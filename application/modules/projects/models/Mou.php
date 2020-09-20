<?php

class Projects_Model_Mou extends JBlac_ObjectModel
{
    protected $id                   =   null; 
    protected $signedDate            =   null;
    protected $completionDate              =   null;
    
    
    /*
     * Application related 
     */
    protected $projectNumber               =   null;    
    

    public function getId() {
        return $this->id;
    }
    public function getSignedDate() {
        return $this->signedDate;
    }

    public function getCompletionDate() {
        return $this->completionDate;
    }

    public function getProjectNumber() {
        return $this->projectNumber;
    }

    
    public function setId($id) {
        $this->id = (!empty($id)? $id:null);
        return $this;
    }
    public function setSignedDate($signedDate) {
        $this->signedDate = (!empty($signedDate)? $signedDate:null);
        return $this;
    }

    public function setCompletionDate($completionDate) {
        $this->completionDate = (!empty($completionDate)? $completionDate:null);
        return $this;
    }

    public function setProjectNumber($projectNumber) {
        $this->projectNumber = (!empty($projectNumber)? $projectNumber:null);
        return $this;
    }


}