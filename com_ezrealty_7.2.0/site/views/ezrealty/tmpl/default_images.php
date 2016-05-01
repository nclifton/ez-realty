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

if ($this->params->get( 'distortimg') && $this->params->get( 'thumbheight')){
	$theheight = "height: ".$this->params->get( 'thumbheight')."px;";
} else {
	$theheight = "";
}

if ($this->params->get('er_imgfilesys') == 1){

	// open in a modal window
	JHtml::_('behavior.modal', 'a.modal');

}

if ($this->params->get( 'er_thumbcols')){
	$thecols = $this->params->get( 'er_thumbcols');
} else {
	$thecols = "4";
}


if ($this->params->get( 'er_thumbcols') == 2){
	$thespan = "span6";
} else if ($this->params->get( 'er_thumbcols') == 3){
	$thespan = "span4";
} else if ($this->params->get( 'er_thumbcols') == 4){
	$thespan = "span3";
} else if ($this->params->get( 'er_thumbcols') == 6){
	$thespan = "span2";
} else {
	$thespan = "span3";
}

if ($this->params->get('er_imgfilesys') == 2){ ?>

<script type="text/javascript">
hs.graphicsDir = '<?php echo JURI::root(); ?>components/com_ezrealty/assets/highslide/graphics/'
hs.showCredits = false
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
hs.outlineType = 'rounded-white';
hs.fadeInOut = true;
hs.dimmingOpacity = 0.75;

// Add the controlbar
hs.addSlideshow({
	//slideshowGroup: 'group1',
	interval: 5000,
	repeat: false,
	useControls: true,
	fixedControls: 'fit',
	overlayOptions: {
		opacity: 0.75,
		position: 'bottom center',
		hideOnMouseOut: true
	}
});
</script>

<?php } ?>

<script type="text/javascript">

<!-- Begin
<?php

$images = EZRealtyFHelper::getImagesById($this->ezrealty->id);

if(!empty($images)):
	foreach($images as $key=>$image):

		if($image->fname){

			if ($image->fname && $image->path){
				$theimgpath = $image->path;
				$thimgpath = $image->path;
			} else {
				$theimgpath = JURI::root()."images/ezrealty/properties";
				$thimgpath = JURI::root()."images/ezrealty/properties/th";
			}

			?>
			var pic<?php echo $image->id ?> = new Image();
			pic<?php echo $image->id;?>.src = "<?php echo $theimgpath;?>/<?php echo $image->fname;?>";
			<?php
		}
	endforeach;
endif;
?>

function doButtons(picimage) {
eval("document['picture'].src = " + picimage + ".src");
}
//  End -->

</script>

<!--START IMAGE TABLE-->			

<div class="hidden-phone" align="center">

	<div class="row-fluid">

		<?php if ( $this->params->get( 'er_imglayoutwidth') ) { ?>
			<div class="span2">
			</div>
			<div class="span8">
		<?php } else { ?>
			<div class="span12">
		<?php } ?>

			<div id="ezitem-watermark_box" class="thumbnail" >

				<div style="max-height: <?php echo $this->params->get( 'er_imgheight');?>px; overflow: hidden;">

				<?php if ($images[0]->fname) {
	
					if ($images[0]->fname && $images[0]->path){
						$theimgpath = $images[0]->path;
					} else {
						$theimgpath = JURI::root()."images/ezrealty/properties";
					}
					?>
					<img class="span12 " src="<?php echo $theimgpath.'/'.$images[0]->fname;?>" name="picture" alt="<?php echo JText::_('EZREALTY_PIX_HOVER');?>" />
				<?php } else { ?>
					<img class="span12 " src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/nothumb.png" name="picture" alt="" />
				<?php }
				if ( $this->params->get( 'er_watermark') ) {

					if ( $this->ezrealty->soleAgency==1 ) { ?>

						<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/sole-agency_large.png" class="spotlight_watermark" alt="<?php echo JText::_('EZREALTY_SOLE_AGENCY');?>" />

					<?php } else {

						if ( $this->ezrealty->sold==5 ) { ?>
							<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/sold_large.png" class="main_watermark" alt="<?php echo JText::_('EZREALTY_DETAILS_MARKET5');?>" />
						<?php }
						if ( $this->ezrealty->sold==9 ) { ?>
							<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/leased_large.png" class="main_watermark" alt="<?php echo JText::_('EZREALTY_DETAILS_MARKET9');?>" />
						<?php }
						if ( $this->ezrealty->featured==1 && $this->ezrealty->sold!=5 && $this->ezrealty->sold!=9 ) { ?>
							<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/featured_large.png" class="main_watermark" alt="<?php echo $this->ezrealty->adline;?>" />
						<?php }
						if ( $this->ezrealty->type==4 && $this->ezrealty->featured!=1 && $this->ezrealty->sold!=5 && $this->ezrealty->sold!=9 ) { ?>
							<img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/auction_large.png" class="main_watermark" alt="<?php echo $this->ezrealty->adline;?>" />
						<?php }
					}
				} ?>

				</div>

			</div>

		</div>

		<?php if ( $this->params->get( 'er_imglayoutwidth') ) { ?>
			<div class="span2">
			</div>
		<?php } ?>

	</div>
<br />
	<div class="row-fluid">

		<?php if(!empty($images)):
			foreach($images as $key=>$image):
				if($image->fname): ?>

					<div class="<?php echo $thespan;?>">
						<?php if ($this->params->get('er_imgfilesys') == 2){ ?>
							<a onmouseover="doButtons('pic<?php echo $image->id;?>')" href="<?php echo $theimgpath;?>/<?php echo $image->fname;?>" class="highslide" title="<?php echo $image->description;?>" onclick="return hs.expand(this)">
							<img class="span12 thumbnail" src="<?php echo $thimgpath;?>/<?php echo $image->fname;?>" style="<?php echo $theheight;?>" alt="<?php echo $image->title;?>" />
						<?php } else { ?>
							<a class="modal" onmouseover="doButtons('pic<?php echo $image->id;?>')" href="<?php echo $theimgpath;?>/<?php echo $image->fname;?>" title="<?php echo $image->description;?>">
							<img class="span12 thumbnail" src="<?php echo $thimgpath;?>/<?php echo $image->fname;?>" style="<?php echo $theheight;?>" alt="<?php echo $image->title;?>" />
						<?php } ?>
						</a>
						<?php if ($this->params->get('er_imgfilesys') == 2){ ?>
							<div class="highslide-caption">
								<span style="font-weight: bold;"><?php echo $image->title;?></span><?php if ($image->description){ ?><br /><?php echo $image->description;?><?php } ?>
							</div>
						<?php } ?>
					</div>

				<?php else: ?>
					<div class="<?php echo $thespan;?>"> </div>
				<?php endif ;
				if(($key+1) % $thecols == 0): ?>
					</div><br /><div class="row-fluid">
				<?php  endif;
			endforeach ;
		endif; ?>	

	</div>

</div>

<div class="visible-phone" style="align: center; ">

	<div class="row-fluid">

		<?php if(!empty($images)):
			foreach($images as $key=>$image):
				if($image->fname): ?>

					<div class="12">
						<img class="span12 thumbnail" src="<?php echo $thimgpath;?>/<?php echo $image->fname;?>" alt="<?php echo $image->title;?>" />
					</div>

				<?php  endif;
			endforeach ;
		endif; ?>	

	</div>

</div>

<!--END IMAGE TABLE-->
