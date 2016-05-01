<?php

/**
* @package EZ Realty
* @version 7.2.0
* @author  Kathy Strickland (aka PixelBunyiP) - Raptor Services <kathy@raptorservices.com>
* @link    http://www.raptorservices.com
* @copyright Copyright (C) 2006 - 2014 Raptor Developments Pty Ltd T/as Raptor Services-All rights reserved
* @license Creative Commons GNU GPL, see http://creativecommons.org/licenses/GPL/2.0/ for full license.
**/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 *
 * @package	EZ Realty
 */
class EzrealtysViewSuburb extends JViewLegacy
{
	function display( $tpl = null )
	{

		$app		= JFactory::getApplication();
		$params 	= &$app->getParams('com_ezrealty');

		// Check if the print results feature is available

		if ( !$params->get('show_print_results') ){
			echo JText::_('EZREALTY_FEATURE_NOT_AVAILABLE');
			return;
		}

		$dispatcher	=& JDispatcher::getInstance();
		$document	= & JFactory::getDocument();
		$model		= &$this->getModel();


		// Get data from the model
		$items		= & $this->get( 'Data');

		$this->assignRef('items',		$items);

		define("PRINTPAGE_PATH",JPATH_SITE. "/components/com_ezrealty/views/suburb/tmpl/" );

		require_once(JPATH_SITE . '/components/com_ezrealty/assets/tcpdf/tcpdf.php');
		require_once(JPATH_SITE . '/components/com_ezrealty/assets/tcpdf/pdf.helper.php');

		// create new PDF document
		$pdf = new LISTPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		
		$pdf->SetAuthor('Site Name');
		
		$pdf->SetTitle( JText::_( 'EZREALTY_PDF_TITLE' ) );
		$pdf->SetSubject( JText::_( 'EZREALTY_PDF_SUBJECT' ) );
		$pdf->SetKeywords( JText::_( 'EZREALTY_PDF_KEYWORDS' ) );
		
		
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(0);
		$pdf->SetFooterMargin(0);
		
		// remove default footer
		$pdf->setPrintFooter(false);
		
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		


// ------------------Add the details page---------------------------------------


// add a page
$pdf->AddPage();

ob_start();

if (file_exists(PRINTPAGE_PATH.'default_print.php')) {
	include(PRINTPAGE_PATH.'default_print.php');
}

$html = ob_get_clean();

// Print a text
$pdf->writeHTML($html, true, false, true, false, '');


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.

	
$alias = JApplication::stringURLSafe( JText::_( 'EZREALTY_PDF_TITLE' ) );
	

$pdf->Output("{$alias}.pdf", 'I');		
die();
//echo $html;




	}
}

?>