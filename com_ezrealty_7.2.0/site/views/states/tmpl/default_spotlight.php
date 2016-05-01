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

if (!$this->params->get('butcolour')){
	$btncolour = "btn";
} else {
	$btncolour = $this->params->get('butcolour');
}

if (!$this->params->get('icon_colour')){
	$iconcolour = "icon-black";
} else {
	$iconcolour = "icon-white";
}


if ($this->params->get( 'show_statspot_title' )){ ?>

	<div class="row-fluid">
		<div class="span12">
			<h2><span><?php echo $this->params->get( 'stats_spotlight_title' );?></span></h2>
		</div>
	</div>

<?php

}

foreach ($this->featured as $feat) {

    $shortlist = JURI::root() . 'index.php?tmpl=component&amp;option=com_ezrealty&amp;task=addshortlist&amp;id='. $feat->id;

	$loc =& JTable::getInstance('localities', 'Table');
	$loc->load($feat->locid);


?>

	<div class="row-fluid ezitem-separator">
		<div class="span12">

			<div class="row-fluid">
				<div class="span12 ezitem-bopad">

					<span class="ezitem-featpropertytitle">

						<?php if ( $feat->type ) {
							echo EZRealtyFHelper::convertListingtype ($feat->type)." - ";
						} ?><?php echo stripslashes($loc->ezcity); ?> - 

					</span>
					<span class="ezitem-smfeatpropertyprice <?php echo $this->params->get( 'titlecolor' );?>">

						<?php if ( $this->params->get( 'er_hideprice') || $this->params->get( 'er_hideprice')==0 && $this->user->id ) {
							echo EZRealtyFHelper::formatDisplayPrice ($feat->showprice, $feat->price, $feat->currency_format, $feat->currency, $feat->currency_position, $feat->priceview, $feat->freq);
						} else {
							echo "(".JText::_('EZREALTY_CONFIG_HIDEPRICE_MSG').")";
						} ?>

					</span>

				</div>
			</div>

			<div class="row-fluid">
				<div class="span12">

					<div id="ezitem-watermark_box" class="thumbnail">
						<div id="ezimagefade">
							<div class="ezimage-wrap">
								<a href="<?php echo $feat->link; ?>">
									<?php if ( $this->params->get( 'stats_imgsource') ) { ?>
										<?php if( $feat->panorama ){ ?>
											<img class="span12" src="<?php echo JURI::root();?>images/ezrealty/panorama/<?php echo $feat->panorama;?>" alt="<?php echo $feat->adline;?>" />
										<?php } else { ?>
											<img class="span12" src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/nopanorama.png" alt="<?php echo $feat->adline;?>" />
										<?php } ?>
									<?php } else { ?>
										<?php if(!EZRealtyFHelper::getTheImage($feat->id) ){ ?>
											<img class="span12" src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/noimage.png" alt="<?php echo $feat->adline;?>" />
										<?php } else { ?>
											<?php echo EZRealtyFHelper::featuredImage ($feat->id, $feat->soleAgency, $feat->sold, $feat->adline, $feat->featured, $feat->type, 0); ?>
										<?php } ?>
									<?php } ?>
								</a>
							</div>
							<?php if ( $this->params->get( 'stats_imgsource') ) {
								echo EZRealtyFHelper::smallWatermark ($feat->id, $feat->soleAgency, $feat->sold, $feat->adline, $feat->featured, $feat->type, 0);
							} else {
								echo EZRealtyFHelper::theWatermark ($feat->id, $feat->soleAgency, $feat->sold, $feat->adline, $feat->featured, $feat->type, 0);
							} ?>
						</div>
					</div>

				</div>
			</div>


			<div class="row-fluid">
				<div class="span12">

					<?php if ( $this->params->get( 'show_icons' ) ) { ?>
						<?php if ($feat->bedrooms || $feat->bathrooms || $feat->parkingGarage || $feat->squarefeet || $feat->LandAreaSqFt){ ?>
							<div class="row-fluid ezitem-toppad">
								<div class="span12" style="text-align: center;">
									<?php if ( $this->params->get( 'show_icons' ) == 1 ) {
										echo EZRealtyFHelper::convertHicons ($feat->bedrooms, $feat->bathrooms, $feat->parkingGarage, $feat->squarefeet, $feat->LandAreaSqFt);
									} else {
										echo EZRealtyFHelper::textIcons ($feat->bedrooms, $feat->bathrooms, $feat->parkingGarage, $feat->squarefeet, $feat->LandAreaSqFt);
									} ?>
								</div>
							</div>
						<?php } ?>
					<?php } ?>

					<!-- Begin read more and bookmarking button -->
					<div class="row-fluid">
						<div class="span6">
							<?php if ( $this->params->get( 'er_shortlisting' ) ) { ?>
								<?php if ( $this->params->get( 'popup_linktype' ) ) { ?>
									<a href="javascript:void(0)" class="<?php echo $btncolour;?> btn-small span12" onclick="window.open('<?php echo $shortlist; ?>','win2','<?php echo $status; ?>');" title="<?php echo JText::_('EZREALTY_LISTINGS_ADDLIGHTBOX');?>">
										<i class="icon-bookmark <?php echo $iconcolour;?>"></i> <?php echo JText::_('COM_EZREALTY_SAVE');?>
									</a>
								<?php } else { ?>
									<a href="<?php echo $shortlist;?>" class="modal <?php echo $btncolour;?> btn-small span12" rel="{handler:'iframe',size:{x:300,y:200}}" title="<?php echo JText::_('EZREALTY_LISTINGS_ADDLIGHTBOX');?>">
										<i class="icon-bookmark <?php echo $iconcolour;?>"></i> <?php echo JText::_('COM_EZREALTY_SAVE');?>
									</a>
								<?php } ?>
							<?php } ?>
						</div>
						<div class="span6">
							<a href="<?php echo $feat->link; ?>" class="<?php echo $btncolour;?> btn-small span12" title="<?php echo JText::_('EZREALTY_READMORE');?>">
								<i class="icon-file <?php echo $iconcolour;?>"></i> <?php echo JText::_('EZREALTY_READMORE');?>
							</a>
						</div>
					</div>
					<!-- End read more button -->

				</div>
			</div>

		</div>
	</div>

<?php } ?>

