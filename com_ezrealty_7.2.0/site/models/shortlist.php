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

jimport('joomla.application.component.model');

/**
 * Ezrealty Component transaction type Model
 *
 * @package		EZ Realty
 *
 */
class EzrealtysModelShortlist extends JModelLegacy
{

	/**
	 * Transaction type data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Transaction type total
	 *
	 * @var integer
	 */
	var $_total = null;

	/**
	 * Pagination object
	 *
	 * @var object
	 */
	var $_pagination = null;



	/**
	 * Constructor
	 *
	 */
	function __construct()
	{
		parent::__construct();

		$app		= JFactory::getApplication();

		// Get the pagination request variables
		$this->setState('limit', $app->getUserStateFromRequest('com_ezrealty.limit', 'limit', '20', 'int'));
		$this->setState('limitstart', JRequest::getVar('limitstart', 0, '', 'int'));

		// In case limit has been changed, adjust limitstart accordingly
		$this->setState('limitstart', ($this->getState('limit') != 0 ? (floor($this->getState('limitstart') / $this->getState('limit')) * $this->getState('limit')) : 0));

	}

	/**
	 * Method to get item data for the Transaction type
	 *
	 */
	function getData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));

			$total = count($this->_data);
			for($i = 0; $i < $total; $i++)
			{
				$item =& $this->_data[$i];
				$item->slug = $item->id.':'.$item->alias;
			}
		}

		return $this->_data;
	}

	/**
	 * Method to get the total number of items for the Transaction type
	 *
	 */
	function getTotal()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_total))
		{
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}

		return $this->_total;
	}

	/**
	 * Method to get a pagination object of the items for the Transaction type
	 *
	 */
	function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}

		return $this->_pagination;
	}

	function _buildQuery()
	{

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		$where		= $this->_buildContentWhere();
		$orderby		= $this->_buildContentOrderBy();

        if (empty ($this->_data)) {

		if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){

			$query = 'SELECT distinct(a.id),a.*, lb.id AS litem, cc.name AS category, dd.ezcity AS proploc, ee.name AS statename, ff.name AS cnname, ss.seller_name AS dealer_name, ss.seller_email AS dealer_email, 
			ss.seller_phone AS dealer_phone, ss.seller_mobile AS dealer_mobile, ss.seller_company AS dealer_company, ss.seller_image AS dealer_image, ss.seller_logo AS logo_image, ss.published AS dealerpublished, gg.title AS dealer_type, '
			. ' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', a.id, a.alias) ELSE a.id END as slug, '
			. ' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(\':\', cc.id, cc.alias) ELSE cc.id END as catslug, '
			. ' CASE WHEN CHAR_LENGTH(dd.alias) THEN CONCAT_WS(\':\', dd.id, dd.alias) ELSE dd.id END as subslug, '
			. ' CASE WHEN CHAR_LENGTH(ee.alias) THEN CONCAT_WS(\':\', ee.id, ee.alias) ELSE ee.id END as statslug '
				. ' FROM #__ezrealty AS a'
				. ' LEFT JOIN #__ezrealty_lightbox AS lb ON lb.propid = a.id'
				. ' LEFT JOIN #__ezrealty_catg AS cc ON cc.id = a.cid'
				. ' INNER JOIN #__ezrealty_incats as pc on pc.property_id = a.id'
				. ' LEFT JOIN #__ezrealty_catg as ac on ac.id = pc.category_id'
				. ' LEFT JOIN #__ezrealty_locality AS dd ON dd.id = a.locid'
				. ' LEFT JOIN #__ezrealty_state AS ee ON ee.id = a.stid'
				. ' LEFT JOIN #__ezrealty_country AS ff ON ff.id = a.cnid'
				. ' LEFT JOIN #__ezportal AS ss ON ss.uid = a.owner'
				. ' LEFT JOIN #__ezportal_catg AS gg ON gg.id = ss.cid'
				. $where
				. $orderby
				;

		} else {

			$query = 'SELECT distinct(a.id),a.*, lb.id AS litem, cc.name AS category, dd.ezcity AS proploc, ee.name AS statename, ff.name AS cnname, ss.seller_name AS dealer_name, ss.seller_phone AS dealer_phone, ss.seller_logo AS logo_image, '
			. ' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', a.id, a.alias) ELSE a.id END as slug, '
			. ' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(\':\', cc.id, cc.alias) ELSE cc.id END as catslug, '
			. ' CASE WHEN CHAR_LENGTH(dd.alias) THEN CONCAT_WS(\':\', dd.id, dd.alias) ELSE dd.id END as subslug, '
			. ' CASE WHEN CHAR_LENGTH(ee.alias) THEN CONCAT_WS(\':\', ee.id, ee.alias) ELSE ee.id END as statslug '
				. ' FROM #__ezrealty AS a'
				. ' LEFT JOIN #__ezrealty_lightbox AS lb ON lb.propid = a.id'
				. ' LEFT JOIN #__ezrealty_catg AS cc ON cc.id = a.cid'
				. ' INNER JOIN #__ezrealty_incats as pc on pc.property_id = a.id'
				. ' LEFT JOIN #__ezrealty_catg as ac on ac.id = pc.category_id'
				. ' LEFT JOIN #__ezrealty_locality AS dd ON dd.id = a.locid'
				. ' LEFT JOIN #__ezrealty_state AS ee ON ee.id = a.stid'
				. ' LEFT JOIN #__ezrealty_country AS ff ON ff.id = a.cnid'
				. ' LEFT JOIN #__ezportal AS ss ON ss.uid = a.owner'
				. $where
				. $orderby
				;

		}

            $this->_total = $this->_getListCount($query);
            if ($this->getState('limitstart') >= $this->_total) $this->setState('limitstart', 0);
            if ($this->getState('limitstart') > 0 && $this->getState('limit') == 0)  $this->setState('limitstart', 0);
            $this->_buildQuery = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
        }
//echo $query;
		return $query;
	}


	function _buildContentOrderBy()
	{
		$params = JComponentHelper::getParams ('com_ezrealty');
		$app		= JFactory::getApplication();

		$which_order		= $app->getUserStateFromRequest( 'com_ezrealty.which_order',		'which_order',		'a.featured desc, '.$params->get( 'defordering' ),			'string' );

		if ( $which_order ){
			$orderby 	= ' ORDER BY '.$which_order;
		} else {
			$orderby 	= ' ORDER BY a.featured desc, '.$params->get( 'defordering' );
		}

		return $orderby;

	}


	function _buildContentWhere() {

		$app		= JFactory::getApplication();
		$params 	= $app->getParams();

		$user = JFactory::getUser();
		$groups = implode(',', $user->getAuthorisedViewLevels());


		$db					=& JFactory::getDBO();
		$filter_a3cid		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3cid',		'filter_a3cid',		0,				'int' );
		$filter_a3type		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3type',		'filter_a3type',		0,				'int' );
		$filter_a3sold		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3sold',		'filter_a3sold',		0,				'int' );
		$filter_a3seller	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3seller',		'filter_a3seller',	0,				'int' );
		$filter_a3country	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3country',	'filter_a3country',	-1,				'int' );
		$filter_a3state		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3state',		'filter_a3state',	-1,				'int' );
		$filter_a3locality	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3locality',	'filter_a3locality',	0,				'int' );
		$filter_a3minprice	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3minprice',	'filter_a3minprice',	'',				'char' );
		$filter_a3maxprice	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3maxprice',	'filter_a3maxprice',	'',				'char' );
		$filter_a3minbed	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3minbed',		'filter_a3minbed',	0,				'char' );
		$filter_a3minbaths	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3minbaths',	'filter_a3minbaths',	0,				'char' );
		$filter_a3custom1	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3custom1',	'filter_a3custom1',	'',				'string' );
		$filter_a3minarea	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3minarea',	'filter_a3minarea',	'',				'char' );
		$filter_a3maxarea	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3maxarea',	'filter_a3maxarea',	'',				'char' );
		$filter_a3search	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3search',		'filter_a3search',	'',				'string' );
		$filter_a3radius	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3radius',	'filter_a3radius',			'NULL',		'string' );

		$filter_a3minland			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3minland',			'filter_a3minland',			'',				'string' );
		$filter_a3maxland			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3maxland',			'filter_a3maxland',			'',				'string' );
		$filter_a3landtype			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a3landtype',			'filter_a3landtype',		0,				'int' );

		if ( file_exists(JPATH_SITE . '/administrator/components/com_realtybookings/realtybookings.php') ) {
			if ( $params->get( 'use_realtybookings' ) && $params->get( 'show_dates_select' ) ) {
				$filter_a3begin		= $app->getUserStateFromRequest( 'com_realtybookings.filter_a3begin',	'filter_a3begin',	'', 'string' );
				$filter_a3end			= $app->getUserStateFromRequest( 'com_realtybookings.filter_a3end',	'filter_a3end',	'', 'string' );
			}
		}

		if (strpos($filter_a3search, '"') !== false) {
			$filter_a3search = str_replace(array('=', '<'), '', $filter_a3search);
		}
		$filter_a3search = JString::strtolower($filter_a3search);


		$where = array();


		if($filter_a3landtype == '2') {
			if ($filter_a3minland != '') {
				$a3minland = preg_replace("/[^0-9.]/", "", $filter_a3minland);

				if ($a3minland != '') {
					$where[] = 'a.AcresTotal >= '.$db->escape($a3minland, true );
				}
			}
			if ($filter_a3maxland != '') {
				$a3maxland = preg_replace("/[^0-9.]/", "", $filter_a3maxland);

				if ($a3maxland != '') {
					$where[] = 'a.AcresTotal <= '.$db->escape($a3maxland, true );
				}
			}
		} else if ($filter_a3landtype == '1') {
			if ($filter_a3minland != '') {
				$a3minland = preg_replace("/[^0-9.]/", "", $filter_a3minland);

				if ($a3minland != '') {
					$where[] = 'a.LandAreaSqFt >= '.$db->escape($a3minland, true );
				}
			}
			if ($filter_a3maxland != '') {
				$a3maxland = preg_replace("/[^0-9.]/", "", $filter_a3maxland);

				if ($a3maxland != '') {
					$where[] = 'a.LandAreaSqFt <= '.$db->escape($a3maxland, true );
				}
			}
		} else {
		}



		if($filter_a3radius != 'NULL' && $filter_a3radius != '') {
			$radcheck = "1";
		} else {
			$radcheck = "0";
		}
		if ($filter_a3locality > 0 && $radcheck == 0) {
			$where[] = 'a.locid = '.(int) $filter_a3locality;
		}
		if ($filter_a3state > 0 && $radcheck == 0) {
			$where[] = 'a.stid = '.(int) $filter_a3state;
		}
		if ($filter_a3country > 0 && $radcheck == 0) {
			$where[] = 'a.cnid = '.(int) $filter_a3country;
		}


		if ($filter_a3custom1 != '') {
			$where[] = 'a.custom1 = "'.$db->escape($filter_a3custom1, true ).'"';
		}
		if ($filter_a3cid > 0) {
			$where[] = 'pc.category_id = '.(int) $filter_a3cid;
		}
		if ($filter_a3type > 0) {
			$where[] = 'a.type = '.(int) $filter_a3type;
		}
		if ($filter_a3sold > 0) {
			$where[] = 'a.sold = '.(int) $filter_a3sold;
		}
		if ($filter_a3seller > 0) {
			$where[] = 'a.owner = '.(int) $filter_a3seller;
		}

		if ($filter_a3minprice != '') {
			$a3minprice = preg_replace("/[^0-9.]/", "", $filter_a3minprice);
			if ($a3minprice != '') {
				$where[] = 'a.price >= '.$db->escape($a3minprice, true );
			}
		}
		if ($filter_a3maxprice != '') {
			$a3maxprice = preg_replace("/[^0-9.]/", "", $filter_a3maxprice);
			if ($a3maxprice != '') {
				$where[] = 'a.price <= '.$db->escape($a3maxprice, true );
			}
		}

		if ($filter_a3minarea != '') {
			$where[] = 'a.squarefeet >= '.$db->escape($filter_a3minarea, true );
		}
		if ($filter_a3maxarea != '') {
			$where[] = 'a.squarefeet <= '.$db->escape($filter_a3maxarea, true );
		}
		if ($filter_a3minbed > 0) {
			$where[] = 'a.bedrooms >= '.(int) $filter_a3minbed;
		}
		if ($filter_a3minbaths != '') {
			$where[] = 'a.bathrooms >= '.(int) $filter_a3minbaths;
		}

		if ( $params->get( 'er_expmgmt')==1 ) {
			$currentdate=mktime(0, 0, 0, date("m"), date("d"), date("Y"));
			$where[] = 'a.expdate> '.$currentdate;
        }

		if (JFactory::getApplication()->getLanguageFilter()) {
			$where[] = 'a.language in (' . $db->Quote(JFactory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')';
		}

		if ( file_exists(JPATH_SITE . '/administrator/components/com_realtybookings/realtybookings.php') ) {
			if ( $params->get( 'use_realtybookings' ) && $params->get( 'show_dates_select' ) ) {
				if ($filter_a3begin != '' && $filter_a3end != '') {
					$where[] = "a.id NOT IN (SELECT id FROM #__realtybookings WHERE date BETWEEN '".$db->escape($filter_a3begin, true )."' AND '".$db->escape($filter_a3end, true )."')";
				}
			}
		}

		if ($filter_a3search) {
			$where[] = '(LOWER(a.mls_id) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.office_id) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.id) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.county) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.ctown) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.ctport) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.schooldist) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.preschool) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.primaryschool) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.highschool) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.appliances) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.indoorfeatures) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.outdoorfeatures) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.buildingfeatures) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.communityfeatures) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.otherfeatures) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.custom1) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.custom2) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.custom3) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.custom4) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.custom5) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.custom6) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.custom7) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.custom8) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.adline) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.smalldesc) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.propdesc) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(a.postcode) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(dd.ezcity) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(ee.name) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false )
.'OR LOWER(ff.name) LIKE '.$db->Quote( '%'.$db->escape( $filter_a3search, true ).'%', false ).')'
;
		}

		if($filter_a3locality) {
			if($radcheck) {

				//$filter_a3radius = 1;

				if ($params->get( 'er_radius_dist') ){
					$radius = $params->get( 'er_radius_dist');
				} else {
					$radius = 15;
				}

				$postcode = EZRealtyFHelper::getPostcodeById($filter_a3locality);

				if ($postcode){

					$found_post_codes = EZRealtyFHelper::get_pcodes_in_range ($postcode, $radius);

					// If some zips were found we create an IN query.
					if (count($found_post_codes) > 0) {
						$wherepostcode =" a.postcode IN (";
	
						foreach($found_post_codes as $pcodes => $dists)
						$wherepostcode .= '"' . $pcodes . '", ';
	
						$wherepostcode .= '"00000")';
	
						$where[] = $wherepostcode;
					}

				} else {
					$where[] = 'a.postcode = "ZZZZZ"';
				}
			}
		}


		$where[] = 'lb.uid= '.$user->id;
		$where[] = 'ac.access IN (' . $groups . ')';
		$where[] = 'ac.published = 1';
		$where[] = 'a.published = 1';


		$where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );

		return $where;
	}



	function getProfileList() {	

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		if ($ezrparams->get('deflistorder') == 1) {
			$orderby 	= ' ORDER BY ss.seller_name';
		} else {
			$orderby 	= ' ORDER BY ss.ordering';
		}

		$query = "SELECT ss.uid AS value, ss.seller_name AS text"
		. "\n FROM #__ezportal as ss WHERE ss.published = 1"
		. "\n $orderby ";

        $this->_db->setQuery( $query );
        $lists = $this->_db->loadObjectlist();    
		
		return $lists;
	}

	function getCountryList() {	

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

        if ($ezrparams->get('deflistorder') == 1) {
			$orderby 	= ' ORDER BY c.name';
		} else {
			$orderby 	= ' ORDER BY c.ordering';
		}

		if (JFactory::getApplication()->getLanguageFilter()) {
			$db			=& JFactory::getDBO();
			$where = 'c.published = 1 AND c.language in (' . $db->Quote(JFactory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')';
		} else {
			$where = 'c.published = 1';
		}

        $query = "SELECT c.id AS value, c.name AS text"
        . "\n FROM #__ezrealty_country as c"
        . "\n WHERE ". $where
        . "\n GROUP BY c.id"
        . "\n $orderby ";
        $this->_db->setQuery( $query );
        $lists = $this->_db->loadObjectlist();    
		
		return $lists;
	}	    

	function getStateList() {	

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

        if ($ezrparams->get('deflistorder') == 1) {
			$orderby 	= ' ORDER BY c.name';
		} else {
			$orderby 	= ' ORDER BY c.ordering';
		}

		if (JFactory::getApplication()->getLanguageFilter()) {
			$db			=& JFactory::getDBO();
			$where = 'c.published = 1 AND c.language in (' . $db->Quote(JFactory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')';
		} else {
			$where = 'c.published = 1';
		}

        $query = "SELECT c.id AS value, c.name AS text"
        . "\n FROM #__ezrealty_state as c"
        . "\n WHERE ". $where
        . "\n GROUP BY c.id"
        . "\n $orderby ";
        $this->_db->setQuery( $query );
        $lists = $this->_db->loadObjectlist();    
		
		return $lists;
	}	  

    function getLocalityPublishedList() {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

        if ($ezrparams->get('deflistorder') == 1) {
			$orderby 	= ' ORDER BY b.ezcity';
		} else {
			$orderby 	= ' ORDER BY b.ordering';
		}

		if (JFactory::getApplication()->getLanguageFilter()) {
			$db			=& JFactory::getDBO();
			$where = 'b.published = 1 AND b.language in (' . $db->Quote(JFactory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')';
		} else {
			$where = 'b.published = 1';
		}

        $query = "SELECT b.id AS value, b.ezcity AS text"
		. "\n FROM #__ezrealty_locality AS b"
		. "\n WHERE ". $where
        . "\n $orderby ";
        //Log::debug($query);
        $this->_db->setQuery( $query );
        $ordering = $this->_db->loadObjectlist();    
        
        return $ordering;
    }    

	function getCategoryList() {	

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

        if ($ezrparams->get('deflistorder') == 1) {
			$orderby 	= ' ORDER BY c.name';
		} else {
			$orderby 	= ' ORDER BY c.ordering';
		}

		if (JFactory::getApplication()->getLanguageFilter()) {
			$db			=& JFactory::getDBO();
			$where = 'c.published = 1 AND c.language in (' . $db->Quote(JFactory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')';
		} else {
			$where = 'c.published = 1';
		}

        $query = "SELECT c.id AS value, c.name AS text"
        . "\n FROM #__ezrealty_catg as c"
        . "\n WHERE ". $where
        . "\n $orderby ";
        $this->_db->setQuery( $query );
        $lists = $this->_db->loadObjectlist();    
		
		return $lists;
	}	      

    function getCustom1List() {

        # Build custom 1 select list

		if (JFactory::getApplication()->getLanguageFilter()) {
			$db			=& JFactory::getDBO();
			$where = 't.published = 1 AND t.custom1 != "" AND t.language in (' . $db->Quote(JFactory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')';
		} else {
			$where = 't.published = 1 AND t.custom1 != ""';
		}

        $query = "SELECT DISTINCT t.custom1 as value, t.custom1 as text"
        . "\n FROM #__ezrealty as t"
        . "\n WHERE ". $where
        . "\n ORDER BY t.custom1";
        $this->_db->setQuery( $query );
        $lists = $this->_db->loadObjectlist();    
		
		return $lists;

    }    


}



?>