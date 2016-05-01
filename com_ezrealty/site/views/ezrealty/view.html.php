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

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the EZ Realty component
 *
 * @package		EZ Realty
 *
 */
class EzrealtysViewEzrealty extends JViewLegacy
{
	function display($tpl = null)
	{


        $user =& JFactory::getUser();
	    $max_id = 1;;
	    foreach ($user->groups as $group_id)
	    	if ($max_id < $group_id) $max_id = $group_id;
	    $user->gid = $max_id;


		$app		= JFactory::getApplication();
		$menus		= $app->getMenu();
		$pathway	= $app->getPathway();
		$title 		= null;

		$document	= & JFactory::getDocument();

		// Get the parameters of the active menu item
		$menu = $menus->getActive();

		$params = &$app->getParams('com_ezrealty');

		// Selected Request vars
		// ID may come from the product switcher
		if (!($ezrealtyId	= JRequest::getInt( 'ezrealty_id',	0 ))) {
			$ezrealtyId	= JRequest::getInt( 'id',			$ezrealtyId );
		}

		// query options
		$options['id']	= $ezrealtyId;
		$options['aid']	= $user->get('aid', 0);

		$ezrealty	=& $this->get('data');

		// check if we have an item
		if (!is_object( $ezrealty )) {
			JError::raiseError( 404, 'RESOURCE NOT FOUND' );
			return;
		}


		$catid	= JRequest::getInt( 'cid',		'0' );
		$subid	= JRequest::getInt( 'sid',		'0' );
		$statid	= JRequest::getInt( 'tid',		'0' );


		$db = & JFactory::getDBO();

if ($subid){

		// current category info
		$query = 'SELECT c.*, CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(\':\', c.id, c.alias) ELSE c.id END as slug FROM #__ezrealty_locality AS c' .
		' WHERE c.id = '. (int) $subid ;
		$db->setQuery($query);
		$category = $db->loadObject();

		$category->name = $category->ezcity;

} else if ($statid){

		// current state info
		$query = 'SELECT c.*, CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(\':\', c.id, c.alias) ELSE c.id END as slug FROM #__ezrealty_state AS c' .
		' WHERE c.id = '. (int) $statid ;
		$db->setQuery($query);
		$category = $db->loadObject();

		$category->name = $category->name;

} else {

		// current category info
		$query = 'SELECT c.*, CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(\':\', c.id, c.alias) ELSE c.id END as slug FROM #__ezrealty_catg AS c' .
		' WHERE c.id = '. (int) $ezrealty->cid ;
		$db->setQuery($query);
		$category = $db->loadObject();

}


		if ($menu) {
			$params->get('page_heading', $params->get('page_title', $menu->title));
		}
		else {
			$params->get('page_heading', JText::_('COM_EZREALTY_DEFAULT_PAGE_TITLE'));
		}
		
		$title = $params->get('page_title', '');
		
		$id = (int) @$menu->query['id'];


		// if the menu item does not concern this ezrealty
		if ($menu && ($menu->query['option'] != 'com_ezrealty' || $menu->query['view'] != 'ezrealty' || $id != $ezrealty->id)) 
		{
			
			// If this is not a single contact menu item, set the page title to the contact title
			if ($ezrealty->adline) {
				$title = $ezrealty->adline;
			}
			$path = array(array('title' => $ezrealty->adline, 'link' => ''));

			if (!$id )
			{
if ($subid){
				$path[] = array('title' => $category->name, 'link' => EzrealtyHelperRoute::getSuburbRoute($category->slug));
} else if ($statid){
				$path[] = array('title' => $category->name, 'link' => EzrealtyHelperRoute::getStateRoute($category->slug));
} else {
				$path[] = array('title' => $category->name, 'link' => EzrealtyHelperRoute::getCategoryRoute($category->slug));
}
			}

			$path = array_reverse($path);

			foreach($path as $item)
			{
				$pathway->addItem($item['title'], $item['link']);
			}

		}

		if (empty($title)) {
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0)) {
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}

		if (empty($title)) {
			$title = $item->name;
		}
		$this->document->setTitle($title);


		if ($ezrealty->metadesc) {
			$this->document->setDescription($ezrealty->metadesc);
		}

		if ($ezrealty->metakey) {
			$this->document->setMetadata('keywords', $ezrealty->metakey);
		}

		$print = JRequest::getBool('print');
		if ($print) {
			$document->setMetaData('robots', 'noindex, nofollow');
		}
		$ezpdf = JRequest::getBool('ezpdf');
		if ($ezpdf) {
			$document->setMetaData('robots', 'noindex, nofollow');
		}

		if ( $params->get( 'er_imglayout' ) == 'images' && $params->get('er_imgfilesys') == 2 ) {
			$document->addStyleSheet("components/com_ezrealty/assets/highslide/highslide.css",'text/css',"screen");
			$document->addScript("components/com_ezrealty/assets/highslide/highslide-with-gallery.js");
		}

		if ($params->get( 'popup_linktype' )){
			$document->addScript("components/com_ezrealty/assets/highslide/highslide.js");
		}

		if ( $params->get( 'er_usemap' ) ){
			$document->addScript("http://maps.googleapis.com/maps/api/js?sensor=false");
			$document->addScript("components/com_ezrealty/assets/includes.js");
		}

        $document->addStyleSheet("components/com_ezrealty/assets/style.css",'text/css',"screen");

		if ( $params->get( 'enable_bootstrap' ) ){
			$document->addStyleSheet("components/com_ezrealty/assets/bootstrap.css",'text/css',"screen");
		}


		JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_ezrealty/tables');


        $cont =& JTable::getInstance('countrys', 'Table');
        $cont->load($ezrealty->cnid);
        $this->assignRef( 'cont', $cont );

        $stat =& JTable::getInstance('states', 'Table');
        $stat->load($ezrealty->stid);
        $this->assignRef( 'stat', $stat );

        $loc =& JTable::getInstance('localities', 'Table');
        $loc->load($ezrealty->locid);
        $this->assignRef( 'loc', $loc );

        $cat =& JTable::getInstance('categories', 'Table');
        $cat->load($ezrealty->cid);
        $this->assignRef( 'cat', $cat );


		$uri     	=& JFactory::getURI();
		$this->assign('action', 	$uri->toString());

        $this->assignRef('user', 		$user);
		$this->assignRef('print', 		$print);
		$this->assignRef('ezpdf', 		$ezpdf);
		$this->assignRef('ezrealty',	$ezrealty);
		$this->assignRef('params',		$params);

		parent::display($tpl);
	}

}
?>