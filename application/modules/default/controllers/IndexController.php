<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->headTitle('index page', 'PREPEND');
        //cnbc_Log::info("in cont");
      
    }
    
public function createAction()
    {
        // action body
    }


}

