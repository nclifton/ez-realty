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

$session = & JFactory::getSession();

JHtml::_('behavior.tooltip');
JHtml::_('behavior.modal');

$ezrparams = JComponentHelper::getParams ('com_ezrealty');

$lists = $this->lists;
$editor =& JFactory::getEditor();
$property = $this->property;

JFilterOutput::objectHTMLSafe( $property );

?>

<script src="<?php echo JURI::root();?>components/com_ezrealty/assets/animatedcollapse.js" type="text/javascript" language="javascript"></script>

<link rel="stylesheet" href="<?php echo JURI::root(); ?>administrator/components/com_ezrealty/assets/style.css" type="text/css" />

<link rel="stylesheet" href="<?php echo JURI::root(); ?>components/com_ezrealty/assets/swfupload/swfupload/style.css" type="text/css" />
<script src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/swfupload/swfupload/swfupload.js" type="text/javascript" language="javascript"></script>
<script src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/swfupload/jquery.swfupload.js" type="text/javascript" language="javascript"></script>

<script type="text/javascript" language="javascript">
jQuery.noConflict();

function updateImageTitle(id, el){
	jQuery.ajax({
	   type: "POST",
	   url: "index.php",	
	   data: "option=com_ezrealty&controller=ezrealty&task=updateImageTitle&id="+id+"&value="+el.value,   
	   success: function(html){	    	
	  	}
	});
}

function updateImageDescription(id, el){
	jQuery.ajax({
	   type: "POST",
	   url: "index.php",	
	   data: "option=com_ezrealty&controller=ezrealty&task=updateImageDescription&id="+id+"&value="+el.value,   
	   success: function(html){	    	
	  	}
	});
}

function deleteImageListing(id, imgName,el){	
	jQuery.ajax({
	   type: "POST",
	   url: "index.php",	
	   data: "option=com_ezrealty&controller=ezrealty&task=deleteImageListing&id="+id+"&imageName="+imgName,   
	   success: function(html){
		   if(html==1){			
			   jQuery(el).parent().parent().fadeOut('slow');				   
			}	    	
	  	}
	});
}

function orderup(id, el){	
	jQuery.ajax({
	   type: "POST",
	   url: "index.php",	
	   data: "option=com_ezrealty&controller=ezrealty&task=orderup&id="+id+"&value="+el.value,   
	   success: function(html){	 
		   if(html){
			   document.location.reload();
			}      	
	  	}
	});
}

function orderdown(id, el){	
	jQuery.ajax({
	   type: "POST",
	   url: "index.php",	
	   data: "option=com_ezrealty&controller=ezrealty&task=orderdown&id="+id+"&value="+el.value,   
	   success: function(html){	 
		   if(html){
			   document.location.reload();
			}      	
	  	}
	});
}



jQuery(function(){
	jQuery('#swfupload-control').swfupload({
			upload_url: "<?php echo JURI::base();?>index.php",
			file_post_name: 'imagelisting',
			post_params : {
				"option" 		: "com_ezrealty",
				"controller" 	: "ezrealty",
				"task" 			: "uploadListingImage",
				"cid"			: <?php echo intval($this->property->id) ?>,
				"<?php echo $session->getName() ?>" : "<?php echo $session->getId() ?>",
                "format" 		: "raw"
			},
			preserve_relative_urls : true,
			file_size_limit : "5120",
			file_types : "*.jpg;*.png;*.gif",
			file_types_description : "Image files",
			file_upload_limit : <?php echo intval($ezrparams->get( 'max_images') - count($this->property->images))?> ,
			flash_url : "<?php echo JURI::root(); ?>components/com_ezrealty/assets/swfupload/swfupload/swfupload.swf",
			button_image_url : '<?php echo JURI::root(); ?>components/com_ezrealty/assets/swfupload/swfupload/wdp_buttons_upload_114x29.png',
			button_width : 114,
			button_height : 29,
			button_placeholder : jQuery('#button')[0],						
			debug: false
		})

		.bind('fileQueued', function(event, file){
			var listitem='<li id="'+file.id+'" >'+
				'File: <em>'+file.name+'</em> ('+Math.round(file.size/1024)+' KB) <span class="progressvalue" ></span>'+
				'<div class="row-fluid"><div class="span6 form-horizontal"><div class="progressbar" ><div class="progress" ></div></div></div><div class="span3 form-horizontal">'+
				'<button type="button" class="btn btn-success upload btn-large"><i class="icon-upload icon-white"></i> <span>Start upload</span></button></div><div class="span3 form-horizontal">'+
				'<button type="button" class="btn btn-warning cancel btn-large"><i class="icon-ban-circle icon-white"></i> <span>Cancel upload</span></button></div></div></div>'+
				'<p class="status" >Pending</p>'+
				'</li>';
			jQuery('#log').append(listitem);
			jQuery('li#'+file.id+' .cancel').bind('click', function(){
				var swfu = jQuery.swfupload.getInstance('#swfupload-control');
				swfu.cancelUpload(file.id);
				jQuery('li#'+file.id).slideUp('fast');
			});
			jQuery('li#'+file.id+' .upload').bind('click', function(){
				var swfu = jQuery.swfupload.getInstance('#swfupload-control');
				var listingId = <?php echo intval($this->property->id) ?>;
				if(listingId == 0){
					alert('<?php echo JText::_('EZREALTY_SAVE_FIRST');?>');
					return false;
				}
				swfu.startUpload(file.id);				
			});					
		})
		.bind('fileQueueError', function(event, file, errorCode, message){
			if(!file) alert('<?php echo JText::_('EZREALTY_MAXIMGS_REACHED');?>');
			else alert('Size of the file '+file.name+' is greater than limit');
		})
		.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){
			jQuery('#queuestatus').text('Files Selected: '+numFilesSelected+' / Queued Files: '+numFilesQueued);			
		})
		.bind('uploadStart', function(event, file){
			jQuery('#log li#'+file.id).find('p.status').text('Uploading...');
			jQuery('#log li#'+file.id).find('span.progressvalue').text('0%');
			jQuery('#log li#'+file.id).find('span.cancel').hide();
			jQuery('#log li#'+file.id).find('span.upload').hide();
		})
		.bind('uploadProgress', function(event, file, bytesLoaded){
			//Show Progress
			var percentage=Math.round((bytesLoaded/file.size)*100);
			jQuery('#log li#'+file.id).find('div.progress').css('width', percentage+'%');
			jQuery('#log li#'+file.id).find('span.progressvalue').text(percentage+'%');
		})
		.bind('uploadSuccess', function(event, file, serverData){
			var item=jQuery('#log li#'+file.id);
			item.find('div.progress').css('width', '100%');
			item.find('span.progressvalue').text('100%');
			var pathtofile='<a class="modal" href="<?php echo JURI::root()?>images/ezrealty/properties/'+serverData.split('filenameuploaded=')[1]+'" target="_blank" >view &raquo;</a>';
			item.addClass('success').find('p.status').html('Image uploaded !!! | '+pathtofile);				
			var imageDataString = serverData.split('fileuploaded=');	
			imageData = jQuery.parseJSON(imageDataString[1]);
			if(imageData){
				var newImage  = '<tr>';
					newImage +=		'<td width="100px" valign="middle" align="center" style="padding: 5px;">';
					newImage +=			'<a class="modal" title="Open full size image" href="<?php echo JURI::root() ?>images/ezrealty/properties/'+imageData.filenameuploaded+'">';
					newImage +=				'<img width="100px" alt="" src="<?php echo JURI::root() ?>images/ezrealty/properties/th/'+imageData.filenameuploaded+'">';
					newImage +=			'</a>';
					newImage +=		'</td>';
					newImage +=		'<td><input class="inputbox" type="text" size="35" maxlength="70" onchange="updateImageTitle('+imageData.id+', this);" /></td>';
					newImage +=		'<td><textarea onchange="updateImageDescription('+imageData.id+', this);" rows="2" cols="12"></textarea></td>';
					newImage +=		'<td valign="middle" align="center">';
					newImage +=			'<span><a class="btn btn-micro " href="javascript:void(0);" onclick="orderup('+imageData.id+', this);" title="Move up"><i class="icon-uparrow"></i></a></span> ';
					newImage +=			'<span><a class="btn btn-micro " href="javascript:void(0);" onclick="orderdown('+imageData.id+', this);" title="Move down"><i class="icon-downarrow"></i></a></span> ';
					newImage +=			'<input type="text" name="order[]" size="5" value="'+imageData.ordering+'"  class="input-mini" style="text-align: center" readonly />';
					newImage +=		'</td>';
					newImage +=		'<td valign="middle" align="center">';
					newImage +=		'<button type="button" class="btn btn-danger delete btn-large" onclick="deleteImageListing('+imageData.id+', \''+imageData.filenameuploaded+'\',this)">';
					newImage +=		'<i class="icon-trash icon-white"></i>';
					newImage +=		'<span><?php echo JText::_('EZREALTY_VLDET_DELETE')?></span>';
					newImage +=		'</button>';
					newImage +=		'</td>';
					newImage +=	'</tr>';		
				jQuery('table#imagesListing').append(newImage);

				// upload has completed, try the next one in the queue
				jQuery(this).swfupload('startUpload');	

			}					
		})
		.bind('uploadComplete', function(event, file){
			// upload has completed, try the next one in the queue
			//jQuery(this).swfupload('startUpload');	
			jQuery('#log li#'+file.id).fadeOut('slow');				
			//jQuery('html, body').animate({scrollTop:jQuery('#log').position().top}, 'slow');
		});

});	

</script>


<?php if ( $ezrparams->get( 'er_stateloc' ) == 1 && $ezrparams->get( 'er_country' ) == 1 ) { ?>

	<script language="javascript" type="text/javascript">
		<!--
		var countstates = new Array;
		<?php
		$i = 0;
		foreach ($lists['countstates'] as $k=>$items) {
			foreach ($items as $v) {
				echo "countstates[".$i++."] = new Array( '$k','".addslashes( $v->value )."','".addslashes( $v->text )."' );\n\t\t";
			}
		}
		?>
		//-->
    </script>

    <script language="javascript" type="text/javascript">
		<!--
		var statelocs = new Array;
		<?php
		$i = 0;
		foreach ($lists['statelocs'] as $k=>$items) {
			foreach ($items as $v) {
				echo "statelocs[".$i++."] = new Array( '$k','".addslashes( $v->value )."','".addslashes( $v->text )."' );\n\t\t";
			}
		}
		?>
		//-->
    </script>

<?php } 

if ( $ezrparams->get( 'er_stateloc' ) == 1 && !$ezrparams->get( 'er_country' ) ) {

?>

    <script language="javascript" type="text/javascript">
		<!--
		var statelocs = new Array;
		<?php
		$i = 0;
		foreach ($lists['statelocs'] as $k=>$items) {
			foreach ($items as $v) {
				echo "statelocs[".$i++."] = new Array( '$k','".addslashes( $v->value )."','".addslashes( $v->text )."' );\n\t\t";
			}
		}
		?>
		//-->
    </script>

<?php } 

if ( $ezrparams->get( 'er_country' ) && $ezrparams->get( 'er_stateloc' ) == 2 ) {

?>

    <script language="javascript" type="text/javascript">
		<!--
		var statelocs = new Array;
		<?php
		$i = 0;
		foreach ($lists['statelocs'] as $k=>$items) {
			foreach ($items as $v) {
				echo "statelocs[".$i++."] = new Array( '$k','".addslashes( $v->value )."','".addslashes( $v->text )."' );\n\t\t";
			}
		}
		?>
		//-->
    </script>

<?php } ?>


<script type="text/javascript">
	<!--
	function ismaxlength(obj){
		var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
		if (obj.getAttribute && obj.value.length>mlength)
		obj.value=obj.value.substring(0,mlength)
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

		if (form.cid.value == "") {
			alert( "<?php echo JText::_('EZREALTY_DETAILS_ERROR6');?>" );
			form.cid.focus()
			return false

<?php if ($ezrparams->get( 'er_country' ) ) { ?>

		} else if (form.cnid.value == "0" && form.country.value == "") {
			alert( "<?php echo JText::_('EZREALTY_DETAILS_ERROR4');?>" );
			form.cnid.focus()
			return false

<?php }
if ( $ezrparams->get( 'er_stateloc' ) == 1 ) { ?>

		} else if (form.stid.value == "0" && form.state.value == "") {
			alert( "<?php echo JText::_('EZREALTY_DETAILS_ERROR3');?>" );
			form.stid.focus()
			return false

<?php }
if ( $ezrparams->get( 'er_stateloc' ) > 0 ) { ?>

		} else if (form.locid.value == "0" && form.locality.value == ""){
			alert( "<?php echo JText::_('EZREALTY_DETAILS_ERROR2');?>" );
			form.locid.focus()
			return false

<?php }
if ( $ezrparams->get( 'er_usepc' ) ) { ?>

		} else if (form.postcode.value == "") {
			alert( "<?php echo JText::_('EZREALTY_DETAILS_ERROR5');?>" );
			form.postcode.focus()
			return false

<?php }
if ( $ezrparams->get( 'er_currencycontrol' ) == 1 ) { ?>

		} else if (form.currency.value == "0") {
			alert( "<?php echo JText::_('EZREALTY_CURRENCY_ERROR');?>" );
			form.currency.focus()
			return false

<?php } ?>

		} else if (form.price.value == "") {
			alert( "<?php echo JText::_('EZREALTY_DETAILS_ERROR8');?>" );
			form.price.focus()
			return false

		} else if (form.adline.value == "") {
			alert( "<?php echo JText::_('EZREALTY_DETAILS_ERROR10');?>" );
			form.adline.focus()
			return false

		} else if (form.smalldesc.value == "") {
			alert( "<?php echo JText::_('EZREALTY_DETAILS_ERROR11');?>" );
			form.smalldesc.focus()
			return false

		} else if (form.type.value == "0") {
			alert( "<?php echo JText::_('EZREALTY_TRANSTYPE_ERROR');?>" );
			form.type.focus()
			return false

<?php if ( $ezrparams->get( 'er_usemarket' ) ) { ?>

		} else if (form.sold.value == ""){
			alert( "<?php echo JText::_('EZREALTY_SOLD_ERROR');?>" );
			form.sold.focus()
			return false

<?php } ?>

<?php if (!$this->property->id || $this->property->owner || !$this->property->agentInfo){ ?>

		} else if (form.owner.value == "0"){
			alert( "<?php echo JText::_('EZREALTY_ADDOWNER_ERROR');?>" );
			form.owner.focus()
			return false

<?php } ?>

		} else {

			<?php $editor->save('propdesc'); ?>

			document.adminForm.action = "index.php";
			document.adminForm.submit();

		}
	}
	//-->
</script>



<script type="text/javascript">

animatedcollapse.addDiv('bspecdet', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('lndbldg', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('buscom', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('useland', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('useutil', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('usefees', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('useparking', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('businfo', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('ruraldet', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('useschools', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('usegenres', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('useynfeat', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('useapfeat', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('usecustspec', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('useohouse', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('useauc', 'fade=1,speed=400,group=events,persist=1,hide=1')
animatedcollapse.addDiv('userent', 'fade=1,speed=400,group=events,persist=1,hide=1')

animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
}

animatedcollapse.init()

</script>


<div class="container-fluid">

	<div class="row-fluid">
		<div class="span12">

			<form action="index.php?option=com_ezrealty" method="post" name="adminForm" id="adminForm" class="form-validate form-horizontal" enctype="multipart/form-data">

				<div class="row-fluid">
					<!-- Begin Main Content -->
					<div class="span9">
			
						<ul class="nav nav-tabs">
							<li class="active"><a href="#overview" data-toggle="tab"><?php echo JText::_('EZREALTY_DETAILS_OVERVIEW');?></a></li>
							<li><a href="#sales" data-toggle="tab"><?php echo JText::_('EZREALTY_DETAILS_SALES');?></a></li>

							<?php if ($ezrparams->get( 'er_genres' ) || $ezrparams->get( 'er_useschools' ) || $ezrparams->get( 'er_customspecs' ) || $ezrparams->get( 'er_useynfeat' ) || $ezrparams->get( 'use_appliancefeats' ) || $ezrparams->get( 'use_indoorfeats' ) || $ezrparams->get( 'use_outdoorfeats' ) || $ezrparams->get( 'use_buildingfeats' ) || $ezrparams->get( 'use_communityfeats' ) || $ezrparams->get( 'use_otherfeats' ) ) { ?>
								<li><a href="#extra" data-toggle="tab"><?php echo JText::_('EZREALTY_DETAILS_EXTRA');?></a></li>
							<?php } ?>
							<?php if ($ezrparams->get( 'er_ohinfo' ) || $ezrparams->get( 'er_aucinfo' ) || $ezrparams->get( 'er_usetype2' ) || $ezrparams->get( 'use_realtybookings' )) { ?>
								<li><a href="#events" data-toggle="tab"><?php echo JText::_('EZREALTY_DETAILS_EVENTS');?></a></li>
							<?php } ?>
							<?php if ($ezrparams->get( 'er_useflplupload' ) || $ezrparams->get( 'er_useepcupload' ) || $ezrparams->get( 'er_usepdfupload' ) || $ezrparams->get( 'er_usepanorama' ) || $ezrparams->get( 'er_useflv' )) { ?>
								<li><a href="#resources" data-toggle="tab"><?php echo JText::_('EZREALTY_MARKETING_RESOURCES');?></a></li>
							<?php } ?>
							<?php if ($ezrparams->get( 'er_useadministrative' ) || $ezrparams->get( 'er_meta' )) { ?>
								<li><a href="#theadmins" data-toggle="tab"><?php echo JText::_('EZREALTY_DETAILS_GENADMINDET');?></a></li>
							<?php } ?>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="overview">
			
								<div class="row-fluid">
									<div class="span6">
										<?php echo $this->loadTemplate('address'); ?>
									</div>
									<div class="span6">

										<?php if ($ezrparams->get( 'er_usebasespecs' ) ) { ?>
											<?php echo $this->loadTemplate('basespecs'); ?>
										<?php } ?>

										<?php if ($ezrparams->get( 'er_useparking' ) ) { ?>
											<?php echo $this->loadTemplate('parking'); ?>
										<?php } ?>

									</div>
								</div>

								<?php if ($ezrparams->get( 'er_usebldg' ) || $ezrparams->get( 'er_usebsmt' ) || $ezrparams->get( 'er_useland' )) { ?>
									<div class="row-fluid">
										<div class="span12 btn btn-small" style="text-align: left; font-size: 18px;">
											<a href="#" rel="toggle[lndbldg]" data-openimage="<?php echo JURI::root();?>components/com_ezrealty/assets/images/down-arrow.png" data-closedimage="<?php echo JURI::root();?>components/com_ezrealty/assets/images/right-arrow.png"><div style="width: 100%;"><img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/right-arrow.png" border="0" /> <?php echo JText::_('EZREALTY_TABS_LANDBLDG');?></div></a>
										</div>
									</div>
									<div id="lndbldg" class="row-fluid">
										<div class="span12">
											<br />
											<br />
											<div class="row-fluid">
												<div class="span6">
													<?php if ($ezrparams->get( 'er_usebldg' ) ) { ?>
														<?php echo $this->loadTemplate('building'); ?>
													<?php } ?>
												</div>
												<div class="span6">
													<?php if ($ezrparams->get( 'er_usebsmt' ) ) { ?>
														<?php echo $this->loadTemplate('bandf'); ?>
													<?php } ?>
													<?php if ($ezrparams->get( 'er_useland' ) ) { ?>
														<?php echo $this->loadTemplate('landinfo'); ?>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>

								<?php if ($ezrparams->get( 'er_businfo' )) { ?>
									<div class="row-fluid">
										<div class="span12 btn btn-small" style="text-align: left; font-size: 18px;">
											<a href="#" rel="toggle[buscom]" data-openimage="<?php echo JURI::root();?>components/com_ezrealty/assets/images/down-arrow.png" data-closedimage="<?php echo JURI::root();?>components/com_ezrealty/assets/images/right-arrow.png"><div style="width: 100%;"><img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/right-arrow.png" border="0" /> <?php echo JText::_('EZREALTY_DETAILS_BUSINESS');?></div></a>
										</div>
									</div>
									<div id="buscom" class="row-fluid">
										<div class="span12">
											<br />
											<br />
											<?php if ($ezrparams->get( 'er_businfo' ) ) { ?>
												<?php echo $this->loadTemplate('business'); ?>
											<?php } ?>
										</div>
									</div>
								<?php } ?>

								<?php if ($ezrparams->get( 'er_ruralinfo' )) { ?>
									<div class="row-fluid">
										<div class="span12 btn btn-small" style="text-align: left; font-size: 18px;">
											<a href="#" rel="toggle[ruraldet]" data-openimage="<?php echo JURI::root();?>components/com_ezrealty/assets/images/down-arrow.png" data-closedimage="<?php echo JURI::root();?>components/com_ezrealty/assets/images/right-arrow.png"><div style="width: 100%;"><img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/right-arrow.png" border="0" /> <?php echo JText::_('EZREALTY_DETAILS_RURAL');?></div></a>
										</div>
									</div>
									<div id="ruraldet" class="row-fluid">
										<div class="span12">
											<br />
											<br />
											<?php if ($ezrparams->get( 'er_ruralinfo' ) ) { ?>
												<?php echo $this->loadTemplate('rural'); ?>
											<?php } ?>
										</div>
									</div>
								<?php } ?>

								<?php if ($ezrparams->get( 'er_useutil' ) || $ezrparams->get( 'er_usefees' )) { ?>
									<div class="row-fluid">
										<div class="span12 btn btn-small" style="text-align: left; font-size: 18px;">
											<a href="#" rel="toggle[usefees]" data-openimage="<?php echo JURI::root();?>components/com_ezrealty/assets/images/down-arrow.png" data-closedimage="<?php echo JURI::root();?>components/com_ezrealty/assets/images/right-arrow.png"><div style="width: 100%;"><img src="<?php echo JURI::root();?>components/com_ezrealty/assets/images/right-arrow.png" border="0" /> <?php echo JText::_('EZREALTY_MISCFEES_COSTS');?></div></a>
										</div>
									</div>
									<div id="usefees" class="row-fluid">
										<div class="span12">
											<br />
											<br />
											<div class="row-fluid">
												<div class="span6">
													<?php if ($ezrparams->get( 'er_useutil' ) ) { ?>
														<?php echo $this->loadTemplate('utilities'); ?>
													<?php } ?>
												</div>
												<div class="span6">
													<?php if ($ezrparams->get( 'er_usefees' ) ) { ?>
														<?php echo $this->loadTemplate('fees'); ?>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>

							</div>

							<div class="tab-pane" id="sales">
								<div class="row-fluid">
									<div class="span6">
										<?php echo $this->loadTemplate('pricing'); ?>
									</div>
									<div class="span6">
										<?php echo $this->loadTemplate('salescopy'); ?>
										<?php if ($ezrparams->get( 'er_currencycontrol' ) ) { ?><?php echo $this->loadTemplate('currency'); ?><?php } ?>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12">
										<?php echo $this->loadTemplate('description'); ?>
									</div>
								</div>
							</div>

							<?php if ($ezrparams->get( 'er_genres' ) || $ezrparams->get( 'er_useschools' ) || $ezrparams->get( 'er_customspecs' ) || $ezrparams->get( 'er_useynfeat' ) || $ezrparams->get( 'use_appliancefeats' ) || $ezrparams->get( 'use_indoorfeats' ) || $ezrparams->get( 'use_outdoorfeats' ) || $ezrparams->get( 'use_buildingfeats' ) || $ezrparams->get( 'use_communityfeats' ) || $ezrparams->get( 'use_otherfeats' ) ) { ?>
								<div class="tab-pane" id="extra">
									<div class="row-fluid">
										<div class="span6">
											<?php if ($ezrparams->get( 'er_useschools' ) ) { ?>
												<?php echo $this->loadTemplate('schools'); ?>
											<?php } ?>
											<?php if ($ezrparams->get( 'er_genres' ) ) { ?>
												<?php echo $this->loadTemplate('genres'); ?>
											<?php } ?>
											<?php if ($ezrparams->get( 'er_useynfeat' ) ) { ?>
												<?php echo $this->loadTemplate('ynfeatures'); ?>
											<?php } ?>
											<?php if ($ezrparams->get( 'er_customspecs' ) ) { ?>
												<?php echo $this->loadTemplate('custom'); ?>
											<?php } ?>
										</div>
										<div class="span6">
											<?php if ($ezrparams->get( 'use_appliancefeats' ) || $ezrparams->get( 'use_indoorfeats' ) || $ezrparams->get( 'use_outdoorfeats' ) || $ezrparams->get( 'use_buildingfeats' ) || $ezrparams->get( 'use_communityfeats' ) || $ezrparams->get( 'use_otherfeats' ) ) { ?>
												<?php echo $this->loadTemplate('features'); ?>
											<?php } ?>
										</div>
									</div>
								</div>
							<?php } ?>

							<?php if ($ezrparams->get( 'er_ohinfo' ) || $ezrparams->get( 'er_aucinfo' ) || $ezrparams->get( 'er_usetype2' ) || $ezrparams->get( 'use_realtybookings' )) { ?>
								<div class="tab-pane" id="events">
									<?php if ($ezrparams->get( 'er_ohinfo' ) ) { ?>
										<?php echo $this->loadTemplate('openhouse'); ?>
									<?php } ?>
									<?php if ($ezrparams->get( 'er_aucinfo' ) ) { ?>
										<?php echo $this->loadTemplate('auction'); ?>
									<?php } ?>
									<?php if ($ezrparams->get( 'er_usetype2' ) || $ezrparams->get( 'use_realtybookings' ) ) { ?>
										<?php echo $this->loadTemplate('availability'); ?>
									<?php } ?>
								</div>
							<?php } ?>

							<?php if ($ezrparams->get( 'er_useflplupload' ) || $ezrparams->get( 'er_useepcupload' ) || $ezrparams->get( 'er_usepdfupload' ) || $ezrparams->get( 'er_usepanorama' ) || $ezrparams->get( 'er_useflv' )) { ?>
								<div class="tab-pane" id="resources">
									<?php if ($ezrparams->get( 'er_useflplupload' ) ) { ?><?php echo $this->loadTemplate('flplans'); ?><?php } ?>
									<?php if ($ezrparams->get( 'er_useepcupload' ) ) { ?><?php echo $this->loadTemplate('epc'); ?><?php } ?>
									<?php if ($ezrparams->get( 'er_usepdfupload' ) ) { ?><?php echo $this->loadTemplate('docs'); ?><?php } ?>
									<?php if ($ezrparams->get( 'er_usepanorama' ) ) { ?><?php echo $this->loadTemplate('slideshow'); ?><?php } ?>
									<?php if ($ezrparams->get( 'er_useflv' ) ) { ?><?php echo $this->loadTemplate('video'); ?><?php } ?>
								</div>
							<?php } ?>

							<?php if ($ezrparams->get( 'er_useadministrative' ) || $ezrparams->get( 'er_meta' )) { ?>
								<div class="tab-pane" id="theadmins">
									<div class="row-fluid">
										<div class="span6">
											<?php if ($ezrparams->get( 'er_useadministrative' ) ) { ?><?php echo $this->loadTemplate('admin'); ?><?php } ?>
										</div>
										<div class="span6">
											<?php if ($ezrparams->get( 'er_meta' ) ) { ?><?php echo $this->loadTemplate('metatags'); ?><?php } ?>
										</div>
									</div>
								</div>
							<?php } ?>

						</div>
						<!-- End tab content -->

					</div>
					<!-- End Main Content -->

					<!-- Begin Sidebar -->
						<div class="span3">
				
							<?php if (!$this->property->id || $this->property->owner || !$this->property->agentInfo){ ?>
								<h4><?php echo JText::_('EZREALTY_DETAILS_THESELLER');?></h4>
								<hr />
							<?php } ?>
				
							<fieldset class="form-vertical">
								<?php echo $this->loadTemplate('seller'); ?>
							</fieldset>
				
							<h4><?php echo JText::_('EZREALTY_DETAILS_TAB6A');?></h4>
							<hr />
							<fieldset class="form-vertical">
								<?php echo $this->loadTemplate('publishing'); ?>
							</fieldset>
				
						</div>
					<!-- End Sidebar -->

				</div>
				<!-- End full span -->

				<div class="row-fluid">
					<div class="span12">
						<br /><br />
						<?php if (!$property->id){ ?>
							<div align="center"><h2><?php echo JText::_('EZREALTY_SAVE_FIRST');?></h2><br /><br /></div>
							<input type="hidden" name="imgmarker" value="1" />
						<?php } else {
							echo $this->loadTemplate('images');
						} ?>

					</div>
				</div>

				<input type="hidden" name="applyFlag" value="0" />
				<input type="hidden" name="id" value="<?php echo $property->id; ?>" />
				<input type="hidden" name="task" value="save" />
				<input type="hidden" name="option" value="com_ezrealty" />
			    <input type="hidden" name="controller" value="ezrealty" /> 

			</form>

		</div>
	</div>
</div>
