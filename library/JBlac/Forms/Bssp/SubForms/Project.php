<?php

class JBlac_Forms_Bssp_SubForms_Project extends Zend_Form_SubForm
{
    
    public static $validateUnique = true;                          //STORE CURRENT OPERATION WETHER NEW ACCOUNT OR UPDATING

    public function init()
    {    
                       
        $projectName = new Zend_Form_Element_Text('projectName');
        $projectName->setLabel('Project name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter project name',
                    'maxlength' => '120'                    
                ))
                ->setRequired(false);
        $this->addElement($projectName);
        
        $projectDescription = new Zend_Form_Element_Textarea('projectDescription');
        $projectDescription->setLabel('Project description')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'rows' => 2,
                    'placeholder ' => 'Enter project description',
                    'maxlength' => '4000'                    
                ))
                ->setRequired(false);
        $this->addElement($projectDescription);        
        
        $projectStatus = new Zend_Form_Element_Select('projectStatus');
        $projectStatus->setLabel('Project status');
//        $codes = JBlac_Utilities_AppReference::getCountries();

        $projectStatus->setMultiOptions([
            'NEW' => 'New Project',
            'ACTIVE' => 'Active Project',
            'COMPLETE' => 'Completed Project',
            'EXTENDED' => 'Extended Project',
            'TERMINATED' => 'Terminated Project',
        ])
                ->setValue('new')
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));     
        $this->addElement($projectStatus);
        
        $startDate = new Zend_Form_Element_Text('startDate');
        $startDate->setLabel('Project start date')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter start date',
                    'maxlength' => '12'                    
                ))
                ->setRequired(false);
        $this->addElement($startDate);
        
        $endDate = new Zend_Form_Element_Text('endDate');
        $endDate->setLabel('Project completion date')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter end date',
                    'maxlength' => '12'                    
                ))
                ->setRequired(false);
        
        $this->addElement($endDate);
                               
    }                

}