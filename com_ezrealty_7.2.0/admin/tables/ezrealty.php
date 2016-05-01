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
 * Properties Table class for J2.5x
 *
 * @package    EZ Realty
 */
class EzrealtyTableEzrealty extends JTable
{
    /**
     * Primary Key
     *
     * @var int
    */
    var $id = null;
    var $type = null;
    var $rent_type = null;
    var $cid = null;
    var $locid = null;
    var $stid = null;
    var $cnid = null;
    var $soleAgency = null;
    var $bldg_name = null;
    var $unit_num = null;
    var $lot_num = null;
    var $street_num = null;
    var $address2 = null;
    var $postcode = null;
    var $county = null;
    var $locality = null;
    var $state = null;
    var $country = null;
    var $viewad = null;
    var $owncoords = null;
    var $price = null;
    var $offpeak = null;
    var $showprice = null;
    var $freq = null;
    var $bond = null;
    var $closeprice = null;
    var $priceview = null;
    var $year = null;

    var $yearRemodeled = null;
    var $houseStyle = null;
    var $houseConstruction = null;
    var $exteriorFinish = null;
    var $roof = null;
    var $flooring = null;
    var $porchPatio = null;

    var $landtype = null;
    var $frontage = null;
    var $depth = null;

    var $subdivision = null;
    var $LandAreaSqFt = null;
    var $AcresTotal = null;
    var $LotDimensions = null;

    var $bedrooms = null;
    var $sleeps = null;
    var $totalrooms = null;
    var $otherrooms = null;

    var $livingarea = null;
    var $bathrooms = null;
    var $fullBaths = null;
    var $thqtrBaths = null;
    var $halfBaths = null;
    var $qtrBaths = null;
    var $ensuite = null;
    var $parking = null;

    var $garageDescription = null;
    var $parkingGarage = null;
    var $parkingCarport = null;

    var $stories = null;
    var $declat = null;
    var $declong = null;
    var $adline = null;
    var $alias = null;
    var $propdesc = null;
    var $smalldesc = null;
    var $panorama = null;
    var $mediaUrl = null;
    var $mediaType = null;
    var $pdfinfo1 = null;
    var $pdfinfo2 = null;
    var $epc1 = null;
    var $epc2 = null;
    var $flpl1 = null;
    var $flpl2 = null;
    var $ctown = null;
    var $ctport = null;
    var $schooldist = null;
    var $preschool = null;
    var $primaryschool = null;
    var $highschool = null;
    var $university = null;
    var $hofees = null;

    var $AnnualInsurance = null;
    var $TaxAnnual = null;
    var $TaxYear = null;
    var $Utlities = null;
    var $ElectricService = null;
    var $AverageUtilElec = null;
    var $AverageUtilHeat = null;

    var $BasementAndFoundation = null;
    var $BasementSize = null;
    var $BasementPctFinished = null;

    var $appliances = null;
    var $indoorfeatures = null;
    var $outdoorfeatures = null;
    var $buildingfeatures = null;
    var $communityfeatures = null;
    var $otherfeatures = null;

    var $CovenantsYN = null;
    var $PhoneAvailableYN = null;
    var $GarbageDisposalYN = null;
    var $RefrigeratorYN = null;
    var $OvenYN = null;
    var $FamilyRoomPresent = null;
    var $LaundryRoomPresent = null;
    var $KitchenPresent = null;
    var $LivingRoomPresent = null;
    var $ParkingSpaceYN = null;

    var $custom1 = null;
    var $custom2 = null;
    var $custom3 = null;
    var $custom4 = null;
    var $custom5 = null;
    var $custom6 = null;
    var $custom7 = null;
    var $custom8 = null;
    var $takings = null;
    var $returns = null;
    var $netprofit = null;
    var $bustype = null;
    var $bussubtype = null;
    var $stock = null;
    var $fixtures = null;
    var $fittings = null;
    var $squarefeet = null;

    var $SqFtLower = null;
    var $SqFtMainLevel = null;
    var $SqFtUpper = null;

    var $percentoffice = null;
    var $percentwarehouse = null;
    var $loadingfac = null;
    var $fencing = null;
    var $rainfall = null;
    var $soiltype = null;
    var $grazing = null;
    var $cropping = null;
    var $irrigation = null;
    var $waterresources = null;
    var $carryingcap = null;
    var $storage = null;
    var $services = null;
    var $currency_position = null;
    var $currency = null;
    var $currency_format = null;
    var $schoolprof = null;
    var $hoodprof = null;
    var $openhouse = null;
    var $ohouse_desc = null;
    var $ohdate = null;
    var $ohstarttime = null;
    var $ohendtime = null;
    var $ohdate2 = null;
    var $ohstarttime2 = null;
    var $ohendtime2 = null;
    var $viewbooking = null;
    var $availdate = null;
    var $aucdate = null;
    var $auctime = null;
    var $aucdet = null;
    var $private = null;
    var $listdate = null;
    var $lastupdate = null;
    var $expdate = null;
    var $closedate = null;
    var $contractdate = null;
    var $hits = null;
    var $sold = null;
    var $featured = null;
    var $camtype = null;
    var $office_id = null;
    var $mls_id = null;
    var $mls_agent = null;
    var $agentInfo = null;
    var $rets_source = null;
    var $mls_disclaimer = null;
    var $mls_image = null;
    var $oh_id = null;
    var $owner = null;
    var $assoc_agent = null;
    var $email_status = null;
    var $skipimp = null;
    var $metadesc = null;
    var $metakey = null;
    var $ordering = null;
    var $published = null;
    var $language = null;
    var $checked_out = null;
    var $checked_out_time = null;


    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct( &$db ) {
        parent::__construct('#__ezrealty', 'id', $db);
    }   
    
}

/**
 * Properties Table class for J1.7x
 *
 * @package    EZ Realty
 */
class TableEzrealty extends JTable
{
    /**
     * Primary Key
     *
     * @var int
    */
    var $id = null;
    var $type = null;
    var $rent_type = null;
    var $cid = null;
    var $locid = null;
    var $stid = null;
    var $cnid = null;
    var $soleAgency = null;
    var $bldg_name = null;
    var $unit_num = null;
    var $lot_num = null;
    var $street_num = null;
    var $address2 = null;
    var $postcode = null;
    var $county = null;
    var $locality = null;
    var $state = null;
    var $country = null;
    var $viewad = null;
    var $owncoords = null;
    var $price = null;
    var $offpeak = null;
    var $showprice = null;
    var $freq = null;
    var $bond = null;
    var $closeprice = null;
    var $priceview = null;
    var $year = null;

    var $yearRemodeled = null;
    var $houseStyle = null;
    var $houseConstruction = null;
    var $exteriorFinish = null;
    var $roof = null;
    var $flooring = null;
    var $porchPatio = null;

    var $landtype = null;
    var $frontage = null;
    var $depth = null;

    var $subdivision = null;
    var $LandAreaSqFt = null;
    var $AcresTotal = null;
    var $LotDimensions = null;

    var $bedrooms = null;
    var $sleeps = null;
    var $totalrooms = null;
    var $otherrooms = null;

    var $livingarea = null;
    var $bathrooms = null;
    var $fullBaths = null;
    var $thqtrBaths = null;
    var $halfBaths = null;
    var $qtrBaths = null;
    var $ensuite = null;
    var $parking = null;

    var $garageDescription = null;
    var $parkingGarage = null;
    var $parkingCarport = null;

    var $stories = null;
    var $declat = null;
    var $declong = null;
    var $adline = null;
    var $alias = null;
    var $propdesc = null;
    var $smalldesc = null;
    var $panorama = null;
    var $mediaUrl = null;
    var $mediaType = null;
    var $pdfinfo1 = null;
    var $pdfinfo2 = null;
    var $epc1 = null;
    var $epc2 = null;
    var $flpl1 = null;
    var $flpl2 = null;
    var $ctown = null;
    var $ctport = null;
    var $schooldist = null;
    var $preschool = null;
    var $primaryschool = null;
    var $highschool = null;
    var $university = null;
    var $hofees = null;

    var $AnnualInsurance = null;
    var $TaxAnnual = null;
    var $TaxYear = null;
    var $Utlities = null;
    var $ElectricService = null;
    var $AverageUtilElec = null;
    var $AverageUtilHeat = null;

    var $BasementAndFoundation = null;
    var $BasementSize = null;
    var $BasementPctFinished = null;
    var $appliances = null;
    var $indoorfeatures = null;
    var $outdoorfeatures = null;
    var $buildingfeatures = null;
    var $communityfeatures = null;
    var $otherfeatures = null;

    var $CovenantsYN = null;
    var $PhoneAvailableYN = null;
    var $GarbageDisposalYN = null;
    var $RefrigeratorYN = null;
    var $OvenYN = null;
    var $FamilyRoomPresent = null;
    var $LaundryRoomPresent = null;
    var $KitchenPresent = null;
    var $LivingRoomPresent = null;
    var $ParkingSpaceYN = null;

    var $custom1 = null;
    var $custom2 = null;
    var $custom3 = null;
    var $custom4 = null;
    var $custom5 = null;
    var $custom6 = null;
    var $custom7 = null;
    var $custom8 = null;
    var $takings = null;
    var $returns = null;
    var $netprofit = null;
    var $bustype = null;
    var $bussubtype = null;
    var $stock = null;
    var $fixtures = null;
    var $fittings = null;
    var $squarefeet = null;

    var $SqFtLower = null;
    var $SqFtMainLevel = null;
    var $SqFtUpper = null;

    var $percentoffice = null;
    var $percentwarehouse = null;
    var $loadingfac = null;
    var $fencing = null;
    var $rainfall = null;
    var $soiltype = null;
    var $grazing = null;
    var $cropping = null;
    var $irrigation = null;
    var $waterresources = null;
    var $carryingcap = null;
    var $storage = null;
    var $services = null;
    var $currency_position = null;
    var $currency = null;
    var $currency_format = null;
    var $schoolprof = null;
    var $hoodprof = null;
    var $openhouse = null;
    var $ohouse_desc = null;
    var $ohdate = null;
    var $ohstarttime = null;
    var $ohendtime = null;
    var $ohdate2 = null;
    var $ohstarttime2 = null;
    var $ohendtime2 = null;
    var $viewbooking = null;
    var $availdate = null;
    var $aucdate = null;
    var $auctime = null;
    var $aucdet = null;
    var $private = null;
    var $listdate = null;
    var $lastupdate = null;
    var $expdate = null;
    var $closedate = null;
    var $contractdate = null;
    var $hits = null;
    var $sold = null;
    var $featured = null;
    var $camtype = null;
    var $office_id = null;
    var $mls_id = null;
    var $mls_agent = null;
    var $agentInfo = null;
    var $rets_source = null;
    var $mls_disclaimer = null;
    var $mls_image = null;
    var $oh_id = null;
    var $owner = null;
    var $assoc_agent = null;
    var $email_status = null;
    var $skipimp = null;
    var $metadesc = null;
    var $metakey = null;
    var $ordering = null;
    var $published = null;
    var $language = null;
    var $checked_out = null;
    var $checked_out_time = null;


    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct( &$db ) {
        parent::__construct('#__ezrealty', 'id', $db);
    }   
    
}



?>