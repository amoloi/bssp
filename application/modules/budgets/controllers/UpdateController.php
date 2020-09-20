<?php

class Budgets_UpdateController extends JBlac_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
    }

    public function indexAction()
    {
        //exit('creating');
        $this->view->title = 'New application';
        $id = $this->_request->getParam('id', false);
        if($id === false){
            $this->_helper->redirector->gotoSimple('parameters-missing' , 'error' , 'default');
        }          
        $form = new JBlac_Forms_Bssp_Budget();

        $obj = new Budgets_Model_MasterBudget();
        $objMapper = new Budgets_Model_MasterBudgetMapper('Budgets_Model_DbTable_MasterBudget');
        $objData = $objMapper->fetchOne($id, $obj);

        if($this->getRequest()->isPost()){
            $formData = $this->getRequest()->getPost();
            
            if(null !== $this->getRequest()->getPost('id')){
                $name = $form->getElement('name');
                $name->addValidator('Db_NoRecordExists',
                                 false,
                                 array('table'    => 'bssp_master_budgets',
                                         'field'     => 'name',
                                         'exclude' => array ('field' => 'id',
                                                                    'value' => $formData['id'])));
                
                $period = $form->getElement('period');
                $period->addValidator('Db_NoRecordExists',
                                 false,
                                 array('table'    => 'bssp_master_budgets',
                                         'field'     => 'period',
                                         'exclude' => array ('field' => 'id',
                                                                    'value' => $this->getRequest()->getPost('id'))));
                
                $code = $form->getElement('code');
                $code->addValidator('Db_NoRecordExists',
                                 false,
                                 array('table'    => 'bssp_master_budgets',
                                         'field'     => 'code',
                                         'exclude' => array ('field' => 'id',
                                                                    'value' => $this->getRequest()->getPost('id'))));
                
            }
            if($form->isValid($this->getRequest()->getPost())){
                $obj->setCode($formData['code'])
                          ->setName($formData['name'])
                          ->setPeriod($formData['period'])
                          ->setAmount($formData['amount'])
                          ->setDescription($formData['description'])
                          ->setId($formData['id'])
                          ->setCreatedBy('SYSTEM');               
                try{                    
                    $entityId = $objMapper->save($obj);
                    $this->_flashMessenger->addMessage(array('message' => 'Budget record has been updated.', 'status' => 'success'));   
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
                $this->_redirect('/budgets/');
            }else{
                $form->populate($this->getRequest()->getPost());
                Zend_Debug::dump($form->getCustomMessages());
                $this->view->form = $form;
                return;
            }
        }else{
            $form->populate($objData);
            $this->view->form = $form;                      
        }
    } 
}