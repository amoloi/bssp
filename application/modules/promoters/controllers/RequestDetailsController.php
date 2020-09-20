<?php

class Promoters_RequestDetailsController extends JBlac_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
    }


    public function indexAction()
    {
        
        $this->view->title = '';
        $requestNumber = $this->_request->getParam('rn', 0);
        
        /*
         * Retreving Request Details
         */
        $request = new Applications_Model_BsspRequest();        
        $requestMapper = new Applications_Model_BsspRequestMapper('Applications_Model_DbTable_BsspRequest');
        
        $this->view->request = $requestMapper->searchRequestByRequestNumber($requestNumber);
//        Zend_Debug::dump($requestMapper->searchApplicationByRequestNumber($requestNumber));
        $this->view->application = $requestMapper->searchApplicationByRequestNumber($requestNumber);
//        Zend_Debug::dump($requestMapper->searchCommiteeResolutionByRequestNumber($requestNumber));
        $this->view->resolution = $requestMapper->searchCommiteeResolutionByRequestNumber($requestNumber);
//        Zend_Debug::dump($requestMapper->searchProjectByRequestNumber($requestNumber));
        $this->view->project = $requestMapper->searchProjectByRequestNumber($requestNumber);
        
    }
}



