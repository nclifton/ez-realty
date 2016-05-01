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

<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_DETAILS_LANDINFO');?></div>

<?php if ( $this->ezrealty->landtype ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_LANDTYPE');?>: <?php echo stripslashes($this->ezrealty->landtype);?></div>
	</div>
<?php } if ( $this->ezrealty->LandAreaSqFt ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_LANDAREA');?>: <?php echo stripslashes($this->ezrealty->LandAreaSqFt);?> <?php echo EZRealtyFHelper::convertLandArea();?></div>
	</div>
<?php } if ( $this->ezrealty->AcresTotal ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_ACRES');?>: <?php echo stripslashes($this->ezrealty->AcresTotal);?> <?php echo EZRealtyFHelper::convertAcreage();?></div>
	</div>
<?php } if ( $this->ezrealty->LotDimensions ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_LOTDIM');?>: <?php echo stripslashes($this->ezrealty->LotDimensions);?></div>
	</div>
<?php } if ( $this->ezrealty->frontage ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_FRONTAGE');?>: <?php echo stripslashes($this->ezrealty->frontage);?> <?php echo JText::_('EZREALTY_LAND_UNIT');?></div>
	</div>
<?php } if ( $this->ezrealty->depth ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_DEPTH');?>: <?php echo stripslashes($this->ezrealty->depth);?> <?php echo JText::_('EZREALTY_LAND_UNIT');?></div>
	</div>
<?php } ?>
