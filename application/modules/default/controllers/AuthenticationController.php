<?php

class AuthenticationController extends Zend_Controller_Action
{

	protected $authMod;

    public function init()
    {
        /* Initialize action controller here */
		$this->authMod = new Default_Model_DbTable_Admin();
    }

    public function indexAction()
    {
        // action body
     
    }
    
    public function createAction()
    {
        // action body
    }

    public function loginAction()
    {
    	// $this->_redirect('index/index');
    	$this->view->title = 'Login';
        if(Zend_Auth::getInstance()->hasIdentity()){
            $this->_redirect('index/index');
        }
        
        $request = $this->getRequest();
        $form = new Form_LoginForm();
        if($request->isPost()){
            if($form->isValid($this->_request->getPost())){
              $authAdapter = $this->getAuthAdapter();
        
                $username = $form->getValue('username');
                $password = $form->getValue('password');
                
                $authAdapter->setIdentity($username)->setCredential($password);
                            
                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);
                
                if($result->isValid()){
                    $identity = $authAdapter->getResultRowObject();
                    $authStorage = $auth->getStorage();
                    $authStorage->write($identity);
                    
                    $this->_redirect('index/index');
                } else {
                    $this->view->errorMessage = "User name or password is wrong.";
                }
            }
        }
        
     //  echo "dump form";
       $this->view->form = $form;
        
        
    }
    
    public function readvisepasswordAction(){
    	 $form = new Form_PasswordForm();
    	 $this->view->form = $form;
    	
    }
    
	public function readviseusernameAction(){
		$form = new Form_UsernameForm();
		$this->view->form = $form;
    	
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('index/index');
    }
	
	public function newuserAction(){
		$form = new Form_NewuserForm();
		$this->view->form = $form;
		 $request = $this->getRequest();	
		 if($request->isPost()){
            if($form->isValid($this->_request->getPost())){
				 $user = $this->getRequest()->getPost();
				 echo "your request has been sent to admin services";
			 $to = "edward.hunton@cnbc.com";
			 $subject = "Membership request";
			 $from = "admin@toolkit.cnbceuropeshared.com";
			 //$headers = "From: edward.hunton@cnbc.com\r\n";
			// $headers .= "MIME-Version: 1.0\r\n";
			// $header .= "Content-Type: text/html;\n";   
			$headers = "From: " . $from .  "\r\n"; 
			$headers .= "Reply-To: " . $from .  "\r\n"; 
			$headers .= "Return-Path: " . $from .  "\r\n";
			
			$body = "New user request \r\n";

 			$body .= "Username: ".$user['username'] ."\r\n";
			$body .= "Password: ".$user['password'] ."\r\n";
			$body .= "Email: ".$user['email'] ."\r\n";
			$body .= "Department: ".$user['department'] ."\r\n";
			$body .= "Comments: ".$user['comments'] ."\r\n";
			
			
			
			
 				if (mail($to, $subject, $body,  $headers, "-f" . $from)) {
 			  echo("<p>Message successfully sent!</p>");
			    return $this->_forward('index', 'index', null);
 					 } else {
  			 echo("<p>Message delivery failed...</p>");
  				}
			} 
		 } 
	}
	
   
	
	public function fetchusernameAction()
    {
         $request = $this->getRequest();
		 $post = $request->getPost();
		 $pword = $post['password'];
		 $email = $post['email'];
		// var_dump($post);
		 // look in admin table with passowrd and return username
		 $uname = $this->getUserNameViaPassword($pword, $email);
		 	 if($uname){
			 // email etc
			 echo "your username has been sent to your email address";
			 $to = $email;
			 $subject = "Username reminder";
			 $from = "admin@toolkit.cnbceuropeshared.com";
			 //$headers = "From: edward.hunton@cnbc.com\r\n";
			// $headers .= "MIME-Version: 1.0\r\n";
			// $header .= "Content-Type: text/html;\n";   
			$headers = "From: " . $from .  "\r\n"; 
			$headers .= "Reply-To: " . $from .  "\r\n"; 
			$headers .= "Return-Path: " . $from .  "\r\n";
			

 			$body = "This is your username: ".$uname['username'] ."\r\n";
			
			
			
			
 				if (mail($to, $subject, $body,  $headers, "-f" . $from)) {
 			  echo("<p>Message successfully sent!</p>");
 					 } else {
  			 echo("<p>Message delivery failed...</p>");
  				}

		 } else {
			 echo "the username or email does not match those in the system<br>email a request to admin<br><a href='mailto:admin@toolkit.cnbceuropeshared.com?subject=username problem&body=The following user has had difficulty accessing or reseting their password: ".$pword. ". Please advise'>email</a>";
		 }
		 // send username to email if there is a match
    }
	
	public function fetchpasswordAction()
    {
         $request = $this->getRequest();
		 $post = $request->getPost();
		 $uname = $post['username'];
		 $email = $post['email'];
		
		 $pword = $this->getPassWordViaUsername($uname, $email);
		 
		 // var_dump($pword);
		  
		  
		 if($pword){
			 // email etc
			 echo "your password has been sent to your email address";
			 $to = $email;
			 $subject = "Password reminder";
			 $from = "admin@toolkit.cnbceuropeshared.com";
			 //$headers = "From: edward.hunton@cnbc.com\r\n";
			// $headers .= "MIME-Version: 1.0\r\n";
			// $header .= "Content-Type: text/html;\n";   
			$headers = "From: " . $from .  "\r\n"; 
			$headers .= "Reply-To: " . $from .  "\r\n"; 
			$headers .= "Return-Path: " . $from .  "\r\n";
			

 			$body = "This is your password: ".$pword['password'] ."\r\n";
			
			
			
			
 				if (mail($to, $subject, $body,  $headers, "-f" . $from)) {
 			  echo("<p>Message successfully sent!</p>");
 					 } else {
  			 echo("<p>Message delivery failed...</p>");
  				}

		 } else {
			 echo "the password or email does not match those in the system<br>email a request to admin<br><a href='mailto:admin@toolkit.cnbceuropeshared.com?subject=password problem&body=The following user has had difficulty accessing or reseting their password: ".$uname. ". Please advise'>email</a>";
		 }
		
    }
	
	private function getUserNameViaPassword($_password, $email){
		$uname = $this->authMod->getUsernameViaPassword($_password, $email);
		return $uname;
	}

	private function getPassWordViaUsername($_uname, $email){
		// var_dump($_uname);
		$pword = $this->authMod->getPasswordViaUsername($_uname, $email);
		return $pword;
	}

    private function getAuthAdapter() {
    	
    	//$db = Zend_Registry::get('config')->default->resources->db;
    	$db = cnbc_Db::getAdapter(Zend_Registry::get('config')->admin->resources->db);
        $authAdapter = new Zend_Auth_Adapter_DbTable($db); //Zend_Db_Table::getDefaultAdapter()
        $authAdapter->setTableName('admin_users')
                    ->setIdentityColumn('username')
                    ->setCredentialColumn('password');
                    
        return $authAdapter;
    }

}





