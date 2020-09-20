<?php

class Payments_Model_BsspPaymentInstallmentMapper extends JBlac_ObjectModelMapper
{
    public function save(Payments_Model_BsspPaymentInstallment $objEntity)
    {
        $data = [
            'id'                =>  $objEntity->getId(),
            'installmentAmount'            =>  $objEntity->getAmount(),
            'installmentPhase'             =>  $objEntity->getPhase(),
            'installmentDateOfPayment'        =>  $objEntity->getDateOfPayment(),            
            'installmentBudgetNumber'           =>  $objEntity->getBudgetNumber(),
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

    public function find($id, Funds_Model_Payment $objEntity)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $objEntity->setAmount($row->amount)
                  ->setPhase($row->phase)
                  ->setDateOfPayment($row->dateOfPayment)
                  ->setBudgetNumber($row->budgetNumber)
                ->setId($row->id);        
        return $row;
    }
    public function fetchOne($id, Funds_Model_Payment $objEntity)
    {
        $select = $this->getDbTable()->select()->from(['d' => 'funds'] , [
                    'id',
                    'installmentAmount',
                    'installmentPhase',
                    'DATE_FORMAT(installmentDateOfPayment , \'%d/%m/%Y\') as installmentDateOfPayment',
                    'installmentBudgetNumber',                    
                    ])->where('id = ?' , $id);
        $result = $select->query()->fetch();
        if (0 == count($result)) {
            return;
        }
        $row = $result;
        $objEntity->setAmount($row['installmentAmount'])
                  ->setPhase($row['installmentPhase'])
                  ->setDateOfPayment($row['installmentDateOfPayment'])
                  ->setBudgetNumber($row['installmentBudgetNumber'])
                  ->setId($row['id']);
        
        return $row;
    } 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $objEntity = new Funds_Model_Payment();
            $objEntity->setAmount($row->installmentAmount)
                  ->setPhase($row->installmentPhase)
                  ->setDateOfPayment($row->installmentDateOfPayment)
                  ->setBudgetNumber($row->installmentBudgetNumber)
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
    public function searchPaymentByBudgetNumber($installmentBudgetNumber)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['b' => 'bssp_payment_installments_v'])->where('installmentBudgetNumber = ?' , $installmentBudgetNumber);

        $results = $select->query()->fetchAll();

        if (!$results) {
            return [];
        }
        
        return $results;
    } 
}