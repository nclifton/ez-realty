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

/**
 *
 * @static
 * @package		EZ Realty
 */
class JHtmlIcon
{

	static function email($ezrealty, $params, $attribs = array())
	{
		require_once(JPATH_SITE.'/components/com_mailto/helpers/mailto.php');
		$uri 		= JFactory::getURI();
		$base	= $uri->toString(array('scheme', 'host', 'port'));
		$template = JFactory::getApplication()->getTemplate();

		$link = JURI::root() . 'index.php?option=com_ezrealty&view=ezrealty&id='.$ezrealty->slug;

		$url	= 'index.php?option=com_mailto&tmpl=component&template='.$template.'&link='.MailToHelper::addLink($link);

		$status = 'width=400,height=350,menubar=no,resizable=yes';

		// shows the icon image
		$text = '<img src="'.JURI::root().'components/com_ezrealty/assets/images/email.png" border="0" alt="'. JText::_('JGLOBAL_EMAIL').'" />';

		$attribs['title']	= JText::_('JGLOBAL_EMAIL');
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";

		$output = JHtml::_('link',JRoute::_($url), $text, $attribs);
		return $output;
	}


	static function pdf($ezrealty, $params, $access=1, $attribs = array())
	{
		$url  = 'index.php?option=com_ezrealty&view=ezrealty';
		$url .=  @$ezrealty->catslug ? '&cid='.$ezrealty->catslug : '';
		$url .= '&id='.$ezrealty->slug.'&format=pdf';

		$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=700,height=480,directories=no,location=no';

		// checks template image directory for image, if non found default are loaded
		$text = '<img src="'.JURI::root().'components/com_ezrealty/assets/images/pdf_22.png" border="0" alt="'. JText::_('JGLOBAL_PRINT').'" />';

		$attribs['title']	= JText::_( 'JGLOBAL_PRINT' );
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";
		$attribs['rel']     = 'nofollow';

		return JHtml::_('link', JRoute::_($url), $text, $attribs);
	}


	static function cal($ezrealty, $params, $access=1, $attribs = array())
	{
		$template = JFactory::getApplication()->getTemplate();

		$url  = 'index.php?option=com_realtybookings&view=realtybooking';
		$url .= '&id='.$ezrealty->slug.'&source=1&tmpl=component&template='.$template;

		$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=420,height=270,directories=no,location=no';

		// shows the icon image
		$text = '<img src="'.JURI::root().'components/com_ezrealty/assets/images/calendar.png" style="height: 40px;" border="0" alt="'. JText::_('EZREALTY_VIEW_CALENDAR').'" />';
			//$text = JHtml::_('image','system/calendar.png', JText::_('EZREALTY_VIEW_CALENDAR'), NULL, true);

		$attribs['title']	= JText::_( 'EZREALTY_VIEW_CALENDAR' );
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";
		$attribs['rel']     = 'nofollow';

		return JHtml::_('link', JRoute::_($url), $text, $attribs);
	}

	static function print_popup($ezrealty, $params, $attribs = array())
	{
		$url  = EzrealtyHelperRoute::getEzrealtyRoute($ezrealty->slug, $ezrealty->cid, '', '');
		$url .= '&tmpl=component&print=1&layout=default&page='.@ $request->limitstart;

		$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';

		// checks template image directory for image, if non found default are loaded
		$text = '<img src="'.JURI::root().'components/com_ezrealty/assets/images/print_22.png" border="0" alt="'. JText::_('JGLOBAL_PRINT').'" />';

		$attribs['title']	= JText::_('JGLOBAL_PRINT');
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";
		$attribs['rel']		= 'nofollow';

		return JHtml::_('link', JRoute::_($url), $text, $attribs);
	}



}

?>