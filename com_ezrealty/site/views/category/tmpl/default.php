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

JHtml::_('behavior.framework');
JHtml::_('bootstrap.framework');

$user = JFactory::getUser();
$groups = implode(',', $user->getAuthorisedViewLevels());

$document	= & JFactory::getDocument();

$ezmapimg = $this->params->get( 'er_listmapheight');

// prepare the CSS
$ezmapcss = '/* styles to define the map replacement image */

.ezmap-wrap{
	max-height: '.$ezmapimg.'px;
    overflow: hidden;
    max-width: 800px;      
    -webkit-transition: max-width .5s ease-out;  /* Saf3.2+, Chrome */
    -moz-transition: max-width .5s ease-out;  /* FF4+ */
    -ms-transition: max-width .5s ease-out;  /* IE10? */
    -o-transition: max-width .5s ease-out;  /* Opera 10.5+ */
    transition: max-width .5s ease-out;
}

';
// add the CSS to the document
$document->addStyleDeclaration($ezmapcss);


if ( $this->params->get( 'which_pageclass' ) ) {
	$pagelass=$this->params->get( 'which_pageclass' );
} else {
	$pagelass="pagination";
}

?>

<div id="system" class="container-fluid">

	<div class="row-fluid">
		<div class="span12">

			<?php if ( $this->params->get( 'show_page_heading' ) ) { ?>
				<h1 class="componentheading">
					<?php echo $this->escape($this->params->get('page_heading')); ?>
				</h1>
			<?php } ?>

			<?php if($this->params->get('show_category_title')) { ?>
				<h2>
					<span>
						<?php echo JHtml::_('content.prepare', $this->category->name); ?>
					</span>
				</h2>
			<?php } ?>

			<?php if ($this->params->def('show_description') && $this->category->description || $this->params->def('show_description_image') && $this->category->image) { ?>
				<div class="category-desc">
					<?php if ($this->params->get('show_description_image') && $this->category->image) { ?>
						<img src="<?php echo $this->baseurl .'/'. 'images/'. $this->category->image;?>" align="<?php echo $this->params->get('catimg_align');?>" style="margin-bottom: 10px; margin-left: 10px; margin-right: 10px" alt="<?php echo $this->category->name;?>" />
					<?php } ?>
					<?php if ($this->params->get('show_description') && $this->category->description) { ?>
						<?php echo JHtml::_('content.prepare', $this->category->description); ?>
					<?php } ?>
				</div>
			<?php } ?>

		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">

			<form action="<?php echo JFilterOutput::ampReplace($this->action); ?>" method="post" id="adminForm" name="adminForm">

					<div class="row-fluid">
						<div class="span12 well">

							<div class="row-fluid">
								<div class="span8">

									<?php if ( $this->params->get( 'er_uselistmap' ) ){?>

										<?php if ( $this->params->get( 'er_usealtmap' ) == 2 ){
											echo $this->loadTemplate('map3');
										} else if ( $this->params->get( 'er_usealtmap' ) == 1 ){
											echo $this->loadTemplate('map2');
										} else {
											echo $this->loadTemplate('map');
										} ?>

									<?php } else { ?>
										<div class="ezmap-wrap">
											<img class="span12 thumbnail" src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/mapfill.jpg" alt="" />
										</div>
									<?php } ?>

								</div>
								<div class="span4">

									<?php echo $this->loadTemplate('filters'); ?>

								</div>
							</div>

							<?php if ( $this->params->get( 'er_uselistmap' ) && $this->params->get( 'er_usealtmap' ) < 2 ){?>
								<div class="row-fluid ezitem-toppad">
									<div class="span12">
										<?php echo EZRealtyFHelper::convertMapIcons(); ?>
									</div>
								</div>
							<?php } ?>

							<div class="row-fluid ezitem-toppad">
								<div class="span4">
									<?php if ($this->params->get('show_sort_list')) { ?>
										<?php echo stripslashes($this->lists['whatorder']);?>
									<?php } ?>
								</div>
								<div class="span8">
									<div class="display-limit" style="text-align: right;">
										<?php if ($this->params->get('show_pagination_limit')) { ?>
											<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>&#160; <?php echo stripslashes($this->lists['limit']);?>
										<?php } ?>
									</div>
								</div>
							</div>

						</div>
					</div>
<br />




				<div class="row-fluid">
					<div class="span12">

						<?php if (!$this->items){ ?>

							<div class="alert alert-block">
								<a class="close" data-dismiss="alert" href="#">&times;</a>
								<h4 class="alert-heading">
									<?php
									if (strpos($groups,$this->category->access) !== false) {
									    echo JText::_('EZREALTY_NOLISTINGS');
									} else {
									    echo JText::_('EZREALTY_NOACCESS_MESSAGE');
									}
									?>
								</h4>
							</div>

						<?php } else { echo $this->loadTemplate('items'); } ?>

					</div>
				</div>

				<div class="row-fluid">
					<div class="span12">
						<div class="<?php echo $pagelass;?>">
							<?php if ( $this->params->get( 'show_pagination_results' ) ) { ?>
								<p class="counter">
									<?php echo $this->pagination->getPagesCounter(); ?>
								</p>
							<?php } ?>
							<?php if ( $this->params->get( 'show_pagination' ) ) { ?>
								<?php echo $this->pagination->getPagesLinks(); ?>
							<?php } ?>
						</div>
					</div>
				</div>

			</form>

		</div>
	</div>
</div>

<?php
EZRealtyFHelper::EZPowered();
?>