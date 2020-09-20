<?php

class Users_CreateController extends JBlac_Controller_Action
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
        $form = new JBlac_Forms_Bssp_User();
        $form->removeElement('id');
        $this->view->form = $form;
        $objEntity = new Users_Model_User();

        if($this->getRequest()->isPost()){
            $formData = $this->getRequest()->getPost();
            if($form->isValid($formData)){
                $objEntityMapper = new Users_Model_UserMapper('Users_Model_DbTable_User');
                $objEntity->setFirstname($formData['firstname'])
                          ->setLastname($formData['lastname'])
                          ->setEmailAddress($formData['email'])
                          ->setUsername($formData['username'])
                          ->setPassword($formData['password'])
                          ->setRoleId($formData['role'])
                          ->setCreatedBy('SYSTEM');
                
                try{
                    
                    $entityId = $objEntityMapper->save($objEntity);
                    $this->_flashMessenger->addMessage(array('message' => 'User`s record has been updated.', 'status' => 'success'));                         
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
                $this->_redirect('/users/');
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
        $objMapper = new Users_Model_UserMapper('Users_Model_DbTable_User');
        $applicationData = $objMapper->delete($id);
        $this->_flashMessenger->addMessage(array('message' => 'User`s record has been deleted.', 'status' => 'success'));   
        $this->_redirect('/users/');
    }
}



