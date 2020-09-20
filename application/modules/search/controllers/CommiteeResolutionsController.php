<?php

class Search_CommiteeResolutionsController extends JBlac_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
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
            $this->view->paginator = Applications_Model_BsspApplicationMapper::searchApplications($options);
            
        }else{
            
            $applMapper = new Applications_Model_BsspApplicationMapper('Applications_Model_DbTable_BsspApplication');

            $this->view->paginator = $applMapper->fetchPage($page);
            
        }
        
        $this->view->form = $searchForm;
    }
}



