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
		// This function returns up to n Originals, that have no Copy
		$query='SELECT * FROM `originals` AS Original LEFT OUTER JOIN copies ON Original.id = copies.original_id WHERE copies.id IS NULL AND Original.film_id = '.$this->id.' GROUP BY Original.id';
		$loneOriginals=$this->Original->query($query);
		$frameCount=$this->Original->getAffectedRows();
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
	

}
?>