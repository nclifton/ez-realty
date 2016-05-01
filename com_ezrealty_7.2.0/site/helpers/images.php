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
class EzRealtyImagesHelper {



	function checkForImagexml($id, $order) {
		$db = & JFactory::getDBO();

		$result = '';

		if(isset($id)) {

			$query="SELECT * FROM #__ezrealty_images as p WHERE p.propid = $id AND p.ordering = '$order' LIMIT 1";
			$db->setQuery( $query );
			$result = $db->loadResult();

			return $result;

		}
	}

	function getImageUrlxml ($id, $order) {

		$params = JComponentHelper::getParams ('com_ezrealty');

		$db = & JFactory::getDBO();

		$result = '';

		if(isset($id)) {

			$db->setQuery( "SELECT * FROM #__ezrealty_images WHERE propid = $id AND ordering = $order LIMIT 1" );
			$therow = $db->loadObjectList();
			$therow = $therow[0];

			if ($therow->fname && $therow->path){
				$result = $therow->path;
			} else {

				$result = JURI::root()."images/ezrealty/properties/".$therow->fname;
			}

			return $result;
		}
	}



}

?>
