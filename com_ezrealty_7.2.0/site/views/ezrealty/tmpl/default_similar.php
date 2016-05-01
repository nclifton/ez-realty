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

if ( $this->params->get( 'er_simnum' ) ) {
	$simnum=$this->params->get( 'er_simnum' );
} else {
	$simnum="5";
}


$db =& JFactory::getDBO();

$where = array();

$where[] = 'a.id != '.(int) $this->ezrealty->id;
$where[] = 'a.published = 1';
$where[] = 'a.locid = '.(int) $this->ezrealty->locid;
$where[] = 'a.type = '.(int) $this->ezrealty->type;
$where[] = 'a.cid = '.(int) $this->ezrealty->cid;
$where[] = 'a.bedrooms = '.(int) $this->ezrealty->bedrooms;
$where[] = 'a.bathrooms = '.(int) $this->ezrealty->bathrooms;

$wherex 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );

$howmany = ' LIMIT '.$simnum;

$queryx = 'SELECT a.*, cc.name AS category, '
.' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', a.id, a.alias) ELSE a.id END as slug, '
.' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(\':\', cc.id, cc.alias) ELSE cc.id END as catslug '
.' FROM #__ezrealty AS a'
.' LEFT JOIN #__ezrealty_catg AS cc ON cc.id = a.cid'
. $wherex
. $howmany
;
$db->setQuery( $queryx );

//echo $query;

$itemxs = $db->loadObjectList();

if ($itemxs){

?>

<br />

<div class="row-fluid">
	<div class="span12 well">

		<h4 style="margin-top: -10px; margin-bottom: -20px;"><?php echo JText::_('EZREALTY_FIND_SIMILAR');?></h4>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>
					</th>
					<th class="hidden-phone">
						<?php echo JText::_('EZREALTY_VIEWDET_PRICE');?>
					</th>
					<th class="hidden-phone">
						<?php echo JText::_('COM_EZREALTY_DISPLAY_BEDS_TITLE');?>
					</th>
					<th class="hidden-phone">
						<?php echo JText::_('COM_EZREALTY_DISPLAY_BATHS_TITLE');?>
					</th>
				</tr>
			</thead>
		
			<tbody>

				<?php foreach ($itemxs as $itemx) {
					$linkx = JRoute::_(EzrealtyHelperRoute::getEzrealtyRoute($itemx->slug, $itemx->catslug, '', '' ));
					?>
					<tr>
						<td>
							<a href="<?php echo $linkx;?>" title="<?php echo $itemx->adline;?>">
								<?php echo $itemx->adline;?>
							</a>
							<span class="visible-phone">
								<?php if ( $this->params->get( 'er_hideprice') || $this->params->get( 'er_hideprice')==0 && $this->user->id ) {
									echo EZRealtyFHelper::formatDisplayPrice ($itemx->showprice, $itemx->price, $itemx->currency_format, $itemx->currency, $itemx->currency_position, $itemx->priceview, $itemx->freq);
								} else {
									echo "(".JText::_('EZREALTY_CONFIG_HIDEPRICE_MSG').")";
								} ?>
								<br />
								<?php echo EZRealtyFHelper::textIcons ($itemx->bedrooms, $itemx->bathrooms, '', '', ''); ?>
							</span>
						</td>
						<td class="hidden-phone">
							<?php if ( $this->params->get( 'er_hideprice') || $this->params->get( 'er_hideprice')==0 && $this->user->id ) {
								echo EZRealtyFHelper::formatDisplayPrice ($itemx->showprice, $itemx->price, $itemx->currency_format, $itemx->currency, $itemx->currency_position, $itemx->priceview, $itemx->freq);
							} else {
								echo "(".JText::_('EZREALTY_CONFIG_HIDEPRICE_MSG').")";
							} ?>
						</td>
						<td class="hidden-phone">
							<?php echo $itemx->bedrooms;?>
						</td>
						<td class="hidden-phone">
							<?php if ($itemx->bathrooms != "0.00"){ $itemx->bathrooms = preg_replace(array('/.00/', '/.25/', '/.50/', '/.75/'), array('', '&#188;', '&#189;', '&#190;'), $itemx->bathrooms);
								echo $itemx->bathrooms;
							} ?>
						</td>
					</tr>
		
				<?php } ?>
		
			<tbody>
		</table>
	</div>
</div>

<?php } ?>
