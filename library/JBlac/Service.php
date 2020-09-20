<?php
/**
 * Description of JBlac_Service
 *
 * @author Innocent
 */
class JBlac_Service {
    //put your code here
    
    public static function beginTransaction(){
        Zend_Db_Table::getDefaultAdapter()->beginTransaction();
    }
    public static function commitTransaction(){
        Zend_Db_Table::getDefaultAdapter()->commit();
    }
    public static function rollbackTransaction(){
        Zend_Db_Table::getDefaultAdapter()->rollBack();
    }       
}
