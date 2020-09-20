<?php

class Login_IndexController extends JBlac_Controller_Action
{

	private $options;
	
	/**
	 * Init
	 * 
	 * @see Zend_Controller_Action::init()
	 */
    public function init()
    {
        $this->_options= $this->getInvokeArg('bootstrap')->getOptions();
        Zend_Layout::getMvcInstance()->setLayout('/login/layout');
        parent::init();
    }

    /**
     * Index
     */
    public function indexAction()
    {
        $flash = $this->_helper->getHelper('flashMessenger');
        if ($flash->hasMessages()) {
            $this->view->message = $flash->getMessages();
        }
        $opt= array (
    			'custom' => array (
    				'timeout' => $this->_options['auth']['timeout']
 				)   	
    	);
        $form = new Login_Form_Login($opt);
        $form->getElement('username')->setAttrib('required', true);
        $form->getElement('password')->setAttrib('required', true);
        $this->view->form = $form;
        
        $this->render('login');
    }
    
    /**
     * Login
     */
    public function loginAction()
    {
    	$opt= array (
    			'custom' => array (
    				'timeout' => $this->_options['auth']['timeout']
 				)   	
    	);
        $form = new Login_Form_Login($opt);
        if (!$form->isValid($this->getRequest()->getPost())) {   
            $this->view->form = $form;
            return $this->render('login');
        }
        $options=array();
        $options['username']= $this->getRequest()->getParam('username');
        $options['password']= $this->getRequest()->getParam('password');
        $options['returnUrl']= $this->getRequest()->getParam('returnUrl');
        $auth= Zend_Auth::getInstance();
        $db = $this->getInvokeArg('bootstrap')->getResource('db');
        $user= new Login_Model_Users($db);
        if ($user->isLdapUser($options['username'])) {
        	$options['ldap']= $this->_options['ldap'];
        	$authAdapter= JBlac_Login_Auth::_getAdapter('ldap', $options);
        } else {
        	$options['db']= $db;
        	$options['salt']= $this->_options['auth']['salt'];
        	$authAdapter= JBlac_Login_Auth::_getAdapter('db', $options);
        }	
    	$result = $auth->authenticate($authAdapter);
        if ($result->isValid()) {
                $userData = $authAdapter->getResultRowObject(NULL , [
                    'password',
                ]);
        	$role_id= $user->getRoleId($options['username']);
                $role = $user->getRoleName($role_id);
        	$data= array(
                        'name' => sprintf('%s %s', $userData->firstname , $userData->lastname),
                        'email' => sprintf('%s', $userData->email),
        		'username' => $options['username'],
        		'id_role'  => $role_id,
                        'role'     => $role,
        	);
        	$auth->getStorage()->write($data);
                $this->_flashMessenger->addMessage(array('message' => 'Authentication success: You have successfully been signed in.', 'status' => 'success'));
                
                    $this->_redirect('/');
        	
        } else {
            $this->_flashMessenger->addMessage(array('message' => 'Authentication error: Invalid username/password combination. Please try again.', 'status' => 'error'));
            $this->_redirect('/login/index');
        }
    }
    
    /**
     * Logout
     */
    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_flashMessenger->addMessage(array('message' => 'Authentication Notice: You have successfully been signed out of the BSSP System.', 'status' => 'success'));
        $this->_redirect('/login');
    }

    public function passAction() {
    	$password=sha1($this->_options['auth']['salt'].'enrico');
    	die($password);
    }
}

