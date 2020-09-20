<?php

class JBlac_Forms_Bssp_Promoter extends JBlac_Form
{
    
    public static $validateUnique = true;                          //STORE CURRENT OPERATION WETHER NEW ACCOUNT OR UPDATING

    public function init()
    {
        $this->setMethod('post');
        $promoterId = new Zend_Form_Element_Hidden('promoterId');
        $promoterId->setDecorators(['ViewHelper']);
        $addressId = new Zend_Form_Element_Hidden('addressId');
        $addressId->setDecorators(['ViewHelper']);
        
        $firstName = new Zend_Form_Element_Text('firstName');
        $firstName->setLabel('First name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter first name',
                    'maxlength' => '50'                    
                ))
                ->setRequired();
        $middleName = new Zend_Form_Element_Text('middleName');
        $middleName->setLabel('Middle name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter middle name',
                    'maxlength' => '50'                    
                ))
                ->setRequired(FALSE);
        
        $lastName = new Zend_Form_Element_Text('lastName');
        $lastName->setLabel('Last name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter last name',
                    'maxlength' => '50'                    
                ))
                ->setRequired();
        
        $identityNumber = new Zend_Form_Element_Text('identityNumber');
        $identityNumber->setLabel('Identity number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter identity number',
                    'maxlength' => '50'                    
                ))
                ->setRequired(FALSE);        

        $passportNumber = new Zend_Form_Element_Text('passportNumber');
        $passportNumber->setLabel('Passport number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter passport number',
                    'maxlength' => '50'                    
                ))
                ->setRequired(FALSE);        
        $dateOfBirth = new Zend_Form_Element_Text('dateOfBirth');
        $dateOfBirth->setLabel('Date of Birth')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter date of birth',
                    'maxlength' => '50'                    
                ))
                ->setRequired(FALSE);  
        
        $companyRegistrationNumber = new Zend_Form_Element_Text('companyRegistrationNumber');
        $companyRegistrationNumber->setLabel('Company Registration Number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter registration number',
                    'maxlength' => '50'                    
                ))
                ->setRequired(FALSE);          

        $companyName = new Zend_Form_Element_Text('companyName');
        $companyName->setLabel('Company Name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter company name',
                    'maxlength' => '50'                    
                ))
                ->setRequired(FALSE);   
        
        $promoterType = new Zend_Form_Element_Select('entityType');
        $promoterType->setLabel('Entity Type');
        $promoters = [
                        '' => 'Select entity',
                        'company' => 'Organization/Company Promoter',
                        'individual' => 'Individual Promoter',
                        'consultant' => 'Consultant',            
                ];

        $promoterType->setMultiOptions($promoters)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));         
        
        $remarks = new Zend_Form_Element_Textarea('remarks');
        $remarks->setLabel('Notice/Remarks')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter buyer notice',
                    'maxlength' => '4000'                    
                ))
                ->setRequired(FALSE);
        
        $telephone = new Zend_Form_Element_Text('telephoneNumber');
        $telephone->setLabel('Telephone number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter telephone number',
                    'maxlength' => '20'                    
                ))
                ->setRequired();
        $mobileNumber = new Zend_Form_Element_Text('mobileNumber');
        $mobileNumber->setLabel('Mobile number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter mobile number',
                    'maxlength' => '20'                    
                ))
                ->setRequired();        
        
        $facsimile = new Zend_Form_Element_Text('faxNumber');
        $facsimile->setLabel('Facsimile number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter fax number',
                    'maxlength' => '20'                    
                ))
                ->setRequired();        
        $email = new Zend_Form_Element_Text('emailAddress');
        $email->setLabel('E-mail address')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter E-mail address',
                    'maxlength' => '50'                    
                ))
                ->setRequired()
                ->addValidator(new Zend_Validate_EmailAddress(array('domain' => true)));
                //->addValidator(new Zend_Validate_Db_NoRecordExists(array('table' => 'SYS_USERS' ,'field' => 'USR_EMAIL')));
        
        /*
         * Address Details
         */
        $addressLineOne = new Zend_Form_Element_Text('addressLineOne');
        $addressLineOne->setLabel('Street address 1')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter street address 1',
                    'maxlength' => '50'                    
                ))
                ->setRequired();
        $addressLineTwo = new Zend_Form_Element_Text('addressLineTwo');
        $addressLineTwo->setLabel('Street address 2')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter street address 2',
                    'maxlength' => '50'                    
                ))
                ->setRequired();        
        $cityName = new Zend_Form_Element_Text('cityCode');
        $cityName->setLabel('City')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter city`s name',
                    'maxlength' => '50'                    
                ))
                ->setRequired();
        $postalAddress = new Zend_Form_Element_Text('postalAddress');
        $postalAddress->setLabel('Postal address')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter postal address',
                    'maxlength' => '120'                    
                ))
                ->setRequired();
        $region = new Zend_Form_Element_Text('regionCode');
        $region->setLabel('Region')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter region',
                    'maxlength' => '50'                    
                ))
                ->setRequired();         
        $country = new Zend_Form_Element_Select('countryCode');
        $country->setLabel('Country');

        $country->setMultiOptions(array(
            '' => 'Select one',
            'NAM' => 'Namibia',
            'TZ' => 'Tanzania',
            'ANG' => 'Angola'
        ))
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));
     
        /**
         * Add validation for unique email address and username 
         */
//              if(self::$validateUnique){
//                     $username->addValidator(new Zend_Validate_Db_NoRecordExists(array('table' => 'SYS_USERS' ,'field' => 'USR_USERNAME')));
//                     $email->addValidator(new Zend_Validate_Db_NoRecordExists(array('table' => 'SYS_USERS' ,'field' => 'USR_EMAIL')));
//                }
        
                $this->addElements(array(
                    $promoterId,
                    $firstName,
                    $middleName,
                    $lastName,
                    $dateOfBirth,
                    $identityNumber,
                    $passportNumber,
                    $remarks,
                    
                    $companyRegistrationNumber,
                    $companyName,
                    $promoterType,
                    
                    $telephone,
                    $facsimile,
                    $mobileNumber,
                    $email,
                    
                    $addressId,
                    $addressLineOne,
                    $addressLineTwo,
                    $cityName,
                    $postalAddress,
                    $region,
                    $country,
                ));
                
                
    }                

}