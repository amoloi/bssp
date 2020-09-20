<?php

class Payments_Model_PaymentMapper extends JBlac_ObjectModelMapper
{
    public function save(Payments_Model_Payment $objEntity)
    {
        $data = [
            'id'                =>  $objEntity->getId(),
            'amount'            =>  $objEntity->getAmount(),
            'phase'             =>  $objEntity->getPhase(),
            'dateOfPayment'        =>  $objEntity->getDateOfPayment(),            
            'budgetNumber'           =>  $objEntity->getBudgetNumber(),
        ];
        if (null === ($id = $objEntity->getId())) {
            
            unset($data['id']);
            $data['createdBy'] = $objEntity->getCreatedBy();
            $data['createdOn'] = date('Y-m-d H:i:s');
            try {
              $newId =  $this->getDbTable()->insert($data);
              $objEntity->setId($newId);
              return $objEntity->getId();
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }

            
        } else {
            $data['modifiedBy'] = $objEntity->getModifiedBy();
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
                  ->setRemarks($row->remarks)
                ->setId($row->id);        
        return $row;
    }
    public function fetchOne($id, Funds_Model_Payment $objEntity)
    {
        $select = $this->getDbTable()->select()->from(['d' => 'funds'] , [
                    'id',
                    'amount',
                    'phase',
                    'DATE_FORMAT(dateOfPayment , \'%d/%m/%Y\') as dateOfPayment',
                    'budgetNumber',                    
                    'remarks',
                    ])->where('id = ?' , $id);
        $result = $select->query()->fetch();
        if (0 == count($result)) {
            return;
        }
        $row = $result;
        $objEntity->setAmount($row['amount'])
                  ->setPhase($row['phase'])
                  ->setDateOfPayment($row['dateOfPayment'])
                  ->setBudgetNumber($row['budgetNumber'])
                  ->setRemarks($row['remarks'])
                  ->setId($row['id']);
        
        return $row;
    } 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $objEntity = new Funds_Model_Payment();
            $objEntity->setAmount($row->amount)
                  ->setPhase($row->phase)
                  ->setDateOfPayment($row->dateOfPayment)
                  ->setBudgetNumber($row->budgetNumber)
                  ->setRemarks($row->remarks)
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

}