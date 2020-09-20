<?php

class JBlac_Forms_Bssp_SearchConsultants extends JBlac_Form
{
    
    public static $validateUnique = true;

    public function init()
    {    
        
        $entityCategory = new Zend_Form_Element_Hidden('entityCategory');
        $entityCategory
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => '',
                    'maxlength' => '30',
                    'placeholder ' => 'Enter number',
                ))->setValue('consultant')
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->setRequired(false);
        $this->addElement($entityCategory);     
        
        $legalEntityName = new Zend_Form_Element_Text('legalEntityName');
        $legalEntityName->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter name',
                    'maxlength' => '50'                    
                ))
                ->addFilter('StripTags')
                ->addFilter('stringTrim')                
                ->setRequired(false);
        
        $this->addElement($legalEntityName);
                                  
    }
}