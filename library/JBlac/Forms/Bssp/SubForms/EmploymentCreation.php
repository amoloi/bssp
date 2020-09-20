<?php

class JBlac_Forms_Bssp_SubForms_EmploymentCreation extends Zend_Form_SubForm
{
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

    public function init()
    { 
        $this->addDecorators($this->decorators);
        
        $employmentCreationId = new Zend_Form_Element_Hidden('employmentCreationId');
        $employmentCreationId->setIsArray(true);
        $employmentCreationId->removeDecorator('Label'); 
        $this->addElement($employmentCreationId);
        
        $employmentNumberOfMales = new Zend_Form_Element_Text('employmentNumberOfMales');
        $employmentNumberOfMales->setLabel('Number of Males Employed')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter number',
                    'maxlength' => '4'                    
                ))
                ->setRequired(false)
                ->setIsArray(true);
        $this->addElement($employmentNumberOfMales);

        $employmentNumberOfFemales = new Zend_Form_Element_Text('employmentNumberOfFemales');
        $employmentNumberOfFemales->setLabel('Number of Females Employed')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter number',
                    'maxlength' => '4'                    
                ))
                ->setRequired(true)
                ->setIsArray(true);
        $this->addElement($employmentNumberOfFemales);
        
        $employmentDateOfEmployment = new Zend_Form_Element_Text('employmentDateOfEmployment');
        $employmentDateOfEmployment->setLabel('Date Of Employment')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter date',
                    'readonly ' => 'readonly',
                    'maxlength' => '12'                    
                ))
                ->setRequired(false)
                ->setIsArray(true);
        $this->addElement($employmentDateOfEmployment);
        
        $removeButton = new Zend_Form_Element_Button('btn_remove');
        $removeButton->setLabel('Remove')
                ->setAttribs(array(
                    'class' => 'form-control btn',
                    'onclick' => 'bssp.removeRow(this.id)',
                    'id' => 'remove_' . self::$rowCount,
                ))
                ->setRequired(false)
                ->setIgnore(true)
                ->removeDecorator('label')->removeDecorator('HtmlTag');
        $this->addElement($removeButton);
    }
    public function getRowCount(){
        return self::$rowCount;
    }    
}
//->removeDecorator('label')->removeDecorator('HtmlTag')