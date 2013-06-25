<?php

require 'flight/flight/Flight.php';
require 'Mail.php';

session_start();

Flight::map('config', function() {
	$config = file_get_contents('config.json');
	return json_decode($config);
});

$config = Flight::config();

Flight::register('mongo', 'MongoClient', [$config->dbms->server]);

Flight::map('projectdb', function($project) {
	$mongo = Flight::mongo();
	return $mongo->selectDB($project);
});

Flight::map('sysdb', function() {
	$mongo = Flight::mongo();
	$config = Flight::config();
	return $mongo->selectDB($config->dbms->db);
});

Flight::map('translit', function($str) {
    $tr = array(
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
        "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
        "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
        "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
        "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
        "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
        "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya", " " => "-"
    );
    return strtr($str, $tr);
});

Flight::route('GET /authorization', function() {
	Flight::render('authorization');
});

// @todo Сделать запоминание авторизации через авторизационный ключ в куках
Flight::route('POST /authorization', function() {
	$sysdb = Flight::sysdb();
	$email =filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		Flight::halt(406, 'Email address is not valid!');
	}

	$user = $sysdb->users->findOne(['_id' => $email]);
	
	if(!$user) {
		// Парль отсылается только в случае, если он генерируется системой. Иначе есть опасность отослать вредные данные пользователю.
		if(!$_POST['password']) {
			$bytes = openssl_random_pseudo_bytes(rand(4, 12));
			$password = bin2hex($bytes);
			$message = "Welcome to AgileIT!<br>Your password: ".$password;
		} else {
			$password = $_POST['password'];
			$message = "Welcome to AgileIT!";
		}

		$hash = md5($password);
		$projectName = substr($email, 0, strpos($email, '@')).'_'.rand(0, 999);
		$user = ['_id' => $email,
				 'password' => $hash,
				 'projects' => [['name' => $projectName,
				 				 'title' => 'Personal',
				 				 'owner' => true]],
				 'name' => 'Hello',
				 'lastname' => 'Username',
				 'currentProject' => $projectName
				];
		$sysdb->users->insert($user);

		$db = Flight::projectdb($projectName);
		$db->users->insert(['_id' => $email,
							'name' => 'Hello',
				 			'lastname' => 'Username',
				 			'owner' => true]);

		$mail = new Mail('Agile IT! <bot@agileit.ru>');
		$mail->send($email, 'Successful registration', $message);
	} else {
		if(md5($_POST['password']) !== $user['password']) {
			Flight::halt(403, 'Incorrect password!');
		}
	}

	$_SESSION['user'] = $user;

	Flight::json(['success' => true]);
});

Flight::route('*', function() {
	if(isset($_SESSION['user'])) {
		$sysdb = Flight::sysdb();
		$user = $sysdb->users->findOne(['_id' => $_SESSION['user']['_id']]);
		$_SESSION['user'] = $user;
		
		Flight::set('user', $user);
		Flight::set('currentProject', $user['currentProject']);
		
		Flight::view()->set('user', $user);
		Flight::view()->set('currentProject', $user['currentProject']);

		return true;
	} else {
		Flight::redirect('/authorization');
	}
});

Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('GET /dashboard', function() {
	$db = Flight::projectdb(Flight::get('currentProject'));
	$bugs = $db->tasks->find([
		'type' => 'bug'
	]);

	$features = $db->tasks->find([
		'type' => 'feature'
	]);

	Flight::render('dashboard', ['bugs' => $bugs, 'features' => $features], 'content');
	Flight::render('root');
});

Flight::route('POST /dashboard/add/@type', function($type) {
	$taskId = Flight::translit($_POST['name']);
	$db = Flight::projectdb(Flight::get('currentProject'));
	$db->tasks->insert([
		'_id' => $taskId,
		'name' => $_POST['name'],
		'details' => $_POST['details'],
		'type' => $type,
		'status' => 'open'
	]);
	
	Flight::json(['success' => true, 'taskId' => $taskId]);
});

Flight::route('GET /dashboard/select/@project', function($project) {
	$userId = $_SESSION['user']['_id'];
	$db = Flight::sysdb();
	$db->users->update(['_id' => $userId], ['$set' => ['currentProject' => $project]]);

	Flight::redirect('/dashboard');
});

Flight::route('GET /task/@id', function($id) {
	$db = Flight::projectdb(Flight::get('currentProject'));
	$task = $db->tasks->findOne(['_id' => $id]);

	Flight::render('task', $task, 'content');
	Flight::render('root');
});

Flight::route('PUT /task/@id/close', function($id) {
	$db = Flight::projectdb(Flight::get('currentProject'));
	$task = $db->tasks->update(['_id' => $id],
										  ['$set' => ['status' => 'close']]);

	Flight::json(['success' => true, 'taskId' => $id]);
});

Flight::route('PUT /task/@id/open', function($id) {
	$db = Flight::projectdb(Flight::get('currentProject'));
	$task = $db->tasks->update(['_id' => $id],
										  ['$set' => ['status' => 'open']]);

	Flight::json(['success' => true, 'taskId' => $id]);
});

Flight::route('GET /branches', function() {
	$list = [];
	$db = Flight::projectdb(Flight::get('currentProject'));
	$branches = $db->branches->find([], ['name' => true, 'status' => true]);

	while($branches->hasNext()) {
		$list[] = $branches->getNext();
	}

	Flight::render('branches', ['list' => $list], 'content');
	Flight::render('root');
});

Flight::route('GET /backlog', function() {
	$db = Flight::projectdb(Flight::get('currentProject'));
	$backlog = $db->backlog->find()->sort(['rating' => -1]);
	Flight::render('backlog', ['backlog' => $backlog], 'content');
	Flight::render('root');
});

Flight::route('POST /backlog/add', function() {
	$db = Flight::projectdb(Flight::get('currentProject'));
	$db->backlog->insert([
		'text' => $_POST['record'],
		'rating' => 0
	]);
	
	Flight::json(['success' => true, 'text' => $_POST['record']]);
});

Flight::route('GET /backlog/remove/@id', function($id) {
	$db = Flight::projectdb(Flight::get('currentProject'));
	$db->backlog->remove([
		'_id' => new MongoId($id)
	]);
	
	Flight::json(['success' => true]);
});

Flight::route('GET /backlog/up/@id', function($id) {
	$db = Flight::projectdb(Flight::get('currentProject'));
	$db->backlog->update(['_id' => new MongoId($id)],
									['$inc' => ['rating' => 1]]);
	Flight::json(['success' => true]);
});

Flight::route('GET /stream', function() {
	$db = Flight::projectdb(Flight::get('currentProject'));
	$stream = $db->stream->find()->sort(['date' => -1]);

	Flight::render('stream', ['stream' => $stream], 'content');
	Flight::render('root');
});

Flight::route('POST /stream/add', function() {
	$db = Flight::projectdb(Flight::get('currentProject'));
	$db->stream->insert([
		'text' => $_POST['note'],
		'author' => 'Kirill Zorin',
		'date' => new MongoDate(time())
	]);
	
	Flight::json(['success' => true, 'text' => $_POST['note'],
									 'author' => 'Kirill Zorin',
									 'date' => date("d-m-Y H:i")]);
});

Flight::route('GET /settings', function() {
	$db = Flight::projectdb(Flight::get('currentProject'));
	$settings = $db->settings->findOne(['project' => '35cm']);

	Flight::render('settings', ['settings' => $settings], 'content');
	Flight::render('root');
});

Flight::route('POST /settings', function() {
	$db = Flight::projectdb(Flight::get('currentProject'));
	$db->settings->update(['project' => '35cm'],
						  ['project' => '35cm',
						   'repoPath' => $_POST['repo'], 
						   'clonePath' => $_POST['path']],
						  ['upsert' => true]);

	Flight::json(['success' => true]);
});

Flight::start();