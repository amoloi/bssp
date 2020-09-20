<?php

class JBlac_Forms_Bssp_ProjectComposition extends JBlac_Form
{
    
    public static $validateUnique = true;                          //STORE CURRENT OPERATION WETHER NEW ACCOUNT OR UPDATING

    public function init()
    {
        $this->setMethod('post');
        $resolutionId = new Zend_Form_Element_Hidden('id');
        $resolutionId->setDecorators(['ViewHelper']);
        $projectNumber = new Zend_Form_Element_Hidden('projectNumber');
        $projectNumber->setDecorators(['ViewHelper']); 
        $projectId = new Zend_Form_Element_Hidden('projectId');
        $projectId->setDecorators(['ViewHelper']);
        

        
        
        $applicationId = new Zend_Form_Element_Hidden('applicationId');
        $applicationId->setDecorators(['ViewHelper']);
        $this->addElement($applicationId);
        
        $applicationNumber = new Zend_Form_Element_Hidden('applicationNumber');
        $applicationNumber->setDecorators(['ViewHelper']);
        $this->addElement($applicationNumber);
        
        $applicantName = new Zend_Form_Element_Hidden('applicantName');
        $applicantName->setDecorators(['ViewHelper']);
        $this->addElement($applicantName);        
        

        /**
         * RESOLUTION DATA
         */
        
        $discussionDate = new Zend_Form_Element_Text('discussionDate');
        $discussionDate->setLabel('Date of Discussion')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter discussion date',
                    'readonly ' => 'readonly',
                    'maxlength' => '13',
                    'required' => 'required' 
                ))
                ->setRequired(false);
        
        $corespondenceDate = new Zend_Form_Element_Text('corespondenceDate');
        $corespondenceDate->setLabel('Date of Corespondence')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'readonly ' => 'readonly',
                    'placeholder ' => 'Enter corespondence date',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);        
        
        $discussionStatus = new Zend_Form_Element_Select('discussionStatus');
        $discussionStatus->setLabel('Discussion Status');
        $lov = [
                        '' => 'Select status',
                        'APPROVED'  => 'Discussed - Approved',
                        'PENDING'   => 'Received - Decision Pending',                        
                        'REJECTED'  => 'Discussed - Rejected',
                ];
                
        $discussionStatus->setMultiOptions($lov)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));
        $requestType = new Zend_Form_Element_Select('requestType');
        $requestType->setLabel('Request Type');
        $lov = [
                        '' => 'Select one',
                        'Feasibility Study' => 'Feasibility Study',
                        'Business Plan' => 'Business Plan',
                        'Environmental Impact Assessment' => 'Environmental Impact Assessment',
                        'Due Diligence' => 'Due Diligence',
                        'Mentorship' => 'Mentorship',
                        'Architectural Design' => 'Architectural Design',
                        'Turnaround Strategy' => 'Turnaround Strategy',
                        'Other' => 'Other - Please specify below',
                ];

        $requestType->setMultiOptions($lov)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));
        $this->addElement($requestType);
        
        $resolutionRemarks = new Zend_Form_Element_Text('resolutionRemarks');
        $resolutionRemarks->setLabel('Resolution remarks')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'readonly' => 'readonly',
                    'placeholder ' => '',                  
                ))
                ->setRequired(false);
        $this->addElement($resolutionRemarks);

        /**
         * CONSULTANT DATA
         */
        $projectConsultancyId = new Zend_Form_Element_Hidden('projectConsultancyId');
        $projectConsultancyId->setDecorators(['ViewHelper']);
        $this->addElement($projectConsultancyId);
        
        $consultantLegalEntityId = new Zend_Form_Element_Hidden('consultantLegalEntityId');
        $consultantLegalEntityId->setDecorators(['ViewHelper']);
        $this->addElement($consultantLegalEntityId);        

        $consultantId = new Zend_Form_Element_Select('consultantId');
        $consultantId->setLabel('Consultancy Name');
        $codes = JBlac_Models_LegalEntityMapper::fetchEntityLOV('consultant');
        $codes [''] = 'Select consultancy';
        $codes ['unknown'] = 'Unknown Conslultancy';

        $consultantId->setMultiOptions($codes)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ))->setValue('');        
       
  
        $principleConsultant = new Zend_Form_Element_Text('principleConsultant');
        $principleConsultant->setLabel('Principle Consultant Name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter principle cunsultant name',
                    'maxlength' => '50'                    
                ))
                ->setRequired();         
        
        /**
         * PAYMENT STATUS
         */
        
        $installmentId = new Zend_Form_Element_Hidden('installmentId');
        $installmentId->setDecorators(['ViewHelper']);
        $installmentId->setIsArray(true);
        $this->addElement($installmentId);
        
        
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
                ))
                ->setIsArray(true);
        
        $instalmentAmount = new Zend_Form_Element_Text('instalmentAmount');
        $instalmentAmount->setLabel('Instalment(In Namibian Dollars)')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter instalment',
                    'maxlength' => '10'                    
                ))
                ->setRequired(false)
                ->setIsArray(true);
        
        $instalmentDate = new Zend_Form_Element_Text('instalmentDate');
        $instalmentDate->setLabel('Instalment Date')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter instalment date',
                    'maxlength' => '12'                    
                ))
                ->setRequired(false)
                ->setIsArray(true);
        /**
         * NEW INSTALMENT LINK
         */
        $newProjectBudget = $this->addElement('note' , 'newProjectBudget' , [
            'value' => '<a href="javascript:;" class="btn" id="add-project-budget">Create a Project Budget</a>',
        ]);        
        /**
         * NEW INSTALMENT LINK
         */
        $newInstalment = $this->addElement('note' , 'newInstalment' , [
            'value' => '<a href="javascript:;" class="btn" id="addInstalment">Create a Project Instalment</a>',
        ]);
        /**
         * NEW CONSULTANT LINK
         */
        $newInstalment = $this->addElement('note' , 'newConsultant' , [
            'value' => '<a href="javascript:;" class="btn" id="add-consultant">Create a Consultancy</a>',
        ]);
        /**
         * NEW CONSULTANT LINK
         */
        $newExtension = $this->addElement('note' , 'newExtension' , [
            'value' => '<a href="javascript:;" class="btn" id="add-extension">Add Assignment Extension</a>',
        ])->removeDecorator('Label');
        /**
         * FUNDS DETAILS
         */
        /**
         * NEW EMPLOYMENT LINK
         */
        $newExtension = $this->addElement('note' , 'newEmployment' , [
            'value' => '<a href="javascript:;" class="btn" id="add-employment">Add New Employement Created</a>',
        ])->removeDecorator('Label');
        /**
         * FUNDS DETAILS
         */
        $fundsApproved = new Zend_Form_Element_Select('budgetApproved');
        $fundsApproved->setLabel('Budget Approved');
        $codes = JBlac_Utilities_AppReference::fetchFundsLOV();
        $codes['NEW-BUDGET'] = 'Create a new budget.';
        $fundsApproved->setMultiOptions($codes)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'id'    =>  'budget-approved',
                    'required' => true,
                ));        
        
        
        $fundsOutstanding = new Zend_Form_Element_Text('budgetOutstanding');
        $fundsOutstanding->setLabel('Budget Outstanding Amount(In NAD)')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'id'    =>  'outstanding-amount',
                    'placeholder ' => '',
                    'maxlength' => '10'                    
                ))
                
                ->setRequired(false);
        
        $fundsApprovedDate = new Zend_Form_Element_Text('budgetApprovedDate');
        $fundsApprovedDate->setLabel('Date Of Budget Approval')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'id'    =>  'date-approved',
                    'readonly ' => 'readonly',
                    'placeholder ' => 'Enter date of budget approval',
                    'maxlength' => '12'                    
                ))
                ->setRequired(false);

        /**
         * IMPLEMENTATION STATUS DETAILS
         */
        $includeImplementation = new Zend_Form_Element_Select('includeImplementationReport');
        $includeImplementation->setLabel('Include project implementation status');
        $lov = [
                        ''        => 'Select one',
                        'Y'       => 'Yes - Include project mplementation status',
                        'N'       => 'No - Do not include project mplementation status',
                ];

        $includeImplementation->setMultiOptions($lov)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));      
        $this->addElement($includeImplementation);
        
        $implementationId = new Zend_Form_Element_Hidden('implementationId');
        $implementationId->setDecorators(['ViewHelper']);
        $this->addElement($implementationId);        
        $dateIssuedToPromoters = new Zend_Form_Element_Text('implementationDateOfIssueToPromoters');
        $dateIssuedToPromoters->setLabel('Date Issued to Promoters')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'readonly ' => 'readonly',
                    'placeholder ' => 'Enter date of issue to promoters',
                    'maxlength' => '12'                    
                ))
                ->setRequired(false);        

        $reportType = new Zend_Form_Element_Text('implementationReportType');
        $reportType->setLabel('Report Type')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'readonly ' => 'readonly',
                    'placeholder ' => '',
                    'maxlength' => '256'                    
                ))
                ->setRequired(true); 
       
        $sourceOfFunds = new Zend_Form_Element_Text('implementationSourceOfFunds');
        $sourceOfFunds->setLabel('Financial Instituion/ Investor Funding')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter source of funds',
                    'maxlength' => '50'                    
                ))
                ->setRequired(false);
        
        $implementationRemarks = new Zend_Form_Element_Textarea('implementationRemarks');
        $implementationRemarks->setLabel('Implementation Remarks')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder ' => 'Enter implementation remarks',                  
                ))
                ->setRequired(false);
        
        /**
         * EMPLOYMENT STATUS
         */        
        $employmentCreationId = new Zend_Form_Element_Hidden('employmentCreationId');
        $employmentCreationId->setIsArray(true);
        $employmentCreationId->removeDecorator('Label'); 
        $this->addElement($employmentCreationId);
        
        $employmentNumberOfMales = new Zend_Form_Element_Text('employmentNumberOfMales');
        $employmentNumberOfMales->setLabel('Initial Number of Males Employed')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter number',
                    'maxlength' => '4'                    
                ))
                ->setRequired(false)
                ->setIsArray(true);
        $this->addElement($employmentNumberOfMales);

        $employmentNumberOfFemales = new Zend_Form_Element_Text('employmentNumberOfFemales');
        $employmentNumberOfFemales->setLabel('Initial Number of Females Employed')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter number',
                    'maxlength' => '4'                    
                ))
                ->setRequired(false)
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

                $this->addElements(array(
                    $projectId,
                    $projectNumber,                    
                    $resolutionId,
//                    $discussionDate,
                    $discussionStatus,
                    $requestType,
//                    $corespondenceDate,
                    
                    $consultantId,
                    $principleConsultant,
                    
                    $instalmentPhase,
                    $instalmentAmount,
                    $instalmentDate,
                    
                    $fundsApproved,
                    $fundsApprovedDate,
                    $fundsOutstanding,
                    
//                    $assignmentDiscussionDate,
//                    $assignmentEstensionDateTo,
//                    $assignmentCommitteeRemarks,
                    
                    $dateIssuedToPromoters,
                    $reportType,
                    $sourceOfFunds,
                    $implementationRemarks,
                ));
                
                
    }                

}