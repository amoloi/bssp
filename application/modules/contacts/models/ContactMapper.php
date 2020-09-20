<?php

class Contacts_Model_ContactMapper extends JBlac_ObjectModelMapper
{
    public function save(Contacts_Model_Contact $objEntity)
    {
        $data = [
            'id'                => $objEntity->getId(),
            'contactFirstName'         => $objEntity->getContactFirstName(),
            'contactMiddleName'          => $objEntity->getContactMiddleName(),
            'contactLastName'    => $objEntity->getContactLastName(),
            'contactPosition'    => $objEntity->getContactPosition(), 
            'contactTitle'    => $objEntity->getContactTitle(), 
            'legalEntityId'    => $objEntity->getLegalEntityId(), 
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

    public function find($id, Contacts_Model_Contact $objEntity)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $objEntity->setId($row->id)
                ->setContactFirstName($row->contactFirstName)
                ->setContactMiddleName($row->contactMiddleName)
                ->setContactLastName($row->contactLastName)
                ->setContactPosition($row->contactPosition)
                ->setContactTitle($row->contactTitle)
                ->setLegalEntityId($row->legalEntityId);        
        return $row;
    }
    public function fetchOne($id, Contacts_Model_Contact $objEntity)
    {
        $select = $this->getDbTable()->select()->from(['p' => 'promoters'] , [
                    'id',
                    'contactFirstName',
                    'contactMiddleName',
                    'contactLastName',
                    'contactPosition',
                    'contactTitle',
                    'legalEntityId',            
                    ])->where('id = ?' , $id);
        $result = $select->query()->fetch();
        if (0 == count($result)) {
            return [];
        }
        $row = $result;
        $objEntity->setId($row['id'])
                  ->setContactFirstName($row['contactFirstName'])
                  ->setContactMiddleName($row['contactMiddleName'])
                  ->setContactLastName($row['contactLastName'])
                  ->setContactPosition($row['contactPosition'])
                  ->setContactTitle($row['contactTitle'])
                  ->setLegalEntityId($row['legalEntityId']);
        
        return $row;
    }
    public function fetchOneByApplicant($legalEntityId)
    {
        if($legalEntityId === null){
            return [];
        }
        $db = $this->getDb();
        $select = $db->select()->from(['c' => 'bssp_contact_v'] , [
                    'contactId',
                    'contactFirstName',
                    'contactMiddleName',
                    'contactLastName',
                    'contactPosition',
                    'contactTitle',          
                    ])->where('legalEntityId = ?' , $legalEntityId);
        $result = $select->query()->fetch();
        if (0 == count($result)) {
            return [];
        }
        
        return $result;
    }
    public function searchContactsByLegalIdentityId($legalEntityId)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['a' => 'bssp_contact_v'] ,[
                    'contactId',
                    'contactFirstName',
                    'contactMiddleName',
                    'contactLastName',
                    'contactPosition',
                    'contactTitle',          
                    ])->where('legalEntityId = ?' , $legalEntityId);        

        $results = $select->query()->fetchAll();
        if (!$results) {
            return [];
        }
        return $results;
    }      
    public function searchContactByLegalIdentityId($legalEntityId)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['a' => 'bssp_contact_v'] ,[
                    'contactId',
                    'contactFirstName',
                    'contactMiddleName',
                    'contactLastName',
                    'contactPosition',
                    'contactTitle',          
                    ])->where('legalEntityId = ?' , $legalEntityId);        

        $results = $select->query()->fetch();
        if (!$results) {
            return [];
        }
        return $results;
    }     
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Contacts_Model_Contact();
            $entry->setId($row->id)
                ->setContactFirstName($row->contactFirstName)
                ->setContactMiddleName($row->contactMiddleName)
                ->setContactLastName($row->contactLastName)
                ->setContactPosition($row->contactPosition)
                ->setContactTitle($row->contactTitle)
                ->setLegalEntityId($row->legalEntityId);
            $entries[] = $entry;
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
        $paginator->setItemCountPerPage(10);
        /*
        * Set the current page number
        */
        $paginator->setCurrentPageNumber($page);
        /*
        * Assign to view
        */
        
        return $paginator;
    }
public static function fetchPomotersLOV()
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['p' => 'promoters_v'] , [
                    'id',
                    'coalesce(person , company) promoter',
                    ]);

        $results = $select->query()->fetchAll();

        if (0 == count($results)) {
            exit;
            return [];
        }
        $promoters = [];
        foreach ($results as $row) {
            $promoters[$row['id']] = $row['promoter'];

        }        
        return $promoters;
    }     
}