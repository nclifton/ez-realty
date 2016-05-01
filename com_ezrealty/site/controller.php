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

jimport('joomla.application.component.controller');

/**
 * EZ Realty Component Controller
 *
 */
class EzrealtysController extends JControllerLegacy
{
	/**
	 * Method to show an EZ Realty view
	 *
	 */
	function display()
	{
		// Set a default view if none exists
		if ( ! JRequest::getCmd( 'view' ) ) {
			JRequest::setVar('view', 'categories' );
		}

		//update the hit count for the item
		if(JRequest::getCmd('view') == 'ezrealty' && JRequest::getCmd('format') != 'pdf')
		{
			$model =& $this->getModel('ezrealty');
			$model->hit();
		}

		parent::display();
	}

	function addshortlist() {

		$app		= JFactory::getApplication();
		$params		= $app->getParams();
        $my			= & JFactory::getUser();
		$database	= & JFactory::getDBO();

		# Check that shortlisting is enabled

		if ( !$params->get( 'er_shortlisting' ) ){
            JError::raiseError( 403, JText::_("ALERTNOTAUTH") );
			return;
		}

		# Check that person has access to shortlisting

		if ( !$my->id ){

			$message = JText::_('EZREALTY_NEEDTOLOGIN');

			EZRealtyFHelper::EZClose($message);

		} else {

			$id  = intval(JRequest::getVar( 'id', 0 ));

			$database->SetQuery("SELECT count(*) from #__ezrealty_lightbox WHERE propid = '$id' AND uid='$my->id'");
			$exists = $database->LoadResult();

			if ($exists > 0){

				$message = JText::_('EZREALTY_SHORTLIST_ERROR');

				EZRealtyFHelper::EZClose($message);

			} else {

				$date=mktime();

				$query = "INSERT INTO #__ezrealty_lightbox(`id`,`uid`,`propid`,`date`) VALUES ( '',$my->id,$id,'$date')";
				$database->setQuery( $query );

				if ( !$database->query() ) {
					echo "<script> alert('" . $database->getErrorMsg()
					. "'); window.history.go(-1); </script>\n";
				}

				$message = JText::_('EZREALTY_SHORTLIST_SUCCESS');

				EZRealtyFHelper::EZClose($message);
			}
		}
	}


	function removeshortlist()
	{

		$itemid  	= intval(JRequest::getVar( 'Itemid', ''));
		$app		= JFactory::getApplication();
		$params		= $app->getParams();
        $my			= & JFactory::getUser();
		$database	= & JFactory::getDBO();

		# Check that shortlisting is enabled

		if ( !$params->get( 'er_shortlisting' ) ){
            JError::raiseError( 403, JText::_("ALERTNOTAUTH") );
			return;
		}

		# Check that person has access to shortlisting

		if ( !$my->id ){
			echo JText::_('EZREALTY_NEEDTOLOGIN');
			return;
		}
	
		$id  = intval(JRequest::getVar( 'id', 0 ));

		$database->setQuery( "DELETE FROM #__ezrealty_lightbox WHERE id=$id AND uid=$my->id" );

		if ( !$database->query() ) {
			echo "<script> alert('" . $database->getErrorMsg()
			. "'); window.history.go(-1); </script>\n";
		}

		$msg = JText::_( 'EZREALTY_SHORTLIST_REMOVED');

		$link = JRoute::_('index.php?option=com_ezrealty&view=shortlist&Itemid='.$itemid, false);

		$this->setRedirect($link, $msg);

	}	


	/**
	 *
	 * Method to send an email to a seller
	 *
	 */
	function sendmailform () {

		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$app		= JFactory::getApplication();
		$params		= $app->getParams('com_ezrealty');
		$database	= & JFactory::getDBO();
		$my			=& JFactory::getUser();

		# Check that email contact is enabled

		if ( !$params->get( 'er_viewarrange' ) ){
            JError::raiseError( 403, JText::_("ALERTNOTAUTH") );
			return;
		}

		# Get the post variables

	    $name  = JRequest::getVar( 'name', '');
	    $email  = JRequest::getVar( 'email', '');
	    $dtelephone  = JRequest::getVar( 'dtelephone', '');
	    $ahtelephone  = JRequest::getVar( 'ahtelephone', '');
	    $mobile  = JRequest::getVar( 'mobile', '');
	    $method  = intval(JRequest::getVar( 'method', '0'));
	    $themessage  = JRequest::getVar( 'message', '');
	    $id  = intval(JRequest::getVar( 'id', '0'));
	    $itemid  = intval(JRequest::getVar( 'itemid', '0'));
	    $mid  = intval(JRequest::getVar( 'mid', '0'));
	    $amid  = intval(JRequest::getVar( 'amid', '0'));
	    $formtype  = intval(JRequest::getVar( 'formtype', '0'));


		if ($params->get('er_recaptcha')){
			# do the captcha stuff
			if (JPluginHelper::isEnabled('captcha', 'recaptcha')) {
				$post = JRequest::get('post');      
				JPluginHelper::importPlugin('captcha');
				$dispatcher = JDispatcher::getInstance();
				$res = $dispatcher->trigger('onCheckAnswer',$post['recaptcha_response_field']);
				if(!$res[0]){
					die('Invalid Captcha');
				}
			}
		}


		if(!EZRealtyFHelper::check_email($email)) {
			echo "<script> alert('".JText::_('EZREALTY_EMAIL_FORMAT_ERROR')."'); window.history.go(-1); </script>\n";
		} else {

			# Find the property address and seller details

				$query = 'SELECT w.*, cc.name AS category, dd.ezcity AS proploc, ee.name AS statename, ff.name AS countryname, u.uid AS mid, u.seller_name AS dealer_name, 
				u.seller_company AS dealer_company, u.seller_email AS dealer_email, u.seller_phone AS dealer_phone, u.seller_mobile AS dealer_mobile, 
				u.published AS dealerpublished, u.job_title AS dealer_jobtitle, 
				p.uid AS amid, p.seller_name AS adealer_name, p.seller_company AS adealer_company, p.seller_phone AS adealer_phone, 
				p.seller_mobile AS adealer_mobile, p.published AS adealerpublished, p.job_title AS adealer_jobtitle, '
			. ' CASE WHEN CHAR_LENGTH(w.alias) THEN CONCAT_WS(\':\', w.id, w.alias) ELSE w.id END as slug, '
			. ' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(\':\', cc.id, cc.alias) ELSE cc.id END as catslug, '
			. ' CASE WHEN CHAR_LENGTH(dd.alias) THEN CONCAT_WS(\':\', dd.id, dd.alias) ELSE dd.id END as subslug, '
			. ' CASE WHEN CHAR_LENGTH(ee.alias) THEN CONCAT_WS(\':\', ee.id, ee.alias) ELSE ee.id END as statslug '.
				' FROM #__ezrealty AS w' .
				' LEFT JOIN #__ezrealty_catg AS cc ON cc.id = w.cid' .
				' LEFT JOIN #__ezrealty_locality AS dd ON dd.id = w.locid' .
				' LEFT JOIN #__ezrealty_state AS ee ON ee.id = w.stid' .
				' LEFT JOIN #__ezrealty_country AS ff ON ff.id = w.cnid' .
				' LEFT JOIN #__ezportal AS u ON u.uid = w.owner' .
				' LEFT JOIN #__ezportal AS p ON p.uid = w.assoc_agent' .
				' WHERE w.published = 1 AND w.id = '. (int) $id;

			$database->setQuery( $query );
			$therows = $database->loadObjectList();
			$therow = $therows[0];

			$thepropertylink  = JURI::root() . 'index.php?option=com_ezrealty&view=ezrealty&id='.$therow->slug.'&cid='.$therow->catslug.'&Itemid='.$itemid;

			//echo $thepropertylink;

			if ($method == '1'){
				$bestmethod = JText::_('EZREALTY_DAYTIME_PHONE');
			} else if ($method == '2'){
				$bestmethod = JText::_('EZREALTY_AH_PHONE');
			} else if ($method == '3'){
				$bestmethod = JText::_('EZREALTY_LEADS_MOBILE');
			} else {
				$bestmethod = JText::_('EZREALTY_CONFIG_EMAIL');
			}

			# Build the message

			$subject= stripslashes ( $params->get( 'er_bizname' ) ) .' '. JText::_('EZREALTY_INSPECTION');

			$message=$name." ".JText::_('EZREALTY_CONTACT_DISCUSS_MSG')."\r\n\r\n";
			$message.=JText::_('EZREALTY_MAIL_PROPADD1')."\r\n".JText::_('EZREALTY_MAIL_CONTACTDET')."\r\n".JText::_('EZREALTY_MAIL_PROPADD1')."\r\n\r\n";
			$message.=JText::_('EZREALTY_CONFIG_EMAIL')." $email \r\n ";

			if ($formtype == '1'){

				$message.=JText::_('EZREALTY_CONFIG_TELEPHONE')." $dtelephone \r\n ";

			} else {

				$message.=JText::_('EZREALTY_DAYTIME_PHONE')." $dtelephone \r\n ";
				$message.=JText::_('EZREALTY_AH_PHONE')." $ahtelephone \r\n ";
				$message.=JText::_('EZREALTY_LEADS_MOBILE')." $mobile \r\n ";

			}

			$message.=JText::_('EZREALTY_PREFERRED_CONTACT')." $bestmethod \r\n ";
			$message.=JText::_('EZREALTY_SELLER_SMS10')." $themessage \r\n\r\n";
			$message.=JText::_('EZREALTY_MAIL_PROPADD1')."\r\n".JText::_('EZREALTY_MAIL_LISTDET')."\r\n".JText::_('EZREALTY_MAIL_PROPADD1')."\r\n\r\n";
			$message.=JText::_('EZREALTY_DET_ADDNUM')." $id \r\n\r\n ";
			$message.=JText::_('EZREALTY_REQUEST_FOLLOWLINK')."\r \n";
			$message.=$thepropertylink ."\r\n\r\n";
			$message.=JText::_('EZREALTY_BROKENLINK_WARNING')."\r \n";
			$message.=JText::_('EZREALTY_MAIL_PROPADD1')."\r\n".JText::_('EZREALTY_TABS_ADDRESS')."\r\n".JText::_('EZREALTY_MAIL_PROPADD1')."\r \n";
			$message.=$therow->unit_num ." ". $therow->street_num ." ". $therow->address2." \r\n ";
			$message.=$therow->proploc . " " . $therow->postcode." \r\n ";
			$message.=$therow->statename." \r\n ";
			$message.=$therow->countryname." \r\n ";


			# Find the agent's email address

				$thecontact = $params->get( 'er_bizemail');

				if ($params->get( 'er_mailoverride') ) {
					$thecontact = $params->get( 'er_bizemail');
				} else {
					if ($mid > 0) {
						$query = "SELECT seller_email AS smail FROM #__ezportal"
						. "\n WHERE uid = $mid";
						$database->setQuery( $query );
						$contacts = $database->loadObjectList();
						$contact = $contacts[0];
						$thecontact = $contact->smail;

						if ($amid > 0) {
							$query = "SELECT seller_email AS assocsmail FROM #__ezportal"
							. "\n WHERE uid = $amid";
							$database->setQuery( $query );
							$assoccontacts = $database->loadObjectList();
							$assoccontact = $assoccontacts[0];
							$theassoccontact = $assoccontact->assocsmail;

						} else {
							$theassoccontact = "";
						}

					} else {

						if ($therow->agentInfo) {

							$whichagentkey = explode(";",$therow->agentInfo);
							$whichemail = $whichagentkey[10];

							if(!EZRealtyFHelper::check_email($whichemail)) {
								$thecontact = $params->get( 'er_bizemail');
							} else {
								$thecontact = trim($whichemail);
							}

						} else {

							$thecontact = $params->get( 'er_bizemail');

						}
					}
				}


			# Send the message

			$mailfrom	= $app->getCfg('mailfrom');
			$fromname	= $app->getCfg('fromname');
			$sitename	= $app->getCfg('sitename');

			$name		= $name;
			$email		= $email;
			$subject	= $subject;
			$body		= $message;

			// Prepare email body
			$body	= $name.' <'.$email.'>'."\r\n\r\n".stripslashes($body);

			$mail = JFactory::getMailer();
			$mail->addRecipient($thecontact);
			$mail->addReplyTo(array($email, $name));
			$mail->setSender(array($mailfrom, $fromname));
			$mail->setSubject($sitename.': '.$subject);
			$mail->setBody($body);
			$sent = $mail->Send();

			# Send copy of the message to the secondary agent if they're listed
			if ($amid > 0 && $theassoccontact) {
				$mail = JFactory::getMailer();
				$mail->addRecipient($theassoccontact);
				$mail->addReplyTo(array($email, $name));
				$mail->setSender(array($mailfrom, $fromname));
				$mail->setSubject($sitename.': '.$subject);
				$mail->setBody($body);
				$sent = $mail->Send();
			}

			$msg = JText::_( 'EZREALTY_MSG_SENT_THANKYOU');
			$this->setRedirect(JRoute::_(EzrealtyHelperRoute::getEzrealtyRoute($therow->slug, $therow->catslug, '', ''), false), $msg);

			return true;

		}
	}



}

?>