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

<script language="javascript" type="text/javascript">
function showHide(shID) {
   if (document.getElementById(shID)) {
      if (document.getElementById(shID+'-show').style.display != 'none') {
         document.getElementById(shID+'-show').style.display = 'none';
         document.getElementById(shID).style.display = 'block';
      }
      else {
         document.getElementById(shID+'-show').style.display = 'inline';
         document.getElementById(shID).style.display = 'none';
      }
   }
}
</script>
<style type="text/css">
   /* This CSS is just for presentational purposes. */
   #wrap {
      width: 100%;
   }

   /* This CSS is used for the Show/Hide functionality. */
   .more {
      display: none;
      border-top: 1px solid #666;
      border-bottom: 1px solid #666;
      border-left: 1px solid #666;
      border-right: 1px solid #666;
      padding-left: 5px;
	}
   a.showLink, a.hideLink {
      text-decoration: none;
      color: #36f;
      padding-left: 8px;
      background: transparent url(down.gif) no-repeat left; }
   a.hideLink {
      background: transparent url(up.gif) no-repeat left; }
   a.showLink:hover, a.hideLink:hover {
      border-bottom: 1px dotted #36f; }
</style>


<div class="row-fluid">
	<div class="span12">

	<legend><?php echo JText::_('EZREALTY_TABS_ADDRESS');?></legend>

	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_BLDG_NAME');?></div>
		<div class="controls"><input class="input-large ezinput" type="text" name="bldg_name" id="bldg_name" value="<?php echo stripslashes($this->property->bldg_name); ?>" /></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_UNITNUM');?></div>
		<div class="controls"><input class="input-large ezinput" type="text" name="unit_num" id="unit_num" value="<?php echo stripslashes($this->property->unit_num); ?>" /></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_LOTNUM');?></div>
		<div class="controls"><input class="input-large ezinput" type="text" name="lot_num" id="lot_num" value="<?php echo stripslashes($this->property->lot_num); ?>" /></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_STREETNUM');?></div>
		<div class="controls"><input class="input-large ezinput" type="text" name="street_num" id="street_num" size="15" maxlength="10" value="<?php echo stripslashes($this->property->street_num);?>" /></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo JText::_('EZREALTY_DETAILS_PROPADDRESS2');?></div>
		<div class="controls"><input class="input-large ezinput" type="text" name="address2" id="address2" size="31" maxlength="100" value="<?php echo stripslashes($this->property->address2);?>" /></div>
	</div>
	<?php if ( $ezrparams->get( 'er_country' ) ) { ?>
		<div class="control-group">
			<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_DETAILS_COUNTRY' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?>"><?php echo JText::_('EZREALTY_DETAILS_COUNTRY');?></div>
			<div class="controls">
				<?php if (!$this->property->id && $ezrparams->get( 'er_addnew' )){ ?>
					<div id="wrap">
						<p><?php echo stripslashes($this->lists['cnid']); ?><br /><?php echo JText::_( 'EZREALTY_ADDNEW_OR' ); ?> <a href="#" id="thecount-show" class="showLink" onclick="showHide('thecount');return false;"><strong><?php echo JText::_( 'EZREALTY_ADDNEW_COUNTRY' ); ?></strong></a></p>
						<div id="thecount" class="more">
							<p><br /><?php echo JText::_( 'EZREALTY_ADDNEW_COUNTRY' ); ?><br /><input class="span12 ezinput required" type="text" name="country" id="country" size="31" maxlength="100" value="<?php echo stripslashes($this->property->country);?>" /> <a href="#" id="thecount-hide" class="hideLink" onclick="showHide('thecount');return false;"><?php echo JText::_( 'EZREALTY_ADDNEW_HIDE' ); ?></a></p>
						</div>
					</div>
				<?php } else { ?>
					<?php echo stripslashes($this->lists['cnid']); ?>
				<?php } ?>
			</div>
		</div>
	<?php } if ( $ezrparams->get( 'er_stateloc' ) == 1 ) { ?>
		<div class="control-group">
			<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_DETAILS_AREA' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?>"><?php echo JText::_('EZREALTY_DETAILS_AREA');?></div>
			<div class="controls">
				<?php if (!$this->property->id && $ezrparams->get( 'er_addnew' )){ ?>
					<div id="wrap">
						<p><?php echo stripslashes($this->lists['stid']); ?><br /><?php echo JText::_( 'EZREALTY_ADDNEW_OR' ); ?> <a href="#" id="thestat-show" class="showLink" onclick="showHide('thestat');return false;"><strong><?php echo JText::_( 'EZREALTY_ADDNEW_STATE' ); ?></strong></a></p>
						<div id="thestat" class="more">
							<p><br /><?php echo JText::_( 'EZREALTY_ADDNEW_STATE' ); ?><br /><input class="span12 ezinput required" type="text" name="state" id="state" size="31" maxlength="100" value="<?php echo stripslashes($this->property->state);?>" /> <a href="#" id="thestat-hide" class="hideLink" onclick="showHide('thestat');return false;"><?php echo JText::_( 'EZREALTY_ADDNEW_HIDE' ); ?></a></p>
						</div>
					</div>
				<?php } else { ?>
					<?php echo stripslashes($this->lists['stid']); ?>
				<?php } ?>
			</div>
		</div>
	<?php } if ( $ezrparams->get( 'er_stateloc' ) > 0 ) { ?>
		<div class="control-group">
			<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_DETAILS_PROPCITY' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?>"><?php echo JText::_('EZREALTY_DETAILS_PROPCITY');?></div>
			<div class="controls">
				<?php if (!$this->property->id && $ezrparams->get( 'er_addnew' )){ ?>
					<div id="wrap">
						<p><?php echo stripslashes($this->lists['locid']); ?><br /><?php echo JText::_( 'EZREALTY_ADDNEW_OR' ); ?> <a href="#" id="thesub-show" class="showLink" onclick="showHide('thesub');return false;"><strong><?php echo JText::_( 'EZREALTY_ADDNEW_SUBURB' ); ?></strong></a></p>
						<div id="thesub" class="more">
							<p><br /><?php echo JText::_( 'EZREALTY_ADDNEW_SUBURB' ); ?><br /><input class="span12 ezinput required" type="text" name="locality" id="locality" size="31" maxlength="100" value="<?php echo stripslashes($this->property->locality);?>" /> <a href="#" id="thesub-hide" class="hideLink" onclick="showHide('thesub');return false;"><?php echo JText::_( 'EZREALTY_ADDNEW_HIDE' ); ?></a></p>
						</div>
					</div>
				<?php } else { ?>
					<?php echo stripslashes($this->lists['locid']); ?>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	<?php if ( $ezrparams->get( 'er_usepc' ) ) { ?>
		<div class="control-group">
			<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_DETAILS_PROPPOSTCODE' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_REQ' ); ?>"><?php echo JText::_('EZREALTY_DETAILS_PROPPOSTCODE');?></div>
			<div class="controls"><input class="input-large ezinput required" type="text" name="postcode" id="postcode" size="15" maxlength="100" value="<?php echo stripslashes($this->property->postcode);?>" /></div>
		</div>
	<?php } ?>


	<div class="control-group">
		<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_DETAILS_PROPCOUNTY' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_PROPCOUNTY_DESC' ); ?>"><?php echo JText::_('EZREALTY_DETAILS_PROPCOUNTY');?></div>
		<div class="controls"><input class="input-large ezinput" type="text" name="county" id="county" size="31" maxlength="100" value="<?php echo stripslashes($this->property->county);?>" /></div>
	</div>
	<?php if ($ezrparams->get( 'er_usemap' ) ) { ?>
		<div class="control-group">
			<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_LISTINGS_OWNCOORDS' ); ?>::<?php echo JText::_( 'EZREALTY_LISTINGS_OWNCOORDS_DESC' ); ?>"> </div>
			<div class="controls">
				<span class="hasTip" title="<?php echo JText::_( 'EZREALTY_LISTINGS_OWNCOORDS' ); ?>::<?php echo JText::_( 'EZREALTY_LISTINGS_OWNCOORDS_DESC' ); ?>"><?php echo JText::_('EZREALTY_LISTINGS_OWNCOORDS'); ?></span><br />
				<fieldset id="owncoords" class="radio btn-group">
					<input type="radio" id="owncoords0" name="owncoords" value="0" <?php if ($this->property->owncoords=='0'){ echo " checked=CHECKED "; } ?> />
					<label for="owncoords0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
					<input type="radio" id="owncoords1" name="owncoords" value="1" <?php if ($this->property->owncoords=='1'){ echo " checked=CHECKED "; } ?> />
					<label for="owncoords1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
				</fieldset>
			</div>
		</div>
		<div class="control-group">
			<div class="control-label"> </div>
			<div class="controls">
				<table>
					<tr>
						<td class="nowrap">
							<input class="input-small ezinput" type="text" name="declat" id="declat" maxlength="25" value="<?php echo stripslashes($this->property->declat);?>" /><br />
							<?php echo JText::_( 'EZREALTY_DETAILS_DECLAT' ); ?>
						</td>
						<td class="nowrap">
							<input class="input-small ezinput" type="text" name="declong" id="declong" maxlength="25" value="<?php echo stripslashes($this->property->declong);?>" /><br />
							<?php echo JText::_( 'EZREALTY_DETAILS_DECLONG' ); ?>
						</td>
					</tr>
				</table>
			</div>
		</div>
	<?php } ?>

	<div class="control-group">
		<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_DETAILS_DISPLAYAD' ); ?>::<?php echo JText::_( 'EZREALTY_DETAILS_DISPLAYAD_DESC' ); ?>"><?php echo JText::_('EZREALTY_DETAILS_DISPLAYAD'); ?></div>
		<div class="controls">
			<fieldset id="viewad" class="radio btn-group">
				<input type="radio" id="viewad0" name="viewad" value="0" <?php if ($this->property->viewad=='0'){ echo " checked=CHECKED "; } ?> />
				<label for="viewad0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
				<input type="radio" id="viewad1" name="viewad" value="1" <?php if ($this->property->viewad=='1'){ echo " checked=CHECKED "; } ?> />
				<label for="viewad1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
			</fieldset>
		</div>
	</div>

	<?php if ( $ezrparams->get( 'er_schoolprof' ) ) { ?>
		<div class="control-group">
			<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_VIEW_SCHOOL_PROFILE' ); ?>::<?php echo JText::_( 'EZREALTY_VIEW_SCHOOL_PROFILE_DESC' ); ?>"><?php echo JText::_('EZREALTY_VIEW_SCHOOL_PROFILE'); ?></div>
			<div class="controls">
				<fieldset id="schoolprof" class="radio btn-group">
					<input type="radio" id="schoolprof0" name="schoolprof" value="0" <?php if ($this->property->schoolprof=='0'){ echo " checked=CHECKED "; } ?> />
					<label for="schoolprof0"><?php echo JText::_( 'EZREALTY_SCHOOLS_NONE' ); ?></label>
					<input type="radio" id="schoolprof1" name="schoolprof" value="1" <?php if ($this->property->schoolprof=='1'){ echo " checked=CHECKED "; } ?> />
					<label for="schoolprof1"><?php echo JText::_( 'EZREALTY_SCHOOLS_US' ); ?></label>
					<input type="radio" id="schoolprof2" name="schoolprof" value="2" <?php if ($this->property->schoolprof=='2'){ echo " checked=CHECKED "; } ?> />
					<label for="schoolprof2"><?php echo JText::_( 'EZREALTY_SCHOOLS_UK' ); ?></label>
	
				</fieldset>
			</div>
		</div>
	<?php } if ( $ezrparams->get( 'er_hoodprof' ) ) { ?>
		<div class="control-group">
			<div class="hasTip control-label" title="<?php echo JText::_( 'EZREALTY_VIEW_HOOD_PROFILE' ); ?>::<?php echo JText::_( 'EZREALTY_VIEW_HOOD_PROFILE_DESC' ); ?>"><?php echo JText::_('EZREALTY_VIEW_HOOD_PROFILE'); ?></div>
			<div class="controls">
				<fieldset id="hoodprof" class="radio btn-group">
					<input type="radio" id="hoodprof0" name="hoodprof" value="0" <?php if ($this->property->hoodprof=='0'){ echo " checked=CHECKED "; } ?> />
					<label for="hoodprof0"><?php echo JText::_( 'EZREALTY_CONFIG_NO' ); ?></label>
					<input type="radio" id="hoodprof1" name="hoodprof" value="1" <?php if ($this->property->hoodprof=='1'){ echo " checked=CHECKED "; } ?> />
					<label for="hoodprof1"><?php echo JText::_( 'EZREALTY_CONFIG_YES' ); ?></label>
				</fieldset>
			</div>
		</div>
	<?php } ?>


	</div>
</div>
