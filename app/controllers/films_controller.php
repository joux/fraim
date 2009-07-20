<?php
class FilmsController extends AppController {

	var $name = 'Films';
	var $helpers = array('Html', 'Form','Javascript');
	var $components= array('Auth');
	
	function beforeFilter(){
		$this->Auth->allow('*');
	}

	function index() {
		$this->Film->recursive = 0;
		$this->set('films', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Film.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('film', $this->Film->read(null, $id));
		$this->set('suggestFrames',$this->Film->getUnclonedOriginals(4));
	}

	function add() {
		debug($this->data);
		if (!empty($this->data)) {
			$this->Film->create();
			if ($this->Film->save($this->data)) {
				$this->Session->setFlash(__('The Film has been saved', true));
				debug('Film record saved with id '.$this->Film->id);
				debug('Uploaded video file name was '.$this->data['Film']['content']['name']);
				// Handle the uploaded video:
				// Check for some possible problems:
				$uploadProblems=false;
				$uploadErrorReport='';
				if(empty($this->data['Film']['content']['name'])){
					$uploadProblems=true;
					$uploadErrorReport=$uploadErrorReport.' '.__('You did not choose a file.',true);
				}
				if($this->data['Film']['content']['size'] > Configure::read('max_video_upload_size') || $this->data['Film']['content']['error']==1){
					// Error Code 1 means file size exceeds the upload_max_filesize directive in php.ini.
					$uploadProblems=true;
					$uploadErrorReport=$uploadErrorReport.' '.__('The video file is too big.',true);
				}
				if($this->data['Film']['content']['type']!='video/x-flv'){
					$uploadProblems=true;
					$uploadErrorReport=$uploadErrorReport.' '.__('Only Flash videos (.flv) are allowed.',true).$this->data['Film']['content']['type'];
				}
				if($this->data['Film']['content']['error'] != 0){
					$uploadProblems=true;
					$uploadErrorReport=$uploadErrorReport.' '.__('Upload Error.',true);
				}
				// Now move the uploaded file into the right folder:
				if(!$uploadProblems){
					$uploadPath=WWW_ROOT.Configure::read('mediaPath').'video/original/';
					debug(sprintf('Video file will now be moved to %s%05d.flv',$uploadPath,$this->Film->id));
					move_uploaded_file($this->data['Film']['content']['tmp_name'],sprintf('%s%05d.flv',$uploadPath,$this->Film->id));
				}else{
					// Delete the film record again, because there is no corresponding file now:
					$this->Film->del($this->Film->id);
					$this->Session->setFlash(__('Video Error. The film could not be created', true).$uploadErrorReport);
				}
				
				
			} else {
				$this->Session->setFlash(__('The Film record could not be saved. Please, try again.', true));
			}
		}else{debug('empty data');}
		$users = $this->Film->User->find('list');
		$this->set(compact('users'));
	}
	
	function adoptFrame($id=null){
		// This function redirects to adding a copy to a random original (that needs it)
		if(!$id) $this->redirect('index');
		$loneOriginals=$this->Film->getUnclonedOriginals(1);
		if(!empty($loneOriginals)) $this->redirect(array('controller'=>'Copies','action'=>'add',$loneOriginals[0]['Original']['id']));
		// If all originals already have copies: Get the one with the least amount of copies:
		$loneOriginals=$this->Film->getLeastClonedOriginals(1);
		$this->redirect(array('controller'=>'Copies','action'=>'add',$loneOriginals[0]['Original']['id']));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Film', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Film->save($this->data)) {
				$this->Session->setFlash(__('The Film has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Film could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Film->read(null, $id);
		}
		$users = $this->Film->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Film', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Film->del($id)) {
			$this->Session->setFlash(__('Film deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>