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

$ezrparams = JComponentHelper::getParams ('com_ezrealty');

	/**
	 * the agentInfo field stores an array of agent details in the following order:-
	 *
	 * 1. agent name
	 * 2. job title
	 * 3. business telephone
	 * 4. mobile phone
	 * 5. fax number
	 * 6. company name
	 * 7. street address
	 * 8. suburb
	 * 9. state
	 * 10. postcode
	 * 11. email address
	 *
	 */


for($i=1; $i < 10+1; $i++){
	$myagentkey[$i]='';
}

if ($this->ezrealty->agentInfo) {
$agentkey = explode(";",$this->ezrealty->agentInfo);

$myagentkey1=$agentkey[0];
$myagentkey2=$agentkey[1];
$myagentkey3=$agentkey[2];
$myagentkey4=$agentkey[3];
$myagentkey5=$agentkey[4];
$myagentkey6=$agentkey[5];
$myagentkey7=$agentkey[6];
$myagentkey8=$agentkey[7];
$myagentkey9=$agentkey[8];
$myagentkey10=$agentkey[9];
$myagentkey11=$agentkey[10];

}

if ($myagentkey11){
	if(!EZRealtyFHelper::check_email($myagentkey11)) {
		$myagentkey11 = '';
	} else {

		$myagentkey11 = trim($myagentkey11);

		if (!empty($myagentkey11)) {
			$myagentkey11 = JHtml::_('email.cloak', $myagentkey11);
		} else {
			$myagentkey11 = '';
		}
	}
}


?>

	<br />
	<h2><?php echo JText::_('EZREALTY_MEMBERS_SELLERDET');?></h2>

	<div class="row-fluid">
		<div class="span12">

			<h3>
				<?php if ( $myagentkey1 ) { ?>
					<?php echo $myagentkey1;?>
				<?php } ?>
				<?php if ( $myagentkey2 ) { ?>
					 (<?php echo $myagentkey2;?>)
				<?php } ?>
			</h3><hr />

		</div>
	</div>

	<div class="row-fluid">
		<div class="span3">

			<?php if ( $myagentkey3 ) { ?>
				<?php echo JText::_('EZREALTY_PROFILE_PHONE');?>:&nbsp;<?php echo $myagentkey3;?><br />
			<?php } ?>
			<?php if ( $myagentkey4 ) { ?>
				<?php echo JText::_('EZREALTY_PROFILE_MOBILE2');?>:&nbsp;<?php echo $myagentkey4;?><br />
			<?php } ?>
			<?php if ( $myagentkey5 ) { ?>
				<?php echo JText::_('EZREALTY_PROFILE_FAX');?>:&nbsp;<?php echo $myagentkey5;?><br />
			<?php } ?>
			<?php if ( $myagentkey11 ) { ?>
				<?php echo $myagentkey11;?><br />
			<?php } ?>

		</div>
		<div class="span9">

			<?php if ( $myagentkey6 ) { ?>
				<strong><?php echo $myagentkey6;?></strong><br />
			<?php } ?>

			<?php if ( $myagentkey7 ) { ?><?php echo $myagentkey7;?><br /><?php } ?>

			<?php if ( $myagentkey8 ) { ?><?php echo $myagentkey8;?> <?php } ?>
			<?php if ( $myagentkey9 ) { ?><?php echo $myagentkey9;?> <?php } ?>
			<?php if ( $myagentkey10 ) { ?><?php echo $myagentkey10;?><?php } ?>

		</div>
	</div>
