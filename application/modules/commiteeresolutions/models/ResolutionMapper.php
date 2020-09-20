<?php

class Commiteeresolutions_Model_ResolutionMapper extends JBlac_ObjectModelMapper
{
    public function save(Projects_Model_Resolution $obj)
    {
        $data = [
                'id'                                =>               $obj->getId() ,
                'discussionDate'                    =>               $obj->getDiscussionDate() ,
                'discussionStatus'                  =>               $obj->getDiscussionStatus() ,
                'requestType'                       =>               $obj->getRequestType() ,
                'corespondenceDate'                 =>               $obj->getCorespondenceDate() ,
                'consultantId'                      =>               $obj->getConsultantId() ,
                'principleConsultant'               =>               $obj->getPrincipleConsultant(),               
                'fundsId'                           =>               $obj->getFundsId() ,            
                'projectId'                         =>               $obj->getProjectId() ,
                'projectNumber'                     =>               $obj->getProjectNumber(),
                'requestNumber'                     =>               $obj->getRequestNumber()
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

    public function find($id, Projects_Model_Resolution $obj)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $obj->setDiscussionDate($row->discussionDate)
                ->setDiscussionStatus($row->discussionStatus)
                ->setRequestType($row->requestType)
                ->setCorespondenceDate($row->corespondenceDate)
                ->setConsultantId($row->consultantId)
                ->setPrincipleConsultant($row->principleConsultant)
                ->setFundsId($row->fundsId)
                ->setProjectId($row->projectId)
                ->setProjectNumber($row->projectNumber)
                ->setId($id);
        
        return $row->toArray();
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
        $entry = new Projects_Model_Resolution();
        
        $entry->setDiscussionDate($row->discussionDate)
                ->setDiscussionStatus($row->discussionStatus)
                ->setRequestType($row->requestType)
                ->setCorespondenceDate($row->corespondenceDate)
                ->setConsultantId($row->consultantId)
                ->setPrincipleConsultant($row->principleConsultant)
                ->setFundsId($row->fundsId)
                ->setProjectId($row->projectId)
                ->setProjectNumber($row->projectNumber)
                ->setId($row->id);
        
            $entries[] = $entry;
        }
        return $entries;
    }
    public function fetchOne($id, Projects_Model_Resolution $obj)
    {
        $select = $this->getDbTable()->select()->from(['resolutions'] , [
                'id',
                'DATE_FORMAT(discussionDate , \'%d/%m/%Y\') as discussionDate',
                'discussionStatus',
                'requestType',
                'DATE_FORMAT(corespondenceDate , \'%d/%m/%Y\') as corespondenceDate',
                'consultantId',
                'principleConsultant',
                'fundsId',
                'projectId',
                'projectNumber',
            
                    ])->where('id = ?' , $id);
        
        $result = $select->query()->fetch();
        if (0 == count($result)) {
            return;
        }
        $row = $result;
        $obj->setDiscussionDate($row['discussionDate'])
                ->setDiscussionStatus($row['discussionStatus'])
                ->setRequestType($row['requestType'])
                ->setCorespondenceDate($row['corespondenceDate'])
                ->setConsultantId($row['consultantId'])
                ->setPrincipleConsultant($row['principleConsultant'])
                ->setFundsId($row['fundsId'])
                ->setProjectId($row['projectId'])
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