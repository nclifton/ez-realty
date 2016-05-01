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

			<legend><?php echo JText::_('EZREALTY_DETAILS_RENTALAVAIL');?></legend>

			<?php if ($ezrparams->get( 'er_usetype2') ) { ?>
				<div class="control-group">
					<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_DATE_AVAILABILITY' ); ?>::<?php echo JText::_( 'EZREALTY_DATE_AVAILABILITY_DESC' ); ?>"><?php echo JText::_('EZREALTY_DATE_AVAILABILITY');?></div>
					<div class="controls"><?php echo JHTML::calendar($this->property->availdate,'availdate','availdate','%Y-%m-%d'); ?></div>
				</div>
			<?php } ?>
			<?php if ($ezrparams->get( 'use_realtybookings') ) { ?>
				<div class="control-group">
					<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_SHOW_CALENDAR' ); ?>::<?php echo JText::_( 'EZREALTY_SHOW_CALENDAR_DESC' ); ?>"><?php echo JText::_('EZREALTY_SHOW_CALENDAR'); ?></div>
					<div class="controls">
						<fieldset id="viewbooking" class="radio btn-group">
							<input type="radio" id="viewbooking0" name="viewbooking" value="0" <?php if ($this->property->viewbooking=='0'){ echo " checked=CHECKED "; } ?> />
							<label for="viewbooking0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
							<input type="radio" id="viewbooking1" name="viewbooking" value="1" <?php if ($this->property->viewbooking=='1'){ echo " checked=CHECKED "; } ?> />
							<label for="viewbooking1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
						</fieldset>
					</div>
				</div>
			<?php } ?>

		</div>
	</div>

