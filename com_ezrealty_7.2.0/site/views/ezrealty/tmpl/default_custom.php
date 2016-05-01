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

if ( $this->ezrealty->ctown || $this->ezrealty->ctport || $this->ezrealty->custom1 || $this->ezrealty->custom2 || $this->ezrealty->custom3 || $this->ezrealty->custom4 || $this->ezrealty->custom5 || $this->ezrealty->custom6 || $this->ezrealty->custom7 || $this->ezrealty->custom8 ){ ?>

	<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_TABDETS_ADDITIONALDETS');?></div>

	<?php if ( $this->ezrealty->ctown ) { ?>
		<div class="row-fluid">
			<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_CTOWN');?>: <?php echo stripslashes($this->ezrealty->ctown);?></div>
		</div>
	<?php } if ( $this->ezrealty->ctport ) { ?>
		<div class="row-fluid">
			<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_CTPORT');?>: <?php echo stripslashes($this->ezrealty->ctport);?></div>
		</div>
	<?php } if ( $this->ezrealty->custom1 ) { ?>
		<div class="row-fluid">
			<div class="span12"><?php echo JText::_('EZREALTY_CONFIG_CPI1');?>: <?php echo stripslashes($this->ezrealty->custom1);?></div>
		</div>
	<?php } if ( $this->ezrealty->custom2 ) { ?>
		<div class="row-fluid">
			<div class="span12"><?php echo JText::_('EZREALTY_CONFIG_CPI2');?>: <?php echo stripslashes($this->ezrealty->custom2);?></div>
		</div>
	<?php } if ( $this->ezrealty->custom3 ) { ?>
		<div class="row-fluid">
			<div class="span12"><?php echo JText::_('EZREALTY_CONFIG_CPI3');?>: <?php echo stripslashes($this->ezrealty->custom3);?></div>
		</div>
	<?php } if ( $this->ezrealty->custom4 ) { ?>
		<div class="row-fluid">
			<div class="span12"><?php echo JText::_('EZREALTY_CUSTOM4');?>: <?php echo stripslashes($this->ezrealty->custom4);?></div>
		</div>
	<?php } if ( $this->ezrealty->custom5 ) { ?>
		<div class="row-fluid">
			<div class="span12"><?php echo JText::_('EZREALTY_CUSTOM5');?>: <?php echo stripslashes($this->ezrealty->custom5);?></div>
		</div>
	<?php } if ( $this->ezrealty->custom6 ) { ?>
		<div class="row-fluid">
			<div class="span12"><?php echo JText::_('EZREALTY_CUSTOM6');?>: <?php echo stripslashes($this->ezrealty->custom6);?></div>
		</div>
	<?php } if ( $this->ezrealty->custom7 ) { ?>
		<div class="row-fluid">
			<div class="span12"><?php echo JText::_('EZREALTY_CUSTOM7');?>: <?php echo stripslashes($this->ezrealty->custom7);?></div>
		</div>
	<?php } if ( $this->ezrealty->custom8 ) { ?>
		<div class="row-fluid">
			<div class="span12"><?php echo JText::_('EZREALTY_CUSTOM8');?>: <?php echo stripslashes($this->ezrealty->custom8);?></div>
		</div>
	<?php }

} ?>
