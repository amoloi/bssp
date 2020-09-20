<?php

class Commiteeresolutions_CreateController extends JBlac_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
    }

    public function indexAction()
    {
        $id = $this->getParam('rn', false);
//        if($id === false){
//            $this->_helper->redirector->gotoSimple('parameters-missing' , 'error' , 'default');
//        }          
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
        
        $requestData = $requestMapper->fetchOne($id, $request);
        $requestData['discussionStatus'] = $requestData['requestStatus'];
        $requestData['discussionDate'] = date('d/m/Y');
        
        $proForm = new JBlac_Forms_Bssp_SubForms_Project();
        $form->addSubForm($proForm, 'project');
       
        $form->populate($requestData);
        $this->view->request = $requestData;
        
//        Zend_Debug::dump($requestData);

        
        $objEntity = new Projects_Model_Project();

        if($this->getRequest()->isPost()){
//                    Zend_Debug::dump($this->getRequest()->getPost());exit;
            /*
             * Get data out of the post super global
             */
            $PostData = $this->getRequest()->getPost();
            if($form->isValid($this->getRequest()->getPost())){
                            $applRequest = new Applications_Model_BsspRequest();
                            $applRequestMapper = new Applications_Model_BsspRequestMapper('Applications_Model_DbTable_BsspRequest');
                            
                            $resolution = new Commiteeresolutions_Model_BsspResolution();
                            $resolutionMapper = new Commiteeresolutions_Model_BsspResolutionMapper('Commiteeresolutions_Model_DbTable_BsspResolution');
                            
                switch ($PostData['resolutionDiscussionStatus']) {
                    case 'APPROVED':
                            $applRequest->setId($PostData['requestId'])
                                    ->setApplicationNumber($PostData['applicationNumber'])
                                    ->setRequestNumber($PostData['requestNumber'])
                                    ->setRequestStatus($PostData['resolutionDiscussionStatus'])
                                    ->setRequestRemarks($PostData['resolutionRemarks']);
                            $applRequestMapper->updateStatus($applRequest);
                            
                            
                            $objEntityMapper = new Projects_Model_ProjectMapper('Projects_Model_DbTable_Project');
                            $projectNumber = JBlac_Utilities_BSSP::getProjectNumber();
                            $objEntity->setName($PostData['projectName'])
                                      ->setNumber($projectNumber)
                                      ->setStatus($PostData['projectStatus'])
                                      ->setDescription($PostData['projectDescription'])
                                      ->setApplicationNumber($PostData['applicationNumber'])
                                      ->setRequestNumber($PostData['requestNumber'])
                                      ->setCreatedBy(Zend_Registry::get('user'));
                              
                            try{

                                $projectId = $objEntityMapper->save($objEntity);

                            } catch (Exception $ex) {
                                echo $ex->getMessage();
                            }
                            
                            $resolution->setResolutionDiscussionDate(JBlac_Utilities_Date::getMySQLDefault($PostData['resolutionDiscussionDate']))
                                    ->setResolutionDiscussionStatus($PostData['resolutionDiscussionStatus'])
                                    ->setResolutionCorespondenceDate(JBlac_Utilities_Date::getMySQLDefault($PostData['resolutionCorespondenceDate']))
                                    ->setResolutionRemarks($PostData['resolutionRemarks'])
                                    ->setResolutionRemarksDescription($PostData['resolutionRemarksDescription'])
                                    ->setResolution_requestNumber($PostData['requestNumber']);

                            try {

                                $resolutionMapper->save($resolution);
                            } catch (Exception $ex) {

//                                Zend_Debug::dump($ex->getMessage());
                            }                            
                            
                           $projectData = $objEntityMapper->featchProjectByProjectId($projectId); 
                          $this->_flashMessenger->addMessage(array('message' => "The request with number <strong>{$applRequest->getRequestNumber()}</strong> has been approved.", 'status' => 'success'));

                            if(array_key_exists('btnSaveProject', $PostData)){

                                $this->_helper->redirector->gotoSimple('index','composition' , 'projects' , ['pn'=>$projectData['number']]);

                            }else{

                                $this->_redirect('/commiteeresolutions/');

                            }                          
                          
                            
                        break;
                    case 'REJECTED':   
                            $applRequest->setId($PostData['requestId'])
                                    ->setApplicationNumber($PostData['applicationNumber'])
                                    ->setRequestNumber($PostData['requestNumber'])
                                    ->setRequestStatus($PostData['resolutionDiscussionStatus'])
                                    ->setRequestRemarks($PostData['resolutionRemarks']);
                            $applRequestMapper->updateStatus($applRequest);

                            
                            $resolution->setResolutionDiscussionDate(JBlac_Utilities_Date::getMySQLDefault($PostData['resolutionDiscussionDate']))
                                    ->setResolutionDiscussionStatus($PostData['resolutionDiscussionStatus'])
                                    ->setResolutionCorespondenceDate(JBlac_Utilities_Date::getMySQLDefault($PostData['resolutionCorespondenceDate']))
                                    ->setResolutionRemarks($PostData['resolutionRemarks'])
                                    ->setResolutionRemarksDescription($PostData['resolutionRemarksDescription'])
                                    ->setResolution_requestNumber($PostData['requestNumber']);

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
                $session = new Zend_Session_Namespace('BSSP');
                
                if($form->hasErrors()){
                    $this->_flashMessenger->addMessage(array('message' => 'A project could not be created.', 'status' => 'error'));
                    $session->FormData->errors = $form->getMessages();
                    $session->FormData->data = $PostData;
                    $this->_helper->redirector->gotoSimple('index' , 'create' , 'commiteeresolutions' , ['rn' => $PostData['requestNumber'] ]);
                }else{}
                return;
            }
        }else{
                $session = new Zend_Session_Namespace('BSSP');

                if(isset($session->FormData->errors)){
//                    $form->setErrorMessages($session->FormData->errors);
                }
                if(isset($session->FormData->data)){
                    $form->populate($session->FormData->data);
                }

                    $this->view->form = $form;
                    unset($session->FormData);

                      
        } 
    }
    
    public function deleteAction(){
        $this->view->title = 'New application';
        $id = $this->_request->getParam('id', 0);
        $objMapper = new Promoters_Model_PromoterMapper('Promoters_Model_DbTable_Promoter');
        $applicationData = $objMapper->delete($id);
        $this->_redirect('/commiteeresolutions/');
    }
}