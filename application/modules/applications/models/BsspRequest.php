<?php

class Applications_Model_BsspRequest extends JBlac_ObjectModel
{

  protected $id                             =            null;
  protected $requestNumber                  =            null;  
  protected $requestType                    =            null;
  protected $otherRequestTypeText           =            null;
  protected $requestSector                  =            null;
  protected $requestPriotityArea            =            null;
  protected $requestBusinessActivity        =            null;
  protected $requestStatus                  =            null;
  protected $requestRemarks                 =            null;
  protected $applicationNumber              =            null;

  
  public function getId() {
      return $this->id;
  }
  public function getRequestNumber() {
      return $this->requestNumber;
  }

  public function getRequestType() {
      return $this->requestType;
  }
  public function getOtherRequestTypeText() {
      return $this->otherRequestTypeText;
  }
  public function getRequestSector() {
      return $this->requestSector;
  }

  public function getRequestPriotityArea() {
      return $this->requestPriotityArea;
  }

  public function getRequestBusinessActivity() {
      return $this->requestBusinessActivity;
  }

  public function getRequestStatus() {
      return $this->requestStatus;
  }

  public function getRequestRemarks() {
      return $this->requestRemarks;
  }

  public function getApplicationNumber() {
      return $this->applicationNumber;
  }

  
  public function setId($id) {
      $this->id = $id;
      return $this;
  }
  public function setRequestNumber($requestNumber) {
      $this->requestNumber = (!empty($requestNumber)? $requestNumber:JBlac_Utilities_BSSP::getRequestNumber());
      return $this;
  }

  function setRequestType($requestType) {
      $this->requestType = (!empty($requestType)? $requestType:null);
      return $this;
  }
  public function setOtherRequestTypeText($otherRequestTypeText) {
      $this->otherRequestTypeText = (!empty($otherRequestTypeText)? $otherRequestTypeText:null);
      return $this;
  }
  
  public function setRequestSector($requestSector) {
      $this->requestSector = (!empty($requestSector)? $requestSector:null);
      return $this;
  }

  public function setRequestPriotityArea($requestPriotityArea) {
      $this->requestPriotityArea = (!empty($requestPriotityArea)? $requestPriotityArea:null);
      return $this;
  }

  public function setRequestBusinessActivity($requestBusinessActivity) {
      $this->requestBusinessActivity = (!empty($requestBusinessActivity)? $requestBusinessActivity:null);
      return $this;
  }

  public function setRequestRemarks($requestRemarks) {
      $this->requestRemarks = (!empty($requestRemarks)? $requestRemarks:null);
      return $this;
  }

  
  public function setRequestStatus($requestStatus) {
      $this->requestStatus = (!empty($requestStatus)? $requestStatus:null);
      return $this;
  }

  public function setApplicationNumber($applicationNumber) {
      $this->applicationNumber = (!empty($applicationNumber)? $applicationNumber:null);
      return $this;
  }

  
    public function exchangeArray($data){
        $this->id                           =   (!empty($data['id'])? $data['id']:null);
        $this->requestType                       =   (!empty($data['requestType'])? $data['requestType']:null);
        $this->requestPriotityArea                    =   (!empty($data['requestPriotityArea'])? $data['requestPriotityArea']:null);
        $this->requestBusinessActivity                  =   (!empty($data['requestBusinessActivity'])? $data['requestBusinessActivity']:null);
        $this->requestStatus              =   (!empty($data['requestStatus'])? $data['requestStatus']:null);
        $this->requestRemarks          =   (!empty($data['requestRemarks'])? $data['requestRemarks']:null);
        $this->applicationNumber               =   (!empty($data['applicationNumber'])? $data['applicationNumber']:null);
        $this->createdBy                    =   (!empty($data['createdBy'])? $data['createdBy']:null);
        $this->createdOn                    =   (!empty($data['createdOn'])? $data['createdOn']:null);
        $this->modifiedBy                   =   (!empty($data['modifiedBy'])? $data['modifiedBy']:null);
        $this->modifiedOn                   =   (!empty($data['modifiedOn'])? $data['modifiedOn']:null);
    }

}