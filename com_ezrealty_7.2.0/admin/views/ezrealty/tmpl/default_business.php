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

		<legend><?php echo JText::_('EZREALTY_DETAILS_BUSINESS');?></legend>

		<div class="row-fluid">
			<div class="span6">

				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_TAKINGS');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="takings" id="takings" maxlength="50" value="<?php echo stripslashes($this->property->takings);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_RETURNS');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="returns" id="returns" maxlength="50" value="<?php echo stripslashes($this->property->returns);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_NETPROFIT');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="netprofit" id="netprofit" maxlength="50" value="<?php echo stripslashes($this->property->netprofit);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_BUSTYPE');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="bustype" id="bustype" maxlength="50" value="<?php echo stripslashes($this->property->bustype);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_BUSSUBTYPE');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="bussubtype" id="bussubtype" maxlength="50" value="<?php echo stripslashes($this->property->bussubtype);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_STOCK');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="stock" id="stock" maxlength="50" value="<?php echo stripslashes($this->property->stock);?>" /></div>
				</div>
			</div>
			<div class="span6">
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_FIXTURES');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="fixtures" id="fixtures" maxlength="50" value="<?php echo stripslashes($this->property->fixtures);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_FITTINGS');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="fittings" id="fittings" maxlength="50" value="<?php echo stripslashes($this->property->fittings);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_POFFICE');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="percentoffice" id="percentoffice" maxlength="50" value="<?php echo stripslashes($this->property->percentoffice);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_PWAREHOUSE');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="percentwarehouse" id="percentwarehouse" maxlength="50" value="<?php echo stripslashes($this->property->percentwarehouse);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_LOADING');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="loadingfac" id="loadingfac" maxlength="50" value="<?php echo stripslashes($this->property->loadingfac);?>" /></div>
				</div>

			</div>
		</div>

	</div>
</div>
