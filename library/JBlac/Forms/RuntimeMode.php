<?php

class Admin_Form_RuntimeMode extends Zend_Form
{

    public function init()
    {
        $this->setAction('/admin/settings/runtimemode');
        $this->setMethod('post');

        $doctype = new Search_Model_DoctypeService();
        $doctypes = $doctype->getAllDoctypes();
        
        $runtimeMode = new Zend_Form_Element_Select('init_val');
        $runtimeMode->setLabel('Runtime Mode');
        
        $refObj = new Admin_Model_DbTable_ReferenceCodes();
        $refObjMapper = new Admin_Model_ReferenceCodeMapper([]);
        $runtimeModes[null] = ' - Select runtime mode - ';
        foreach ($refObjMapper->fetchPerRefType('RUN_MODE') as $refObj){
            $runtimeModes[$refObj['REF_CD']] = $refObj['REF_DESC'];
        }
        $runtimeMode->setMultiOptions($runtimeModes)
                ->setAttribs(array(
                    'class' => 'form-control',    
                    'required' => true,
                ))
                    ->setRequired(true)
                    ->setErrorMessages(['Runtime mode is required']);
        
        $button = new Zend_Form_Element_Button('cmdsave');
        
        $button->setLabel('Save setting')
                ->setAttribs(array(
                    'class' => 'btn btn-primary',
                    'type' => 'submit'
                ));
        
                $this->addElements(array(
                    $runtimeMode,
                    $button,
                ));
    }
}

