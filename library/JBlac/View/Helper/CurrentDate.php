<?php
/**
 * Description of JBlac_View_Helper_CurrentDate
 *
 * @author Innocent
 * 
 */
class JBlac_View_Helper_CurrentDate {
    //put your code here
    
    public function currentDate(){
      $now = new DateTime();
      return $now->format('d/m/Y');
    }
}