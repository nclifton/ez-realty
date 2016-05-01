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

JHtml::_('behavior.framework');
$id  = intval(JRequest::getVar( 'id', 0 ));

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
if (!$this->params->get('er_fieldsize')){
	$er_fieldsize = "span12";
} else {
	$er_fieldsize = $this->params->get('er_fieldsize');
}
if (!$this->params->get('icon_colour')){
	$iconcolour = "icon-black";
} else {
	$iconcolour = "icon-white";
}

if ($this->params->get('show_print_results')){
	$printlink	= JRoute::_('index.php?option=com_ezrealty&view=suburb&id='.$id.'&format=pdf', false);
}

//suburb filters

$thelist1 = $this->params->get( 'show_categories_select' );
$thelist2 = $this->params->get( 'show_transtype_select' );
$thelist3 = $this->params->get( 'show_marketstatus_select' );

$thelist4 = $this->params->get( 'show_sellers_select' );

$thelist5 = $this->params->get( 'show_minmaxprice_select' );
$thelist6 = 0;
$thelist7 = 0;
$thelist8 = 0;
$thelist9 = $this->params->get( 'show_minbedsbaths_select' );
$thelist10 = $this->params->get( 'show_minmaxarea_select' );
$thelist11 = $this->params->get( 'show_minmaxland_select' );

?>

	<?php if ( $this->params->get( 'show_keyword_select' ) ) { ?>
		<div class="row-fluid">
			<div class="span12">
				<input type="text" name="filter_a5search" id="filter_a5search" placeholder="<?php echo JText::_('COM_EZREALTY_KEYWORD'); ?>" value="<?php echo htmlspecialchars($this->lists['filter_a5search']);?>" class="<?php echo $er_fieldsize;?>" onchange="document.adminForm.submit();" />
			</div>
		</div>
	<?php } ?>

	<?php if ( $this->params->get( 'show_transtype_select' ) || $this->params->get( 'show_marketstatus_select' ) || 
	$this->params->get( 'show_sellers_select' ) || $this->params->get( 'show_minmaxprice_select' ) || 
	$this->params->get( 'show_countries_select' ) || $this->params->get( 'show_states_select' ) || $this->params->get( 'show_suburbs_select' ) || 
	$this->params->get( 'show_minbedsbaths_select' ) || $this->params->get( 'show_minmaxarea_select' ) || $this->params->get( 'show_minmaxland_select' ) ) { ?>

		<?php echo EZRealtyFHelper::convertSelectList ( $this->params->get( 'listorder1' ), $thelist1,$thelist2,$thelist3,$thelist4,$thelist5,$thelist6,$thelist7,$thelist8,$thelist9,$thelist10,$thelist11 );?>
		<?php echo EZRealtyFHelper::convertSelectList ( $this->params->get( 'listorder2' ), $thelist1,$thelist2,$thelist3,$thelist4,$thelist5,$thelist6,$thelist7,$thelist8,$thelist9,$thelist10,$thelist11 );?>
		<?php echo EZRealtyFHelper::convertSelectList ( $this->params->get( 'listorder3' ), $thelist1,$thelist2,$thelist3,$thelist4,$thelist5,$thelist6,$thelist7,$thelist8,$thelist9,$thelist10,$thelist11 );?>
		<?php echo EZRealtyFHelper::convertSelectList ( $this->params->get( 'listorder4' ), $thelist1,$thelist2,$thelist3,$thelist4,$thelist5,$thelist6,$thelist7,$thelist8,$thelist9,$thelist10,$thelist11 );?>
		<?php echo EZRealtyFHelper::convertSelectList ( $this->params->get( 'listorder5' ), $thelist1,$thelist2,$thelist3,$thelist4,$thelist5,$thelist6,$thelist7,$thelist8,$thelist9,$thelist10,$thelist11 );?>
		<?php echo EZRealtyFHelper::convertSelectList ( $this->params->get( 'listorder6' ), $thelist1,$thelist2,$thelist3,$thelist4,$thelist5,$thelist6,$thelist7,$thelist8,$thelist9,$thelist10,$thelist11 );?>
		<?php echo EZRealtyFHelper::convertSelectList ( $this->params->get( 'listorder7' ), $thelist1,$thelist2,$thelist3,$thelist4,$thelist5,$thelist6,$thelist7,$thelist8,$thelist9,$thelist10,$thelist11 );?>
		<?php echo EZRealtyFHelper::convertSelectList ( $this->params->get( 'listorder8' ), $thelist1,$thelist2,$thelist3,$thelist4,$thelist5,$thelist6,$thelist7,$thelist8,$thelist9,$thelist10,$thelist11 );?>
		<?php echo EZRealtyFHelper::convertSelectList ( $this->params->get( 'listorder9' ), $thelist1,$thelist2,$thelist3,$thelist4,$thelist5,$thelist6,$thelist7,$thelist8,$thelist9,$thelist10,$thelist11 );?>
	<?php } ?>

	<?php if ( $this->params->get( 'show_custom1_select' ) ) { ?>
		<div class="row-fluid">
			<div class="span12">
				<?php echo stripslashes($this->lists['custom1']);?>
			</div>
		</div>
	<?php } ?>


	<?php
	if ( file_exists(JPATH_SITE . '/administrator/components/com_realtybookings/realtybookings.php') ) {
		if ( $this->params->get( 'use_realtybookings' ) && $this->params->get( 'show_dates_select' ) ) { ?>
			<div class="row-fluid">
				<div class="span6">
					<label class="filter-hide-lbl" for="filter_a5begin"><?php echo JText::_('EZREALTY_BEGIN'); ?></label>
					<?php echo JHtml::_('calendar', $this->lists['filter_a5begin'], 'filter_a5begin', 'filter_a5begin', '%Y-%m-%d' , array('size'=>10, 'onchange'=>"this.form.fireEvent('submit');this.form.submit()"));?>
				</div>
				<div class="span6">
					<label class="filter-hide-lbl" for="filter_a5end"><?php echo JText::_('EZREALTY_END'); ?></label>
					<?php echo JHtml::_('calendar', $this->lists['filter_a5end'], 'filter_a5end', 'filter_a5end', '%Y-%m-%d' , array('size'=>10, 'onchange'=>"this.form.fireEvent('submit');this.form.submit()"));?>
				</div>
			</div>
		<?php }
	} ?>


		<div class="row-fluid">
			<div class="span7">
				<?php if ($this->params->get('show_print_results')){ ?>
					<a class="<?php echo $btncolour.' '.$btnsize;?>" target="_blank" href="<?php echo $printlink; ?>" title="<?php echo JText::_('JGLOBAL_PRINT');?>"><i class="icon-print <?php echo $iconcolour;?>"></i> <?php echo JText::_('EZREALTY_DETAILS_PRINT_RESULTS');?></a>
				<?php } ?>
			</div>

			<div class="span5">

	<?php if ( $this->params->get( 'show_categories_select' ) == 0 && 
	$this->params->get( 'show_transtype_select' ) == 0 && 
	$this->params->get( 'show_marketstatus_select' ) == 0 && 
	$this->params->get( 'show_sellers_select' ) == 0 && 
	$this->params->get( 'show_minmaxprice_select' ) == 0 && 
	$this->params->get( 'show_minbedsbaths_select' ) == 0 && 
	$this->params->get( 'show_minmaxarea_select' ) == 0 && 
	$this->params->get( 'show_keyword_select' ) == 0 && 
	$this->params->get( 'show_dates_select' ) == 0 && 
	$this->params->get( 'show_minmaxland_select' ) == 0 && 
	$this->params->get( 'show_custom1_select' ) == 0 ) { } else { ?>

			<button class="<?php echo $btncolour.' '.$btnsize;?> ezitem-shiftbutton" onclick="
			<?php if ( $this->params->get( 'show_categories_select' ) ) { ?>document.getElementById('filter_a5cid').value='0';<?php } ?>
			<?php if ( $this->params->get( 'show_transtype_select' ) ) { ?>document.getElementById('filter_a5type').value='0';<?php } ?>
			<?php if ( $this->params->get( 'show_marketstatus_select' ) ) { ?>document.getElementById('filter_a5sold').value='0';<?php } ?>
			<?php if ( $this->params->get( 'show_sellers_select' ) ) { ?>document.getElementById('filter_a5seller').value='0';<?php } ?>
			<?php if ( $this->params->get( 'show_minmaxprice_select' ) ) { ?>document.getElementById('filter_a5minprice').value='';document.getElementById('filter_a5maxprice').value='';<?php } ?>
			<?php if ( $this->params->get( 'show_minbedsbaths_select' ) ) { ?>document.getElementById('filter_a5minbed').value='0';document.getElementById('filter_a5minbaths').value='';<?php } ?>
			<?php if ( $this->params->get( 'show_minmaxarea_select' ) ) { ?>document.getElementById('filter_a5minarea').value=''; document.getElementById('filter_a5maxarea').value='';<?php } ?>
			<?php if ( $this->params->get( 'show_keyword_select' ) ) { ?>document.getElementById('filter_a5search').value='';<?php } ?>
			<?php if ( file_exists(JPATH_SITE . '/administrator/components/com_realtybookings/realtybookings.php') ) {
				if ( $this->params->get( 'use_realtybookings' ) && $this->params->get( 'show_dates_select' ) ) { ?>document.getElementById('filter_a5begin').value=''; document.getElementById('filter_a5end').value='';<?php } ?>
			<?php } ?>
			<?php if ( $this->params->get( 'show_custom1_select' ) ) { ?>document.getElementById('filter_a5custom1').value='';<?php } ?>
			<?php if ( $this->params->get( 'show_minmaxland_select' ) ) { ?>
				document.getElementById('filter_a5minland').value='';
				document.getElementById('filter_a5maxland').value='';
				document.getElementById('filter_a5landtype').value=0;
			<?php } ?>

			this.form.submit();"><?php echo JText::_( 'EZREALTY_RESET_BTN' ); ?></button>
	<?php } ?>

			</div>
		</div>

