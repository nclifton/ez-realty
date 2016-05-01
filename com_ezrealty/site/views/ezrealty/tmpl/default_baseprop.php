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

<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_DETAILS_BASESPECS');?></div>

<?php if ( $this->ezrealty->bedrooms == -2 ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_BEDROOMS');?>: <?php echo JText::_('EZREALTY_COUCH');?></div>
	</div>
<?php } if ( $this->ezrealty->bedrooms == -1 ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_BEDROOMS');?>: <?php echo JText::_('EZREALTY_STUDIO');?></div>
	</div>
<?php } if ( $this->ezrealty->bedrooms >= 1 ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_BEDROOMS');?>: <?php echo stripslashes($this->ezrealty->bedrooms);?></div>
	</div>
<?php } if ( $this->ezrealty->sleeps >= 1 ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_SLEEPS');?>: <?php echo stripslashes($this->ezrealty->sleeps);?></div>
	</div>
<?php } ?>
<?php if ( $this->ezrealty->bathrooms > 0 ) {
	$this->ezrealty->bathrooms = preg_replace(array('/0.00/', '/.00/', '/.25/', '/.50/', '/.75/'), array('', '', '&#188;', '&#189;', '&#190;'), $this->ezrealty->bathrooms);
?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_TOTALBATHS');?>: <?php echo stripslashes($this->ezrealty->bathrooms);?></div>
	</div>
<?php } if ( $this->ezrealty->fullBaths > 0 ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_FULLBATHS');?>: <?php echo stripslashes($this->ezrealty->fullBaths);?></div>
	</div>
<?php } if ( $this->ezrealty->thqtrBaths > 0 ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_THRQTRBATHS');?>: <?php echo stripslashes($this->ezrealty->thqtrBaths);?></div>
	</div>
<?php } if ( $this->ezrealty->halfBaths > 0 ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_HALFBATHS');?>: <?php echo stripslashes($this->ezrealty->halfBaths);?></div>
	</div>
<?php } if ( $this->ezrealty->qtrBaths > 0 ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_QTRBATHS');?>: <?php echo stripslashes($this->ezrealty->qtrBaths);?></div>
	</div>
<?php } if ( $this->ezrealty->ensuite > 0 ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_ENBATHS');?>: <?php echo stripslashes($this->ezrealty->ensuite);?></div>
	</div>
<?php } if ( $this->ezrealty->totalrooms ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_TOTALROOMS');?>: <?php echo stripslashes($this->ezrealty->totalrooms);?></div>
	</div>
<?php } if ( $this->ezrealty->livingarea ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_LIVINGAREA');?>: <?php echo stripslashes($this->ezrealty->livingarea);?></div>
	</div>
<?php } if ( $this->ezrealty->otherrooms ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_OTHERROOMS');?>: <?php echo stripslashes($this->ezrealty->otherrooms);?></div>
	</div>
<?php } if ( $this->ezrealty->CovenantsYN ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_COVENANTS_APPLY');?></div>
	</div>
<?php } if ( $this->ezrealty->GarbageDisposalYN ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_GARDISP_AVAILABLE');?></div>
	</div>
<?php } if ( $this->ezrealty->RefrigeratorYN ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_REFRIG_AVAILABLE');?></div>
	</div>
<?php } if ( $this->ezrealty->OvenYN ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_OVEN_AVAILABLE');?></div>
	</div>
<?php } if ( $this->ezrealty->FamilyRoomPresent ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_FAMILYROOM_AVAILABLE');?></div>
	</div>
<?php } if ( $this->ezrealty->LaundryRoomPresent ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_LAUNDRYROOM_AVAILABLE');?></div>
	</div>
<?php } if ( $this->ezrealty->KitchenPresent ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_KITCHEN_AVAILABLE');?></div>
	</div>
<?php } if ( $this->ezrealty->LivingRoomPresent ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_LIVROOM_AVAILABLE');?></div>
	</div>
<?php } ?>
