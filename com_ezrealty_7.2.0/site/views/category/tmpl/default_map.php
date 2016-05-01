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

$maploc  = intval(JRequest::getVar( 'filter_a1locality', '0'));

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

<script type="text/javascript">
// <![CDATA[

  var map;
  var panorama;
  var centerPlace = new google.maps.LatLng(<?php echo $latitude;?>, <?php echo $longitude;?>);

<?php foreach ($this->items as $item){
	if ($item->declat && $item->declong && $item->viewad){ ?>
		var propertyListing<?php echo $item->id;?> = new google.maps.LatLng(<?php echo $item->declat;?>, <?php echo $item->declong;?>);
<?php
	}
} ?>

  function initEzrMapCom() {

	// Set up the map
	var mapOptions = {
		center: centerPlace,
		zoom: <?php echo $mapres;?>,
		streetViewControl: <?php if ( $this->params->get( 'er_streetview' ) ){ ?>true<?php } else { ?>false<?php } ?>,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

	// Setup the markers on the map

<?php foreach ($this->items as $item){

	$iconcount = $this->pagination->getRowOffset( $item->count );
	if ($item->declat && $item->declong && $item->viewad){

		//clean any line breaks
		$smalldesc = preg_replace(array('/\r/', '/\n/'), '', $item->smalldesc);

?>

    var contentString<?php echo $item->id;?> = '<div class="row-fluid">'+
        '<div class="span12"><span class="<?php echo $this->params->get( 'titlecolor' );?>" style="font-size: 120%; font-weight: bold;"><?php echo addslashes($item->adline);?></span></div>'+
        '</div><div class="row-fluid"><div class="span12">'+
        '<div class="ezitem-iconbkgr"><span class="ezitem-leftpad"><?php echo EZRealtyFHelper::textIcons ($item->bedrooms, $item->bathrooms, $item->parkingGarage, $item->squarefeet, $item->LandAreaSqFt); ?></span></div>'+
        '</div></div>'+
        '<div class="row-fluid">'+
        '<div class="span4">'+
		<?php if(!EZRealtyFHelper::getTheImage($item->id) ){ ?>
        '<a href="<?php echo $item->link;?>"><img class="span12 thumbnail" src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/noimage.png" /></a>'+
		<?php } else { ?>
        '<a href="<?php echo $item->link;?>"><img class="span12 thumbnail" src="<?php echo EZRealtyFHelper::convertMapImage ($item->id); ?>" /></a>'+
		<?php } ?>
        '</div><div class="span8 ezitem-smallleftpad">'+
        '<p style="font-size: 90%; font-weight: normal;"><?php echo addslashes($smalldesc); ?> ... <a href="<?php echo $item->link; ?>"><?php echo $readmore;?></a></p>'+
        '</div>'+
        '</div>';

        
    var infowindow<?php echo $item->id;?> = new google.maps.InfoWindow({
        content: contentString<?php echo $item->id;?>
    });

    var propertyListing<?php echo $item->id;?>MarkerImage =
        new google.maps.MarkerImage(
            '<?php echo JURI::root()."components/com_ezrealty/assets/images/map".$item->type.".png";?>');
    var propertyListing<?php echo $item->id;?>Marker = new google.maps.Marker({
        position: propertyListing<?php echo $item->id;?>,
        map: map,
        icon: propertyListing<?php echo $item->id;?>MarkerImage,
        title: '<?php echo $propid;?> <?php echo $item->id;?>:- <?php echo addslashes($item->adline);?>'
    });

    google.maps.event.addListener(propertyListing<?php echo $item->id;?>Marker, 'click', function() {
      infowindow<?php echo $item->id;?>.open(map,propertyListing<?php echo $item->id;?>Marker);
    });

<?php
	}
} ?>

    // We get the map's default panorama and set up some defaults.
    // Note that we don't yet set it visible.
    panorama = map.getStreetView();
    panorama.setPosition(centerPlace);
    panorama.setPov({
      heading: 265,
      zoom:1,
      pitch:0}
    );
  }

  function toggleStreetView() {
    var toggle = panorama.getVisible();
    if (toggle == false) {
      panorama.setVisible(true);
    } else {
      panorama.setVisible(false);
    }
  }
// ]]>
</script>

<div id="map_canvas" style="position:relative; width: 100%; height: <?php echo $this->params->get( 'er_listmapheight');?>px"></div>

