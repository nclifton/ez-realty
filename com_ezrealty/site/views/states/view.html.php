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
 * HTML View class for the component
 *
 */
class EzrealtysViewStates extends JViewLegacy
{
	function display( $tpl = null)
	{

        $user =& JFactory::getUser();
		$document =& JFactory::getDocument();
		$app		= JFactory::getApplication();

		// Get the page/component configuration
		$params = &$app->getParams();

		$states	=& $this->get('data');
		$total		=& $this->get('total');
		$state		=& $this->get('state');

		if ($params->get( 'show_subs_spotlight' )){
			$featured 	= &$this->get('featured');
		}

		$menus		= $app->getMenu();
		$pathway	= $app->getPathway();
		$title 		= null;

		// Get the parameters of the active menu item
		$menu 		= $menus->getActive();


		if ($menu) {
			$params->def('page_heading', $params->get('page_title', $menu->title));
		} else {
			$params->def('page_heading', JText::_('Our Property Suburbs'));
		}

		$title = $params->get('page_title', '');

		if (empty($title)) {
			$title = $app->getCfg('sitename');
		} elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		} elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}

		$this->document->setTitle($title);

		$this->document->setGenerator('EZ Realty - Joomla! Real Estate Management - RaptorServices.com');

		// Set some defaults if not set for params
		$params->def('comp_description', JText::_('Welcome to our online property portal'));


		for($i = 0; $i < count($states); $i++)
		{
			$state =& $states[$i];
			$state->link = JRoute::_(EzrealtyHelperRoute::getStateRoute($state->slug ));

		}

		if ($params->get( 'show_stats_spotlight' )){

			$count3 = count($featured);
			for($i = 0; $i < $count3; $i++)
			{
				$feat =& $featured[$i];
				$feat->link = JRoute::_(EzrealtyHelperRoute::getEzrealtyRoute($feat->slug, '', '', $feat->statslug ));

			}
		}

        $document->addStyleSheet("components/com_ezrealty/assets/style.css",'text/css',"screen");

		if ( $params->get( 'enable_bootstrap' ) ){
			$document->addStyleSheet("components/com_ezrealty/assets/bootstrap.css",'text/css',"screen");
		}

		$this->assignRef('user',		$user);
		$this->assignRef('image',		$image);
		$this->assignRef('params',		$params);
		$this->assignRef('states',		$states);

		if ($params->get( 'show_stats_spotlight' )){
			$this->assignRef('featured',	$featured);
		}

		parent::display($tpl);
	}
}
?>
