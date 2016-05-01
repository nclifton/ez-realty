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
 * Shortlist favourites Table class for J2.5x
 *
 * @package    EZ Realty
 */
class LightboxTableLightbox extends JTable
{
    /**
     * Primary Key
     *
     * @var int
     */
    var $id = null;    
    var $uid = null;    
	var $propid = null;
	var $date = null;

	/**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct( &$db ) {
        parent::__construct('#__ezrealty_lightbox', 'id', $db);
    }   
    
}

/**
 * Shortlist favourites Table class for J1.7x
 *
 * @package    EZ Realty
 */
class TableLightbox extends JTable
{
    /**
     * Primary Key
     *
     * @var int
     */
    var $id = null;    
    var $uid = null;    
	var $propid = null;
	var $date = null;

	/**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct( &$db ) {
        parent::__construct('#__ezrealty_lightbox', 'id', $db);
    }   
    
}

?>