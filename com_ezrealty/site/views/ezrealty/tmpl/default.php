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

JHtml::_('behavior.framework');
JHtml::_('bootstrap.framework');


?>

<div class="container-fluid">

	<?php if ($this->print){

		if ( $this->params->get( 'er_bizbanner' ) ){ ?>

			<div class="row-fluid">
				<div class="span12">
					<img class="span12" src="<?php echo $this->params->get( 'er_bizbanner' );?>" alt="" />
				</div>
			</div>

		<?php } ?>

		<div class="row-fluid">
			<div class="span12">
				<a href="javascript:if(window.print)window.print()"><?php echo JText::_( 'JGLOBAL_PRINT' );?></a>
			</div>
		</div>

	<?php } ?>

<br />
<div class="row-fluid">
	<div class="span8">

		<span style="font-size: 150%; font-weight: bold;">

			<?php if ( $this->params->get( 'which_page_title' ) == 1 ) {
				if ($this->ezrealty->viewad == 1) {

					if ( $this->params->get( 'address_format' ) == 1 ) {

						if ( $this->ezrealty->bldg_name ) {
							echo '"'.stripslashes($this->ezrealty->bldg_name).'", ';
						}

						if ( $this->ezrealty->address2 ) {
							echo stripslashes($this->ezrealty->address2).', ';
						}

						if ( $this->ezrealty->lot_num ) {
							echo JText::_('EZREALTY_LOT').' '.stripslashes($this->ezrealty->lot_num).' ';
						}

						if ( $this->ezrealty->unit_num && $this->ezrealty->street_num ) {
							echo stripslashes($this->ezrealty->unit_num).'/'.stripslashes($this->ezrealty->street_num).' ';
						} if ( !$this->ezrealty->unit_num && $this->ezrealty->street_num ) {
							echo stripslashes($this->ezrealty->street_num).' ';
						} if ( $this->ezrealty->unit_num && !$this->ezrealty->street_num ) {
							echo stripslashes($this->ezrealty->unit_num).' ';
						} if ( $this->params->get( 'er_usepc') && $this->ezrealty->postcode ) {
							echo ' '.stripslashes($this->ezrealty->postcode);
						} if ( $this->ezrealty->proploc ) {
							echo ' '.stripslashes($this->loc->ezcity);
						} 

					} else {

						if ( $this->ezrealty->bldg_name ) {
							echo '"'.stripslashes($this->ezrealty->bldg_name).'", ';
						}
						if ( $this->ezrealty->lot_num ) {
							echo JText::_('EZREALTY_LOT').' '.stripslashes($this->ezrealty->lot_num).' ';
						}

						if ( $this->ezrealty->unit_num && $this->ezrealty->street_num ) {
							echo stripslashes($this->ezrealty->unit_num).'/'.stripslashes($this->ezrealty->street_num).' ';
						} if ( !$this->ezrealty->unit_num && $this->ezrealty->street_num ) {
							echo stripslashes($this->ezrealty->street_num).' ';
						} if ( $this->ezrealty->unit_num && !$this->ezrealty->street_num ) {
							echo stripslashes($this->ezrealty->unit_num).' ';
						} if ( $this->ezrealty->address2 ) {
							echo stripslashes($this->ezrealty->address2).', ';
						} if ( $this->ezrealty->proploc ) {
							echo stripslashes($this->loc->ezcity);
						} if ( $this->params->get( 'er_usepc') && $this->ezrealty->postcode ) {
							echo ' '.stripslashes($this->ezrealty->postcode);
						}
					}

				} else {
					echo stripslashes($this->ezrealty->adline);
				}
			} else {
				echo stripslashes($this->ezrealty->adline);
			}
		?>

		</span>

	</div>
	<div class="span4">

		<span class="pull-right" style="padding-top: 10px;">

		<?php if ( $this->ezrealty->mls_id ) { ?>
			<?php echo JText::_('EZREALTY_DETAILS_MLSID');?>: <?php echo stripslashes($this->ezrealty->mls_id);?>
		<?php } else {
			if ( $this->ezrealty->office_id ) { ?>
				<?php echo JText::_('EZREALTY_DETAILS_OFFICEID');?>: <?php echo stripslashes($this->ezrealty->office_id);?>
			<?php } ?>
		<?php } ?>

		</span>

	</div>
</div>

<hr />

<div class="row-fluid">
	<div class="span8">

		<h3>
			<?php if ( $this->params->get( 'er_hideprice') || $this->params->get( 'er_hideprice')==0 && $this->user->id ) {
				echo EZRealtyFHelper::formatDisplayPrice ($this->ezrealty->showprice, $this->ezrealty->price, $this->ezrealty->currency_format, $this->ezrealty->currency, $this->ezrealty->currency_position, $this->ezrealty->priceview, $this->ezrealty->freq);
			} else {
				echo "(".JText::_('EZREALTY_CONFIG_HIDEPRICE_MSG').")";
			} ?>
		</h3>

	</div>
	<div class="span4">

		<?php if (!$this->print){ ?>
			<span class="pull-right" style="padding-top: 10px;">

				<?php if ( $this->params->get( 'use_print' ) || $this->params->get( 'er_viewrecommend' ) || $this->params->get( 'er_shortlisting' ) ) {
					echo $this->loadTemplate('tools');
				} ?>

			</span>
		<?php } ?>

	</div>
</div>




	<?php if (!$this->print){ ?>

		<?php if ($this->params->get( 'use_jrev' ) && file_exists("components/com_jreviews/jreviews/models/everywhere/everywhere_com_ezrealty.php")){ ?>
			<div class="row-fluid">
				<div class="span12">
					<?php
					if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);    
					require('components' . DS . 'com_jreviews' . DS . 'jreviews' . DS . 'framework.php');

 				   // Populate $JreParams array
				    $JreParams['data']['extension'] = 'com_ezrealty';
				    $JreParams['data']['tmpl_suffix'] = '';
					$JreParams['data']['controller'] = 'everywhere';
				    $JreParams['data']['action'] = 'index';
				    $JreParams['data']['listing_id'] = $this->ezrealty->id;
                           
					// Load dispatch class
					$Dispatcher = new S2Dispatcher('jreviews',true);

					$jreDetail = $Dispatcher->dispatch($JreParams);
					//echo $jreDetail['output']; // review form and reviews
					echo $jreDetail['summary'];  // average rating stars
					//echo $jreDetail[‘detailed_ratings’]; // Displays detailed ratings graph

					?>			
				</div>
			</div>
		<?php } ?>

	<?php } ?>

	<div class="row-fluid">
		<div class="span12">

			<?php echo $this->loadTemplate('single'); ?>

		</div>
	</div>

	<?php if (!$this->print && $this->params->get( 'er_usesimilar' )){  ?>
		<div class="row-fluid">
			<div class="span12">
				<?php echo $this->loadTemplate('similar'); ?>
			</div>
		</div>
	<?php } ?>

	<?php if ($this->params->get( 'er_useqrcode' ) ){ ?>
		<div class="row-fluid">
			<div class="span12">

				<?php if ($this->params->get( 'er_useqrcode' )){ ?>
					<br />

					<?php
	
					$itemid  = intval(JRequest::getVar( 'Itemid', ''));
					$theproplink  = JURI::root() . 'index.php?option=com_ezrealty&view=ezrealty&id='.$this->ezrealty->id.'&cid='.$this->ezrealty->cid.'&Itemid='.$itemid;
	
					// include 2D barcode class (search for installation path)
					require_once (JPATH_COMPONENT . '/assets/tcpdf/tcpdf_barcodes_2d.php');
	
					// set the barcode content and type
					$barcodeobj = new TCPDF2DBarcode($theproplink, 'QRCODE,L');
	
					// output the barcode as HTML object
					echo $barcodeobj->getBarcodeHTML(4, 4, 'black');
	
					?>

				<?php } ?>

			</div>
		</div>
	<?php } ?>

	<?php if ($this->params->get( 'use_jrev' ) && file_exists("components/com_jreviews/jreviews/models/everywhere/everywhere_com_ezrealty.php")){  ?>
		<div class="row-fluid">
			<div class="span12">
				<?php
					echo $jreDetail['output']; // review form and reviews
				?>
			</div>
		</div>
	<?php } ?>

	<?php if ($this->ezrealty->mls_disclaimer) { ?>
		<div class="row-fluid">
			<div class="span12">

				<?php if ($this->ezrealty->mls_image){ ?>
					<img style="float:left; padding-right: 5px; " src="<?php echo stripslashes($this->ezrealty->mls_image);?>" />
				<?php }
				echo stripslashes($this->ezrealty->mls_disclaimer);
				?>

			</div>
		</div>
	<?php } ?>


</div><!--/.fluid-container-->


<?php EZRealtyFHelper::EZPowered();?>
