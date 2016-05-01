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


?>



		
					<?php if ( $this->ezrparams->get( 'appliancefeats' ) && $this->ezrparams->get( 'use_appliancefeats' ) ){ ?>
					
						<div class="row-fluid">
							<div class="span12">
					
								<legend><?php echo JText::_('EZREALTY_CONFIG_FEATURES_APPLIANCES');?></legend>
					
								<?php echo $this->lists['appliances'];?>
					
							</div>
						</div>
					
					<?php }
					if ( $this->ezrparams->get( 'indoorfeats' ) && $this->ezrparams->get( 'use_indoorfeats' ) ){ ?>
					
						<div class="row-fluid">
							<div class="span12">
					
								<legend><?php echo JText::_('EZREALTY_CONFIG_FEATURES_INDOOR');?></legend>
					
								<?php echo $this->lists['indoorfeatures'];?>
					
							</div>
						</div>
					
					<?php } ?>
					
					<?php if ( $this->ezrparams->get( 'outdoorfeats' ) && $this->ezrparams->get( 'use_outdoorfeats' ) ){ ?>
					
						<div class="row-fluid">
							<div class="span12">
					
								<legend><?php echo JText::_('EZREALTY_CONFIG_FEATURES_OUTDOOR');?></legend>
					
								<?php echo $this->lists['outdoorfeatures'];?>
					
							</div>
						</div>
					
					<?php } ?>
		
	
					<?php if ( $this->ezrparams->get( 'buildingfeats' ) && $this->ezrparams->get( 'use_buildingfeats' ) ){ ?>
					
						<div class="row-fluid">
							<div class="span12">
					
								<legend><?php echo JText::_('EZREALTY_CONFIG_FEATURES_BUILDING');?></legend>
					
								<?php echo $this->lists['buildingfeatures'];?>
					
							</div>
						</div>
					
					<?php } ?>
					
					<?php if ( $this->ezrparams->get( 'communityfeats' ) && $this->ezrparams->get( 'use_communityfeats' ) ){ ?>
					
						<div class="row-fluid">
							<div class="span12">
					
								<legend><?php echo JText::_('EZREALTY_CONFIG_FEATURES_COMMUNITY');?></legend>
					
								<?php echo $this->lists['communityfeatures'];?>
					
							</div>
						</div>
					
					<?php }
					if ( $this->ezrparams->get( 'otherfeats' ) && $this->ezrparams->get( 'use_otherfeats' ) ){ ?>
					
						<div class="row-fluid">
							<div class="span12">
					
								<legend><?php echo JText::_('EZREALTY_OTHER_FEATURES');?></legend>
					
								<?php echo $this->lists['otherfeatures'];?>
					
							</div>
						</div>
					
					<?php } ?>
		

