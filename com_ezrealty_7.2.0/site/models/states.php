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
 * EZ Realty Component Categories Model
 *
 */
class EzrealtysModelStates extends JModelLegacy
{
	/**
	 * States data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * States total
	 *
	 * @var integer
	 */
	var $_total = null;

	/**
	 * Constructor
	 *
	 */

	function __construct()
	{
		parent::__construct();

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
			$this->_data = $this->_getList($query);
		}

		return $this->_data;
	}

	/**
	 * Method to get the total number of items for the category
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

	function _buildQuery()
	{

		$params = JComponentHelper::getParams ('com_ezrealty');

		if (JFactory::getApplication()->getLanguageFilter()) {
			$db			=& JFactory::getDBO();
			$where = ' WHERE cc.published = 1 AND cc.language in (' . $db->Quote(JFactory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')';
		} else {
			$where = ' WHERE cc.published = 1';
		}

        if ($params->get('deflistorder') == 1) {
			$whichorder 	= ' ORDER BY cc.name';
		} else {
			$whichorder 	= ' ORDER BY cc.ordering';
		}

		//Query to retrieve all states.
		$query = 'SELECT cc.*,'
		. ' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(\':\', cc.id, cc.alias) ELSE cc.id END as slug'
		. ' FROM #__ezrealty_state AS cc'
		. $where
		. $whichorder
		;

		return $query;
	}


	/**
	 * Method to get item data for the states
	 *
	 */
	function getFeatured()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_featured))
		{
			$query = $this->_buildFeatured();
			$this->_featured = $this->_getList($query);
		}

		return $this->_featured;
	}


	function _buildFeatured()
	{

		$user = JFactory::getUser();
		$groups = implode(',', $user->getAuthorisedViewLevels());
		$params = JComponentHelper::getParams ('com_ezrealty');

		$where = array();

		$where[] = 'a.published = 1';
		$where[] = 'a.featured = 2';
		$where[] = 'ac.access IN (' . $groups . ')';
		$where[] = 'ac.published = 1';

		if (JFactory::getApplication()->getLanguageFilter()) {
			$db			=& JFactory::getDBO();
			$where[] = 'a.language in (' . $db->Quote(JFactory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')';
		}

		$where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );

		$whichorder = " ORDER BY RAND()";
		$howmany = ' LIMIT '. $params->get('stats_spotlight_number');


		if (empty ($this->_featured)) {

			$query = 'SELECT DISTINCT a.*, cc.name AS category, dd.ezcity AS proploc, ee.name AS statename, ff.name AS cnname, '
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
			. $where
			. $whichorder
			. $howmany
			;

        }


		return $query;
	}


}

?>