<?php

class Extensions_Model_ExtensionMapper extends JBlac_ObjectModelMapper
{
    public function save(Extensions_Model_Extension $objEntity)
    {
        $data = [
            'id'                    => $objEntity->getId(),
            'phase'                 => $objEntity->getPhase(),
            'discussionDate'        => $objEntity->getDiscussionDate(),
            'extendedToDate'        => $objEntity->getExtendedToDate(), 
            'projectNumber'         => $objEntity->getProjectNumber(), 
            'remarks'               => $objEntity->getRemarks(),
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

    public function find($id, Extensions_Model_Extension $objEntity)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $objEntity->setId($row->id)
                  ->setPhase($row->phase)
                  ->setDiscussionDate($row->discussionDate)
                  ->setExtendedToDate($row->extendedToDate)
                  ->setProjectNumber($row->projectNumber)
                  ->setRemarks($row->remarks);        
        return $row;
    }
    public function fetchOne($id, Extensions_Model_Extension $objEntity)
    {
        $select = $this->getDbTable()->select()->from(['e' => 'extensions'] , [
                    'id',
                    'phase',
                    'DATE_FORMAT(discussionDate , \'%d/%m/%Y\') as discussionDate',
                    'DATE_FORMAT(extendedToDate , \'%d/%m/%Y\') as extendedToDate',
                    'projectNumber',
                    'remarks',
                    ])->where('id = ?' , $id);
        $result = $select->query()->fetch();
        if (0 == count($result)) {
            return;
        }
        $row = $result;
        $objEntity->setId($row['id'])
                  ->setPhase($row['phase'])
                  ->setDiscussionDate($row['discussionDate'])
                  ->setExtendedToDate($row['extendedToDate'])
                  ->setProjectNumber($row['projectNumber'])
                  ->setRemarks($row['remarks']);
        
        return $row;
    }
    public function fetchDataSet($id, Extensions_Model_Extension $promoterEntity , Promoters_Model_Address $addressEntity)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['e' => 'extensions'] , [
                    'id',
                    'phase',
                    'discussionDate',
                    'extendedToDate',
                    'committeeId',
                    'projectId',
                    'remarks',
                    ])
                    ->join(['p' => 'project'], 'e.id = p.projectId', [
                    'id as projectId',
                    'addressLineOne',
                    'addressLineTwo',
                    'postalAddress',
                    'regionCode',
                    'cityCode',
                    'countryCode',
                        ])
                        ->where('p.id = ?' , $id);

        $result = $select->query()->fetch();

        if (0 == count($result)) {
            exit;
            return [];
        }
        $row = $result;
        /*
         * Buyer Data
         */
        $promoterEntity->setId($row['promoterId'])
                  ->setFirstName($row['firstName'])
                  ->setLastName($row['lastName'])
                  ->setIdentityNumber($row['identityNumber'])
                  ->setCompanyRegistrationNumber($row['companyRegistrationNumber'])
                  ->setCompanyName($row['companyName'])
                  ->setPromoterType($row['promoterType'])                
                  ->setEmailAddress($row['emailAddress'])
                  ->setTelephoneNumber($row['telephoneNumber'])
                  ->setMobileNumber($row['mobileNumber'])
                  ->setFaxNumber($row['faxNumber'])
                  ->setRemarks($row['remarks']);
        /*
         * Address Data
         */
        $addressEntity->setId($row['addressId'])
                  ->setAddressLineOne($row['addressLineOne'])
                  ->setAddressLineTwo($row['addressLineTwo'])
                  ->setPostalAddress($row['postalAddress'])
                  ->setRegionCode($row['regionCode'])
                  ->setCityCode($row['cityCode'])
                  ->setCountryCode($row['countryCode'])
                  ->setPromoterId($row['promoterId']); 
        
        return $row;
    }    
    public function fetchAll()
    {
//        $resultSet = $this->getDbTable()->fetchAll();
        $select = $this->getDbTable()->select()->from(['e' => 'extensions'] , [
                    'id',
                    'phase',
                    'DATE_FORMAT(discussionDate , \'%d/%m/%Y\') as discussionDate',
                    'DATE_FORMAT(extendedToDate , \'%d/%m/%Y\') as extendedToDate',
                    'projectNumber',
                    'remarks',
                    ])->where('projectNumber IS NOT NULL');
        $resultSet = $select->query()->fetchAll();        
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Extensions_Model_Extension();
            $entry->setId($row['id'])
                  ->setPhase($row['phase'])
                  ->setDiscussionDate($row['discussionDate'])
                  ->setExtendedToDate($row['extendedToDate'])
                  ->setProjectNumber($row['projectNumber'])
                  ->setRemarks($row['remarks']);
            $entries[] = $entry;
        }
        return $resultSet;
    }

    public function fetchExtensionsPerProject($projectNumber)
    {
//        $resultSet = $this->getDbTable()->fetchAll();
        
        if(is_null($projectNumber)){
            return [];
        }
        $select = $this->getDbTable()->select()->from(['e' => 'extensions'] , [
                    'id',
                    'phase',
                    'DATE_FORMAT(discussionDate , \'%d/%m/%Y\') as discussionDate',
                    'DATE_FORMAT(extendedToDate , \'%d/%m/%Y\') as extendedToDate',
                    'projectNumber',
                    'remarks',
                    ])->where('projectNumber = ?' , $projectNumber);
        $resultSet = $select->query()->fetchAll();        
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Extensions_Model_Extension();
            $entry->setId($row['id'])
                  ->setPhase($row['phase'])
                  ->setDiscussionDate($row['discussionDate'])
                  ->setExtendedToDate($row['extendedToDate'])
                  ->setProjectNumber($row['projectNumber'])
                  ->setRemarks($row['remarks']);
            $entries[] = $entry;
        }
        return $resultSet;
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
        $paginator = Zend_Paginator::factory($this->fetchAll());
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
        $select = $db->select()->from(['p' => 'assignment_extensions_v'] , [
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