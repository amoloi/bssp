<?php

class Promoters_Model_AddressMapper extends JBlac_ObjectModelMapper
{
    public function save(Promoters_Model_Address $objEntity)
    {
        $data = [
            'id'                => $objEntity->getId(),
            'addressLineOne'    => $objEntity->getAddressLineOne(),
            'addressLineTwo'    => $objEntity->getAddressLineTwo(),
            'postalAddress'     => $objEntity->getPostalAddress(),           
            'regionCode'        => $objEntity->getRegionCode(),
            'cityCode'          => $objEntity->getCityCode(),
            'countryCode'       => $objEntity->getCountryCode(),
            'promoterId'           => $objEntity->getPromoterId(),
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
            unset($data['promoterId']);
            $data['modifiedBy'] = $objEntity->getModifiedBy();
            $data['modifiedOn'] = date('Y-m-d H:i:s');            
            $this->getDbTable()->update($data, ['id = ?' => $id]);
        }
    }

    public function find($id, Promoters_Model_Address $objEntity)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $objEntity->setId($row->id)
                  ->setAddressLineOne($row->addressLineOne)
                  ->setAddressLineTwo($row->addressLineTwo)
                  ->setPostalAddress($row->postalAddress)
                  ->setRegionCode($row->regionCode)
                  ->setCityCode($row->cityCode)
                  ->setCountryCode($row->countryCode)
                  ->setPromoterId($row->promoterId);        
        return $row;
    }
    public function fetchOne($id, Promoters_Model_Address $objEntity)
    {
        $select = $this->getDbTable()->select()->from('address')->where('id = ?' , $id);
        $result = $select->query()->fetch();
        if (0 == count($result)) {
            return;
        }
        $row = $result;
        $objEntity->setId($row['id'])
                  ->setAddressLineOne($row['addressLineOne'])
                  ->setAddressLineTwo($row['addressLineTwo'])
                  ->setPostalAddress($row['postalAddress'])
                  ->setRegionCode($row['regionCode'])
                  ->setCityCode($row['cityCode'])
                  ->setCountryCode($row['countryCode'])
                  ->setPromoterId($row['promoterId']); 
        
        return $row;
    }
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Promoters_Model_Address();
            $entry->setId($row->id)
                  ->setAddressLineOne($row->addressLineOne)
                  ->setAddressLineTwo($row->addressLineTwo)
                  ->setPostalAddress($row->postalAddress)
                  ->setRegionCode($row->regionCode)
                  ->setCityCode($row->cityCode)
                  ->setCountryCode($row->countryCode)
                  ->setPromoterId($row->promoterId);
            $entries[] = $entry;
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