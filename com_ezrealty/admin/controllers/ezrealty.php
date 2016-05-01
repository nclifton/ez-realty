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

jimport( 'joomla.application.component.controller' );

class EZRealtyControllerEzrealty extends JControllerAdmin
{

	function __construct() {
		parent::__construct();             
		$this->registerTask("", "display");
		$this->registerTask("add", "edit");
		$this->registerTask("apply", "save");
		$this->registerTask("pdfselect", "pdfselect");
		$this->registerTask("unpublish", "publish");
		$this->registerTask("publish", "publish");
		$this->registerTask("saveorder", "saveorder");	
		$this->registerTask("orderdown", "orderdown");	
		$this->registerTask("orderup", "orderup");                 
		$this->registerTask("dofeatured", "setlevel");	                 
		$this->registerTask("dospotlight", "setlevel");	                 
		$this->registerTask("dostandard", "setlevel");	                 
		$this->registerTask("checkin", "checkin");
		$this->registerTask("prunelightbox", "pruneLightbox");
	}   

    function display() {        

		$view = $this->getView("ezrealty", "html");

        $modelEzrealty = & $this->getModel('ezrealty');
		$view->setModel($modelEzrealty, true);        

        $modelCategories = & $this->getModel('categories');
        $view->setModel($modelCategories);        

        $modelStates = & $this->getModel('states');
        $view->setModel($modelStates);        

        $modelLocalities = & $this->getModel('localities');
        $view->setModel($modelLocalities);        

        $modelCountrys = & $this->getModel('countrys');
        $view->setModel($modelCountrys);     

		$view->display();

    }


    function edit() {

        $view = $this->getView("ezrealty", "html");

        $modelEzrealty = & $this->getModel('ezrealty');
		$view->setModel($modelEzrealty, true);        

        $modelCategories = & $this->getModel('categories');
        $view->setModel($modelCategories);        

        $modelStates = & $this->getModel('states');
        $view->setModel($modelStates);        

        $modelLocalities = & $this->getModel('localities');
        $view->setModel($modelLocalities);        

        $modelCountrys = & $this->getModel('countrys');
        $view->setModel($modelCountrys);     

        $view->setLayout("edit");
        $view->edit();  
    }

    function save() {

        $model = $this->getModel('ezrealty');
        $res = $model->store();

		$id = JRequest::getVar( 'id', '' );

        if (JRequest::getVar('applyFlag') == 1) {
            $link = 'index.php?option=com_ezrealty&controller=ezrealty&task=edit&hidemainmenu=1&cid=' .$res;
        } else {
            $link = 'index.php?option=com_ezrealty&controller=ezrealty';
		}

        if ($res) {
            $msg = JText::_( 'EZREALTY_GENERIC_SAVED' );
        } else {
            $msg = JText::_( 'EZREALTY_SAVEERROR' );
        }

        $this->setRedirect($link, $msg);
    }

    /**
     * remove record(s)
     * @return void
     */
    function remove() {

        $model = $this->getModel('ezrealty');

        if(!$model->delete()) {
            $msg = JText::_( 'EZREALTY_ENTRIES_NOT_DELETED' );
        } else {
            $msg = JText::_( 'EZREALTY_ENTRIES_DELETED' );
        }     

        $this->setRedirect( 'index.php?option=com_ezrealty', $msg );
    }

    /**
     * cancel editing a record
     * @return void
     */

    function cancel() {

        $model = $this->getModel('ezrealty');     
        $res = $model->closeit();

        $msg = JText::_( 'EZREALTY_OPERATION_CANCELLED' );
        $this->setRedirect( 'index.php?option=com_ezrealty', $msg );
    }

    function sort() {

		$link = "index.php?option=com_ezrealty";
		$this->setRedirect($link, $msg);

    }

	function oldpublish () {

        $model = $this->getModel('ezrealty'); 
		$res = $model->publish();

		if ($res) {
			$msg = JText::_('EZREALTY_PUB');
		} else {
            $msg = JText::_('EZREALTY_UNPUB');
		}		

		$link = "index.php?option=com_ezrealty";
		$this->setRedirect($link, $msg);
	}

	function publish () {

        $model = $this->getModel('ezrealty'); 
		$res = $model->publish();

		if ($res) {
			$msg = JText::_('EZREALTY_PUB');
		} else {
            $msg = JText::_('EZREALTY_UNPUB');
		}		

		$link = "index.php?option=com_ezrealty";
		$this->setRedirect($link, $msg);
	}

	function checkin () {

        $model = $this->getModel('ezrealty'); 
		$res = $model->docheckin();

		if ($res) {
			$msg = JText::_('EZREALTY_CHECKIN_SUCCESS');
		} else {
            $msg = JText::_('EZREALTY_CHECKIN_FAILED');
		}		

		$link = "index.php?option=com_ezrealty";
		$this->setRedirect($link, $msg);
	}


    function setlevel() {
    
        $db =& JFactory::getDBO();
        $id = JRequest::getInt('cid',0);
        $task = JRequest::getVar('task', '');

		if ($task == 'dospotlight'){
            $db->setQuery( "UPDATE #__ezrealty SET featured=2 WHERE id=$id" );
		} elseif ($task == 'dofeatured') {
            $db->setQuery( "UPDATE #__ezrealty SET featured=1 WHERE id=$id" );
		} else {
            $db->setQuery( "UPDATE #__ezrealty SET featured=0 WHERE id=$id" );
        }

		if ( !$db->query() ) {
			echo "<script> alert('" . $db->getErrorMsg() . "'); window.history.go(-1); </script>\n";
		}

		$msg = '';
		$link = 'index.php?option=com_ezrealty';
		$this->setRedirect($link, $msg);
        
    }   

    function camform() {
    
		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
        $db =& JFactory::getDBO();
        $id = JRequest::getInt('id',0);
        $cam = JRequest::getInt('cam',0);
        $task = JRequest::getVar('task', '');

		if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){

			$ezpparams = JComponentHelper::getParams ('com_ezportal');

			if ( $ezpparams->get( 'paid_listings' ) == 1 ){

				$sql	= "SELECT DISTINCT cc.id AS value, cc.title AS text FROM #__ezportal_campaigns as cc WHERE cc.published = 1 AND cc.type = 1 ORDER BY cc.ordering";
				$db->setQuery($sql);

				if (!$db->query()) {
					echo $db->stderr();
					return;
				}

				$cctypelist[] = JHTML::_('select.option', '0', JText::_('EZREALTY_DETAILS_FREESTATUS'));
				$cctypelist = array_merge( $cctypelist, $db->loadObjectList() );
				$lists['camtype'] = JHTML::_('select.genericlist', $cctypelist, 'camtype', 'class="input-xlarge" size="1"','value', 'text', $cam);

				?>

				<script type="text/javascript">

					<!--

					function updatecam() {

						var form = document.adminForm;

						// do field validation

						document.adminForm.action = "index.php";
						document.adminForm.submit();

					}
					//-->
				</script>

				<form action="<?php echo JRoute::_('index.php?option=com_ezrealty&format=raw'); ?>" method="post" name="adminForm" id="adminForm">

					<?php echo $lists['camtype'];?>

					<input type="button" name="<?php echo JText::_('COM_EZREALTY_SAVE') ?>" value="<?php echo JText::_('COM_EZREALTY_SAVE') ?>" class="btn-large btn-primary" onclick="updatecam()" />

					<input type="hidden" name="task" value="resetcamtype" />
					<input type="hidden" name="option" value="com_ezrealty" />
				    <input type="hidden" name="controller" value="ezrealty" /> 
				    <input type="hidden" name="id" value="<?php echo $id;?>" /> 

				</form>

				<?php
			}
		}        
    }   


    function resetcamtype() {

		$id  		= intval(JRequest::getVar( 'id', 0));
		$camtype  	= intval(JRequest::getVar( 'camtype', 0));

        $database 	= & JFactory::getDBO();
		$ezrparams 	= JComponentHelper::getParams ('com_ezrealty');


		if ($camtype > '0'){

			$database->setQuery( "SELECT * FROM #__ezportal_campaigns WHERE id=$camtype" );
			$ezcam = $database->loadObjectList();
			$ezcamtype = $ezcam[0];

			if ($ezcamtype->unit == '1'){
				$expdate=mktime(0, 0, 0,date("m")+$ezcamtype->length, date("d"), date("Y"));
			} else {
				$expdate=mktime(0, 0, 0, date("m"), date("d")+$ezcamtype->length, date("Y"));
			}

			$whichfeature = $ezcamtype->featured;
		} else {

            $expdate=mktime(0, 0, 0, date("m"), date("d")+$ezrparams->get( 'er_expfig'), date("Y"));
			$whichfeature = 0;

		}

        if ( $id ) {           

            $database->setQuery( "UPDATE #__ezrealty SET camtype = $camtype, featured = $whichfeature, expdate=$expdate WHERE id=$id" );

            if ( !$database->query() ) {
                echo "<script> alert('" . $database->getErrorMsg() . "'); window.history.go(-1); </script>\n";
            }

                echo "<script> window.parent.location.reload(true); </script>\n";

			JToolBarHelper::title( JText::_('COM_EZREALTY_CAMPAIGN_UPDATED'), 'thememanager' );

        } else {

			JToolBarHelper::title( JText::_('COM_EZREALTY_CAMPAIGN_NOTUPDATED'), 'thememanager' );

		}

    }


    function resethits() {

        $id = JRequest::getInt('cid',0);
        $database = & JFactory::getDBO();

        $database->setQuery( "select hits from #__ezrealty where id=$id" );
        $own=$database->loadResult();

        if ( $id ) {           

            $database->setQuery( "UPDATE #__ezrealty SET hits=0 WHERE id=$id" );

            if ( !$database->query() ) {
                echo "<script> alert('" . $database->getErrorMsg() . "'); window.history.go(-1); </script>\n";
            }

            $this->setRedirect( 'index.php?option=com_ezrealty', JText::_('EZREALTY_RESET_MSG') );
        }
    }

    function resetdate () {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
        $id = JRequest::getInt('cid',0);
        $database = & JFactory::getDBO();

        $database->setQuery( "select * from #__ezrealty where id=$id" );
        $own=$database->loadResult();

        if ( $id > 0 ) {

            $doreset=mktime(0, 0, 0, date("m"), date("d")+$ezrparams->get( 'er_expfig'), date("Y"));
            $database->setQuery( "UPDATE #__ezrealty SET expdate=$doreset WHERE id=$id" );

            if ( !$database->query() ) {
                echo "<script> alert('" . $database->getErrorMsg() . "'); window.history.go(-1); </script>\n";
            }

            $this->setRedirect( 'index.php?option=com_ezrealty', JText::_('EZREALTY_EXPDATE_RESET') );
        } 
    }


    function copy() {

        $model = $this->getModel('ezrealty'); 
		$res = $model->copy();

		if ($res) {
			$msg = JText::_('EZREALTY_COPY_SUCCESS');
		} else {
            $msg = JText::_('EZREALTY_COPY_FAILED');
		}		

		$link = "index.php?option=com_ezrealty";
		$this->setRedirect($link, $msg);

    }



    function deleteepc () {

        $database = & JFactory::getDBO();
        $id = JRequest::getVar('cid',0);
        $thefile = JRequest::getVar('file', '');

        $database->setQuery( "select $thefile from #__ezrealty where id=$id" );
        $epcinfo=$database->loadResult();

        if ( $id > 0 && !empty($epcinfo)) {
            @unlink(  JPATH_ROOT . '/images/ezrealty/epc/'.$epcinfo );
            $database->setQuery( "UPDATE #__ezrealty SET $thefile='' WHERE id=$id" );

            if ( !$database->query() ) {
                echo "<script> alert('" . $database->getErrorMsg() . "'); window.history.go(-1); </script>\n";
            }

            $this->setRedirect( 'index.php?option=com_ezrealty&controller=ezrealty&task=edit&hidemainmenu=1&cid='.$id, JText::_('COM_EZREALTY_FILE_DELETED') );
        }
    }   

    function deleteflpl () {

        $database = & JFactory::getDBO();
        $id = JRequest::getVar('cid',0);
        $thefile = JRequest::getVar('file', '');

        $database->setQuery( "select $thefile from #__ezrealty where id=$id" );
        $fpinfo=$database->loadResult();

        if ( $id > 0 && !empty($fpinfo)) {
            @unlink(  JPATH_ROOT . '/images/ezrealty/floorplans/'.$fpinfo );
            $database->setQuery( "UPDATE #__ezrealty SET $thefile='' WHERE id=$id" );

            if ( !$database->query() ) {
                echo "<script> alert('" . $database->getErrorMsg() . "'); window.history.go(-1); </script>\n";
            }

            $this->setRedirect( 'index.php?option=com_ezrealty&controller=ezrealty&task=edit&hidemainmenu=1&cid='.$id, JText::_('COM_EZREALTY_FILE_DELETED') );
        }
    }   

    function deletepdfinfo () {

        $database = & JFactory::getDBO();
        $id = JRequest::getVar('cid',0);
        $thefile = JRequest::getVar('file', '');

        $database->setQuery( "select $thefile from #__ezrealty where id=$id" );
        $pdfinfo=$database->loadResult();

        if ( $id > 0 && !empty($pdfinfo)) {
            @unlink(  JPATH_ROOT . '/images/ezrealty/pdfs/'.$pdfinfo );
            $database->setQuery( "UPDATE #__ezrealty SET $thefile='' WHERE id=$id" );

            if ( !$database->query() ) {
                echo "<script> alert('" . $database->getErrorMsg() . "'); window.history.go(-1); </script>\n";
            }

            $this->setRedirect( 'index.php?option=com_ezrealty&controller=ezrealty&task=edit&hidemainmenu=1&cid='.$id, JText::_('COM_EZREALTY_FILE_DELETED') );
        }
    }   

    function deletepanorama () {

        $database = & JFactory::getDBO();
        $id = JRequest::getVar('cid',0);

        $database->setQuery( "select panorama from #__ezrealty where id=$id" );
        $panorama=$database->loadResult();

        if ( $id > 0 && !empty($panorama)) {
			@unlink( JPATH_ROOT . '/images/ezrealty/panorama/' . $panorama );
            $database->setQuery( "UPDATE #__ezrealty SET panorama='' WHERE id=$id" );

            if ( !$database->query() ) {
                echo "<script> alert('" . $database->getErrorMsg() . "'); window.history.go(-1); </script>\n";
            }

            $this->setRedirect( 'index.php?option=com_ezrealty&controller=ezrealty&task=edit&hidemainmenu=1&cid='.$id, JText::_('COM_EZREALTY_FILE_DELETED') );
        }
    }   








/**************************************************************\
	   		UPLOAD THE PROPERTY IMAGES
\**************************************************************/

	function uploadListingImage(){

    	$db = & JFactory::getDBO();
    	$id = & JRequest::getInt('cid', 0);

    	$query = 'SELECT max(ordering) FROM #__ezrealty_images WHERE propid = '.intval($id);
        $db->setQuery($query);

        $maxOrderingImage = $db->loadResult();

    	if(isset ($_FILES['imagelisting']['name'])){
        	$imageName = EzRealtyUploadHelper::saveFileUpload($_FILES['imagelisting']['name'],$_FILES['imagelisting']['type'],$_FILES['imagelisting']['tmp_name']);	        		
        	if($imageName){

        		$query  = "INSERT INTO #__ezrealty_images SET propid = ".intval($id).", `fname` = '$imageName', `ordering` = ".intval(1 + $maxOrderingImage);
        		$db->setQuery($query);	        			
        		$db->Query();

				$theordering = intval(1 + $maxOrderingImage);

				echo 'fileuploaded={"filenameuploaded":"'.$imageName.'","ordering":"'.$theordering.'","id":"'.intval($db->insertid()).'"}';
			} else {
        		echo "";
        	}
        }
    	exit();    	
    }

/**************************************************************\
	   		ORDER DOWN THE PROPERTY IMAGE
\**************************************************************/

	function orderdown(){   

    	$id = & JRequest::getInt('id', 0);
		$model = $this->getModel('ezrealty');

		if($model->orderImage($id, 1)){
			echo 1;
		} else echo 0;
    }

/**************************************************************\
	   		ORDER UP THE PROPERTY IMAGE
\**************************************************************/

	function orderup() {

    	$id = & JRequest::getInt('id', 0);
		$model = $this->getModel('ezrealty');

		if($model->orderImage($id, -1)){
			echo 1;
		} else echo 0;
	}	

/**************************************************************\
	   		DELETE THE IMAGE
\**************************************************************/

    function deleteImageListing(){

    	$db = & JFactory::getDBO();
    	$id = & JRequest::getInt('id', 0);    	
    	$imageName = & JRequest::getString('imageName', '');

    	$db->setQuery("DELETE FROM #__ezrealty_images WHERE `id` = {$id}");

    	if($db->Query()){

			if(file_exists(JPATH_ROOT.'/images/ezrealty/properties/'.$imageName)){
    			@unlink(JPATH_ROOT.'/images/ezrealty/properties/'.$imageName);
				@unlink(JPATH_ROOT.'/images/ezrealty/properties/th/'.$imageName);
			}

			$model = $this->getModel('ezrealty');
			$model->updateImageOrder($id);

			echo 1;
    	} else {
    		echo 0;
    	}
    	exit();    	
    }

/**************************************************************\
	   		UPDATE THE IMAGE TITLE
\**************************************************************/

    function updateImageTitle(){   

    	$db = & JFactory::getDBO();
    	$id = & JRequest::getInt('id', 0);
    	$value = & JRequest::getString('value', '');

		$newvalue = $db->escape($value);

    	$db->setQuery("UPDATE #__ezrealty_images SET `title` = '$newvalue' WHERE `id` = '$id'");
    	$db->Query();

    	exit();
    }

/**************************************************************\
	   		UPDATE THE IMAGE DESCRIPTION
\**************************************************************/

    function updateImageDescription(){   

    	$db = & JFactory::getDBO();
    	$id = & JRequest::getInt('id', 0);
    	$value = & JRequest::getString('value', '');

		$newvalue = $db->escape($value);

    	$db->setQuery("UPDATE #__ezrealty_images SET `description` = '$newvalue' WHERE `id` = '$id'");
    	$db->Query();

    	exit();
    }




/**************************************************************\
 SECONDARY IMAGE UPLOAD FORM IF FLASH FAILS OR ON MOBILE DEVICE
\**************************************************************/


    function imageform() {
    
		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
        $db =& JFactory::getDBO();
        $id = JRequest::getInt('id',0);
        $task = JRequest::getVar('task', '');
        $database = & JFactory::getDBO();
        $themedia 	= EZRealtyHelper::getImagesById($id);

		?>

		<script type="text/javascript">
			<!--

			function updateimg() {

				var form = document.adminForm;

				// do field validation

				document.adminForm.action = "index.php?option=com_ezrealty&format=raw";
				document.adminForm.submit();

			}
			//-->
		</script>

		<form action="<?php echo JRoute::_('index.php?option=com_ezrealty&format=raw'); ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">

			<fieldset class="adminform">
				<legend><?php echo JText::_( 'EZREALTY_DETAILS_TAB4A' ); ?></legend>	

				<table class="table table-striped table-bordered" id="imagesListing">
					<tr>
						<td width="100px" align="center"><strong><?php echo JText::_('EZREALTY_VLDET_CURRENTIMG');?></strong></td>
					</tr>
					<?php for ($i=0, $n=count( $themedia ); $i < $n; $i++ ) {
						$image = $themedia[$i];
					} for (; $i < $ezrparams->get( 'max_images'); $i++) { 
						$cur_img="image".$i;
						?>
						<tr>
							<td>
								<?php EzRealtyUploadHelper::imageUpload('1',$cur_img);?>

							</td>
						</tr>
					<?php } ?>
				</table>

			</fieldset>

			<input type="button" name="<?php echo JText::_('COM_EZREALTY_SAVE') ?>" value="<?php echo JText::_('COM_EZREALTY_SAVE') ?>" class="btn-large btn-primary" onclick="updateimg()" />

			<?php echo JHtml::_('form.token'); ?>

			<input type="hidden" name="task" value="updateimages" />
			<input type="hidden" name="option" value="com_ezrealty" />
		    <input type="hidden" name="controller" value="ezrealty" /> 
		    <input type="hidden" name="id" value="<?php echo $id;?>" /> 

		</form>

	<?php
    }   

	function updateimages() {

		$db 	= & JFactory::getDBO();
		$id  	= intval(JRequest::getVar( 'id', 0));

		if ( $id ) {           

        	//insert images for listing into the images table

	        $query = 'SELECT max(ordering) FROM #__ezrealty_images WHERE propid = '.intval($id);
	        $db->setQuery($query);
	        $maxOrderingImage = $db->loadResult();    	
        	for($i=0; $i<count($_FILES['imagelistings']['name']); $i++){
        		if($_FILES['imagelistings']['name'][$i]){
	        		$imageName = EzRealtyUploadHelper::saveFileUpload($_FILES['imagelistings']['name'][$i],$_FILES['imagelistings']['type'][$i],$_FILES['imagelistings']['tmp_name'][$i]); 
	        		echo $imageName;
	        		if($imageName){
	        			$query  = '  INSERT INTO #__ezrealty_images SET ';
	        			$query .= '  propid = '.intval($id);
	        			$query .= ', fname = '.$db->Quote($db->escape($imageName));        			
	        			$query .= ', ordering = '.intval($i + 1 + $maxOrderingImage);
	        			$db->setQuery($query);	        			
	        			$db->Query();
	        		}
        		}
        	}

			echo "<script> window.parent.location.reload(true); </script>\n";

			JToolBarHelper::title( JText::_('EZREALTY_GENERIC_SAVED'), 'thememanager' );

		} else {

			JToolBarHelper::title( JText::_('EZREALTY_SAVEERROR'), 'thememanager' );

		}
	}


/**************************************************************\
	   		CLEAN OUT THE DATABASE OF EXPIRED LISTINGS
\**************************************************************/

    function cleanDB() {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
        $mainframe = &JFactory::getApplication();
        $database =& JFactory::getDBO();

        if ( $ezrparams->get( 'er_expmgmt') ==1 ) {

			$date1=mktime(0, 0, 0, date("m"), date("d")-$ezrparams->get( 'er_expgrace'), date("Y"));
			$date2=mktime(0, 0, 0, date("m"), date("d"), date("Y"));

			$database->setQuery( "SELECT * FROM #__ezrealty WHERE expdate < $date1 AND expdate < $date2" );
			$rows = $database->loadObjectList();

			foreach($rows as $row) {

				$row->images = EZRealtyHelper::getImagesById($row->id);
				for($i=1; $i < count($row->images); $i++){
					if ($row->images->image) {
						@unlink( JPATH_SITE."/images/ezrealty/properties/".$row->images->fname );
						@unlink( JPATH_SITE."/images/ezrealty/properties/th/".$row->images->fname );
					}
				}
				$database->setQuery( "DELETE FROM #__ezrealty_images WHERE `propid ` = ".intval($row->id) );


				if ($row->pdfinfo1) {
					@unlink( JPATH_SITE.'/images/ezrealty/pdfs/'.$row->pdfinfo1 );
				}
				if ($row->pdfinfo2) {
					@unlink( JPATH_SITE.'/images/ezrealty/pdfs/'.$row->pdfinfo2 );
				}
				if ($row->epc1) {
					@unlink( JPATH_SITE.'/images/ezrealty/epc/'.$row->epc1 );
				}
				if ($row->epc2) {
					@unlink( JPATH_SITE.'/images/ezrealty/epc/'.$row->epc2 );
				}
				if ($row->flpl1) {
					@unlink( JPATH_SITE.'/images/ezrealty/floorplans/'.$row->flpl1 );
				}
				if ($row->flpl2) {
					@unlink( JPATH_SITE.'/images/ezrealty/floorplans/'.$row->flpl2 );
				}
				if ($row->panorama) {
					@unlink( JPATH_SITE.'/images/ezrealty/panorama/'.$row->panorama );
				}
			}

			$database->setQuery( "DELETE FROM #__ezrealty WHERE expdate < $date1 AND expdate < $date2" );

			if ( !$database->query() ) {
				echo "<script> alert('" . $database->getErrorMsg()
				. "'); window.history.go(-1); </script>\n";
			}

			$mainframe->redirect( "index.php?option=com_ezrealty", JText::_('EZREALTY_CLEANDB_SUCCESS') );

		} else {

			$mainframe->redirect( "index.php?option=com_ezrealty", JText::_('EZREALTY_CLEANDB_FAIL') );
		}
	}

/**************************************************************\
	   				PRUNE THE LIGHTBOX OF OLD LISTINGS
\**************************************************************/


    function pruneLightbox() {

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
        $mainframe = &JFactory::getApplication();

        $database =& JFactory::getDBO();
        $calcdate=mktime(0, 0, 0, date("m"), date("d")-$ezrparams->get( 'er_lightboxexp'), date("Y"));
        $database->setQuery( "DELETE FROM #__ezrealty_lightbox WHERE date < $calcdate" );

        if ( !$database->query() ) {
            echo "<script> alert('" . $database->getErrorMsg()
                    . "'); window.history.go(-1); </script>\n";
        }

        $mainframe->redirect( "index.php?option=com_ezrealty", JText::_('EZREALTY_PRUNE_DONE') );
    }



	function quickRegenerate () {

        $cids = JRequest::getVar( 'cid', array(0), 'default', 'array' );

		if ($cids[0] == 0){
			$msg = JText::_('Oops - please select some listings to regenerate thumbnails for');
		} else {

			$model = $this->getModel('ezrealty'); 
			$res = $model->imgregen();

			if ($res) {
				$msg = JText::_('Images regenerated');
			} else {
				$msg = JText::_('Oops - something went wrong');
			}		
		}

		$link = "index.php?option=com_ezrealty";
		$this->setRedirect($link, $msg);
	}



/**************************************************************\
	   				CLEAN OUT ORPHAN FILES
\**************************************************************/


    function cleanfiles () {

		$database = & JFactory::getDBO();
		$ezrparams = JComponentHelper::getParams ('com_ezrealty');

		// clean out the old property images
		// define the absolute directory path
		$dirPath1 = JPATH_ROOT.'/images/ezrealty/properties';

		// open the directory and make sure it's open
		if ($handle = opendir($dirPath1)) {

			// read through the directory contents
			while (false !== ($file = readdir($handle))) {

				// don't worry about the current or parent directory
				if ($file != "." && $file != "..") {
				
					if (is_dir("$dirPath1/$file")) {
						// echo "[$file]<br>"; // don't do anything with subdirectories
					} else {

						//don't show the placeholder image or index file
						if ($file != "index.html") {

							# Do the main database query to match images with those in use
							$query = "SELECT id FROM #__ezrealty_images"
							."\n WHERE `fname`='$file'";
							$database->setQuery( $query );
							$liveimages = $database->loadResult();

							//show a delete link if the image is not listed in the database
							if (!$liveimages){

								if(file_exists($dirPath1."/".$file )){
									@unlink( $dirPath1."/".$file );
								}
								if(file_exists($dirPath1."/th/".$file)){
									@unlink( $dirPath1."/th/".$file );
								}
							}
						}
					}
				}
			}

			// now we close the directory
			closedir($handle);
		}


		// clean out the old epc files
		// define the absolute directory path
		$dirPath2 = JPATH_ROOT."/images/ezrealty/epc";

		// open the directory and make sure it's open
		if ($handle = opendir($dirPath2)) {

			// read through the directory contents
			while (false !== ($file = readdir($handle))) {

				// don't worry about the current or parent directory
				if ($file != "." && $file != "..") {
					if (is_dir($dirPath2."/".$file)) {
						// echo "[$file]<br>"; // don't do anything with subdirectories
					} else {

						//don't show the placeholder image or index file
						if ($file != "index.html") {

							# Do the main database query to match images with those in use
							$query = "SELECT id FROM #__ezrealty"
							."\n WHERE epc1='$file' OR epc2='$file'"
							;
							$database->setQuery( $query );
							$liveimages = $database->loadResult();

							//show a delete link if the image is not listed in the database
							if (!$liveimages){

								unlink( $dirPath2."/".$file );

							}
						}
					}
				}
			}

			// now we close the directory
			closedir($handle);
		}


		// clean out the old pdf files
		// define the absolute directory path
		$dirPath3 = JPATH_ROOT."/images/ezrealty/pdfs";

		// open the directory and make sure it's open
		if ($handle = opendir($dirPath3)) {

			// read through the directory contents
			while (false !== ($file = readdir($handle))) {

				// don't worry about the current or parent directory
				if ($file != "." && $file != "..") {
					if (is_dir($dirPath3."/".$file)) {
						// echo "[$file]<br>"; // don't do anything with subdirectories
					} else {

						//don't show the index file
						if ($file != "index.html") {

							# Do the main database query to match images with those in use

							$query = "SELECT id FROM #__ezrealty"
							."\n WHERE pdfinfo1='$file' OR pdfinfo2='$file'";
                            
							$database->setQuery( $query );
							$liveimages = $database->loadResult();

							//show a delete link if the image is not listed in the database
							if (!$liveimages){

								unlink( $dirPath3."/".$file );

							}
						}
					}
				}
			}

			// now we close the directory
			closedir($handle);
		}


		// clean out the old panorama images
		// define the absolute directory path
		$dirPath4 = JPATH_ROOT."/images/ezrealty/panorama";

		// open the directory and make sure it's open
		if ($handle = opendir($dirPath4)) {

			// read through the directory contents
			while (false !== ($file = readdir($handle))) {

				// don't worry about the current or parent directory
				if ($file != "." && $file != "..") {
					if (is_dir($dirPath4."/".$file)) {
						// echo "[$file]<br>"; // don't do anything with subdirectories
					} else {

						//don't show the index file
						if ($file != "index.html") {

							# Do the main database query to match images with those in use

							$query = "SELECT id FROM #__ezrealty"
							."\n WHERE panorama='$file'";
                            
							$database->setQuery( $query );
							$liveimages = $database->loadResult();

							//show a delete link if the image is not listed in the database
							if (!$liveimages){

								unlink( $dirPath4."/".$file );

							}
						}
					}
				}
			}

			// now we close the directory
			closedir($handle);
		}


		// clean out the old floorplans
		// define the absolute directory path
		$dirPath6 = JPATH_ROOT."/images/ezrealty/floorplans";

		// open the directory and make sure it's open
		if ($handle = opendir($dirPath6)) {

			// read through the directory contents
			while (false !== ($file = readdir($handle))) {

				// don't worry about the current or parent directory
				if ($file != "." && $file != "..") {
					if (is_dir($dirPath6."/".$file)) {
						// echo "[$file]<br>"; // don't do anything with subdirectories
					} else {

						//don't show the placeholder image or index file
						if ($file != "index.html") {

							# Do the main database query to match images with those in use
							$query = "SELECT id FROM #__ezrealty"
							."\n WHERE flpl1='$file' OR flpl2='$file'"
							;
							$database->setQuery( $query );
							$liveimages = $database->loadResult();

							//show a delete link if the image is not listed in the database
							if (!$liveimages){

								unlink( $dirPath6."/".$file );

							}
						}
					}
				}
			}

			// now we close the directory
			closedir($handle);
		}


        $msg = JText::_('EZREALTY_FILES_CLEANED');
		$this->setRedirect( 'index.php?option=com_ezrealty', $msg );

	}


/**************************************************************\
	   				OPTIMIZE THE DATABASE TABLES
\**************************************************************/


    function optimizetables() {

        $database =& JFactory::getDBO();
        $msg = JText::_('EZREALTY_OPTIMIZE_FINISHED');


        $database->setQuery("OPTIMIZE TABLE `#__ezrealty`");
        $database->query();

        $database->setQuery("OPTIMIZE TABLE `#__ezrealty_catg`");
        $database->query();

        $database->setQuery("OPTIMIZE TABLE `#__ezrealty_incats`");
        $database->query();

        $database->setQuery("OPTIMIZE TABLE `#__ezrealty_country`");
        $database->query();

        $database->setQuery("OPTIMIZE TABLE `#__ezrealty_images`");
        $database->query();

        $database->setQuery("OPTIMIZE TABLE `#__ezrealty_lightbox`");
        $database->query();

        $database->setQuery("OPTIMIZE TABLE `#__ezrealty_locality`");
        $database->query();

        $database->setQuery("OPTIMIZE TABLE `#__ezrealty_state`");
        $database->query();

        $database->setQuery("OPTIMIZE TABLE `#__ezportal`");
        $database->query();


		$this->setRedirect( 'index.php?option=com_ezrealty', $msg );
    }


    function updateTables() {

        $app = &JFactory::getApplication();
        $db =& JFactory::getDBO();
		$msg = JText::_('COM_EZREALTY_UPGRADE_DONE');

		# check for the fullBaths field which was added into the V7.1.0 #__ezrealty table, and if it doesn't exist - add the various fields incorporated into this version

		$pretab = $app->getCfg('dbprefix');

		$tabname1 = "ezrealty";
		$table1 = $pretab.$tabname1;

		$result1 = mysql_query("SHOW COLUMNS FROM `$table1` LIKE 'fullBaths'");
		$exists1 = (mysql_num_rows($result1))?TRUE:FALSE;

		if ($exists1) { } else {

			EZRealtyUpgradesHelper::ezrealty710Upgrade();

		}


		# check for the prices admin menu item which was removed from the V7.2.0 EZ Realty version, and if it exists - indicate an upgrade is needed

		$query2 = "SELECT id FROM #__menu WHERE link = 'index.php?option=com_ezrealty&controller=prices' ";
		$db->setQuery($query2);
		$db->query();
		$preresult = $db->getNumRows();

		if ($preresult) {

			EZRealtyUpgradesHelper::ezrealty720Upgrade();

		} else { }



		$this->setRedirect( 'index.php?option=com_ezrealty', $msg );

	}



/************************************************************************************\
  		MIGRATE DATA FROM THE OLD pre-J3x VERSION TABLES INTO THE NEW TABLES
\************************************************************************************/


    function doMigration() {

        $database =& JFactory::getDBO();
        $msg = JText::_('EZREALTY_DATA_MIGRATED');
        $app = &JFactory::getApplication();


		EZRealtyMigrationHelper::renameTables();

		EZRealtyMigrationHelper::recreateTables();

		EZRealtyMigrationHelper::migrateData();


		$this->setRedirect( 'index.php?option=com_ezrealty', $msg );

	}




    function pdfstock() {
    
        $cids = JRequest::getVar('cid', array(0), 'post', 'array');
		echo EZRealtyPdfHelper::displayPdf ( $cids );

	}


    function pdfselect() {
    
        $task = JRequest::getVar('task', '');
        $database = & JFactory::getDBO();
		$ezrparams 	= JComponentHelper::getParams ('com_ezrealty');


		// Get the WHERE and ORDER BY clauses for the query
		$where		= " WHERE a.published = 1";
		$orderby	= " ORDER BY a.id DESC LIMIT 100";

		$query = 'SELECT a.*, cc.name AS category '
		. ' FROM #__ezrealty AS a'
		. ' LEFT JOIN #__ezrealty_catg AS cc ON cc.id = a.cid'
		. $where
		. $orderby
		;
        $database->setQuery( $query );
        $items = $database->loadObjectList();

		?>

		<script type="text/javascript">
			<!--

			function updatearts() {

				var form = document.adminForm;

				// do field validation

					document.adminForm.action = "index.php?option=com_ezrealty&format=raw";
					document.adminForm.submit();

			}
			//-->
		</script>

		<legend><?php echo JText::_( 'EZREALTY_PDF_SELECT_PROPERTIES' ); ?></legend>	

		<form action="<?php echo JRoute::_('index.php?option=com_ezrealty&format=raw'); ?>" method="post" name="adminForm" id="adminForm">

			<div style="text-align: center;">
				<input type="button" name="<?php echo JText::_('EZREALTY_PDF_ADD_PROPERTIES') ?>" value="<?php echo JText::_('EZREALTY_PDF_ADD_PROPERTIES') ?>" class="btn-small btn-primary" onclick="updatearts()" />
			</div>
			<br />

			<table cellpadding="0" cellspacing="0" border="0" width="100%">

				<?php for ($i=0, $n=count( $items ); $i < $n; $i++) {
					$item = &$items[$i];

					$theimage = EZRealtyHelper::getTheImage($item->id);

					?>

					<tr>
						<td>
							<?php echo JHTML::_('grid.id', $i, $item->id ); ?>
						</td>
						<td>
							<?php if (isset($theimage)) { ?>
								<?php echo EZRealtyHelper::getThePath($item->id);?>
							<?php } else { ?>
								<img class="thumbnail" src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/nothumb.png" height="70px" width="90px" alt="" />
							<?php } ?>
						</td>
						<td>

							<?php echo EZRealtyFHelper::formatDisplayPrice ($item->showprice, $item->price, $item->currency_format, $item->currency, $item->currency_position, $item->priceview, $item->freq); ?>

							<br />
							<?php echo stripslashes($item->unit_num.' '.$item->street_num.' '.$item->address2.' '.$item->locality.' '.$item->postcode);?>
						</td>
						<td>
							<?php echo $item->category; ?>
						</td>
					</tr>

				<?php } ?>

			</table>
			<br />
			<div style="text-align: center;">
				<input type="button" name="<?php echo JText::_('EZREALTY_PDF_ADD_PROPERTIES') ?>" value="<?php echo JText::_('EZREALTY_PDF_ADD_PROPERTIES') ?>" class="btn-small btn-primary" onclick="updatearts()" />
			</div>

			<?php echo JHtml::_('form.token'); ?>

			<input type="hidden" name="task" value="pdfstock" />
			<input type="hidden" name="option" value="com_ezrealty" />
		    <input type="hidden" name="controller" value="ezrealty" /> 

		</form>

	<?php
    }   



}

?>
