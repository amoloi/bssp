<?php

class Payments_Model_BsspPaymentInstallment extends JBlac_ObjectModel
{

  protected $amount		= 	null;
  protected $phase              = 	null;
  protected $dateOfPayment         = 	null;
  protected $budgetNumber            = 	null;
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
  public function getBudgetNumber() {
      return $this->budgetNumber;
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
      $this->dateOfPayment = (!empty($dateOfPayment)? $dateOfPayment:null);
      return $this;
  }
  public function setBudgetNumber($budgetNumber) {
      $this->budgetNumber = (!empty($budgetNumber)? $budgetNumber:null);
      return $this;
  }

  public function setRemarks($remarks) {
      $this->remarks = (!empty($remarks)? $remarks:null);
      return $this;
  }
}