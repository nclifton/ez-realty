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

JHtml::_('behavior.modal');

?>

<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_VIEWDET_TOUR');?></div>

	<div class="row-fluid">
		<div class="span12">

			<?php if ( $this->params->def( 'er_useflv')==1 && $this->ezrealty->mediaUrl && $this->ezrealty->mediaUrl != 'http://' && $this->ezrealty->mediaType==2 ) {

				$video = preg_replace(array('/youtu.be/'), array('youtube.com/embed'), $this->ezrealty->mediaUrl);
				$vidstatus = 'status=no,toolbar=no,scrollbars=no,titlebar=no,menubar=no,resizable=yes,width=480,height=385,directories=no,location=no';

				$width="480";
				$height="385";

				?>

				<?php if ( $this->params->get( 'popup_linktype' ) ) { ?>
					<a href="javascript:void(0)" onclick="window.open('<?php echo $video; ?>','win2','<?php echo $vidstatus; ?>');"><img src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/tours.png" border="0" alt="<?php echo JText::_('EZREALTY_VIEWDET_VTOUR');?>" /></a>
				<?php } else { ?>
					<a class="modal" href="<?php echo $video;?>" rel="{handler: 'iframe', size: {x:<?php echo $this->escape($width);?>, y:<?php echo $this->escape($height);?>}}"><img src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/tours.png" border="0" alt="<?php echo JText::_('EZREALTY_VIEWDET_VTOUR');?>" /></a>
				<?php } ?>

			<?php } if ( $this->params->def( 'er_useflv')==1 && $this->ezrealty->mediaUrl && $this->ezrealty->mediaUrl != 'http://' && $this->ezrealty->mediaType==1 ) { ?>

				<a target="_blank" href="<?php echo $this->ezrealty->mediaUrl;?>"><img src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/tours.png" border="0" alt="<?php echo JText::_('EZREALTY_VIEWDET_VTOUR');?>" /></a>

			<?php } ?>

		</div>
	</div>
