<?php

/**
* @package EZ Realty
* @version 7.2.0
* @author  Kathy Strickland (aka PixelBunyiP) - Raptor Services <kathy@raptorservices.com>
* @link    http://www.raptorservices.com
* @copyright Copyright (C) 2006 - 2014 Raptor Developments Pty Ltd T/as Raptor Services-All rights reserved
* @license Creative Commons GNU GPL, see http://creativecommons.org/licenses/GPL/2.0/ for full license.
**/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * EzRealty Helper
 *
 */
class EZRealtyFHelper {


	function check_email($str){

		//returns 1 if valid email, 0 if not

		if(preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $str))

			return 1;

		else

			return 0;
	}


	function checkAgentEmail ($agentInfo) {

		$result = '';

		for($i=1; $i < 10+1; $i++){
			$myagentkey[$i]='';
		}

		if ($agentInfo) {
			$agentkey = explode(";",$agentInfo);

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

		if ( $myagentkey11 ) {
			$result = $myagentkey11;
		} else {
			$result = '';
		}

		return $result;

	}



	function EZClose($message) {

	?>

		<br />
		<div align="center"><?php echo $message;?><br /><br /></div>
		<br />

	<?php

	}


	/**
	 * check to see if listing has an image
	 *
	 */

	function checkForImage($id) {
		$db = & JFactory::getDBO();

		$result = '';

		if(isset($id)) {

			$query="SELECT * FROM #__ezrealty_images as p WHERE p.propid = $id order by ordering LIMIT 1";
			$db->setQuery( $query );
			$result = $db->loadResult();

			return $result;

		}
	}


	function convertMapIcons () {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		$result = '';

		if ($ezrparams->get( 'show_transtype_select') ) {
			if ( $ezrparams->get( 'er_usetype1') ) { ?>
				<span style="font-weight: normal; font-size: 80%;"><img src="components/com_ezrealty/assets/images/mapbutton1.png" border="0" alt="" /> <?php echo JText::_('EZREALTY_TYPE_SALE');?></span> 
			<?php }
			if ( $ezrparams->get( 'er_usetype2') ) { ?>
				<span style="font-weight: normal; font-size: 80%;"><img src="components/com_ezrealty/assets/images/mapbutton2.png" border="0" alt="" /> <?php echo JText::_('EZREALTY_TYPE_RENTAL');?></span> 
			<?php }
			if ( $ezrparams->get( 'er_usetype3') ) { ?>
				<span style="font-weight: normal; font-size: 80%;"><img src="components/com_ezrealty/assets/images/mapbutton3.png" border="0" alt="" /> <?php echo JText::_('EZREALTY_TYPE_LEASE');?></span> 
			<?php }
			if ( $ezrparams->get( 'er_usetype4') ) { ?>
				<span style="font-weight: normal; font-size: 80%;"><img src="components/com_ezrealty/assets/images/mapbutton4.png" border="0" alt="" /> <?php echo JText::_('EZREALTY_TYPE_AUCTION');?></span> 
			<?php }
			if ( $ezrparams->get( 'er_usetype5') ) { ?>
				<span style="font-weight: normal; font-size: 80%;"><img src="components/com_ezrealty/assets/images/mapbutton5.png" border="0" alt="" /> <?php echo JText::_('EZREALTY_TYPE_SWAP');?></span> 
			<?php }
			if ( $ezrparams->get( 'er_usetype6') ) { ?>
				<span style="font-weight: normal; font-size: 80%;"><img src="components/com_ezrealty/assets/images/mapbutton6.png" border="0" alt="" /> <?php echo JText::_('EZREALTY_TYPE_TENDER');?></span>
			<?php }
			if ( $ezrparams->get( 'er_usetype7') ) { ?>
				<span style="font-weight: normal; font-size: 80%;"><img src="components/com_ezrealty/assets/images/mapbutton7.png" border="0" alt="" /> <?php echo JText::_('EZREALTY_TYPE_SHARE');?></span>
			<?php }
		}

		return $result;

	}


	function convertSelectList ($whichlist,$thelist1,$thelist2,$thelist3,$thelist4,$thelist5,$thelist6,$thelist7,$thelist8,$thelist9,$thelist10,$thelist11) {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		$result = '';

		if ($whichlist == 'catgtype' && $thelist1 == '1'){

			if ( $ezrparams->get( 'show_categories_select' ) ) { ?><div class="row-fluid"><div class="span12"><?php echo stripslashes($this->lists['cid']);?></div></div><?php }

		} else if ($whichlist == 'transtype' && $thelist2 == '1'){

			if ( $ezrparams->get( 'show_transtype_select' ) ) { ?><div class="row-fluid"><div class="span12"><?php echo stripslashes($this->lists['type']);?></div></div><?php }

		} else if ($whichlist == 'marketstatus' && $thelist3 == '1'){

			if ( $ezrparams->get( 'show_marketstatus_select' ) ) { ?><div class="row-fluid"><div class="span12"><?php echo stripslashes($this->lists['sold']);?></div></div><?php }

		} else if ($whichlist == 'sellers' && $thelist4 == '1'){

			if ( $ezrparams->get( 'show_sellers_select' ) ) { ?><div class="row-fluid"><div class="span12"><?php echo stripslashes($this->lists['seller']);?></div></div><?php }

		} else if ($whichlist == 'minmaxprice' && $thelist5 == '1'){

			if ( $ezrparams->get( 'show_minmaxprice_select' ) ) { ?><div class="row-fluid"><div class="span6"><?php echo stripslashes($this->lists['minprice']);?></div><div class="span6"><?php echo stripslashes($this->lists['maxprice']);?></div></div><?php }

		} else if ($whichlist == 'locations' && ( $thelist6 == '1' || $thelist7 == '1' || $thelist8 == '1' )){

			if ( $ezrparams->get( 'show_countries_select' ) && $thelist6 == '1' ) { ?><div class="row-fluid"><div class="span12"><?php echo stripslashes($this->lists['cnid']);?></div></div><?php }
			if ( $ezrparams->get( 'show_states_select' ) && $thelist7 == '1' ) { ?><div class="row-fluid"><div class="span12"><?php echo stripslashes($this->lists['stid']);?></div></div><?php }
			if ( $ezrparams->get( 'show_suburbs_select' ) && $thelist8 == '1' ) { ?><div class="row-fluid"><div class="span12"><?php echo stripslashes($this->lists['locid']);?></div></div><?php if ($ezrparams->get( 'show_surrounding_select' )){ ?><div class="row-fluid"><div class="span12">&nbsp;<?php echo $this->lists['radius'];?> <?php echo JText::_('EZREALTY_INCL_SURROUNDING');?></div></div><?php } ?><?php }

		} else if ($whichlist == 'minmxbeds' && $thelist9 == '1'){

			if ( $ezrparams->get( 'show_minbedsbaths_select' ) ) { ?><div class="row-fluid"><div class="span6"><?php echo stripslashes($this->lists['minbed']);?></div><div class="span6"><?php echo stripslashes($this->lists['minbaths']);?></div></div><?php }

		} else if ($whichlist == 'minmaxarea' && $thelist10 == '1'){

			if ( $ezrparams->get( 'show_minmaxarea_select' ) ) { ?><div class="row-fluid"><div class="span6"><?php echo stripslashes($this->lists['minarea']);?></div><div class="span6"><?php echo stripslashes($this->lists['maxarea']);?></div></div><?php }

		} else if ($whichlist == 'minmaxland' && $thelist11 == '1'){

			if ( $ezrparams->get( 'show_minmaxland_select' ) ) { ?><div class="row-fluid"><div class="span4"><?php echo stripslashes($this->lists['minland']);?></div><div class="span4"><?php echo stripslashes($this->lists['maxland']);?></div><div class="span4"><?php echo stripslashes($this->lists['lottype']);?></div></div><?php }

		} else { }

		return $result;

	}


	function findSuburbCoords ($subid) {

		$params = JComponentHelper::getParams ('com_ezrealty');
		$db = & JFactory::getDBO();

		$maplat = 0;
		$maplong = 0;
		$mapzoom = 0;

		$db->setQuery( "SELECT * FROM #__ezrealty_locality WHERE id = $subid order by ordering LIMIT 1" );
		$therow = $db->loadObjectList();

		if(isset($therow[0]->declat)) {
			$maplat = $therow[0]->declat;
		}
		if(isset($therow[0]->declong)) {
			$maplong = $therow[0]->declong;
		}
		if(isset($therow[0]->zoom)) {
			$mapzoom = $therow[0]->zoom;
		}

		return array(
			$maplat,
			$maplong,
			$mapzoom,
		);

	}


	function getImagesById($id) {
		$db = & JFactory::getDBO();

		if(isset($id)) {

			$query="SELECT * FROM #__ezrealty_images WHERE propid = ".intval($id)." order by ordering";
			$db->setQuery( $query );
			$result = $db->loadObjectList();

			return $result;

		} else {

			return NULL;

		}
	}

	function getTheImage($id) {
		$db = & JFactory::getDBO();

		$result = '';

		if(isset($id)) {

			$query="SELECT fname AS image FROM #__ezrealty_images as p WHERE p.propid = $id order by ordering LIMIT 1";
			$db->setQuery( $query );
			$result = $db->loadResult();

			return $result;

		}
	}

	function convertPdfImage ($id) {

		$db = & JFactory::getDBO();
		$params = JComponentHelper::getParams ('com_ezrealty');

		if ($params->get( 'er_pdffix' )){
			$imgbase = "";
		} else {
			$imgbase = JURI::root();
		}

		$result = '';

		if(isset($id)) {

			$db->setQuery( "SELECT * FROM #__ezrealty_images WHERE propid = $id order by ordering LIMIT 1" );
			$therow = $db->loadObjectList();
			$therow = $therow[0];

			if ($therow->fname && $therow->path){
				$result = $therow->path."/".$therow->fname;
			} else {
				$result = $imgbase."images/ezrealty/properties/th/".$therow->fname;
			}

			return $result;
		}
	}

	function convertLpdfImage ($id) {

		$db = & JFactory::getDBO();
		$params = JComponentHelper::getParams ('com_ezrealty');

		if ($params->get( 'er_pdffix' )){
			$imgbase = "";
		} else {
			$imgbase = JURI::root();
		}

		$result = '';

		if(isset($id)) {

			$db->setQuery( "SELECT * FROM #__ezrealty_images WHERE propid = $id order by ordering LIMIT 1" );
			$therow = $db->loadObjectList();
			$therow = $therow[0];

			if ($therow->fname && $therow->path){
				$result = $therow->path."/".$therow->fname;
			} else {
				$result = $imgbase."images/ezrealty/properties/".$therow->fname;
			}

			return $result;
		}
	}

	function convertFeedImage ($id) {

		$params = JComponentHelper::getParams ('com_ezrealty');

		$db = & JFactory::getDBO();

		$result = '';

		if(isset($id)) {

			$db->setQuery( "SELECT * FROM #__ezrealty_images WHERE propid = $id order by ordering LIMIT 1" );
			$therow = $db->loadObjectList();
			$therow = $therow[0];

			if ($therow->fname && $therow->path){
				$result = $therow->path."/".$therow->fname;
			} else {
				$result = JURI::root()."images/ezrealty/properties/th/".$therow->fname;
			}

			return $result;
		}
	}



	function convertMapImage ($id) {

		$app		= JFactory::getApplication();
		$params		= $app->getParams();
		$db = & JFactory::getDBO();

		$result = '';

		if(isset($id)) {

			$db->setQuery( "SELECT * FROM #__ezrealty_images WHERE propid = $id order by ordering LIMIT 1" );
			$therow = $db->loadObjectList();
			$therow = $therow[0];

			if ($therow->fname && $therow->path){
				echo $therow->path."/".$therow->fname;
			} else {
				echo JURI::root()."images/ezrealty/properties/th/".$therow->fname;
			}

			return $result;
		}
	}

	function convertModuleImage ($id) {

		$params = JComponentHelper::getParams ('com_ezrealty');

		$db = & JFactory::getDBO();

		$result = '';

		if(isset($id)) {

			$db->setQuery( "SELECT * FROM #__ezrealty_images WHERE propid = $id order by ordering LIMIT 1" );
			$therow = $db->loadObjectList();
			$therow = $therow[0];

			if ($therow->fname && $therow->path){
				$result = $therow->path."/".$therow->fname;
			} else {
				$result = JURI::root()."images/ezrealty/properties/th/".$therow->fname;
			}

			return $result;
		}
	}

	function convertLmodImage ($id) {

		$params = JComponentHelper::getParams ('com_ezrealty');

		$db = & JFactory::getDBO();

		$result = '';

		if(isset($id)) {

			$db->setQuery( "SELECT * FROM #__ezrealty_images WHERE propid = $id order by ordering LIMIT 1" );
			$therow = $db->loadObjectList();
			$therow = $therow[0];

			if ($therow->fname && $therow->path){
				$result = $therow->path."/".$therow->fname;
			} else {
				$result = JURI::root()."images/ezrealty/properties/".$therow->fname;
			}

			return $result;
		}
	}


	function featuredImage ($id, $solo, $themarketstatus, $theadline, $thefeat, $thetype) {

		$params = JComponentHelper::getParams ('com_ezrealty');
		$db = & JFactory::getDBO();

		$result = '';

		if(isset($id)) {

			$db->setQuery( "SELECT * FROM #__ezrealty_images WHERE propid = $id order by ordering LIMIT 1" );
			$therow = $db->loadObjectList();
			$therow = $therow[0];

			if ($therow->fname && $therow->path){ ?>
				<img class="span12 thumbnail" src="<?php echo $therow->path;?>/<?php echo $therow->fname;?>" alt="<?php echo $theadline;?>" />
			<?php } else { ?>
				<img class="span12" src="<?php echo JURI::root();?>images/ezrealty/properties/<?php echo $therow->fname;?>" alt="<?php echo $theadline;?>" />
			<?php }

			return $result;
		}
	}

	function theWatermark ($id, $solo, $themarketstatus, $theadline, $thefeat, $thetype) {

		$params = JComponentHelper::getParams ('com_ezrealty');
		$db = & JFactory::getDBO();

		$result = '';

		if(isset($id)) {

			if ( $params->get( 'er_watermark') ) {

				if ( $solo==1 ) { ?>

					<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/sole-agency_large.png" class="spotlight_watermark" alt="<?php echo JText::_('EZREALTY_SOLE_AGENCY');?>" />

				<?php } else {

					if ( $themarketstatus==5 ) { ?>
						<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/sold_large.png" class="spotlight_watermark" alt="<?php echo JText::_('EZREALTY_DETAILS_MARKET5');?>" />
					<?php } if ( $themarketstatus==9 ) { ?>
						<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/leased_large.png" class="spotlight_watermark" alt="<?php echo JText::_('EZREALTY_DETAILS_MARKET9');?>" />
					<?php } if ( $thefeat==2 && $themarketstatus!=5 && $themarketstatus!=9 ) { ?>
							<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/featured_large.png" class="spotlight_watermark" alt="<?php echo $theadline;?>" />
					<?php } if ( $thetype==4 && $thefeat!=2 && $themarketstatus!=5 && $themarketstatus!=9 ) { ?>
						<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/auction_large.png" class="spotlight_watermark" alt="<?php echo $theadline;?>" />
					<?php }

				}

			}

			return $result;
		}
	}

	function convertImage ($id, $solo, $themarketstatus, $theadline, $thefeat, $thetype) {

		$params = JComponentHelper::getParams ('com_ezrealty');
		$db = & JFactory::getDBO();

		if ($params->get( 'distortimg') && $params->get( 'thumbheight')){
			$theheight = "height=\"".$params->get( 'thumbheight')."px\"";
		} else {
			$theheight = "";
		}

		$result = '';

		if(isset($id)) {

			$db->setQuery( "SELECT * FROM #__ezrealty_images WHERE propid = $id order by ordering LIMIT 1" );
			$therow = $db->loadObjectList();
			$therow = $therow[0];

			if ($therow->fname && $therow->path){ ?>
				<img class="span12" src="<?php echo $therow->path;?>/<?php echo $therow->fname;?>" alt="<?php echo $theadline;?>" />
			<?php } else { ?>
				<img class="span12" src="<?php echo JURI::root();?>images/ezrealty/properties/th/<?php echo $therow->fname;?>" alt="<?php echo $theadline;?>" />
			<?php }

			return $result;
		}
	}

	function smallWatermark ($id, $solo, $themarketstatus, $theadline, $thefeat, $thetype) {

		$params = JComponentHelper::getParams ('com_ezrealty');

		$result = '';

		if(isset($id)) {

			if ( $params->get( 'er_watermark') ) {

				if ( $solo==1 ) { ?>

					<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/sole-agency_small.png" class="featured_watermark" alt="<?php echo JText::_('EZREALTY_SOLE_AGENCY');?>" />

				<?php } else {

					if ( $themarketstatus==5 ) { ?>
						<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/sold_small.png" class="featured_watermark" alt="" />
					<?php } if ( $themarketstatus==9 ) { ?>
						<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/leased_small.png" class="featured_watermark" alt="" />
					<?php } if ( $thefeat==1 && $themarketstatus!=5 && $themarketstatus!=9 ) { ?>
							<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/featured_small.png" class="featured_watermark" alt="" />
					<?php } if ( $thetype==4 && $thefeat!=1 && $themarketstatus!=5 && $themarketstatus!=9 ) { ?>
						<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/auction_small.png" class="featured_watermark" alt="" />
					<?php }
				}
			}


			return $result;
		}
	}

	function convertSellerImage ($thesellerimg, $printout) {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		$result = '';

		if ($printout){

			if ($thesellerimg){ ?>
			<img class="thumbnail" src="<?php echo JURI::root();?>images/ezportal/avatar/<?php echo $thesellerimg;?>" alt="" />
			<?php } else { ?>
			<img class="thumbnail" src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/noavatar.png" alt="" />
			<?php }

		} else {

			if ($thesellerimg){ ?>
			<img class="span12 thumbnail" src="<?php echo JURI::root();?>images/ezportal/avatar/<?php echo $thesellerimg;?>" alt="" />
			<?php } else { ?>
			<img class="span12 thumbnail" src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/noavatar.png" alt="" />
			<?php }

		}


		return $result;

	}

	function convertSellerLogo ($thesellerimg) {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		$result = '';

		if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){
			if ($thesellerimg){ ?>
				<img src="<?php echo JURI::root();?>images/ezportal/logo/<?php echo $thesellerimg;?>" style="width: 150px;" alt="" />
			<?php } else { }
		} else {
			if ( $ezrparams->get( 'er_bizlogo' ) ){ ?>
				<img src="<?php echo $ezrparams->get( 'er_bizlogo' );?>" style="width: 150px;" alt="" />
			<?php } else { }
		}

		return $result;

	}


	function convertPrice ($theprice, $thecurrency, $thecurrencypos) {

		$app		= JFactory::getApplication();
		$params		= $app->getParams();

		$result = '';

		if ( $params->get( 'er_currencycontrol' ) == 1 ) {
			if ( $thecurrencypos==0 ) {
				$result =  $thecurrency.''.$theprice;
			} else {
				$result =  $theprice.' '.$thecurrency;
			}
		} else {
			if ( $params->get( 'er_currencypos' )==0 ) {
				$result =  $params->get( 'er_currencysign' ).''.$theprice;
			} else {
				$result =  $theprice.' '.$params->get( 'er_currencysign' );
			}
		}

		return $result;

	}

	function convertBst ($bsthumb) {

		$result = '';

		if ( $bsthumb==1 ) { $result =  "span11"; }
		if ( $bsthumb==2 ) { $result =  "span10"; }
		if ( $bsthumb==3 ) { $result =  "span9"; }
		if ( $bsthumb==4 ) { $result =  "span8"; }
		if ( $bsthumb==5 ) { $result =  "span7"; }
		if ( $bsthumb==6 ) { $result =  "span6"; }

		return $result;

	}

	function convertRental ($therent) {

		$result = '';

		if ( $therent==1 ) { $result =  JText::_('EZREALTY_RENTYPE_LONG'); }
		if ( $therent==2 ) { $result =  JText::_('EZREALTY_RENTYPE_SHORT'); }
		if ( $therent==3 ) { $result =  JText::_('EZREALTY_RENTYPE_STUDENT'); }
		if ( $therent==4 ) { $result =  JText::_('EZREALTY_RENTYPE_COMMERCIAL'); }

		return $result;

	}

	function convertFrequency ($thefreq) {

		$result = '';

		if ( $thefreq==1 ) { $result =  JText::_('EZREALTY_RENTAL_NIGHTLY'); }
		if ( $thefreq==2 ) { $result =  JText::_('EZREALTY_RENTAL_WEEKLY'); }
		if ( $thefreq==3 ) { $result =  JText::_('EZREALTY_RENTAL_FNIGHT'); }
		if ( $thefreq==4 ) { $result =  JText::_('EZREALTY_RENTAL_MONTH'); }
		if ( $thefreq==5 ) { $result =  JText::_('EZREALTY_RENTAL_SQFT'); }
		if ( $thefreq==6 ) { $result =  JText::_('EZREALTY_RENTAL_SQMTR'); }
		if ( $thefreq==7 ) { $result =  JText::_('EZREALTY_RENTAL_SPARE'); }

		return $result;

	}

	function convertListingtype ($thetype) {

		$result = '';

		if ( $thetype==1 ) { $result =  JText::_('EZREALTY_TYPE_SALE'); }
		if ( $thetype==2 ) { $result =  JText::_('EZREALTY_TYPE_RENTAL'); }
		if ( $thetype==3 ) { $result =  JText::_('EZREALTY_TYPE_LEASE'); }
		if ( $thetype==4 ) { $result =  JText::_('EZREALTY_TYPE_AUCTION'); }
		if ( $thetype==5 ) { $result =  JText::_('EZREALTY_TYPE_SWAP'); }
		if ( $thetype==6 ) { $result =  JText::_('EZREALTY_TYPE_TENDER'); }
		if ( $thetype==7 ) { $result =  JText::_('EZREALTY_TYPE_SHARE'); }

		return $result;

	}

	function convertMarketstatus ($themarket) {

		$result = '';

		if ( $themarket==1 ) { $result =  JText::_('EZREALTY_DETAILS_MARKET1'); }
        if ( $themarket==2 ) { $result =  JText::_('EZREALTY_DETAILS_MARKET2'); }
		if ( $themarket==3 ) { $result =  JText::_('EZREALTY_DETAILS_MARKET3'); }
        if ( $themarket==4 ) { $result =  JText::_('EZREALTY_DETAILS_MARKET4'); }
        if ( $themarket==5 ) { $result =  JText::_('EZREALTY_DETAILS_MARKET5'); }
        if ( $themarket==6 ) { $result =  JText::_('EZREALTY_DETAILS_MARKET6'); }
        if ( $themarket==7 ) { $result =  JText::_('EZREALTY_DETAILS_MARKET7'); }
        if ( $themarket==8 ) { $result =  JText::_('EZREALTY_DETAILS_MARKET8'); }
        if ( $themarket==9 ) { $result =  JText::_('EZREALTY_DETAILS_MARKET9'); }
        if ( $themarket==10 ) { $result =  JText::_('EZREALTY_DETAILS_MARKET10'); }

		return $result;

	}

	function convertArea ($thearea) {

		$params = JComponentHelper::getParams ('com_ezrealty');

		$result = '';

		if ($params->get( 'er_areaunit') == 1){
			$theunit = JText::_('EZREALTY_SEARCH_METERS');
		} else if ($params->get( 'er_areaunit') == 2){
			$theunit = JText::_('EZREALTY_SEARCH_SQFEET');
		} else if ($params->get( 'er_areaunit') == 3){
			$theunit = JText::_('EZREALTY_SEARCH_YARDS');
		} else if ($params->get( 'er_areaunit') == 4){
			$theunit = JText::_('EZREALTY_SEARCH_SQUARES');
		} else {
			$theunit = "";
		}

		echo stripslashes($thearea)." ".$theunit;

		return $result;

	}



	function convertAcreage ( ) {

		$params = JComponentHelper::getParams ('com_ezrealty');

		$result = '';

		if ($params->get( 'er_acreageunit') == 1){
			$result = JText::_('EZREALTY_SEARCH_ACRES');
		} else if ($params->get( 'er_acreageunit') == 2){
			$result = JText::_('EZREALTY_SEARCH_HECTARES');
		} else {
			$result = "";
		}

		return $result;

	}

	function convertLandArea( ) {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		$formatted_landarea = '';

			if ($ezrparams->get( 'er_landareaunit') == '1') {
				$formatted_landarea = JText::_('EZREALTY_SEARCH_METERS');
			} else if ($ezrparams->get( 'er_landareaunit') == '2') {
				$formatted_landarea = JText::_('EZREALTY_SEARCH_SQFEET');
			} else if ($ezrparams->get( 'er_landareaunit') == '3') {
				$formatted_landarea = JText::_('EZREALTY_SEARCH_YARDS');
			} else {
				$formatted_landarea = JText::_('EZREALTY_SEARCH_METERS');
			}


		return $formatted_landarea;
	}


	function convertFloorArea( ) {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		$formatted_flarea = '';

			if ($ezrparams->get( 'er_areaunit') == '1') {
				$formatted_flarea = JText::_('EZREALTY_SEARCH_METERS');
			} else if ($ezrparams->get( 'er_areaunit') == '2') {
				$formatted_flarea = JText::_('EZREALTY_SEARCH_SQFEET');
			} else if ($ezrparams->get( 'er_areaunit') == '3') {
				$formatted_flarea = JText::_('EZREALTY_SEARCH_YARDS');
			} else if ($ezrparams->get( 'er_areaunit') == '4') {
				$formatted_flarea = JText::_('EZREALTY_SEARCH_SQUARES');
			} else {
				$formatted_flarea = JText::_('EZREALTY_SEARCH_METERS');
			}


		return $formatted_flarea;
	}




	function textIcons ($thebedrooms, $thebathrooms, $theparking, $thearea, $theland) {

		$params = JComponentHelper::getParams ('com_ezrealty');


		$result = '';

		if ( $thebedrooms == -2) {
			$pf1 = " ". JText::_('EZREALTY_COUCH')." |";
		} else {
			$pf1 = "";
		}
		if ( $thebedrooms == -1) {
			$pf2 = " ". JText::_('EZREALTY_STUDIO_BEDROOM')." |";
		} else {
			$pf2 = "";
		}
		if ( $thebedrooms == 1 ) {
			$pf3 = " ". stripslashes($thebedrooms)." ".JText::_('EZREALTY_SINGLE_BEDROOM')." |";
		} else {
			$pf3 = "";
		}
		if ( $thebedrooms > 1 ) {
			$pf4 = " ". stripslashes($thebedrooms)." ".JText::_('EZREALTY_DETAILS_BEDROOMS')." |";
		} else {
			$pf4 = "";
		}
		if ( $thebathrooms != "0.00" ) {
			$thebathrooms = preg_replace(array('/0.00/', '/.00/', '/.25/', '/.50/', '/.75/'), array('', '', '&#188;', '&#189;', '&#190;'), $thebathrooms);

			$pf5 = " ". stripslashes($thebathrooms)." ".JText::_('EZREALTY_DETAILS_BATHROOMS')." |";
		} else {
			$pf5 = "";
		}
		if ( $theparking ) {
			$pf6 = " ". stripslashes($theparking)." ".JText::_('EZREALTY_PARKING_SPACES')." |";
		} else {
			$pf6 = "";
		}
		if ( $thearea ) {
			$pf7 = " ". stripslashes($thearea)." ".EZRealtyFHelper::convertFloorArea()." |";
		} else {
			$pf7 = "";
		}

		if ( $theland ) {
			$pf8 = " ". stripslashes($theland)." ".EZRealtyFHelper::convertLandArea()." |";
		} else {
			$pf8 = "";
		}



		$iconstuff = $pf1.$pf2.$pf3.$pf4.$pf5.$pf6.$pf7.$pf8;
		$result = rtrim($iconstuff, ' |');

		return $result;

	}

	function convertHicons ($thebedrooms, $thebathrooms, $theparking, $thearea, $theland) {

		$params = JComponentHelper::getParams ('com_ezrealty');

		if ($params->get('page_iconcolour')){
			$thecolour = "2";
		} else {
			$thecolour = "";
		}

		$result = '';

		if ( $thebedrooms == -2) { ?>
			<span class="hasTooltip" title="<?php echo JText::_('EZREALTY_COUCH');?>"><img border="0" src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/couch<?php echo $thecolour;?>.gif" class="feat-icons" alt="" /> <span class="small-icons"><?php echo JText::_('EZREALTY_COUCH');?>&nbsp;</span></span> 
		<?php }
		if ( $thebedrooms == -1) { ?>
			<span class="hasTooltip" title="<?php echo JText::_('EZREALTY_DETAILS_BEDROOMS');?>"><img border="0" src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/bedrooms<?php echo $thecolour;?>.gif" class="feat-icons" alt="" /> <span class="small-icons"><?php echo JText::_('EZREALTY_STUDIO');?>&nbsp;</span></span> 
		<?php }
		if ( $thebedrooms >= 1 ) { ?>
			<span class="hasTooltip" title="<?php echo JText::_('EZREALTY_DETAILS_BEDROOMS');?>"><img border="0" src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/bedrooms<?php echo $thecolour;?>.gif" class="feat-icons" alt="" /> <span class="small-icons"><?php echo stripslashes($thebedrooms);?>&nbsp;</span></span> 
		<?php }
		if ( $thebathrooms != "0.00" ) {
			$thebathrooms = preg_replace(array('/0.00/', '/.00/', '/.25/', '/.50/', '/.75/'), array('', '', '&#188;', '&#189;', '&#190;'), $thebathrooms);
		?>
			<span class="hasTooltip" title="<?php echo JText::_('EZREALTY_DETAILS_BATHROOMS');?>"><img border="0" src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/bathroom<?php echo $thecolour;?>.gif" class="feat-icons" alt="" /> <span class="small-icons"><?php echo stripslashes($thebathrooms);?>&nbsp;</span></span> 
		<?php }
		if ( $theparking ) { ?>
			<span class="hasTooltip" title="<?php echo JText::_('EZREALTY_DETAILS_GARPARKING');?>"><img border="0" src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/parking<?php echo $thecolour;?>.gif" class="feat-icons" alt="" /> <span class="small-icons"><?php echo stripslashes($theparking);?>&nbsp;</span></span>
		<?php }
		if ( $thearea ) { ?>
			<span class="hasTooltip" title="<?php echo JText::_('EZREALTY_DETAILS_SQUARES');?>"><img border="0" src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/floorarea<?php echo $thecolour;?>.gif" class="feat-icons" alt="" /> <span class="small-icons"><?php echo stripslashes($thearea)." <span style=\"font-size:90%\">".EZRealtyFHelper::convertFloorArea();?></span></span></span>
		<?php }
		if ( $theland ) { ?>
			<span class="hasTooltip" title="<?php echo JText::_('EZREALTY_DETAILS_LANDAREA');?>"><img border="0" src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/land<?php echo $thecolour;?>.gif" class="feat-icons" alt="" /> <span class="small-icons"><?php echo stripslashes($theland)." <span style=\"font-size:90%\">".EZRealtyFHelper::convertLandArea();?></span></span></span>
		<?php }

		return $result;

	}



	function convertTitle ($thetype, $theproploc, $theadline) {

		$params = JComponentHelper::getParams ('com_ezrealty');

		$showtype = '';
		$showproploc = '';
		$showhline = '';
		$result = '';

		if ( $params->get( 'title_source' ) == 1 ) {
			if ( $thetype ) {
				$showtype = EZRealtyFHelper::convertListingtype ($thetype);
			}
			if ( $theproploc ) {
				$showproploc = " - ". stripslashes($theproploc);
			}
		} else if ( $params->get( 'title_source' ) == 2 ) {
			if ( $thetype ) {
				$showtype = EZRealtyFHelper::convertListingtype ($thetype);
			}
			if ( $theproploc ) {
				$showproploc = " - ". stripslashes($theproploc);
			}
			if ( $theadline ) {
				$showhline = " - ". stripslashes($theadline);
			}
		} else {
			$showhline = stripslashes($theadline);
		}

		$result = $showtype.$showproploc.$showhline;

		return $result;

	}


	function convertJreviews ($thelisting, $whichone) {

		$result = '';

		# MVC initalization script
		if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
		require('components' . DS . 'com_jreviews' . DS . 'jreviews' . DS . 'framework.php');

		// Populate $JreParams array
		$JreParams['data']['extension'] = 'com_ezrealty';
		$JreParams['data']['tmpl_suffix'] = '';
		$JreParams['data']['controller'] = 'everywhere';
		$JreParams['data']['action'] = 'index';
		$JreParams['data']['listing_id'] = $thelisting;

		// Load dispatch class
		$Dispatcher = new S2Dispatcher('jreviews',true);

		$jreDetail = $Dispatcher->dispatch($JreParams);

		if ($whichone){
			echo $jreDetail['summary'];
		} else {
			echo $jreDetail['output'];
		}

		return $result;

	}


	function convertDate ($thedate) {

		$params = JComponentHelper::getParams ('com_ezrealty');

		$result = '';

		if ($params->get( 'er_dateformat') == 'd-m-Y') {
			# Y-m-d => UK Format
			echo date("d.m.Y",strtotime($thedate));
		}
		if ($params->get( 'er_dateformat') == 'm-d-Y') {
			# Y-m-d => US Format
			echo date("m-d-Y",strtotime($thedate));
		}
		if ($params->get( 'er_dateformat') == 'Y-m-d') {
			# default date format
			echo $thedate;
		}
		if ($params->get( 'er_dateformat') == 'D d-m-Y') {
			# D d-m-Y => medium date Format
			echo date("D d-M Y",strtotime($thedate));
		}

		return $result;

	}

	function convertTime($text) {

		$ez_time = $text;
		$ez_time = preg_replace("/00:00:00/si","12:00MN", $ez_time);
		$ez_time = preg_replace("/00:15:00/si","12:15AM", $ez_time);
		$ez_time = preg_replace("/00:30:00/si","12:30AM", $ez_time);
		$ez_time = preg_replace("/00:45:00/si","12:45AM", $ez_time);
		$ez_time = preg_replace("/01:00:00/si","1:00AM", $ez_time);
		$ez_time = preg_replace("/01:15:00/si","1:15AM", $ez_time);
		$ez_time = preg_replace("/01:30:00/si","1:30AM", $ez_time);
		$ez_time = preg_replace("/01:45:00/si","1:45AM", $ez_time);
		$ez_time = preg_replace("/02:00:00/si","2:00AM", $ez_time);
		$ez_time = preg_replace("/02:15:00/si","2:15AM", $ez_time);
		$ez_time = preg_replace("/02:30:00/si","2:30AM", $ez_time);
		$ez_time = preg_replace("/02:45:00/si","2:45AM", $ez_time);
		$ez_time = preg_replace("/03:00:00/si","3:00AM", $ez_time);
		$ez_time = preg_replace("/03:15:00/si","3:15AM", $ez_time);
		$ez_time = preg_replace("/03:30:00/si","3:30AM", $ez_time);
		$ez_time = preg_replace("/03:45:00/si","3:45AM", $ez_time);
		$ez_time = preg_replace("/04:00:00/si","4:00AM", $ez_time);
		$ez_time = preg_replace("/04:15:00/si","4:15AM", $ez_time);
		$ez_time = preg_replace("/04:30:00/si","4:30AM", $ez_time);
		$ez_time = preg_replace("/04:45:00/si","4:45AM", $ez_time);
		$ez_time = preg_replace("/05:00:00/si","5:00AM", $ez_time);
		$ez_time = preg_replace("/05:15:00/si","5:15AM", $ez_time);
		$ez_time = preg_replace("/05:30:00/si","5:30AM", $ez_time);
		$ez_time = preg_replace("/05:45:00/si","5:45AM", $ez_time);
		$ez_time = preg_replace("/06:00:00/si","6:00AM", $ez_time);
		$ez_time = preg_replace("/06:15:00/si","6:15AM", $ez_time);
		$ez_time = preg_replace("/06:30:00/si","6:30AM", $ez_time);
		$ez_time = preg_replace("/06:45:00/si","6:45AM", $ez_time);
		$ez_time = preg_replace("/07:00:00/si","7:00AM", $ez_time);
		$ez_time = preg_replace("/07:15:00/si","7:15AM", $ez_time);
		$ez_time = preg_replace("/07:30:00/si","7:30AM", $ez_time);
		$ez_time = preg_replace("/07:45:00/si","7:45AM", $ez_time);
		$ez_time = preg_replace("/08:00:00/si","8:00AM", $ez_time);
		$ez_time = preg_replace("/08:15:00/si","8:15AM", $ez_time);
		$ez_time = preg_replace("/08:30:00/si","8:30AM", $ez_time);
		$ez_time = preg_replace("/08:45:00/si","8:45AM", $ez_time);
		$ez_time = preg_replace("/09:00:00/si","9:00AM", $ez_time);
		$ez_time = preg_replace("/09:15:00/si","9:15AM", $ez_time);
		$ez_time = preg_replace("/09:30:00/si","9:30AM", $ez_time);
		$ez_time = preg_replace("/09:45:00/si","9:45AM", $ez_time);
		$ez_time = preg_replace("/10:00:00/si","10:00AM", $ez_time);
		$ez_time = preg_replace("/10:15:00/si","10:15AM", $ez_time);
		$ez_time = preg_replace("/10:30:00/si","10:30AM", $ez_time);
		$ez_time = preg_replace("/10:45:00/si","10:45AM", $ez_time);
		$ez_time = preg_replace("/11:00:00/si","11:00AM", $ez_time);
		$ez_time = preg_replace("/11:15:00/si","11:15AM", $ez_time);
		$ez_time = preg_replace("/11:30:00/si","11:30AM", $ez_time);
		$ez_time = preg_replace("/11:45:00/si","11:45AM", $ez_time);
		$ez_time = preg_replace("/12:00:00/si","12:00MD", $ez_time);
		$ez_time = preg_replace("/12:15:00/si","12:15PM", $ez_time);
		$ez_time = preg_replace("/12:30:00/si","12:30PM", $ez_time);
		$ez_time = preg_replace("/12:45:00/si","12:45PM", $ez_time);
		$ez_time = preg_replace("/13:00:00/si","1:00PM", $ez_time);
		$ez_time = preg_replace("/13:15:00/si","1:15PM", $ez_time);
		$ez_time = preg_replace("/13:30:00/si","1:30PM", $ez_time);
		$ez_time = preg_replace("/13:45:00/si","1:45PM", $ez_time);
		$ez_time = preg_replace("/14:00:00/si","2:00PM", $ez_time);
		$ez_time = preg_replace("/14:15:00/si","2:15PM", $ez_time);
		$ez_time = preg_replace("/14:30:00/si","2:30PM", $ez_time);
		$ez_time = preg_replace("/14:45:00/si","2:45PM", $ez_time);
		$ez_time = preg_replace("/15:00:00/si","3:00PM", $ez_time);
		$ez_time = preg_replace("/15:15:00/si","3:15PM", $ez_time);
		$ez_time = preg_replace("/15:30:00/si","3:30PM", $ez_time);
		$ez_time = preg_replace("/15:45:00/si","3:45PM", $ez_time);
		$ez_time = preg_replace("/16:00:00/si","4:00PM", $ez_time);
		$ez_time = preg_replace("/16:15:00/si","4:15PM", $ez_time);
		$ez_time = preg_replace("/16:30:00/si","4:30PM", $ez_time);
		$ez_time = preg_replace("/16:45:00/si","4:45PM", $ez_time);
		$ez_time = preg_replace("/17:00:00/si","5:00PM", $ez_time);
		$ez_time = preg_replace("/17:15:00/si","5:15PM", $ez_time);
		$ez_time = preg_replace("/17:30:00/si","5:30PM", $ez_time);
		$ez_time = preg_replace("/17:45:00/si","5:45PM", $ez_time);
		$ez_time = preg_replace("/18:00:00/si","6:00PM", $ez_time);
		$ez_time = preg_replace("/18:15:00/si","6:15PM", $ez_time);
		$ez_time = preg_replace("/18:30:00/si","6:30PM", $ez_time);
		$ez_time = preg_replace("/18:45:00/si","6:45PM", $ez_time);
		$ez_time = preg_replace("/19:00:00/si","7:00PM", $ez_time);
		$ez_time = preg_replace("/19:15:00/si","7:15PM", $ez_time);
		$ez_time = preg_replace("/19:30:00/si","7:30PM", $ez_time);
		$ez_time = preg_replace("/19:45:00/si","7:45PM", $ez_time);
		$ez_time = preg_replace("/20:00:00/si","8:00PM", $ez_time);
		$ez_time = preg_replace("/20:15:00/si","8:15PM", $ez_time);
		$ez_time = preg_replace("/20:30:00/si","8:30PM", $ez_time);
		$ez_time = preg_replace("/20:45:00/si","8:45PM", $ez_time);
		$ez_time = preg_replace("/21:00:00/si","9:00PM", $ez_time);
		$ez_time = preg_replace("/21:15:00/si","9:15PM", $ez_time);
		$ez_time = preg_replace("/21:30:00/si","9:30PM", $ez_time);
		$ez_time = preg_replace("/21:45:00/si","9:45PM", $ez_time);
		$ez_time = preg_replace("/22:00:00/si","10:00PM", $ez_time);
		$ez_time = preg_replace("/22:15:00/si","10:15PM", $ez_time);
		$ez_time = preg_replace("/22:30:00/si","10:30PM", $ez_time);
		$ez_time = preg_replace("/22:45:00/si","10:45PM", $ez_time);
		$ez_time = preg_replace("/23:00:00/si","11:00PM", $ez_time);
		$ez_time = preg_replace("/23:15:00/si","11:15PM", $ez_time);
		$ez_time = preg_replace("/23:30:00/si","11:30PM", $ez_time);
		$ez_time = preg_replace("/23:45:00/si","11:45PM", $ez_time);

		while($ez_time != strip_tags($ez_time)) {
			$ez_time = strip_tags($ez_time);
		}

		return $ez_time;

	}


	function EZPowered() { ?>

		<div align="center">
			<br /><span class="small">Powered by <a href="http://www.raptorservices.com/" target="_blank">EZ Realty</a></span>
		</div>

	<?php

	}

	function limit_ezrealtytext( $text, $limit ) {
		if( strlen($text)>$limit ) {
			$text = substr( $text,0,$limit );
			$text = substr( $text,0,-(strlen(strrchr($text,' '))) );
		}
		return $text;
	}

    function CountCont ( $cat, $whichone ) {

		$params = JComponentHelper::getParams ('com_ezrealty');
        $db = & JFactory::getDBO();


		if ($whichone == 1){


			if ( $params->get( 'er_expmgmt')==1 ) {
				if ($params->get( 'restrict_sold')==1) {
					$currentdate=mktime(0, 0, 0, date("m"), date("d"), date("Y"));
					$query="SELECT count(p.id) as count FROM #__ezrealty as p WHERE p.stid = $cat AND p.published=1 AND p.sold != 5 AND p.sold != 9 AND p.expdate>$currentdate";
				} else {
					$currentdate=mktime(0, 0, 0, date("m"), date("d"), date("Y"));
					$query="SELECT count(p.id) as count FROM #__ezrealty as p WHERE p.stid = $cat AND p.published=1 AND p.expdate>$currentdate";
				}
			} else {
				if ($params->get( 'restrict_sold')==1) {
					$query="SELECT count(p.id) as count FROM #__ezrealty as p WHERE p.stid = $cat AND p.published=1 AND p.sold != 5 AND p.sold != 9";
				} else {
					$query="SELECT count(p.id) as count FROM #__ezrealty as p WHERE p.stid = $cat AND p.published=1";
				}
			}


		} else if ($whichone == 2){


			if ( $params->get( 'er_expmgmt')==1 ) {
				if ($params->get( 'restrict_sold')==1) {
					$currentdate=mktime(0, 0, 0, date("m"), date("d"), date("Y"));
					$query="SELECT count(p.id) as count FROM #__ezrealty as p WHERE p.locid = $cat AND p.published=1 AND p.sold != 5 AND p.sold != 9 AND p.expdate>$currentdate";
				} else {
					$currentdate=mktime(0, 0, 0, date("m"), date("d"), date("Y"));
					$query="SELECT count(p.id) as count FROM #__ezrealty as p WHERE p.locid = $cat AND p.published=1 AND p.expdate>$currentdate";
				}
			} else {
				if ($params->get( 'restrict_sold')==1) {
					$query="SELECT count(p.id) as count FROM #__ezrealty as p WHERE p.locid = $cat AND p.published=1 AND p.sold != 5 AND p.sold != 9";
				} else {
					$query="SELECT count(p.id) as count FROM #__ezrealty as p WHERE p.locid = $cat AND p.published=1";
				}
			}


		} else if ($whichone == 3){


			if ( $params->get( 'er_expmgmt')==1 ) {
				if ($params->get( 'restrict_sold')==1) {
					$currentdate=mktime(0, 0, 0, date("m"), date("d"), date("Y"));
					$query="SELECT count(p.id) as count FROM #__ezrealty as p INNER JOIN #__ezrealty_incats as ic ON ic.property_id=p.id WHERE ic.category_id = $cat AND p.published=1 AND p.sold != 5 AND p.sold != 9 AND p.expdate>$currentdate";
				} else {
					$currentdate=mktime(0, 0, 0, date("m"), date("d"), date("Y"));
					$query="SELECT count(p.id) as count FROM #__ezrealty as p INNER JOIN #__ezrealty_incats as ic ON ic.property_id=p.id WHERE ic.category_id = $cat AND p.published=1 AND p.expdate>$currentdate";
				}
			} else {
				if ($params->get( 'restrict_sold')==1) {
					$query="SELECT count(p.id) as count FROM #__ezrealty as p INNER JOIN #__ezrealty_incats as ic ON ic.property_id=p.id WHERE ic.category_id = $cat AND p.published=1 AND p.sold != 5 AND p.sold != 9";
				} else {
					$query="SELECT count(p.id) as count FROM #__ezrealty as p INNER JOIN #__ezrealty_incats as ic ON ic.property_id=p.id WHERE ic.category_id = $cat AND p.published=1";
				}
			}


		} else {
		}


        $db->setQuery( $query );
        $result = $db->loadResult();

        return $result;
    }


	function formatDisplayPrice( $showprice, $number, $curformat, $currency, $position, $priceview, $frequency ) {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		$formatted_displayprice = '';

		if ($priceview){
			$thepriceview = stripslashes($priceview);
		} else {
			$thepriceview = "";
		}
		if ($frequency){
			$thefreq = " ".EZRealtyFHelper::convertFrequency ($frequency);
		} else {
			$thefreq = "";
		}

		if ( $ezrparams->get( 'er_currencycontrol' ) == 1 ) {

			if ($curformat==0) {
				$formatted_price = number_format($number);
			} else if ($curformat==1) {
				$formatted_price = number_format($number, 2,",",".");
			} else if ($curformat==2) {
				$formatted_price = number_format($number, 0,",",".");
			} else if ($curformat==3) {
				$formatted_price = number_format($number, 2,".",",");
			} else if ($curformat==4) {
				$formatted_price = number_format($number, 2,","," ");
			}

			if ( !$showprice ) {
				if ( $thepriceview ) {
					$formatted_displayprice = $thepriceview;
				} else {
					$formatted_displayprice = JText::_('EZREALTY_PRICE_NOT_AVAIL');
				}
			} else {
				if ( $position==0 ) {
					$formatted_displayprice = $currency.''.$formatted_price.$thefreq;
				} else {
					$formatted_displayprice = $formatted_price.' '.$currency.$thefreq;
				}
			}

		} else {

			if ($ezrparams->get( 'er_currencyformat' )==0) {
				$formatted_price = number_format($number);
			} else if ($ezrparams->get( 'er_currencyformat' )==1) {
				$formatted_price = number_format($number, 2,",",".");
			} else if ($ezrparams->get( 'er_currencyformat' )==2) {
				$formatted_price = number_format($number, 0,",",".");
			} else if ($ezrparams->get( 'er_currencyformat' )==3) {
				$formatted_price = number_format($number, 2,".",",");
			} else if ($ezrparams->get( 'er_currencyformat' )==4) {
				$formatted_price = number_format($number, 2,","," ");
			}

			if ( !$showprice ) {
				if ( $thepriceview ) {
					$formatted_displayprice = $thepriceview;
				} else {
					$formatted_displayprice = JText::_('EZREALTY_PRICE_NOT_AVAIL');
				}
			} else {
				if ( $ezrparams->get( 'er_currencypos' )==0 ) {
					$formatted_displayprice = $ezrparams->get( 'er_currencysign' ).''.$formatted_price.$thefreq;
				} else {
					$formatted_displayprice = $formatted_price.' '.$ezrparams->get( 'er_currencysign' ).$thefreq;
				}
			}
		}

		return $formatted_displayprice;
	}

	function xmlListingtype ($thetype) {

		$result = '';

		if ( $thetype==1 ) { $result = JText::_('EZREALTY_TYPE_SALE'); }
		if ( $thetype==2 ) { $result = JText::_('EZREALTY_TYPE_RENTAL'); }
		if ( $thetype==3 ) { $result = JText::_('EZREALTY_TYPE_LEASE'); }
		if ( $thetype==4 ) { $result = JText::_('EZREALTY_TYPE_AUCTION'); }
		if ( $thetype==5 ) { $result = JText::_('EZREALTY_TYPE_SWAP'); }
		if ( $thetype==6 ) { $result = JText::_('EZREALTY_TYPE_TENDER'); }

		return $result;

	}

	function xmlConvertArea ($thearea) {

		$params = JComponentHelper::getParams ('com_ezrealty');

		$result = '';

		if ($thearea){

			if ($params->get( 'er_areaunit') == 1){
				$theunit = JText::_('EZREALTY_SEARCH_METERS');
			} else if ($params->get( 'er_areaunit') == 2){
				$theunit = JText::_('EZREALTY_SEARCH_SQFEET');
			} else if ($params->get( 'er_areaunit') == 3){
				$theunit = JText::_('EZREALTY_SEARCH_YARDS');
			} else if ($params->get( 'er_areaunit') == 4){
				$theunit = JText::_('EZREALTY_SEARCH_SQUARES');
			} else {
				$theunit = "";
			}

			$result = stripslashes($thearea)." ".$theunit;
		}

		return $result;

	}



	function getPostcodeById($id) {
		$db = & JFactory::getDBO();

		if(isset($id)) {

			$query="SELECT * FROM #__ezrealty_locality WHERE id = ".intval($id)." order by ordering";
			$db->setQuery( $query );
			$therow = $db->loadObjectList();

			$result = $therow[0]->postcode;

			return $result;

		} else {

			return NULL;

		}
	}


	// POSTCODE RADIUS SEARCH STUFF

	function get_pcodes_in_range ( $pcode, $range ){

		$database = & JFactory::getDBO();

		// returns an array of the postcodes within $range of $pcode. Returns
		// an array with keys as postcodes and values as the distance from
		// the postcode defined in $pcode.

		$in = explode (" ", $pcode);

		$pcode = $in[0];

 		$d = EZRealtyFHelper::get_pcode_point($pcode); // base postcode details
		$details = $d[0];
		$details[0] = $details["declat"];
		$details[1] = $details["declong"];

		if (empty($details)) return;

		// Calculate the minimum and maximum latitude and longitude within a given range
		// to find Max - Min Lat / Long for Radius and zero point and query only postcodes in that range.
		// with reference to code provided by zeb

		$lat_range = $range/69.172;

		$lon_range = abs($range/(cos($details[0]) * 69.172));
		$min_lat = number_format($details[0] - $lat_range, "4", ".", "");
		$max_lat = number_format($details[0] + $lat_range, "4", ".", "");
		$min_lon = number_format($details[1] - $lon_range, "4", ".", "");
		$max_lon = number_format($details[1] + $lon_range, "4", ".", "");

		$return = array();    // declared here for scope

		$sql = 'SELECT postcode, declat, declong FROM #__ezrealty_locality
          WHERE declat BETWEEN '.$min_lat.' AND '.$max_lat.' AND declong BETWEEN '.$min_lon.' AND '.$max_lon;

		$database->setQuery($sql);
		if (!$database->query()) {
			echo $database->stderr();
			return;
		} else {
  			$row = $database->loadRowList();

			foreach ($row as $r) {

				// loop through all postcodes in reference table and determine whether or not it's within the specified range.

				$dist = EZRealtyFHelper::calculate_distance($details[0],$r[1],$details[1],$r[2]);

				if ($dist <= $range) {

					$return[$r[0]] = round($dist, 2);

				}
			}
		}

		return $return;
	}


	function get_pcode_point ( $pcode ) {

		$database = & JFactory::getDBO();

		// This function pulls the lattitude and longitude from the reference table for a given postcode.

		$sql = 'SELECT declat, declong from #__ezrealty_locality WHERE postcode = "' . $pcode . '"';
		$database->setQuery($sql);

		if (!$database->query()) {
			echo $database->stderr();
			return;
		}

		$row = $database->loadAssocList();

		return $row;

	}


	function calculate_distance ($lat1, $lat2, $lon1, $lon2 ) {

		$params = JComponentHelper::getParams ('com_ezrealty');

		if ($params->get( 'er_radius_unit') ){
			$theraddist = $params->get( 'er_radius_unit');
		} else {
			$theraddist = 6378.7;
		}


		// standard mathematical equations to determine the distance between 2 points based on decimal coordinates

		$lat1 = str_replace(",", ".", $lat1);
		$lat2 = str_replace(",", ".", $lat2);
		$lon1 = str_replace(",", ".", $lon1);
		$lon2 = str_replace(",", ".", $lon2);

		// Convert decimal degrees to radians

		$lat1 = deg2rad($lat1);
		$lon1 = deg2rad($lon1);
		$lat2 = deg2rad($lat2);
		$lon2 = deg2rad($lon2);

		// Great Circle Distance Formula using radians:

		//$distance = 3437.74677 (nautical miles)
		//$distance = 6378.7 (kilometers)
		//$distance = 3963.0 (statute miles)


		$distance = $theraddist * acos(sin($lat1) * sin($lat2) + cos($lat1) * cos($lat2) * cos($lon2 - $lon1));

		return $distance;

	}

	function newMailmsg ( $theid ) {

		$app		= JFactory::getApplication();
		$params = JComponentHelper::getParams ('com_ezrealty');

		# Build the message

		$subject= stripslashes ( $params->get( 'er_bizname' ) ) .' '. JText::_('EZREALTY_NEWLISTING_SAVED_SUBJECT');
		$message.=JText::_('EZREALTY_NEWLISTING_SAVED_MESSAGE')."\r\n\r\n";
		$message.=JText::_('EZREALTY_AD_NUMBER')." $theid \r\n ";

		# Send the message

		$mailfrom	= $app->getCfg('mailfrom');
		$fromname	= $app->getCfg('fromname');
		$sitename	= $app->getCfg('sitename');
		$name		= $app->getCfg('sitename');
		$email		= $app->getCfg('mailfrom');
		$subject	= $subject;
		$body		= $message;

		# Prepare email body
		$body	= $name.' <'.$email.'>'."\r\n\r\n".stripslashes($body);

		$mail = JFactory::getMailer();
		$mail->addRecipient($params->get( 'er_bizemail' ));
		$mail->addReplyTo(array($email, $name));
		$mail->setSender(array($mailfrom, $fromname));
		$mail->setSubject($sitename.': '.$subject);
		$mail->setBody($body);
		$sent = $mail->Send();

	}

	function updateMailmsg ( $theid ) {

		$app		= JFactory::getApplication();
		$params = JComponentHelper::getParams ('com_ezrealty');

		# Build the message

		$subject= stripslashes ( $params->get( 'er_bizname' ) ) .' '. JText::_('EZREALTY_UDLISTING_SAVED_SUBJECT');
		$message.=JText::_('EZREALTY_UDLISTING_SAVED_MESSAGE')."\r\n\r\n";
		$message.=JText::_('EZREALTY_AD_NUMBER')." $theid \r\n ";

		# Send the message

		$mailfrom	= $app->getCfg('mailfrom');
		$fromname	= $app->getCfg('fromname');
		$sitename	= $app->getCfg('sitename');
		$name		= $app->getCfg('sitename');
		$email		= $app->getCfg('mailfrom');
		$subject	= $subject;
		$body		= $message;

		# Prepare email body
		$body	= $name.' <'.$email.'>'."\r\n\r\n".stripslashes($body);

		$mail = JFactory::getMailer();
		$mail->addRecipient($params->get( 'er_bizemail' ));
		$mail->addReplyTo(array($email, $name));
		$mail->setSender(array($mailfrom, $fromname));
		$mail->setSubject($sitename.': '.$subject);
		$mail->setBody($body);
		$sent = $mail->Send();

	}



}

?>
