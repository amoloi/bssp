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
class JBlac_ListPdf extends TCPDF{
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
    public function __construct($data , $orientation = 'P' , $unit = 'pt' , $format = 'A4' , $unicode = true , $encoding = 'UTF-8' )
    {
        parent::__construct( $orientation, $unit, $format, $unicode, $encoding );
        
        $this->listData = $data;
        $this->SetMargins(72, 36, 72, TRUE);
        $this->SetAutoPageBreak(TRUE, 36);
        
        /**
         * Setting document meta information
         */
        
        $this->SetCreator('PDF_CREATOR');
        $this->SetAuthor('Innocent J. Blac (innocent.blacius@gmail.com)');
        $this->SetTitle('Search List - Deeds Kiosk');
        $this->SetSubject('Search Item List for Deeds Data Kiosk');
        $this->SetKeywords('Deeds' , 'Members','Natau','Report' , 'PDF');
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
    }
//Page header
	public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.'coart_of_arms.png';
		
            
                $largeFont = 14;
            
                $imageScale = (128.0 / 26.0) * $largeFont;
                $smallFont = (16.0 / 26.0) * $largeFont;
                $this->Image($image_file, 64, 15, 72, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                //$this->Cell(0 , 0 , '' , 0 , 1);
                $this->SetFont('helvetica', 'B', $largeFont);
                $this->Cell(0, 0, 'Namibia Transport and Allied Worker`s Union', 0, false, 'L', 0, '', 0, false, 'M', 'M');
                $this->SetFont('helvetica', '', $smallFont);
                $this->Cell($imageScale);
                $this->Cell(0 , 0 , '' , 0 , 1);
                $this->Cell($imageScale);
                
                $this->Cell(0, 15, 'P.O. Box 7516', 0, 1);
                $this->Cell($imageScale);
                $this->Cell(0, 0 , 'Windhoek, Namibia,', 0, 1);
                $this->Cell($imageScale);
                $this->Cell(0, 0, 'Erf No: 8506 Mungunda Street, Katutura,', 0, 1);
                $this->Cell($imageScale);
                $this->Cell(0, 0, 'Tel: +264-61-217244', 0, 1);
                $this->Cell($imageScale);
                $this->Cell(0, 0, 'Fax: +264-61-263767', 0, 1);
                $this->Cell($imageScale);
                $this->Cell(0, 0, 'E-mail: natau@mweb.com.na', 0, 1);                
                global $webcolor;
                $this->SetY(1.5 * 72 , TRUE);
                $this->SetLineStyle(['width' => 2 ,
                                     'color' => [$webcolor['black']]]);
                                 $this->Line(72 , 36 + $imageScale , $this->getPageWidth() + 72, 36 + $imageScale);
	}
        
        public function createReport(){
            $this->AddPage();
            $this->SetFont(Zend_Pdf_Font::FONT_HELVETICA , '' , 11);
            $this->SetY(116 , TRUE);
            
        # Table parameters
            # Column size, wide (description) column, table indent, row height.
            $col = 72;
            $wideCol = 3 * $col;
            $indent = ( $this->getPageWidth() - 2 * 72 - $wideCol - 3 * $col ) / 2;
            $line = 18;
            # Table header
            $this->SetFont( '', 'b' );
            $this->Cell( $indent , $line , 'NATAU MEMBERS LIST' , 0, 1,'C' );
            $this->Cell( $indent , '' , '' , 0, 1,'C' );
            $this->Cell( $wideCol, $line, 'Item', 1, 0, 'L' );
            $this->Cell( $col, $line, 'Quantity', 1, 0, 'R' );
            $this->Cell( $col, $line, 'Price', 1, 0, 'R' );
            $this->Cell( '', $line, 'Cost', 1, 0, 'R' );
            $this->Ln();
            # Table content rows
            //$this->SetFont( '', '' );
//            foreach( $this->invoiceData['items'] as $item ) {  
//            $this->Cell( $indent );
//            $this->Cell( $wideCol, $line, $item[0], 1, 0, 'L' );
//            $this->Cell( $col, $line, $item[1], 1, 0, 'R' );
//            $this->Cell( $col, $line, $item[2], 1, 0, 'R' );
//            $this->Cell( $col, $line, $item[3], 1, 0, 'R' );
//            $this->Ln();
//            }    
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