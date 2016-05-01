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

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

$editor =& JFactory::getEditor();

JFilterOutput::objectHTMLSafe( $this->profile );

?>

<script type="text/javascript">

	<!--

	function applyFlag() {
		var form = document.adminForm;
		updatedoc(1);
	}

	function updatedoc(view) {

		var form = document.adminForm;

		form.applyFlag.value = view;

		// do field validation

		if (form.seller_name.value == "") {
			alert( "<?php echo JText::_('COM_EZPORTAL_ERROR3');?>" );
			form.seller_name.focus()
			return false

		} else if (form.seller_suburb.value == ""){
			alert( "<?php echo JText::_('COM_EZPORTAL_ERROR4');?>" );
			form.seller_suburb.focus()
			return false

		} else if (form.seller_email.value == ""){
			alert( "<?php echo JText::_('COM_EZPORTAL_ERROR5');?>" );
			form.seller_email.focus()
			return false

		} else if (form.uid.value == "0"){
			alert( "<?php echo JText::_('COM_EZPORTAL_ERROR12');?>" );
			form.uid.focus()
			return false

		} else {

			document.adminForm.action = "index.php?option=com_ezrealty&controller=agents";
			document.adminForm.submit();

		}
	}
	//-->
</script>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">

<form action="index.php?option=com_ezrealty&controller=agents" method="post" name="adminForm" id="adminForm" class="form-validate form-horizontal" enctype="multipart/form-data">
	<div class="row-fluid">
		<!-- Begin Main Content -->
		<div class="span9">
			<fieldset>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#details" data-toggle="tab"><?php echo JText::_('JDETAILS');?></a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="details">

						<div class="row-fluid">
							<div class="span6">

								<?php echo $this->loadTemplate('personal'); ?>

							</div>
							<div class="span6">

								<?php echo $this->loadTemplate('address'); ?>

							</div>
						</div>

						<div class="row-fluid">
							<div class="span12">

								<?php echo $this->loadTemplate('media'); ?>

							</div>
						</div>


					</div>

				</div>
			</fieldset>

		</div>
	<!-- End Main Content -->
	<!-- Begin Sidebar -->
		<div class="span3">
			<h4><?php echo JText::_('JDETAILS');?></h4>
			<hr />
			<fieldset class="form-vertical">

				<?php echo $this->loadTemplate('publishing'); ?>

			</fieldset>
		</div>
	<!-- End Sidebar -->
	</div>

	<input type="hidden" name="applyFlag" value="0" />
	<input type="hidden" name="id" value="<?php echo $this->profile->id; ?>" />
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="option" value="com_ezrealty" />
    <input type="hidden" name="controller" value="agents" /> 

</form>

		</div>
	</div>
</div>

