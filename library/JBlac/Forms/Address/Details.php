<?php

class JBlac_Forms_Address_Details extends JBlac_Form
{
    
    public static $validateUnique = true;                          //STORE CURRENT OPERATION WETHER NEW ACCOUNT OR UPDATING

    public function init()
    {
        $this->setMethod('post');
        $employerId = new Zend_Form_Element_Text('EMPL_ID');
        $employerId->setLabel('Employer`s name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter employer`s name',
                    'maxlength' => '15'                    
                ))
                ->setRequired(true);
        $employeeId = new Zend_Form_Element_Text('EMP_ID');
        $employeeId->setLabel('Employee`s name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter employee`s name',
                    'maxlength' => '15'                    
                ))
                ->setRequired(true);        
                
        $addressLineOne = new Zend_Form_Element_Text('ADDRESS_LINE_1');
        $addressLineOne->setLabel('Address line 1')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter address line 1',
                    'maxlength' => '50'                    
                ))
                ->setRequired();
        $addressLineTwo = new Zend_Form_Element_Text('ADDRESS_LINE_2');
        $addressLineTwo->setLabel('Address line 2')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter address line 2',
                    'maxlength' => '50'                    
                ))
                ->setRequired();        
        $cityName = new Zend_Form_Element_Text('CITY_TOWN');
        $cityName->setLabel('City')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter city`s name',
                    'maxlength' => '50'                    
                ))
                ->setRequired();
        $postalAddress = new Zend_Form_Element_Text('PO_BOX');
        $postalAddress->setLabel('Postal address')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter postal address',
                    'maxlength' => '30'                    
                ))
                ->setRequired();
        $region = new Zend_Form_Element_Text('REGION');
        $region->setLabel('Region')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter region',
                    'maxlength' => '50'                    
                ))
                ->setRequired();         
        $country = new Zend_Form_Element_Select('COUNTRY');
        $country->setLabel('Country');

        $country->setMultiOptions(array(
            '' => 'Select one',
            'NAM' => 'Namibia',
            'TZ' => 'Tanzania',
            'ANG' => 'Angola'
        ))
                ->setAttribs(array(
                    'class' => 'form-control',
                    'required' => true,
                ));     
       
        
        $button = new Zend_Form_Element_Button('cmdsave');
        
        $button->setLabel('Submit employee`s details')
                ->setAttribs(array(
                    'class' => 'btn btn-primary',
                    'type' => 'submit'
                ));        
        /**
         * Add validation for unique email address and username 
         */
//              if(self::$validateUnique){
//                     $username->addValidator(new Zend_Validate_Db_NoRecordExists(array('table' => 'SYS_USERS' ,'field' => 'USR_USERNAME')));
//                     $email->addValidator(new Zend_Validate_Db_NoRecordExists(array('table' => 'SYS_USERS' ,'field' => 'USR_EMAIL')));
//                }
        
                $this->addElements(array(
                    $employeeId,
                    $employerId,
                    $addressLineOne,
                    $addressLineTwo,
                    $postalAddress,
                    $cityName,
                    $region,
                    $country,

                    $button,
                ));
    }


}