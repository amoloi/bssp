<?php

class JBlac_Forms_Bssp_SubForms_AssignmentExtension extends Zend_Form_SubForm
{
    public function init()
    {
        
        /**
         * ASSIGNMENT EXTENSION DETAILS
         */
        $extensionCount = new Zend_Form_Element_Hidden('extensionCount');
        $extensionCount->setDecorators(['ViewHelper']);
        $extensionCount->setIsArray(true);
        $extensionCount->setValue(1);
        $this->addElement($extensionCount);        
        
        /**
         * ASSIGNMENT EXTENSION DETAILS
         */
        $assignmentExtensionId = new Zend_Form_Element_Hidden('assignmentExtensionId');
        $assignmentExtensionId->setDecorators(['ViewHelper']);
        $assignmentExtensionId->setIsArray(true);
        $this->addElement($assignmentExtensionId);
        
        $extensionPhase = new Zend_Form_Element_Select('assignmentExtensionPhase');
        $extensionPhase->setLabel('Extension Phase');
        $lov = [
                        '' => 'Select phase',
                        'FIRST PHASE'      => 'First Extension - [1]',
                        'SECOND PHASE'     => 'Second Extension - [2]',
                ];

        $extensionPhase->setMultiOptions($lov)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ))
                ->setRequired(true)
                ->setIsArray(true);
        $this->addElement($extensionPhase);
        
        $assignmentDiscussionDate = new Zend_Form_Element_Text('assignmentExtensionDiscussionDate');
        $assignmentDiscussionDate->setLabel('Date Of Discussion')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter date of discussion',
                    'maxlength' => '12'                    
                ))
                ->setRequired(true)
                ->setIsArray(true);
        $this->addElement($assignmentDiscussionDate);
        
        $assignmentExtendedFromDate = new Zend_Form_Element_Text('assignmentExtendedFromDate');
        $assignmentExtendedFromDate->setLabel('Extended From')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter date',
                    'maxlength' => '12'                    
                ))
                ->setRequired(true)
                ->setIsArray(true);
        $this->addElement($assignmentExtendedFromDate);
        
        $assignmentEstensionDateTo = new Zend_Form_Element_Text('assignmentExtendedToDate');
        $assignmentEstensionDateTo->setLabel('Extended To')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter date',
                    'maxlength' => '12'                    
                ))
                ->setRequired(true)
                ->setIsArray(true);
        $this->addElement($assignmentEstensionDateTo);
        
        $assignmentCommitteeRemarks = new Zend_Form_Element_Text('assignmentExtensionRemarks');
        $assignmentCommitteeRemarks->setLabel('Committee Remarks')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder ' => 'Enter commitee remarks',                  
                ))
                ->setRequired(false)
                ->setIsArray(true);
        $this->addElement($assignmentCommitteeRemarks);
        
        $removeButton = new Zend_Form_Element_Button('btn_remove');
        $removeButton->setLabel('Remove')
                ->setAttribs(array(
                    'class' => 'form-control btn btn_remove',
                    'onclick' => 'bssp.removeRow(this.id)',
                ))
                ->setRequired(false)
                ->setIgnore(true)
                ->removeDecorator('label')->removeDecorator('HtmlTag');
        $this->addElement($removeButton);        
    }                

}