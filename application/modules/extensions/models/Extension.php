<?php

class Extensions_Model_Extension extends JBlac_ObjectModel
{
    protected $id = null;   
    protected $phase = null;
    protected $discussionDate = null;
    protected $extendedToDate = null;
    protected $remarks = null;



    
    /*
     * Refference Data
     */

    protected $projectNumber                   =     null;

    
    public function getId() {
        return $this->id;
    }
    public function getPhase() {
        return $this->phase;
    }

    public function getDiscussionDate() {
        return $this->discussionDate;
    }

    public function getExtendedToDate() {
        return $this->extendedToDate;
    }

    public function getRemarks() {
        return $this->remarks;
    }

    public function getProjectNumber() {
        return $this->projectNumber;
    }

    public function setId($id) {
        $this->id = (!empty($id)? $id:null);
        return $this;
    }

    public function setPhase($phase) {
        $this->phase = (!empty($phase)? $phase:null);
        return $this;
    }

    public function setDiscussionDate($discussionDate) {
        $this->discussionDate = (!empty($discussionDate)? $discussionDate:null);
        return $this;
    }

    public function setExtendedToDate($extendedToDate) {
        $this->extendedToDate = (!empty($extendedToDate)? $extendedToDate:null);
        return $this;
    }

    public function setRemarks($remarks) {
        $this->remarks = (!empty($remarks)? $remarks:null);
        return $this;
    }
    
    public function setProjectNumber($projectNumber) {
      $this->projectNumber = (!empty($projectNumber)? $projectNumber:null);
      return $this;
    }    
}