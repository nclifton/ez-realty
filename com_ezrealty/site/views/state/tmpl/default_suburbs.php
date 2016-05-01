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

if ($this->params->get( 'show_suburbs_title' )){ ?>

	<div class="row-fluid">
		<div class="span12">
			<h2><span><?php echo $this->params->get( 'subs_title' );?><?php if($this->params->get('show_state_title') && $this->state->name) { ?> : <?php echo JHtml::_('content.prepare', $this->state->name); ?><?php } ?></span></h2>
		</div>
	</div>

<?php } ?>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
		<?php
		if(!empty($this->suburbs)){

			$cityname = "";

			foreach($this->suburbs as $key=>$suburb){
				if($suburb->ezcity){

					$cityname .= "<a href=\"". $suburb->link ."\" class=\"category". $this->escape($this->params->get( 'pageclass_sfx' )) ."\"><span class=\"ezitem-featpropertyprice ". $this->params->get( 'titlecolor' ) ."\">". $this->escape($suburb->ezcity) ."</span></a>, ";

				} else {
					
				}
			}

			$thecities = $cityname;
			$thecitieslist = rtrim($thecities, ', ');
			echo $thecitieslist;

		}
		?>	

	</div>
	</div>
</div>
