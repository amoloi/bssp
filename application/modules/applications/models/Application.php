<?php

class Applications_Model_Application extends JBlac_ObjectModel
{

  protected $id                         =                null;
  protected $promoter                	=                null;
  protected $businessName               =                null;
  protected $businessSector             =                null;
  protected $businessActivity           =                null;
  protected $requestType                =                null;
  protected $telephoneNumber            =                null;
  protected $mobileNumber               =                null;
  protected $faxNumber                	=                null;
  protected $emailAddress               =                null;
  protected $postalAddress              =                null;
  protected $residentialAddress         =                null;
  protected $region                	=                null;
  protected $town                	=                null;
  protected $applicationDate            =                null;
  protected $acknowledgementDate        =                null;

  function getId() {
      return $this->id;
  }

  function getPromoter() {
      return $this->promoter;
  }

  function getBusinessName() {
      return $this->businessName;
  }

  function getBusinessSector() {
      return $this->businessSector;
  }

  function getBusinessActivity() {
      return $this->businessActivity;
  }

  function getRequestType() {
      return $this->requestType;
  }

  function getTelephoneNumber() {
      return $this->telephoneNumber;
  }

  function getMobileNumber() {
      return $this->mobileNumber;
  }

  function getFaxNumber() {
      return $this->faxNumber;
  }

  function getEmailAddress() {
      return $this->emailAddress;
  }
  function getPostalAddress() {
      return $this->postalAddress;
  }

  function getResidentialAddress() {
      return $this->residentialAddress;
  }
  function getRegion() {
      return $this->region;
  }

  function getTown() {
      return $this->town;
  }

  function getApplicationDate() {
      return $this->applicationDate;
  }

  function getAcknowledgementDate() {
      return $this->acknowledgementDate;
  }

  function setId($id) {
      $this->id = $id;
      return $this;
  }

  function setPromoter($promoter) {
      $this->promoter = (!empty($promoter)? $promoter:null);
      return $this;
  }

  function setBusinessName($businessName) {
      $this->businessName = (!empty($businessName)? $businessName:null);
      return $this;
  }

  function setBusinessSector($businessSector) {
      $this->businessSector = (!empty($businessSector)? $businessSector:null);
      return $this;
  }

  function setBusinessActivity($businessActivity) {
      $this->businessActivity = (!empty($businessActivity)? $businessActivity:null);
      return $this;
  }

  function setRequestType($requestType) {
      $this->requestType = (!empty($requestType)? $requestType:null);
      return $this;
  }

  function setTelephoneNumber($telephoneNumber) {
      $this->telephoneNumber = (!empty($telephoneNumber)? $telephoneNumber:null);
      return $this;
  }

  function setMobileNumber($mobileNumber) {
      $this->mobileNumber = (!empty($mobileNumber)? $mobileNumber:null);
      return $this;
  }

  function setFaxNumber($faxNumber) {
      $this->faxNumber = (!empty($faxNumber)? $faxNumber:null);
      return $this;
  }

  function setEmailAddress($emailAddress) {
      $this->emailAddress = (!empty($emailAddress)? $emailAddress:null);
      return $this;
  }
  
  function setPostalAddress($postalAddress) {
      $this->postalAddress = (!empty($postalAddress)? $postalAddress:null);
      return $this;
  }

  function setResidentialAddress($residentialAddress) {
      $this->residentialAddress = (!empty($residentialAddress)? $residentialAddress:null);
      return $this;
  }
  
  function setRegion($region) {
      $this->region = (!empty($region)? $region:null);
      return $this;
  }

  function setTown($town) {
      $this->town = (!empty($town)? $town:null);
      return $this;
  }

  function setApplicationDate($applicationDate) {
      $this->applicationDate = (!empty($applicationDate)? $applicationDate:date('Y-m-d'));
      return $this;
  }

  function setAcknowledgementDate($acknowledgementDate) {
      $this->acknowledgementDate = (!empty($acknowledgementDate)? $acknowledgementDate:null);
      return $this;
  }

    
    public function exchangeArray($data){
        $this->id                   =   (!empty($data['id'])? $data['id']:null);
        $this->promoter                 =   (!empty($data['promoter'])? $data['promoter']:null);
        $this->businessName                =   (!empty($data['businessName'])? $data['businessName']:null);
        $this->businessSector          =   (!empty($data['businessSector'])? $data['businessSector']:null);
        $this->businessActivity                 =   (!empty($data['businessActivity'])? $data['businessActivity']:null);
        $this->requestType                 =   (!empty($data['requestType'])? $data['requestType']:null);
        $this->telephoneNumber                 =   (!empty($data['telephoneNumber'])? $data['telephoneNumber']:null);
        $this->mobileNumber                 =   (!empty($data['mobileNumber'])? $data['mobileNumber']:null);
        $this->faxNumber                 =   (!empty($data['faxNumber'])? $data['faxNumber']:null);
        $this->emailAddress                 =   (!empty($data['emailAddress'])? $data['emailAddress']:null);
        $this->region                 =   (!empty($data['region'])? $data['region']:null);
        $this->town                 =   (!empty($data['town'])? $data['town']:null);
        $this->applicationDate                 =   (!empty($data['applicationDate'])? $data['applicationDate']:null);
        $this->acknowledgementDate                 =   (!empty($data['acknowledgementDate'])? $data['acknowledgementDate']:null);
        $this->createdBy            =   (!empty($data['createdBy'])? $data['createdBy']:null);
        $this->createdOn            =   (!empty($data['createdOn'])? $data['createdOn']:null);
        $this->modifiedBy           =   (!empty($data['modifiedBy'])? $data['modifiedBy']:null);
        $this->modifiedOn           =   (!empty($data['modifiedOn'])? $data['modifiedOn']:null);
    }

}