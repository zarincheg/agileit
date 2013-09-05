<?php
include 'Git.php';

/**
 * $argv[1] - Project name
 */

$mongo = new MongoClient();
$db = $mongo->selectDB($argv[1]);
$settings = $db->settings->findOne(['project' => $argv[1]]);
$git = new Git($argv[1], $settings['repoPath'], $settings['clonePath']); // @todo Из mongo->agilit->settings

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
	preg_match("!^([0-9a-z_]+)\-!ui", $b, $m);
	$branchType = isset($m[1]) ? $m[1] : 'common';

	$db->branches->insert(['name' => $b,
						   'type' => $branchType,
						   'status' => 'review',
						   'merged' => []]);
}

$diff = array_diff($list, $branches);

foreach ($diff as $b) {
	$db->branches->remove(['name' => $b]);
}