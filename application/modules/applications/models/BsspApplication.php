<?php

class Applications_Model_BsspApplication extends JBlac_ObjectModel
{

  protected $id                                         =                null;
  protected $applicationNumber                          =                null;
  protected $applicationDate                            =                null;
  protected $applicationAcknowledgementDate             =                null;
  protected $applicationLegalEntityId                   =                null;
  protected $applicationLegalEntityType                   =                null;
  
  protected $applicationRequests                                   =                [];
          
  function getId() {
      return $this->id;
  }
  public function getApplicationNumber() {
      return $this->applicationNumber;
  }
  
  public function getApplicationLegalEntityId() {
      return $this->applicationLegalEntityId;
  }
  public function getApplicationLegalEntityType() {
      return $this->applicationLegalEntityType;
  }

    function getApplicationDate() {
      return $this->applicationDate;
  }

  public function getApplicationAcknowledgementDate() {
      return $this->applicationAcknowledgementDate;
  }
  
  public function getApplicationRequests() {
      return $this->applicationRequests;
  }
  
  function setId($id) {
      $this->id = $id;
      return $this;
  }
  
  public function setApplicationNumber($applicationNumber) {
      $this->applicationNumber = (!empty($applicationNumber)? $applicationNumber:null);
      return $this;
  }
  public function setApplicationLegalEntityId($applicationLegalEntityId) {
      $this->applicationLegalEntityId = (!empty($applicationLegalEntityId)? $applicationLegalEntityId:null);
      return $this;
  }
  public function setApplicationLegalEntityType($applicationLegalEntityType) {
      $this->applicationLegalEntityType = (!empty($applicationLegalEntityType)? $applicationLegalEntityType:null);
      return $this;
  }

    function setApplicationDate($applicationDate) {
      $this->applicationDate = (!empty($applicationDate)? $applicationDate:date('Y-m-d'));
      return $this;
  }
  
  public function setApplicationAcknowledgementDate($applicationAcknowledgementDate) {
      $this->applicationAcknowledgementDate = (!empty($applicationAcknowledgementDate)? $applicationAcknowledgementDate:null);
      return $this;
  }
  public function setApplicationRequest($applicationRequest) {
      array_push($this->applicationRequests ,$applicationRequest );
      return $this;
  }
  public function setApplicationRequests($applicationRequests) {
      $this->applicationRequests = $applicationRequests;
      return $this;
  }

  
  public function exchangeArray($data){
        $this->id                           =   (!empty($data['id'])? $data['id']:null);
        $this->applicationNumber                       =   (!empty($data['applicationNumber'])? $data['applicationNumber']:null);
        $this->legalEntityId                    =   (!empty($data['legalEntityId'])? $data['legalEntityId']:null);
        $this->applicationDate              =   (!empty($data['applicationDate'])? $data['applicationDate']:null);
        $this->applicationAcknowledgementDate          =   (!empty($data['applicationAcknowledgementDate'])? $data['applicationAcknowledgementDate']:null);
        $this->createdBy                    =   (!empty($data['createdBy'])? $data['createdBy']:null);
        $this->createdOn                    =   (!empty($data['createdOn'])? $data['createdOn']:null);
        $this->modifiedBy                   =   (!empty($data['modifiedBy'])? $data['modifiedBy']:null);
        $this->modifiedOn                   =   (!empty($data['modifiedOn'])? $data['modifiedOn']:null);
  }

}