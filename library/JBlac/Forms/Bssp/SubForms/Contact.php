<?php

class JBlac_Forms_Bssp_SubForms_Contact extends Zend_Form_SubForm
{
    
    public static $validateUnique = true;

    public function init()
    {    
        $applicationId = new Zend_Form_Element_Hidden('contactId');
        $applicationId->removeDecorator('Label')
                      ->setIsArray(true); 
        $this->addElement($applicationId);

        $firstName = new Zend_Form_Element_Text('contactFirstName');
        $firstName->setLabel('First name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter first name',
                    'maxlength' => '50'                    
                ))
                ->addFilter('StripTags')
                ->addFilter('stringTrim')                
                ->setRequired(false)
                ->setIsArray(true);
        $this->addElement($firstName);
        
        $middleName = new Zend_Form_Element_Text('contactMiddleName');
        $middleName->setLabel('Middle name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter middle name',
                    'maxlength' => '50'                    
                ))
                ->addFilter('StripTags')
                ->addFilter('stringTrim')                
                ->setRequired(false)
                ->setIsArray(true);
        $this->addElement($middleName);
        
        $lastName = new Zend_Form_Element_Text('contactLastName');
        $lastName->setLabel('Last name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter last name',
                    'maxlength' => '50'                    
                ))
                ->addFilter('StripTags')
                ->addFilter('stringTrim')                
                ->setRequired(false)
                ->setIsArray(true);
        $this->addElement($lastName);
        
        $position = new Zend_Form_Element_Text('contactPosition');
        $position->setLabel('Position')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter position',
                    'maxlength' => '128',
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->setRequired(false)
                ->setIsArray(true);
        $this->addElement($position);

        $title = new Zend_Form_Element_Select('contactTitle');
        $title->setLabel('Title');
        $lov = [
                        'none' => 'Select one',
                        'Mr' => 'Mr',
                        'Mrs' => 'Mrs',
                        'Miss' => 'Miss',
                        'Ms' => 'Ms',
                        'Dr' => 'Dr',
                        'Professor' => 'Professor',
                        'Reverend' => 'Reverend',
                ];

        $title->setMultiOptions($lov)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                ))->setRequired(false)
                ->setIsArray(true);
        $this->addElement($title);        
        
        /**
         * NEW INSTALMENT LINK
         */
        $newRow = $this->addElement('note' , 'newContact' , [
            'value' => '<a href="javascript:;" class="btn" id="add-contact">Add Contact Row</a>',
        ]);                             
    }
}