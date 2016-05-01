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

<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_DETAILS_BANDF_TITLE');?></div>

<?php if ( $this->ezrealty->BasementAndFoundation ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('COM_EZREALTY_LISTINGS_BANDF');?>: <?php echo stripslashes($this->ezrealty->BasementAndFoundation);?></div>
	</div>
<?php } if ( $this->ezrealty->BasementSize ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('COM_EZREALTY_LISTINGS_BSIZE');?>: <?php echo stripslashes($this->ezrealty->BasementSize);?> 
		(
		<?php if ($this->params->get( 'er_areaunit') == '1') {
			echo JText::_('EZREALTY_SEARCH_METERS');
		} else if ($this->params->get( 'er_areaunit') == '2') {
			echo JText::_('EZREALTY_SEARCH_SQFEET');
		} else if ($this->params->get( 'er_areaunit') == '3') {
			echo JText::_('EZREALTY_SEARCH_YARDS');
		} else if ($this->params->get( 'er_areaunit') == '4') {
			echo JText::_('EZREALTY_SEARCH_SQUARES');
		} else {
			echo JText::_('EZREALTY_SEARCH_METERS');
		}
		?>
		)
		</div>
	</div>
<?php } if ( $this->ezrealty->BasementPctFinished ) { ?>
	<div class="row-fluid">
		<div class="span12"><?php echo JText::_('COM_EZREALTY_LISTINGS_PCTFINISHED');?>: <?php echo stripslashes($this->ezrealty->BasementPctFinished);?></div>
	</div>
<?php } ?>
