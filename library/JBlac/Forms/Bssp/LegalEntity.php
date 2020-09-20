<?php

class JBlac_Forms_Bssp_LegalEntity extends JBlac_Form
{
    
    public static $validateUnique = true;                          //STORE CURRENT OPERATION WETHER NEW ACCOUNT OR UPDATING
    private $elementDecorators = array(
                             'Zend_Form_Element_Radio' => array (
                                 'Label',
                                 'ViewHelper',
                                 array (array ('data' => 'HtmlTag'), array ('tag' => 'div', 'class' => 'radio')),
                                 array (array ('row' => 'HtmlTag'), array ('tag' => 'li')),
                             ),
    );
    
    public $decorators = array (
                             'Zend_Form_Element_Submit' => array (
                                 'ViewHelper',
                                 array (array ('data' => 'HtmlTag'), array ('tag' => 'div', 'class' => 'button')),
                                 array (array ('row' => 'HtmlTag'), array ('tag' => 'li')),
                             ),
                             'Zend_Form_Element_Captcha' => array (
                                 'Label',
                                 array (array ('row' => 'HtmlTag'), array ('tag' => 'li'))
                             ),
                             'Zend_Form_Element_Checkbox' => array (
                                 'Label',
                                 'ViewHelper',
                                 array (array ('data' => 'HtmlTag'), array ('tag' => 'div', 'class' => 'checkbox')),
                                 array (array ('row' => 'HtmlTag'), array ('tag' => 'li')),
                             ),
                             'Zend_Form_Element_Radio' => array (
                                 'Label',
                                 'ViewHelper',
                                 array (array ('data' => 'HtmlTag'), array ('tag' => 'div', 'class' => 'radio')),
                                 array (array ('row' => 'HtmlTag'), array ('tag' => 'li')),
                             ),
                             'Zend_Form_Element' => array (
                                 'ViewHelper',
                                 array (array ('data' => 'HtmlTag'), array ('tag' => 'div', 'class' => 'element')),
                                 'Label',
                                 array (array ('row' => 'HtmlTag'), array ('tag' => 'li')),
                             ),
                             'Zend_Form' => array (
                                 'FormErrors',
                                 'FormElements',
                                 array ('HtmlTag', array ('tag' => 'ol')),
                                 'Form'
                             ),
                         );    
    
    public function init()
    {
        $this->setMethod('post');
        $legalEntityId = new Zend_Form_Element_Hidden('legalEntityId');
        $legalEntityId->setDecorators(['ViewHelper']);
        
        $addressId = new Zend_Form_Element_Hidden('addressId');
        $addressId->setDecorators(['ViewHelper']);
        $this->addElement($addressId);
        
        
        $entityCategory = new Zend_Form_Element_Hidden('entityCategory');
        $entityCategory->setDecorators(['ViewHelper']);
        
        $addressId = new Zend_Form_Element_Hidden('addressId');
        $addressId->setDecorators(['ViewHelper']);
        
        $firstName = new Zend_Form_Element_Text('firstName');
        $firstName->setLabel('First name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter first name',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $middleName = new Zend_Form_Element_Text('middleName');
        $middleName->setLabel('Middle name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter middle name',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        
        $lastName = new Zend_Form_Element_Text('lastName');
        $lastName->setLabel('Last name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter last name',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        
        $identityNumber = new Zend_Form_Element_Text('identityNumber');
        $identityNumber->setLabel('Identity number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter identity number',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);        

        $passportNumber = new Zend_Form_Element_Text('passportNumber');
        $passportNumber->setLabel('Passport number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter passport number',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);        
        $dateOfBirth = new Zend_Form_Element_Text('dateOfBirth');
        $dateOfBirth->setLabel('Date of Birth')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter date of birth',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);  
        
        $companyRegistrationNumber = new Zend_Form_Element_Text('companyRegistrationNumber');
        $companyRegistrationNumber->setLabel('Company Registration Number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter registration number',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);          

        $companyName = new Zend_Form_Element_Text('companyName');
        $companyName->setLabel('Company Name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter company name',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        
        $entityType = new Zend_Form_Element_Select('entityType');
        $entityType->setLabel('Entity Type');
        $promoters = [
                        '' => 'Select one',
                        'company' => 'Organization/Company',
                        'person' => 'Individual Person',          
                ];

//        $entityType->setMultiOptions($promoters)
//                ->setAttribs(array(
//                    'class' => 'form-control no-selectric',
//                ));

        $entityType->setMultiOptions($promoters)
                ->setAttribs(array(
                    'class' => 'form-control',
                ))->setRequired(true);
        
//        $this->addElement('radio', 'entity', [
//            'label' => 'Entity type',
//            'separator' => '',
////            'decorators'=>  $this->elementDecorators,
//            'multiOptions' => [
//                        'company' => 'Organization/Company',
//                        'person' => 'Individual Person',                
//            ]
//        ]);
        
        $remarks = new Zend_Form_Element_Textarea('remarks');
        $remarks->setLabel('Notice/Remarks')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter buyer notice',
                    'maxlength' => '4000'                    
                ))
                ->setRequired(false);
        
        $telephone = new Zend_Form_Element_Text('telephoneNumber');
        $telephone->setLabel('Telephone number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter telephone number',
                    'maxlength' => '20'                    
                ))
                ->setRequired(false);
        $mobileNumber = new Zend_Form_Element_Text('mobileNumber');
        $mobileNumber->setLabel('Mobile number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter mobile number',
                    'maxlength' => '20'                    
                ))
                ->setRequired(false);        
        
        $facsimile = new Zend_Form_Element_Text('faxNumber');
        $facsimile->setLabel('Facsimile number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter fax number',
                    'maxlength' => '20'                    
                ))
                ->setRequired(false);        
        $email = new Zend_Form_Element_Text('emailAddress');
        $email->setLabel('E-mail address')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter E-mail address',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false)
                ->addValidator(new Zend_Validate_EmailAddress(array('domain' => true)));
                //->addValidator(new Zend_Validate_Db_NoRecordExists(array('table' => 'SYS_USERS' ,'field' => 'USR_EMAIL')));
        
        /*
         * Address Details
         */
        $addressLineOne = new Zend_Form_Element_Text('addressLineOne');
        $addressLineOne->setLabel('Physical/Street address')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter street address 1',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $addressLineTwo = new Zend_Form_Element_Text('addressLineTwo');
        $addressLineTwo->setLabel('Street address 2')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter street address 2',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        
        $cityName = new Zend_Form_Element_Select('cityCode');
        $cityName->setLabel('City/Town');
        $codes = []; //$codes = JBlac_Utilities_AppReference::fetchTowns('KHOMAS');
        $codes[''] = ' Select region first...';
        $cityName->setMultiOptions($codes)
                ->setValue('')
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ))->setRegisterInArrayValidator(false)
                ->removeValidator('InArray');
        
        $constituencyCode = new Zend_Form_Element_Select('constituencyCode');
        $constituencyCode->setLabel('Constituency');
        $codes = [];// JBlac_Utilities_AppReference::fetchConstituences('WINDHOEK');
        $codes[''] = ' Select town first...';
        array_push($codes, ['Not Defined' => 'Not Defined']);
        $constituencyCode->setMultiOptions($codes)
                ->setValue('')
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ))->setRegisterInArrayValidator(false)
                ->removeValidator('InArray');        
        
        $postalAddress = new Zend_Form_Element_Text('postalAddress');
        $postalAddress->setLabel('Postal address')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter postal address',
                    'maxlength' => '120'                    
                ))
                ->setRequired(false);

        $region = new Zend_Form_Element_Select('regionCode');
        $region->setLabel('Region');
        $codes = JBlac_Utilities_AppReference::getRegions();
        $codes[''] = ' Select one...';
        $region->setMultiOptions($codes)
                ->setValue('')
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ))->setRegisterInArrayValidator(false)
                ->removeValidator('InArray');        
        
        $country = new Zend_Form_Element_Select('countryCode');
        $country->setLabel('Country');
        $codes = JBlac_Utilities_AppReference::getCountries();

        $country->setMultiOptions($codes)
                ->setValue('NAM')
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ))->setRegisterInArrayValidator(false);
     
                $this->addElements(array(
                    $legalEntityId,
                    $entityCategory,
                    $firstName,
                    $middleName,
                    $lastName,
                    $dateOfBirth,
                    $identityNumber,
                    $passportNumber,
                    $remarks,
                    
                    $companyRegistrationNumber,
                    $companyName,
                    $entityType,
                    
                    $telephone,
                    $facsimile,
                    $mobileNumber,
                    $email,
                    
                    $addressId,
                    $addressLineOne,
                    $addressLineTwo,
                    $cityName,
                    $constituencyCode,
                    $postalAddress,
                    $region,
                    $country,
                ));
                
                
    }                

}