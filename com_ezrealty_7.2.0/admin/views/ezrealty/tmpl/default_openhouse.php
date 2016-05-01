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

		<legend><?php echo JText::_('EZREALTY_MARKETING_OPENHOUSE');?></legend>

			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_OHOUSE'); ?></div>
				<div class="controls">
					<fieldset id="openhouse" class="radio btn-group">
						<input type="radio" id="openhouse0" name="openhouse" value="0" <?php if ($this->property->openhouse=='0'){ echo " checked=CHECKED "; } ?> />
						<label for="openhouse0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
						<input type="radio" id="openhouse1" name="openhouse" value="1" <?php if ($this->property->openhouse=='1'){ echo " checked=CHECKED "; } ?> />
						<label for="openhouse1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
					</fieldset>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_OPENHOUSE_DATE');?></div>
				<div class="controls"><?php echo JHTML::calendar($this->property->ohdate,'ohdate','ohdate','%Y-%m-%d'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_OPENHOUSE_STARTTIME');?></div>
				<div class="controls"><?php echo $this->lists['ohstarttime']; ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_OPENHOUSE_ENDTIME');?></div>
				<div class="controls"><?php echo $this->lists['ohendtime']; ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_OPENHOUSE_DATE');?></div>
				<div class="controls"><?php echo JHTML::calendar($this->property->ohdate2,'ohdate2','ohdate2','%Y-%m-%d'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_OPENHOUSE_STARTTIME');?></div>
				<div class="controls"><?php echo $this->lists['ohstarttime2']; ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_OPENHOUSE_ENDTIME');?></div>
				<div class="controls"><?php echo $this->lists['ohendtime2']; ?></div>
			</div>

			<div class="control-group">
				<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_DETAILS_OHOUSEDET_TITLE' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_OHOUSEDET_DESC' ); ?>"><?php echo JText::_('EZREALTY_DETAILS_OHOUSEDET_TITLE');?></div>
				<div class="controls"><textarea class="input-xlarge" rows="5" cols="34" name="ohouse_desc" id="ohouse_desc" maxlength="255" onkeyup="return ismaxlength(this)"><?php echo stripslashes($this->property->ohouse_desc);?></textarea></div>
			</div>


	</div>
</div>
