<?php

class Commiteeresolutions_Model_ImplementationMapper extends JBlac_ObjectModelMapper
{
    public function save(Projects_Model_Implementation $obj)
    {
        $data = [
                'id'                                =>               $obj->getId() ,
                'discussionDate'                    =>               $obj->getDiscussionDate() ,
                'dateIssuedToPromoters'             =>               $obj->getDateIssuedToPromoters() ,
                'reportType'                        =>               $obj->getReportType() ,
                'sourceOfFunds'                     =>               $obj->getSourceOfFunds() ,
                'numberOfMaleEmployed'              =>               $obj->getNumberOfMaleEmployed() ,
                'numberOfFemaleEmployed'            =>               $obj->getNumberOfFemaleEmployed() ,
                'implementationRemarks'             =>               $obj->getImplementationRemarks() ,            
                'projectNumber'                     =>               $obj->getProjectNumber() ,
        ];
        if (null === ($id = $obj->getId())) {
            
            unset($data['id']);
            $data['createdOn'] = date('Y-m-d H:i:s');
            $data['createdBy'] = Zend_Registry::get('user');
            try {
                
                $newId = $this->getDbTable()->insert($data);
                $obj->setId($newId);
                
              return $obj->getId();
              
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }

            
        } else {
            $data['modifiedOn'] = date('Y-m-d H:i:s');
            $data['modifiedBy'] = Zend_Registry::get('user');
            $this->getDbTable()->update($data, ['id = ?' => $id]);
        }
    }

    public function find($id, Projects_Model_Implementation $obj)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $obj->setDiscussionDate($row->discussionDate)
                ->setDateIssuedToPromoters($row->dateIssuedToPromoters)
                ->setReportType($row->reportType)
                ->setSourceOfFunds($row->sourceOfFunds)
                ->setNumberOfMaleEmployed($row->numberOfMaleEmployed)
                ->setNumberOfFemaleEmployed($row->numberOfFemaleEmployed)
                ->setRemarks($row->remarks)
                ->setProjectNumber($row->projectNumber)
                ->setId($id);
        
        return $row->toArray();
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
        $entry = new Projects_Model_Implementation();
        
        $entry->setDiscussionDate($row->discussionDate)
                ->setDateIssuedToPromoters($row->dateIssuedToPromoters)
                ->setReportType($row->reportType)
                ->setSourceOfFunds($row->sourceOfFunds)
                ->setNumberOfMaleEmployed($row->numberOfMaleEmployed)
                ->setNumberOfFemaleEmployed($row->numberOfFemaleEmployed)
                ->setRemarks($row->remarks)
                ->setProjectNumber($row->projectNumber)
                ->setId($row->id);
        
            $entries[] = $entry;
        }
        return $entries;
    }
    public function fetchOne($id, Projects_Model_Implementation $obj)
    {
        $select = $this->getDbTable()->select()->from(['implementation'] , [
                'id',
                'DATE_FORMAT(discussionDate , \'%d/%m/%Y\') as discussionDate',
                'DATE_FORMAT(dateIssuedToPromoters , \'%d/%m/%Y\') as dateIssuedToPromoters',
                'reportType',
                
                'sourceOfFunds',
                'numberOfMaleEmployed',
                'numberOfFemaleEmployed',
                'remarks',
                'projectNumber',
            
                    ])->where('id = ?' , $id);
        
        $result = $select->query()->fetch();
        if (0 == count($result)) {
            return;
        }
        $row = $result;
        $obj->setDiscussionDate($row['discussionDate'])
                ->setDateIssuedToPromoters($row['dateIssuedToPromoters'])
                ->setReportType($row['reportType'])
                ->setSourceOfFunds($row['sourceOfFunds'])
                ->setNumberOfMaleEmployed($row['numberOfMaleEmployed'])
                ->setNumberOfFemaleEmployed($row['numberOfFemaleEmployed'])
                ->setRemarks($row['remarks'])
                ->setProjectNumber($row['projectNumber'])
                ->setId($row['id']);
        
        return $row;
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
}