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

$editor =& JFactory::getEditor();

?>

	<legend><?php echo JText::_('EZREALTY_DETAILS_SALESCOPY');?></legend>

	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_ADLINE');?></div>
		<div class="controls"><input class="input-xlarge ezinput required" type="text" name="adline" id="adline" size="40" maxlength="255" value="<?php echo stripslashes($this->property->adline);?>" /></div>
	</div>
	<div class="control-group">
		<div class="hasTip control-label" title="<?php echo JText::_( 'COM_EZREALTY_ALIAS' ); ?>::<?php echo JText::_( 'EZREALTY_ALIAS_DESC' ); ?>"><?php echo JText::_('COM_EZREALTY_ALIAS');?></div>
		<div class="controls"><input class="input-xlarge ezinput required" type="text" name="alias" id="alias" size="40" maxlength="255" value="<?php echo stripslashes($this->property->alias);?>" /></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_SHORTDESC');?></div>
		<div class="controls"><textarea name="smalldesc" id="smalldesc" rows="6" class="input-xlarge required" maxlength="255" onkeyup="return ismaxlength(this)"><?php echo stripslashes($this->property->smalldesc);?></textarea></div>
	</div>

