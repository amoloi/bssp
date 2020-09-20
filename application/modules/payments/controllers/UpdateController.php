<?php

class Payments_UpdateController extends JBlac_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
    }

    public function indexAction()
    {
        //exit('creating');
        $this->view->title = 'New application';
        $id = $this->_request->getParam('id', false);
        if($id === false){
            $this->_helper->redirector->gotoSimple('parameters-missing' , 'error' , 'default');
        }        
        $form = new JBlac_Forms_Bssp_Funds();
        $form->setAction('/funds/update/index');
        
        $obj = new Funds_Model_Fund();
        
        $objMapper = new Funds_Model_FundMapper('Funds_Model_DbTable_Funds');
        $objData = $objMapper->fetchOne($id, $obj);

        if($this->getRequest()->isPost()){
            if(null !== $this->getRequest()->getPost('id')){
                $name = $form->getElement('name');
                $name->addValidator('Db_NoRecordExists',
                                 false,
                                 array('table'    => 'funds',
                                         'field'     => 'name',
                                         'exclude' => array ('field' => 'id',
                                                                    'value' => $this->getRequest()->getPost('id'))));
            }
            if($form->isValid($this->getRequest()->getPost())){
                $obj->setName($this->getRequest()->getPost('name'))
                          ->setInitialAmount($this->getRequest()->getPost('initialAmount'))
                          ->setOutstandingAmount($this->getRequest()->getPost('outstandingAmount'))
                          ->setDateOfApproval($this->getRequest()->getPost('dateOfApproval'))
                          ->setRemarks($this->getRequest()->getPost('remarks'))
                          ->setId($this->getRequest()->getPost('id'))
                          ->setCreatedBy('SYSTEM');               
                try{                    
                    $entityId = $objMapper->save($obj);                     
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
                $this->_redirect('/funds/');
            }else{
                $form->populate($this->getRequest()->getPost());
                Zend_Debug::dump($form->getCustomMessages());
                $this->view->form = $form;
                return;
            }
        }else{
            $form->populate($objData);
            $this->view->form = $form;                      
        }
    }
    public function updateAction()
    {
        //exit('creating');
        $this->view->title = 'New application';
        $id = $this->_request->getParam('id', false);
        if($id === false){
            $this->_helper->redirector->gotoSimple('parameters-missing' , 'error' , 'default');
        }        
        $form = new JBlac_Forms_Bssp_Promoter();
        $form->setAction('/promoters/update/update');
        
        $promoter = new Promoters_Model_Promoter();
        $address = new Promoters_Model_Address();
        
        $promoterMapper = new Promoters_Model_PromoterMapper('Promoters_Model_DbTable_Promoter');
        
        $promoterData = $promoterMapper->fetchDataSet($id, $promoter , $address);

        
        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $objEntityMapper = new Promoters_Model_PromoterMapper('Promoters_Model_DbTable_Promoter');
                $promoter->setId($this->getRequest()->getPost('promoterId'))
                        ->setEmailAddress($this->getRequest()->getPost('emailAddress'))
                          ->setTelephoneNumber($this->getRequest()->getPost('telephoneNumber'))
                          ->setMobileNumber($this->getRequest()->getPost('mobileNumber'))
                          ->setFaxNumber($this->getRequest()->getPost('faxNumber'))
                          ->setRemarks($this->getRequest()->getPost('remarks'))
                          ->setPromoterType($this->getRequest()->getPost('promoterType'))
                          ->setCreatedBy('SYSTEM');
                
                  switch ($this->getRequest()->getPost('promoterType')) {
                      case 'individual':
                          $promoter->setFirstName($this->getRequest()->getPost('firstName'))
                                    ->setLastName($this->getRequest()->getPost('lastName'))
                                    ->setIdentityNumber($this->getRequest()->getPost('identityNumber'));
                          break;
                      case 'company':
                          $promoter->setCompanyName($this->getRequest()->getPost('companyName'))
                                    ->setCompanyRegistrationNumber($this->getRequest()->getPost('companyRegistrationNumber'));
                          break;
                      default:
                          break;
                  }
                
                try{
                    $promoterId = $objEntityMapper->save($promoter);
                    
                    $addressObj = new Promoters_Model_Address();
                    $addressObjMapper = new Promoters_Model_AddressMapper('Promoters_Model_DbTable_Address');
                    
                    $addressObj->setId($this->getRequest()->getPost('addressId'))
                                ->setAddressLineOne($this->getRequest()->getPost('addressLineOne'))
                              ->setAddressLineTwo($this->getRequest()->getPost('addressLineTwo'))
                              ->setPostalAddress($this->getRequest()->getPost('postalAddress'))
                              ->setRegionCode($this->getRequest()->getPost('regionCode'))
                              ->setCityCode($this->getRequest()->getPost('cityCode'))
                              ->setCountryCode($this->getRequest()->getPost('countryCode'))
                              ->setPromoterId($promoterId);                    
                    $addressId = $addressObjMapper->save($addressObj);
                    
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
                $this->_redirect('/promoters/');
            }else{
                $this->view->form = $form;
                return;
            }
        }else{
        $form->populate($promoterData);
        $this->view->form = $form;                      
        }
    }    
}