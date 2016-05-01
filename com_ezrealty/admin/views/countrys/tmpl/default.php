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
    
$items = $this->items;
$user 	=& JFactory::getUser();

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('dropdown.init');
JHtml::_('formbehavior.chosen', 'select');

$listOrder	= $this->lists['order'];
$listDirn	= $this->lists['order_Dir'];

?>

<?php if ( !$this->ezrparams->get( 'user_id' )  ){ ?>

	<div align="center"><br /><br /><span style="font-size: 28px; color: #ff0000; font-weight: bold;"><?php echo JText::_( 'EZREALTY_CONFIG_WARNING' ); ?></span><br /><br /></div>

<?php } ?>

<form action="<?php echo JRoute::_('index.php?option=com_ezrealty'); ?>" method="post" name="adminForm" id="adminForm">

<?php if(!empty( $this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>

	<div id="filter-bar" class="btn-toolbar">
		<div class="filter-search btn-group pull-left">
			<label for="filter_search" class="element-invisible"><?php echo JText::_('COM_EZREALTY_KEYWORD');?></label>
			<input type="text" name="search" id="search" placeholder="<?php echo JText::_('COM_EZREALTY_KEYWORD'); ?>" value="<?php echo htmlspecialchars($this->lists['search']);?>" class="text_area" onchange="document.adminForm.submit();" />
		</div>
		<div class="btn-group pull-left">
			<button class="btn hasTooltip" type="submit" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>" onclick="this.form.submit();"><i class="icon-search"></i></button>
			<button class="btn hasTooltip" type="button" title="<?php echo JText::_('EZREALTY_RESET_BTN'); ?>" onclick="document.getElementById('search').value='';this.form.submit();"><i class="icon-remove"></i></button>
		</div>

		<div class="btn-group pull-right hidden-phone">
			<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
	</div>
	<div class="clearfix"> </div>

	<table class="table table-striped" id="articleList">
		<thead>
			<tr>
				<th width="1%" class="hidden-phone">
					<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
				</th>
				<th width="5%" class="nowrap center">
					<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
				</th>
				<th class="title" align="left">
					<?php echo JHTML::_( 'grid.sort', JText::_('COM_EZREALTY_TITLE') , 'a.name', $listDirn, $listOrder); ?>
				</th>
				<th width="12%" class="nowrap hidden-phone">
					<?php echo JHTML::_( 'grid.sort', JText::_('EZREALTY_DETAILS_DECLAT') , 'a.declat', $listDirn, $listOrder); ?>
				</th>
				<th width="12%" class="nowrap hidden-phone">
					<?php echo JHTML::_( 'grid.sort', JText::_('EZREALTY_DETAILS_DECLONG') , 'a.declong', $listDirn, $listOrder); ?>
				</th>
				<th width="13%" class="nowrap center hidden-phone">
					<span style="position: absolute; "><?php echo JHTML::_( 'grid.sort', JText::_('COM_EZREALTY_ORDERING'), 'a.ordering', $listDirn, $listOrder); ?></span>
					<?php echo JHTML::_('grid.order',  $items ); ?>            
				</th>
				<th width="10%" class="nowrap hidden-phone">
					<?php echo JHTML::_( 'grid.sort', JText::_('EZREALTY_LANGUAGE') , 'a.language', $listDirn, $listOrder); ?>
				</th>
				<th width="1%" class="nowrap center hidden-phone">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="8">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>

			<?php
		$k = 0; $ordering = true; 
		for ($i=0, $n=count( $this->items ); $i < $n; $i++) {
			$row = &$this->items[$i];
			$task	=	$row->published ? 'unpublish' : 'publish';
			$img	=	$row->published ? 'publish_g.png' : 'publish_x.png';
			$alt 	=	$row->published ? JText::_('COM_EZREALTY_PUBLISH') : JText::_('COM_EZREALTY_UNPUBLISH');

			$row->id 	= $row->id;
			$link 		= 'index.php?option=com_ezrealty&controller=countrys&task=edit&hidemainmenu=1&cid='. $row->id;

			//$checked 	= mosCommonHTML::CheckedOutProcessing( $row, $i );

			?>
		<tr class="<?php echo "row$k"; ?>">
				<td class="center hidden-phone">
         		   <?php echo JHTML::_('grid.id', $i, $row->id ); ?>
				</td>
				<td class="center">
					<?php echo JHtml::_('jgrid.published', $row->published, $i, '', true);?>
				</td>
				<td class="nowrap has-context">
				<?php
				if ( $row->checked_out && ( $row->checked_out != $user->id ) ) {
					echo stripslashes($row->name);
				} else {
					?>
					<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_EZREALTY_EDIT');?>">
					<?php echo stripslashes($row->name); ?>
					</a>
					<?php
				}
				?>
					 <span class="small">(<?php echo JText::_('COM_EZREALTY_ALIAS');?>: <?php echo stripslashes($row->alias); ?>)</span>
			</td>

				<td class="small hidden-phone">
					<?php echo stripslashes($row->declat); ?>
				</td>
				<td class="small hidden-phone">
					<?php echo stripslashes($row->declong); ?>
				</td>


				<td class="small hidden-phone">
					<span><?php echo $this->pagination->orderUpIcon( $i, true, 'orderup', JText::_('COM_EZREALTY_UP'), $ordering); ?></span>
					<span><?php echo $this->pagination->orderDownIcon( $i, $n, true, 'orderdown', JText::_('COM_EZREALTY_DOWN'), $ordering ); ?></span>
					<?php $disabled = $ordering ?  '' : 'disabled="disabled"'; ?>
					<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" <?php echo $disabled; ?> class="input-mini" style="text-align: center" />
				</td>
				<td class="small hidden-phone"><?php if ($row->language == "*"){ echo JText::_('EZREALTY_LANGUAGE_ALL'); } else { echo $row->language; } ?></td>
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
		
		<input type="hidden" name="option" value="com_ezrealty" />
        <input type="hidden" name="controller" value="countrys" />        
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />

	</div>
</form>
<?php
    echo EZRealtyHelper::showFooter();
?>