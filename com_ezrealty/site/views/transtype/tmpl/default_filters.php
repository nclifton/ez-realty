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
	$printlink	= JRoute::_('index.php?option=com_ezrealty&view=transtype&id='.$id.'&format=pdf', false);
}

//transtype filters

$thelist1 = $this->params->get( 'show_categories_select' );

	if ($this->params->get( 'show_transtype_select') && $this->transtype > '7') {
		$thelist2 = $this->params->get( 'show_transtype_select' );
	} else {
		$thelist2 = 0;
	}


$thelist3 = $this->params->get( 'show_marketstatus_select' );

$thelist4 = $this->params->get( 'show_sellers_select' );

$thelist5 = $this->params->get( 'show_minmaxprice_select' );
$thelist6 = $this->params->get( 'show_countries_select' );
$thelist7 = $this->params->get( 'show_states_select' );
$thelist8 = $this->params->get( 'show_suburbs_select' );
$thelist9 = $this->params->get( 'show_minbedsbaths_select' );
$thelist10 = $this->params->get( 'show_minmaxarea_select' );
$thelist11 = $this->params->get( 'show_minmaxland_select' );

?>


	<?php if ( $this->params->get( 'show_keyword_select' ) ) { ?>
		<div class="row-fluid">
			<div class="span12">
				<input type="text" name="filter_a6search" id="filter_a6search" placeholder="<?php echo JText::_('COM_EZREALTY_KEYWORD'); ?>" value="<?php echo htmlspecialchars($this->lists['filter_a6search']);?>" class="<?php echo $er_fieldsize;?>" onchange="document.adminForm.submit();" />
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
					<label class="filter-hide-lbl" for="filter_a6begin"><?php echo JText::_('EZREALTY_BEGIN'); ?></label>
					<?php echo JHtml::_('calendar', $this->lists['filter_a6begin'], 'filter_a6begin', 'filter_a6begin', '%Y-%m-%d' , array('size'=>10, 'onchange'=>"this.form.fireEvent('submit');this.form.submit()"));?>
				</div>
				<div class="span6">
					<label class="filter-hide-lbl" for="filter_a6end"><?php echo JText::_('EZREALTY_END'); ?></label>
					<?php echo JHtml::_('calendar', $this->lists['filter_a6end'], 'filter_a6end', 'filter_a6end', '%Y-%m-%d' , array('size'=>10, 'onchange'=>"this.form.fireEvent('submit');this.form.submit()"));?>
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
	$this->params->get( 'show_countries_select' ) == 0 && 
	$this->params->get( 'show_states_select' ) == 0 && 
	$this->params->get( 'show_suburbs_select' ) == 0 && 
	$this->params->get( 'show_surrounding_select' ) == 0 && 
	$this->params->get( 'show_minmaxprice_select' ) == 0 && 
	$this->params->get( 'show_minbedsbaths_select' ) == 0 && 
	$this->params->get( 'show_minmaxarea_select' ) == 0 && 
	$this->params->get( 'show_minmaxland_select' ) == 0 && 
	$this->params->get( 'show_keyword_select' ) == 0 && 
	$this->params->get( 'show_dates_select' ) == 0 && 
	$this->params->get( 'show_custom1_select' ) == 0 ) { } else { ?>

			<button class="<?php echo $btncolour.' '.$btnsize;?> ezitem-shiftbutton" onclick="
			<?php if ( $this->params->get( 'show_categories_select' ) ) { ?>document.getElementById('filter_a6cid').value='0';<?php } ?>
			<?php if ( $this->params->get( 'show_transtype_select' ) ) { ?>document.getElementById('filter_a6type').value='0';<?php } ?>
			<?php if ( $this->params->get( 'show_marketstatus_select' ) ) { ?>document.getElementById('filter_a6sold').value='0';<?php } ?>
			<?php if ( $this->params->get( 'show_sellers_select' ) ) { ?>document.getElementById('filter_a6seller').value='0';<?php } ?>
			<?php if ( $this->params->get( 'show_countries_select' ) ) { ?>document.getElementById('filter_a6country').value='0';<?php } ?>
			<?php if ( $this->params->get( 'show_states_select' ) ) { ?>document.getElementById('filter_a6state').value='0';<?php } ?>
			<?php if ( $this->params->get( 'show_suburbs_select' ) ) { ?>document.getElementById('filter_a6locality').value='0';<?php } ?>
			<?php if ( $this->params->get( 'show_minmaxprice_select' ) ) { ?>document.getElementById('filter_a6minprice').value='';document.getElementById('filter_a6maxprice').value='';<?php } ?>
			<?php if ( $this->params->get( 'show_minbedsbaths_select' ) ) { ?>document.getElementById('filter_a6minbed').value='0';document.getElementById('filter_a6minbaths').value='';<?php } ?>
			<?php if ( $this->params->get( 'show_minmaxarea_select' ) ) { ?>document.getElementById('filter_a6minarea').value=''; document.getElementById('filter_a6maxarea').value='';<?php } ?>
			<?php if ( $this->params->get( 'show_keyword_select' ) ) { ?>document.getElementById('filter_a6search').value='';<?php } ?>
			<?php if ( file_exists(JPATH_SITE . '/administrator/components/com_realtybookings/realtybookings.php') ) {
				if ( $this->params->get( 'use_realtybookings' ) && $this->params->get( 'show_dates_select' ) ) { ?>document.getElementById('filter_a6begin').value=''; document.getElementById('filter_a6end').value='';<?php } ?>
			<?php } ?>
			<?php if ( $this->params->get( 'show_custom1_select' ) ) { ?>document.getElementById('filter_a6custom1').value='';<?php } ?>
			<?php if ( $this->params->get( 'show_suburbs_select' ) && $this->params->get( 'show_surrounding_select' )){ ?>
				document.getElementById('filter_a6radius').value='NULL';
			<?php } ?>

			<?php if ( $this->params->get( 'show_minmaxland_select' ) ) { ?>
				document.getElementById('filter_a6minland').value='';
				document.getElementById('filter_a6maxland').value='';
				document.getElementById('filter_a6landtype').value=0;
			<?php } ?>

			this.form.submit();"><?php echo JText::_( 'EZREALTY_RESET_BTN' ); ?></button>
	<?php } ?>

			</div>
		</div>
