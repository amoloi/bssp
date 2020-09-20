<?php
/**
 * Description of JBlac_Model_LegalEntity
 *
 * @author Innocent
 */

class JBlac_Models_LegalEntity extends JBlac_ObjectModel{
    protected $id = null;   
    protected $firstName = null;
    protected $middleName = null;
    protected $lastName = null;
    protected $dateOfBirth = null;
    protected $passportNumber = null;    
    protected $identityNumber = null;
    protected $entityType = null;
    protected $entityCategory = null;
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
    
    protected $companyRegistrationNumber    =               null;
    protected $companyName                  =               null;
    protected $businessSector             =                null;
    protected $businessActivity           =                null;
    
    public function getId() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->firstName;
    }
    public function getMiddleName() {
        return $this->middleName;
    }
    public function getLastName() {
        return $this->lastName;
    }
    public function getDateOfBirth() {
        return $this->dateOfBirth;
    }

    public function getPassportNumber() {
        return $this->passportNumber;
    }
    public function getIdentityNumber() {
        return $this->identityNumber;
    }
    public function getEntityType() {
        return $this->entityType;
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
    function getBusinessSector() {
        return $this->businessSector;
    }

    function getBusinessActivity() {
        return $this->businessActivity;
    }

    function getRequestType() {
        return $this->requestType;
    }

    public function getEntityCategory() {
        return $this->entityCategory;
    }

    public function setId($id) {
        $this->id = (!empty($id)? $id:null);
        return $this;
    }

    public function setFirstName($firstName) {
        $this->firstName = (!empty($firstName)? $firstName:null);
        return $this;
    }
    public function setMiddleName($middleName) {
        $this->middleName = (!empty($middleName)? $middleName:null);
        return $this;
    }
    public function setLastName($lastName) {
        $this->lastName = (!empty($lastName)? $lastName:null);
        return $this;
    }
    public function setDateOfBirth($dateOfBirth) {
        $this->dateOfBirth = (!empty($dateOfBirth)? $dateOfBirth:null);
        return $this;
    }

    public function setPassportNumber($passportNumber) {
        $this->passportNumber = (!empty($passportNumber)? $passportNumber:null);
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
    function setBusinessSector($businessSector) {
        $this->businessSector = (!empty($businessSector)? $businessSector:null);
        return $this;
    }

    function setBusinessActivity($businessActivity) {
        $this->businessActivity = (!empty($businessActivity)? $businessActivity:null);
        return $this;
    }

    public function setEntityType($entityType) {
        $this->entityType = (!empty($entityType)? $entityType:null);
        return $this;
    }
    
    public function setEntityCategory($entityCategory) {
        $this->entityCategory = (!empty($entityCategory)? $entityCategory:null);
        return $this;
    }    
}