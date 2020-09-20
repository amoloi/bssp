<?php

class JBlac_Forms_Bssp_ProjectResolution extends JBlac_Form
{
    
    public static $validateUnique = true;                          //STORE CURRENT OPERATION WETHER NEW ACCOUNT OR UPDATING

    public function init()
    {
        $this->setMethod('post');
        $resolutionId = new Zend_Form_Element_Hidden('resolutionId');
        $resolutionId->setDecorators(['ViewHelper']);
        $this->addElement($resolutionId);
        
        $resolution_requestNumber = new Zend_Form_Element_Hidden('resolution_requestNumber');
        $resolution_requestNumber->setDecorators(['ViewHelper']); 

        $this->addElement($resolution_requestNumber);        
        
        $applicationId = new Zend_Form_Element_Hidden('applicationId');
        $applicationId->setDecorators(['ViewHelper']);
        $this->addElement($applicationId);
        
        $applicationNumber = new Zend_Form_Element_Hidden('applicationNumber');
        $applicationNumber->setDecorators(['ViewHelper']);
        $this->addElement($applicationNumber);
        
        $requestNumber = new Zend_Form_Element_Hidden('requestNumber');
        $requestNumber->setDecorators(['ViewHelper']);
        $this->addElement($requestNumber); 
        
        $requestId = new Zend_Form_Element_Hidden('requestId');
        $requestId->setDecorators(['ViewHelper']);
        $this->addElement($requestId);
        
        $projectNumber = new Zend_Form_Element_Hidden('projectNumber');
        $projectNumber->setDecorators(['ViewHelper']);
        $this->addElement($projectNumber); 
        
        $projectId = new Zend_Form_Element_Hidden('projectId');
        $projectId->setDecorators(['ViewHelper']);
        $this->addElement($projectId);         
		
        /**
         * RESOLUTION DATA
         */
        
        $discussionDate = new Zend_Form_Element_Text('resolutionDiscussionDate');
        $discussionDate->setLabel('Date of Discussion')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter discussion date',
                    'maxlength' => '13',
                    'required' => 'required' 
                ))
                ->setRequired(TRUE);
        $this->addElement($discussionDate);
        
        $corespondenceDate = new Zend_Form_Element_Text('resolutionCorespondenceDate');
        $corespondenceDate->setLabel('Date of Corespondence')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter corespondence date',
                    'maxlength' => '13'                    
                ))
                ->setRequired();        
        $this->addElement($corespondenceDate);
        
        $discussionStatus = new Zend_Form_Element_Select('resolutionDiscussionStatus');
        $discussionStatus->setLabel('Discussion Status');
        $lov = [
                        '' => 'Select status',
                        'APPROVED'  => 'Approve Request ',                        
                        'REJECTED'  => 'Reject Request',
                        'PENDING-INFO'  => 'Pending Request - Additional information required',
                ];

        $discussionStatus->setMultiOptions($lov)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));

        $this->addElement($discussionStatus);
        
        $resolutionRemarks = new Zend_Form_Element_Text('resolutionRemarks');
        $resolutionRemarks->setLabel('Resolution Remarks')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'readonly' => 'readonly',
                    'placeholder ' => '',                  
                ))
                ->setRequired(FALSE);
        $this->addElement($resolutionRemarks);
        
        $resolutionRemarksDescription = new Zend_Form_Element_Textarea('resolutionRemarksDescription');
        $resolutionRemarksDescription->setLabel('Resolution Remarks Description')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'rows' => 2,
                    'placeholder ' => 'Enter remarks description',
                    'maxlength' => '4000'                    
                ))
                ->setRequired(FALSE);
        $this->addElement($resolutionRemarksDescription);
        
        /**
         * Extra button
         */
        $btnSaveToProject = new Zend_Form_Element_Button('btnSaveProject');
        $btnSaveToProject->setLabel('Save resolution details and continue to project composition')
                ->setAttribs([
                    'class' => 'btn btn-block btn-primary',
                    'type' => 'submit'
                ])
                ->setIgnore(false);
        $this->addElement($btnSaveToProject);
    }                

}