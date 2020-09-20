<?php
/**
 * Description of JBlac_Services_Application
 *
 * @author Innocent
 */
class JBlac_Services_Application {
    

//$count = $db->fetchOne(  );

    public static function getNumberOfNewApplications(){
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
                  $select->from('bssp_application_count_v');
                  
                  $results = $select->query()->fetch(PDO::FETCH_ASSOC);
                  
        return ['rows' => $results];
                          
    }
    
    public static function getNumberOfNewCommiteeResolution(){
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
                  $select->from('bssp_commitee_resolution_count_v');
                  
                  $results = $select->query()->fetch(PDO::FETCH_ASSOC);
                  
        return ['rows' => $results];
                          
    }
    public static function getNumberOfNewProjects(){
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
                  $select->from('bssp_projects_count_v');
                  
                  $results = $select->query()->fetch(PDO::FETCH_ASSOC);
                  
        return ['rows' => $results];
                          
    }    
}