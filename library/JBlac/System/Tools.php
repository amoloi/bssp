<?php
/**
 * Description of JBlac_System_Tools
 *
 * @author Innocent
 */
class JBlac_System_Tools {
    //put your code here
    
    public static function getLoadTime(){
            $total = 0;
            $loadTimes = sys_getloadavg();
            
            foreach ($loadTimes as $value) {
                $total = $total + $value;
            }
            
            $average =  $total / count($loadTimes);
            return sprintf("%01.2f", $loadTimes[0]);      
    }
    
    public static function getApplicationKey(){
            $tokens = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $segment_chars = 5;
            $num_segments = 4;
            $key_string = '';

            for ($i = 0; $i < $num_segments; $i++) {

                $segment = '';

                for ($j = 0; $j < $segment_chars; $j++) {
                        $segment .= $tokens[rand(0, 35)];
                }

                $key_string .= $segment;

                if ($i < ($num_segments - 1)) {
                        $key_string .= '-';
                }

            }

            return $key_string;        
    }
}