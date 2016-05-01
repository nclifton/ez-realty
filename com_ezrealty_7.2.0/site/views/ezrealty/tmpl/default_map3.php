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

    <!--
        Connects Yandex.Maps API 2.x
        Parameters:
          - 'load' = package.full - full package;
	      - 'lang' = en-US - American English.
    -->
    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=<?php echo $this->params->def( 'er_maplang');?>" type="text/javascript"></script>

    <script type="text/javascript">
        // Initializes the map as soon as the API is loaded and DOM is ready
        ymaps.ready(init);

        function init () {
            var myMap = new ymaps.Map("map", {
                    center: [<?php echo $this->ezrealty->declat;?>, <?php echo $this->ezrealty->declong;?>],
                    zoom: <?php echo $this->params->def( 'er_mapres');?>
                }),
                // The first way to set placemarks
                myPlacemark = new ymaps.Placemark([<?php echo $this->ezrealty->declat;?>, <?php echo $this->ezrealty->declong;?>]);

            // Adding placemarks to the map
            myMap.geoObjects
                .add(myPlacemark);


            // The field "control" is used for adding
            // map controls to the map. The field refers to
            // a collection of map control elements.
            // The add() method adds an element
            // to the collection.

            // The add() method accepts a string id
            // of the map control and its parameters.
            myMap.controls
                // The zoom control button
                .add('zoomControl')
                // The list of map types
                .add('typeSelector')
                // The zoom control button (a compact version)
                // Let's shift it to the right
                .add('smallZoomControl', { right: 5, top: 75 })
                // A standard toolbar
                .add('mapTools');

            // You can also pass to the add() method an instance of the class implementing a map control.
            // For example, a scale line
            myMap.controls
                .add(new ymaps.control.ScaleLine())
                // In the constructor of a control element you can define auxiliary
                // parameters, for example, a map type for the overview map
                .add(new ymaps.control.MiniMap({
                    type: 'yandex#satellite'
                }));

        }
    </script>

<div id="map" style="width:100%; height:<?php echo $this->params->get( 'er_mapheight');?>px"></div>
