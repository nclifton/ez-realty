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



	$database =& JFactory::getDBO();
	$menuclass = 'category'.$this->params->get('pageclass_sfx');
	$width	= $this->params->get('width');
	$height	= $this->params->get('height');
	if ($width == null || $height == null) {
		$width	= 600;
		$height	= 500;
	}

$suburblink = JRoute::_(EzrealtyHelperRoute::getSuburbRoute($this->ezrealty->subslug ));

// get category
$theprop = $this->ezrealty->id;

$database->setQuery("select c.name,c.id from #__ezrealty_catg as c inner join #__ezrealty_incats as ic on ic.category_id=c.id where ic.property_id=$theprop");
$pcategories=$database->loadObjectList();
$i=0;
$pcategory_name='';
foreach($pcategories as $pcategory) {
	if($i==0) {
		$pcategory_name=$pcategory->name;
	} else {
		$pcategory_name.=', '.$pcategory->name;
	}
	$i++;
}


	switch ($this->params->get('target'))
	{
		case 1:
			// open in a new window
			$link9 = '<a href="http://www.greatschools.net/search/search.page?state='. stripslashes($this->ezrealty->statename) .'&q='. stripslashes($this->ezrealty->proploc) .'&type=school" target="_blank" class="'. $menuclass .'" rel="nofollow">'. JText::_('EZREALTY_VIEW_SCHOOL_PROFILE') .'</a>';
			$link10 = '<a href="http://www.schoolswebdirectory.co.uk/index.php?county='. stripslashes($this->ezrealty->statename) .'&submit=Submit+Query" target="_blank" class="'. $menuclass .'" rel="nofollow">'. JText::_('EZREALTY_VIEW_SCHOOL_PROFILE') .'</a>';
			$link11 = '<a href="http://www.bestplaces.net/search/?q='. stripslashes($this->ezrealty->postcode) .'" target="_blank" class="'. $menuclass .'" rel="nofollow">'. JText::_('EZREALTY_VIEW_HOOD_PROFILE') .'</a>';
			break;

		case 2:
			// open in a popup window
			$attribs = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width='.$this->escape($width).',height='.$this->escape($height).'';
			$link9 = "<a href=\"http://www.greatschools.net/search/search.page?state=". stripslashes($this->ezrealty->statename) ."&q=". stripslashes($this->ezrealty->proploc) ."&type=school\" onclick=\"window.open(this.href, 'targetWindow', '".$attribs."'); return false;\">". JText::_('EZREALTY_VIEW_SCHOOL_PROFILE').'</a>';
			$link10 = "<a href=\"http://www.schoolswebdirectory.co.uk/index.php?county=". stripslashes($this->ezrealty->statename) ."&submit=Submit+Query\" onclick=\"window.open(this.href, 'targetWindow', '".$attribs."'); return false;\">". JText::_('EZREALTY_VIEW_SCHOOL_PROFILE').'</a>';
			$link11 = "<a href=\"http://www.bestplaces.net/search/?q=". stripslashes($this->ezrealty->postcode) ."\" onclick=\"window.open(this.href, 'targetWindow', '".$attribs."'); return false;\">". JText::_('EZREALTY_VIEW_HOOD_PROFILE').'</a>';
			break;

		default:
			// open in parent window
			$link9 = '<a href="http://www.greatschools.net/search/search.page?state='. stripslashes($this->ezrealty->statename) .'&q='. stripslashes($this->ezrealty->proploc) . '&type=school" class="'. $menuclass .'" rel="nofollow">'. JText::_('EZREALTY_VIEW_SCHOOL_PROFILE') . ' </a>';
			$link10 = '<a href="http://www.schoolswebdirectory.co.uk/index.php?county='. stripslashes($this->ezrealty->statename) .'&submit=Submit+Query" class="'. $menuclass .'" rel="nofollow">'. JText::_('EZREALTY_VIEW_SCHOOL_PROFILE') . ' </a>';
			$link11 = '<a href="http://www.bestplaces.net/search/?q='. stripslashes($this->ezrealty->postcode) . '" class="'. $menuclass .'" rel="nofollow">'. JText::_('EZREALTY_VIEW_HOOD_PROFILE') . ' </a>';
			break;
	}




?>



		<?php if ( $this->params->get( 'er_hideprice') || $this->params->get( 'er_hideprice')==0 && $this->user->id ) { ?>
			<div class="row-fluid">
				<div class="span12">
					<span class="ezitem-mainpropertyprice">

						<?php if ( $this->ezrealty->offpeak == 0.00 ) { ?><?php echo JText::_('EZREALTY_VIEWDET_PRICE');?><?php } else { ?><?php echo JText::_('EZREALTY_PEAK_TARRIF');?><?php } ?>: 
						<?php echo EZRealtyFHelper::formatDisplayPrice ($this->ezrealty->showprice, $this->ezrealty->price, $this->ezrealty->currency_format, $this->ezrealty->currency, $this->ezrealty->currency_position, $this->ezrealty->priceview, $this->ezrealty->freq); ?>

					</span>
				</div>
			</div>

			<?php if ( $this->ezrealty->offpeak != 0.00 ) { ?>
				<div class="row-fluid">
					<div class="span12"><?php echo JText::_('EZREALTY_OFFPEAK_TARRIF');?>: 

						<?php echo EZRealtyFHelper::formatDisplayPrice ($this->ezrealty->showprice, $this->ezrealty->offpeak, $this->ezrealty->currency_format, $this->ezrealty->currency, $this->ezrealty->currency_position, $this->ezrealty->priceview, $this->ezrealty->freq); ?>

					</div>
				</div>
			<?php } if ($this->ezrealty->bond != 0.00 ) { ?>
				<div class="row-fluid">
					<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_BOND');?>: 

						<?php echo EZRealtyFHelper::formatDisplayPrice ($this->ezrealty->showprice, $this->ezrealty->bond, $this->ezrealty->currency_format, $this->ezrealty->currency, $this->ezrealty->currency_position, $this->ezrealty->priceview, ''); ?>

					</div>
				</div>
			<?php } ?>
		<?php } else { ?>
			<div class="row-fluid">
				<div class="span12"><?php if ( $this->ezrealty->offpeak == 0.00 ) { ?><?php echo JText::_('EZREALTY_VIEWDET_PRICE');?><?php } else { ?><?php echo JText::_('EZREALTY_PEAK_TARRIF');?><?php } ?>: <?php echo JText::_('EZREALTY_CONFIG_HIDEPRICE_MSG');?></div>
			</div>
		<?php } ?>

		<div class="row-fluid">
			<div class="span12"><?php if ( $this->ezrealty->type ) { ?><?php echo EZRealtyFHelper::convertListingtype ($this->ezrealty->type);?>: <?php } ?><?php echo $pcategory_name;?> <?php if ( $this->ezrealty->sold ) { ?>(<?php echo EZRealtyFHelper::convertMarketstatus ($this->ezrealty->sold); ?>)<?php } ?></div>
		</div>

		<?php if ( $this->ezrealty->rent_type && $this->params->get( 'er_userenttype') ) { ?>
			<div class="row-fluid">
				<div class="span12"><?php echo JText::_('EZREALTY_RENTAL_TYPE');?>: <?php echo EZRealtyFHelper::convertRental ($this->ezrealty->rent_type);?></div>
			</div>
		<?php } if ($this->ezrealty->availdate && $this->ezrealty->availdate != '0000-00-00') {?>
			<div class="row-fluid">
				<div class="span12"><?php echo JText::_('EZREALTY_DATE_AVAILABILITY');?>: <?php echo EZRealtyFHelper::convertDate ($this->ezrealty->availdate);?></div>
			</div>
		<?php } ?>

		<?php if ($this->ezrealty->subdivision){ ?>
			<div class="row-fluid">
				<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_SUBDIV');?>: <?php echo stripslashes($this->ezrealty->subdivision);?></div>
			</div>
		<?php } ?>
		<?php if ($this->ezrealty->proploc){ ?>
			<div class="row-fluid">
				<div class="span12"><?php echo JText::_('EZREALTY_VIEWDET_LOCALITY');?>: <a href="<?php echo $suburblink;?>"><span class="hasTooltip" title="<?php echo JText::_('EZREALTY_BROWSEMORE_PROPERTIES');?> <?php echo stripslashes($this->loc->ezcity);?>"><?php echo stripslashes($this->loc->ezcity);?></span></a></div>
			</div>
		<?php } ?>
		<?php if ( $this->params->get( 'er_schoolprof') && $this->ezrealty->schoolprof ) { ?>
			<div class="row-fluid">
				<div class="span12"><?php if ( $this->ezrealty->schoolprof == 1 ) { echo $link9; } if ( $this->ezrealty->schoolprof == 2 ) { echo $link10; } ?></div>
			</div>
		<?php } if ( $this->params->get( 'er_hoodprof') && $this->ezrealty->hoodprof ) { ?>
			<div class="row-fluid">
				<div class="span12"><?php echo $link11;?></div>
			</div>
		<?php } if ( $this->ezrealty->county ) { ?>
			<div class="row-fluid">
				<div class="span12"><?php echo JText::_('EZREALTY_DET_COUNTY');?>: <?php echo stripslashes($this->ezrealty->county);?></div>
			</div>
		<?php } if ( $this->params->def( 'use_realtybookings' ) && $this->ezrealty->viewbooking == '1' ) { ?>
		
			<?php if ( $this->params->get( 'popup_linktype' ) ) { ?>

				<div class="row-fluid">
					<div class="span12"><?php echo JText::_('EZREALTY_VIEW_CALENDAR');?>: <?php echo JHtml::_('icon.cal',  $this->ezrealty, $this->params); ?></div>
				</div>
			<?php } else {
			
				$template = JFactory::getApplication()->getTemplate();
				$calendar = JURI::root() . 'index.php?tmpl=component&option=com_realtybookings&view=realtybooking&amp;id='. $this->ezrealty->slug.'&source=1&tmpl=component&template='.$template;
				?>
				<div class="row-fluid">
					<div class="span12">
						<?php echo JText::_('EZREALTY_VIEW_CALENDAR');?>: <a href="<?php echo $calendar;?>" class="modal" rel="{handler:'iframe',size:{x:420,y:330}}">
							<span class="hasTooltip" title="<?php echo JText::_('EZREALTY_VIEW_CALENDAR');?>"><img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/calendar.png" border="0" style="height: 40px;" alt="" /></span>
						</a>
					</div>
				</div>
			<?php } ?>

		<?php } ?>




