<?php
class RenderFilmTask extends Shell{
	var $uses=array('Film','Original','Copy');
	function execute($film_id){
		// *** Prepare: ***
		$this->Film->read(null,$film_id);
		$originalFolder=sprintf('%s%sframes/original/%05d',WWW_ROOT,Configure::read('mediaPath'),$film_id);
		$originalVideo=sprintf('%s%svideo/original/%05d.flv',WWW_ROOT,Configure::read('mediaPath'),$film_id);
		$copyFolder=sprintf('%s%sframes/copy',WWW_ROOT,Configure::read('mediaPath'));
		$destinationFolder=sprintf('%s%svideo/copy',WWW_ROOT,Configure::read('mediaPath'));
		$tmpFolder=sprintf('%s%05d',TMP,$film_id);
		// Create temporary folder to place symlinks:
		mkdir($tmpFolder);
		// Get all the film's frames:
		$originals=$this->Original->find('all',array('conditions'=>array('film_id'=>$film_id),'recursive'=>'1') );
		// *** Create symlinks for all frames ***
		$i=0;
		foreach($originals as $original){
			// If there is no copy, just link to the original:
			if(empty($original['Copy'])){
				symlink(sprintf('%s/%s',$originalFolder,$original['Original']['file']),sprintf('%s/%010d.jpg',$tmpFolder,$i));
			}else{
			// select first copy and link it:
			$this->out('copy '.$original['Original']['id']);
				symlink(sprintf('%s/%010d.jpg',$copyFolder,$original['Copy'][0]['id']),sprintf('%s/%010d.jpg',$tmpFolder,$i));
			}
			$i++;
		}
		// Mark this films as rendered (it is not yet, but symlinks are done..):
		$this->Film->id=$film_id;
		$this->Film->saveField('render_me',false);
		
		// *** Render video from frames, add original audio ***
		exec(sprintf('nice ffmpeg -r %s -i %s/%s.jpg -i %s -map 0.0 -map 1.1 -vcodec libx264 -b 700k -vpre hq -crf 22 -threads 0 -acodec libmp3lame %s/%05d.flv',$this->Film->getFramerate(),$tmpFolder,'%10d',$originalVideo,$tmpFolder,$film_id));
		// Some explanations:
		//                         ^ framerate from original
		//                               ^ Image sequence input
		//                                            ^ Original video input (for sound)
		//                                                  ^ take video stream from first input
		//                                                           ^ and audio stream from second input
		unlink(sprintf('%s/%05d.flv',$destinationFolder,$film_id));
		rename(sprintf('%s/%05d.flv',$tmpFolder,$film_id),sprintf('%s/%05d.flv',$destinationFolder,$film_id));
		// *** Clean Up ***
		// Mark this films as rendered:
		$this->Film->id=$film_id;
		$this->Film->saveField('render_me',false);
		// Delete temporary data:
		exec('rm -r '.$tmpFolder);
	}
}

?>