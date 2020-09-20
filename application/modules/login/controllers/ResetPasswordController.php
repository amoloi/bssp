<?php
class Login_ResetPasswordController extends JBlac_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
    }

    public function indexAction()
    {
        
       $form = new Login_Form_ResetPassword();
       $objEntity = new Users_Model_User();

        if($this->_request->isPost()){
            
            $formData = $this->getRequest()->getPost();
            
            if($form->isValid($formData)){
                
               $objEntityMapper = new Users_Model_UserMapper('Users_Model_DbTable_User');
                
                $password = $this->getRequest()->getPost('password');
                $password = $this->getRequest()->getPost('password_confirm');
                
                
                $objEntity->setPassword($password)
                          ->setUsername(Zend_Registry::get('user'));                
                
                try{
                    
                    $entityId = $objEntityMapper->resetPassword($objEntity);
                    $this->_flashMessenger->addMessage(array('message' => 'Your password has been successfully updated. Login again to continue using the BSSP System', 'status' => 'success'));
                    
                    $auth = Zend_Auth::getInstance();
                    $auth->clearIdentity();
                    
                    $this->_redirect('/login');                    
                    
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }                

            }else{
                
                $this->view->form = $form;
                
                return false;
            }
        }else{
            $this->view->form = $form;
          
            }         
    }
    
    public function resetAction(){
       
    }
    public function completeAction()
    {}    
    
}