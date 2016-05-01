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

			<legend><?php echo JText::_('EZREALTY_DETAILS_LANDINFO');?></legend>

				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_SUBDIV');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="subdivision" id="subdivision" size="15" maxlength="50" value="<?php echo stripslashes($this->property->subdivision);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_LANDTYPE');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="landtype" id="landtype" size="15" maxlength="50" value="<?php echo stripslashes($this->property->landtype);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_LANDAREA');?> (<?php echo EZRealtyHelper::convertLandArea();?>)</div>
					<div class="controls"><input class="input-large ezinput" type="text" name="LandAreaSqFt" id="LandAreaSqFt" size="15" maxlength="50" value="<?php echo stripslashes($this->property->LandAreaSqFt);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_ACRES');?> (<?php echo EZRealtyFHelper::convertAcreage();?>)</div>
					<div class="controls"><input class="input-large ezinput" type="text" name="AcresTotal" id="AcresTotal" size="15" maxlength="50" value="<?php echo stripslashes($this->property->AcresTotal);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_LOTDIM');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="LotDimensions" id="LotDimensions" size="15" maxlength="50" value="<?php echo stripslashes($this->property->LotDimensions);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_FRONTAGE');?> <?php echo JText::_('EZREALTY_LAND_UNIT');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="frontage" id="frontage" size="15" maxlength="50" value="<?php echo stripslashes($this->property->frontage);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_DEPTH');?> <?php echo JText::_('EZREALTY_LAND_UNIT');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="depth" id="depth" size="15" maxlength="50" value="<?php echo stripslashes($this->property->depth);?>" /></div>
				</div>

		</div>
	</div>
