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

// Import Joomla! libraries
jimport( 'joomla.application.component.view');

class ezrealtyViewAgents extends JViewLegacy {

    function display($tpl = null) {

		$params 	= JComponentHelper::getParams ('com_ezrealty');
		$mainframe = &JFactory::getApplication();
        $option = $mainframe->scope;
        $document =& JFactory::getDocument();

		// Get data from the model
		$items		= & $this->get( 'Data');
		$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );


		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');

		JToolBarHelper::title( JText::_('COM_EZREALTY_PAGETITLE_AGENTS'), 'groups.png' );		


        JToolBarHelper::addNew('add');
        JToolBarHelper::editList('edit');
        JToolBarHelper::publishList( 'publish' );
        JToolBarHelper::unpublishList( 'unpublish' );
        JToolBarHelper::custom('checkin', 'checkin.png', 'checkin.png', JText::_('EZREALTY_CHECKIN'), false );
        JToolBarHelper::deleteList( '', 'remove' );


		JToolBarHelper::preferences('com_ezrealty', '550', '875');

		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_PROPERTIES'), 'index.php?option=com_ezrealty');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_CATEGORIES'), 'index.php?option=com_ezrealty&controller=categories');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_LOCALITIES'), 'index.php?option=com_ezrealty&controller=localities');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_STATES'), 'index.php?option=com_ezrealty&controller=states');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_COUNTRYS'), 'index.php?option=com_ezrealty&controller=countrys');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_AGENTS'), 'index.php?option=com_ezrealty&controller=agents', true);

		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'word' );

		$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );


        $state =& $this->get('state');      



		// table ordering
        $lists['filter_category'] = $filter_category = $state->get( 'filter_category' );         
        $lists['search'] = $search = $state->get( 'search' );
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;


		$this->sidebar = JHtmlSidebar::render();
        $this->assignRef( 'params', $params );
        $this->assignRef( 'lists', $lists );        
        $this->assignRef( 'items', $items );
		$this->assignRef( 'pagination', $pagination);            


        parent::display($tpl);
    }


	function edit($tpl = null) {

    	$user 	=& JFactory::getUser();
		$params 	= JComponentHelper::getParams ('com_ezrealty');

		$profile	=& $this->get('DataById');
		$isNew	= ($profile->id < 1);

		$text = $isNew ? JText::_( 'COM_EZREALTY_PAGETITLE_ADD' ) : JText::_( 'COM_EZREALTY_PAGETITLE_EDIT' );
		JToolBarHelper::title(   JText::_( 'COM_EZREALTY_PAGETITLE_AGENTS' ).': <small><small>[ ' . $text.' ]</small></small>', 'groups.png' );


		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			JToolBarHelper::cancel( 'cancel', JText::_( 'Close' ) );
		}


        $lists = array();


		// Edit or Create?
		if (!$isNew)
		{
			$model = $this->getModel('agents');
			$model->checkout( $user->get('id') );

		}
		else
		{
			// initialise new record
			$profile->published = 1;
			$profile->show_addy = 1;
			$profile->calcown = 0;
			$profile->seller_unlimited = 0;
			$profile->publish_own = 0;
			$profile->featured = 0;
			$profile->cid = 0;
		}


        # Build published select list

		$publishit[] = JHTML::_('select.option',  '1', JText::_( 'EZREALTY_PUB' ) );
		$publishit[] = JHTML::_('select.option',  '0', JText::_('EZREALTY_UNPUB') );

		$lists['published'] 	= JHTML::_('select.genericlist',   $publishit, 'published', 'class="input-medium" size="1"', 'value', 'text', $profile->published );



	// Build seller Profile select list

		$userlist = & $this->get('UserList');
		$sellerlist[] = JHTML::_('select.option',  '0', JText::_('COM_EZREALTY_SELECT_AGENT' ) );
		if ($userlist) {
			$sellerlist = array_merge( $sellerlist, $userlist );
		}
		$lists['uid'] = JHTML::_('select.genericlist',   $sellerlist, 'uid', 'class="input-medium" size="1"','value', 'text', $profile->uid);



	// get Ordering list

		$orders =& $this->get('Ordering');        
		$lists['orderlist'] = JHTML::_('select.genericlist', $orders, 'ordering', 'class="input-medium" size="1"', 'value', 'text', intval( $profile->ordering ) );        



        $this->assignRef( 'lists', $lists );
        $this->assignRef( 'params', $params );
		$this->assignRef( 'profile', $profile );

		parent::display($tpl);
    }
    
}
?>