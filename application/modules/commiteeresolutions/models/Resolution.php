<?php

class Commiteeresolutions_Model_Resolution extends JBlac_ObjectModel
{
    
    protected $discussionDate             =     null;
    protected $discussionStatus           =     null;
    protected $corespondenceDate          =     null;
    protected $requestType                =     null;    
    protected $consultantId               =     null;
    protected $principleConsultant               =     null;   
    protected $fundsId                    =     null;
    protected $projectId                  =     null;
    protected $projectNumber              =     null;
    protected $requestNumber              =     null; 

  public function getDiscussionDate() {
      return $this->discussionDate;
  }

  public function getDiscussionStatus() {
      return $this->discussionStatus;
  }

  public function getRequestType() {
      return $this->requestType;
  }

  public function getCorespondenceDate() {
      return $this->corespondenceDate;
  }

  public function getConsultantId() {
      return $this->consultantId;
  }
    public function getPrincipleConsultant() {
        return $this->principleConsultant;
    }  
  public function getFundsId() {
      return $this->fundsId;
  }
  public function getProjectId() {
      return $this->projectId;
  }
  public function getProjectNumber() {
      return $this->projectNumber;
  }
  public function getRequestNumber() {
      return $this->requestNumber;
  }

  
  public function setDiscussionDate($discussionDate) {
      $this->discussionDate = (!empty($discussionDate)? $discussionDate:null);
      return $this;
  }

  public function setDiscussionStatus($discussionStatus) {
      $this->discussionStatus = (!empty($discussionStatus)? $discussionStatus:null);
      return $this;
  }

  public function setRequestType($requestType) {
      $this->requestType = (!empty($requestType)? $requestType:null);
      return $this;
  }

  public function setCorespondenceDate($corespondenceDate) {
      $this->corespondenceDate = (!empty($corespondenceDate)? $corespondenceDate:null);
      return $this;
  }

  public function setConsultantId($consultantId) {
      $this->consultantId = (!empty($consultantId)? $consultantId:null);
      return $this;
  }
    public function setPrincipleConsultant($principleConsultant) {
        $this->principleConsultant = (!empty($principleConsultant)? $principleConsultant:null);
        return $this;
    }  
  public function setFundsId($fundsId) {
      $this->fundsId = (!empty($fundsId)? $fundsId:null);
      return $this;
  }
  public function setProjectNumber($projectNumber) {
      $this->projectNumber = (!empty($projectNumber)? $projectNumber:null);
      return $this;
  }
  public function setRequestNumber($requestNumber) {
      $this->requestNumber = (!empty($requestNumber)? $requestNumber:null);
      return $this;
  }

  
  public function setProjectId($projectId) {
      $this->projectId = (!empty($projectId)? $projectId:null);
      return $this;
  }
  
  public function exchangeArray($data){
        $this->id                       =   (!empty($data['id'])? $data['id']:null);
        $this->discussionDate           =   (!empty($data['discussionDate'])? $data['discussionDate']:null);
        $this->discussionStatus         =   (!empty($data['discussionStatus'])? $data['discussionStatus']:null);
        $this->requestType              =   (!empty($data['requestType'])? $data['requestType']:null);
        $this->corespondenceDate        =   (!empty($data['corespondenceDate'])? $data['corespondenceDate']:null);
        $this->consultantId             =   (!empty($data['consultantId'])? $data['consultantId']:null);
        $this->principleConsultant             =   (!empty($data['principleConsultant'])? $data['principleConsultant']:null);
        $this->fundsId                  =   (!empty($data['fundsId'])? $data['fundsId']:null);        
        $this->projectId                =   (!empty($data['projectId'])? $data['projectId']:null);
        $this->projectNumber            =   (!empty($data['projectNumber'])? $data['projectNumber']:null);
        $this->requestNumber            =   (!empty($data['requestNumber'])? $data['requestNumber']:null);
        $this->createdBy                =   (!empty($data['createdBy'])? $data['createdBy']:null);
        $this->createdOn                =   (!empty($data['createdOn'])? $data['createdOn']:null);
        $this->modifiedBy               =   (!empty($data['modifiedBy'])? $data['modifiedBy']:null);
        $this->modifiedOn               =   (!empty($data['modifiedOn'])? $data['modifiedOn']:null);
    }

}