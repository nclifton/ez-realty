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

JHtml::_('behavior.modal');

$shortlist = JURI::root() . 'index.php?tmpl=component&amp;option=com_ezrealty&amp;task=addshortlist&amp;id='. $this->ezrealty->id;
$status = 'status=no,toolbar=no,scrollbars=no,titlebar=no,menubar=no,resizable=yes,width=300,height=200,directories=no,location=no';

?>

<div align="right">
	<?php if ( $this->params->def( 'use_print' ) ) { ?>
			<?php echo JHtml::_('icon.print_popup',  $this->ezrealty, $this->params); ?> 
	<?php } ?>

	<?php if ( $this->params->def( 'use_print' ) ) { ?>
			<?php echo JHtml::_('icon.pdf',  $this->ezrealty, $this->params); ?> 
	<?php } if ( $this->params->def( 'er_viewrecommend' ) ) { ?>
			<?php echo JHtml::_('icon.email',  $this->ezrealty, $this->params); ?> 
	<?php } if ( $this->params->def( 'er_shortlisting' ) ) { ?>

		<?php if ( $this->params->get( 'popup_linktype' ) ) { ?>
			<a href="javascript:void(0)" onclick="window.open('<?php echo $shortlist; ?>','win2','<?php echo $status; ?>');" title="<?php echo JText::_('EZREALTY_LISTINGS_ADDLIGHTBOX');?>"><img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/savefavs.png" border="0" height="16" alt="<?php echo JText::_('EZREALTY_LISTINGS_ADDLIGHTBOX');?>" /></a>
		<?php } else { ?>
			<a href="<?php echo $shortlist;?>" class="modal" rel="{handler:'iframe',size:{x:300,y:200}}" title="<?php echo JText::_('EZREALTY_LISTINGS_ADDLIGHTBOX');?>"><img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/savefavs.png" border="0" height="16" alt="<?php echo JText::_('EZREALTY_LISTINGS_ADDLIGHTBOX');?>" /></a>
		<?php } ?>

	<?php } ?>
</div>