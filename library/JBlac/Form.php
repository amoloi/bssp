<?php
/**
 * Description of JBlac_Form
 *
 * @author Innocent
 */
class JBlac_Form extends Zend_Form{

    public function __construct($options = null) {
        parent::__construct($options);
        $fc = Zend_Controller_Front::getInstance();
        $m = $fc->getRequest()->getModuleName();
        $c = $fc->getRequest()->getControllerName();
        $a = $fc->getRequest()->getActionName();
        $this->setAttrib('class', 'zend-form');
        parent::init();
        $this->setAction("/{$m}/{$c}/{$a}");
        $this->setMethod('post');
        
        $reset = new Zend_Form_Element_Reset('btnReset');
        $reset->setLabel('Clear Form')
                ->setAttribs([
                    'class' => 'btn btn-block',
                ])
                ->setIgnore(true);

        $cancel = new Zend_Form_Element_Button('btnCancel');
        $cancel->setLabel('Cancel')
                ->setAttribs([
                    'class' => 'cancel button',
                ])
                ->setIgnore(true);
        
        $btnSubmit = new Zend_Form_Element_Button('btnSubmit');
        $btnSubmit->setLabel('Submit')
                ->setAttribs([
                    'class' => 'btn btn-block btn-primary',
                    'type' => 'submit'
                ])
                ->setIgnore(TRUE);

        $btnMore = new Zend_Form_Element_Button('btnMore');
        $btnMore->setLabel('Save and Create Another')
                ->setAttribs([
                    'class' => 'btn btn-block btn-primary',
                    'type' => 'submit'
                ])
                ->setIgnore(TRUE);        


        $this->addElements([
            $cancel,
            $reset,
            $btnSubmit,
            $btnMore,
        ]);
    }

}