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

?>

	<div class="row-fluid">
		<div class="span12">
			<br />
			<?php echo $this->loadTemplate('overview'); ?> <!-- /.overview output -->
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<?php echo $this->loadTemplate('details'); ?> <!-- /.details output -->
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_TABS_DESCRIPTION');?></div>
			<?php echo $this->loadTemplate('description'); ?> <!-- /.property description output -->
		</div>
	</div>
<?php if ( $this->ezrealty->openhouse ){ ?>
	<div class="row-fluid">
		<div class="span12">
			<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_OHOUSE');?></div>
			<?php echo $this->loadTemplate('openhouse'); ?> <!-- /.open house info output -->
		</div>
	</div>
<?php } ?>
<?php if ( $this->ezrealty->type == 4 && $this->ezrealty->aucdate && $this->ezrealty->aucdate != '0000-00-00' ){ ?>
	<div class="row-fluid">
		<div class="span12">
			<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_DETAILS_AUCTION');?></div>
			<?php echo $this->loadTemplate('auction'); ?> <!-- /.auction details output -->
		</div>
	</div>
<?php } ?>
