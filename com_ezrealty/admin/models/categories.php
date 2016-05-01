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
 * Categories Model
 *
 * @package    EZ Realty
 */
class ezrealtyModelCategories extends JModelList                   
{     
    
	var $_id = null;
    var $_data = null;    
    var $_order  = array();
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

        /* Filter By keyword */

        $search = $app->getUserStateFromRequest( $option."search", 'search', '', 'string' );
        $this->setState('search', $search);

		if (strpos($search, '"') !== false) {
			$search = str_replace(array('=', '<'), '', $search);
		}
		$search = JString::strtolower($search);

        $this->_search = $search;

    }

	function _buildContentOrderBy() {

        $app = &JFactory::getApplication();
        $option = $app->scope;

		$filter_order		= $app->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.id',	'cmd' );
		$filter_order_Dir	= $app->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );

		if ($filter_order == 'a.id' || $filter_order == 'a.name' || $filter_order == 'groupname' || $filter_order == 'a.published' || $filter_order == 'a.ordering' || $filter_order == 'a.language' ){
			$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir;
		} else {
			$orderby 	= ' ORDER BY a.id desc';
		}

		return $orderby;
	}

    function _buildContentWhere() {

		$db		=& JFactory::getDBO();

        $where = array();

		if ($this->_search) {
			$where[] = 'LOWER(a.id) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.name) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.alias) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.description) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
;
		}


        if (!empty($where)) $where = " where " . implode( ' AND ', $where ) . " ";
        else $where = "";

        return $where;
    }

	function getData() {	
    
		if (empty ($this->_data)) {
        
            $sql = "SELECT a.*, g.title AS groupname, u.name as editor"
            . "\n FROM #__ezrealty_catg AS a"
            . "\n LEFT JOIN #__viewlevels AS g ON g.id = a.access"
            . "\n LEFT JOIN #__users AS u ON u.id = a.checked_out"       
			. $this->_buildContentWhere()
			. $this->_buildContentOrderBy();

            $this->_total = $this->_getListCount($sql);                        
			if ($this->getState('limitstart') > $this->_total) $this->setState('limitstart', 0);
			if ($this->getState('limitstart') > 0 && $this->getState('limit') == 0)  $this->setState('limitstart', 0);			
			$this->_data = $this->_getList($sql, $this->getState('limitstart'), $this->getState('limit'));		
		}
		return $this->_data;
	}	

    function getOrdering() {

        $query = "SELECT b.ordering AS value, b.name AS text"
                . "\n FROM #__ezrealty_catg AS b"
                . "\n ORDER BY b.ordering ";
        $this->_db->setQuery( $query );
        $ordering = $this->_db->loadObjectlist();    
        
        return $ordering;
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
            $query = ' SELECT * FROM #__ezrealty_catg '.
                    '  WHERE id = '.$this->_id;
            $this->_db->setQuery( $query );
            $this->_data = $this->_db->loadObject();
        }
        
        if (!$this->_data) {
            $this->_data = new stdClass();
            $this->_data->id = 0;
            $this->_data->name = null;
            $this->_data->alias = null;
            $this->_data->description = null;
            $this->_data->image = null;
            $this->_data->metadesc = null;
            $this->_data->metakey = null;
            $this->_data->access = null;
            $this->_data->published = null;
            $this->_data->ordering = null;
            $this->_data->checked_out = null;
            $this->_data->checked_out_time = null;
            $this->_data->language = null;
        }
        
        return $this->_data;
    }

    
	function getPagination(){
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))	{
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
    
    function store()
    {
        $row =& $this->getTable();
     
        $data = JRequest::get( 'post' );
		$data['description'] = JRequest::getVar('description', '', 'POST', 'string', JREQUEST_ALLOWRAW);
        
        // Bind the form fields to the table
        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

		if (trim($row->alias) == '') {
			$row->alias = $row->name;
		}

		$row->alias = JApplication::stringURLSafe($row->alias);

		if (trim(str_replace('-','',$row->alias)) == '') {
			$row->alias = JFactory::getDate()->format('Y-m-d-H-i-s');
		}
        // code cleaner for xhtml transitional compliance
        $row->description = str_replace( '<br>', '<br />', $data['description'] );

        // sanitize
        $row->id = intval($row->id);

        // Make sure the record is valid
        if (!$row->check()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
     
        // Store the table to the database
        if (!$row->store()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        $row->reorder();

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

    function getGroupsList(){
        # get list of groups
        $this->_db->setQuery( "SELECT id AS value, title AS text FROM #__viewlevels ORDER BY id" );
        $groups = $this->_db->loadObjectList();    
        
        return $groups;        
    }    
    
	function getCategoryFiltList() {	

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

        if ($ezrparams->get('deflistorder') == 1) {
			$orderby 	= ' ORDER BY c.name';
		} else {
			$orderby 	= ' ORDER BY c.ordering';
		}

        $query = "SELECT c.id AS value, CONCAT(c.name,' (',count(b.id),')' ) AS text"
        . "\n FROM #__ezrealty_catg as c"
		. "\n INNER JOIN #__ezrealty AS b ON c.id = b.cid "
        . "\n WHERE c.published = 1"
        . "\n GROUP BY c.id"
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

        $query = "SELECT c.id AS value, c.name AS text"
        . "\n FROM #__ezrealty_catg as c"
        . "\n WHERE c.published = 1"
        . "\n GROUP BY c.id"
        . "\n $orderby ";
        $this->_db->setQuery( $query );
        $lists = $this->_db->loadObjectlist();    
		
		return $lists;
	}	      


    /**
     * Method to delete record(s)
     *
     * @access    public
     * @return    boolean    True on success
     */
    function delete()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        $row =& $this->getTable();
     
        foreach($cids as $cid) {
            if (!$row->delete( $cid )) {
                $this->setError( $row->getErrorMsg() );
                return false;
            }
        }
     
        $row->reorder();        
        return true;
    }
    
	function orderField( $uid, $inc )
	{
		// Initialize variables
		//$db		=& JFactory::getDBO();
		$row	=& $this->getTable();
		$row->load( $uid );
		$row->move( $inc ); // , '`group` = '.$db->Quote($row->group) 
        $row->reorder();
	}
	
	
	function saveorder() {

		// Initialize variables
		$db			= & JFactory::getDBO();

		$cid		= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$order		= JRequest::getVar( 'order', array (0), 'post', 'array' );
		$total		= count($cid);
		$conditions	= array ();

		
		JArrayHelper::toInteger($cid, array(0));
		JArrayHelper::toInteger($order, array(0));

        $row = & $this->getTable();
		// update ordering values
		for( $i=0; $i < $total; $i++ ) {
			$row->load( (int) $cid[$i] );
			// track sections
			//$groupings[] = $row->group;
			if ($row->ordering != $order[$i]) {
				$row->ordering = $order[$i];
				if (!$row->store()) {
					JError::raiseError(500, $db->getErrorMsg());
				}
			}
		}

        $row->reorder();
        /*
		// execute updateOrder for each parent group
		$groupings = array_unique( $groupings );
		foreach ($groupings as $group){
		//	echo 'group = '.$db->Quote($group)."<br/>";
			$row->reorder('`group` = '.$db->Quote($group));
		}
        */
		$msg = JText::_('New ordering saved');		
	}

	function publish () {
		
		$db =& JFactory::getDBO();
		$cids = JRequest::getVar('cid', array(0), 'post', 'array');
		$task = JRequest::getVar('task', '', 'post');

        $pub = false;
		if ($task == 'publish'){
			$sql = "update #__ezrealty_catg set published='1' where id in ('".implode("','", $cids)."')";
            $pub = true;
		} else {
			$sql = "update #__ezrealty_catg set published='0' where id in ('".implode("','", $cids)."')";
		}

		$db->setQuery($sql);
		if (!$db->query() ){
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
            $sql = "update #__ezrealty_catg set checked_out='0' where id in ('".implode("','", $cids)."')";
            $thecheck = true;
        }

        $db->setQuery($sql);
        if (!$db->query() ) {
            $this->setError($db->getErrorMsg());
            return false;
        }
        return $thecheck;

	}


}


?>