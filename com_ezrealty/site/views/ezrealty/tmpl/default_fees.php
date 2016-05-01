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

<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_DETAILS_FEES');?></div>

<?php if ( $this->ezrealty->hofees && $this->ezrealty->hofees != '0.00' ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_LISTINGS_HOFEES');?>: <?php echo stripslashes($this->ezrealty->hofees);?></div>
	</div>
<?php } if ( $this->ezrealty->AnnualInsurance && $this->ezrealty->AnnualInsurance != '0.00' ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_ANNINSURANCE');?>: <?php echo stripslashes($this->ezrealty->AnnualInsurance);?></div>
	</div>
<?php } if ( $this->ezrealty->TaxAnnual && $this->ezrealty->TaxAnnual != '0.00' ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_TAXAN');?>: <?php echo stripslashes($this->ezrealty->TaxAnnual);?></div>
	</div>
<?php } if ( $this->ezrealty->TaxYear ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_TAXYEAR');?>: <?php echo stripslashes($this->ezrealty->TaxYear);?></div>
	</div>
<?php } ?>
