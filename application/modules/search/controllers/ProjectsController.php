<?php

class Search_ProjectsController extends JBlac_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
    }


    public function indexAction()
    {
        $this->view->title = '';
        $page = $this->_getParam('page', 1);
        $searchForm = new JBlac_Forms_Bssp_SearchProjects();
        
        if($this->getRequest()->isPost()){
            $PostData = $this->getRequest()->getPost();
            
                $options['projectNumber']   =   $PostData['projectNumber'];
                $options['projectName']       =   $PostData['projectName'];
           
            $searchForm->populate($PostData);
            $this->view->paginator = Projects_Model_ProjectMapper::searchProjects($options);
            
        }else{
            
            $mapper = new Projects_Model_ProjectMapper ('Projects_Model_DbTable_Project');
            $this->view->paginator = $mapper->fetchPage($page);
            
        }                
        $this->view->form = $searchForm;        
    }
}



