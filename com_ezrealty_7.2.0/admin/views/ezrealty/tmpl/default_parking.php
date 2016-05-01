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

?>


	<div class="row-fluid">
		<div class="span12">

			<legend><?php echo JText::_('EZREALTY_DETAILS_PARKING_TITLE');?></legend>

			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_GARDESC');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="garageDescription" id="garageDescription" size="15" maxlength="150" value="<?php echo stripslashes($this->property->garageDescription);?>" /></div>
			</div>
		
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_GARPARKING');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="parkingGarage" id="parkingGarage" size="15" maxlength="15" value="<?php echo stripslashes($this->property->parkingGarage);?>" /></div>
			</div>
		
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_CPORTPARKING');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="parkingCarport" id="parkingCarport" size="15" maxlength="15" value="<?php echo stripslashes($this->property->parkingCarport);?>" /></div>
			</div>
		
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_PARKING');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="parking" id="parking" size="15" maxlength="50" value="<?php echo stripslashes($this->property->parking);?>" /></div>
			</div>

		</div>
	</div>

