<?php
/**
 * Description of JBlac_Controller_Action_Helper_PayPrint
 *
 * @author Innocent
 */
class Zend_Controller_Action_Helper_GenerateSalt extends Zend_Controller_Action_Helper_Abstract{
    //put your code here
    public function direct($length = 8){
    // Define supported characters in the unique string
        $seeds = 'abcdefghijklmnopqrstuvwqyz0123456789@#$%^&*()_-+=\ABCDEFGHIJKLMNOPQ<>?/|';

        $code = '';

        $count = strlen($seeds);

        for ($i = 0; $i < $length; $i++)
        {
            $code .= $seeds[mt_rand(0, $count - 1)];
        }
        return $code;
        }
}