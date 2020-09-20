<?php
/**
 * Description of JBlac_APIKey
 *
 * @author Innocent
 */
class JBlac_APIKey {
    
    protected $apiKey = null;
    private $randomValue = null;

public function __construct(array $options) {
    $this->genKey($options['length']);
}

private  function genKey($length) {
  if($length > 0) { 
	  $apiKey="";
		for($i=1; $i <= $length; $i++) {
		 mt_srand((double)microtime() * 1000000);
                 $this->setRandomValue(mt_rand(1,72));
		 $apiKey .= $this->getRandomValue();
		}
  }
  $this->setApiKey($apiKey);
}
public function getApiKey() {
    return $this->apiKey;
}

public function getRandomValue() {
    return $this->randomValue;
}

public function setApiKey($apiKey) {
    $this->apiKey = $apiKey;
    return $this;
}

public function setRandomValue($Value) {
        
  switch($Value) {
    case "1":
     $randomValue = "a";
    break;
    case "2":
     $randomValue = "b";
    break;
    case "3":
     $randomValue = "c";
    break;
    case "4":
     $randomValue = "d";
    break;
    case "5":
     $randomValue = "e";
    break;
    case "6":
     $randomValue = "f";
    break;
    case "7":
     $randomValue = "g";
    break;
    case "8":
     $randomValue = "h";
    break;
    case "9":
     $randomValue = "i";
    break;
    case "10":
     $randomValue = "j";
    break;
    case "11":
     $randomValue = "k";
    break;
    case "12":
     $randomValue = "l";
    break;
    case "13":
     $randomValue = "m";
    break;
    case "14":
     $randomValue = "n";
    break;
    case "15":
     $randomValue = "o";
    break;
    case "16":
     $randomValue = "p";
    break;
    case "17":
     $randomValue = "q";
    break;
    case "18":
     $randomValue = "r";
    break;
    case "19":
     $randomValue = "s";
    break;
    case "20":
     $randomValue = "t";
    break;
    case "21":
     $randomValue = "u";
    break;
    case "22":
     $randomValue = "v";
    break;
    case "23":
     $randomValue = "w";
    break;
    case "24":
     $randomValue = "x";
    break;
    case "25":
     $randomValue = "y";
    break;
    case "26":
     $randomValue = "z";
    break;
    case "27":
     $randomValue = "0";
    break;
    case "28":
     $randomValue = "1";
    break;
    case "29":
     $randomValue = "2";
    break;
    case "30":
     $randomValue = "3";
    break;
    case "31":
     $randomValue = "4";
    break;
    case "32":
     $randomValue = "5";
    break;
    case "33":
     $randomValue = "6";
    break;
    case "34":
     $randomValue = "7";
    break;
    case "35":
     $randomValue = "8";
    break;
    case "36":
     $randomValue = "9";
    break;
    case "37":
     $randomValue = "*";
    break;
    case "38":
     $randomValue = "~";
    break;
    case "39":
     $randomValue = "-";
    break;
    case "40":
     $randomValue = "|";
    break;
    case "41":
     $randomValue = "^";
    break;
    case "42":
     $randomValue = "%";
    break;
    case "43":
     $randomValue = " ";
    break;
    case "44":
     $randomValue = "_";
    break;
    case "45":
     $randomValue = "+";
    break;
    case "46":
     $randomValue = "=";
    break;
    case "47":
     $randomValue = "A";
    break;
    case "48":
     $randomValue = "B";
    break;
    case "49":
     $randomValue = "C";
    break;
    case "50":
     $randomValue = "D";
    break;
    case "51":
     $randomValue = "E";
    break;
    case "52":
     $randomValue = "F";
    break;
    case "53":
     $randomValue = "G";
    break;
    case "54":
     $randomValue = "H";
    break;
    case "55":
     $randomValue = "I";
    break;
    case "56":
     $randomValue = "J";
    break;
    case "57":
     $randomValue = "K";
    break;
    case "58":
     $randomValue = "L";
    break;
    case "59":
     $randomValue = "M";
    break;
    case "60":
     $randomValue = "N";
    break;
    case "61":
     $randomValue = "O";
    break;
    case "62":
     $randomValue = "P";
    break;
    case "63":
     $randomValue = "Q";
    break;
    case "64":
     $randomValue = "R";
    break;
    case "65":
     $randomValue = "S";
    break;
    case "66":
     $randomValue = "T";
    break;
    case "67":
     $randomValue = "U";
    break;
    case "68":
     $randomValue = "V";
    break;
    case "69":
     $randomValue = "W";
    break;
    case "70":
     $randomValue = "X";
    break;
    case "71":
     $randomValue = "Y";
    break;
    case "72":
     $randomValue = "Z";
    break;
  }
 
  $this->randomValue = $randomValue;    
  
  return $this;
}
}