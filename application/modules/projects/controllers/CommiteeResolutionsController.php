<?php

class Projects_CommiteeResolutionsController extends JBlac_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
    }


    public function indexAction()
    {
        $this->view->title = 'Applications List';
        $page = $this->_getParam('page', 1);
        $promoterMapper = new JBlac_Models_LegalEntityMapper('JBlac_Models_DbTable_LegalEntity');
        
//        Zend_Debug::dump($promoterMapper->fetchPage($page , 'consultant'));exit;
        $this->view->paginator = $promoterMapper->fetchPage($page , 'consultant');
    }

    public function createAction()
    {
        $this->view->title = 'New application';
        $id = $this->_request->getParam('id', 0);
        /*
         * Project Object
         */
        $objEntity = new Projects_Model_Project();
        
        $projectMapper = new Projects_Model_ProjectMapper('Projects_Model_DbTable_Project');        
        $projectData = $projectMapper->fetchOne($id, $objEntity);

        /*
         * Application Object
         */
        $application = new Applications_Model_Application();
        $aplicationMapper = new Applications_Model_ApplicationMapper('Applications_Model_DbTable_Application');
        $applicationData = $aplicationMapper->find($projectData['applicationId'], $application);
        
//        Zend_Debug::dump($projectData);
//        Zend_Debug::dump($applicationData, 'application');
        $form = new JBlac_Forms_Bssp_ProjectResolution();
        $form->removeElement('id');
        
        $form->getElement('projectNumber')->setValue($projectData['number']);
        $form->getElement('projectId')->setValue($projectData['id']);
        
        $form->getElement('requestType')->setValue($applicationData['requestType']);
        
        $extensionObj = new Extensions_Model_Extension();
        $extensionMapper = new Extensions_Model_ExtensionMapper('Extensions_Model_DbTable_Extension');
        
//        Zend_Debug::dump($extensionMapper->fetchExtensionsPerProject($projectData['number']));
        if('' === $projectData['number']){
            $projectNumber = $this->getRequest()->getPost('projectNumber');
        }else{
            $projectNumber = $projectData['number'];
        }
//        echo $this->getRequest()->getPost('projectNumber');exit;
        $this->view->extensions = $extensionMapper->fetchExtensionsPerProject($projectNumber);
        $resolution = new Projects_Model_Resolution();
        $resolutionMapper = new Projects_Model_ResolutionMapper('Projects_Model_DbTable_Resolution');
        
        if($this->getRequest()->isPost()){
            
            $postData = $this->getRequest()->getPost();

            if($form->isValid($postData)){
                
                $resolution->setDiscussionDate(JBlac_Utilities_Date::getMySQLDefault($postData['discussionDate']))
                        ->setDiscussionStatus($postData['discussionStatus'])
                        ->setCorespondenceDate(JBlac_Utilities_Date::getMySQLDefault($postData['corespondenceDate']))
                        ->setRequestType($postData['requestType'])
                        ->setConsultantId($postData['consultantId'])
                        ->setPrincipleConsultant($postData['principleConsultant'])
                        ->setFundsId($postData['fundsApproved'])
                        ->setProjectId($postData['projectId'])
                        ->setProjectNumber($postData['projectNumber'])                      
                        ->setCreatedBy('SYSTEM');
                
                try{
                    $resId = $resolutionMapper->save($resolution);                    
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    exit;
                }
                
                if($resId){
                    $paymentsMapper = new Payments_Model_PaymentMapper('Payments_Model_DbTable_Payment');
                    
                    $numPayments = count($this->getRequest()->getPost('phase'));
                    for($i = 0 ; $i < $numPayments ; $i++){
                        $payments = new Payments_Model_Payment();
                        $payments->setAmount($postData['instalmentAmount'][$i])
                                ->setDateOfPayment(JBlac_Utilities_Date::getMySQLDefault($postData['instalmentDate'][$i]))
                                ->setFundsId($postData['fundsApproved'])
                                ->setPhase($postData['phase'][$i]);
                        $paymentsMapper->save($payments);
                    }
                    
                    $implObj = new Projects_Model_Implementation();
                    $implMapper = new Projects_Model_ImplementationMapper('Projects_Model_DbTable_Implementation');
                    
                    $implObj->setDiscussionDate(JBlac_Utilities_Date::getMySQLDefault($postData['discussionDate']))
                            ->setDateIssuedToPromoters(JBlac_Utilities_Date::getMySQLDefault($postData['dateIssuedToPromoters']))
                            ->setReportType($postData['reportType'])
                            ->setSourceOfFunds($postData['sourceOfFunds'])
                            ->setNumberOfMaleEmployed($postData['numberOfMaleEmployed'])
                            ->setNumberOfFemaleEmployed($postData['numberOfFemaleEmployed'])
                            ->setProjectNumber($postData['projectNumber'])
                            ->setImplementationRemarks($postData['implementationRemarks']);

                    try {
                        $impId = $implMapper->save($implObj);
                    } catch (Exception $ex) {
                        Zend_Debug::dump($ex->getMessage());
                    }
                }
                 $this->_flashMessenger->addMessage(array('message' => 'Project resolution has been created and saved.', 'status' => 'success'));
                
//                $this->_redirect('/projects/');
            }else{
                $this->view->form = $form;
                return;
            }
        }else{
                $this->view->form = $form;            
         //$this->view->form = $form;   
        }        
    }
    
    public function resolutionInfoAction(){
        $this->view->title = 'Resolution Information';
        $id = $this->_request->getParam('id', 0);
    }
}