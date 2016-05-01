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

$db	=	& JFactory::getDBO();
$ezrparams = JComponentHelper::getParams ('com_ezrealty');

if ($ezrparams->get( 'er_pdffix' )){
	$imgbase = "../";
} else {
	$imgbase = JURI::root();
}

$query = "SELECT a.*, cc.name AS category, dd.ezcity AS proploc, ss.seller_name AS propseller, ss.seller_phone AS sellerphone FROM #__ezrealty AS a LEFT JOIN #__ezrealty_catg AS cc ON cc.id = a.cid LEFT JOIN #__ezrealty_locality AS dd ON dd.id = a.locid LEFT JOIN #__ezportal AS ss ON ss.uid = a.owner where a.id in ('".implode("','", $cids)."')";
$db->setQuery( $query );

$items = $db->loadObjectList();

if (count($items) > 0){

?>
	<table class="table table-striped table-bordered table-condensed">

		<thead>
			<tr>
				<th width="100px"> </th>
				<th width="177px"> </th>
				<th width="150px"><span style="font-weight: bold; font-size: 0.7em;"><?php echo JText::_( 'EZREALTY_VIEWDET_PRICE' );?></span></th>
				<th width="80px"><span style="font-weight: bold; font-size: 0.7em;"><?php echo JText::_( 'EZREALTY_DETAILS_BEDROOMS' );?></span></th>
				<th width="110px"><span style="font-weight: bold; font-size: 0.7em;"><?php echo JText::_( 'EZREALTY_DETAILS_TOTALBATHS' );?></span></th>
				<th width="70px"><span style="font-weight: bold; font-size: 0.7em;"><?php echo JText::_( 'EZREALTY_DETAILS_PARKING_TITLE' );?></span></th>
				<th width="110px"><span style="font-weight: bold; font-size: 0.7em;"><?php echo JText::_( 'COM_EZREALTY_STATUS' );?></span></th>
				<th width="150px"><span style="font-weight: bold; font-size: 0.7em;"><?php echo JText::_( 'EZREALTY_LISTER_AGENT' );?></span></th>
			</tr>
			<tr>
				<th colspan="8"><hr style="height:0.75em;width:100%;border:1px solid #000;" /> </th>
			</tr>
		</thead>

		<tbody>

			<?php

			$k = 0;
			$count = count($items);
			for($i = 0; $i < $count; $i++) {

				$item =& $items[$i];


				if(!EZRealtyFHelper::getTheImage($item->id) ){
					$image = $imgbase."components/com_ezrealty/assets/images/nothumb.png";
				} else {
					$image = EZRealtyFHelper::convertPdfImage ($item->id);
				}

				?>

				<tr nobr="true">
					<td width="100px" style="text-align:left;">
						<img src="<?php if ($ezrparams->get( 'er_pdffix' )){ ?>../<?php } ?><?php echo $image;?>" class="thumbnail" style="height:70px; width:90px;" />
					</td>

					<td width="177px" style="padding-left: 10px;">
						<?php if ( $item->type ) { echo EZRealtyFHelper::convertListingtype ($item->type); } ?><br /><?php echo $item->proploc; ?>
					</td>

					<td width="150px" valign="top">
						<?php echo EZRealtyFHelper::formatDisplayPrice ($item->showprice, $item->price, $item->currency_format, $item->currency, $item->currency_position, $item->priceview, $item->freq); ?>
					</td>

					<td width="80px" valign="top">
						<?php if ($item->bedrooms != 0){?>
							<?php if ($item->bedrooms == -2){ echo "<span style=\"font-size: 80%;\">". JText::_('EZREALTY_COUCH')."</span>"; } else if ($item->bedrooms == -1){ echo JText::_('EZREALTY_STUDIO'); } else { echo $item->bedrooms; } ?>
						<?php } ?>
					</td>
					<td width="110px" valign="top">
						<?php if ( $item->bathrooms ) {
							$item->bathrooms = preg_replace(array('/0.00/', '/.00/'), array('', ''), $item->bathrooms);?>
							<?php echo stripslashes($item->bathrooms);?>
						<?php } ?>
					</td>
					<td width="70px" valign="top">
						<?php if ($item->parkingGarage){?><?php echo $item->parkingGarage; ?><?php } ?>
					</td>

					<td width="110px" valign="top">

						<?php if ( $item->sold ) { echo EZRealtyFHelper::convertMarketstatus ($item->sold); } ?>

					</td>
					<td width="150px" valign="top">
						<?php echo stripslashes($item->propseller);?><br />
						<?php echo stripslashes($item->sellerphone);?>
					</td>

				</tr>

				<?php
				$item->odd		= $k;
				$item->count	= $i;
				$k = 1 - $k;
			}
			?>

		</tbody>
	</table>

<?php } ?>

