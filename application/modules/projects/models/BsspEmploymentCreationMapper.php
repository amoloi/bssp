<?php

class Projects_Model_BsspEmploymentCreationMapper extends JBlac_ObjectModelMapper
{
    public function save(Projects_Model_BsspEmploymentCreation $obj)
    {
        $data = [
                'id'                                =>               $obj->getId() ,
                'employmentNumberOfMales'           =>               $obj->getEmploymentNumberOfMales() ,
                'employmentNumberOfFemales'         =>               $obj->getEmploymentNumberOfFemales() ,
                'employmentDateOfEmployment'        =>               $obj->getEmploymentDateOfEmployment() ,
                'employmentRemarks'                 =>               $obj->getEmploymentRemarks() ,           
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

    public function find($id, Projects_Model_BsspEmploymentCreation $obj)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $obj->setEmploymentNumberOfMales($row->employmentNumberOfMales)
                ->setEmploymentNumberOfFemales($row->employmentNumberOfFemales)
                ->setEmploymentDateOfEmployment($row->employmentDateOfEmployment)
                ->setEmploymentRemarks($row->employmentRemarks)
                ->setProjectNumber($row->projectNumber)
                ->setId($row->id);
        
        return $row->toArray();
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
        $entry = new Projects_Model_BsspEmploymentCreation();
        
        $entry->setEmploymentNumberOfMales($row->employmentNumberOfMales)
                ->setEmploymentNumberOfFemales($row->employmentNumberOfFemales)
                ->setEmploymentDateOfEmployment($row->employmentDateOfEmployment)
                ->setEmploymentRemarks($row->employmentRemarks)
                ->setProjectNumber($row->projectNumber)
                ->setId($row->id);
        
            $entries[] = $entry;
        }
        return $entries;
    }
    public function fetchOne($id, Projects_Model_BsspEmploymentCreation $obj)
    {
        $select = $this->getDbTable()->select()->from(['bssp_employment_creation_v'] , [
                'id',
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
        $obj->setEmploymentNumberOfMales($row['employmentNumberOfMales'])
                ->setEmploymentNumberOfFemales($row['employmentNumberOfFemales'])
                ->setEmploymentDateOfEmployment($row['employmentDateOfEmployment'])
                ->setEmploymentRemarks($row['employmentRemarks'])
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
    public function searchEmploymentDataByProjectNumber($projectNumber){
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['p' => 'bssp_employment_creation_v'])
                ->where('projectNumber = ?' , $projectNumber);

        $results = $select->query()->fetchAll();

        if (!$results) {
            return [];
        }
        
        return $results;        
    }    
}