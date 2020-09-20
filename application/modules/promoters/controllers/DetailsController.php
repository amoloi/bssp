<?php

class Promoters_DetailsController extends JBlac_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
    }


    public function indexAction()
    {
        
        $this->view->title = '';
        $applicationNumber = $this->_request->getParam('an', 0);        
        
        $application = new Applications_Model_BsspApplication();
        $applicationMapper = new Applications_Model_BsspApplicationMapper('Applications_Model_DbTable_BsspApplication');
        
        $address = new JBlac_Models_Address();        
        $addressMapper = new JBlac_Models_AddressMapper('JBlac_Models_DbTable_Address');

        $contact = new Contacts_Model_Contact();
        $contactMapper = new Contacts_Model_ContactMapper('Contacts_Model_DbTable_Contact');
        
        
        $contactMapper = new Contacts_Model_ContactMapper('Contacts_Model_DbTable_Contact');
        
        /*
         * Fetching Data
         */
        $ApplicationData = $applicationMapper->fetchOneByApplicationNumber($applicationNumber);
        $this->view->application = $ApplicationData;

        
        $RequestData = $applicationMapper->searchApplicationRequestByApplicationNumber($applicationNumber);
        $this->view->requests = $RequestData;

        
        $AddressData = $addressMapper->searchAaddressByLegalIdentityId($ApplicationData['applicationLegalEntityId']);
        $this->view->address = $AddressData;

              
        if('company' === $ApplicationData['entityType']){
            $ContactData = $contactMapper->searchContactByLegalIdentityId($ApplicationData['applicationLegalEntityId']);

        }else{
            $ContactData = [];
        }
        $this->view->contact = $ContactData;
    }
}



