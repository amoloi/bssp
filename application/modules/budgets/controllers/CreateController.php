<?php

class Budgets_CreateController extends JBlac_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
    }

    public function indexAction()
    {
        //exit('creating');
        $this->view->title = 'New payment';
        $form = new JBlac_Forms_Bssp_Budget();
        $form->removeElement('id');
        $this->view->form = $form;
        $objEntity = new Budgets_Model_MasterBudget();

        if($this->getRequest()->isPost()){
            $formData = $this->getRequest()->getPost();
            if($form->isValid($formData)){
                $objEntityMapper = new Budgets_Model_MasterBudgetMapper('Budgets_Model_DbTable_MasterBudget');
                $objEntity->setCode($formData['code'])
                          ->setName($formData['name'])
                          ->setPeriod($formData['period'])
                          ->setAmount($formData['amount'])
                          ->setDescription($formData['description'])
//                          ->setGLAccount($formData['GLAccount'])               
                          ->setCreatedBy('SYSTEM');
                
                try{
                    
                    $entityId = $objEntityMapper->save($objEntity);
                    $this->_flashMessenger->addMessage(array('message' => 'A Master Budget has been created.', 'status' => 'success'));                         
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
                $this->_redirect('/budgets/');
            }else{
                echo 'errors';
                Zend_Debug::dump($form->getCustomMessages());
                $this->view->form = $form;
                return;
            }
        }else{
                      
        } 
    }
    
    public function deleteAction(){
        $this->view->title = 'New application';
        $id = $this->_request->getParam('id', 0);
        $objMapper = new Budgets_Model_BudgetMapper('Budgets_Model_DbTable_Budget');
        $applicationData = $objMapper->delete($id);
        $this->_flashMessenger->addMessage(array('message' => 'A Budget has been deleted.', 'status' => 'success'));   
        $this->_redirect('/budgets/');
    }
}



