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


class EZRealtyHelper {


/**************************************************\
 BUILD THE MULTISELECT LISTS
\**************************************************/

	function multiSelect($arr_main,$theid,$name,$arr_selected) {
		$return='<select name="'.$name.'" id="'.$theid.'" class="input-large" style="height: 300px;" size="10" multiple="multiple">';
			$return.='<option value="">'.JText::_('EZREALTY_SELECT_MULTIPLE').'</option>';
		foreach($arr_main as $key=>$value) {
			if(is_array($arr_selected)) {
				$selected='';
				foreach($arr_selected as $k=>$v) {
					if($key==$v){
						$selected='selected';
					}
				}
				$return.='<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
			} else {
				if($key==$arr_selected){
					$return.='<option value="'.$key.'" selected>'.$value.'</option>';
				} else {
					$return.='<option value="'.$key.'" >'.$value.'</option>';
				}
			}
		}
		$return.="</select>";
		return $return;
	}


	function categorySelect($arr_main,$theid,$name,$arr_selected) {
		$return='<select name="'.$name.'" id="'.$theid.'" class="input-large required" size="10" multiple="multiple">';
			$return.='<option value="">'.JText::_('EZREALTY_SELECT_MULTIPLE').'</option>';
		foreach($arr_main as $key=>$value) {
			if(is_array($arr_selected)) {
				$selected='';
				foreach($arr_selected as $k=>$v) {
					if($key==$v){
						$selected='selected';
					}
				}
				$return.='<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
			} else {
				if($key==$arr_selected){
					$return.='<option value="'.$key.'" selected>'.$value.'</option>';
				} else {
					$return.='<option value="'.$key.'" >'.$value.'</option>';
				}
			}
		}
		$return.="</select>";
		return $return;
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


	function formatSelectPrice( $number ) {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		$formatted_priceselect = '';

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


		return $formatted_price;
	}



	# check to see if curl is installed on the server so we can use it for mapping when saving a listing to generate coordinates

	function _iscurlinstalled() {
		if  (in_array  ('curl', get_loaded_extensions())) {
			return true;
		} else {
			return false;
		}
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

	function getThePath($id) {
	
		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
		$db = & JFactory::getDBO();
	
		$result = '';
	
	    if(isset($id)) {
	
			$db->setQuery( "SELECT * FROM #__ezrealty_images WHERE propid = $id order by ordering LIMIT 1" );
			$therow = $db->loadObjectList();
			$therow = $therow[0];
	
				if ($therow->fname && $therow->path){ ?>
					<img src="<?php echo $therow->path;?>/<?php echo $therow->fname;?>" class="thumbnail" style="height:70px; width:90px;" alt="<?php echo JText::_('COM_EZREALTY_EDIT'); ?>" />
				<?php } else { ?>
					<img src="<?php echo JURI::root();?>images/ezrealty/properties/th/<?php echo $therow->fname;?>" class="thumbnail" style="height:70px; width:90px;" alt="<?php echo JText::_('COM_EZREALTY_EDIT'); ?>" />
				<?php }
	
	        return $result;
	
		}
	}

	function getMainPath($id) {
	
		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
		$db = & JFactory::getDBO();
	
		$result = '';
	
	    if(isset($id)) {
	
			$db->setQuery( "SELECT * FROM #__ezrealty_images WHERE propid = $id order by ordering LIMIT 1" );
			$therow = $db->loadObjectList();
			$therow = $therow[0];
	
				if ($therow->fname && $therow->path){ ?>
					<img src="<?php echo $therow->path;?>/<?php echo $therow->fname;?>" width="400px" alt="" />
				<?php } else { ?>
					<img src="<?php echo JURI::root();?>images/ezrealty/properties/<?php echo $therow->fname;?>" width="400px" alt="" />
				<?php }
	
	        return $result;
	
		}
	}

	function getTheImage($id) {
		$db = & JFactory::getDBO();
	
	    if(isset($id)) {
	
			$query="SELECT fname AS image FROM #__ezrealty_images as p WHERE p.propid = $id order by ordering LIMIT 1";
	        $db->setQuery( $query );
	        $result = $db->loadResult();
	
	        return $result;
	
		} else {
	
			return NULL;
	
		}
	}



	/************************************************************\
	FUNCTION THAT FINDS THE FIRST CATEGORY SELECTED FOR A PROPERTY
	\************************************************************/
	
	
	function getTheCategory($id) {
		$db = & JFactory::getDBO();
	
	    if(isset($id)) {
	
			$query="SELECT title AS category FROM #__ezrealty_incats as p WHERE p.property_id = $id order by ordering LIMIT 1";
	        $db->setQuery( $query );
	        $result = $db->loadResult();
	
	        return $result;
	
		} else {
	
			return NULL;
	
		}
	}











	function convertPrice ($theprice, $thecurrency, $thecurrencypos) {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		$result = '';

		if ( $ezrparams->get( 'er_currencycontrol' ) == 1 ) {
			if ( $thecurrencypos==0 ) {
				echo $thecurrency.''.$theprice;
			} else {
				echo $theprice.' '.$thecurrency;
			}
		} else {
			if ( $ezrparams->get( 'er_currencypos' )==0 ) {
				echo $ezrparams->get( 'er_currencysign' ).''.$theprice;
			} else {
				echo $theprice.' '.$ezrparams->get( 'er_currencysign' );
			}
		}

		return $result;

	}


	function convertFrequency ($thefreq) {

		$result = '';

		if ( $thefreq==1 ) { echo JText::_('EZREALTY_RENTAL_NIGHTLY'); }
		if ( $thefreq==2 ) { echo JText::_('EZREALTY_RENTAL_WEEKLY'); }
		if ( $thefreq==3 ) { echo JText::_('EZREALTY_RENTAL_FNIGHT'); }
		if ( $thefreq==4 ) { echo JText::_('EZREALTY_RENTAL_MONTH'); }
		if ( $thefreq==5 ) { echo JText::_('EZREALTY_RENTAL_SQFT'); }
		if ( $thefreq==6 ) { echo JText::_('EZREALTY_RENTAL_SQMTR'); }
		if ( $thefreq==7 ) { echo JText::_('EZREALTY_RENTAL_SPARE'); }

		return $result;

	}


    function showFooter( ) {

    ?>
            <table width="100%" border="0">
                <tr>
                    <td>
                        <div align="center"><img src="<?php echo JURI::root(); ?>administrator/components/com_ezrealty/assets/images/logo.png" alt="EZ Realty" /></div>
                        <div align="center"><span class='smalldark'><strong>EZ Realty Version 7.2.0</strong></span></div>
                        <div align="center">By: <a href='http://www.raptorservices.com/' target='_blank'>Kathy Strickland (aka PixelBunyiP)</a></div>
                        <br />
                    </td>
                </tr>
            </table>
    <?php

    }








}
?>