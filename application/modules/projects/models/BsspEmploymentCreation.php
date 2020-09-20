<?php

class Projects_Model_BsspEmploymentCreation extends JBlac_ObjectModel
{
   
    protected $employmentNumberOfMales                      =     null;
    protected $employmentNumberOfFemales                    =     null;
    protected $employmentDateOfEmployment                   =     null;     
    protected $employmentRemarks                            =     null;
    protected $projectNumber                                =     null;    

    public function getProjectNumber() {
        return $this->projectNumber;
    }

    public function getEmploymentDateOfEmployment() {
        return $this->employmentDateOfEmployment;
    }

    public function getEmploymentNumberOfMales() {
        return $this->employmentNumberOfMales;
    }

    public function getEmploymentNumberOfFemales() {
        return $this->employmentNumberOfFemales;
    }

    public function getEmploymentRemarks() {
        return $this->employmentRemarks;
    }

    public function setEmploymentDateOfEmployment($employmentDateOfEmployment) {
        $this->employmentDateOfEmployment = (!empty($employmentDateOfEmployment)? $employmentDateOfEmployment:null);
        return $this;
    }

    public function setEmploymentNumberOfMales($employmentNumberOfMales) {
        $this->employmentNumberOfMales = (!empty($employmentNumberOfMales)? $employmentNumberOfMales:null);
        return $this;
    }

    public function setEmploymentNumberOfFemales($employmentNumberOfFemales) {
        $this->employmentNumberOfFemales = (!empty($employmentNumberOfFemales)? $employmentNumberOfFemales:null);
        return $this;
    }

    public function setEmploymentRemarks($employmentRemarks) {
        $this->employmentRemarks = (!empty($employmentRemarks)? $employmentRemarks:null);
        return $this;
    }      

  public function setProjectNumber($projectNumber) {
      $this->projectNumber = (!empty($projectNumber)? $projectNumber:null);
      return $this;
  }
    
  public function exchangeArray($data){
        $this->id                           =       (!empty($data['id'])? $data['id']:null);
        $this->employmentNumberOfMales      =       (!empty($data['employmentNumberOfMales'])? $data['employmentNumberOfMales']:null);
        $this->employmentNumberOfFemales    =       (!empty($data['employmentNumberOfFemales'])? $data['employmentNumberOfFemales']:null);
        $this->employmentDateOfEmployment   =       (!empty($data['employmentDateOfEmployment'])? $data['employmentDateOfEmployment']:null);
        $this->employmentRemarks            =       (!empty($data['employmentRemarks'])? $data['employmentRemarks']:null);
        $this->projectNumber                =       (!empty($data['projectNumber'])? $data['projectNumber']:null);
        $this->createdBy                    =       (!empty($data['createdBy'])? $data['createdBy']:null);
        $this->createdOn                    =       (!empty($data['createdOn'])? $data['createdOn']:null);
        $this->modifiedBy                   =       (!empty($data['modifiedBy'])? $data['modifiedBy']:null);
        $this->modifiedOn                   =       (!empty($data['modifiedOn'])? $data['modifiedOn']:null);
    }

}