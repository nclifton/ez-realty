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

$propid = JText::_('EZREALTY_PRINT_ID');

?>

  <div id="map_canvas" style="position:relative;width: 100%; height: <?php echo $this->params->def( 'er_mapheight');?>px"></div>

  <script type="text/javascript">
    var locations = [
      ['<div class="ezitem-maptitle"><?php echo addslashes($this->ezrealty->adline);?></div>', <?php echo $this->ezrealty->declat;?>, <?php echo $this->ezrealty->declong;?>, 1]
    ];

    var map = new google.maps.Map(document.getElementById('map_canvas'), {
      zoom: <?php echo $this->params->def( 'er_mapres');?>,
      center: new google.maps.LatLng(<?php echo $this->ezrealty->declat;?>, <?php echo $this->ezrealty->declong;?>),
      streetViewControl: <?php if ( $this->params->get( 'er_streetview' ) ){ ?>true<?php } else { ?>false<?php } ?>,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    var propertyListingMarkerImage = new google.maps.MarkerImage('<?php echo JURI::root()."components/com_ezrealty/assets/images/map".$this->ezrealty->type.".png";?>');

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: propertyListingMarkerImage,
        title: '<?php echo $propid;?> <?php echo $this->ezrealty->id;?>:- <?php echo addslashes($this->ezrealty->adline);?>'
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
