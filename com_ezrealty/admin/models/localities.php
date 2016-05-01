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
 * Localities Model
 *
 * @package    EZ Realty
 */
class ezrealtyModelLocalities extends JModelList                   
{     
    
	var $_id = null;
    var $_data = null;    
    var $_order  = array();
    var $_filter_state = null;
	var $_search = null;

	function __construct () {
		
        parent::__construct();
		
        $cids = JRequest::getVar('cid', 0, '', 'array');
		$this->setId((int)$cids[0]);
		
        //global $app, $option;
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
        
		$db		=& JFactory::getDBO();

        $where = array();
        
        if ( $this->_filter_state > 0 ) {
            $where[] = " a.stateid = '".$this->_filter_state."' ";
        }  

		if ($this->_search) {
			$where[] = 'LOWER(a.id) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.ezcity) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.alias) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
.'OR LOWER(a.ezcity_desc) LIKE '.$db->Quote( '%'.$db->escape( $this->_search, true ).'%', false )
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

		$filter_order		= $app->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.id',	'cmd' );
		$filter_order_Dir	= $app->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );

		if ($filter_order == 'a.id' || $filter_order == 'a.ezcity' || $filter_order == 'a.postcode' || $filter_order == 'a.declat' || $filter_order == 'a.declong' || $filter_order == 'a.published' || $filter_order == 'a.ordering' || $filter_order == 'a.language' ){
			$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir.' , a.id ';
		} else {
			$orderby 	= ' ORDER BY a.id desc';
		}

		return $orderby;
	}

	function getData() {	

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		if (empty ($this->_data)) {

            if ($ezrparams->get( 'er_stateloc' ) == 1) {

              # Do the main database query
                $sql = "SELECT a.*, a.ezcity as name, c.name as statename, u.name AS editor "
                . "\n FROM #__ezrealty_locality AS a "
                . "\n LEFT JOIN #__ezrealty_state as c ON c.id=a.stateid "
                . "\n LEFT JOIN #__users AS u ON u.id = a.checked_out "
                .$this->_buildContentWhere()
                .$this->_buildContentOrderBy();

            } else if ( $ezrparams->get( 'er_stateloc' ) == 2 && $ezrparams->get( 'er_country' ) == 1 ) {                

              # Do the main database query
                $sql = "SELECT a.*, a.ezcity as name, c.name as countryname, u.name AS editor "
                . "\n FROM #__ezrealty_locality AS a "
                . "\n LEFT JOIN #__ezrealty_country as c ON c.id=a.stateid "
                . "\n LEFT JOIN #__users AS u ON u.id = a.checked_out "
                .$this->_buildContentWhere()
                .$this->_buildContentOrderBy();

            } else {

                $sql = "SELECT a.*, a.ezcity as name, u.name AS editor "
                . "\n FROM #__ezrealty_locality AS a "
                . "\n LEFT JOIN #__users AS u ON u.id = a.checked_out "
                .$this->_buildContentWhere()
                .$this->_buildContentOrderBy();

			}

            $this->_total = $this->_getListCount($sql);                        
			if ($this->getState('limitstart') > $this->_total) $this->setState('limitstart', 0);
			if ($this->getState('limitstart') > 0 && $this->getState('limit') == 0)  $this->setState('limitstart', 0);			
			$this->_data = $this->_getList($sql, $this->getState('limitstart'), $this->getState('limit'));		

		}
		return $this->_data;
	}	
    
    function getOrdering() {

        $query = "SELECT b.ordering AS value, b.ezcity AS text"
                . "\n FROM #__ezrealty_locality AS b"
                . "\n ORDER BY b.ordering ";
        $this->_db->setQuery( $query );
        $ordering = $this->_db->loadObjectlist();    
        
        return $ordering;
    }    
    
    function getLocalityFiltList() {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

        if ($ezrparams->get('deflistorder') == 1) {
			$orderby 	= ' ORDER BY b.ezcity';
		} else {
			$orderby 	= ' ORDER BY b.ordering';
		}

        $query = "SELECT b.id AS value, CONCAT(b.ezcity,' (',count(c.id),')' ) AS text"
        . "\n FROM #__ezrealty_locality AS b"
		. "\n INNER JOIN #__ezrealty AS c ON b.id = c.locid "
        . "\n WHERE b.published = 1"
        . "\n GROUP BY b.id"
        . "\n $orderby ";
        $this->_db->setQuery( $query );
        $ordering = $this->_db->loadObjectlist();    

        return $ordering;
    }    

    function getLocalityList() {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

        if ($ezrparams->get('deflistorder') == 1) {
			$orderby 	= ' ORDER BY b.ezcity';
		} else {
			$orderby 	= ' ORDER BY b.ordering';
		}

        $query = "SELECT b.id AS value, b.ezcity AS text"
		. "\n FROM #__ezrealty_locality AS b"
		. $orderby;        
        $this->_db->setQuery( $query );
        $ordering = $this->_db->loadObjectlist();    
        
        return $ordering;
    }       
    
    function getLocalityPublishedList() {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

        if ($ezrparams->get('deflistorder') == 1) {
			$orderby 	= ' ORDER BY b.ezcity';
		} else {
			$orderby 	= ' ORDER BY b.ordering';
		}

        $query = "SELECT b.id AS value, CONCAT(b.ezcity,' (',count(c.id),')' ) AS text"
        . "\n FROM #__ezrealty_locality AS b"
		. "\n LEFT JOIN #__ezrealty AS c ON b.id = c.locid "
        . "\n WHERE b.published = 1"
        . "\n GROUP BY b.id"
        . "\n $orderby ";
        $this->_db->setQuery( $query );
        $ordering = $this->_db->loadObjectlist();    

        return $ordering;
    }    
    
    function getLocalityListByStateID($stateid) {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

        if ($ezrparams->get('deflistorder') == 1) {
			$orderby 	= ' ORDER BY p.ezcity';
		} else {
			$orderby 	= ' ORDER BY p.ordering';
		}

        $query = "SELECT p.id AS value, p.ezcity AS text"
        . "\n FROM #__ezrealty_locality AS p"
        . "\n WHERE p.published = 1 AND p.stateid='$stateid'"
        . "\n $orderby ";
        $this->_db->setQuery( $query );
        $ordering = $this->_db->loadObjectlist();    
        
        return $ordering;
    }    
    
    function getLocalityListWhere($where) {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

        if ($ezrparams->get('deflistorder') == 1) {
			$orderby 	= ' ORDER BY p.ezcity';
		} else {
			$orderby 	= ' ORDER BY p.ordering';
		}

        $query = "SELECT p.id AS value, p.ezcity AS text"
        . "\n FROM #__ezrealty_locality AS p "
        . "\n $where "
        . "\n $orderby ";
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
            $query = ' SELECT * FROM #__ezrealty_locality '.
                    '  WHERE id = '.$this->_id;
            $this->_db->setQuery( $query );
            $this->_data = $this->_db->loadObject();
        }
        
        if (!$this->_data) {
            $this->_data = new stdClass();
            $this->_data->id = 0;
            $this->_data->stateid = null;
            $this->_data->ezcity = null;
            $this->_data->alias = null;
            $this->_data->postcode = null;
            $this->_data->declat = null;
            $this->_data->declong = null;
            $this->_data->zoom = null;
            $this->_data->owncoords = null;
            $this->_data->image = null;
            $this->_data->ezcity_desc = null;
            $this->_data->metadesc = null;
            $this->_data->metakey = null;
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
			if (!isset($this->_total)) $this->getСountrys(); 
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
		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
		$database = & JFactory::getDBO();

        $row =& $this->getTable();

        $data = JRequest::get( 'post' );
		$data['ezcity_desc'] = JRequest::getVar('ezcity_desc', '', 'POST', 'string', JREQUEST_ALLOWRAW);

        // Bind the form fields to the table
        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        // code cleaner for xhtml transitional compliance
        $row->ezcity_desc = str_replace( '<br>', '<br />', $data['ezcity_desc'] );
        $row->postcode = str_replace( ' ', '', $row->postcode );


		if (trim($row->alias) == '') {
			$row->alias = $row->ezcity;
		}

		$row->alias = JApplication::stringURLSafe($row->alias);

		if (trim(str_replace('-','',$row->alias)) == '') {
			$row->alias = JFactory::getDate()->format('Y-m-d-H-i-s');
		}


        // start mapping

		if ($ezrparams->get( 'er_usemap') && $row->owncoords == 0) {

			$stateid = JRequest::getVar( 'stateid' );

			$thestate = '';
			$thecountry = '';

			// if using countries but not states
			if ( $ezrparams->get( 'er_stateloc' ) == 2 && $ezrparams->get( 'er_country' ) ) {

				if (!empty($stateid)) {

					$database->setQuery( "SELECT * FROM #__ezrealty_country WHERE id='$stateid'" );
					$ezcount = $database->loadObjectList();
					$ezcounttype = $ezcount[0];

					$thecountry = $ezcounttype->name;
				}
			}

			// if using states and countries
			if ( $ezrparams->get( 'er_stateloc' ) == 1 && $ezrparams->get( 'er_country' ) ) {

				if (!empty($stateid)) {

					$database->setQuery( "SELECT * FROM #__ezrealty_state WHERE id=$stateid" );
					$ezstate = $database->loadObjectList();
					$ezstatetype = $ezstate[0];

					$thestatcount = $ezstatetype->countid;

					$database->setQuery( "SELECT * FROM #__ezrealty_country WHERE id=$thestatcount" );
					$ezcount = $database->loadObjectList();
					$ezcounttype = $ezcount[0];

					$thestate = $ezstatetype->name;
					$thecountry = $ezcounttype->name;
				}
			}

			$address = $row->ezcity . ', ' . $thestate . ', ' . $row->postcode . ', ' . $thecountry;
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
			$sql = "update #__ezrealty_locality set published='1' where id in ('".implode("','", $cids)."')";
            $pub = true;
		} else {
			$sql = "update #__ezrealty_locality set published='0' where id in ('".implode("','", $cids)."')";
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
            $sql = "update #__ezrealty_locality set checked_out='0' where id in ('".implode("','", $cids)."')";
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
