<?php

require 'flight/Flight.php';


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
	$mongo = new MongoClient();
	$mongo->agilit->tasks->insert([
		'name' => $_POST['name'],
		'details' => $_POST['details'],
		'type' => $type,
		'status' => 'open'
	]);
	
	Flight::json(['success' => true]);
});

Flight::route('GET /branches', function() {
	Flight::render('branches', null, 'content');
	Flight::render('root');
});

Flight::route('GET /backlog', function() {
	Flight::render('backlog', null, 'content');
	Flight::render('root');
});

Flight::route('GET /stream', function() {
	Flight::render('stream', null, 'content');
	Flight::render('root');
});

Flight::start();