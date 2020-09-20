<?php
/**
 * Description of JBlac_Services_Sector
 *
 * @author Innocent
 */
class JBlac_Services_Sector {
    //put your code here
    public static function getSectorsLOV(){
        
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from('bssp_sectors_v');
        $select->where('value IS NOT NULL');
        
        $results = $select->query()->fetchAll();
        
        $sectors = [];
        foreach ($results as $value) {
            $sectors[$value['value']] = $value['label'];
        }
                return $sectors;
    }    
    public static function fetchSectorPriorityAreas($sector){
        
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from('bssp_priority_arears_v' , [
            'value',
            'label'
        ]);
        $select->where('ref_sector_code = :ref_sector_code')
                ->bind([':ref_sector_code' => $sector]);
        
        $results = $select->query()->fetchAll();
        
            $entities = [];
            
            foreach ($results as $row) {
                $entities[$row['value']] = $row['label'];
            } 
            
            return ['priorities' => $results];
    }
    public static function fetchSectorPriorityAreasLOV($sector){
        
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from('bssp_priority_arears_v' , [
            'value',
            'label'
        ]);
        $select->where('ref_sector_code = :ref_sector_code')
                ->bind([':ref_sector_code' => $sector]);
        
        $results = $select->query()->fetchAll();
        
            $entities = [];
            
            foreach ($results as $row) {
                $entities[$row['value']] = $row['label'];
            } 
            
            return $entities;
    }    
    public static function searchOrganizationByOrganizationNumber($regNumber){
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
                  $select->from('ROC_ORG_ORGANISATION_V')
                          ->where('ORG_FILE_NO = ?' , $regNumber);
                  
                  $results = $select->query()->fetch(PDO::FETCH_ASSOC);
                  
        return $results;
                          
    }    
}
