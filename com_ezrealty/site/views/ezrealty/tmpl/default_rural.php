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

<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_TABDETS_RURAL');?></div>

<?php if ( $this->ezrealty->fencing ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_FENCING');?>: <?php echo stripslashes($this->ezrealty->fencing);?></div>
	</div>
<?php } if ( $this->ezrealty->rainfall ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_RAINFALL');?>: <?php echo stripslashes($this->ezrealty->rainfall);?></div>
	</div>
<?php } if ( $this->ezrealty->soiltype ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_SOILTYPE');?>: <?php echo stripslashes($this->ezrealty->soiltype);?></div>
	</div>
<?php } if ( $this->ezrealty->grazing ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_GRAZING');?>: <?php echo stripslashes($this->ezrealty->grazing);?></div>
	</div>
<?php } if ( $this->ezrealty->cropping ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_CROPPING');?>: <?php echo stripslashes($this->ezrealty->cropping);?></div>
	</div>
<?php } if ( $this->ezrealty->irrigation ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_IRRIGATION');?>: <?php echo stripslashes($this->ezrealty->irrigation);?></div>
	</div>
<?php } if ( $this->ezrealty->waterresources ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_WATERRESOURCES');?>: <?php echo stripslashes($this->ezrealty->waterresources);?></div>
	</div>
<?php } if ( $this->ezrealty->carryingcap ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_CARRYINGCAP');?>: <?php echo stripslashes($this->ezrealty->carryingcap);?></div>
	</div>
<?php } if ( $this->ezrealty->storage ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_STORAGE');?>: <?php echo stripslashes($this->ezrealty->storage);?></div>
	</div>
<?php } if ( $this->ezrealty->services ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_SERVICES');?>: <?php echo stripslashes($this->ezrealty->services);?></div>
	</div>
<?php } ?>
