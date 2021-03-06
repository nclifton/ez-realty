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

if (!$this->params->get('page_iconcolour')){
	$pageiconcolour = "ezicon-black";
} else {
	$pageiconcolour = "ezicon-white";
}

?>

<?php if ( $this->params->get( 'er_layout' ) == 2 ){ ?>
	<br />
	<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_DETAILS_AUCTION');?></div>
<?php } ?>

<div class="row-fluid">
	<div class="span12">
	<?php if ($this->ezrealty->aucdate && $this->ezrealty->aucdate != '0000-00-00') { ?>
		<div class="row-fluid">
			<div class="span12" style="font-weight: bold;"><i class="ezicon-calendar <?php echo $pageiconcolour;?>"></i> <?php echo JText::_('EZREALTY_DETAILS_AUCTION_DATE');?>: <?php echo EZRealtyFHelper::convertDate ($this->ezrealty->aucdate);?></div>
		</div>
	<?php } ?>
	<?php if ($this->ezrealty->auctime && $this->ezrealty->auctime != '00:00:00') {?>
		<div class="row-fluid">
			<div class="span12"><i class="ezicon-time <?php echo $pageiconcolour;?>"></i> <?php echo JText::_('EZREALTY_DETAILS_AUCTION_TIME');?>: <?php echo EZRealtyFHelper::convertTime ($this->ezrealty->auctime);?></div>
		</div>
	<?php } ?>
	<?php if ($this->ezrealty->aucdet ) {?>
		<div class="row-fluid">
			<div class="span12">
				<?php echo stripslashes($this->ezrealty->aucdet);?>
			</div>
		</div>
	<?php } ?>
	</div>
</div>

