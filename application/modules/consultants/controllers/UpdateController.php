<?php

class Consultants_UpdateController extends JBlac_Controller_Action
{

    public function indexAction()
    {
        $id = $this->_request->getParam('id', false);
        if($id === false){
            $this->_helper->redirector->gotoSimple('parameters-missing' , 'error' , 'default');
        }        
        $form = new JBlac_Forms_Bssp_LegalEntity();
        $form->setAction('/consultants/update/update');
        
        $promoter = new JBlac_Models_LegalEntity();
        $address = new JBlac_Models_Address();
        
        $promoterMapper = new JBlac_Models_LegalEntityMapper('JBlac_Models_DbTable_LegalEntity');
        
        $promoterData = $promoterMapper->fetchDataSet($id, $promoter , $address);
        
        if($this->getRequest()->isPost()){

        }else{
        $form->populate($promoterData);
        $this->view->form = $form;                      
        }
    }
    public function updateAction()
    {
        $id = $this->_request->getParam('id', 0);
        $form = new JBlac_Forms_Bssp_LegalEntity();
        $form->removeElement('businessActivity');
        $form->setAction('/consultants/update/update');
        
        $promoter = new JBlac_Models_LegalEntity();
        $address = new JBlac_Models_Address();
        
        $promoterMapper = new JBlac_Models_LegalEntityMapper('JBlac_Models_DbTable_LegalEntity');
        
        $promoterData = $promoterMapper->fetchDataSet($id, $promoter , $address);

        
        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $promoter->setEmailAddress($this->getRequest()->getPost('emailAddress'))
                          ->setTelephoneNumber($this->getRequest()->getPost('telephoneNumber'))
                          ->setMobileNumber($this->getRequest()->getPost('mobileNumber'))
                          ->setFaxNumber($this->getRequest()->getPost('faxNumber'))
                          ->setEntityType($this->getRequest()->getPost('entityType'))
                          ->setEntityCategory($this->getRequest()->getPost('entityCategory'))
                          ->setRemarks($this->getRequest()->getPost('remarks'))
                          ->setId($this->getRequest()->getPost('legalEntityId'))
                          ->setCreatedBy('SYSTEM');
                
                  switch ($this->getRequest()->getPost('entityType')) {
                      case 'person':
                          $promoter->setFirstName($this->getRequest()->getPost('firstName'))
                                    ->setMiddleName($this->getRequest()->getPost('middleName'))
                                    ->setLastName($this->getRequest()->getPost('lastName'))
                                    ->setIdentityNumber($this->getRequest()->getPost('identityNumber'))
                                    ->setPassportNumber($this->getRequest()->getPost('passportNumber'));
                          break;
                      case 'company':
                          $promoter->setCompanyName($this->getRequest()->getPost('companyName'))
                                    ->setCompanyRegistrationNumber($this->getRequest()->getPost('companyRegistrationNumber'));
                          break;
                      default:
                          $promoter->setFirstName($this->getRequest()->getPost('firstName'))
                                    ->setMiddleName($this->getRequest()->getPost('middleName'))
                                    ->setLastName($this->getRequest()->getPost('lastName'))
                                    ->setIdentityNumber($this->getRequest()->getPost('identityNumber'))
                                    ->setPassportNumber($this->getRequest()->getPost('passportNumber'))
                                    ->setCompanyName($this->getRequest()->getPost('companyName'))
                                    ->setCompanyRegistrationNumber($this->getRequest()->getPost('companyRegistrationNumber'));                              
                          break;
                  }
                
                try{
                    $promoterId = $promoterMapper->save($promoter);

                    $addressObjMapper = new JBlac_Models_AddressMapper('JBlac_Models_DbTable_Address');
                    
                    $address->setAddressLineOne($this->getRequest()->getPost('addressLineOne'))
                              ->setAddressLineTwo($this->getRequest()->getPost('addressLineTwo'))
                              ->setPostalAddress($this->getRequest()->getPost('postalAddress'))
                              ->setRegionCode($this->getRequest()->getPost('regionCode'))
                              ->setCityCode($this->getRequest()->getPost('cityCode'))
                              ->setCountryCode($this->getRequest()->getPost('countryCode'))
                              ->setLegalEntityId($promoter->getId());                    
                    $addressId = $addressObjMapper->save($address);
                
                    $this->_flashMessenger->addMessage(array('message' => 'Consultant has been updated.', 'status' => 'success'));
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    $this->_flashMessenger->addMessage(array('message' => 'Consultant could not be updated.', 'status' => 'error'));
                }
                $this->_redirect('/consultants/');
            }else{
                echo 'errors';
                $this->view->form = $form;
                return;
            }
        }else{
        $form->populate($promoterData);
        $this->view->form = $form;                      
        }
    }    
}



