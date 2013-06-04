<?php

class Git {
	protected $repo;
	protected $name;
	protected $clonePath;

	public function __construct($name, $repoPath, $clonePath) {
		$this->repo = $repoPath;
		$this->name = $name;
		$this->clonePath = $clonePath.'/'.$name;
	}

	public function load() {
		if(!file_exists($this->clonePath))
			mkdir($this->clonePath);

		`git clone $this->repo $this->clonePath`;
	}

	public function fetch() {
		$output = shell_exec("cd $this->clonePath && git fetch -p");
		preg_match_all('!\[new branch\]\s+([a-zA-Z0-9_\-]+)\s!i', $output, $branches);

		return $branches[1];
	}

	public function branch() {
		$output = shell_exec("cd $this->clonePath && git branch -r");
		preg_match_all('!origin/([a-zA-Z0-9_\-]+)\n?!i', $output, $branches);

		return $branches[1];
	}

	public function isRepo() {
		if(file_exists($this->clonePath.'/.git'))
			return true;
		else
			return false;
	}
}