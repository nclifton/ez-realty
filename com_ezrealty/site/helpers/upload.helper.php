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

/**
 * EzRealty Upload Helper
 *
 */
class EzRealtyUploadHelper {



	/**********************************************************************\
 	 SHOW THE ALTERNATIVE IMAGE SELECTOR LIST ON THE ADD/EDIT LISTINGS PAGE
	\**********************************************************************/

	function imageUpload($admin,$fieldname){

	?>

		<strong><?php echo JText::_('EZREALTY_VLDET_UPLOADNEW');?>:</strong><br />
		<input class="inputbox" type='file' name='imagelistings[]' size="20" />

	<?php
	}


	/**************************************************\
		FUNCTION THAT MANAGES THE PANORAMA IMAGE UPLOAD
	\**************************************************/

	function panoramaUpload($image,$admin,$fieldname){

		if($image){
			if(file_exists(JPATH_ROOT.'/images/ezrealty/panorama/'.$image) ) { ?>
				<img src="<?php echo JURI::root(); ?>images/ezrealty/panorama/<?php echo $image;?>" hspace="4" width="200" border="0" alt="" />
			<?php } else { ?>
				<img src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/nopanorama.jpg" hspace="4" width="200" border="0" alt="" />
			<?php }
		} else { ?>
	
			<strong><?php echo JText::_('EZREALTY_UPLOAD_PANORAMA');?>:</strong><br />
			<input class="inputbox" type='file' name='<?php echo $fieldname;?>upload' size="15" />
	
		<?php }
	
	}


	function savePanoramaUpload($fileatt_name,$fileatt_type,$fileatt){
	
		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
	
		if ($ezrparams->get( 'er_maxpanoimgsize')) {
			$imageSize = filesize($fileatt);
			$maxImgSize=$ezrparams->get( 'er_maxpanoimgsize')*1024;
		}
	
		$fileatt_name = str_replace("%20","-",$fileatt_name);
		$fileatt_name = str_replace(" ","-",$fileatt_name);
		$extension = substr($fileatt_name, strrpos($fileatt_name, "."));
		$name = substr($fileatt_name, 0,strrpos($fileatt_name, "."));
		$fileatt_name= md5(microtime()).strtolower($extension);
	
		if ($ezrparams->get( 'er_maxpanoimgsize') && $imageSize < $maxImgSize ) {
			if ((strcasecmp(substr($fileatt_name,-4),".jpg")) == 0 || (strcasecmp(substr($fileatt_name,-4),".JPG")) == 0 || (strcasecmp(substr($fileatt_name,-5),".jpeg")) == 0  || (strcasecmp(substr($fileatt_name,-5),".JPEG")) == 0  || (strcasecmp(substr($fileatt_name,-4),".gif")) == 0 || (strcasecmp(substr($fileatt_name,-4),".GIF")) == 0 || (strcasecmp(substr($fileatt_name,-4),".png")) == 0 || (strcasecmp(substr($fileatt_name,-4),".PNG")) == 0 ) {
				if (!file_exists( JPATH_ROOT."/images/ezrealty/panorama/".$fileatt_name )) {
					// Set mode of uploaded picture
					chmod($fileatt, octdec('644'));
					if (@move_uploaded_file($fileatt ,JPATH_ROOT."/images/ezrealty/panorama/".$fileatt_name)){
						return $fileatt_name;
					}
				}
				$fileatt_name = '';
				return $fileatt_name;
			}
			$fileatt_name = '';
			return $fileatt_name;
		}
	}


	/**************************************************\
			PDF MANAGEMENT STUFF
	\**************************************************/
	
	
	function proppdfUpload($pdf,$admin,$fieldname){
		
		if($pdf){ ?>
	
			<strong><?php echo JText::_('EZREALTY_PROFILE_CURRENT_PDF');?></strong><br />
			<a target="_blank" href="<?php echo JURI::root(); ?>images/ezrealty/pdfs/<?php echo $pdf;?>"><img src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/pdfs.png" border="0" alt="" /></a>
	
		<?php } else { ?>
	
			<input class="input-file" type='file' name='<?php echo $fieldname;?>upload' size="15" />
	
		<?php } ?>
	
	
	<?php
	
	}


	/**************************************************\
		FUNCTION THAT MANAGES THE PDF PROMO UPLOAD
	\**************************************************/

	function savePropPdf($fileatt_name,$fileatt_type,$fileatt){
	
		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
	
		if ($ezrparams->get( 'er_maxpdfsize')) {
			$imageSize = filesize($fileatt);
			$maxImgSize=$ezrparams->get( 'er_maxpdfsize')*1024;
		}
	
		$fileatt_name = str_replace("%20","-",$fileatt_name);
		$fileatt_name = str_replace(" ","-",$fileatt_name);
		$extension = substr($fileatt_name, strrpos($fileatt_name, "."));
		$name = substr($fileatt_name, 0,strrpos($fileatt_name, "."));
		$fileatt_name= md5(microtime()).strtolower($extension);
	
		if ($ezrparams->get( 'er_maxpdfsize') && $imageSize < $maxImgSize ) {
			if ((strcasecmp(substr($fileatt_name,-4),".pdf")) == 0 || (strcasecmp(substr($fileatt_name,-4),".PDF")) == 0 || (strcasecmp(substr($fileatt_name,-4),".doc")) == 0  || (strcasecmp(substr($fileatt_name,-4),".DOC")) == 0  || (strcasecmp(substr($fileatt_name,-4),".xls")) == 0 || (strcasecmp(substr($fileatt_name,-4),".XLS")) == 0 ) {
				if (!file_exists( JPATH_ROOT."/images/ezrealty/pdfs/".$fileatt_name )) {
					// Set mode of uploaded picture
					chmod($fileatt, octdec('644'));
					if (@move_uploaded_file($fileatt ,JPATH_ROOT."/images/ezrealty/pdfs/".$fileatt_name)){
						return $fileatt_name;
					}
				}
				$fileatt_name = '';
				return $fileatt_name;
			}
			$fileatt_name = '';
			return $fileatt_name;
		}
	}


	/**************************************************\
			EPC FILE UPLOAD STUFF
	\**************************************************/

	function epcUpload($epc,$admin,$fieldname){
		
		if($epc){ ?>
	
			<strong><?php echo JText::_('EZREALTY_CURRENT_EPC');?></strong><br />
	
			<?php if (strcasecmp(substr($epc,-4),".pdf")) { ?>
				<a class="modal" href="<?php echo JURI::root(); ?>images/ezrealty/epc/<?php echo $epc;?>">
			<?php } else { ?>
				<a target="_blank" href="<?php echo JURI::root(); ?>images/ezrealty/epc/<?php echo $epc;?>">
			<?php } ?>
	
			<img src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/epcs.png" border="0" alt="" /></a>
	
		<?php } else { ?>
	
			<input class="input-file" type='file' name='<?php echo $fieldname;?>upload' size="15" />
	
		<?php } ?>
	
	
	<?php
	
	}


	/**************************************************\
		FUNCTION THAT MANAGES THE EPC PROMO UPLOAD
	\**************************************************/

	function saveEpc($fileatt_name,$fileatt_type,$fileatt){

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
	
		if ($ezrparams->get( 'er_maxepcsize')) {
			$imageSize = filesize($fileatt);
			$maxImgSize=$ezrparams->get( 'er_maxepcsize')*1024;
		}

		$fileatt_name = str_replace("%20","-",$fileatt_name);
		$fileatt_name = str_replace(" ","-",$fileatt_name);
		$extension = substr($fileatt_name, strrpos($fileatt_name, "."));
		$name = substr($fileatt_name, 0,strrpos($fileatt_name, "."));
		$fileatt_name= md5(microtime()).strtolower($extension);

		if ($ezrparams->get( 'er_maxepcsize') && $imageSize < $maxImgSize ) {
			if ((strcasecmp(substr($fileatt_name,-4),".pdf")) == 0 || (strcasecmp(substr($fileatt_name,-4),".PDF")) == 0 || (strcasecmp(substr($fileatt_name,-4),".jpg")) == 0 || (strcasecmp(substr($fileatt_name,-4),".JPG")) == 0 || (strcasecmp(substr($fileatt_name,-5),".jpeg")) == 0  || (strcasecmp(substr($fileatt_name,-5),".JPEG")) == 0  || (strcasecmp(substr($fileatt_name,-4),".gif")) == 0 || (strcasecmp(substr($fileatt_name,-4),".GIF")) == 0 || (strcasecmp(substr($fileatt_name,-4),".png")) == 0 || (strcasecmp(substr($fileatt_name,-4),".PNG")) == 0 ) {
				if (!file_exists( JPATH_ROOT."/images/ezrealty/epc/".$fileatt_name )) {
					// Set mode of uploaded picture
					chmod($fileatt, octdec('644'));
					if (@move_uploaded_file($fileatt ,JPATH_ROOT."/images/ezrealty/epc/".$fileatt_name)){
						return $fileatt_name;
					}
				}
				$fileatt_name = '';
				return $fileatt_name;
			}
			$fileatt_name = '';
			return $fileatt_name;
		}
	}


	/**************************************************\
			Floorplan FILE UPLOAD STUFF
	\**************************************************/
	
	
	function floorplanUpload($flpl,$admin,$fieldname){
		
		if($flpl){ ?>
	
			<strong><?php echo JText::_('EZREALTY_CURRENT_FLPL');?></strong><br />
			<a class="modal" href="<?php echo JURI::root(); ?>images/ezrealty/floorplans/<?php echo $flpl;?>"><img src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/floorplans.png" border="0" alt="" /></a>
	
		<?php } else { ?>
	
			<input class="input-file" type='file' name='<?php echo $fieldname;?>upload' size="15" />
	
		<?php } ?>
	
	
	<?php
	
	}


	/**************************************************\
		FUNCTION THAT MANAGES THE FLOORPLAN UPLOAD
	\**************************************************/

	function saveFlpl($fileatt_name,$fileatt_type,$fileatt){

		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
	
		if ($ezrparams->get( 'er_maxflplsize')) {
			$imageSize = filesize($fileatt);
			$maxImgSize=$ezrparams->get( 'er_maxflplsize')*1024;
		}

		$fileatt_name = str_replace("%20","-",$fileatt_name);
		$fileatt_name = str_replace(" ","-",$fileatt_name);
		$extension = substr($fileatt_name, strrpos($fileatt_name, "."));
		$name = substr($fileatt_name, 0,strrpos($fileatt_name, "."));
		$fileatt_name= md5(microtime()).strtolower($extension);

		if ($ezrparams->get( 'er_maxflplsize') && $imageSize < $maxImgSize ) {
			if ((strcasecmp(substr($fileatt_name,-4),".pdf")) == 0 || (strcasecmp(substr($fileatt_name,-4),".PDF")) == 0 || (strcasecmp(substr($fileatt_name,-4),".jpg")) == 0 || (strcasecmp(substr($fileatt_name,-4),".JPG")) == 0 || (strcasecmp(substr($fileatt_name,-5),".jpeg")) == 0  || (strcasecmp(substr($fileatt_name,-5),".JPEG")) == 0  || (strcasecmp(substr($fileatt_name,-4),".gif")) == 0 || (strcasecmp(substr($fileatt_name,-4),".GIF")) == 0 || (strcasecmp(substr($fileatt_name,-4),".png")) == 0 || (strcasecmp(substr($fileatt_name,-4),".PNG")) == 0 ) {
				if (!file_exists( JPATH_ROOT."/images/ezrealty/floorplans/".$fileatt_name )) {
					// Set mode of uploaded picture
					chmod($fileatt, octdec('644'));
					if (@move_uploaded_file($fileatt ,JPATH_ROOT."/images/ezrealty/floorplans/".$fileatt_name)){
						return $fileatt_name;
					}
				}
				$fileatt_name = '';
				return $fileatt_name;
			}
			$fileatt_name = '';
			return $fileatt_name;
		}
	}



	/**************************************************\
			PROFILE IMAGE MANAGEMENT STUFF
	\**************************************************/

	function profileUpload($image,$admin,$fieldname){
	
		if($image){ ?>
	
			<strong><?php echo JText::_('EZREALTY_VLDET_CURRENTIMG');?></strong><br />
			<a class="modal" href="<?php echo JURI::root(); ?>images/ezportal/avatar/<?php echo $image;?>"><img src="<?php echo JURI::root();?>images/ezportal/avatar/<?php echo $image;?>" width="130px" alt="" /></a>
	
		<?php } else { ?>
	
			<input class="input-file" type='file' name='<?php echo $fieldname;?>upload' size="15" />
	
		<?php } ?>
	
	<?php
	}


	/****************************************************\
		FUNCTION THAT MANAGES THE PROFILE IMAGE UPLOAD
	\****************************************************/

	function saveProfileUpload($fileatt_name,$fileatt_type,$fileatt){
	
		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
	
		if ($ezrparams->get( 'er_maxprofimgsize')) {
			$imageSize = filesize($fileatt);
			$maxImgSize=$ezrparams->get( 'er_maxprofimgsize')*1024;
		}
	
		$fileatt_name = str_replace("%20","-",$fileatt_name);
		$fileatt_name = str_replace(" ","-",$fileatt_name);
		$extension = substr($fileatt_name, strrpos($fileatt_name, "."));
		$name = substr($fileatt_name, 0,strrpos($fileatt_name, "."));
		$fileatt_name= md5(microtime()).strtolower($extension);
	
		if ($ezrparams->get( 'er_maxprofimgsize') && $imageSize < $maxImgSize ) {
			if ((strcasecmp(substr($fileatt_name,-4),".jpg")) == 0 || (strcasecmp(substr($fileatt_name,-4),".JPG")) == 0 || (strcasecmp(substr($fileatt_name,-5),".jpeg")) == 0  || (strcasecmp(substr($fileatt_name,-5),".JPEG")) == 0  || (strcasecmp(substr($fileatt_name,-4),".gif")) == 0 || (strcasecmp(substr($fileatt_name,-4),".GIF")) == 0 || (strcasecmp(substr($fileatt_name,-4),".png")) == 0 || (strcasecmp(substr($fileatt_name,-4),".PNG")) == 0 ) {
				if (!file_exists( JPATH_ROOT."/images/ezportal/avatar/".$fileatt_name )) {
					// Set mode of uploaded picture
					chmod($fileatt, octdec('644'));
					if (@move_uploaded_file($fileatt ,JPATH_ROOT."/images/ezportal/avatar/".$fileatt_name)){
						return $fileatt_name;
					}
				}
				$fileatt_name = '';
				return $fileatt_name;
			}
			$fileatt_name = '';
			return $fileatt_name;
		}
	}



	/**************************************************************\
	 FUNCTION THAT MANAGES THE IMAGE UPLOAD AND CALL TO THUMBNAILER
	\**************************************************************/

	function saveFileUpload($fileatt_name,$fileatt_type,$fileatt){
		
		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
	
		$fileatt_name = str_replace("%20","-",$fileatt_name);
		$fileatt_name = str_replace(" ","-",$fileatt_name);
	
		$extension = substr($fileatt_name, strrpos($fileatt_name, "."));
		$name = substr($fileatt_name, 0,strrpos($fileatt_name, "."));
		$fileatt_name= md5(microtime()).strtolower($extension);
	
		if ((strcasecmp(substr($fileatt_name,-4),".jpg")) && (strcasecmp(substr($fileatt_name,-5),".jpeg"))  && (strcasecmp(substr($fileatt_name,-4),".gif")) && (strcasecmp(substr($fileatt_name,-4),".png")) ) {
			echo "<script> alert('".$fileatt_name." is a file type that is not allowed!'); window.history.go(-1); </script>\n";
			exit();
		}
	
		if (file_exists( JPATH_ROOT."/images/ezrealty/properties/".$fileatt_name )) {
			echo "<script> alert('".$fileatt_name." already exists. Please rename your image'); window.history.go(-1); </script>\n";
			exit();
			return '';
		}else{
	
			// Set mode of uploaded picture
			chmod($fileatt, octdec('644'));
	
			if (@move_uploaded_file($fileatt ,JPATH_ROOT."/images/ezrealty/properties/".$fileatt_name)){
			} else {
				echo "<script> alert('".$fileatt_name." was not uploaded to directory /images/ezrealty/properties/ .  Upload error!'); window.history.go(-1); </script>\n";
				exit();
			}
	
			// Resize the thumbnail and main image
	
			EzRealtyUploadHelper::resize_main(JPATH_ROOT.'/images/ezrealty/properties/'.$fileatt_name );
			EzRealtyUploadHelper::resize_thumb(JPATH_ROOT.'/images/ezrealty/properties/'.$fileatt_name, JPATH_ROOT."/images/ezrealty/properties/th/".$fileatt_name, $ezrparams->get( 'newthumbwidth'), $ezrparams->get( 'er_thumbcreation'), $ezrparams->get( 'er_thumbquality') );
	
			return $fileatt_name;
		}
	}



	/**************************************************\
		FUNCTION THAT RESIZES THE MAIN IMAGE
	\**************************************************/

	function resize_main($src_file){
		
		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
	
		$imagetype = array( 1 => 'GIF', 2 => 'JPG', 3 => 'PNG');
		$imginfo = getimagesize($src_file);
	
		if ($imginfo == null) die("ERROR: Source file not found!");
	
		$imginfo[2] = $imagetype[$imginfo[2]];
	
		// height/width
		$srcWidth = $imginfo[0];
		$srcHeight = $imginfo[1];
	
		// Set a maximum height and width
		$width = $ezrparams->get( 'er_maxwidth') ;
		$height = $ezrparams->get( 'er_maxheight') ;
	
	
		if ($srcWidth > $width OR $srcHeight > $height) {
	
	
			// Get new dimensions
			list($width_orig, $height_orig) = getimagesize($src_file);
	
			$ratio_orig = $width_orig/$height_orig;
	
			if ($width/$height > $ratio_orig) {
				$width = $height*$ratio_orig;
			} else {
				$height = $width/$ratio_orig;
			}
	
			// Resample
			$image_p = imagecreatetruecolor($width, $height);
	
			if ($imginfo[2] == 'JPG')
			$image = imagecreatefromjpeg($src_file);
			if ($imginfo[2] == 'GIF')
			$image = imagecreatefromgif($src_file);
			if ($imginfo[2] == 'PNG')
			$image = imagecreatefrompng($src_file);
	
			$withSampling = true;
	
			// Resize
			if($withSampling)
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
			else
			imagecopyresized($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	
			// Output
			if(imagejpeg($image_p, $src_file, $ezrparams->get( 'er_thumbquality') )) {
				return 1;
			} else if(imagegif($image_p, $src_file, $ezrparams->get( 'er_thumbquality') )) {
				return 1;
			} else if(imagepng($image_p, $src_file, $ezrparams->get( 'er_thumbquality') )) {
				return 1;
			} else {
				return 0;
			}
		}
	}


	/**************************************************\
						THUMBNAILER
	\**************************************************/

	function resize_thumb($src_file, $dest_file, $new_size, $method) {
	
		$session = & JFactory::getSession();
		
		$ezrparams = JComponentHelper::getParams ('com_ezrealty');
		global $fileatt_name, $fileatt;
	
		$imagetype = array( 1 => 'GIF', 2 => 'JPG', 3 => 'PNG', 4 => 'SWF', 5 => 'PSD', 6 => 'BMP', 7 => 'TIFF', 8 => 'TIFF', 9 => 'JPC', 10 => 'JP2', 11 => 'JPX', 12 => 'JB2', 13 => 'SWC', 14 => 'IFF');
		$imginfo = getimagesize($src_file);
	
		if ($imginfo == null) die("ERROR: Source file not found!");
	
		$imginfo[2] = $imagetype[$imginfo[2]];
	
		// GD can only handle JPG & PNG images
		if ($imginfo[2] != 'JPG' && $imginfo[2] != 'PNG' && ($method == 'gd1' || $method == 'gd2')) die("ERROR: GD can only handle JPG and PNG files!");
	
		//Move on and do the thumbnailing stuff
	
		// height/width
		$srcWidth = $imginfo[0];
		$srcHeight = $imginfo[1];
	
		//echo "Creating thumbnail from $imginfo[2], $imginfo[0] x $imginfo[1]...<br>";
	
		$destWidth = $new_size;
		$ratio=$srcHeight*$destWidth;
		$destHeight=$ratio/$srcWidth;
	
		// Method for thumbnails creation
	
		switch ($method) {
	
			case "gd1" :
	
				if (!function_exists('imagecreatefromjpeg')) {
					die('GD image library not installed!');
				}
				if ($imginfo[2] == 'JPG'){
					$src_img = imagecreatefromjpeg($src_file);
					//      echo 'src_img1'.$src_img;
				}else{
					$src_img = imagecreatefrompng($src_file);
					//      echo 'src_img2'.$src_img;
				}
				if (!$src_img){
					$ERROR = $lang_errors['invalid_image'];
					//    echo $lang_errors['invalid_image'];
					echo "<font color=red>Error</font> : Thumbnailing ".$src_file." to ".$dest_file." failed<br />";
					return false;
				}
	
				$dst_img = imagecreate($destWidth, $destHeight);
	
				imagetruecolortopalette($src_img, false, 256);   // Create New Color Pallete
				$palsize = ImageColorsTotal($src_img);
				for ($i = 0; $i < $palsize; $i++) {   // Counting Colors In The Image
					$colors = ImageColorsForIndex($src_img, $i);   // Number Of Colors Used
					ImageColorAllocate($dst_img, $colors['red'], $colors['green'], $colors['blue']);   // Tell The Server What Colors This Image Will Use
				}
	
				imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, $destWidth, $destHeight, $srcWidth, $srcHeight);
	
				if(imagejpeg($dst_img, $dest_file, $ezrparams->get( 'er_thumbquality') )){
					echo "<font color=green>Success</font> : Thumbnail created ".$dest_file."<br />";
				}else{
					echo "<font color=red>Error</font> : Thumbnailing ".$src_file." to ".$dest_file." failed<br />";
				}
	
				imagedestroy($src_img);
				imagedestroy($dst_img);
				break;
	
			case "gd2" :
				if (!function_exists('imagecreatefromjpeg')) {
					die('GD image library not installed!');
				}
				if (!function_exists('imagecreatetruecolor')) {
					die('GD2 image library does not support truecolor thumbnailing!');
				}
				if ($imginfo[2] == 'JPG')
				$src_img = imagecreatefromjpeg($src_file);
				else
				$src_img = imagecreatefrompng($src_file);
				if (!$src_img){
					echo "<font color=red>Error</font> : Thumbnailing ".$src_file." to ".$dest_file." failed<br />";
					//      $ERROR = $lang_errors['invalid_image'];
					return false;
				}
				$dst_img = imagecreatetruecolor($destWidth, $destHeight);
				imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $destWidth, (int)$destHeight, $srcWidth, $srcHeight);
				imagejpeg($dst_img, $dest_file, $ezrparams->get( 'er_thumbquality') );
	
				if(imagejpeg($dst_img, $dest_file, $ezrparams->get( 'er_thumbquality') )){
					echo "<font color=green>Success</font> : Thumbnail created ".$dest_file."<br />";
				}else{
					echo "<font color=red>Error</font> : Thumbnailing ".$src_file." to ".$dest_file." failed<br />";
				}
	
				imagedestroy($src_img);
				imagedestroy($dst_img);
				break;
		}
	
		// Set mode of uploaded picture
		chmod($dest_file, octdec('644'));
	
		// We check that the image is valid
		$imginfo = getimagesize($dest_file);
		if ($imginfo == null){
			return false;
		} else {
			return true;
		}
	}


	/**************************************************\
		FUNCTION THAT COPIES THE VARIOUS MEDIA FILES
	\**************************************************/
	
	function copyFile($current_file,$dirlocation){
	
		$file = $current_file;
	
		$fileatt_name = str_replace("%20","-",$file);
		$fileatt_name = str_replace(" ","-",$fileatt_name);
		$extension = substr($fileatt_name, strrpos($fileatt_name, "."));
		$name = substr($fileatt_name, 0,strrpos($fileatt_name, "."));
		$newfile= md5(microtime()).strtolower($extension);
	
		if (!copy( JPATH_ROOT."/images/ezrealty/".$dirlocation."/".$file,  JPATH_ROOT."/images/ezrealty/".$dirlocation."/".$newfile)) {
			echo "failed to copy $file...\n";
		} else {
			return $newfile;
		}
	}





}

?>
