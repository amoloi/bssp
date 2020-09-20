<?php

class Budgets_Model_MasterBudgetMapper extends JBlac_ObjectModelMapper
{
    public function save(Budgets_Model_MasterBudget $objEntity)
    {
        $data = [
            'id'                =>  $objEntity->getId(),
            'code'            =>  $objEntity->getCode(),
            'name'             =>  $objEntity->getName(),
            'period'        =>  $objEntity->getPeriod(),
            'amount'             =>  $objEntity->getAmount(),
            'description'        =>  $objEntity->getDescription(),            
            'GLAccount'           =>  $objEntity->getGLAccount(),
        ];
        if (null === ($id = $objEntity->getId())) {
            
            unset($data['id']);
            $data['createdOn'] = date('Y-m-d H:i:s');
            $data['createdBy'] = Zend_Registry::get('user'); 
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

    public function find($id, Budgets_Model_MasterBudget $objEntity)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $objEntity->setCode($row->code)
                  ->setName($row->name)
                  ->setPeriod($row->period)
                  ->setAmount($row->amount)
                  ->setDescription($row->description)
                  ->setGLAccount($row->GLAccount)
                ->setId($row->id);        
        return $row;
    }
    public function fetchOne($id, Budgets_Model_MasterBudget $objEntity)
    {
        $select = $this->getDbTable()->select()->from(['b' => 'bssp_master_budgets'] , [
                    'id',
                    'code',
                    'name',
                    'period',
                    'amount',                    
                    'description',
                    'GLAccount',
                    ])->where('id = ?' , $id);
        $select->setIntegrityCheck(false);
            try {
                $result = $select->query()->fetch();
            } catch (Exception $ex) {

            }
        
        if (0 == count($result)) {
            return $result;
        }
        $row = $result;
        $objEntity->setCode($row['code'])
                  ->setName($row['name'])
                  ->setPeriod($row['period'])
                  ->setAmount($row['amount'])
                  ->setDescription('description')
                  ->setGLAccount($row['GLAccount'])
                  ->setId($row['id']);
        
        return $row;
    }
    public static function searchFinancialBudgets(array $options = null , $category = null)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        if(!is_null($options)){
            
            if(!empty($options['budgetName'])){
                
                $select->where('name LIKE ?', "%{$options['budgetName']}%");
            }
            if(!empty($options['budgetCode'])){
                
                $select->where('code = ?', $options['budgetCode']);
            }
            if(!empty($options['budgetPeriod'])){
                
                $select->where('period = ?', $options['budgetPeriod']);
            }            
            $select->from(['a' => 'bssp_master_budgets']);
        }else{
            //$select = $db->select()->from(['a' => 'bssp_applications_legal_entity_v']);
        }
            $adapter = new Zend_Paginator_Adapter_DbSelect($select);
            
            $paginator = new Zend_Paginator($adapter);

        return $paginator;
    }     
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $objEntity = new Budgets_Model_MasterBudget();
            $objEntity->setCode($row->amount)
                  ->setName($row->phase)
                  ->setPeriod($row->dateOfPayment)
                  ->setAmount($row->fundsId)
                  ->setDescription($row->remarks)
                  ->setGLAccount($row->GLAccount)
                  ->setId($row->id);
            $entries[] = $objEntity;
        }
        return $entries;
    }
    public function fetchArray()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        return $resultSet;
    }
    
    public function fetchAllMasterBudgets()
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        
        $select = $db->select();        
        $select->from(['b' => 'bssp_master_budget_v']);

            try {
                $results = $select->query()->fetchAll();
            } catch (Exception $ex) {

            }
        
        if (!$results) {
            $results = [];
        }
        
        return $results;
    }    
    
    public function fetchPage($page)
    {
        /*
        * Object of Zend_Paginator
        */
        $paginator = Zend_Paginator::factory($this->fetchAllMasterBudgets());
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