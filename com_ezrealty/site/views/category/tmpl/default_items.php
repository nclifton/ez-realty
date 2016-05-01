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
$status = 'status=no,toolbar=no,scrollbars=no,titlebar=no,menubar=no,resizable=yes,width=300,height=200,directories=no,location=no';

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_ezrealty/tables');

$Itemid  = intval(JRequest::getVar( 'Itemid', ''));

if (!$this->params->get('butcolour')){
	$btncolour = "btn";
} else {
	$btncolour = $this->params->get('butcolour');
}

if (!$this->params->get('butsize')){
	$btnsize = "";
} else {
	$btnsize = $this->params->get('butsize');
}

if (!$this->params->get('icon_colour')){
	$iconcolour = "icon-black";
} else {
	$iconcolour = "icon-white";
}

if (!$this->params->get('page_iconcolour')){
	$pageiconcolour = "ezicon-black";
} else {
	$pageiconcolour = "ezicon-white";
}

if (!$this->params->get('standard_thumb')){
	$standard_thumb = "span3";
} else {
	$standard_thumb = $this->params->get('standard_thumb');
}

if (!$this->params->get('feat_thumb')){
	$feat_thumb = "span4";
} else {
	$feat_thumb = $this->params->get('feat_thumb');
}

$getnow = date("Y-m-d");

foreach ($this->items as $item) {

    $shortlist = JURI::root() . 'index.php?tmpl=component&amp;option=com_ezrealty&amp;task=addshortlist&amp;id='. $item->id.'&amp;Itemid='. $Itemid;

	$loc =& JTable::getInstance('localities', 'Table');
	$loc->load($item->locid);

?>

<div class="row-fluid ezitem-separator">
	<div class="span12">

		<div class="row-fluid">

			<?php if ($item->featured == 2){ ?>

				<div class="span<?php echo $feat_thumb;?>">
					<div id="ezitem-watermark_box" class="thumbnail">
						<div id="ezimagefade">
							<div class="ezimage-wrap">
						<a href="<?php echo $item->link; ?>">
							<?php if(!EZRealtyFHelper::getTheImage($item->id) ){ ?>
								<img class="span12 thumbnail" src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/noimage.png" alt="<?php echo $item->adline;?>" />
							<?php } else { ?>
								<?php echo EZRealtyFHelper::featuredImage ($item->id, $item->soleAgency, $item->sold, $item->adline, $item->featured, $item->type); ?>
							<?php } ?>
						</a>
							</div>
							<?php echo EZRealtyFHelper::theWatermark ($item->id, $item->soleAgency, $item->sold, $item->adline, $item->featured, $item->type); ?>
						</div>
					</div>
				</div>

			<?php } else { ?>

				<div class="span<?php echo $standard_thumb;?>">
					<div id="ezitem-watermark_box" class="thumbnail">
						<div id="ezimagefade">
							<div class="ezimage-wrap">
						<a href="<?php echo $item->link; ?>">
							<?php if(!EZRealtyFHelper::getTheImage($item->id) ){ ?>
								<img class="span12 thumbnail" src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/noimage.png" alt="<?php echo $item->adline;?>" />
							<?php } else { ?>
								<?php echo EZRealtyFHelper::convertImage ($item->id, $item->soleAgency, $item->sold, $item->adline, $item->featured, $item->type, 0); ?>
							<?php } ?>
						</a>
							</div>
							<?php echo EZRealtyFHelper::smallWatermark ($item->id, $item->soleAgency, $item->sold, $item->adline, $item->featured, $item->type, 0); ?>
						</div>
					</div>
				</div>

			<?php } ?>

			<?php if ($item->featured == 2){ ?>
				<div class="<?php echo EZRealtyFHelper::convertBst ($this->params->get('feat_thumb')); ?>">
			<?php } else { ?>
				<div class="<?php echo EZRealtyFHelper::convertBst ($this->params->get('standard_thumb')); ?>">
			<?php } ?>

				<div class="row-fluid ezitem-toppad">
					<div class="span12">

						<?php if ( $this->params->def( 'use_realtybookings' ) && $item->viewbooking == '1' ) { ?>
							<span class="ez-buttons">
			
								<?php if ( $this->params->get( 'popup_linktype' ) ) { ?>
	
									<div class="row-fluid">
										<div class="span12"><?php echo JHtml::_('icon.cal',  $item, $this->params); ?></div>
									</div>
								<?php } else {
				
									$template = JFactory::getApplication()->getTemplate();
									$calendar = JURI::root() . 'index.php?tmpl=component&option=com_realtybookings&view=realtybooking&amp;id='. $item->slug.'&source=1&tmpl=component&template='.$template;
									?>
									<div class="row-fluid">
										<div class="span12">
											<a href="<?php echo $calendar;?>" class="modal" rel="{handler:'iframe',size:{x:420,y:370}}">
												<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/calendar.png" border="0" style="height: 40px;" alt="" />
											</a>
										</div>
									</div>
								<?php } ?>
	
							</span>
						<?php } ?>

						<span class="ezitem-propertyprice <?php echo $this->params->get( 'titlecolor' );?>">

							<?php if ( $this->params->get( 'er_hideprice') || $this->params->get( 'er_hideprice')==0 && $this->user->id ) {
								echo EZRealtyFHelper::formatDisplayPrice ($item->showprice, $item->price, $item->currency_format, $item->currency, $item->currency_position, $item->priceview, $item->freq);
							} else {
								echo "(".JText::_('EZREALTY_CONFIG_HIDEPRICE_MSG').")";
							} ?>

						</span>
						<span>

							<?php if ($this->params->get( 'use_jrev' ) && file_exists("components/com_jreviews/jreviews/models/everywhere/everywhere_com_ezrealty.php")){
								echo EZRealtyFHelper::convertJreviews ($item->id, '1');
							} ?>
						
						</span>
					</div>
				</div>

				<div class="row-fluid ezitem-toppad">
					<div class="span12">
						<span class="ezitem-propertytitle">

							<?php echo EZRealtyFHelper::convertTitle ($item->type, $loc->ezcity, $item->adline); ?>

						</span>
					</div>
				</div>

				<?php if ( $this->params->get( 'show_icons' ) ) {
					if ($item->bedrooms != 0 || $item->bathrooms > 0 || $item->parkingGarage || $item->squarefeet || $item->LandAreaSqFt){ ?>
						<div class="row-fluid ezitem-toppad">
							<div class="span12">
								<?php if ( $this->params->get( 'show_icons' ) == 1 ) {
									echo EZRealtyFHelper::convertHicons ($item->bedrooms, $item->bathrooms, $item->parkingGarage, $item->squarefeet, $item->LandAreaSqFt);
								} else {
									echo EZRealtyFHelper::textIcons ($item->bedrooms, $item->bathrooms, $item->parkingGarage, $item->squarefeet, $item->LandAreaSqFt);
								} ?>
							</div>
						</div>
					<?php }
				} ?>

				<?php if ( $this->params->get( 'show_openhousedate' ) ) {
					if ($item->ohdate >= $getnow && $item->ohdate != '0000-00-00' && $item->ohdate && $item->ohstarttime != '00:00:00' || $item->ohdate2 >= $getnow && $item->ohdate2 != '0000-00-00' && $item->ohdate && $item->ohstarttime2 != '00:00:00' ) { ?>
						<div class="row-fluid ezitem-toppad">
							<div class="span12">
								<?php if ($item->ohdate >= $getnow && $item->ohdate != '0000-00-00' && $item->ohdate && $item->ohdate != '00:00:00' ) { ?>
									<?php if ($item->ohdate && $item->ohdate >= $getnow){ ?><i class="ezicon-calendar <?php echo $pageiconcolour;?>"></i> <span class="events"><?php echo JText::_('COM_EZREALTY_LISTINGS_OPENHOUSE');?> <?php echo EZRealtyFHelper::convertDate ($item->ohdate);?></span><?php } ?>: 
									<?php if ($item->ohstarttime){?><span class="events-small"><?php echo EZRealtyFHelper::convertTime ($item->ohstarttime);?> - <?php } ?><?php if ($item->ohendtime){?><?php echo EZRealtyFHelper::convertTime ($item->ohendtime);?></span><?php } ?>
								<br />
								<?php } ?>
								<?php if ($item->ohdate2 >= $getnow && $item->ohdate2 != '0000-00-00' && $item->ohdate && $item->ohstarttime2 != '00:00:00') { ?>
									<?php if ($item->ohdate2 && $item->ohdate2 != '0000-00-00'){ ?><i class="ezicon-calendar <?php echo $pageiconcolour;?>"></i> <span class="events"><?php echo JText::_('COM_EZREALTY_LISTINGS_OPENHOUSE');?> <?php echo EZRealtyFHelper::convertDate ($item->ohdate2);?></span><?php } ?>: 
									<?php if ($item->ohstarttime2){?><span class="events-small"><?php echo EZRealtyFHelper::convertTime ($item->ohstarttime2);?> - <?php } ?><?php if ($item->ohendtime2){?><?php echo EZRealtyFHelper::convertTime ($item->ohendtime2);?></span><?php } ?>
								<br />
								<?php } ?>
							</div>
						</div>

					<?php }
				} ?>

				<?php if ( $this->params->get( 'show_auctiondate' ) ) {
					if ( $item->aucdate >= $getnow && $item->aucdate != '0000-00-00' && $item->auctime && $item->auctime != '00:00:00' ) { ?>
						<div class="row-fluid">
							<div class="span12">
								<?php if ($item->aucdate && $item->aucdate >= $getnow){ ?><i class="ezicon-calendar <?php echo $pageiconcolour;?>"></i> <span class="events"><?php echo JText::_('COM_EZREALTY_LISTINGS_AUCTION');?> <?php echo EZRealtyFHelper::convertDate ($item->aucdate);?></span><?php } ?>: 
								<?php if ($item->auctime){?><span class="events-small"><?php echo EZRealtyFHelper::convertTime ($item->auctime);?></span><?php } ?> 
							</div>
						</div>
					<?php }
				} ?>

				<?php if ( $item->featured == 2 || $this->params->get( 'show_small_desc' ) ) { ?>
					<div class="row-fluid ezitem-bopad">
						<div class="span12">
							<?php echo stripslashes($item->smalldesc);?>
						</div>
					</div>
				<?php } ?>

				<div class="row-fluid">
					<div class="span12">
						<span class="ez-buttons">
							<?php if ( $this->params->get( 'er_shortlisting' ) ) { ?>
								<?php if ( $this->params->get( 'popup_linktype' ) ) { ?>
									<a href="javascript:void(0)" class="<?php echo $btncolour.' '.$btnsize;?>" onclick="window.open('<?php echo $shortlist; ?>','win2','<?php echo $status; ?>');" title="<?php echo JText::_('EZREALTY_LISTINGS_ADDLIGHTBOX');?>">
										<i class="icon-bookmark <?php echo $iconcolour;?>"></i> <?php echo JText::_('COM_EZREALTY_SAVE');?>
									</a>
								<?php } else { ?>
									<a href="<?php echo $shortlist;?>" class="modal <?php echo $btncolour.' '.$btnsize;?>" rel="{handler:'iframe',size:{x:300,y:200}}" title="<?php echo JText::_('EZREALTY_LISTINGS_ADDLIGHTBOX');?>">
										<i class="icon-bookmark <?php echo $iconcolour;?>"></i> <?php echo JText::_('COM_EZREALTY_SAVE');?>
									</a>
								<?php } ?>
							<?php } ?>
							<a href="<?php echo $item->link; ?>" class="<?php echo $btncolour.' '.$btnsize;?>" title="<?php echo JText::_('EZREALTY_READMORE');?>">
								<i class="icon-file <?php echo $iconcolour;?>"></i> <?php echo JText::_('EZREALTY_READMORE');?>
							</a>
						</span>
						<?php echo EZRealtyFHelper::convertSellerLogo ($item->logo_image);?>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>

<?php } ?>
