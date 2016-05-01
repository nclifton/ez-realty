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

			<legend><?php echo JText::_('EZREALTY_DETAILS_GENADMINDET');?></legend>

			<?php if ( $this->ezrparams->get( 'er_useoffice') ) { ?>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_OFFICEID');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="office_id" id="office_id" size="15" maxlength="30" value="<?php echo stripslashes($this->property->office_id);?>" /></div>
				</div>
			<?php } ?>
			<?php if ( $this->ezrparams->get( 'er_usemlsid') ) { ?>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_MLSID');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="mls_id" id="mls_id" size="15" maxlength="30" value="<?php echo stripslashes($this->property->mls_id);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_MLSAGENT');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="mls_agent" id="mls_agent" size="15" maxlength="30" value="<?php echo stripslashes($this->property->mls_agent);?>" /></div>
				</div>
			<?php } ?>
			<div class="control-group">
				<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_DETAILS_PRIVATESTUFF' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_PRIVATESTUFF' ); ?>"><?php echo JText::_('EZREALTY_DETAILS_PRIVATESTUFF');?></div>
				<div class="controls"><textarea name="private" id="private" rows="10" class="input-large"><?php echo stripslashes($this->property->private);?></textarea></div>
			</div>

		</div>
	</div>

