<?php
/**
 * Description of JBlac_Forms_SubForms_Partner
 *
 * @author Innocent
 */
class JBlac_Forms_SubForms_Instalment extends Zend_Form_SubForm {
    protected static $formCount = null;
    protected static $rowCount = null;
    private $elementDecorators = array(
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element')),
        'Label',
        array(array('row' => 'HtmlTag'), array('tag' => 'li')),
    );
 
    private $buttonDecorators = array(
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'button')),
        array(array('row' => 'HtmlTag'), array('tag' => 'li')),
    );
 
    private $captchaDecorators = array(
        'Label',
        array(array('row' => 'HtmlTag'), array('tag' => 'li'))
    );    
    public function __construct($options = null) {
        if(is_null($options['rowCount'])){
            self::$rowCount = 1;
        }else{
            self::$rowCount = $options['rowCount'];
        }         
        parent::__construct($options);       
    }
    
    public function __destruct() {
        self::$formCount = self::$formCount + 1;
        self::$rowCount = self::$rowCount + 1;
    }

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
    
    public function init() {
        $this->addDecorators($this->decorators);
        
        $instalmentPhase = new Zend_Form_Element_Select('phase');
        $instalmentPhase->setLabel('Instalment Phase');
        $lov = [
                        '' => 'Select phase',
                        'first'         => 'First Instalment - [1]',
                        'second'        => 'Second Instalment - [2]',
                        'third'         => 'Third Instalment - [3]',
                        'fourth'        => 'Fourth Instalment - [4]',
                ];

        $instalmentPhase->setMultiOptions($lov)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                    'required' => 'required',
                    'id' => 'phase_' . self::$rowCount,
                ))
                ->setIsArray(TRUE)
                ->removeDecorator('label')->removeDecorator('HtmlTag');


        $instalmentAmount = new Zend_Form_Element_Text('instalmentAmount');
        $instalmentAmount->setLabel('Instalment(In Namibian Dollars)')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter instalment',
                    'maxlength' => '10' ,
                    'id' => 'instalmentAmount_' . self::$rowCount,
                ))
                ->setRequired(FALSE)
                ->setIsArray(TRUE)
                ->removeDecorator('label')->removeDecorator('HtmlTag');
        
        $instalmentDate = new Zend_Form_Element_Text('instalmentDate');
        $instalmentDate->setLabel('Instalment Date')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter instalment date',
                    'maxlength' => '12',
                    'id' => 'instalmentDate_' . self::$rowCount,
                ))
                ->setRequired(FALSE)
                ->setIsArray(TRUE)
                ->removeDecorator('label')->removeDecorator('HtmlTag');                

        $removeButton = new Zend_Form_Element_Button('btn_remove');
        $removeButton->setLabel('Remove')
                ->setAttribs(array(
                    'class' => 'form-control btn',
                    'onclick' => 'bssp.removeInstallment(this.id)',
                    'id' => 'remove_' . self::$rowCount,
                ))
                ->setRequired(FALSE)
                ->setIgnore(TRUE)
                ->removeDecorator('label')->removeDecorator('HtmlTag');
        
        $this->addElements([
            $instalmentPhase,
            $instalmentAmount,
            $instalmentDate,
            $removeButton
        ]);
    }
    
    public function getRowCount(){
        return self::$rowCount;
    }
}