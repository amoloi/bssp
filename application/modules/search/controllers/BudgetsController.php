<?php

class Search_BudgetsController extends JBlac_Controller_Action
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
        
        $searchForm = new JBlac_Forms_Bssp_SearchBudget();
        
        if($this->getRequest()->isPost()){
            $PostData = $this->getRequest()->getPost();
            
                $options['budgetName']          =      $PostData['budgetName'];
                $options['budgetCode']          =      $PostData['budgetCode'];
                $options['budgetPeriod']        =      $PostData['budgetPeriod'];
          
            $searchForm->populate($PostData);
            $this->view->paginator = Budgets_Model_MasterBudgetMapper::searchFinancialBudgets($options);
            
        }else{
            
        $objMapper = new Budgets_Model_MasterBudgetMapper('Budgets_Model_DbTable_MasterBudget');
        
        $this->view->paginator = $objMapper->fetchPage($page);
            
        }
        
        $this->view->form = $searchForm;   
    }
}



