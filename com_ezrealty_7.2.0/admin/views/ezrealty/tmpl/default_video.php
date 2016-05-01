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

	<div class="row-fluid">
		<div class="span12 toppad">

			<div class="control-group">
				<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_PROPERTIES_VVTURL' ); ?>::<?php echo JText::_( 'EZREALTY_PROPERTIES_VVTURL' ); ?>"><?php echo JText::_('EZREALTY_PROPERTIES_VVTURL');?></div>
				<div class="controls"><input class="input-xlarge" type="text" name="mediaUrl" id="mediaUrl" value="<?php echo stripslashes($this->property->mediaUrl);?>" /></div>
			</div>
		
			<div class="control-group">
				<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_PROPERTIES_URLTYPE' ); ?>::<?php echo JText::_( 'EZREALTY_PROPERTIES_URLTYPE' ); ?>"><?php echo JText::_('EZREALTY_PROPERTIES_URLTYPE'); ?></div>
				<div class="controls">
					<fieldset id="mediaType" class="radio btn-group">
						<input type="radio" id="mediaType0" name="mediaType" value="0" <?php if ($this->property->mediaType=='0'){ echo " checked=CHECKED "; } ?> />
						<label for="mediaType0"><?php echo JText::_( 'EZREALTY_SCHOOLS_NONE' ); ?></label>
						<input type="radio" id="mediaType1" name="mediaType" value="1" <?php if ($this->property->mediaType=='1'){ echo " checked=CHECKED "; } ?> />
						<label for="mediaType1"><?php echo JText::_( 'EZREALTY_PROPERTIES_VIRTUALTOUR' ); ?></label>
						<input type="radio" id="mediaType2" name="mediaType" value="2" <?php if ($this->property->mediaType=='2'){ echo " checked=CHECKED "; } ?> />
						<label for="mediaType2"><?php echo JText::_( 'EZREALTY_PROPERTIES_YOUTUBESHARE' ); ?></label>
		
					</fieldset>
				</div>
			</div>

		</div>
	</div>

