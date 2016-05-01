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


class EZRealtyUpgradesHelper {



	function upgradeStatus() {

		$app = &JFactory::getApplication();
		$db = & JFactory::getDBO();

		$result = '';

		# check for the fullBaths field which was added into the V7.1.0 #__ezrealty table, and if it doesn't exist - indicate an upgrade is needed

		$thedb = $app->getCfg('db');
		$pretab = $app->getCfg('dbprefix');

		$tabname1 = "ezrealty";
		$checktable = $pretab.$tabname1;

		$query = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$thedb' AND TABLE_NAME = '$checktable' AND COLUMN_NAME = 'fullBaths'";
		$db->setQuery($query);
		$db->query();
		$result = $db->getNumRows();


		# check for the prices admin menu item which was removed from the V7.2.0 EZ Realty version, and if it exists - indicate an upgrade is needed

		$query2 = "SELECT id FROM #__menu WHERE link = 'index.php?option=com_ezrealty&controller=prices' ";
		$db->setQuery($query2);
		$db->query();
		$preresult = $db->getNumRows();

		if ($preresult == 1){
			$result = 0;
		} else {
			$result = 1;
		}


        return $result;

	}


	# function to remove the price manager menu item which was removed from the V7.2.0 system

    function ezrealty720Upgrade() {

        $app = &JFactory::getApplication();
        $database =& JFactory::getDBO();

		$database->setQuery( "DELETE FROM #__menu WHERE link = 'index.php?option=com_ezrealty&controller=prices'" );

		if ( !$database->query() ) {
			echo "<script> alert('" . $database->getErrorMsg()
			. "'); window.history.go(-1); </script>\n";
		}

	}


	# function to add new fields for V7.1.0 into older V7x #__ezrealty tables

    function ezrealty710Upgrade() {

        $app = &JFactory::getApplication();
        $database =& JFactory::getDBO();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `soleAgency` tinyint ( 1 ) NOT NULL AFTER `cnid`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `bldg_name` varchar ( 30 ) NOT NULL AFTER `soleAgency`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `lot_num` varchar ( 10 ) NOT NULL AFTER `unit_num`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `fullBaths` tinyint ( 3 ) NOT NULL AFTER `bathrooms`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `thqtrBaths` tinyint ( 3 ) NOT NULL AFTER `fullBaths`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `halfBaths` tinyint ( 3 ) NOT NULL AFTER `thqtrBaths`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `qtrBaths` tinyint ( 3 ) NOT NULL AFTER `halfBaths`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `BasementAndFoundation` varchar ( 100 ) NOT NULL AFTER `hofees`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `BasementSize` varchar ( 50 ) NOT NULL AFTER `BasementAndFoundation`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `BasementPctFinished` varchar ( 50 ) NOT NULL AFTER `BasementSize`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `yearRemodeled` varchar ( 6 ) NOT NULL AFTER `year`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `houseStyle` varchar ( 6 ) NOT NULL AFTER `yearRemodeled`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `houseConstruction` varchar ( 6 ) NOT NULL AFTER `houseStyle`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `exteriorFinish` varchar ( 6 ) NOT NULL AFTER `houseConstruction`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `roof` varchar ( 6 ) NOT NULL AFTER `exteriorFinish`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `flooring` varchar ( 6 ) NOT NULL AFTER `roof`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `porchPatio` varchar ( 6 ) NOT NULL AFTER `flooring`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `subdivision` VARCHAR( 50 ) NOT NULL AFTER `depth` ,
		ADD `LandAreaSqFt` VARCHAR( 20 ) NOT NULL AFTER `subdivision` ,
		ADD `AcresTotal` VARCHAR( 20 ) NOT NULL AFTER `LandAreaSqFt` ,
		ADD `LotDimensions` VARCHAR( 20 ) NOT NULL AFTER `AcresTotal`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `CovenantsYN` TINYINT( 1 ) NOT NULL AFTER `otherfeatures` ,
ADD `PhoneAvailableYN` TINYINT( 1 ) NOT NULL AFTER `CovenantsYN` ,
ADD `GarbageDisposalYN` TINYINT( 1 ) NOT NULL AFTER `PhoneAvailableYN` ,
ADD `RefrigeratorYN` TINYINT( 1 ) NOT NULL AFTER `GarbageDisposalYN` ,
ADD `OvenYN` TINYINT( 1 ) NOT NULL AFTER `RefrigeratorYN` ,
ADD `FamilyRoomPresent` TINYINT( 1 ) NOT NULL AFTER `OvenYN` ,
ADD `LaundryRoomPresent` TINYINT( 1 ) NOT NULL AFTER `FamilyRoomPresent` ,
ADD `KitchenPresent` TINYINT( 1 ) NOT NULL AFTER `LaundryRoomPresent` ,
ADD `LivingRoomPresent` TINYINT( 1 ) NOT NULL AFTER `KitchenPresent` ,
ADD `ParkingSpaceYN` TINYINT( 1 ) NOT NULL AFTER `LivingRoomPresent`");
		$database->query();


		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `AnnualInsurance` DECIMAL( 15, 2 ) NOT NULL AFTER `hofees` ,
ADD `TaxAnnual` DECIMAL( 15, 2 ) NOT NULL AFTER `AnnualInsurance` ,
ADD `TaxYear` VARCHAR( 4 ) NOT NULL AFTER `TaxAnnual` ,
ADD `Utlities` TEXT NOT NULL AFTER `TaxYear` ,
ADD `ElectricService` VARCHAR( 30 ) NOT NULL AFTER `Utlities` ,
ADD `AverageUtilElec` DECIMAL( 15, 2 ) NOT NULL AFTER `ElectricService` ,
ADD `AverageUtilHeat` DECIMAL( 15, 2 ) NOT NULL AFTER `AverageUtilElec`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `SqFtLower` VARCHAR( 8 ) NOT NULL AFTER `squarefeet` ,
ADD `SqFtMainLevel` VARCHAR( 8 ) NOT NULL AFTER `SqFtLower` ,
ADD `SqFtUpper` VARCHAR( 8 ) NOT NULL AFTER `SqFtMainLevel`");
		$database->query();


		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `otherrooms` varchar ( 50 ) NOT NULL AFTER `totalrooms`");
		$database->query();


		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `garageDescription` VARCHAR( 150 ) NOT NULL AFTER `parking` ,
ADD `parkingGarage` VARCHAR( 15 ) NOT NULL AFTER `garageDescription` ,
ADD `parkingCarport` VARCHAR( 15 ) NOT NULL AFTER `parkingGarage`");
		$database->query();


		$database->setQuery("ALTER TABLE `#__ezrealty` CHANGE `parking` `parking` VARCHAR( 50 ) NOT NULL DEFAULT ''");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty` ADD `skipimp` tinyint ( 1 ) NOT NULL AFTER `email_status`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty_catg` CHANGE `description` `description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty_catg` ADD `metadesc` varchar ( 255 ) NOT NULL AFTER `image`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty_catg` ADD `metakey` varchar ( 255 ) NOT NULL AFTER `metadesc`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty_locality` ADD `postcode` varchar ( 10 ) NOT NULL AFTER `alias`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty_locality` ADD `zoom` tinyint ( 2 ) NOT NULL AFTER `declong`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty_locality` ADD `metadesc` varchar ( 255 ) NOT NULL AFTER `ezcity_desc`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty_locality` ADD `metakey` varchar ( 255 ) NOT NULL AFTER `metadesc`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty_state` ADD `metadesc` varchar ( 255 ) NOT NULL AFTER `alias`");
		$database->query();

		$database->setQuery("ALTER TABLE `#__ezrealty_state` ADD `metakey` varchar ( 255 ) NOT NULL AFTER `metadesc`");
		$database->query();



        $database->setQuery("CREATE TABLE IF NOT EXISTS `#__ezportal` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `alias` varchar(255) NOT NULL,
		  `uid` int(11) NOT NULL DEFAULT '0',
		  `cid` int(11) NOT NULL DEFAULT '0',
		  `seller_name` varchar(50) NOT NULL DEFAULT '',
		  `seller_company` varchar(50) NOT NULL DEFAULT '',
		  `job_title` varchar(100) NOT NULL DEFAULT '',
		  `seller_info` varchar(255) NOT NULL DEFAULT '',
		  `seller_bio` mediumtext NOT NULL,
		  `seller_unitnum` varchar(20) NOT NULL DEFAULT '',
		  `seller_address1` varchar(50) NOT NULL DEFAULT '',
		  `seller_address2` varchar(50) NOT NULL DEFAULT '',
		  `seller_suburb` varchar(50) NOT NULL DEFAULT '',
		  `seller_pcode` varchar(10) NOT NULL DEFAULT '',
		  `seller_state` varchar(50) NOT NULL DEFAULT '',
		  `seller_country` varchar(50) NOT NULL DEFAULT '',
		  `show_addy` tinyint(1) NOT NULL DEFAULT '0',
		  `seller_declat` varchar(20) NOT NULL DEFAULT '',
		  `seller_declong` varchar(20) NOT NULL DEFAULT '',
		  `seller_email` varchar(50) NOT NULL DEFAULT '',
		  `seller_phone` varchar(20) NOT NULL DEFAULT '',
		  `seller_fax` varchar(20) NOT NULL DEFAULT '',
		  `seller_mobile` varchar(20) NOT NULL DEFAULT '',
		  `seller_sms` varchar(20) NOT NULL DEFAULT '',
		  `show_sms` tinyint(1) NOT NULL DEFAULT '0',
		  `seller_exempt` tinyint(1) NOT NULL DEFAULT '0',
		  `seller_unlimited` tinyint(1) NOT NULL DEFAULT '0',
		  `feat_upgr` tinyint(1) NOT NULL DEFAULT '0',
		  `publish_own` tinyint(1) NOT NULL DEFAULT '0',
		  `reset_own` tinyint(1) NOT NULL DEFAULT '0',
		  `seller_fbook` varchar(50) NOT NULL,
		  `seller_twitter` varchar(50) NOT NULL,
		  `seller_pinterest` varchar(50) NOT NULL,
		  `seller_linkedin` varchar(50) NOT NULL,
		  `seller_youtube` varchar(50) NOT NULL,
		  `seller_msn` varchar(50) NOT NULL,
		  `seller_skype` varchar(50) NOT NULL DEFAULT '',
		  `seller_ymsgr` varchar(50) NOT NULL DEFAULT '',
		  `seller_icq` varchar(50) NOT NULL DEFAULT '',
		  `seller_web` varchar(255) NOT NULL DEFAULT '',
		  `seller_blog` varchar(255) NOT NULL DEFAULT '',
		  `seller_image` varchar(70) NOT NULL DEFAULT '',
		  `seller_logo` varchar(70) NOT NULL DEFAULT '',
		  `seller_banner` varchar(70) NOT NULL DEFAULT '',
		  `seller_pdfbkgr` varchar(70) NOT NULL DEFAULT '',
		  `seller_pdf` varchar(70) NOT NULL DEFAULT '',
		  `calcown` tinyint(1) NOT NULL DEFAULT '0',
		  `featured` tinyint(1) NOT NULL,
		  `metadesc` varchar(1024) NOT NULL DEFAULT '',
		  `metakey` varchar(1024) NOT NULL DEFAULT '',
		  `published` tinyint(1) NOT NULL DEFAULT '0',
		  `rets_source` char(30) NOT NULL DEFAULT '',
		  `listdate` date NOT NULL DEFAULT '0000-00-00',
		  `lastupdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
		  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		  `ordering` int(11) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`id`),
		  UNIQUE KEY `uid` (`uid`),
		  KEY `rets_source` (`rets_source`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8");
        $database->query();


	}






}
?>