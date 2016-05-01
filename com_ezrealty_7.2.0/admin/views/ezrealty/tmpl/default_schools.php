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

$ezrparams = JComponentHelper::getParams ('com_ezrealty');

?>

	<div class="row-fluid">
		<div class="span12">

			<legend><?php echo JText::_('EZREALTY_DETAILS_SCHOOLS_TITLE');?></legend>

			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_LISTINGS_SCHOOLDIST');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="schooldist" id="schooldist" maxlength="50" value="<?php echo stripslashes($this->property->schooldist);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_LISTINGS_PRESCHOOL');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="preschool" id="preschool" maxlength="50" value="<?php echo stripslashes($this->property->preschool);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_LISTINGS_PRIMARYSCHOOL');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="primaryschool" id="primaryschool" maxlength="50" value="<?php echo stripslashes($this->property->primaryschool);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_LISTINGS_HIGHSCHOOL');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="highschool" id="highschool" maxlength="50" value="<?php echo stripslashes($this->property->highschool);?>" /></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('EZREALTY_LISTINGS_UNIVERSITY');?></div>
				<div class="controls"><input class="input-large ezinput" type="text" name="university" id="university" maxlength="50" value="<?php echo stripslashes($this->property->university);?>" /></div>
			</div>

		</div>
	</div>

