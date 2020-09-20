<?php

class Projects_Model_ProjectConsultantMapper extends JBlac_ObjectModelMapper
{
    public function save(Projects_Model_ProjectConsultant $objEntity)
    {
        $data = [
            'id'                            => $objEntity->getId(),
            'legalEntityId'                 => $objEntity->getLegalEntityId(),
            'projectNumber'                 => $objEntity->getProjectNumber(),
            'principleConsultant'           => $objEntity->getPrincipleConsultant(),           
        ];
//        Zend_Debug::dump($data);exit;
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

    public function find($id, Projects_Model_ProjectConsultant $objEntity)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $objEntity->setId($row->id)
                  ->setLegalEntityId($row->legalEntityId)
                  ->setProjectNumber($row->projectNumber)
                  ->setPrincipleConsultant($row->principleConsultant);       
        return $row;
    }
    public function fetchOne($id, Projects_Model_ProjectConsultant $objEntity)
    {
        $select = $this->getDbTable()->select()->from('bssp_project_consultancy_v')->where('id = ?' , $id);
        $result = $select->query()->fetch();
        if (0 == count($result)) {
            return;
        }
        $row = $result;
        $objEntity->setId($row['id'])
                  ->setLegalEntityId($row['legalEntityId'])
                  ->setProjectNumber($row['projectNumber'])
                  ->setPrincipleConsultant($row['principleConsultant']); 
        
        return $row;
    }
    public function fetchOneByProjectNumnber($projectNumber)
    {
        
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from('bssp_project_consultancy_v')
                    ->where('projectNumber = ?' , $projectNumber);

        $results = $select->query()->fetch();        

        if (!$results) {
            $results = [];
        }

        return $results;
    }    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Projects_Model_ProjectConsultant();
            $entry->setId($row->id)
                  ->setLegalEntityId($row->legalEntityId)
                  ->setProjectNumber($row->projectNumber)
                  ->setPrincipleConsultantName($row->principleConsultantName); 
            $entries[] = $entry;
        }
        return $entries;
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
        $paginator->setItemCountPerPage(5);
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