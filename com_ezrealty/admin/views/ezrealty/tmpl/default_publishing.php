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

	<div class="control-group">
		<div class="control-label">
			<?php echo JText::_( 'EZREALTY_LISTINGS_LISTINGDATE' );?>
		</div>
		<div class="controls">
			<?php echo JHTML::calendar($this->property->listdate,'listdate','listdate','%Y-%m-%d'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo JText::_( 'JSTATUS' );?>
		</div>
		<div class="controls">
			<?php echo $this->lists['published']; ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo JText::_( 'EZREALTY_LANGUAGE' );?>
		</div>
		<div class="controls">
			<?php echo $this->lists['language']; ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo JText::_('EZREALTY_DISPLAY_STATUS');?>
		</div>
		<div class="controls">
			<?php echo $this->lists['featured']; ?>
		</div>
	</div>

<?php if ($this->property->id) { ?>

	<div class="control-group">
		<div class="control-label">
			<?php echo JText::_( 'EZREALTY_AD_NUMBER' );?>
		</div>
		<div class="controls">
			<?php echo $this->property->id;?>
		</div>
	</div>

<?php } ?>

	<div class="control-group">
		<div class="control-label">
		
		</div>
		<div class="controls">
			<input type="button" name="<?php echo JText::_('COM_EZREALTY_SAVE') ?>" value="<?php echo JText::_('COM_EZREALTY_SAVE') ?>" class="btn-large btn-primary" onclick="updatedoc(0)" />
			<input type="button" name="<?php echo JText::_('apply') ?>" value="<?php echo JText::_('COM_EZREALTY_APPLY') ?>" class="btn-large btn-primary" onclick="updatedoc(1)" />
		</div>
	</div>
