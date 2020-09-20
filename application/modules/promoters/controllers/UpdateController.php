<?php

class Promoters_UpdateController extends JBlac_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();  
    }


    public function indexAction()
    {

        $this->view->title = 'New application';
        $an = $this->_request->getParam('an', false);
//        
//        if($an === false){
//            $this->_helper->redirector->gotoSimple('parameters-missing' , 'error' , 'default');
//        }
        $this->view->title = 'New application';
        $form = new JBlac_Forms_Bssp_LegalEntity();
        $applForm = new JBlac_Forms_Bssp_SubForms_Application();
        $form->addSubForm($applForm, 'application');
        $contactForm = new JBlac_Forms_Bssp_SubForms_Contact();
        
        $form->addSubForm($contactForm, 'contact');
        $requestForm = new JBlac_Forms_Bssp_SubForms_ApplicationRequest();
        $attribs = $requestForm->getElement('otherRequestTypeText')->getAttribs();
        unset( $requestForm->getElement('otherRequestTypeText')->disabled);
        $requestForm->getElement('otherRequestTypeText')->setAttribs($attribs);
//        Zend_Debug::dump($requestForm->getElement('otherRequestTypeText')->getAttribs());
//        foreach($requestForm->getElements() as $element)
//        {
//            $element->removeDecorator('Label');
//        }
        $form->addSubForm($requestForm, 'requestForm');
        $form->getElement('entityCategory')->setValue('promoter');
        $form->getElement('entityType')->setLabel('Applicant Type');        
        
        $objEntity = new JBlac_Models_LegalEntity();
        
        $address = new JBlac_Models_Address();
        
        $addressMapper = new JBlac_Models_AddressMapper('JBlac_Models_DbTable_Address');

        $objEntity = new JBlac_Models_LegalEntity();
        $applMapper = new Applications_Model_BsspApplicationMapper('Applications_Model_DbTable_BsspApplication');
        
        $contactMapper = new Contacts_Model_ContactMapper('Contacts_Model_DbTable_Contact');
        if($this->getRequest()->isGet()){
            $applicationData = $applMapper->fetchOneByApplicationNumber($an);
            $addressData = $addressMapper->searchByLegalEntity($applicationData['applicationLegalEntityId']);
            $towns = JBlac_Utilities_AppReference::fetchTowns($addressData['regionCode']);
            $constituences = JBlac_Utilities_AppReference::fetchConstituences($addressData['cityCode']);
            
//            $form->getElement('regionCode')->setMultiOptions();
            $form->getElement('cityCode')->setMultiOptions($towns);
            $form->getElement('constituencyCode')->setMultiOptions($constituences);

            if('company' === $applicationData['entityType']){
                $contactData['contact'] = (array)$contactMapper->searchContactsByLegalIdentityId($applicationData['applicationLegalEntityId']);
            }else{
                $contactData['contact'] = [];
            }

            $applicationData = (array)$applicationData;

            $applicationData = array_merge($applicationData ,$contactData , $addressData );
            $this->view->applicationData = $applicationData;
            
        }

        if($this->getRequest()->isPost()){
            $PostData = $this->getRequest()->getPost();
            
//            Zend_Debug::dump($PostData);exit;
            if($form->isValid($this->getRequest()->getPost())){
                $objEntityMapper = new JBlac_Models_LegalEntityMapper('JBlac_Models_DbTable_LegalEntity');
                $objEntity->setEmailAddress($PostData['emailAddress'])
                          ->setId($PostData['applicationLegalEntityId'])
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
                                    ->setIdentityNumber($PostData['identityNumber'])
                                    ->setPassportNumber($PostData['passportNumber'])
                                    ->setCompanyName($PostData['companyName'])
                                    ->setCompanyRegistrationNumber($PostData['companyRegistrationNumber']);                              
                          break;
                  }
                
                try{
                    Zend_Db_Table::getDefaultAdapter()->beginTransaction();
                    $OK = $objEntityMapper->save($objEntity);
                    
                    $addressObj = new JBlac_Models_Address();
                    $addressObjMapper = new JBlac_Models_AddressMapper('JBlac_Models_DbTable_Address');
                    
                    $addressObj->setAddressLineOne($PostData['addressLineOne'])
                            ->setId($PostData['addressId'])
                              ->setPostalAddress($PostData['postalAddress'])
                              ->setRegionCode($PostData['regionCode'])
                              ->setCityCode($PostData['cityCode'])
                              ->setCountryCode($PostData['countryCode'])
                              ->setConstituencyCode($PostData['constituencyCode'])
                              ->setLegalEntityId($PostData['applicationLegalEntityId']);
                    
                    $OK = $addressObjMapper->save($addressObj);
                    
                    $applObject = new Applications_Model_BsspApplication();
                    $applMapper = new Applications_Model_BsspApplicationMapper('Applications_Model_DbTable_BsspApplication');
                    
                    $applObject->setApplicationLegalEntityId($PostData['applicationLegalEntityId'])
                            ->setId($PostData['applicationId'])
                            ->setApplicationLegalEntityType($PostData['entityType'])
                            ->setApplicationNumber($PostData['applicationNumber'])
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
                                                ->setLegalEntityId($PostData['applicationLegalEntityId'])
                                                ->setId($PostData['contactId'][$i]);                        
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
                                    
                                    if(is_null($PostData['requestId'][$i])){
                                        $requestNumber  = JBlac_Utilities_BSSP::getRequestNumber();
                                    }else{
                                        $requestNumber  = $PostData['requestNumber'][$i];
                                    }
                                                                
                                    $appRequest
                                            ->setId($PostData['requestId'][$i])
                                            ->setRequestNumber($requestNumber)                                    
                                            ->setRequestType($PostData['requestType'][$i])
                                            ->setOtherRequestTypeText($PostData['otherRequestTypeText'][$i])
                                            ->setRequestSector($PostData['requestSector'][$i])
                                            ->setRequestPriotityArea($PostData['requestPriotityArea'][$i])
                                            ->setRequestBusinessActivity($PostData['requestBusinessActivity'][$i])
                                            ->setRequestStatus($PostData['requestStatus'][$i])
                                            ->setRequestRemarks('New Application')
                                            ->setApplicationNumber($applObject->getApplicationNumber());                                    

                                    $appRequestMapper->save($appRequest);
                                }                            
                        }                        
                        
                    Zend_Db_Table::getDefaultAdapter()->commit();
                                    
                    $this->_flashMessenger->addMessage(array('message' => "A BSSP application <strong>{$PostData['applicationNumber']}</strong> has been updated.", 'status' => 'success'));
                } catch (Exception $ex) {
                    Zend_Db_Table::getDefaultAdapter()->rollBack();
                    echo $ex->getMessage();
                    $this->_flashMessenger->addMessage(array('message' => 'Promoter could not be created.', 'status' => 'error'));
                }
               $this->_redirect('/promoters/');
            }else{
                $this->view->form = $form;
                return;
            }
        }else{
        $form->populate($applicationData);
        $this->view->form = $form;                      
        }
    }   
}