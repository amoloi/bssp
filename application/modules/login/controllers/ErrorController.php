<?php

class Login_ErrorController extends JBlac_Controller_Action
{
    public function init()
    {
        $this->_options= $this->getInvokeArg('bootstrap')->getOptions();
        Zend_Layout::getMvcInstance()->setLayout('/login/layout');
    }

    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        
        if (!$errors) {
            $this->view->message = 'You have reached the error page';
            return;
        }
        
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
        
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->message = 'Page not found';
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $this->view->message = 'Application error';
                break;
        }
        
        // Log exception, if logger available
        if ($log = $this->getLog()) {
            $log->crit($this->view->message, $errors->exception);
        }
        
        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }
        
        $this->view->request   = $errors->request;
    }

    public function getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }
    
    public function authenticationRequiredAction(){
        //$this->setNoviewRender();
        //exit('You must be loodeg in to use this facility.');
        $flash = $this->_helper->getHelper('flashMessenger');
        if ($flash->hasMessages()) {
            $this->view->message = $flash->getMessages();
        }
        $opt= array (
    			'custom' => array (
    				'timeout' => $this->_options['auth']['timeout']
 				)   	
    	);
        $this->view->form = new Login_Form_Login($opt);        
    }


}