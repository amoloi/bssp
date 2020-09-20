<?php

class JBlac_Forms_Bssp_Budget extends JBlac_Form
{
    
    public function init()
    {    
        $id = new Zend_Form_Element_Hidden('id');
        $id->removeDecorator('Label');
        
        $this->addElement($id);

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Budget Name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter budget name',
                    'maxlength' => '128',
                    'required' => 'required'
                ))
                ->setRequired(TRUE)
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->addValidator('Db_NoRecordExists' , FALSE , [
                    'table' => 'bssp_master_budgets',
                    'field' => 'name',
                ]);
        
        $this->addElement($name);

        $code = new Zend_Form_Element_Text('code');
        $code->setLabel('Budget Code')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter budget code',
                    'maxlength' => '128',
                    'readonly' => 'readonly',
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->addValidator('Db_NoRecordExists' , FALSE , [
                    'table' => 'bssp_master_budgets',
                    'field' => 'code',
                ]);
        
        $this->addElement($code);
        
        $period = new Zend_Form_Element_Select('period');
        $period->setLabel('Budget Period');
        $lov = JBlac_Utilities_Project::getBudgetPeriods(2000);
        $lov[''] = ' Select period...';
        $period->setMultiOptions($lov)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ))
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->addValidator('Db_NoRecordExists' , FALSE , [
                    'table' => 'bssp_master_budgets',
                    'field' => 'period',
                ])
                ->setValue('');
        $this->addElement($period);
        
        
        $amount = new Zend_Form_Element_Text('amount');
        $amount->setLabel('Budget Amount')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter budget amount',
                    'maxlength' => '12',
                    'required' => 'required'
                ))
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->addFilter('Digits');
        
        $this->addElement($amount);

        $description = new Zend_Form_Element_Textarea('description');
        $description->setLabel('Budget Description')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder ' => 'Enter budget description',                  
                ))
                ->setRequired(FALSE)
                ->addFilter('StripTags')
                ->addFilter('stringTrim');
        
        $this->addElement($description);
        
        $GLAccount = new Zend_Form_Element_Text('GLAccount');
        $GLAccount->setLabel('GL Account')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter GL Account',                  
                ))
                ->setRequired(FALSE)
                ->addFilter('StripTags')
                ->addFilter('stringTrim');
        
        $this->addElement($GLAccount);        
                                      
    }
}