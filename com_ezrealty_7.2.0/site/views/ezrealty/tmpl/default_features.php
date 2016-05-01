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

<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_DETAILS_TAB2A');?></div>


<?php if ($this->ezrealty->appliances){
$appliances = str_replace( ";", "; ", $this->ezrealty->appliances );
?>

	<div class="row-fluid">
		<div class="span12"><span style="font-weight: bold;"><?php echo JText::_('EZREALTY_CONFIG_FEATURES_APPLIANCES');?>: </span> <?php echo $appliances;?></div>
	</div>
	<br />
<?php } ?>
<?php if ($this->ezrealty->indoorfeatures){
$indoorfeatures = str_replace( ";", "; ", $this->ezrealty->indoorfeatures );
?>
	<div class="row-fluid">
		<div class="span12"><span style="font-weight: bold;"><?php echo JText::_('EZREALTY_CONFIG_FEATURES_INDOOR');?>: </span> <?php echo $indoorfeatures;?></div>
	</div>
	<br />

<?php } ?>
<?php if ($this->ezrealty->outdoorfeatures){
$outdoorfeatures = str_replace( ";", "; ", $this->ezrealty->outdoorfeatures );
?>

	<div class="row-fluid">
		<div class="span12"><span style="font-weight: bold;"><?php echo JText::_('EZREALTY_CONFIG_FEATURES_OUTDOOR');?>: </span> <?php echo $outdoorfeatures;?></div>
	</div>
	<br />
<?php } ?>
<?php if ($this->ezrealty->buildingfeatures){
$buildingfeatures = str_replace( ";", "; ", $this->ezrealty->buildingfeatures );
?>

	<div class="row-fluid">
		<div class="span12"><span style="font-weight: bold;"><?php echo JText::_('EZREALTY_CONFIG_FEATURES_BUILDING');?>: </span> <?php echo $buildingfeatures;?></div>
	</div>
	<br />
<?php } ?>
<?php if ($this->ezrealty->communityfeatures){
$communityfeatures = str_replace( ";", "; ", $this->ezrealty->communityfeatures );
?>

	<div class="row-fluid">
		<div class="span12"><span style="font-weight: bold;"><?php echo JText::_('EZREALTY_CONFIG_FEATURES_COMMUNITY');?>: </span> <?php echo $communityfeatures;?></div>
	</div>
	<br />

<?php } ?>
<?php if ($this->ezrealty->otherfeatures){
$otherfeatures = str_replace( ";", "; ", $this->ezrealty->otherfeatures );
?>

	<div class="row-fluid">
		<div class="span12"><span style="font-weight: bold;"><?php echo JText::_('EZREALTY_OTHER_FEATURES');?>: </span> <?php echo $otherfeatures;?></div>
	</div>
<?php } ?>

