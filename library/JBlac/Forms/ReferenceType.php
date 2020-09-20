<?php

class Admin_Form_ReferenceType extends Zend_Form
{

    public function init()
    {
        $this->setAction('/admin/settings/newreftype');
        $this->setMethod('post');
        
        $reference_code = new Zend_Form_Element_Text('rtp_cd');
        $reference_code->setLabel('Reference code')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Type a reference type code here',
                    'maxlength' => '10'
                ))
                ->setRequired()
                ->setErrorMessages(['Reference type code is required']);
       /*
        * Company Search details
        */ 
        $reference_desc = new Zend_Form_Element_Text('rtp_desc');
        $reference_desc->setLabel('Reference type description')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Type a reference type description here',
                    'maxlength' => '100'
                ))
                ->setRequired()
                ->setErrorMessages(['Reference type description is required']);
        
        
        $ref_isactive_flag = new Zend_Form_Element_Select('rtp_isactive_f');
        $ref_isactive_flag->setLabel('Reference type status');

        $ref_isactive_flag->setMultiOptions([
                                                '' => ' - Select status - ',
                                                '1' => 'Active',
                                                '0' => 'Inactive',            
                                            ]
                )
                ->setAttribs([
                                'class' => 'form-control',
                                'id' => 'ref-code-status',
                                'onchange' => '',                    
                            ])
                ->setRequired()
                ->setErrorMessages(['Reference type status is required']);        
                
        $button = new Zend_Form_Element_Button('cmdsave');
        
        $button->setLabel('Save reference code data')
                ->setAttribs([
                                'class' => 'btn btn-primary',
                                'type' => 'submit'                    
                            ]
                            );

        $this->addElements([
                                $reference_code,
                                $reference_desc,
                                $ref_isactive_flag,
                                $button,            
                            ]);
    }


}