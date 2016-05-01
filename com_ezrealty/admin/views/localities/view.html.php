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

class ezrealtyViewLocalities extends JViewLegacy {

    function display($tpl = null) {
        
		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');

		JToolBarHelper::title( JText::_('COM_EZREALTY_PAGETITLE_LOCALITIES'), 'module.png' );		

		JToolbarHelper::addNew('add');
		JToolbarHelper::editList('edit');
        JToolBarHelper::publishList( 'publish' );
        JToolBarHelper::unpublishList( 'unpublish' );
        JToolBarHelper::custom('checkin', 'checkin.png', 'checkin.png', JText::_('EZREALTY_CHECKIN'), false );
        JToolBarHelper::deleteList( '', 'remove' );
		JToolBarHelper::preferences('com_ezrealty', '550', '875');

		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_PROPERTIES'), 'index.php?option=com_ezrealty');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_CATEGORIES'), 'index.php?option=com_ezrealty&controller=categories');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_LOCALITIES'), 'index.php?option=com_ezrealty&controller=localities', true);
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_STATES'), 'index.php?option=com_ezrealty&controller=states');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_COUNTRYS'), 'index.php?option=com_ezrealty&controller=countrys');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_AGENTS'), 'index.php?option=com_ezrealty&controller=agents');

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
		$mainframe = &JFactory::getApplication();
        $option = $mainframe->scope;
        $document =& JFactory::getDocument();

		$filter_state		= $mainframe->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',				'word' );
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

        $lists['filter_state'] = $filter_state = $state->get( 'filter_state' );         
        $lists['search'] 			= $search 			= $state->get( 'search' );


        if ( $ezrparams->get( 'er_stateloc' ) == 1 ) { 
            $statelist = & $this->get('StateList', 'states');
            $statelist_default_option[] = JHTML::_('select.option',  '0', JText::_('EZREALTY_SORT_ALLSTATES') );
            $statelist = array_merge($statelist_default_option, $statelist);            
            
            $statelist_option = $statelist_default_option;
            if ($statelist){  
				$statelist_option = JHTML::_('select.genericlist',   $statelist, 'filter_state', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_state );
            }
            $lists['statelist'] = $statelist_option;
        } if ( $ezrparams->get( 'er_stateloc' ) == 2 && $ezrparams->get( 'er_country' ) == 1 ) { 
            $countryslist = & $this->get('CountryList', 'countrys');
            $countryslist_default_option[] = JHTML::_('select.option',  '0', JText::_('EZREALTY_SORT_ALLCOUNTRIES') );
            $countryslist = array_merge($countryslist_default_option, $countryslist);            
            
            $countryslist_option = $countryslist_default_option;
            if ($countryslist){  
				$statelist_option = JHTML::_('select.genericlist',   $countryslist, 'filter_state', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_state );
            }
            //Log::debug($countlist_option);
            $lists['statelist'] = $statelist_option;
        }

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

		$locality	=& $this->get('DataById', 'localities');
		$isNew		= ($locality->id < 1);

		$text = $isNew ? JText::_( 'COM_EZREALTY_PAGETITLE_ADD' ) : JText::_( 'COM_EZREALTY_PAGETITLE_EDIT' );
		JToolBarHelper::title(   JText::_( 'COM_EZREALTY_PAGETITLE_LOCALITIES' ).': <small><small>[ ' . $text.' ]</small></small>', 'module.png' );

		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		// Edit or Create?
		if (!$isNew) {

			$model = $this->getModel('localities');
			$model->checkout( $user->get('id') );

		} else {

			// initialise new record
			$locality->published = 1;
			$locality->zoom = 12;

		}

        $lists = array();


        # Build published select list

		$publishit[] = JHTML::_('select.option',  '1', JText::_( 'COM_EZREALTY_PUBLISH' ) );
		$publishit[] = JHTML::_('select.option',  '0', JText::_( 'COM_EZREALTY_UNPUBLISH' ) );

		$lists['published'] 	= JHTML::_('select.genericlist',   $publishit, 'published', 'class="input-medium" size="1"', 'value', 'text', $locality->published );


        # Build language select list

        $langlist = & $this->get('LanguageList');

		$ltypelist[] = JHTML::_('select.option',  '*', JText::_( 'EZREALTY_LANGUAGE_ALL' ) );
        $ltypelist = array_merge( $ltypelist, $langlist );
		$lists['language'] 	= JHTML::_('select.genericlist',   $ltypelist, 'language', 'class="input-medium" size="1"', 'value', 'text', $locality->language );


        # Build Ordering list
        
        $orders =& $this->get('Ordering');   
        $lists['orderlist'] = JHTML::_('select.genericlist', $orders, 'ordering', 'class="input-medium" size="1"', 'value', 'text', intval( $locality->ordering ) );        


        /* Country list */
        
        if ( $ezrparams->get( 'er_stateloc' ) == 1 ) {
            $statelist = & $this->get('StateList', 'states');
            //Log::debug($statelist);die;
            $statelist_default_option[] = JHTML::_('select.option',  '0', JText::_('EZREALTY_DETAILS_SELSTATE') );
            $statelist = array_merge($statelist_default_option, $statelist);            
            
            $statelist_option = $statelist_default_option;
            if ($statelist){  
				$lists['stateid'] 	= JHTML::_('select.genericlist', $statelist, 'stateid', 'class="input-medium" size="1"', 'value', 'text', $locality->stateid );
            }
        }            
        
        /* Country list */
        
        if ( $ezrparams->get( 'er_stateloc' ) == 2 && $ezrparams->get( 'er_country' ) == 1 ) {
            $countlist = & $this->get('CountryList', 'countrys');
            //Log::debug($countlist);die;
            $countlist_default_option[] = JHTML::_('select.option',  '0', JText::_('EZREALTY_DETAILS_SELCOUNTRY') );
            $countlist = array_merge($countlist_default_option, $countlist);            
            
            $countlist_option = $countlist_default_option;
            if ($countlist){  
				$lists['stateid'] 	= JHTML::_('select.genericlist', $countlist, 'stateid', 'class="input-medium" size="1"', 'value', 'text', $locality->stateid );
            }
        }          


        // Imagelist
      
        $javascript 	= 'onchange="changeDisplayImage(this);"';
        $directory 		= '/images';
        $lists['image'] = JHTML::_('list.images', 'image', $locality->image, $javascript, $directory );        


        $this->assignRef( 'lists', $lists );
		$this->assignRef( 'locality', $locality );
		$this->assignRef( 'ezrparams', $ezrparams);

		parent::display($tpl);
    }
    
}
?>