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

		<legend><?php echo JText::_('EZREALTY_DETAILS_AUCTION');?></legend>

		<div class="row-fluid">
			<div class="span12">
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_AUCTION_DATE');?></div>
					<div class="controls"><?php echo JHTML::calendar($this->property->aucdate,'aucdate','aucdate','%Y-%m-%d'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_AUCTION_TIME');?></div>
					<div class="controls"><?php echo $this->lists['auctime']; ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_AUCTION_DETAILS');?></div>
					<div class="controls"><textarea name="aucdet" id="aucdet" rows="7" class="input-xlarge" maxlength="255" onkeyup="return ismaxlength(this)"><?php echo stripslashes($this->property->aucdet);?></textarea></div>
				</div>
			</div>
		</div>

	</div>
</div>
