<?php

class Users_Model_Permission extends JBlac_ObjectModel
{

  protected $roleId              = 	null;
  protected $resourceId          = 	null;
  protected $permission          = 	null; /* allow , deny */
  
  
  public function getRoleId() {
      return $this->roleId;
  }

    public function getResourceId() {
      return $this->resourceId;
  }

  public function getPermission() {
      return $this->permission;
  }
  
  public function setRoleId($roleId) {
      $this->roleId = (!empty($roleId)? $roleId:null);
      return $this;
  }
  
  public function setResourceId($resourceId) {
      $this->resourceId = (!empty($resourceId)? $resourceId:null);
      return $this;
  }

  public function setPermission($permission) {
      $this->permission = (!empty($permission)? $permission:null);
      return $this;
  }


}