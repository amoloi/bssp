<?php

class Commiteeresolutions_DetailsController extends JBlac_Controller_Action
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        
        $this->view->title = '';
        $requestNumber = $this->_request->getParam('rn', false);
        if($requestNumber === false){
            $this->_helper->redirector->gotoSimple('parameters-missing' , 'error' , 'default');
        }        
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