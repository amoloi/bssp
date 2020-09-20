<?php

class Extensions_CreateController extends JBlac_Controller_Action
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
        $form = new JBlac_Forms_Bssp_ProjectExtension();     
        $form->removeElement('id');
        $this->view->form = $form;
        
        $objEntity = new Extensions_Model_Extension();

        if($this->getRequest()->isPost()){
            $formData = $this->getRequest()->getPost();
            if($form->isValid($formData)){
                $objEntityMapper = new Extensions_Model_ExtensionMapper('Extensions_Model_DbTable_Extension');
                $objEntity->setPhase($formData['phase'])
                          ->setDiscussionDate(JBlac_Utilities_Date::getMySQLDefault($formData['discussionDate']))
                          ->setExtendedToDate(JBlac_Utilities_Date::getMySQLDefault($formData['extendedToDate']))
                          ->setRemarks($formData['remarks'])
                          ->setProjectNumber($formData['projectNumber'])               
                          ->setCreatedBy('SYSTEM');
                try{
                    $extensionId = $objEntityMapper->save($objEntity);
                    $this->_flashMessenger->addMessage(array('message' => 'Promoter has been created.', 'status' => 'success'));                    
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    $this->_flashMessenger->addMessage(array('message' => 'Promoter could not be created.', 'status' => 'error'));
                }

                if(array_key_exists('btnSubmit', $formData)){
                    $this->_redirect('/extensions/');
                }
                if(array_key_exists('btnMore', $formData)){
                    $this->_redirect('/extensions/create');
                }                
                
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
        $id = $this->_request->getParam('id', 0);
        $objMapper = new Extensions_Model_ExtensionMapper('Extensions_Model_DbTable_Extension');
        $applicationData = $objMapper->delete($id);
        $this->_flashMessenger->addMessage(array('message' => 'Assignment extension record has been deleted.', 'status' => 'success'));
        $this->_redirect('/extensions/');
    }
}



