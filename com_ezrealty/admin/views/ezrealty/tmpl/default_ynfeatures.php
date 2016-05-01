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

			<legend><?php echo JText::_('EZREALTY_DETAILS_YNFEATURES');?></legend>

			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_COVENANTS');?></div>
				<div class="controls">
					<fieldset id="CovenantsYN" class="radio btn-group">
						<input type="radio" id="CovenantsYN0" name="CovenantsYN" value="0" <?php if ($this->property->CovenantsYN=='0'){ echo " checked=CHECKED "; } ?> />
						<label for="CovenantsYN0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
						<input type="radio" id="CovenantsYN1" name="CovenantsYN" value="1" <?php if ($this->property->CovenantsYN=='1'){ echo " checked=CHECKED "; } ?> />
						<label for="CovenantsYN1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
					</fieldset>
				</div>
			</div>
		
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_PHONEAVAIL');?></div>
				<div class="controls">
					<fieldset id="PhoneAvailableYN" class="radio btn-group">
						<input type="radio" id="PhoneAvailableYN0" name="PhoneAvailableYN" value="0" <?php if ($this->property->PhoneAvailableYN=='0'){ echo " checked=CHECKED "; } ?> />
						<label for="PhoneAvailableYN0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
						<input type="radio" id="PhoneAvailableYN1" name="PhoneAvailableYN" value="1" <?php if ($this->property->PhoneAvailableYN=='1'){ echo " checked=CHECKED "; } ?> />
						<label for="PhoneAvailableYN1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
					</fieldset>
				</div>
			</div>
		
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_GARBDIS');?></div>
				<div class="controls">
					<fieldset id="GarbageDisposalYN" class="radio btn-group">
						<input type="radio" id="GarbageDisposalYN0" name="GarbageDisposalYN" value="0" <?php if ($this->property->GarbageDisposalYN=='0'){ echo " checked=CHECKED "; } ?> />
						<label for="GarbageDisposalYN0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
						<input type="radio" id="GarbageDisposalYN1" name="GarbageDisposalYN" value="1" <?php if ($this->property->GarbageDisposalYN=='1'){ echo " checked=CHECKED "; } ?> />
						<label for="GarbageDisposalYN1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
					</fieldset>
				</div>
			</div>
		
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_REFRIG');?></div>
				<div class="controls">
					<fieldset id="RefrigeratorYN" class="radio btn-group">
						<input type="radio" id="RefrigeratorYN0" name="RefrigeratorYN" value="0" <?php if ($this->property->RefrigeratorYN=='0'){ echo " checked=CHECKED "; } ?> />
						<label for="RefrigeratorYN0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
						<input type="radio" id="RefrigeratorYN1" name="RefrigeratorYN" value="1" <?php if ($this->property->RefrigeratorYN=='1'){ echo " checked=CHECKED "; } ?> />
						<label for="RefrigeratorYN1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
					</fieldset>
				</div>
			</div>
		
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_OVENYN');?></div>
				<div class="controls">
					<fieldset id="OvenYN" class="radio btn-group">
						<input type="radio" id="OvenYN0" name="OvenYN" value="0" <?php if ($this->property->OvenYN=='0'){ echo " checked=CHECKED "; } ?> />
						<label for="OvenYN0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
						<input type="radio" id="OvenYN1" name="OvenYN" value="1" <?php if ($this->property->OvenYN=='1'){ echo " checked=CHECKED "; } ?> />
						<label for="OvenYN1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
					</fieldset>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_FAMROOM');?></div>
				<div class="controls">
					<fieldset id="FamilyRoomPresent" class="radio btn-group">
						<input type="radio" id="FamilyRoomPresent0" name="FamilyRoomPresent" value="0" <?php if ($this->property->FamilyRoomPresent=='0'){ echo " checked=CHECKED "; } ?> />
						<label for="FamilyRoomPresent0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
						<input type="radio" id="FamilyRoomPresent1" name="FamilyRoomPresent" value="1" <?php if ($this->property->FamilyRoomPresent=='1'){ echo " checked=CHECKED "; } ?> />
						<label for="FamilyRoomPresent1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
					</fieldset>
				</div>
			</div>
		
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_LAUNDROOM');?></div>
				<div class="controls">
					<fieldset id="LaundryRoomPresent" class="radio btn-group">
						<input type="radio" id="LaundryRoomPresent0" name="LaundryRoomPresent" value="0" <?php if ($this->property->LaundryRoomPresent=='0'){ echo " checked=CHECKED "; } ?> />
						<label for="LaundryRoomPresent0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
						<input type="radio" id="LaundryRoomPresent1" name="LaundryRoomPresent" value="1" <?php if ($this->property->LaundryRoomPresent=='1'){ echo " checked=CHECKED "; } ?> />
						<label for="LaundryRoomPresent1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
					</fieldset>
				</div>
			</div>
		
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_KITCHPRES');?></div>
				<div class="controls">
					<fieldset id="KitchenPresent" class="radio btn-group">
						<input type="radio" id="KitchenPresent0" name="KitchenPresent" value="0" <?php if ($this->property->KitchenPresent=='0'){ echo " checked=CHECKED "; } ?> />
						<label for="KitchenPresent0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
						<input type="radio" id="KitchenPresent1" name="KitchenPresent" value="1" <?php if ($this->property->KitchenPresent=='1'){ echo " checked=CHECKED "; } ?> />
						<label for="KitchenPresent1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
					</fieldset>
				</div>
			</div>
		
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_LIVROOM');?></div>
				<div class="controls">
					<fieldset id="LivingRoomPresent" class="radio btn-group">
						<input type="radio" id="LivingRoomPresent0" name="LivingRoomPresent" value="0" <?php if ($this->property->LivingRoomPresent=='0'){ echo " checked=CHECKED "; } ?> />
						<label for="LivingRoomPresent0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
						<input type="radio" id="LivingRoomPresent1" name="LivingRoomPresent" value="1" <?php if ($this->property->LivingRoomPresent=='1'){ echo " checked=CHECKED "; } ?> />
						<label for="LivingRoomPresent1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
					</fieldset>
				</div>
			</div>
		
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_PSPACEYN');?></div>
				<div class="controls">
					<fieldset id="ParkingSpaceYN" class="radio btn-group">
						<input type="radio" id="ParkingSpaceYN0" name="ParkingSpaceYN" value="0" <?php if ($this->property->ParkingSpaceYN=='0'){ echo " checked=CHECKED "; } ?> />
						<label for="ParkingSpaceYN0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
						<input type="radio" id="ParkingSpaceYN1" name="ParkingSpaceYN" value="1" <?php if ($this->property->ParkingSpaceYN=='1'){ echo " checked=CHECKED "; } ?> />
						<label for="ParkingSpaceYN1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
					</fieldset>
				</div>
			</div>

		</div>
	</div>

