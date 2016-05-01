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

$itemid  = intval(JRequest::getVar( 'Itemid', ''));

if (!$this->params->get('butcolour')){
	$btncolour = "btn";
} else {
	$btncolour = $this->params->get('butcolour');
}

if (!$this->params->get('butsize')){
	$btnsize = "";
} else {
	$btnsize = $this->params->get('butsize');
}
if ($this->params->get('er_fieldsize')){
	$er_fieldsize = $this->params->get('er_fieldsize');
} else {
	$er_fieldsize = "span12";
}
if ($this->params->get('mailcolor')){
	$mailcolor = $this->params->get('mailcolor');
} else {
	$mailcolor = "mail-gold";
}

?>

<script type="text/javascript">
		<!--
		function validatemail() {
			var form = document.mailform;
			// do field validation
			if (form.name.value == "") {
				alert( "<?php echo JText::_('EZREALTY_EMAIL_ERROR1');?>" );
				form.name.focus()
				return false
			} else if (form.email.value == "") {
				alert( "<?php echo JText::_('EZREALTY_EMAIL_ERROR2');?>" );
				form.email.focus()
				return false
			} else if (form.message.value == "") {
				alert( "<?php echo JText::_('EZREALTY_EMAIL_ERROR9');?>" );
				form.message.focus()
				return false
			} else {
				document.mailform.action = '<?php echo $this->action ?>';
				document.mailform.submit();

			}
		}
		//-->
</script>

<br />

<div class="<?php echo $mailcolor;?> ez_mailheading"><?php echo JText::_('COM_EZREALTY_ENQUIRE');?></div>


	<div class="row-fluid">
		<div class="span12 ez-mailbody">

			<form class="ezrealtyform" name="mailform" action="<?php echo $this->action ?>" method="post">
				<input type="hidden" name="option" value="com_ezrealty" />
				<input type="hidden" name="task" value="sendmailform" />
				<input type="hidden" name="itemid" value="<?php echo $itemid;?>" />
				<input type="hidden" name="id" value="<?php echo $this->ezrealty->id;?>" />
				<input type="hidden" name="mid" value="<?php echo $this->ezrealty->owner;?>" />
				<input type="hidden" name="amid" value="<?php echo $this->ezrealty->assoc_agent;?>" />
				<input type="hidden" name="formtype" value="1" />

				<div class="ez-mailpad">

					<div class="row-fluid">
						<div class="span12">

							<div class="row-fluid">
								<div class="span4">
									<span style="font-size: 90%"><?php echo JText::_('EZREALTY_VIEWDET_VNAME');?></span> <span style="font-size: 80%">(<?php echo JText::_('EZREALTY_DETAILS_REQ');?>)</span><br />
									<input class="<?php echo $er_fieldsize;?>" type="text" name="name" id="name" maxlength="50" />
								</div>
								<div class="span4">
									<span style="font-size: 90%"><?php echo JText::_('EZREALTY_VIEWDET_VMAIL');?></span> <span style="font-size: 80%">(<?php echo JText::_('EZREALTY_DETAILS_REQ');?>)</span><br />
									<input class="<?php echo $er_fieldsize;?>" type="text" name="email" id="email" maxlength="50" />
								</div>
								<div class="span4">
									<span style="font-size: 90%"><?php echo JText::_('EZREALTY_VIEWDET_VPHONE');?></span><br />
									<input class="<?php echo $er_fieldsize;?>" type="text" name="dtelephone" id="dtelephone" maxlength="20" />
								</div>
							</div>

							<div class="row-fluid">
								<div class="span12">
									<span style="font-size: 90%"><?php echo JText::_('EZREALTY_SELLER_SMS10');?></span> <span style="font-size: 80%">(<?php echo JText::_('EZREALTY_DETAILS_REQ');?>)</span><br />
									<textarea class="<?php echo $er_fieldsize;?>" rows="3" name="message" id="message"></textarea>
								</div>
							</div>

							<?php if ($this->params->get('er_recaptcha')){
								if (JPluginHelper::isEnabled('captcha', 'recaptcha')) { ?>

									<div class="row-fluid">
										<div class="span12">
		
											<span style="font-size: 90%"><?php echo JText::_('COM_EZREALTY_CAPTCHA');?></span> <span style="font-size: 80%">(<?php echo JText::_('EZREALTY_DETAILS_REQ');?>)</span><br />
		
													<?php
													//php code
		
													JPluginHelper::importPlugin('captcha');
													$dispatcher = JDispatcher::getInstance();
													$dispatcher->trigger('onInit','dynamic_recaptcha_1');
		
													//html code inside form tag
													?>
											<div id="dynamic_recaptcha_1"></div>
		
										</div>
									</div>

								<?php }
							} ?>

							<div class="row-fluid">
								<div class="span12">
									<input class="<?php echo $btncolour.' '.$btnsize;?>" type="submit" name="<?php echo JText::_('EZREALTY_VIEWDET_SEND');?>" value="<?php echo JText::_('EZREALTY_VIEWDET_SEND');?>" onclick="validatemail()" />
									<input class="<?php echo $btncolour.' '.$btnsize;?>" type="reset" name="<?php echo JText::_( 'EZREALTY_RESET' ); ?>" value="<?php echo JText::_( 'EZREALTY_RESET' ); ?>" />
								</div>
							</div>


							<?php echo JHtml::_( 'form.token' ); ?>

						</div>
					</div>

				</div>

			</form>

		</div>

</div>

<br />
