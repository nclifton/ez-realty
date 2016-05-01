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

		<legend><?php echo JText::_('EZREALTY_DETAILS_BUILDINGINFO');?></legend>

				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_YEAR_BUILT');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="year" id="year" size="15" maxlength="6" value="<?php echo stripslashes($this->property->year);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_YEAR_REMODELED');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="yearRemodeled" id="yearRemodeled" size="15" maxlength="6" value="<?php echo stripslashes($this->property->yearRemodeled);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_HOUSESTYLE');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="houseStyle" id="houseStyle" size="15" maxlength="30" value="<?php echo stripslashes($this->property->houseStyle);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_HOUSECONST');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="houseConstruction" id="houseConstruction" size="15" maxlength="30" value="<?php echo stripslashes($this->property->houseConstruction);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_EXTFINISH');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="exteriorFinish" id="exteriorFinish" size="15" maxlength="30" value="<?php echo stripslashes($this->property->exteriorFinish);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_ROOF');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="roof" id="roof" size="15" maxlength="30" value="<?php echo stripslashes($this->property->roof);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_FLOORING');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="flooring" id="flooring" size="15" maxlength="30" value="<?php echo stripslashes($this->property->flooring);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_PORCHPATIO');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="porchPatio" id="porchPatio" size="15" maxlength="30" value="<?php echo stripslashes($this->property->porchPatio);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_FLOORS');?></div>
					<div class="controls"><input class="input-large ezinput" type="text" name="stories" id="stories" size="15" maxlength="5" value="<?php if ( $this->property->stories == 0 ) { echo ''; } else { echo $this->property->stories; } ?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_SQFTLOWER');?> (<?php echo EZRealtyHelper::convertFloorArea();?>)</div>
					<div class="controls"><input class="input-large ezinput" type="text" name="SqFtLower" id="SqFtLower" size="15" maxlength="8" value="<?php echo stripslashes($this->property->SqFtLower);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_SQFTMAIN');?> (<?php echo EZRealtyHelper::convertFloorArea();?>)</div>
					<div class="controls"><input class="input-large ezinput" type="text" name="SqFtMainLevel" id="SqFtMainLevel" size="15" maxlength="8" value="<?php echo stripslashes($this->property->SqFtMainLevel);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_SQFTUPPER');?> (<?php echo EZRealtyHelper::convertFloorArea();?>)</div>
					<div class="controls"><input class="input-large ezinput" type="text" name="SqFtUpper" id="SqFtUpper" size="15" maxlength="8" value="<?php echo stripslashes($this->property->SqFtUpper);?>" /></div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo JText::_( 'EZREALTY_DETAILS_SQUARES' ); ?> (<?php echo EZRealtyHelper::convertFloorArea();?>)
					</div>
					<div class="controls"><input class="input-large ezinput" type="text" name="squarefeet" id="squarefeet" size="15" maxlength="50" value="<?php echo stripslashes($this->property->squarefeet);?>" /></div>
				</div>

	</div>
</div>

