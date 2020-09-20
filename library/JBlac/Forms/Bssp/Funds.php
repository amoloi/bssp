<?php

class JBlac_Forms_Bssp_Funds extends JBlac_Form
{
    
    public static $validateUnique = true;

    public function init()
    {    
        $fundsId = new Zend_Form_Element_Hidden('id');
        $fundsId->removeDecorator('Label');

        /*
         * Budget related info
         */
        $budget = new Zend_Form_Element_Select('budget');
        $budget->setLabel('Budget Allocated');
        $lov = JBlac_Utilities_Project::fetchBudgetsLOV();

        $budget->setMultiOptions($lov)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ))
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('stringTrim');
        
        $this->addElement($budget);
        
        $fundsName = new Zend_Form_Element_Text('name');
        $fundsName->setLabel('Funds Name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter funds name',
                    'maxlength' => '100'                    
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->addValidator('Db_NoRecordExists' , FALSE , [
                    'table' => 'funds',
                    'field' => 'name',
                ]);        
        
        $initialAmount = new Zend_Form_Element_Text('initialAmount');
        $initialAmount->setLabel('Initial Amount')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter initial amount',
                    'maxlength' => '12'                    
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->addFilter('Digits');

        $outstandingAmount = new Zend_Form_Element_Text('outstandingAmount');
        $outstandingAmount->setLabel('Outstanding Amount')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'readonly' => 'readonly',
                    'placeholder ' => 'Enter outstanding amount',
                    'maxlength' => '12'                    
                ))
                ->setRequired(FALSE)
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->addFilter('Digits');
        
        $dateOfApproval = new Zend_Form_Element_Text('dateOfApproval');
        $dateOfApproval->setLabel('Date Of Approval')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter date of approval',
                    'maxlength' => '12'                    
                ))
                ->setRequired();
        
        $fundsRemarks = new Zend_Form_Element_Textarea('remarks');
        $fundsRemarks->setLabel('Funds Remarks')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder ' => 'Enter funds remarks',                  
                ))
                ->setRequired(FALSE);

           $this->addElements(array(
                    $fundsId,
                    $fundsName,
                    $initialAmount,
                    $outstandingAmount,
                    $dateOfApproval,               
                    $fundsRemarks,
                ));                               
    }
}