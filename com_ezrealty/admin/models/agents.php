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
 * Profiles Model
 *
 * @package    EZ Portal
 */
class ezrealtyModelAgents extends JModelList                   
{     
    
	var $_id = null;
    var $_data = null;    
    var $_order  = array();
	var $_search = null;

	function __construct () {
		
        parent::__construct();
		
        $cids = JRequest::getVar('cid', 0, '', 'array');
		$this->setId((int)$cids[0]);
		
		$app		= JFactory::getApplication();
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

		$db						=& JFactory::getDBO();

        $where = array();
        
		if ($this->_search) {
			$where[] = 'LOWER(a.seller_name) LIKE '.$this->_db->Quote( '%'.$this->_db->getEscaped( $this->_search, true ).'%', false )
.'OR LOWER(a.seller_company) LIKE '.$this->_db->Quote( '%'.$this->_db->getEscaped( $this->_search, true ).'%', false )
.'OR LOWER(a.seller_suburb) LIKE '.$this->_db->Quote( '%'.$this->_db->getEscaped( $this->_search, true ).'%', false )
.'OR LOWER(a.seller_pcode) LIKE '.$this->_db->Quote( '%'.$this->_db->getEscaped( $this->_search, true ).'%', false )
.'OR LOWER(a.seller_email) LIKE '.$this->_db->Quote( '%'.$this->_db->getEscaped( $this->_search, true ).'%', false )
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

		if ($filter_order == 'a.id' || $filter_order == 'a.seller_name' || $filter_order == 'a.seller_company' || $filter_order == 'a.seller_email' || $filter_order == 'a.listdate' || $filter_order == 'a.lastupdate' || $filter_order == 'a.published' || $filter_order == 'a.ordering' ){
			$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir.' , a.id ';
		} else {
			$orderby 	= ' ORDER BY a.id '.$filter_order_Dir;
		}

		return $orderby;
	}


	function getData() {	

		if (empty ($this->_data)) {
            
              # Do the main database query
                $sql = "SELECT a.*, m.username AS member, u.name as editor "
                . "\n FROM #__ezportal AS a "
                . "\n LEFT JOIN #__users AS m ON m.id = a.uid "                
                . "\n LEFT JOIN #__users AS u ON u.id = a.checked_out "                
                    . $this->_buildContentWhere()
                    . $this->_buildContentOrderBy();

            $this->_total = $this->_getListCount($sql);
            if ($this->getState('limitstart') > $this->_total) $this->setState('limitstart', 0);
            if ($this->getState('limitstart') > 0 && $this->getState('limit') == 0)  $this->setState('limitstart', 0);
            $this->_data = $this->_getList($sql, $this->getState('limitstart'), $this->getState('limit'));
        }
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


    /**
     * Retrieves the data
     * @return array Array of objects containing the data from the database
     */
    function getDataById() {
    
        // Load the data
        if (empty( $this->_data )) {
            $query = ' SELECT * FROM #__ezportal '.
                    '  WHERE id = '.$this->_id;
            $this->_db->setQuery( $query );
            $this->_data = $this->_db->loadObject();
        }
        
        if (!$this->_data) {
            $this->_data = new stdClass();
            $this->_data->id = 0;
            $this->_data->uid=null;
            $this->_data->cid=null;
            $this->_data->seller_name=null;
            $this->_data->alias=null;
            $this->_data->seller_company=null;
            $this->_data->job_title=null;
            $this->_data->seller_info=null;
            $this->_data->seller_bio=null;
            $this->_data->seller_unitnum=null;
            $this->_data->seller_address1=null;
            $this->_data->seller_address2=null;
            $this->_data->seller_suburb=null;
            $this->_data->seller_pcode=null;
            $this->_data->seller_state=null;
            $this->_data->seller_country=null;
            $this->_data->show_addy=null;
            $this->_data->seller_declat=null;
            $this->_data->seller_declong=null;
            $this->_data->seller_email=null;
            $this->_data->seller_phone=null;
            $this->_data->seller_fax=null;
            $this->_data->seller_mobile=null;
            $this->_data->seller_sms=null;
            $this->_data->show_sms=null;
            $this->_data->seller_exempt=null;
            $this->_data->seller_unlimited=null;
            $this->_data->feat_upgr=null;
            $this->_data->publish_own=null;
            $this->_data->reset_own=null;
            $this->_data->seller_fbook=null;
            $this->_data->seller_twitter=null;
            $this->_data->seller_pinterest=null;
            $this->_data->seller_linkedin=null;
            $this->_data->seller_youtube=null;
            $this->_data->seller_msn=null;
            $this->_data->seller_skype=null;
            $this->_data->seller_ymsgr=null;
            $this->_data->seller_icq=null;
            $this->_data->seller_web=null;
            $this->_data->seller_blog=null;
            $this->_data->seller_image=null;
            $this->_data->seller_logo=null;
            $this->_data->seller_banner=null;
            $this->_data->seller_pdf=null;
            $this->_data->calcown=null;
            $this->_data->qrcode = null;
            $this->_data->featured = null;
            $this->_data->published=null;
            $this->_data->rets_source=null;
            $this->_data->listdate=null;
            $this->_data->lastupdate=null;
            $this->_data->metadesc = null;
            $this->_data->metakey = null;
            $this->_data->checked_out=null;
            $this->_data->checked_out_time=null;
            $this->_data->ordering=null;
        }
        
        return $this->_data;
    }


	function getUserList() {

		$query = "SELECT n.id as value, n.username as text FROM #__users AS n ORDER by n.username ASC";
		$this->_db->setQuery( $query );
		$users = $this->_db->loadObjectlist();            
		return $users;
	}

	function getProfileList() {	
    
        $query = "SELECT ss.uid AS value, ss.seller_name AS text"
        . "\n FROM #__ezportal as ss WHERE ss.published = 1"
        . "\n ORDER BY ss.seller_name"
        ;     
        $this->_db->setQuery( $query );
        $lists = $this->_db->loadObjectlist();    
		
		return $lists;
	}	      

	function getOrdering() {

		$query = "SELECT b.ordering AS value, b.seller_name AS text"
		. "\n FROM #__ezportal AS b"
		. "\n ORDER BY b.ordering ";
		$this->_db->setQuery( $query );
		$ordering = $this->_db->loadObjectlist();    

		return $ordering;
	}

    function store(){

		$ezpparams = JComponentHelper::getParams ('com_ezrealty');
		$database	= & JFactory::getDBO();

        $row =& $this->getTable();
     
        $data = JRequest::get( 'post' );
        
        // Bind the form fields to the table
        if (!$row->bind($data)) {
            echo "<script> alert('".JText::_('COM_EZPORTAL_ERROR9')."'); window.history.go(-1); </script>\n";
            exit();
        }

		if (trim($row->alias) == '') {
			$row->alias = $row->seller_name;
		}

		$row->alias = JApplication::stringURLSafe($row->alias);

		if (trim(str_replace('-','',$row->alias)) == '') {
			$row->alias = JFactory::getDate()->format('Y-m-d-H-i-s');
		}


		if ($ezpparams->get( 'er_usemap') && $row->calcown == 0) {

			$address = $row->seller_address1 . ' ' . $row->seller_address2 . ', ' . $row->seller_suburb . ', ' . $row->seller_state . ', ' . $row->seller_pcode . ', ' . $row->seller_country;
			$address = htmlentities(urlencode($address));

			$latitude='';
			$longitude='';


			if ( $ezpparams->get( 'er_usealtmap' ) == 2 ){


				$url = "http://geocode-maps.yandex.ru/1.x/?geocode=".$address."&lang=".$ezpparams->get( 'ep_maplang');
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

				$row->seller_declat = $latitude;
				$row->seller_declong = $longitude; 


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

						$row->seller_declat = $latitude;
						$row->seller_declong = $longitude; 

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

				$row->seller_declat = $latitude;
				$row->seller_declong = $longitude; 

			}
		}
	}

        // end mapping
        
        // sanitize
        $row->id = intval($row->id);
        $row->uid = intval($row->uid);

        //die(print_r($_FILES,1));
        
        if(isset($_REQUEST['seller_image'])) { $row->seller_image=$_REQUEST['seller_image'];}
        if(isset($_FILES['seller_imageupload']['name']) && !empty($_FILES['seller_imageupload']['name'])) { $row->seller_image=EzRealtyUploadHelper::saveProfileUpload($_FILES['seller_imageupload']['name'],$_FILES['seller_imageupload']['type'],$_FILES['seller_imageupload']['tmp_name']); }


        $row->lastupdate=date("Y-m-d H:i:s");

        $isNew = ( $row->id < 1 );
        if ($isNew) {
            $row->listdate = date("Y-m-d");
        }


        // Make sure the record is valid
        if (!$row->check()) {
            echo "<script> alert('".JText::_('COM_EZREALTY_AGENTERROR9')."'); window.history.go(-1); </script>\n";
            exit();
        }

        // Store the table to the database
        if (!$row->store()) {
            echo "<script> alert('".JText::_('COM_EZREALTY_AGENTERROR9')."'); window.history.go(-1); </script>\n";
            exit();
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

        if (JRequest::getVar('applyFlag') == 0) {
			$row->checkin();
        }

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

            $row->load( $cid );

       	    unlink( JPATH_ROOT.'/images/agents/avatar/'.$row->seller_image );
       	    unlink( JPATH_ROOT.'/images/agents/logo/'.$row->seller_logo );
       	    unlink( JPATH_ROOT.'/images/agents/banner/'.$row->seller_banner );
       	    unlink( JPATH_ROOT.'/images/agents/pdf/'.$row->seller_pdf );

            if (!$row->delete( $cid )) {
                $this->setError( $row->getErrorMsg() );
                return false;
            }
        }
     
        $row->reorder();        
        return true;
    }
 
	function publish () {
		
		$db =& JFactory::getDBO();
		$cids = JRequest::getVar('cid', array(0), 'post', 'array');
		$task = JRequest::getVar('task', '', 'post');

        $pub = false;
		if ($task == 'publish'){
			$sql = "update #__ezportal set published='1' where id in ('".implode("','", $cids)."')";
            $pub = true;
		} else {
			$sql = "update #__ezportal set published='0' where id in ('".implode("','", $cids)."')";
		}

		$db->setQuery($sql);
		if (!$db->query() ){
			$this->setError($db->getErrorMsg());
			return false;
		}
        return $pub;
	}    


	function orderField( $uid, $inc )
	{
		// Initialize variables
		//$db		=& JFactory::getDBO();
		$row	=& $this->getTable();
		$row->load( $uid );
		$row->move( $inc );
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
			if ($row->ordering != $order[$i]) {
				$row->ordering = $order[$i];
				if (!$row->store()) {
					JError::raiseError(500, $db->getErrorMsg());
				}
			}
		}

        $row->reorder();
		$msg = JText::_('New ordering saved');		
	}


    function docheckin () {

        $db =& JFactory::getDBO();
        $cids = JRequest::getVar('cid', array(0), 'post', 'array');
        $task = JRequest::getVar('task', '', 'post');

        $thecheck = false;
        if ($task == 'checkin') {
            $sql = "update #__ezportal set checked_out='0' where checked_out='1'";
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
