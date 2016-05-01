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

class ezrealtyViewCategories extends JViewLegacy {

    function display($tpl = null) {

		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');

		JToolBarHelper::title( JText::_('COM_EZREALTY_PAGETITLE_CATEGORIES'), 'banners-categories.png' );		

		JToolbarHelper::addNew('add');
		JToolbarHelper::editList('edit');
        JToolBarHelper::publishList( 'publish' );
        JToolBarHelper::unpublishList( 'unpublish' );
        JToolBarHelper::custom('checkin', 'checkin.png', 'checkin.png', JText::_('EZREALTY_CHECKIN'), false );
        JToolBarHelper::deleteList( '', 'remove' );
		JToolBarHelper::preferences('com_ezrealty', '550', '875');

		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_PROPERTIES'), 'index.php?option=com_ezrealty');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_CATEGORIES'), 'index.php?option=com_ezrealty&controller=categories', true);
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_LOCALITIES'), 'index.php?option=com_ezrealty&controller=localities');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_STATES'), 'index.php?option=com_ezrealty&controller=states');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_COUNTRYS'), 'index.php?option=com_ezrealty&controller=countrys');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_AGENTS'), 'index.php?option=com_ezrealty&controller=agents');

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
		$mainframe = &JFactory::getApplication();
        $option = $mainframe->scope;
        $document =& JFactory::getDocument();

		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'word' );

		$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );

		// Get data from the model
		$items		= & $this->get( 'Data');
		$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );

        $state =& $this->get('state');      

		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;

        $lists['search'] 			= $search 			= $state->get( 'search' );

		JHtmlSidebar::setAction('index.php?option=com_ezrealty');

		$this->sidebar = JHtmlSidebar::render();
        $this->assignRef( 'lists', $lists );        
        $this->assignRef( 'items', $items );
		$this->assignRef( 'pagination', $pagination);            
		$this->assignRef( 'ezrparams',	$ezrparams);

        parent::display($tpl);
    }
    
    function edit($tpl = null) {

		$user 		=& JFactory::getUser();
        $document 	=& JFactory::getDocument();
		$ezrparams 	= JComponentHelper::getParams ('com_ezrealty');

        // get item

		$category	=& $this->get('DataById');
		$isNew		= ($category->id < 1);

		$text = $isNew ? JText::_( 'COM_EZREALTY_PAGETITLE_ADD' ) : JText::_( 'COM_EZREALTY_PAGETITLE_EDIT' );
		JToolBarHelper::title(   JText::_( 'COM_EZREALTY_PAGETITLE_CATEGORIES' ).': <small><small>[ ' . $text.' ]</small></small>', 'banners-categories.png' );

		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		// Edit or Create?
		if (!$isNew) {

			$model = $this->getModel('categories');
			$model->checkout( $user->get('id') );

		} else {

			// initialise new record
			$category->published = 1;

		}

        $lists = array();


        # Build published select list

		$publishit[] = JHTML::_('select.option',  '1', JText::_( 'COM_EZREALTY_PUBLISH' ) );
		$publishit[] = JHTML::_('select.option',  '0', JText::_( 'COM_EZREALTY_UNPUBLISH' ) );

		$lists['published'] 	= JHTML::_('select.genericlist',   $publishit, 'published', 'class="input-medium" size="1"', 'value', 'text', $category->published );


        # Build language select list

        $langlist = & $this->get('LanguageList');

		$ltypelist[] = JHTML::_('select.option',  '*', JText::_( 'EZREALTY_LANGUAGE_ALL' ) );
        $ltypelist = array_merge( $ltypelist, $langlist );
		$lists['language'] 	= JHTML::_('select.genericlist',   $ltypelist, 'language', 'class="input-medium" size="1"', 'value', 'text', $category->language );


        # Build Ordering list
        
        $orders =& $this->get('Ordering');   
        $lists['orderlist'] = JHTML::_('select.genericlist', $orders, 'ordering', 'class="input-medium" size="1"', 'value', 'text', intval( $category->ordering ) );        


        # Build groups select list

        $groupslist = & $this->get('GroupsList');        
        //Log::debug($groupslist); die;
        $glist = JHTML::_('select.genericlist', $groupslist, 'access', 'class="input-medium" size="1"', 'value', 'text', intval( $category->access ) );    
        $this->assignRef('glist', $glist);  


        // Imagelist
      
        $javascript 	= 'onchange="changeDisplayImage(this);"';
        $directory 		= '/images';
        $lists['image'] = JHTML::_('list.images', 'image', $category->image, $javascript, $directory );        

       
        $this->assignRef( 'lists', $lists );
		$this->assignRef('category', $category);    

		parent::display($tpl);
    }


}
?>