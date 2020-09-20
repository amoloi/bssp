<?php

class JBlac_Forms_Bssp_SubForms_LegalEntity extends Zend_Form_SubForm
{
    public function init()
    {
        $this->setDecorators(
                [
                    [
                        'viewScript',
                        [
                            'viewScript' => 'forms/legal-entity.phtml'
                        ]
                    ]
                ]);
        
        $entityCategory = new Zend_Form_Element_Hidden('entityCategory');
        $entityCategory->setDecorators(['ViewHelper']);
        
        $this->addElement($entityCategory);
        
        $firstName = new Zend_Form_Element_Text('firstName');
        $firstName->setLabel('First name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter first name',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($firstName);
        
        $middleName = new Zend_Form_Element_Text('middleName');
        $middleName->setLabel('Middle name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter middle name',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($middleName);
        
        $lastName = new Zend_Form_Element_Text('lastName');
        $lastName->setLabel('Last name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter last name',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($lastName);
        
        $identityNumber = new Zend_Form_Element_Text('identityNumber');
        $identityNumber->setLabel('Identity number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter identity number',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($identityNumber);

        $passportNumber = new Zend_Form_Element_Text('passportNumber');
        $passportNumber->setLabel('Passport number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter passport number',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false); 
        $this->addElement($passportNumber);
        
        $dateOfBirth = new Zend_Form_Element_Text('dateOfBirth');
        $dateOfBirth->setLabel('Date of Birth')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter date of birth',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($dateOfBirth);
        
        $companyRegistrationNumber = new Zend_Form_Element_Text('companyRegistrationNumber');
        $companyRegistrationNumber->setLabel('Company Registration Number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter registration number',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($companyRegistrationNumber);

        $companyName = new Zend_Form_Element_Text('companyName');
        $companyName->setLabel('Company Name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter company name',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        $this->addElement($companyName);
        
        $entityType = new Zend_Form_Element_Select('entityType');
        $entityType->setLabel('Entity Type');
        $promoters = [
                        '' => 'Select one',
                        'company' => 'Organization/Company',
                        'person' => 'Individual Person',          
                ];

        $entityType->setMultiOptions($promoters)
                ->setAttribs(array(
                    'class' => 'form-control no-selectric',
                    'required' => true,
                ));
        $this->addElement($entityType);
        
        $remarks = new Zend_Form_Element_Textarea('remarks');
        $remarks->setLabel('Notice/Remarks')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter buyer notice',
                    'maxlength' => '4000'                    
                ))
                ->setRequired(false);
        $this->addElement($remarks);
        
        $telephone = new Zend_Form_Element_Text('telephoneNumber');
        $telephone->setLabel('Telephone number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter telephone number',
                    'maxlength' => '20'                    
                ))
                ->setRequired();
        $this->addElement($telephone);
        
        $mobileNumber = new Zend_Form_Element_Text('mobileNumber');
        $mobileNumber->setLabel('Mobile number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter mobile number',
                    'maxlength' => '20'                    
                ))
                ->setRequired();
        $this->addElement($mobileNumber);
        
        $facsimile = new Zend_Form_Element_Text('faxNumber');
        $facsimile->setLabel('Facsimile number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter fax number',
                    'maxlength' => '20'                    
                ))
                ->setRequired();
        $this->addElement($facsimile);
        
        $email = new Zend_Form_Element_Text('emailAddress');
        $email->setLabel('E-mail address')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter E-mail address',
                    'maxlength' => '50'                    
                ))
                ->setRequired()
                ->addValidator(new Zend_Validate_EmailAddress(array('domain' => true)));
        $this->addElement($email);

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
        $this->addElement($addressLineOne);
        
        $addressLineTwo = new Zend_Form_Element_Text('addressLineTwo');
        $addressLineTwo->setLabel('Street address 2')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter street address 2',
                    'maxlength' => '50'                    
                ))
                ->setRequired();
        $this->addElement($addressLineTwo);
        
        $cityName = new Zend_Form_Element_Select('cityCode');
        $cityName->setLabel('City/Town');
        $codes = $codes = JBlac_Utilities_AppReference::fetchTowns('KHOMAS');

        $cityName->setMultiOptions($codes)
                ->setValue('')
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));
        $this->addElement($cityName);
        
        $constituencyCode = new Zend_Form_Element_Select('constituencyCode');
        $constituencyCode->setLabel('Constituency');
        $codes = JBlac_Utilities_AppReference::fetchConstituences('WINDHOEK');

        $constituencyCode->setMultiOptions($codes)
                ->setValue('')
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));
        $this->addElement($constituencyCode);
        
        $postalAddress = new Zend_Form_Element_Text('postalAddress');
        $postalAddress->setLabel('Postal address')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter postal address',
                    'maxlength' => '120'                    
                ))
                ->setRequired();
        $this->addElement($postalAddress);
        
        
        $region = new Zend_Form_Element_Select('regionCode');
        $region->setLabel('Region');
        $codes = JBlac_Utilities_AppReference::getRegions();

        $region->setMultiOptions($codes)
                ->setValue('KHOMAS')
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));        
        $this->addElement($region);
        
        $country = new Zend_Form_Element_Select('countryCode');
        $country->setLabel('Country');
        $codes = JBlac_Utilities_AppReference::getCountries();

        $country->setMultiOptions($codes)
                ->setValue('NAM')
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));
        $this->addElement($country);    
    }                

}