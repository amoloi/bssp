<?php

class Applications_Model_ApplicationMapper extends JBlac_ObjectModelMapper
{
    public function save(Applications_Model_Application $application)
    {
        $data = [
                'id'                        =>               $application->getId() ,
                'promoter'                  =>               $application->getPromoter() ,
                'businessName'              =>               $application->getBusinessName() ,
                'businessSector'            =>               $application->getBusinessSector() ,
                'businessActivity'          =>               $application->getBusinessActivity() ,
                'requestType'               =>               $application->getRequestType() ,
                'telephoneNumber'           =>               $application->getTelephoneNumber() ,
                'mobileNumber'              =>               $application->getMobileNumber() ,
                'faxNumber'                 =>               $application->getFaxNumber() ,
                'emailAddress'              =>               $application->getEmailAddress() ,
                'postalAddress'             =>               $application->getPostalAddress() ,
                'residentialAddress'        =>               $application->getResidentialAddress() ,
                'region'                    =>               $application->getRegion() ,
                'town'                      =>               $application->getTown() ,
                'applicationDate'           =>               $application->getApplicationDate() ,
                'acknowledgementDate'       =>               $application->getAcknowledgementDate() , 
        ];
        if (null === ($id = $application->getId())) {
            
            unset($data['id']);
            $data['createdOn'] = date('Y-m-d H:i:s');
            $data['createdBy'] = Zend_Registry::get('user');
            try {
                $this->getDbTable()->insert($data);
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }

            
        } else {
            $data['modifiedOn'] = date('Y-m-d H:i:s');
            $data['modifiedBy'] = Zend_Registry::get('user');
            $this->getDbTable()->update($data, ['id = ?' => $id]);
        }
    }

    public function find($id, Applications_Model_Application $application)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $application->setId($row->id)
                ->setPromoter($row->promoter)
                ->setBusinessName($row->businessName)
                ->setBusinessSector($row->businessSector)
                ->setBusinessActivity($row->businessActivity)
                ->setRequestType($row->requestType)
                ->setTelephoneNumber($row->telephoneNumber)
                ->setMobileNumber($row->mobileNumber)
                ->setFaxNumber($row->faxNumber)
                ->setEmailAddress($row->emailAddress)
                ->setPostalAddress($row->postalAddress)
                ->setResidentialAddress($row->residentialAddress)
                ->setRegion($row->region)
                ->setTown($row->town)
                ->setApplicationDate($row->applicationDate)
                ->setAcknowledgementDate($row->acknowledgementDate);
        
        return $row->toArray();
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
        $entry = new Applications_Model_Application();
        $entry->setId($row->id)
                ->setPromoter($row->promoter)
                ->setBusinessName($row->businessName)
                ->setBusinessSector($row->businessSector)
                ->setBusinessActivity($row->businessActivity)
                ->setRequestType($row->requestType)
                ->setTelephoneNumber($row->telephoneNumber)
                ->setMobileNumber($row->mobileNumber)
                ->setFaxNumber($row->faxNumber)
                ->setEmailAddress($row->emailAddress)
                ->setPostalAddress($row->postalAddress)
                ->setResidentialAddress($row->residentialAddress)                
                ->setRegion($row->region)
                ->setTown($row->town)
                ->setApplicationDate($row->applicationDate)
                ->setAcknowledgementDate($row->acknowledgementDate);
            $entries[] = $entry;
        }
        return $entries;
    }
    public function fetchOne($id, Applications_Model_Application $application)
    {
        $select = $this->getDbTable()->select()->from(['auction'] , [
                'id',
                'promoter',
                'businessName',
                'businessSector',
                'businessActivity',
                'requestType',
                'telephoneNumber',
                'mobileNumber',
                'faxNumber',
                'emailAddress',
                'postalAddress',
                'residentialAddress',
            
                'region',
                'town',
                'DATE_FORMAT(applicationDate , \'%d/%m/%Y\') as applicationDate',
                'DATE_FORMAT(acknowledgementDate , \'%d/%m/%Y\') as acknowledgementDate',
                    ])->where('id = ?' , $id);
        $result = $select->query()->fetch();
        if (0 == count($result)) {
            return;
        }
        $row = $result;
        $application->setId($row['id'])
                ->setPromoter($row['promoter'])
                ->setBusinessName($row['businessName'])
                ->setBusinessSector($row['businessSector'])
                ->setBusinessActivity($row['businessActivity'])
                ->setRequestType($row['requestType'])
                ->setTelephoneNumber($row['telephoneNumber'])
                ->setMobileNumber($row['mobileNumber'])
                ->setFaxNumber($row['faxNumber'])
                ->setEmailAddress($row['emailAddress'])
                ->setPostalAddress($row['postalAddress'])
                ->setResidentialAddress($row['residentialAddress'])
                
                ->setRegion($row['region'])
                ->setTown($row['town'])
                ->setApplicationDate($row['applicationDate'])
                ->setAcknowledgementDate($row['acknowledgementDate']);
        
        return $row;
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