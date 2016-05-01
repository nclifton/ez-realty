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

jimport( 'joomla.application.component.model' );

/**
 * Ezrealty Model
 *
 * @package    EZ Realty
 */
class ezrealtyModelEzrealty extends JModelList {

    var $_id = null;
    var $_data = null;
    var $_order  = array();

    var $_filter_category = null;
    var $_filter_type = null;
    var $_filter_sold = null;
    var $_filter_street = null;
    var $_filter_locality = null;
    var $_filter_state = null;
    var $_filter_country = null;
    var $_filter_seller = null;
    var $_filter_published = null;
	var $_search = null;

    function __construct () {

        parent::__construct();

        $cids = JRequest::getVar('cid', 0, '', 'array');
        $this->setId((int)$cids[0]);

        $app = &JFactory::getApplication();
        $option = $app->scope;

        $this->controller = JRequest::getVar("controller");

        // Get the pagination request variables

		$limit = $app->getUserStateFromRequest( 'global.list.limit', 'limit', $app->getCfg('list_limit'), 'int' );
        $this->setState('limit', $limit); // Set the limit variable for query later on

        $limitstart = $app->getUserStateFromRequest( $option.'limitstart', 'limitstart', 0, 'int' );
        $this->setState('limitstart', $limitstart);


        /* Filter By States */

        $filter_state = $app->getUserStateFromRequest( $option."filter_state", 'filter_state', 0, 'int' );
        $this->setState('filter_state', $filter_state);
        $this->_filter_state = $filter_state;

        /* Filter By Category */

        $filter_category = $app->getUserStateFromRequest( $option."filter_category", 'filter_category', 0, 'int' );
        $this->setState('filter_category', $filter_category);
        $this->_filter_category = $filter_category;

        /* Filter By Type */

        $filter_type = $app->getUserStateFromRequest( $option."filter_type", 'filter_type', 0, 'int' );
        $this->setState('filter_type', $filter_type);
        $this->_filter_type = $filter_type;

        /* Filter By Market Status */

        $filter_sold = $app->getUserStateFromRequest( $option."filter_sold", 'filter_sold', 0, 'int' );
        $this->setState('filter_sold', $filter_sold);
        $this->_filter_sold = $filter_sold;

        /* Filter By Street */

        $filter_street = $app->getUserStateFromRequest( $option."filter_street", 'filter_street', '', 'string' );
        $this->setState('filter_street', $filter_street);
        $this->_filter_street = $filter_street;

        /* Filter By Locality */

        $filter_locality = $app->getUserStateFromRequest( $option."filter_locality", 'filter_locality', 0, 'int' );
        $this->setState('filter_locality', $filter_locality);
        $this->_filter_locality = $filter_locality;

        /* Filter By Country */

        $filter_country = $app->getUserStateFromRequest( $option."filter_country", 'filter_country', 0, 'int' );
        $this->setState('filter_country', $filter_country);
        $this->_filter_country = $filter_country;

        /* Filter By Seller */

        $filter_seller = $app->getUserStateFromRequest( $option."filter_seller", 'filter_seller', 0, 'int' );
        $this->setState('filter_seller', $filter_seller);
        $this->_filter_seller = $filter_seller;

        /* Filter By Published status */

        $filter_published = $app->getUserStateFromRequest( $option."filter_published", 'filter_published', '', 'string' );
        $this->setState('filter_published', $filter_published);
        $this->_filter_published = $filter_published;

        /* Filter By keyword */

        $search = $app->getUserStateFromRequest( $option."search", 'search', '', 'string' );
        $this->setState('search', $search);

		if (strpos($search, '"') !== false) {
			$search = str_replace(array('=', '<'), '', $search);
		}
		$search = JString::strtolower($search);

        $this->_search = $search;

    }

    function _buildContentWhere() {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
		$db					=& JFactory::getDBO();

        $where = array();

        if ( $this->_filter_category > 0 ) {
            $where[] = " pc.category_id = '".(int) $this->_filter_category."' ";
        }

        if ( $this->_filter_type > 0 ) {
            $where[] = " a.type = '".(int) $this->_filter_type."' ";
        }

        if ( $this->_filter_sold > 0 ) {
            $where[] = " a.sold = '".(int) $this->_filter_sold."' ";
        }

        if ( $this->_filter_street != '' ) {
            $where[] = " a.address2 = '".$db->escape($this->_filter_street, true )."' ";
        }

        if ( $this->_filter_locality > 0 ) {
            $where[] = " a.locid = '".(int) $this->_filter_locality."' ";
        }

        if ( $this->_filter_state > 0 ) {
            $where[] = " a.stid = '".(int) $this->_filter_state."' ";
        }

        if ( $this->_filter_country > 0 ) {
            $where[] = " a.cnid = '".(int) $this->_filter_country."' ";
        }

		if ( $this->_filter_published ) {
			if ( $this->_filter_published == 'P' ) {
				$where[] = 'a.published = 1';
			} else if ($this->_filter_published == 'U' ) {
				$where[] = 'a.published = 0';
			}
		}

		if ( $this->_filter_seller > 0 ) {
			$where[] = " a.owner = '".(int) $this->_filter_seller."' ";
		}


		if ($this->_search) {
			$where[] = 'LOWER(a.mls_id) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.office_id) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.id) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.county) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.ctown) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.ctport) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.schooldist) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.preschool) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.primaryschool) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.highschool) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.custom1) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.custom2) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.custom3) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.custom4) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.custom5) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.custom6) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.custom7) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.custom8) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.adline) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.smalldesc) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.propdesc) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.address2) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.postcode) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(dd.ezcity) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(ee.name) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(ff.name) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
;
		}


        if (!empty($where)) $where = " where " . implode( ' AND ', $where ) . " ";
        else $where = "";

        return $where;
    }

    /* Used to table ordering*/
	function _buildContentOrderBy()
	{
        $app = &JFactory::getApplication();
        $option = $app->scope;
		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		$filter_order		= $app->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.id desc',	'cmd' );
		$filter_order_Dir	= $app->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );

		if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){
			if ($filter_order == 'a.id' || $filter_order == 'a.address2' || $filter_order == 'a.mls_id' || $filter_order == 'a.price' || $filter_order == 'a.hits' || $filter_order == 'a.published' || $filter_order == 'a.featured' || $filter_order == 'thecamtype' || $filter_order == 'propseller' || $filter_order == 'a.sold' || $filter_order == 'a.listdate' || $filter_order == 'a.lastupdate' || $filter_order == 'a.expdate' || $filter_order == 'a.language' ){
				$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir;
			} else {
				$orderby 	= ' ORDER BY a.id desc';
			}
		} else {
			if ($filter_order == 'a.id' || $filter_order == 'a.address2' || $filter_order == 'a.mls_id' || $filter_order == 'a.price' || $filter_order == 'a.hits' || $filter_order == 'a.published' || $filter_order == 'a.featured' || $filter_order == 'propseller' || $filter_order == 'a.sold' || $filter_order == 'a.listdate' || $filter_order == 'a.lastupdate' || $filter_order == 'a.expdate' || $filter_order == 'a.language' ){
				$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir;
			} else {
				$orderby 	= ' ORDER BY a.id desc';
			}
		}


		return $orderby;
	}



    function getData() {

		# check whether an upgrade or migration needs to be done
		$checktest = EZRealtyMigrationHelper::migrationStatus();
		$upgradecheck = EZRealtyUpgradesHelper::upgradeStatus();

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

        if (empty ($this->_data)) {

			if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){

				$ezpparams = JComponentHelper::getParams ('com_ezportal');

					$sql = "SELECT distinct(a.id),a.*, dd.ezcity AS proploc, ee.name AS statename, ff.name AS cnname, ss.seller_name AS propseller, tt.title AS thecamtype, u.name AS editor"
                    . "\n FROM #__ezrealty AS a"
					. "\n LEFT JOIN #__ezrealty_incats AS pc ON pc.property_id = a.id"
					. "\n LEFT JOIN #__ezrealty_catg AS cc ON cc.id = pc.category_id"
                    . "\n LEFT JOIN #__ezrealty_locality AS dd ON dd.id = a.locid"
                    . "\n LEFT JOIN #__ezrealty_state AS ee ON ee.id = a.stid"
                    . "\n LEFT JOIN #__ezrealty_country AS ff ON ff.id = a.cnid"
                    . "\n LEFT JOIN #__ezportal AS ss ON ss.uid = a.owner"
                    . "\n LEFT JOIN #__ezportal_campaigns AS tt ON tt.id = a.camtype"
                    . "\n LEFT JOIN #__users AS u ON u.id = a.checked_out"
                    . $this->_buildContentWhere()
                    . $this->_buildContentOrderBy();

			} else {

				if($checktest && $upgradecheck){

					$sql = "SELECT distinct(a.id),a.*, dd.ezcity AS proploc, ee.name AS statename, ff.name AS cnname, ss.seller_name AS propseller, u.name AS editor"
					. "\n FROM #__ezrealty AS a"
					. "\n LEFT JOIN #__ezrealty_incats AS pc ON pc.property_id = a.id"
					. "\n LEFT JOIN #__ezrealty_catg AS cc ON cc.id = pc.category_id"
					. "\n LEFT JOIN #__ezrealty_locality AS dd ON dd.id = a.locid"
					. "\n LEFT JOIN #__ezrealty_state AS ee ON ee.id = a.stid"
					. "\n LEFT JOIN #__ezrealty_country AS ff ON ff.id = a.cnid"
					. "\n LEFT JOIN #__ezportal AS ss ON ss.uid = a.owner"
					. "\n LEFT JOIN #__users AS u ON u.id = a.checked_out"
					. $this->_buildContentWhere()
					. $this->_buildContentOrderBy();

				} else {

					$sql = "SELECT distinct(a.id),a.*, dd.ezcity AS proploc, ee.name AS statename, ff.name AS cnname, ss.name AS propseller, u.name AS editor"
					. "\n FROM #__ezrealty AS a"
					. "\n LEFT JOIN #__ezrealty_locality AS dd ON dd.id = a.locid"
					. "\n LEFT JOIN #__ezrealty_state AS ee ON ee.id = a.stid"
					. "\n LEFT JOIN #__ezrealty_country AS ff ON ff.id = a.cnid"
					. "\n LEFT JOIN #__users AS ss ON ss.id = a.owner"
					. "\n LEFT JOIN #__users AS u ON u.id = a.checked_out"
					. $this->_buildContentWhere()
					. $this->_buildContentOrderBy();

				}

			}

            $this->_total = $this->_getListCount($sql);
            if ($this->getState('limitstart') > $this->_total) $this->setState('limitstart', 0);
            if ($this->getState('limitstart') > 0 && $this->getState('limit') == 0)  $this->setState('limitstart', 0);
            $this->_data = $this->_getList($sql, $this->getState('limitstart'), $this->getState('limit'));
        }


		return $this->_data;

    }



    function getOrdering() {

        $query = "SELECT b.ordering AS value, b.name AS text"
                . "\n FROM #__ezrealty AS b"
                . "\n ORDER BY b.ordering ";
        $this->_db->setQuery( $query );
        $ordering = $this->_db->loadObjectlist();

        return $ordering;
    }


    function getStreetListID() {

        $query = "SELECT DISTINCT nn.address2 AS value, nn.address2 AS text"
                . "\n FROM #__ezrealty as nn WHERE nn.address2!=''"
                . "\n ORDER BY nn.address2";
        $this->_db->setQuery( $query );
        $ordering = $this->_db->loadObjectlist();

        return $ordering;
    }


    function getCampaigns() {
		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
		$ezpparams = JComponentHelper::getParams ('com_ezportal');

		$thecampaigns = '';

		if ( $ezpparams->get( 'paid_listings' ) == 1 && $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){

			$query = "SELECT DISTINCT cc.id AS value, cc.title AS text"
			. "\n FROM #__ezportal_campaigns as cc WHERE cc.published = 1"
			. "\n ORDER BY cc.ordering";
			$this->_db->setQuery( $query );
			$thecampaigns = $this->_db->loadObjectlist();

		}

		return $thecampaigns;
    }


	function getProfileList() {	

		# check whether an upgrade or migration needs to be done
		$checktest = EZRealtyMigrationHelper::migrationStatus();
		$upgradecheck = EZRealtyUpgradesHelper::upgradeStatus();

		if($checktest && $upgradecheck){

			$orderby 	= ' ORDER BY ss.ordering';

			$query = "SELECT ss.uid AS value, CONCAT(ss.seller_name,' (',count(b.id),')' ) AS text"
			. "\n FROM #__ezportal as ss"
			. "\n LEFT JOIN #__ezrealty AS b ON ss.uid = b.owner "
	       	. "\n GROUP BY ss.id"
			. "\n $orderby ";
	        $this->_db->setQuery( $query );
	        $lists = $this->_db->loadObjectlist();    

		} else {

			$orderby 	= ' ORDER BY ss.name';

			$query = "SELECT ss.id AS value, CONCAT(ss.name,' (',count(b.id),')' ) AS text"
			. "\n FROM #__users as ss"
			. "\n LEFT JOIN #__ezrealty AS b ON ss.id = b.owner "
	       	. "\n GROUP BY ss.id"
			. "\n $orderby ";
	        $this->_db->setQuery( $query );
	        $lists = $this->_db->loadObjectlist();    

		}


		return $lists;
	}	      



    function getLanguageList() {

        $query = "SELECT n.lang_code as value, n.title as text FROM #__languages AS n ORDER by n.ordering ASC";
        $this->_db->setQuery( $query );
        $languages = $this->_db->loadObjectlist();            
        return $languages;
    }


    /**
     * Retrieves the data
     * @return array Array of objects containing the data from the database
     */
    function getDataById() {

        // Load the data
        if (empty( $this->_data )) {
            $query = ' SELECT * FROM #__ezrealty '.
                    '  WHERE id = '.$this->_id;
            $this->_db->setQuery( $query );
            $this->_data = $this->_db->loadObject();
        }

        if (!$this->_data) {
            $this->_data->id = null;
            $this->_data->type = null;
            $this->_data->rent_type = null;
            $this->_data->cid = null;
            $this->_data->locid = null;
            $this->_data->stid = null;
            $this->_data->cnid = null;
            $this->_data->soleAgency = null;
            $this->_data->bldg_name = null;
            $this->_data->unit_num = null;
            $this->_data->lot_num = null;
            $this->_data->street_num = null;
            $this->_data->address2 = null;
            $this->_data->postcode = null;
            $this->_data->county = null;
            $this->_data->locality = null;
            $this->_data->state = null;
            $this->_data->country = null;
            $this->_data->viewad = null;
            $this->_data->owncoords = null;
            $this->_data->price = null;
            $this->_data->offpeak = null;
            $this->_data->showprice = null;
            $this->_data->freq = null;
            $this->_data->bond = null;
            $this->_data->closeprice = null;
            $this->_data->priceview = null;
            $this->_data->year = null;
            $this->_data->yearRemodeled = null;

            $this->_data->houseStyle = null;
            $this->_data->houseConstruction = null;
            $this->_data->exteriorFinish = null;
            $this->_data->roof = null;
            $this->_data->flooring = null;
            $this->_data->porchPatio = null;

            $this->_data->landtype = null;
            $this->_data->frontage = null;
            $this->_data->depth = null;


            $this->_data->subdivision = null;
            $this->_data->LandAreaSqFt = null;
            $this->_data->AcresTotal = null;
            $this->_data->LotDimensions = null;


            $this->_data->bedrooms = null;
            $this->_data->sleeps = null;
            $this->_data->totalrooms = null;
            $this->_data->otherrooms = null;
            $this->_data->livingarea = null;
            $this->_data->bathrooms = null;

            $this->_data->fullBaths = null;
            $this->_data->thqtrBaths = null;
            $this->_data->halfBaths = null;
            $this->_data->qtrBaths = null;

            $this->_data->ensuite = null;
            $this->_data->parking = null;

            $this->_data->garageDescription = null;
            $this->_data->parkingGarage = null;
            $this->_data->parkingCarport = null;

            $this->_data->stories = null;
            $this->_data->declat = null;
            $this->_data->declong = null;
            $this->_data->adline = null;
            $this->_data->alias = null;
            $this->_data->propdesc = null;
            $this->_data->smalldesc = null;
            $this->_data->panorama = null;
            $this->_data->mediaUrl = null;
            $this->_data->mediaType = null;
            $this->_data->pdfinfo1 = null;
            $this->_data->pdfinfo2 = null;
            $this->_data->epc1 = null;
            $this->_data->epc2 = null;
            $this->_data->flpl1 = null;
            $this->_data->flpl2 = null;
            $this->_data->ctown = null;
            $this->_data->ctport = null;
            $this->_data->schooldist = null;
            $this->_data->preschool = null;
            $this->_data->primaryschool = null;
            $this->_data->highschool = null;
            $this->_data->university = null;
            $this->_data->hofees = null;

            $this->_data->AnnualInsurance = null;
            $this->_data->TaxAnnual = null;
            $this->_data->TaxYear = null;
            $this->_data->Utlities = null;
            $this->_data->ElectricService = null;
            $this->_data->AverageUtilElec = null;
            $this->_data->AverageUtilHeat = null;

            $this->_data->BasementAndFoundation = null;
            $this->_data->BasementSize = null;
            $this->_data->BasementPctFinished = null;

            $this->_data->appliances = null;
            $this->_data->indoorfeatures = null;
            $this->_data->outdoorfeatures = null;
            $this->_data->buildingfeatures = null;
            $this->_data->communityfeatures = null;
            $this->_data->otherfeatures = null;

            $this->_data->CovenantsYN = null;
            $this->_data->PhoneAvailableYN = null;
            $this->_data->GarbageDisposalYN = null;
            $this->_data->RefrigeratorYN = null;
            $this->_data->OvenYN = null;
            $this->_data->FamilyRoomPresent = null;
            $this->_data->LaundryRoomPresent = null;
            $this->_data->KitchenPresent = null;
            $this->_data->LivingRoomPresent = null;
            $this->_data->ParkingSpaceYN = null;


            $this->_data->custom1 = null;
            $this->_data->custom2 = null;
            $this->_data->custom3 = null;
            $this->_data->custom4 = null;
            $this->_data->custom5 = null;
            $this->_data->custom6 = null;
            $this->_data->custom7 = null;
            $this->_data->custom8 = null;
            $this->_data->takings = null;
            $this->_data->returns = null;
            $this->_data->netprofit = null;
            $this->_data->bustype = null;
            $this->_data->bussubtype = null;
            $this->_data->stock = null;
            $this->_data->fixtures = null;
            $this->_data->fittings = null;
            $this->_data->squarefeet = null;

            $this->_data->SqFtLower = null;
            $this->_data->SqFtMainLevel = null;
            $this->_data->SqFtUpper = null;

            $this->_data->percentoffice = null;
            $this->_data->percentwarehouse = null;
            $this->_data->loadingfac = null;
            $this->_data->fencing = null;
            $this->_data->rainfall = null;
            $this->_data->soiltype = null;
            $this->_data->grazing = null;
            $this->_data->cropping = null;
            $this->_data->irrigation = null;
            $this->_data->waterresources = null;
            $this->_data->carryingcap = null;
            $this->_data->storage = null;
            $this->_data->services = null;
            $this->_data->currency_position = null;
            $this->_data->currency = null;
            $this->_data->currency_format = null;
            $this->_data->schoolprof = null;
            $this->_data->hoodprof = null;
            $this->_data->openhouse = null;
            $this->_data->ohouse_desc = null;
            $this->_data->ohdate = null;
            $this->_data->ohstarttime = null;
            $this->_data->ohendtime = null;
            $this->_data->ohdate2 = null;
            $this->_data->ohstarttime2 = null;
            $this->_data->ohendtime2 = null;
            $this->_data->viewbooking = null;
            $this->_data->availdate = null;
            $this->_data->aucdate = null;
            $this->_data->auctime = null;
            $this->_data->aucdet = null;
            $this->_data->private = null;
            $this->_data->listdate = null;
            $this->_data->lastupdate = null;
            $this->_data->expdate = null;
            $this->_data->closedate = null;
            $this->_data->contractdate = null;
            $this->_data->hits = null;
            $this->_data->sold = null;
            $this->_data->featured = null;
            $this->_data->camtype = null;
            $this->_data->office_id = null;
            $this->_data->mls_id = null;
            $this->_data->mls_agent = null;
            $this->_data->agentInfo = null;
            $this->_data->rets_source = null;
            $this->_data->mls_disclaimer = null;
            $this->_data->mls_image = null;
            $this->_data->oh_id = null;
            $this->_data->owner = null;
            $this->_data->assoc_agent = null;
            $this->_data->email_status = null;
            $this->_data->skipimp = null;
            $this->_data->metadesc = null;
            $this->_data->metakey = null;
            $this->_data->ordering = null;
            $this->_data->published = null;
            $this->_data->language = null;
            $this->_data->checked_out = null;
            $this->_data->checked_out_time = null;
        }

		$this->_data->images = EZRealtyHelper::getImagesById($this->_id);
        return $this->_data;
    }


    function getPagination() {
        // Lets load the content if it doesn't already exist
        if (empty($this->_pagination)) {
            jimport('joomla.html.pagination');
            if (!isset($this->_total)) $this->getData();
            $this->_pagination = new JPagination( $this->_total, $this->getState('limitstart'), $this->getState('limit') );
        }
        return $this->_pagination;
    }

    function setId($id) {
        $this->_id = $id;
        $this->_data = null;
    }

    function store() {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
        $database = & JFactory::getDBO();

        $row =& $this->getTable();


        $data = JRequest::get( 'post' );
		$data['propdesc'] = JRequest::getVar('propdesc', '', 'POST', 'string', JREQUEST_ALLOWRAW);

        // Bind the form fields to the table
        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

		$cids=$_POST['cid'];

		$row->cid = $cids[0];

		if (trim($row->alias) == '') {
			$row->alias = $row->adline;
		}

		$row->alias = JApplication::stringURLSafe($row->alias);

		if (trim(str_replace('-','',$row->alias)) == '') {
			$row->alias = JFactory::getDate()->format('Y-m-d-H-i-s');
		}


		$cnid = JRequest::getVar( 'cnid' );
		$stid = JRequest::getVar( 'stid' );
		$locid = JRequest::getVar( 'locid' );

		$country = JRequest::getVar( 'country' );
		$state = JRequest::getVar( 'state' );
		$suburb = JRequest::getVar( 'suburb' );
		$pcode = JRequest::getVar( 'postcode' );

		$row->cnid = $cnid;
		$thecnid = $row->cnid;

		$row->stid = $stid;
		$thestid = $row->stid;

		$row->locid = $locid;
		$thelocid = $row->locid;


        // insert the manually entered country into the countrys table

		if ($row->country && !$cnid){

			// step 1 - check to see if the country already exists in the countrys table

			$database->setQuery( "SELECT * FROM #__ezrealty_country WHERE name LIKE '$country'" );
			$ezcont = $database->loadObjectList();
			$ezcountryexists = $ezcont[0];

			if (isset( $ezcountryexists->id )){

				$row->cnid = $ezcountryexists->id;
				$row->country = $ezcountryexists->name;
				$thecnid = $row->cnid;

			} else {

				// step 2 - find the max ordering number of the countrys

				$query = 'SELECT max(ordering) FROM #__ezrealty_country';
				$database->setQuery($query);

				$maxOrderingState = $database->loadResult();
				$theordering = intval(1 + $maxOrderingState);

				// step 3 - generate an alias for the country

				$countryalias = JApplication::stringURLSafe($row->country);

				// step 4 - insert the country into the countrys table

				$database->setQuery("INSERT INTO `#__ezrealty_country` ( `name` , `alias` , `published` , `language`, `ordering` ) VALUES ('$row->country', '$countryalias', '1', '*', '$theordering')");
				$database->query();

				// step 5 - pull out the country id out of the countrys table

				$query = "SELECT id from #__ezrealty_country"
				. "\n WHERE name = '$row->country'"
				;
				$database->setQuery( $query );
				$thecountryid = $database->loadResult();

				$row->cnid = $thecountryid;
				$thecnid = $row->cnid;

			}

			$cncount = $row->country;

		} else {

			$cncount = '';
			if (!empty($cnid)) {
				$query = "SELECT name from #__ezrealty_country"
				. "\n WHERE id = $cnid"
				;
				$database->setQuery( $query );
				$cncount = $database->loadResult();
			}

		}



        // insert the manually entered state into the states table and chain it to the state

		if ($row->state && !$row->stid){

			// step 1 - check to see if the state already exists in the states table

			$database->setQuery( "SELECT * FROM #__ezrealty_state WHERE name LIKE '$state'" );
			$ezstat = $database->loadObjectList();
			$ezstateexists = $ezstat[0];

			if (isset( $ezstateexists->id )){

				$row->stid = $ezstateexists->id;
				$row->state = $ezstateexists->name;
				$thestid = $row->stid;

			} else {

				// step 2 - find the max ordering number of the states

				$query = 'SELECT max(ordering) FROM #__ezrealty_state';
				$database->setQuery($query);

				$maxOrderingRegion = $database->loadResult();
				$theordering = intval(1 + $maxOrderingRegion);

				// step 3 - generate an alias for the state

				$statalias = JApplication::stringURLSafe($row->state);

				// step 4 - insert the state into the states table

				$database->setQuery("INSERT INTO `#__ezrealty_state` ( `name` , `countid` , `alias` , `published` , `language`, `ordering` ) VALUES ('$row->state', '$thecnid', '$statalias', '1', '*', '$theordering')");
				$database->query();

				// step 5 - pull out the state id out of the states table

				$query = "SELECT id from #__ezrealty_state"
				. "\n WHERE name = '$row->state'"
				;
				$database->setQuery( $query );
				$thestateid = $database->loadResult();

				$row->stid = $thestateid;
				$thestid = $row->stid;

			}

			$ststate = $row->state;

		} else {

			$ststate = '';
			if (!empty($stid)) {
				$query = "SELECT name from #__ezrealty_state"
				. "\n WHERE id = $stid"
				;
				$database->setQuery( $query );
				$ststate = $database->loadResult();
			}

		}

		if ( $ezrparams->get( 'er_stateloc' ) == 1){
			$whichref = $thestid;
		}
		if ( $ezrparams->get( 'er_stateloc' ) == 2 && $ezrparams->get( 'er_country' ) ){
			$whichref = $thecnid;
		}
		if ( $ezrparams->get( 'er_stateloc' ) == 2 && !$ezrparams->get( 'er_country' ) ){
			$whichref = 0;
		}



        // insert the manually entered locality into the localitys table and chain it to the state

		if ($row->locality && !$row->locid){

			// step 1 - check to see if the locality already exists in the localitys table

			$database->setQuery( "SELECT * FROM #__ezrealty_locality WHERE ezcity LIKE '$locality' AND postcode LIKE '$pcode'" );
			$ezsub = $database->loadObjectList();
			$ezlocalityexists = $ezsub[0];

			if (isset( $ezlocalityexists->id )){

				$row->locid = $ezlocalityexists->id;
				$row->locality = $ezlocalityexists->name;
				$thelocid = $row->locid;

			} else {

				// step 2 - find the max ordering number of the localitys

				$query = 'SELECT max(ordering) FROM #__ezrealty_locality';
				$database->setQuery($query);

				$maxOrderingSuburb = $database->loadResult();
				$theordering = intval(1 + $maxOrderingSuburb);

				// step 3 - generate an alias for the region

				$localias = JApplication::stringURLSafe($row->locality);

				// step 4 - insert the locality into the localitys table

				$database->setQuery("INSERT INTO `#__ezrealty_locality` ( `ezcity` , `stateid` , `alias` , `postcode` , `published` , `language`, `ordering` ) VALUES ('$row->locality', '$whichref', '$localias', '$row->postcode', '1', '*', '$theordering')");
				$database->query();

				// step 5 - pull out the locality id out of the localitys table

				$query = "SELECT id from #__ezrealty_locality"
				. "\n WHERE ezcity = '$row->locality'"
				;
				$database->setQuery( $query );
				$thelocid = $database->loadResult();

				$row->locid = $thelocid;
				$thelocid = $row->locid;

			}

			$loccity = $row->locality;

		} else {

			$loccity = '';
			if (!empty($locid)) {
				$query = "SELECT ezcity from #__ezrealty_locality"
				. "\n WHERE id = $locid"
				;
				$database->setQuery( $query );
				$loccity = $database->loadResult();
			}

		}


        // start mapping

		if ($ezrparams->get( 'er_usemap') && $row->owncoords == 0) {

			$address = $row->street_num . ' ' . $row->address2 . ', ' . $loccity . ', ' . $ststate . ', ' . $row->postcode . ', ' . $cncount;
			$address = htmlentities(urlencode($address));

			$latitude='';
			$longitude='';

			if ( $ezrparams->get( 'er_usealtmap' ) == 2 ){

				$url = "http://geocode-maps.yandex.ru/1.x/?geocode=".$address."&lang=".$ezrparams->get( 'er_maplang');
				$ymaps = simplexml_load_file($url);

				$getcoord = $ymaps->GeoObjectCollection->featureMember->GeoObject->Point->pos;

				$whichcoords = explode(" ",$getcoord);

				if ($whichcoords[0]){
					$longitude = $whichcoords[0];
				} else {
					$longitude = "";
				}
				if ($whichcoords[1]){
					$latitude = $whichcoords[1];
				} else {
					$latitude = "";
				}

				$row->declat = $latitude;
				$row->declong = $longitude; 


			} else {

				if (EZRealtyHelper::_iscurlinstalled()){

					$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$address."&sensor=false";

					if ($ch = curl_init()){

						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_HEADER,0);
						curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
						curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

						$mdata = curl_exec($ch);
						curl_close($ch);
						$geo_json = json_decode($mdata, true);
						print_r($geo_json);

						if ($geo_json['status'] == 'OK') {

							if (isset($geo_json['results'][0]['geometry']['location']['lat'])){
								$latitude = $geo_json['results'][0]['geometry']['location']['lat'];
							}
							if (isset($geo_json['results'][0]['geometry']['location']['lng'])){
								$longitude = $geo_json['results'][0]['geometry']['location']['lng'];
							}

							//echo "Latitide: $latitude \n";
							//echo "Longitude: $longitude \n";

							$row->declat = $latitude;
							$row->declong = $longitude; 

						} else {
							echo "Error in geocoding! Http error ".substr($mdata,0,3);
						}
					}

				} else {

					$url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$address."&sensor=false";

 					$delay = 0;
  					$geocode_pending = true;
  
					// load file from url
					while($geocode_pending) {
    					try {
							$xml = simplexml_load_file($url);
						}
						catch(Exception $e) {
							// return an empty array for a file request exception
							return array();
						}
    
						//get response status
						$status = $xml->status;

						if (strcmp($status, 'OK') == 0) {
							$geocode_pending = false;
      
							// get coordinates from xml response

							$latitude = $xml->result->geometry->location->lat;
							$longitude = $xml->result->geometry->location->lng;

						}
    
						// handle timeout responses and delay re-execution of geocoding
						else if (strcmp($status, 620) == 0) {
							$delay += 100000;
						}
    
						usleep($delay);
					}

					//echo "Latitide: $latitude \n";
					//echo "Longitude: $longitude \n";

					$row->declat = $latitude;
					$row->declong = $longitude; 

				}
			}
		}
		// end mapping


        // sanitize
        $row->id = intval($row->id);
        $row->cid = intval($row->cid);




		for($i=1; $i < 2+1; $i++){
			$cur_img="epc".$i;
			$new_img="epc".$i."upload";
			$zap_img="epc".$i."delete";

		    if(isset ($_REQUEST[$zap_img])){
				unlink (JPATH_ROOT.'/images/ezrealty/epc/'.$row->$cur_img);
				$row->$cur_img="";
			}else{
		        if(isset ($_REQUEST[$cur_img])){$row->$cur_img=$_REQUEST[$cur_img];}
				if($_FILES[$new_img]['name']){  $row->$cur_img=EzRealtyUploadHelper::saveEpc($_FILES[$new_img]['name'],$_FILES[$new_img]['type'],$_FILES[$new_img]['tmp_name']); }
		    }
		}

		for($i=1; $i < 2+1; $i++){
			$cur_img="flpl".$i;
			$new_img="flpl".$i."upload";
			$zap_img="flpl".$i."delete";

		    if(isset ($_REQUEST[$zap_img])){
				unlink (JPATH_ROOT.'/images/ezrealty/floorplans/'.$row->$cur_img);
				$row->$cur_img="";
			}else{
		        if(isset ($_REQUEST[$cur_img])){$row->$cur_img=$_REQUEST[$cur_img];}
				if($_FILES[$new_img]['name']){  $row->$cur_img=EzRealtyUploadHelper::saveFlpl($_FILES[$new_img]['name'],$_FILES[$new_img]['type'],$_FILES[$new_img]['tmp_name']); }
		    }
		}

		for($i=1; $i < 2+1; $i++){
			$cur_img="pdfinfo".$i;
			$new_img="pdfinfo".$i."upload";
			$zap_img="pdfinfo".$i."delete";

		    if(isset ($_REQUEST[$zap_img])){
				unlink (JPATH_ROOT.'/images/ezrealty/pdfs/'.$row->$cur_img);
				$row->$cur_img="";
			}else{
		        if(isset ($_REQUEST[$cur_img])){$row->$cur_img=$_REQUEST[$cur_img];}
				if($_FILES[$new_img]['name']){  $row->$cur_img=EzRealtyUploadHelper::savePropPdf($_FILES[$new_img]['name'],$_FILES[$new_img]['type'],$_FILES[$new_img]['tmp_name']); }
		    }
		}


        if(isset ($_REQUEST['panorama'])) {
            $row->panorama=$_REQUEST['panorama'];
        }
        if($_FILES['panoramaupload']['name']) {
            $row->panorama=EzRealtyUploadHelper::savePanoramaUpload($_FILES['panoramaupload']['name'],$_FILES['panoramaupload']['type'],$_FILES['panoramaupload']['tmp_name']);
        }

        $row->lastupdate=mktime();

        // code cleaner for xhtml transitional compliance
        $row->propdesc = str_replace( '<br>', '<br />', $row->propdesc );
        $row->postcode = str_replace( ' ', '', $row->postcode );

        // code cleaner to strip commas out of prices to prepare data for decimal data fields
        $row->price = str_replace( ',', '', $row->price );
        $row->offpeak = str_replace( ',', '', $row->offpeak );
        $row->bond = str_replace( ',', '', $row->bond );
        $row->closeprice = str_replace( ',', '', $row->closeprice );

		$row->appliances = implode ( ";",$row->appliances);
		$row->indoorfeatures = implode ( ";",$row->indoorfeatures);
		$row->outdoorfeatures = implode ( ";",$row->outdoorfeatures);
		$row->buildingfeatures = implode ( ";",$row->buildingfeatures);
		$row->communityfeatures = implode ( ";",$row->communityfeatures);
		$row->otherfeatures = implode ( ";",$row->otherfeatures);

		$todaysdate = date("Y-m-d");

		if ($row->listdate != "0000-00-00" && $row->listdate <= $todaysdate){
			$row->listdate = $row->listdate;
		} else {
			$row->listdate = date("Y-m-d");
		}


        $isNew = ( $row->id < 1 );
        if ($isNew) {
            $row->expdate=mktime(0, 0, 0, date("m"), date("d")+$ezrparams->get( 'er_expfig'), date("Y"));
        }

        // Make sure the record is valid
        if (!$row->check()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        // Store the table to the database
        if (!$row->store()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }else{


			$insert_category[]="delete from #__ezrealty_incats where property_id='".$row->id."'";
			foreach($cids as $key=>$value) {
				$insert_category[]="insert into #__ezrealty_incats(property_id,category_id)values('".$row->id."','".$value."') ";
			}
			foreach($insert_category as $sql) {
				$database->setQuery($sql);
				$database->query();
			}


        	//insert images for listing into the images table

	        $query = 'SELECT max(ordering) FROM #__ezrealty_images WHERE propid = '.intval($row->id);
	        $this->_db->setQuery($query);
	        $maxOrderingImage = $this->_db->loadResult();    	
        	for($i=0; $i<count($_FILES['imagelistings']['name']); $i++){
        		if($_FILES['imagelistings']['name'][$i]){
	        		$imageName = EZRealtyHelper::saveFileUpload($_FILES['imagelistings']['name'][$i],$_FILES['imagelistings']['type'][$i],$_FILES['imagelistings']['tmp_name'][$i]); 
	        		echo $imageName;
	        		if($imageName){
	        			$query  = '  INSERT INTO #__ezrealty_images SET ';
	        			$query .= '  propid = '.intval($row->id);
	        			$query .= ', fname = '.$db->Quote($db->escape($imageName));        			
	        			$query .= ', ordering = '.intval($i + 1 + $maxOrderingImage);
	        			$this->_db->setQuery($query);	        			
	        			$this->_db->Query();
	        		}
        		}
        	}
        	
        }

        if ($isNew) {
			if ($ezrparams->get( 'er_newnotifications')) {
				EZRealtyFHelper::newMailmsg ( $row->id );
			}
        } else {
			if ($ezrparams->get( 'er_udnotifications')) {
				EZRealtyFHelper::updateMailmsg ( $row->id );
			}
        }


        if (JRequest::getVar('applyFlag') == 0) {
			$row->checkin();
        }

        return $row->id;
    }



    function closeit()
    {
        $row =& $this->getTable();
        $data = JRequest::get( 'post' );

        // Bind the form fields to the table
        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

		$row->checkin();

        return true;
    }

	/**
	 * Method to checkin/unlock the item
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function checkin()
	{
		if ($this->_id)
		{
			$row = & $this->getTable();
			if(! $row->checkin($this->_id)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return false;
	}

	/**
	 * Method to checkout/lock the item
	 *
	 * @access	public
	 * @param	int	$uid	User ID of the user checking the article out
	 * @return	boolean	True on success
	 */
	function checkout($uid = null)
	{
		if ($this->_id)
		{
			// Make sure we have a user id to checkout the article with
			if (is_null($uid)) {
				$user	=& JFactory::getUser();
				$uid	= $user->get('id');
			}
			// Lets get to it and checkout the thing...
			$row = & $this->getTable();
			if(!$row->checkout($uid, $this->_id)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}

			return true;
		}
		return false;
	}



    /**
     * Method to delete record(s)
     *
     * @access    public
     * @return    boolean    True on success
     */
    function delete() {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

        $db =& JFactory::getDBO();
        $cids = JRequest::getVar( 'cid', array(0), 'default', 'array' );
        $row =& $this->getTable();

        foreach($cids as $cid) {

            $row->load( $cid );

			$row->images = EZRealtyHelper::getImagesById($cid);
			for($i=1; $i < count($row->images); $i++){

				if(file_exists(JPATH_ROOT.'/images/ezrealty/properties/'.$row->images[$i]->fname)){
					@unlink( JPATH_ROOT.'/images/ezrealty/properties/'.$row->images[$i]->fname );
					@unlink( JPATH_ROOT.'/images/ezrealty/properties/th/'.$row->images[$i]->fname );
				}
			}

			//delete the entries from the multicats table

			$db->setQuery( "DELETE FROM #__ezrealty_incats WHERE property_id = $row->id" );
			if ( !$db->query() ) {
				echo "<script> alert('" . $db->getErrorMsg() . "'); window.history.go(-1); </script>\n";
			}

			//delete the entries from the images table

			$db->setQuery( "DELETE FROM #__ezrealty_images WHERE propid = $cid" );
			if ( !$db->query() ) {
				echo "<script> alert('" . $db->getErrorMsg() . "'); window.history.go(-1); </script>\n";
			}

            @unlink( JPATH_ROOT.'/images/ezrealty/panorama/'.$row->panorama );

            @unlink( JPATH_ROOT.'/images/ezrealty/epc/'.$row->epc1 );
            @unlink( JPATH_ROOT.'/images/ezrealty/epc/'.$row->epc2 );

            @unlink( JPATH_ROOT.'/images/ezrealty/floorplans/'.$row->flpl1 );
            @unlink( JPATH_ROOT.'/images/ezrealty/floorplans/'.$row->flpl2 );

            @unlink( JPATH_ROOT.'/images/ezrealty/pdfs/'.$row->pdfinfo1 );
            @unlink( JPATH_ROOT.'/images/ezrealty/pdfs/'.$row->pdfinfo2 );

            if (!$row->delete( $cid )) {
                $this->setError( $row->getErrorMsg() );
                return false;
            }
        }

        return true;
    }


    function publish () {

        $db =& JFactory::getDBO();
        $cids = JRequest::getVar('cid', array(0), 'post', 'array');
        $task = JRequest::getVar('task', '', 'post');

        $pub = false;
        if ($task == 'publish') {
            $sql = "update #__ezrealty set published='1' where id in ('".implode("','", $cids)."')";
            $pub = true;
        } else {
            $sql = "update #__ezrealty set published='0' where id in ('".implode("','", $cids)."')";
        }

        $db->setQuery($sql);
        if (!$db->query() ) {
            $this->setError($db->getErrorMsg());
            return false;
        }
        return $pub;

	}


    function docheckin () {

        $db =& JFactory::getDBO();
        $cids = JRequest::getVar('cid', array(0), 'post', 'array');
        $task = JRequest::getVar('task', '', 'post');

        $thecheck = false;
        if ($task == 'checkin') {
            $sql = "update #__ezrealty set checked_out='0' where checked_out!='0'";
            $thecheck = true;
        }

        $db->setQuery($sql);
        if (!$db->query() ) {
            $this->setError($db->getErrorMsg());
            return false;
        }
        return $thecheck;

	}


	function copy() {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
        $db =& JFactory::getDBO();
		$cids = JRequest::getVar('cid', array(0), 'post', 'array');
		$row =& $this->getTable();

		$total = count( $cids );

        $docopy = false;

		for ( $i = 0; $i < $total; $i++ ) {


            // main query
			$query = "SELECT a.*"
			. "\n FROM #__ezrealty AS a"
			. "\n WHERE a.id = " . (int) $cids[$i];
			$this->_db->setQuery( $query );
			$item = $this->_db->loadObjectList();

			if ($item){

				$row->id 					= NULL;
				$row->type 					= $item[0]->type;
				$row->rent_type 			= $item[0]->rent_type;
				$row->cid 					= $item[0]->cid;
				$row->locid 				= $item[0]->locid;
				$row->stid 					= $item[0]->stid;
				$row->cnid 					= $item[0]->cnid;
				$row->soleAgency 			= '0';
				$row->bldg_name 			= $item[0]->bldg_name;
				$row->unit_num 				= $item[0]->unit_num;
				$row->lot_num 				= $item[0]->lot_num;
				$row->street_num 			= $item[0]->street_num;
				$row->address2 				= $item[0]->address2;
				$row->postcode 				= $item[0]->postcode;
				$row->county 				= $item[0]->county;
				$row->locality 				= $item[0]->locality;
				$row->state 				= $item[0]->state;
				$row->country 				= $item[0]->country;
				$row->viewad 				= $item[0]->viewad;
				$row->owncoords 			= $item[0]->owncoords;
				$row->price 				= $item[0]->price;
				$row->offpeak 				= $item[0]->offpeak;
				$row->showprice 			= $item[0]->showprice;
				$row->freq 					= $item[0]->freq;
				$row->bond 					= $item[0]->bond;
				$row->closeprice 			= $item[0]->closeprice;
				$row->priceview 			= $item[0]->priceview;
				$row->year 					= $item[0]->year;
				$row->yearRemodeled			= $item[0]->yearRemodeled;

				$row->houseStyle 			= $item[0]->houseStyle;
				$row->houseConstruction 	= $item[0]->houseConstruction;
				$row->exteriorFinish 		= $item[0]->exteriorFinish;
				$row->roof 					= $item[0]->roof;
				$row->flooring 				= $item[0]->flooring;
				$row->porchPatio 			= $item[0]->porchPatio;

				$row->landtype 				= $item[0]->landtype;
				$row->frontage 				= $item[0]->frontage;
				$row->depth 				= $item[0]->depth;

				$row->subdivision 			= $item[0]->subdivision;
				$row->LandAreaSqFt 			= $item[0]->LandAreaSqFt;
				$row->AcresTotal 			= $item[0]->AcresTotal;
				$row->LotDimensions 		= $item[0]->LotDimensions;


				$row->bedrooms 				= $item[0]->bedrooms;
				$row->sleeps 				= $item[0]->sleeps;
				$row->totalrooms 			= $item[0]->totalrooms;

				$row->otherrooms 			= $item[0]->otherrooms;

				$row->livingarea 			= $item[0]->livingarea;
				$row->bathrooms 			= $item[0]->bathrooms;
				$row->fullBaths 			= $item[0]->fullBaths;
				$row->thqtrBaths 			= $item[0]->thqtrBaths;
				$row->halfBaths 			= $item[0]->halfBaths;
				$row->qtrBaths 				= $item[0]->qtrBaths;
				$row->ensuite 				= $item[0]->ensuite;
				$row->parking 				= $item[0]->parking;

				$row->garageDescription 	= $item[0]->garageDescription;
				$row->parkingGarage 		= $item[0]->parkingGarage;
				$row->parkingCarport 		= $item[0]->parkingCarport;

				$row->stories 				= $item[0]->stories;
				$row->declat 				= $item[0]->declat;
				$row->declong 				= $item[0]->declong;
				$row->adline 				= $item[0]->adline;
				$row->alias 				= $item[0]->alias;
				$row->propdesc 				= $item[0]->propdesc;
				$row->smalldesc 			= $item[0]->smalldesc;

				$row->panorama				= EzRealtyUploadHelper::copyFile($item[0]->panorama,"panorama");

				$row->mediaUrl 				= $item[0]->mediaUrl;
				$row->mediaType 			= $item[0]->mediaType;

				$row->pdfinfo1				= EzRealtyUploadHelper::copyFile($item[0]->pdfinfo1,"pdfs");
				$row->pdfinfo2				= EzRealtyUploadHelper::copyFile($item[0]->pdfinfo2,"pdfs");
				$row->epc1					= EzRealtyUploadHelper::copyFile($item[0]->epc1,"epc");
				$row->epc2					= EzRealtyUploadHelper::copyFile($item[0]->epc2,"epc");
				$row->flpl1					= EzRealtyUploadHelper::copyFile($item[0]->flpl1,"floorplans");
				$row->flpl2					= EzRealtyUploadHelper::copyFile($item[0]->flpl2,"floorplans");

				$row->ctown 				= $item[0]->ctown;
				$row->ctport 				= $item[0]->ctport;
				$row->schooldist 			= $item[0]->schooldist;
				$row->preschool 			= $item[0]->preschool;
				$row->primaryschool 		= $item[0]->primaryschool;
				$row->highschool 			= $item[0]->highschool;
				$row->university 			= $item[0]->university;
				$row->hofees 				= $item[0]->hofees;

				$row->AnnualInsurance 		= $item[0]->AnnualInsurance;
				$row->TaxAnnual 			= $item[0]->TaxAnnual;
				$row->TaxYear 				= $item[0]->TaxYear;
				$row->Utlities 				= $item[0]->Utlities;
				$row->ElectricService 		= $item[0]->ElectricService;
				$row->AverageUtilElec 		= $item[0]->AverageUtilElec;
				$row->AverageUtilHeat 		= $item[0]->AverageUtilHeat;

				$row->BasementAndFoundation = $item[0]->BasementAndFoundation;
				$row->BasementSize 			= $item[0]->BasementSize;
				$row->BasementPctFinished 	= $item[0]->BasementPctFinished;

				$row->appliances 			= $item[0]->appliances;
				$row->indoorfeatures 		= $item[0]->indoorfeatures;
				$row->outdoorfeatures 		= $item[0]->outdoorfeatures;
				$row->buildingfeatures 		= $item[0]->buildingfeatures;
				$row->communityfeatures 	= $item[0]->communityfeatures;
				$row->otherfeatures 		= $item[0]->otherfeatures;

				$row->CovenantsYN 			= $item[0]->CovenantsYN;
				$row->PhoneAvailableYN 		= $item[0]->PhoneAvailableYN;
				$row->GarbageDisposalYN 	= $item[0]->GarbageDisposalYN;
				$row->RefrigeratorYN 		= $item[0]->RefrigeratorYN;
				$row->OvenYN 				= $item[0]->OvenYN;
				$row->FamilyRoomPresent 	= $item[0]->FamilyRoomPresent;
				$row->LaundryRoomPresent 	= $item[0]->LaundryRoomPresent;
				$row->KitchenPresent 		= $item[0]->KitchenPresent;
				$row->LivingRoomPresent 	= $item[0]->LivingRoomPresent;
				$row->ParkingSpaceYN 		= $item[0]->ParkingSpaceYN;

				$row->custom1 				= $item[0]->custom1;
				$row->custom2 				= $item[0]->custom2;
				$row->custom3 				= $item[0]->custom3;
				$row->custom4 				= $item[0]->custom4;
				$row->custom5 				= $item[0]->custom5;
				$row->custom6 				= $item[0]->custom6;
				$row->custom7 				= $item[0]->custom7;
				$row->custom8 				= $item[0]->custom8;
				$row->takings 				= $item[0]->takings;
				$row->returns 				= $item[0]->returns;
				$row->netprofit 			= $item[0]->netprofit;
				$row->bustype 				= $item[0]->bustype;
				$row->bussubtype 			= $item[0]->bussubtype;
				$row->stock 				= $item[0]->stock;
				$row->fixtures 				= $item[0]->fixtures;
				$row->fittings 				= $item[0]->fittings;
				$row->squarefeet 			= $item[0]->squarefeet;

				$row->SqFtLower 			= $item[0]->SqFtLower;
				$row->SqFtMainLevel 		= $item[0]->SqFtMainLevel;
				$row->SqFtUpper 			= $item[0]->SqFtUpper;

				$row->percentoffice 		= $item[0]->percentoffice;
				$row->percentwarehouse 		= $item[0]->percentwarehouse;
				$row->loadingfac 			= $item[0]->loadingfac;
				$row->fencing 				= $item[0]->fencing;
				$row->rainfall 				= $item[0]->rainfall;
				$row->soiltype 				= $item[0]->soiltype;
				$row->grazing 				= $item[0]->grazing;
				$row->cropping 				= $item[0]->cropping;
				$row->irrigation 			= $item[0]->irrigation;
				$row->waterresources 		= $item[0]->waterresources;
				$row->carryingcap 			= $item[0]->carryingcap;
				$row->storage 				= $item[0]->storage;
				$row->services 				= $item[0]->services;
				$row->currency_position 	= $item[0]->currency_position;
				$row->currency 				= $item[0]->currency;
				$row->currency_format 		= $item[0]->currency_format;
				$row->schoolprof 			= $item[0]->schoolprof;
				$row->hoodprof 				= $item[0]->hoodprof;
				$row->openhouse 			= $item[0]->openhouse;
				$row->ohouse_desc 			= $item[0]->ohouse_desc;
				$row->ohdate 				= $item[0]->ohdate;
				$row->ohstarttime 			= $item[0]->ohstarttime;
				$row->ohendtime 			= $item[0]->ohendtime;
				$row->ohdate2 				= $item[0]->ohdate2;
				$row->ohstarttime2 			= $item[0]->ohstarttime2;
				$row->ohendtime2 			= $item[0]->ohendtime2;
				$row->viewbooking 			= $item[0]->viewbooking;
				$row->availdate 			= $item[0]->availdate;
				$row->aucdate 				= $item[0]->aucdate;
				$row->auctime 				= $item[0]->auctime;
				$row->aucdet 				= $item[0]->aucdet;
				$row->private 				= $item[0]->private;
				$row->listdate 				= date("Y-m-d");
				$row->lastupdate 			= mktime();
				$row->expdate 				= mktime(0, 0, 0, date("m"), date("d")+$ezrparams->get( 'er_expfig'), date("Y"));
				$row->closedate 			= $item[0]->closedate;
				$row->contractdate 			= $item[0]->contractdate;
				$row->hits 					= 0;
				$row->sold 					= $item[0]->sold;
				$row->featured 				= $item[0]->featured;
				$row->camtype 				= $item[0]->camtype;
				$row->office_id 			= $item[0]->office_id;
				$row->mls_id 				= $item[0]->mls_id;
				$row->mls_agent 			= $item[0]->mls_agent;
				$row->agentInfo 			= $item[0]->agentInfo;
				$row->rets_source 			= $item[0]->rets_source;
				$row->mls_disclaimer 		= $item[0]->mls_disclaimer;
				$row->mls_image 			= $item[0]->mls_image;
				$row->oh_id 				= $item[0]->oh_id;
				$row->owner 				= $item[0]->owner;
				$row->assoc_agent 			= $item[0]->assoc_agent;
				$row->email_status 			= '0';
				$row->skipimp 				= '0';
				$row->metadesc 				= $item[0]->metadesc;
				$row->metakey 				= $item[0]->metakey;
				$row->ordering 				= $item[0]->ordering;
				$row->published 			= 0;
				$row->language 				= $item[0]->language;
				$row->checked_out 			= 0;
				$row->checked_out_time 		= '';

				$getcats 					= $item[0]->id;

				if (!$row->check()) {
					echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
					exit();
				}
				if (!$row->store()) {
					echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
					exit();
				}

				# create the property categories

				$db->setQuery("select DISTINCT * from #__ezrealty_catg as c INNER JOIN #__ezrealty_incats as ic on ic.category_id=c.id where ic.property_id='$getcats'");
				$categories=$db->loadObjectList();

				foreach($categories as $category) {

        			$query  = "INSERT INTO #__ezrealty_incats SET property_id = ".intval($row->id).", `category_id` = ".intval($category->category_id);
        			$db->setQuery($query);	        			
        			$db->Query();

				}

				# define the absolute directory paths
				$mainPath = JPATH_SITE."/images/ezrealty/properties";
				$thumbPath = JPATH_SITE."/images/ezrealty/properties/th";

				# create the image copies

				$db->setQuery("select * from #__ezrealty_images where propid='$getcats' order by ordering");
				$images=$db->loadObjectList();

				foreach($images as $image) {

					$query = 'SELECT max(ordering) FROM #__ezrealty_images WHERE propid = '.intval($row->id);
					$db->setQuery($query);

					$maxOrderingImage = $db->loadResult();

					$newimage				= EzRealtyUploadHelper::copyFile($image->fname,"properties");
					EzRealtyUploadHelper::resize_thumb($mainPath."/".$newimage, $thumbPath."/".$newimage, $ezrparams->get( 'newthumbwidth'), $ezrparams->get( 'er_thumbcreation'), $ezrparams->get( 'er_thumbquality') );


        			$query  = "INSERT INTO #__ezrealty_images SET propid = ".intval($row->id).", `fname` = '$newimage', `title` = '".$db->escape($image->title, true )."', `description` = '".$db->escape($image->description, true )."', `path` = '$image->path', `rets_source` = '$image->rets_source', `ordering` = ".intval($image->ordering);
        			$db->setQuery($query);	        			
        			$db->Query();

				}

				$docopy = true;

			} else {
			}
		}
        return $docopy;

	}



	function orderImage( $uid, $inc )
	{
		// Initialize variables
		$db		=& JFactory::getDBO();
		$row =& $this->getTable('images');
		$row->load( $uid );
		$row->move( $inc, 'propid = ' . (int) $row->propid );
		$row->reorder('propid = '.(int) $row->propid);

	}

	function updateImageOrder( $uid )
	{
		// Initialize variables
		$db		=& JFactory::getDBO();
		$row =& $this->getTable('images');
		$row->load( $uid );
		$row->reorder('propid = '.(int) $row->propid);

	}



    function imgregen() {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

        $db =& JFactory::getDBO();
        $cids = JRequest::getVar( 'cid', array(0), 'default', 'array' );
        $row =& $this->getTable();

        foreach($cids as $cid) {

            $row->load( $cid );

			$row->images = EZRealtyHelper::getImagesById($cid);
			for($i=0; $i < count($row->images); $i++){

				if(file_exists(JPATH_ROOT.'/images/ezrealty/properties/'.$row->images[$i]->fname)){
					@unlink( JPATH_ROOT.'/images/ezrealty/properties/th/'.$row->images[$i]->fname );
					EzRealtyUploadHelper::resize_thumb(JPATH_ROOT.'/images/ezrealty/properties/'.$row->images[$i]->fname, JPATH_ROOT.'/images/ezrealty/properties/th/'.$row->images[$i]->fname, $ezrparams->get( 'newthumbwidth'), $ezrparams->get( 'er_thumbcreation'), $ezrparams->get( 'er_thumbquality') );
				}
			}
        }

        return true;
    }



}


?>
