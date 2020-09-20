<?php


/**
 * ProfileLink helper
 *
 * Call as $this->profileLink() in your layout script
 */
/**
 * Description of JBlac_View_Helper_ProfileLink
 *
 * @author Innocent
 */
class JBlac_View_Helper_ProfileLink{
   public $view;

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function profileLink()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $userData = $auth->getStorage()->read();

            $fullName =  $userData['name']; 

            return  "<a href='/login/reset-password' class='profile-name text-muted small'>Welcome, $fullName </a> <a href='/login/index/logout' class='access text-muted small'>Logout</a>";
        }else{
            return "Welcome Guest <a href='/' class='access text-muted small'> Login</a>";
        } 

        return FALSE;
    }
}