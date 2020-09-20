<?php

class Projects_CompositionController extends JBlac_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
        
//        Zend_Debug::dump(JBlac_Models_LegalEntityMapper::fetchEntityListOption('consultant', 8));
    }

    public function indexAction()
    {
        $projectNumber = $this->getParam('pn', false);
        
        if($projectNumber === false && !$this->getRequest()->isPost()){
            $this->_helper->redirector->gotoSimple('parameters-missing' , 'error' , 'default');
        } 
        
        $this->view->title = 'New application';
        $form = new JBlac_Forms_Bssp_ProjectComposition();
        
        $budegtForm = new JBlac_Forms_Bssp_SubForms_ProjectBudget();
        
        $form->addSubForm($budegtForm, 'project_budget');
        
        $AssignmentExtensionForm = new JBlac_Forms_Bssp_SubForms_AssignmentExtension();
        
        $form->addSubForm($AssignmentExtensionForm, 'extensions');
        
        $mouForm = new JBlac_Forms_Bssp_SubForms_MemorandumOfAgreement();
        $form->addSubForm($mouForm, 'mou');
        
        
        $form->removeElement('id');
        
        /**
         * Get details of te application
         * including application number
         */
        
        $request = new Applications_Model_BsspRequest();
        $requestMapper = new Applications_Model_BsspRequestMapper('Applications_Model_DbTable_BsspRequest');
        
        $project = new Projects_Model_Project();
        $projectMapper = new Projects_Model_ProjectMapper('Projects_Model_DbTable_Project');
        
        $mou = new Projects_Model_Mou();
        $mouMapper = new Projects_Model_MouMapper('Projects_Model_DbTable_Mou');

//        Zend_Debug::dump($projectData);
//        Zend_Debug::dump($this->getRequest()->getPost());exit;

        /**
         * Project Consultant Object and Mapper
         */
        
        $projectConsultant = new Projects_Model_ProjectConsultant();
        $projectConsultantMapper = new Projects_Model_ProjectConsultantMapper('Projects_Model_DbTable_ProjectConsultant');
        
        /**
         * Project Consultant Object and Mapper
         */
        
        $projectBudget = new Budgets_Model_ProjectBudget();
        $projectBudgetMapper = new Budgets_Model_ProjectBudgetMapper('Budgets_Model_DbTable_ProjectBudget');
        
        /**
         * Project Implementation Object and Mapper
         */
        
        $projectImplementation = new Projects_Model_BsspProjectImplementation();
        $projectImplementationMapper = new Projects_Model_BsspProjectImplementationMapper('Projects_Model_DbTable_BsspProjectImplementation');
        
       /**
         * Get minimum application data
         */
        
        $applObject = new Applications_Model_BsspApplication();
        $applMapper = new Applications_Model_BsspApplicationMapper('Applications_Model_DbTable_BsspApplication');
        
        if($this->getRequest()->isPost()){
            /*
             * Get data out of the post super global
             */
            $PostData = $this->getRequest()->getPost();
            $this->view->data = $PostData;
            
//            Zend_Debug::dump($PostData);
//                        exit(1);
                        
            if($form->isValid($this->getRequest()->getPost())){
            /*
             * Begin a DB Transaction Here
             */
            JBlac_Service::beginTransaction();
            
            
            /**
             * Update project 
             * So that the system knows that 
             * this pareticular project has been disscussed
             */
            
            if(Projects_Model_ProjectMapper::setProjectIsDisscussed([
                                                                        'projectNumber' => $PostData['projectNumber'],
                                                                        'isDisscussed' => 'Y'
                                                                        ]))
            {
            /*
             * Project Consultant data
             */                 
                $projectConsultant->setLegalEntityId($PostData['consultantId'])
                                  ->setProjectNumber($PostData['projectNumber'])
                                  ->setPrincipleConsultant($PostData['principleConsultant']);
                
                
                        try {                            
                          $projectConsultantMapper->save($projectConsultant); 
                        } catch (Exception $ex) {
//                            Zend_Debug::dump($ex->getMessage());
                        }
                        
            /*
             * Project MOU data
             */ 
             $mou->setProjectNumber($PostData['projectNumber'])
                     ->setSignedDate(JBlac_Utilities_Date::getMySQLDefault($PostData['signedDate']))
                     ->setCompletionDate(JBlac_Utilities_Date::getMySQLDefault($PostData['completionDate']));
             
             try {
                 $mouMapper->save($mou);
             } catch (Exception $ex) {
//                 Zend_Debug::dump($ex->getMessage());
             }
                        
            /*
             * Project Budget data
             */                 
                $budgetNumber = JBlac_Utilities_BSSP::getProjectBudgetCode();
                $projectBudget->setBudgetAmount($PostData['budgetAmount'])
                        ->setBudgetDateOfApproval(JBlac_Utilities_Date::getMySQLDefault($PostData['budgetDateOfApproval']))
                        ->setMasterBudgetNumber($PostData['masterBudgetNumber'])
                        ->setBudgetNumber($budgetNumber)
                        ->setProjectNumber($PostData['projectNumber']);
                
                        try {                            
                          $id = $projectBudgetMapper->save($projectBudget);  
                        } catch (Exception $ex) {
//                            Zend_Debug::dump($ex->getMessage());
                        }
            
            /*
             * Payment data
             */            
                    $paymentsMapper = new Payments_Model_BsspPaymentInstallmentMapper('Payments_Model_DbTable_BsspPaymentInstallment');
                    
                    $paymentsCount = count($this->getRequest()->getPost('phase'));

                    for($i = 0 ; $i < $paymentsCount ; $i++){
                        $payments = new Payments_Model_BsspPaymentInstallment();
                        $payments->setAmount($PostData['instalmentAmount'][$i])
                                ->setDateOfPayment(JBlac_Utilities_Date::getMySQLDefault($PostData['instalmentDate'][$i]))
                                ->setBudgetNumber($budgetNumber)
                                ->setPhase($PostData['phase'][$i]);                        
                        try {
                            $paymentsMapper->save($payments);
                        } catch (Exception $ex) {
//                            Zend_Debug::dump($ex->getMessage());
                        }                        
                    }
                    
            /*
             * Assignment Extension Data
             */ 
                    $assigmentExtensionMapper = new Extensions_Model_BsspAssignmentExtensionMapper('Extensions_Model_DbTable_BsspAssignmentExtension');
                    
                    $extensionsCount = count($this->getRequest()->getPost('extensionCount'));
                    
                    for($i = 0 ; $i < $extensionsCount ; $i++){
                            $assigmentExtension = new Extensions_Model_BsspAssignmentExtension();
                            $assigmentExtension->setAssignmentExtensionPhase($PostData['assignmentExtensionPhase'][$i])
                                ->setAssignmentExtensionDiscussionDate(JBlac_Utilities_Date::getMySQLDefault($PostData['assignmentExtensionDiscussionDate'][$i]))
                                ->setAssignmentExtendedFromDate(JBlac_Utilities_Date::getMySQLDefault($PostData['assignmentExtendedFromDate'][$i]))
                                ->setAssignmentExtendedToDate(JBlac_Utilities_Date::getMySQLDefault($PostData['assignmentExtendedToDate'][$i]))
                                ->setAssignmentExtensionRemarks($PostData['assignmentExtensionRemarks'][$i])
                                ->setAssignmentExtensionProjectNumber($PostData['projectNumber']);                        
                        try {
                            $assigmentExtensionMapper->save($assigmentExtension);
                        } catch (Exception $ex) {
//                            Zend_Debug::dump($ex->getMessage());
                        }                        
                    }                      
                  
            /*
             * Project Employment Creation Data
             */ 
                    $employmentCreationMapper = new Projects_Model_BsspEmploymentCreationMapper('Projects_Model_DbTable_BsspEmploymentCreation');
                    
                    $employmentCount = count($PostData['employmentNumberOfMales']);
                    
                    for($i = 0 ; $i < $employmentCount ; $i++){
                            $employmentCreation = new Projects_Model_BsspEmploymentCreation();
                            $employmentCreation->setEmploymentNumberOfMales($PostData['employmentNumberOfMales'][$i])
                                ->setEmploymentNumberOfFemales($PostData['employmentNumberOfFemales'][$i])
                                ->setEmploymentDateOfEmployment(JBlac_Utilities_Date::getMySQLDefault($PostData['employmentDateOfEmployment'][$i]))
                                ->setEmploymentRemarks(NULL)
                                ->setProjectNumber($PostData['projectNumber']);                        
                        try {
                            $employmentCreationMapper->save($employmentCreation);
                        } catch (Exception $ex) {
                            
//                            Zend_Debug::dump($ex->getMessage());
                        }                        
                    }
                    
            /*
             * Project implementation data
             */ 
                    if('N' === $PostData['includeImplementationReport']){
                        $projectImplementation
                                ->setIncludeImplementationReport($PostData['includeImplementationReport'])
                                ->setImplementationDateOfIssueToPromoters(JBlac_Utilities_Date::getMySQLDefault($PostData['implementationDateOfIssueToPromoters']))
                                ->setImplementationReportType($PostData['implementationReportType'])
                                ->setImplementationSourceOfFunds($PostData['implementationSourceOfFunds'])
                                ->setProjectNumber($PostData['projectNumber'])
                                ->setImplementationRemarks($PostData['implementationRemarks']);
                        try {
                            $projectImplementationMapper->save($projectImplementation);
                            
                        } catch (Exception $ex) {
                            JBlac_Service::rollbackTransaction();
//                            Zend_Debug::dump($ex->getMessage());
                        }                        
                    }
                 
            }
                JBlac_Service::commitTransaction();
                
                $this->_flashMessenger->addMessage(array('message' => "A project with project number <strong>{$PostData['projectNumber']}</strong> has been updated with project details.", 'status' => 'success'));                
                $this->_redirect('/projects/');                
            
            }else{
                $this->_flashMessenger->addMessage(array('message' => 'A project could not be created.', 'status' => 'error'));
//                Zend_Debug::dump($form->getCustomMessages());
//                Zend_Debug::dump($form->getErrorMessages());
//                Zend_Debug::dump($form->getErrors());
//                Zend_Debug::dump($PostData);
                $this->view->form = $form;
                return;
            }
        }else{
        $projectData = $projectMapper->fetchProject($projectNumber);
        $projectData['discussionStatus'] = $projectData['requestStatus'];
        
        
        $applData = $applMapper->fetchOneByApplicationNumber($projectData['applicationNumber']);
        $projectData = array_merge($applData , $projectData);
        
        
        $form->populate($projectData);
        $this->view->request = $projectData;
        $this->view->form = $form;                      
        } 
    }
    
    public function updateAction() {
        $projectNumber = $this->getParam('pn', false);
        
        if($projectNumber === false && !$this->getRequest()->isPost()){
            $this->_helper->redirector->gotoSimple('parameters-missing' , 'error' , 'default');
        } 
        
        $this->view->title = 'New application';
        $form = new JBlac_Forms_Bssp_ProjectComposition();
        
        $budegtForm = new JBlac_Forms_Bssp_SubForms_ProjectBudget();
        
        $form->addSubForm($budegtForm, 'project_budget');
        
        $AssignmentExtensionForm = new JBlac_Forms_Bssp_SubForms_AssignmentExtension();
        
        $form->addSubForm($AssignmentExtensionForm, 'extensions');
        
        $mouForm = new JBlac_Forms_Bssp_SubForms_MemorandumOfAgreement();
        $form->addSubForm($mouForm, 'mou');
        
        
        $form->removeElement('id');
        
        /**
         * Get details of te application
         * including application number
         */
        
        $request = new Applications_Model_BsspRequest();
        $requestMapper = new Applications_Model_BsspRequestMapper('Applications_Model_DbTable_BsspRequest');
        
        $project = new Projects_Model_Project();
        $projectMapper = new Projects_Model_ProjectMapper('Projects_Model_DbTable_Project');
        
        $mou = new Projects_Model_Mou();
        $mouMapper = new Projects_Model_MouMapper('Projects_Model_DbTable_Mou');

//        Zend_Debug::dump($projectData);
//        Zend_Debug::dump($this->getRequest()->getPost());

        /**
         * Project Consultant Object and Mapper
         */
        
        $projectConsultant = new Projects_Model_ProjectConsultant();
        $projectConsultantMapper = new Projects_Model_ProjectConsultantMapper('Projects_Model_DbTable_ProjectConsultant');
        
        /**
         * Project Consultant Object and Mapper
         */
        
        $projectBudget = new Budgets_Model_ProjectBudget();
        $projectBudgetMapper = new Budgets_Model_ProjectBudgetMapper('Budgets_Model_DbTable_ProjectBudget');
        
        /*
         * Assignment Extension Data
         */ 
        
        $assigmentExtensionMapper = new Extensions_Model_BsspAssignmentExtensionMapper('Extensions_Model_DbTable_BsspAssignmentExtension');
        
        /*
         * Project Employment Creation Data
         */ 
        $employmentCreationMapper = new Projects_Model_BsspEmploymentCreationMapper('Projects_Model_DbTable_BsspEmploymentCreation');        
        
        /**
         * Project Implementation Object and Mapper
         */
        
        $projectImplementation = new Projects_Model_BsspProjectImplementation();
        $projectImplementationMapper = new Projects_Model_BsspProjectImplementationMapper('Projects_Model_DbTable_BsspProjectImplementation');
        
        /**
         * Payment Data
         */
        $paymentsMapper = new Payments_Model_BsspPaymentInstallmentMapper('Payments_Model_DbTable_BsspPaymentInstallment');
       /**
         * Get minimum application data
         */
        $applObject = new Applications_Model_BsspApplication();
        $applMapper = new Applications_Model_BsspApplicationMapper('Applications_Model_DbTable_BsspApplication');
        
        if($this->getRequest()->isPost()){
            /*
             * Get data out of the post super global
             */
            $PostData = $this->getRequest()->getPost();
            $this->view->data = $PostData;

            if($form->isValid($this->getRequest()->getPost())){
            /*
             * Begin a DB Transaction Here
             */
            JBlac_Service::beginTransaction();
            
            
            /**
             * Update project 
             * So that the system knows that 
             * this pareticular project has been disscussed
             */
            
            if(Projects_Model_ProjectMapper::setProjectIsDisscussed([
                                                                        'projectNumber' => $PostData['projectNumber'],
                                                                        'isDisscussed' => 'Y'
                                                                        ]))
            {
            /*
             * Project Consultant data
             */                 
                $projectConsultant->setLegalEntityId($PostData['consultantId'])
                                  ->setProjectNumber($PostData['projectNumber'])
                                  ->setPrincipleConsultant($PostData['principleConsultant'])
                                  ->setId($PostData['projectConsultancyId']);
                
                
                        try {                            
                          $projectConsultantMapper->save($projectConsultant); 
                        } catch (Exception $ex) {
//                            Zend_Debug::dump($ex->getMessage());
                        }
                        
            /*
             * Project MOU data
             */ 
             $mou->setProjectNumber($PostData['projectNumber'])
                     ->setSignedDate(JBlac_Utilities_Date::getMySQLDefault($PostData['signedDate']))
                     ->setCompletionDate(JBlac_Utilities_Date::getMySQLDefault($PostData['completionDate']))
                     ->setId($PostData['mou_id']);
             
             try {
                 $mouMapper->save($mou);
             } catch (Exception $ex) {
//                 Zend_Debug::dump($ex->getMessage());
             }
                        
            /*
             * Project Budget data
             */                 
//                $budgetNumber = JBlac_Utilities_BSSP::getProjectBudgetCode();
                $projectBudget->setBudgetAmount($PostData['budgetAmount'])
                        ->setBudgetDateOfApproval(JBlac_Utilities_Date::getMySQLDefault($PostData['budgetDateOfApproval']))
                        ->setMasterBudgetNumber($PostData['masterBudgetNumber'])
                        ->setBudgetNumber($PostData['budgetNumber'])
                        ->setProjectNumber($PostData['projectNumber'])
                        ->setId($PostData['projectBudgetId']);
                
                        try {                            
                          $id = $projectBudgetMapper->save($projectBudget);  
                        } catch (Exception $ex) {
//                            Zend_Debug::dump($ex->getMessage());
                        }
            
            /*
             * Payment data
             */            
                    
                    
                    $paymentsCount = count($this->getRequest()->getPost('phase'));
                    for($i = 0 ; $i < $paymentsCount ; $i++){
                        $payments = new Payments_Model_BsspPaymentInstallment();
                        $payments->setAmount($PostData['instalmentAmount'][$i])
                                ->setDateOfPayment(JBlac_Utilities_Date::getMySQLDefault($PostData['instalmentDate'][$i]))
                                ->setBudgetNumber($PostData['budgetNumber'])
                                ->setPhase($PostData['phase'][$i])
                                ->setId($PostData['installmentId'][$i]);                        
                        try {
                            $paymentsMapper->save($payments);
                        } catch (Exception $ex) {
//                            Zend_Debug::dump($ex->getMessage());
                        }                        
                    }
                    
            /*
             * Assignment Extension Data
             */ 
                    $extensionsCount = count($this->getRequest()->getPost('extensionCount'));

                    for($i = 0 ; $i < $extensionsCount ; $i++){
                            $assigmentExtension = new Extensions_Model_BsspAssignmentExtension();
                            $assigmentExtension->setAssignmentExtensionPhase($PostData['assignmentExtensionPhase'][$i])
                                ->setAssignmentExtensionDiscussionDate(JBlac_Utilities_Date::getMySQLDefault($PostData['assignmentExtensionDiscussionDate'][$i]))
                                ->setAssignmentExtendedFromDate(JBlac_Utilities_Date::getMySQLDefault($PostData['assignmentExtendedFromDate'][$i]))
                                ->setAssignmentExtendedToDate(JBlac_Utilities_Date::getMySQLDefault($PostData['assignmentExtendedToDate'][$i]))
                                ->setAssignmentExtensionRemarks($PostData['assignmentExtensionRemarks'][$i])
                                ->setAssignmentExtensionProjectNumber($PostData['projectNumber'])
                                ->setId($PostData['assignmentExtensionId'][$i]);                        
                        try {
                            $assigmentExtensionMapper->save($assigmentExtension);
                        } catch (Exception $ex) {
//                            Zend_Debug::dump($ex->getMessage());
                        }                        
                    }
            /*
             * Project Employment Creation Data
             */ 
                    
                    $employmentCount = count($PostData['employmentNumberOfMales']);
                    
                    for($i = 0 ; $i < $employmentCount ; $i++){
                            $employmentCreation = new Projects_Model_BsspEmploymentCreation();
                            $employmentCreation->setEmploymentNumberOfMales($PostData['employmentNumberOfMales'][$i])
                                ->setEmploymentNumberOfFemales($PostData['employmentNumberOfFemales'][$i])
                                ->setEmploymentDateOfEmployment(JBlac_Utilities_Date::getMySQLDefault($PostData['employmentDateOfEmployment'][$i]))
                                ->setEmploymentRemarks(NULL)
                                ->setProjectNumber($PostData['projectNumber'])
                                ->setId($PostData['employmentCreationId'][$i]);                        
                        try {
                            $employmentCreationMapper->save($employmentCreation);
                        } catch (Exception $ex) {
                            
//                            Zend_Debug::dump($ex->getMessage());
                        }                        
                    }
                    
            /*
             * Project implementation data
             */
                    if('Y' === $PostData['includeImplementationReport']){
                        $projectImplementation
                                ->setIncludeImplementationReport($PostData['includeImplementationReport'])
                                ->setImplementationDateOfIssueToPromoters(JBlac_Utilities_Date::getMySQLDefault($PostData['implementationDateOfIssueToPromoters']))
                                ->setImplementationReportType($PostData['implementationReportType'])
                                ->setImplementationSourceOfFunds($PostData['implementationSourceOfFunds'])
                                ->setProjectNumber($PostData['projectNumber'])
                                ->setImplementationRemarks($PostData['implementationRemarks'])
                                ->setId($PostData['implementationId']);
                        try {
                            
                            $projectImplementationMapper->save($projectImplementation);
                            
                        } catch (Exception $ex) {
                            JBlac_Service::rollbackTransaction();
//                            Zend_Debug::dump($ex->getMessage());
                        }                        
                    }                                    
            }
                JBlac_Service::commitTransaction();
                $this->_flashMessenger->addMessage(array('message' => "A project with project number <strong>{$PostData['projectNumber']}</strong> has been updated with project details.", 'status' => 'success'));                
                $this->_redirect('/projects/');                
            
            }else{
                $this->_flashMessenger->addMessage(array('message' => 'A project could not be created.', 'status' => 'error'));
//                Zend_Debug::dump($form->getCustomMessages());
//                Zend_Debug::dump($form->getErrorMessages());
//                Zend_Debug::dump($form->getErrors());
//                Zend_Debug::dump($PostData);
                $this->view->form = $form;
                return;
            }
        }else{
        $projectData = $projectMapper->fetchProject($projectNumber);
        $projectData['discussionStatus'] = $projectData['requestStatus'];
        
        $mouData = $mouMapper->fetchMouByProjectNumber($projectNumber);
//        Zend_Debug::dump($mouData);
        
        
        $consultancyData = $projectConsultantMapper->fetchOneByProjectNumnber($projectNumber);
        
//        Zend_Debug::dump($consultancyData);
        
        $budgetData = $projectBudgetMapper->fetchBudgetByProjectNumber($projectNumber);
//        Zend_Debug::dump($budgetData);

        $assigmentExtensionData = $assigmentExtensionMapper->searchAssignmentExtensionsByProjectNumber($projectNumber);
//        Zend_Debug::dump($assigmentExtensionData);
        $this->view->extensions = $assigmentExtensionData;
        
        $projectImplementationData = $projectImplementationMapper->searchProjectImplementationByProjectNumber($projectNumber);
//        Zend_Debug::dump($projectImplementationData);
        $this->view->implementation = $projectImplementationData;
        
        $employmentData = $employmentCreationMapper->searchEmploymentDataByProjectNumber($projectNumber);
//        Zend_Debug::dump($employmentData);
        $this->view->employmentData = $employmentData;
        
        $installmentBudgetNumber = $budgetData['budgetNumber'];
        $paymentData = $paymentsMapper->searchPaymentByBudgetNumber($installmentBudgetNumber);
        
        $this->view->paymentData = $paymentData;
//        Zend_Debug::dump($paymentData);
        
        
        $applData = $applMapper->fetchOneByApplicationNumber($projectData['applicationNumber']);
        $projectData = array_merge(
                                    $applData , 
                                    $projectData , 
                                    $mouData , 
                                    $consultancyData , 
                                    $budgetData , 
                                    $projectImplementationData
                                    );
        
        
        $form->populate($projectData);
        $this->view->request = $projectData;
        $this->view->form = $form;                      
        }         
    }

    public function deleteAction(){
        $this->view->title = 'New application';
        $id = $this->_request->getParam('id', 0);
        $objMapper = new Promoters_Model_PromoterMapper('Promoters_Model_DbTable_Promoter');
        $applicationData = $objMapper->delete($id);
        $this->_redirect('/promoters/');
    }

}