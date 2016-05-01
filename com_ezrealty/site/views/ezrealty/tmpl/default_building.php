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

<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_DETAILS_BUILDINGINFO');?></div>

<?php if ( $this->ezrealty->year ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_YEAR_BUILT');?>: <?php echo stripslashes($this->ezrealty->year);?></div>
	</div>
<?php } if ( $this->ezrealty->yearRemodeled ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_YEAR_REMODELED');?>: <?php echo stripslashes($this->ezrealty->yearRemodeled);?></div>
	</div>
<?php } if ( $this->ezrealty->houseStyle ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_HOUSESTYLE');?>: <?php echo stripslashes($this->ezrealty->houseStyle);?></div>
	</div>
<?php } if ( $this->ezrealty->houseConstruction ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_HOUSECONST');?>: <?php echo stripslashes($this->ezrealty->houseConstruction);?></div>
	</div>
<?php } if ( $this->ezrealty->exteriorFinish ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_EXTFINISH');?>: <?php echo stripslashes($this->ezrealty->exteriorFinish);?></div>
	</div>
<?php } if ( $this->ezrealty->roof ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_ROOF');?>: <?php echo stripslashes($this->ezrealty->roof);?></div>
	</div>
<?php } if ( $this->ezrealty->flooring ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_FLOORING');?>: <?php echo stripslashes($this->ezrealty->flooring);?></div>
	</div>
<?php } if ( $this->ezrealty->porchPatio ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_PORCHPATIO');?>: <?php echo stripslashes($this->ezrealty->porchPatio);?></div>
	</div>
<?php } if ( $this->ezrealty->stories ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_FLOORS');?>: <?php echo stripslashes($this->ezrealty->stories);?></div>
	</div>
<?php } if ( $this->ezrealty->SqFtLower ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_SQFTLOWER');?>: <?php echo stripslashes($this->ezrealty->SqFtLower);?></div>
	</div>
<?php } if ( $this->ezrealty->SqFtMainLevel ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_SQFTMAIN');?>: <?php echo stripslashes($this->ezrealty->SqFtMainLevel);?></div>
	</div>
<?php } if ( $this->ezrealty->SqFtUpper ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_SQFTUPPER');?>: <?php echo stripslashes($this->ezrealty->SqFtUpper);?></div>
	</div>
<?php } if ( $this->ezrealty->squarefeet ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_SQUARES');?>: <?php echo EZRealtyFHelper::convertArea ($this->ezrealty->squarefeet);?> </div>
	</div>
<?php } ?>
