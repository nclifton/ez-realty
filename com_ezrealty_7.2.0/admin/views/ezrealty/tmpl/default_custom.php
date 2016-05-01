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

			<legend><?php echo JText::_('EZREALTY_DETAILS_CUSTOMSPECS');?></legend>

			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_CONFIG_CPI1');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="custom1" id="custom1" maxlength="50" value="<?php echo stripslashes($this->property->custom1);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_CONFIG_CPI2');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="custom2" id="custom2" maxlength="50" value="<?php echo stripslashes($this->property->custom2);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_CONFIG_CPI3');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="custom3" id="custom3" maxlength="50" value="<?php echo stripslashes($this->property->custom3);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_CUSTOM4');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="custom4" id="custom4" maxlength="50" value="<?php echo stripslashes($this->property->custom4);?>" /></div>
			</div>

			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_CUSTOM5');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="custom5" id="custom5" maxlength="50" value="<?php echo stripslashes($this->property->custom5);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_CUSTOM6');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="custom6" id="custom6" maxlength="50" value="<?php echo stripslashes($this->property->custom6);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_CUSTOM7');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="custom7" id="custom7" maxlength="50" value="<?php echo stripslashes($this->property->custom7);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_CUSTOM8');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="custom8" id="custom8" maxlength="50" value="<?php echo stripslashes($this->property->custom8);?>" /></div>
			</div>

		</div>
	</div>

