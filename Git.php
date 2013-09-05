<?php

class Git {
	protected $repo;
	protected $name;
	protected $clonePath;

	public function __construct($name, $repoPath, $clonePath) {
		$this->repo = $repoPath;
		$this->name = $name;
		$this->clonePath = $clonePath;
	}

	public function load() {
		if(!file_exists($this->clonePath)) {
			echo("Clone path doesn't exists:".$this->clonePath."\n");
			exit(0);
		}

		if(!file_exists($this->clonePath.'/'.$this->name))
			mkdir($this->clonePath.'/'.$this->name);

		return `git clone $this->repo $this->clonePath.'/'.$this->name`;
	}

	public function fetch() {
		$output = shell_exec("cd $this->clonePath.'/'.$this->name && git fetch -p");
		preg_match_all('!\[new branch\]\s+([a-zA-Z0-9_\-]+)\s!i', $output, $branches);

		return $branches[1];
	}

	public function branch() {
		$output = shell_exec("cd $this->clonePath.'/'.$this->name && git branch -r");
		preg_match_all('!origin/([a-zA-Z0-9_\-]+)\n?!i', $output, $branches);

		return $branches[1];
	}

	public function isRepo() {
		if(file_exists($this->clonePath.'/'.$this->name.'/.git'))
			return true;
		else
			return false;
	}
}