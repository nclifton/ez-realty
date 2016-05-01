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


?>

<table width="660" cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td>

			<br />
			<div style="margin: 19px 0; font-weight: bold; font-size: 1.2em;">
				<?php echo stripslashes($ezrealty->adline);?>
			</div>

			<div style="margin: 19px 0; font-weight: bold; font-size: 1.2em;">

				<?php if ( $params->get( 'er_hideprice') || $params->get( 'er_hideprice')==0 && $this->user->id ) { ?>

					<?php if ( $ezrealty->offpeak == 0.00 ) { ?><?php echo JText::_('EZREALTY_VIEWDET_PRICE');?><?php } else { ?><?php echo JText::_('EZREALTY_PEAK_TARRIF');?><?php } ?>: 
					<?php echo EZRealtyFHelper::formatDisplayPrice ($ezrealty->showprice, $ezrealty->price, $ezrealty->currency_format, $ezrealty->currency, $ezrealty->currency_position, $ezrealty->priceview, $ezrealty->freq); ?>

					<?php if ( $ezrealty->offpeak != 0.00 ) { ?>
						<br />
						<?php echo JText::_('EZREALTY_OFFPEAK_TARRIF');?>: 
						<?php echo EZRealtyFHelper::formatDisplayPrice ($ezrealty->showprice, $ezrealty->offpeak, $ezrealty->currency_format, $ezrealty->currency, $ezrealty->currency_position, $ezrealty->priceview, $ezrealty->freq); ?>

					<?php } ?>

					<?php if ($ezrealty->bond != 0.00 ) { ?>
						<br />
						<?php echo JText::_('EZREALTY_DETAILS_BOND');?>: 
						<?php echo EZRealtyFHelper::formatDisplayPrice ($ezrealty->showprice, $ezrealty->bond, $ezrealty->currency_format, $ezrealty->currency, $ezrealty->currency_position, $ezrealty->priceview, ''); ?>

					<?php } ?>

				<?php } else { ?>

					<?php if ( $ezrealty->offpeak == 0.00 ) { ?><?php echo JText::_('EZREALTY_VIEWDET_PRICE');?><?php } else { ?><?php echo JText::_('EZREALTY_PEAK_TARRIF');?><?php } ?>: 
					<?php echo JText::_('EZREALTY_CONFIG_HIDEPRICE_MSG');?>

				<?php } ?>

			</div>

		</td>
	</tr>
</table>

<table width="660" cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td width="460">

			<table width="460" cellspacing="0" cellpadding="1" border="0">
				<tr>
					<td width="440">

						<div style="font-size: 0.9em;"><?php echo stripslashes($ezrealty->propdesc); ?></div>

					</td>
					<td width="20"> </td>
				</tr>
			</table>


			<table>
				<?php if ( $ezrealty->bedrooms == -1 ) { ?>
				<tr>
					<td><?php echo JText::_('EZREALTY_DETAILS_BEDROOMS');?></td>
					<td><?php echo JText::_('EZREALTY_STUDIO');?></td>
				</tr>
				<?php } ?>
				<?php if ( $ezrealty->bedrooms >= 1 ) { ?>
				<tr>
					<td><?php echo JText::_('EZREALTY_DETAILS_BEDROOMS');?></td>
					<td><?php echo stripslashes($ezrealty->bedrooms);?></td>
				</tr>
				<?php } if ( $ezrealty->sleeps >= 1 ) { ?>
				<tr>
					<td><?php echo JText::_('EZREALTY_DETAILS_SLEEPS');?></td>
					<td><?php echo stripslashes($ezrealty->sleeps);?></td>
				</tr>
				<?php } if ( $ezrealty->bathrooms ) {
					$ezrealty->bathrooms = preg_replace(array('/0.00/', '/.00/'), array('', ''), $ezrealty->bathrooms);
				?>
				<tr>
					<td><?php echo JText::_('EZREALTY_DETAILS_TOTALBATHS');?></td>
					<td><?php echo stripslashes($ezrealty->bathrooms);?></td>
				</tr>
				<?php } if ( $ezrealty->fullBaths > 0 ) { ?>
				<tr>
					<td><?php echo JText::_('EZREALTY_DETAILS_FULLBATHS');?></td>
					<td><?php echo stripslashes($ezrealty->fullBaths);?></td>
				</tr>
				<?php } if ( $ezrealty->thqtrBaths > 0 ) { ?>
				<tr>
					<td><?php echo JText::_('EZREALTY_DETAILS_THRQTRBATHS');?></td>
					<td><?php echo stripslashes($ezrealty->thqtrBaths);?></td>
				</tr>
				<?php } if ( $ezrealty->halfBaths > 0 ) { ?>
				<tr>
					<td><?php echo JText::_('EZREALTY_DETAILS_HALFBATHS');?></td>
					<td><?php echo stripslashes($ezrealty->halfBaths);?></td>
				</tr>
				<?php } if ( $ezrealty->qtrBaths > 0 ) { ?>
				<tr>
					<td><?php echo JText::_('EZREALTY_DETAILS_QTRBATHS');?></td>
					<td><?php echo stripslashes($ezrealty->qtrBaths);?></td>
				</tr>
				<?php } if ( $ezrealty->ensuite > 0 ) { ?>
				<tr>
					<td><?php echo JText::_('EZREALTY_DETAILS_ENBATHS');?></td>
					<td><?php echo stripslashes($ezrealty->ensuite);?></td>
				</tr>
				<?php } if ( $ezrealty->totalrooms ) { ?>
				<tr>
					<td><?php echo JText::_('EZREALTY_DETAILS_TOTALROOMS');?></td>
					<td><?php echo stripslashes($ezrealty->totalrooms);?></td>
				</tr>
				<?php } if ( $ezrealty->parking ) { ?>
				<tr>
					<td><?php echo JText::_('EZREALTY_DETAILS_PARKING');?></td>
					<td><?php echo stripslashes($ezrealty->parking);?></td>
				</tr>
				<?php } if ( $ezrealty->stories ) { ?>
				<tr>
					<td><?php echo JText::_('EZREALTY_DETAILS_FLOORS');?></td>
					<td><?php echo stripslashes($ezrealty->stories);?></td>
				</tr>
				<?php } if ( $ezrealty->year ) { ?>
				<tr>
					<td><?php echo JText::_('EZREALTY_YEAR_BUILT');?></td>
					<td><?php echo stripslashes($ezrealty->year);?></td>
				</tr>
				<?php } if ( $ezrealty->BasementAndFoundation ) { ?>
				<tr>
					<td><?php echo JText::_('COM_EZREALTY_LISTINGS_BANDF');?></td>
					<td><?php echo stripslashes($ezrealty->BasementAndFoundation);?></td>
				</tr>
				<?php } if ( $ezrealty->BasementSize ) { ?>
				<tr>
					<td><?php echo JText::_('COM_EZREALTY_LISTINGS_BSIZE');?></td>
					<td><?php echo stripslashes($ezrealty->BasementSize);?> 
						(
						<?php if ($params->get( 'er_areaunit') == '1') {
							echo JText::_('EZREALTY_SEARCH_METERS');
						} else if ($params->get( 'er_areaunit') == '2') {
							echo JText::_('EZREALTY_SEARCH_SQFEET');
						} else if ($params->get( 'er_areaunit') == '3') {
							echo JText::_('EZREALTY_SEARCH_YARDS');
						} else if ($params->get( 'er_areaunit') == '4') {
							echo JText::_('EZREALTY_SEARCH_SQUARES');
						} else {
							echo JText::_('EZREALTY_SEARCH_METERS');
						}
						?>
						)
					</td>
				</tr>
				<?php } if ( $ezrealty->BasementPctFinished ) { ?>
				<tr>
					<td><?php echo JText::_('COM_EZREALTY_LISTINGS_PCTFINISHED');?></td>
					<td><?php echo stripslashes($ezrealty->BasementPctFinished);?></td>
				</tr>
				<?php } if ( $ezrealty->landtype ) { ?>
				<tr>
					<td><?php echo JText::_('EZREALTY_DETAILS_LANDTYPE');?></td>
					<td><?php echo stripslashes($ezrealty->landtype);?></td>
				</tr>
				<?php } if ( $ezrealty->frontage ) { ?>
				<tr>
					<td><?php echo JText::_('EZREALTY_DETAILS_FRONTAGE');?></td>
					<td><?php echo stripslashes($ezrealty->frontage);?> <?php echo JText::_('EZREALTY_LAND_UNIT');?></td>
				</tr>
				<?php } if ( $ezrealty->depth ) { ?>
				<tr>
					<td><?php echo JText::_('EZREALTY_DETAILS_DEPTH');?></td>
					<td><?php echo stripslashes($ezrealty->depth);?> <?php echo JText::_('EZREALTY_LAND_UNIT');?></td>
				</tr>
				<?php } ?>
			</table>
			<br /><br />

			<table>
				<?php if ($ezrealty->appliances){ ?>
					<tr>
						<td>
							<?php $appliances = str_replace( ";", "; ", $ezrealty->appliances ); ?>
							<span style="margin: 19px 0; font-weight: bold; font-size: 1.0em;"><?php echo JText::_('EZREALTY_CONFIG_FEATURES_APPLIANCES');?>:</span> <?php echo $appliances;?>
						</td>
					</tr>
				<?php } ?>

				<?php if ($ezrealty->indoorfeatures){ ?>
					<tr>
						<td>
							<?php $indoorfeatures = str_replace( ";", "; ", $ezrealty->indoorfeatures ); ?>
							<br /><br />
							<span style="margin: 19px 0; font-weight: bold; font-size: 1.0em;"><?php echo JText::_('EZREALTY_CONFIG_FEATURES_INDOOR');?>:</span> <?php echo $indoorfeatures;?>
						</td>
					</tr>
				<?php } ?>
				<?php if ($ezrealty->outdoorfeatures){ ?>

					<tr>
						<td>
							<?php $outdoorfeatures = str_replace( ";", "; ", $ezrealty->outdoorfeatures ); ?>
							<br /><br />
							<span style="margin: 19px 0; font-weight: bold; font-size: 1.0em;"><?php echo JText::_('EZREALTY_CONFIG_FEATURES_OUTDOOR');?>:</span> <?php echo $outdoorfeatures;?>
						</td>
					</tr>
				<?php } ?>
				<?php if ($ezrealty->buildingfeatures){ ?>

					<tr>
						<td>
							<?php $buildingfeatures = str_replace( ";", "; ", $ezrealty->buildingfeatures ); ?>
							<br /><br />
							<span style="margin: 19px 0; font-weight: bold; font-size: 1.0em;"><?php echo JText::_('EZREALTY_CONFIG_FEATURES_BUILDING');?>:</span> <?php echo $buildingfeatures;?>
						</td>
					</tr>
				<?php } ?>
				<?php if ($ezrealty->communityfeatures){ ?>

					<tr>
						<td>
							<?php $communityfeatures = str_replace( ";", "; ", $ezrealty->communityfeatures ); ?>
							<br /><br />
							<span style="margin: 19px 0; font-weight: bold; font-size: 1.0em;"><?php echo JText::_('EZREALTY_CONFIG_FEATURES_COMMUNITY');?>:</span> <?php echo $communityfeatures;?>
						</td>
					</tr>
				<?php } ?>
				<?php if ($ezrealty->otherfeatures){ ?>

					<tr>
						<td>
							<?php $otherfeatures = str_replace( ";", "; ", $ezrealty->otherfeatures ); ?>
							<br /><br />
							<span style="margin: 19px 0; font-weight: bold; font-size: 1.0em;"><?php echo JText::_('EZREALTY_OTHER_FEATURES');?>:</span> <?php echo $otherfeatures;?>
						</td>
					</tr>
				<?php } ?>

			</table>

		</td>
		<td width="200">

			<?php if ( $ezrealty->openhouse ){ ?>
				<div style="font-weight: bold; font-size: 0.9em;"><?php echo JText::_('EZREALTY_UPCOMING_INSPECTIONS');?></div>

				<br />

				<?php if ($ezrealty->ohdate && $ezrealty->ohdate != '0000-00-00') {?>
					<span style="font-size: 0.8em;"><?php echo JText::_('EZREALTY_OPENHOUSE_DATE');?>: <?php echo EZRealtyFHelper::convertDate ($ezrealty->ohdate);?></span><br />
				<?php } ?>
				<?php if ($ezrealty->ohstarttime && $ezrealty->ohstarttime != '00:00:00') {?>
					<span style="font-size: 0.8em;"><?php echo JText::_('EZREALTY_OPENHOUSE_STARTTIME');?>: <?php echo EZRealtyFHelper::convertTime ($ezrealty->ohstarttime);?></span><br />
				<?php } ?>
				<?php if ($ezrealty->ohendtime && $ezrealty->ohendtime != '00:00:00') {?>
					<span style="font-size: 0.8em;"><?php echo JText::_('EZREALTY_OPENHOUSE_ENDTIME');?>: <?php echo EZRealtyFHelper::convertTime ($ezrealty->ohendtime);?></span><br />
				<?php } ?>

				<?php if ($ezrealty->ohdate2 && $ezrealty->ohdate2 != '0000-00-00') {?>
					<span style="font-size: 0.8em;"><?php echo JText::_('EZREALTY_OPENHOUSE_DATE');?>: <?php echo EZRealtyFHelper::convertDate ($ezrealty->ohdate2);?></span><br />
				<?php } ?>
				<?php if ($ezrealty->ohstarttime2 && $ezrealty->ohstarttime2 != '00:00:00') {?>
					<span style="font-size: 0.8em;"><?php echo JText::_('EZREALTY_OPENHOUSE_STARTTIME');?>: <?php echo EZRealtyFHelper::convertTime ($ezrealty->ohstarttime2);?></span><br />
				<?php } ?>
				<?php if ($ezrealty->ohendtime2 && $ezrealty->ohendtime2 != '00:00:00') {?>
					<span style="font-size: 0.8em;"><?php echo JText::_('EZREALTY_OPENHOUSE_ENDTIME');?>: <?php echo EZRealtyFHelper::convertTime ($ezrealty->ohendtime2);?></span><br />
				<?php } ?>
			<?php } ?>

			<?php if ( $params->get( 'er_useprofile' ) && $ezrealty->dealerpublished ) { ?>

				<br />

				<table width="200">
					<tr>
						<td valign="top">

							<span style="font-weight: bold; font-size: 1.1em;"><?php echo stripslashes($ezrealty->dealer_name);?></span> <?php if ($ezrealty->dealer_jobtitle){ ?><span style="font-weight: bold; font-size: 0.8em;">(<?php echo stripslashes($ezrealty->dealer_jobtitle);?>)</span><?php } ?><br />

							<div style="font-size: 0.8em;">

							<?php if ($ezrealty->dealer_company) { ?>
								<span style="font-weight: bold;"><?php echo stripslashes($ezrealty->dealer_company);?></span><br />
							<?php } ?>

							<?php
							$theunitnum = '';
							if ($ezrealty->dealer_unitnum){ 
								$theunitnum = stripslashes($ezrealty->dealer_unitnum).' / ';
							}
							$thebusaddress = '';
							$thebusaddress = stripslashes($theunitnum).''.stripslashes($ezrealty->dealer_address1).' '.stripslashes($ezrealty->dealer_address2).' '.stripslashes($ezrealty->dealer_suburb);
							$statcode='';
							$statcode = stripslashes($ezrealty->dealer_state).' '.stripslashes($ezrealty->dealer_pcode);
							?>

							<?php if ( $thebusaddress ) { ?><?php echo $thebusaddress;?><br /><?php } ?>
							<?php if ( $statcode ) { ?><?php echo $statcode;?><br /><?php } ?>

							<?php if ($ezrealty->dealer_phone) { ?><?php echo JText::_('EZREALTY_PROFILE_PHONE');?>:&nbsp;<?php echo stripslashes($ezrealty->dealer_phone);?><br />
							<?php } if ($ezrealty->dealer_mobile) { ?><?php echo JText::_('EZREALTY_PROFILE_MOBILE2');?>:&nbsp;<?php echo stripslashes($ezrealty->dealer_mobile);?>
							<?php } ?>

							</div>

						</td>
					</tr>
					<tr>
						<td valign="top">

							<?php if ($ezrealty->dealer_image){ ?>
								<img src="images/ezportal/avatar/<?php echo $ezrealty->dealer_image;?>" alt="" width="120" style="float: left;" />
							<?php } else { ?>
								<img src="components/com_ezrealty/assets/images/noavatar.png" alt="" width="120" style="float: left;" />
							<?php } ?>

						</td>
					</tr>

				</table>

			<?php } ?>

		</td>
	</tr>
</table>

<?php if ($ezrealty->viewad == 1 && $ezrealty->declat && $ezrealty->declong && $params->get( 'er_usemap')) { ?>
	<div align="center">
		<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $ezrealty->declat;?>,<?php echo $ezrealty->declong;?>&zoom=13&size=710x200&scale=2&maptype=roadmap&markers=color:red%7C<?php echo $ezrealty->declat;?>,<?php echo $ezrealty->declong;?>&sensor=false" alt="" />
	</div>
<?php } ?>

<table style="width: 650;" cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td>
			<?php echo $image2;?>
		</td>
		<td>
			<?php echo $image3;?>
		</td>
		<td>
			<?php echo $image4;?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $image5;?>
		</td>
		<td>
			<?php echo $image6;?>
		</td>
		<td>
			<?php echo $image7;?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $image8;?>
		</td>
		<td>
			<?php echo $image9;?>
		</td>
		<td>
			<?php echo $image10;?>
		</td>
	</tr>
</table>

