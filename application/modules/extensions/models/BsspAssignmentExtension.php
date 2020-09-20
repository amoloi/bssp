<?php

class Extensions_Model_BsspAssignmentExtension extends JBlac_ObjectModel
{
    protected $id                                   =   null;   
    protected $assignmentExtensionPhase             =   null;
    protected $assignmentExtensionDiscussionDate    =   null;
    protected $assignmentExtendedFromDate           =   null;
    protected $assignmentExtendedToDate             =   null;
    protected $assignmentExtensionRemarks           =   null;

    /*
     * Refference Data
     */


    protected $assignmentExtensionProjectNumber     =     null;

    
    public function getId() {
        return $this->id;
    }
    public function getAssignmentExtensionPhase() {
        return $this->assignmentExtensionPhase;
    }

    public function getAssignmentExtensionDiscussionDate() {
        return $this->assignmentExtensionDiscussionDate;
    }
    public function getAssignmentExtendedFromDate() {
        return $this->assignmentExtendedFromDate;
    }

    public function getAssignmentExtendedToDate() {
        return $this->assignmentExtendedToDate;
    }

    public function getAssignmentExtensionRemarks() {
        return $this->assignmentExtensionRemarks;
    }

    public function getAssignmentExtensionProjectNumber() {
        return $this->assignmentExtensionProjectNumber;
    }

    public function setId($id) {
        $this->id = (!empty($id)? $id:null);
        return $this;
    }
    public function setAssignmentExtensionPhase($assignmentExtensionPhase) {
        $this->assignmentExtensionPhase = (!empty($assignmentExtensionPhase)? $assignmentExtensionPhase:null);
        return $this;
    }

    public function setAssignmentExtensionDiscussionDate($assignmentExtensionDiscussionDate) {
        $this->assignmentExtensionDiscussionDate = (!empty($assignmentExtensionDiscussionDate)? $assignmentExtensionDiscussionDate:null);
        return $this;
    }

    public function setAssignmentExtendedFromDate($assignmentExtendedFromDate) {
        $this->assignmentExtendedFromDate = (!empty($assignmentExtendedFromDate)? $assignmentExtendedFromDate:null);
        return $this;
    }
    public function setAssignmentExtendedToDate($assignmentExtendedToDate) {
        $this->assignmentExtendedToDate = (!empty($assignmentExtendedToDate)? $assignmentExtendedToDate:null);
        return $this;
    }

    public function setAssignmentExtensionRemarks($assignmentExtensionRemarks) {
        $this->assignmentExtensionRemarks = (!empty($assignmentExtensionRemarks)? $assignmentExtensionRemarks:null);
        return $this;
    }

    public function setAssignmentExtensionProjectNumber($assignmentExtensionProjectNumber) {
        $this->assignmentExtensionProjectNumber = (!empty($assignmentExtensionProjectNumber)? $assignmentExtensionProjectNumber:null);
        return $this;
    }

    
   
}