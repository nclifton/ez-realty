
CREATE TABLE IF NOT EXISTS `#__ezrealty` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__ezrealty_locality` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__ezrealty_state` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__ezrealty_country` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__ezrealty_catg` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__ezrealty_incats` (
   `property_id` int(11) NOT NULL,
   `category_id` int(11) NOT NULL,
   PRIMARY KEY(`property_id`,`category_id`),
   INDEX `property_id` (`property_id`),
   INDEX `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__ezrealty_images` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__ezrealty_lightbox` (
`id` int(11) NOT NULL auto_increment,
`uid` int(11) NOT NULL default '0',
`propid` int(11) NOT NULL default '0',
`date` varchar(20) default NULL,
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__ezportal` (
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
) ENGINE=MyISAM ;



