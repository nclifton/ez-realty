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

			<legend><?php echo JText::_('EZREALTY_DETAILS_BANDF_TITLE');?></legend>

			<div class="control-group">
				<div class="control-label"><?php echo JText::_('COM_EZREALTY_LISTINGS_BANDF');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="BasementAndFoundation" id="BasementAndFoundation" size="15" maxlength="100" value="<?php echo stripslashes($this->property->BasementAndFoundation);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('COM_EZREALTY_LISTINGS_BSIZE');?> (<?php echo EZRealtyHelper::convertFloorArea();?>)</div>
				<div class="controls"><input class="input-large ezinput" type="text" name="BasementSize" id="BasementSize" size="15" maxlength="50" value="<?php echo stripslashes($this->property->BasementSize);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('COM_EZREALTY_LISTINGS_PCTFINISHED');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="BasementPctFinished" id="BasementPctFinished" size="15" maxlength="50" value="<?php echo stripslashes($this->property->BasementPctFinished);?>" /></div>
			</div>

		</div>
	</div>

