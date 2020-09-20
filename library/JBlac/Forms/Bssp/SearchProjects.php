<?php

class JBlac_Forms_Bssp_SearchProjects extends JBlac_Form
{
    
    public static $validateUnique = true;

    public function init()
    {    
        
        $number = new Zend_Form_Element_Text('projectNumber');
        $number
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => '',
                    'maxlength' => '30',
                    'placeholder ' => 'Enter number',
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->setRequired(false);
        $this->addElement($number);     
        
        $startDate = new Zend_Form_Element_Text('startDate');
        $startDate->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => '',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($startDate);
        
        $projectName = new Zend_Form_Element_Text('projectName');
        $projectName->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter name',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($projectName);
        
        $projectStatus = new Zend_Form_Element_Text('projectStatus');
        $projectStatus->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => '',
                    'disabled ' => 'disabled',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($projectStatus);                            
    }
}