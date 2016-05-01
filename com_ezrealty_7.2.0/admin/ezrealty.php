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

# Kill error reporting
error_reporting(0);

/*
 * Make sure the user is authorized to view this page
 */
$user = & JFactory::getUser();
//if (!$user->authorize( 'com_banners', 'manage' )) {
//	$mainframe->redirect( 'index.php', JText::_('ALERTNOTAUTH') );
//}

$mainframe = &JFactory::getApplication();

require_once( JPATH_SITE . '/components/com_ezrealty/helpers/helper.php' );

require_once( JPATH_COMPONENT_ADMINISTRATOR . '/assets/helper.php' );
require_once( JPATH_COMPONENT_ADMINISTRATOR . '/assets/upgrades_helper.php' );
require_once( JPATH_COMPONENT_ADMINISTRATOR . '/assets/migration_helper.php' );
require_once( JPATH_COMPONENT_ADMINISTRATOR . '/assets/pdf.helper.php' );

require_once( JPATH_SITE . '/components/com_ezrealty/helpers/upload.helper.php' );

if($controller = JRequest::getVar('controller')) {
    require_once (JPATH_COMPONENT . '/controllers/' . $controller.'.php');
} else {
    require_once (JPATH_COMPONENT . '/controllers/ezrealty.php');
}


if (empty($controller)) $controller = 'ezrealty';
// Create the controller

$classname  = 'EZRealtyController'.ucfirst($controller);
//$controller = new $classname( array('default_task' => 'display') );
$controller = new $classname();

// Perform the Request task
$controller->execute( JRequest::getVar('task') );

// Redirect if set by the controller
$controller->redirect();

 
?>
