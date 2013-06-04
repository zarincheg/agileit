<?php

require 'flight/Flight.php';

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

Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('GET /dashboard', function() {
	$mongo = new MongoClient();
	$bugs = $mongo->agilit->tasks->find([
		'type' => 'bug'
	]);

	$features = $mongo->agilit->tasks->find([
		'type' => 'feature'
	]);

	Flight::render('dashboard', ['bugs' => $bugs, 'features' => $features], 'content');
	Flight::render('root');
});

Flight::route('POST /dashboard/add/@type', function($type) {
	$taskId = Flight::translit($_POST['name']);
	$mongo = new MongoClient();
	$mongo->agilit->tasks->insert([
		'_id' => $taskId,
		'name' => $_POST['name'],
		'details' => $_POST['details'],
		'type' => $type,
		'status' => 'open'
	]);
	
	Flight::json(['success' => true, 'taskId' => $taskId]);
});

Flight::route('GET /task/@id', function($id) {
	$mongo = new MongoClient();
	$task = $mongo->agilit->tasks->findOne(['_id' => $id]);

	Flight::render('task', $task, 'content');
	Flight::render('root');
});

Flight::route('GET /branches', function() {
	preg_match_all("!.*?origin/(.*?)\n!", `git branch -r`, $list);
	sort($list[1]);

	Flight::render('branches', ['list' => $list[1]], 'content');
	Flight::render('root');
});

Flight::route('GET /backlog', function() {
	$mongo = new MongoClient();
	$backlog = $mongo->agilit->backlog->find()->sort(['rating' => -1]);
	Flight::render('backlog', ['backlog' => $backlog], 'content');
	Flight::render('root');
});

Flight::route('POST /backlog/add', function() {
	$mongo = new MongoClient();
	$mongo->agilit->backlog->insert([
		'text' => $_POST['record'],
		'rating' => 0
	]);
	
	Flight::json(['success' => true, 'text' => $_POST['record']]);
});

Flight::route('GET /backlog/remove/@id', function($id) {
	$mongo = new MongoClient();
	$mongo->agilit->backlog->remove([
		'_id' => new MongoId($id)
	]);
	
	Flight::json(['success' => true]);
});

Flight::route('GET /backlog/up/@id', function($id) {
	$mongo = new MongoClient();
	$mongo->agilit->backlog->update(['_id' => new MongoId($id)],
									['$inc' => ['rating' => 1]]);
	Flight::json(['success' => true]);
});

Flight::route('GET /stream', function() {
	$mongo = new MongoClient();
	$stream = $mongo->agilit->stream->find()->sort(['date' => -1]);

	Flight::render('stream', ['stream' => $stream], 'content');
	Flight::render('root');
});

Flight::route('POST /stream/add', function() {
	$mongo = new MongoClient();
	$mongo->agilit->stream->insert([
		'text' => $_POST['note'],
		'author' => 'Kirill Zorin',
		'date' => new MongoDate(time())
	]);
	
	Flight::json(['success' => true, 'text' => $_POST['note'],
									 'author' => 'Kirill Zorin',
									 'date' => date("d-m-Y H:i")]);
});

Flight::route('GET /settings', function() {
	$mongo = new MongoClient();
	$settings = $mongo->agilit->settings->findOne(['project' => '35cm']);

	Flight::render('settings', ['settings' => $settings], 'content');
	Flight::render('root');
});

Flight::route('POST /settings', function() {
	$mongo = new MongoClient();
	$mongo->agilit->settings->update(['project' => '35cm'],
									 ['project' => '35cm',
									  'repoPath' => $_POST['repo'], 
									  'clonePath' => $_POST['path']],
									 ['upsert' => true]);

	Flight::json(['success' => true]);
});

Flight::start();