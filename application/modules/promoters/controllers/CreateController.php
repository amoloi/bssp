<?php

class Promoters_CreateController extends JBlac_Controller_Action
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
        $applForm = new JBlac_Forms_Bssp_SubForms_Application();
        $form->addSubForm($applForm, 'application');
        $contactForm = new JBlac_Forms_Bssp_SubForms_Contact();
        $form->addSubForm($contactForm, 'contact');
        $requestForm = new JBlac_Forms_Bssp_SubForms_ApplicationRequest();
        $form->addSubForm($requestForm, 'requestForm');
        $form->getElement('entityCategory')->setValue('promoter');
        $form->getElement('entityType')->setLabel('Applicant Type');        
        $form->removeElement('id');
        $this->view->form = $form;
        $objEntity = new JBlac_Models_LegalEntity();

        if($this->getRequest()->isPost()){
            
            /**
             * Towns
             */
                        $options = JBlac_Utilities_AppReference::fetchTowns();
                        $form->getElement('cityCode')->setMultiOptions($options);
             /*
              * Constituences
              */       
                        $options = JBlac_Utilities_AppReference::fetchConstituences();
                        $form->getElement('constituencyCode')->setMultiOptions($options);
                        
            $PostData = $this->getRequest()->getPost();
            $this->view->data = $PostData;
            if($form->isValid($this->getRequest()->getPost())){

                $objEntityMapper = new JBlac_Models_LegalEntityMapper('JBlac_Models_DbTable_LegalEntity');
                $objEntity->setEmailAddress($PostData['emailAddress'])
                          ->setTelephoneNumber($PostData['telephoneNumber'])
                          ->setMobileNumber($PostData['mobileNumber'])
                          ->setFaxNumber($PostData['faxNumber'])
                          ->setEntityType($PostData['entityType'])
                          ->setEntityCategory($PostData['entityCategory'])               
                          ->setCreatedBy('SYSTEM');
                
                  switch ($PostData['entityType']) {
                      case 'person':
                          $objEntity->setFirstName($PostData['firstName'])
                                    ->setMiddleName($PostData['middleName'])
                                    ->setLastName($PostData['lastName'])
                                    ->setDateOfBirth(JBlac_Utilities_Date::getMySQLDefault($PostData['dateOfBirth']))
                                    ->setIdentityNumber($PostData['identityNumber'])
                                    ->setPassportNumber($PostData['passportNumber']);
                          break;
                      case 'company':
                          $objEntity->setCompanyName($PostData['companyName'])
                                    ->setCompanyRegistrationNumber($PostData['companyRegistrationNumber']);
                          break;
                      default:
                          $objEntity->setFirstName($PostData['firstName'])
                                    ->setMiddleName($PostData['middleName'])
                                    ->setLastName($PostData['lastName'])
                                    ->setDateOfBirth(JBlac_Utilities_Date::getMySQLDefault($PostData['dateOfBirth']))
                                    ->setIdentityNumber($PostData['identityNumber'])
                                    ->setPassportNumber($PostData['passportNumber'])
                                    ->setCompanyName($PostData['companyName'])
                                    ->setCompanyRegistrationNumber($PostData['companyRegistrationNumber']);                              
                          break;
                  }
                
                try{
                    
                    
                    $promoterId = $objEntityMapper->save($objEntity);

                    $addressObj = new JBlac_Models_Address();
                    $addressObjMapper = new JBlac_Models_AddressMapper('JBlac_Models_DbTable_Address');
                    
                    $addressObj->setAddressLineOne($PostData['addressLineOne'])
                              ->setPostalAddress($PostData['postalAddress'])
                              ->setRegionCode($PostData['regionCode'])
                              ->setCityCode($PostData['cityCode'])
                              ->setCountryCode($PostData['countryCode'])
                              ->setConstituencyCode($PostData['constituencyCode'])
                              ->setLegalEntityId($promoterId);                    
                    $addressId = $addressObjMapper->save($addressObj);
                    
                    $applObject = new Applications_Model_BsspApplication();
                    $applMapper = new Applications_Model_BsspApplicationMapper('Applications_Model_DbTable_BsspApplication');
                    
                    $applicationNumber = JBlac_Utilities_BSSP::getApplicationNumber();
                    $applObject->setApplicationLegalEntityId($promoterId)
                            ->setApplicationLegalEntityType($PostData['entityType'])
                            ->setApplicationNumber($applicationNumber)
                            ->setApplicationDate(JBlac_Utilities_Date::getMySQLDefault($PostData['applicationDate']))
                            ->setApplicationAcknowledgementDate(JBlac_Utilities_Date::getMySQLDefault($PostData['applicationAcknowledgementDate']));
                    
                    $applMapper->save($applObject);
                             
                    if('company' === $PostData['entityType']){
                        
                                $numOfContacts = count($PostData['contactFirstName']);
                                $contactMapper = new Contacts_Model_ContactMapper('Contacts_Model_DbTable_Contact');
                                
                                for($i = 0 ; $i < $numOfContacts ; $i++){
                                        $contact = new Contacts_Model_Contact();
                                        
                                        $contact->setContactFirstName($PostData['contactFirstName'][$i])
                                                ->setContactMiddleName($PostData['contactMiddleName'][$i])
                                                ->setContactLastName($PostData['contactLastName'][$i])
                                                ->setContactPosition($PostData['contactPosition'][$i])
                                                ->setContactTitle($PostData['contactTitle'][$i])
                                                ->setLegalEntityId($promoterId);                        
                                        try {
                                            $contactMapper->save($contact);
                                        } catch (Exception $ex) {
                                            Zend_Debug::dump($ex->getMessage());
                                        }                                    
                                }                         

                    }
                    
                    if(null !== $applObject->getApplicationNumber()){
                                
                                $appRequestMapper = new Applications_Model_BsspRequestMapper('Applications_Model_DbTable_BsspRequest');
                                
                                /**
                                 * Get number of request submitted for the application
                                 */
                                
                                $numberOfRequests = count($PostData['requestType']);
                                
                                for($i = 0 ; $i < $numberOfRequests ; $i++){
                                    $appRequest = new Applications_Model_BsspRequest();
                                    $requestNumber  = JBlac_Utilities_BSSP::getRequestNumber();
                                    $appRequest
                                            ->setRequestNumber($requestNumber)                                    
                                            ->setRequestType($PostData['requestType'][$i])
                                            ->setOtherRequestTypeText($PostData['otherRequestTypeText'][$i])
                                            ->setRequestSector($PostData['requestSector'][$i])
                                            ->setRequestPriotityArea($PostData['requestPriotityArea'][$i])
                                            ->setRequestBusinessActivity($PostData['requestBusinessActivity'][$i])
                                            ->setRequestStatus($PostData['requestStatus'][$i])
                                            ->setRequestRemarks('New Application')
                                            ->setApplicationNumber($applObject->getApplicationNumber());
                                    try {
                                        $appRequestMapper->save($appRequest);
                                        
                                    } catch (Exception $ex) {
                                        echo $ex->getMessage();
                                    }                                    
                                }                            
                        }

                    $this->_flashMessenger->addMessage(array('message' => 'BSSP Application has been created.', 'status' => 'success'));
                } catch (Exception $ex) {

                    echo $ex->getMessage();
                    $this->_flashMessenger->addMessage(array('message' => 'Promoter could not be created.', 'status' => 'error'));
                }
                $this->_redirect('/promoters/');
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
        $id = $this->_request->getParam('an', 0);
        $objMapper = new JBlac_Models_LegalEntityMapper('JBlac_Models_DbTable_LegalEntity');
        $applicationData = $objMapper->delete($id);
        $this->_flashMessenger->addMessage(array('message' => 'Promoter has been deleted.', 'status' => 'success'));
        $this->_redirect('/promoters/');
    }
    
    public function deleteRequestAction(){
        $this->setNoviewRender();
        $id = $this->_request->getParam('rn', 0);
        $objMapper = new Applications_Model_BsspRequestMapper('Applications_Model_DbTable_BsspRequest');
        $applicationData = $objMapper->delete($id);
        $this->_flashMessenger->addMessage(array('message' => 'Request has been deleted.', 'status' => 'success'));
        $this->_redirect('/promoters/');        
    }
}