<?php
class Zwas_Controller_NodeAuthenitcated extends Zwas_Controller_Authenitcated {
	
	public function init() {
		if (! ApplicationModel::isNode()) {
			$this->redirect(array('controller' => 'Index', 'action' => 'Index'));
		}
		parent::init();
	}
}
