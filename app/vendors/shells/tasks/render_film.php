<?php
class RenderFilmTask extends Shell{
	var $uses=array('Film','Original','Copy');
	function execute($film_id){
		// *** Prepare: ***
		$originalFolder=sprintf('%s%sframes/original/%05d',WWW_ROOT,Configure::read('mediaPath'),$film_id);
		$copyFolder=sprintf('%s%sframes/copy',WWW_ROOT,Configure::read('mediaPath'));
		$destinationFolder=sprintf('%s%svideo/copy',WWW_ROOT,Configure::read('mediaPath'));
		$tmpFolder=sprintf('%s%05d',TMP,$film_id);
		// Create temporary folder to place symlinks:
		mkdir($tmpFolder);
		// Get all the film's frames:
		$originals=$this->Original->find('all',array('conditions'=>array('film_id'=>$film_id),'recursive'=>'1') );
		// *** Create symlinks for all frames ***
		foreach($originals as $original){
			// If there is no copy, just link to the original:
			if(empty($original['Copy'])){
				symlink(sprintf('%s/%010d.jpg',$originalFolder,$original['Original']['id']),sprintf('%s/%010d.jpg',$tmpFolder,$original['Original']['id']));
			}else{
			// select a random copy and link it:
			$this->out('copy '.$original['Original']['id']);
				symlink(sprintf('%s/%010d.jpg',$copyFolder,$original['Copy'][0]['id']),sprintf('%s/%010d.jpg',$tmpFolder,$original['Original']['id']));
			}
		}
		// Mark this films as rendered (it is not yet, but symlinks are done...):
		$this->Film->id=$film_id;
		$this->Film->saveField('render_me',false);
		
		// *** Render video from frames ***
		exec(sprintf('ffmpeg -i %s/%s.jpg -vcodec libx264 -b 700k -r 25 %s/%05d.flv',$tmpFolder,'%10d',$tmpFolder,$film_id));
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