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

$itemid  = intval(JRequest::getVar( 'Itemid', ''));
$ezrparams = JComponentHelper::getParams ('com_ezrealty');

?>

	<div class="row-fluid">
		<div class="span12 toppad">

			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_PROP_PDF');?><br />
					<?php echo JText::_('COM_EZREALTY_MAXFILE_SIZE');?><br />
					<?php echo $ezrparams->get( 'er_maxpdfsize' );?> <?php echo JText::_('COM_EZREALTY_MAXKB');?>
				</div>
				<div class="controls">
					<?php echo EzRealtyUploadHelper::proppdfUpload($this->property->pdfinfo1,'1','pdfinfo1');?>
					<?php if ($this->property->pdfinfo1){ ?>
						&nbsp;&nbsp;<a class="btn btn-danger" href="index.php?option=com_ezrealty&controller=ezrealty&task=deletepdfinfo&cid=<?php echo $this->property->id;?>&file=pdfinfo1"><i class="icon-trash icon-white"></i> <?php echo JText::_('EZREALTY_VLDET_DELETE');?></a>
					<?php } ?>
					<br />
					<br />
					<?php echo EzRealtyUploadHelper::proppdfUpload($this->property->pdfinfo2,'1','pdfinfo2');?>
					<?php if ($this->property->pdfinfo2){ ?>
						&nbsp;&nbsp;<a class="btn btn-danger" href="index.php?option=com_ezrealty&controller=ezrealty&task=deletepdfinfo&cid=<?php echo $this->property->id;?>&file=pdfinfo2"><i class="icon-trash icon-white"></i> <?php echo JText::_('EZREALTY_VLDET_DELETE');?></a>
					<?php } ?>
				</div>
			</div>

		</div>
	</div>

