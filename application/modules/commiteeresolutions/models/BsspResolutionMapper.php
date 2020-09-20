<?php

class Commiteeresolutions_Model_BsspResolutionMapper extends JBlac_ObjectModelMapper
{
    public function save(Commiteeresolutions_Model_BsspResolution $obj)
    {
        $data = [
                'id'                                =>               $obj->getId() ,
                'resolutionDiscussionDate'          =>               $obj->getResolutionDiscussionDate() ,
                'resolutionDiscussionStatus'        =>               $obj->getResolutionDiscussionStatus() ,
                'resolutionCorespondenceDate'       =>               $obj->getResolutionCorespondenceDate() ,
                'resolutionRemarks'                 =>               $obj->getResolutionRemarks() ,
                'resolutionRemarksDescription'      =>               $obj->getResolutionRemarksDescription(),
                'resolution_requestNumber'          =>               $obj->getResolution_requestNumber() ,
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

    public function find($id, Commiteeresolutions_Model_BsspResolution $obj)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $obj->setResolutionDiscussionDate($row->resolutionDiscussionDate)
                ->setResolutionDiscussionStatus($row->resolutionDiscussionStatus)
                ->setResolutionCorespondenceDate($row->resolutionCorespondenceDate)
                ->setResolutionRemarks($row->resolutionRemarks)
                ->setResolutionRemarksDescription($row->resolutionRemarksDescription)
                ->setResolution_requestNumber($row->resolution_requestNumber)
                ->setId($id);
        
        return $row->toArray();
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
        $entry = new Commiteeresolutions_Model_BsspResolution();
        
        $entry->setResolutionDiscussionDate($row->resolutionDiscussionDate)
                ->setResolutionDiscussionStatus($row->resolutionDiscussionStatus)
                ->setResolutionCorespondenceDate($row->resolutionCorespondenceDate)
                ->setResolutionRemarks($row->resolutionRemarks)
                ->setResolutionRemarksDescription($row->resolutionRemarksDescription)
                ->setResolution_requestNumber($row->resolution_requestNumber)
                ->setId($row->id);
        
            $entries[] = $entry;
        }
        return $entries;
    }
    public function fetchOne($id, Commiteeresolutions_Model_BsspResolution $obj)
    {
        $select = $this->getDbTable()->select()->from(['resolutions'] , [
                'id',
                'DATE_FORMAT(resolutionDiscussionDate , \'%d/%m/%Y\') as resolutionDiscussionDate',
                'DATE_FORMAT(resolutionCorespondenceDate , \'%d/%m/%Y\') as resolutionCorespondenceDate',
                'resolutionDiscussionStatus',
                'resolution_requestNumber',
                'resolutionRemarks',
                'resolutionRemarksDescription',
            
                    ])->where('id = ?' , $id);
        
        $result = $select->query()->fetch();
        if (0 == count($result)) {
            return;
        }
        $row = $result;
        $obj->setResolutionDiscussionDate($row['resolutionDiscussionDate'])
                ->setResolutionDiscussionStatus($row['resolutionDiscussionStatus'])
                ->setResolutionCorespondenceDate($row['resolutionCorespondenceDate'])
                ->setResolutionRemarks($row['resolutionRemarks'])
                ->setResolutionRemarksDescription($row['resolutionRemarksDescription'])
                ->setResolution_requestNumber($row['resolution_requestNumber'])
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