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

			<legend><?php echo JText::_('EZREALTY_DETAILS_FEES');?></legend>

			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_LISTINGS_HOFEES');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="hofees" id="hofees" size="15" maxlength="50" value="<?php echo stripslashes($this->property->hofees);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_ANNINSURANCE');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="AnnualInsurance" id="AnnualInsurance" size="15" maxlength="50" value="<?php echo stripslashes($this->property->AnnualInsurance);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_TAXAN');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="TaxAnnual" id="TaxAnnual" size="15" maxlength="50" value="<?php echo stripslashes($this->property->TaxAnnual);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_TAXYEAR');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="TaxYear" id="TaxYear" size="15" maxlength="50" value="<?php echo stripslashes($this->property->TaxYear);?>" /></div>
			</div>

		</div>
	</div>

