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
	<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_OHOUSE');?></div>
<?php } ?>


<div class="row-fluid">
	<div class="span12">

	<?php if ( $this->params->get( 'er_layout' ) != 2 ){ ?>
		<div class="row-fluid">
			<div class="span6">
	<?php } ?>

	<?php if ($this->ezrealty->ohdate && $this->ezrealty->ohdate != '0000-00-00') {?>
		<div class="row-fluid">
			<div class="span12" style="font-weight: bold;"><i class="ezicon-calendar <?php echo $pageiconcolour;?>"></i> <?php echo JText::_('EZREALTY_OPENHOUSE_DATE');?>: <?php echo EZRealtyFHelper::convertDate ($this->ezrealty->ohdate);?></div>
		</div>
	<?php } ?>
	<?php if ($this->ezrealty->ohstarttime && $this->ezrealty->ohstarttime != '00:00:00') {?>
		<div class="row-fluid">
			<div class="span12"><i class="ezicon-time <?php echo $pageiconcolour;?>"></i> <?php echo JText::_('EZREALTY_OPENHOUSE_STARTTIME');?>: <?php echo EZRealtyFHelper::convertTime ($this->ezrealty->ohstarttime);?></div>
		</div>
	<?php } ?>
	<?php if ($this->ezrealty->ohendtime && $this->ezrealty->ohendtime != '00:00:00') {?>
		<div class="row-fluid">
			<div class="span12"><i class="ezicon-time <?php echo $pageiconcolour;?>"></i> <?php echo JText::_('EZREALTY_OPENHOUSE_ENDTIME');?>: <?php echo EZRealtyFHelper::convertTime ($this->ezrealty->ohendtime);?></div>
		</div>
	<?php } ?>

	<?php if ( $this->params->get( 'er_layout' ) != 2 ){ ?>
			</div>
			<div class="span6">
	<?php } ?>

	<?php if ($this->ezrealty->ohdate2 && $this->ezrealty->ohdate2 != '0000-00-00') {?>
		<div class="row-fluid">
			<div class="span12" style="font-weight: bold;"><i class="ezicon-calendar <?php echo $pageiconcolour;?>"></i> <?php echo JText::_('EZREALTY_OPENHOUSE_DATE');?>: <?php echo EZRealtyFHelper::convertDate ($this->ezrealty->ohdate2);?></div>
		</div>
	<?php } ?>
	<?php if ($this->ezrealty->ohstarttime2 && $this->ezrealty->ohstarttime2 != '00:00:00') {?>
		<div class="row-fluid">
			<div class="span12"><i class="ezicon-time <?php echo $pageiconcolour;?>"></i> <?php echo JText::_('EZREALTY_OPENHOUSE_STARTTIME');?>: <?php echo EZRealtyFHelper::convertTime ($this->ezrealty->ohstarttime2);?></div>
		</div>
	<?php } ?>
	<?php if ($this->ezrealty->ohendtime2 && $this->ezrealty->ohendtime2 != '00:00:00') {?>
		<div class="row-fluid">
			<div class="span12"><i class="ezicon-time <?php echo $pageiconcolour;?>"></i> <?php echo JText::_('EZREALTY_OPENHOUSE_ENDTIME');?>: <?php echo EZRealtyFHelper::convertTime ($this->ezrealty->ohendtime2);?></div>
		</div>
	<?php } ?>

	<?php if ( $this->params->get( 'er_layout' ) != 2 ){ ?>
			</div>
		</div>
	<?php } ?>

		<?php if ($this->ezrealty->ohouse_desc ) {?>
			<div class="row-fluid">
				<div class="span12">
					<?php echo stripslashes($this->ezrealty->ohouse_desc);?>
				</div>
			</div>
		<?php } ?>

	</div>
</div>
