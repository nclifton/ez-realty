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

$ezimgwidth = $this->params->def( 'er_imgwidth');
$ezimgheight = $this->params->def( 'er_imgheight');
$ezgalwidth = $ezimgwidth + '50';
$ezgalheight = $ezimgheight + '100';

$document->addStyleSheet("components/com_ezrealty/views/ezrealty/tmpl/minimalist/css/style.css",'text/css',"screen");

// prepare the CSS
$ezmingalcss = '/* styles to define the minimalist gallery and image window size */

.msg_slideshow{
    width: 100%;
    height: '.$ezgalheight.'px;
	margin-top:5px;
	padding:10px;
	position:relative;
	overflow:hidden;
	background:#101010 url(../icons/loading.gif) no-repeat center center;
	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	border-radius:10px;
}

.msg_wrapper{
    width: 100%;
    height: '.$ezgalheight.'px;
	position:relative;
	margin:0;
	padding:0;
	padding-top: 50px; !Important /* add some top padding for IE browsers because of middle alignment problems */
	display:table-cell;
	text-align:center;
	vertical-align:middle;
}

';
// add the CSS to the document
$document->addStyleDeclaration($ezmingalcss);

?>

<div class="row-fluid">

	<?php if ( $this->params->get( 'er_imglayoutwidth') ) { ?>
		<div class="span2">
		</div>
		<div class="span8">
	<?php } else { ?>
		<div class="span12">
	<?php } ?>

	<div id="msg_slideshow" class="msg_slideshow">
		<div id="msg_wrapper" class="msg_wrapper"></div>

		<div id="msg_controls" class="msg_controls"><!-- right has to animate to 15px, default -110px -->
			<a href="#" id="msg_grid" class="msg_grid"></a>
			<a href="#" id="msg_prev" class="msg_prev"></a>
			<a href="#" id="msg_pause_play" class="msg_pause"></a><!-- has to change to msg_play if paused-->
			<a href="#" id="msg_next" class="msg_next"></a>
		</div>
		<div id="msg_thumbs" class="msg_thumbs"><!-- top has to animate to 0px, default -230px -->

			<?php

			$images = EZRealtyFHelper::getImagesById($this->ezrealty->id);
			if(!empty($images)):
			?>

				<div class="msg_thumb_wrapper">

				<?php
				foreach($images as $key=>$image):
					if($image->fname):

						if ($image->fname && $image->path){
							$theimgpath = $image->path;
							$thimgpath = $image->path;
						} else {
							$theimgpath = JURI::root()."images/ezrealty/properties";
							$thimgpath = JURI::root()."images/ezrealty/properties/th";
						}

						?>

						<a href="#"><img src="<?php echo $thimgpath;?>/<?php echo $image->fname;?>" alt="<?php echo $theimgpath;?>/<?php echo $image->fname;?>" width="75" height="75"/></a>

					<?php endif ;
					if(($key+1) % 6 == 0):
					?>
						</div><div class="msg_thumb_wrapper" style="display:none;">
					<?php endif;?>
				<?php endforeach;?>	

				</div>
			<?php endif;?>


			<a href="#" id="msg_thumb_next" class="msg_thumb_next"></a>
			<a href="#" id="msg_thumb_prev" class="msg_thumb_prev"></a>
			<a href="#" id="msg_thumb_close" class="msg_thumb_close"></a>
			<span class="msg_loading"></span><!-- show when next thumb wrapper loading -->
		</div>

	</div>

	<div class="gen-1"></div>

	</div>

	<?php if ( $this->params->get( 'er_imglayoutwidth') ) { ?>
		<div class="span2">
		</div>
	<?php } ?>

</div>


        <!-- The JavaScript -->

<?php if ( $this->params->get( 'disable_jquery' ) == 0 ){ ?>
		<script type="text/javascript" src="components/com_ezrealty/assets/jquery/jquery-1.8.3.min.js"></script>
<?php } ?>
        <script type="text/javascript">
		jQuery.noConflict();

// <![CDATA[
            jQuery(function() {
				/**
				* interval : time between the display of images
				* playtime : the timeout for the setInterval function
				* current  : number to control the current image
				* current_thumb : the index of the current thumbs wrapper
				* nmb_thumb_wrappers : total number	of thumbs wrappers
				* nmb_images_wrapper : the number of images inside of each wrapper
				*/
				var interval			= 4000;
				var playtime;
				var current 			= 0;
				var current_thumb 		= 0;
				var nmb_thumb_wrappers	= jQuery('#msg_thumbs .msg_thumb_wrapper').length;
				var nmb_images_wrapper  = 6;
				/**
				* start the slideshow
				*/
				play();
				
				/**
				* show the controls when 
				* mouseover the main container
				*/
				slideshowMouseEvent();
				function slideshowMouseEvent(){
					jQuery('#msg_slideshow').unbind('mouseenter')
									   .bind('mouseenter',showControls)
									   .andSelf()
									   .unbind('mouseleave')
									   .bind('mouseleave',hideControls);
					}
				
				/**
				* clicking the grid icon,
				* shows the thumbs view, pauses the slideshow, and hides the controls
				*/
				jQuery('#msg_grid').bind('click',function(e){
					hideControls();
					jQuery('#msg_slideshow').unbind('mouseenter').unbind('mouseleave');
					pause();
					jQuery('#msg_thumbs').stop().animate({'top':'0px'},500);
					e.preventDefault();
				});
				
				/**
				* closing the thumbs view,
				* shows the controls
				*/
				jQuery('#msg_thumb_close').bind('click',function(e){
					showControls();
					slideshowMouseEvent();
					jQuery('#msg_thumbs').stop().animate({'top':'-230px'},500);
					e.preventDefault();
				});
				
				/**
				* pause or play icons
				*/
				jQuery('#msg_pause_play').bind('click',function(e){
					var $this = jQuery(this);
					if($this.hasClass('msg_play'))
						play();
					else
						pause();
					e.preventDefault();	
				});
				
				/**
				* click controls next or prev,
				* pauses the slideshow, 
				* and displays the next or prevoius image
				*/
				jQuery('#msg_next').bind('click',function(e){
					pause();
					next();
					e.preventDefault();
				});
				jQuery('#msg_prev').bind('click',function(e){
					pause();
					prev();
					e.preventDefault();
				});
				
				/**
				* show and hide controls functions
				*/
				function showControls(){
					jQuery('#msg_controls').stop().animate({'right':'15px'},500);
				}
				function hideControls(){
					jQuery('#msg_controls').stop().animate({'right':'-110px'},500);
				}
				
				/**
				* start the slideshow
				*/
				function play(){
					next();
					jQuery('#msg_pause_play').addClass('msg_pause').removeClass('msg_play');
					playtime = setInterval(next,interval)
				}
				
				/**
				* stops the slideshow
				*/
				function pause(){
					jQuery('#msg_pause_play').addClass('msg_play').removeClass('msg_pause');
					clearTimeout(playtime);
				}
				
				/**
				* show the next image
				*/
				function next(){
					++current;
					showImage('r');
				}
				
				/**
				* shows the previous image
				*/
				function prev(){
					--current;
					showImage('l');
				}
				
				/**
				* shows an image
				* dir : right or left
				*/
				function showImage(dir){
					/**
					* the thumbs wrapper being shown, is always 
					* the one containing the current image
					*/
					alternateThumbs();
					
					/**
					* the thumb that will be displayed in full mode
					*/
					var $thumb = jQuery('#msg_thumbs .msg_thumb_wrapper:nth-child('+current_thumb+')')
								.find('a:nth-child('+ parseInt(current - nmb_images_wrapper*(current_thumb -1)) +')')
								.find('img');
					if($thumb.length){
						var source = $thumb.attr('alt');
						var $currentImage = jQuery('#msg_wrapper').find('img');
						if($currentImage.length){
							$currentImage.fadeOut(function(){
								jQuery(this).remove();
								jQuery('<img />').load(function(){
									var $image = jQuery(this);
									resize($image);
									$image.hide();
									jQuery('#msg_wrapper').empty().append($image.fadeIn());
								}).attr('src',source);
							});
						}
						else{
							jQuery('<img />').load(function(){
									var $image = jQuery(this);
									resize($image);
									$image.hide();
									jQuery('#msg_wrapper').empty().append($image.fadeIn());
							}).attr('src',source);
						}
								
					}
					else{ //this is actually not necessary since we have a circular slideshow
						if(dir == 'r')
							--current;
						else if(dir == 'l')
							++current;	
						alternateThumbs();
						return;
					}
				}
				
				/**
				* the thumbs wrapper being shown, is always 
				* the one containing the current image
				*/
				function alternateThumbs(){
					jQuery('#msg_thumbs').find('.msg_thumb_wrapper:nth-child('+current_thumb+')')
									.hide();
					current_thumb = Math.ceil(current/nmb_images_wrapper);
					/**
					* if we reach the end, start from the beggining
					*/
					if(current_thumb > nmb_thumb_wrappers){
						current_thumb 	= 1;
						current 		= 1;
					}	
					/**
					* if we are at the beggining, go to the end
					*/					
					else if(current_thumb == 0){
						current_thumb 	= nmb_thumb_wrappers;
						current 		= current_thumb*nmb_images_wrapper;
					}
					
					jQuery('#msg_thumbs').find('.msg_thumb_wrapper:nth-child('+current_thumb+')')
									.show();	
				}
				
				/**
				* click next or previous on the thumbs wrapper
				*/
				jQuery('#msg_thumb_next').bind('click',function(e){
					next_thumb();
					e.preventDefault();
				});
				jQuery('#msg_thumb_prev').bind('click',function(e){
					prev_thumb();
					e.preventDefault();
				});
				function next_thumb(){
					var $next_wrapper = jQuery('#msg_thumbs').find('.msg_thumb_wrapper:nth-child('+parseInt(current_thumb+1)+')');
					if($next_wrapper.length){
						jQuery('#msg_thumbs').find('.msg_thumb_wrapper:nth-child('+current_thumb+')')
										.fadeOut(function(){
											++current_thumb;
											$next_wrapper.fadeIn();									
										});
					}
				}
				function prev_thumb(){
					var $prev_wrapper = jQuery('#msg_thumbs').find('.msg_thumb_wrapper:nth-child('+parseInt(current_thumb-1)+')');
					if($prev_wrapper.length){
						jQuery('#msg_thumbs').find('.msg_thumb_wrapper:nth-child('+current_thumb+')')
										.fadeOut(function(){
											--current_thumb;
											$prev_wrapper.fadeIn();									
										});
					}				
				}
				
				/**
				* clicking on a thumb, displays the image (alt attribute of the thumb)
				*/
				jQuery('#msg_thumbs .msg_thumb_wrapper > a').bind('click',function(e){
					var $this 		= jQuery(this);
					jQuery('#msg_thumb_close').trigger('click');
					var idx			= $this.index();
					var p_idx		= $this.parent().index();
					current			= parseInt(p_idx*nmb_images_wrapper + idx + 1);
					showImage();
					e.preventDefault();
				}).bind('mouseenter',function(){
					var $this 		= jQuery(this);
					$this.stop().animate({'opacity':1});
				}).bind('mouseleave',function(){
					var $this 		= jQuery(this);	
					$this.stop().animate({'opacity':0.5});
				});
				
				/**
				* resize the image to fit in the container (400 x 400)
				*/
				function resize($image){
					var theImage 	= new Image();
					theImage.src 	= $image.attr("src");
					var imgwidth 	= theImage.width;
					var imgheight 	= theImage.height;
					
					var containerwidth  = <?php echo $this->params->def( 'er_imgwidth');?>;
					var containerheight = <?php echo $this->params->def( 'er_imgheight');?>;
                
					if(imgwidth	> containerwidth){
						var newwidth = containerwidth;
						var ratio = imgwidth / containerwidth;
						var newheight = imgheight / ratio;
						if(newheight > containerheight){
							var newnewheight = containerheight;
							var newratio = newheight/containerheight;
							var newnewwidth =newwidth/newratio;
							theImage.width = newnewwidth;
							theImage.height= newnewheight;
						}
						else{
							theImage.width = newwidth;
							theImage.height= newheight;
						}
					}
					else if(imgheight > containerheight){
						var newheight = containerheight;
						var ratio = imgheight / containerheight;
						var newwidth = imgwidth / ratio;
						if(newwidth > containerwidth){
							var newnewwidth = containerwidth;
							var newratio = newwidth/containerwidth;
							var newnewheight =newheight/newratio;
							theImage.height = newnewheight;
							theImage.width= newnewwidth;
						}
						else{
							theImage.width = newwidth;
							theImage.height= newheight;
						}
					}
					$image.css({
						'width'	:theImage.width,
						'height':theImage.height
					});
				}
            });
// ]]>
        </script>

