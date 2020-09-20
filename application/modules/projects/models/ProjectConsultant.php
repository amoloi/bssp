<?php

class Projects_Model_ProjectConsultant extends JBlac_ObjectModel
{
    protected $id = null;
    protected $legalEntityId = null;    
    protected $projectNumber = null;
    protected $principleConsultant = null;
    protected $status = null;

    
    public function getId() {
        return $this->id;
    }    
    public function getLegalEntityId() {
        return $this->legalEntityId;
    }

    public function getProjectNumber() {
        return $this->projectNumber;
    }

    public function getPrincipleConsultant() {
        return $this->principleConsultant;
    }

    public function getStatus() {
        return $this->status;
    }
    
    public function setId($id) {
        $this->id = (!empty($id)? $id:null);
        return $this;
    }
    
    public function setLegalEntityId($legalEntityId) {
        $this->legalEntityId = (!empty($legalEntityId)? $legalEntityId:null);
        return $this;
    }

    public function setProjectNumber($projectNumber) {
        $this->projectNumber = (!empty($projectNumber)? $projectNumber:null);
        return $this;
    }

    public function setPrincipleConsultant($principleConsultant) {
        $this->principleConsultant = (!empty($principleConsultant)? $principleConsultant:null);
        return $this;
    }

    public function setStatus($status) {
        $this->status = (!empty($status)? $status:null);
        return $this;
    }
}