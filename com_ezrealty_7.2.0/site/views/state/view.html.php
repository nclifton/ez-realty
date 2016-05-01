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
class EzrealtysViewState extends JViewLegacy
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
		$state			= &$this->get('thestate' );

		$subtotal			= &$this->get('subtotal');
		$suburbs			= &$this->get('suburbs' );

		// Get the page/component configuration
		$params = &$app->getParams();

	    $max_id = 1;
	    foreach ($user->groups as $group_id)
	    	if ($max_id < $group_id) $max_id = $group_id;
	    $user->gid = $max_id;


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

		$limitstart					= JRequest::getVar('limitstart',		0,				'', 'int');
		$which_order				= $app->getUserStateFromRequest( 'com_ezrealty.which_order',				'which_order',		'a.featured desc, a.ordering asc',	'string' );

		$filter_a4type				= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4type',				'filter_a4type',				0,				'int' );
		$filter_a4cid				= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4cid',				'filter_a4cid',				0,				'int' );
		$filter_a4sold				= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4sold',				'filter_a4sold',				0,				'int' );
		$filter_a4locality			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4locality',			'filter_a4locality',			0,				'int' );
		$filter_a4minprice			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4minprice',			'filter_a4minprice',			'',				'char' );
		$filter_a4maxprice			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4maxprice',			'filter_a4maxprice',			'',				'char' );
		$filter_a4minbed			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4minbed',			'filter_a4minbed',			0,				'char' );
		$filter_a4minbaths			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4minbaths',			'filter_a4minbaths',			0,				'char' );
		$filter_a4seller			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4seller',			'filter_a4seller',			0,				'int' );
		$filter_a4custom1			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4custom1',			'filter_a4custom1',			'',				'string' );
		$filter_a4minarea			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4minarea',			'filter_a4minarea',			'',				'char' );
		$filter_a4maxarea			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4maxarea',			'filter_a4maxarea',			'',				'char' );
		$filter_a4radius			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4radius',			'filter_a4radius',			'NULL',			'string' );

		$filter_a4minland			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4minland',			'filter_a4minland',			'',				'string' );
		$filter_a4maxland			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4maxland',			'filter_a4maxland',			'',				'string' );
		$filter_a4landtype			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4landtype',			'filter_a4landtype',		0,				'int' );

		$filter_a4search				= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4search',				'filter_a4search',			'',				'string' );

		if ( file_exists(JPATH_SITE . '/administrator/components/com_realtybookings/realtybookings.php') ) {
			if ( $params->get( 'use_realtybookings' ) && $params->get( 'show_dates_select' ) ) {
				$filter_a4begin		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4begin',	'filter_a4begin',	'', 'string' );
				$filter_a4end			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a4end',		'filter_a4end',	'', 'string' );
			}
		}


		// search filter
		$lists['filter_a4search']= $filter_a4search;

		# min/max land filters
		$thefilter_a4minland = preg_replace("/[^0-9.]/", "", $filter_a4minland );
		$thefilter_a4maxland = preg_replace("/[^0-9.]/", "", $filter_a4maxland );


		if ( file_exists(JPATH_SITE . '/administrator/components/com_realtybookings/realtybookings.php') ) {
			if ( $params->get( 'use_realtybookings', 1 ) && $params->get( 'show_dates_select', 1 ) ) {
				$lists['filter_a4begin']= $filter_a4begin;
				$lists['filter_a4end']= $filter_a4end;
			}
		}


        if ( $params->get( 'show_minmaxprice_select' ) ) {

			$thefilter_a4minprice = preg_replace("/[^0-9.]/", "", $filter_a4minprice );
			$thefilter_a4maxprice = preg_replace("/[^0-9.]/", "", $filter_a4maxprice );

			$lists['minprice'] = "<input type=\"text\" name=\"filter_a4minprice\" id=\"filter_a4minprice\" placeholder=\"". JText::_('EZREALTY_SEARCH_MINPRICE')."\" maxlength=\"15\" value=\"". htmlspecialchars($thefilter_a4minprice)."\" class=\"". $er_fieldsize."\" onchange=\"document.adminForm.submit();\" />";
			$lists['maxprice'] = "<input type=\"text\" name=\"filter_a4maxprice\" id=\"filter_a4maxprice\" placeholder=\"". JText::_('EZREALTY_SEARCH_MAXPRICE')."\" maxlength=\"15\" value=\"". htmlspecialchars($thefilter_a4maxprice)."\" class=\"". $er_fieldsize."\" onchange=\"document.adminForm.submit();\" />";

		}

		if($filter_a4radius != 'NULL' && $filter_a4radius != '') {
			$lists['radius'] = "<input type=\"checkbox\" id=\"filter_a4radius\" name=\"filter_a4radius\" onchange=\"document.adminForm.submit();\" checked />";
		} else {
			$lists['radius'] = "<input type=\"checkbox\" id=\"filter_a4radius\" name=\"filter_a4radius\" onchange=\"document.adminForm.submit();\" />";
		}


		$lists['minland'] = "<input type=\"text\" name=\"filter_a4minland\" id=\"filter_a4minland\" placeholder=\"". JText::_('EZREALTY_SEARCH_MINLAND')."\" value=\"". htmlspecialchars($thefilter_a4minland)."\" class=\"". $er_fieldsize."\" onchange=\"document.adminForm.submit();\" />";
		$lists['maxland'] = "<input type=\"text\" name=\"filter_a4maxland\" id=\"filter_a4maxland\" placeholder=\"". JText::_('EZREALTY_SEARCH_MAXLAND')."\" value=\"". htmlspecialchars($thefilter_a4maxland)."\" class=\"". $er_fieldsize."\" onchange=\"document.adminForm.submit();\" />";


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


        if ($params->get( 'show_custom1_select') ) {

			$custom1list = & $this->get('Custom1List', 'state');
			$custom1[] = JHTML::_('select.option',  '', JText::_( 'EZREALTY_SELECT_CUSTOM1' ) );
            $custom1 = array_merge( $custom1, $custom1list );
			$lists['custom1'] 	= JHTML::_('select.genericlist',   $custom1, 'filter_a4custom1', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a4custom1 );

		}

        if ( $params->get( 'show_categories_select' ) ) {

		// build the category filter list

            $categorylist = & $this->get('CategoryList', 'state');
			$categorys[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_SEARCH_ALL_PROP_CATS' ) );
            $categorys = array_merge( $categorys, $categorylist );
			$lists['cid']	= JHTML::_('select.genericlist',   $categorys, 'filter_a4cid', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', "$filter_a4cid" );

		}

	// Build transaction type select list

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

			$lists['type'] 	= JHTML::_('select.genericlist',   $typeit, 'filter_a4type', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a4type );
        }

	// Build Market Status select list

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

			$lists['sold'] 	= JHTML::_('select.genericlist',   $soldit, 'filter_a4sold', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a4sold );
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
			$lists['minarea'] 	= JHTML::_('select.genericlist',   $thearealist, 'filter_a4minarea', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a4minarea );

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
			$lists['maxarea'] 	= JHTML::_('select.genericlist',   $themarealist, 'filter_a4maxarea', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a4maxarea );
		}

        if ( $params->get( 'show_sellers_select' ) ) {

		// get list of Agent/seller Profiles for the dropdown filter

			$profilelist = & $this->get('ProfileList', 'state');
			$sellers[] = JHTML::_('select.option',  '0', JText::_( 'COM_EZREALTY_ALL_AGENTS' ) );
			$sellers = array_merge( $sellers, $profilelist );
			$lists['seller'] 	= JHTML::_('select.genericlist',   $sellers, 'filter_a4seller', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a4seller );

		}

        if ( $params->get( 'show_suburbs_select' ) ) {

            # Build individual Locality select list

			$localitylist = & $this->get('LocalityPublishedList', 'state');
			$localitys[] = JHTML::_('select.option',  '0', JText::_( 'EZREALTY_LISTINGS_SORTLOCALL' ) );
			$localitys = array_merge( $localitys, $localitylist );
			$lists['locid'] 	= JHTML::_('select.genericlist',   $localitys, 'filter_a4locality', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a4locality );

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
  	
			$lists['minbed'] 	= JHTML::_('select.genericlist',   $bedlist1, 'filter_a4minbed', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a4minbed );


		// Build Bathroom select list

			$bathit[] = JHTML::_('select.option', '', JText::_('EZREALTY_SEARCH_ANY_BATHS'));
			$bathit[] = JHTML::_('select.option', '1', JText::_('EZREALTY_SEARCH_1MORE_BATHS'));
			$bathit[] = JHTML::_('select.option', '2', JText::_('EZREALTY_SEARCH_2MORE_BATHS'));
			$bathit[] = JHTML::_('select.option', '3', JText::_('EZREALTY_SEARCH_3MORE_BATHS'));
			$bathit[] = JHTML::_('select.option', '4', JText::_('EZREALTY_SEARCH_4MORE_BATHS'));
			$bathit[] = JHTML::_('select.option', '5', JText::_('EZREALTY_SEARCH_5MORE_BATHS'));

			$lists['minbaths'] 	= JHTML::_('select.genericlist',   $bathit, 'filter_a4minbaths', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a4minbaths );

		}


		$lottype[] = JHTML::_('select.option', '0', JText::_('EZREALTY_SEARCH_LOTTYPE'));
		$lottype[] = JHTML::_('select.option', '1', EZRealtyFHelper::convertLandArea());
		$lottype[] = JHTML::_('select.option', '2', EZRealtyFHelper::convertAcreage());

		$lists['lottype'] 	= JHTML::_('select.genericlist',   $lottype, 'filter_a4landtype', 'class="'.$er_selectsize.'" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_a4landtype );





		if ($menu) {
			$params->get('page_heading', $params->get('page_title', $menu->title));
		} else {
			$params->get('page_heading', JText::_('COM_EZREALTY_DEFAULT_PAGE_TITLE'));
		}

		$id = (int) @$menu->query['id'];

		if ($menu && ($menu->query['option'] != 'com_ezrealty' || $menu->query['view'] == 'ezrealty' || $id != $state->id)) {
			$path = array(array('title' => $state->name, 'link' => ''));
			$params->get('page_heading', $state->name);


			while (($menu->query['option'] != 'com_ezrealty' || $id == $state->id) )
			{
				$path[] = array('title' => 'States', 'link' => '');
			}

			$path = array_reverse($path);

			foreach($path as $item)
			{
				$pathway->addItem($item['title'], $item['link']);
			}
		}

		$title = $state->name;

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

		if ($state->metadesc) {
			$this->document->setDescription($state->metadesc);
		} else if ($params->get('menu-meta_description')) {
			$this->document->setDescription($params->get('menu-meta_description'));
		} else {
			$this->document->setDescription($state->name);
		}

		if ($state->metakey) {
			$this->document->setMetadata('keywords', $state->metakey);
		} else if ($params->get('menu-meta_description')) {
			$this->document->setMetadata('keywords', $params->get('menu-meta_keywords'));
		} else {
			$this->document->setMetadata('keywords', $state->name);
		}

		$this->document->setGenerator('EZ Realty - Joomla! Real Estate Management - RaptorServices.com');



		// Set some defaults if not set for params
		$params->def('comp_description', JText::_('EZREALTY_SITE_WELCOME'));


		$k = 0;
		$count = count($items);
		for($i = 0; $i < $count; $i++)
		{
			$item =& $items[$i];
			$item->link = JRoute::_(EzrealtyHelperRoute::getEzrealtyRoute($item->slug, '', '', $item->statslug ));

			$menuclass = 'category'.$this->escape($params->get( 'pageclass_sfx' ));

			$item->odd		= $k;
			$item->count	= $i;
			$k = 1 - $k;
		}


		for($i = 0; $i < count($suburbs); $i++)
		{
			$suburb =& $suburbs[$i];
			$suburb->link = JRoute::_(EzrealtyHelperRoute::getSuburbRoute($suburb->slug ));

			// Prepare category description
			$suburb->ezcity_desc = JHTML::_('content.prepare', $suburb->ezcity_desc);
		}


        $document->addStyleSheet("components/com_ezrealty/assets/style.css",'text/css',"screen");

		if ( $params->get( 'enable_bootstrap' ) ){
			$document->addStyleSheet("components/com_ezrealty/assets/bootstrap.css",'text/css',"screen");
		}

		if ( $params->get( 'er_uselistmap' ) ){
			$document->addScript("http://maps.googleapis.com/maps/api/js?sensor=false");
			$document->addScript("components/com_ezrealty/assets/includes.js");
		}

		$this->assignRef('user',		$user);
		$this->assignRef('lists',		$lists);
		$this->assignRef('params',		$params);
		$this->assignRef('state',		$state);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);
		$this->assignRef('suburbs',		$suburbs);

		$this->assign('action',	$uri->toString());

		parent::display($tpl);
	}
}

?>