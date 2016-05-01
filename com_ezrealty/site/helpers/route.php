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

// Component Helper
jimport('joomla.application.component.helper');

/**
 * EZ Realty Component Route Helper
 *
 * @static
 * @package	EZ Realty
 */
class EzrealtyHelperRoute
{
	/**
	 * @param	int	The route of the ezrealtys item
	 */
	function getEzrealtyRoute($id, $cid, $sid, $tid)
	{

		$app		= JFactory::getApplication();
		$menus		= $app->getMenu();

		$needles = array(
			'ezrealty'  => (int) $id,
			'category' => (int) $cid,
			'suburb' => (int) $sid,
			'state' => (int) $tid,
		);

		//Create the link
		$link = 'index.php?option=com_ezrealty&view=ezrealty&id='. $id;

		if($cid) {
			$link .= '&cid='.$cid;
		}
		if($sid) {
			$link .= '&sid='.$sid;
		}
		if($tid) {
			$link .= '&tid='.$tid;
		}

		if($item = EzrealtyHelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item->id;
		};

		return $link;
	}

	function getCategoryRoute($cid)
	{
		$needles = array(
			'category' => (int) $cid,
			'categories' => null
		);

		//Create the link
		$link = 'index.php?option=com_ezrealty&view=category&id='.$cid;

		if($item = EzrealtyHelperRoute::_findItem($needles)) {
			if(isset($item->query['layout'])) {
				$link .= '&layout='.$item->query['layout'];
			}
			$link .= '&Itemid='.$item->id;
		};

		return $link;
	}

	function getSuburbRoute($sid)
	{
		$needles = array(
			'suburb' => (int) $sid,
			'suburbs' => null
		);

		//Create the link
		$link = 'index.php?option=com_ezrealty&view=suburb&id='.$sid;

		if($item = EzrealtyHelperRoute::_findItem($needles)) {
			if(isset($item->query['layout'])) {
				$link .= '&layout='.$item->query['layout'];
			}
			$link .= '&Itemid='.$item->id;
		};

		return $link;
	}

	function getStateRoute($tid)
	{
		$needles = array(
			'state' => (int) $tid,
			'states' => null
		);

		//Create the link
		$link = 'index.php?option=com_ezrealty&view=state&id='.$tid;

		if($item = EzrealtyHelperRoute::_findItem($needles)) {
			if(isset($item->query['layout'])) {
				$link .= '&layout='.$item->query['layout'];
			}
			$link .= '&Itemid='.$item->id;
		};

		return $link;
	}

	function _findItem($needles)
	{

		$app		= JFactory::getApplication();
		$menus		= $app->getMenu('site');

			$component	= JComponentHelper::getComponent('com_ezrealty');
			$items		= $menus->getItems('component_id', $component->id);

		$match = null;

		foreach($needles as $needle => $id)
		{
			foreach($items as $item)
			{
				if ((@$item->query['view'] == $needle) && (@$item->query['id'] == $id)) {
					$match = $item;
					break;
				}
			}

			if(isset($match)) {
				break;
			}
		}

		return $match;
	}
}
?>
