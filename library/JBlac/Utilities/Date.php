<?php
/**
 * Description of JBlac_Utilities_Date
 *
 * @author Innocent
 */
class JBlac_Utilities_Date {
    
    /**
     * 
     * @param type $date in the format dd/mm/yyyy
     * @return date - MySQL Default date in the format yyyy-mm-dd
     */
    public static function getMySQLDefault($date){
            if(is_null($date)){
                return date('Y-m-d');
            }
            list($dd , $mm , $yyyy) = explode('/', $date);
            
        return sprintf('%s-%s-%s', $yyyy , $mm , $dd);        
    }
}
