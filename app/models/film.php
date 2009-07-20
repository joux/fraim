<?php
class Film extends AppModel {

	var $name = 'Film';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Original' => array(
			'className' => 'Original',
			'foreignKey' => 'film_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	function getUnclonedOriginals($amount=1){
		// This function returns up to n Originals that have no Copy
		// Check how many records will be affected:
		$query='SELECT COUNT(*) AS count FROM (SELECT Original.id AS myId FROM `originals` AS Original LEFT OUTER JOIN copies ON Original.id = copies.original_id WHERE copies.id IS NULL AND Original.film_id = '.$this->id.' GROUP BY Original.id) AS countTable;';
		$count=$this->Original->query($query);
		$count=$count[0][0]['count'];
		// We want to retrieve 4 times as many records as needed, so we can randomize a little:
		$getAmount=2*$amount;
		debug('Lone records: '.$count);
		// Retrieve data 1:
		$query='SELECT Original.* FROM `originals` AS Original LEFT OUTER JOIN copies ON Original.id = copies.original_id WHERE copies.id IS NULL AND Original.film_id = '.$this->id.' GROUP BY Original.id LIMIT '.rand(1,$count-$getAmount).','.$getAmount;
		$loneOriginals=$this->Original->query($query);
		$frameCount=$this->Original->getAffectedRows();
		// Retrieve data 2:
		$query='SELECT Original.* FROM `originals` AS Original LEFT OUTER JOIN copies ON Original.id = copies.original_id WHERE copies.id IS NULL AND Original.film_id = '.$this->id.' GROUP BY Original.id LIMIT '.rand(1,$count-$getAmount).','.$getAmount;
		$loneOriginals=array_merge($loneOriginals,$this->Original->query($query));
		$frameCount+=$this->Original->getAffectedRows();
		// Now we have records from 2 different "pages" to choose from:
		if($frameCount<$amount) $amount=$frameCount;
		shuffle($loneOriginals);
		$loneOriginals=array_slice($loneOriginals,0,$amount);
		return $loneOriginals;
	}
	
	function getLeastClonedOriginals($amount=1){
		// This function returns the n Originals that have the smallest amount of Copies.
		// Be careful: It 
		// ######## am besten mit subquery nur die wenigsten, also etwa alle mit 0 finden, dann rand.
		$query='SELECT originals.id,COUNT(copies.id) AS copycount FROM `originals` LEFT OUTER JOIN copies on copies.original_id=originals.id WHERE originals.film_id='.$this->id.' GROUP BY originals.id ORDER BY copycount ASC LIMIT '.$amount;
		$query='SELECT *,COUNT(copies.id) AS copycount FROM `originals` AS Original LEFT OUTER JOIN copies on copies.original_id=Original.id WHERE Original.film_id='.$this->id.' GROUP BY Original.id ORDER BY copycount ASC LIMIT '.$amount;
		$loneOriginals=$this->Original->query($query);
		$frameCount=$this->Original->getAffectedRows();
		if($frameCount<$amount) $amount=$frameCount;
		shuffle($loneOriginals);
		return $loneOriginals;
	}
	
	function getFramerate(){
		// Check if framerate is already cached in db:
		// ###
		// Extract and save framerate from the original video file:
		$inputFile=sprintf('%s%svideo/original/%05d.flv',WWW_ROOT,Configure::read('mediaPath'),$this->id);
		// Run ffmpeg on the file, redirect stderr, so we can read it:
		exec('nice ffmpeg -i '.$inputFile.' 2>&1',$fileInfo);
		$fileInfo=implode($fileInfo);
		preg_match('/[0-9.]{1,5} tbr/',$fileInfo,$matches);
		$framerate=substr($matches[0],0,-4);
		return $framerate;
	}

}
?>