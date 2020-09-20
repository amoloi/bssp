<?php

class Search_ConsultantsController extends JBlac_Controller_Action
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
        
        $searchForm = new JBlac_Forms_Bssp_SearchConsultants();
        
        
        if($this->getRequest()->isPost()){
            $PostData = $this->getRequest()->getPost();
            
                $options['legalEntityName']   =   $PostData['legalEntityName'];
                $options['entityCategory']       =   $PostData['entityCategory'];
          
                $searchForm->populate($PostData);
                $this->view->paginator = JBlac_Models_LegalEntityMapper::searchLegalEntitiesByCategory($options , $PostData['entityCategory'] );
            
        }else{
            
            $objMapper = new JBlac_Models_LegalEntityMapper('JBlac_Models_DbTable_LegalEntity');
            $this->view->paginator = $objMapper->fetchEntityPage('consultant',$page);
            
        }
        
        $this->view->form = $searchForm;
    }
}



