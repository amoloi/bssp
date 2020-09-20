<?php

class Promoters_Model_Address extends JBlac_ObjectModel
{
    protected $id = null;
    protected $addressLineOne = null;    
    protected $addressLineTwo = null;
    protected $postalAddress = null;
    protected $regionCode = null;
    protected $cityCode = null;
    protected $countryCode = null;
    protected $promoterId = null;

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

    public function getPromoterId() {
        return $this->promoterId;
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

    public function setPromoterId($promoterId) {
        $this->promoterId = (!empty($promoterId)? $promoterId:null);
        return $this;
    }
}