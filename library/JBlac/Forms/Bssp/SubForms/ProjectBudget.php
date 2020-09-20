<?php

class JBlac_Forms_Bssp_SubForms_ProjectBudget extends Zend_Form_SubForm
{
    public function init()
    {    
        $fundsId = new Zend_Form_Element_Hidden('projectBudgetId');
        $fundsId->removeDecorator('Label');
        $this->addElement($fundsId);
        $budgetNumber = new Zend_Form_Element_Hidden('budgetNumber');
        $budgetNumber->removeDecorator('Label');
        $this->addElement($budgetNumber);        
        
        $projectNumber = new Zend_Form_Element_Hidden('projectNumber');
        $projectNumber->removeDecorator('Label');
        
        $this->addElement($projectNumber);
        
        /*
         * Budget related info
         */
        $budget = new Zend_Form_Element_Select('masterBudgetNumber');
        $budget->setLabel('Financal Year Budget');
        $lov = JBlac_Utilities_Project::fetchBudgetsLOV();
        $lov[''] = ' Select budget';
        $budget->setMultiOptions($lov)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ))->setValue('')
                ->setRequired(false)
                ->addFilter('StripTags')
                ->addFilter('stringTrim');
        
        $this->addElement($budget);
        
        $budgetName = new Zend_Form_Element_Text('budgetName');
        $budgetName->setLabel('Budget Name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter budget name',
                    'maxlength' => '100'                    
                ))
                ->setRequired(false)
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->addValidator('Db_NoRecordExists' , false , [
                    'table' => 'funds',
                    'field' => 'name',
                ]);
        
                $this->addElement($budgetName);
        
        $budgetAmount = new Zend_Form_Element_Text('budgetAmount');
        $budgetAmount->setLabel('Budget Amount')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter budget amount',
                    'maxlength' => '12'                    
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->addFilter('Digits');
        $this->addElement($budgetAmount);

        $budgetOutstandingAmount = new Zend_Form_Element_Text('budgetOutstandingAmount');
        $budgetOutstandingAmount->setLabel('Outstanding Amount')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'readonly' => 'readonly',
                    'placeholder ' => '',
                    'maxlength' => '12'                    
                ))
                ->setRequired(false)
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->addFilter('Digits');
        $this->addElement($budgetOutstandingAmount);
        
        $budgetDateOfApproval = new Zend_Form_Element_Text('budgetDateOfApproval');
        $budgetDateOfApproval->setLabel('Date of Budget Approval')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter date of approval',
                    'maxlength' => '12'                    
                ))
                ->setRequired();
        $this->addElement($budgetDateOfApproval);
        
        $budgetRemarks = new Zend_Form_Element_Textarea('budgetRemarks');
        $budgetRemarks->setLabel('Budget Remarks')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder ' => 'Enter budget remarks',                  
                ))
                ->setRequired(false);
        
        $this->addElement($budgetRemarks);
                              
    }
}