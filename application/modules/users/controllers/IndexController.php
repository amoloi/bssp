<?php

class Users_IndexController extends JBlac_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
        
    }


    public function indexAction()
    {
        $this->view->title = 'Funds List';
        $page = $this->_getParam('page', 1);
        $objMapper = new Users_Model_UserMapper('Users_Model_DbTable_User');
        
        $this->view->paginator = $objMapper->fetchPage($page);
    }       

}