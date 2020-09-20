<?php

class JBlac_Forms_Bssp_Application extends JBlac_Form
{
    
    public static $validateUnique = true;

    public function init()
    {    
        $auctionId = new Zend_Form_Element_Hidden('id');
        $auctionId->removeDecorator('Label');

        $promoter = new Zend_Form_Element_Select('promoter');
        $promoter->setLabel('Promoter Name');
        $promoters = JBlac_Models_LegalEntityMapper::fetchEntityLOV('promoter');
        $promoter->setMultiOptions($promoters)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                )); 
        $newPromoter = $this->addElement('note' , 'newPromoter' , [
            'value' => '<a href="javascript:;" class="btn" id="addCompany">Create Promoter</a>',
        ]);
        $businessName = new Zend_Form_Element_Text('businessName');
        $businessName->setLabel('Business Name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter business name',
                    'maxlength' => '30'                    
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim');      
         
        /**
         * Contact Details
         */
        
        $telephoneNumber = new Zend_Form_Element_Text('telephoneNumber');
        $telephoneNumber->setLabel('TelephoneNumber')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter business name',
                    'maxlength' => '30'                    
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim');
        
        $telephoneNumber = new Zend_Form_Element_Text('telephoneNumber');
        $telephoneNumber->setLabel('Telephone Number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter telephone number',
                    'maxlength' => '30'                    
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim');
        
        $mobileNumber = new Zend_Form_Element_Text('mobileNumber');
        $mobileNumber->setLabel('Mobile Number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter mobile number',
                    'maxlength' => '30'                    
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim');
        
        $faxNumber = new Zend_Form_Element_Text('faxNumber');
        $faxNumber->setLabel('Fax Number')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter fax number',
                    'maxlength' => '30'                    
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim');
        $emailAddress = new Zend_Form_Element_Text('emailAddress');
        $emailAddress->setLabel('E-mail Address')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter e-mail',
                    'maxlength' => '30'                    
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim');
        
        $postalAddress = new Zend_Form_Element_Text('postalAddress');
        $postalAddress->setLabel('Enter postal address')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter e-mail',
                    'maxlength' => '128'                    
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim'); 
        
        $residentialAddress = new Zend_Form_Element_Text('residentialAddress');
        $residentialAddress->setLabel('Residential address')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter residential address',
                    'maxlength' => '128'                    
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim');
        
        $region = new Zend_Form_Element_Select('region');
        $region->setLabel('Region');
        $regions = [
                    '' => 'Select region',
                '!KARAS' => '!KARAS REGION',
                'ERONGO' => 'ERONGO REGION',
                'HARDAP' => 'HARDAP REGION',
                'KAVANGO EAST' => 'KAVANGO EAST REGION',
                'KAVANGO WEST' => 'KAVANGO WEST REGION',
                'KHOMAS' => 'KHOMAS REGION',
                'KUNENE' => 'KUNENE REGION',
                'OHANGWENA' => 'OHANGWENA REGION',
                'OMAHEKE' => 'OMAHEKE REGION',
                'OMUSATI' => 'OMUSATI REGION',
                'OSHANA' =>  'OSHANA REGION',
                'OSHIKOTO' => 'OSHIKOTO REGION',
                'OTJOZONDJUPA' => 'OTJOZONDJUPA REGION',
                'ZAMBEZI' => 'ZAMBEZI REGION',         
                ];
        $region->setMultiOptions($regions)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));         

        $region = new Zend_Form_Element_Select('region');
        $region->setLabel('Region');
        $regions = [
                    '' => 'Select region',
                '!KARAS' => '!KARAS REGION',
                'ERONGO' => 'ERONGO REGION',
                'HARDAP' => 'HARDAP REGION',
                'KAVANGO EAST' => 'KAVANGO EAST REGION',
                'KAVANGO WEST' => 'KAVANGO WEST REGION',
                'KHOMAS' => 'KHOMAS REGION',
                'KUNENE' => 'KUNENE REGION',
                'OHANGWENA' => 'OHANGWENA REGION',
                'OMAHEKE' => 'OMAHEKE REGION',
                'OMUSATI' => 'OMUSATI REGION',
                'OSHANA' =>  'OSHANA REGION',
                'OSHIKOTO' => 'OSHIKOTO REGION',
                'OTJOZONDJUPA' => 'OTJOZONDJUPA REGION',
                'ZAMBEZI' => 'ZAMBEZI REGION',         
                ];
        $region->setMultiOptions($regions)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));
        
        $town = new Zend_Form_Element_Select('town');
        $town->setLabel('City/Town');
        $towns = [
                    '' => 'Select town',
                    'Windhoek'  => 'Windhoek',
                    'Rundu'  => 'Rundu',
                    'Walvis Bay'  => 'Walvis Bay',
                    'Swakopmund'  => 'Swakopmund',
                    'Oshakati'  => 'Oshakati',
                    'Rehoboth'  => 'Rehoboth',
                    'Katima Mulilo'  => 'Katima Mulilo',
                    'Otjiwarongo'  => 'Otjiwarongo',
                    'Ondangwa'  => 'Ondangwa',
                    'Okahandja'  => 'Okahandja',
                    'Keetmanshoop'  => 'Keetmanshoop',
                    'Ongwediva'  => 'Ongwediva',        
                ];
        $town->setMultiOptions($towns)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));       
        
           $this->addElements(array(
                    $promoter,
                    $businessName,
                    $businessSector,
                    $businessActivity,
                    $requestType,
               
                    $telephoneNumber,
                    $mobileNumber,
                    $faxNumber,
                    $emailAddress,
                    $postalAddress,
                    $residentialAddress,
                    $region,
                    $town,
                    $auctionId,
                ));                               
    }
}