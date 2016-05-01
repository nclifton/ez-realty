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

/**
 * Localities Table class for J2.5x
 *
 * @package    EZ Realty
 */
class LocalitiesTableLocalities extends JTable
{
    /**
     * Primary Key
     *
     * @var int
     */
    var $id = null;    
    var $stateid = null;    
	var $ezcity = null;
	var $alias = null;
	var $postcode = null;
    var $declat = null;
    var $declong = null;
    var $zoom = null;
    var $owncoords = null;
	var $ezcity_desc = null;
    var $metadesc = null;
    var $metakey = null;
	var $published = null;
    var $language = null;
	var $ordering = null;
	var $checked_out = null;
	var $checked_out_time = null;

    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct( &$db ) {
        parent::__construct('#__ezrealty_locality', 'id', $db);
    }   
    
}

/**
 * Localities Table class for J1.7x
 *
 * @package    EZ Realty
 */
class TableLocalities extends JTable
{
    /**
     * Primary Key
     *
     * @var int
     */
    var $id = null;    
    var $stateid = null;    
	var $ezcity = null;
	var $alias = null;
	var $postcode = null;
    var $declat = null;
    var $declong = null;
    var $zoom = null;
    var $owncoords = null;
	var $ezcity_desc = null;
    var $metadesc = null;
    var $metakey = null;
	var $published = null;
    var $language = null;
	var $ordering = null;
	var $checked_out = null;
	var $checked_out_time = null;

    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct( &$db ) {
        parent::__construct('#__ezrealty_locality', 'id', $db);
    }   
    
}

?>