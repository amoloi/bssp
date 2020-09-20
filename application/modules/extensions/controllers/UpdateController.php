<?php

class Extensions_UpdateController extends JBlac_Controller_Action
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
        $id = $this->_request->getParam('id', false);
        if($id === false){
            $this->_helper->redirector->gotoSimple('parameters-missing' , 'error' , 'default');
        }        
        $form = new JBlac_Forms_Bssp_ProjectExtension();
        //$form->setAction('/extensions/update/update');
        
        $objEntity = new Extensions_Model_Extension();
        
        $objEntityMapper = new Extensions_Model_ExtensionMapper('Extensions_Model_DbTable_Extension');
        
        $objData = $objEntityMapper->fetchOne($id, $objEntity);
//        Zend_Debug::dump($objData);//return;
        
        if($this->getRequest()->isPost()){
            
            $formData = $this->getRequest()->getPost();
            
            if($form->isValid($formData)){
                
                $objEntity->setPhase($formData['phase'])
                          ->setDiscussionDate(JBlac_Utilities_Date::getMySQLDefault($formData['discussionDate']))
                          ->setExtendedToDate(JBlac_Utilities_Date::getMySQLDefault($formData['extendedToDate']))
                          ->setRemarks($formData['remarks'])
                          ->setProjectNumber($formData['projectNumber'])
                          ->setId($formData['id']) 
                          ->setCreatedBy('SYSTEM');
                try{
                    $updated = $objEntityMapper->save($objEntity);
                    $this->_flashMessenger->addMessage(array('message' => 'Project extension record has been updated.', 'status' => 'success'));                    
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    $this->_flashMessenger->addMessage(array('message' => 'Project extension record could not be updated.', 'status' => 'error'));
                }

                    $this->_redirect('/extensions/');
              
            }else{
                echo 'errors';
                Zend_Debug::dump($form->getCustomMessages());
                $this->view->form = $form;
                return;
            }
        }else{
        $form->populate($objData);
        $this->view->form = $form;                      
        }
    }   
}