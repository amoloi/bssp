<?php

class Projects_Model_BsspProjectImplementationMapper extends JBlac_ObjectModelMapper
{
    public function save(Projects_Model_BsspProjectImplementation $obj)
    {
        $data = [
                'id'                                                =>               $obj->getId() ,
                'includeImplementationReport'                       =>               $obj->getIncludeImplementationReport() ,
                'implementationDateOfIssueToPromoters'              =>               $obj->getImplementationDateOfIssueToPromoters() ,
                'implementationReportType'                          =>               $obj->getImplementationReportType() ,
                'implementationSourceOfFunds'                       =>               $obj->getImplementationSourceOfFunds() ,
                'implementationRemarks'                             =>               $obj->getImplementationRemarks() ,           
                'projectNumber'                                     =>               $obj->getProjectNumber() ,
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

    public function find($id, Projects_Model_BsspProjectImplementation $obj)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $obj    ->setIncludeImplementationReport($row->includeImplementationReport)
                ->setImplementationDateOfIssueToPromoters($row->implementationDateOfIssueToPromoters)
                ->setImplementationReportType($row->implementationReportType)
                ->setImplementationSourceOfFunds($row->implementationSourceOfFunds)
                ->setImplementationRemarks($row->implementationRemarks)
                ->setProjectNumber($row->projectNumber)
                ->setId($id);
        
        return $row->toArray();
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
        $entry = new Projects_Model_BsspProjectImplementation();
        
        $entry
                ->setIncludeImplementationReport($row->includeImplementationReport)
                ->setImplementationDateOfIssueToPromoters($row->implementationDateOfIssueToPromoters)
                ->setImplementationReportType($row->implementationReportType)
                ->setImplementationSourceOfFunds($row->implementationSourceOfFunds)
                ->setImplementationRemarks($row->implementationRemarks)
                ->setProjectNumber($row->projectNumber)
                ->setId($row->id);
        
            $entries[] = $entry;
        }
        return $entries;
    }
    public function fetchOne($id, Projects_Model_BsspProjectImplementation $obj)
    {
        $select = $this->getDbTable()->select()->from(['bssp_project_implementation_v'])->where('id = ?' , $id);
        
        $result = $select->query()->fetch();
        if (0 == count($result)) {
            return;
        }
        $row = $result;
        $obj->setIncludeImplementationReport($row['includeImplementationReport'])
                ->setImplementationDateOfIssueToPromoters($row['implementationDateOfIssueToPromoters'])
                ->setImplementationReportType($row['implementationReportType'])
                ->setImplementationSourceOfFunds($row['implementationSourceOfFunds'])
                ->setImplementationRemarks($row['implementationRemarks'])
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
    public function searchProjectImplementationByProjectNumber($projectNumber){
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['p' => 'bssp_project_implementation_v'])
                ->where('projectNumber = ?' , $projectNumber);

        $results = $select->query()->fetch();

        if (!$results) {
            return [];
        }
        
        return $results;        
    }    
}