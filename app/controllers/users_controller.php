<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');
	var $components= array('Auth');
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('add');
	}

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid User.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		//debug($this->Auth);
		if (!empty($this->data)) {
			//debug($this->data);
			// Check if password was entered twice correctly:
			if($this->data['User']['password']!=$this->Auth->password($this->data['User']['password2'])){
				// Empty password fields:
				$this->data['User']['password']=null;
				$this->data['User']['password2']=null;
				$this->Session->setFlash(__('The passwords you entered do not match. Please try again.',true));
			}else{
				//$this->data['User']['password']=$this->Auth->password($this->data['User']['password']);
				$this->User->create();
				if ($this->User->save($this->data)) {
					$this->Session->setFlash(__('The User has been saved', true));
					$this->redirect(array('action'=>'index'));
				} else {
					$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
				}
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function login(){
		
	}
	
	function logout(){
		$this->Auth->logout();
		$this->redirect('/');
	}
	
	function changePassword(){
		if(!empty($this->data)){
			// Change password only of logged in user, of course:
			$this->User->id=$this->Auth->user('id');
			// Check if both fields match:
			if($this->data['User']['password']==$this->data['User']['password2']){
				//Check if password validates (minLength):
				//if($this->Artist->validates()){
				if(true){ // TODO: Set up validation
					// Only then hash and put new password into data:
					if ($this->User->saveField('password',$this->Auth->password($this->data['User']['password']),true)) {
						// Don't display the input again:
						$this->data=null;
						$this->Session->setFlash(__('Your new password has been saved', true));
					}else{
						$this->Session->setFlash(__('Your new password could not be saved. Please, try again.', true));
					}
				}else{$this->Session->setFlash(__('Your password is not secure.', true));
				debug($this->Artist->validationErrors);
				}
			}else{
					$this->Session->setFlash(__('The two fields do not match.', true));
					// Reset form:
					$this->data=null;
			}
		}
	}

}
?>