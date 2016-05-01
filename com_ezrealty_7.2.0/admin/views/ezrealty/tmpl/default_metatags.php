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

			<legend><?php echo JText::_('EZREALTY_SEO_OPT');?></legend>

			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_META_DESCRIPTION');?></div>
				<div class="controls"><textarea name="metadesc" id="metadesc" rows="10" class="input-large" maxlength="255" onkeyup="return ismaxlength(this)"><?php echo stripslashes($this->property->metadesc);?></textarea></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_META_KEYWORDS');?></div>
				<div class="controls"><textarea name="metakey" id="metakey" rows="10" class="input-large" maxlength="255" onkeyup="return ismaxlength(this)"><?php echo stripslashes($this->property->metakey);?></textarea></div>
			</div>

		</div>
	</div>

