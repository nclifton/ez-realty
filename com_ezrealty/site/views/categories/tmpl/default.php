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


?>

<div class="container-fluid">

	<div class="row-fluid">
		<div class="span12">
			<?php if ( $this->params->get( 'show_page_heading' ) ) { ?>
				<h1 class="componentheading">
					<?php echo $this->escape($this->params->get('page_heading')); ?>
				</h1>
			<?php } ?>
		</div>
	</div>

	<div class="row-fluid">
		<?php if ($this->params->get( 'show_cats_spotlight' )){ ?>
			<div class="span6 category-left-centered">
		<?php } else { ?>
			<div class="span12 ">
		<?php } ?>

		<?php if (!$this->categories){ ?>

			<div class="alert alert-block">
				<a class="close" data-dismiss="alert" href="#">&times;</a>
				<h4 class="alert-heading"><?php echo JText::_('EZREALTY_NOLISTINGS');?></h4>
			</div>

		<?php } else { echo $this->loadTemplate('items'); } ?>

		</div>

		<?php if ($this->params->get( 'show_cats_spotlight' )){ ?>
			<div class="span6">

				<?php if (!$this->featured){ ?>

					<div class="alert alert-block">
						<a class="close" data-dismiss="alert" href="#">&times;</a>
						<h4 class="alert-heading"><?php echo JText::_('EZREALTY_NO_SPOTLIGHT');?></h4>
					</div>

				<?php } else { echo $this->loadTemplate('spotlight'); } ?>

			</div>
		<?php } ?>
	</div>

</div>

<?php
EZRealtyFHelper::EZPowered();
?>