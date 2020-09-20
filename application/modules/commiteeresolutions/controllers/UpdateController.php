<?php

class Commiteeresolutions_UpdateController extends JBlac_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
    }


    public function indexAction()
    {
        $id = $this->getParam('rn', false);
        if($id === false){
            $this->_helper->redirector->gotoSimple('parameters-missing' , 'error' , 'default');
        }        
        $this->view->title = 'New application';
        $form = new JBlac_Forms_Bssp_ProjectResolution();
        $form->removeElement('id');
        
        /**
         * Get details of te application
         * including application number
         */
        
        $request = new Applications_Model_BsspRequest();
        $requestMapper = new Applications_Model_BsspRequestMapper('Applications_Model_DbTable_BsspRequest');
        
        
//      Zend_Debug::dump($applMapper->fetchOne($id, $application));
        
        $requestData = $requestMapper->searchRequestResolutionData($id);
        $requestData['discussionStatus'] = $requestData['requestStatus'];
        $requestData['discussionDate'] = date('d/m/Y');
        
        $proForm = new JBlac_Forms_Bssp_SubForms_Project();
        $form->addSubForm($proForm, 'project');
        
        
        /**
         * Get project data for a request if available
         */
        $project = new Projects_Model_Project();
        $projectMapper = new Projects_Model_ProjectMapper('Projects_Model_DbTable_Project');
         
        if('APPROVED' === $requestData['requestStatus']){
            $projectData = $projectMapper->searchProjectByRequestNumber($id);
            $requestData = array_merge($requestData , $projectData);
        }else{
            
        }

        $form->populate($requestData);
        $this->view->request = $requestData;
        $this->view->form = $form;
//        Zend_Debug::dump($requestData);

        
        

        if($this->getRequest()->isPost()){
//                    Zend_Debug::dump($this->getRequest()->getPost());exit;
            /*
             * Get data out of the post super global
             */
            $postData = $this->getRequest()->getPost();
            if($form->isValid($this->getRequest()->getPost())){
                            $applRequest = new Applications_Model_BsspRequest();
                            $applRequestMapper = new Applications_Model_BsspRequestMapper('Applications_Model_DbTable_BsspRequest');
                            
                            $resolution = new Commiteeresolutions_Model_BsspResolution();
                            $resolutionMapper = new Commiteeresolutions_Model_BsspResolutionMapper('Commiteeresolutions_Model_DbTable_BsspResolution');
                            
                switch ($postData['resolutionDiscussionStatus']) {
                    case 'APPROVED':
                            $applRequest->setId($postData['requestId'])
                                    ->setApplicationNumber($postData['applicationNumber'])
                                    ->setRequestNumber($postData['requestNumber'])
                                    ->setRequestStatus($postData['resolutionDiscussionStatus'])
                                    ->setRequestRemarks($postData['resolutionRemarks']);
                            $applRequestMapper->updateStatus($applRequest);
                            
                            $project->setName($postData['projectName'])
                                      ->setNumber($postData['projectNumber'])
                                      ->setStatus($postData['projectStatus'])
                                      ->setDescription($postData['projectDescription'])
                                      ->setStartDate(JBlac_Utilities_Date::getMySQLDefault($postData['startDate']))
                                      ->setEndDate(JBlac_Utilities_Date::getMySQLDefault($postData['endDate'])) 
                                      ->setApplicationNumber($postData['applicationNumber'])
                                      ->setRequestNumber($postData['requestNumber'])
                                      ->setId($postData['projectId'])                                    
                                      ->setCreatedBy('SYSTEM');
                            
                            try{

                                $projectId = $projectMapper->save($project);

                            } catch (Exception $ex) {
                                echo $ex->getMessage();
                            }
                            
                            $resolution->setResolutionDiscussionDate(JBlac_Utilities_Date::getMySQLDefault($postData['resolutionDiscussionDate']))
                                    ->setResolutionDiscussionStatus($postData['resolutionDiscussionStatus'])
                                    ->setResolutionCorespondenceDate(JBlac_Utilities_Date::getMySQLDefault($postData['resolutionCorespondenceDate']))
                                    ->setResolutionRemarks($postData['resolutionRemarks'])
                                    ->setResolutionRemarksDescription($postData['resolutionRemarksDescription'])
                                    ->setResolution_requestNumber($postData['requestNumber'])
                                    ->setId($postData['resolutionId']);

                            try {

                                $resolutionMapper->save($resolution);
                            } catch (Exception $ex) {
                                Zend_Debug::dump($ex->getMessage());
                            }                            
                            
                            
                            $this->_flashMessenger->addMessage(array('message' => "The request with number <strong>{$applRequest->getRequestNumber()}</strong> has been approved.", 'status' => 'success'));                            
                          $this->_redirect('/commiteeresolutions/');
                            
                        break;
                    case 'REJECTED':
                            $projectMapper->deleteProjectByRequestNumber($postData['requestNumber']);
                            $applRequest->setId($postData['requestId'])
                                    ->setApplicationNumber($postData['applicationNumber'])
                                    ->setRequestNumber($postData['requestNumber'])
                                    ->setRequestStatus($postData['resolutionDiscussionStatus'])
                                    ->setRequestRemarks($postData['resolutionRemarks']);
                            $applRequestMapper->updateStatus($applRequest);

                            
                            
                            $resolution->setResolutionDiscussionDate(JBlac_Utilities_Date::getMySQLDefault($postData['resolutionDiscussionDate']))
                                    ->setResolutionDiscussionStatus($postData['resolutionDiscussionStatus'])
                                    ->setResolutionCorespondenceDate(JBlac_Utilities_Date::getMySQLDefault($postData['resolutionCorespondenceDate']))
                                    ->setResolutionRemarks($postData['resolutionRemarks'])
                                    ->setResolutionRemarksDescription($postData['resolutionRemarksDescription'])
                                    ->setResolution_requestNumber($postData['requestNumber'])
                                    ->setId($postData['resolutionId']);

                            try {

                                $resolutionMapper->save($resolution);
                            } catch (Exception $ex) {
                                Zend_Debug::dump($ex->getMessage());
                            }                                                        
                            
                            $this->_flashMessenger->addMessage(array('message' => "The application request with number <strong>{$applRequest->getRequestNumber()}</strong> has been rejected.", 'status' => 'success'));                            
                            $this->_redirect('/commiteeresolutions/');
                            exit();

                        break;                   
                    default:
                        break;
                }

            }else{
                $this->_flashMessenger->addMessage(array('message' => 'A project could not be created.', 'status' => 'error'));
                Zend_Debug::dump($form->getCustomMessages());
                $this->view->form = $form;
                return;
            }
        }else{
                      
        } 
    }
}



