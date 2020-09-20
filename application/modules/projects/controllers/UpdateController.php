<?php

class Projects_UpdateController extends JBlac_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
    }


    public function indexAction()
    {
        $this->view->title = '';
        $id = $this->_request->getParam('id', false);
        if($id === false){
            $this->_helper->redirector->gotoSimple('parameters-missing' , 'error' , 'default');
        }
        $form = new JBlac_Forms_Bssp_Project();
        //$form->setAction('/promoters/update/update');
        
        $objEntity = new Projects_Model_Project();
        
        $projectMapper = new Projects_Model_ProjectMapper('Projects_Model_DbTable_Project');
        
        $projectData = $projectMapper->fetchOne($id, $objEntity);
        
        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $objEntityMapper = new Projects_Model_ProjectMapper('Projects_Model_DbTable_Project');
                $objEntity->setName($this->getRequest()->getPost('name'))
                          ->setNumber($this->getRequest()->getPost('number'))
                          ->setStatus($this->getRequest()->getPost('status'))
                          ->setTasks($this->getRequest()->getPost('tasks'))
                          ->setDescription($this->getRequest()->getPost('description'))
                          ->setStartDate(JBlac_Utilities_Date::getMySQLDefault($this->getRequest()->getPost('startDate')))
                          ->setEndDate(JBlac_Utilities_Date::getMySQLDefault($this->getRequest()->getPost('endDate'))) 
                          ->setApplicationId($this->getRequest()->getPost('applicationId'))
                          ->setId($this->getRequest()->getPost('id'))
                          ->setCreatedBy('SYSTEM');
                
                try{
                    
                    $OK = $objEntityMapper->save($objEntity);
                    
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
                $this->_flashMessenger->addMessage(array('message' => "A project with project number <strong>{$objEntity->getNumber()}</strong> has been updated.", 'status' => 'success'));                
                $this->_redirect('/projects/');
            }else{
                $this->_flashMessenger->addMessage(array('message' => 'A project could not be updated.', 'status' => 'error'));
                Zend_Debug::dump($form->getCustomMessages());
                $this->view->form = $form;
                return;
            }
        }else{
        $form->populate($projectData);
        $this->view->form = $form;                      
        }
    } 
}



