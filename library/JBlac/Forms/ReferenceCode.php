<?php

class Admin_Form_ReferenceCode extends Zend_Form
{

    public function init()
    {
        $this->setAction('/admin/settings/newrefcode');
        $this->setMethod('post');
        
        $reference_code = new Zend_Form_Element_Text('ref_cd');
        $reference_code->setLabel('Reference code')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Type a reference code here',
                    'maxlength' => '10'
                ))
                ->setRequired()
                ->setErrorMessages(['Reference code is required']);
       /*
        * Company Search details
        */ 
        $reference_desc = new Zend_Form_Element_Text('ref_desc');
        $reference_desc->setLabel('Reference code description')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Type a reference code description here',
                    'maxlength' => '100'
                ))
                ->setRequired()
                ->setErrorMessages(['Reference code description is required']);

        
        $reference_type = new Zend_Form_Element_Select('ref_rtp_cd');
        $reference_type->setLabel('Reference code type');
        
        $type = new Admin_Model_ReferenceType();
        $TM = new Admin_Model_ReferenceTypeMapper([]);
        
        $typeSet = [];
        $typeSet[''] = ' - Select type - ';
        foreach ($TM->fetchAll() as $obj ) {
            $typeSet[$obj->getRefTypeCode()] = $obj->getRefTypeDesc();
        }
               
        $reference_type->setMultiOptions($typeSet)
                ->setAttribs(array(
                    'class' => 'form-control',
                    'id' => 'ref-type',
                    'onchange' => '',
                ))
                ->setRequired()
                ->setErrorMessages(['Reference type code is required']);
        
        
        $ref_isactive_flag = new Zend_Form_Element_Select('ref_isactive_f');
        $ref_isactive_flag->setLabel('Reference code status');

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
                ->setErrorMessages(['Reference code status is required']);        
                
        $button = new Zend_Form_Element_Button('cmdsave');
        
        $button->setLabel('Save reference code data')
                ->setAttribs([
                                'class' => 'btn btn-primary',
                                'type' => 'submit'                    
                            ]
                            );

        $this->addElements([
                                $reference_type,
                                $reference_code,
                                $reference_desc,
                                $ref_isactive_flag,
                                $button,            
                            ]);
    }


}