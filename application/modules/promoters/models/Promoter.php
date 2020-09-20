<?php

class Promoters_Model_Promoter extends JBlac_ObjectModel
{
    protected $id = null;   
    protected $firstName = null;
    protected $lastName = null;
    protected $identityNumber = null;
    protected $isActive = null;
    protected $telephoneNumber = null;
    protected $mobileNumber = null;
    protected $faxNumber = null;
    protected $emailAddress = null;
    protected $remarks = null;
    
    /*
     * Just in-case the promoter happens to be 
     * an Organization or a Company
     */
    
    protected $companyRegistrationNumber = null;
    protected $companyName = null;
    protected $promoterType = null;   

    public function getId() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getIdentityNumber() {
        return $this->identityNumber;
    }

    public function getIsActive() {
        return $this->isActive;
    }

    public function getTelephoneNumber() {
        return $this->telephoneNumber;
    }
    
    public function getMobileNumber() {
        return $this->mobileNumber;
    }
    
    public function getFaxNumber() {
        return $this->faxNumber;
    }

    public function getEmailAddress() {
        return $this->emailAddress;
    }

    public function getRemarks() {
        return $this->remarks;
    }
    public function getCompanyRegistrationNumber() {
        return $this->companyRegistrationNumber;
    }

    public function getCompanyName() {
        return $this->companyName;
    }

    public function getPromoterType() {
        return $this->promoterType;
    }

    public function setId($id) {
        $this->id = (!empty($id)? $id:null);
        return $this;
    }

    public function setFirstName($firstName) {
        $this->firstName = (!empty($firstName)? $firstName:null);
        return $this;
    }

    public function setLastName($lastName) {
        $this->lastName = (!empty($lastName)? $lastName:null);
        return $this;
    }

    public function setIdentityNumber($identityNumber) {
        $this->identityNumber = (!empty($identityNumber)? $identityNumber:null);
        return $this;
    }

    public function setIsActive($isActive) {
        $this->isActive = (!empty($isActive)? $isActive:null);
        return $this;
    }

    public function setTelephoneNumber($telephoneNumber) {
        $this->telephoneNumber = (!empty($telephoneNumber)? $telephoneNumber:null);
        return $this;
    }
    
    public function setMobileNumber($mobileNumber) {
        $this->mobileNumber = (!empty($mobileNumber)? $mobileNumber:null);
        return $this;
    }
    
    public function setFaxNumber($faxNumber) {
        $this->faxNumber = (!empty($faxNumber)? $faxNumber:null);
        return $this;
    }

    public function setEmailAddress($emailAddress) {
        $this->emailAddress = (!empty($emailAddress)? $emailAddress:null);
        return $this;
    }

    public function setRemarks($remarks) {
        $this->remarks = (!empty($remarks)? $remarks:null);
        return $this;
    }

    public function setCompanyRegistrationNumber($companyRegistrationNumber) {
        $this->companyRegistrationNumber = (!empty($companyRegistrationNumber)? $companyRegistrationNumber:null);
        return $this;
    }

    public function setCompanyName($companyName) {
        $this->companyName = (!empty($companyName)? $companyName:null);
        return $this;
    }

    public function setPromoterType($promoterType) {
        $this->promoterType = (!empty($promoterType)? $promoterType:null);
        return $this;
    }    
}