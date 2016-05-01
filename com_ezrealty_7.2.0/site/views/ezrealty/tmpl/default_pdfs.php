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

<div class="ezitem-smlegend"><?php echo JText::_('EZREALTY_DOCUMENTS');?></div>

<div class="row-fluid">
	<div class="span12">
		<?php if ( $this->ezrealty->pdfinfo1 ) { ?>
			<a target="_blank" href="<?php echo JURI::root(); ?>images/ezrealty/pdfs/<?php echo $this->ezrealty->pdfinfo1;?>"><img src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/pdfs.png" border="0" alt="<?php echo JText::_('EZREALTY_PROFILE_DOWNLOAD_PROMO');?>" /></a>
		<?php } if ( $this->ezrealty->pdfinfo2 ) { ?>
			<a target="_blank" href="<?php echo JURI::root(); ?>images/ezrealty/pdfs/<?php echo $this->ezrealty->pdfinfo2;?>"><img src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/pdfs.png" border="0" alt="<?php echo JText::_('EZREALTY_PROFILE_DOWNLOAD_PROMO');?>" /></a>
		<?php } ?>
	</div>
</div>
