<?php
class ConvertNextFilmTask extends Shell{
	var $uses=array('Film');
	function execute(){
		//App:import('Core','File');
		// Exit if lock file exists
		if(file_exists('locks/CONVERTING')) return;
		// Create lock file
		fclose(fopen('locks/CONVERTING', 'w'));
		while($this->Film->find('count',array('conditions'=>array('single_frames_ready'=>0,'conversion_error'=>0) ) ) > 0){
			$films=$this->Film->find('all',array('conditions'=>array('single_frames_ready'=>0,'conversion_error'=>0) ) );
			foreach($films as $film){
				$this->out($film['Film']['title']);
				$inputFile=sprintf('app/webroot/%svideo/%05d.flv',Configure::read('mediaPath'),$film['Film']['id']);
				$outputFolder=sprintf('app/webroot/%sframes/original/%05d/',Configure::read('mediaPath'),$film['Film']['id']);
				exec('nice ffmpeg -i '.$inputFile.' -s 640x480 -an -r 10 -y '.$outputFolder.'%10d.jpg');
				//exec("touch exec-here.txt");
				$film['Film']['single_frames_ready']=1;
				$this->Film->save($film);
			}
			
		}
		// delete lock file:
		unlink('locks/CONVERTING');
	}
}
?>