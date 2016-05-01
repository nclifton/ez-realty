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

<div class="btn-large btn" style="width: 95%; text-align: left; margin-bottom: 5px;" data-toggle="collapse" data-target="#ezrealty-currency"><i class="icon-list"></i> &nbsp;&nbsp;&nbsp;<?php echo JText::_('EZREALTY_CURRENCY_DETAILS');?></div>

<div id="ezrealty-currency" class="collapse">

	<div class="row-fluid">
		<div class="span12 toppad">

			<div class="control-group">
				<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_CONFIG_CURRENCYSIGN' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?>"><?php echo JText::_('EZREALTY_CONFIG_CURRENCYSIGN');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="currency" id="currency" size="15" maxlength="20" value="<?php echo $this->property->currency; ?>" /></div>
			</div>
			<div class="control-group">
				<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_CONFIG_CURRENCYPOS' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?>"><?php echo JText::_('EZREALTY_CONFIG_CURRENCYPOS');?></div>
				<div class="controls"><?php echo $this->lists['currency_position']; ?></div>
			</div>
			<div class="control-group">
				<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_CONFIG_CURRENCYFORMAT' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?>"><?php echo JText::_('EZREALTY_CONFIG_CURRENCYFORMAT');?></div>
				<div class="controls"><?php echo $this->lists['currency_format']; ?></div>
			</div>

		</div>
	</div>

</div>