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

<?php if ( ($this->ezrealty->appliances || $this->ezrealty->indoorfeatures || $this->ezrealty->outdoorfeatures || $this->ezrealty->buildingfeatures || $this->ezrealty->communityfeatures || $this->ezrealty->otherfeatures) && ($this->ezrealty->ctown || $this->ezrealty->ctport || $this->ezrealty->custom1 || $this->ezrealty->custom2 || $this->ezrealty->custom3 || $this->ezrealty->custom4 || $this->ezrealty->custom5 || $this->ezrealty->custom6 || $this->ezrealty->custom7 || $this->ezrealty->custom8) ){ ?>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $this->loadTemplate('features'); ?>
		</div>
		<div class="span6">
			<?php echo $this->loadTemplate('custom'); ?>
		</div>
	</div>

<?php } else { ?>

	<?php if ( ($this->ezrealty->appliances || $this->ezrealty->indoorfeatures || $this->ezrealty->outdoorfeatures || $this->ezrealty->buildingfeatures || $this->ezrealty->communityfeatures || $this->ezrealty->otherfeatures) && (!$this->ezrealty->ctown && !$this->ezrealty->ctport && !$this->ezrealty->custom1 && !$this->ezrealty->custom2 && !$this->ezrealty->custom3 && !$this->ezrealty->custom4 && !$this->ezrealty->custom5 && !$this->ezrealty->custom6 && !$this->ezrealty->custom7 && !$this->ezrealty->custom8) ){ ?>

		<div class="row-fluid">
			<div class="span12">
				<?php echo $this->loadTemplate('features'); ?>
			</div>
		</div>

	<?php } else { ?>

		<div class="row-fluid">
			<div class="span12">
				<?php echo $this->loadTemplate('custom'); ?>
			</div>
		</div>

	<?php } ?>

<?php } ?>

