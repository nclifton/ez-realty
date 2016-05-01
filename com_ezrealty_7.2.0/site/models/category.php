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
 * Ezrealty Component category Model
 *
 * @package		EZ Realty
 *
 */
class EzrealtysModelCategory extends JModelLegacy
{
	/**
	 * Category id
	 *
	 * @var int
	 */
	var $_id = null;

	/**
	 * Category data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Category total
	 *
	 * @var integer
	 */
	var $_total = null;

	/**
	 * Category data
	 *
	 * @var object
	 */
	var $_category = null;

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
		$this->setState('limit', $app->getUserStateFromRequest('com_ezrealty.limit', 'limit', $app->getCfg('list_limit'), 'int'));
		$this->setState('limitstart', JRequest::getVar('limitstart', 0, '', 'int'));

		// In case limit has been changed, adjust limitstart accordingly
		$this->setState('limitstart', ($this->getState('limit') != 0 ? (floor($this->getState('limitstart') / $this->getState('limit')) * $this->getState('limit')) : 0));

		$id = JRequest::getVar('id', 0, '', 'int');
		$this->setId((int)$id);
	}

	/**
	 * Method to set the category id
	 *
	 * @param	int	Category ID number
	 */
	function setId($id)
	{
		// Set category ID and wipe data
		$this->_id			= $id;
		$this->_category	= null;
	}

	/**
	 * Method to get item data for the category
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
	 * Method to get the total number of items for the subcategory
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
	 * Method to get a pagination object of the items for the subcategory
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

	/**
	 * Method to get category data for the current category
	 *
	 */
	function getCategory()
	{
		// Load the Category data
		if ($this->_loadCategory())

		return $this->_category;
	}

	/**
	 * Method to load category data if it doesn't exist.
	 *
	 * @return	boolean	True on success
	 */
	function _loadCategory()
	{

		$params = JComponentHelper::getParams ('com_ezrealty');

		if (empty($this->_category))
		{

			// current category info
			$query = 'SELECT c.*, ' .
				' CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(\':\', c.id, c.alias) ELSE c.id END as slug '.
				' FROM #__ezrealty_catg AS c' .
				' WHERE c.id = '. (int) $this->_id ;
			$this->_db->setQuery($query, 0, 1);
			$this->_category = $this->_db->loadObject();

		}
		return true;
	}

	function _buildQuery()
	{

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		$where		= $this->_buildContentWhere();
		$orderby	= $this->_buildContentOrderBy();

		// We need to get a list of all listings in the given category

        if (empty ($this->_data)) {

		if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){

			$query = 'SELECT distinct(a.id),a.*, cc.name AS category, ac.access AS memaccess, dd.ezcity AS proploc, ee.name AS statename, ff.name AS cnname, ss.seller_name AS dealer_name, ss.seller_email AS dealer_email, 
			ss.seller_phone AS dealer_phone, ss.seller_mobile AS dealer_mobile, ss.seller_company AS dealer_company, ss.seller_image AS dealer_image, ss.seller_logo AS logo_image, ss.published AS dealerpublished, gg.title AS dealer_type, '
			. ' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', a.id, a.alias) ELSE a.id END as slug, '
			. ' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(\':\', cc.id, cc.alias) ELSE cc.id END as catslug, '
			. ' CASE WHEN CHAR_LENGTH(dd.alias) THEN CONCAT_WS(\':\', dd.id, dd.alias) ELSE dd.id END as subslug, '
			. ' CASE WHEN CHAR_LENGTH(ee.alias) THEN CONCAT_WS(\':\', ee.id, ee.alias) ELSE ee.id END as statslug '
			. ' FROM #__ezrealty AS a'
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

			$query = 'SELECT distinct(a.id),a.*, cc.name AS category, ac.access AS memaccess, dd.ezcity AS proploc, ee.name AS statename, ff.name AS cnname, ss.seller_name AS dealer_name, ss.seller_phone AS dealer_phone, ss.seller_logo AS logo_image, '
			. ' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', a.id, a.alias) ELSE a.id END as slug, '
			. ' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(\':\', cc.id, cc.alias) ELSE cc.id END as catslug, '
			. ' CASE WHEN CHAR_LENGTH(dd.alias) THEN CONCAT_WS(\':\', dd.id, dd.alias) ELSE dd.id END as subslug, '
			. ' CASE WHEN CHAR_LENGTH(ee.alias) THEN CONCAT_WS(\':\', ee.id, ee.alias) ELSE ee.id END as statslug '
			. ' FROM #__ezrealty AS a'
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
		$filter_a1type		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1type',			'filter_a1type',		0,			'int' );
		$filter_a1sold		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1sold',			'filter_a1sold',		0,			'int' );
		$filter_a1seller	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1seller',		'filter_a1seller',		0,			'int' );
		$filter_a1country	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1country',		'filter_a1country',		-1,			'int' );
		$filter_a1state		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1state',			'filter_a1state',		-1,			'int' );
		$filter_a1locality	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1locality',		'filter_a1locality',	0,			'int' );
		$filter_a1minprice	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1minprice',		'filter_a1minprice',	'',			'char' );
		$filter_a1maxprice	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1maxprice',		'filter_a1maxprice',	'',			'char' );
		$filter_a1minbed	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1minbed',		'filter_a1minbed',		0,			'char' );
		$filter_a1minbaths	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1minbaths',		'filter_a1minbaths',	0,			'char' );
		$filter_a1custom1	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1custom1',		'filter_a1custom1',		'',			'string' );
		$filter_a1minarea	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1minarea',		'filter_a1minarea',		'',			'char' );
		$filter_a1maxarea	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1maxarea',		'filter_a1maxarea',		'',			'char' );
		$filter_a1search	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1search',		'filter_a1search',		'',			'string' );
		$filter_a1radius	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1radius',		'filter_a1radius',		'NULL',		'string' );

		$filter_a1minland			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1minland',			'filter_a1minland',			'',				'string' );
		$filter_a1maxland			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1maxland',			'filter_a1maxland',			'',				'string' );
		$filter_a1landtype			= $app->getUserStateFromRequest( 'com_ezrealty.filter_a1landtype',			'filter_a1landtype',		0,				'int' );

		if ( file_exists(JPATH_SITE . '/administrator/components/com_realtybookings/realtybookings.php') ) {
			if ( $params->get( 'use_realtybookings' ) && $params->get( 'show_dates_select' ) ) {
				$filter_a1begin		= $app->getUserStateFromRequest( 'com_realtybookings.filter_a1begin',	'filter_a1begin',	'', 'string' );
				$filter_a1end		= $app->getUserStateFromRequest( 'com_realtybookings.filter_a1end',	'filter_a1end',	'', 'string' );
			}
		}

		if (strpos($filter_a1search, '"') !== false) {
			$filter_a1search = str_replace(array('=', '<'), '', $filter_a1search);
		}
		$filter_a1search = JString::strtolower($filter_a1search);


		$where = array();


		if($filter_a1landtype == '2') {
			if ($filter_a1minland != '') {
				$a1minland = preg_replace("/[^0-9.]/", "", $filter_a1minland);

				if ($a1minland != '') {
					$where[] = 'a.AcresTotal >= '.$db->escape($a1minland, true );
				}
			}
			if ($filter_a1maxland != '') {
				$a1maxland = preg_replace("/[^0-9.]/", "", $filter_a1maxland);

				if ($a1maxland != '') {
					$where[] = 'a.AcresTotal <= '.$db->escape($a1maxland, true );
				}
			}
		} else if ($filter_a1landtype == '1') {
			if ($filter_a1minland != '') {
				$a1minland = preg_replace("/[^0-9.]/", "", $filter_a1minland);

				if ($a1minland != '') {
					$where[] = 'a.LandAreaSqFt >= '.$db->escape($a1minland, true );
				}
			}
			if ($filter_a1maxland != '') {
				$a1maxland = preg_replace("/[^0-9.]/", "", $filter_a1maxland);

				if ($a1maxland != '') {
					$where[] = 'a.LandAreaSqFt <= '.$db->escape($a1maxland, true );
				}
			}
		} else {
		}


		if($filter_a1radius != 'NULL' && $filter_a1radius != '') {
			$radcheck = "1";
		} else {
			$radcheck = "0";
		}

		if ($filter_a1locality > 0 && $radcheck == 0) {
			$where[] = 'a.locid = '.(int) $filter_a1locality;
		}
		if ($filter_a1state > 0 && $radcheck == 0) {
			$where[] = 'a.stid = '.(int) $filter_a1state;
		}
		if ($filter_a1country > 0 && $radcheck == 0) {
			$where[] = 'a.cnid = '.(int) $filter_a1country;
		}



		if ($filter_a1type > 0) {
			$where[] = 'a.type = '.(int) $filter_a1type;
		}
		if ($filter_a1sold > 0) {
			$where[] = 'a.sold = '.(int) $filter_a1sold;
		}
		if ($filter_a1seller > 0) {
			$where[] = 'a.owner = '.(int) $filter_a1seller;
		}
		if ($filter_a1minbed > 0) {
			$where[] = 'a.bedrooms >= '.(int) $filter_a1minbed;
		}
		if ($filter_a1minbaths != '') {
			$where[] = 'a.bathrooms >= '.(int) $filter_a1minbaths;
		}

		if ($filter_a1custom1 != '') {
			$where[] = 'a.custom1 = "'.$db->escape($filter_a1custom1, true ).'"';
		}

		if ($filter_a1minprice != '') {
			$a1minprice = preg_replace("/[^0-9.]/", "", $filter_a1minprice);
			if ($a1minprice != '') {
				$where[] = 'a.price >= '.$db->escape($a1minprice, true );
			}
		}
		if ($filter_a1maxprice != '') {
			$a1maxprice = preg_replace("/[^0-9.]/", "", $filter_a1maxprice);
			if ($a1maxprice != '') {
				$where[] = 'a.price <= '.$db->escape($a1maxprice, true );
			}
		}

		if ($filter_a1minarea != '') {
			$where[] = 'a.squarefeet >= '.$db->escape($filter_a1minarea, true );
		}
		if ($filter_a1maxarea != '') {
			$where[] = 'a.squarefeet <= '.$db->escape($filter_a1maxarea, true );
		}


		if ($params->get( 'restrict_sold' )) {
			$where[] = 'a.sold != 5 AND a.sold != 9';
		}
		if ( $params->get( 'er_expmgmt')==1 ) {
			$currentdate=mktime(0, 0, 0, date("m"), date("d"), date("Y"));
			$where[] = 'a.expdate > '.$currentdate;
        }



		if (JFactory::getApplication()->getLanguageFilter()) {
			$where[] = 'a.language in (' . $db->Quote(JFactory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')';
		}

		if ( file_exists(JPATH_SITE . '/administrator/components/com_realtybookings/realtybookings.php') ) {
			if ( $params->get( 'use_realtybookings' ) && $params->get( 'show_dates_select' ) ) {
				if ($filter_a1begin != '' && $filter_a1end != '') {
					$where[] = "a.id NOT IN (SELECT id FROM #__realtybookings WHERE date BETWEEN '".$db->escape($filter_a1begin, true )."' AND '".$db->escape($filter_a1end, true )."')";
				}
			}
		}

		if ($filter_a1search) {
			$where[] = '(LOWER(a.mls_id) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.office_id) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.id) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.county) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.ctown) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.ctport) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.schooldist) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.preschool) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.primaryschool) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.highschool) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.appliances) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.indoorfeatures) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.outdoorfeatures) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.buildingfeatures) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.communityfeatures) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.otherfeatures) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.custom1) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.custom2) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.custom3) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.custom4) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.custom5) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.custom6) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.custom7) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.custom8) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.adline) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.smalldesc) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.propdesc) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(a.postcode) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(dd.ezcity) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(ee.name) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false )
.'OR LOWER(ff.name) LIKE '.$db->Quote( '%'.$db->escape( $filter_a1search, true ).'%', false ).')'
;
		}


		if($filter_a1locality) {
			if($radcheck) {

				//$filter_a1radius = 1;

				if ($params->get( 'er_radius_dist') ){
					$radius = $params->get( 'er_radius_dist');
				} else {
					$radius = 15;
				}

				$postcode = EZRealtyFHelper::getPostcodeById($filter_a1locality);

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


		$where[] = 'pc.category_id = '. (int) $this->_id;
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