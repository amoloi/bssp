<?php

class Applications_Model_BsspRequestMapper extends JBlac_ObjectModelMapper
{
    private static $_instance = null;
    public function save(Applications_Model_BsspRequest $request)
    {
        $data = [
                'id'                                =>               $request->getId() ,
                'requestNumber'                     =>               $request->getRequestNumber() ,
                'requestType'                       =>               $request->getRequestType() ,
                'requestSector'                     =>               $request->getRequestSector() ,
                'requestPriotityArea'               =>               $request->getRequestPriotityArea() ,
                'requestBusinessActivity'           =>               $request->getRequestBusinessActivity() ,
                'requestStatus'                     =>               $request->getRequestStatus() ,
                'requestRemarks'                    =>               $request->getRequestRemarks() ,            
                'applicationNumber'                 =>               $request->getApplicationNumber() ,
 
        ];
                
        if('Other' === $request->getRequestType()){
            $data['otherRequestTypeText']   =   $request->getOtherRequestTypeText();
        }

        if (null === ($id = $request->getId())) {
            
            unset($data['id']);
            $data['createdOn'] = date('Y-m-d H:i:s');
            $data['createdBy'] = Zend_Registry::get('user');
            try {
              return  $this->getDbTable()->insert($data);
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }

            
        } else {
            if('Other' !== $request->getRequestType()){
                $data['otherRequestTypeText']   =   null;
            }            
            $data['modifiedOn'] = date('Y-m-d H:i:s');
            $data['modifiedBy'] = Zend_Registry::get('user');
            $this->getDbTable()->update($data, ['id = ?' => $id]);
        }
    }
    public function updateStatus(Applications_Model_BsspRequest $application)
    {
        $data = [
                'id'                                =>               $application->getId() ,
                'requestStatus'                     =>               $application->getRequestStatus() ,
                'requestRemarks'                    =>               $application->getRequestRemarks() ,  
        ];
        if (null !== ($id = $application->getRequestNumber())) {
            
            $data['modifiedOn'] = date('Y-m-d H:i:s');
            $data['modifiedBy'] = Zend_Registry::get('user');
                        
            
            try {
                $this->getDbTable()->update($data, ['requestNumber = ?' => $id]);
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }

            
        } else {

        }
    }
    public function find($id, Applications_Model_BsspRequest $application)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return [];
        }
        $row = $result->current();
        $application->setId($row->id)
                ->setRequestNumber($row->requestNumber)
                ->setRequestType($row->number)
                ->setOtherRequestTypeText($row->otherRequestTypeText)
                ->setRequestSector($row->requestSector)
                ->setRequestPriotityArea($row->applicant)
                ->setRequestBusinessActivity($row->requestType)
                ->setRequestStatus($row->applicationDate)
                ->setRequestRemarks($row->acknowledgementDate)
                ->setApplicationNumber($row->resolutionDate);
        
        return $row->toArray();
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
        $entry = new Applications_Model_Application();
        $entry->setId($row->id)
                ->setRequestNumber($row->requestNumber)
                ->setRequestType($row->requestType)
                ->setOtherRequestTypeText($row->otherRequestTypeText)
                ->setRequestSector($row->requestSector)
                ->setRequestPriotityArea($row->requestPriotityArea)
                ->setRequestBusinessActivity($row->requestBusinessActivity)
                ->setRequestStatus($row->requestStatus)
                ->setRequestRemarks($row->requestRemarks)
                ->setApplicationNumber($row->applicationNumber);
            $entries[] = $entry;
        }
        return $entries;
    }
    public function fetchApplicationsList()
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['a' => 'bssp_requests'] , [
                                                                    'requestNumber',
                                                                    'applicationId',
                                                                    'requestType',
                                                                    'otherRequestTypeText',
                                                                    'requestSector',
                                                                    'requestPriotityArea',
                                                                    'requestBusinessActivity',
                                                                    'requestStatus',
                                                                    'requestRemarks',
                                                                    'applicationNumber',
                    ]);        

        $results = $select->query()->fetchAll();
        if (0 == count($results)) {
            return [];
        }
        return $results;
    }
    public function searchRequestByRequestNumber($requestNumber)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['a' => 'bssp_requests_v'])->where('requestNumber = ?' , $requestNumber);        

        $results = $select->query()->fetch();
        if (!$results) {
            return [];
        }
        return $results;
    }
    public function searchApplicationByRequestNumber($requestNumber)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['a' => 'bssp_applications_v'])->where('requestNumber = ?' , $requestNumber);        

        $results = $select->query()->fetch();
        if (!$results) {
            return [];
        }
        return $results;
    }
    public function searchCommiteeResolutionByRequestNumber($requestNumber)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['a' => 'bssp_resolutions_v'])->where('resolution_requestNumber = ?' , $requestNumber);        

        $results = $select->query()->fetch();
        if (!$results) {
            return [];
        }
        return $results;
    }
    public function searchProjectByRequestNumber($requestNumber)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['a' => 'bssp_projects_v'])->where('requestNumber = ?' , $requestNumber);        

        $results = $select->query()->fetch();
        if (!$results) {
            return [];
        }
        return $results;
    }    
    
    public function searchRequestsByApplicationNumber($applicationNumber){
        
        $db = $this->getDb();
        
        $select = $db->select()->from(['r' => 'bssp_requests_v' , [
            
        ]])
                
                        ->where('r.applicationNumber = ?' , $applicationNumber);

        try {
            $results = $select->query()->fetchAll();
        } catch (Exception $ex) {
            echo 'Error : ' . $ex->getMessage();
        }

        $requestEntries = [];
        foreach ($results as $entry){
            $request = new Applications_Model_BsspRequest();
            $request->setId($entry['requestId'])
                    ->setRequestNumber($entry['requestNumber'])
                    ->setRequestSector($entry['requestSector'])
                    ->setRequestPriotityArea($entry['requestPriotityArea'])
                    ->setRequestBusinessActivity($entry['requestBusinessActivity'])
                    ->setRequestStatus($entry['requestStatus'])
                    ->setRequestType($entry['requestType'])
                    ->setOtherRequestTypeText($entry['otherRequestTypeText'])
                    ->setRequestStatus($entry['requestStatus']);
            
            array_push($requestEntries, $request);
        }
        
        return $results;
        
    }

        /**
     * 
     * @param type $requestNumber
     * @param Applications_Model_BsspRequest $application
     * @return type
     */
    public function fetchOne($requestNumber, Applications_Model_BsspRequest $application)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['a' => 'bssp_applications_v'])->where('requestNumber = ?' , $requestNumber);
        $result = $select->query()->fetch();
        if (!$result) {
            return [];
        }
        
        return $result;
    }
    
    /**
     * 
     * @param string $requestNumber
     * @return array
     */
    public function searchRequestResolutionData($requestNumber)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['a' => 'bssp_resolution_application_requests_v'])->where('requestNumber = ?' , $requestNumber);
        $result = $select->query()->fetch();
        if (!$result) {
            return [];
        }
        
        return $result;
    }
    /**
     * 
     * @return array
     */
    public function fetchDataSet($id)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['a' => 'bssp_requests'])
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
    
    public function featchRequestByRequestId($requestId)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        if(!is_null($requestId)){

            $select->where('id = ?', $requestId);          
            $select->from(['a' => 'bssp_requests_v']);
            
        }else{
            //$select = $db->select()->from(['a' => 'bssp_applications_legal_entity_v']);
        }
        
        $results = $select->query()->fetch();
        
        if(!$results){
           $results = []; 
        }
         
        return $results;
    }     
    
    /**
     * 
     * @return Applications_Model_BsspRequestMapper
     */
    public static function getInstance(){
        
        if(!isset(self::$_instance)){
            $c = __CLASS__;
            self::$_instance = new $c;
        }
        
        return self::$_instance;
    }    
}