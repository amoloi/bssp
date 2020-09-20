<?php

class Budgets_Model_ProjectBudget extends JBlac_ObjectModel
{

  protected $budgetNumber		= 	null;
  protected $budgetName		= 	null;
  protected $budgetAmount           = 	null;
  protected $budgetOutstandingAmount           = 	null;
  protected $budgetDateOfApproval          = 	null;
  protected $budgetRemarks           = 	null;
  protected $masterBudgetNumber           = 	null;
  protected $projectNumber           = 	null;

  
  public function getBudgetNumber() {
      return $this->budgetNumber;
  }

  public function getBudgetName() {
      return $this->budgetName;
  }

  public function getBudgetAmount() {
      return $this->budgetAmount;
  }

  public function getBudgetOutstandingAmount() {
      return $this->budgetOutstandingAmount;
  }

  public function getBudgetDateOfApproval() {
      return $this->budgetDateOfApproval;
  }

  public function getBudgetRemarks() {
      return $this->budgetRemarks;
  }

  public function getMasterBudgetNumber() {
      return $this->masterBudgetNumber;
  }

  public function getProjectNumber() {
      return $this->projectNumber;
  }

  public function setBudgetNumber($budgetNumber) {
      $this->budgetNumber = (!empty($budgetNumber)? $budgetNumber:JBlac_Utilities_BSSP::getProjectBudgetCode());
      return $this;
  }

  public function setBudgetName($budgetName) {
      $this->budgetName = (!empty($budgetName)? $budgetName:null);
      return $this;
  }

  public function setBudgetAmount($budgetAmount) {
      $this->budgetAmount = (!empty($budgetAmount)? $budgetAmount:null);
      return $this;
  }

  public function setBudgetOutstandingAmount($budgetOutstandingAmount) {
      $this->budgetOutstandingAmount = (!empty($budgetOutstandingAmount)? $budgetOutstandingAmount:null);
      return $this;
  }

  public function setBudgetDateOfApproval($budgetDateOfApproval) {
      $this->budgetDateOfApproval = (!empty($budgetDateOfApproval)? $budgetDateOfApproval:null);
      return $this;
  }

  public function setBudgetRemarks($budgetRemarks) {
      $this->budgetRemarks = (!empty($budgetRemarks)? $budgetRemarks:null);
      return $this;
  }

  public function setMasterBudgetNumber($masterBudgetNumber) {
      $this->masterBudgetNumber = (!empty($masterBudgetNumber)? $masterBudgetNumber:null);
      return $this;
  }

  public function setProjectNumber($projectNumber) {
      $this->projectNumber = (!empty($projectNumber)? $projectNumber:null);
      return $this;
  }
}