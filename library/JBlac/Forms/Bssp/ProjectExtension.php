<?php

class JBlac_Forms_Bssp_ProjectExtension extends JBlac_Form
{
    
    public static $validateUnique = true;                          //STORE CURRENT OPERATION WETHER NEW ACCOUNT OR UPDATING

    public function init()
    {
        $this->setMethod('post');
        $extensionId = new Zend_Form_Element_Hidden('id');
        $extensionId->setDecorators(['ViewHelper']);
        $projectNumber = new Zend_Form_Element_Hidden('projectNumber');
        $projectNumber->setDecorators(['ViewHelper']); 
               
        
        /**
         * NEW INSTALMENT LINK
         */
        $newInstalment = $this->addElement('note' , 'newInstalment' , [
            'value' => '<a href="javascript:;" class="btn" id="addInstalment">Add Instalment</a>',
        ]);        
        
        /**
         * ASSIGNMENT EXTENSION DETAILS
         */
        $projectNumber = new Zend_Form_Element_Select('projectNumber');
        $projectNumber->setLabel('Project name');
        $lov = Projects_Model_ProjectMapper::fetchProjectsLOV();

        $projectNumber->setMultiOptions($lov)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ))
                ->setRequired(TRUE);
        
        $extensionPhase = new Zend_Form_Element_Select('phase');
        $extensionPhase->setLabel('Extension Phase');
        $lov = [
                        '' => 'Select phase',
                        'first'      => 'First Extension - [1]',
                        'second'     => 'Second Extension - [2]',
                ];

        $extensionPhase->setMultiOptions($lov)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ))
                ->setRequired(TRUE);
        
        $assignmentDiscussionDate = new Zend_Form_Element_Text('discussionDate');
        $assignmentDiscussionDate->setLabel('Date Of Discussion')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter date of discussion',
                    'maxlength' => '12'                    
                ))
                ->setRequired(TRUE);
        
        $assignmentEstensionDateTo = new Zend_Form_Element_Text('extendedToDate');
        $assignmentEstensionDateTo->setLabel('Date Entended To')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter date extended to',
                    'maxlength' => '12'                    
                ))
                ->setRequired(TRUE);
        
        $assignmentCommitteeRemarks = new Zend_Form_Element_Textarea('remarks');
        $assignmentCommitteeRemarks->setLabel('Committee Remarks')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder ' => 'Enter commitee remarks',                  
                ))
                ->setRequired(true);
      
                $this->addElements(array(
                    $extensionId,
                                        
                    $projectNumber,
                    $extensionPhase,
                    $assignmentDiscussionDate,
                    $assignmentEstensionDateTo,
                    $assignmentCommitteeRemarks,
                ));
                
                
    }                

}