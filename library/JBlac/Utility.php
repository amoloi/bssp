<?php
/**
 * Description of JBlac_Utilities_AgeCalculator
 *
 * @author Innocent
 */
class JBlac_Utility {
    
    /**
     * 
     * @param type $dateOfBirth
     * @return int - person`s age based on a supplied DOB
     */
    public static function getProjectNumber(){
        $db = Zend_Db_Table::getDefaultAdapter();
        $proj_number = null;
        
        $data = [
            'year' => NULL,
        ];
        
        try {
            $OK = $db->insert('project_numbers_gen', $data);
            $id = $db->lastInsertId();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
                
        $select = $db->select()->from('project_numbers_gen', [
                    'id',
                    "CONCAT_WS('' ,'BSP' , YEAR(CURRENT_DATE) , LPAD(id , 5 , 0)) AS proj_number",
                    ])
                ->where('id = ?' , $id);
        try {
           $results = $select->query()->fetch(); 
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $results['proj_number']; 
    }
    public static function getApplicationNumber(){
        $db = Zend_Db_Table::getDefaultAdapter();

        $data = [
            'data' => NULL,
        ];
        
        try {
            $OK = $db->insert('application_numbers_gen', $data);
            $id = $db->lastInsertId();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
                
        $select = $db->select()->from('application_numbers_gen', [
                    'id',
                    "CONCAT_WS('' ,'BSA' , YEAR(CURRENT_DATE) , LPAD(id , 5 , 0)) AS appl_number",
                    ])
                ->where('id = ?' , $id);
        try {
           $results = $select->query()->fetch(); 
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $results['appl_number']; 
    }    
    public static function getBudgetCode(){
        $db = Zend_Db_Table::getDefaultAdapter();
        $proj_number = null;
        
        $data = [
            'year' => NULL,
        ];
        
        try {
            $OK = $db->insert('project_numbers_gen', $data);
            $id = $db->lastInsertId();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
                
        $select = $db->select()->from('project_numbers_gen', [
                    'id',
                    "CONCAT_WS('' ,'BSB' , YEAR(CURRENT_DATE) , LPAD(id , 5 , 0)) AS proj_number",
                    ])
                ->where('id = ?' , $id);
        try {
           $results = $select->query()->fetch(); 
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $results['proj_number']; 
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