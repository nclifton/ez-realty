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

<div class="row-fluid">
	<div class="span6">


		<?php echo $this->loadTemplate('pricedets'); ?> <!-- /.base property specs information output -->


		<?php if ( $this->ezrealty->bedrooms == -1 || $this->ezrealty->bedrooms >= 1 || $this->ezrealty->sleeps >= 1 || $this->ezrealty->bathrooms > 0 || $this->ezrealty->fullBaths > 0 || $this->ezrealty->thqtrBaths > 0 || $this->ezrealty->halfBaths > 0 || $this->ezrealty->qtrBaths > 0 || $this->ezrealty->ensuite > 0 || $this->ezrealty->totalrooms || $this->ezrealty->livingarea || $this->ezrealty->otherrooms || $this->ezrealty->CovenantsYN || $this->ezrealty->GarbageDisposalYN || $this->ezrealty->RefrigeratorYN || $this->ezrealty->OvenYN || $this->ezrealty->FamilyRoomPresent || $this->ezrealty->LaundryRoomPresent || $this->ezrealty->KitchenPresent || $this->ezrealty->LivingRoomPresent ){
			echo $this->loadTemplate('baseprop');
		} ?> <!-- /.base property specs information output -->


		<?php if ( $this->ezrealty->year || $this->ezrealty->yearRemodeled || $this->ezrealty->houseStyle || $this->ezrealty->houseConstruction || $this->ezrealty->exteriorFinish || $this->ezrealty->roof || $this->ezrealty->flooring || $this->ezrealty->porchPatio || $this->ezrealty->stories || $this->ezrealty->SqFtLower || $this->ezrealty->SqFtMainLevel || $this->ezrealty->SqFtUpper || $this->ezrealty->squarefeet ){
			echo $this->loadTemplate('building');
		} ?> <!-- /.building information output -->


		<?php if ( $this->ezrealty->takings || $this->ezrealty->returns || $this->ezrealty->netprofit || $this->ezrealty->bustype || $this->ezrealty->bussubtype || $this->ezrealty->stock || $this->ezrealty->fixtures || $this->ezrealty->fittings || $this->ezrealty->percentoffice || $this->ezrealty->percentwarehouse || $this->ezrealty->loadingfac ){
			echo $this->loadTemplate('business');
		} ?> <!-- /.business information output -->


	</div>
	<div class="span6">

		<?php if ( $this->params->get( 'er_idnum')==1 ) { ?>
			<div class="row-fluid">
				<div class="span12"><?php echo JText::_('EZREALTY_DET_ADDNUM');?>: <?php echo stripslashes($this->ezrealty->id);?></div>
			</div>
		<?php } if ( $this->ezrealty->mls_id ) { ?>
			<div class="row-fluid">
				<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_MLSID');?>: <?php echo stripslashes($this->ezrealty->mls_id);?></div>
			</div>
		<?php } if ( $this->ezrealty->office_id ) { ?>
			<div class="row-fluid">
				<div class="span12"><?php echo JText::_('EZREALTY_DETAILS_OFFICEID');?>: <?php echo stripslashes($this->ezrealty->office_id);?></div>
			</div>
		<?php } ?>


		<?php if ( $this->ezrealty->ParkingSpaceYN || $this->ezrealty->parkingGarage || $this->ezrealty->parkingCarport || $this->ezrealty->parking || $this->ezrealty->garageDescription ){
			echo $this->loadTemplate('parking');
		} ?> <!-- /.parking information output -->


		<?php if ( $this->ezrealty->BasementAndFoundation || $this->ezrealty->BasementSize || $this->ezrealty->BasementPctFinished ){
			echo $this->loadTemplate('bandf');
		} ?> <!-- /.basement and foundations information output -->


		<?php if ( $this->ezrealty->landtype || $this->ezrealty->LandAreaSqFt || $this->ezrealty->AcresTotal || $this->ezrealty->LotDimensions || $this->ezrealty->frontage || $this->ezrealty->depth ){
			echo $this->loadTemplate('land');
		} ?> <!-- /.parking information output -->


		<?php if ( $this->ezrealty->fencing || $this->ezrealty->rainfall || $this->ezrealty->soiltype || $this->ezrealty->grazing || $this->ezrealty->cropping || $this->ezrealty->irrigation || $this->ezrealty->waterresources || $this->ezrealty->carryingcap || $this->ezrealty->storage || $this->ezrealty->storage ){
			echo $this->loadTemplate('rural');
		} ?> <!-- /.rural information output -->


		<?php if ( $this->ezrealty->hofees && $this->ezrealty->hofees != '0.00' || $this->ezrealty->AnnualInsurance && $this->ezrealty->AnnualInsurance != '0.00' || $this->ezrealty->TaxAnnual && $this->ezrealty->TaxAnnual != '0.00' || $this->ezrealty->TaxYear ){
			echo $this->loadTemplate('fees');
		} ?> <!-- /.fees and taxes information output -->


		<?php if ( $this->ezrealty->Utlities || $this->ezrealty->ElectricService || $this->ezrealty->AverageUtilElec != "0.00" || $this->ezrealty->AverageUtilHeat != "0.00" || $this->ezrealty->PhoneAvailableYN ){
			echo $this->loadTemplate('utilities');
		} ?> <!-- /.utilities information output -->


		<?php if ( $this->ezrealty->schooldist || $this->ezrealty->preschool || $this->ezrealty->primaryschool || $this->ezrealty->highschool || $this->ezrealty->university ){
			echo $this->loadTemplate('schools');
		} ?>

	</div>
</div>
