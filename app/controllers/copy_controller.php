<?php
class CopyController extends AppController {

	var $name = 'Copy';
	var $helpers = array('Html', 'Form');

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

	function add() {
		if (!empty($this->data)) {
			$this->Copy->create();
			if ($this->Copy->save($this->data)) {
				$this->Session->setFlash(__('The Copy has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Copy could not be saved. Please, try again.', true));
			}
		}
		$originals = $this->Copy->Original->find('list');
		$users = $this->Copy->User->find('list');
		$this->set(compact('originals', 'users'));
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