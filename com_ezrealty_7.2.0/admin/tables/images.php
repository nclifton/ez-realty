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
 * Listings Image Table class
 *
 * @package    EZ Realty
 */
class TableImages extends JTable
{
    /**
     * Primary Key
     *
     * @var int
    */
var $id=null;
var $propid=null;
var $fname=null;
var $title=null;
var $description=null;
var $path=null;
var $rets_source=null;
var $ordering=null;

    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct( &$db ) {
        parent::__construct('#__ezrealty_images', 'id', $db);
    }   
    
}

/**
 * Listings Image Table class
 *
 * @package    EZ Realty
 */
class ImagesTableImages extends JTable
{
    /**
     * Primary Key
     *
     * @var int
    */
var $id=null;
var $propid=null;
var $fname=null;
var $title=null;
var $description=null;
var $path=null;
var $rets_source=null;
var $ordering=null;

    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct( &$db ) {
        parent::__construct('#__ezrealty_images', 'id', $db);
    }   
    
}

?>