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

	<legend><?php echo JText::_('EZREALTY_DETAILS_THETRANSACTION');?></legend>

	<div class="control-group">
		<div class="hasTip control-label" for="cid" title="<?php echo JText::_( 'EZREALTY_DETAILS_SELCAT' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?>"><?php echo JText::_('EZREALTY_DETAILS_SELCAT');?></div>
		<div class="controls"><?php echo $this->lists['cid'];?></div>
	</div>

	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_TRANSACTION_TYPE');?></div>
		<div class="controls"><?php echo $this->lists['type']; ?></div>
	</div>
<?php if ($ezrparams->get( 'er_userenttype' ) && $ezrparams->get( 'er_usetype2') ) { ?>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_RENTAL_TYPE');?></div>
		<div class="controls"><?php echo $this->lists['rent_type']; ?></div>
	</div>
<?php } ?>
<?php if ($ezrparams->get( 'er_usemarket' ) ) { ?>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_MARKET');?></div>
		<div class="controls"><?php echo $this->lists['sold']; ?></div>
	</div>
<?php } ?>
	<div class="control-group">
		<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_PRIME_PRICING' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_PRICE_DESC' ); ?>"><?php echo JText::_('EZREALTY_PRIME_PRICING');?></div>
		<div class="controls"><input class="input-large ezinput required" type="text" name="price" id="price" size="15" maxlength="20" value="<?php echo stripslashes($this->property->price);?>" /></div>
	</div>
<?php if ($ezrparams->get( 'er_usetype2') ) { ?>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_OFFPEAK_TARRIF');?></div>
		<div class="controls"><input class="input-large ezinput" type="text" name="offpeak" id="offpeak" size="15" maxlength="20" value="<?php echo stripslashes($this->property->offpeak);?>" /></div>
	</div>
<?php } ?>
<?php if ($ezrparams->get( 'er_usefrequit') && $ezrparams->get( 'er_usetype2') ) { ?>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_RENTAL_FREQUENCY');?></div>
		<div class="controls"><?php echo $this->lists['freq']; ?></div>
	</div>
<?php } ?>
<?php if ($ezrparams->get( 'er_usetype2') ) { ?>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_BOND');?></div>
		<div class="controls"><input class="input-large ezinput" type="text" name="bond" id="bond" size="15" maxlength="20" value="<?php echo stripslashes($this->property->bond);?>" /></div>
	</div>
<?php } ?>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_SHOW_PRICE'); ?></div>
		<div class="controls">
			<fieldset id="showprice" class="radio btn-group">
				<input type="radio" id="showprice0" name="showprice" value="0" <?php if ($this->property->showprice=='0'){ echo " checked=CHECKED "; } ?> />
				<label for="showprice0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
				<input type="radio" id="showprice1" name="showprice" value="1" <?php if ($this->property->showprice=='1'){ echo " checked=CHECKED "; } ?> />
				<label for="showprice1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
			</fieldset>
		</div>
	</div>
	<div class="control-group">
		<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_DETAILS_PRICEVIEW' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_PRICEVIEW_DESC' ); ?>"><?php echo JText::_('EZREALTY_DETAILS_PRICEVIEW');?></div>
		<div class="controls"><input class="input-large ezinput" type="text" name="priceview" id="priceview" size="40" maxlength="100" value="<?php echo stripslashes($this->property->priceview);?>" /></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_CLOSEPRICE');?></div>
		<div class="controls"><input class="input-large ezinput" type="text" name="closeprice" id="closeprice" size="15" maxlength="20" value="<?php echo stripslashes($this->property->closeprice);?>" /></div>
	</div>
