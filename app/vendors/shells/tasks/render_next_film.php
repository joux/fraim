<?php
class RenderNextFilmTask extends Shell{
	// This task renders the Copy videos from the image sequences.
	var $uses=array('Film','Original','Copy');
	var $tasks=array('RenderFilm');
	function execute(){
		// Exit if lock file exists
		if(file_exists(APP_PATH.'locks/RENDERING')) return;
		// Create lock file
		fclose(fopen(APP_PATH.'locks/RENDERING', 'w'));
		$conditions=array('render_me'=>1);
		while($this->Film->find('count',array('recursive'=>0,'conditions'=>$conditions ) ) > 0){
			$films=$this->Film->find('all',array('recursive'=>0,'conditions'=>$conditions));
			foreach($films as $film){
				
				$this->out('Start rendering film #'.$film['Film']['id']);
				$this->RenderFilm->execute($film['Film']['id']);
			}
			
		}
		// delete lock file:
		unlink(APP_PATH.'locks/RENDERING');
	}
}
?>