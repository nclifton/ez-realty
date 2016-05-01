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
class EzrealtysViewCategory extends JViewLegacy
{
	function display( $tpl = null )
	{

		// Initialize some variables
		$document	= &JFactory::getDocument();
		$uri 		= &JFactory::getURI();
		$db			= &JFactory::getDBO();

		$app		= JFactory::getApplication();
		$menus		= $app->getMenu();
		$pathway	= $app->getPathway();
		$title 		= null;
		$user		= &JFactory::getUser();

		// Get the parameters of the active menu item
		$menu 		= $menus->getActive();

		// Get some data from the model
		$items			= &$this->get('data' );
		$total			= &$this->get('total');
		$pagination		= &$this->get('pagination');
		$category		= &$this->get('category' );


		// Get the page/component configuration
		$params = &$app->getParams();



		// Add alternate feed link
		if ($params->get('show_feed_link', 1) == 1)
		{
			$link	= '&format=feed&limitstart=';
			$attribs = array('type' => 'application/rss+xml', 'title' => 'RSS 2.0');
			$this->document->addHeadLink(JRoute::_($link.'&type=rss'), 'alternate', 'rel', $attribs);
			$attribs = array('type' => 'application/atom+xml', 'title' => 'Atom 1.0');
			$this->document->addHeadLink(JRoute::_($link.'&type=atom'), 'alternate', 'rel', $attribs);
		}

		if ($params->get('er_selectsize') ){
			$er_selectsize = $params->get('er_selectsize');
		} else {
			$er_selectsize = "span12";
		}
		if (!$params->get('er_fieldsize')){
			$er_fieldsize = "span12";
		} else {
			$er_fieldsize = $params->get('er_fieldsize');
		}

		$limitstart				= JRequest::getVar('limitstart',		0,				'', 'int');
		$which_order			= $app->getUserStateFromRequest( 'com_ezrealty.which_order',		'which_order',		'a.featured desc, a.ordering desc',	'string' );

		$filter_a1type			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1type',		'filter_a1type',				0,				'int' );
		$filter_a1sold			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1sold',		'filter_a1sold',				0,				'int' );
		$filter_a1country		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1country',	'filter_a1country',			-1,				'int' );
		$filter_a1state			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1state',		'filter_a1state',			0,				'int' );
		$filter_a1locality		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1locality',	'filter_a1locality',			0,				'int' );
		$filter_a1minprice		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1minprice',	'filter_a1minprice',			'',				'char' );
		$filter_a1maxprice		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1maxprice',	'filter_a1maxprice',			'',				'char' );
		$filter_a1minbed		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1minbed',	'filter_a1minbed',			0,				'char' );
		$filter_a1minbaths		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1minbaths',	'filter_a1minbaths',			0,				'char' );
		$filter_a1seller		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1seller',	'filter_a1seller',			0,				'int' );
		$filter_a1custom1		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1custom1',	'filter_a1custom1',			'',				'string' );
		$filter_a1minarea		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1minarea',	'filter_a1minarea',			'',				'char' );
		$filter_a1maxarea		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1maxarea',	'filter_a1maxarea',			'',				'char' );
		$filter_a1radius		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1radius',	'filter_a1radius',			'NULL',			'string' );

		$filter_a1minland			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1minland',			'filter_a1minland',			'',				'string' );
		$filter_a1maxland			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1maxland',			'filter_a1maxland',			'',				'string' );
		$filter_a1landtype			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1landtype',			'filter_a1landtype',		0,				'int' );

		$filter_a1search		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1search',	'filter_a1search',	'',				'string' );

		if ( file_exists(JPATH_SITE . '/administrator/components/com_realtybookings/realtybookings.php') ) {
			if ( $params->get( 'use_realtybookings', 1 ) && $params->get( 'show_dates_select', 1 ) ) {
				$filter_a1begin		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1begin',	'filter_a1begin',	'', 'string' );
				$filter_a1end			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1end',		'filter_a1end',	'', 'string' );
			}
		}


		// search filter
		$lists['filter_a1search']= $filter_a1search;

		# min/max land filters
		$thefilter_a1minland = preg_replace("/[^0-9.]/", "", $filter_a1minland );
		$thefilter_a1maxland = preg_replace("/[^0-9.]/", "", $filter_a1maxland );


		if ( file_exists(JPATH_SITE . '/administrator/components/com_realtybookings/realtybookings.php') ) {
			if ( $params->get( 'use_realtybookings', 1 ) && $params->get( 'show_dates_select', 1 ) ) {
				$lists['filter_a1begin']= $filter_a1begin;
				$lists['filter_a1end']= $filter_a1end;
			}
		}


        if ( $params->get( 'show_minmaxprice_select' ) ) {

			$thefilter_a1minprice = preg_replace("/[^0-9.]/", "", $filter_a1minprice );
			$thefilter_a1maxprice = preg_replace("/[^0-9.]/", "", $filter_a1maxprice );

			$lists['minprice'] = "<input type=\"text\" name=\"filter_a1minprice\" id=\"filter_a1minprice\" placeholder=\"". JText::_('EZREALTY_SEARCH_MINPRICE')."\" maxlength=\"15\" value=\"". htmlspecialchars($thefilter_a1minprice)."\" class=\"". $er_fieldsize."\" onchange=\"document.adminForm.submit();\" />";
			$lists['maxprice'] = "<input type=\"text\" name=\"filter_a1maxprice\" id=\"filter_a1maxprice\" placeholder=\"". JText::_('EZREALTY_SEARCH_MAXPRICE')."\" maxlength=\"15\" value=\"". htmlspecialchars($thefilter_a1maxprice)."\" class=\"". $er_fieldsize."\" onchange=\"document.adminForm.submit();\" />";

		}

		if($filter_a1radius != 'NULL' && $filter_a1radius != '') {
			$lists['radius'] = "<input type=\"checkbox\" id=\"filter_a1radius\" name=\"filter_a1radius\" onchange=\"document.adminForm.submit();\" checked />";
		} else {
			$lists['radius'] = "<input type=\"checkbox\" id=\"filter_a1radius\" name=\"filter_a1radius\" onchange=\"document.adminForm.submit();\" />";
		}


		$lists['minland'] = "<input type=\"text\" name=\"filter_a1minland\" id=\"filter_a1minland\" placeholder=\"". JText::_('EZREALTY_SEARCH_MINLAND')."\" value=\"". htmlspecialchars($thefilter_a1minland)."\" class=\"". $er_fieldsize."\" onchange=\"document.adminForm.submit();\" />";
		$lists['maxland'] = "<input type=\"text\" name=\"filter_a1maxland\" id=\"filter_a1maxland\" placeholder=\"". JText::_('EZREALTY_SEARCH_MAXLAND')."\" value=\"". htmlspecialchars($thefilter_a1maxland)."\" class=\"". $er_fieldsize."\" onchange=\"document.adminForm.submit();\" />";


		$orderit[] = JHTML::_('select.option',  '', JText::_( 'COM_EZREALTY_SORTRESULTS' ) );
		$orderit[] = JHTML::_('select.option',  'a.listdate desc', JText::_( 'EZREALTY_LISTINGS_LISTINGDATE' ).' '.JText::_( 'COM_EZREALTY_SELECT_DESC' ) );
		$orderit[] = JHTML::_('select.option',  'a.listdate asc', JText::_( 'EZREALTY_LISTINGS_LISTINGDATE' ).' '.JText::_( 'COM_EZREALTY_SELECT_ASC' ) );
		$orderit[] = JHTML::_('select.option',  'a.price desc', JText::_( 'EZREALTY_VIEWDET_PRICE' ).' '.JText::_( 'COM_EZREALTY_SELECT_DESC' ) );
		$orderit[] = JHTML::_('select.option',  'a.price asc', JText::_( 'EZREALTY_VIEWDET_PRICE' ).' '.JText::_( 'COM_EZREALTY_SELECT_ASC' ) );
		$orderit[] = JHTML::_('select.option',  'dd.ezcity desc', JText::_( 'EZREALTY_SEARCHSUB' ).' '.JText::_( 'COM_EZREALTY_SELECT_DESC' ) );
		$orderit[] = JHTML::_('select.option',  'dd.ezcity asc', JText::_( 'EZREALTY_SEARCHSUB' ).' '.JText::_( 'COM_EZREALTY_SELECT_ASC' ) );

		$lists['whatorder'] 	= JHTML::_('select.genericlist',   $orderit, 'which_order', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $which_order );


		$thelimit[] = JHTML::_('select.option',  '5', JText::_( 'COM_EZREALTY_PAGINATION_5' ) );
		$thelimit[] = JHTML::_('select.option',  '10', JText::_( 'COM_EZREALTY_PAGINATION_10' ) );
		$thelimit[] = JHTML::_('select.option',  '15', JText::_( 'COM_EZREALTY_PAGINATION_15' ) );
		$thelimit[] = JHTML::_('select.option',  '20', JText::_( 'COM_EZREALTY_PAGINATION_20' ) );
		$thelimit[] = JHTML::_('select.option',  '25', JText::_( 'COM_EZREALTY_PAGINATION_25' ) );
		$thelimit[] = JHTML::_('select.option',  '30', JText::_( 'COM_EZREALTY_PAGINATION_30' ) );
		$thelimit[] = JHTML::_('select.option',  '50', JText::_( 'COM_EZREALTY_PAGINATION_50' ) );

		$lists['limit'] 	= JHTML::_('select.genericlist',   $thelimit, 'limit', 'class="inputbox input-mini" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $pagination->limit );



		if (!$filter_a1country){
			$cnid = '0';
		} else {
			$cnid = $filter_a1country;
		}

		if (!$filter_a1state){
			$stid = '0';
		} else {
			$stid = $filter_a1state;
		}


        if ($params->get( 'show_custom1_select') ) {

			$custom1list = & $this->get('Custom1List', 'category');
			$custom1[] = JHTML::_('select.option',  '', JText::_( 'EZREALTY_SELECT_CUSTOM1' ) );
            $custom1 = array_merge( $custom1, $custom1list );
			$lists['custom1'] 	= JHTML::_('select.genericlist',   $custom1, 'filter_a1custom1', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1custom1 );

		}


	  # Build transaction type select list

        if ($params->get( 'show_transtype_select') ) {

			$typeit[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_SEARCH_ALL_TRANS_TYPES' ) );
            if ( $params->get( 'er_usetype1') ) {
				$typeit[] = JHTML::_('select.option',  '1', JText::_( 'EZREALTY_TYPE_SALE' ) );
            }
            if ( $params->get( 'er_usetype2') ) {
				$typeit[] = JHTML::_('select.option',  '2', JText::_( 'EZREALTY_TYPE_RENTAL' ) );
            }
            if ( $params->get( 'er_usetype3') ) {
				$typeit[] = JHTML::_('select.option',  '3', JText::_( 'EZREALTY_TYPE_LEASE' ) );
            }
            if ( $params->get( 'er_usetype4') ) {
				$typeit[] = JHTML::_('select.option',  '4', JText::_( 'EZREALTY_TYPE_AUCTION' ) );
            }
            if ( $params->get( 'er_usetype5') ) {
				$typeit[] = JHTML::_('select.option',  '5', JText::_( 'EZREALTY_TYPE_SWAP' ) );
            }
            if ( $params->get( 'er_usetype6') ) {
				$typeit[] = JHTML::_('select.option',  '6', JText::_( 'EZREALTY_TYPE_TENDER' ) );
            }
            if ( $params->get( 'er_usetype7') ) {
				$typeit[] = JHTML::_('select.option',  '7', JText::_( 'EZREALTY_TYPE_SHARE' ) );
            }

			$lists['type'] 	= JHTML::_('select.genericlist',   $typeit, 'filter_a1type', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1type );
        }

	  # Build Market Status select list

		if ($params->get( 'show_marketstatus_select')) {

			$soldit[] = JHTML::_('select.option', 0, JText::_('EZREALTY_SEARCH_ANYMARKET') );
			if ( $params->get( 'er_usemarket1') ) {
				$soldit[] = JHTML::_('select.option', 1, JText::_('EZREALTY_DETAILS_MARKET1') );
			}
			if ( $params->get( 'er_usemarket2') ) {
				$soldit[] = JHTML::_('select.option', 2, JText::_('EZREALTY_DETAILS_MARKET2') );
			}
			if ( $params->get( 'er_usemarket3') ) {
				$soldit[] = JHTML::_('select.option', 3, JText::_('EZREALTY_DETAILS_MARKET3') );
			}
			if ( $params->get( 'er_usemarket4') ) {
				$soldit[] = JHTML::_('select.option', 4, JText::_('EZREALTY_DETAILS_MARKET4') );
			}
			if ( $params->get( 'er_usemarket5') ) {
				$soldit[] = JHTML::_('select.option', 5, JText::_('EZREALTY_DETAILS_MARKET5') );
			}
			if ( $params->get( 'er_usemarket6') ) {
				$soldit[] = JHTML::_('select.option', 6, JText::_('EZREALTY_DETAILS_MARKET6') );
			}
			if ( $params->get( 'er_usemarket7') ) {
				$soldit[] = JHTML::_('select.option', 7, JText::_('EZREALTY_DETAILS_MARKET7') );
			}

			$lists['sold'] 	= JHTML::_('select.genericlist',   $soldit, 'filter_a1sold', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1sold );
		}


		if ( $params->get( 'show_minmaxarea_select' ) ) {

			# Build minimum floor area select list

			$thearealist[] = JHTML::_('select.option',  '', JText::_( 'EZREALTY_MIN_FLOORAREA' ) );
			if ( $params->get( 'er_arealist' ) ) {
				$tarea = str_replace( "\r\n", "", $params->get( 'er_arealist' ) );
				$someAreas = explode(";",$tarea);
				for($i = 0; $i < count($someAreas)-1; $i++){
					$vlist = str_replace( ",", "", $someAreas[$i] );
					$showlist = $someAreas[$i];
					if ($showlist != ''){
						$thearealist[] = JHTML::_('select.option',  $vlist, $showlist );
					}
				}
			}
			$lists['minarea'] 	= JHTML::_('select.genericlist',   $thearealist, 'filter_a1minarea', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1minarea );

			# Build maximum floor area select list

			$themarealist[] = JHTML::_('select.option',  '', JText::_( 'EZREALTY_MAX_FLOORAREA' ) );
			if ( $params->get( 'er_arealist' ) ) {
				$mtarea = str_replace( "\r\n", "", $params->get( 'er_arealist' ) );
				$msomeAreas = explode(";",$mtarea);
				for($i < count($msomeAreas)+1; $i > 0-1; $i--){
					$mvlist = str_replace( ",", "", $msomeAreas[$i] );
					$mshowlist = $msomeAreas[$i];

					if ($mshowlist != ''){
						$themarealist[] = JHTML::_('select.option',  $mvlist, $mshowlist );
					}
				}
			}
			$lists['maxarea'] 	= JHTML::_('select.genericlist',   $themarealist, 'filter_a1maxarea', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1maxarea );
		}


	  # get list of Agent/seller Profiles for the dropdown filter

		if ($params->get( 'show_sellers_select')) {

			$profilelist = & $this->get('ProfileList', 'category');
			$sellers[] = JHTML::_('select.option',  '0', JText::_( 'COM_EZREALTY_ALL_AGENTS' ) );
            $sellers = array_merge( $sellers, $profilelist );
			$lists['seller'] 	= JHTML::_('select.genericlist',   $sellers, 'filter_a1seller', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1seller );

		}


        if ( $params->get( 'show_countries_select' ) && $params->get( 'show_states_select' ) && $params->get( 'show_suburbs_select' ) ) {

            # Build the City/State/Locality chained selector list

            $countrylist = & $this->get('CountryList', 'category');
			$countrys[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_SORT_ALLCOUNTRIES' ) );
            $countrys = array_merge( $countrys, $countrylist );
			$lists['cnid'] 	= JHTML::_('select.genericlist',   $countrys, 'filter_a1country', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1country );


        // get list of States for the dropdown filter

			if (JFactory::getApplication()->getLanguageFilter()) {
				$whichlang1 = "dd.published = 1 AND dd.countid=".$cnid." AND dd.language in (" . $db->Quote(JFactory::getLanguage()->getTag()) . "," . $db->Quote('*') . ")";
			} else {
				$whichlang1 = "dd.published = 1 AND dd.countid=".$cnid;
			}

			if ($params->get('deflistorder') == 1) {
				$orderby 	= ' ORDER BY dd.name';
			} else {
				$orderby 	= ' ORDER BY dd.ordering';
			}

			$sql = 'SELECT dd.id AS value, dd.name AS text' .
			' FROM #__ezrealty_state AS dd' .
			' INNER JOIN #__ezrealty_country AS e ON e.id = dd.countid ' .
			' WHERE '.$whichlang1 .'
			'.$orderby;

			$db->setQuery($sql);
			if (!$db->query()) {
				echo $db->stderr();
				return;
			}
			$states[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_SORT_ALLSTATES' ) );
			$states = array_merge( $states, $db->loadObjectList() );
			$lists['stid'] 	= JHTML::_('select.genericlist',   $states, 'filter_a1state', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1state );

        // get list of Localities for the dropdown filter

			if (JFactory::getApplication()->getLanguageFilter()) {
				$whichlang2 = "cc.published = 1 AND cc.stateid=".$stid." AND cc.language in (" . $db->Quote(JFactory::getLanguage()->getTag()) . "," . $db->Quote('*') . ")";
			} else {
				$whichlang2 = "cc.published = 1 AND cc.stateid=".$stid;
			}

			if ($params->get('deflistorder') == 1) {
				$orderby 	= ' ORDER BY cc.ezcity';
			} else {
				$orderby 	= ' ORDER BY cc.ordering';
			}

			$sql = 'SELECT cc.id AS value, cc.ezcity AS text' .
			' FROM #__ezrealty_locality AS cc' .
			' INNER JOIN #__ezrealty_state AS s ON s.id = cc.stateid ' .
			' WHERE '.$whichlang2 .'
			'.$orderby;

			$db->setQuery($sql);
			if (!$db->query()) {
				echo $db->stderr();
				return;
			}
			$localitys[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_LISTINGS_SORTLOCALL' ) );
			$localitys = array_merge( $localitys, $db->loadObjectList() );
			$lists['locid'] 	= JHTML::_('select.genericlist',   $localitys, 'filter_a1locality', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1locality );

		}

        if ( !$params->get( 'show_countries_select' ) && $params->get( 'show_states_select' ) && $params->get( 'show_suburbs_select' ) ) {

            # Build the State/Locality chained selector list

        // get list of States for the dropdown filter

            $statelist = & $this->get('StateList', 'category');
			$states[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_SORT_ALLSTATES' ) );
            $states = array_merge( $states, $statelist );
			$lists['stid'] 	= JHTML::_('select.genericlist',   $states, 'filter_a1state', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1state );

        // get list of Localities for the dropdown filter

			if (JFactory::getApplication()->getLanguageFilter()) {
				$whichlang3 = "cc.published = 1 AND cc.stateid=".$stid." AND cc.language in (" . $db->Quote(JFactory::getLanguage()->getTag()) . "," . $db->Quote('*') . ")";
			} else {
				$whichlang3 = "cc.published = 1 AND cc.stateid=".$stid;
			}

			if ($params->get('deflistorder') == 1) {
				$orderby 	= ' ORDER BY cc.ezcity';
			} else {
				$orderby 	= ' ORDER BY cc.ordering';
			}

			$sql = 'SELECT cc.id AS value, cc.ezcity AS text' .
			' FROM #__ezrealty_locality AS cc' .
			' INNER JOIN #__ezrealty_state AS s ON s.id = cc.stateid ' .
			' WHERE '.$whichlang3 .'
			'.$orderby;

			$db->setQuery($sql);
			if (!$db->query()) {
				echo $db->stderr();
				return;
			}
			$localitys[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_LISTINGS_SORTLOCALL' ) );
			$localitys = array_merge( $localitys, $db->loadObjectList() );
			$lists['locid'] 	= JHTML::_('select.genericlist',   $localitys, 'filter_a1locality', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1locality );

        }

        if ( $params->get( 'show_countries_select' ) && !$params->get( 'show_states_select' ) && $params->get( 'show_suburbs_select' ) ) {

            # Build the Country/Locality chained selector list

            $countrylist = & $this->get('CountryList', 'category');
			$countrys[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_SORT_ALLCOUNTRIES' ) );
            $countrys = array_merge( $countrys, $countrylist );
			$lists['cnid'] 	= JHTML::_('select.genericlist',   $countrys, 'filter_a1country', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1country );

            # get list of Localities for the dropdown filter

			if (JFactory::getApplication()->getLanguageFilter()) {
				$whichlang4 = "cc.published = 1 AND cc.stateid=".$cnid." AND cc.language in (" . $db->Quote(JFactory::getLanguage()->getTag()) . "," . $db->Quote('*') . ")";
			} else {
				$whichlang4 = "cc.published = 1 AND cc.stateid=".$cnid;
			}

			if ($params->get('deflistorder') == 1) {
				$orderby 	= ' ORDER BY cc.ezcity';
			} else {
				$orderby 	= ' ORDER BY cc.ordering';
			}

			$sql = 'SELECT cc.id AS value, cc.ezcity AS text' .
			' FROM #__ezrealty_locality AS cc' .
			' INNER JOIN #__ezrealty_country AS s ON s.id = cc.stateid ' .
			' WHERE '.$whichlang4 .'
			'.$orderby;

			$db->setQuery($sql);
			if (!$db->query()) {
				echo $db->stderr();
				return;
			}
			$localitys[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_LISTINGS_SORTLOCALL' ) );
			$localitys = array_merge( $localitys, $db->loadObjectList() );
			$lists['locid'] 	= JHTML::_('select.genericlist',   $localitys, 'filter_a1locality', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1locality );

        }

        if ( !$params->get( 'show_countries_select' ) && !$params->get( 'show_states_select' ) && $params->get( 'show_suburbs_select' ) ) {

            # Build individual Locality select list

            $localitylist = & $this->get('LocalityPublishedList', 'category');
			$localitys[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_LISTINGS_SORTLOCALL' ) );
            $localitys = array_merge( $localitys, $localitylist );
			$lists['locid'] 	= JHTML::_('select.genericlist',   $localitys, 'filter_a1locality', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1locality );

        }


        if ( $params->get( 'show_minbedsbaths_select' ) ) {

		// Build Bed Number select lists

			$bedlist1 = array();
			$bedlist1[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_SEARCH_MINBEDS' ) );

			if ($params->get( 'er_usecouch')) {
				$bedlist1[] = JHTML::_('select.option',  '-2', JText::_( 'EZREALTY_COUCH' ) );
			}
			if ($params->get( 'er_usestudio')) {
				$bedlist1[] = JHTML::_('select.option',  '-1', JText::_( 'EZREALTY_STUDIO' ) );
			}

			for($i=1;$i<$params->get( 'er_maxrooms')+1;$i++){
				$bedlist1[] = JHTML::_('select.option',$i , $i);
			}
  	
			$lists['minbed'] 	= JHTML::_('select.genericlist',   $bedlist1, 'filter_a1minbed', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1minbed );


		// Build Bathroom select list

			$bathit[] = JHTML::_('select.option', '', JText::_('EZREALTY_SEARCH_ANY_BATHS'));
			$bathit[] = JHTML::_('select.option', '1', JText::_('EZREALTY_SEARCH_1MORE_BATHS'));
			$bathit[] = JHTML::_('select.option', '2', JText::_('EZREALTY_SEARCH_2MORE_BATHS'));
			$bathit[] = JHTML::_('select.option', '3', JText::_('EZREALTY_SEARCH_3MORE_BATHS'));
			$bathit[] = JHTML::_('select.option', '4', JText::_('EZREALTY_SEARCH_4MORE_BATHS'));
			$bathit[] = JHTML::_('select.option', '5', JText::_('EZREALTY_SEARCH_5MORE_BATHS'));

			$lists['minbaths'] 	= JHTML::_('select.genericlist',   $bathit, 'filter_a1minbaths', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1minbaths );

		}

		$lottype[] = JHTML::_('select.option', '0', JText::_('EZREALTY_SEARCH_LOTTYPE'));
		$lottype[] = JHTML::_('select.option', '1', EZRealtyFHelper::convertLandArea());
		$lottype[] = JHTML::_('select.option', '2', EZRealtyFHelper::convertAcreage());

		$lists['lottype'] 	= JHTML::_('select.genericlist',   $lottype, 'filter_a1landtype', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a1landtype );



		if ($menu) {
			$params->get('page_heading', $params->get('page_title', $menu->title));
		} else {
			$params->get('page_heading', JText::_('COM_EZREALTY_DEFAULT_PAGE_TITLE'));
		}

		$id = (int) @$menu->query['id'];

		if ($menu && ($menu->query['option'] != 'com_ezrealty' || $menu->query['view'] == 'ezrealty' || $id != $category->id)) {
			$path = array(array('title' => $category->name, 'link' => ''));
			$params->get('page_heading', $category->name);


			while (($menu->query['option'] != 'com_ezrealty' || $id == $category->id) )
			{
				$path[] = array('title' => 'Categories', 'link' => '');
			}

			$path = array_reverse($path);

			foreach($path as $item)
			{
				$pathway->addItem($item['title'], $item['link']);
			}
		}

if ($params->get('page_title')){
		$title = $params->get('page_title');
} else {
		$title = $category->name;
}

		//$title = $category->name;

		if (empty($title)) {
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}

		$this->document->setTitle($title);


		if ($category->metadesc) {
			$this->document->setDescription($category->metadesc);
		} else if ($params->get('menu-meta_description')) {
			$this->document->setDescription($params->get('menu-meta_description'));
		} else {
			$this->document->setDescription($category->name);
		}

		if ($category->metakey) {
			$this->document->setMetadata('keywords', $category->metakey);
		} else if ($params->get('menu-meta_description')) {
			$this->document->setMetadata('keywords', $params->get('menu-meta_keywords'));
		} else {
			$this->document->setMetadata('keywords', $category->name);
		}

		$this->document->setGenerator('EZ Realty - Joomla! Real Estate Management - RaptorServices.com');





		// Set some defaults if not set for params
		$params->def('comp_description', JText::_('EZREALTY_SITE_WELCOME'));

		$k = 0;
		$count = count($items);
		for($i = 0; $i < $count; $i++)
		{
			$item =& $items[$i];

			$item->link = JRoute::_(EzrealtyHelperRoute::getEzrealtyRoute($item->slug, $item->catslug, '', '' ));

			$menuclass = 'category'.$this->escape($params->get( 'pageclass_sfx' ));

			$item->odd		= $k;
			$item->count	= $i;
			$k = 1 - $k;
		}

        $document->addStyleSheet("components/com_ezrealty/assets/style.css",'text/css',"screen");

		if ( $params->get( 'enable_bootstrap' ) ){
			$document->addStyleSheet("components/com_ezrealty/assets/bootstrap.css",'text/css',"screen");
		}

		if ( $params->get( 'er_uselistmap' ) ){
			$document->addScript("components/com_ezrealty/assets/includes.js");
			$document->addScript("http://maps.googleapis.com/maps/api/js?sensor=false");
		}

		$this->assignRef('user',		$user);
		$this->assignRef('lists',		$lists);
		$this->assignRef('params',		$params);
		$this->assignRef('category',	$category);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);

		$this->assign('action',	$uri->toString());

		parent::display($tpl);
	}
}

?>