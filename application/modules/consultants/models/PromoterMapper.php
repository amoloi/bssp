<?php

class Promoters_Model_PromoterMapper extends JBlac_ObjectModelMapper
{
    public function save(Promoters_Model_Promoter $objEntity)
    {
        $data = [
            'id'                => $objEntity->getId(),
            'firstName'         => $objEntity->getFirstName(),
            'lastName'          => $objEntity->getLastName(),
            'identityNumber'    => $objEntity->getIdentityNumber(),
            'companyRegistrationNumber'    => $objEntity->getCompanyRegistrationNumber(), 
            'promoterType'    => $objEntity->getPromoterType(), 
            'companyName'    => $objEntity->getCompanyName(), 
            'emailAddress'      => $objEntity->getEmailAddress(),
            'telephoneNumber'   => $objEntity->getTelephoneNumber(),
            'mobileNumber'      => $objEntity->getMobileNumber(),
            'faxNumber'         => $objEntity->getFaxNumber(),
            'remarks'           => $objEntity->getRemarks(),
        ];
        if (null === ($id = $objEntity->getId())) {
            
            unset($data['id']);
            $data['createdBy'] = Zend_Registry::get('user');
            $data['createdOn'] = date('Y-m-d H:i:s');
            try {
              $newId =  $this->getDbTable()->insert($data);
              $objEntity->setId($newId);
              return $objEntity->getId();
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }

            
        } else {
            $data['modifiedBy'] = Zend_Registry::get('user');
            $data['modifiedOn'] = date('Y-m-d H:i:s');            
            $this->getDbTable()->update($data, ['id = ?' => $id]);
        }
    }

    public function find($id, Promoters_Model_Promoter $objEntity)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $objEntity->setId($row->id)
                  ->setFirstName($row->firstName)
                  ->setLastName($row->lastName)
                  ->setIdentityNumber($row->identityNumber)
                  ->setCompanyRegistrationNumber($row->companyRegistrationNumber)
                  ->setCompanyName($row->companyName)
                  ->setPromoterType($row->promoterType)                 
                  ->setEmailAddress($row->emailAddress)
                  ->setTelephoneNumber($row->telephoneNumber)
                  ->setMobileNumber($row->mobileNumber)
                  ->setFaxNumber($row->faxNumber)
                  ->setRemarks($row->remarks);        
        return $row;
    }
    public function fetchOne($id, Promoters_Model_Promoter $objEntity)
    {
        $select = $this->getDbTable()->select()->from(['p' => 'promoters'] , [
                    'id',
                    'firstName',
                    'lastName',
                    'identityNumber',
                    'companyRegistrationNumber',
                    'companyName',
                    'promoterType',            
                    'emailAddress',
                    'telephoneNumber',
                    'mobileNumber',
                    'faxNumber',
                    'remarks',
                    ])->where('id = ?' , $id);
        $result = $select->query()->fetch();
        if (0 == count($result)) {
            return;
        }
        $row = $result;
        $objEntity->setId($row['buyerId'])
                  ->setFirstName($row['firstName'])
                  ->setLastName($row['lastName'])
                  ->setIdentityNumber($row['identityNumber'])
                  ->setCompanyRegistrationNumber($row['companyRegistrationNumber'])
                  ->setCompanyName($row['companyName'])
                  ->setPromoterType($row['promoterType'])
                  ->setEmailAddress($row['emailAddress'])
                  ->setTelephoneNumber($row['telephoneNumber'])
                  ->setMobileNumber($row['mobileNumber'])
                  ->setFaxNumber($row['faxNumber'])
                  ->setRemarks($row['remarks']);
        
        return $row;
    }
    public function fetchDataSet($id, Promoters_Model_Promoter $promoterEntity , Promoters_Model_Address $addressEntity)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(['p' => 'promoters'] , [
                    'id as promoterId',
                    'firstName',
                    'lastName',
                    'identityNumber',
                    'companyRegistrationNumber',
                    'companyName',
                    'promoterType',
                    'emailAddress',
                    'telephoneNumber',
                    'mobileNumber',
                    'faxNumber',
                    'remarks',
                    ])
                    ->join(['a' => 'address'], 'p.id = a.promoterId', [
                    'id as addressId',
                    'addressLineOne',
                    'addressLineTwo',
                    'postalAddress',
                    'regionCode',
                    'cityCode',
                    'countryCode',
                        ])
                        ->where('p.id = ?' , $id);

        $result = $select->query()->fetch();

        if (0 == count($result)) {
            exit;
            return [];
        }
        $row = $result;
        /*
         * Buyer Data
         */
        $promoterEntity->setId($row['promoterId'])
                  ->setFirstName($row['firstName'])
                  ->setLastName($row['lastName'])
                  ->setIdentityNumber($row['identityNumber'])
                  ->setCompanyRegistrationNumber($row['companyRegistrationNumber'])
                  ->setCompanyName($row['companyName'])
                  ->setPromoterType($row['promoterType'])                
                  ->setEmailAddress($row['emailAddress'])
                  ->setTelephoneNumber($row['telephoneNumber'])
                  ->setMobileNumber($row['mobileNumber'])
                  ->setFaxNumber($row['faxNumber'])
                  ->setRemarks($row['remarks']);
        /*
         * Address Data
         */
        $addressEntity->setId($row['addressId'])
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
            $entry = new Auction_Model_Buyer();
            $entry->setId($row->id)
                  ->setFirstName($row->firstName)
                  ->setLastName($row->lastName)
                  ->setIdentityNumber($row->identityNumber)
                  ->setCompanyRegistrationNumber($row->companyRegistrationNumber)
                  ->setCompanyName($row->companyName)
                  ->setPromoterType($row->promoterType)                     
                  ->setEmailAddress($row->emailAddress)
                  ->setTelephoneNumber($row->telephoneNumber)
                  ->setMobileNumber($row->mobileNumber)
                  ->setFaxNumber($row->faxNumber)
                  ->setRemarks($row->remarks);
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
        $paginator->setItemCountPerPage(10);
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