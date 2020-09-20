<?php

class Extensions_Model_BsspAssignmentExtensionMapper extends JBlac_ObjectModelMapper
{
    public function save(Extensions_Model_BsspAssignmentExtension $objEntity)
    {
        $data = [
            'id'                                       =>   $objEntity->getId(),
            'assignmentExtensionPhase'                 =>   $objEntity->getAssignmentExtensionPhase(),
            'assignmentExtensionDiscussionDate'        =>   $objEntity->getAssignmentExtensionDiscussionDate(),
            'assignmentExtendedFromDate'               =>   $objEntity->getAssignmentExtendedFromDate(),  
            'assignmentExtendedToDate'                 =>   $objEntity->getAssignmentExtendedToDate(),              
            'assignmentExtensionRemarks'               =>   $objEntity->getAssignmentExtensionRemarks(),
            'assignmentExtensionProjectNumber'         =>   $objEntity->getAssignmentExtensionProjectNumber(),
        ];

        if (null === ($id = $objEntity->getId())) {
            
            unset($data['id']);
            $data['createdBy'] = Zend_Registry::get('user');
            $data['createdOn'] = date('Y-m-d H:i:s');
            try {
              $newId =  $this->getDbTable()->insert($data);
              $objEntity->setId($newId);
              return $objEntity->getId();
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }

            
        } else {
            $data['modifiedBy'] = Zend_Registry::get('user');
            $data['modifiedOn'] = date('Y-m-d H:i:s');            
            $this->getDbTable()->update($data, ['id = ?' => $id]);
        }
    }

    public function find($id, Extensions_Model_BsspAssignmentExtension $objEntity)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $objEntity->setId($row->id)
                ->setAssignmentExtensionPhase($row->assignmentExtensionPhase)
                ->setAssignmentExtensionDiscussionDate($row->assignmentExtensionDiscussionDate)
                ->setAssignmentExtendedFromDate($row->assignmentExtendedFromDate)
                ->setAssignmentExtendedToDate($row->assignmentExtendedToDate)
                ->setAssignmentExtensionRemarks($row->assignmentExtensionRemarks)
                ->setAssignmentExtensionProjectNumber($row->assignmentExtensionProjectNumber);        
        return $row;
    }
    public function fetchOne($id, Extensions_Model_BsspAssignmentExtension $objEntity)
    {
        $select = $this->getDbTable()->select()->from(['e' => 'bssp_assignment_extensions_v'])->where('id = ?' , $id);
        $result = $select->query()->fetch();
        if (0 == count($result)) {
            return;
        }
        $row = $result;
        $objEntity->setId($row['id'])
                ->setAssignmentExtensionPhase($row['assignmentExtensionPhase'])
                ->setAssignmentExtensionDiscussionDate($row['assignmentExtensionDiscussionDate'])
                ->setAssignmentExtendedFromDate($row['assignmentExtendedFromDate'])
                ->setAssignmentExtendedToDate($row['assignmentExtendedToDate'])
                ->setAssignmentExtensionRemarks($row['assignmentExtensionRemarks'])
                ->setAssignmentExtensionProjectNumber($row['assignmentExtensionProjectNumber']); 
        
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
            $entry = new Extensions_Model_BsspAssignmentExtension();
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
    
    public function searchAssignmentExtensionsByProjectNumber($projectNumber){
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['p' => 'bssp_assignment_extensions_v'])
                ->where('assignmentExtensionProjectNumber = ?' , $projectNumber);

        $results = $select->query()->fetchAll();

        if (!$results) {
            return [];
        }
        
        return $results;        
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