<?php

class Users_Model_PermissionMapper extends JBlac_ObjectModelMapper
{
    public function save(Users_Model_Permission $objEntity)
    {
        $data = [
            'id'                =>  $objEntity->getId(),
            'id_role'           =>  $objEntity->getRoleId(),
            'id_resource'       =>  $objEntity->getResourceId(),
            'permission'       =>  $objEntity->getPermission(),
        ];
        if (null === ($id = $objEntity->getId())) {
            
            unset($data['id']);
            $data['createdBy'] = $objEntity->getCreatedBy();
            $data['createdOn'] = date('Y-m-d H:i:s');
            try {
              $newId =  $this->getDbTable()->insert($data);
              $objEntity->setId($newId);
              return $objEntity->getId();
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }

            
        } else {
            $data['modifiedBy'] = $objEntity->getModifiedBy();
            $data['modifiedOn'] = date('Y-m-d H:i:s');            
            $this->getDbTable()->update($data, ['id = ?' => $id]);
        }
    }

    public function find($id, Users_Model_Permission $objEntity)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $objEntity->setRoleId($row->id_role)
                  ->setResourceId($row->id_resource)
                  ->setPermission($row->permission)
                ->setId($row->id);        
        return $row;
    }
    public function fetchOne($id, Users_Model_Permission $objEntity)
    {
        $select = $this->getDbTable()->select()->from(['b' => 'permissions'] , [
                    'id',
                    'id_role',
                    'id_resource',
                    'permission',
                    ])->where('id = ?' , $id);
        $select->setIntegrityCheck(false);
            try {
                $result = $select->query()->fetch();
            } catch (Exception $ex) {

            }
        
        if (0 == count($result)) {
            return $result;
        }
        $row = $result;
        $objEntity->setRoleId($row['id_role'])
                  ->setResourceId($row['id_resource'])
                  ->setPermission($row['permission'])
                  ->setId($row['id']);        
        return $row;
    } 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $objEntity = new Users_Model_Permission();
            $objEntity->setRoleId($row->id_role)
                  ->setResourceId($row->id_resource)
                  ->setPermission($row->permission)
                  ->setId($row->id);
            $entries[] = $objEntity;
        }
        return $entries;
    }
         
    public function fetchArray()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        return $resultSet;
    }
    public function fetchPage($page)
    {
        /*
        * Object of Zend_Paginator
        */
        $paginator = Zend_Paginator::factory($this->fetchArray());
        /*
        * Set the number of counts in a page
        */
        $paginator->setItemCountPerPage(5);
        /*
        * Set the current page number
        */
        $paginator->setCurrentPageNumber($page);
        /*
        * Assign to view
        */
        
        return $paginator;
    } 

}