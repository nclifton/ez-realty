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

$category = $this->category;

// Include the component HTML helpers.
JHtml::_('behavior.tooltip');


JFilterOutput::objectHTMLSafe( $category );
$editor =& JFactory::getEditor();

?>

<script language="javascript" type="text/javascript">
	<!--
	function changeDisplayImage() {
		if (document.adminForm.image.value !='') {
			document.adminForm.imagelib.src='../images/' + document.adminForm.image.value;
		} else {
			document.adminForm.imagelib.src='images/blank.png';
		}
	}
	//-->
</script>

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
        	alert( "<?php echo JText::_('EZREALTY_CATEGORY_ERROR1');?>" );
			form.name.focus()
			return false

		} else {

			<?php $editor->save('description'); ?>

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
									<div class="controls"><input class="input-large" type="text" name="name" id="name" value="<?php echo stripslashes($category->name);?>"> <span class="badge badge-warning"><?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?></span></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo JText::_('COM_EZREALTY_ALIAS');?></div>
									<div class="controls"><input class="input-large" type="text" name="alias" id="alias" value="<?php echo stripslashes($category->alias);?>"> <span class="badge badge-warning"><?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?></span></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo JText::_('COM_EZREALTY_SELECTIMG');?></div>
									<div class="controls">
										<?php echo $this->lists['image']; ?>
									</div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo JText::_('COM_EZREALTY_PREVIEWIMG');?></div>
									<div class="controls">
										<?php if (preg_match("/swf/i", $category->image)) { ?>
											<img src="images/blank.png" name="imagelib" alt="" />
										<?php } elseif (preg_match("/gif|jpg|png/i", $category->image)) { ?>
											<img src="../images/<?php echo $category->image; ?>" name="imagelib" alt="<?php echo JText::_('COM_EZREALTY_PREVIEWIMG'); ?>" />
										<?php } else { ?>
											<img src="images/blank.png" name="imagelib" alt="" />
										<?php } ?>
									</div>
								</div>

							</div>
							<div class="span6">

								<legend><?php echo JText::_('EZREALTY_SEO_OPT');?></legend>

								<div class="control-group">
									<div class="control-label"><?php echo JText::_('EZREALTY_META_DESCRIPTION');?></div>
									<div class="controls"><textarea name="metadesc" id="metadesc" rows="5" class="input-large" maxlength="255" onkeyup="return ismaxlength(this)"><?php echo stripslashes($category->metadesc);?></textarea></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo JText::_('EZREALTY_META_KEYWORDS');?></div>
									<div class="controls"><textarea name="metakey" id="metakey" rows="5" class="input-large" maxlength="255" onkeyup="return ismaxlength(this)"><?php echo stripslashes($category->metakey);?></textarea></div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</fieldset>

			<legend><?php echo JText::_('COM_EZREALTY_DESCRIPTION');?></legend>

			<fieldset class="form-vertical">
				<div class="control-group">
					<div class="control-label"></div>
					<div class="controls">
						<?php
						// parameters : areaname, content, hidden field, width, height, rows, cols
						echo $editor->display('description', stripslashes($category->description), '100%', '300', '60', '20');
						?>
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
				<div class="control-group">
					<div class="control-group">
						<div class="controls">
							<?php echo stripslashes($category->name);?>
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
						<?php echo JText::_('COM_EZREALTY_ACCESS');?>
					</div>
					<div class="controls">
						<?php echo $this->glist?>
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

	<?php echo JHtml::_('form.token'); ?>

	<input type="hidden" name="applyFlag" value="0" />
	<input type="hidden" name="id" value="<?php echo $this->category->id; ?>" />
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="option" value="com_ezrealty" />
    <input type="hidden" name="controller" value="categories" /> 

</form>

		</div>
	</div>
</div>
