<?php

class Users_UpdateController extends JBlac_Controller_Action
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
        $form = new JBlac_Forms_Bssp_User();

        $obj = new Users_Model_User();
        $objMapper = new Users_Model_UserMapper('Users_Model_DbTable_User');
        $objData = $objMapper->fetchOne($id, $obj);

        if($this->getRequest()->isPost()){
            $formData = $this->getRequest()->getPost();
            
            if(null !== $this->getRequest()->getPost('id')){
                $name = $form->getElement('username');
                $name->addValidator('Db_NoRecordExists',
                                 false,
                                 array('table'    => 'users',
                                         'field'     => 'username',
                                         'exclude' => array ('field' => 'id',
                                                                    'value' => $formData['id'])));
                
                $period = $form->getElement('email');
                $period->addValidator('Db_NoRecordExists',
                                 false,
                                 array('table'    => 'users',
                                         'field'     => 'email',
                                         'exclude' => array ('field' => 'id',
                                                                    'value' => $this->getRequest()->getPost('id'))));
                
            }
            if($form->isValid($this->getRequest()->getPost())){
                $obj->setFirstname($formData['firstname'])
                          ->setLastname($formData['lastname'])
                          ->setEmailAddress($formData['email'])
                          ->setUsername($formData['username'])
                          ->setPassword($formData['password'])
                          ->setRoleId($formData['role'])
                          ->setId($formData['id'])
                          ->setCreatedBy('SYSTEM');               
                try{                    
                    $entityId = $objMapper->save($obj);
                    $this->_flashMessenger->addMessage(array('message' => 'User`s record has been updated.', 'status' => 'success'));
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
                $this->_redirect('/users/');
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
    
    public function profileUpdateAction() {
        
    }
}