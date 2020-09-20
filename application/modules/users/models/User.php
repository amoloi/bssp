<?php

class Users_Model_User extends JBlac_ObjectModel
{

  protected $firstname              = 	null;
  protected $lastname               = 	null;
  protected $email                  = 	null;
  protected $username               = 	null;
  protected $password               = 	null;
  protected $roleId                 = 	null;
  protected $ldap                   = 	0;

  public function getFirstname() {
      return $this->firstname;
  }

  public function getLastname() {
      return $this->lastname;
  }

  public function getEmailAddress() {
      return $this->email;
  }

  public function getUsername() {
      return $this->username;
  }

  public function getPassword() {
      return $this->password;
  }

  public function getRoleId() {
      return $this->roleId;
  }

  public function getLdap() {
      return $this->ldap;
  }

  public function setFirstname($firstname) {
      $this->firstname = (!empty($firstname)? $firstname:null);
      return $this;
  }

  public function setLastname($lastname) {
      $this->lastname = (!empty($lastname)? $lastname:null);
      return $this;
  }

  public function setEmailAddress($email) {
      $this->email = (!empty($email)? $email:null);
      return $this;
  }

  public function setUsername($username) {
      $this->username = (!empty($username)? $username:null);
      return $this;
  }

  public function setPassword($password) {
      $crypt = new Zend_Crypt();
      $password = $crypt->hash('sha256', $password);
      $this->password = (!empty($password)? $password:null);
      return $this;
  }

  public function setRoleId($roleId) {
      $this->roleId = (!empty($roleId)? $roleId:null);
      return $this;
  }

  public function setLdap($ldap) {
      $this->ldap = (!empty($ldap)? $ldap:$this->ldap);
      return $this;
  }
}