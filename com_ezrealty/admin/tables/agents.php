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
 * Seller information Table class for Joomla 2.5x
 *
 * @package    EZ Realty
 */
class AgentsTableAgents extends JTable
{
    /**
     * Primary Key
     *
     * @var int
     */
     var $id=null;
     var $alias=null;
     var $uid=null;
     var $cid=null;
     var $seller_name=null;
     var $seller_company=null;
     var $job_title=null;
     var $seller_info=null;
     var $seller_bio=null;
     var $seller_unitnum=null;
     var $seller_address1=null;
     var $seller_address2=null;
     var $seller_suburb=null;
     var $seller_pcode=null;
     var $seller_state=null;
     var $seller_country=null;
     var $show_addy=null;
     var $seller_declat=null;
     var $seller_declong=null;
     var $seller_email=null;
     var $seller_phone=null;
     var $seller_fax=null;
     var $seller_mobile=null;
     var $seller_sms=null;
     var $show_sms=null;
     var $seller_exempt=null;
     var $seller_unlimited=null;
     var $feat_upgr=null;
     var $publish_own=null;
     var $reset_own=null;
     var $seller_fbook=null;
     var $seller_twitter=null;
     var $seller_pinterest=null;
     var $seller_linkedin=null;
     var $seller_youtube=null;
     var $seller_msn=null;
     var $seller_skype=null;
     var $seller_ymsgr=null;
     var $seller_icq=null;
     var $seller_web=null;
     var $seller_blog=null;
     var $seller_image=null;
     var $seller_logo=null;
     var $seller_banner=null;
     var $seller_pdf=null;
     var $calcown=null;
     var $qrcode = null;
     var $featured = null;
     var $published=null;
     var $rets_source=null;
     var $listdate=null;
     var $lastupdate=null;
     var $metadesc=null;
     var $metakey=null;
     var $checked_out=null;
     var $checked_out_time=null;
     var $ordering=null;

	/**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct( &$db ) {
        parent::__construct('#__ezportal', 'id', $db);
    }   
    
}

/**
 * Seller information Table class for Joomla 1.7x
 *
 * @package    EZ Realty
 */
class TableAgents extends JTable
{
    /**
     * Primary Key
     *
     * @var int
     */
     var $id=null;
     var $alias=null;
     var $uid=null;
     var $cid=null;
     var $seller_name=null;
     var $seller_company=null;
     var $job_title=null;
     var $seller_info=null;
     var $seller_bio=null;
     var $seller_unitnum=null;
     var $seller_address1=null;
     var $seller_address2=null;
     var $seller_suburb=null;
     var $seller_pcode=null;
     var $seller_state=null;
     var $seller_country=null;
     var $show_addy=null;
     var $seller_declat=null;
     var $seller_declong=null;
     var $seller_email=null;
     var $seller_phone=null;
     var $seller_fax=null;
     var $seller_mobile=null;
     var $seller_sms=null;
     var $show_sms=null;
     var $seller_exempt=null;
     var $seller_unlimited=null;
     var $feat_upgr=null;
     var $publish_own=null;
     var $reset_own=null;
     var $seller_fbook=null;
     var $seller_twitter=null;
     var $seller_pinterest=null;
     var $seller_linkedin=null;
     var $seller_youtube=null;
     var $seller_msn=null;
     var $seller_skype=null;
     var $seller_ymsgr=null;
     var $seller_icq=null;
     var $seller_web=null;
     var $seller_blog=null;
     var $seller_image=null;
     var $seller_logo=null;
     var $seller_banner=null;
     var $seller_pdf=null;
     var $calcown=null;
     var $qrcode = null;
     var $featured = null;
     var $published=null;
     var $rets_source=null;
     var $listdate=null;
     var $lastupdate=null;
     var $metadesc=null;
     var $metakey=null;
     var $checked_out=null;
     var $checked_out_time=null;
     var $ordering=null;

	/**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct( &$db ) {
        parent::__construct('#__ezportal', 'id', $db);
    }   
    
}

?>