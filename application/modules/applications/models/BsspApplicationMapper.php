<?php

class Applications_Model_BsspApplicationMapper extends JBlac_ObjectModelMapper
{
    private static $_instance = null;
    public function save(Applications_Model_BsspApplication $application)
    {
        $data = [
                'id'                                    =>               $application->getId() ,
                'applicationNumber'                     =>               $application->getApplicationNumber() ,
                'applicationLegalEntityId'                         =>    $application->getApplicationLegalEntityId() ,
                'applicationLegalEntityType'            =>              $application->getApplicationLegalEntityType(),
                'applicationDate'                       =>               $application->getApplicationDate() ,
                'applicationAcknowledgementDate'        =>               $application->getApplicationAcknowledgementDate() ,            
 
        ];
        
        
        if (null === ($id = $application->getId())) {
            unset($data['id']);
            $data['createdOn'] = date('Y-m-d H:i:s');
            $data['createdBy'] = Zend_Registry::get('user'); 
            try {
                return $this->getDbTable()->insert($data);
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }

            
        } else {
            $data['modifiedOn'] = date('Y-m-d H:i:s');
            $data['modifiedBy'] = Zend_Registry::get('user');           
            $this->getDbTable()->update($data, ['id = ?' => $id]);
        }
    }
    public function updateStatus(Applications_Model_BsspApplication $application)
    {
        $data = [
                'id'                        =>               $application->getId() ,
                'applicationNumber'                    =>               $application->getApplicationNumber() ,            
        ];
        if (null !== ($id = $application->getId())) {
            
            $data['modifiedOn'] = date('Y-m-d H:i:s');
            $data['modifiedBy'] = Zend_Registry::get('user');            
            
            try {
                $this->getDbTable()->update($data, ['id = ?' => $id]);
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }

            
        } else {

        }
    }
    public function find($id, Applications_Model_BsspApplication $application)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return [];
        }
        $row = $result->current();
        $application->setId($row->id)
                ->setApplicationNumber($row->applicationNumber)
                ->setApplicationLegalEntityId($row->applicationLegalEntityId)
                ->setApplicationLegalEntityType($row->applicationLegalEntityType)
                ->setApplicationDate($row->applicationDate)
                ->setApplicationAcknowledgementDate($row->applicationAcknowledgementDate);
        
        return $row->toArray();
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
        $entry = new Applications_Model_BsspApplication();
        $entry->setId($row->id)
                ->setApplicationNumber($row->applicationNumber)
                ->setApplicationLegalEntityId($row->applicationLegalEntityId)
                ->setApplicationLegalEntityType($row->applicationLegalEntityType)
                ->setApplicationDate($row->applicationDate)
                ->setApplicationAcknowledgementDate($row->applicationAcknowledgementDate);
            $entries[] = $entry;
        }
        return $entries;
    }
    public function fetchApplicationsList()
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $status = 'PENDING';
        $select = $db->select()->from(['a' => 'bssp_applications_legal_entity_v'])->where('requestStatus = ?' , $status);        

        $results = $select->query()->fetchAll();
        if (0 == count($results)) {
            return [];
        }

        return $results;
    }
    
    public static function searchApplications(array $options = null)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        if(!is_null($options)){
            
            if(!empty($options['applicationNumber'])){
                
                $select->where('applicationNumber = ?', $options['applicationNumber']);
            }
            if(!empty($options['applicantName'])){
                
                $select->where('applicantName LIKE ?', "%{$options['applicantName']}%");
            }
            if(!empty($options['applicationDate'])){
                
                $select->where('applicationDate = ?', $options['applicationDate']);
            }            
            $select->from(['a' => 'bssp_applications_legal_entity_v']);
        }else{
            //$select = $db->select()->from(['a' => 'bssp_applications_legal_entity_v']);
        }
        
            $adapter = new Zend_Paginator_Adapter_DbSelect($select);
            $paginator = new Zend_Paginator($adapter);

        return $paginator;
    }     
    public function fetchOne($id, Applications_Model_BsspApplication $application)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['a' => 'bssp_applications_legal_entity_v'] , [
                'applicationId',          
                'applicationNumber',
                'applicationLegalEntityId',
                'applicationLegalEntityType',
                'applicationDate',
                'applicationAcknowledgementDate',
                'applicantName',
                    ])->where('applicationId = ?' , $id);
        $result = $select->query()->fetch();
        if (!$result) {
            return [];
        }
        
        return $result;
    }
    public function fetchOneByApplicationNumber($applicationNumber)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['a' => 'bssp_applications_v'])->where('applicationNumber = ?' , $applicationNumber)->limit(1);
        
        $result = $select->query()->fetch();
        
        $requestMapper = new Applications_Model_BsspRequestMapper('Applications_Model_DbTable_BsspRequest');
        $applicationRequests = $requestMapper->searchRequestsByApplicationNumber($applicationNumber);
        $result['requests'] = $applicationRequests;
        $application = new Applications_Model_BsspApplication();
        $application->setId($result['applicationId'])
                ->setApplicationNumber($result['applicationNumber'])
                ->setApplicationDate($result['applicationDate'])
                ->setApplicationAcknowledgementDate($result['applicationAcknowledgementDate'])
                ->setApplicationLegalEntityId($result['applicationLegalEntityId'])
                ->setApplicationLegalEntityType($result['entityType'])
                ->setApplicationRequests($applicationRequests);
        
        return $result;
        
    }
    /**
     * 
     * @return array
     */
    public function fetchDataSet($id)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['a' => 'bssp_applications_v'])
                        ->where('a.applicationId = ?' , $id);

        $result = $select->query()->fetch();

        if (0 == count($result)) {
            return [];
        }
        $row = $result;
        
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
        $paginator = Zend_Paginator::factory($this->fetchApplicationsList());
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
    public function searchApplicationRequestByApplicationNumber($applicationNumber)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['a' => 'bssp_requests_v'])->where('applicationNumber = ?' , $applicationNumber);        

        $results = $select->query()->fetchAll();
        if (!$results) {
            return [];
        }
        return $results;
    }     
    /**
     * 
     * @return Applications_Model_BsspApplicationMapper
     */
    public static function getInstance(){
        
        if(!isset(self::$_instance)){
            $c = __CLASS__;
            self::$_instance = new $c;
        }
        
        return self::$_instance;
    }    
}