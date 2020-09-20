<?php
/**
 * Description of JBlac_Controller_Action_Helper_Messenger
 *
 * @author Innocent
 */
class Zend_Controller_Action_Helper_Messenger extends Zend_Controller_Action_Helper_Abstract {
    
    protected $_flashMessenger = null;
 
    public function messenger($name='error', $message=null)
    {
        if ($name == 'error' && $message === null) {
            return $this;
        }
        if (!isset($this->_flashMessenger[$name])) {
            $this->_flashMessenger[$name] = $this->getActionController()
                                                 ->getHelper('FlashMessenger')
                                                 ->setNamespace($name.'_message');
        }
        if ($message !== null) {
            $message = $this->getActionController()->view->translate($message);
            $this->_flashMessenger[$name]->addMessage($message);
        }
        return $this->_flashMessenger[$name];
    }
 
    public function direct($name='error', $message=null)
    {
        return $this->messenger($name,$message);
    }
}