<?php

/**
* @package EZ Realty
* @version 7.0.0
* @author  Kathy Strickland (aka PixelBunyiP) - Raptor Services <kathy@justjoomla.com>
* @link    http://www.justjoomla.com
* @copyright Copyright (C) 2006 - 2013 Raptor Developments Pty Ltd T/as Raptor Services-All rights reserved
* @license Creative Commons GNU GPL, see http://creativecommons.org/licenses/GPL/2.0/ for full license.
**/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );



class ADLISTPDF extends TCPDF {

    public function Header() {

		$params = JComponentHelper::getParams ('com_ezrealty');

		if ($params->get( 'er_pdffix' )){
			$imgbase = "../";
		} else {
			$imgbase = JURI::root();
		}

        // set bacground image

		if ($params->get( 'er_adminpdfbkgr' )){
			$img_file = "../".$params->get( 'er_adminpdfbkgr' );
		} else {
			$img_file = $imgbase."components/com_ezrealty/assets/images/admin_bkgr.jpg";
		}

        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);

        $this->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }

}


class LISTPDF extends TCPDF {

    public function Header() {

		$params = JComponentHelper::getParams ('com_ezrealty');

		if ($params->get( 'er_pdffix' )){
			$imgbase = "";
		} else {
			$imgbase = JURI::root();
		}

        // set bacground image

		if ($params->get( 'er_adminpdfbkgr' )){
			$img_file = $params->get( 'er_adminpdfbkgr' );
		} else {
			$img_file = $imgbase."components/com_ezrealty/assets/images/admin_bkgr.jpg";
		}

        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);

        $this->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }

}


class PAGEPDF extends TCPDF {

    public function Header() {

		$id  = intval(JRequest::getVar( 'id', ''));
		$db	 =& JFactory::getDBO();
		$params = JComponentHelper::getParams ('com_ezrealty');

		if ($params->get( 'er_pdffix' )){
			$imgbase = "";
		} else {
			$imgbase = JURI::root();
		}

        // set bacground image


		if ( $params->get( 'er_useprofile') && $params->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){

			$db->setQuery( "SELECT w.*, u.seller_pdfbkgr AS seller_pdfbkgr FROM #__ezrealty AS w LEFT JOIN #__ezportal AS u ON u.uid = w.owner WHERE w.id=$id" );
			$pdfbk = $db->loadObjectList();
			$prpdfbk = $pdfbk[0];

			if ($prpdfbk->seller_pdfbkgr != ""){
				$img_file = $imgbase."images/ezportal/pdfbkgr/".$prpdfbk->seller_pdfbkgr;
			} else {
				if ($params->get( 'er_pdfbkgr')){
					$img_file = $params->get( 'er_pdfbkgr');
				} else {
					$img_file = $imgbase."components/com_ezrealty/assets/images/pdfbkgr.jpg";
				}
			}
		} else {

			if ($params->get( 'er_pdfbkgr')){
				$img_file = $params->get( 'er_pdfbkgr');
			} else {
				$img_file = $imgbase."components/com_ezrealty/assets/images/pdfbkgr.jpg";
			}
		}

        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);

        $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }

}


class MYPDF extends TCPDF {

    public function Header() {

		$params = JComponentHelper::getParams ('com_ezrealty');

		if ($params->get( 'er_pdffix' )){
			$imgbase = JURI::root();
		} else {
			$imgbase = "";
		}

        // set bacground image

		if ($params->get( 'er_adminpdfbkgr' )){
			$img_file = $params->get( 'er_adminpdfbkgr' );
		} else {
			$img_file = $imgbase."components/com_ezrealty/assets/images/admin_bkgr.jpg";
		}

        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);

        $this->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }

}


?>
