<?php

class Admin_IndexController extends Zend_Controller_Action {
	
	protected $adminMod;
	
	public function init() {
		
		$this->adminMod = new Admin_Model_DbTable_Admins ();
	}
	
	public function indexAction() {
		$admins = $this->adminMod->getAllAdmins ();
		$this->view->content = $admins;
	}
	
	public function editAction() {
		
		require_once APPLICATION_PATH . '/modules/admin/forms/AdminEdit.php';
		$form = new Admin_Forms_AdminEdit ();
		$request = $this->getRequest ();
		$id = $request->getParam ( 'id' );
		if (! $request->isPost ()) {
			
			// Failed validation; redisplay form
			$admin = $this->_getModel ()->getAdminById ( $id );
			$this->view->admin = $admin;
			$this->view->form = $form;
			$this->view->editAdmin = true;
			
			return;
		}
		$admin = $this->getRequest ()->getPost ();
		$this->_updateAdmin ( $admin, $id );
		return $this->_forward ( 'index', 'index', null );
	
	}
	
	public function managemultipleAction() {
		$request = $this->getRequest ();
		$admins = $request->getPost ();
		$this->deleteAdmins ( $admins );
		return $this->_forward ( 'index', 'index', null );
	}
	
	public function filterbyAction() {
		
		$request = $this->getRequest ();
		$filter = $request->getParam ( 'filter' );
		$dir = $request->getParam ( 'dir' );
		$this->view->content = $this->adminMod->getAdminsBy ( $filter, $dir );
	
	}
	
	private function deleteAdmins($admins) {
		
		$this->adminMod->deleteAdmins ( $admins );
	
	}
	
	public function createAction() {
		require_once APPLICATION_PATH . '/modules/admin/forms/Admin.php';
		$form = new Admin_Forms_Admin ();
		$request = $this->getRequest ();
		if (! $request->isPost ()) {
			
			$this->view->form = $form;
			$this->view->newAdmin = true;
			
			return;
		}
		
		$admin = $this->getRequest ()->getPost ();
		$this->_insertUser ( $admin );
		
		return $this->_forward ( 'index', 'index', null );
	
	}
	
	public function registeruserAction(){
		$user = $this->getRequest()->getParams();
		
		$this->_registerUser($user);
		
	}
	
	

	protected function _updateAdmin(array $admin, $id) {
		$this->_getModel ()->updateAdmin ( $admin, $id );
	}
	
	protected function _insertUser(array $user) {
		$this->_getModel ()->insertAdmin ( $user );
	}
	
	protected function _registerUser(array $user) {
		$this->_getModel ()->insertUser ( $user );
	}
	
	protected function _getModel() {
		if (null === $this->adminMod) {
			$this->adminMod = new Admin_Model_DbTable_Admins ();
		}
		return $this->adminMod;
	}

}

