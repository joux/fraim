<?php 
class TwitterShell extends Shell{
	var $uses=array('User','Original','Copy');
	var $tasks=array('GetValidHashTagId');
	
	function main(){
		App::import('Component','TwitterPicture');
		$this->TwitterPicture=& new TwitterPictureComponent(null);
		$this->out('Twitter Shell');
		$this->out('---------------');
		$testTweet='We are some #cool #12 people at http://cool.com/';
		$this->out('Test Tweet: '.$testTweet);
		$this->out('Valid Original ID and URL found:');
		$this->out($this->GetValidHashTagId->execute($testTweet));
		$this->out($this->TwitterPicture->findURLs($testTweet));
	}
}
?>