<?php

class JBlac_Forms_Bssp_Project extends JBlac_Form
{
    
    public static $validateUnique = true;                          //STORE CURRENT OPERATION WETHER NEW ACCOUNT OR UPDATING

    public function init()
    {
        $this->setMethod('post');
        $id = new Zend_Form_Element_Hidden('id');
        $id->setDecorators(['ViewHelper']);
        
        $projectNumber = new Zend_Form_Element_Hidden('number');
        $projectNumber->setDecorators(['ViewHelper']);
       
//        $applicationId = new Zend_Form_Element_Hidden('applicationId');
//        $applicationId->setDecorators(['ViewHelper']);
        $applicationId = new Zend_Form_Element_Select('applicationId');
        $applicationId->setLabel('Application to be defined as a project');
        $codes = JBlac_Utilities_AppReference::fetchApplicationsLOV();

        $applicationId->setMultiOptions($codes)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));     
                       
        $projectName = new Zend_Form_Element_Text('name');
        $projectName->setLabel('Project name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter project name',
                    'maxlength' => '120'                    
                ))
                ->setRequired(FALSE);
        
        $projectTasks = new Zend_Form_Element_Text('tasks');
        $projectTasks->setLabel('Enter project tasks')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter project tasks',
                    'maxlength' => '3000'                    
                ))
                ->setRequired(FALSE);
        
        $projectTasks = new Zend_Form_Element_Textarea('tasks');
        $projectTasks->setLabel('Enter project tasks')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'rows' => 2,
                    'placeholder ' => 'Enter project description',
                    'maxlength' => '4000'                    
                ))
                ->setRequired(FALSE);        
        
        $projectStatus = new Zend_Form_Element_Select('status');
        $projectStatus->setLabel('Project status');
//        $codes = JBlac_Utilities_AppReference::getCountries();

        $projectStatus->setMultiOptions([
            'new' => 'New Project',
            'active' => 'Active Project',
            'complete' => 'Completed Project',
            'extended' => 'Extended Project',
            'terminated' => 'Terminated Project',
        ])
                ->setValue('new')
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));     
               
        $description = new Zend_Form_Element_Textarea('description');
        $description->setLabel('Project Description')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder ' => 'Enter project description',
                    'maxlength' => '4000'                    
                ))
                ->setRequired(FALSE);
        $startDate = new Zend_Form_Element_Text('startDate');
        $startDate->setLabel('Start date')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter start date',
                    'maxlength' => '12'                    
                ))
                ->setRequired();
        $endDate = new Zend_Form_Element_Text('endDate');
        $endDate->setLabel('End date')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter end date',
                    'maxlength' => '12'                    
                ))
                ->setRequired();        
                $this->addElements(array(
                    $id,
                    $applicationId,
                    $projectName,
                    $projectNumber,
                    $projectTasks,
                    $projectStatus,
                    $description,
                    $startDate,
                    $endDate,
                    
                ));
                               
    }                

}