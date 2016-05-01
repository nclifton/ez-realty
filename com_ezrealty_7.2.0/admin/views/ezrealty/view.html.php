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

class ezrealtyViewEzrealty extends JViewLegacy {

    function display($tpl = null) {

		$app = &JFactory::getApplication();
        $option 	= $app->scope;
        $document 	=& JFactory::getDocument();
		$ezrparams 	= JComponentHelper::getParams ('com_ezrealty');
		$db			= &JFactory::getDBO();

		
		// Get data from the model
		$items		= & $this->get( 'Data');
		$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );


		# check whether an upgrade or migration needs to be done
		$checktest = EZRealtyMigrationHelper::migrationStatus();
		$upgradecheck = EZRealtyUpgradesHelper::upgradeStatus();


		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');

        JToolBarHelper::title( JText::_('COM_EZREALTY_PAGETITLE_PROPERTIES'), 'thememanager' );


	if($checktest && $upgradecheck){

		$thetitle = JText::_('EZREALTY_PDF_STOCK_LIST');
		$bar->appendButton( 'Popup', 'pdfselect', $thetitle, 'index.php?option=com_ezrealty&task=pdfselect', '800', '700' );


		JToolbarHelper::addNew('add');
		JToolbarHelper::editList('edit');
        JToolBarHelper::custom('copy', 'copy.png', 'copy_f2.png', JText::_('EZREALTY_COPY_ITEM'), false );
        JToolBarHelper::publishList( 'publish' );
        JToolBarHelper::unpublishList( 'unpublish' );
        JToolBarHelper::custom('checkin', 'checkin.png', 'checkin.png', JText::_('EZREALTY_CHECKIN'), false );
        JToolBarHelper::deleteList( '', 'remove' );
        JToolBarHelper::custom('cleanfiles', 'trash.png', 'trash_f2.png', JText::_('EZREALTY_DELETE_ORPHAN'), false );
        JToolBarHelper::custom('cleandb', 'trash.png', 'trash_f2.png', JText::_('EZREALTY_CPANEL_CLEANLIST'), false );
        JToolBarHelper::custom('prunelightbox', 'trash.png', 'trash_f2.png', JText::_('EZREALTY_CPANEL_PRUNE'), false );
        JToolBarHelper::custom('optimizetables', 'checkbox.png', 'checkbox_f2.png', JText::_('EZREALTY_OPTIMIZE'), false );
        JToolBarHelper::custom('quickRegenerate', 'refresh.png', 'refresh_f2.png', JText::_('EZREALTY_REGENERATE'), false );

		JToolBarHelper::preferences('com_ezrealty', '550', '875');

	} else {

		// check whether there's any data which needs to be migrated, or whether the tables need to be upgraded - and show the necessary buttons
		if(!$checktest){
			JToolBarHelper::custom('doMigration', 'archive.png', 'archive_f2.png', JText::_('EZREALTY_MIGRATE_DATA'), false );
		} else {
			if(!$upgradecheck){
				JToolBarHelper::custom('updateTables', 'archive.png', 'archive_f2.png', JText::_('EZREALTY_CPANEL_UPGRADE'), false );
			}
		}

	}


		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_PROPERTIES'), 'index.php?option=com_ezrealty', true );
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_CATEGORIES'), 'index.php?option=com_ezrealty&controller=categories');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_LOCALITIES'), 'index.php?option=com_ezrealty&controller=localities');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_STATES'), 'index.php?option=com_ezrealty&controller=states');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_COUNTRYS'), 'index.php?option=com_ezrealty&controller=countrys');
		JHtmlSidebar::addEntry(JText::_('COM_EZREALTY_SUBMENU_AGENTS'), 'index.php?option=com_ezrealty&controller=agents');

		// define the necessary image directories

		$dirname1 = JPATH_SITE."/images/ezrealty";
		$dirname2 = JPATH_SITE."/images/ezrealty/pdfs"; 
		$dirname3 = JPATH_SITE."/images/ezrealty/panorama"; 
		$dirname4 = JPATH_SITE."/images/ezrealty/epc"; 
		$dirname5 = JPATH_SITE."/images/ezrealty/floorplans"; 
		$dirname7 = JPATH_SITE."/images/ezrealty/properties"; 
		$dirname8 = JPATH_SITE."/images/ezrealty/properties/th"; 

		// create the image directories if they don't exist

		if(!file_exists($dirname1)) {
			mkdir($dirname1,0777,true);
		}
		if(!file_exists($dirname2)) {
			mkdir($dirname2,0777,true);
		}
		if(!file_exists($dirname3)) {
			mkdir($dirname3,0777,true);
		}
		if(!file_exists($dirname4)) {
			mkdir($dirname4,0777,true);
		}
		if(!file_exists($dirname5)) {
			mkdir($dirname5,0777,true);
		}
		if(!file_exists($dirname7)) {
			mkdir($dirname7,0777,true);
		}
		if(!file_exists($dirname8)) {
			mkdir($dirname8,0777,true);
		}

		// define the necessary image directories

		$dirname9 = JPATH_SITE."/images/ezportal"; 
		$dirname10 = JPATH_SITE."/images/ezportal/avatar"; 
		$dirname11 = JPATH_SITE."/images/ezportal/banner"; 
		$dirname12 = JPATH_SITE."/images/ezportal/logo"; 
		$dirname13 = JPATH_SITE."/images/ezportal/pdf"; 

		// create the image directories if they don't exist

		if(!file_exists($dirname9)) {
			mkdir($dirname9,0777,true);
		}
		if(!file_exists($dirname10)) {
			mkdir($dirname10,0777,true);
		}
		if(!file_exists($dirname11)) {
			mkdir($dirname11,0777,true);
		}
		if(!file_exists($dirname12)) {
			mkdir($dirname12,0777,true);
		}
		if(!file_exists($dirname13)) {
			mkdir($dirname13,0777,true);
		}


		$filter_published	= $app->getUserStateFromRequest( $option.'filter_published',	'filter_published',	'',				'word' );
		$filter_state		= $app->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',				'word' );
		$filter_category	= $app->getUserStateFromRequest( $option.'filter_category',	'filter_category',	'',				'word' );
		$filter_type		= $app->getUserStateFromRequest( $option.'filter_type',		'filter_type',		'',				'word' );
		$filter_sold		= $app->getUserStateFromRequest( $option.'filter_sold',		'filter_sold',		'',				'word' );
		$filter_street		= $app->getUserStateFromRequest( $option.'filter_street',		'filter_street',	'',				'word' );
		$filter_locality	= $app->getUserStateFromRequest( $option.'filter_locality',	'filter_locality',	'',				'word' );
		$filter_country		= $app->getUserStateFromRequest( $option.'filter_country',	'filter_country',	'',				'word' );
		$filter_seller		= $app->getUserStateFromRequest( $option.'filter_seller',		'filter_seller',	'',				'word' );
		$search				= $app->getUserStateFromRequest( $option.'search',			'search',			'',				'word' );


		$filter_order		= $app->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.id desc',	'cmd' );
		$filter_order_Dir	= $app->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );


        $state =& $this->get('state');      


		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;

        $lists['filter_published'] 	= $filter_published = $state->get( 'filter_published' );         
        $lists['filter_state'] 		= $filter_state 	= $state->get( 'filter_state' );         
        $lists['filter_category'] 	= $filter_category 	= $state->get( 'filter_category' );
        $lists['filter_type'] 		= $filter_type 		= $state->get( 'filter_type' );
        $lists['filter_sold'] 		= $filter_sold 		= $state->get( 'filter_sold' );
        $lists['filter_street'] 	= $filter_street 	= $state->get( 'filter_street' );
        $lists['filter_locality'] 	= $filter_locality 	= $state->get( 'filter_locality' );
        $lists['filter_country'] 	= $filter_country 	= $state->get( 'filter_country' );
        $lists['filter_seller'] 	= $filter_seller 	= $state->get( 'filter_seller' );
        $lists['search'] 			= $search 			= $state->get( 'search' );




        // get list of streets for the dropdown filter
        if ($ezrparams->get('er_filterstreet')) {

            $streetlist = & $this->get('StreetListID');
			$streets[] = JHTML::_('select.option',  '', JText::_( 'EZREALTY_FILTER_ALLSTREETS' ) );
            $streets = array_merge( $streets, $streetlist );
			$lists['street'] 	= JHTML::_('select.genericlist',   $streets, 'filter_street', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_street );
        }

        // get list of Property Categories for the dropdown filter
        if ($ezrparams->get( 'er_filtercid' )) {

            $categorylist = & $this->get('CategoryList', 'categories');
			$categorys[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_LISTINGS_SORTTYPEALL' ) );
            $categorys = array_merge( $categorys, $categorylist );
			$lists['cid'] 	= JHTML::_('select.genericlist',   $categorys, 'filter_category', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_category );
        }

        // get list of Agent/seller Profiles for the dropdown filter

		if ($ezrparams->get( 'er_filterseller' )) {
			$profilelist = & $this->get('ProfileList', 'ezrealty');
			$sellers[] = JHTML::_('select.option',  '0', JText::_( 'COM_EZREALTY_ALL_AGENTS' ) );
			$sellers = array_merge( $sellers, $profilelist );
			$lists['seller'] 	= JHTML::_('select.genericlist',   $sellers, 'filter_seller', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_seller );
		}

		if (!$filter_country){
			$cnid = '0';
		} else {
			$cnid = $filter_country;
		}

		if (!$filter_state){
			$stid = '0';
		} else {
			$stid = $filter_state;
		}


	# Build the Country/State/Locality chained selector list

        if ( $ezrparams->get( 'er_filtercount' ) && $ezrparams->get( 'er_filterstate' ) && $ezrparams->get( 'er_filterloc' ) ) {

            $countrylist = & $this->get('CountryFiltList', 'countrys');
			$countrys[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_SORT_ALLCOUNTRIES' ) );
            $countrys = array_merge( $countrys, $countrylist );
			$lists['cnid'] 	= JHTML::_('select.genericlist',   $countrys, 'filter_country', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_country );


        // get list of States for the dropdown filter

			$whichdata1 = "dd.published = 1 AND dd.countid=".$cnid;

			if ($ezrparams->get('deflistorder') == 1) {
				$orderby 	= ' ORDER BY dd.name';
			} else {
				$orderby 	= ' ORDER BY dd.ordering';
			}

			$sql = 'SELECT dd.id AS value, dd.name AS text' .
			' FROM #__ezrealty_state AS dd' .
			' LEFT JOIN #__ezrealty_country AS e ON e.id = dd.countid ' .
			' WHERE '.$whichdata1 .'
			'.$orderby;

			$db->setQuery($sql);
			if (!$db->query()) {
				echo $db->stderr();
				return;
			}
			$states[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_SORT_ALLSTATES' ) );
			$states = array_merge( $states, $db->loadObjectList() );
			$lists['stid'] 	= JHTML::_('select.genericlist',   $states, 'filter_state', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_state );

        // get list of Localities for the dropdown filter

			$whichdata2 = "cc.published = 1 AND cc.stateid=".$stid;

			if ($ezrparams->get('deflistorder') == 1) {
				$orderby 	= ' ORDER BY cc.ezcity';
			} else {
				$orderby 	= ' ORDER BY cc.ordering';
			}

			$sql = 'SELECT cc.id AS value, cc.ezcity AS text' .
			' FROM #__ezrealty_locality AS cc' .
			' LEFT JOIN #__ezrealty_state AS s ON s.id = cc.stateid ' .
			' WHERE '.$whichdata2 .'
			'.$orderby;

			$db->setQuery($sql);
			if (!$db->query()) {
				echo $db->stderr();
				return;
			}
			$localitys[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_LISTINGS_SORTLOCALL' ) );
			$localitys = array_merge( $localitys, $db->loadObjectList() );
			$lists['locid'] 	= JHTML::_('select.genericlist',   $localitys, 'filter_locality', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_locality );

		}


	# Build the State/Locality chained selector list

        if ( !$ezrparams->get( 'er_filtercount' ) && $ezrparams->get( 'er_filterstate' ) && $ezrparams->get( 'er_filterloc' ) ) {

        // get list of States for the dropdown filter

            $statelist = & $this->get('StateFiltList', 'states');
			$states[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_SORT_ALLSTATES' ) );
            $states = array_merge( $states, $statelist );
			$lists['stid'] 	= JHTML::_('select.genericlist',   $states, 'filter_state', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_state );

        // get list of Localities for the dropdown filter

			$whichdata3 = "cc.published = 1 AND cc.stateid=".$stid;

			if ($ezrparams->get('deflistorder') == 1) {
				$orderby 	= ' ORDER BY cc.ezcity';
			} else {
				$orderby 	= ' ORDER BY cc.ordering';
			}

			$sql = 'SELECT cc.id AS value, cc.ezcity AS text' .
			' FROM #__ezrealty_locality AS cc' .
			' LEFT JOIN #__ezrealty_state AS s ON s.id = cc.stateid ' .
			' WHERE '.$whichdata3 .'
			'.$orderby;

			$db->setQuery($sql);
			if (!$db->query()) {
				echo $db->stderr();
				return;
			}
			$localitys[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_LISTINGS_SORTLOCALL' ) );
			$localitys = array_merge( $localitys, $db->loadObjectList() );
			$lists['locid'] 	= JHTML::_('select.genericlist',   $localitys, 'filter_locality', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_locality );

        }


	# Build the Country/Locality chained selector list

        if ( $ezrparams->get( 'er_filtercount' ) && !$ezrparams->get( 'er_filterstate' ) && $ezrparams->get( 'er_filterloc' ) ) {

            $countrylist = & $this->get('CountryFiltList', 'countrys');
			$countrys[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_SORT_ALLCOUNTRIES' ) );
            $countrys = array_merge( $countrys, $countrylist );
			$lists['cnid'] 	= JHTML::_('select.genericlist',   $countrys, 'filter_country', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_country );

            # get list of Localities for the dropdown filter

			$whichlang4 = "cc.published = 1 AND cc.stateid=".$cnid;

			if ($ezrparams->get('deflistorder') == 1) {
				$orderby 	= ' ORDER BY cc.ezcity';
			} else {
				$orderby 	= ' ORDER BY cc.ordering';
			}

			$sql = 'SELECT cc.id AS value, cc.ezcity AS text' .
			' FROM #__ezrealty_locality AS cc' .
			' LEFT JOIN #__ezrealty_country AS s ON s.id = cc.stateid ' .
			' WHERE '.$whichlang4 .'
			'.$orderby;

			$db->setQuery($sql);
			if (!$db->query()) {
				echo $db->stderr();
				return;
			}
			$localitys[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_LISTINGS_SORTLOCALL' ) );
			$localitys = array_merge( $localitys, $db->loadObjectList() );
			$lists['locid'] 	= JHTML::_('select.genericlist',   $localitys, 'filter_locality', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_locality );

        }


	# Build individual Locality select list

        if ( !$ezrparams->get( 'er_filtercount' ) && !$ezrparams->get( 'er_filterstate' ) && $ezrparams->get( 'er_filterloc' ) ) {

            $localitylist = & $this->get('LocalityFiltList', 'localities');
			$localitys[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_LISTINGS_SORTLOCALL' ) );
            $localitys = array_merge( $localitys, $localitylist );
			$lists['locid'] 	= JHTML::_('select.genericlist',   $localitys, 'filter_locality', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_locality );
        }


            # Build Market Status select list

		if ( $ezrparams->get( 'er_usemarket' ) ) {

			$soldit[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_SEARCH_ANYMARKET' ) );
            if ( $ezrparams->get( 'er_usemarket1' ) ) {
				$soldit[] = JHTML::_('select.option',  '1', JText::_( 'EZREALTY_DETAILS_MARKET1' ) );
            }
            if ( $ezrparams->get( 'er_usemarket2' ) ) {
				$soldit[] = JHTML::_('select.option',  '2', JText::_( 'EZREALTY_DETAILS_MARKET2' ) );
            }
            if ( $ezrparams->get( 'er_usemarket3' ) ) {
				$soldit[] = JHTML::_('select.option',  '3', JText::_( 'EZREALTY_DETAILS_MARKET3' ) );
            }
            if ( $ezrparams->get( 'er_usemarket4' ) ) {
				$soldit[] = JHTML::_('select.option',  '4', JText::_( 'EZREALTY_DETAILS_MARKET4' ) );
            }
            if ( $ezrparams->get( 'er_usemarket5' ) ) {
				$soldit[] = JHTML::_('select.option',  '5', JText::_( 'EZREALTY_DETAILS_MARKET5' ) );
            }
            if ( $ezrparams->get( 'er_usemarket9' ) ) {
				$soldit[] = JHTML::_('select.option',  '9', JText::_( 'EZREALTY_DETAILS_MARKET9' ) );
            }
            if ( $ezrparams->get( 'er_usemarket6' ) ) {
				$soldit[] = JHTML::_('select.option',  '6', JText::_( 'EZREALTY_DETAILS_MARKET6' ) );
            }
            if ( $ezrparams->get( 'er_usemarket7' ) ) {
				$soldit[] = JHTML::_('select.option',  '7', JText::_( 'EZREALTY_DETAILS_MARKET7' ) );
            }
            if ( $ezrparams->get( 'er_usemarket8' ) ) {
				$soldit[] = JHTML::_('select.option',  '8', JText::_( 'EZREALTY_DETAILS_MARKET8' ) );
            }
            if ( $ezrparams->get( 'er_usemarket10' ) ) {
				$soldit[] = JHTML::_('select.option',  '10', JText::_( 'EZREALTY_DETAILS_MARKET10' ) );
            }

			$lists['sold'] 	= JHTML::_('select.genericlist',   $soldit, 'filter_sold', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_sold );
		}


        // Build property type select list

        if ($ezrparams->get( 'er_filtertype' )) {
			$typeit[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_TYPE_ALL' ) );
            if ( $ezrparams->get( 'er_usetype1' ) ) {
				$typeit[] = JHTML::_('select.option',  '1', JText::_( 'EZREALTY_TYPE_SALE' ) );
            }
            if ( $ezrparams->get( 'er_usetype2' ) ) {
				$typeit[] = JHTML::_('select.option',  '2', JText::_( 'EZREALTY_TYPE_RENTAL' ) );
            }
            if ( $ezrparams->get( 'er_usetype3' ) ) {
				$typeit[] = JHTML::_('select.option',  '3', JText::_( 'EZREALTY_TYPE_LEASE' ) );
            }
            if ( $ezrparams->get( 'er_usetype4' ) ) {
				$typeit[] = JHTML::_('select.option',  '4', JText::_( 'EZREALTY_TYPE_AUCTION' ) );
            }
            if ( $ezrparams->get( 'er_usetype5' ) ) {
				$typeit[] = JHTML::_('select.option',  '5', JText::_( 'EZREALTY_TYPE_SWAP' ) );
            }
            if ( $ezrparams->get( 'er_usetype6' ) ) {
				$typeit[] = JHTML::_('select.option',  '6', JText::_( 'EZREALTY_TYPE_TENDER' ) );
            }
            if ( $ezrparams->get( 'er_usetype7' ) ) {
				$typeit[] = JHTML::_('select.option',  '7', JText::_( 'EZREALTY_TYPE_SHARE' ) );
            }

			$lists['type'] 	= JHTML::_('select.genericlist',   $typeit, 'filter_type', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_type );
        }



        // Build published status select list

			$pubstatus[] = JHTML::_('select.option',  '', JText::_( 'EZREALTY_SEARCH_ANYPUBLISHED' ) );
			$pubstatus[] = JHTML::_('select.option',  'P', JText::_( 'EZREALTY_PUB' ) );
			$pubstatus[] = JHTML::_('select.option',  'U', JText::_( 'EZREALTY_UNPUB' ) );

			$lists['published'] 	= JHTML::_('select.genericlist',   $pubstatus, 'filter_published', 'class="input-xlarge" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_published );



		if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){
			$ezpparams = JComponentHelper::getParams ('com_ezportal');
			$this->assignRef( 'ezpparams', $ezpparams );
		}



		$this->sidebar = JHtmlSidebar::render();
        $this->assignRef( 'lists', $lists );        
        $this->assignRef( 'items', $items );
		$this->assignRef( 'pagination', $pagination);            
		$this->assignRef( 'ezrparams',	$ezrparams);

        $this->assignRef( 'checktest', $checktest );        
        $this->assignRef( 'upgradecheck', $upgradecheck );        

        parent::display($tpl);


    }



    function edit($tpl = null) {

		$user 		=& JFactory::getUser();
        $document 	=& JFactory::getDocument();
        $db = & JFactory::getDBO();

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){
			$ezpparams = JComponentHelper::getParams ('com_ezportal');
		}

        // get item

        $property	=& $this->get('DataById');
        $isNew	= ($property->id < 1);

		$text = $isNew ? JText::_( 'COM_EZREALTY_PAGETITLE_ADD' ) : JText::_( 'COM_EZREALTY_PAGETITLE_EDIT' );
        JToolBarHelper::title(   JText::_( 'COM_EZREALTY_PAGETITLE_PROPERTIES' ).': <small><small>[ ' . $text.' ]</small></small>', 'thememanager' );

		if ($isNew) {
			JToolBarHelper::cancel();
		} else {
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

        $cnid = 0;
        $stid = 0;

		// Edit or Create?
		if (!$isNew) {

			$model = $this->getModel('ezrealty');
			$model->checkout( $user->get('id') );

            $cnid = $property->cnid;
            $stid = $property->stid;

		} else {

			// initialise new record
			$property->showprice='1';
			$property->viewbooking='0';
			$property->published='1';
			$property->viewad='1';
			$property->owncoords='0';
			$property->schoolprof='0';
			$property->hoodprof='0';
			$property->soleAgency='0';
			$property->listdate = date("Y-m-d");

		}


        $lists = array();


        if ( $cnid == 0 ) {
            $where = "\n WHERE c.countid NOT LIKE '%com_%'";
        } else {
            $where = "\n WHERE c.published = 1 AND c.countid='$cnid'";
        }

        if ( $stid == 0 ) {
            $where2 = "\n WHERE p.stateid NOT LIKE '%com_%'";
        } else {
            $where2 = "\n WHERE p.published = 1 AND p.stateid='$stid'";
        }

        if ( $cnid == 0 ) {
            $where3 = "\n WHERE p.stateid NOT LIKE '%com_%'";
        } else {
            $where3 = "\n WHERE p.published = 1 AND p.stateid='$cnid'";
        }


		if ( $ezrparams->get( 'er_usefrequit' ) ) {

            # Build rental frequency select list

			$freqit[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_RENTAL_NA' ) );
            if ( $ezrparams->get( 'er_usefrequit1' ) ) {
				$freqit[] = JHTML::_('select.option',  '1', JText::_( 'EZREALTY_RENTAL_NIGHTLY' ) );
            }
            if ( $ezrparams->get( 'er_usefrequit2' ) ) {
				$freqit[] = JHTML::_('select.option',  '2', JText::_( 'EZREALTY_RENTAL_WEEKLY' ) );
            }
            if ( $ezrparams->get( 'er_usefrequit3' ) ) {
				$freqit[] = JHTML::_('select.option',  '3', JText::_( 'EZREALTY_RENTAL_FNIGHT' ) );
            }
            if ( $ezrparams->get( 'er_usefrequit4' ) ) {
				$freqit[] = JHTML::_('select.option',  '4', JText::_( 'EZREALTY_RENTAL_MONTH' ) );
            }
            if ( $ezrparams->get( 'er_usefrequit5' ) ) {
				$freqit[] = JHTML::_('select.option',  '5', JText::_( 'EZREALTY_RENTAL_SQFT' ) );
            }
            if ( $ezrparams->get( 'er_usefrequit6' ) ) {
				$freqit[] = JHTML::_('select.option',  '6', JText::_( 'EZREALTY_RENTAL_SQMTR' ) );
            }
            if ( $ezrparams->get( 'er_usefrequit7' ) ) {
				$freqit[] = JHTML::_('select.option',  '7', JText::_( 'EZREALTY_RENTAL_SPARE' ) );
            }

			$lists['freq'] 	= JHTML::_('select.genericlist',   $freqit, 'freq', 'class="input-large" size="1"', 'value', 'text', $property->freq );
		}


        # Build property type select list

			//$typeit[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_LISTING_SELECTTYPE' ) );
            if ( $ezrparams->get( 'er_usetype1' ) ) {
				$typeit[] = JHTML::_('select.option',  '1', JText::_( 'EZREALTY_TYPE_SALE' ) );
            }
            if ( $ezrparams->get( 'er_usetype2' ) ) {
				$typeit[] = JHTML::_('select.option',  '2', JText::_( 'EZREALTY_TYPE_RENTAL' ) );
            }
            if ( $ezrparams->get( 'er_usetype3' ) ) {
				$typeit[] = JHTML::_('select.option',  '3', JText::_( 'EZREALTY_TYPE_LEASE' ) );
            }
            if ( $ezrparams->get( 'er_usetype4' ) ) {
				$typeit[] = JHTML::_('select.option',  '4', JText::_( 'EZREALTY_TYPE_AUCTION' ) );
            }
            if ( $ezrparams->get( 'er_usetype5' ) ) {
				$typeit[] = JHTML::_('select.option',  '5', JText::_( 'EZREALTY_TYPE_SWAP' ) );
            }
            if ( $ezrparams->get( 'er_usetype6' ) ) {
				$typeit[] = JHTML::_('select.option',  '6', JText::_( 'EZREALTY_TYPE_TENDER' ) );
            }
            if ( $ezrparams->get( 'er_usetype7' ) ) {
				$typeit[] = JHTML::_('select.option',  '7', JText::_( 'EZREALTY_TYPE_SHARE' ) );
            }

			$lists['type'] 	= JHTML::_('select.genericlist',   $typeit, 'type', 'class="input-large required" size="1"', 'value', 'text', $property->type );



            # Build Market Status select list

		if ( $ezrparams->get( 'er_usemarket' ) ) {

			//$soldit[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_DETAILS_MARKET' ) );
            if ( $ezrparams->get( 'er_usemarket1' ) ) {
				$soldit[] = JHTML::_('select.option',  '1', JText::_( 'EZREALTY_DETAILS_MARKET1' ) );
            }
            if ( $ezrparams->get( 'er_usemarket2' ) ) {
				$soldit[] = JHTML::_('select.option',  '2', JText::_( 'EZREALTY_DETAILS_MARKET2' ) );
            }
            if ( $ezrparams->get( 'er_usemarket3' ) ) {
				$soldit[] = JHTML::_('select.option',  '3', JText::_( 'EZREALTY_DETAILS_MARKET3' ) );
            }
            if ( $ezrparams->get( 'er_usemarket4' ) ) {
				$soldit[] = JHTML::_('select.option',  '4', JText::_( 'EZREALTY_DETAILS_MARKET4' ) );
            }
            if ( $ezrparams->get( 'er_usemarket5' ) ) {
				$soldit[] = JHTML::_('select.option',  '5', JText::_( 'EZREALTY_DETAILS_MARKET5' ) );
            }
            if ( $ezrparams->get( 'er_usemarket9' ) ) {
				$soldit[] = JHTML::_('select.option',  '9', JText::_( 'EZREALTY_DETAILS_MARKET9' ) );
            }
            if ( $ezrparams->get( 'er_usemarket6' ) ) {
				$soldit[] = JHTML::_('select.option',  '6', JText::_( 'EZREALTY_DETAILS_MARKET6' ) );
            }
            if ( $ezrparams->get( 'er_usemarket7' ) ) {
				$soldit[] = JHTML::_('select.option',  '7', JText::_( 'EZREALTY_DETAILS_MARKET7' ) );
            }
            if ( $ezrparams->get( 'er_usemarket8' ) ) {
				$soldit[] = JHTML::_('select.option',  '8', JText::_( 'EZREALTY_DETAILS_MARKET8' ) );
            }

            if ( $ezrparams->get( 'er_usemarket10' ) ) {
				$soldit[] = JHTML::_('select.option',  '10', JText::_( 'EZREALTY_DETAILS_MARKET10' ) );
            }


			$lists['sold'] 	= JHTML::_('select.genericlist',   $soldit, 'sold', 'class="input-large required" size="1"', 'value', 'text', $property->sold );
		}


        if ( $ezrparams->get( 'er_stateloc' ) == 1 && $ezrparams->get( 'er_country' ) == 1 ) {

            # Build the City/State/Locality chained selector list


            $javascript = "onchange=\"changeDynaList( 'stid', countstates, document.adminForm.cnid.options[document.adminForm.cnid.selectedIndex].value, 0, 0);\"";
            $javascript2 = "onchange=\"changeDynaList( 'locid', statelocs, document.adminForm.stid.options[document.adminForm.stid.selectedIndex].value, 0, 0);\"";

            $countrys = & $this->get('CountryList', 'countrys');

            if ( $cnid == 0 ) {
                if ($countrys) {
                    array_unshift ($countrys, JHTML::_('select.option', '0', JText::_('EZREALTY_DETAILS_SELCOUNTRY')));
                } else {
                    $countrys[] = JHTML::_('select.option', '0', JText::_('EZREALTY_ADD_COUNTS_FIRST'));
                }
                $lists['cnid'] = JHTML::_('select.genericlist', $countrys, 'cnid', 'class="input-large required" size="1" '. $javascript, 'value', 'text' );
            } else {
                $lists['cnid'] = JHTML::_('select.genericlist', $countrys, 'cnid', 'class="input-large required" size="1" '. $javascript, 'value', 'text', intval( $property->cnid));
            }

            $state_model = & $this->getModel('states');
            $states = & $state_model->getStateList();

            if ( $stid == 0 ) {
                if ($states) {
                    array_unshift ($states, JHTML::_('select.option', '0', JText::_('EZREALTY_DETAILS_SELSTATE')));
                } else {
                    $states[] = JHTML::_('select.option', '0', JText::_('EZREALTY_ADD_STATES_FIRST'));
                }
                $lists['stid'] = JHTML::_('select.genericlist', $states, 'stid', 'class="input-large required" size="1" '. $javascript2, 'value', 'text' );
            } else {
                $lists['stid'] = JHTML::_('select.genericlist', $states, 'stid', 'class="input-large required" size="1" '. $javascript2, 'value', 'text', intval( $property->stid));
            }
            $countstates 		= array();
            $countstates[-1] 	= array();
            $countstates[-1][] 	= JHTML::_('select.option', '0', JText::_('EZREALTY_DETAILS_SELSTATE'));


//SHOWS ON NEW FORM ONCE A COUNTRY HAS BEEN SELECTED

			if ($countrys) foreach($countrys as $countid) {
                    $countstates[$countid->value] = array();

                    $propertys2 = & $state_model->getStateListByCountID($countid->value);

                    if ($propertys2) $countstates[$countid->value][] = JHTML::_('select.option', '0', JText::_('EZREALTY_DETAILS_SELSTATE'));

                    if ($propertys2) foreach($propertys2 as $property2) $countstates[$countid->value][] = JHTML::_('select.option', $property2->value, $property2->text );
                    else $countstates[$countid->value][] = JHTML::_('select.option', "0", JText::_('EZREALTY_NO_STATES_AVAIL'));
                    $lists['countstates'] = $countstates;
			}

            // get list of states



            // do the localities

            $statelocs 		= array();
            $statelocs[-1] 	= array();
            $statelocs[-1][] 	= JHTML::_('select.option', '0', JText::_('EZREALTY_DETAILS_SELLOC'));

            if ($states) foreach($states as $stateid) {
                    $statelocs[$stateid->value] = array();

                    $locality_model = & $this->getModel('localities');
                    $propertys3 = $locality_model->getLocalityListByStateID($stateid->value);

                    if ($propertys3) $statelocs[$stateid->value][] = JHTML::_('select.option', '0', JText::_('EZREALTY_DETAILS_SELLOC'));

                    if ($propertys3) foreach($propertys3 as $property3) $statelocs[$stateid->value][] = JHTML::_('select.option', $property3->value, $property3->text );
                    else $statelocs[$stateid->value][] = JHTML::_('select.option', "0", JText::_('EZREALTY_NO_LOCS_AVAIL'));
                    $lists['statelocs'] = $statelocs;
                }

            // get list of localities

            if ( !$property->locid && !$property->stid ) {
                $locs[] 		= JHTML::_('select.option', '0', JText::_('EZREALTY_DETAILS_SELLOC'));
                $lists['locid'] = JHTML::_('select.genericlist', $locs, 'locid', 'class="input-large required" size="1"', 'value', 'text' );
            } else {

                $locality_model = & $this->getModel('localities');
                $localitylist = $locality_model->getLocalityListWhere($where2);

                $locs[] 		= JHTML::_('select.option', '0', JText::_('EZREALTY_DETAILS_SELLOC'));
                $locs 		= array_merge( $locs, $localitylist );
                $lists['locid'] = JHTML::_('select.genericlist', $locs, 'locid', 'class="input-large required" size="1"', 'value', 'text', intval( $property->locid ) );
            }
        }


        if ( $ezrparams->get( 'er_stateloc' ) == 1 && !$ezrparams->get( 'er_country' ) ) {

            # Build the State/Locality chained selector list

            $javascript2 = "onchange=\"changeDynaList( 'locid', statelocs, document.adminForm.stid.options[document.adminForm.stid.selectedIndex].value, 0, 0);\"";

            $states = $this->get('StateList', 'states');

            if ( $stid == 0 ) {
                if ($states) {
                    array_unshift ($states, JHTML::_('select.option', '0', JText::_('EZREALTY_DETAILS_SELSTATE')));
                } else {
                    $states[] = JHTML::_('select.option', '0', JText::_('EZREALTY_ADD_STATES_FIRST'));
                }
                $lists['stid'] = JHTML::_('select.genericlist', $states, 'stid', 'class="input-large required" size="1" '. $javascript2, 'value', 'text' );
            } else {
                $lists['stid'] = JHTML::_('select.genericlist', $states, 'stid', 'class="input-large required" size="1" '. $javascript2, 'value', 'text', intval( $property->stid));
            }

            $statelocs 		= array();
            $statelocs[-1] 	= array();
            $statelocs[-1][] 	= JHTML::_('select.option', "0", JText::_('EZREALTY_DETAILS_SELLOC'));

            if ($states) foreach($states as $stateid) {
                    $statelocs[$stateid->value] = array();

                    $locality_model = & $this->getModel('localities');
                    $propertys3 = $locality_model->getLocalityListByStateID($stateid->value);

                    if ($propertys3) $statelocs[$stateid->value][] = JHTML::_('select.option', '0', JText::_('EZREALTY_DETAILS_SELLOC'));

                    if ($propertys3) foreach($propertys3 as $property3) $statelocs[$stateid->value][] = JHTML::_('select.option', $property3->value, $property3->text );
                    else $statelocs[$stateid->value][] = JHTML::_('select.option', "0", JText::_('EZREALTY_NO_LOCS_AVAIL'));
                    $lists['statelocs'] = $statelocs;
                }

            // get list of localities

            if ( !$property->locid && !$property->stid ) {
                $locs[] 		= JHTML::_('select.option', "0", JText::_('EZREALTY_DETAILS_SELLOC'));
                $lists['locid'] = JHTML::_('select.genericlist', $locs, 'locid', 'class="input-large required" size="1"', 'value', 'text' );
            } else {

                $locality_model = & $this->getModel('localities');
                $localitylist = $locality_model->getLocalityListWhere($where2);

                $locs[] 		= JHTML::_('select.option', '0', JText::_('EZREALTY_DETAILS_SELLOC'));
                $locs 		= array_merge( $locs, $localitylist );
                $lists['locid'] = JHTML::_('select.genericlist', $locs, 'locid', 'class="input-large required" size="1"', 'value', 'text', intval( $property->locid ) );
            }
        }


        if ( $ezrparams->get( 'er_country' ) && $ezrparams->get( 'er_stateloc' ) == 2 ) {

            # Build the Country/Locality chained selector list

            $javascript2 = "onchange=\"changeDynaList( 'locid', statelocs, document.adminForm.cnid.options[document.adminForm.cnid.selectedIndex].value, 0, 0);\"";

            $states = $this->get('CountryList', 'countrys');

            if ( $cnid == 0 ) {
                if ($states) {
                    array_unshift ($states, JHTML::_('select.option', '0', JText::_('EZREALTY_DETAILS_SELCOUNTRY')));
                } else {
                    $states[] = JHTML::_('select.option', '0', JText::_('EZREALTY_ADD_COUNTS_FIRST'));
                }
                $lists['cnid'] = JHTML::_('select.genericlist', $states, 'cnid', 'class="input-large required" size="1" '. $javascript2, 'value', 'text' );
            } else {
                $lists['cnid'] = JHTML::_('select.genericlist', $states, 'cnid', 'class="input-large required" size="1" '. $javascript2, 'value', 'text', intval( $property->cnid));
            }

            $statelocs 		= array();
            $statelocs[-1] 	= array();
            $statelocs[-1][] 	= JHTML::_('select.option', "0", JText::_('EZREALTY_DETAILS_SELLOC'));

            if ($states) foreach($states as $stateid) {
                    $statelocs[$stateid->value] = array();

                    $locality_model = & $this->getModel('localities');
                    $propertys3 = $locality_model->getLocalityListByStateID($stateid->value);

                    if ($propertys3) $statelocs[$stateid->value][] = JHTML::_('select.option', '0', JText::_('EZREALTY_DETAILS_SELLOC'));

                    if ($propertys3) foreach($propertys3 as $property3) $statelocs[$stateid->value][] = JHTML::_('select.option', $property3->value, $property3->text );
                    else $statelocs[$stateid->value][] = JHTML::_('select.option', "0", JText::_('EZREALTY_NO_LOCS_AVAIL'));
                    $lists['statelocs'] = $statelocs;
                }

            // get list of localities

            if ( !$property->locid && !$property->cnid ) {
                $locs[] 		= JHTML::_('select.option', "0", JText::_('EZREALTY_DETAILS_SELLOC'));
                $lists['locid'] = JHTML::_('select.genericlist', $locs, 'locid', 'class="input-large required" size="1"', 'value', 'text' );
            } else {

                $locality_model = & $this->getModel('localities');
                $localitylist = $locality_model->getLocalityListWhere($where3);

                $locs[] 		= JHTML::_('select.option', '0', JText::_('EZREALTY_DETAILS_SELLOC'));
                $locs 		= array_merge( $locs, $localitylist );
                $lists['locid'] = JHTML::_('select.genericlist', $locs, 'locid', 'class="input-large required" size="1"', 'value', 'text', intval( $property->locid ) );
            }
        }


        if ( $ezrparams->get( 'er_stateloc' ) == 2 && !$ezrparams->get( 'er_country' ) ) {

            # Build individual Locality select list

            $locality_model = & $this->getModel('localities');
            $localitylist = $locality_model->getLocalityPublishedList();

            $loclist[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_DETAILS_SELLOC' ) );
            $loclist = array_merge( $loclist, $localitylist );
            $lists['locid'] = JHTML::_('select.genericlist',   $loclist, 'locid', 'class="input-large required" size="1"','value', 'text', $property->locid);

        }


 # Build multiselect Property category select list


        if ($ezrparams->get('deflistorder') == 1) {
			$catorderby 	= ' d.name';
		} else {
			$catorderby 	= ' d.ordering';
		}


	$selected_category[]=0;

	$sql	= "SELECT d.id as value, d.name as text FROM #__ezrealty_catg AS d WHERE d.published=1 ORDER by $catorderby";
	$db->setQuery($sql);
	if (!$db->query()) {
		echo $db->stderr();
		return;
	}

	$ptypelist = $db->loadObjectList();
	$db->setQuery("select * from #__ezrealty_incats where property_id='$property->id'");
	$selected_categorys=$db->loadObjectList();
	foreach ($selected_categorys as $selected_catetgory)
		{
		$selected_category[]=$selected_catetgory->category_id;
		}
	
	if($db->loadResult()==0){$selected_catetgory=0;}
	foreach($ptypelist as $ptypelists)
		{
		$category_id[$ptypelists->value]=$ptypelists->text;
		}
	$lists['cid'] = EZRealtyHelper::categorySelect($category_id,'cid','cid[]',$selected_category);





if ( $ezrparams->get( 'appliancefeats' ) && $ezrparams->get( 'use_appliancefeats' ) ){

        # Build appliances select list

		$query = "SELECT appliances from #__ezrealty"
		. "\n WHERE id='$property->id'"
		;
		$db->setQuery( $query );
		$myappliances = $db->loadResult();

		$myappliances2  = explode(";",$myappliances);

		foreach($myappliances2 as $myappliance2) {
			$myappliance2;
		}
	
		if($db->loadResult()==0){$myappliance2=0;}

		if ( $ezrparams->get( 'appliancefeats' ) ) {
			$tpay = str_replace( "\r\n", "", $ezrparams->get( 'appliancefeats' ) );
			$somePays = explode(";",$tpay);

			for($i = 0; $i < count($somePays)-1; $i++){
				$appliance[$somePays[$i]]=$somePays[$i];
			}
		}

		$lists['appliances'] = EZRealtyHelper::multiSelect($appliance,'appliances','appliances[]',$myappliances2);

}
if ( $ezrparams->get( 'indoorfeats' ) && $ezrparams->get( 'use_indoorfeats' ) ){

        # Build indoor features select list

		$query = "SELECT indoorfeatures from #__ezrealty"
		. "\n WHERE id='$property->id'"
		;
		$db->setQuery( $query );
		$myindoorfeatures = $db->loadResult();

		$myindoorfeatures2  = explode(";",$myindoorfeatures);

		foreach($myindoorfeatures2 as $myindoorfeature2) {
			$myindoorfeature2;
		}
	
		if($db->loadResult()==0){$myindoorfeature2=0;}

		if ( $ezrparams->get( 'indoorfeats' ) ) {
			$tpay = str_replace( "\r\n", "", $ezrparams->get( 'indoorfeats' ) );
			$somePays = explode(";",$tpay);

			for($i = 0; $i < count($somePays)-1; $i++){
				$indoorfeature[$somePays[$i]]=$somePays[$i];
			}
		}

		$lists['indoorfeatures'] = EZRealtyHelper::multiSelect($indoorfeature,'indoorfeatures','indoorfeatures[]',$myindoorfeatures2);

}
if ( $ezrparams->get( 'outdoorfeats' ) && $ezrparams->get( 'use_outdoorfeats' ) ){

        # Build outdoor features select list

		$query = "SELECT outdoorfeatures from #__ezrealty"
		. "\n WHERE id='$property->id'"
		;
		$db->setQuery( $query );
		$myoutdoorfeatures = $db->loadResult();

		$myoutdoorfeatures2  = explode(";",$myoutdoorfeatures);

		foreach($myoutdoorfeatures2 as $myoutdoorfeature2) {
			$myoutdoorfeature2;
		}
	
		if($db->loadResult()==0){$myoutdoorfeature2=0;}

		if ( $ezrparams->get( 'outdoorfeats' ) ) {
			$tpay = str_replace( "\r\n", "", $ezrparams->get( 'outdoorfeats' ) );
			$somePays = explode(";",$tpay);

			for($i = 0; $i < count($somePays)-1; $i++){
				$outdoorfeature[$somePays[$i]]=$somePays[$i];
			}
		}

		$lists['outdoorfeatures'] = EZRealtyHelper::multiSelect($outdoorfeature,'outdoorfeatures','outdoorfeatures[]',$myoutdoorfeatures2);

}
if ( $ezrparams->get( 'buildingfeats' ) && $ezrparams->get( 'use_buildingfeats' ) ){

        # Build building features select list

		$query = "SELECT buildingfeatures from #__ezrealty"
		. "\n WHERE id='$property->id'"
		;
		$db->setQuery( $query );
		$mybuildingfeatures = $db->loadResult();

		$mybuildingfeatures2  = explode(";",$mybuildingfeatures);

		foreach($mybuildingfeatures2 as $mybuildingfeature2) {
			$mybuildingfeature2;
		}
	
		if($db->loadResult()==0){$mybuildingfeature2=0;}

		if ( $ezrparams->get( 'buildingfeats' ) ) {
			$tpay = str_replace( "\r\n", "", $ezrparams->get( 'buildingfeats' ) );
			$somePays = explode(";",$tpay);

			for($i = 0; $i < count($somePays)-1; $i++){
				$buildingfeature[$somePays[$i]]=$somePays[$i];
			}
		}

		$lists['buildingfeatures'] = EZRealtyHelper::multiSelect($buildingfeature,'buildingfeatures','buildingfeatures[]',$mybuildingfeatures2);

}
if ( $ezrparams->get( 'communityfeats' ) && $ezrparams->get( 'use_communityfeats' ) ){

        # Build community features select list

		$query = "SELECT communityfeatures from #__ezrealty"
		. "\n WHERE id='$property->id'"
		;
		$db->setQuery( $query );
		$mycommunityfeatures = $db->loadResult();

		$mycommunityfeatures2  = explode(";",$mycommunityfeatures);

		foreach($mycommunityfeatures2 as $mycommunityfeature2) {
			$mycommunityfeature2;
		}
	
		if($db->loadResult()==0){$mycommunityfeature2=0;}

		if ( $ezrparams->get( 'communityfeats' ) ) {
			$tpay = str_replace( "\r\n", "", $ezrparams->get( 'communityfeats' ) );
			$somePays = explode(";",$tpay);

			for($i = 0; $i < count($somePays)-1; $i++){
				$communityfeature[$somePays[$i]]=$somePays[$i];
			}
		}

		$lists['communityfeatures'] = EZRealtyHelper::multiSelect($communityfeature,'communityfeatures','communityfeatures[]',$mycommunityfeatures2);

}
if ( $ezrparams->get( 'otherfeats' ) && $ezrparams->get( 'use_otherfeats' ) ){

        # Build other features select list

		$query = "SELECT otherfeatures from #__ezrealty"
		. "\n WHERE id='$property->id'"
		;
		$db->setQuery( $query );
		$myotherfeatures = $db->loadResult();

		$myotherfeatures2  = explode(";",$myotherfeatures);

		foreach($myotherfeatures2 as $myotherfeature2) {
			$myotherfeature2;
		}
	
		if($db->loadResult()==0){$myotherfeature2=0;}

		if ( $ezrparams->get( 'otherfeats' ) ) {
			$tpay = str_replace( "\r\n", "", $ezrparams->get( 'otherfeats' ) );
			$somePays = explode(";",$tpay);

			for($i = 0; $i < count($somePays)-1; $i++){
				$otherfeature[$somePays[$i]]=$somePays[$i];
			}
		}

		$lists['otherfeatures'] = EZRealtyHelper::multiSelect($otherfeature,'otherfeatures','otherfeatures[]',$myotherfeatures2);

}

if ($ezrparams->get( 'er_maxrooms')) {

        # Build Bed Number select list

		$bedlist = array();
		$bedlist[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_DETAILS_SELROOM' ) );
		if ($ezrparams->get( 'er_usecouch')) {
			$bedlist[] = JHTML::_('select.option',  '-2', JText::_( 'EZREALTY_COUCH' ) );
		}
		if ($ezrparams->get( 'er_usestudio')) {
			$bedlist[] = JHTML::_('select.option',  '-1', JText::_( 'EZREALTY_STUDIO' ) );
		}

		for($i=1;$i< $ezrparams->get( 'er_maxrooms')+1;$i++){
			$bedlist[] = JHTML::_('select.option',$i , $i);

            //$bedlist[] = JHTML::_('select.option', $i . '.0', $i . '');
            //$bedlist[] = JHTML::_('select.option', $i . '.5', $i . '.5');

		}
  	
		$lists['bedrooms'] = JHTML::_('select.genericlist', $bedlist, 'bedrooms', 'class="input-large" size="1"','value', 'text', $property->bedrooms);

}

		if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){
			if ( $ezpparams->get( 'paid_listings' ) == 1 ){

	        # Build paid campaigns select list

	        $campaignlist = & $this->get('Campaigns');

			$cctypelist[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_DETAILS_FREESTATUS' ) );
	        $cctypelist = array_merge( $cctypelist, $campaignlist );
			$lists['camtype'] 	= JHTML::_('select.genericlist',   $cctypelist, 'camtype', 'class="span12" size="1"', 'value', 'text', $property->camtype );
			}
		}


        if ($ezrparams->get( 'er_currencycontrol' ) == 1) {

            // currency settings

			$cpos[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_CONFIG_BEFORE' ) );
			$cpos[] = JHTML::_('select.option',  '1', JText::_( 'EZREALTY_CONFIG_AFTER' ) );
			$lists['currency_position'] 	= JHTML::_('select.genericlist',   $cpos, 'currency_position', 'class="span12" size="1"', 'value', 'text', $property->currency_position );

			$currencyformat[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_CONFIG_DECIMAL' ) );
			$currencyformat[] = JHTML::_('select.option',  '3', JText::_( 'EZREALTY_CONFIG_DECIMAL2' ) );
			$currencyformat[] = JHTML::_('select.option',  '1', JText::_( 'EZREALTY_CONFIG_EUROPEAN' ) );
			$currencyformat[] = JHTML::_('select.option',  '2', JText::_( 'EZREALTY_CONFIG_BRAZILIAN' ) );
			$currencyformat[] = JHTML::_('select.option',  '4', JText::_( 'EZREALTY_CONFIG_SLOVAK' ) );
			$lists['currency_format'] 	= JHTML::_('select.genericlist',   $currencyformat, 'currency_format', 'class="span12" size="1"', 'value', 'text', $property->currency_format );

        }


        if ($ezrparams->get( 'er_userenttype' ) == 1) {

			$rentype[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_NA' ) );
			$rentype[] = JHTML::_('select.option',  '1', JText::_( 'EZREALTY_RENTYPE_LONG' ) );
			$rentype[] = JHTML::_('select.option',  '2', JText::_( 'EZREALTY_RENTYPE_SHORT' ) );
			$rentype[] = JHTML::_('select.option',  '3', JText::_( 'EZREALTY_RENTYPE_STUDENT' ) );
			$rentype[] = JHTML::_('select.option',  '4', JText::_( 'EZREALTY_RENTYPE_COMMERCIAL' ) );
			$lists['rent_type'] 	= JHTML::_('select.genericlist',   $rentype, 'rent_type', 'class="input-large" size="1"', 'value', 'text', $property->rent_type );

        }


        $listtimes = array();
        for($i=0;$i<24;$i++) {
            $listtimes[] = JHTML::_('select.option', (strlen($i) < 2 ? '0'.$i : $i) . ':00:00', $i . ':00');
            $listtimes[] = JHTML::_('select.option', (strlen($i) < 2 ? '0'.$i : $i) . ':15:00', $i . ':15');
            $listtimes[] = JHTML::_('select.option', (strlen($i) < 2 ? '0'.$i : $i) . ':30:00', $i . ':30');
            $listtimes[] = JHTML::_('select.option', (strlen($i) < 2 ? '0'.$i : $i) . ':45:00', $i . ':45');
        }

		$lists['ohstarttime'] 	= JHTML::_('select.genericlist',   $listtimes, 'ohstarttime', 'class="input-large" size="1"', 'value', 'text', $property->ohstarttime );
		$lists['ohendtime'] 	= JHTML::_('select.genericlist',   $listtimes, 'ohendtime', 'class="input-large" size="1"', 'value', 'text', $property->ohendtime );
		$lists['ohstarttime2'] 	= JHTML::_('select.genericlist',   $listtimes, 'ohstarttime2', 'class="input-large" size="1"', 'value', 'text', $property->ohstarttime2 );
		$lists['ohendtime2'] 	= JHTML::_('select.genericlist',   $listtimes, 'ohendtime2', 'class="input-large" size="1"', 'value', 'text', $property->ohendtime2 );

		$lists['auctime'] 	= JHTML::_('select.genericlist',   $listtimes, 'auctime', 'class="input-large" size="1"', 'value', 'text', $property->auctime );



			# Build Agent/seller Profile select list

			$profilelist = $this->get('ProfileList','ezrealty');
			$dealerlist[] = JHTML::_('select.option',  '0', JText::_('EZREALTY_SELECT_SELLER' ) );
			$dealerlist = array_merge( $dealerlist, $profilelist );
			$lists['owner'] = JHTML::_('select.genericlist',   $dealerlist, 'owner', 'class="span12 required" size="1"','value', 'text', $property->owner);
			$lists['assoc_agent'] = JHTML::_('select.genericlist',   $dealerlist, 'assoc_agent', 'class="span12" size="1"','value', 'text', $property->assoc_agent);



        # Build language select list

        $langlist = & $this->get('LanguageList');

		$ltypelist[] = JHTML::_('select.option',  '*', JText::_( 'EZREALTY_LANGUAGE_ALL' ) );
        $ltypelist = array_merge( $ltypelist, $langlist );
		$lists['language'] 	= JHTML::_('select.genericlist',   $ltypelist, 'language', 'class="span12" size="1"', 'value', 'text', $property->language );


		$publishit[] = JHTML::_('select.option',  '1', JText::_( 'COM_EZREALTY_PUBLISH' ) );
		$publishit[] = JHTML::_('select.option',  '0', JText::_('COM_EZREALTY_UNPUBLISH') );

		$lists['published'] 	= JHTML::_('select.genericlist',   $publishit, 'published', 'class="span12" size="1"', 'value', 'text', $property->published );



		$displayit[] = JHTML::_('select.option',  '0', JText::_('EZREALTY_STANDARD') );
		$displayit[] = JHTML::_('select.option',  '1', JText::_('EZREALTY_FEATURED') );
		$displayit[] = JHTML::_('select.option',  '2', JText::_('EZREALTY_SPOTLIGHT') );

		$lists['featured'] 	= JHTML::_('select.genericlist',   $displayit, 'featured', 'class="span12" size="1"', 'value', 'text', $property->featured );



		if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){
			$this->assignRef( 'ezpparams', $ezpparams );
		}
        $this->assignRef( 'lists', $lists );
        $this->assignRef( 'ezrparams', $ezrparams );
        $this->assignRef('property', $property);

        parent::display($tpl);
    }

}

?>