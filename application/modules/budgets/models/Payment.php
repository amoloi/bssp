<?php

class Budgets_Model_Payment extends JBlac_ObjectModel
{

  protected $amount		= 	null;
  protected $phase              = 	null;
  protected $dateOfPayment         = 	null;
  protected $fundsId            = 	null;
  protected $remarks            = 	null;

  public function getAmount() {
      return $this->amount;
  }

  public function getPhase() {
      return $this->phase;
  }

  public function getDateOfPayment() {
      return $this->dateOfPayment;
  }
  public function getFundsId() {
      return $this->fundsId;
  }
  public function getRemarks() {
      return $this->remarks;
  }
  
  public function setAmount($amount) {
      $this->amount = (!empty($amount)? $amount:0);
      return $this;
  }

  public function setPhase($phase) {
      $this->phase = (!empty($phase)? $phase:null);
      return $this;
  }

  public function setDateOfPayment($dateOfPayment) {
      $this->dateOfPayment = JBlac_Utilities_Date::getMySQLDefault($dateOfPayment);
      return $this;
  }
  public function setFundsId($fundsId) {
      $this->fundsId = (!empty($fundsId)? $fundsId:null);
      return $this;
  }

  public function setRemarks($remarks) {
      $this->remarks = (!empty($remarks)? $remarks:null);
      return $this;
  }
}