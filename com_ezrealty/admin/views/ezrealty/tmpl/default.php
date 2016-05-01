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
 
$database = & JFactory::getDBO();
$user 	=& JFactory::getUser();
    
$items = $this->items;
$lists = $this->lists;

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('dropdown.init');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.modal');

$listOrder	= $this->lists['order'];
$listDirn	= $this->lists['order_Dir'];


?>

<?php if(!$this->checktest){ ?>
	<div align="center"><br /><br /><span style="font-size: 28px; color: #ff0000; font-weight: bold;"><?php echo JText::_( 'EZREALTY_UPGRADE_WARNING1' ); ?><br /><br /><?php echo JText::_( 'EZREALTY_UPGRADE_WARNING2' ); ?><br /><br /><?php echo JText::_( 'EZREALTY_UPGRADE_WARNING4' ); ?></span><br /><br /><br /><br /></div>
<?php } else { ?>
	<?php if(!$this->upgradecheck){ ?>
		<div align="center"><br /><br /><span style="font-size: 28px; color: #ff0000; font-weight: bold;"><?php echo JText::_( 'EZREALTY_UPGRADE_WARNING1' ); ?><br /><br /><?php echo JText::_( 'EZREALTY_UPGRADE_WARNING3' ); ?><br /><br /><?php echo JText::_( 'EZREALTY_UPGRADE_WARNING4' ); ?></span><br /><br /></div>
	<?php } ?>
<?php } ?>

<?php if ( $this->checktest && $this->upgradecheck && !$this->ezrparams->get( 'user_id' )  ){ ?>

	<div align="center"><br /><br /><span style="font-size: 28px; color: #ff0000; font-weight: bold;"><?php echo JText::_( 'EZREALTY_CONFIG_WARNING' ); ?></span><br /><br /></div>

<?php } ?>

<form action="<?php echo JRoute::_('index.php?option=com_ezrealty'); ?>" method="post" name="adminForm" id="adminForm">

	<?php if($this->checktest && $this->upgradecheck){ ?>

		<?php if(!empty( $this->sidebar)): ?>
			<div id="j-sidebar-container" class="span2">
				<?php echo $this->sidebar; ?>
		
				<hr />
		
				<?php if (!$this->ezrparams->get( 'er_filtercid' ) && !$this->ezrparams->get( 'er_filtertype' ) && !$this->ezrparams->get( 'er_filterstreet' ) && !$this->ezrparams->get( 'er_filterloc' ) && !$this->ezrparams->get( 'er_filterstate' ) && !$this->ezrparams->get( 'er_filtercount' ) && !$this->ezrparams->get( 'er_filterseller' ) ) { } else { ?>
		
					<div class="filter-select hidden-phone">
						<h4 class="page-header"><?php echo JText::_('COM_EZREALTY_FILTERBY');?></h4>
						<?php echo $lists['published']."<hr class=\"hr-condensed\" />";
						if ( $this->ezrparams->get( 'er_filtercid' ) == '1' ){ echo $lists['cid']."<hr class=\"hr-condensed\" />"; }
						if ( $this->ezrparams->get( 'er_filtertype' ) == '1' ){ echo $lists['type']."<hr class=\"hr-condensed\" />"; }
						if ( $this->ezrparams->get( 'er_usemarket' ) == '1' ){ echo $lists['sold']."<hr class=\"hr-condensed\" />"; }
		
						if ( $this->ezrparams->get( 'er_filtercount' ) && $this->ezrparams->get( 'er_filterstate' ) && $this->ezrparams->get( 'er_filterloc' ) ) {
							echo $lists['cnid']."<hr class=\"hr-condensed\" />";
							echo $lists['stid']."<hr class=\"hr-condensed\" />";
							echo $lists['locid']."<hr class=\"hr-condensed\" />";
						}
						if ( !$this->ezrparams->get( 'er_filtercount' ) && $this->ezrparams->get( 'er_filterstate' ) && $this->ezrparams->get( 'er_filterloc' ) ) {
							echo $lists['stid']."<hr class=\"hr-condensed\" />";
							echo $lists['locid']."<hr class=\"hr-condensed\" />";
						}
						if ( $this->ezrparams->get( 'er_filtercount' ) && !$this->ezrparams->get( 'er_filterstate' ) && $this->ezrparams->get( 'er_filterloc' ) ) {
							echo $lists['cnid']."<hr class=\"hr-condensed\" />";
							echo $lists['locid']."<hr class=\"hr-condensed\" />";
						}
						if ( !$this->ezrparams->get( 'er_filtercount' ) && !$this->ezrparams->get( 'er_filterstate' ) && $this->ezrparams->get( 'er_filterloc' ) ) {
							echo $lists['locid']."<hr class=\"hr-condensed\" />";
						}
						if ( $this->ezrparams->get( 'er_filterstreet') == '1' ){ echo $lists['street']."<hr class=\"hr-condensed\" />"; }
						if ( $this->ezrparams->get( 'er_filterseller' ) == '1' ) { echo $lists['seller']."<hr class=\"hr-condensed\" />"; } 
						?>
		
					</div>
				<?php } ?>
		
			</div>
			<div id="j-main-container" class="span10">
		<?php else : ?>
			<div id="j-main-container">
		<?php endif;?>


		<?php if ( $this->ezrparams->get( 'er_filter_keyword' ) == '1' ) { ?>

			<div id="filter-bar" class="btn-toolbar">
	
				<div class="filter-search btn-group pull-left">
					<label for="filter_search" class="element-invisible"><?php echo JText::_('COM_EZREALTY_KEYWORD');?></label>
					<input type="text" name="search" id="search" placeholder="<?php echo JText::_('COM_EZREALTY_KEYWORD'); ?>" value="<?php echo htmlspecialchars($this->lists['search']);?>" class="text_area" onchange="document.adminForm.submit();" />
				</div>
				<div class="btn-group pull-left">
					<button class="btn hasTooltip" type="submit" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>" onclick="this.form.submit();"><i class="icon-search"></i></button>
	
					<button class="btn hasTooltip" type="button" title="<?php echo JText::_('EZREALTY_RESET_BTN'); ?>" onclick="document.getElementById('search').value='';
					this.form.getElementById('filter_published').value='';
					<?php if ( $this->ezrparams->get( 'er_filtercid' ) == '1' ){ ?>this.form.getElementById('filter_category').value='0';<?php } ?>
					<?php if ( $this->ezrparams->get( 'er_filtertype' ) == '1' ){ ?>this.form.getElementById('filter_type').value='0';<?php } ?>
					<?php if ( $this->ezrparams->get( 'er_usemarket' ) == '1' ){ ?>this.form.getElementById('filter_sold').value='0';<?php } ?>
					<?php if ( $this->ezrparams->get( 'er_filterstreet' ) == '1' ){ ?>this.form.getElementById('filter_street').value='';<?php } ?>
	
					<?php if ( $this->ezrparams->get( 'er_filtercount' ) && $this->ezrparams->get( 'er_filterstate' ) && $this->ezrparams->get( 'er_filterloc' ) ) { ?>
						this.form.getElementById('filter_locality').value='0';
						this.form.getElementById('filter_state').value='0';
						this.form.getElementById('filter_country').value='0';
					<?php }
					if ( !$this->ezrparams->get( 'er_filtercount' ) && $this->ezrparams->get( 'er_filterstate' ) && $this->ezrparams->get( 'er_filterloc' ) ) { ?>
						this.form.getElementById('filter_locality').value='0';
						this.form.getElementById('filter_state').value='0';
					<?php }
					if ( $this->ezrparams->get( 'er_filtercount' ) && !$this->ezrparams->get( 'er_filterstate' ) && $this->ezrparams->get( 'er_filterloc' ) ) { ?>
						this.form.getElementById('filter_locality').value='0';
						this.form.getElementById('filter_country').value='0';
					<?php }
					if ( !$this->ezrparams->get( 'er_filtercount' ) && !$this->ezrparams->get( 'er_filterstate' ) && $this->ezrparams->get( 'er_filterloc' ) ) { ?>
						this.form.getElementById('filter_locality').value='0';
					<?php } ?>
	
					<?php if ( $this->ezrparams->get( 'er_filterseller' ) == '1' ){ ?>this.form.getElementById('filter_seller').value='0';<?php } ?>
	
					this.form.submit();"><i class="icon-remove"></i></button>
	
				</div>
				<div class="btn-group pull-right hidden-phone">
					<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
					<?php echo $this->pagination->getLimitBox(); ?>
				</div>
			</div>
			<div class="clearfix"> </div>

		<?php } ?>

	<table class="table table-striped" id="articleList">
		<thead>
			<tr>
				<th width="1%" class="hidden-phone">
					<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
				</th>
				<th width="5%" class="nowrap center">
					<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?> / <?php echo JHTML::_( 'grid.sort', JText::_('JSTATUS') , 'a.featured', $listDirn, $listOrder); ?>
				</th>
				<?php if ( $this->ezrparams->get( 'er_piclist') ) { ?>
					<th width="7%" class="nowrap center">&nbsp;</th>
				<?php } ?>
				<th class="nowrap has-context">
         	       <?php echo JHTML::_( 'grid.sort', JText::_('EZREALTY_TABS_ADDRESS') , 'a.address2', $listDirn, $listOrder); ?>
         	   </th>
			<th width="8%" class="nowrap hidden-phone">
                <?php echo JText::_('EZREALTY_LISTINGS_PROPCAT');?>                        
            </th>
			<th width="6%" class="nowrap hidden-phone">
                <?php echo JHTML::_( 'grid.sort', JText::_('EZREALTY_LISTINGS_PROPPRICE') , 'a.price', $listDirn, $listOrder); ?>
            </th>
			<th width="4%" class="nowrap hidden-phone">
                <?php echo JHTML::_( 'grid.sort', JText::_('EZREALTY_LISTINGS_PROPHITS') , 'a.hits', $listDirn, $listOrder); ?>
            </th>

<?php if ( $this->ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){
	if ( $this->ezpparams->get( 'paid_listings' ) == 1 ){ ?>
			<th width="6%" class="nowrap hidden-phone">
                <?php echo JHTML::_( 'grid.sort', JText::_('EZREALTY_CAMPAIGN') , 'thecamtype', $listDirn, $listOrder); ?>
            </th>
	<?php }	?>
			<th width="6%" class="nowrap hidden-phone">
                <?php echo JHTML::_( 'grid.sort', JText::_('EZREALTY_PROFILE_NAME') , 'propseller', $listDirn, $listOrder); ?>
            </th>
<?php } else { ?>
			<th width="6%" class="nowrap hidden-phone">
                <?php echo JHTML::_( 'grid.sort', JText::_('EZREALTY_PROFILE_NAME') , 'propseller', $listDirn, $listOrder); ?>
            </th>
<?php } ?>
			<th width="3%" class="nowrap hidden-phone">
                <?php echo JHTML::_( 'grid.sort', JText::_('EZREALTY_LISTINGS_LISTINGDATE') , 'a.listdate', $listDirn, $listOrder); ?>
            </th>
			<th width="3%" class="nowrap hidden-phone">
                <?php echo JHTML::_( 'grid.sort', JText::_('EZREALTY_LISTINGS_UPDATE') , 'a.lastupdate', $listDirn, $listOrder); ?>
            </th>
<?php if ($this->ezrparams->get( 'er_expmgmt') ==1) { ?>
			<th width="3%" class="nowrap hidden-phone">
                <?php echo JHTML::_( 'grid.sort', JText::_('EZREALTY_LISTINGS_EXPDATE') , 'a.expdate', $listDirn, $listOrder); ?>
            </th>
<?php } ?>


				<th width="4%" class="nowrap hidden-phone">
					<?php echo JHTML::_( 'grid.sort', JText::_('EZREALTY_LANGUAGE') , 'a.language', $listDirn, $listOrder); ?>
				</th>
<?php if ( $this->ezrparams->get( 'er_usemlsid') ) { ?>
				<th width="1%" class="nowrap center hidden-phone">
            	    <?php echo JHTML::_( 'grid.sort', JText::_('EZREALTY_DETAILS_MLSID') , 'a.mls_id', $listDirn, $listOrder); ?>
        	    </th>
<?php } ?>

				<th width="1%" class="nowrap center hidden-phone">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="14">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>


		<?php
			$k = 0;
			for ($i=0, $n=count( $items ); $i < $n; $i++) {
				$row = &$items[$i];

				$link 	= 'index.php?option=com_ezrealty&controller=ezrealty&task=edit&hidemainmenu=1&cid='. $row->id;
				$link3  = JURI::root().'index.php?option=com_ezrealty&view=ezrealty&cid='. $row->cid .'&id='. $row->id .'&format=pdf';
				$link4 	= 'index.php?option=com_ezrealty&controller=ezrealty&task=camform&tmpl=component&cam='. $row->camtype .'&id='. $row->id;


				$task	=	$row->published ? 'unpublish' : 'publish';
				$img	=	$row->published ? 'publish_g.png' : 'publish_x.png';
				$alt 	=	$row->published ? JText::_('EZREALTY_PUBLISH_UNPUBLISH') : JText::_('EZREALTY_UNPUBLISH_PUBLISH');

				if ($row->featured == 1){
					$featalt 	=	JText::_('EZREALTY_FEATURED_SPOTLIGHT');
					$linklevel 	= 'index.php?option=com_ezrealty&controller=ezrealty&task=dospotlight&cid='. $row->id;
				} elseif ($row->featured == 2){
					$featalt 	=	JText::_('EZREALTY_SPOTLIGHT_STANDARD');
					$linklevel 	= 'index.php?option=com_ezrealty&controller=ezrealty&task=dostandard&cid='. $row->id;
				} else {
					$featalt 	=	JText::_('EZREALTY_STANDARD_FEATURED');
					$linklevel 	= 'index.php?option=com_ezrealty&controller=ezrealty&task=dofeatured&cid='. $row->id;
				}


				$theimage = EZRealtyHelper::getTheImage($row->id);   

				if($this->checktest){
		
					// getting the category
					$pcategory="";
		
					$database->setQuery("select * from #__ezrealty_catg as c INNER JOIN #__ezrealty_incats as ic on ic.category_id=c.id where ic.property_id='$row->id'");
					$categories=$database->loadObjectList();
					foreach($categories as $category)
						{
						$pcategory.=$category->name.'<br />';
						}
		
				} else {
		
					$pcategory="";	
		
				}

    		    ?>

			<tr class="<?php echo "row$k"; ?>">
				<td class="center hidden-phone">
         		   <?php echo JHTML::_('grid.id', $i, $row->id ); ?>
				</td>
				<td class="center">
					<span class="hasTooltip" title="<?php echo $alt;?>"><?php echo JHtml::_('jgrid.published', $row->published, $i, '', true);?></span> 
					<a href="<?php echo $linklevel;?>" title=""><span class="btn btn-micro active hasTooltip" title="<?php echo $featalt;?>"><img src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/featured<?php echo $row->featured;?>.png" alt="<?php echo $featalt;?>" /></span></a>
				</td>
				<?php if ( $this->ezrparams->get( 'er_piclist') ) { ?>
					<td>

						<?php if (isset($theimage)) { ?>
							<?php echo EZRealtyHelper::getThePath($row->id);?>
						<?php } else { ?>
							<img src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/nothumb.png" class="thumbnail" style="height:70px; width:90px;" alt="<?php echo JText::_('COM_EZREALTY_EDIT'); ?>" />
						<?php } ?>
					</td>
				<?php } ?>

				<td align="left">

					<?php if ($this->ezrparams->get( 'er_expmgmt') == 1 && $row->expdate <= mktime(0, 0, 0, date("m"), date("d"), date("Y"))) { ?>
						<strong>***<?php echo JText::_('EZREALTY_LISTINGS_EXPIRED'); ?>***</strong><br />
					<?php } ?>

					<?php

					if ($this->ezrparams->get( 'er_usepc' )){ $pcode = $row->postcode; } else { $pcode = ''; }
					if ($this->ezrparams->get( 'er_stateloc' )){ $thesub = $row->proploc; } else { $thesub = ''; }

					if ( $row->checked_out && ( $row->checked_out != $user->id ) ) {
						echo stripslashes($row->unit_num.' '.$row->street_num.' '.$row->address2.' '.$thesub.' '.$pcode );
					} else {
						?>
						<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_EZREALTY_EDIT');?>">
							<?php echo stripslashes($row->unit_num.' '.$row->street_num.' '.$row->address2.' '.$thesub.' '.$pcode);?>
						</a>
						<?php
					}
					?>

					<?php if ($this->ezrparams->get( 'er_usemarket' )) { ?>
						<br />
						<span class="small">(
						<?php if ( $row->sold==1 ){ echo JText::_('EZREALTY_DETAILS_MARKET1'); }
						if ( $row->sold==2 ){ echo JText::_('EZREALTY_DETAILS_MARKET2'); }
						if ( $row->sold==3 ){ echo JText::_('EZREALTY_DETAILS_MARKET3'); }
						if ( $row->sold==4 ){ echo JText::_('EZREALTY_DETAILS_MARKET4'); }
						if ( $row->sold==5 ){ echo JText::_('EZREALTY_DETAILS_MARKET5'); }
						if ( $row->sold==6 ){ echo JText::_('EZREALTY_DETAILS_MARKET6'); }
						if ( $row->sold==7 ){ echo JText::_('EZREALTY_DETAILS_MARKET7'); }
						if ( $row->sold==8 ){ echo JText::_('EZREALTY_DETAILS_MARKET8'); }
						if ( $row->sold==9 ){ echo JText::_('EZREALTY_DETAILS_MARKET9'); }
						if ( $row->sold==10 ){ echo JText::_('EZREALTY_DETAILS_MARKET10'); } ?>
						)</span>
					<?php } ?>
					<?php if ($row->published == 1){ ?>
						<br />
						<a target="_blank" href="<?php echo $link3;?>" title="<?php echo JText::_('EZREALTY_VIEWDET_PRINT');?>">
							<img src="<?php echo JURI::root(); ?>components/com_ezrealty/assets/images/print_22.png" border="0" width="25" alt="<?php echo JText::_('EZREALTY_VIEWDET_PRINT'); ?>" />
						</a>
					<?php } ?>

				</td>

				<td class="small hidden-phone"><?php echo ($pcategory); ?></td>
				<td class="small hidden-phone">

					<?php echo EZRealtyFHelper::formatDisplayPrice ($row->showprice, $row->price, $row->currency_format, $row->currency, $row->currency_position, $row->priceview, $row->freq); ?>

				</td>
				<td class="small hidden-phone"><?php echo $row->hits; ?><br /><a href = "javascript:if (confirm('<?php echo JText::_('EZREALTY_RESET_BTN');?>')){ location.href='index.php?option=com_ezrealty&amp;controller=ezrealty&amp;task=resethits&amp;cid=<?php echo $row->id?>';}" title="<?php echo JText::_('EZREALTY_RESET_BTN');?>"><span class="badge badge-warning hasTooltip" title="<?php echo JText::_('EZREALTY_RESET_BTN');?>"><strong><?php echo JText::_('EZREALTY_RESET_BTN');?></strong></span></a></td>

				<?php if ( $this->ezrparams->get( 'use_ezportal' ) == 1 && file_exists(JPATH_SITE . '/administrator/components/com_ezportal/ezportal.php')){
					if ( $this->ezpparams->get( 'paid_listings' ) == 1 ){ ?>
						<td class="small hidden-phone">

							<?php echo $row->thecamtype; ?><br />

							<a class="modal" href="<?php echo $link4;?>" rel="{handler:'iframe',size:{x:400,y:300}}" title="<?php echo JText::_('COM_EZREALTY_CHANGE_CAMPAIGN');?>">
								<span class="badge badge-success hasTooltip" title="<?php echo JText::_('COM_EZREALTY_CHANGE_CAMPAIGN');?>"><strong><?php echo JText::_('COM_EZREALTY_CHANGE_CAMPAIGN');?></strong></span>
							</a>

						</td>
					<?php } ?>
				<?php } ?>

				<td class="small hidden-phone">

					<?php if ( $row->owner > 0 ) {
						echo ($row->propseller);
					} else if ( $row->owner == 0 && $row->agentInfo ) {
						echo JText::_('COM_EZREALTY_EXTERNAL_AGENT');
					} else { } ?>

				</td>

				<td class="small hidden-phone"><?php echo ($row->listdate); ?></td>
				<td class="small hidden-phone"><?php echo strftime("%c",$row->lastupdate); ?></td>

				<?php if ($this->ezrparams->get( 'er_expmgmt' ) ==1) { ?>
					<td class="small hidden-phone">
						<?php if ($row->expdate) { ?>
							<?php echo strftime("%c",$row->expdate); ?><br />
							<?php if ($row->expdate <= mktime(0, 0, 0, date("m"), date("d"), date("Y"))) { ?><a href = "javascript:if (confirm('<?php echo JText::_('EZREALTY_RESET_BTN'); ?>')){ location.href='index.php?option=com_ezrealty&amp;controller=ezrealty&amp;task=resetdate&amp;cid=<?php echo $row->id?>';}" title="<?php echo JText::_('EZREALTY_RESET_BTN');?>"><span class="badge badge-important hasTooltip" title="<?php echo JText::_('EZREALTY_RESET_BTN'); ?>"><strong><?php echo JText::_('EZREALTY_RESET_BTN');?></strong></span></a><?php } ?>
						<?php } else { ?>
							<a href = "javascript:if (confirm('<?php echo JText::_('EZREALTY_RESET_BTN'); ?>')){ location.href='index.php?option=com_ezrealty&amp;controller=ezrealty&amp;task=resetdate&amp;cid=<?php echo $row->id?>';}" title="<?php echo JText::_('EZREALTY_RESET_BTN');?>"><span class="badge badge-important hasTooltip" title="<?php echo JText::_('EZREALTY_RESET_BTN'); ?>"><strong><?php echo JText::_('EZREALTY_RESET_BTN');?></strong></span></a>
						<?php } ?>
					</td>
				<?php } ?>

				<td class="small hidden-phone"><?php if ($row->language == "*"){ echo JText::_('EZREALTY_LANGUAGE_ALL'); } else { echo $row->language; } ?></td>
				<?php if ( $this->ezrparams->get( 'er_usemlsid') ) { ?>
					<td class="small hidden-phone"><?php echo ($row->mls_id); ?></td>
				<?php } ?>
				<td class="small hidden-phone">
					<?php echo $row->id; ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</tbody>
	</table>


<?php } ?>

	
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="option" value="com_ezrealty" />
    <input type="hidden" name="controller" value="ezrealty" /> 
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="hidemainmenu" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />

	</div>
</form>



<?php
    echo EZRealtyHelper::showFooter();
?>
<br />
