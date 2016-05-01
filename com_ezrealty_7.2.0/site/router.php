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

# Kill error reporting
error_reporting(0);

function EzrealtyBuildRoute(&$query)
{
	$segments = array();

	// get a menu item based on Itemid or currently active

	$app		= JFactory::getApplication();
	$menu		= $app->getMenu();

	if (empty($query['Itemid'])) {
		$menuItem = $menu->getActive();
	} else {
		$menuItem = $menu->getItem($query['Itemid']);
	}

	$mView	= (empty($menuItem->query['view'])) ? null : $menuItem->query['view'];
	$mCid	= (empty($menuItem->query['cid'])) ? null : $menuItem->query['cid'];
	$mSid	= (empty($menuItem->query['sid'])) ? null : $menuItem->query['sid'];
	$mTid	= (empty($menuItem->query['tid'])) ? null : $menuItem->query['tid'];
	$mId	= (empty($menuItem->query['id'])) ? null : $menuItem->query['id'];

	if(isset($query['view']))
	{
		$view = $query['view'];
		if(empty($query['Itemid'])) {
			$segments[] = $query['view'];
		}
		unset($query['view']);
	};

	// are we dealing with a property that is attached to a menu item?
	if (($mView == 'ezrealty') and (isset($query['id'])) and ($mId == intval($query['id']))) {
		unset($query['view']);
		unset($query['cid']);
		unset($query['sid']);
		unset($query['tid']);
		unset($query['id']);
	}

	if (isset($view) and ($view == 'categories' && !empty($query['Itemid']))) {
		if (($mView != 'categories') or ($mView == 'categories')) {
			$segments[] = 'categories';
			unset($query['Itemid']);
		}
	}

	if (isset($view) and ($view == 'suburbs' && !empty($query['Itemid']))) {
		if (($mView != 'suburbs') or ($mView == 'suburbs')) {
			$segments[] = 'suburbs';
			unset($query['Itemid']);
		}
	}

	if (isset($view) and ($view == 'states' && !empty($query['Itemid']))) {
		if (($mView != 'states') or ($mView == 'states')) {
			$segments[] = 'states';
			unset($query['Itemid']);
		}
	}

	if (isset($view) and $view == 'category') {
		if ($mId != intval($query['id']) || $mView != $view) {
			$segments[] = $query['id'];
		}
		unset($query['id']);
	}

	if (isset($view) and $view == 'suburb') {
		if ($mId != intval($query['id']) || $mView != $view) {
			$segments[] = $query['id'];
		}
		unset($query['id']);
	}

	if (isset($view) and $view == 'state') {
		if ($mId != intval($query['id']) || $mView != $view) {
			$segments[] = $query['id'];
		}
		unset($query['id']);
	}

	if (isset($query['cid'])) {
		// if we are routing a property or category where the category id matches the menu cid, don't include the category segment
		if ((($view == 'ezrealty') and ($mView != 'category') and ($mView != 'ezrealty') and ($mCid != intval($query['cid'])))) {
			$segments[] = $query['cid'];
		}
		unset($query['cid']);
	};

	if (isset($query['sid'])) {
		// if we are routing a property or suburb where the suburb id matches the menu sid, don't include the suburb segment
		if ((($view == 'ezrealty') and ($mView != 'suburb') and ($mView != 'ezrealty') and ($mSid != intval($query['sid'])))) {
			$segments[] = $query['sid'];
		}
		unset($query['sid']);
	};

	if (isset($query['tid'])) {
		// if we are routing a property or state where the state id matches the menu tid, don't include the state segment
		if ((($view == 'ezrealty') and ($mView != 'state') and ($mView != 'ezrealty') and ($mTid != intval($query['tid'])))) {
			$segments[] = $query['tid'];
		}
		unset($query['tid']);
	};

	if(isset($query['id'])) {
		if (empty($query['Itemid'])) {
			$segments[] = $query['id'];
		} else {
			if (isset($menuItem->query['id'])) {
				if($query['id'] != $mId) {
					$segments[] = $query['id'];
				}
			} else {
				$segments[] = $query['id'];
			}
		}
		unset($query['id']);
	};


	return $segments;
}

function EzrealtyParseRoute($segments)
{
	$vars = array();

	//Get the active menu item
	$menu =& JSite::getMenu();
	$item =& $menu->getActive();

	// Count route segments
	$count = count($segments);

	//Standard routing for ezrealtys
	if(!isset($item))
	{
		$vars['view']  = $segments[0];
		$vars['id']    = $segments[$count - 1];
		return $vars;
	}

	//Handle View and Identifier
	switch($item->query['view'])
	{
		case 'categories' :
		{
			if($count == 1) {
				$vars['view'] = 'category';
			}

			if($count == 2) {
				$vars['view']  = 'ezrealty';
				$vars['cid'] = $segments[$count-2];
			}

			$vars['id']    = $segments[$count-1];

		} break;

		case 'category'   :
		{
			$vars['id']   = $segments[$count-1];
			$vars['view'] = 'ezrealty';

		} break;

		case 'suburbs' :
		{
			if($count == 1) {
				$vars['view'] = 'suburb';
			}

			if($count == 2) {
				$vars['view']  = 'ezrealty';
				$vars['sid'] = $segments[$count-2];
			}

			$vars['id']    = $segments[$count-1];

		} break;

		case 'suburb'   :
		{
			$vars['id']   = $segments[$count-1];
			$vars['view'] = 'ezrealty';

		} break;

		case 'states' :
		{
			if($count == 1) {
				$vars['view'] = 'state';
			}

			if($count == 2) {
				$vars['view']  = 'ezrealty';
				$vars['tid'] = $segments[$count-2];
			}

			$vars['id']    = $segments[$count-1];

		} break;

		case 'state'   :
		{
			$vars['id']   = $segments[$count-1];
			$vars['view'] = 'ezrealty';

		} break;

		case 'shortlist'   :
		{
			$vars['id']   = $segments[$count-1];
			$vars['view'] = 'ezrealty';

		} break;

		case 'transtype'   :
		{
			$vars['id']   = $segments[$count-1];
			$vars['view'] = 'ezrealty';

		} break;


		case 'ezrealty' :
		{
			$vars['id']	  = $segments[$count-1];
			$vars['view'] = 'ezrealty';
		} break;

	}

	return $vars;
}
?>