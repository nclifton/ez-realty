<?php

/**
* @package EZ Realty
* @version 7.2.0
* @author  Kathy Strickland (aka PixelBunyiP) - Raptor Services <kathy@raptorservices.com>
* @link    http://www.raptorservices.com
* @copyright Copyright (C) 2006 - 2014 Raptor Developments Pty Ltd T/as Raptor Services-All rights reserved
* @license Creative Commons GNU GPL, see http://creativecommons.org/licenses/GPL/2.0/ for full license.
**/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

if (file_exists("components/com_jreviews/jreviews/models/everywhere/everywhere_com_ezrealty_property.php")){  
    # MVC initalization script
    if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);    
    require('components' . DS . 'com_jreviews' . DS . 'jreviews' . DS . 'framework.php');

    // Populate $JreParams array
    $JreParams['data']['extension'] = 'com_ezrealty_property';
    $JreParams['data']['tmpl_suffix'] = '';
    $JreParams['data']['controller'] = 'everywhere';
    $JreParams['data']['action'] = 'index';
    $JreParams['data']['listing_id'] = $this->ezrealty->id;
                           
    // Load dispatch class
    $Dispatcher = new S2Dispatcher('jreviews',true);

    $jreDetail = $Dispatcher->dispatch($JreParams);
    //echo $jreDetail['output']; // review form and reviews
    //echo $jreDetail['summary'];  // average rating stars
}

?>

<div class="row-fluid">
	<div class="span12">

		<!--START IMAGE TABLE-->

		<?php $images = EZRealtyFHelper::getImagesById($this->ezrealty->id);

		if (!$this->print){

			if (isset($images[1]->fname)) {

				echo $this->loadTemplate($this->params->get( 'er_imglayout' ) );

			} else {
				if(!EZRealtyFHelper::getTheImage($this->ezrealty->id) ){
					$image = JURI::root()."components/com_ezrealty/assets/images/noimage.png";
				} else {
					$image = EZRealtyFHelper::convertLmodImage ($this->ezrealty->id);
				}
			?>

				<div class="row-fluid">
			
					<?php if ( $this->params->get( 'er_imglayoutwidth') ) { ?>
						<div class="span2">
						</div>
						<div class="span8">
					<?php } else { ?>
						<div class="span12">
					<?php } ?>
			
						<img class="thumbnail span12" src="<?php echo $image;?>" name="picture" alt="" />
					</div>
			
					<?php if ( $this->params->get( 'er_imglayoutwidth') ) { ?>
						<div class="span2">
						</div>
					<?php } ?>
			
				</div>

			<?php } ?>

		<?php } else { ?>

			<!--START PRINT LAYOUT IMAGE-->			

			<div align="center">
			<?php

				if ($images[0]->fname) {

					if ($images[0]->fname && $images[0]->path){
						$theimgpath = $images[0]->path;
					} else {
						$theimgpath = JURI::root()."images/ezrealty/properties";
					}
					?>
					<img class="span12 thumbnail" src="<?php echo $theimgpath.'/'.$images[0]->fname;?>" style="width: 700px;" alt="" />
				<?php } else { ?>
					<img class="span12 thumbnail" src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/noimage.png" style="width: 700px;" alt="" />
				<?php } ?>
			</div>

			<!--END PRINT LAYOUT IMAGE-->
		
		<?php } ?>

	</div>
</div>

<?php if (!$this->print){ ?>
	<?php if ( $this->params->get( 'social_pinterest' ) || $this->params->get( 'social_tweet' ) || $this->params->get( 'social_gplus' ) || $this->params->get( 'social_facebook' ) ) { ?>
		<div class="row-fluid">
			<div class="span12">
				<span class="pull-right" style="padding-top: 15px;">
					<?php echo $this->loadTemplate('bookmarks'); ?>
				</span>
			</div>
		</div>
	<?php } ?>
<?php } ?>

<div class="row-fluid">
	<div class="span12">
		<h3><?php echo stripslashes($this->ezrealty->adline);?></h3>
	</div>
</div>


<?php if (!$this->print){ ?>

<div class="row-fluid">
	<div class="span12">

		<?php if ( $this->params->get( 'er_layout' ) == 1 ){
			echo $this->loadTemplate('sliders');
		} else if ( $this->params->get( 'er_layout' ) == 2 ){
			echo $this->loadTemplate('plain');
		} else {
			echo $this->loadTemplate('tabs');
		} ?>

	</div>
</div>

<?php } else { ?>

<div class="row-fluid">
	<div class="span12">

		<?php echo $this->loadTemplate('sysprint'); ?> <!-- /.tabbed information output -->

	</div>
</div>

<?php } ?>

<?php if ( $this->params->get( 'er_walkscore' ) && $this->params->get( 'er_wsapi' ) && $this->ezrealty->declat && $this->ezrealty->declong && $this->ezrealty->viewad ) { ?>

	<div class="row-fluid">
		<div class="span12">

			<br />
			<h2><?php echo JText::_('COM_EZREALTY_AMENITIES_TITLE');?></h2>

			<?php echo $this->loadTemplate('walkscore'); ?>
		</div>
	</div>

<?php } else { ?>

	<?php if ($this->params->get( 'er_usemap') && $this->ezrealty->declat && $this->ezrealty->declong && $this->ezrealty->viewad ) { ?>
		<div class="row-fluid">
			<div class="span12">

				<?php if ( $this->params->get( 'er_usealtmap' ) == 2 ){
					echo $this->loadTemplate('map3');
				} else if ( $this->params->get( 'er_usealtmap' ) == 1 ){
					echo $this->loadTemplate('map2');
				} else {
					echo $this->loadTemplate('map');
				} ?>

			</div>
		</div>
	<?php } ?>

<?php } ?>

<?php if ( $this->params->get( 'er_useprofile')){ ?>

	<?php if ($this->ezrealty->agentInfo ) { ?>

		<div class="row-fluid">
			<div class="span12">
				<?php echo $this->loadTemplate('mlsagent'); ?> <!-- /.mls import agent output -->
			</div>
		</div>

	<?php } else { ?>

		<div class="row-fluid">
			<div class="span12">

				<br />
				<h2><?php echo JText::_('EZREALTY_MEMBERS_SELLERDET');?></h2>

				<?php if ($this->params->get( 'er_proflayout') == 1 ) { ?>
					<?php echo $this->loadTemplate('profiletwo'); ?> <!-- /.2 column profile output -->
				<?php } else { ?>
					<?php echo $this->loadTemplate('profileone'); ?> <!-- /.1 column profile output -->
				<?php } ?>

			</div>
		</div>

	<?php } ?>

<?php } ?>

<?php if ( !$this->print && !$this->ezrealty->agentInfo && $this->params->get( 'er_viewarrange' ) ){ ?>

	<div class="row-fluid">
		<div class="span12">

			<!-- /.mail form -->
			<?php if ($this->params->get( 'er_formtype' )){
				echo $this->loadTemplate('mailform');
			} else {
				echo $this->loadTemplate('bizmailform');
			}
			?>

		</div>
	</div>

<?php } ?>

<?php if (file_exists("components/com_jreviews/jreviews/models/everywhere/everywhere_com_ezrealty_property.php")) { ?>

	<div class="row-fluid">
		<div class="span12">

			<?php echo $jreDetail['output']; ?> <!-- /.jReviews form -->

		</div>
	</div>

<?php } ?>
