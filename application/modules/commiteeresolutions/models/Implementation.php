<?php

class Commiteeresolutions_Model_Implementation extends JBlac_ObjectModel
{
    
    protected $discussionDate                  =     null;
    protected $dateIssuedToPromoters           =     null;
    protected $reportType                      =     null;
    protected $sourceOfFunds                   =     null;    
    protected $numberOfMaleEmployed            =     null;
    protected $numberOfFemaleEmployed          =     null;
    protected $implementationRemarks           =     null;
    protected $projectNumber                   =     null;    


  public function getDiscussionDate() {
      return $this->discussionDate;
  }
  public function getDateIssuedToPromoters() {
      return $this->dateIssuedToPromoters;
  }
  public function getReportType() {
      return $this->reportType;
  }

  public function getSourceOfFunds() {
      return $this->sourceOfFunds;
  }

  public function getNumberOfMaleEmployed() {
      return $this->numberOfMaleEmployed;
  }

  public function getNumberOfFemaleEmployed() {
      return $this->numberOfFemaleEmployed;
  }

  public function getImplementationRemarks() {
      return $this->implementationRemarks;
  }
  public function getProjectNumber() {
      return $this->projectNumber;
  }

  
  public function setDiscussionDate($discussionDate) {
      $this->discussionDate = (!empty($discussionDate)? $discussionDate:null);
      return $this;
  }
  
  public function setDateIssuedToPromoters($dateIssuedToPromoters) {
      $this->dateIssuedToPromoters = (!empty($dateIssuedToPromoters)? $dateIssuedToPromoters:null);
      return $this;
  }

  public function setReportType($reportType) {
      $this->reportType = (!empty($reportType)? $reportType:null);
      return $this;
  }

  public function setSourceOfFunds($sourceOfFunds) {
      $this->sourceOfFunds = (!empty($sourceOfFunds)? $sourceOfFunds: 'MTI-BSSP');
      return $this;
  }

  public function setNumberOfMaleEmployed($numberOfMaleEmployed) {
      $this->numberOfMaleEmployed = (!empty($numberOfMaleEmployed)? $numberOfMaleEmployed:null);
      return $this;
  }

  public function setNumberOfFemaleEmployed($numberOfFemaleEmployed) {
      $this->numberOfFemaleEmployed = (!empty($numberOfFemaleEmployed)? $numberOfFemaleEmployed:null);
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
        $this->id                           =       (!empty($data['id'])? $data['id']:null);
        $this->discussionDate               =       (!empty($data['discussionDate'])? $data['discussionDate']:null);
        $this->dateIssuedToPromoters        =       (!empty($data['dateIssuedToPromoters'])? $data['dateIssuedToPromoters']:null);
        $this->reportType                   =       (!empty($data['reportType'])? $data['reportType']:null);
        $this->sourceOfFunds                =       (!empty($data['sourceOfFunds'])? $data['sourceOfFunds']:null);
        $this->numberOfMaleEmployed         =       (!empty($data['numberOfMaleEmployed'])? $data['numberOfMaleEmployed']:null);
        $this->numberOfFemaleEmployed       =       (!empty($data['numberOfFemaleEmployed'])? $data['numberOfFemaleEmployed']:null);        
        $this->implementationRemarks                      =       (!empty($data['implementationRemarks'])? $data['implementationRemarks']:null);
        $this->projectNumber                =       (!empty($data['projectNumber'])? $data['projectNumber']:null);
        $this->createdBy                    =       (!empty($data['createdBy'])? $data['createdBy']:null);
        $this->createdOn                    =       (!empty($data['createdOn'])? $data['createdOn']:null);
        $this->modifiedBy                   =       (!empty($data['modifiedBy'])? $data['modifiedBy']:null);
        $this->modifiedOn                   =       (!empty($data['modifiedOn'])? $data['modifiedOn']:null);
    }

}