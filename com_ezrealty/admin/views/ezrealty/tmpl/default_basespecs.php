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

<script type="text/javascript">
<!--
function updatesum() {
document.adminForm.bathrooms.value = (document.adminForm.fullBaths.value -0) + (document.adminForm.thqtrBaths.value -0) + (document.adminForm.halfBaths.value -0) + (document.adminForm.qtrBaths.value -0) + (document.adminForm.ensuite.value -0);
}
//-->
</script>	


	<div class="row-fluid">
		<div class="span12">

			<legend><?php echo JText::_('EZREALTY_DETAILS_BASESPECS');?></legend>

			<?php if ($ezrparams->get( 'er_maxrooms')) { ?>
			
				<div class="control-group">
					<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_DETAILS_BEDROOMS' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?>"><?php echo JText::_('EZREALTY_DETAILS_BEDROOMS');?></div>
					<div class="controls"><?php echo $this->lists['bedrooms']; ?></div>
				</div>
			
			<?php } else { ?>
			
				<div align="center" class="alert alert-error"><h4><?php echo JText::_('EZREALTY_CONFIG_BEDROOMS_WARNING');?></h4></div>
			
			<?php } ?>

			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_SLEEPS');?></div>
				<div class="controls">
					<?php $this->property->sleeps = preg_replace(array('/0/'), array(''), $this->property->sleeps); ?>
					<input class="input-large ezinput" type="text" name="sleeps" id="sleeps" size="15" maxlength="5" value="<?php echo stripslashes($this->property->sleeps);?>" />
				</div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_TOTALROOMS');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="totalrooms" id="totalrooms" size="15" maxlength="5" value="<?php echo stripslashes($this->property->totalrooms);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_LIVINGAREA');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="livingarea" id="livingarea" size="15" maxlength="5" value="<?php echo stripslashes($this->property->livingarea);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_OTHERROOMS');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="otherrooms" id="otherrooms" size="15" maxlength="5" value="<?php echo stripslashes($this->property->otherrooms);?>" /></div>
			</div>
			<div class="control-group">
				<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_DETAILS_BATHROOMS' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_BATHROOMS_DESC' ); ?>"><?php echo JText::_('EZREALTY_DETAILS_BATHROOMS');?></div>
				<div class="controls">
					<div class="input-append" style="padding-bottom: 5px;">
						<input class="input-mini" type="text" name="fullBaths" id="fullBaths" maxlength="3" value="<?php echo stripslashes($this->property->fullBaths);?>" onChange="updatesum()" /> <span class="add-on" style="width: 70px;" ><span style="font-size: 80%;" ><?php echo JText::_('EZREALTY_DETAILS_FULL');?></span></span>
					</div><br />
					<div class="input-append" style="padding-bottom: 5px;">
						<input class="input-mini" type="text" name="thqtrBaths" id="thqtrBaths" maxlength="3" value="<?php echo stripslashes($this->property->thqtrBaths);?>" onChange="updatesum()" /> <span class="add-on" style="width: 70px;" ><span style="font-size: 80%;" ><?php echo JText::_('EZREALTY_DETAILS_THRQTR');?></span></span>
					</div><br />
					<div class="input-append" style="padding-bottom: 5px;">
						<input class="input-mini" type="text" name="halfBaths" id="halfBaths" maxlength="3" value="<?php echo stripslashes($this->property->halfBaths);?>" onChange="updatesum()" /> <span class="add-on" style="width: 70px;" ><span style="font-size: 80%;" ><?php echo JText::_('EZREALTY_DETAILS_HALF');?></span></span>
					</div><br />
					<div class="input-append" style="padding-bottom: 5px;">
						<input class="input-mini" type="text" name="qtrBaths" id="qtrBaths" maxlength="3" value="<?php echo stripslashes($this->property->qtrBaths);?>" onChange="updatesum()" /> <span class="add-on" style="width: 70px;" ><span style="font-size: 80%;" ><?php echo JText::_('EZREALTY_DETAILS_QTR');?></span></span>
					</div><br />
					<div class="input-append" style="padding-bottom: 5px;">
						<input class="input-mini" type="text" name="ensuite" id="ensuite" maxlength="3" value="<?php echo stripslashes($this->property->ensuite);?>" onChange="updatesum()" /> <span class="add-on" style="width: 70px;" ><span style="font-size: 80%;" ><?php echo JText::_('EZREALTY_DETAILS_ENSUITEBATHS');?></span></span>
					</div><br />
					<div class="input-append" style="padding-bottom: 5px;">
						<?php if ( $this->property->bathrooms ) { $this->property->bathrooms = preg_replace(array('/0.00/', '/.00/', '/.50/', '/.30/', '/.80/'), array('', '', '.5', '.25', '.75'), $this->property->bathrooms); } ?>
						<input class="input-mini" type="text" name="bathrooms" id="bathrooms" maxlength="3" value="<?php echo stripslashes($this->property->bathrooms);?>" /> <span class="add-on" style="width: 70px;" ><span style="font-size: 80%;" ><?php echo JText::_('EZREALTY_DETAILS_TOTAL');?></span></span>
					</div>
				</div>
			</div>

		</div>
	</div>

