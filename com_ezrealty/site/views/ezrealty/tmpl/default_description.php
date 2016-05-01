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

?>

<div class="row-fluid">
	<div class="span12">

		<?php
		if ($this->params->def( 'er_parsing') == 1) {
			if ($this->ezrealty->propdesc) {
				echo EZRealtyFHelper::parseThruBots(stripslashes($this->ezrealty->propdesc));
			} else {
				echo EZRealtyFHelper::parseThruBots(stripslashes($this->ezrealty->smalldesc));
			}
		} else {
			if ($this->ezrealty->propdesc) {
				echo stripslashes($this->ezrealty->propdesc);
			} else {
				echo stripslashes($this->ezrealty->smalldesc);
			}
		}
		?>

	</div>
</div>
