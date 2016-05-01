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
 * HTML View class for the EZ Realty component
 *
 * @package		EZ Realty
 *
 */
class EzrealtysViewEzrealty extends JViewLegacy
{
	function display($tpl = null)
	{


		$mainframe = &JFactory::getApplication();
		$database = & JFactory::getDBO();
		$my =& JFactory::getUser();

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		$ezrealty	=& $this->get('data');


		$filename = "EZ_Realty_Listing_ID_".$ezrealty->id."_" . date('d-m-Y');

		$output = '<?xml version="1.0" encoding="utf-8" ?>
				  <listings>
				  ';


		if ( $ezrealty->showprice==0 ) {
			$price = stripslashes($ezrealty->priceview);
		} else {
			$price = EZRealtyFHelper::formatDisplayPrice ($ezrealty->showprice, $ezrealty->price, $ezrealty->currency_format, $ezrealty->currency, $ezrealty->currency_position, $ezrealty->priceview, $ezrealty->freq);
		}

		$thetranstype = EZRealtyFHelper::xmlListingtype ($ezrealty->type);


if ( $ezrparams->get( 'er_useprofile') ){

	if ($ezrealty->agentInfo ) {

		//agent details via agentinfo field in EZ Realty

		for($i=1; $i < 10+1; $i++){
			$myagentkey[$i]='';
		}

		if ($ezrealty->agentInfo) {
			$agentkey = explode(";",$ezrealty->agentInfo);

			$myagentkey1=$agentkey[0];
			$myagentkey2=$agentkey[1];
			$myagentkey3=$agentkey[2];
			$myagentkey4=$agentkey[3];
			$myagentkey5=$agentkey[4];
			$myagentkey6=$agentkey[5];
			$myagentkey7=$agentkey[6];
			$myagentkey8=$agentkey[7];
			$myagentkey9=$agentkey[8];
			$myagentkey10=$agentkey[9];
			$myagentkey11=$agentkey[10];

		}

		if ( isset( $myagentkey1 )) {
			$propseller = $myagentkey1;
		} else {
			$propseller = "";
		}
		if ( isset( $myagentkey6 )) {
			$dealercompany = $myagentkey6;
		} else {
			$dealercompany = "";
		}

		$dealerstnum = "";

		if ( isset( $myagentkey7 )) {
			$dealerstreet = $myagentkey7;
		} else {
			$dealerstreet = "";
		}
		if ( isset( $myagentkey8 )) {
			$dealerloc = $myagentkey8;
		} else {
			$dealerloc = "";
		}
		if ( isset( $myagentkey9 )) {
			$dealerpcode = $myagentkey9;
		} else {
			$dealerpcode = "";
		}
		if ( isset( $myagentkey10 )) {
			$dealerstate = $myagentkey10;
		} else {
			$dealerstate = "";
		}

		if ( isset( $myagentkey3 )) {
			$dealerphone = $myagentkey3;
		} else {
			$dealerphone = "";
		}
		if ( isset( $myagentkey5 )) {
			$dealerfax = $myagentkey5;
		} else {
			$dealerfax = "";
		}
		if ( isset( $myagentkey4 )) {
			$dealermobile = $myagentkey4;
		} else {
			$dealermobile = "";
		}
		if ( isset( $myagentkey11 )) {
			$dealeremail = $myagentkey11;
		} else {
			$dealeremail = "";
		}

	} else {

		//agent details via EZ* tables
	
		$propseller = $ezrealty->dealer_name;
		$dealercompany = $ezrealty->dealer_company;
		$dealerphone = $ezrealty->dealer_phone;
		$dealerfax = $ezrealty->dealer_fax;
		$dealermobile = $ezrealty->dealer_mobile;
		$dealeremail = $ezrealty->dealer_email;
	
		$dealerstnum = $ezrealty->dealer_address1;
		$dealerstreet = $ezrealty->dealer_address2;
		$dealerloc = $ezrealty->dealer_suburb;
		$dealerpcode = $ezrealty->dealer_pcode;
		$dealerstate = $ezrealty->dealer_state;
	
		if ($ezrealty->dealer_image) {
			$dealerimage = JURI::root()."images/ezportal/avatar/".$ezrealty->dealer_image;
		} else {
			$dealerimage = '';
		}

	}

}


		if ($ezrealty->appliances){
			$appliances = $ezrealty->appliances."; ";
		} else {
			$appliances = "";
		}
		if ($ezrealty->outdoorfeatures){
			$outdoorfeatures = $ezrealty->outdoorfeatures."; ";
		} else {
			$outdoorfeatures = "";
		}
		if ($ezrealty->indoorfeatures){
			$indoorfeatures = $ezrealty->indoorfeatures."; ";
		} else {
			$indoorfeatures = "";
		}
		if ($ezrealty->buildingfeatures){
			$buildingfeatures = $ezrealty->buildingfeatures."; ";
		} else {
			$buildingfeatures = "";
		}
		if ($ezrealty->communityfeatures){
			$communityfeatures = $ezrealty->communityfeatures."; ";
		} else {
			$communityfeatures = "";
		}
		if ($ezrealty->otherfeatures){
			$otherfeatures = $ezrealty->otherfeatures."; ";
		} else {
			$otherfeatures = "";
		}


		$stringfeatures = $appliances.$indoorfeatures.$outdoorfeatures.$buildingfeatures.$communityfeatures.$otherfeatures;
		$trimmedfeatures = rtrim($stringfeatures, '; ');

		$features  = $trimmedfeatures;


		if ( $ezrealty->bathrooms > 0 ) {
			$ezrealty->bathrooms = preg_replace(array('/.00/', '/.25/', '/.50/', '/.75/'), array('', '&#188;', '&#189;', '&#190;'), $ezrealty->bathrooms);
			$bathrooms = $ezrealty->bathrooms;
		}

		if ( $ezrealty->parkingGarage ) {
			$parking   = $ezrealty->parkingGarage;
		} else {
			$parking   = '';
		}

		if ( $ezrealty->squarefeet ) {
			$housesize   = EZRealtyFHelper::xmlConvertArea ($ezrealty->squarefeet);
		} else {
			$housesize   = '';
		}

		if ( $ezrealty->landtype ) {
			$lotsize   = $ezrealty->landtype;
		} else {
			$lotsize   = '';
		}


		// Check if there is an image for the listing


		if(!EzRealtyImagesHelper::checkForImagexml($ezrealty->id, '1') ){
			$image1 = '';
		} else {
			$image1 = EzRealtyImagesHelper::getImageUrlxml($ezrealty->id, '1');
		}
		if(!EzRealtyImagesHelper::checkForImagexml($ezrealty->id, 2) ){
			$image2 = '';
		} else {
			$image2 = EzRealtyImagesHelper::getImageUrlxml($ezrealty->id, 2);
		}
		if(!EzRealtyImagesHelper::checkForImagexml($ezrealty->id, 3) ){
			$image3 = '';
		} else {
			$image3 = EzRealtyImagesHelper::getImageUrlxml($ezrealty->id, 3);
		}
		if(!EzRealtyImagesHelper::checkForImagexml($ezrealty->id, 4) ){
			$image4 = '';
		} else {
			$image4 = EzRealtyImagesHelper::getImageUrlxml($ezrealty->id, 4);
		}
		if(!EzRealtyImagesHelper::checkForImagexml($ezrealty->id, 5) ){
			$image5 = '';
		} else {
			$image5 = EzRealtyImagesHelper::getImageUrlxml($ezrealty->id, 5);
		}
		if(!EzRealtyImagesHelper::checkForImagexml($ezrealty->id, 6) ){
			$image6 = '';
		} else {
			$image6 = EzRealtyImagesHelper::getImageUrlxml($ezrealty->id, 6);
		}
		if(!EzRealtyImagesHelper::checkForImagexml($ezrealty->id, 7) ){
			$image7 = '';
		} else {
			$image7 = EzRealtyImagesHelper::getImageUrlxml($ezrealty->id, 7);
		}
		if(!EzRealtyImagesHelper::checkForImagexml($ezrealty->id, 8) ){
			$image8 = '';
		} else {
			$image8 = EzRealtyImagesHelper::getImageUrlxml($ezrealty->id, 8);
		}


		// Create a URL to the listing
		$itemurl  = JURI::root() . 'index.php?option=com_ezrealty&amp;view=ezrealty&amp;id='.$ezrealty->slug.'&amp;cid='.$ezrealty->catslug;


		$output .= "<listing>\n";
		$output .= "<feedtype>property</feedtype>\n";
		$output .= "<category>".htmlspecialchars(stripslashes($ezrealty->category), ENT_QUOTES)."</category>\n";
		$output .= "<uniqueID>".$ezrealty->id."</uniqueID>\n";
		$output .= "<mlsID>".htmlspecialchars(stripslashes($ezrealty->mls_id), ENT_QUOTES)."</mlsID>\n";
		$output .= "<price>".htmlspecialchars(stripslashes($price), ENT_QUOTES)."</price>\n";
		$output .= "<transtype>".htmlspecialchars(stripslashes($thetranstype), ENT_QUOTES)."</transtype>\n";

		$output .= "<title>".htmlspecialchars(stripslashes($ezrealty->adline), ENT_QUOTES)."</title>\n";
		$output .= "<url>".$itemurl."</url>\n";
		$output .= "<city>".htmlspecialchars(stripslashes($ezrealty->proploc), ENT_QUOTES)."</city>\n";
		$output .= "<postcode>".htmlspecialchars(stripslashes($ezrealty->postcode), ENT_QUOTES)."</postcode>\n";

		$output .= "<bedrooms>".htmlspecialchars(stripslashes($ezrealty->bedrooms), ENT_QUOTES)."</bedrooms>\n";
		$output .= "<bathrooms>".htmlspecialchars(stripslashes($bathrooms), ENT_QUOTES)."</bathrooms>\n";
		$output .= "<floors>".htmlspecialchars(stripslashes($ezrealty->stories), ENT_QUOTES)."</floors>\n";
		$output .= "<year>".htmlspecialchars(stripslashes($ezrealty->year), ENT_QUOTES)."</year>\n";
		$output .= "<features>".htmlspecialchars(stripslashes($features), ENT_QUOTES)."</features>\n";

		$output .= "<parking>".htmlspecialchars(stripslashes($parking), ENT_QUOTES)."</parking>\n";
		$output .= "<housesize>".htmlspecialchars(stripslashes($housesize), ENT_QUOTES)."</housesize>\n";
		$output .= "<lotsize>".htmlspecialchars(stripslashes($lotsize), ENT_QUOTES)."</lotsize>\n";
		$output .= "<hoa>".htmlspecialchars(stripslashes($ezrealty->hofees), ENT_QUOTES)."</hoa>\n";

		$output .= "<description><![CDATA[".stripslashes($ezrealty->propdesc)."]]></description>\n";

		$output .= "<image1>".$image1."</image1>\n";
		$output .= "<image2>".$image2."</image2>\n";
		$output .= "<image3>".$image3."</image3>\n";
		$output .= "<image4>".$image4."</image4>\n";
		$output .= "<image5>".$image5."</image5>\n";
		$output .= "<image6>".$image6."</image6>\n";
		$output .= "<image7>".$image7."</image7>\n";
		$output .= "<image8>".$image8."</image8>\n";

		$output .= "<agentName>".htmlspecialchars(stripslashes($propseller), ENT_QUOTES)."</agentName>\n";
		$output .= "<agentCompany>".htmlspecialchars(stripslashes($dealercompany), ENT_QUOTES)."</agentCompany>\n";
		$output .= "<agentPhone>".htmlspecialchars(stripslashes($dealerphone), ENT_QUOTES)."</agentPhone>\n";
		$output .= "<agentFax>".htmlspecialchars(stripslashes($dealerfax), ENT_QUOTES)."</agentFax>\n";
		$output .= "<agentMobile>".htmlspecialchars(stripslashes($dealermobile), ENT_QUOTES)."</agentMobile>\n";
		$output .= "<agentEmail>".htmlspecialchars(stripslashes($dealeremail), ENT_QUOTES)."</agentEmail>\n";
		$output .= "<agentStNum>".htmlspecialchars(stripslashes($dealerstnum), ENT_QUOTES)."</agentStNum>\n";
		$output .= "<agentStName>".htmlspecialchars(stripslashes($dealerstreet), ENT_QUOTES)."</agentStName>\n";
		$output .= "<agentSuburb>".htmlspecialchars(stripslashes($dealerloc), ENT_QUOTES)."</agentSuburb>\n";
		$output .= "<agentPostcode>".htmlspecialchars(stripslashes($dealerpcode), ENT_QUOTES)."</agentPostcode>\n";
		$output .= "<agentState>".htmlspecialchars(stripslashes($dealerstate), ENT_QUOTES)."</agentState>\n";
		$output .= "<agentImage>".htmlspecialchars(stripslashes($dealerimage), ENT_QUOTES)."</agentImage>\n";


		$output .= "  </listing>\n";
	$output .= "</listings>";

	//send file to browser

	@ob_end_clean();
	ob_start();

	header('Content-Type: application/xml');
	header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');

	print $output;


	exit();

	}
}

?>