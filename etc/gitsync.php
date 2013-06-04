<?php
include 'Git.php';

$mongo = new MongoClient();
$db = $mongo->selectDB('agilit');
$settings = $db->settings->findOne(['project' => '35cm']);
$git = new Git('35cm', $settings['repoPath'], $settings['clonePath']); // @todo Из mongo->agilit->settings

if(!$git->isRepo()) {
	$git->load();
} else {
	$git->fetch();
}

$branches = $git->branch();
$list = [];
$exists = $db->branches->find();

while($exists->hasNext()) {
	$branch = $exists->getNext();
	$list[] = $branch['name'];
}

$diff = array_diff($branches, $list);

foreach ($diff as $b) {
	$db->branches->insert(['name' => $b,
						   'type' => 'common', // @todo Определять тип по префиксу имени: patch, feature, etc
						   'status' => 'review']);
}

$diff = array_diff($list, $branches);

foreach ($diff as $b) {
	$db->branches->remove(['name' => $b]);
}