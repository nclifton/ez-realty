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

$latitude = $this->params->get( 'er_listmaplat');
$longitude = $this->params->get( 'er_listmaplong');
$mapres = $this->params->get( 'er_listmapres');

$maploc  = intval(JRequest::getVar( 'filter_a3locality', '0'));

if ($maploc != 0){

	list($maplat, $maplong, $mapzoom) = EZRealtyFHelper::findSuburbCoords($maploc);

	if ($maplat != 0 && $maplong != 0 && $mapzoom != 0){
		$latitude = $maplat;
		$longitude = $maplong;
		$mapres = $mapzoom;
	}
}

$readmore = JText::_('EZREALTY_READMORE');
$propid = JText::_('EZREALTY_PRINT_ID');

?>

<div id="map_canvas" style="position:relative; width: 100%; height: <?php echo $this->params->def( 'er_listmapheight');?>px;"></div>

	<script type="text/javascript">
	var locations = [
		<?php foreach ($this->items as $item){
			$iconcount = $this->pagination->getRowOffset( $item->count );
			$whichicon = JURI::root()."components/com_ezrealty/assets/images/map".$item->type.".png";

			//clean any line breaks
        $smalldesc = str_replace( "\r\n", " ", $item->smalldesc );
		$textlength = "150";
		$mapdesc = EZRealtyFHelper::limit_ezrealtytext( $smalldesc,$textlength );

			if ($item->declat && $item->declong && $item->viewad){ ?>
				['<div class="row-fluid"><div class="span12"><span class="<?php echo $this->params->get( 'titlecolor' );?>" style="font-size: 120%; font-weight: bold;"><?php echo addslashes($item->adline);?></span></div></div><div class="row-fluid"><div class="span12"><div class="ezitem-iconbkgr"><span class="ezitem-leftpad"><?php echo EZRealtyFHelper::textIcons ($item->bedrooms, $item->bathrooms, $item->parkingGarage, $item->squarefeet, $item->LandAreaSqFt); ?></span></div></div></div><div class="row-fluid"><div class="span4"><?php if(!EZRealtyFHelper::getTheImage($item->id) ){ ?><a href="<?php echo $item->link;?>"><img class="span12 thumbnail" src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/noimage.png" /></a><?php } else { ?><a href="<?php echo $item->link;?>"><img class="span12 thumbnail" src="<?php echo EZRealtyFHelper::convertMapImage ($item->id); ?>" /></a><?php } ?></div><div class="span8 ezitem-smallleftpad"><p style="font-size: 90%; font-weight: normal;"><?php echo addslashes($smalldesc); ?> ... <a href="<?php echo $item->link; ?>"><?php echo $readmore;?></a></p></div></div>', <?php echo $item->declat;?>, <?php echo $item->declong;?>, <?php echo $iconcount;?>, '<?php echo $whichicon;?>'],
			<?php }
		} ?>
	];

	var map = new google.maps.Map(document.getElementById('map_canvas'), {
		zoom: <?php echo $mapres;?>,
		center: new google.maps.LatLng(<?php echo $latitude;?>, <?php echo $longitude;?>),
		streetViewControl: <?php if ( $this->params->get( 'er_streetview' ) ){ ?>true<?php } else { ?>false<?php } ?>,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	var infowindow = new google.maps.InfoWindow();

	var marker, i;

	for (i = 0; i < locations.length; i++) {

		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map,
			icon: new google.maps.MarkerImage(locations[i][4])
		});

		google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
				infowindow.setContent(locations[i][0]);
				infowindow.open(map, marker);
			}
		})(marker, i));
	}
</script>
