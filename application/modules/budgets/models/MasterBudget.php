<?php

class Budgets_Model_MasterBudget extends JBlac_ObjectModel
{

  protected $code              = 	null;
  protected $name              = 	null;
  protected $period            = 	null;
  protected $amount            = 	null;
  protected $description       = 	null;
  protected $GLAccount         = 	null;

  public function getCode() {
      return $this->code;
  }

  public function getName() {
      return $this->name;
  }

  public function getPeriod() {
      return $this->period;
  }

  public function getAmount() {
      return $this->amount;
  }

  public function getDescription() {
      return $this->description;
  }

  public function getGLAccount() {
      return $this->GLAccount;
  }

  public function setCode($code) {
      $this->code = (!empty($code)? $code:null);
      return $this;
  }

  public function setName($name) {
      $this->name = (!empty($name)? $name:null);
      return $this;
  }

  public function setPeriod($period) {
      $this->period = (!empty($period)? $period:null);
      return $this;
  }

  public function setAmount($amount) {
      $this->amount = (!empty($amount)? $amount:null);
      return $this;
  }

  public function setDescription($description) {
      $this->description = (!empty($description)? $description:null);
      return $this;
  }

  public function setGLAccount($GLAccount) {
      $this->GLAccount = (!empty($GLAccount)? $GLAccount:null);
      return $this;
  }  
}