<?php
/**
 * Description of JBlac_Utilities_AgeCalculator
 *
 * @author Innocent
 */
class JBlac_Utilities_Token {
    
    /**
     * 
     * @param type $dateOfBirth
     * @return int - person`s age based on a supplied DOB
     */
    public static function generate($email){        
            $crypt = new Zend_Crypt();
            
            $token = $crypt->hash('sha256', $email . time());            
            return $token;        
    }
    public static function keygen($length=10)
{
	$key = '';
	list($usec, $sec) = explode(' ', microtime());
	mt_srand((float) $sec + ((float) $usec * 100000));
	
   	$inputs = array_merge(range('z','a'),range(0,9),range('A','Z'));

   	for($i=0; $i<$length; $i++)
	{
   	    $key .= $inputs{mt_rand(0,61)};
	}
	return $key;
}    
    function randomToken($len = 64, $output = 5, $standardChars = true, $specialChars = true, $chars = array()) {
        $out = '';
        $len = intval($len);
        $outputMap = array(1 => 2, 2 => 8, 3 => 10, 4=> 16, 5 => 10);
        if (!is_array($chars)) { $chars = array_unique(str_split($chars)); }
        if ($standardChars) { $chars = array_merge($chars, range(48, 57),range(65, 90), range(97, 122)); }
        if ($specialChars) { $chars = array_merge($chars, range(33, 47),range(58, 64), range(91, 96), range(123, 126)); }
        array_walk($chars, function(&$val) { if (!is_int($val)) { $val = ord($val); } });
        if (is_int($len)) {
            while ($len) {
                $tmp = ord(openssl_random_pseudo_bytes(1));
                if (in_array($tmp, $chars)) {
                    if (!$output || !in_array($output, range(1,5)) || $output == 3 || $output == 5) { $out .= ($output == 3) ? $tmp : chr($tmp);  }
                    else { 
                        $based = base_convert($tmp, 10, $outputMap[$output]);
                        $out .= ((($output == 1) ? '00' : (($output == 4) ? '0x' : '')) . (($output == 2) ? sprintf('%03d', $based) : $based)); 
                    }
                    $len--;
                }
            }
        }
        return (empty($out)) ? false : $out;
    }
    
/**
* Generate and return a unique subject identifier
*
* @param       int     $length  Length of string to be generated
* @param       string  $seeds   Generation seed
*/
  public static function generateId($length = 8)
  {
    // Define supported characters in the unique string
    $seeds = 'abcdefghijklmnopqrstuvwqyz0123456789ABCDEFGHIJKLMNOPQRSTUVWQYZ*!@%&(){}[]|#';
    
    // Define supported characters in the unique string
    $seeds = array_merge(range('a', 'z') , range(0, 9) , range('A', 'Z'));
	

    $code = '';

    $count = strlen(join('', $seeds));

    for ($i = 0; $i < $length; $i++)
    {
        $code .= $seeds[mt_rand(0, $count - 1)];
    }
    
    return hash('sha256', $code);
  }
  
  public static function getPassword($password = 'password'){
            $crypt = new Zend_Crypt();
            
            return $crypt->hash('sha256', $password); 
  }
    
}