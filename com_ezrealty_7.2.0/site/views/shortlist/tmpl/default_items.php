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

$Itemid  = intval(JRequest::getVar( 'Itemid', ''));

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_ezrealty/tables');

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

?>


<div id="roxscrollable" class="hidden-phone">
	<div id="roxitems">
		<br />

	<?php
	if(!empty($this->items)):
		foreach($this->items as $key=>$item):
			if($item->id):

				$remove = JURI::root() . 'index.php?option=com_ezrealty&amp;view=ezrealty&amp;task=removeshortlist&amp;id='. $item->litem.'&amp;Itemid='. $Itemid;

				$loc =& JTable::getInstance('localities', 'Table');
				$loc->load($item->locid);

				?>
				<div class="roxitem category-left-centered">

					<?php if ($this->params->get( 'use_jrev' ) && file_exists("components/com_jreviews/jreviews/models/everywhere/everywhere_com_ezrealty.php")){ ?>
						<div class="row-fluid">
							<div class="span12">
								<?php echo EZRealtyFHelper::convertJreviews ($item->id, '1'); ?>
							</div>
						</div>
					<?php } ?>

					<div class="row-fluid">
						<div class="span12">

							<div id="ezitem-watermark_box" class="thumbnail">
								<div id="ezimagefade">
									<div class="ezimage-smallwrap">
										<a href="<?php echo $item->link; ?>">
											<?php if(!EZRealtyFHelper::getTheImage($item->id) ){ ?>
												<img class="span12" src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/noimage.png" alt="<?php echo $item->adline;?>" />
											<?php } else { ?>
												<?php echo EZRealtyFHelper::convertImage ($item->id, $item->soleAgency, $item->sold, $item->adline, $item->featured, $item->type, 0); ?>
											<?php } ?>
										</a>
									</div>
									<?php echo EZRealtyFHelper::smallWatermark ($item->id, $item->soleAgency, $item->sold, $item->adline, $item->featured, $item->type, 0); ?>
								</div>
							</div>

						</div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad">
							<div class="ezitem-darklisttitle">

								<?php if ( $item->type ) { echo EZRealtyFHelper::convertListingtype ($item->type); } ?>

							</div>
						</div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad">
							<span class="ezitem-darklisttitle"><?php echo $item->category;?></span>
						</div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad">
							<span class="ezitem-darklisttitle"><?php echo stripslashes($loc->ezcity);?></span>
						</div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad">
							<span class="ezitem-smliprice">

							<?php if ( $this->params->get( 'er_hideprice') || $this->params->get( 'er_hideprice')==0 && $this->user->id ) {
								echo EZRealtyFHelper::formatDisplayPrice ($item->showprice, $item->price, $item->currency_format, $item->currency, $item->currency_position, $item->priceview, $item->freq);
							} else {
								echo "(".JText::_('EZREALTY_CONFIG_HIDEPRICE_MSG').")";
							} ?>

							</span>
						</div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_YEAR_BUILT');?>: <?php echo stripslashes($item->year);?></div>
					</div>

					<?php if ( $item->bedrooms == -2 ) { ?>
						<div class="row-fluid rox-border">
							<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_BEDROOMS');?>: <?php echo JText::_('EZREALTY_COUCH');?></div>
						</div>
					<?php } else if ( $item->bedrooms == -1 ) { ?>
						<div class="row-fluid rox-border">
							<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_BEDROOMS');?>: <?php echo JText::_('EZREALTY_STUDIO');?></div>
						</div>
					<?php } else { ?>
						<div class="row-fluid rox-border">
							<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_BEDROOMS');?>: <?php if ($item->bedrooms != 0){ echo stripslashes($item->bedrooms); } else { } ?></div>
						</div>
					<?php } ?>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_SLEEPS');?>: <?php if ( $item->sleeps != 0 ) { echo stripslashes($item->sleeps); } ?></div>
					</div>

					<?php $item->bathrooms = preg_replace(array('/0.00/', '/.00/', '/.25/', '/.50/', '/.75/'), array('', '', '&#188;', '&#189;', '&#190;'), $item->bathrooms);?>
					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_TOTALBATHS');?>: <?php echo stripslashes($item->bathrooms);?></div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_TOTALROOMS');?>: <?php echo stripslashes($item->totalrooms);?></div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_LIVINGAREA');?>: <?php echo stripslashes($item->livingarea);?></div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_SQUARES');?>: <?php echo EZRealtyFHelper::xmlConvertArea ($item->squarefeet); ?></div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_GARPARKING');?>: <?php if ( $item->parkingGarage ) { echo stripslashes($item->parkingGarage); } ?></div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_FLOORS');?>: <?php if ( $item->stories != "0" ) { echo stripslashes($item->stories); } ?></div>
					</div>

					<div class="row-fluid">
						<div class="span12">
						<?php if ( $this->params->get( 'er_shortlisting' ) ) { ?>
							<a href="<?php echo $remove;?>" class="<?php echo $btncolour;?> btn-mini"  title="<?php echo JText::_('EZREALTY_REMOVE_LIGHTBOX');?>">
								<i class="icon-trash <?php echo $iconcolour;?>"></i><?php echo JText::_('EZREALTY_REMOVE_LIGHTBOX');?>
							</a>
						<?php } ?>

						<a href="<?php echo $item->link; ?>" class="<?php echo $btncolour;?> btn-mini" title="<?php echo JText::_('EZREALTY_READMORE');?>">
							<i class="icon-file <?php echo $iconcolour;?>"></i><?php echo JText::_('EZREALTY_READMORE');?>
						</a>
						</div>
					</div>

				</div>

			<?php 
			endif;
		endforeach ;
	endif;
	?>	

	</div>
</div>


<div class="row-fluid visible-phone">
	<div class="span12">

	<?php
	if(!empty($this->items)):
		foreach($this->items as $key=>$item):
			if($item->id):

				$remove = JURI::root() . 'index.php?option=com_ezrealty&amp;view=ezrealty&amp;task=removeshortlist&amp;id='. $item->litem.'&amp;Itemid='. $Itemid;

				$loc =& JTable::getInstance('localities', 'Table');
				$loc->load($item->locid);

				?>

					<?php if ($this->params->get( 'use_jrev' ) && file_exists("components/com_jreviews/jreviews/models/everywhere/everywhere_com_ezrealty.php")){ ?>
						<div class="row-fluid">
							<div class="span12">
								<?php echo EZRealtyFHelper::convertJreviews ($item->id, '1'); ?>
							</div>
						</div>
					<?php } ?>

					<div class="row-fluid">
						<div class="span12">

							<div id="ezitem-watermark_box" class="thumbnail">
								<div id="ezimagefade">
									<div class="ezimage-smallwrap">
										<a href="<?php echo $item->link; ?>">
											<?php if(!EZRealtyFHelper::getTheImage($item->id) ){ ?>
												<img class="span12" src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/noimage.png" alt="" />
											<?php } else { ?>
												<?php echo EZRealtyFHelper::convertImage ($item->id, $item->soleAgency, $item->sold, $item->adline, $item->featured, $item->type, 0); ?>
											<?php } ?>
										</a>
									</div>
									<?php echo EZRealtyFHelper::smallWatermark ($item->id, $item->soleAgency, $item->sold, $item->adline, $item->featured, $item->type, 0); ?>
								</div>
							</div>

						</div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad">
							<div class="ezitem-darklisttitle">

								<?php if ( $item->type ) { echo EZRealtyFHelper::convertListingtype ($item->type); } ?>

							</div>
						</div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad">
							<span class="ezitem-darklisttitle"><?php echo $item->category;?></span>
						</div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad">
							<span class="ezitem-darklisttitle"><?php echo stripslashes($loc->ezcity);?></span>
						</div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad">
							<span class="ezitem-smliprice">

							<?php if ( $this->params->get( 'er_hideprice') || $this->params->get( 'er_hideprice')==0 && $this->user->id ) {
								echo EZRealtyFHelper::formatDisplayPrice ($item->showprice, $item->price, $item->currency_format, $item->currency, $item->currency_position, $item->priceview, $item->freq);
							} else {
								echo "(".JText::_('EZREALTY_CONFIG_HIDEPRICE_MSG').")";
							} ?>

							</span>
						</div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_YEAR_BUILT');?>: <?php echo stripslashes($item->year);?></div>
					</div>

					<?php if ( $item->bedrooms == -1 ) { ?>
						<div class="row-fluid rox-border">
							<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_BEDROOMS');?>: <?php echo JText::_('EZREALTY_STUDIO');?></div>
						</div>
					<?php } else { ?>
						<div class="row-fluid rox-border">
							<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_BEDROOMS');?>: <?php echo stripslashes($item->bedrooms);?></div>
						</div>
					<?php } ?>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_SLEEPS');?>: <?php if ( $item->sleeps != 0 ) { echo stripslashes($item->sleeps); } ?></div>
					</div>

					<?php $item->bathrooms = preg_replace(array('/0.00/', '/.00/', '/.25/', '/.50/', '/.75/'), array('', '', '&#188;', '&#189;', '&#190;'), $item->bathrooms);?>
					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_TOTALBATHS');?>: <?php echo stripslashes($item->bathrooms);?></div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_TOTALROOMS');?>: <?php echo stripslashes($item->totalrooms);?></div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_LIVINGAREA');?>: <?php echo stripslashes($item->livingarea);?></div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_SQUARES');?>: <?php echo EZRealtyFHelper::xmlConvertArea ($item->squarefeet); ?></div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_GARPARKING');?>: <?php if ( $item->parkingGarage ) { echo stripslashes($item->parkingGarage); } ?></div>
					</div>

					<div class="row-fluid rox-border">
						<div class="span12 ezitem-bopad ezitem-toppad"><?php echo JText::_('EZREALTY_DETAILS_FLOORS');?>: <?php if ( $item->stories != "0" ) { echo stripslashes($item->stories); } ?></div>
					</div>

					<div class="row-fluid">
						<div class="span12">
						<?php if ( $this->params->get( 'er_shortlisting' ) ) { ?>
							<a href="<?php echo $remove;?>" class="<?php echo $btncolour;?> btn-mini"  title="<?php echo JText::_('EZREALTY_REMOVE_LIGHTBOX');?>">
								<i class="icon-trash <?php echo $iconcolour;?>"></i> <?php echo JText::_('EZREALTY_REMOVE_LIGHTBOX');?>
							</a>
						<?php } ?>

						<a href="<?php echo $item->link; ?>" class="<?php echo $btncolour;?> btn-mini" title="<?php echo JText::_('EZREALTY_READMORE');?>">
							<i class="icon-file <?php echo $iconcolour;?>"></i> <?php echo JText::_('EZREALTY_READMORE');?>
						</a>
						</div>
					</div>

			<?php 
			endif;
		endforeach ;
	endif;
	?>	

	</div>
</div>
