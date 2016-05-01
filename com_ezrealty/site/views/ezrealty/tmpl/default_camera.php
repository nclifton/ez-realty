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

$document =& JFactory::getDocument();

$document->addStyleSheet("components/com_ezrealty/views/ezrealty/tmpl/camera/css/camera.css",'text/css',"screen");

?>

<?php if ( $this->params->get( 'disable_jquery' ) == 0 ){ ?>
	<script type="text/javascript" src="<?php echo JURI::root();?>/components/com_ezrealty/assets/jquery/jquery-1.8.3.min.js"></script>
<?php } ?>

<script type="text/javascript" src="<?php echo JURI::root();?>/components/com_ezrealty/views/ezrealty/tmpl/camera/scripts/jquery.mobile.customized.min.js"></script>
<script type="text/javascript" src="<?php echo JURI::root();?>/components/com_ezrealty/views/ezrealty/tmpl/camera/scripts/jquery.easing.1.3.js"></script> 
<script type="text/javascript" src="<?php echo JURI::root();?>/components/com_ezrealty/views/ezrealty/tmpl/camera/scripts/camera.min.js"></script> 
    
    
<script>
	jQuery.noConflict();
	jQuery(function(){
			
		jQuery('#ezr_camera_wrap').camera({
			height: '<?php echo $this->params->def( 'er_imgheight');?>px',
			pagination: false,
			thumbnails: true
		});
	});
</script>

<div class="row-fluid">

	<?php if ( $this->params->get( 'er_imglayoutwidth') ) { ?>
		<div class="span2">
		</div>
		<div class="span8">
	<?php } else { ?>
		<div class="span12">
	<?php } ?>

	<div class="camera_wrap camera_black_skin" id="ezr_camera_wrap">


	<?php

	$images = EZRealtyFHelper::getImagesById($this->ezrealty->id);

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

			<div data-thumb="<?php echo $thimgpath;?>/<?php echo $image->fname;?>" data-src="<?php echo $theimgpath;?>/<?php echo $image->fname;?>">
				<?php if ($image->title || $image->description){ ?>
					<div class="camera_caption fadeFromBottom">
						<?php echo $image->title;?><?php if ($image->title && $image->description){ ?><br /><?php echo $image->description;?><?php } ?>
					</div>
				<?php } ?>
			</div>

		<?php
		endforeach;
	endif;
	?>

</div>


	</div>

	<?php if ( $this->params->get( 'er_imglayoutwidth') ) { ?>
		<div class="span2">
		</div>
	<?php } ?>

</div>

