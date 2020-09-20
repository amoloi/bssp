<?php

class JBlac_Forms_Bssp_SubForms_ApplicationRequest extends Zend_Form_SubForm
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
//        self::$formCount = self::$formCount + 1;
//        self::$rowCount = self::$rowCount + 1;
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
        
        $requestId = new Zend_Form_Element_Hidden('requestId');
        $requestId->setIsArray(TRUE);
        $requestId->removeDecorator('Label'); 
        $this->addElement($requestId);
        
        $requestStatus = new Zend_Form_Element_Hidden('requestStatus');
        $requestStatus->setIsArray(TRUE);
        $requestStatus->removeDecorator('Label');
        $requestStatus->setValue('PENDING');
        $this->addElement($requestStatus);        
        
        $requestNumber = new Zend_Form_Element_Hidden('requestNumber');
        $requestNumber->setIsArray(TRUE);
        $requestNumber->removeDecorator('Label'); 
        $this->addElement($requestNumber);
        
        $requestType = new Zend_Form_Element_Select('requestType');
        $requestType->setLabel('Request Type');
        $lov = [
                        '' => 'Select one',
                        'Feasibility Study'                   => 'Feasibility Study',
                        'Business Plan'                        => 'Business Plan',
                        'Feasibility Study and Business Plan'   => 'Feasibility Study and Business Plan',
                        'Environmental Impact Assessment'       => 'Environmental Impact Assessment',
                        'Architectural Design'                  => 'Architectural Design',
                        'Training'                              => 'Training',
                        'Mentorship'                            => 'Mentorship',
                        'Training and Mentorship'               => 'Training and Mentorship',
                        'Product Development'                   => 'Product Development',            
                        'Due Diligence'                         => 'Due Diligence',
                        'Turnaround Strategy'                   => 'Turnaround Strategy',
                        'Other'                                 => 'Other - Please specify below',
                ];
        $requestType->setMultiOptions($lov)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'id' => 'request-type-' . self::$rowCount,
                    'required' => true,
                    'onchange' => 'BsspRequest.otherType(this.id , this.value)'
                ))
                ->setIsArray(TRUE);
        $this->addElement($requestType);
        $otherRequestType = new Zend_Form_Element_Text('otherRequestTypeText');
        $otherRequestType->setLabel('Other Request Type')
                ->setAttribs(array(
                    'class' => 'form-control other-request-type',
                    'id' => 'other-request-type-' . self::$rowCount,
                    'placeholder ' => 'Enter other request type',
                    'maxlength' => '1024'                    
                ))->setDescription('If your chouse for "request Type" above is other , please describe your request here')
                ->setRequired(FALSE)
                ->setIsArray(TRUE);
        
        $this->addElement($otherRequestType);        
        $businessActivity = new Zend_Form_Element_Text('requestBusinessActivity');
        $businessActivity->setLabel('Request Description')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'id' => 'business-activity-' . self::$rowCount,
                    'placeholder ' => 'Enter description',
                    'maxlength' => '1024'                    
                ))
                ->setRequired(FALSE)
                ->setIsArray(TRUE);
        $this->addElement($businessActivity);

        $sectors = new Zend_Form_Element_Select('requestSector');
        $sectors->setLabel('Request Sector');

        $sectorsLOV = JBlac_Services_Sector::getSectorsLOV();

        $sectorsLOV[''] = 'Select sector';
        
        $sectors->setMultiOptions($sectorsLOV)
                ->setAttribs(array(
                    'class' => 'form-control selectric2',
                    'id' => 'sector' . self::$rowCount,
                    'onchange' => "bsspObj.loadPriorityAreas(this.value , " . self::$rowCount . ")"
                ))->setRequired(false)
                ->setIsArray(true)
                ->setValue('')
                ->setRegisterInArrayValidator(false)
                ;
        $this->addElement($sectors);
        
        $priorityArea = new Zend_Form_Element_Select('requestPriotityArea');
        $priorityArea->setLabel('Request Sub Sector');

        $priorityAreas = [
                    'none' => 'Select sector first',      
                ];
        
        $priorityArea->setMultiOptions($priorityAreas)
                ->setAttribs(array(
                    'class' => 'form-control selectric2',
                    'id' => 'priority' . self::$rowCount,
                ))->setRequired(FALSE)
                ->setIsArray(TRUE)
                ->setRegisterInArrayValidator(false)
                ;
        $this->addElement($priorityArea);
        
        $removeButton = new Zend_Form_Element_Button('btn_remove');
        $removeButton->setLabel('Remove')
                ->setAttribs(array(
                    'class' => 'form-control btn',
                    'onclick' => 'bssp.removeRow(this.id)',
                    'id' => 'remove_' . self::$rowCount,
                ))
                ->setRequired(FALSE)
                ->setIgnore(TRUE)
                ->removeDecorator('label')->removeDecorator('HtmlTag');
        $this->addElement($removeButton);
        
        /**
         * NEW INSTALMENT LINK
         */
        $newRow = $this->addElement('note' , 'newRow' , [
            'value' => '<a href="javascript:;" class="btn" id="add-request">Add Request Row</a>',
        ]);
    }
    public function getRowCount(){
        return self::$rowCount;
    }    
}
//->removeDecorator('label')->removeDecorator('HtmlTag')