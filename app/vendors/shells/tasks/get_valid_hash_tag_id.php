<?php
// Searches a text (Tweet) for hash tag numbers and returns the first one 
// that matches an Original Id from the database:
class GetValidHashTagIdTask extends Shell{
	var $uses=array('Film','Original','Copy');
	function execute($text){
		// Load component:
		App::import('Component','TwitterPicture');
		$this->TwitterPicture=& new TwitterPictureComponent(null);
		
		$hashTags=$this->TwitterPicture->findHashTags($text);
		$originalId=null;
		foreach($hashTags as $hashTag){
			$testId=substr($hashTag,1); // Remove '#'
			// Check if we can find an original with that id
			if($this->Original->find('count',array('recursive'=>'0',
				'conditions'=>array(
					'Original.id'=>$testId
					) ))==1){
				$originalId=$testId;
				break;
			}
		}
		return $originalId;
	}
}

?>