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

if ($this->params->get( 'show_subs_spotlight' )){
	$colnum = 1;
	$spansize = 12;
	$imgspan = 4;
} else {
	$colnum = 2;
	$spansize = 6;
	$imgspan = 3;
}

if ($this->params->get( 'show_suburbs_title' )){ ?>

	<div class="row-fluid">
		<div class="span12">
			<h2><span><?php echo $this->params->get( 'subs_title' );?></span></h2>
		</div>
	</div>

<?php } ?>

<div class="container-fluid">
	<div class="row-fluid">
		<?php
			if(!empty($this->suburbs)):
				foreach($this->suburbs as $key=>$suburb):
					if($suburb->ezcity):
					?>

				<div class="span<?php echo $spansize;?> ezcat_stuff ezitem-toppad">
					<?php if ($suburb->image){ ?>
						<a href="<?php echo $suburb->link; ?>" class="category<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>">
							<img class="span<?php echo $imgspan;?> thumbnail ezcat_catimg" src="<?php echo JURI::root();?>images/<?php echo $suburb->image;?>" alt="" />
						</a>
					<?php } ?>

					<a href="<?php echo $suburb->link; ?>" class="category<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>">
						<div class="ezitem-bopad"><span class="ezitem-featpropertyprice <?php echo $this->params->get( 'titlecolor' );?>"><?php echo $this->escape($suburb->ezcity);?></span></div>
					</a>

							<div class="ezitem-toppad"><?php echo $suburb->ezcity_desc;?></div>

							<?php if ($this->params->get( 'show_subs_propcount' )){
								$thecount = EZRealtyFHelper::CountCont( $suburb->id, 2 );
								?>
								(<span class="ezcat_count"><?php echo $thecount; ?> <?php if ($thecount == 1) { echo JText::_('EZREALTY_COUNT_PROPERTY'); } else { echo JText::_('COM_EZREALTY_SUBMENU_PROPERTIES'); } ?></span>)
							<?php } ?>
				</div>

				<?php else: ?>
					</div><div class="span<?php echo $spansize;?> ezcat_stuff">
				<?php endif ;
				if(($key+1) % $colnum == 0):
				?>
				</div><div class="row-fluid">
				<?php 
				endif;
				?>
			<?php endforeach ;

			endif;

			?>	

	</div>
</div>


