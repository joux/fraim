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