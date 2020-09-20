<?php

class Projects_Model_BsspProjectImplementation extends JBlac_ObjectModel
{
    
    protected $includeImplementationReport              =     null;
    protected $implementationDateOfIssueToPromoters     =     null;
    protected $implementationReportType                 =     null;
    protected $implementationSourceOfFunds              =     null;    
    protected $implementationRemarks                    =     null;
    protected $projectNumber                            =     null;    

    public function getIncludeImplementationReport() {
        return $this->includeImplementationReport;
    }
    public function getImplementationDateOfIssueToPromoters() {
        return $this->implementationDateOfIssueToPromoters;
    }

    public function getImplementationReportType() {
        return $this->implementationReportType;
    }

    public function getImplementationSourceOfFunds() {
        return $this->implementationSourceOfFunds;
    }
    public function getImplementationRemarks() {
        return $this->implementationRemarks;
    }
    
    public function getProjectNumber() {
      return $this->projectNumber;
    }    


    public function setIncludeImplementationReport($includeImplementationReport) {
        $this->includeImplementationReport = (!empty($includeImplementationReport)? $includeImplementationReport:'N');
        return $this;
    }
    
    public function setImplementationDateOfIssueToPromoters($implementationDateOfIssueToPromoters) {
        $this->implementationDateOfIssueToPromoters = (!empty($implementationDateOfIssueToPromoters)? $implementationDateOfIssueToPromoters:null);
        return $this;
    }

    public function setImplementationReportType($implementationReportType) {
        $this->implementationReportType = (!empty($implementationReportType)? $implementationReportType:null);
        return $this;
    }

    public function setImplementationSourceOfFunds($implementationSourceOfFunds) {
        $this->implementationSourceOfFunds = (!empty($implementationSourceOfFunds)? $implementationSourceOfFunds:null);
        return $this;
    }
    
    public function setImplementationRemarks($implementationRemarks) {
        $this->implementationRemarks = (!empty($implementationRemarks)? $implementationRemarks:null);
        return $this;
    }
    
    public function setProjectNumber($projectNumber) {
        $this->projectNumber = (!empty($projectNumber)? $projectNumber:null);
        return $this;
    }

  public function exchangeArray($data){
        $this->id                                           =       (!empty($data['id'])? $data['id']:null);
        $this->implementationDateOfIssueToPromoters         =       (!empty($data['implementationDateOfIssueToPromoters'])? $data['implementationDateOfIssueToPromoters']:null);
        $this->implementationReportType                     =       (!empty($data['implementationReportType'])? $data['implementationReportType']:null);
        $this->implementationSourceOfFunds                  =       (!empty($data['implementationSourceOfFunds'])? $data['implementationSourceOfFunds']:null);       
        $this->implementationRemarks                        =       (!empty($data['implementationRemarks'])? $data['implementationRemarks']:null);
        $this->projectNumber                                =       (!empty($data['projectNumber'])? $data['projectNumber']:null);
        $this->createdBy                                    =       (!empty($data['createdBy'])? $data['createdBy']:null);
        $this->createdOn                                    =       (!empty($data['createdOn'])? $data['createdOn']:null);
        $this->modifiedBy                                   =       (!empty($data['modifiedBy'])? $data['modifiedBy']:null);
        $this->modifiedOn                                   =       (!empty($data['modifiedOn'])? $data['modifiedOn']:null);
    }

}