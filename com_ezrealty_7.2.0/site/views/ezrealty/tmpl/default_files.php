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

if ( $this->params->get( 'er_layout' ) == 2 ){
	$whichspan = "6";
} else {
	$whichspan = "3";
}


?>

<div class="row-fluid">
	<?php if ( $this->ezrealty->epc1 || $this->ezrealty->epc2 ) { ?>
		<div class="span<?php echo $whichspan;?>">
			<?php echo $this->loadTemplate('epc'); ?>
		</div>
	<?php } ?>
	<?php if ( $this->ezrealty->flpl1 || $this->ezrealty->flpl2 ) { ?>
		<div class="span<?php echo $whichspan;?>">
			<?php echo $this->loadTemplate('floorplans'); ?>
		</div>
	<?php } ?>

<?php if ( $this->params->get( 'er_layout' ) == 2 ){ ?>
	</div>
	<div class="row-fluid">
<?php } ?>

	<?php if ( $this->ezrealty->pdfinfo1 || $this->ezrealty->pdfinfo2 ) { ?>
		<div class="span<?php echo $whichspan;?>">
			<?php echo $this->loadTemplate('pdfs'); ?>
		</div>
	<?php } ?>
	<?php if ( $this->params->def( 'er_useflv')==1 && $this->ezrealty->mediaUrl && $this->ezrealty->mediaUrl != 'http://' && $this->ezrealty->mediaType==2 || $this->params->def( 'er_useflv')==1 && $this->ezrealty->mediaUrl && $this->ezrealty->mediaUrl != 'http://' && $this->ezrealty->mediaType==1 ) { ?>
		<div class="span<?php echo $whichspan;?>">
			<?php echo $this->loadTemplate('video'); ?>
		</div>
	<?php } ?>
</div>
<br />
<br />
