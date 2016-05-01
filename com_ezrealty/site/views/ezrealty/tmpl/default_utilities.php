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

<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_DETAILS_UTILITIES');?></div>

<?php if ( $this->ezrealty->Utlities ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_UTILITIES');?>: <?php echo stripslashes($this->ezrealty->Utlities);?></div>
	</div>
<?php } if ( $this->ezrealty->ElectricService ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_ELECSERV');?>: <?php echo stripslashes($this->ezrealty->ElectricService);?></div>
	</div>
<?php } if ( $this->ezrealty->AverageUtilElec != "0.00" ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_AVUTILELEC');?>: <?php echo stripslashes($this->ezrealty->AverageUtilElec);?></div>
	</div>
<?php } if ( $this->ezrealty->AverageUtilHeat != "0.00" ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_AVUTILHEAT');?>: <?php echo stripslashes($this->ezrealty->AverageUtilHeat);?></div>
	</div>
<?php } if ( $this->ezrealty->PhoneAvailableYN ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_PHONE_AVAILABLE');?></div>
	</div>
<?php } ?>
