<?php

class JBlac_Models_Address extends JBlac_ObjectModel
{
    protected $id = null;
    protected $addressLineOne = null;    
    protected $addressLineTwo = null;
    protected $postalAddress = null;
    protected $regionCode = null;
    protected $cityCode = null;
    protected $countryCode = null;
    protected $constituencyCode = null;
    protected $legalEntityId = null;


    public function getId() {
        return $this->id;
    }

    public function getAddressLineOne() {
        return $this->addressLineOne;
    }

    public function getAddressLineTwo() {
        return $this->addressLineTwo;
    }

    public function getPostalAddress() {
        return $this->postalAddress;
    }

    public function getRegionCode() {
        return $this->regionCode;
    }

    public function getCityCode() {
        return $this->cityCode;
    }

    public function getCountryCode() {
        return $this->countryCode;
    }
    public function getConstituencyCode() {
        return $this->constituencyCode;
    }

    public function getLegalEntityId() {
        return $this->legalEntityId;
    }

    public function setId($id) {
        $this->id = (!empty($id)? $id:null);
        return $this;
    }

    public function setAddressLineOne($addressLineOne) {
        $this->addressLineOne = (!empty($addressLineOne)? $addressLineOne:null);
        return $this;
    }

    public function setAddressLineTwo($addressLineTwo) {
        $this->addressLineTwo = (!empty($addressLineTwo)? $addressLineTwo:null);
        return $this;
    }

    public function setPostalAddress($postalAddress) {
        $this->postalAddress = (!empty($postalAddress)? $postalAddress:null);
        return $this;
    }

    public function setRegionCode($regionCode) {
        $this->regionCode = (!empty($regionCode)? $regionCode:null);
        return $this;
    }

    public function setCityCode($cityCode) {
        $this->cityCode = (!empty($cityCode)? $cityCode:null);
        return $this;
    }

    public function setCountryCode($countryCode) {
        $this->countryCode = (!empty($countryCode)? $countryCode:null);
        return $this;
    }
    public function setConstituencyCode($constituencyCode) {
        $this->constituencyCode = (!empty($constituencyCode)? $constituencyCode:null);
        return $this;
    }
    public function setLegalEntityId($legalEntityId) {
        $this->legalEntityId = (!empty($legalEntityId)? $legalEntityId:null);
        return $this;
    }
}