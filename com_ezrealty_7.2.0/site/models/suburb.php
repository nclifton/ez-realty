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
 * Ezrealty Component suburb Model
 *
 * @package		EZ Realty
 *
 */
class EzrealtysModelSuburb extends JModelLegacy
{
	/**
	 * Suburb id
	 *
	 * @var int
	 */
	var $_id = null;

	/**
	 * Suburb data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Suburb total
	 *
	 * @var integer
	 */
	var $_total = null;

	/**
	 * Suburb data
	 *
	 * @var object
	 */
	var $_suburb = null;

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
	 * Method to set the suburb id
	 *
	 * @param	int	Suburb ID number
	 */
	function setId($id)
	{
		// Set suburb ID and wipe data
		$this->_id			= $id;
		$this->_suburb	= null;
	}

	/**
	 * Method to get item data for the suburb
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
	 * Method to get the total number of items for the suburb
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
	 * Method to get a pagination object of the items for the suburb
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
	 * Method to get suburb data for the current suburb
	 *
	 */
	function getSuburb()
	{
		// Load the Suburb data
		if ($this->_loadSuburb())

		return $this->_suburb;
	}

	/**
	 * Method to load suburb data if it doesn't exist.
	 *
	 * @return	boolean	True on success
	 */
	function _loadSuburb()
	{

		$params = JComponentHelper::getParams ('com_ezrealty');

		if (empty($this->_suburb))
		{

			// current suburb info
			$query = 'SELECT c.*, ' .
				' CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(\':\', c.id, c.alias) ELSE c.id END as slug '.
				' FROM #__ezrealty_locality AS c' .
				' WHERE c.id = '. (int) $this->_id ;
			$this->_db->setQuery($query, 0, 1);
			$this->_suburb = $this->_db->loadObject();

		}
		return true;
	}

	function _buildQuery()
	{

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		$where		= $this->_buildContentWhere();
		$orderby		= $this->_buildContentOrderBy();

		// We need to get a list of all listings in the given suburb

        if (empty ($this->_data)) {

		if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){

			$query = 'SELECT distinct(a.id),a.*, cc.name AS category, dd.ezcity AS proploc, ee.name AS statename, ff.name AS cnname, ss.seller_name AS dealer_name, ss.seller_email AS dealer_email, 
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

			$query = ' SELECT distinct(a.id),a.*, cc.name AS category, dd.ezcity AS proploc, ee.name AS statename, ff.name AS cnname, ss.seller_name AS dealer_name, ss.seller_phone AS dealer_phone, ss.seller_logo AS logo_image, '
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
		$filter_a5cid		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a5cid',		'filter_a5cid',			0,				'int' );
		$filter_a5type		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a5type',		'filter_a5type',		0,				'int' );
		$filter_a5sold		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a5sold',		'filter_a5sold',		0,				'int' );
		$filter_a5seller	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a5seller',	'filter_a5seller',		0,				'int' );
		$filter_a5minprice	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a5minprice',	'filter_a5minprice',	'',				'char' );
		$filter_a5maxprice	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a5maxprice',	'filter_a5maxprice',	'',				'char' );
		$filter_a5minbed	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a5minbed',	'filter_a5minbed',		0,				'char' );
		$filter_a5minbaths	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a5minbaths',	'filter_a5minbaths',	0,				'char' );
		$filter_a5custom1	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a5custom1',	'filter_a5custom1',		'',				'string' );
		$filter_a5minarea	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a5minarea',	'filter_a5minarea',		'',				'char' );
		$filter_a5maxarea	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a5maxarea',	'filter_a5maxarea',		'',				'char' );
		$filter_a5search	= $app->getUserStateFromRequest( 'com_ezrealty.filter_a5search',	'filter_a5search',		'',				'string' );

		$filter_a5minland		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a5minland',		'filter_a5minland',			'',			'string' );
		$filter_a5maxland		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a5maxland',		'filter_a5maxland',			'',			'string' );
		$filter_a5landtype		= $app->getUserStateFromRequest( 'com_ezrealty.filter_a5landtype',		'filter_a5landtype',		0,			'int' );


		if ( file_exists(JPATH_SITE . '/administrator/components/com_realtybookings/realtybookings.php') ) {
			if ( $params->get( 'use_realtybookings', 1 ) && $params->get( 'show_dates_select', 1 ) ) {
				$filter_a5begin		= $app->getUserStateFromRequest( 'com_realtybookings.filter_a5begin',	'filter_a5begin',	'', 'string' );
				$filter_a5end		= $app->getUserStateFromRequest( 'com_realtybookings.filter_a5end',	'filter_a5end',	'', 'string' );
			}
		}

		if (strpos($filter_a5search, '"') !== false) {
			$filter_a5search = str_replace(array('=', '<'), '', $filter_a5search);
		}
		$filter_a5search = JString::strtolower($filter_a5search);


		$where = array();


		if($filter_a5landtype == '2') {
			if ($filter_a5minland != '') {
				$a5minland = preg_replace("/[^0-9.]/", "", $filter_a5minland);

				if ($a5minland != '') {
					$where[] = 'a.AcresTotal >= '.$db->escape($a5minland, true );
				}
			}
			if ($filter_a5maxland != '') {
				$a5maxland = preg_replace("/[^0-9.]/", "", $filter_a5maxland);

				if ($a5maxland != '') {
					$where[] = 'a.AcresTotal <= '.$db->escape($a5maxland, true );
				}
			}
		} else if ($filter_a5landtype == '1') {
			if ($filter_a5minland != '') {
				$a5minland = preg_replace("/[^0-9.]/", "", $filter_a5minland);

				if ($a5minland != '') {
					$where[] = 'a.LandAreaSqFt >= '.$db->escape($a5minland, true );
				}
			}
			if ($filter_a5maxland != '') {
				$a5maxland = preg_replace("/[^0-9.]/", "", $filter_a5maxland);

				if ($a5maxland != '') {
					$where[] = 'a.LandAreaSqFt <= '.$db->escape($a5maxland, true );
				}
			}
		} else {
		}


		if ($filter_a5custom1 != '') {
			$where[] = 'a.custom1 = "'.$db->escape($filter_a5custom1, true ).'"';
		}
		if ($filter_a5cid > 0) {
			$where[] = 'pc.category_id = '.(int) $filter_a5cid;
		}
		if ($filter_a5type > 0) {
			$where[] = 'a.type = '.(int) $filter_a5type;
		}
		if ($filter_a5sold > 0) {
			$where[] = 'a.sold = '.(int) $filter_a5sold;
		}
		if ($filter_a5seller > 0) {
			$where[] = 'a.owner = '.(int) $filter_a5seller;
		}

		if ($filter_a5minprice != '') {
			$a5minprice = preg_replace("/[^0-9.]/", "", $filter_a5minprice);
			if ($a5minprice != '') {
				$where[] = 'a.price >= '.$db->escape($a5minprice, true );
			}
		}
		if ($filter_a5maxprice != '') {
			$a5maxprice = preg_replace("/[^0-9.]/", "", $filter_a5maxprice);
			if ($a5maxprice != '') {
				$where[] = 'a.price <= '.$db->escape($a5maxprice, true );
			}
		}

		if ($filter_a5minarea != '') {
			$where[] = 'a.squarefeet >= '.$db->escape($filter_a5minarea, true );
		}
		if ($filter_a5maxarea != '') {
			$where[] = 'a.squarefeet <= '.$db->escape($filter_a5maxarea, true );
		}
		if ($filter_a5minbed > 0) {
			$where[] = 'a.bedrooms >= '.(int) $filter_a5minbed;
		}
		if ($filter_a5minbaths != '') {
			$where[] = 'a.bathrooms >= '.(int) $filter_a5minbaths;
		}

		if ($params->get( 'restrict_sold', 1 )) {
			$where[] = 'a.sold != 5 AND a.sold != 9';
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
				if ($filter_a5begin != '' && $filter_a5end != '') {
					$where[] = "a.id NOT IN (SELECT id FROM #__realtybookings WHERE date BETWEEN '".$db->escape($filter_a5begin, true )."' AND '".$db->escape($filter_a5end, true )."')";
				}
			}
		}

		if ($filter_a5search) {
			$where[] = '(LOWER(a.mls_id) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.office_id) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.id) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.county) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.ctown) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.ctport) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.schooldist) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.preschool) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.primaryschool) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.highschool) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.appliances) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.indoorfeatures) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.outdoorfeatures) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.buildingfeatures) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.communityfeatures) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.otherfeatures) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.custom1) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.custom2) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.custom3) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.custom4) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.custom5) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.custom6) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.custom7) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.custom8) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.adline) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.smalldesc) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.propdesc) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(a.postcode) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(dd.ezcity) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(ee.name) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false )
.'OR LOWER(ff.name) LIKE '.$db->Quote( '%'.$db->escape( $filter_a5search, true ).'%', false ).')'
;
		}


		$where[] = 'a.locid = '. (int) $this->_id;

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