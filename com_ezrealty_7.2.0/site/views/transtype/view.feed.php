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
class EzrealtysViewTranstype extends JViewLegacy
{
	function display($tpl = null)
	{
		$app	= JFactory::getApplication();
		$document = JFactory::getDocument();
		$params = $app->getParams();

		$document->link = JRoute::_(EzrealtyHelperRoute::getCategoryRoute(JRequest::getVar('id',null, '', 'int')));

		JRequest::setVar('limit', $app->getCfg('feed_limit'));
		$siteEmail = $app->getCfg('mailfrom');
		$fromName = $app->getCfg('fromname');
		$document->editor = $fromName;
		$document->editorEmail = $siteEmail;

		// Get some data from the model
		$items		=& $this->get( 'data' );
		$transtype	= &$this->get('transtype' );

		$whichinteg		= 0;

		if ( $params->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){
			$whichinteg		= 1;
		}

		foreach ( $items as $item )
		{

			if(!EZRealtyFHelper::getTheImage($item->id) ){
				$image = JURI::root()."components/com_ezrealty/assets/images/nothumb.png";
			} else {
				$image = EZRealtyFHelper::convertFeedImage ($item->id);
			}

			// strip html from feed item title
			$title = $this->escape($item->adline);
			$title = html_entity_decode($title, ENT_COMPAT, 'UTF-8');


		if ( $transtype==1 ) { $transtype = JText::_('EZREALTY_TYPE_SALE'); }
		if ( $transtype==2 ) { $transtype = JText::_('EZREALTY_TYPE_RENTAL'); }
		if ( $transtype==3 ) { $transtype = JText::_('EZREALTY_TYPE_LEASE'); }
		if ( $transtype==4 ) { $transtype = JText::_('EZREALTY_TYPE_AUCTION'); }
		if ( $transtype==5 ) { $transtype = JText::_('EZREALTY_TYPE_SWAP'); }
		if ( $transtype==6 ) { $transtype = JText::_('EZREALTY_TYPE_TENDER'); }
		if ( $transtype==7 ) { $transtype = JText::_('EZREALTY_FEATURED_LISTINGS'); }
		if ( $transtype==8 ) { $transtype = JText::_('EZREALTY_OPENHOUSE_DAYS'); }
		if ( $transtype==9 ) { $transtype = JText::_('EZREALTY_SHOWSOLD'); }


			$catname = $this->escape($transtype);
			$catname = html_entity_decode($catname, ENT_COMPAT, 'UTF-8');

			// url link to the item
			$link = JRoute::_(EzrealtyHelperRoute::getEzrealtyRoute($item->slug, $item->catslug, '', '' ));


			// strip html from feed item description text
			$description	= ($params->get('feed_summary', 0) ? $item->propdesc : $item->smalldesc);
			$author			= $whichinteg ? $item->dealer_name : $params->get( 'er_agent' );
			$feedmail		= $whichinteg ? $item->dealer_email : $params->get( 'er_bizemail' );
			@$date			= ($item->listdate ? date('r', strtotime($item->listdate)) : '');

			// load individual item creator class
			$feeditem = new JFeedItem();
			$feeditem->title 		= $title;
			$feeditem->link 		= $link;
			$feeditem->description 	= "<img src='{$image}' align='left' width='".$params->get( 'er_thumbwidth')."' hspace='10' style='padding-right:10px' />$description";
			$feeditem->date			= $date;
			$feeditem->category   	= $catname;
			$feeditem->author		= $author;
			$feeditem->authorEmail 	= $feedmail;

			// loads item info into rss array
			$document->addItem( $feeditem );
		}
	}
}
?>
