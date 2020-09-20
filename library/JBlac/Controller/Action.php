<?php
/**
 * Description of JBlac_Controller_Action
 *
 * @author Innocent
 */
class JBlac_Controller_Action extends Zend_Controller_Action {
    const STATUS_OK = 200;
    const STATUS_CREATED = 201;
    const STATUS_UNPROCESSABLE_ENTITY = 422;
    const STATUS_FORBIDDEN = 403;
    const STATUS_NOT_FOUND = 404;
    const STATUS_GONE = 410;
    const STATUS_INTERNAL_SERVER_ERROR = 500;

    //Is it still used ??
    const REG_KEY_CONTEXT = 'bssp_request_context';
    const REQ_CONTEXT_BACK = 'backoffice';
    const REQ_CONTEXT_FRONT = 'frontoffice';

    protected static $_cache = null;
    public function init() {
        // Enable the flash messenger helper so we can send messages.
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');        
        parent::init();
    }

    /**
     *
     * @return Zend_Auth
     */
    public function getUser()
    {
        return Zend_Auth::getInstance();
    }

    /**
     *
     * @return Zend_Cache_Core
     */
    protected function _getCache()
    {
        if (null === self::$_cache) {
            self::$_cache = $this->getInvokeArg('bootstrap')->getResource('cachemanager')->getCache('core');
        }

        return self::$_cache;
    }

    /**
     * Forwards current action to the default 404 error action.
     *
     * @param string $message Message of the generated exception
     * @throws Zend_Controller_Action_Exception
     */
    public function forward404($message = null)
    {
        throw new Zend_Controller_Action_Exception($this->_get404Message($message), 404);
    }

    /**
     * Forwards current action to the default 404 error action unless the specified condition is true.
     *
     * @param bool   $condition A condition that evaluates to true or false
     * @param string $message   Message of the generated exception
     * @throws Zend_Controller_Action_Exception
     */
    public function forward404Unless($condition, $message = null)
    {
        if (!$condition) {
            $this->forward404($message);
        }
    }

    /**
     * Forwards current action to the default 404 error action if the specified condition is true.
     *
     * @param bool   $condition A condition that evaluates to true or false
     * @param string $message   Message of the generated exception
     *
     * @throws Zend_Controller_Action_Exception
     */
    public function forward404If($condition, $message = null)
    {
        if ($condition) {
            $this->forward404($message);
        }
    }

    /**
     * Redirects current request to a new URL, only if specified condition is true.
     *
     * This method stops the action. So, no code is executed after a call to this method.
     *
     * @param bool   $condition  A condition that evaluates to true or false
     * @param string $url        Url
     * @param string $statusCode Status code (default to 302)
     */
    public function redirectIf($condition, $url)
    {
        if ($condition) {
            $this->_redirect($url);
        }
    }

    /**
     * Redirects current request to a new URL, unless specified condition is true.
     *
     * This method stops the action. So, no code is executed after a call to this method.
     *
     * @param bool   $condition  A condition that evaluates to true or false
     * @param string $url        Url
     * @param string $statusCode Status code (default to 302)
     */
    public function redirectUnless($condition, $url)
    {
        if (!$condition) {
            $this->_redirect($url);
        }
    }

    /**
     * Render a View script to response with given parameters.
     *
     * @param string $viewScript View script
     * @param string $kwargs Parameters to assign
     * @return Centurion_Controller_Action
     */
    public function renderToResponse($viewScript, $kwargs)
    {
        $this->getHelper('viewRenderer')->setNoRender(true);
        $this->getResponse()->appendBody($this->renderToString($viewScript, $kwargs));

        return $this;
    }

    /**
     * @todo use renderToResponse instead
     */
    public function renderIfNotExists($action = null, $name = null, $noController = false)
    {
        $dirs = $this->view->getScriptPaths();
        $renderScript = false;
        $viewFile = $this->getRequest()->getControllerName()
                  . DIRECTORY_SEPARATOR
                  . $this->getRequest()->getActionName()
                  . '.' . $this->viewSuffix;
        foreach ($dirs as $dir) {
            if (is_readable($dir . $viewFile)) {
                $renderScript = true;
                break;
            }
        }

        if (!$renderScript) {
            $this->_helper->viewRenderer->setNoRender(true);
            $this->render($action, $name, $noController);
        }
    }

    /**
     * Render a View script to string with given parameters.
     *
     * @param string $viewScript View script
     * @param string $kwargs Parameters to assign
     */
    public function renderToString($viewScript, $kwargs)
    {
        return $this->view->renderToString($viewScript, $kwargs);
    }

    /**
     * @param null $message
     * @return null|string
     * @todo documentation
     */
    protected function _get404Message($message = null)
    {
        return null === $message
               ? sprintf('This request has been forwarded to a 404 error page by the action "%s/%s".',
                         $this->getRequest()->getModuleName(),
                         $this->getRequest()->getActionName())
               : $message;
    }
    
    protected function setNoviewRender(){
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(TRUE);
    }
    protected function disableLayout(){
        $this->_helper->layout->disableLayout();
    }
    
    protected function startTransaction(){
        Zend_Db_Table::getDefaultAdapter()->beginTransaction();
    }
    
    protected function endTransaction(){
        Zend_Db_Table::getDefaultAdapter()->commit();
    }
    
    protected function cancelTransaction(){
        Zend_Db_Table::getDefaultAdapter()->rollBack();
    }    
}
