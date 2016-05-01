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

// Include the component HTML helpers.
JHtml::_('behavior.tooltip');

JFilterOutput::objectHTMLSafe( $this->state );
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

		if (form.name.value == ""){
        	alert( "<?php echo JText::_('EZREALTY_STATE_ERROR1');?>" );
			form.name.focus()
			return false

			<?php if ( $this->ezrparams->get( 'er_country' ) == 1 ) { ?>

				} else if (form.countid.value == "0"){
				alert( "<?php echo JText::_('EZREALTY_DETAILS_ERROR4');?>" );
				form.countid.focus()
				return false

			<?php } ?>

		} else {

			document.adminForm.action = "index.php";
			document.adminForm.submit();

		}
	}
	//-->
</script>

<script type="text/javascript">
	<!--
	function ismaxlength(obj){
		var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
		if (obj.getAttribute && obj.value.length>mlength)
		obj.value=obj.value.substring(0,mlength)
	}
	//-->
</script>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">

<form action="index.php?option=com_ezrealty" method="post" name="adminForm" id="adminForm" class="form-validate form-horizontal">
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

						<div class="control-group">
							<div class="control-label"><?php echo JText::_('COM_EZREALTY_TITLE');?></div>
							<div class="controls"><input class="input-xlarge" type="text" name="name" id="name" size="25" value="<?php echo stripslashes($this->state->name);?>"> <span class="badge badge-warning"><?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?></span></div>
						</div>
						<div class="control-group">
							<div class="control-label"><?php echo JText::_('COM_EZREALTY_ALIAS');?></div>
							<div class="controls"><input class="input-xlarge" type="text" name="alias" id="alias" value="<?php echo stripslashes($this->state->alias);?>"> <span class="badge badge-warning"><?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?></span></div>
						</div>

<?php if ( $this->ezrparams->get( 'er_country' ) == 1 ) { ?>

						<div class="control-group">
							<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_SELCOUNTRY');?></div>
							<div class="controls"><?php echo $this->lists['countlist']; ?> <span class="badge badge-warning"><?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?></span></div>
						</div>

<?php } ?>

						<?php if ($this->ezrparams->get( 'er_usemap' ) ) { ?>
							<div class="control-group">
								<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_LISTINGS_OWNCOORDS' ); ?>::<?php echo JText::_( 'EZREALTY_LISTINGS_OWNCOORDS_DESC' ); ?>"></div>
								<div class="controls"><?php echo JText::_('EZREALTY_LISTINGS_OWNCOORDS'); ?><br />
									<fieldset id="owncoords" class="radio btn-group">
										<input type="radio" id="owncoords0" name="owncoords" value="0" <?php if ($this->state->owncoords=='0'){ echo " checked=CHECKED "; } ?> />
										<label for="owncoords0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
										<input type="radio" id="owncoords1" name="owncoords" value="1" <?php if ($this->state->owncoords=='1'){ echo " checked=CHECKED "; } ?> />
										<label for="owncoords1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
									</fieldset>
								</div>
							</div>
							<div class="control-group">
								<div class="control-label"> </div>
								<div class="controls">
									<table>
										<tr>
											<td class="nowrap">
												<input class="input-small" type="text" name="declat" id="declat" maxlength="25" value="<?php echo stripslashes($this->state->declat);?>" /><br />
												<?php echo JText::_( 'EZREALTY_DETAILS_DECLAT' ); ?>
											</td>
											<td>
												<input class="input-small" type="text" name="declong" id="declong" maxlength="25" value="<?php echo stripslashes($this->state->declong);?>" /><br />
												<?php echo JText::_( 'EZREALTY_DETAILS_DECLONG' ); ?>
											</td>
										</tr>
									</table>
								</div>
							</div>
						<?php } ?>

							</div>
							<div class="span6">

								<legend><?php echo JText::_('EZREALTY_SEO_OPT');?></legend>

								<div class="control-group">
									<div class="control-label"><?php echo JText::_('EZREALTY_META_DESCRIPTION');?></div>
									<div class="controls"><textarea name="metadesc" id="metadesc" rows="5" class="input-large" maxlength="255" onkeyup="return ismaxlength(this)"><?php echo stripslashes($this->state->metadesc);?></textarea></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo JText::_('EZREALTY_META_KEYWORDS');?></div>
									<div class="controls"><textarea name="metakey" id="metakey" rows="5" class="input-large" maxlength="255" onkeyup="return ismaxlength(this)"><?php echo stripslashes($this->state->metakey);?></textarea></div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</fieldset>

			<?php echo JHtml::_('form.token'); ?>
		</div>
	<!-- End Main Content -->
	<!-- Begin Sidebar -->
		<div class="span3">
			<h4><?php echo JText::_('JDETAILS');?></h4>
			<hr />
			<fieldset class="form-vertical">
				<div class="control-group">
					<div class="control-group">
						<div class="controls">
							<?php echo stripslashes($this->state->name);?>
						</div>
					</div>
					<div class="control-label">
						<?php echo JText::_( 'JSTATUS' );?>
					</div>
					<div class="controls">
						<?php echo $this->lists['published']; ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo JText::_('COM_EZREALTY_ORDERING');?>
					</div>
					<div class="controls">
						<?php echo $this->lists['orderlist']; ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo JText::_( 'EZREALTY_LANGUAGE' );?>
					</div>
					<div class="controls">
						<?php echo $this->lists['language']; ?>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">
					
					</div>
					<div class="controls">
						<input type="button" name="<?php echo JText::_('COM_EZREALTY_SAVE') ?>" value="<?php echo JText::_('COM_EZREALTY_SAVE') ?>" class="btn-large btn-primary" onclick="updatedoc(0)" />
						<input type="button" name="<?php echo JText::_('apply') ?>" value="<?php echo JText::_('COM_EZREALTY_APPLY') ?>" class="btn-large btn-primary" onclick="updatedoc(1)" />
					</div>
				</div>

			</fieldset>
		</div>
	<!-- End Sidebar -->
	</div>

	<input type="hidden" name="applyFlag" value="0" />
	<input type="hidden" name="id" value="<?php echo $this->state->id; ?>" />
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="option" value="com_ezrealty" />
    <input type="hidden" name="controller" value="states" /> 

</form>

		</div>
	</div>
</div>
