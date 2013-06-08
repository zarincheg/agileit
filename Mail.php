<?php
class Mail {
	public $sender;
	
	private $attaches = array();
	private $headers = "";
	private $boundary;
	
	function __construct($sender = '') {
		$this->boundary = "PHP-mixed-".md5(time());
		$this->headers .= 'Content-Type: multipart/mixed; boundary="' . $this->boundary . "\"\n";
		$this->sender = $sender;
	}
	
	function attach(array $files) {
		foreach($files as $file) {
			$file["attachment"] = chunk_split(base64_encode(file_get_contents($file['path'])));
			$this->attaches[] = $this->getPart('attach', $file);
		}
	}
	
	function send($recipient, $subject, $message) {
        if(is_array($recipient))
            $recipient = implode(',', $recipient);

		$headers = $this->headers . "From: {$this->sender}\nReply-To: {$this->sender}\n";
		
		$body = $this->getPart('text', $message);
		if($this->attaches) {
			$body .= implode("", $this->attaches);
		}
		$body .= "--" . $this->boundary . "--\n\n";
		return mail($recipient, $subject, $body, $headers);
	}
	
	function getPart($type, $content) {
		$part = "--" . $this->boundary . "\n";
		if($type == 'text') {
			$part .= 'Content-Type: text/html; charset="utf-8"' . "\n";
			$part .= "Content-Transfer-Encoding: 8bit\n\n";
			$part .= $content . "\n";
		} elseif($type == 'attach' && is_array($content)) {
			$part .= 'Content-Type: ' . $content['type'] . '; name="' . $content['name'] . "\"\n";
			$part .= "Content-Transfer-Encoding: base64\n";
			$part .= "Content-Disposition: attachment\n\n";
			$part .= $content["attachment"] . "\n";
		}
		return $part;
	}
}
