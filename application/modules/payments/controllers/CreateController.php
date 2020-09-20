<?php

class Payments_CreateController extends JBlac_Controller_Action
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
        $form = new JBlac_Forms_Bssp_Payment();
        $form->removeElement('id');
        $this->view->form = $form;
        $objEntity = new Payments_Model_Payment();

        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $objEntityMapper = new Payments_Model_PaymentMapper('Payments_Model_DbTable_Payment');
                $objEntity->setAmount($this->getRequest()->getPost('amount'))
                          ->setPhase($this->getRequest()->getPost('phase'))
                          ->setDateOfPayment($this->getRequest()->getPost('dateOfPayment'))
                          ->setApplicationId($this->getRequest()->getPost('applicationId'))
                          ->setFundsId($this->getRequest()->getPost('fundsId'))
                          ->setRemarks($this->getRequest()->getPost('remarks'))               
                          ->setCreatedBy('SYSTEM');
                
                try{
                    
                    $entityId = $objEntityMapper->save($objEntity);
                      
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
                $this->_redirect('/funds/');
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
        $objMapper = new Promoters_Model_PromoterMapper('Promoters_Model_DbTable_Promoter');
        $applicationData = $objMapper->delete($id);
        $this->_redirect('/promoters/');
    }
}