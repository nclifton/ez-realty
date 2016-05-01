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

$itemid  = intval(JRequest::getVar( 'Itemid', ''));

$thebookmark  = JURI::root() . 'index.php?option=com_ezrealty&view=ezrealty&id='.$this->ezrealty->slug.'&cid='.$this->ezrealty->catslug.'&Itemid='.$itemid;
$encbookmark = htmlentities(urlencode($thebookmark));

$pindesc = htmlentities(rawurlencode(stripslashes($this->ezrealty->adline)));

if(!EZRealtyFHelper::getTheImage($this->ezrealty->id) ){
	$pinimage = "";
} else {
	$pinimage = htmlentities(urlencode(EZRealtyFHelper::convertFeedImage ($this->ezrealty->id)));
}

?>

<?php if (!$this->print && $this->params->get( 'social_facebook' ) == 1){ ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php } ?>

<?php if (!$this->print){ ?>

	<?php if ( $this->params->get( 'social_tweet' ) == 1 ){ ?>
		<div class="ezimageBox">
			<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-via="twitterapi" data-lang="en"><?php echo JText::_('EZREALTY_TWEET');?></a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	<?php } ?>
	<?php if ( $this->params->get( 'social_gplus' ) == 1 ){ ?>
		<div class="ezimageBox">

			<!-- Place this tag where you want the +1 button to render -->
			<g:plusone size="medium" annotation="none"></g:plusone>

			<!-- Place this render call where appropriate -->
			<script type="text/javascript">
			  (function() {
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		 	   po.src = 'https://apis.google.com/js/plusone.js';
		 	   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
		</div>
	<?php } ?>
	<?php if ($this->params->get( 'social_pinterest' ) == 1 && $pinimage){ ?>
		<div class="ezimageBox">

			<a href="//www.pinterest.com/pin/create/button/?url=<?php echo $encbookmark;?>&media=<?php echo $pinimage;?>&description=<?php echo $pindesc;?>" data-pin-do="buttonPin" data-pin-config="none" data-pin-color="red"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" /></a>

			<?php if ( !$this->params->get( 'disable_pinjs' ) ){ ?>
				<!-- Please call pinit.js only once per page -->
				<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
			<?php } ?>

		</div>
	<?php } ?>
	<?php if ( $this->params->get( 'social_facebook' ) == 1 ){ ?>
		<div class="ezimageBox">
			<div class="fb-like" data-href="<?php echo $thebookmark;?>" data-send="true" data-layout="button_count" data-width="450" data-show-faces="false"></div>
		</div>
	<?php } ?>



<?php } else { } ?>
