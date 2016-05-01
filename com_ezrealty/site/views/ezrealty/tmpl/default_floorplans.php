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

JHtml::_('behavior.modal');

?>

<?php if ( $this->params->get( 'popup_linktype' ) ) { ?>

<script type="text/javascript">
//<![CDATA[
hs.registerOverlay({
	html: '<div class="closebutton" onclick="return hs.close(this)" title="Close"></div>',
	position: 'top right',
	fade: 2 // fading the semi-transparent overlay looks bad in IE
});

hs.graphicsDir = '<?php echo JURI::root();?>components/com_ezrealty/assets/highslide/graphics/';
hs.wrapperClassName = 'borderless';
//]]>
</script>

<?php } ?>

<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_FLPL');?></div>

<div class="row-fluid">
	<div class="span12">
		<?php if ( $this->ezrealty->flpl1 ) { ?>
			<?php if ( $this->params->get( 'popup_linktype' ) ) { ?>
				<a href="<?php echo JURI::root(); ?>images/ezrealty/floorplans/<?php echo $this->ezrealty->flpl1;?>" class="highslide" onclick="return hs.expand(this)">
			<?php } else { ?>
				<a class="modal" href="<?php echo JURI::root(); ?>images/ezrealty/floorplans/<?php echo $this->ezrealty->flpl1;?>">
			<?php } ?>
				<img src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/floorplans.png" border="0" title="<?php echo JText::_('EZREALTY_VIEW_FLPL');?>" alt="<?php echo JText::_('EZREALTY_VIEW_FLPL');?>" />
			</a> 
		<?php } ?>

		<?php if ( $this->ezrealty->flpl2 ) { ?>
			<?php if ( $this->params->get( 'popup_linktype' ) ) { ?>
				<a href="<?php echo JURI::root(); ?>images/ezrealty/floorplans/<?php echo $this->ezrealty->flpl2;?>" class="highslide" onclick="return hs.expand(this)">
			<?php } else { ?>
				<a class="modal" href="<?php echo JURI::root(); ?>images/ezrealty/floorplans/<?php echo $this->ezrealty->flpl2;?>">
			<?php } ?>
				<img src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/floorplans.png" border="0" title="<?php echo JText::_('EZREALTY_VIEW_FLPL');?>" alt="<?php echo JText::_('EZREALTY_VIEW_FLPL');?>" />
			</a> 
		<?php } ?>
	</div>
</div>
