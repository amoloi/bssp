<?php

class JBlac_Forms_Bssp_SearchBudget extends JBlac_Form
{
    
    public static $validateUnique = true;

    public function init()
    { 

        $number = new Zend_Form_Element_Text('budgetCode');
        $number
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => '',
                    'maxlength' => '30',
                    'placeholder ' => 'Enter code',
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->setRequired(false);
        $this->addElement($number);     
        
        $budgetPeriod = new Zend_Form_Element_Text('budgetPeriod');
        $budgetPeriod->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter period',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false)
                ->addFilter('StripTags')
                ->addFilter('stringTrim');
        $this->addElement($budgetPeriod);
        
        $budgetName = new Zend_Form_Element_Text('budgetName');
        $budgetName->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter name',
                    'maxlength' => '124'                    
                ))
                ->setRequired(false)
                ->addFilter('StripTags')
                ->addFilter('stringTrim')                ;
        $this->addElement($budgetName);
        
        $budgetAmount = new Zend_Form_Element_Text('budgetAmount');
        $budgetAmount->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => '',
                    'disabled ' => 'disabled',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false)
                ->addFilter('StripTags')
                ->addFilter('stringTrim')                ;
        $this->addElement($budgetAmount);                            
    }
}