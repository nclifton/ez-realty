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

$ezrparams = JComponentHelper::getParams ('com_ezrealty');

?>

	<div class="row-fluid">
		<div class="span12">

			<legend><?php echo JText::_('EZREALTY_DETAILS_GENERAL');?></legend>

			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_CTOWN');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="ctown" id="ctown" maxlength="50" value="<?php echo stripslashes($this->property->ctown);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_CTPORT');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="ctport" id="ctport" maxlength="50" value="<?php echo stripslashes($this->property->ctport);?>" /></div>
			</div>

		</div>
	</div>

