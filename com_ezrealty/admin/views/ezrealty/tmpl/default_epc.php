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
				<div class="control-label"><?php echo JText::_('EZREALTY_PROP_EPC');?><br />
					<?php echo JText::_('COM_EZREALTY_MAXFILE_SIZE');?><br />
					<?php echo $ezrparams->get( 'er_maxepcsize' );?> <?php echo JText::_('COM_EZREALTY_MAXKB');?>
				</div>
				<div class="controls">
					<?php echo EzRealtyUploadHelper::epcUpload($this->property->epc1,'1','epc1');?>
					<?php if ($this->property->epc1){ ?>
						&nbsp;&nbsp;<a class="btn btn-danger" href="index.php?option=com_ezrealty&controller=ezrealty&task=deleteepc&cid=<?php echo $this->property->id;?>&file=epc1"><i class="icon-trash icon-white"></i> <?php echo JText::_('EZREALTY_VLDET_DELETE');?></a>
					<?php } ?>
					<br />
					<br />
					<?php echo EzRealtyUploadHelper::epcUpload($this->property->epc2,'1','epc2');?>
					<?php if ($this->property->epc2){ ?>
						&nbsp;&nbsp;<a class="btn btn-danger" href="index.php?option=com_ezrealty&controller=ezrealty&task=deleteepc&cid=<?php echo $this->property->id;?>&file=epc2"><i class="icon-trash icon-white"></i> <?php echo JText::_('EZREALTY_VLDET_DELETE');?></a>
					<?php } ?>
				</div>
			</div>

		</div>
	</div>

