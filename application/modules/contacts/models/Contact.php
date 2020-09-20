<?php

class Contacts_Model_Contact extends JBlac_ObjectModel
{
    protected $id = null;
    protected $contactFirstName = null;
    protected $contactMiddleName = null;
    protected $contactLastName = null;
    protected $contactTitle = null;
    protected $contactPosition = null;

    
    /*
     * Linkage to legal entities
     */
    
    protected $legalEntityId = null;


    public function getId() {
        return $this->id;
    }

    public function getContactFirstName() {
        return $this->contactFirstName;
    }

    public function getContactMiddleName() {
        return $this->contactMiddleName;
    }

    public function getContactLastName() {
        return $this->contactLastName;
    }

    public function getContactTitle() {
        return $this->contactTitle;
    }

    public function getContactPosition() {
        return $this->contactPosition;
    }

    public function getLegalEntityId() {
        return $this->legalEntityId;
    }
    
    public function setId($id) {
        $this->id = (!empty($id)? $id:null);
        return $this;
    }
    public function setContactFirstName($contactFirstName) {
        $this->contactFirstName = (!empty($contactFirstName)? $contactFirstName:null);
        return $this;
    }

    public function setContactMiddleName($contactMiddleName) {
        $this->contactMiddleName = (!empty($contactMiddleName)? $contactMiddleName:null);
        return $this;
    }

    public function setContactLastName($contactLastName) {
        $this->contactLastName = (!empty($contactLastName)? $contactLastName:null);
        return $this;
    }

    public function setContactTitle($contactTitle) {
        $this->contactTitle = (!empty($contactTitle)? $contactTitle:null);
        return $this;
    }

    public function setContactPosition($contactPosition) {
        $this->contactPosition = (!empty($contactPosition)? $contactPosition:null);
        return $this;
    }

    public function setLegalEntityId($legalEntityId) {
        $this->legalEntityId = (!empty($legalEntityId)? $legalEntityId:null);
        return $this;
    } 
}