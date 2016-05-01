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
 * HTML My Realty View class for the Content component
 *
 * @package	My Realty
 */
class EzrealtysViewEzrealty extends JViewLegacy
{
	function display($tpl = null)
	{

		$app		= JFactory::getApplication();

        $user =& JFactory::getUser();
	    $max_id = 1;;
	    foreach ($user->groups as $group_id)
	    	if ($max_id < $group_id) $max_id = $group_id;
	    $user->gid = $max_id;


		$dispatcher	=& JDispatcher::getInstance();
		$document	= & JFactory::getDocument();
		$model		= &$this->getModel();

		$sitename	= $app->getCfg('sitename');

		$params = &$app->getParams('com_ezrealty');

		// Selected Request vars
		// ID may come from the product switcher
		if (!($ezrealtyId	= JRequest::getInt( 'ezrealty_id',	0 ))) {
			$ezrealtyId	= JRequest::getInt( 'id',			$ezrealtyId );
		}

		// query options
		$options['id']	= $ezrealtyId;
		$options['aid']	= $user->get('aid', 0);

		$ezrealty	=& $this->get('data');
		$category	= &$this->get('category' );

		// check if we have an item
		if (!is_object( $ezrealty )) {
			JError::raiseError( 404, 'RESOURCE NOT FOUND' );
			return;
		}

        $this->assignRef('user', 		$user);


		if ($params->get( 'er_pdffix' )){
			$imgbase = "";
		} else {
			$imgbase = JURI::root();
		}


define("PRINTPAGE_PATH",JPATH_COMPONENT_SITE. "/views/ezrealty/tmpl/" );
JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_ezrealty/tables');

$itemid  = intval(JRequest::getVar( 'Itemid', ''));

$theproplink  = JURI::root() . 'index.php?option=com_ezrealty&view=ezrealty&id='.$ezrealty->slug.'&cid='.$ezrealty->catslug.'&Itemid='.$itemid;

$number = $ezrealty->price;

if ( $params->get( 'er_currencycontrol' ) == 1 ) {

if ($ezrealty->currency_format==0) {
	$formatted_price = number_format($number);
} else if ($ezrealty->currency_format==1) {
	$formatted_price = number_format($number, 2,",",".");
} else if ($ezrealty->currency_format==2) {
	$formatted_price = number_format($number, 0,",",".");
} else if ($ezrealty->currency_format==3) {
	$formatted_price = number_format($number, 2,".",",");
} else if ($ezrealty->currency_format==4) {
	$formatted_price = number_format($number, 2,","," ");
}

} else {

if ($params->get( 'er_currencyformat' )==0) {
	$formatted_price = number_format($number);
} else if ($params->get( 'er_currencyformat' )==1) {
	$formatted_price = number_format($number, 2,",",".");
} else if ($params->get( 'er_currencyformat' )==2) {
	$formatted_price = number_format($number, 0,",",".");
} else if ($params->get( 'er_currencyformat' )==3) {
	$formatted_price = number_format($number, 2,".",",");
} else if ($params->get( 'er_currencyformat' )==4) {
	$formatted_price = number_format($number, 2,","," ");
}

}



if ( $ezrealty->type ) {
	if ( $ezrealty->type==1 ) { $thetype =  JText::_('EZREALTY_TYPE_SALE')." - "; }
	if ( $ezrealty->type==2 ) { $thetype =  JText::_('EZREALTY_TYPE_RENTAL')." - "; }
	if ( $ezrealty->type==3 ) { $thetype =  JText::_('EZREALTY_TYPE_LEASE')." - "; }
	if ( $ezrealty->type==4 ) { $thetype =  JText::_('EZREALTY_TYPE_AUCTION')." - "; }
	if ( $ezrealty->type==5 ) { $thetype =  JText::_('EZREALTY_TYPE_SWAP')." - "; }
	if ( $ezrealty->type==6 ) { $thetype =  JText::_('EZREALTY_TYPE_TENDER')." - "; }
	if ( $ezrealty->type==7 ) { $thetype =  JText::_('EZREALTY_TYPE_SHARE')." - "; }
} else {
	$thetype = '';
}

$loc =& JTable::getInstance('localities', 'Table');
$loc->load($ezrealty->locid);


$theloc = stripslashes($loc->ezcity);

$proptype = $thetype.$theloc;


if(!EZRealtyFHelper::checkForImage($ezrealty->id) ){
	$imageloc = $imgbase."components/com_ezrealty/assets/images/nothumb.png";
} else {
	$imageloc = EZRealtyFHelper::convertLpdfImage ($ezrealty->id);
}

$imginfo = getimagesize($imageloc);

if ($imginfo == null) {

	$image1 = '<img src="'.$imgbase.'components/com_ezrealty/assets/images/noimage.png" width="670px" />';

} else {

	$srcWidth = $imginfo[0];
	$srcHeight = $imginfo[1];

	if ($srcHeight > $srcWidth) {
		$image1 = '<img src="'.$imageloc.'" height="500px" />';
	} else {
		$image1 = '<img src="'.$imageloc.'" width="670px" />';
	}

}


$images = EZRealtyFHelper::getImagesById($ezrealty->id);

if(!empty($images)):
	foreach($images as $key=>$image):

		if($image->fname){

			if ($image->fname && $image->path){
				$theimgpath = $image->path;
				$thimgpath = $image->path;
			} else {
				$theimgpath = $imgbase."images/ezrealty/properties";
				$thimgpath = $imgbase."images/ezrealty/properties/th";
			}

		}
	endforeach;
endif;

if (isset($images[1]->fname)) {
	$image2 = '<img src="'.$theimgpath.'/'.$images[1]->fname.'" style="width:220px; height: 150px;" />';
} else {
	$image2 = '';
}
if (isset($images[2]->fname)) {
	$image3 = '<img src="'.$theimgpath.'/'.$images[2]->fname.'" style="width:220px; height: 150px;" />';
} else {
	$image3 = '';
}
if (isset($images[3]->fname)) {
	$image4 = '<img src="'.$theimgpath.'/'.$images[3]->fname.'" style="width:220px; height: 150px;" />';
} else {
	$image4 = '';
}
if (isset($images[4]->fname)) {
	$image5 = '<img src="'.$theimgpath.'/'.$images[4]->fname.'" style="width:220px; height: 150px;" />';
} else {
	$image5 = '';
}
if (isset($images[5]->fname)) {
	$image6 = '<img src="'.$theimgpath.'/'.$images[5]->fname.'" style="width:220px; height: 150px;" />';
} else {
	$image6 = '';
}
if (isset($images[6]->fname)) {
	$image7 = '<img src="'.$theimgpath.'/'.$images[6]->fname.'" style="width:220px; height: 150px;" />';
} else {
	$image7 = '';
}
if (isset($images[7]->fname)) {
	$image8 = '<img src="'.$theimgpath.'/'.$images[7]->fname.'" style="width:220px; height: 150px;" />';
} else {
	$image8 = '';
}
if (isset($images[8]->fname)) {
	$image9 = '<img src="'.$theimgpath.'/'.$images[8]->fname.'" style="width:220px; height: 150px;" />';
} else {
	$image9 = '';
}
if (isset($images[9]->fname)) {
	$image10 = '<img src="'.$theimgpath.'/'.$images[9]->fname.'" style="width:220px; height: 150px;" />';
} else {
	$image10 = '';
}


if ($ezrealty->viewad == 1) {
	if ( $ezrealty->unit_num ) {
		$unitnum = stripslashes($ezrealty->unit_num)." ";
	} else {
		$unitnum = "";
	}
	if ( $ezrealty->street_num ) {
		$streetnum = stripslashes($ezrealty->street_num)." ";
	} else {
		$streetnum = "";
	}
	if ( $ezrealty->address2 ) {
		$streetname = stripslashes($ezrealty->address2).", ";
	} else {
		$streetname = "";
	}
	if ( $ezrealty->proploc ) {
		$suburb = stripslashes($loc->ezcity)." ";
	} else {
		$suburb = "";
	}
	if ( $params->get( 'er_usepc' ) && $ezrealty->postcode ) {
		$postcode = stripslashes($ezrealty->postcode)." ";
	} else {
		$postcode = "";
	}

	$addressstuff = $unitnum.$streetnum.$streetname.$suburb.$postcode;
	$thetitle = rtrim($addressstuff, ' ');

} else {
	$thetitle = stripslashes($ezrealty->adline);
}


if ( $ezrealty->sold > 0 && $ezrealty->sold < 11 ) {
	if ( $ezrealty->sold==1 ) { $thestatus = JText::_('EZREALTY_DETAILS_MARKET1');}
	if ( $ezrealty->sold==2 ) { $thestatus = JText::_('EZREALTY_DETAILS_MARKET2');}
	if ( $ezrealty->sold==3 ) { $thestatus = JText::_('EZREALTY_DETAILS_MARKET3');}
	if ( $ezrealty->sold==4 ) { $thestatus = JText::_('EZREALTY_DETAILS_MARKET4');}
	if ( $ezrealty->sold==5 ) { $thestatus = JText::_('EZREALTY_DETAILS_MARKET5');}
	if ( $ezrealty->sold==6 ) { $thestatus = JText::_('EZREALTY_DETAILS_MARKET6');}
	if ( $ezrealty->sold==7 ) { $thestatus = JText::_('EZREALTY_DETAILS_MARKET7');}
	if ( $ezrealty->sold==8 ) { $thestatus = JText::_('EZREALTY_DETAILS_MARKET8');}
	if ( $ezrealty->sold==9 ) { $thestatus = JText::_('EZREALTY_DETAILS_MARKET9');}
	if ( $ezrealty->sold==10 ) { $thestatus = JText::_('EZREALTY_DETAILS_MARKET10');}
} else {
	$thestatus = "";
}


if ( $params->get( 'er_hideprice') || $params->get( 'er_hideprice')==0 && $this->user->id ) {
	if ( $params->get( 'title_price' ) ) {
		if ( $ezrealty->freq==0 ) {
			if ( $ezrealty->showprice==0 ) {
				$theprice = stripslashes($ezrealty->priceview);
			} else {
				$theprice = EZRealtyFHelper::convertPrice ($formatted_price, $ezrealty->currency, $ezrealty->currency_position);
			}
		}
		if ( $ezrealty->freq>0 ) {
			if ( $ezrealty->showprice==0 ) {
				$theprice = stripslashes($ezrealty->priceview);
			} else {
				$theprice = EZRealtyFHelper::convertPrice ($formatted_price, $ezrealty->currency, $ezrealty->currency_position)."&nbsp;".EZRealtyFHelper::convertFrequency ($ezrealty->freq);
			}
		}
	}
} else {
	$theprice = JText::_('EZREALTY_CONFIG_HIDEPRICE_MSG');
}


ob_start();


$html = ob_get_clean();


require_once(JPATH_SITE . '/components/com_ezrealty/assets/tcpdf/tcpdf.php');
require_once(JPATH_SITE . '/components/com_ezrealty/assets/tcpdf/pdf.helper.php');


// create new PDF document
$pdf = new PAGEPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);

$pdf->SetAuthor($ezrealty->dealer_name);

$pdf->SetTitle($ezrealty->adline);
$pdf->SetSubject($ezrealty->adline);
$pdf->SetKeywords($ezrealty->metakey);


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 41, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// remove default footer
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, "40");

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font

//$pdf->SetFont('dejavusans', '', 12, '', true);


// ------------------Add the cover page---------------------------------------


// add a page
$pdf->AddPage();

// Print a text
$tbl = <<<EOD

<div style="text-align: center;">$image1</div>
<div>
	<span style="color: #474747; font-weight: bold; font-size: 24; text-align: center;">$proptype</span>
</div>
<div>
	<span style="color: #ff0000; font-size: 22; text-align: center;">$theprice</span>
</div>
<div>
	<span style="color: #474747; font-size: 16; text-align: center;">$thetitle</span>
</div>

EOD;

$pdf->writeHTML($tbl, true, false, true, false, '');


// ------------------Add the details page---------------------------------------


// add a page
$pdf->AddPage();

ob_start();

if (file_exists(PRINTPAGE_PATH.'default_print.php')) {
	include(PRINTPAGE_PATH.'default_print.php');
}

$html2 = ob_get_clean();

// Print a text
$pdf->writeHTML($html2, true, false, true, false, '');

if ($params->get( 'er_useqrcode' )){

	$qplink  = JURI::root() . 'index.php?option=com_ezrealty&view=ezrealty&id='.$ezrealty->id.'&cid='.$ezrealty->cid.'&Itemid='.$itemid;

// set style for barcode
$style = array(
    'border' => 0,
    'vpadding' => '1',
    'hpadding' => '1',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);


	$pdf->write2DBarcode($qplink, 'QRCODE,H', 170, 210, 30, 30, $style, 'N');
	$pdf->Text(20, 205, '');


	
	// QRCODE,H : QR-CODE Best error correction
	//$pdf->write2DBarcode($qplink, 'QRCODE,H', 80, 210, 50, 50, $style, 'N');
	//$pdf->Text(80, 205, '');

}


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.

if (trim($ezrealty->alias) == '') {
	$ezrealty->alias = $ezrealty->adline;
}
	
$ezrealty->alias = JApplication::stringURLSafe($ezrealty->alias);
	
if (trim(str_replace('-','',$ezrealty->alias)) == '') {
	$ezrealty->alias = JFactory::getDate()->format('Y-m-d-H-i-s');
}

$pdf->Output("{$ezrealty->alias}.pdf", 'I');		
die();
//echo $html;


	}
}
?>