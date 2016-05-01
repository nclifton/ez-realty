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

$document	= & JFactory::getDocument();

if ( $this->params->get( 'disable_jquery' ) == 0 ){
	$document->addScript("components/com_ezrealty/assets/jquery/jquery-1.8.3.min.js");
}

$document->addScript("components/com_ezrealty/views/ezrealty/tmpl/galleria129/galleria-1.2.9.min.js");


$ezgalwidth = $this->params->def( 'er_imgwidth');
$ezgalheight = $this->params->def( 'er_imgheight');

// prepare the CSS
$ezmingalcss = '/* styles to define the minimalist gallery and image window size */

/* This rule is read by Galleria to define the gallery height: */

#galleria{
	height: '.$ezgalheight.'px;
}
body .galleria-layer{background:rgba(255,0,0,0.3);}

@media only screen and (min-width: 768px) and (max-width: 1200px) {
    #galleria { '.$ezgalheight.'px; }
}

@media only screen and (min-width: 410px) and (max-width: 600px) {
    #galleria { max-height: 300px; }
}

@media only screen and (max-width: 400px) {
    #galleria { max-height: 220px; }
}


';
// add the CSS to the document
$document->addStyleDeclaration($ezmingalcss);

$images = EZRealtyFHelper::getImagesById($this->ezrealty->id);

?>

<div class="row-fluid">

	<?php if ( $this->params->get( 'er_imglayoutwidth') ) { ?>
		<div class="span2">
		</div>
		<div class="span8">
	<?php } else { ?>
		<div class="span12">
	<?php } ?>


		<div id="galleria">

			<?php

			if(!empty($images)):
				foreach($images as $key=>$image):

					if ($image->fname && $image->path){
						$theimgpath = $image->path;
						$thimgpath = $image->path;
					} else {
						$theimgpath = JURI::root()."images/ezrealty/properties";
						$thimgpath = JURI::root()."images/ezrealty/properties/th";
					}

					?>

					<a href="<?php echo $theimgpath;?>/<?php echo $image->fname;?>">
                		<img 
                    		src="<?php echo $thimgpath;?>/<?php echo $image->fname;?>",
                    		data-big="<?php echo $theimgpath;?>/<?php echo $image->fname;?>"
                    		data-title="<?php echo $image->title;?>"
                    		data-description="<?php echo $image->description;?>"
                		>
					</a>

				<?php
				endforeach;
			endif;
			?>

		</div>

	<script>


	// Load the classic theme
	Galleria.loadTheme('<?php echo JURI::root();?>components/com_ezrealty/views/ezrealty/tmpl/galleria129/themes/classic/galleria.classic.min.js');


	// Initialize Galleria
	Galleria.run('#galleria');

	Galleria.configure({
		lightbox:true,
		imageCrop:true,
		preload: 5,
		transition: 'flash',
		transitionSpeed: 600,
		showCounter:true,

	});


	Galleria.ready(function() {

		var gallery = this,
		show = true;
		jQuery('#toggle').click(function(e) {
			gallery.jQuery('thumbnails').animate({
				bottom: show ? -50 : 0
			});
			gallery.jQuery('stage').animate({
				bottom: show ? 10 : 60
			},{
				step: function() {
					gallery.rescale();
				}
			});
			show = !show;
		});

	});

	</script>

	<script type="text/javascript">
		jQuery.noConflict();
	</script>

	</div>

	<?php if ( $this->params->get( 'er_imglayoutwidth') ) { ?>
		<div class="span2">
		</div>
	<?php } ?>

</div>
<br /><br />