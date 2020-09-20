<?php

class JBlac_Forms_Bssp_SearchApplication extends JBlac_Form
{
    
    public static $validateUnique = true;

    public function init()
    {    
        
        $number = new Zend_Form_Element_Text('applicationNumber');
        $number
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => '',
                    'maxlength' => '30',
                    'placeholder ' => 'Enter application number',
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->setRequired(false);
        $this->addElement($number);     
        
        $applicationDate = new Zend_Form_Element_Text('applicationDate');
        $applicationDate->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter date',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($applicationDate);
        
        $applicantName = new Zend_Form_Element_Text('applicantName');
        $applicantName->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter name',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($applicantName);
        
        $requestType = new Zend_Form_Element_Text('requestType');
        $requestType->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => '',
                    'disabled ' => 'disabled',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($requestType);
        
        $requestStatus = new Zend_Form_Element_Text('requestStatus');
        $requestStatus->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => '',
                    'disabled ' => 'disabled',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($requestStatus);
        
//        $status = new Zend_Form_Element_Select('requestStatus');
//        $lov = [
//                        '' => 'Select status',
//                        'APPROVED'  => 'Approved',                        
//                        'REJECTED'  => 'Rejected',
//                        'PENDING'  => 'Pending',
//                ];
//
//        $status->setMultiOptions($lov)
//                ->setAttribs(array(
//                    'class' => 'form-control selectric',
//                    'required' => false,
//                ));        
//        $this->addElement($status);                              
    }
}