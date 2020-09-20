<?php
/**
 * Description of JBlac_Utilities_AgeCalculator
 *
 * @author Innocent
 */
class JBlac_Utilities_BSSP {
    
    public static function getApplicationNumber(){
        $db = Zend_Db_Table::getDefaultAdapter();

        $data = [
            'data' => NULL,
        ];
        
        try {
            $OK = $db->insert('bssp_application_numbers_gen', $data);
            $id = $db->lastInsertId();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
                
        $select = $db->select()->from('bssp_application_numbers_gen', [
                    'id',
                    "CONCAT_WS('' ,'BSA' , DATE_FORMAT(CURRENT_DATE,'%Y%m%d') , LPAD(id , 4 , 0)) AS appl_number",
                    ])
                ->where('id = ?' , $id);
        try {
           $results = $select->query()->fetch();
           
           $where = ['id = ?' => $id];
           $db->delete('bssp_application_numbers_gen', $where); 
           
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $results['appl_number']; 
    } 
    
    public static function getProjectNumber(){
        $db = Zend_Db_Table::getDefaultAdapter();
        $proj_number = null;
        
        $data = [
            'year' => NULL,
        ];
        
        try {
            $OK = $db->insert('bssp_project_numbers_gen', $data);
            $id = $db->lastInsertId();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
                
        $select = $db->select()->from('bssp_project_numbers_gen', [
                    "CONCAT_WS('' ,'BSP' , DATE_FORMAT(CURRENT_DATE , '%Y%m%d') , LPAD(id , 4 , 0)) AS proj_number",
                    ])
                ->where('id = ?' , $id);
        try {
           $results = $select->query()->fetch();
           
           $where = ['id = ?' => $id];
           $db->delete('bssp_project_numbers_gen', $where);           
           
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $results['proj_number']; 
    }
    
    /**
     * Request numbers
     */    
    public static function getRequestNumber(){
        $db = Zend_Db_Table::getDefaultAdapter();
        $proj_number = null;
        
        $data = [
            'year' => NULL,
        ];
        
        try {
            $OK = $db->insert('bssp_request_numbers_gen', $data);
            $id = $db->lastInsertId();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
                
        $select = $db->select()->from('bssp_request_numbers_gen', [
                    'id',
                    "CONCAT_WS('' ,'BSR' , YEAR(CURRENT_DATE),MONTH(CURRENT_DATE) , LPAD(id , 8 , 0)) AS request_number",
                    ])
                ->where('id = ?' , $id);
        try {
           $results = $select->query()->fetch();
           
           $where = ['id = ?' => $id];
           $db->delete('bssp_request_numbers_gen', $where);
           
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $results['request_number']; 
    }
    
    public static function getMusterBudgetCode(){
        $db = Zend_Db_Table::getDefaultAdapter();
        $proj_number = null;
        
        $data = [
            'year' => NULL,
        ];
        
        try {
            $OK = $db->insert('bssp_master_budgets', $data);
            $id = $db->lastInsertId();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
                
        $select = $db->select()->from('bssp_master_budgets', [
                    'id',
                    "CONCAT_WS('' ,'BSMB' , DATE_FORMAT(CURRENT_DATE , '%Y%m%d') , LPAD(id , 6 , 0)) AS master_budget_number",
                    ])
                ->where('id = ?' , $id);
        try {
           $results = $select->query()->fetch();
           $where = ['id = ?' => $id];
           $db->delete('master_budget_number', $where);           
           
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $results['master_budget_number']; 
    }
    public static function getProjectBudgetCode(){
        $db = Zend_Db_Table::getDefaultAdapter();
        $proj_number = null;
        
        $data = [
            'year' => NULL,
        ];
        
        try {
            $OK = $db->insert('bssp_project_budget_numbers_gen', $data);
            $id = $db->lastInsertId();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
                
        $select = $db->select()->from('bssp_project_budget_numbers_gen', [
                    'id',
                    "CONCAT_WS('' ,'BSPB' , DATE_FORMAT(CURRENT_DATE , '%Y%m%d') , LPAD(id , 6 , 0)) AS project_budget_number",
                    ])
                ->where('id = ?' , $id);
        try {
           $results = $select->query()->fetch();
           $where = ['id = ?' => $id];
           $db->delete('bssp_project_budget_numbers_gen', $where);
           
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $results['project_budget_number']; 
    }    
    public static function getBudgetPeriods($startYear = null ){
        $periods = [];
        if(is_null($startYear)){
            $start = date('Y');
        }  else {
            $start = $startYear;
        }

        for($i = 0 ; $i < ((date('Y')+5) - $startYear) ; $i++){
            $end = $start + 1;
  
            $period = sprintf('%d-%d' , $start ,$end);
            $periods[$period] = $period;
            
            $start = $end;
        }
        
        return $periods;
    }
    
    public static function getUserRoles(){
        $roles = [
            3 => 'Administrator',
            2 => 'User - Data Capturer',
            1 => 'User - Committee'
        ];
        return $roles;
    }
    public static function fetchBudgetsLOV()
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['b' => 'budgets_v'] , [
                    'value',
                    'label',
                    ]);

        $results = $select->query()->fetchAll();

        if (0 == count($results)) {
            return [];
        }
        $lovs = [];
        foreach ($results as $row) {
            $lovs[$row['value']] = $row['label'];

        }        
        return $lovs;
    }      
}