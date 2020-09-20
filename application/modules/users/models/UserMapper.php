<?php

class Users_Model_UserMapper extends JBlac_ObjectModelMapper
{
    public function save(Users_Model_User $objEntity)
    {
        $data = [
            'firstname'             =>  $objEntity->getFirstname(),
            'lastname'        =>  $objEntity->getLastname(),            
            'email'           =>  $objEntity->getEmailAddress(),            
            'username'                =>  $objEntity->getUsername(),
            'password'            =>  $objEntity->getPassword(),
            'id_role'             =>  $objEntity->getRoleId(),
            'ldap'        =>  $objEntity->getLdap(),
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

    public function resetPassword(Users_Model_User $objEntity)
    {
        $data = [           
            'password'            =>  $objEntity->getPassword(),
        ];
        if (null !== ($username = $objEntity->getUsername())) {
            
            $data['modifiedBy'] = Zend_Registry::get('user');
            $data['modifiedOn'] = date('Y-m-d H:i:s');            
                        
            try {
                
              $OK = $this->getDbTable()->update($data, ['username = ?' => $username]);
              
              return $OK;
              
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }
        }
    }    
    
    public function find($id, Users_Model_User $objEntity)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $objEntity->setFirstname($row->firstname)
                  ->setLastname($row->lastname)
                  ->setEmailAddress($row->email)
                  ->setUsername($row->username)
                  ->setRoleId($row->id_role)
                  ->setLdap($row->ldap)
                ->setId($row->id);        
        return $row;
    }
    public function fetchOne($id, Users_Model_User $objEntity)
    {
        $select = $this->getDbTable()->select()->from(['b' => 'users'] , [
                    'id',
                    'firstname',
                    'lastname',
                    'email',
                    'username',                    
                    'id_role',
                    'ldap',
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
        $objEntity->setFirstname($row['firstname'])
                  ->setLastname($row['lastname'])
                  ->setEmailAddress($row['email'])
                  ->setUsername($row['username'])
                  ->setRoleId('id_role')
                  ->setLdap($row['ldap'])
                  ->setId($row['id']);
        
        return $row;
    } 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $objEntity = new Users_Model_User();
            $objEntity->setFirstname($row->firstname)
                  ->setLastname($row->lastname)
                  ->setEmailAddress($row->email)
                  ->setUsername($row->username)
                  ->setRoleId($row->id_role)
                  ->setLdap($row->ldap)
                  ->setId($row->id);
            $entries[] = $objEntity;
        }
        return $entries;
    }

    public function fetchDataSet(Users_Model_User $objEntity)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['u' => 'users'] , [
                    'id as userId',
                    'firstname',
                    'lastname',
                    'email',
                    'username',
                    'id_role',
                    ])
                    ->join(['r' => 'roles'], 'u.id_role = r.id', [
                    'id as roleId',
                    'role',
                        ])
                        ->where('username IS NOT NULL');

        $results = $select->query()->fetchAll();

        if (0 == count($results)) {
            return $results;
        }
        $entries   = [];
        foreach ($results as $row) {
            $entry = new Users_Model_User();
            $entry->setFirstname($row['firstname'])
                  ->setLastname($row['lastname'])
                  ->setEmailAddress($row['email'])
                  ->setUsername($row['username'])
                  ->setRoleId($row['id_role'])
                  ->setId($row['userId']);
            $entries[] = $entry;
        }        
        
        return $results;
    }        
    public function fetchAllDataSet()
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['u' => 'users'] , [
                    'id as userId',
                    'firstname',
                    'lastname',
                    'email',
                    'username',
                    'id_role',
                    'r.role_description',
                    ])
                    ->join(['r' => 'roles'], 'u.id_role = r.id', [
                    'id as roleId',
                    'role',
                        ])
                        ->where('username IS NOT NULL');

        $results = $select->query()->fetchAll();

        if (0 == count($results)) {
            return $results;
        }
        $entries   = [];

        return $results;
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
        $paginator = Zend_Paginator::factory($this->fetchAllDataSet());
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