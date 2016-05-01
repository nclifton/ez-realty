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

$ezrparams = JComponentHelper::getParams ('com_ezrealty');

?>

	<div class="row-fluid">
		<div class="span12 toppad">

			<div class="control-group">
				<div class="control-label">
					<?php echo JText::_( 'EZREALTY_PANORAMA_TITLE' );?><br />
					<?php echo JText::_('COM_EZREALTY_MAXFILE_SIZE');?><br />
					<?php echo $ezrparams->get( 'er_maxpanoimgsize' );?> <?php echo JText::_('COM_EZREALTY_MAXKB');?>
				</div>
				<div class="controls">
					<?php echo EzRealtyUploadHelper::panoramaUpload($this->property->panorama,'1','panorama');?>
					<?php if ($this->property->panorama){ ?>
					&nbsp;&nbsp;<a class="btn btn-danger" href="index.php?option=com_ezrealty&controller=ezrealty&task=deletepanorama&cid=<?php echo $this->property->id;?>"><i class="icon-trash icon-white"></i> <?php echo JText::_('EZREALTY_VLDET_DELETE');?></a>
					<?php } ?>
				</div>
			</div>

		</div>
	</div>

