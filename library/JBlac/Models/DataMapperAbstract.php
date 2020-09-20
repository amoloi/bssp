<?php
/**
 * Description of JBlac_Model_DataMapperAbstract
 *
 * @author Innocent
 */

abstract class JBlac_Model_DataMapperAbstract {
    private static $_db = null;
    private static $_instance = null;


    protected function getDb(){
        if(is_null(self::$_db)){
            self::$_db = Zend_Db_Table::getDefaultAdapter();
        }
        
        return self::$_db;
    }
    
    public function save(JBlac_Model_DomainObjectAbstract $obj){
        if(is_null($obj->getId())){
            $this->_insert($obj);
        }else{
            $this->_update($obj);
        }
    }
    
    abstract protected function _insert(JBlac_Model_DomainObjectAbstract $obj);
    abstract protected function _update(JBlac_Model_DomainObjectAbstract $obj);
    abstract public static function getInstance();   
}