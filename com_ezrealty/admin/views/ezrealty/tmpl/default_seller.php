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

?>

<?php if ($this->property->id > 0 && !$this->property->owner && $this->property->agentInfo){ ?>

	<h4><?php echo JText::_('COM_EZREALTY_EXTERNAL_AGENT_DESC');?></h4><hr />

<?php

for($i=1; $i < 10+1; $i++){
	$myagentkey[$i]='';
}

if ($this->property->agentInfo) {
$agentkey = explode(";",$this->property->agentInfo);

echo JText::_('COM_EZREALTY_AGENT_NAME')." - ".$agentkey[0]."<br />";
echo JText::_('COM_EZREALTY_JOB_TITLE')." - ".$agentkey[1]."<br />";
echo JText::_('COM_EZREALTY_BUSINESS_TELEPHONE')." - ".$agentkey[2]."<br />";
echo JText::_('EZREALTY_CONFIG_MOBILE')." - ".$agentkey[3]."<br />";
echo JText::_('EZREALTY_CONFIG_FAX')." - ".$agentkey[4]."<br />";
echo JText::_('COM_EZREALTY_COMPANY_NAME')." - ".$agentkey[5]."<br />";
echo JText::_('EZREALTY_CONFIG_STREETAD')." - ".$agentkey[6]."<br />";
echo JText::_('EZREALTY_SEARCHSUB')." - ".$agentkey[7]."<br />";
echo JText::_('EZREALTY_CONFIG_BIZSTATE')." - ".$agentkey[8]."<br />";
echo JText::_('EZREALTY_CONFIG_BIZPC')." - ".$agentkey[9]."<br />";
echo JText::_('EZREALTY_CONFIG_EMAIL')." - ".$agentkey[10]."<br />";

}

?>
<br /><br />

<?php } else { ?>

		<div class="control-group">
			<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_SOLE_AGENCY' ); ?>::<?php echo JText::_( 'EZREALTY_SOLE_AGENCY_DESC' ); ?>"><?php echo JText::_('EZREALTY_SOLE_AGENCY'); ?></div>
			<div class="controls">
				<fieldset id="soleAgency" class="radio btn-group">
					<input type="radio" id="soleAgency0" name="soleAgency" value="0" <?php if ($this->property->soleAgency=='0'){ echo " checked=CHECKED "; } ?> />
					<label for="soleAgency0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
					<input type="radio" id="soleAgency1" name="soleAgency" value="1" <?php if ($this->property->soleAgency=='1'){ echo " checked=CHECKED "; } ?> />
					<label for="soleAgency1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
				</fieldset>
			</div>
		</div>

	<div class="control-group">
		<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_DEALER_SELLER' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?>"><?php echo JText::_('EZREALTY_DEALER_SELLER');?></div>
		<div class="controls"><?php echo $this->lists['owner'];?></div>
	</div>

	<?php if ( $this->ezrparams->get( 'er_usesecondary' ) ) { ?>
		<div class="control-group">
			<div class="control-label"><?php echo JText::_('EZREALTY_DEALER_ASSOC');?></div>
			<div class="controls"><?php echo $this->lists['assoc_agent'];?>  <?php echo JText::_('EZREALTY_DETAILS_OPT');?></div>
		</div>
	<?php } ?>

<?php } ?>
