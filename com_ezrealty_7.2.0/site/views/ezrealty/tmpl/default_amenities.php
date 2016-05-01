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

if (!$this->params->get('page_iconcolour')){
	$pageiconcolour = "ezicon-black";
} else {
	$pageiconcolour = "ezicon-white";
}

	$menuclass = 'category'.$this->params->get('pageclass_sfx');
	$width	= $this->params->get('width');
	$height	= $this->params->get('height');
	if ($width == null || $height == null) {
		$width	= 600;
		$height	= 500;
	}

	switch ($this->params->get('target'))
	{
		case 1:
			// open in a new window
			$link1 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_SCHOOLS').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) .'" target="_blank" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_SCHOOLS') .'</a>';
			$link2 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_RSTATIONS').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) .'" target="_blank" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_RSTATIONS') .'</a>';
			$link3 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_RESTAURANT').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) .'" target="_blank" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_RESTAURANT') .'</a>';
			$link4 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_TAKEAWAY').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) .'" target="_blank" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_TAKEAWAY') .'</a>';
			$link5 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_DOCTORS').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) .'" target="_blank" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_DOCTORS') .'</a>';
			$link6 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_DENTISTS').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) .'" target="_blank" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_DENTISTS') .'</a>';
			$link7 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_HOSPITALS').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) .'" target="_blank" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_HOSPITALS') .'</a>';
			$link8 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_VETS').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) .'" target="_blank" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_VETS') .'</a>';
			break;

		case 2:
			// open in a popup window
			$attribs = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width='.$this->escape($width).',height='.$this->escape($height).'';
			$link1 = "<a href=\"http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_SCHOOLS').'&amp;om=1&amp;near=". stripslashes($this->ezrealty->postcode) ."%20". stripslashes($this->ezrealty->cnname) ."\" onclick=\"window.open(this.href, 'targetWindow', '".$attribs."'); return false;\">". JText::_('COM_EZREALTY_AMENITIES_SCHOOLS').'</a>';
			$link2 = "<a href=\"http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_RSTATIONS').'&amp;om=1&amp;near=". stripslashes($this->ezrealty->postcode) ."%20". stripslashes($this->ezrealty->cnname) ."\" onclick=\"window.open(this.href, 'targetWindow', '".$attribs."'); return false;\">". JText::_('COM_EZREALTY_AMENITIES_RSTATIONS').'</a>';
			$link3 = "<a href=\"http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_RESTAURANT').'&amp;om=1&amp;near=". stripslashes($this->ezrealty->postcode) ."%20". stripslashes($this->ezrealty->cnname) ."\" onclick=\"window.open(this.href, 'targetWindow', '".$attribs."'); return false;\">". JText::_('COM_EZREALTY_AMENITIES_RESTAURANT').'</a>';
			$link4 = "<a href=\"http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_TAKEAWAY').'&amp;om=1&amp;near=". stripslashes($this->ezrealty->postcode) ."%20". stripslashes($this->ezrealty->cnname) ."\" onclick=\"window.open(this.href, 'targetWindow', '".$attribs."'); return false;\">". JText::_('COM_EZREALTY_AMENITIES_TAKEAWAY').'</a>';
			$link5 = "<a href=\"http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_DOCTORS').'&amp;om=1&amp;near=". stripslashes($this->ezrealty->postcode) ."%20". stripslashes($this->ezrealty->cnname) ."\" onclick=\"window.open(this.href, 'targetWindow', '".$attribs."'); return false;\">". JText::_('COM_EZREALTY_AMENITIES_DOCTORS').'</a>';
			$link6 = "<a href=\"http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_DENTISTS').'&amp;om=1&amp;near=". stripslashes($this->ezrealty->postcode) ."%20". stripslashes($this->ezrealty->cnname) ."\" onclick=\"window.open(this.href, 'targetWindow', '".$attribs."'); return false;\">". JText::_('COM_EZREALTY_AMENITIES_DENTISTS').'</a>';
			$link7 = "<a href=\"http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_HOSPITALS').'&amp;om=1&amp;near=". stripslashes($this->ezrealty->postcode) ."%20". stripslashes($this->ezrealty->cnname) ."\" onclick=\"window.open(this.href, 'targetWindow', '".$attribs."'); return false;\">". JText::_('COM_EZREALTY_AMENITIES_HOSPITALS').'</a>';
			$link8 = "<a href=\"http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_VETS').'&amp;om=1&amp;near=". stripslashes($this->ezrealty->postcode) ."%20". stripslashes($this->ezrealty->cnname) ."\" onclick=\"window.open(this.href, 'targetWindow', '".$attribs."'); return false;\">". JText::_('COM_EZREALTY_AMENITIES_VETS').'</a>';

			break;

		default:
			// open in parent window
			$link1 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_SCHOOLS').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) . '" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_SCHOOLS') . ' </a>';
			$link2 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_RSTATIONS').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) . '" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_RSTATIONS') . ' </a>';
			$link3 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_RESTAURANT').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) . '" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_RESTAURANT') . ' </a>';
			$link4 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_TAKEAWAY').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) . '" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_TAKEAWAY') . ' </a>';
			$link5 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_DOCTORS').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) . '" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_DOCTORS') . ' </a>';
			$link6 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_DENTISTS').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) . '" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_DENTISTS') . ' </a>';
			$link7 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_HOSPITALS').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) . '" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_HOSPITALS') . ' </a>';
			$link8 = '<a href="http://local.google.com/local?f=l&amp;hl=en&amp;q=category:+'.JText::_('COM_EZREALTY_AMENITIES_VETS').'&amp;om=1&amp;near='. stripslashes($this->ezrealty->postcode) .'%20'. stripslashes($this->ezrealty->cnname) . '" class="'. $menuclass .'" rel="nofollow">'. JText::_('COM_EZREALTY_AMENITIES_VETS') . ' </a>';

			break;
	}


if ( $this->params->get( 'page_structure' ) == 1 || $this->params->get( 'page_structure' ) == 2 ){ ?>

	<div class="row-fluid">
		<div class="span6">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link1;?>
		</div>
		<div class="span6">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link5;?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link2;?>
		</div>
		<div class="span6">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link6;?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link3;?>
		</div>
		<div class="span6">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link7;?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link4;?>
		</div>
		<div class="span6">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link8;?>
		</div>
	</div>

<?php } else { ?>

	<div class="row-fluid">
		<div class="span3">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link1;?>
		</div>
		<div class="span3">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link3;?>
		</div>
		<div class="span3">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link5;?>
		</div>
		<div class="span3">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link7;?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span3">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link2;?>
		</div>
		<div class="span3">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link4;?>
		</div>
		<div class="span3">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link6;?>
		</div>
		<div class="span3">
			<i class="ezicon-map-marker <?php echo $pageiconcolour;?>"></i> <?php echo $link8;?>
		</div>
	</div>

<?php } ?>
