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

$maploc  = intval(JRequest::getVar( 'filter_a6locality', '0'));

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

    <!--
        Connects Yandex.Maps API 2.x
        Parameters:
          - 'load' = package.full - full package;
	      - 'lang' = en-US - American English.
    -->
    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=<?php echo $this->params->get( 'er_maplang');?>" type="text/javascript"></script>
    <script type="text/javascript">
        // Initializes the map as soon as the API is loaded and DOM is ready
        ymaps.ready(init);

        function init () {
            var myMap = new ymaps.Map('map', {
				center: [<?php echo $latitude;?>, <?php echo $longitude;?>],
				zoom: <?php echo $mapres;?>
                });

			// set placemarks

			<?php if ($this->items){

				foreach ($this->items as $item){
					if ($item->viewad){

						$smalldesc = str_replace( "\r\n", " ", $item->smalldesc );
						$textlength = "150";
						$mapdesc = EZRealtyFHelper::limit_ezrealtytext( $smalldesc,$textlength );

						?>

						myPlacemark<?php echo $item->id;?> = new ymaps.Placemark([<?php echo $item->declat;?>, <?php echo $item->declong;?>], {
							// Properties
							iconContent: '<?php echo $item->id;?>',
							balloonContentHeader: '<?php echo addslashes($item->adline);?>',
							balloonContentBody: '<div class="row-fluid"><div class="span4"><?php if(!EZRealtyFHelper::getTheImage($item->id) ){ ?><a href="<?php echo $item->link;?>"><img class="span12 thumbnail" src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/noimage.png" /></a><?php } else { ?><a href="<?php echo $item->link;?>"><img class="span12 thumbnail" src="<?php echo EZRealtyFHelper::convertMapImage ($item->id); ?>" /></a><?php } ?></div><div class="span8 ezitem-smallleftpad"><div class="row-fluid"></div><p><?php echo addslashes($mapdesc); ?></p></div></div>',
							balloonContentFooter: '<a href="<?php echo $item->link; ?>"><?php echo $readmore;?></a>'
						}, {
							// Options
							preset: 'twirl#blueStretchyIcon' // the icon stretches to fit the content
						});

					<?php
					}
				} ?>


				// Adding placemarks to the map
				myMap.geoObjects

				<?php foreach ($this->items as $item){

					if ($item->declat && $item->declong && $item->viewad){ ?>
						.add(myPlacemark<?php echo $item->id;?>)
					<?php
					}
				} ?>
				;

			<?php } ?>

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

<div id="map" style="width:100%; height:<?php echo $this->params->get( 'er_listmapheight');?>px"></div>
