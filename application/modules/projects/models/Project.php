<?php

class Projects_Model_Project extends JBlac_ObjectModel
{
    protected $id                   =   null; 
    protected $number               =   null;
    protected $name                 =   null;
    protected $description          =   null;
    protected $status               =   null;
    protected $startDate            =   null;
    protected $endDate              =   null;
    
    
    /*
     * Application related 
     */
    
    protected $applicationId = null;
    protected $applicationNumber = null;    
    protected $requestNumber = null;
    
    /**
     * Control Variable
     */
    
    protected $isDisscussed = 'N';

    public function getId() {
        return $this->id;
    }
    public function getNumber() {
        return $this->number;
    }

    public function getName() {
        return $this->name;
    }
    
    public function getDescription() {
        return $this->description;
    }

    public function getStatus() {
        return $this->status;
    }
    public function getStartDate() {
        return $this->startDate;
    }

    public function getEndDate() {
        return $this->endDate;
    } 
    public function getApplicationId() {
        return $this->applicationId;
    }
    public function getApplicationNumber() {
        return $this->applicationNumber;
    }

    
    public function getRequestNumber() {
        return $this->requestNumber;
    }

        public function setId($id) {
        $this->id = (!empty($id)? $id:null);
        return $this;
    }
    public function getIsDisscussed() {
        return $this->isDisscussed;
    }


    public function setName($name) {
        $this->name = (!empty($name)? $name:null);
        return $this;
    }

    public function setNumber($number) {
        $this->number = (!empty($number)? $number:JBlac_Utilities_BSSP::getProjectNumber());
        return $this;
    }

    public function setDescription($description) {
        $this->description = (!empty($description)? $description:null);
        return $this;
    }

    public function setStatus($status) {
        $this->status = (!empty($status)? $status:null);
        return $this;
    }
    public function setStartDate($startDate) {
        $this->startDate = (!empty($startDate)? $startDate:null);
        return $this;
    }

    public function setEndDate($endDate) {
        $this->endDate = (!empty($endDate)? $endDate:null);
        return $this;
    }
    
    public function setApplicationId($applicationId) {
        $this->applicationId = (!empty($applicationId)? $applicationId:null);
        return $this;
    }
    public function setApplicationNumber($applicationNumber) {
        $this->applicationNumber = (!empty($applicationNumber)? $applicationNumber:null);
        return $this;
    }

    
    public function setRequestNumber($requestNumber) {
        $this->requestNumber = (!empty($requestNumber)? $requestNumber:null);
        return $this;
    }

    public function setIsDisscussed($isDisscussed) {
        $this->isDisscussed = (!empty($isDisscussed)? $isDisscussed:$this->getIsDisscussed());
        return $this;
    }  
}