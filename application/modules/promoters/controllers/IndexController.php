<?php

class Promoters_IndexController extends JBlac_Controller_Action
{

    public function init()
    {
        parent::init();
    }


    public function indexAction()
    {
        
        $this->view->title = 'Applications List';
        $page = $this->_getParam('page', 1);

        
        /**
         * Search form
         */
        
        $searchForm = new JBlac_Forms_Bssp_SearchApplication();
        
        
        if($this->getRequest()->isPost()){
            $PostData = $this->getRequest()->getPost();
            
                $options['applicationNumber']   =   $PostData['applicationNumber'];
                $options['applicantName']       =   $PostData['applicantName'];
                $options['applicationDate']     =   $PostData['applicationDate'];
          
            $searchForm->populate($PostData);
//            Zend_Debug::dump(Applications_Model_BsspApplicationMapper::searchApplications($options)); 
            $this->view->paginator = Applications_Model_BsspApplicationMapper::searchApplications($options);
            
        }else{
            
            $applMapper = new Applications_Model_BsspApplicationMapper('Applications_Model_DbTable_BsspApplication');
    //        Zend_Debug::dump($applMapper->fetchPage($page));
            $this->view->paginator = $applMapper->fetchPage($page);
            
        }
        
        $this->view->form = $searchForm;
    }
}



