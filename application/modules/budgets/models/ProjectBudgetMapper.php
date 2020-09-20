<?php

class Budgets_Model_ProjectBudgetMapper extends JBlac_ObjectModelMapper
{
    protected $entries = [];
    public function save(Budgets_Model_ProjectBudget $obj)
    {
        $data = [
            'id'                            => $obj->getId(),
            'budgetNumber'                  => $obj->getBudgetNumber(),
            'budgetName'                    => $obj->getBudgetName(),
            'budgetAmount'                  => $obj->getBudgetAmount(),
            'budgetOutstandingAmount'       => $obj->getBudgetOutstandingAmount(),            
            'budgetDateOfApproval'          => $obj->getBudgetDateOfApproval(),
            'masterBudgetNumber'            => $obj->getMasterBudgetNumber(),
            'projectNumber'                 => $obj->getProjectNumber(),
            
        ];
        if (null === ($id = $obj->getId())) {
            
            unset($data['id']);
            $data['createdBy'] = Zend_Registry::get('user');
            $data['createdOn'] = date('Y-m-d H:i:s');
            try {
              $newId =  $this->getDbTable()->insert($data);
              $obj->setId($newId);
              return $obj->getId();
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }

            
        } else {
            $data['modifiedBy'] = Zend_Registry::get('user');
            $data['modifiedOn'] = date('Y-m-d H:i:s');            
            $this->getDbTable()->update($data, ['id = ?' => $id]);
        }
    }

    public function find($id, Budgets_Model_ProjectBudget $obj)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $obj->setBudgetNumber($row->budgetNumber)
                  ->setBudgetName($row->budgetName)
                  ->setBudgetAmount($row->budgetAmount)
                  ->setBudgetOutstandingAmount($row->budgetOutstandingAmount)
                  ->setBudgetDateOfApproval($row->budgetDateOfApproval)
                  ->setBudgetRemarks($row->budgetRemarks)
                  ->setMasterBudgetNumber($row->masterBudgetNumber)
                ->setId($row->id);        
        return $row;
    }
    public function fetchOne($id, Budgets_Model_ProjectBudget $obj)
    {
        $select = $this->getDbTable()->select()->from(['d' => 'bssp_project_budgets'] , [
                    'id',
                    'budgetNumber',
                    'budgetName',
                    'budgetAmount',
                    'budgetOutstandingAmount',
                    'DATE_FORMAT(budgetDateOfApproval , \'%d/%m/%Y\') as budgetDateOfApproval',
                    'budgetRemarks',
                    'masterBudgetNumber',
                    ])->where('id = ?' , $id);
        $result = $select->query()->fetch();
        if (0 == count($result)) {
            return;
        }
        $row = $result;
        $obj->setBudgetNumber($row['budgetNumber'])
                  ->setBudgetName($row['budgetName'])
                  ->setBudgetAmount($row['budgetAmount'])
                  ->setBudgetOutstandingAmount($row['budgetOutstandingAmount'])
                  ->setBudgetDateOfApproval($row['budgetDateOfApproval'])
                  ->setBudgetRemarks($row['budgetRemarks'])
                  ->setMasterBudgetNumber($row['masterBudgetNumber'])
                  ->setId($row['id']); 
        
        return $row;
    }
    public function fetchProjectBudgets()
    {
        $select = $this->getDbTable()->select()->from(['d' => 'bssp_project_budgets'] , [
                    'id',
                    'budgetNumber',
                    'budgetName',
                    'budgetAmount',
                    'budgetOutstandingAmount',
                    'DATE_FORMAT(budgetDateOfApproval , \'%d/%m/%Y\') as budgetDateOfApproval',
                    'budgetRemarks',
                    'masterBudgetNumber',
                    ]);
        $results = $select->query()->fetchAll();
        if (0 == count($results)) {
            return [];
        }

        $entries   = [];
        foreach ($results as $row) {
            $obj = new Budgets_Model_ProjectBudget();
            $obj->setBudgetNumber($row['budgetNumber'])
                      ->setBudgetName($row['budgetName'])
                      ->setBudgetAmount($row['budgetAmount'])
                      ->setBudgetOutstandingAmount($row['budgetOutstandingAmount'])
                      ->setBudgetDateOfApproval($row['budgetDateOfApproval'])
                      ->setBudgetRemarks($row['budgetRemarks'])
                      ->setMasterBudgetNumber($row['masterBudgetNumber'])
                      ->setId($row['id']);
                $entries[] = $obj;
        }
        $this->entries = $entries;
        
        return $results;
    }    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $obj = new Budgets_Model_ProjectBudget();
            $obj->setBudgetNumber($row->budgetNumber)
                      ->setBudgetName($row->budgetName)
                      ->setBudgetAmount($row->budgetAmount)
                      ->setBudgetOutstandingAmount($row->budgetOutstandingAmount)
                      ->setBudgetDateOfApproval($row->budgetDateOfApproval)
                      ->setBudgetRemarks($row->budgetRemarks)
                      ->setMasterBudgetNumber($row->masterBudgetNumber)
                    ->setId($row->id);
            $entries[] = $obj;
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
        $paginator = Zend_Paginator::factory($this->fetchFunds());
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
    public function getEntries(){
        return $this->entries;
    }
    
    public static function fetchBudgetByProjectNumber($projectNumber)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['b' => 'bssp_project_budget_v'])->where('projectNumber = ?' , $projectNumber);

        $result = $select->query()->fetch();

        if (!$result) {
            return [];
        }
        
        return $result;
    }
    public static function searchBudgetDataPerProject($projectNumber)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['b' => 'bssp_project_budget_details_v'] , [
                    'budgetAmount',
                    'paidAmount',
                    'autstandingAmount',
                    ])->where('projectNumber = ?' , $projectNumber);

        $result = $select->query()->fetch();

        if (!$result) {
            return [
                    'budgetAmount'          =>   '0.00',
                    'paidAmount'            =>   '0.00',
                    'autstandingAmount'     =>   '0.00',                
                    ];
        }
        
        return $result;
    }
    
    public static function fetchCOnsultanceBudgetByConultantLegalEntityId($legalEntityId)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['b' => 'bssp_consultancy_budget_v'])->where('consultantLegalEntityId = ?' , $legalEntityId);

        $result = $select->query()->fetch();

        if (!$result) {
            return [
                    'committedAmount'           =>   '0.00',
                    'paidAmount'                =>   '0.00',
                    'consultantId'              =>   null,
                    'consultantLegalEntityId'   =>   null,
                    ];
        }
        
        return $result;
    }    
}