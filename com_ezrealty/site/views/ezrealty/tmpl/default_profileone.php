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

$ezrparams = JComponentHelper::getParams ('com_ezrealty');

if (!$ezrparams->get('page_iconcolour')){
	$pageiconcolour = "ezicon-black";
} else {
	$pageiconcolour = "ezicon-white";
}

if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){

	require_once (JPATH_SITE . '/components/com_ezportal/helpers/route.php' );

	$db =& JFactory::getDBO();

	$where1 = ' WHERE a.published = 1 AND cc.id = a.cid AND a.uid = '. $this->ezrealty->owner;
	$howmany = ' LIMIT 1';

	$query1 = 'SELECT a.*, cc.title AS category, '
	.' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', a.id, a.alias) ELSE a.id END as slug, '
	.' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(\':\', cc.id, cc.alias) ELSE cc.id END as catslug '
	.' FROM #__ezportal AS a'
	.' LEFT JOIN #__ezportal_catg AS cc ON cc.id = a.cid'
	. $where1
	. $howmany
	;
	$db->setQuery( $query1 );

	//echo $query;

	$rows1 = $db->loadObjectList();

	if ($rows1){
		$row1 = $rows1[0];
		$primlink = JRoute::_(EzportalHelperRoute::getEzportalRoute($row1->slug, $row1->catslug));
	}
	if ($this->ezrealty->assoc_agent && $this->ezrealty->adealerpublished) {

	$where2 = ' WHERE a.published = 1 AND cc.id = a.cid AND a.uid = '. $this->ezrealty->assoc_agent;

	$query2 = 'SELECT a.*, cc.title AS category, '
	.' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', a.id, a.alias) ELSE a.id END as slug, '
	.' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(\':\', cc.id, cc.alias) ELSE cc.id END as catslug '
	.' FROM #__ezportal AS a'
	.' LEFT JOIN #__ezportal_catg AS cc ON cc.id = a.cid'
	. $where2
	. $howmany
	;
	$db->setQuery( $query2 );

	//echo $query;

	$rows2 = $db->loadObjectList();

	$row2 = $rows2[0];
	$seclink = JRoute::_(EzportalHelperRoute::getEzportalRoute($row2->slug, $row2->catslug));

	}
}

?>

<?php if ($this->ezrealty->dealerpublished) { ?>

	<div class="row-fluid">
		<div class="span12">

			<div class="row-fluid">
				<div class="span2">

					<?php if ($this->print){
						echo EZRealtyFHelper::convertSellerImage ($this->ezrealty->dealer_image, '1');
					} else {
						echo EZRealtyFHelper::convertSellerImage ($this->ezrealty->dealer_image, '0');
					} ?>

				</div>

				<div class="span10">
					<div class="ezitem-leftpad">

					<div class="row-fluid">
						<div class="span12">

							<h3>
								<?php if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php') && $primlink){ ?>
									<a href="<?php echo $primlink;?>"><?php echo stripslashes($this->ezrealty->dealer_name);?></a> 
								<?php } else { ?>
									<?php echo stripslashes($this->ezrealty->dealer_name);?> 
								<?php } ?>
								<?php if ($this->ezrealty->dealer_jobtitle){ echo " (". $this->ezrealty->dealer_jobtitle .")"; } ?>
							</h3><hr />

						</div>
					</div>

					<div class="row-fluid">
						<div class="span12">

							<?php if ($this->ezrealty->dealer_company) { ?>
								<strong><?php echo stripslashes($this->ezrealty->dealer_company);?></strong><br />
							<?php } ?>

							<?php if ($this->ezrealty->dealer_unitnum) { ?><?php echo stripslashes($this->ezrealty->dealer_unitnum);?>/<?php } ?><?php if ($this->ezrealty->dealer_address1) { ?><?php echo stripslashes($this->ezrealty->dealer_address1);?><?php } ?>
							<?php if ($this->ezrealty->dealer_address2) { ?><?php echo stripslashes($this->ezrealty->dealer_address2);?><br /><?php } ?>
							<?php if ($this->ezrealty->dealer_suburb) { ?><?php echo stripslashes($this->ezrealty->dealer_suburb);?> <?php } ?>
							<?php if ($this->ezrealty->dealer_state) { ?><?php echo stripslashes($this->ezrealty->dealer_state);?> <?php } ?>
							<?php if ($this->ezrealty->dealer_pcode) { ?><?php echo stripslashes($this->ezrealty->dealer_pcode);?><?php } ?><br />

							<?php if ($this->ezrealty->dealer_phone) { ?>
								<?php echo JText::_('EZREALTY_PROFILE_PHONE');?>:&nbsp;<?php echo stripslashes($this->ezrealty->dealer_phone);?><br />
							<?php } ?>
							<?php if ($this->ezrealty->dealer_mobile) { ?>
								<?php echo JText::_('EZREALTY_PROFILE_MOBILE2');?>:&nbsp;<?php echo stripslashes($this->ezrealty->dealer_mobile);?><br />
							<?php } ?>
							<?php if ($this->ezrealty->dealer_fax) { ?>
								<?php echo JText::_('EZREALTY_PROFILE_FAX');?>:&nbsp;<?php echo stripslashes($this->ezrealty->dealer_fax);?><br />
							<?php } ?>

							<?php if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php') && $primlink){ ?>
								<i class="icon-user <?php echo $pageiconcolour;?>"></i> <a href="<?php echo $primlink;?>">View My Profile</a> 
							<?php } ?>

						</div>
					</div>

				</div>
				</div>
			</div>

		</div>
	</div>

	<?php if ($ezrparams->get( 'er_usesecondary' )){ ?>
	<br />
	<div class="row-fluid">
		<div class="span12">

			<?php if ($this->ezrealty->assoc_agent && $this->ezrealty->adealerpublished) { ?>
				<div class="row-fluid">
					<div class="span2">

						<?php if ($this->print){
							echo EZRealtyFHelper::convertSellerImage ($this->ezrealty->adealer_image, '1');
						} else {
							echo EZRealtyFHelper::convertSellerImage ($this->ezrealty->adealer_image, '0');
						} ?>

					</div>
					<div class="span10">
						<div class="ezitem-leftpad">

							<div class="row-fluid">
								<div class="span12">

									<h3>
										<?php if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){ ?>
											<a href="<?php echo $seclink;?>"><?php echo stripslashes($this->ezrealty->adealer_name);?></a> 
										<?php } else { ?>
											<?php echo stripslashes($this->ezrealty->adealer_name);?> 
										<?php } ?>
										<?php if ($this->ezrealty->adealer_jobtitle){ echo " (". $this->ezrealty->adealer_jobtitle .")"; } ?>
									</h3><hr />

								</div>
							</div>

							<div class="row-fluid">
								<div class="span12">

									<?php if ($this->ezrealty->adealer_company) { ?>
										<strong><?php echo stripslashes($this->ezrealty->adealer_company);?></strong><br />
									<?php } ?>

									<?php if ($this->ezrealty->adealer_unitnum) { ?><?php echo stripslashes($this->ezrealty->adealer_unitnum);?>/<?php } ?><?php if ($this->ezrealty->adealer_address1) { ?><?php echo stripslashes($this->ezrealty->adealer_address1);?><?php } ?>
									<?php if ($this->ezrealty->adealer_address2) { ?><?php echo stripslashes($this->ezrealty->adealer_address2);?><br /><?php } ?>
									<?php if ($this->ezrealty->adealer_suburb) { ?><?php echo stripslashes($this->ezrealty->adealer_suburb);?> <?php } ?>
									<?php if ($this->ezrealty->adealer_state) { ?><?php echo stripslashes($this->ezrealty->adealer_state);?> <?php } ?>
									<?php if ($this->ezrealty->adealer_pcode) { ?><?php echo stripslashes($this->ezrealty->adealer_pcode);?><?php } ?><br />

									<?php if ($this->ezrealty->adealer_phone) { ?>
										<?php echo JText::_('EZREALTY_PROFILE_PHONE');?>:&nbsp;<?php echo stripslashes($this->ezrealty->adealer_phone);?><br />
									<?php } ?>
									<?php if ($this->ezrealty->adealer_mobile) { ?>
										<?php echo JText::_('EZREALTY_PROFILE_MOBILE2');?>:&nbsp;<?php echo stripslashes($this->ezrealty->adealer_mobile);?><br />
									<?php } ?>
									<?php if ($this->ezrealty->adealer_fax) { ?>
										<?php echo JText::_('EZREALTY_PROFILE_FAX');?>:&nbsp;<?php echo stripslashes($this->ezrealty->adealer_fax);?><br />
									<?php } ?>

									<?php if ( $ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){ ?>
										<i class="icon-user <?php echo $pageiconcolour;?>"></i> <a href="<?php echo $seclink;?>">View My Profile</a> 
									<?php } ?>

								</div>
							</div>
						</div>

					</div>
				</div>
			<?php } ?>

		</div>

	</div>

	<?php } ?>

<?php } else { ?>

	<div class="row-fluid">
		<div class="span12">
			<?php echo JText::_('EZREALTY_PNPFC');?>
		</div>
	</div>

<?php } ?>

