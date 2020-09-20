<?php

class Applications_CreateController extends JBlac_Controller_Action
{

    public function indexAction()
    {
        //
        //exit('creating');
        $this->view->title = 'New application';
        $form = new JBlac_Forms_Bssp_Application();
        $form->removeElement('id');
        $this->view->form = $form;
        $application = new Applications_Model_Application();
        
        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $aplicationMapper = new Applications_Model_ApplicationMapper('Applications_Model_DbTable_Application');
                $application->setPromoter($this->getRequest()->getPost('promoter'))
                        ->setBusinessName($this->getRequest()->getPost('businessName'))
                        ->setBusinessSector($this->getRequest()->getPost('businessSector'))
                        ->setBusinessActivity($this->getRequest()->getPost('businessActivity'))
                        ->setRequestType($this->getRequest()->getPost('requestType'))
                        ->setTelephoneNumber($this->getRequest()->getPost('telephoneNumber'))
                        ->setMobileNumber($this->getRequest()->getPost('mobileNumber'))
                        ->setFaxNumber($this->getRequest()->getPost('faxNumber'))
                        ->setEmailAddress($this->getRequest()->getPost('emailAddress'))
                        ->setPostalAddress($this->getRequest()->getPost('postalAddress'))
                        ->setResidentialAddress($this->getRequest()->getPost('residentialAddress'))
                        ->setRegion($this->getRequest()->getPost('region'))
                        ->setTown($this->getRequest()->getPost('town'))
                        ->setApplicationDate($this->getRequest()->getPost('applicationDate'))
                        ->setAcknowledgementDate($this->getRequest()->getPost('acknowledgementDate'))                        
                        ->setCreatedBy('SYSTEM');                
                try{
                    $aplicationMapper->save($application);
                        // Tell the user that we succeeded.
                        $this->_flashMessenger->addMessage(array('message' => 'Application has been created.', 'status' => 'success'));
                } catch (Exception $ex) {
                    $this->_flashMessenger->addMessage(array('message' => 'Application could not be created.', 'status' => 'error'));
                    echo $ex->getMessage();
                    exit;
                }
                
                $this->_redirect('/applications/');
            }else{
                $this->view->form = $form;
                return;
            }
        }else{            
         //$this->view->form = $form;   
        }  
    }
    
    public function deleteAction(){
        $this->view->title = 'New application';
        $id = $this->_request->getParam('id', 0);
        $application = new Applications_Model_Application();
        $aplicationMapper = new Applications_Model_ApplicationMapper('Applications_Model_DbTable_Application');
        $applicationData = $aplicationMapper->delete($id);
        $this->_flashMessenger->addMessage(array('message' => 'Application has been deleted.', 'status' => 'success'));
        $this->_redirect('/applications/');
    }
}



