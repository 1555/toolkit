<?php

//require_once APPLICATION_PATH . '/modules/stocks/models/DbTable/Stocks.php';

class Stocks_IndexController extends Zend_Controller_Action
{

	 protected $stocksMod;
	
    public function init()
    {
        /* Initialize action controller here */
    	$this->stocksMod = new Stocks_Model_DbTable_Stocks();
    }
	
	

    public function indexAction()
    {
		
		$this->view->content= $this->stocksMod->getAllStocks();
		
   //  $this->_helper->layout->disableLayouts(); 
 /*   
 
 $this->view->buckets = $buckets;
 
    var_dump($s3->getBuckets());


*/

	}
	
	public function submitallAction(){
		require_once('Zend/Service/Amazon/S3.php');
		$awsKey       = 'AKIAIH634X63GTXMEOBQ';
   		$awsSecretKey = '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';
 
   		$s3 = new Zend_Service_Amazon_S3($awsKey, $awsSecretKey);// next version will go to a database tbale and get a list of all the indexs
		
		 $perms      = array(
        Zend_Service_Amazon_S3::S3_ACL_HEADER =>
            Zend_Service_Amazon_S3::S3_ACL_PUBLIC_READ
   			 );
 
 		$bucketname = 'cnbc.emea.indexs';
		
	//	$this->submitAction('FTSE',$bucketname, $perms, $s3);
	//	$this->submitAction('CAC',$bucketname, $perms, $s3);
	//	$this->submitAction('DAX',$bucketname, $perms, $s3);
		$this->submitAction('commodities',$bucketname, $perms, $s3);
	//	$this->submitAction('Currencys',$bucketname, $perms, $s3);
		
		return $this->_forward('index', 'index', null, array('title' => $id));
	}

public function submitAction($index, $bucketname, $perms, $s3){
	//$this->_helper->layout->disableLayouts(); 
	//var_dump($index);
	//var_dump($bucketname);
	//var_dump($perms);
	//var_dump($s3);
	
	$this->view->content= $this->stocksMod->getAllStocksByIndex($index);
	$this->view->index = $index;
	$xml = $this->view->Indexxml();
	
	//var_dump($xml);
	
	
 
    
 
 //$buckets = $s3->getBuckets();
 


   $ret = $s3->putObject(
        $bucketname . '/'.$index.'.xml',
        $xml,
        $perms
    );
	
	
}

        
    
	
	public function versionAction(){
		$this->_helper->layout->disableLayouts(); 
		echo "wingnuts";
	}
    
    public function listAction()
    {
    	// go and get all the polls and list
    	//$this->
    	
    	
    }
    
public function editAction()
    {
    	// go and get all the polls and list
    	// action body
		
            $request      = $this->getRequest();
        	$id = $request->getParam('id');
        	var_dump($request->isPost());
        	require_once APPLICATION_PATH . '/modules/stocks/forms/StockEdit.php';
                $form    = new Stocks_Forms_StockEdit();
                if (!$request->isPost() ) { //|| !$form->isValid($request->getPost()
                    // Failed validation; redisplay form
                   $this->view->form = $form;
                   $this->view->editStock = true;
                   // $this->view->pageTitle = $title;
        		 // var_dump($id);
        		 
         			$poll = $this->_getModel()->getStockById($id);
        			
        			//var_dump($screen );
                   // if (!$venue) {
                        // Attempted to submit an edit form for a new article
                       // throw new MyWiki_Exception('Cannot edit entries that do not exist');
                //    }
                   $this->view->stock = $stock;
                  $this->render('view');
                  return;
             }
             //var_dump($request->isPost()); 
             $poll = $form->getValues();
              $this->_updateStock($stock, $id);
            return $this->_forward('index', 'index', null, array('title' => $id));
    	
    	
    	
    }
    
public function createAction()
    {
    	// go and get all the polls and list
    	// action body
		
            $request      = $this->getRequest();
        	
       // require_once APPLICATION_PATH . '/modules/alerts/forms/Alert.php';
        	require_once APPLICATION_PATH . '/modules/stocks/forms/Stocks.php';
                $form = new Stocks_Forms_Stocks();
                if (!$request->isPost() ) { //|| !$form->isValid($request->getPost()
                    // Failed validation; redisplay form
                   $this->view->form = $form;
                 $this->view->newStock = true;
                 
                
                   $this->render('view');
                  return;
             }
             //var_dump($request->isPost()); 
           $stock = $request->getPost();
            $this->_addStock($stock);
            return $this->_forward('index', 'index', null, array('title' => $id));
    	
    	
    	
    }
    
   protected function _addStock(array $stocks)
    {
      //   var_dump($stocks);
        	//   var_dump($id." is the id");
        	  $this->_getModel()->insertStocks($stocks);
    }
    
	protected function _updateStock(array $stock, $id)
    {
        //  var_dump($user." is the venue");
        	//   var_dump($id." is the id");
        	  $this->_getModel()->updateStock($stock, $id);
    }
    
    protected function _getModel()
    {
        if (null === $this->stocksMod) {
                    $this->stocksMod = new Stocks_Model_DbTable_Stocks();
                }
                return $this->stocksMod;
    }
    


}

