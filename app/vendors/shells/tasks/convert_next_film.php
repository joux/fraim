<?php
class ConvertNextFilmTask extends Shell{
	var $uses=array('Film','Original');
	function execute(){
		//App:import('Core','File');
		// Exit if lock file exists
		if(file_exists(APP_PATH.'locks/CONVERTING')) return;
		// Create lock file
		fclose(fopen(APP_PATH.'locks/CONVERTING', 'w'));
		while($this->Film->find('count',array('conditions'=>array('single_frames_ready'=>0,'conversion_error'=>0) ) ) > 0){
			$films=$this->Film->find('all',array('conditions'=>array('single_frames_ready'=>0,'conversion_error'=>0) ) );
			foreach($films as $film){
				//$this->out($film['Film']['title']);
				// Convert to single frames:
				$inputFile=sprintf('%s%svideo/original/%05d.flv',WWW_ROOT,Configure::read('mediaPath'),$film['Film']['id']);
				$outputFolder=sprintf('%s%sframes/original/%05d/',WWW_ROOT,Configure::read('mediaPath'),$film['Film']['id']);
				//Create output folder first:
				mkdir($outputFolder);
				exec('nice ffmpeg -i '.$inputFile.' -s 640x480 -an -r 10 -y '.$outputFolder.'%10d.jpg');
				
				
				// Now create db records for all the frames:
				// Refuse if this film has already parsed frames:
				if( $this->Original->find('count',array('conditions'=>'film_id='.$film['Film']['id'])) > 0){
					$this->out('Originals of the film are already in the db. Something is wrong.');
					exit();
				}
				// We need to save to intermediate array, so we can sort:
				//$fileArray[]=new array();
				foreach (new DirectoryIterator(sprintf('%s%sframes/original/%05d',WWW_ROOT,Configure::read('mediaPath'),$film['Film']['id'])) as $file) {
					// if the file is a file and not hidden:
				   if ( !$file->isDot() && !$file->isDir() )  {
					   $fileArray[]=$file->getFilename();
				   }
				}
				// Now sort by filename:
				asort($fileArray);
				// And create new originals:
				foreach($fileArray as $file){
					$this->Original->create();
					   $this->data['Original']['film_id']=$film['Film']['id'];
					   $this->data['Original']['file']='media/frames/original/'.$film['Film']['id'].'/'.$file;
					   if($this->Original->save($this->data)){
					      $this->out($file.' saved');
					   }else{
						debug('Could not save Original while parsing files');
						break;
					   }
				}
				// Now the film is ready for use:
				$film['Film']['single_frames_ready']=1;
				$this->Film->save($film);
			}
			
		}
		// delete lock file:
		unlink(APP_PATH.'locks/CONVERTING');
	}
}
?>