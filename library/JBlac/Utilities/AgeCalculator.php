<?php
/**
 * Description of JBlac_Utilities_AgeCalculator
 *
 * @author Innocent
 */
class JBlac_Utilities_AgeCalculator {
    
    /**
     * 
     * @param type $dateOfBirth
     * @return int - person`s age based on a supplied DOB
     */
    public static function getAge($dateOfBirth){
        
        return floor((time() - strtotime($dateOfBirth))/31556926);
        
    }
}
