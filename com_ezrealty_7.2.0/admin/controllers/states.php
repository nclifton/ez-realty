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

class EZRealtyControllerStates extends JControllerAdmin
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
        
        $modelStates = & $this->getModel('states');
        
		$view = $this->getView("states", "html");
		$view->setModel($modelStates, true);
        
		$modelCountrys =& $this->getModel("countrys");
		$view->setModel($modelCountrys);        
        
		$view->display();
    }
  
    function edit() {
        
        $view = $this->getView("states", "html");
        
        $modelStates = & $this->getModel('states');
        $view->setModel($modelStates, true);
        
		$modelCountrys =& $this->getModel("countrys");
		$view->setModel($modelCountrys);        
        
        $view->setLayout("edit");
        $view->edit();  
    }
  
    function save() {
    
        $model = $this->getModel('states');
        $res = $model->store();

		$id = JRequest::getVar( 'id', '' );

        if (JRequest::getVar('applyFlag') == 1) {
            $link = 'index.php?option=com_ezrealty&controller=states&task=edit&hidemainmenu=1&cid=' .$res;
        } else {
            $link = 'index.php?option=com_ezrealty&controller=states';
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
        $model = $this->getModel('states');
        if(!$model->delete()) {
            $msg = JText::_( 'EZREALTY_ENTRIES_NOT_DELETED' );
        } else {
            $msg = JText::_( 'EZREALTY_ENTRIES_DELETED' );
        }

        $this->setRedirect( 'index.php?option=com_ezrealty&controller=states', $msg );
    }
    
    /**
     * cancel editing a record
     * @return void
     */
    function cancel() {

        $model = $this->getModel('states');     
        $res = $model->closeit();

        $msg = JText::_( 'EZREALTY_OPERATION_CANCELLED' );
        $this->setRedirect( 'index.php?option=com_ezrealty&controller=states', $msg );
    }

	function orderdown() {
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
        $model = $this->getModel('states');        
		$model->orderField( $cid[0], 1 );
		$link = "index.php?option=com_ezrealty&controller=states";
		$this->setRedirect($link, $msg);		
	}
	
	function orderup() {
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
        
        $model = $this->getModel('states');        
		$model->orderField( $cid[0], -1 );	
        
		//die();
		$link = "index.php?option=com_ezrealty&controller=states";
		$this->setRedirect($link, $msg);		
	}	
	
	function saveorder() {
        $model = $this->getModel('states');   
		$res = $model->saveorder();        
		$link = "index.php?option=com_ezrealty&controller=states";
		$this->setRedirect($link, $msg);
	}
    
    function sort() {
		$link = "index.php?option=com_ezrealty&controller=states";
		$this->setRedirect($link, $msg);
    }

	function publish () {

        $model = $this->getModel('states'); 
		$res = $model->publish();

		if ($res) {
			$msg = JText::_('EZREALTY_PUB');
		} else {
            $msg = JText::_('EZREALTY_UNPUB');
		}	
		$link = "index.php?option=com_ezrealty&controller=states";
		$this->setRedirect($link, $msg);
	}    

	function checkin () {

        $model = $this->getModel('states'); 
		$res = $model->docheckin();

		if ($res) {
			$msg = JText::_('EZREALTY_CHECKIN_SUCCESS');
		} else {
            $msg = JText::_('EZREALTY_CHECKIN_FAILED');
		}		

		$link = "index.php?option=com_ezrealty&controller=states";
		$this->setRedirect($link, $msg);
	}

}


?>
