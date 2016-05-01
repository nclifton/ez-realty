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


class EZRealtyMigrationHelper {



	function migrationStatus() {

		$app = &JFactory::getApplication();
		$db = & JFactory::getDBO();

		$result = '';

		$checktable = $app->getCfg('dbprefix')."ezrealty_incats";
		$db->setQuery( "SHOW TABLES LIKE '".$checktable."'" );
		$result = $db->loadObjectList();

        return $result;

	}


    function renameTables() {

        $app = &JFactory::getApplication();
        $database =& JFactory::getDBO();
		$thedb = $app->getCfg('config.db');


		$migtable1 = $app->getCfg('dbprefix')."ezrealty";

		$database->setQuery( "SHOW TABLES LIKE '".$migtable1."'" );
		$rows = $database->loadObjectList();

		if ($rows){

			$database->setQuery("RENAME TABLE `#__ezrealty` TO `#__ezrealty_old`");
			$database->query();

		}

		$migtable2 = $app->getCfg('dbprefix')."ezrealty_catg";

		$database->setQuery( "SHOW TABLES LIKE '".$migtable2."'" );
		$rows = $database->loadObjectList();

		if ($rows){

			$database->setQuery("RENAME TABLE `#__ezrealty_catg` TO `#__ezrealty_catg_old`");
			$database->query();

		}

		$migtable3 = $app->getCfg('dbprefix')."ezrealty_locality";

		$database->setQuery( "SHOW TABLES LIKE '".$migtable3."'" );
		$rows = $database->loadObjectList();

		if ($rows){

			$database->setQuery("RENAME TABLE `#__ezrealty_locality` TO `#__ezrealty_locality_old`");
			$database->query();

		}

		$migtable4 = $app->getCfg('dbprefix')."ezrealty_state";

		$database->setQuery( "SHOW TABLES LIKE '".$migtable4."'" );
		$rows = $database->loadObjectList();

		if ($rows){

			$database->setQuery("RENAME TABLE `#__ezrealty_state` TO `#__ezrealty_state_old`");
			$database->query();

		}

		$migtable5 = $app->getCfg('dbprefix')."ezrealty_country";

		$database->setQuery( "SHOW TABLES LIKE '".$migtable5."'" );
		$rows = $database->loadObjectList();

		if ($rows){

			$database->setQuery("RENAME TABLE `#__ezrealty_country` TO `#__ezrealty_country_old`");
			$database->query();

		}


		$migtable7 = $app->getCfg('dbprefix')."ezrealty_images";

		$database->setQuery( "SHOW TABLES LIKE '".$migtable7."'" );
		$rows = $database->loadObjectList();

		if ($rows){

			$database->setQuery("RENAME TABLE `#__ezrealty_images` TO `#__ezrealty_images_old`");
			$database->query();

		} else {

			// add a flag to check for and migrate old image data from old table structure into new images table

		}

		$migtable8 = $app->getCfg('dbprefix')."ezrealty_profile";

		$database->setQuery( "SHOW TABLES LIKE '".$migtable8."'" );
		$rows = $database->loadObjectList();

		if ($rows){

			$database->setQuery("RENAME TABLE `#__ezrealty_profile` TO `#__ezrealty_profile_old`");
			$database->query();

		}

		$migtable9 = $app->getCfg('dbprefix')."ezrealty_incats";

		$database->setQuery( "SHOW TABLES LIKE '".$migtable9."'" );
		$rows = $database->loadObjectList();

		if ($rows){

			$database->setQuery("RENAME TABLE `#__ezrealty_incats` TO `#__ezrealty_incats_old`");
			$database->query();

		} else {

			// add a flag to check for and migrate category information to the incats table

		}

		$migtable10 = $app->getCfg('dbprefix')."ezrealty_lightbox";

		$database->setQuery( "SHOW TABLES LIKE '".$migtable10."'" );
		$rows = $database->loadObjectList();

		if ($rows){

			$database->setQuery("RENAME TABLE `#__ezrealty_lightbox` TO `#__ezrealty_lightbox_old`");
			$database->query();

		}


	}

    function recreateTables() {

        $database =& JFactory::getDBO();
        $msg = JText::_('EZREALTY_DATA_MIGRATED');
        $app = &JFactory::getApplication();


        $database->setQuery("CREATE TABLE IF NOT EXISTS `#__ezrealty` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `type` int(11) NOT NULL DEFAULT '0',
		  `rent_type` tinyint(1) NOT NULL DEFAULT '0',
		  `cid` int(11) NOT NULL DEFAULT '0',
		  `locid` int(11) NOT NULL DEFAULT '0',
		  `stid` int(11) NOT NULL DEFAULT '0',
		  `cnid` int(11) NOT NULL DEFAULT '0',
		  `soleAgency` tinyint(1) NOT NULL DEFAULT '0',
		  `bldg_name` varchar(30) NOT NULL DEFAULT '',
		  `unit_num` varchar(20) NOT NULL DEFAULT '',
		  `lot_num` varchar(10) NOT NULL DEFAULT '',
		  `street_num` varchar(10) NOT NULL DEFAULT '',
		  `address2` varchar(255) NOT NULL DEFAULT '',
		  `postcode` varchar(10) NOT NULL DEFAULT '',
		  `county` varchar(50) NOT NULL DEFAULT '',
		  `locality` varchar(100) NOT NULL DEFAULT '',
		  `state` varchar(100) NOT NULL DEFAULT '',
		  `country` varchar(100) NOT NULL DEFAULT '',
		  `viewad` tinyint(1) NOT NULL DEFAULT '0',
		  `owncoords` tinyint(1) NOT NULL DEFAULT '0',
		  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
		  `offpeak` decimal(15,2) NOT NULL DEFAULT '0.00',
		  `showprice` tinyint(1) NOT NULL DEFAULT '0',
		  `freq` int(11) NOT NULL DEFAULT '0',
		  `bond` decimal(15,2) NOT NULL DEFAULT '0.00',
		  `closeprice` decimal(15,2) NOT NULL DEFAULT '0.00',
		  `priceview` varchar(100) NOT NULL DEFAULT '',
		  `year` varchar(6) NOT NULL DEFAULT '',
		  `yearRemodeled` varchar(6) NOT NULL DEFAULT '',
		  `houseStyle` varchar(30) NOT NULL DEFAULT '',
		  `houseConstruction` varchar(30) NOT NULL DEFAULT '',
		  `exteriorFinish` varchar(30) NOT NULL DEFAULT '',
		  `roof` varchar(30) NOT NULL DEFAULT '',
		  `flooring` varchar(30) NOT NULL DEFAULT '',
		  `porchPatio` varchar(30) NOT NULL DEFAULT '',
		  `landtype` varchar(50) NOT NULL DEFAULT '',
		  `frontage` varchar(30) NOT NULL DEFAULT '',
		  `depth` varchar(30) NOT NULL DEFAULT '',
		  `subdivision` varchar(50) NOT NULL DEFAULT '',
		  `LandAreaSqFt` varchar(20) NOT NULL DEFAULT '',
		  `AcresTotal` varchar(20) NOT NULL DEFAULT '',
		  `LotDimensions` varchar(20) NOT NULL DEFAULT '',
		  `bedrooms` tinyint(3) NOT NULL DEFAULT '0',
		  `sleeps` tinyint(3) NOT NULL DEFAULT '0',
		  `totalrooms` varchar(5) NOT NULL DEFAULT '',
		  `otherrooms` varchar(50) NOT NULL DEFAULT '',
		  `livingarea` varchar(30) NOT NULL DEFAULT '',
		  `bathrooms` float(15,2) NOT NULL,
		  `fullBaths` tinyint(3) NOT NULL DEFAULT '0',
		  `thqtrBaths` tinyint(3) NOT NULL DEFAULT '0',
		  `halfBaths` tinyint(3) NOT NULL DEFAULT '0',
		  `qtrBaths` tinyint(3) NOT NULL DEFAULT '0',
		  `ensuite` tinyint(1) NOT NULL DEFAULT '0',
		  `parking` varchar(55) NOT NULL DEFAULT '',
		  `garageDescription` varchar(150) NOT NULL DEFAULT '',
		  `parkingGarage` varchar(15) NOT NULL DEFAULT '',
		  `parkingCarport` varchar(15) NOT NULL DEFAULT '',
		  `stories` tinyint(3) NOT NULL DEFAULT '0',
		  `declat` varchar(20) NOT NULL DEFAULT '',
		  `declong` varchar(20) NOT NULL DEFAULT '',
		  `adline` varchar(255) NOT NULL DEFAULT '',
		  `alias` varchar(255) NOT NULL DEFAULT '',
		  `propdesc` mediumtext NOT NULL DEFAULT '',
		  `smalldesc` varchar(255) NOT NULL DEFAULT '',
		  `panorama` varchar(70) NOT NULL DEFAULT '',
		  `mediaUrl` varchar(1024) NOT NULL DEFAULT '',
		  `mediaType` tinyint(1) NOT NULL DEFAULT '0',
		  `pdfinfo1` varchar(50) NOT NULL DEFAULT '',
		  `pdfinfo2` varchar(50) NOT NULL DEFAULT '',
		  `epc1` varchar(50) NOT NULL DEFAULT '',
		  `epc2` varchar(50) NOT NULL DEFAULT '',
		  `flpl1` varchar(50) NOT NULL DEFAULT '',
		  `flpl2` varchar(50) NOT NULL DEFAULT '',
		  `ctown` varchar(150) NOT NULL DEFAULT '',
		  `ctport` varchar(150) NOT NULL DEFAULT '',
		  `schooldist` varchar(60) NOT NULL DEFAULT '',
		  `preschool` varchar(60) NOT NULL DEFAULT '',
		  `primaryschool` varchar(60) NOT NULL DEFAULT '',
		  `highschool` varchar(60) NOT NULL DEFAULT '',
		  `university` varchar(60) NOT NULL DEFAULT '',
		  `hofees` varchar(10) NOT NULL DEFAULT '',
		  `AnnualInsurance` decimal(15,2) NOT NULL,
		  `TaxAnnual` decimal(15,2) NOT NULL,
		  `TaxYear` varchar(4) NOT NULL DEFAULT '',
		  `Utlities` text NOT NULL DEFAULT '',
		  `ElectricService` varchar(30) NOT NULL DEFAULT '',
		  `AverageUtilElec` decimal(15,2) NOT NULL,
		  `AverageUtilHeat` decimal(15,2) NOT NULL,
		  `BasementAndFoundation` varchar(100) NOT NULL DEFAULT '',
		  `BasementSize` varchar(50) NOT NULL DEFAULT '',
		  `BasementPctFinished` varchar(50) NOT NULL DEFAULT '',
		  `appliances` text NOT NULL DEFAULT '',
		  `indoorfeatures` text NOT NULL DEFAULT '',
		  `outdoorfeatures` text NOT NULL DEFAULT '',
		  `buildingfeatures` text NOT NULL DEFAULT '',
		  `communityfeatures` text NOT NULL DEFAULT '',
		  `otherfeatures` text NOT NULL DEFAULT '',
		  `CovenantsYN` tinyint(1) NOT NULL DEFAULT '0',
		  `PhoneAvailableYN` tinyint(1) NOT NULL DEFAULT '0',
		  `GarbageDisposalYN` tinyint(1) NOT NULL DEFAULT '0',
		  `RefrigeratorYN` tinyint(1) NOT NULL DEFAULT '0',
		  `OvenYN` tinyint(1) NOT NULL DEFAULT '0',
		  `FamilyRoomPresent` tinyint(1) NOT NULL DEFAULT '0',
		  `LaundryRoomPresent` tinyint(1) NOT NULL DEFAULT '0',
		  `KitchenPresent` tinyint(1) NOT NULL DEFAULT '0',
		  `LivingRoomPresent` tinyint(1) NOT NULL DEFAULT '0',
		  `ParkingSpaceYN` tinyint(1) NOT NULL DEFAULT '0',
		  `custom1` varchar(150) NOT NULL DEFAULT '',
		  `custom2` varchar(150) NOT NULL DEFAULT '',
		  `custom3` varchar(150) NOT NULL DEFAULT '',
		  `custom4` varchar(150) NOT NULL DEFAULT '',
		  `custom5` varchar(150) NOT NULL DEFAULT '',
		  `custom6` varchar(150) NOT NULL DEFAULT '',
		  `custom7` varchar(150) NOT NULL DEFAULT '',
		  `custom8` varchar(150) NOT NULL DEFAULT '',
		  `takings` varchar(30) NOT NULL DEFAULT '',
		  `returns` varchar(30) NOT NULL DEFAULT '',
		  `netprofit` varchar(30) NOT NULL DEFAULT '',
		  `bustype` varchar(30) NOT NULL DEFAULT '',
		  `bussubtype` varchar(30) NOT NULL DEFAULT '',
		  `stock` varchar(50) NOT NULL DEFAULT '',
		  `fixtures` varchar(50) NOT NULL DEFAULT '',
		  `fittings` varchar(50) NOT NULL DEFAULT '',
		  `squarefeet` varchar(50) NOT NULL DEFAULT '',
		  `SqFtLower` varchar(8) NOT NULL DEFAULT '',
		  `SqFtMainLevel` varchar(8) NOT NULL DEFAULT '',
		  `SqFtUpper` varchar(8) NOT NULL DEFAULT '',
		  `percentoffice` varchar(50) NOT NULL DEFAULT '',
		  `percentwarehouse` varchar(50) NOT NULL DEFAULT '',
		  `loadingfac` varchar(50) NOT NULL DEFAULT '',
		  `fencing` varchar(50) NOT NULL DEFAULT '',
		  `rainfall` varchar(50) NOT NULL DEFAULT '',
		  `soiltype` varchar(50) NOT NULL DEFAULT '',
		  `grazing` varchar(50) NOT NULL DEFAULT '',
		  `cropping` varchar(50) NOT NULL DEFAULT '',
		  `irrigation` varchar(50) NOT NULL DEFAULT '',
		  `waterresources` varchar(100) NOT NULL DEFAULT '',
		  `carryingcap` varchar(50) NOT NULL DEFAULT '',
		  `storage` varchar(50) NOT NULL DEFAULT '',
		  `services` varchar(50) NOT NULL DEFAULT '',
		  `currency_position` tinyint(1) NOT NULL DEFAULT '0',
		  `currency` char(3) NOT NULL DEFAULT '',
		  `currency_format` tinyint(1) NOT NULL DEFAULT '0',
		  `schoolprof` tinyint(1) NOT NULL DEFAULT '0',
		  `hoodprof` tinyint(1) NOT NULL DEFAULT '0',
		  `openhouse` tinyint(1) DEFAULT '0',
		  `ohouse_desc` text NOT NULL,
		  `ohdate` date NOT NULL DEFAULT '0000-00-00',
		  `ohstarttime` time NOT NULL DEFAULT '00:00:00',
		  `ohendtime` time NOT NULL DEFAULT '00:00:00',
		  `ohdate2` date NOT NULL DEFAULT '0000-00-00',
		  `ohstarttime2` time NOT NULL DEFAULT '00:00:00',
		  `ohendtime2` time NOT NULL DEFAULT '00:00:00',
		  `viewbooking` tinyint(1) NOT NULL DEFAULT '0',
		  `availdate` date NOT NULL DEFAULT '0000-00-00',
		  `aucdate` date NOT NULL DEFAULT '0000-00-00',
		  `auctime` time NOT NULL DEFAULT '00:00:00',
		  `aucdet` varchar(255) NOT NULL DEFAULT '',
		  `private` text NOT NULL,
		  `office_id` varchar(30) NOT NULL DEFAULT '',
		  `mls_id` varchar(30) NOT NULL DEFAULT '',
		  `mls_agent` varchar(30) NOT NULL DEFAULT '',
		  `agentInfo` text NOT NULL,
		  `rets_source` char(30) DEFAULT NULL,
		  `mls_disclaimer` text NOT NULL,
		  `mls_image` varchar(255) NOT NULL,
		  `oh_id` char(30) DEFAULT NULL,
		  `closedate` varchar(20) NOT NULL DEFAULT '',
		  `contractdate` varchar(20) NOT NULL DEFAULT '',
		  `sold` varchar(50) NOT NULL DEFAULT '',
		  `featured` tinyint(1) NOT NULL DEFAULT '0',
		  `camtype` int(11) NOT NULL DEFAULT '0',
		  `owner` int(11) NOT NULL DEFAULT '0',
		  `assoc_agent` int(11) NOT NULL DEFAULT '0',
		  `email_status` tinyint(1) NOT NULL DEFAULT '0',
		  `skipimp` tinyint(1) NOT NULL DEFAULT '0',
		  `listdate` date NOT NULL DEFAULT '0000-00-00',
		  `lastupdate` varchar(20) NOT NULL DEFAULT '',
		  `expdate` varchar(20) NOT NULL DEFAULT '',
		  `metadesc` varchar(255) NOT NULL DEFAULT '',
		  `metakey` varchar(255) NOT NULL DEFAULT '',
		  `hits` int(11) NOT NULL DEFAULT '0',
		  `published` tinyint(1) NOT NULL DEFAULT '0',
		  `language` char(7) NOT NULL,
		  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
		  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		  `ordering` int(11) DEFAULT NULL,
		  PRIMARY KEY (`id`),
		  KEY `rets_source` (`rets_source`),
		  KEY `locid` (`locid`),
		  KEY `stid` (`stid`),
		  KEY `cnid` (`cnid`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8");
        $database->query();


        $database->setQuery("CREATE TABLE IF NOT EXISTS `#__ezrealty_locality` (
		`id` int(11) NOT NULL auto_increment,
		`stateid` int(11) NOT NULL default '0',
		`ezcity` varchar (255) NOT NULL DEFAULT '',
		`alias` varchar (255) NOT NULL DEFAULT '',
		`postcode` varchar(10) NOT NULL DEFAULT '',
		`declat` varchar(20) NOT NULL DEFAULT '',
		`declong` varchar(20) NOT NULL DEFAULT '',
		`zoom` tinyint(2) NOT NULL default '0',
		`owncoords` tinyint(1) NOT NULL DEFAULT '0',
		`image` varchar (70) NOT NULL DEFAULT '',
		`ezcity_desc` TEXT NOT NULL DEFAULT '',
		`metadesc` varchar(255) NOT NULL DEFAULT '',
		`metakey` varchar(255) NOT NULL DEFAULT '',
		`published` tinyint(1) NOT NULL default '1',
		`language` char(7) NOT NULL DEFAULT '',
		`checked_out` tinyint(1) NOT NULL default '0',
		`checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
		`ordering` int(11) NOT NULL default '0',
		PRIMARY KEY  (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8");
        $database->query();


        $database->setQuery("CREATE TABLE IF NOT EXISTS `#__ezrealty_state` (
		`id` int(11) NOT NULL auto_increment,
		`countid` int(11) NOT NULL default '0',
		`name` varchar (255) NOT NULL,
		`alias` varchar (255) NOT NULL,
		`declat` varchar(20) NOT NULL DEFAULT '',
		`declong` varchar(20) NOT NULL DEFAULT '',
		`metadesc` varchar(255) NOT NULL DEFAULT '',
		`metakey` varchar(255) NOT NULL DEFAULT '',
		`owncoords` tinyint(1) NOT NULL DEFAULT '0',
		`published` tinyint(1) NOT NULL default '1',
		`language` char(7) NOT NULL,
		`checked_out` tinyint(1) NOT NULL default '0',
		`checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
		`ordering` int(11) NOT NULL default '0',
		PRIMARY KEY  (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8");
        $database->query();


        $database->setQuery("CREATE TABLE IF NOT EXISTS `#__ezrealty_country` (
		`id` int(11) NOT NULL auto_increment,
		`name` varchar (255) NOT NULL,
		`alias` varchar (255) NOT NULL,
		`declat` varchar(20) NOT NULL DEFAULT '',
		`declong` varchar(20) NOT NULL DEFAULT '',
		`owncoords` tinyint(1) NOT NULL DEFAULT '0',
		`published` tinyint(1) NOT NULL default '1',
		`language` char(7) NOT NULL,
		`checked_out` tinyint(1) NOT NULL default '0',
		`checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
		`ordering` int(11) NOT NULL default '0',
		PRIMARY KEY  (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8");
        $database->query();


        $database->setQuery("CREATE TABLE IF NOT EXISTS `#__ezrealty_catg` (
		`id` int(11) NOT NULL auto_increment,
		`name` varchar(255) NOT NULL default '',
		`alias` varchar(255) NOT NULL default '',
		`description` text NOT NULL default '',
		`image` varchar(255) NOT NULL default '',
		`metadesc` varchar(255) NOT NULL DEFAULT '',
		`metakey` varchar(255) NOT NULL DEFAULT '',
		`access` tinyint(3) unsigned NOT NULL default '0',
		`published` tinyint(1) NOT NULL default '1',
		`language` char(7) NOT NULL,
		`ordering` int(11) NOT NULL default '0',
		`checked_out` tinyint(1) NOT NULL default '0',
		`checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
		PRIMARY KEY  (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8");
        $database->query();


        $database->setQuery("CREATE TABLE IF NOT EXISTS `#__ezrealty_incats` (
		`property_id` int(11) NOT NULL,
		`category_id` int(11) NOT NULL,
		PRIMARY KEY(`property_id`,`category_id`),
		INDEX `property_id` (`property_id`),
		INDEX `category_id` (`category_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8");
        $database->query();


        $database->setQuery("CREATE TABLE IF NOT EXISTS `#__ezrealty_images` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`propid` int(11) NOT NULL,
		`fname` varchar(255) NOT NULL default '',
		`title` varchar(70) NOT NULL default '',
		`description` varchar(255) NOT NULL default '',
		`path` varchar(255) NOT NULL default '',
		`rets_source` char(30) NOT NULL default '',
		`ordering` int(11) NOT NULL default '0',
		PRIMARY KEY (`id`),
		KEY `propid` (`propid`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8");
        $database->query();


        $database->setQuery("CREATE TABLE IF NOT EXISTS `#__ezrealty_lightbox` (
		`id` int(11) NOT NULL auto_increment,
		`uid` int(11) NOT NULL default '0',
		`propid` int(11) NOT NULL default '0',
		`date` varchar(20) default NULL,
		PRIMARY KEY  (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8");
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






/**************************************************************\
  MIGRATE DATA FROM THE OLD VERSION TABLES INTO THE NEW TABLES
\**************************************************************/


    function migrateData() {

        $database =& JFactory::getDBO();
        $msg = JText::_('EZREALTY_DATA_MIGRATED');
        $app = &JFactory::getApplication();



		# migrate the shortlist data from the old table into the J3.0x EZ Realty shortlist table

		$query = "INSERT INTO #__ezrealty_lightbox ( id, uid, propid, date ) SELECT id, uid, propid, date FROM #__ezrealty_lightbox_old";
		$database->setQuery($query);
		$database->query();


		# migrate the image data from the old table into the J3.0x EZ Realty images table



      # find out if the new images table has been created

		$imgtable = $app->getCfg('dbprefix')."ezrealty_images_old";


		$database->setQuery( "SHOW TABLES LIKE '".$imgtable."'" );
		$rows = $database->loadObjectList();

		if ($rows){

			$query = "INSERT INTO #__ezrealty_images (propid, fname, title, description, path, rets_source, ordering) SELECT propid, fname, title, description, path, rets_source, ordering FROM #__ezrealty_images_old";
			$database->setQuery($query);
			$database->query();

		} else {

			// we need to transfer the images from the old #__ezrealty table into the new images table
			//query the EZ Realty database and find all of the properties

			$query = "SELECT * FROM #__ezrealty_old";
			$database->setQuery( $query );
			$rows = $database->loadObjectList();

			foreach($rows as $row) {

			//while looping through the listings - check images 1-24 and insert their details into the new EZ Realty images table

				for($i=1; $i < 24+1; $i++){
					$cur_img="image".$i;
					$img_desc="image".$i."desc";

	        		if($row->$cur_img){
	        			$query  = '  INSERT INTO #__ezrealty_images SET ';
	        			$query .= '  propid = '.intval($row->id);
	        			$query .= ', fname = "'.$row->$cur_img.'"';        			
	        			$query .= ', title = "'.$row->$img_desc.'"';        			
	        			$query .= ', ordering = "'.intval($i).'"';
	        			$database->setQuery($query);	        			
	        			$database->Query();
	        		}
				}
			}
		}



		#	migrate the categories

		$query = "SELECT * FROM #__ezrealty_catg_old";
		$database->setQuery( $query );
		$rows = $database->loadObjectList();

		if ($rows) {

			$k = 0;
			for ($i=0, $n=count( $rows ); $i < $n; $i++) {
				$row = $rows[$i];

				if ( !$row->alias ) {
					$alias = $row->name;
					$thealias = JApplication::stringURLSafe($alias);
				} else {
					$thealias = $row->alias;
				}

				$database->setQuery("INSERT INTO `#__ezrealty_catg` ( 
				`id` , `name` , `alias` , `description` , `image` , `metadesc` , `metakey` , `access` , `published` , `language` , `checked_out` , `checked_out_time` , `ordering` 
				) VALUES (
				'".addslashes($row->id)."', '".addslashes($row->name)."', '".addslashes($thealias)."', '".addslashes($row->description)."', '".addslashes($row->image)."', '', '', '".addslashes($row->access)."', '".addslashes($row->published)."', '".addslashes($row->language)."', '".addslashes($row->checked_out)."', '".addslashes($row->checked_out_time)."', '".addslashes($row->ordering)."')");
				$database->query();
			}
		}


		#	migrate the suburbs

		$query = "SELECT * FROM #__ezrealty_locality_old";
		$database->setQuery( $query );
		$rows = $database->loadObjectList();

		if ($rows) {

			$k = 0;
			for ($i=0, $n=count( $rows ); $i < $n; $i++) {
				$row = $rows[$i];

				$alias = $row->ezcity;
				$thealias = JApplication::stringURLSafe($alias);

				$database->setQuery("INSERT INTO `#__ezrealty_locality` ( 
				`id` , `stateid` , `ezcity` , `alias` , `postcode` , `declat` , `declong` , `zoom` , `owncoords` , `image` , `ezcity_desc` , `metadesc` , `metakey` , `published` , `language` , `checked_out` , `checked_out_time` , `ordering` 
				) VALUES (
				'".addslashes($row->id)."', '".addslashes($row->stateid)."', '".addslashes($row->ezcity)."', '".addslashes($thealias)."', '', '', '', '', '', '".addslashes($row->image)."', '".addslashes($row->ezcity_desc)."', '', '', '".addslashes($row->published)."', '".addslashes($row->language)."', '".addslashes($row->checked_out)."', '".addslashes($row->checked_out_time)."', '".addslashes($row->ordering)."')");
				$database->query();
			}
		}


		#	migrate the states

		$query = "SELECT * FROM #__ezrealty_state_old";
		$database->setQuery( $query );
		$rows = $database->loadObjectList();

		if ($rows) {

			$k = 0;
			for ($i=0, $n=count( $rows ); $i < $n; $i++) {
				$row = $rows[$i];

				$alias = $row->name;
				$thealias = JApplication::stringURLSafe($alias);

				$database->setQuery("INSERT INTO `#__ezrealty_state` ( 
				`id` , `countid` , `name` , `alias` , `declat` , `declong` , `metadesc` , `metakey` , `owncoords` , `published` , `language` , `checked_out` , `checked_out_time` , `ordering` 
				) VALUES (
				'".addslashes($row->id)."', '".addslashes($row->countid)."', '".addslashes($row->name)."', '".addslashes($thealias)."', '', '', '', '', '', '".addslashes($row->published)."', '".addslashes($row->language)."', '".addslashes($row->checked_out)."', '".addslashes($row->checked_out_time)."', '".addslashes($row->ordering)."')");
				$database->query();
			}
		}


		#	migrate the countries

		$query = "SELECT * FROM #__ezrealty_country_old";
		$database->setQuery( $query );
		$rows = $database->loadObjectList();

		if ($rows) {

			$k = 0;
			for ($i=0, $n=count( $rows ); $i < $n; $i++) {
				$row = $rows[$i];

				$alias = $row->name;
				$thealias = JApplication::stringURLSafe($alias);

				$database->setQuery("INSERT INTO `#__ezrealty_country` ( 
				`id` , `name` , `alias` , `declat` , `declong` , `owncoords` , `published` , `language` , `checked_out` , `checked_out_time` , `ordering` 
				) VALUES (
				'".addslashes($row->id)."', '".addslashes($row->name)."', '".addslashes($thealias)."', '', '', '', '".addslashes($row->published)."', '".addslashes($row->language)."', '".addslashes($row->checked_out)."', '".addslashes($row->checked_out_time)."', '".addslashes($row->ordering)."')");
				$database->query();
			}
		}


		#	migrate the old EZ Realty profile information into EZ Portal table


		$query = "SELECT * FROM #__ezrealty_profile_old";
		$database->setQuery( $query );
		$rows = $database->loadObjectList();

		if ($rows) {

			$k = 0;
			for ($i=0, $n=count( $rows ); $i < $n; $i++) {
				$row = $rows[$i];

				$alias = $row->dealer_name;
				$thealias = JApplication::stringURLSafe($alias);

				$database->setQuery("INSERT INTO `#__ezportal` (`id` , `alias` , `uid` , `cid` , `seller_name` ,
				`seller_company` , `job_title` , `seller_info` , `seller_bio` , `seller_unitnum` , 
				`seller_address1` , `seller_address2` , `seller_suburb` , `seller_pcode` , `seller_state` , 
				`seller_country` , `show_addy` , `seller_declat` , `seller_declong` , `seller_email` , 
				`seller_phone` , `seller_fax` , `seller_mobile` , `seller_sms` , `show_sms` , 
				`seller_exempt` , `seller_unlimited` , `feat_upgr` , `publish_own` , `reset_own` , 
				`seller_fbook` , `seller_twitter` , `seller_pinterest` , `seller_linkedin` , `seller_youtube` , 
				`seller_msn` , `seller_skype` , `seller_ymsgr` , `seller_icq` , `seller_web` , 
				`seller_blog` , `seller_image` , `seller_logo` , `seller_banner` , `seller_pdfbkgr` , 
				`seller_pdf` , `calcown` , `featured` , `metadesc` , `metakey` , 
				`published` , `rets_source` , `listdate` , `lastupdate` , `checked_out` , 
				`checked_out_time` , `ordering`) VALUES ('".addslashes($row->id)."' , '".addslashes($thealias)."' , '".addslashes($row->mid)."' , '' , '".addslashes($row->dealer_name)."' , 
				'".addslashes($row->dealer_company)."', '', '".addslashes($row->dealer_info)."', '".addslashes($row->dealer_bio)."', '".addslashes($row->dealer_unitnum)."', 
				'".addslashes($row->dealer_address1)."', '".addslashes($row->dealer_address2)."', '".addslashes($row->dealer_locality)."', '".addslashes($row->dealer_pcode)."', '".addslashes($row->dealer_state)."', 
				'".addslashes($row->dealer_country)."', '".addslashes($row->show_addy)."', '".addslashes($row->dealer_declat)."', '".addslashes($row->dealer_declong)."', '".addslashes($row->dealer_email)."', 
				'".addslashes($row->dealer_phone)."', '".addslashes($row->dealer_fax)."', '".addslashes($row->dealer_mobile)."', '' , '' , 
				'".addslashes($row->dealer_exempt)."', '', '".addslashes($row->feat_upgr)."', '".addslashes($row->publish_own)."', '".addslashes($row->reset_own)."', 
				'' , '' , '' , '' , '' , 
				'' , '".addslashes($row->dealer_skype)."', '".addslashes($row->dealer_ymsgr)."', '".addslashes($row->dealer_icq)."', '".addslashes($row->dealer_web)."', 
				'".addslashes($row->dealer_blog)."', '".addslashes($row->dealer_image)."', '".addslashes($row->logo_image)."', '".addslashes($row->page_topper)."', '', 
				'".addslashes($row->pdf_promo)."' , '' , '' , '' , '' , 
				'".addslashes($row->published)."' , '' , '' , '' , '' , 
				'','' )");
				$database->query();

			}
		}



		#	update the empty listdate and lastupdate values

            $listdate = date("Y-m-d");
			$lastupdate=date("Y-m-d H:i:s");


			$database->setQuery("UPDATE #__ezportal SET #__ezportal.listdate = '$listdate' WHERE #__ezportal.listdate = '0000-00-00'");
			$database->query();

			$database->setQuery("UPDATE #__ezportal SET #__ezportal.lastupdate = '$lastupdate' WHERE #__ezportal.lastupdate = '0000-00-00 00:00:00'");
			$database->query();




		#	migrate the properties

		$query = "SELECT * FROM #__ezrealty_old";
		$database->setQuery( $query );
		$rows = $database->loadObjectList();

		if ($rows) {

			$k = 0;
			for ($i=0, $n=count( $rows ); $i < $n; $i++) {
				$row = $rows[$i];

				if ($row->pool){
					$pool = JText::_('EZREALTY_APF1').";";
				} else {
					$pool = "";
				}
				if ($row->fplace){
					$fplace = JText::_('EZREALTY_APF2').";";
				} else {
					$fplace = "";
				}
				if ($row->bbq){
					$bbq = JText::_('EZREALTY_APF3').";";
				} else {
					$bbq = "";
				}
				if ($row->gazebo){
					$gazebo = JText::_('EZREALTY_APF4').";";
				} else {
					$gazebo = "";
				}
				if ($row->lug){
					$lug = JText::_('EZREALTY_APF5').";";
				} else {
					$lug = "";
				}
				if ($row->bir){
					$bir = JText::_('EZREALTY_APF6').";";
				} else {
					$bir = "";
				}
				if ($row->heating){
					$heating = JText::_('EZREALTY_APF7').";";
				} else {
					$heating = "";
				}
				if ($row->airco){
					$airco = JText::_('EZREALTY_APF8').";";
				} else {
					$airco = "";
				}
				if ($row->shops){
					$shops = JText::_('EZREALTY_APF9').";";
				} else {
					$shops = "";
				}
				if ($row->schools){
					$schools = JText::_('EZREALTY_APF10').";";
				} else {
					$schools = "";
				}
				if ($row->elevator){
					$elevator = JText::_('EZREALTY_APF12').";";
				} else {
					$elevator = "";
				}
				if ($row->extra1){
					$extra1 = JText::_('EZREALTY_APF13').";";
				} else {
					$extra1 = "";
				}
				if ($row->extra2){
					$extra2 = JText::_('EZREALTY_APF14').";";
				} else {
					$extra2 = "";
				}
				if ($row->extra3){
					$extra3 = JText::_('EZREALTY_APF15').";";
				} else {
					$extra3 = "";
				}
				if ($row->extra4){
					$extra4 = JText::_('EZREALTY_APF16').";";
				} else {
					$extra4 = "";
				}
				if ($row->extra5){
					$extra5 = JText::_('EZREALTY_APF17').";";
				} else {
					$extra5 = "";
				}
				if ($row->extra6){
					$extra6 = JText::_('EZREALTY_APF18').";";
				} else {
					$extra6 = "";
				}
				if ($row->extra7){
					$extra7 = JText::_('EZREALTY_APF19').";";
				} else {
					$extra7 = "";
				}
				if ($row->extra8){
					$extra8 = JText::_('EZREALTY_APF20').";";
				} else {
					$extra8 = "";
				}
				if ($row->pets){
					$pets = JText::_('EZREALTY_APF11').";";
				} else {
					$pets = "";
				}
				if ( $row->furnished==1 ) {
					$furnished = JText::_('EZREALTY_FURNISHED2').";";
				} else if ( $row->furnished==2 ) {
					$furnished = JText::_('EZREALTY_FURNISHED3').";";
				} else if ( $row->furnished==3 ) {
					$furnished = JText::_('EZREALTY_FURNISHED4').";";
				} else {
					$furnished = "";
				}

				if ( !$row->alias ) {
					$alias = $row->adline;
					$thealias = JApplication::stringURLSafe($alias);
				} else {
					$thealias = $row->alias;
				}

				$appliances = "";
				$indoorfeatures = $fplace.$bir.$furnished;
				$outdoorfeatures = $pool.$bbq.$gazebo.$lug;
				$buildingfeatures = $heating.$airco.$elevator.$pets;
				$communityfeatures = $shops.$schools;
				$otherfeatures = $extra1.$extra2.$extra3.$extra4.$extra5.$extra6.$extra7.$extra8;

				if ($row->vidtype == 1){
					$mediaUrl = $row->vtour;
					$mediaType = "1";
				} else {
					$mediaUrl = "";
					$mediaType = "0";
				}


				$id = isset($row->id) ? $row->id : '';
				$type = isset($row->type) ? $row->type : '';
				$rent_type = isset($row->rent_type) ? $row->rent_type : '';
				$cid = isset($row->cid) ? $row->cid : '';
				$locid = isset($row->locid) ? $row->locid : '';
				$stid = isset($row->stid) ? $row->stid : '';
				$cnid = isset($row->cnid) ? $row->cnid : '';
				$soleAgency = isset($row->soleAgency) ? $row->soleAgency : '';
				$bldg_name = isset($row->bldg_name) ? $row->bldg_name : '';
				$unit_num = isset($row->unit_num) ? $row->unit_num : '';

				$lot_num = isset($row->lot_num) ? $row->lot_num : '';
				$street_num = isset($row->street_num) ? $row->street_num : '';
				$address2 = isset($row->address2) ? $row->address2 : '';
				$postcode = isset($row->postcode) ? $row->postcode : '';
				$county = isset($row->county) ? $row->county : '';
				$locality = isset($row->locality) ? $row->locality : '';
				$state = isset($row->state) ? $row->state : '';
				$country = isset($row->country) ? $row->country : '';
				$viewad = isset($row->viewad) ? $row->viewad : '';
				$owncoords = isset($row->owncoords) ? $row->owncoords : '';

				$price = isset($row->price) ? $row->price : '';
				$offpeak = isset($row->offpeak) ? $row->offpeak : '';
				$showprice = isset($row->showprice) ? $row->showprice : '';
				$freq = isset($row->freq) ? $row->freq : '';
				$bond = isset($row->bond) ? $row->bond : '';
				$closeprice = isset($row->closeprice) ? $row->closeprice : '';
				$priceview = isset($row->priceview) ? $row->priceview : '';
				$year = isset($row->year) ? $row->year : '';
				$yearRemodeled = isset($row->yearRemodeled) ? $row->yearRemodeled : '';
				$houseStyle = isset($row->houseStyle) ? $row->houseStyle : '';

				$houseConstruction = isset($row->houseConstruction) ? $row->houseConstruction : '';
				$exteriorFinish = isset($row->exteriorFinish) ? $row->exteriorFinish : '';
				$roof = isset($row->roof) ? $row->roof : '';
				$flooring = isset($row->flooring) ? $row->flooring : '';
				$porchPatio = isset($row->porchPatio) ? $row->porchPatio : '';
				$landtype = isset($row->landtype) ? $row->landtype : '';
				$frontage = isset($row->frontage) ? $row->frontage : '';
				$depth = isset($row->depth) ? $row->depth : '';
				$subdivision = isset($row->subdivision) ? $row->subdivision : '';
				$LandAreaSqFt = isset($row->LandAreaSqFt) ? $row->LandAreaSqFt : '';

				$AcresTotal = isset($row->AcresTotal) ? $row->AcresTotal : '';
				$LotDimensions = isset($row->LotDimensions) ? $row->LotDimensions : '';
				$bedrooms = isset($row->bedrooms) ? $row->bedrooms : '';
				$sleeps = isset($row->sleeps) ? $row->sleeps : '';
				$totalrooms = isset($row->totalrooms) ? $row->totalrooms : '';
				$otherrooms = isset($row->otherrooms) ? $row->otherrooms : '';
				$livingarea = isset($row->livingarea) ? $row->livingarea : '';
				$bathrooms = isset($row->bathrooms) ? $row->bathrooms : '';
				$fullBaths = isset($row->fullBaths) ? $row->fullBaths : '';
				$thqtrBaths = isset($row->thqtrBaths) ? $row->thqtrBaths : '';

				$halfBaths = isset($row->halfBaths) ? $row->halfBaths : '';
				$qtrBaths = isset($row->qtrBaths) ? $row->qtrBaths : '';
				$ensuite = isset($row->ensuite) ? $row->ensuite : '';
				$parking = isset($row->parking) ? $row->parking : '';
				$garageDescription = isset($row->garageDescription) ? $row->garageDescription : '';
				$parkingGarage = isset($row->parkingGarage) ? $row->parkingGarage : '';
				$parkingCarport = isset($row->parkingCarport) ? $row->parkingCarport : '';
				$stories = isset($row->stories) ? $row->stories : '';
				$declat = isset($row->declat) ? $row->declat : '';
				$declong = isset($row->declong) ? $row->declong : '';

				$adline = isset($row->adline) ? $row->adline : '';
				//$alias = isset($row->alias) ? $row->alias : '';
				$propdesc = isset($row->propdesc) ? $row->propdesc : '';
				$smalldesc = isset($row->smalldesc) ? $row->smalldesc : '';
				$panorama = isset($row->panorama) ? $row->panorama : '';
				//$mediaUrl = isset($row->mediaUrl) ? $row->mediaUrl : '';
				//$mediaType = isset($row->mediaType) ? $row->mediaType : '';
				$pdfinfo1 = isset($row->pdfinfo1) ? $row->pdfinfo1 : '';
				$pdfinfo2 = isset($row->pdfinfo2) ? $row->pdfinfo2 : '';
				$epc1 = isset($row->epc1) ? $row->epc1 : '';

				$epc2 = isset($row->epc2) ? $row->epc2 : '';
				$flpl1 = isset($row->flpl1) ? $row->flpl1 : '';
				$flpl2 = isset($row->flpl2) ? $row->flpl2 : '';
				$ctown = isset($row->ctown) ? $row->ctown : '';
				$ctport = isset($row->ctport) ? $row->ctport : '';
				$schooldist = isset($row->schooldist) ? $row->schooldist : '';
				$preschool = isset($row->preschool) ? $row->preschool : '';
				$primaryschool = isset($row->primaryschool) ? $row->primaryschool : '';
				$highschool = isset($row->highschool) ? $row->highschool : '';
				$university = isset($row->university) ? $row->university : '';

				$hofees = isset($row->hofees) ? $row->hofees : '';
				$AnnualInsurance = isset($row->AnnualInsurance) ? $row->AnnualInsurance : '';
				$TaxAnnual = isset($row->TaxAnnual) ? $row->TaxAnnual : '';
				$TaxYear = isset($row->TaxYear) ? $row->TaxYear : '';
				$Utlities = isset($row->Utlities) ? $row->Utlities : '';
				$ElectricService = isset($row->ElectricService) ? $row->ElectricService : '';
				$AverageUtilElec = isset($row->AverageUtilElec) ? $row->AverageUtilElec : '';
				$AverageUtilHeat = isset($row->AverageUtilHeat) ? $row->AverageUtilHeat : '';
				$BasementAndFoundation = isset($row->BasementAndFoundation) ? $row->BasementAndFoundation : '';
				$BasementSize = isset($row->BasementSize) ? $row->BasementSize : '';

				$BasementPctFinished = isset($row->BasementPctFinished) ? $row->BasementPctFinished : '';
				//$appliances = isset($row->appliances) ? $row->appliances : '';
				//$indoorfeatures = isset($row->indoorfeatures) ? $row->indoorfeatures : '';
				//$outdoorfeatures = isset($row->outdoorfeatures) ? $row->outdoorfeatures : '';
				//$buildingfeatures = isset($row->buildingfeatures) ? $row->buildingfeatures : '';
				//$communityfeatures = isset($row->communityfeatures) ? $row->communityfeatures : '';
				//$otherfeatures = isset($row->otherfeatures) ? $row->otherfeatures : '';
				$CovenantsYN = isset($row->CovenantsYN) ? $row->CovenantsYN : '';
				$PhoneAvailableYN = isset($row->PhoneAvailableYN) ? $row->PhoneAvailableYN : '';
				$GarbageDisposalYN = isset($row->GarbageDisposalYN) ? $row->GarbageDisposalYN : '';

				$RefrigeratorYN = isset($row->RefrigeratorYN) ? $row->RefrigeratorYN : '';
				$OvenYN = isset($row->OvenYN) ? $row->OvenYN : '';
				$FamilyRoomPresent = isset($row->FamilyRoomPresent) ? $row->FamilyRoomPresent : '';
				$LaundryRoomPresent = isset($row->LaundryRoomPresent) ? $row->LaundryRoomPresent : '';
				$KitchenPresent = isset($row->KitchenPresent) ? $row->KitchenPresent : '';
				$LivingRoomPresent = isset($row->LivingRoomPresent) ? $row->LivingRoomPresent : '';
				$ParkingSpaceYN = isset($row->ParkingSpaceYN) ? $row->ParkingSpaceYN : '';
				$custom1 = isset($row->custom1) ? $row->custom1 : '';
				$custom2 = isset($row->custom2) ? $row->custom2 : '';
				$custom3 = isset($row->custom3) ? $row->custom3 : '';

				$custom4 = isset($row->custom4) ? $row->custom4 : '';
				$custom5 = isset($row->custom5) ? $row->custom5 : '';
				$custom6 = isset($row->custom6) ? $row->custom6 : '';
				$custom7 = isset($row->custom7) ? $row->custom7 : '';
				$custom8 = isset($row->custom8) ? $row->custom8 : '';
				$takings = isset($row->takings) ? $row->takings : '';
				$returns = isset($row->returns) ? $row->returns : '';
				$netprofit = isset($row->netprofit) ? $row->netprofit : '';
				$bustype = isset($row->bustype) ? $row->bustype : '';
				$bussubtype = isset($row->bussubtype) ? $row->bussubtype : '';

				$stock = isset($row->stock) ? $row->stock : '';
				$fixtures = isset($row->fixtures) ? $row->fixtures : '';
				$fittings = isset($row->fittings) ? $row->fittings : '';
				$squarefeet = isset($row->squarefeet) ? $row->squarefeet : '';
				$SqFtLower = isset($row->SqFtLower) ? $row->SqFtLower : '';
				$SqFtMainLevel = isset($row->SqFtMainLevel) ? $row->SqFtMainLevel : '';
				$SqFtUpper = isset($row->SqFtUpper) ? $row->SqFtUpper : '';
				$percentoffice = isset($row->percentoffice) ? $row->percentoffice : '';
				$percentwarehouse = isset($row->percentwarehouse) ? $row->percentwarehouse : '';
				$loadingfac = isset($row->loadingfac) ? $row->loadingfac : '';

				$fencing = isset($row->fencing) ? $row->fencing : '';
				$rainfall = isset($row->rainfall) ? $row->rainfall : '';
				$soiltype = isset($row->soiltype) ? $row->soiltype : '';
				$grazing = isset($row->grazing) ? $row->grazing : '';
				$cropping = isset($row->cropping) ? $row->cropping : '';
				$irrigation = isset($row->irrigation) ? $row->irrigation : '';
				$waterresources = isset($row->waterresources) ? $row->waterresources : '';
				$carryingcap = isset($row->carryingcap) ? $row->carryingcap : '';
				$storage = isset($row->storage) ? $row->storage : '';
				$services = isset($row->services) ? $row->services : '';

				$currency_position = isset($row->currency_position) ? $row->currency_position : '';
				$currency = isset($row->currency) ? $row->currency : '';
				$currency_format = isset($row->currency_format) ? $row->currency_format : '';
				$schoolprof = isset($row->schoolprof) ? $row->schoolprof : '';
				$hoodprof = isset($row->hoodprof) ? $row->hoodprof : '';
				$openhouse = isset($row->openhouse) ? $row->openhouse : '';
				$ohouse_desc = isset($row->ohouse_desc) ? $row->ohouse_desc : '';
				$ohdate = isset($row->ohdate) ? $row->ohdate : '';
				$ohstarttime = isset($row->ohstarttime) ? $row->ohstarttime : '';
				$ohendtime = isset($row->ohendtime) ? $row->ohendtime : '';

				$ohdate2 = isset($row->ohdate2) ? $row->ohdate2 : '';
				$ohstarttime2 = isset($row->ohstarttime2) ? $row->ohstarttime2 : '';
				$ohendtime2 = isset($row->ohendtime2) ? $row->ohendtime2 : '';
				$viewbooking = isset($row->viewbooking) ? $row->viewbooking : '';
				$availdate = isset($row->availdate) ? $row->availdate : '';
				$aucdate = isset($row->aucdate) ? $row->aucdate : '';
				$auctime = isset($row->auctime) ? $row->auctime : '';
				$aucdet = isset($row->aucdet) ? $row->aucdet : '';
				$private = isset($row->private) ? $row->private : '';
				$office_id = isset($row->office_id) ? $row->office_id : '';

				$mls_id = isset($row->mls_id) ? $row->mls_id : '';
				$mls_agent = isset($row->mls_agent) ? $row->mls_agent : '';
				$agentInfo = isset($row->agentInfo) ? $row->agentInfo : '';
				$rets_source = isset($row->rets_source) ? $row->rets_source : '';
				$mls_disclaimer = isset($row->mls_disclaimer) ? $row->mls_disclaimer : '';
				$mls_image = isset($row->mls_image) ? $row->mls_image : '';
				$oh_id = isset($row->oh_id) ? $row->oh_id : '';
				$closedate = isset($row->closedate) ? $row->closedate : '';
				$contractdate = isset($row->contractdate) ? $row->contractdate : '';
				$sold = isset($row->sold) ? $row->sold : '';

				$featured = isset($row->featured) ? $row->featured : '';
				$camtype = isset($row->camtype) ? $row->camtype : '';
				$owner = isset($row->owner) ? $row->owner : '';
				$assoc_agent = isset($row->assoc_agent) ? $row->assoc_agent : '';
				$email_status = isset($row->email_status) ? $row->email_status : '';
				$skipimp = isset($row->skipimp) ? $row->skipimp : '';
				$listdate = isset($row->listdate) ? $row->listdate : '';
				$lastupdate = isset($row->lastupdate) ? $row->lastupdate : '';
				$expdate = isset($row->expdate) ? $row->expdate : '';
				$metadesc = isset($row->metadesc) ? $row->metadesc : '';

				$metakey = isset($row->metakey) ? $row->metakey : '';
				$hits = isset($row->hits) ? $row->hits : '';
				$published = isset($row->published) ? $row->published : '';
				$language = isset($row->language) ? $row->language : '';
				$checked_out = isset($row->checked_out) ? $row->checked_out : '';
				$checked_out_time = isset($row->checked_out_time) ? $row->checked_out_time : '';
				$ordering = isset($row->ordering) ? $row->ordering : '';

				$database->setQuery("INSERT INTO `#__ezrealty` ( `id` , `type` , `rent_type` , `cid` , `locid` , `stid` , `cnid` , `soleAgency` , `bldg_name` , `unit_num`, 
				`lot_num` , `street_num` , `address2` , `postcode` , `county` , `locality` , `state` , `country` , `viewad` , `owncoords`, 
				`price` , `offpeak` , `showprice` , `freq` , `bond` , `closeprice` , `priceview` , `year` , `yearRemodeled` , `houseStyle`, 
				`houseConstruction` , `exteriorFinish` , `roof` , `flooring` , `porchPatio` , `landtype` , `frontage` , `depth` , `subdivision` , `LandAreaSqFt`, 
				`AcresTotal` , `LotDimensions` , `bedrooms` , `sleeps` , `totalrooms` , `otherrooms` , `livingarea` , `bathrooms` , `fullBaths` , `thqtrBaths`, 
				`halfBaths` , `qtrBaths` , `ensuite` , `parking` , `garageDescription` , `parkingGarage` , `parkingCarport` , `stories` , `declat` , `declong` , 
				`adline` , `alias` , `propdesc` , `smalldesc` , `panorama` , `mediaUrl` , `mediaType` , `pdfinfo1` , `pdfinfo2` , `epc1` , 
				`epc2` , `flpl1` , `flpl2` , `ctown` , `ctport` , `schooldist` , `preschool` , `primaryschool` , `highschool` , `university` , 
				`hofees` , `AnnualInsurance` , `TaxAnnual` , `TaxYear` , `Utlities` , `ElectricService` , `AverageUtilElec` , `AverageUtilHeat` , `BasementAndFoundation` , `BasementSize`, 
				`BasementPctFinished` , `appliances` , `indoorfeatures` , `outdoorfeatures` , `buildingfeatures` , `communityfeatures` , `otherfeatures` , `CovenantsYN` , `PhoneAvailableYN` , `GarbageDisposalYN` , 
				`RefrigeratorYN` , `OvenYN` , `FamilyRoomPresent` , `LaundryRoomPresent` , `KitchenPresent` , `LivingRoomPresent` , `ParkingSpaceYN` , `custom1` , `custom2` , `custom3` , 
				`custom4` , `custom5` , `custom6` , `custom7` , `custom8` , `takings` , `returns` , `netprofit` , `bustype` , `bussubtype` , 
				`stock` , `fixtures` , `fittings` , `squarefeet` , `SqFtLower` , `SqFtMainLevel` , `SqFtUpper` , `percentoffice` , `percentwarehouse` , `loadingfac` , 
				`fencing` , `rainfall` , `soiltype` , `grazing` , `cropping` , `irrigation` , `waterresources` , `carryingcap` , `storage` , `services` , 
				`currency_position` , `currency` , `currency_format` , `schoolprof` , `hoodprof` , `openhouse` , `ohouse_desc` , `ohdate` , `ohstarttime` , `ohendtime` , 
				`ohdate2` , `ohstarttime2` , `ohendtime2` , `viewbooking` , `availdate` , `aucdate` , `auctime` , `aucdet` , `private` , `office_id` , 
				`mls_id` , `mls_agent` , `agentInfo` , `rets_source` , `mls_disclaimer` , `mls_image` , `oh_id` , `closedate` , `contractdate` , `sold`, 
				`featured` , `camtype` , `owner` , `assoc_agent` , `email_status` , `skipimp` , `listdate` , `lastupdate` , `expdate` , `metadesc` , 
				`metakey` , `hits` , `published` , `language` , `checked_out` , `checked_out_time` , `ordering`
				 ) VALUES ( '".addslashes($id)."', 
				'".addslashes($type)."', '".addslashes($rent_type)."', '".addslashes($cid)."', '".addslashes($locid)."', '".addslashes($stid)."', '".addslashes($cnid)."', '".addslashes($soleAgency)."', '".addslashes($bldg_name)."', '".addslashes($unit_num)."',
				'".addslashes($lot_num)."', '".addslashes($street_num)."', '".addslashes($address2)."', '".addslashes($postcode)."', '".addslashes($county)."', '".addslashes($locality)."', '".addslashes($state)."', '".addslashes($country)."', '".addslashes($viewad)."', '".addslashes($owncoords)."',
				'".addslashes($price)."', '".addslashes($offpeak)."', '".addslashes($showprice)."', '".addslashes($freq)."', '".addslashes($bond)."', '".addslashes($closeprice)."', '".addslashes($priceview)."', '".addslashes($year)."', '".addslashes($yearRemodeled)."', '".addslashes($houseStyle)."',
				'".addslashes($houseConstruction)."', '".addslashes($exteriorFinish)."', '".addslashes($roof)."', '".addslashes($flooring)."', '".addslashes($porchPatio)."', '".addslashes($landtype)."', '".addslashes($frontage)."', '".addslashes($depth)."', '".addslashes($subdivision)."', '".addslashes($LandAreaSqFt)."',
				'".addslashes($AcresTotal)."', '".addslashes($LotDimensions)."', '".addslashes($bedrooms)."', '".addslashes($sleeps)."', '".addslashes($totalrooms)."', '".addslashes($otherrooms)."', '".addslashes($livingarea)."', '".addslashes($bathrooms)."', '".addslashes($fullBaths)."', '".addslashes($thqtrBaths)."',
				'".addslashes($halfBaths)."', '".addslashes($qtrBaths)."', '".addslashes($ensuite)."', '".addslashes($parking)."', '".addslashes($garageDescription)."', '".addslashes($parkingGarage)."', '".addslashes($parkingCarport)."', '".addslashes($stories)."', '".addslashes($declat)."', '".addslashes($declong)."',
				'".addslashes($adline)."', '".addslashes($thealias)."', '".addslashes($propdesc)."', '".addslashes($smalldesc)."', '".addslashes($panorama)."', '".addslashes($mediaUrl)."', '".addslashes($mediaType)."', '".addslashes($pdfinfo1)."', '".addslashes($pdfinfo2)."', '".addslashes($epc1)."',
				'".addslashes($epc2)."', '".addslashes($flpl1)."', '".addslashes($flpl2)."', '".addslashes($ctown)."', '".addslashes($ctport)."', '".addslashes($schooldist)."', '".addslashes($preschool)."', '".addslashes($primaryschool)."', '".addslashes($highschool)."', '".addslashes($university)."',
				'".addslashes($hofees)."', '".addslashes($AnnualInsurance)."', '".addslashes($TaxAnnual)."', '".addslashes($TaxYear)."', '".addslashes($Utlities)."', '".addslashes($ElectricService)."', '".addslashes($AverageUtilElec)."', '".addslashes($AverageUtilHeat)."', '".addslashes($BasementAndFoundation)."', '".addslashes($BasementSize)."',
				'".addslashes($BasementPctFinished)."', '".addslashes($appliances)."', '".addslashes($indoorfeatures)."', '".addslashes($outdoorfeatures)."', '".addslashes($buildingfeatures)."', '".addslashes($communityfeatures)."', '".addslashes($otherfeatures)."', '".addslashes($CovenantsYN)."', '".addslashes($PhoneAvailableYN)."', '".addslashes($GarbageDisposalYN)."',
				'".addslashes($RefrigeratorYN)."', '".addslashes($OvenYN)."', '".addslashes($FamilyRoomPresent)."', '".addslashes($LaundryRoomPresent)."', '".addslashes($KitchenPresent)."', '".addslashes($LivingRoomPresent)."', '".addslashes($ParkingSpaceYN)."', '".addslashes($custom1)."', '".addslashes($custom2)."', '".addslashes($custom3)."',
				'".addslashes($custom4)."', '".addslashes($custom5)."', '".addslashes($custom6)."', '".addslashes($custom7)."', '".addslashes($custom8)."', '".addslashes($takings)."', '".addslashes($returns)."', '".addslashes($netprofit)."', '".addslashes($bustype)."', '".addslashes($bussubtype)."',
				'".addslashes($stock)."', '".addslashes($fixtures)."', '".addslashes($fittings)."', '".addslashes($squarefeet)."', '".addslashes($SqFtLower)."', '".addslashes($SqFtMainLevel)."', '".addslashes($SqFtUpper)."', '".addslashes($percentoffice)."', '".addslashes($percentwarehouse)."', '".addslashes($loadingfac)."',
				'".addslashes($fencing)."', '".addslashes($rainfall)."', '".addslashes($soiltype)."', '".addslashes($grazing)."', '".addslashes($cropping)."', '".addslashes($irrigation)."', '".addslashes($waterresources)."', '".addslashes($carryingcap)."', '".addslashes($storage)."', '".addslashes($services)."',
				'".addslashes($currency_position)."', '".addslashes($currency)."', '".addslashes($currency_format)."', '".addslashes($schoolprof)."', '".addslashes($hoodprof)."', '".addslashes($openhouse)."', '".addslashes($ohouse_desc)."', '".addslashes($ohdate)."', '".addslashes($ohstarttime)."', '".addslashes($ohendtime)."',
				'".addslashes($ohdate2)."', '".addslashes($ohstarttime2)."', '".addslashes($ohendtime2)."', '".addslashes($viewbooking)."', '".addslashes($availdate)."', '".addslashes($aucdate)."', '".addslashes($auctime)."', '".addslashes($aucdet)."', '".addslashes($private)."', '".addslashes($office_id)."',
				'".addslashes($mls_id)."', '".addslashes($mls_agent)."', '".addslashes($agentInfo)."', '".addslashes($rets_source)."', '".addslashes($mls_disclaimer)."', '".addslashes($mls_image)."', '".addslashes($oh_id)."', '".addslashes($closedate)."', '".addslashes($contractdate)."', '".addslashes($sold)."',
				'".addslashes($featured)."', '".addslashes($camtype)."', '".addslashes($owner)."', '".addslashes($assoc_agent)."', '".addslashes($email_status)."', '".addslashes($skipimp)."', '".addslashes($listdate)."', '".addslashes($lastupdate)."', '".addslashes($expdate)."', '".addslashes($metadesc)."',
				'".addslashes($metakey)."', '".addslashes($hits)."', '".addslashes($published)."', '".addslashes($language)."', '".addslashes($checked_out)."', '".addslashes($checked_out_time)."', '".addslashes($ordering)."'
				)");
				$database->query();
			}
		}

		#	migrate the property category data into the incats table

		$query = "INSERT IGNORE INTO #__ezrealty_incats(property_id,category_id) SELECT id,cid FROM #__ezrealty";
		$database->setQuery($query);
		$database->query();


	}





}
?>