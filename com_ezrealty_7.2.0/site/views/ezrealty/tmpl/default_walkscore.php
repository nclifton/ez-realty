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

<script type='text/javascript'>
var ws_wsid = '<?php echo $this->params->get( 'er_wsapi' );?>';
var ws_lat="<?php echo $this->ezrealty->declat;?>";
var ws_lon="<?php echo $this->ezrealty->declong;?>";
var ws_width = '100%';
var ws_height = '<?php echo $this->params->def( 'er_mapheight');?>';
var ws_layout = 'vertical';
var ws_commute = 'true';
var ws_transit_score = 'true';
var ws_industry_type = "residential";
var ws_map_modules = 'all';
</script>

<style type='text/css'>
	#ws-walkscore-tile{position:relative;text-align:left}
	#ws-walkscore-tile *{float:none;}
	#ws-footer a,#ws-footer a:link{font:11px/14px Verdana,Arial,Helvetica,sans-serif;margin-right:6px;white-space:nowrap;padding:0;color:#000;font-weight:bold;text-decoration:none}
	#ws-footer a:hover{color:#777;text-decoration:none}
	#ws-footer a:active{color:#b14900}
</style>

<div id='ws-walkscore-tile'>
	<div id='ws-footer' style='position:absolute;top:426px;left:8px;width:100%'>
		<form id='ws-form'>
			<a id='ws-a' href='http://www.walkscore.com/' target='_blank'><?php echo JText::_('EZREALTY_WHATSYOUR_WALKSCORE');?></a>
			<input type='text' id='ws-street' style='position:absolute;top:0px;left:170px;width:386px' />
			<input type='image' id='ws-go' src='http://cdn2.walk.sc/images/tile/go-button.gif' height='15' width='22' border='0' alt='<?php echo JText::_('EZREALTY_GETMY_WALKSCORE');?>' style='position:absolute;top:0px;right:0px' />
		</form>
	</div>
</div>
<script type='text/javascript' src='http://www.walkscore.com/tile/show-walkscore-tile.php'></script>
