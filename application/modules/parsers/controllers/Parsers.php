<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Parsers extends MX_Controller
{

	private $title = '';
	private $author= '';


    function __construct() {
        parent::__construct();
    }

    function _set_author( $name )
    {
    	$this->author = $name;
    }

    function _get_author()
    {
    	return $this->author;
    }

    function _set_title( $name )
    {
    	$this->title = $name;
    }

    function _get_title()
    {
    	return $this->title;
    }
/*
 * ===============PAGES================= 
 */
    function _parse_pdf2txt_sub( $file )
	{
		//include PDFparser
		require 'vendor/autoload.php';
		$parser = new \Smalot\PdfParser\Parser();
		
		//parse the pdf to text
		$pdf    = $parser->parseFile( $file );
		$text   = $pdf->getText();

		$this->create_text( 'assets/uploads/documents/samplepdf.txt', $text );

	}

	
	function parse_pdf2txt( $file )
	{
		//include PDFparser
		require 'inc/PdfToText.phpclass';

		//parse the pdf to text
		$pdf	=  new PdfToText ( $file ) ;
		$text   = $pdf->Text;
		$filename = $pdf->Title != '' || is_numeric($pdf->Title) ? $pdf->Title : $this->getTitle($file);
		$this->_set_title( $filename );
		$this->_set_author( $pdf->Author );
		
		$this->create_text( 'assets/uploads/documents/samplepdf.txt', $text );

	}

	function parse_doc2txt( $file )
	{
		require("inc/doc2txt.class.php");

		$doc = new Doc2Txt( $file );
		
		$text = $doc->convertToText();
		$filename = $this->getTitle($file);
		$this->_set_title( $filename );
		
		$this->create_text( 'assets/uploads/documents/sampledoc.txt', $text );

	}

	function parse_xls2txt( $file )
	{
		require 'inc/simplexlsx.class.php';
		$xlsx = new SimpleXLSX( $file );
		$filename = $this->getTitle($file);
		$this->_set_title( $filename );
		return serialize( $xlsx->rows());

	}

	function create_text( $filename, $content ) 
	{
		// In our example we're opening $filename in append mode.
		// The file pointer is at the bottom of the file hence
		// that's where $somecontent will go when we fwrite() it.
		$nContent = $this->tm_map( $content );
		$handle = fopen($filename, 'w+');
		// Write $somecontent to our opened file.
		if ( fwrite($handle, $content ) === FALSE) {
			echo "Cannot write to file ($filename)";
			die();
		}
		
		fclose($handle);

	}

	//We clean up the corpus with the tm_map function.
	function tm_map( $text )
	{
		//remove all cappital letters
		$text = strtolower( $text );

		//remove all numbers
		$textonly = preg_replace('/\d/', '', $text );

		//remove punctuations
		$text = preg_replace("/(?![.=$'€%_-])\p{P}/u", " ", $textonly);

		//remove stop words
		$stopWords_dictionary = [" i "," me "," my "," myself "," we "," our "," ours "," ourselves "," you "," your "," and "," to "," the "];
		$text = str_replace( $stopWords_dictionary, ' ', $text);


		return preg_replace('/\s+/', ' ', $text);
	}
	
	function render_pdf( $file )
	{
	    $path = 'assets/uploads/documents/'.$file;
	    if ( !is_file($path) )
	    {
		die( 'File does not exist' );
	    }
	    require('inc/fpdf.php');
	    require('inc/fpdi.php');
	    // initiate FPDI
	    $pdf = new FPDI();
	    
	    
	    //ob_start();
	    $pgNo = $pdf->setSourceFile($path);
	    
	    // import page 1
	    for ( $i = 1; $i < $pgNo; $i++ ):
		    //import pages
		    $tplIdx = $pdf->ImportPage($i);

		    //get template size from documents
		    $s = $pdf->getTemplatesize($tplIdx);

		    //add pages
		    $pdf->AddPage($s['w'] > $s['h'] ? 'L' : 'P', array($s['w'], $s['h']));
		    $pdf->useTemplate($tplIdx);
	    endfor;
	    $pdf->Output();
	    //ob_end_flush();
	}

	function getText( $file )
	{
		$handle = fopen($file, 'r');
		$content = fread( $handle, filesize( $file )  );
		fclose($handle);
		return $content;
	}
	
	function getTitle( $file )
	{
	    $fn = substr($file, strrpos($file,'/')+1, -1 * (strlen($file) - strrpos($file,'.')) );
	    return str_replace(['_','-','+'],' ', $fn);
	}

	function parser_init( $file_path )
	{
		//get the extension of the file
		$ext = substr( $file_path, strrpos($file_path, '.') );

		switch ( $ext )
		{

			case '.pdf':
				$this->parse_pdf2txt( $file_path );
				$data['content'] = $this->getText('assets/uploads/documents/samplepdf.txt');
				$data['title']    = $this->_get_title();
				$cat = $this->categorize_doc($data['content']);
				$data['category'] = Modules::run('category/quick_insert', $cat);
				$data['author']   = $this->_get_author();
				return $data;
				break;

			case '.docx':
			case '.doc':
				$this->parse_doc2txt( $file_path );
				$data['content'] = $this->getText('assets/uploads/documents/sampledoc.txt');
				$cat = $this->categorize_doc($data['content']);
				$data['category'] = Modules::run('category/quick_insert', $cat);
				$data['author']   = $this->_get_author();
				$data['title']    = $this->_get_title();
				return $data;
				break;

			case '.xlsx':
			case '.xls':
				$data['content'] = $this->parse_xlsx2txt( $file_path );
				$cat = $this->categorize_doc($data['content']);
				$data['category'] = Modules::run('category/quick_insert', $cat);
				$data['author']   = $this->_get_author();
				$data['title']    = $this->_get_title();
				return $data;
				break;
			default:
				return $ext;
		}
	}
	
	function categorize_doc( $text)
	{
	    $pattern = '/(vol|volume|vol.) (\d+)(\s)?(\|\s{1,}|,\s{1,})?(issue(\s{1,}(no|number|no.))?)\s{1,}(\d+)/i';
	    if ( preg_match( $pattern, $text, $match ) ) 
	    {
		return 'Journal';
	    } elseif ( preg_match( '/(invoice|receipt)(\s{0,})/i', $text, $rmatch ) 
		    && preg_match( '/(total)(\s{0,})/i', $text ) ) 
	    {
		echo $rmatch[ 0 ];
	    } elseif ( preg_match( '/(career objective(s)?)(\s{0,})/i', $text) 
		    && preg_match( '/(working experience)(\s{0,})/i', $text ) ) {
		return 'Curriculum vitae';
	    }elseif ( preg_match( '/((\s{0,})system flowchart|(\s{0,})flow|(\s{0,})system requirement)(\s{0,})/i', $text) ) {
		return 'project';
	    } elseif ( preg_match( '/(thesis|project|seminar)(\s{0,})/i', $text, $imatch ) ) {
		$pattern = '';
		$dictionary = '';
		echo $imatch[ 0 ];
		if ( trim( $imatch[ 0 ] ) == 'thesis' ) {
		    $dictionary = ['introduction', 'literature review', 'data', 'results', 'references',
			'conclusion|summary|recommendations'];
		    $pattern = '/[0-9.(\s{1,})]?%s(\s{0,})/i';
		} elseif ( trim( $imatch[ 0 ] ) == 'project' ) {
		    $dictionary = ['introduction', 'literature review', '(methodology|system analysis)', '(design|implementation)',
			'conclusion|summary|recommendations'];
		    $pattern = '/%s(\s{0,})\r/';
		} elseif ( trim( $imatch[ 0 ] ) == 'seminar' ) {
		    $dictionary = ['introduction', 'literature review', 'methodology', '(design|implementation)',
			'conclusion|summary|recommendations'];
		    $pattern = '/%s(\s{0,})\r/';
		} else {
		    $dictionary = ['introduction', 'literature review', 'methodology', '(design|implementation)',
			'conclusion|summary|recommendations'];
		    $pattern = '/%s(\s{0,})\r/';
		}


		$total = 0;
		foreach ( $dictionary as $term )
		{
		    if ( in_array( trim( $imatch[ 0 ] ), ['project'] ) ) {
			$npattern = sprintf( $pattern, strtoupper( $term ) );
		    } else {
			$npattern = sprintf( $pattern, $term );
		    }

		    if ( preg_match( $npattern, $text) ) {
			$total += 1;
		    }
		}

		if ( $total >= 2 ) {
		    return $imatch[0];
		}
	    }

	    return 'unknown documents';

	}


	function test()
	{
		$file = 'assets/uploads/documents/Challenges_of_Reporting_Terror_Among_Nigerian_Journalists,_A_Study_of_Daily_Trust_Awo,_Houston_Otumala.docx';
		$content = $this->parser_init($file);
	    echo '<pre>'. print_r( $content, 1) .'</pre>';
	}
}
