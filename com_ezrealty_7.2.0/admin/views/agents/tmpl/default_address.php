<?php

/**
* @package EZ Realty
* @version 7.2.0
* @author  Kathy Strickland (aka PixelBunyiP) - Raptor Services <kathy@raptorservices.com>
* @link    http://www.raptorservices.com
* @copyright Copyright (C) 2006 - 2014 Raptor Developments Pty Ltd T/as Raptor Services-All rights reserved
* @license Creative Commons GNU GPL, see http://creativecommons.org/licenses/GPL/2.0/ for full license.
**/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

?>

<legend><?php echo JText::_('EZREALTY_TABS_ADDRESS');?></legend>

	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_UNITNUM'); ?></div>
		<div class="controls"><input class="input-large" type="text" name="seller_unitnum" id="seller_unitnum" value="<?php echo stripslashes($this->profile->seller_unitnum); ?>" /></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_STREETNUM'); ?></div>
		<div class="controls"><input class="input-large" type="text" name="seller_address1" id="seller_address1" maxlength="20" value="<?php echo stripslashes($this->profile->seller_address1); ?>" /></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_PROPADDRESS2'); ?></div>
		<div class="controls"><input class="input-large" type="text" name="seller_address2" id="seller_address2" maxlength="60" value="<?php echo stripslashes($this->profile->seller_address2); ?>" /></div>
	</div>
	<div class="control-group">
		<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_DETAILS_PROPCITY' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?>"><?php echo JText::_('EZREALTY_DETAILS_PROPCITY'); ?></div>
		<div class="controls"><input class="input-large reqfield" type="text" name="seller_suburb" id="seller_suburb" maxlength="60" value="<?php echo stripslashes($this->profile->seller_suburb); ?>" /> <span class="badge badge-warning"><?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?></span></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_PROPPOSTCODE'); ?></div>
		<div class="controls"><input class="input-large" type="text" name="seller_pcode" id="seller_pcode" maxlength="60" value="<?php echo stripslashes($this->profile->seller_pcode); ?>" /></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_AREA'); ?></div>
		<div class="controls"><input class="input-large" type="text" name="seller_state" id="seller_state" maxlength="60" value="<?php echo stripslashes($this->profile->seller_state); ?>" /></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_COUNTRY'); ?></div>
		<div class="controls"><input class="input-large" type="text" name="seller_country" id="seller_country" maxlength="60" value="<?php echo stripslashes($this->profile->seller_country); ?>" /></div>
	</div>

	<div class="control-group">
		<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_DETAILS_DISPLAYAD' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_DISPLAYAD_DESC' ); ?>"><?php echo JText::_('EZREALTY_DETAILS_DISPLAYAD'); ?></div>
		<div class="controls">
			<fieldset id="show_addy" class="radio btn-group">
				<input type="radio" id="show_addy0" name="show_addy" value="0" <?php if ($this->profile->show_addy=='0'){ echo " checked=CHECKED "; } ?> />
				<label for="show_addy0"><?php echo JText::_( 'EZREALTY_VIEWDET_NO' ); ?></label>
				<input type="radio" id="show_addy1" name="show_addy" value="1" <?php if ($this->profile->show_addy=='1'){ echo " checked=CHECKED "; } ?> />
				<label for="show_addy1"><?php echo JText::_( 'EZREALTY_VIEWDET_YES' ); ?></label>
			</fieldset>
		</div>
	</div>

<?php if ($this->params->get( 'er_usemap') ) { ?>

<legend><?php echo JText::_('COM_EZREALTY_MAPPING');?></legend>

	<div class="control-group">
		<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_LISTINGS_OWNCOORDS' ); ?>::<?php echo JText::_( 'EZREALTY_LISTINGS_OWNCOORDS_DESC' ); ?>"></div>
		<div class="controls"><?php echo JText::_('EZREALTY_LISTINGS_OWNCOORDS'); ?><br />
			<fieldset id="calcown" class="radio btn-group">
				<input type="radio" id="calcown0" name="calcown" value="0" <?php if ($this->profile->calcown=='0'){ echo " checked=CHECKED "; } ?> />
				<label for="calcown0"><?php echo JText::_( 'EZREALTY_VIEWDET_NO' ); ?></label>
				<input type="radio" id="calcown1" name="calcown" value="1" <?php if ($this->profile->calcown=='1'){ echo " checked=CHECKED "; } ?> />
				<label for="calcown1"><?php echo JText::_( 'EZREALTY_VIEWDET_YES' ); ?></label>
			</fieldset>

		</div>
	</div>

	<div class="control-group">
		<div class="control-label"> </div>
		<div class="controls">
			<table><tr><td class="nowrap">
				<input class="input-small" type="text" name="seller_declat" id="seller_declat" maxlength="20" value="<?php echo stripslashes($this->profile->seller_declat);?>" /><br />
				<?php echo JText::_( 'EZREALTY_DETAILS_DECLAT' ); ?>
			</td>
			<td class="nowrap">
				<input class="input-small" type="text" name="seller_declong" id="seller_declong" maxlength="20" value="<?php echo stripslashes($this->profile->seller_declong);?>" /><br />
				<?php echo JText::_( 'EZREALTY_DETAILS_DECLONG' ); ?>
			</td></tr></table>

		</div>
	</div>

<?php } ?>

