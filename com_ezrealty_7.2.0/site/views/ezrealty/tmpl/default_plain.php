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

<div class="row-fluid">

	<?php if ( $this->ezrealty->openhouse || $this->ezrealty->type == 4 && $this->ezrealty->aucdate && $this->ezrealty->aucdate != '0000-00-00' ){ ?>
		<div class="span8 category-left-centered">
	<?php } else { ?>
		<div class="span12">
	<?php } ?>

		<?php echo $this->loadTemplate('description'); ?> <!-- /.property description output -->

		<?php if (!$this->print){ ?>
			<?php echo $this->loadTemplate('files'); ?>
		<?php } ?>

	</div>

	<?php if ( $this->ezrealty->openhouse || $this->ezrealty->type == 4 && $this->ezrealty->aucdate && $this->ezrealty->aucdate != '0000-00-00' ){ ?>

		<div class="span4">

			<?php if ( $this->ezrealty->openhouse ){ ?>
				<?php echo $this->loadTemplate('openhouse'); ?> <!-- /.open house info output -->
			<?php } ?>
			<?php if ( $this->ezrealty->type == 4 && $this->ezrealty->aucdate && $this->ezrealty->aucdate != '0000-00-00' ){ ?>
				<?php echo $this->loadTemplate('auction'); ?> <!-- /.auction details output -->
			<?php } ?>

		</div>

	<?php } ?>

</div>

<div class="row-fluid">
	<div class="span12">
		<br />
		<?php echo $this->loadTemplate('overview'); ?> <!-- /.overview output -->

		<?php if ( $showcustom || $showfeatures || $showcom ){ ?>
			<?php echo $this->loadTemplate('details'); ?> <!-- /.details output -->
		<?php } ?>

	</div>
</div>

