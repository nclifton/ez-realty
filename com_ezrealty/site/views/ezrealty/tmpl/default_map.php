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

$propid = JText::_('EZREALTY_PRINT_ID');

?>

<script type="text/javascript">
// <![CDATA[

  var map;
  var panorama;
  var centerPlace = new google.maps.LatLng(<?php echo $this->ezrealty->declat;?>, <?php echo $this->ezrealty->declong;?>);
  var propertyListing = new google.maps.LatLng(<?php echo $this->ezrealty->declat;?>, <?php echo $this->ezrealty->declong;?>);

  function initEzrMapCom() {

    // Set up the map
    var mapOptions = {
      center: centerPlace,
      zoom: <?php echo $this->params->def( 'er_mapres');?>,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      streetViewControl: false
    };
    map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

    // Setup the markers on the map

    var propertyListingMarkerImage =
        new google.maps.MarkerImage(
            '<?php echo JURI::root()."components/com_ezrealty/assets/images/map".$this->ezrealty->type.".png";?>');
    var propertyListingMarker = new google.maps.Marker({
        position: propertyListing,
        map: map,
        icon: propertyListingMarkerImage,
        title: '<?php echo $propid;?> <?php echo $this->ezrealty->id;?>:- <?php echo addslashes($this->ezrealty->adline);?>'
    });

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

<?php if ( $this->params->get( 'er_streetview' ) ){ ?>

  <div id="toggle">
	  <input type="button" class="<?php echo $btncolour.' '.$btnsize;?>" value="<?php echo JText::_('EZREALTY_STREETVIEW');?>" onclick="toggleStreetView();"></input>
  </div>

<?php } ?>

  <div id="map_canvas" style="position:relative;width: 100%; height: <?php echo $this->params->def( 'er_mapheight');?>px"></div>


