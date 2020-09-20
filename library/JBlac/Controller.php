<?php
/**
 * Description of Controller
 *
 * @author Innocent
 */
class JBlac_Controller extends Zend_Controller_Action {
    protected function setNoviewRender(){
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(TRUE);
    }
    protected function disableLayout(){
        $this->_helper->layout->disableLayout();
    }    
}
