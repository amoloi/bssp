<?php

class Applications_PromoterController extends JBlac_Controller_Action
{

    public function indexAction()
    {
        $this->getResponse()->setHttpResponseCode(403);
        $this->view->title = 'Applications List';
        $page = $this->_getParam('page', 1);
        $auctionMapper = new Auction_Model_AuctionMapper('Auction_Model_DbTable_Auction');
        $this->view->paginator = $auctionMapper->fetchPage($page);
    }
    public function createAction()
    {
        $this->view->title = 'Auction Manager :: Auctions List';
        $form = new JBlac_Forms_Auction_Registration();
        $form->removeElement('id');
        $this->view->form = $form;
        $auction = new Auction_Model_Auction();
        
        if($this->getRequest()->isPost()){

            if($form->isValid($this->getRequest()->getPost())){
                $auctionMapper = new Auction_Model_AuctionMapper('Auction_Model_DbTable_Auction');
                $auction->setCode($this->getRequest()->getPost('code'))
                        ->setTitle($this->getRequest()->getPost('title'))
                        ->setDescription($this->getRequest()->getPost('description'))
                        ->setDate($this->getRequest()->getPost('date'))
                        ->setTime($this->getRequest()->getPost('time'))
                        ->setCreatedBy('SYSTEM');                
                try{
                    $auctionMapper->save($auction);
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    exit;
                }
                $this->_redirect('/auction/auctions/');
            }else{
                $this->view->form = $form;
                return;
            }
        }else{            
         //$this->view->form = $form;   
        }
    }
    public function updateAction()
    {
        $this->view->title = 'Auction Manager :: Auction Editing';
        $form = new JBlac_Forms_Auction_Registration();

        $auction = new Auction_Model_Auction();
        $id = $this->_getParam('id');
        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $auctionMapper = new Auction_Model_AuctionMapper('Auction_Model_DbTable_Auction');
                $auction->setId($this->getRequest()->getPost('id'))
                        ->setCode($this->getRequest()->getPost('code'))
                        ->setTitle($this->getRequest()->getPost('title'))
                        ->setDescription($this->getRequest()->getPost('description'))
                        ->setDate($this->getRequest()->getPost('date'))
                        ->setTime($this->getRequest()->getPost('time'))
                        ->setModifiedBy('SYSTEM');               
                try{
                    $auctionMapper->save($auction);
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    exit();
                }
                $this->_redirect('/auction/auctions/');
            }else{
                $this->view->form = $form;
                return;
            }
        }else{
            
            $auctionMapper = new Auction_Model_AuctionMapper('Auction_Model_DbTable_Auction');
            $data = $auctionMapper->fetchOne($id , $auction);
            
            $form->populate((array)$data);
            $this->view->form = $form;
        }
    }

    public function saveAction()
    {
        // action body
    }

    public function deleteAction()
    {
           $id = $this->getRequest()->getParam('id');
        $objEntity = new Auction_Model_Auction();
        $objEntityMapper = new Auction_Model_AuctionMapper('Auction_Model_DbTable_Auction');
        
        try {
            $objEntityMapper->delete($id);
        } catch (Zend_Db_Table_Row_Exception $e) {
            echo $e->getMessage();
        }
        
        $this->_redirect('/auction/auctions/');
    }

}









