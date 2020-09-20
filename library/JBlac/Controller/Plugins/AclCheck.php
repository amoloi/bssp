<?php
/**
 * Description of JBlac_Controller_Plugin_AclCheck
 *
 * @author Innocent J Blac
 */
class JBlac_Controller_Plugins_AclCheck extends Zend_Controller_Plugin_Abstract{
protected $_defaultRole = 'guest';
protected $_auth = null;
protected $_acl = null;


    public function __construct(Zend_Auth $auth , Zend_Acl $acl) {
        $this->_auth = $auth;
        $this->_acl = $acl;
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {

        $BSSPSession = new Zend_Session_Namespace('BSSP');
        
        if($this->_auth->hasIdentity()) {
            $user = $this->_auth->getIdentity();          
            
            if(!$this->_acl->isAllowed($user['role'],$request->getModuleName() . '::' . $request->getControllerName() , $request->getActionName())) {
                $BSSPSession->destination_url = $request->getPathInfo();
                $request->setModuleName('default');
                $request->setControllerName('error');
                $request->setActionName('access-denied'); 
            }
        } else {
            if(!$this->_acl->isAllowed($this->_defaultRole,$request->getModuleName() . '::' . $request->getControllerName() , $request->getActionName())) {
                $BSSPSession->destination_url = $request->getPathInfo();

                $request->setModuleName('login');
                $request->setControllerName('index');
                $request->setActionName('index'); 
                
            }
        }
    }
}