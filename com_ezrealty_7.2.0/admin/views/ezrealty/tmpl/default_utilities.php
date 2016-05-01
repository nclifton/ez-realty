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

			<legend><?php echo JText::_('EZREALTY_DETAILS_UTILITIES');?></legend>

			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_UTILITIES');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="Utlities" id="Utlities" size="15" maxlength="50" value="<?php echo stripslashes($this->property->Utlities);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_ELECSERV');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="ElectricService" id="ElectricService" size="15" maxlength="50" value="<?php echo stripslashes($this->property->ElectricService);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_AVUTILELEC');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="AverageUtilElec" id="AverageUtilElec" size="15" maxlength="50" value="<?php echo stripslashes($this->property->AverageUtilElec);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_AVUTILHEAT');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="AverageUtilHeat" id="AverageUtilHeat" size="15" maxlength="50" value="<?php echo stripslashes($this->property->AverageUtilHeat);?>" /></div>
			</div>

		</div>
	</div>

