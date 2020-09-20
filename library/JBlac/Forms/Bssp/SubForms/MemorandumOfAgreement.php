<?php

class JBlac_Forms_Bssp_SubForms_MemorandumOfAgreement extends Zend_Form_SubForm
{

    public function init()
    {
        $id = new Zend_Form_Element_Hidden('mou_id');
        $id->setDecorators(['ViewHelper']);
        
        $this->addElement($id);
        
        $startDate = new Zend_Form_Element_Text('signedDate');
        $startDate->setLabel('Signed date')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter signed date',
                    'maxlength' => '12'                    
                ))
                ->setRequired(true);
        $this->addElement($startDate);
        
        $endDate = new Zend_Form_Element_Text('completionDate');
        $endDate->setLabel('Completion date')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter completion date',
                    'maxlength' => '12'                    
                ))
                ->setRequired(false);
        
        $this->addElement($endDate);
                               
    }                

}