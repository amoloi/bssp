<?php

class Projects_Model_ProjectMapper extends JBlac_ObjectModelMapper
{
    public function save(Projects_Model_Project $objEntity)
    {
        $data = [
            'id'                =>  $objEntity->getId(),
            'number'            =>  $objEntity->getNumber(),
            'name'              =>  $objEntity->getName(),
            'description'       =>  $objEntity->getDescription(),
            'status'            =>  $objEntity->getStatus(), 
            'applicationNumber'     =>  $objEntity->getApplicationNumber(),
            'requestNumber'     =>  $objEntity->getRequestNumber(),
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

    public function find($id, Projects_Model_Project $objEntity)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $objEntity->setId($row->id)
                  ->setNumber($row->number)
                  ->setName($row->name)
                  ->setDescription($row->description)
                  ->setStatus($row->status)
                  ->setApplicationNumber($row->applicationNumber)
                  ->setRequestNumber($row->requestNumber)
                  ->setStartDate($row->startDate)
                  ->setEndDate($row->endDate);       
        return $row;
    }
    public function fetchOne($id, Projects_Model_Project $objEntity)
    {
        $select = $this->getDbTable()->select()->from('bssp_projects', [
                    'id',
                    'number',
                    'name',
                    'description',
                    'status',
                    'applicationNumber',
                    'requestNumber',
                    'DATE_FORMAT(startDate , \'%d/%m/%Y\') as startDate',
                    'DATE_FORMAT(endDate , \'%d/%m/%Y\') as endDate',
                    'createdBy',
                    'createdOn',
                    'modifiedBy',
                    'modifiedOn',
                    ])->where('id = ?' , $id);
        
        $results = $select->query()->fetch();
        $row = $results;
        $objEntity->setId($row['id'])
                  ->setNumber($row['number'])
                  ->setName($row['name'])
                  ->setDescription($row['description'])
                  ->setStatus($row['status'])
                  ->setApplicationNumber($row['applicationNumber'])
                  ->setRequestNumber($row['requestNumber'])
                  ->setStartDate($row['startDate'])
                  ->setEndDate($row['endDate'])
                  ->setCreatedBy($row['createdBy'])
                  ->setCreatedOn($row['createdOn'])
                  ->setModifiedBy($row['modifiedBy'])
                  ->setModifiedOn($row['modifiedOn']);
        
        return $row;
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Projects_Model_Project();
            $entry->setId($row->buyerId)
                  ->setNumber($row->number)
                  ->setName($row->name)
                  ->setDescription($row->description)
                  ->setStatus($row->status)
                  ->setApplicationNumber($row->applicationNumber)
                  ->setRequestNumber($row->requestNumber)
                  ->setStartDate($row->startDate)
                  ->setEndDate($row->endDate)
                  ->setCreatedBy($row->createdBy)
                  ->setCreatedOn($row->createdOn)
                  ->setModifiedBy($row->modifiedBy)
                  ->setModifiedOn($row->modifiedOn);
            $entries[] = $entry;
        }
        return $entries;
    }
    public function fetchProjects()
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from('bssp_projects_v')
                    ->where('name IS NOT NULL');

        $results = $select->query()->fetchAll();

        $entries = [];

        foreach ($results as $row) {
                 $row['bugdet'] = Budgets_Model_ProjectBudgetMapper::searchBudgetDataPerProject($row['number']);
                $entries[] = $row;
        }         

        
        return $entries;
    }
    public static function searchProjects(array $options = null)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        if(!is_null($options)){
            
            if(!empty($options['projectNumber'])){
                
                $select->where('number = ?', $options['projectNumber']);
            }
            if(!empty($options['projectName'])){
                
                $select->where('name LIKE ?', "%{$options['projectName']}%");
            }
            if(!empty($options['startDate'])){
                
                $select->where('startDate = ?', $options['startDate']);
            }            
            $select->from(['a' => 'bssp_projects_v']);
        }else{
            //$select = $db->select()->from(['a' => 'bssp_applications_legal_entity_v']);
        }
        
        $results = $select->query()->fetchAll();
        $entries = [];
        
        foreach ($results as $row) {
                $row['bugdet'] = Budgets_Model_ProjectBudgetMapper::searchBudgetDataPerProject($row['number']);
                $entries[] = $row;
        }          

        $paginator = Zend_Paginator::factory($entries);
            
        return $paginator;
    }
    public function featchProjectByProjectId($projectId)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        if(!is_null($projectId)){

            $select->where('id = ?', $projectId);          
            $select->from(['a' => 'bssp_projects_v']);
            
        }else{
            //$select = $db->select()->from(['a' => 'bssp_applications_legal_entity_v']);
        }
        
        $results = $select->query()->fetch();
        
        if(!$results){
           $results = []; 
        }
         
        return $results;
    }     
    public function fetchProject($projectNumber)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from('bssp_requests_projects_v')
                    ->where('projectNumber = ?' , $projectNumber);

        $results = $select->query()->fetch();

        $entry = null;
        
        if($results){
                $objEntity = new Projects_Model_Project(); 
                $objEntity->setId($results['projectId'])
                          ->setNumber($results['projectNumber'])
                          ->setName($results['projectName'])
                          ->setDescription($results['projectDescription'])
                          ->setStatus($results['projectStatus'])
                          ->setApplicationNumber($results['applicationNumber'])
                          ->setRequestNumber($results['requestNumber'])
                          ->setStartDate($results['startDate'])
                          ->setEndDate($results['endDate'])
                         /* ->setCreatedBy($row['createdBy'])
                          ->setCreatedOn($row['createdOn'])
                          ->setModifiedBy($row['modifiedBy'])
                          ->setModifiedOn($row['modifiedOn'])*/;
                $entry = $objEntity;
        }         

        
        return $results;
    }
    /**
     * 
     * @param string $requestNumber
     * @return array
     */
    public function searchProjectByRequestNumber($requestNumber)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['p' => 'bssp_projects_v'] , [
         'projectId' => 'id', 
	 'projectNumber' => 'number', 
	 'projectName' => 'name', 
	 'projectDescription' =>  'description', 
	 'projectStatus' => 'status' , 
	 'startDate', 
	 'endDate', 
	 'applicationNumber', 
	 'requestNumber',
        ])->where('requestNumber = ?' , $requestNumber);
        $result = $select->query()->fetch();
        if (!$result) {
            return [];
        }
        
        return $result;
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
        $paginator = Zend_Paginator::factory($this->fetchProjects());
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
public static function fetchProjectsLOV()
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from('projects_lov_v')
                    ->where('value IS NOT NULL');

        $results = $select->query()->fetchAll();

        if (0 == count($results)) {
            return [];
        }
        $entities = [];
        foreach ($results as $row) {
            $entities[$row['value']] = $row['label'];
        }        
        return $entities;
    } 
    
    public function deleteProjectByRequestNumber($requestNumber){
        $db = Zend_Db_Table::getDefaultAdapter();
        $db->delete('bssp_projects', ['requestNumber = ?' => $requestNumber]);
    }
    
    public static function setProjectIsDisscussed(array $options = null)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        

        if(!is_null($options)){
            $data = [
                'isDisscussed' => $options['isDisscussed'],
                'discussionDate' => date('Y-m-d H:i:s'),
            ];            
        }else{
            $data = [
                'isDisscussed' => 'N',
                'discussionDate' => date('Y-m-d H:i:s'),
            ];
        }
        
        try {

            $updatedRows = $db->update('bssp_projects', $data, ['number = ?' => $options['projectNumber']]);
                        
        } catch (Exception $ex) {
            return false;
        }
        
        return true;        
    }      
}