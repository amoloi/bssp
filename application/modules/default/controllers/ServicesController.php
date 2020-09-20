<?php

class ServicesController extends JBlac_Controller
{

    public function init()
    {

    }

    public function indexAction()
    {
    }

    public function newInstalmentAction() {
        $this->disableLayout();
        $rowCount = $this->getParam('rowCount' , 0);
        $form = new JBlac_Forms_SubForms_Instalment(['rowCount' => $rowCount]);
//        $this->view->rowCount = $form->getRowCount();
        $this->view->form = $form;
    }
    
    /**
     * Get towns for a particular region
     */
       public function getTownsAction() {
       
       // Do this unless you want the layout too :-P
        $this->disableLayout();

         $ajaxContext = $this->_helper->getHelper('AjaxContext');
         $ajaxContext->addActionContext('get-towns', 'html')->initContext();
            
         $code = $this->_getParam('code', null);
       
         //$element = new JBlac_Models_PersonForm('person');
         $towns = JBlac_Utilities_AppReference::fetchRegionTowns($code);
         
         // What is returned thru ajax
         $this->view->townsjson = Zend_Json_Encoder::encode($towns);
         
       }
    /**
     * Get constituences for a particular town
     */
       public function getConstituencesAction() {
       
       // Do this unless you want the layout too :-P
        $this->disableLayout();

         $ajaxContext = $this->_helper->getHelper('AjaxContext');
         $ajaxContext->addActionContext('get-constituences', 'html')->initContext();
            
         $code = $this->_getParam('code', null);
      
         //$element = new JBlac_Models_PersonForm('person');
         $towns = JBlac_Utilities_AppReference::fetchTownConstituences($code);
         
         // What is returned thru ajax
         $this->view->constituencesjson = Zend_Json_Encoder::encode($towns);
         
       }
    public function newExtensionAction() {
        $this->disableLayout();
        $rowCount = $this->getParam('rowCount' , 0);
        if(intval($rowCount == 0)){
            $rowCount = $rowCount + 1;
        }
        $form = new JBlac_Forms_Bssp_SubForms_AssignmentExtension();
        $this->view->rowCount = $rowCount;
        $this->view->form = $form;
    }
    public function newContactAction() {
        $this->disableLayout();
        $rowCount = $this->getParam('rowCount' , 0);
        if(intval($rowCount == 0)){
            $rowCount = $rowCount + 1;
        }
        $form = new JBlac_Forms_Bssp_SubForms_Contact();
        $this->view->rowCount = $rowCount;
        $this->view->form = $form;
    }    
    public function newEmploymentDataAction() {
        $this->disableLayout();
        $rowCount = $this->getParam('rowCount' , 0);
        if(intval($rowCount == 0)){
            $rowCount = $rowCount + 1;
        }
        $form = new JBlac_Forms_Bssp_SubForms_EmploymentCreation();
        $this->view->rowCount = $rowCount;
        $this->view->form = $form;
    }       
    public function entityformAction(){

        $this->disableLayout();
    }
    
    public function newRequestAction() {
        $this->disableLayout();
        
         $ajaxContext = $this->_helper->getHelper('AjaxContext');
         $ajaxContext->addActionContext('get-constituences', 'html')->initContext();
         
        $rowCount = $this->getParam('rowCount' , 0);
//        $rowCount + 1;
        $form = new JBlac_Forms_Bssp_SubForms_ApplicationRequest(['rowCount' => $rowCount]);
        $form->getElement('requestStatus')->setValue('PENDING');
        $form->getElement('otherRequestTypeText')->setAttrib('readonly' , 'readonly');
        $this->view->form = $form;
    }
    
    public function fetchSectorPriorityAreasAction() {

       // Do this unless you want the layout too :-P
        $this->disableLayout();

        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('fetch-sector-priority-areas', 'html')->initContext();
            
        $code = $this->_getParam('code', null);
        
        $priorities = JBlac_Services_Sector::fetchSectorPriorityAreas($code);
        // What is returned thru ajax
         $this->view->prioritiesjson = Zend_Json_Encoder::encode($priorities);
    }
    public function removeRequestAction() {
        
        $this->disableLayout();
        
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('get-constituences', 'html')->initContext();
         
        $requestId = $this->getParam('requestId' , 0);         
         
        $requestMapper = new Applications_Model_BsspRequestMapper('Applications_Model_DbTable_BsspRequest');
         
         try {
             
             $requestMapper->delete($requestId);
       
         } catch (Exception $ex) {

         }
       

    }    
     public function removeContactAction() {
        
        $this->disableLayout();
        
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('remove-contact', 'html')->initContext();
         
        $contactId = $this->getParam('contactId' , 0);         
         
        $contactMapper = new Contacts_Model_ContactMapper('Contacts_Model_DbTable_Contact');
         
         try {
             
             $contactMapper->delete($contactId);
       
         } catch (Exception $ex) {

         }
    }    
    public function newProjectBudgetAction() {
        $this->disableLayout();
        
         $ajaxContext = $this->_helper->getHelper('AjaxContext');
         $ajaxContext->addActionContext('get-constituences', 'html')->initContext();
         
        $projectNumber = $this->getParam('projectNumber' , 0);
        $form = new JBlac_Forms_Bssp_SubForms_ProjectBudget(['projectNumber' => $projectNumber]);
        $form->getElement('projectNumber')->setValue($projectNumber);
        $this->view->form = $form;
    }
    
    public function createProjectBudgetAction(){
        $this->disableLayout();
        $this->setNoviewRender();
        if($this->getRequest()->isXmlHttpRequest()){
            $PostData = $this->getRequest()->getPost();
            
            $projectBudget = new Budgets_Model_ProjectBudget();
            $projectBudegetMapper = new Budgets_Model_ProjectBudgetMapper('Budgets_Model_DbTable_ProjectBudget');
            
            $budgetNumber = JBlac_Utilities_BSSP::getProjectBudgetCode();
            $projectBudget->setMasterBudgetNumber($PostData['masterBudgetNumber'])
                          ->setProjectNumber($PostData['masterBudgetNumber'])
                          ->setBudgetNumber($budgetNumber)
                          ->setBudgetDateOfApproval(JBlac_Utilities_Date::getMySQLDefault($PostData['budgetDateOfApproval']))
                          ->setBudgetName($PostData['budgetName'])
                          ->setBudgetAmount($PostData['budgetAmount'])
                          ->setBudgetRemarks($PostData['budgetRemarks']);
            
//            $projectBudegetMapper->save($projectBudget);
            Zend_Debug::dump($projectBudegetMapper->save($projectBudget));
        }
    }
    public function newLegalEntityAction() {
        $this->disableLayout();
        
         $ajaxContext = $this->_helper->getHelper('AjaxContext');
         $ajaxContext->addActionContext('get-constituences', 'html')->initContext();
        if($this->getRequest()->isXmlHttpRequest()){
            
                $legalEntity  = $this->getParam('legalEntity' , 'consultant');
                $form = new JBlac_Forms_Bssp_SubForms_LegalEntity();
                $form->getElement('entityCategory')->setValue('consultant');
                $form->getElement('regionCode')->setAttrib('onchange' , 'bsspObj.loadTownsAndCities(this.value)');
                
                $this->view->form = $form;
        }
      
    }    
    public function createLegalEntityAction() {
        $this->disableLayout();

        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('get-constituences', 'html')->initContext();
        
        if($this->getRequest()->isXmlHttpRequest()){

                $objEntity = new JBlac_Models_LegalEntity();

                if($this->getRequest()->isPost()){

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
  
                        } catch (Exception $ex) {

                            echo $ex->getMessage();
                        }
                        $data = JBlac_Models_LegalEntityMapper::fetchEntityListOption('consultant', $entityId);
                        $this->view->entityjson = Zend_Json_Encoder::encode($data); 
                    }else{
                        return ;
                    }
             
        } 
      
    }

    public function fetchNewCommitteeResolutionCountAction() {

       // Do this unless you want the layout too :-P
        $this->disableLayout();

        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('fetch-new-committee-resolution-count', 'html')->initContext();

        
        $count = JBlac_Services_Application::getNumberOfNewCommiteeResolution();
        // What is returned thru ajax
         $this->view->countjson = Zend_Json_Encoder::encode($count);
    }
    public function fetchNewApplicationsCountAction() {

       // Do this unless you want the layout too :-P
        $this->disableLayout();

        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('fetch-new-applications-count', 'html')->initContext();
            
        $count = JBlac_Services_Application::getNumberOfNewApplications();
        // What is returned thru ajax
         $this->view->countjson = Zend_Json_Encoder::encode($count);
    }
    public function fetchNewProjectsCountAction() {

       // Do this unless you want the layout too :-P
        $this->disableLayout();

        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('fetch-new-projects-count', 'html')->initContext();

        $count = JBlac_Services_Application::getNumberOfNewProjects();
        // What is returned thru ajax
         $this->view->countjson = Zend_Json_Encoder::encode($count);
    }     
}