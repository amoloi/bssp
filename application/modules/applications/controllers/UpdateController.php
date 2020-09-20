<?php

class Applications_UpdateController extends JBlac_Controller_Action
{

    public function indexAction()
    {
        //
        //exit('creating');
        $this->view->title = 'New application';
        $id = $this->_request->getParam('id', false);
        if($id === false){
            $this->_helper->redirector->gotoSimple('parameters-missing' , 'error' , 'default');
        }          
        $form = new JBlac_Forms_Bssp_Application();
        
        $application = new Applications_Model_Application();
        $aplicationMapper = new Applications_Model_ApplicationMapper('Applications_Model_DbTable_Application');
        $applicationData = $aplicationMapper->find($id, $application);
        $form->populate($applicationData);
        $this->view->form = $form;

        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $aplicationMapper = new Applications_Model_ApplicationMapper('Applications_Model_DbTable_Application');
                $application->setId($this->getRequest()->getPost('id'))
                        ->setPromoter($this->getRequest()->getPost('promoter'))
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
                    $this->_flashMessenger->addMessage(array('message' => 'Application has been updated.', 'status' => 'success'));
                } catch (Exception $ex) {
                    $this->_flashMessenger->addMessage(array('message' => 'Application could not be updated.', 'status' => 'error'));
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
}



