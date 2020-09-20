<?php

class Commiteeresolutions_Model_BsspResolution extends JBlac_ObjectModel
{
    
    protected $resolutionDiscussionDate             =     null;
    protected $resolutionDiscussionStatus           =     null;
    protected $resolutionCorespondenceDate          =     null;
    protected $resolutionRemarks                =     null;
    protected $resolutionRemarksDescription     =   null;
    protected $resolution_requestNumber               =     null;


    public function getResolutionDiscussionDate() {
        return $this->resolutionDiscussionDate;
    }

    public function getResolutionDiscussionStatus() {
        return $this->resolutionDiscussionStatus;
    }

    public function getResolutionCorespondenceDate() {
        return $this->resolutionCorespondenceDate;
    }

    public function getResolutionRemarks() {
        return $this->resolutionRemarks;
    }
    public function getResolutionRemarksDescription() {
        return $this->resolutionRemarksDescription;
    }

    public function getResolution_requestNumber() {
        return $this->resolution_requestNumber;
    }

    public function setResolutionDiscussionDate($resolutionDiscussionDate) {
        $this->resolutionDiscussionDate = (!empty($resolutionDiscussionDate)? $resolutionDiscussionDate:date('Y-m-d'));
        return $this;
    }

    public function setResolutionDiscussionStatus($resolutionDiscussionStatus) {
        $this->resolutionDiscussionStatus = (!empty($resolutionDiscussionStatus)? $resolutionDiscussionStatus:'PENDING');
        return $this;
    }

    public function setResolutionCorespondenceDate($resolutionCorespondenceDate) {
        $this->resolutionCorespondenceDate = (!empty($resolutionCorespondenceDate)? $resolutionCorespondenceDate:null);
        return $this;
    }

    public function setResolutionRemarks($resolutionRemarks) {
        $this->resolutionRemarks = (!empty($resolutionRemarks)? $resolutionRemarks:null);
        return $this;
    }
    
    public function setResolutionRemarksDescription($resolutionRemarksDescription) {
        $this->resolutionRemarksDescription = (!empty($resolutionRemarksDescription)? $resolutionRemarksDescription:null);
        return $this;
    }
    
    public function setResolution_requestNumber($resolution_requestNumber) {
        $this->resolution_requestNumber = (!empty($resolution_requestNumber)? $resolution_requestNumber:null);
        return $this;
    }
  
  public function exchangeArray($data){
        $this->id                       =   (!empty($data['id'])? $data['id']:null);
        $this->resolutionDiscussionDate           =   (!empty($data['resolutionDiscussionDate'])? $data['resolutionDiscussionDate']:null);
        $this->resolutionDiscussionStatus         =   (!empty($data['resolutionDiscussionStatus'])? $data['resolutionDiscussionStatus']:null);
        $this->resolutionCorespondenceDate              =   (!empty($data['resolutionCorespondenceDate'])? $data['resolutionCorespondenceDate']:null);
        $this->resolutionRemarks        =   (!empty($data['resolutionRemarks'])? $data['resolutionRemarks']:null);
        $this->resolutionRemarksDescription        =   (!empty($data['resolutionRemarksDescription'])? $data['resolutionRemarksDescription']:null);
        $this->resolution_requestNumber             =   (!empty($data['resolution_requestNumber'])? $data['resolution_requestNumber']:null);
        $this->createdBy                =   (!empty($data['createdBy'])? $data['createdBy']:null);
        $this->createdOn                =   (!empty($data['createdOn'])? $data['createdOn']:null);
        $this->modifiedBy               =   (!empty($data['modifiedBy'])? $data['modifiedBy']:null);
        $this->modifiedOn               =   (!empty($data['modifiedOn'])? $data['modifiedOn']:null);
    }

}