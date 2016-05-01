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


	<ul id="ezrTab" class="nav nav-tabs">

		<li class="active"><a href="#summary" data-toggle="tab"><?php echo JText::_('EZREALTY_INFO_KEY_DETAILS');?></a></li>

		<?php if ( $showcustom || $showfeatures || $showcom ){ ?>
			<li><a href="#features" data-toggle="tab"><?php echo JText::_('EZREALTY_DETAILS_TAB2A');?></a></li>
		<?php } ?>

		<li><a href="#description" data-toggle="tab"><?php echo JText::_('EZREALTY_TABS_DESCRIPTION');?></a></li>
		<?php if ( $this->ezrealty->openhouse ){ ?>
			<li><a href="#ohouse" data-toggle="tab"><?php echo JText::_('EZREALTY_OHOUSE');?></a></li>
		<?php } ?>
		<?php if ( $this->ezrealty->type == 4 && $this->ezrealty->aucdate && $this->ezrealty->aucdate != '0000-00-00' ){ ?>
			<li><a href="#auction" data-toggle="tab"><?php echo JText::_('EZREALTY_DETAILS_AUCTION');?></a></li>
		<?php } ?>

	</ul>

	<div id="ezrTabContent" class="tab-content"><!-- /.start content div -->

		<div class="tab-pane fade in active" id="summary">
			<?php echo $this->loadTemplate('overview'); ?> <!-- /.overview output -->
		</div>

		<?php if ( $showcustom || $showfeatures || $showcom ){ ?>
			<div class="tab-pane fade" id="features">
				<?php echo $this->loadTemplate('details'); ?> <!-- /.details output -->
			</div>
		<?php } ?>

		<div class="tab-pane fade" id="description">
			<?php echo $this->loadTemplate('description'); ?> <!-- /.property description output -->
		</div>
		<?php if ( $this->ezrealty->openhouse ){ ?>
			<div class="tab-pane fade" id="ohouse">
				<?php echo $this->loadTemplate('openhouse'); ?> <!-- /.open house info output -->
			</div>
		<?php } ?>
		<?php if ( $this->ezrealty->type == 4 && $this->ezrealty->aucdate && $this->ezrealty->aucdate != '0000-00-00' ){ ?>
			<div class="tab-pane fade" id="auction">
				<?php echo $this->loadTemplate('auction'); ?> <!-- /.auction details output -->
			</div>
		<?php } ?>

	</div><!-- /.end content div -->


<?php if (!$this->print){ ?>

	<?php echo $this->loadTemplate('files'); ?>

<?php } ?>


<script type="text/javascript">
	jQuery.noConflict();

	jQuery('#ezrTab a').click(function (e) {
		e.preventDefault();
		jQuery(this).tab('show');
	})

</script>
