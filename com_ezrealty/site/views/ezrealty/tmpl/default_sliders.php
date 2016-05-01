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

if (!$this->params->get('page_iconcolour')){
	$pageiconcolour = "ezicon-black";
} else {
	$pageiconcolour = "ezicon-white";
}

if ( $this->ezrealty->custom1 || $this->ezrealty->custom2 || $this->ezrealty->custom3 || $this->ezrealty->custom4 || $this->ezrealty->custom5 || $this->ezrealty->custom6 || $this->ezrealty->custom7 || $this->ezrealty->custom8 ){
	$showcustom = 1;
} else {
	$showcustom = 0;
}
if ( $this->ezrealty->appliances || $this->ezrealty->indoorfeatures || $this->ezrealty->outdoorfeatures || $this->ezrealty->buildingfeatures || $this->ezrealty->communityfeatures || $this->ezrealty->otherfeatures ){
	$showfeatures = 1;
} else {
	$showfeatures = 0;
}
if ( $this->ezrealty->ctown || $this->ezrealty->ctport ){
	$showcom = 1;
} else {
	$showcom = 0;
}

?>

<div class="accordion" id="accordion2">

	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
				<i class="icon-tags <?php echo $pageiconcolour;?>"> </i>&nbsp;&nbsp;<span style="font-weight: bold; font-size: 120%;"><?php echo JText::_('EZREALTY_INFO_KEY_DETAILS');?></span>
			</a>
		</div>
		<div id="collapseOne" class="accordion-body collapse">
			<div class="accordion-inner">
				<?php echo $this->loadTemplate('overview'); ?> <!-- /.overview output -->
			</div>
		</div>
	</div>

	<?php if ( $showcustom || $showfeatures || $showcom ){ ?>

		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
					<i class="icon-tags <?php echo $pageiconcolour;?>"> </i>&nbsp;&nbsp;<span style="font-weight: bold; font-size: 120%;"><?php echo JText::_('EZREALTY_DETAILS_TAB2A');?></span>
				</a>
			</div>
			<div id="collapseTwo" class="accordion-body collapse">
				<div class="accordion-inner">
					<?php echo $this->loadTemplate('details'); ?> <!-- /.details output -->
				</div>
			</div>
		</div>

	<?php } ?>

	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
				<i class="icon-tags <?php echo $pageiconcolour;?>"> </i>&nbsp;&nbsp;<span style="font-weight: bold; font-size: 120%;"><?php echo JText::_('EZREALTY_TABS_DESCRIPTION');?></span>
			</a>
		</div>
		<div id="collapseThree" class="accordion-body collapse">
			<div class="accordion-inner">
				<?php echo $this->loadTemplate('description'); ?> <!-- /.property description output -->
			</div>
		</div>
	</div>

	<?php if ( $this->ezrealty->openhouse ){ ?>

		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
					<i class="icon-tags <?php echo $pageiconcolour;?>"> </i>&nbsp;&nbsp;<span style="font-weight: bold; font-size: 120%;"><?php echo JText::_('EZREALTY_OHOUSE');?></span>
				</a>
			</div>
			<div id="collapseFour" class="accordion-body collapse">
				<div class="accordion-inner">
					<?php echo $this->loadTemplate('openhouse'); ?> <!-- /.open house info output -->
				</div>
			</div>
		</div>

	<?php } ?>

	<?php if ( $this->ezrealty->type == 4 && $this->ezrealty->aucdate && $this->ezrealty->aucdate != '0000-00-00' ){ ?>

		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
					<i class="icon-tags <?php echo $pageiconcolour;?>"> </i>&nbsp;&nbsp;<span style="font-weight: bold; font-size: 120%;"><?php echo JText::_('EZREALTY_DETAILS_AUCTION');?></span>
				</a>
			</div>
			<div id="collapseFive" class="accordion-body collapse">
				<div class="accordion-inner">
					<?php echo $this->loadTemplate('auction'); ?> <!-- /.auction details output -->
				</div>
			</div>
		</div>

	<?php } ?>

</div>

<?php if (!$this->print){ ?>

	<?php echo $this->loadTemplate('files'); ?>

<?php } ?>
