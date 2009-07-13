<?php
class FilmController extends AppController {

	var $name = 'Film';
	var $helpers = array('Html', 'Form');

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
	}

	function add() {
		if (!empty($this->data)) {
			$this->Film->create();
			if ($this->Film->save($this->data)) {
				$this->Session->setFlash(__('The Film has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Film could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Film->User->find('list');
		$this->set(compact('users'));
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