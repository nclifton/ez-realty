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

<div class="row-fluid">

	<div class="span12">
		<legend><?php echo JText::_('EZREALTY_PROFILE_IMAGE');?></legend>

	<div class="control-group">
		<div class="control-label">
			<?php echo JText::_('COM_EZREALTY_MAXIMG_SIZE'); ?>:<br /><?php echo $this->params->get( 'er_maxprofimgsize').' (KB)';?>
		</div>
		<div class="controls">

			<?php EzRealtyUploadHelper::profileUpload($this->profile->seller_image,'1','seller_image');?>
			<?php if ($this->profile->seller_image){ ?>
			&nbsp;&nbsp;<a class="btn btn-danger" href="index.php?option=com_ezrealty&controller=agents&task=deleteavatar&cid=<?php echo $this->profile->id;?>"><i class="icon-trash icon-white"></i> <?php echo JText::_('EZREALTY_VLDET_DELETE'); ?></a>
			<?php } ?>

		</div>
	</div>

	</div>

</div>

