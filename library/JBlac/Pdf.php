<?php
/**
 * Description of JBlac_Pdf
 *
 * @author Innocent
 */
/**
 * Load the TCPDF library
 */
Zend_Loader::loadFile('tcpdf.php', '../library/JBlac/TCPDF', TRUE);
class JBlac_Pdf extends TCPDF{
    /**
     * This is the class constructor.
     *
     * It allows to set up the page format, the orientation and the measure unit used in all the methods (except for the font sizes).
     *
     * @param string $orientation page orientation. Possible values are (case insensitive):&lt;ul&gt;&lt;li&gt;P or Portrait (default)&lt;/li&gt;&lt;li&gt;L or Landscape&lt;/li&gt;&lt;/ul&gt;
     * @param string $unit User measure unit. Possible values are:&lt;ul&gt;&lt;li&gt;pt: point&lt;/li&gt;&lt;li&gt;mm: millimeter (default)&lt;/li&gt;&lt;li&gt;cm: centimeter&lt;/li&gt;&lt;li&gt;in: inch&lt;/li&gt;&lt;/ul&gt;&lt;br /&gt;A point equals 1/72 of inch, that is to say about 0.35 mm (an inch being 2.54 cm). This is a very common unit in typography; font sizes are expressed in that unit.
     * @param mixed $format The format used for pages. It can be either one of the following values (case insensitive) or a custom format in the form of a two-element array containing the width and the height (expressed in the unit given by unit).&lt;ul&gt;&lt;li&gt;4A0&lt;/li&gt;&lt;li&gt;2A0&lt;/li&gt;&lt;li&gt;A0&lt;/li&gt;&lt;li&gt;A1&lt;/li&gt;&lt;li&gt;A2&lt;/li&gt;&lt;li&gt;A3&lt;/li&gt;&lt;li&gt;A4 (default)&lt;/li&gt;&lt;li&gt;A5&lt;/li&gt;&lt;li&gt;A6&lt;/li&gt;&lt;li&gt;A7&lt;/li&gt;&lt;li&gt;A8&lt;/li&gt;&lt;li&gt;A9&lt;/li&gt;&lt;li&gt;A10&lt;/li&gt;&lt;li&gt;B0&lt;/li&gt;&lt;li&gt;B1&lt;/li&gt;&lt;li&gt;B2&lt;/li&gt;&lt;li&gt;B3&lt;/li&gt;&lt;li&gt;B4&lt;/li&gt;&lt;li&gt;B5&lt;/li&gt;&lt;li&gt;B6&lt;/li&gt;&lt;li&gt;B7&lt;/li&gt;&lt;li&gt;B8&lt;/li&gt;&lt;li&gt;B9&lt;/li&gt;&lt;li&gt;B10&lt;/li&gt;&lt;li&gt;C0&lt;/li&gt;&lt;li&gt;C1&lt;/li&gt;&lt;li&gt;C2&lt;/li&gt;&lt;li&gt;C3&lt;/li&gt;&lt;li&gt;C4&lt;/li&gt;&lt;li&gt;C5&lt;/li&gt;&lt;li&gt;C6&lt;/li&gt;&lt;li&gt;C7&lt;/li&gt;&lt;li&gt;C8&lt;/li&gt;&lt;li&gt;C9&lt;/li&gt;&lt;li&gt;C10&lt;/li&gt;&lt;li&gt;RA0&lt;/li&gt;&lt;li&gt;RA1&lt;/li&gt;&lt;li&gt;RA2&lt;/li&gt;&lt;li&gt;RA3&lt;/li&gt;&lt;li&gt;RA4&lt;/li&gt;&lt;li&gt;SRA0&lt;/li&gt;&lt;li&gt;SRA1&lt;/li&gt;&lt;li&gt;SRA2&lt;/li&gt;&lt;li&gt;SRA3&lt;/li&gt;&lt;li&gt;SRA4&lt;/li&gt;&lt;li&gt;LETTER&lt;/li&gt;&lt;li&gt;LEGAL&lt;/li&gt;&lt;li&gt;EXECUTIVE&lt;/li&gt;&lt;li&gt;FOLIO&lt;/li&gt;&lt;/ul&gt;
     * @param boolean $unicode TRUE means that the input text is unicode (default = true)
     * @param String $encoding charset encoding; default is UTF-8
     */
    public function __construct( $orientation = 'P' , $unit = 'mm' , $format = 'A4' , $unicode = true , $encoding = 'UTF-8' )
    {
        parent::__construct( $orientation, $unit, $format, $unicode, $encoding );
    }
//Page header
	public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.'coart_of_arms.png';
		$this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B', 20);
		// Title
		$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}    
    
    /**
     *
     * @return float
     */
    public function getPageWidth()
    {
        return $this->w - $this->rMargin - $this->x;
    }    
 
}