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

class EZRealtyControllerAgents extends JControllerAdmin
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
		$this->registerTask("dataupdate", "dataupdate");	          
		$this->registerTask("checkin", "checkin");
	}
	
    function display() {
        
        $model = & $this->getModel('agents');
        
		$view = $this->getView("agents", "html");
		$view->setModel($model, true);    
        
		$view->display();
    }
  
    function edit() {
        
        $view = $this->getView("agents", "html");
        
        $model = & $this->getModel('agents');
        $view->setModel($model, true); 
        
        $view->setLayout("edit");
        $view->edit();  
    }
  
    function save() {
    
		$db	= & JFactory::getDBO();

		$id = JRequest::getVar( 'id', '' );
		$uid = JRequest::getVar( 'uid', '' );

        if (JRequest::getVar('applyFlag') == 1) {
            $link = 'index.php?option=com_ezrealty&controller=agents&task=edit&hidemainmenu=1&cid=' .$id;
        } else {
            $link = 'index.php?option=com_ezrealty&controller=agents';
		}

		/** check for existing member */
		$query = 'SELECT id FROM #__ezportal WHERE uid = '.(int) $uid.' AND id != '.(int) $id;
		$db->setQuery($query);

		$xid = intval($db->loadResult());
		if ($xid && $xid != intval($id)) {

            echo "<script> alert('".JText::_('COM_EZREALTY_AGENT_ERROR')."'); window.history.go(-1); </script>\n";
            exit();

		} else {

    	    $model = $this->getModel('agents');
			$res = $model->store();

			if ($res) {
				$msg = JText::_( 'EZREALTY_GENERIC_SAVED' );
			} else {
				$msg = JText::_( 'EZREALTY_SAVEERROR' );
			}

    	    $this->setRedirect($link, $msg);          

		}
    }
  
    /**
     * remove record(s)
     * @return void
     */
    function remove()
    {
        $model = $this->getModel('agents');
        if(!$model->delete()) {
            $msg = JText::_( 'EZREALTY_ENTRIES_NOT_DELETED' );
        } else {
            $msg = JText::_( 'EZREALTY_ENTRIES_DELETED' );
        }     

        $this->setRedirect( 'index.php?option=com_ezrealty&controller=agents', $msg );
    }
    
    /**
     * cancel editing a record
     * @return void
     */
    function cancel() {

        $model = $this->getModel('agents');     
        $res = $model->closeit();

        $msg = JText::_( 'EZREALTY_OPERATION_CANCELLED' );
        $this->setRedirect( 'index.php?option=com_ezrealty&controller=agents', $msg );
    }

	function orderdown() {
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
        $model = $this->getModel('agents');        
		$model->orderField( $cid[0], 1 );
		$link = "index.php?option=com_ezrealty&controller=agents";
		$this->setRedirect($link, $msg);		
	}
	
	function orderup() {
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
        
        $model = $this->getModel('agents');        
		$model->orderField( $cid[0], -1 );	
        
		//die();
		$link = "index.php?option=com_ezrealty&controller=agents";
		$this->setRedirect($link, $msg);		
	}	
	
	function saveorder() {
        $model = $this->getModel('agents');   
		$res = $model->saveorder();        
		$link = "index.php?option=com_ezrealty&controller=agents";
		$this->setRedirect($link, $msg);
	}
    
    function sort() {
		$link = "index.php?option=com_ezrealty&controller=agents";
		$this->setRedirect($link, $msg);
    }

	function publish () {

        $model = $this->getModel('agents'); 
		$res = $model->publish();

		if (!$res) {
			$msg = JText::_('EZREALTY_PUB');
		} else {
            $msg = JText::_('EZREALTY_UNPUB');
		}		
		$link = "index.php?option=com_ezrealty&controller=agents";
		$this->setRedirect($link, $msg);
	}    

	function checkin () {

        $model = $this->getModel('agents'); 
		$res = $model->docheckin();

		if ($res) {
			$msg = JText::_('EZREALTY_CHECKIN_SUCCESS');
		} else {
            $msg = JText::_('EZREALTY_CHECKIN_FAILED');
		}		

		$link = "index.php?option=com_ezrealty&controller=agents";
		$this->setRedirect($link, $msg);
	}


    function deleteavatar () {
    
        $database = & JFactory::getDBO();
        $id = JRequest::getVar('cid',0);

        $database->setQuery( "select seller_image from #__ezportal where id=$id" );
        $seller_image=$database->loadResult();

        if ( $id > 0 && !empty($seller_image)) {
        
			@unlink( JPath::clean(JPATH_SITE . '/images/ezportal/avatar/'. $seller_image) );
            $database->setQuery( "UPDATE #__ezportal SET seller_image='' WHERE id=$id" );

            if ( !$database->query() ) {
            echo "<script> alert('" . $database->getErrorMsg()
            . "'); window.history.go(-1); </script>\n";
            }

			$msg = JText::_('COM_EZREALTY_FILE_DELETED');
			$link = "index.php?option=com_ezrealty&controller=agents&task=edit&hidemainmenu=1&cid=".$id;
			$this->setRedirect($link, $msg);

        }
    }




}


?>
