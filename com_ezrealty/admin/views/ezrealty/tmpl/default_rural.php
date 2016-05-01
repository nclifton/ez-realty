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

		<legend><?php echo JText::_('EZREALTY_DETAILS_RURAL');?></legend>

		<div class="row-fluid">
			<div class="span6">

				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_FENCING');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="fencing" id="fencing" maxlength="50" value="<?php echo stripslashes($this->property->fencing);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_RAINFALL');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="rainfall" id="rainfall" maxlength="50" value="<?php echo stripslashes($this->property->rainfall);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_SOILTYPE');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="soiltype" id="soiltype" maxlength="50" value="<?php echo stripslashes($this->property->soiltype);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_GRAZING');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="grazing" id="grazing" maxlength="50" value="<?php echo stripslashes($this->property->grazing);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_CROPPING');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="cropping" id="cropping" maxlength="50" value="<?php echo stripslashes($this->property->cropping);?>" /></div>
				</div>

			</div>
			<div class="span6">

				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_IRRIGATION');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="irrigation" id="irrigation" maxlength="50" value="<?php echo stripslashes($this->property->irrigation);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_WATERRESOURCES');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="waterresources" id="waterresources" maxlength="50" value="<?php echo stripslashes($this->property->waterresources);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_CARRYINGCAP');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="carryingcap" id="carryingcap" maxlength="50" value="<?php echo stripslashes($this->property->carryingcap);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_STORAGE');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="storage" id="storage" maxlength="50" value="<?php echo stripslashes($this->property->storage);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_SERVICES');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="services" id="services" maxlength="50" value="<?php echo stripslashes($this->property->services);?>" /></div>
				</div>

			</div>
		</div>

	</div>
</div>
