<?php

class JBlac_Forms_Bssp_SubForms_Application extends Zend_Form_SubForm
{
    
    public static $validateUnique = true;

    public function init()
    {    
        $applicationId = new Zend_Form_Element_Hidden('applicationId');
        $applicationId->removeDecorator('Label'); 
        $this->addElement($applicationId);
        
        $applicationLegalEntityId= new Zend_Form_Element_Hidden('applicationLegalEntityId');
        $applicationLegalEntityId->removeDecorator('Label'); 
        $this->addElement($applicationLegalEntityId);
        
        $number = new Zend_Form_Element_Text('applicationNumber');
        $number->setLabel('Application number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => '',
                    'maxlength' => '30',
                    'readonly' => 'readonly',
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->setRequired(false);
        $this->addElement($number);     
        
        $applicationDate = new Zend_Form_Element_Text('applicationDate');
        $applicationDate->setLabel('Date of Application')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter date of application',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($applicationDate);

        $acknowledgementDate = new Zend_Form_Element_Text('applicationAcknowledgementDate');
        $acknowledgementDate->setLabel('Date of acknowledgement')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter date of acknowledgement',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($acknowledgementDate);
        
        $status = new Zend_Form_Element_Text('status');
        $status->setLabel('Application status')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter application status',
                    'maxlength' => '30',
                    'readonly' => 'readonly',
                ))
                ->setRequired(false)
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->setValue('PENDING');
        $this->addElement($status);                              
    }
}