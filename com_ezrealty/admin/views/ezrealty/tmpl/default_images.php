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

$altimglink 	= 'index.php?option=com_ezrealty&controller=ezrealty&task=imageform&tmpl=component&id='. $this->property->id;

?>


<fieldset class="adminform">
	<legend><?php echo JText::_( 'EZREALTY_DETAILS_TAB4A' ); ?></legend>	

<?php if ( $this->ezrparams->get( 'er_altimgupload' ) ) { ?>
	<a class="modal" href="<?php echo $altimglink;?>" rel="{handler:'iframe',size:{x:800,y:600}}" title="<?php echo JText::_('COM_EZREALTY_CONFIG_ALTIMGUPLOAD_FORM');?>">
		<span class="badge badge-success hasTooltip" title="<?php echo JText::_('COM_EZREALTY_CONFIG_ALTIMGUPLOAD_FORM');?>"><strong><?php echo JText::_('COM_EZREALTY_CONFIG_ALTIMGUPLOAD_FORM');?></strong></span>
	</a>
		<br />
		<br />
<?php } ?>

				<table class="table table-striped table-bordered" id="imagesListing">
					<tr>
						<td width="100px" align="center"><strong><?php echo JText::_('EZREALTY_VLDET_CURRENTIMG');?></strong></td>
						<td align="center"><strong><?php echo JText::_('COM_EZREALTY_TITLE');?></strong></td>
						<td align="center"><strong><?php echo JText::_('COM_EZREALTY_DESCRIPTION');?></strong></td>
						<td align="center"><strong><?php echo JText::_('EZREALTY_REORDER_IMAGES');?></strong></td>
						<td align="center"><strong><?php echo JText::_('EZREALTY_VLDET_DELETEIMG');?></strong></td>
					</tr>

					<?php for($i=0; $i < count($this->property->images); $i++){
					$image = $this->property->images[$i];
					$imageName = JText::_('Image').$i;

					if ($image->path) {
						$imagelocation = $image->path;
					} else {
						$imagelocation = JURI::root()."images/ezrealty/properties";
					}

					?>
					<tr>
						<td width="100px" valign="middle" align="center" style="padding:5px;">
							<?php if($image->fname){?>
								<a class="modal" href="<?php echo $imagelocation;?>/<?php echo $image->fname;?>" title="<?php echo JText::_('EZREALTY_VLDET_TNPREV');?>">
							<?php } ?>

							<?php if ($image->path){ ?>
								<img src="<?php echo $imagelocation;?>/<?php echo $image->fname;?>" width="100px" alt="" />
							<?php } else { ?>
								<img src="<?php echo JURI::root(); ?>images/ezrealty/properties/th/<?php echo $image->fname;?>" width="100px" alt="" />
							<?php } ?>

							<?php if($image->fname){?>
								</a>
							<?php } ?>
						</td>

						<td>
							<input class="input-medium" type="text" name="titleListing" id="titleListing" maxlength="70" onchange="updateImageTitle(<?php echo intval($image->id)?>, this);" value="<?php echo stripslashes($image->title);?>" />
						</td>
						<td><textarea class="input-medium" rows="2" name="descriptionListing" id="descriptionListing" onchange="updateImageDescription(<?php echo intval($image->id)?>, this);"><?php echo $image->description ;?></textarea></td>
						<td align="center" valign="middle">

							<span><a class="btn btn-micro " href="javascript:void(0);" onclick="orderup(<?php echo intval($image->id);?>, this);" title="Move up"><i class="icon-uparrow"></i></a></span>
							<span><a class="btn btn-micro " href="javascript:void(0);" onclick="orderdown(<?php echo intval($image->id);?>, this);" title="Move down"><i class="icon-downarrow"></i></a></span>
							<input type="text" name="order[]" size="5" value="<?php echo $i+1;?>"  class="input-mini" style="text-align: center" readonly />

						</td>
						<td align="center" valign="middle">

							<button type="button" class="btn btn-danger delete btn-large" onclick="deleteImageListing(<?php echo intval($image->id)?>, '<?php echo $image->fname ?>',this)">
								<i class="icon-trash icon-white"></i>
								<span><?php echo JText::_('EZREALTY_VLDET_DELETE')?></span>
							</button>

						</td>
					</tr>
					<?php } ?>

				</table>	

			<p>&nbsp;</p>

			<div id="swfupload-control">
				<p>Upload upto <?php echo intval($ezrparams->get( 'max_images') - count($this->property->images))?> image files(jpg, png, gif), each having maximum size of 5MB</p>

				<input type="button" id="button" />

				<p id="queuestatus" ></p>
				<ol id="log"></ol>	
			</div>
</fieldset>

<div class="clr"></div>
