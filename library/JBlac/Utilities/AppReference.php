<?php
/**
 * Description of ListReferenceCodes
 *
 * @author Innocent J Blac
 */
class JBlac_Utilities_AppReference {
    
    public static function fetchEntityLOV($entity)
        {
            $db = Zend_Db_Table::getDefaultAdapter();
            $select = $db->select()->from('legal_entities_v', [
                        'id',
                        'COALESCE(nullif(person , \'\') , company) as name',
                        ])
                        ->where('entityCategory = ?' , $entity);

            $results = $select->query()->fetchAll();

            if (0 == count($results)) {
                exit;
                return [];
            }
            $entities = [];
            foreach ($results as $row) {
                $entities[$row['id']] = $row['name'];

            }        
            return $entities;
        }
    public static function fetchApplicationsLOV()
        {
            $db = Zend_Db_Table::getDefaultAdapter();
            $select = $db->select()->from('applications_lov_v', [
                        'id',
                        'application',
                        ])
                        ->where('application IS NOT NULL');

            $results = $select->query()->fetchAll();

            if (0 == count($results)) {
                return [];
            }
            $entities = [];
            foreach ($results as $row) {
                $entities[$row['id']] = $row['application'];

            }        
            return $entities;
        }        
    public static function fetchFundsLOV()
        {
            $db = Zend_Db_Table::getDefaultAdapter();
            $select = $db->select()->from('bssp_project_budget_lov_v', [
                        'budgetNumber',
                        'budget',
                        ])
                        ->where('budgetNumber IS NOT NULL');

            $results = $select->query()->fetchAll();
            
            if (0 == count($results)) {
                return [];
            }
            $entities = [];
            foreach ($results as $row) {
                $entities[$row['budgetNumber']] = $row['budget'];

            } 
            
            return $entities;
    }
    public static function getCountries($listOrder = FALSE){
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from('countries_lov_v');
        $select->where('CODE IS NOT NULL');
        $codes = [];

        $data = $db->query($select)->fetchAll();
        foreach($data as $code) {
            $codes[$code['code']] = strtoupper($code['name']);
            }        
            return $codes;
        }
    public static function getRegions($listOrder = FALSE){
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from('regions_lov_v');
        $select->where('value IS NOT NULL');
        $codes = [];

        $data = $db->query($select)->fetchAll();
        foreach($data as $code) {
            $codes[$code['value']] = $code['label'];
        }
        array_push($codes, ['Not Defined' => 'Not Defined']);
            return $codes;
        }        
    public static function fetchRegionTowns($region)
        {
            $db = Zend_Db_Table::getDefaultAdapter();
            $select = $db->select()->from('city_towns_lov_v', [
                        'value',
                        'label',
                        ])
                        ->where('region = ?' , $region);

            $results = $select->query()->fetchAll();
            $entities = [];
            
            if (!$results) {
                $results = [
                            ['value' => 'Not Defined' , 'label' => 'Not Defined']
                           ];
            }else{
                array_push($results, ['value' => 'Not Defined' , 'label' => 'Not Defined']);
                foreach ($results as $row) {
                    $entities[$row['value']] = $row['label'];
                }                
            }

            return ['towns' => $results];
    }
    public static function fetchRegionTownsStandard($region)
        {
            $db = Zend_Db_Table::getDefaultAdapter();
            $select = $db->select()->from('city_towns_lov_v', [
                        'value',
                        'label',
                        ])
                        ->where('region = ?' , $region);

            $results = $select->query()->fetchAll();
            
            if (0 == count($results)) {
                return [];
            }
            $entities = ['Not Defined' => 'Not Defined'];
            foreach ($results as $row) {
                $entities[$row['value']] = $row['label'];
            } 
            
            return $entities;
    } 
    public static function fetchTowns($region = null)
        {
            $db = Zend_Db_Table::getDefaultAdapter();
            $select = $db->select()->from('city_towns_lov_v', [
                        'value',
                        'label',
                        ]);
            if($region !== null){
                $select->where('region = ?' , $region);
            }else{
                $select->where('value IS NOT NULL');
            }
                        

            $results = $select->query()->fetchAll();
            
            if (!$results) {
                $results = [
                            ['value' => 'Not Defined' , 'label' => 'Not Defined']
                           ];
            }else{
                
                array_push($results, ['value' => 'Not Defined' , 'label' => 'Not Defined']);
            }
            
            $entries = [];
            
            foreach ($results as $row) {
                $entries[$row['value']] = $row['label'];
            }            
            
            return $entries;
    }
    
    public static function fetchTownConstituences($town)
        {
            $db = Zend_Db_Table::getDefaultAdapter();
            $select = $db->select()->from('constituences_lov_v', [
                        'value',
                        'label',
                        ])
                        ->where('town = ?' , $town);

            $results = $select->query()->fetchAll();
            
            if (!$results) {
                $results = [
                            ['value' => 'Not Defined' , 'label' => 'Not Defined']
                           ];
            }else{
                
                array_push($results, ['value' => 'Not Defined' , 'label' => 'Not Defined']);
            }
            
            $entities = [];
            foreach ($results as $row) {
                $entities[$row['value']] = $row['label'];
            } 
            
            return ['constituences' => $results];
    }
    
     public static function fetchConstituences($town = null)
        {
            $db = Zend_Db_Table::getDefaultAdapter();
            $select = $db->select()->from('constituences_lov_v', [
                        'value',
                        'label',
                        ]);
            if($town !== null){
                $select->where('town = ?' , $town);
            }else{
                $select->where('value IS NOT NULL');
            }
                        

            $results = $select->query()->fetchAll();
            
            if (!$results) {
                $results = [
                            ['value' => 'Not Defined' , 'label' => 'Not Defined']
                           ];
            }else{
                
                array_push($results, ['value' => 'Not Defined' , 'label' => 'Not Defined']);
            }
            
            $entries = [];
            foreach ($results as $row) {
                $entries[$row['value']] = $row['label'];
            } 
            
            return $entries;
    } 
    
    public static function getIsoCountries($alpha = 2){
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();

        switch ($alpha) {
            case 2:
                    $select->from('COUNTRIES_ISO_ALPA2_V');
                break;
            case 3:
                    $select->from('COUNTRIES_ISO_ALPA3_V');
                break;            
            default:
                    $select->from('COUNTRIES_LOV_V');                
                break;
}
        
        $select->where('VALUE IS NOT NULL');
        $codes = [];

        $data = $db->query($select)->fetchAll();
        foreach($data as $code) {
            $codes[$code['VALUE']] = $code['LABEL'];
        }
        return $codes;
    }
    
    public static function getIsoDialingCountryCodes(){
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();

            $select->from('COUNTRY_DIALING_CODES_V');
        
            $select->where('VALUE IS NOT NULL');
        $codes = [];

        $data = $db->query($select)->fetchAll();
        foreach($data as $code) {
            $codes[$code['VALUE']] = $code['LABEL'];
        }
        return $codes;
    }    
}