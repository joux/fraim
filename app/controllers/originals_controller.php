<?php
class OriginalsController extends AppController {

	var $name = 'Originals';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Original->recursive = 0;
		$this->set('originals', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Original.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('original', $this->Original->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Original->create();
			if ($this->Original->save($this->data)) {
				$this->Session->setFlash(__('The Original has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Original could not be saved. Please, try again.', true));
			}
		}
		$films = $this->Original->Film->find('list');
		$this->set(compact('films'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Original', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Original->save($this->data)) {
				$this->Session->setFlash(__('The Original has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Original could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Original->read(null, $id);
		}
		$films = $this->Original->Film->find('list');
		$this->set(compact('films'));
	}
	
	function addFromFilm($film_id=null){
		// This function creates all the Original frames that belong to the
		// given film by iterating through the corresponding folder:
		
		// Refuse if this film has already parsed frames:
		if( $this->Original->find('count',array('conditions'=>'film_id='.$film_id)) > 0){
			$this->Session->setFlash(__('The selected film was already parsed',true));
			$this->redirect('/');
		}
		// We need to save to intermediate array, so we can sort:
		//$fileArray[]=new array();
		foreach (new DirectoryIterator(sprintf('%sframes/original/%05d',Configure::read('mediaPath'),$film_id)) as $file) {
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
			   $this->data['Original']['film_id']=$film_id;
			   $this->data['Original']['file']='media/frames/original/'.$film_id.'/'.$file;
			   if($this->Original->save($this->data)){
			      pr ($file.' saved');
			   }else{
				$this->Session->setFlash(__('There was an error processing your film',true));
				debug('Could not save Original while parsing files');
				break;
			   }
		}
		$this->redirect('/');
		
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Original', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Original->del($id)) {
			$this->Session->setFlash(__('Original deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>