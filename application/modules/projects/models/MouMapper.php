<?php

class Projects_Model_MouMapper extends JBlac_ObjectModelMapper
{
    public function save(Projects_Model_Mou $objEntity)
    {
        $data = [
            'id'                    =>  $objEntity->getId(),
            'projectNumber'         =>  $objEntity->getProjectNumber(),
            'signedDate'            =>  $objEntity->getSignedDate(),
            'completionDate'        =>  $objEntity->getCompletionDate(),
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
            unset($data['id']);
            $data['modifiedBy'] = Zend_Registry::get('user');
            $data['modifiedOn'] = date('Y-m-d H:i:s');            
            $this->getDbTable()->update($data, ['id = ?' => $id]);
        }
    }

    public function find($id, Projects_Model_Mou $objEntity)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $objEntity->setId($row->id)
                  ->setProjectNumber($row->projectNumber)
                  ->setSignedDate($row->signedDate)
                  ->setCompletionDate($row->completionDate);       
        return $row;
    }
    public function fetchOne($id, Projects_Model_Mou $objEntity)
    {
        $select = $this->getDbTable()->select()->from('bssp_mou_v')->where('mou_id = ?' , $id);
        
        $results = $select->query()->fetch();
        $row = $results; 
        
        return $row;
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Projects_Model_Mou();
            $entry->setId($row->buyerId)
                  ->setProjectNumber($row->projectNumber)
                  ->setSignedDate($row->signedDate)
                  ->setCompletionDate($row->completionDate);
            $entries[] = $entry;
        }
        return $entries;
    }

    public function fetchMouByProjectNumber($projectNumber)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from('bssp_mou_v')
                    ->where('projectNumber = ?' , $projectNumber);

        $results = $select->query()->fetch();

        $entry = null;
        
        if($results){
                $objEntity = new Projects_Model_Mou(); 
                $objEntity->setId($results['mou_id'])
                          ->setProjectNumber($results['projectNumber'])
                          ->setSignedDate($results['signedDate'])
                          ->setCompletionDate($results['completionDate']);
                $entry = $objEntity;
        }         

        return $results;
    }     
}