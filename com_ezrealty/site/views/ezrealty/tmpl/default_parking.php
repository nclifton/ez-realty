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

<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_DETAILS_PARKING_TITLE');?></div>

<?php if ( $this->ezrealty->ParkingSpaceYN ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_PARKING_SPACE_AVAILABLE');?></div>
	</div>
<?php } if ( $this->ezrealty->parkingGarage ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_GARPARKING');?>: <?php echo stripslashes($this->ezrealty->parkingGarage);?></div>
	</div>
<?php } if ( $this->ezrealty->parkingCarport ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_CPORTPARKING');?>: <?php echo stripslashes($this->ezrealty->parkingCarport);?></div>
	</div>
<?php } if ( $this->ezrealty->parking ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_PARKING');?>: <?php echo stripslashes($this->ezrealty->parking);?></div>
	</div>
<?php } if ( $this->ezrealty->garageDescription ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_GARDESC');?>: <?php echo stripslashes($this->ezrealty->garageDescription);?></div>
	</div>
<?php } ?>
