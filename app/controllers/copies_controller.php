<?php
class CopiesController extends AppController {

	var $name = 'Copies';
	var $helpers = array('Html', 'Form');
	var $components= array('Auth');
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('view');
	}

	function index() {
		$this->Copy->recursive = 0;
		$this->set('copies', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Copy.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('copy', $this->Copy->read(null, $id));
	}

	function add($original_id=null) {
		// Check if original id was passed:
		if(empty($this->data) && $original_id==null){
			$this->redirect(array('controller'=>'Films','action'=>'index'));
		}
		// Read id from form data, if present:
		if (!empty($this->data)) $original_id=$this->data['Copy']['original_id'];
		$original = $this->Copy->Original->find('first',array('conditions'=>array('Original.id'=>$original_id) ));
		if (!empty($this->data)) {
			// Copy will belong to the logged in User:
			$this->data['Copy']['user_id']=$this->Auth->user('id');
			$this->Copy->create();
			if ($this->Copy->save($this->data)) {
				//debug('Copy record saved with id '.$this->Copy->id);
				//debug('Uploaded image file name was '.$this->data['Copy']['content']['name']);
				// Handle the uploaded file:
				// Check for some possible problems:
				$uploadProblems=false;
				$uploadErrorReport='';
				if(empty($this->data['Copy']['content']['name'])){
					$uploadProblems=true;
					$uploadErrorReport=$uploadErrorReport.' '.__('You did not choose a file.',true);
				}
				if($this->data['Copy']['content']['size'] > Configure::read('max_picture_upload_size') || $this->data['Copy']['content']['error']==1){
					// Error Code 1 means file size exceeds the upload_max_filesize directive in php.ini.
					$uploadProblems=true;
					$uploadErrorReport=$uploadErrorReport.' '.__('The image file is too big.',true);
				}
				if($this->data['Copy']['content']['type']!='image/jpeg'){
					$uploadProblems=true;
					$uploadErrorReport=$uploadErrorReport.' '.__('Only jpeg images are allowed.',true).$this->data['Copy']['content']['type'];
				}
				if($this->data['Copy']['content']['error'] != 0){
					$uploadProblems=true;
					$uploadErrorReport=$uploadErrorReport.' '.__('Upload Error.',true);
				}
				// Now move the uploaded file into the right folder:
				if(!$uploadProblems){
					$uploadPath=WWW_ROOT.Configure::read('mediaPath').'frames/copy/';
					//debug(sprintf('Image file will now be moved to %s%010d.jpg',$uploadPath,$this->Copy->id));
					move_uploaded_file($this->data['Copy']['content']['tmp_name'],sprintf('%s%010d.jpg',$uploadPath,$this->Copy->id));
					// Mark the film for a new rendering:
					$film=$this->Copy->Original->find('first',array('conditions'=>array('Original.id'=>$original_id) ,'recursive'=>'1') );
					$film['Film']['render_me']=true;
					$this->Copy->Original->Film->save($film);
					$this->Session->setFlash(__('The Copy has been saved. But it will take a while before it shows up in the film.', true));
				}else{
					// Delete the record again, because there is no corresponding file now:
					$this->Copy->del($this->Copy->id);
					$this->Session->setFlash(__('Image Error. The copy could not be created', true).$uploadErrorReport);
				}
				$this->redirect(array('controller'=>'Films','action'=>'view',$original['Original']['film_id']));
			} else {
				$this->Session->setFlash(__('The Copy could not be saved. Please, try again.', true));
			}
		}
		
		$users = $this->Copy->User->find('list');
		$this->set(compact('original', 'users'));
		$this->set('original_id',$original_id);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Copy', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Copy->save($this->data)) {
				$this->Session->setFlash(__('The Copy has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Copy could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Copy->read(null, $id);
		}
		$originals = $this->Copy->Original->find('list');
		$users = $this->Copy->User->find('list');
		$this->set(compact('originals','users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Copy', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Copy->del($id)) {
			$this->Session->setFlash(__('Copy deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>