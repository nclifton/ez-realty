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

$editor =& JFactory::getEditor();

?>

<legend><?php echo JText::_('COM_EZREALTY_DESCRIPTION');?></legend>

<div class="row-fluid">
	<div class="span12">
			<?php
			// parameters : areaname, content, hidden field, width, height, rows, cols
			echo $editor->display('propdesc', stripslashes($this->property->propdesc), '100%', '300', '60', '20');
			?>
	</div>
</div>
