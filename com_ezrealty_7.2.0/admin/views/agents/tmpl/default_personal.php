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

	<div class="control-group">
		<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_PROFILE_LINK' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?>"><?php echo JText::_('EZREALTY_PROFILE_LINK');?></div>
		<div class="controls"><?php echo $this->lists['uid']; ?> <span class="badge badge-warning"><?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?></span></div>
	</div>

	<div class="control-group">
		<div class="hasTip control-label" title="<?php echo JText::_( 'COM_EZREALTY_AGENT_NAME' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?>"><?php echo JText::_('COM_EZREALTY_AGENT_NAME');?></div>
		<div class="controls"><input class="input-large" type="text" name="seller_name" id="seller_name" value="<?php echo stripslashes($this->profile->seller_name); ?>" /> <span class="badge badge-warning"><?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?></span></div>
	</div>
	<div class="control-group">
		<div class="hasTip control-label" title="<?php echo JText::_( 'COM_EZREALTY_ALIAS' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?>"><?php echo JText::_('COM_EZREALTY_ALIAS');?></div>
		<div class="controls"><input class="input-large" type="text" name="alias" id="alias" value="<?php echo stripslashes($this->profile->alias); ?>" /> <span class="badge badge-warning"><?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?></span></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('COM_EZREALTY_JOB_TITLE');?></div>
		<div class="controls"><input class="input-large" type="text" name="job_title" id="job_title" value="<?php echo stripslashes($this->profile->job_title); ?>" /></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_PROFILE_COMPANY');?></div>
		<div class="controls"><input class="input-large" type="text" name="seller_company" id="seller_company" value="<?php echo stripslashes($this->profile->seller_company); ?>" /></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('COM_EZREALTY_AGENT_INTRO'); ?></div>
		<div class="controls"><textarea class="input-large" name="seller_info" id="seller_info" rows="3" maxlength="1024" onkeyup="return ismaxlength(this)"><?php echo stripslashes($this->profile->seller_info);?></textarea></div>
	</div>

<legend><?php echo JText::_('EZREALTY_MAIL_CONTACTDET');?></legend>

	<div class="control-group">
		<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_PROFILE_EMAIL' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?>"><?php echo JText::_('EZREALTY_PROFILE_EMAIL'); ?></div>
		<div class="controls"><input class="input-large" type="text" name="seller_email" id="seller_email" maxlength="60" value="<?php echo stripslashes($this->profile->seller_email); ?>" /> <span class="badge badge-warning"><?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?></span></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_PROFILE_PHONE'); ?></div>
		<div class="controls"><input class="input-large" type="text" name="seller_phone" id="seller_phone" maxlength="60" value="<?php echo stripslashes($this->profile->seller_phone); ?>" /></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_PROFILE_FAX'); ?></div>
		<div class="controls"><input class="input-large" type="text" name="seller_fax" id="seller_fax" maxlength="60" value="<?php echo stripslashes($this->profile->seller_fax); ?>" /></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_PROFILE_MOBILE'); ?></div>
		<div class="controls"><input class="input-large" type="text" name="seller_mobile" id="seller_mobile" maxlength="60" value="<?php echo stripslashes($this->profile->seller_mobile); ?>" /></div>
	</div>

