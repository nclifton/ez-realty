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
 * Ezrealty Component details Model
 *
 * @package		EZ Realty
 *
 */
class EzrealtysModelEzrealty extends JModelLegacy
{
	/**
	 * item id
	 *
	 * @var int
	 */
	var $_id = null;

	/**
	 * item data
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Constructor
	 *
	 */
	function __construct()
	{
		parent::__construct();

		$id = JRequest::getVar('id', 0, '', 'int');
		$this->setId((int)$id);
	}

	/**
	 * Method to set the item identifier
	 *
	 * @param	int item identifier
	 */
	function setId($id)
	{
		// Set listing id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
	 * Method to get an item
	 *
	 */
	function &getData()
	{
		// Load the listing data
		if ($this->_loadData())
		{
			// Initialize some variables
			$user = &JFactory::getUser();

			// Make sure the listing is published
			if (!$this->_data->published) {
				JError::raiseError(404, JText::_("RESOURCE NOT FOUND"));
				return false;
			}

		}
		else  $this->_initData();

		return $this->_data;
	}


	function hit()
	{
		if ($this->_id)
		{
			$ezrealty = & $this->getTable('ezrealty');
			$ezrealty->hit($this->_id);
			return true;
		}
		return false;
	}

	/**
	 * Method to load item data
	 *
	 */
	function _loadData()
	{

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		$where		= $this->_buildContentWhere();

		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{

		if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){

			$query = 'SELECT w.*, cc.name AS category, dd.ezcity AS proploc, ee.name AS statename, ff.name AS cnname, 

			u.id AS seller_id, u.uid AS mid, u.cid AS seller_cat, u.seller_name AS dealer_name, u.job_title AS dealer_jobtitle, u.seller_company AS dealer_company, 
			u.seller_unitnum AS dealer_unitnum, u.seller_address1 AS dealer_address1, u.seller_address2 AS dealer_address2, 
			u.seller_suburb AS dealer_suburb, u.seller_pcode AS dealer_pcode, u.seller_state AS dealer_state, u.seller_country AS dealer_country, 
			u.show_addy AS dealer_showaddy, u.seller_declat AS dealer_declat, u.seller_declong AS dealer_declong, 
			u.seller_email AS dealer_email, u.seller_phone AS dealer_phone, u.seller_mobile AS dealer_mobile, u.seller_fax AS dealer_fax, 
			u.seller_image AS dealer_image, u.seller_logo AS dealer_logo, u.seller_banner AS dealer_banner, 
			u.published AS dealerpublished, gg.title AS dealer_type, 

			p.id AS assocseller_id, p.uid AS amid, p.cid AS aseller_cat, p.seller_name AS adealer_name, p.job_title AS adealer_jobtitle, p.seller_company AS adealer_company, 
			p.seller_unitnum AS adealer_unitnum, p.seller_address1 AS adealer_address1, p.seller_address2 AS adealer_address2, 
			p.seller_suburb AS adealer_suburb, p.seller_pcode AS adealer_pcode, p.seller_state AS adealer_state, p.seller_country AS adealer_country, 
			p.show_addy AS adealer_showaddy, p.seller_declat AS adealer_declat, p.seller_declong AS adealer_declong, 
			p.seller_email AS adealer_email, p.seller_phone AS adealer_phone, p.seller_mobile AS adealer_mobile, p.seller_fax AS adealer_fax, 
			p.seller_image AS adealer_image, p.seller_logo AS adealer_logo, p.seller_banner AS adealer_banner, 
			p.published AS adealerpublished, hh.title AS adealer_type, 

			cc.access as category_access, cc.published AS cat_pub, cc.name as category, '
			. ' CASE WHEN CHAR_LENGTH(w.alias) THEN CONCAT_WS(\':\', w.id, w.alias) ELSE w.id END as slug, '
			. ' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(\':\', cc.id, cc.alias) ELSE cc.id END as catslug, '
			. ' CASE WHEN CHAR_LENGTH(dd.alias) THEN CONCAT_WS(\':\', dd.id, dd.alias) ELSE dd.id END as subslug, '
			. ' CASE WHEN CHAR_LENGTH(ee.alias) THEN CONCAT_WS(\':\', ee.id, ee.alias) ELSE ee.id END as statslug '
			. ' FROM #__ezrealty AS w'
			. ' LEFT JOIN #__ezrealty_catg AS cc ON cc.id = w.cid'
			. ' LEFT JOIN #__ezrealty_locality AS dd ON dd.id = w.locid'
			. ' LEFT JOIN #__ezrealty_state AS ee ON ee.id = w.stid'
			. ' LEFT JOIN #__ezrealty_country AS ff ON ff.id = w.cnid'
			. ' LEFT JOIN #__ezportal AS u ON u.uid = w.owner'
			. ' LEFT JOIN #__ezportal_catg AS gg ON gg.id = u.cid'
			. ' LEFT JOIN #__ezportal AS p ON p.uid = w.assoc_agent'
			. ' LEFT JOIN #__ezportal_catg AS hh ON hh.id = p.cid'
			. $where
			;

		} else {

			$query = 'SELECT w.*, cc.name AS category, dd.ezcity AS proploc, ee.name AS statename, ff.name AS cnname, cc.access as category_access, cc.published AS cat_pub, 

			u.id AS seller_id, u.uid AS mid, u.seller_name AS dealer_name, u.job_title AS dealer_jobtitle, u.seller_company AS dealer_company, 
			u.seller_unitnum AS dealer_unitnum, u.seller_address1 AS dealer_address1, u.seller_address2 AS dealer_address2, 
			u.seller_suburb AS dealer_suburb, u.seller_pcode AS dealer_pcode, u.seller_state AS dealer_state, u.seller_country AS dealer_country, 
			u.show_addy AS dealer_showaddy, u.seller_declat AS dealer_declat, u.seller_declong AS dealer_declong, 
			u.seller_email AS dealer_email, u.seller_phone AS dealer_phone, u.seller_mobile AS dealer_mobile, u.seller_fax AS dealer_fax, 
			u.seller_image AS dealer_image, u.published AS dealerpublished, 

			p.id AS assocseller_id, p.uid AS amid, p.seller_name AS adealer_name, p.job_title AS adealer_jobtitle, p.seller_company AS adealer_company, 
			p.seller_unitnum AS adealer_unitnum, p.seller_address1 AS adealer_address1, p.seller_address2 AS adealer_address2, 
			p.seller_suburb AS adealer_suburb, p.seller_pcode AS adealer_pcode, p.seller_state AS adealer_state, p.seller_country AS adealer_country, 
			p.show_addy AS adealer_showaddy, p.seller_declat AS adealer_declat, p.seller_declong AS adealer_declong, 
			p.seller_email AS adealer_email, p.seller_phone AS adealer_phone, p.seller_mobile AS adealer_mobile, p.seller_fax AS adealer_fax, 
			p.seller_image AS adealer_image, p.published AS adealerpublished, '

			. ' CASE WHEN CHAR_LENGTH(w.alias) THEN CONCAT_WS(\':\', w.id, w.alias) ELSE w.id END as slug, '
			. ' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(\':\', cc.id, cc.alias) ELSE cc.id END as catslug, '
			. ' CASE WHEN CHAR_LENGTH(dd.alias) THEN CONCAT_WS(\':\', dd.id, dd.alias) ELSE dd.id END as subslug, '
			. ' CASE WHEN CHAR_LENGTH(ee.alias) THEN CONCAT_WS(\':\', ee.id, ee.alias) ELSE ee.id END as statslug '
			. ' FROM #__ezrealty AS w'
			. ' LEFT JOIN #__ezrealty_catg AS cc ON cc.id = w.cid'
			. ' LEFT JOIN #__ezrealty_locality AS dd ON dd.id = w.locid'
			. ' LEFT JOIN #__ezrealty_state AS ee ON ee.id = w.stid'
			. ' LEFT JOIN #__ezrealty_country AS ff ON ff.id = w.cnid'
			. ' LEFT JOIN #__ezportal AS u ON u.uid = w.owner'
			. ' LEFT JOIN #__ezportal AS p ON p.uid = w.assoc_agent'
			. $where
			;

		}

			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();
			return (boolean) $this->_data;
		}
		return true;
	}


	function _buildContentWhere() {

		$db		= $this->getDbo();
		$user = JFactory::getUser();
		$groups = implode(',', $user->getAuthorisedViewLevels());

		$where = array();

		if (JFactory::getApplication()->getLanguageFilter()) {
			$where[] = 'w.language in (' . $db->Quote(JFactory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')';
		}

		$where[] = 'w.id = '. (int) $this->_id;

		$where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );

		return $where;
	}

	/**
	 * Method to initialise the item data
	 *
	 */
	function _initData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$user =& JFactory::getUser();

			$ezrealty = new stdClass();

			$ezrealty->id = null;
			$ezrealty->type = null;
			$ezrealty->rent_type = null;
			$ezrealty->cid = null;
			$ezrealty->locid = null;
			$ezrealty->stid = null;
			$ezrealty->cnid = null;
			$ezrealty->unit_num = null;
			$ezrealty->street_num = null;
			$ezrealty->address2 = null;
			$ezrealty->postcode = null;
			$ezrealty->county = null;
			$ezrealty->locality = null;
			$ezrealty->state = null;
			$ezrealty->country = null;
			$ezrealty->viewad = null;
			$ezrealty->owncoords = null;
			$ezrealty->price = null;
			$ezrealty->offpeak = null;
			$ezrealty->showprice = null;
			$ezrealty->freq = null;
			$ezrealty->bond = null;
			$ezrealty->closeprice = null;
			$ezrealty->priceview = null;
			$ezrealty->year = null;
			$ezrealty->landtype = null;
			$ezrealty->frontage = null;
			$ezrealty->depth = null;
			$ezrealty->bedrooms = null;
			$ezrealty->sleeps = null;
			$ezrealty->totalrooms = null;
			$ezrealty->livingarea = null;
			$ezrealty->bathrooms = null;
			$ezrealty->ensuite = null;
			$ezrealty->parking = null;
			$ezrealty->stories = null;
			$ezrealty->declat = null;
			$ezrealty->declong = null;
			$ezrealty->adline = null;
			$ezrealty->alias = null;
			$ezrealty->propdesc = null;
			$ezrealty->smalldesc = null;
			$ezrealty->panorama = null;
			$ezrealty->mediaUrl = null;
			$ezrealty->mediaType = null;
			$ezrealty->pdfinfo1 = null;
			$ezrealty->pdfinfo2 = null;
			$ezrealty->epc1 = null;
			$ezrealty->epc2 = null;
			$ezrealty->flpl1 = null;
			$ezrealty->flpl2 = null;
			$ezrealty->qrcode = null;
			$ezrealty->ctown = null;
			$ezrealty->ctport = null;
			$ezrealty->schooldist = null;
			$ezrealty->preschool = null;
			$ezrealty->primaryschool = null;
			$ezrealty->highschool = null;
			$ezrealty->university = null;
			$ezrealty->hofees = null;
			$ezrealty->appliances = null;
			$ezrealty->indoorfeatures = null;
			$ezrealty->outdoorfeatures = null;
			$ezrealty->buildingfeatures = null;
			$ezrealty->communityfeatures = null;
			$ezrealty->otherfeatures = null;
			$ezrealty->custom1 = null;
			$ezrealty->custom2 = null;
			$ezrealty->custom3 = null;
			$ezrealty->custom4 = null;
			$ezrealty->custom5 = null;
			$ezrealty->custom6 = null;
			$ezrealty->custom7 = null;
			$ezrealty->custom8 = null;
			$ezrealty->takings = null;
			$ezrealty->returns = null;
			$ezrealty->netprofit = null;
			$ezrealty->bustype = null;
			$ezrealty->bussubtype = null;
			$ezrealty->stock = null;
			$ezrealty->fixtures = null;
			$ezrealty->fittings = null;
			$ezrealty->squarefeet = null;
			$ezrealty->percentoffice = null;
			$ezrealty->percentwarehouse = null;
			$ezrealty->loadingfac = null;
			$ezrealty->fencing = null;
			$ezrealty->rainfall = null;
			$ezrealty->soiltype = null;
			$ezrealty->grazing = null;
			$ezrealty->cropping = null;
			$ezrealty->irrigation = null;
			$ezrealty->waterresources = null;
			$ezrealty->carryingcap = null;
			$ezrealty->storage = null;
			$ezrealty->services = null;
			$ezrealty->currency_position = null;
			$ezrealty->currency = null;
			$ezrealty->currency_format = null;
			$ezrealty->schoolprof = null;
			$ezrealty->hoodprof = null;
			$ezrealty->openhouse = null;
			$ezrealty->ohouse_desc = null;
			$ezrealty->ohdate = null;
			$ezrealty->ohstarttime = null;
			$ezrealty->ohendtime = null;
			$ezrealty->ohdate2 = null;
			$ezrealty->ohstarttime2 = null;
			$ezrealty->ohendtime2 = null;
			$ezrealty->viewbooking = null;
			$ezrealty->availdate = null;
			$ezrealty->aucdate = null;
			$ezrealty->auctime = null;
			$ezrealty->aucdet = null;
			$ezrealty->private = null;
			$ezrealty->listdate = null;
			$ezrealty->lastupdate = null;
			$ezrealty->expdate = null;
			$ezrealty->closedate = null;
			$ezrealty->contractdate = null;
			$ezrealty->hits = null;
			$ezrealty->sold = null;
			$ezrealty->featured = null;
			$ezrealty->camtype = null;
			$ezrealty->office_id = null;
			$ezrealty->mls_id = null;
			$ezrealty->mls_agent = null;
			$ezrealty->agentInfo = null;
			$ezrealty->rets_source = null;
			$ezrealty->mls_disclaimer = null;
			$ezrealty->mls_image = null;
			$ezrealty->oh_id = null;
			$ezrealty->owner = null;
			$ezrealty->assoc_agent = null;
			$ezrealty->email_status = null;
			$ezrealty->metadesc = null;
			$ezrealty->metakey = null;
			$ezrealty->ordering = null;
			$ezrealty->published = null;
			$ezrealty->language = null;
			$ezrealty->checked_out = null;
			$ezrealty->checked_out_time = null;

			$ezrealty->category	= null;

			$this->_data		= $ezrealty;

			return (boolean) $this->_data;
		}
		return true;
	}
}

?>