<?php

class Projects_CreateController extends JBlac_Controller_Action
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
        $form = new JBlac_Forms_Bssp_Project();
        $form->removeElement('id');
        $this->view->form = $form;
        
        $objEntity = new Projects_Model_Project();

        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $objEntityMapper = new Projects_Model_ProjectMapper('Projects_Model_DbTable_Project');
                $objEntity->setName($this->getRequest()->getPost('name'))
                          ->setNumber(JBlac_Utilities_Project::getProjectNumber())
                          ->setStatus($this->getRequest()->getPost('status'))
                          ->setTasks($this->getRequest()->getPost('tasks'))
                          ->setDescription($this->getRequest()->getPost('description'))
                          ->setStartDate(JBlac_Utilities_Date::getMySQLDefault($this->getRequest()->getPost('startDate')))
                          ->setEndDate(JBlac_Utilities_Date::getMySQLDefault($this->getRequest()->getPost('endDate'))) 
                          ->setApplicationId($this->getRequest()->getPost('applicationId'))
                          ->setCreatedBy('SYSTEM');
                
                try{
                    
                    $entityId = $objEntityMapper->save($objEntity);
                    
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
                $this->_flashMessenger->addMessage(array('message' => "A new project with project number <strong>{$objEntity->getNumber()}</strong> has been created.", 'status' => 'success'));                
                $this->_redirect('/projects/');
            }else{
                $this->_flashMessenger->addMessage(array('message' => 'A project could not be created.', 'status' => 'error'));
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
        $objMapper = new Promoters_Model_PromoterMapper('Promoters_Model_DbTable_Promoter');
        $applicationData = $objMapper->delete($id);
        $this->_redirect('/promoters/');
    }
}