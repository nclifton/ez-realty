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

<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_TABDETS_SCHOOLSANDED');?></div>

<?php if ( $this->ezrealty->schooldist ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_LISTINGS_SCHOOLDIST');?>: <?php echo stripslashes($this->ezrealty->schooldist);?></div>
	</div>
<?php } if ( $this->ezrealty->preschool ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_LISTINGS_PRESCHOOL');?>: <?php echo stripslashes($this->ezrealty->preschool);?></div>
	</div>
<?php } if ( $this->ezrealty->primaryschool ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_LISTINGS_PRIMARYSCHOOL');?>: <?php echo stripslashes($this->ezrealty->primaryschool);?></div>
	</div>
<?php } if ( $this->ezrealty->highschool ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_LISTINGS_HIGHSCHOOL');?>: <?php echo stripslashes($this->ezrealty->highschool);?></div>
	</div>
<?php } if ( $this->ezrealty->university ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_LISTINGS_UNIVERSITY');?>: <?php echo stripslashes($this->ezrealty->university);?></div>
	</div>
<?php } ?>
