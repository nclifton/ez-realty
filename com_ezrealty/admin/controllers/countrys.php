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

jimport( 'joomla.application.component.controller' );

class EZRealtyControllerCountrys extends JControllerAdmin
{

	function __construct() {
		parent::__construct();             
		$this->registerTask("", "display");
		$this->registerTask("add", "edit");
		$this->registerTask("apply", "save");
		$this->registerTask("unpublish", "publish");
		$this->registerTask("publish", "publish");
		$this->registerTask("saveorder", "saveorder");	
		$this->registerTask("orderdown", "orderdown");	
		$this->registerTask("orderup", "orderup");	          
		$this->registerTask("checkin", "checkin");
	}
	
    function display() {
        
        $model = & $this->getModel('countrys');
		$view = $this->getView("countrys", "html");
		$view->setModel($model, true);
		$view->display();
    }
  
    function edit() {
        $model = & $this->getModel('countrys');
        $view = $this->getView("countrys", "html");
        $view->setModel($model, true);
        $view->setLayout("edit");
        $view->edit();  
    }
  
    function save() {

        $model = $this->getModel('countrys');
        $res = $model->store();

		$id = JRequest::getVar( 'id', '' );

        if (JRequest::getVar('applyFlag') == 1) {
            $link = 'index.php?option=com_ezrealty&controller=countrys&task=edit&hidemainmenu=1&cid=' .$res;
        } else {
            $link = 'index.php?option=com_ezrealty&controller=countrys';
		}

        if ($res) {
            $msg = JText::_( 'EZREALTY_GENERIC_SAVED' );
        } else {
            $msg = JText::_( 'EZREALTY_SAVEERROR' );
        }

        $this->setRedirect($link, $msg);
    }
  
    /**
     * remove record(s)
     * @return void
     */
    function remove()
    {
        $model = $this->getModel('countrys');
        if(!$model->delete()) {
            $msg = JText::_( 'EZREALTY_ENTRIES_NOT_DELETED' );
        } else {
            $msg = JText::_( 'EZREALTY_ENTRIES_DELETED' );
        }

        $this->setRedirect( 'index.php?option=com_ezrealty&controller=countrys', $msg );
    }
    
    /**
     * cancel editing a record
     * @return void
     */
    function cancel() {

        $model = $this->getModel('countrys');     
        $res = $model->closeit();

        $msg = JText::_( 'EZREALTY_OPERATION_CANCELLED' );
        $this->setRedirect( 'index.php?option=com_ezrealty&controller=countrys', $msg );
    }

	function orderdown() {
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
        $model = $this->getModel('countrys');        
		$model->orderField( $cid[0], 1 );
		$link = "index.php?option=com_ezrealty&controller=countrys";
		$this->setRedirect($link, $msg);		
	}
	
	function orderup() {
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
        
        $model = $this->getModel('countrys');        
		$model->orderField( $cid[0], -1 );	
        
		//die();
		$link = "index.php?option=com_ezrealty&controller=countrys";
		$this->setRedirect($link, $msg);		
	}	
	
	function saveorder() {
        $model = $this->getModel('countrys');   
		$res = $model->saveorder();        
		$link = "index.php?option=com_ezrealty&controller=countrys";
		$this->setRedirect($link, $msg);
	}
    
    function sort() {
		$link = "index.php?option=com_ezrealty&controller=countrys";
		$this->setRedirect($link, $msg);
    }

	function publish () {

        $model = $this->getModel('countrys'); 
		$res = $model->publish();

		if ($res) {
			$msg = JText::_('EZREALTY_PUB');
		} else {
            $msg = JText::_('EZREALTY_UNPUB');
		}		
		$link = "index.php?option=com_ezrealty&controller=countrys";
		$this->setRedirect($link, $msg);
	}    

	function checkin () {

        $model = $this->getModel('countrys'); 
		$res = $model->docheckin();

		if ($res) {
			$msg = JText::_('EZREALTY_CHECKIN_SUCCESS');
		} else {
            $msg = JText::_('EZREALTY_CHECKIN_FAILED');
		}		

		$link = "index.php?option=com_ezrealty&controller=countrys";
		$this->setRedirect($link, $msg);
	}

}


?>
