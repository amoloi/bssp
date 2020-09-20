<?php

class Consultants_CreateController extends JBlac_Controller_Action
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
        $form = new JBlac_Forms_Bssp_LegalEntity();
        $form->getElement('entityCategory')->setValue('consultant');
        $form->getElement('entityType')->setLabel('Consultant Type');
//        $form->getElement('entity')->setLabel('Consultant Type');
        $form->removeElement('id');
        $form->removeElement('businessActivity');
        $this->view->form = $form;
        $objEntity = new JBlac_Models_LegalEntity();

        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $objEntityMapper = new JBlac_Models_LegalEntityMapper('JBlac_Models_DbTable_LegalEntity');
                $objEntity->setEmailAddress($this->getRequest()->getPost('emailAddress'))
                          ->setTelephoneNumber($this->getRequest()->getPost('telephoneNumber'))
                          ->setMobileNumber($this->getRequest()->getPost('mobileNumber'))
                          ->setFaxNumber($this->getRequest()->getPost('faxNumber'))
                          ->setEntityType($this->getRequest()->getPost('entityType'))
                          ->setEntityCategory($this->getRequest()->getPost('entityCategory'))
                          ->setRemarks($this->getRequest()->getPost('remarks'))                
                          ->setCreatedBy('SYSTEM');
                
                  switch ($this->getRequest()->getPost('entityType')) {
                      case 'person':
                          $objEntity->setFirstName($this->getRequest()->getPost('firstName'))
                                    ->setMiddleName($this->getRequest()->getPost('middleName'))
                                    ->setLastName($this->getRequest()->getPost('lastName'))
                                    ->setIdentityNumber($this->getRequest()->getPost('identityNumber'))
                                    ->setDateOfBirth(JBlac_Utilities_Date::getMySQLDefault($this->getRequest()->getPost('dateOfBirth')))
                                    ->setPassportNumber($this->getRequest()->getPost('passportNumber'));
                          break;
                      case 'company':
                          $objEntity->setCompanyName($this->getRequest()->getPost('companyName'))
                                    ->setCompanyRegistrationNumber($this->getRequest()->getPost('companyRegistrationNumber'));
                          break;
                      default:
                          $objEntity->setFirstName($this->getRequest()->getPost('firstName'))
                                    ->setMiddleName($this->getRequest()->getPost('middleName'))
                                    ->setLastName($this->getRequest()->getPost('lastName'))
                                    ->setIdentityNumber($this->getRequest()->getPost('identityNumber'))
                                    ->setPassportNumber($this->getRequest()->getPost('passportNumber'))
                                    ->setCompanyName($this->getRequest()->getPost('companyName'))
                                    ->setCompanyRegistrationNumber($this->getRequest()->getPost('companyRegistrationNumber'));                              
                          break;
                  }
                
                try{
                    $entityId = $objEntityMapper->save($objEntity);
                    
                    $addressObj = new JBlac_Models_Address();
                    $addressObjMapper = new JBlac_Models_AddressMapper('JBlac_Models_DbTable_Address');
                    
                    $addressObj->setAddressLineOne($this->getRequest()->getPost('addressLineOne'))
                              ->setPostalAddress($this->getRequest()->getPost('postalAddress'))
                              ->setRegionCode($this->getRequest()->getPost('regionCode'))
                              ->setCityCode($this->getRequest()->getPost('cityCode'))
                              ->setCountryCode($this->getRequest()->getPost('countryCode'))
                              ->setLegalEntityId($entityId);                    
                    $addressId = $addressObjMapper->save($addressObj);
                 $this->_flashMessenger->addMessage(array('message' => 'Consultant has been created.', 'status' => 'success'));   
                } catch (Exception $ex) {
                    $this->_flashMessenger->addMessage(array('message' => 'Consultant could not be created.', 'status' => 'error'));
                    echo $ex->getMessage();
                }
                $this->_redirect('/consultants/');
            }else{
                $this->_flashMessenger->addMessage(array('message' => 'Consultant could not be created.', 'status' => 'error'));
                Zend_Debug::dump($form->getMessages());
                Zend_Debug::dump($form->getErrorMessages());
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
        $objMapper = new JBlac_Models_LegalEntityMapper('JBlac_Models_DbTable_LegalEntity');
        $applicationData = $objMapper->delete($id);
        $this->_flashMessenger->addMessage(array('message' => 'Consultant has been deleted.', 'status' => 'success')); 
        $this->_redirect('/consultants/');
    }
}



