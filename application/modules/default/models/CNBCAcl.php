<?php
class Model_CNBCAcl extends Zend_Acl {
	
	public function __construct() {
        $this->addRole(new Zend_Acl_Role('guests'));
		
		$this->addRole(new Zend_Acl_Role('users'), 'guests');
		$this->addRole(new Zend_Acl_Role('stockedit'), 'users');
		$this->addRole(new Zend_Acl_Role('alert'), 'users');
		$this->addRole(new Zend_Acl_Role('marketing'), 'users');
        $this->addRole(new Zend_Acl_Role('admins'), 'users');
		 $this->addRole(new Zend_Acl_Role('editors'), 'users');
		 
		 

		$this->add(new Zend_Acl_Resource('stocks'))
			 ->add(new Zend_Acl_Resource('stocks:index'), 'stocks');
			 
		$this->add(new Zend_Acl_Resource('campaigns'))
			 ->add(new Zend_Acl_Resource('campaigns:index'), 'campaigns')
			 ->add(new Zend_Acl_Resource('campaigns:image'), 'campaigns')
			 ->add(new Zend_Acl_Resource('campaigns:companies'), 'campaigns');
			 
	$this->add(new Zend_Acl_Resource('edit'))
		 ->add(new Zend_Acl_Resource('edit:index'), 'edit');
		
	$this->add(new Zend_Acl_Resource('alerts'))
			 ->add(new Zend_Acl_Resource('alerts:index'), 'alerts')
			 ->add(new Zend_Acl_Resource('alerts:create'), 'alerts')
			 ->add(new Zend_Acl_Resource('alerts:managemultiple'), 'alerts')
			 ->add(new Zend_Acl_Resource('alerts:duplicate'), 'alerts')
			 ->add(new Zend_Acl_Resource('alerts:getapromo'), 'alerts')
			  ->add(new Zend_Acl_Resource('alerts:getrss'), 'alerts')
			  ->add(new Zend_Acl_Resource('alerts:promos'), 'alerts');
			  
		  $this->add(new Zend_Acl_Resource('newsletters'))
			 ->add(new Zend_Acl_Resource('newsletters:index'), 'newsletters')
		 ->add(new Zend_Acl_Resource('newsletters:create'), 'newsletters')
			 ->add(new Zend_Acl_Resource('newsletters:edit'), 'newsletters')
			 ->add(new Zend_Acl_Resource('newsletters:submit'), 'newsletters')
			 ->add(new Zend_Acl_Resource('newsletters:managemultiple'), 'newsletters')
			  ->add(new Zend_Acl_Resource('newsletters:error'), 'newsletters')
			    ->add(new Zend_Acl_Resource('newsletters:preview'), 'newsletters');//;//
			//->add(new Zend_Acl_Resource('newsletters:submit'), 'newsletters');
			/*		 ->add(new Zend_Acl_Resource('newsletters:create'), 'newsletters')
			 ->add(new Zend_Acl_Resource('newsletters:managemultiple'), 'newsletters')
			 ->add(new Zend_Acl_Resource('newsletters:duplicate'), 'newsletters')
			 ->add(new Zend_Acl_Resource('newsletters:getapromo'), 'newsletters')
			  ->add(new Zend_Acl_Resource('newsletters:getrss'), 'newsletters')
			  ->add(new Zend_Acl_Resource('newsletters:promos'), 'newsletters'); */
			 
		$this->add(new Zend_Acl_Resource('admin'))
			 ->add(new Zend_Acl_Resource('admin:index'), 'admin')
			 ->add(new Zend_Acl_Resource('admin:edit'), 'admin')
			 ->add(new Zend_Acl_Resource('admin:create'), 'admin') 
			 ->add(new Zend_Acl_Resource('admin:managemultiple'), 'admin')
			 //->add(new Zend_Acl_Resource('admin:registeruser'), 'admin')
			 ->add(new Zend_Acl_Resource('admin:filterby'), 'admin') ;
			
			//$this ->add(new Zend_Acl_Resource('admin:registeruser'), 'guests');
			 
		$this->add(new Zend_Acl_Resource('signatures'))
			 ->add(new Zend_Acl_Resource('signatures:index'), 'signatures');
			
			
			 
		$this->add(new Zend_Acl_Resource('polls'))
			 ->add(new Zend_Acl_Resource('polls:index'), 'polls')
			 ->add(new Zend_Acl_Resource('polls:deletemultiple'), 'polls');
			 
		//$this->add(new Zend_Acl_Resource('admin'))
			//->add(new Zend_Acl_Resource('admin:book'), 'admin');
			// 
		$this->add(new Zend_Acl_Resource('default'))
			 ->add(new Zend_Acl_Resource('default:authentication'), 'default')
			 ->add(new Zend_Acl_Resource('default:index'), 'default')
			 ->add(new Zend_Acl_Resource('default:error'), 'default');
			 
		$this->allow('guests', 'default:authentication', array('login','readvisepassword','readviseusername','fetchusername','fetchpassword','newuser'));	 
		//$this->allow('guests', 'admin:registeruser', 'registeruser');	 
			 
		//$this->allow('admins', 'stocks', 'index');	
			$this->allow('admins', 'stocks:index', array('index','create','submitall','submit'));	
			//$this->allow('admins', 'stocks:version', 'stocks');
		//	$this->allow('admins', 'stocks:create', 'stocks');
		$this->allow('admins', 'campaigns:index', array('edit','index','preview','create','image','companies','updatemultipleimages','getimagesbycompany','createcompany','editcompany','uploadimages','imageedit','updatemultiplecompanies','managemultiple', 'filterby'));
		$this->allow('admins', 'alerts:index', array('edit','index','preview','managemultiple','getallpromos','createpromo'));	 
		$this->allow('admins', 'alerts:promos', array('promos','getallpromos'));
		$this->allow('admins', 'signatures:index', 'index');	 
		$this->allow('admins', 'alerts:index', array('index','create','edit','preview','managemultiple','getapromo','getrss','getapromohtml','duplicate','getcompanybycampaignid'));	 
		$this->allow('admins', 'edit:index', 'index');	 
	$this->allow('admins', 'newsletters:index', array('submit','test','index','edit','create','managemultiple','error','preview'));	
		$this->allow('admins', 'polls:index', array('index','create','edit','deletemultiple'));	
		
		$this->allow('admins', 'admin:index', array('index','edit','create','managemultiple','filterby', 'registeruser'));	 
		$this->allow('admins', 'campaigns:image', 'image');	 
		
		//$this->allow('admins', 'campaigns:index', 'createcompany');	 
		$this->allow('admins', 'campaigns:companies', 'companies');	 
		
		$this->allow('marketing', 'campaigns:index', array('edit','index','preview','create','image','companies','getrss','getapromohtml','createpromo','updatemultipleimages','createcompany','editcompany','uploadimages','imageedit','updateimage','updatemultiplecompanies','managemultiple','getimagesbycompany'));
		
$this->allow('editors', 'edit:index', 'index');	 
	$this->allow('editors', 'newsletters:index', array('submit','test','index','edit','create','managemultiple','error','preview'));	 
	
	$this->allow('marketing', 'edit:index', 'index');	 
	$this->allow('marketing', 'newsletters:index', 'submit');	 
		
		$this->allow('marketing', 'campaigns:index', 'companies');	 
		$this->allow('marketing', 'alerts:promos', 'promos');
		$this->allow('marketing', 'alerts:index', array('index','create','edit','preview','managemultiple','getapromo','getrss','getapromohtml','duplicate','getallpromos','createpromo','getcompanybycampaignid','previewpromo','editpromo','promosmanagemultiple'));	 
		
		$this->allow('marketing', 'campaigns:image', 'image');	
		
		$this->allow('admins', 'default:authentication', 'logout');
		$this->allow('admins', 'default:error', 'error');
		
		$this->deny('alert', 'stocks:index', 'stocks');	 
		$this->deny('marketing', 'admin:index', 'admin');	
		$this->deny('editors', 'alerts:index', 'alerts');	  
		
		$this->allow('alert', 'alerts:index', array('edit','index','preview','managemultiple','create','getallpromos'));
		
		$this->allow('stockedit', 'default:authentication', 'login');	
		$this->allow('stockedit', 'default:authentication', 'logout');
		$this->allow('stockedit', 'default:error', 'error');
		$this->allow('stockedit', 'stocks:index', array('index','create','submitall','submit','edit'));	
		
		
		$this->allow('users', 'default:index', 'index');
		//$this->allow('users', 'stocks:index', array('index','create','submitall'));	 
		$this->allow('users', 'default:authentication', 'logout');
		
		
		
    }
}
