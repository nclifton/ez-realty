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

<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_TABDETS_BUSINESS');?></div>

<?php if ( $this->ezrealty->takings ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_TAKINGS');?>: <?php echo stripslashes($this->ezrealty->takings);?></div>
	</div>
<?php } if ( $this->ezrealty->returns ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_RETURNS');?>: <?php echo stripslashes($this->ezrealty->returns);?></div>
	</div>
<?php } if ( $this->ezrealty->netprofit ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_NETPROFIT');?>: <?php echo stripslashes($this->ezrealty->netprofit);?></div>
	</div>
<?php } if ( $this->ezrealty->bustype ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_BUSTYPE');?>: <?php echo stripslashes($this->ezrealty->bustype);?></div>
	</div>
<?php } if ( $this->ezrealty->bussubtype ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_BUSSUBTYPE');?>: <?php echo stripslashes($this->ezrealty->bussubtype);?></div>
	</div>
<?php } if ( $this->ezrealty->stock ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_STOCK');?>: <?php echo stripslashes($this->ezrealty->stock);?></div>
	</div>
<?php } if ( $this->ezrealty->fixtures ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_FIXTURES');?>: <?php echo stripslashes($this->ezrealty->fixtures);?></div>
	</div>
<?php } if ( $this->ezrealty->fittings ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_FITTINGS');?>: <?php echo stripslashes($this->ezrealty->fittings);?></div>
	</div>
<?php } if ( $this->ezrealty->percentoffice ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_POFFICE');?>: <?php echo stripslashes($this->ezrealty->percentoffice);?></div>
	</div>
<?php } if ( $this->ezrealty->percentwarehouse ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_PWAREHOUSE');?>: <?php echo stripslashes($this->ezrealty->percentwarehouse);?></div>
	</div>
<?php } if ( $this->ezrealty->loadingfac ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_LOADING');?>: <?php echo stripslashes($this->ezrealty->loadingfac);?></div>
	</div>
<?php } ?>
