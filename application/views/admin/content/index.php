<div class="cluster">
	<div class="container-fluid">
		<div class="tool-bar clearfix">
			<h1 class="page-title">
				<?=$category->name?>
				<div class="pull-right">
					<ul class="action-icon-list">
						<li><a href="#" class="btn-unpublish"><i class="fa fa-eye-slash" aria-hidden="true"></i> Hide</a></li>
						<li><a href="#" class="btn-publish"><i class="fa fa-eye" aria-hidden="true"></i> Show</a></li>
						<li><a href="#" class="btn-delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
						<li><a href="<?=site_url("syslog/content/{$category->id}/add")?>"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></li>
					</ul>
				</div>
			</h1>
		</div>
		<? if (empty($items) || !sizeof($items)) { ?>
		<p class="help-block">No item found.</p>
		<? } else { ?>
		<form id="frm-admin" name="adminForm" action="" method="POST">
			<input type="hidden" id="task" name="task" value="">
			<input type="hidden" id="boxchecked" name="boxchecked" value="0" />
			<table class="table table-bordered table-hover">
				<tr>
					<th class="text-center" width="30px">#</th>
					<th class="text-center" width="30px">
						<input type="checkbox" id="toggle" name="toggle" onclick="checkAll('<?=sizeof($items)?>');" />
					</th>
					<th>Title</th>
					<th class="hidden" width="180px">Updated</th>
				</tr>
				<?
					$i = 0;
					foreach ($items as $item) {
						$histories = $this->m_history->search($this->m_content->_table, $item->id, NULL, 5);
						$history_detail = "<table class='table-tooltip'>";
						foreach ($histories as $history) {
							$history_detail .= "<tr><td><small>".$history->user_name."</small></td><td class='text-right'><small><i>".date("Y/m/d H:i:s", strtotime($history->created_date))."</i></small></td></tr>";
						}
						$history_detail .= "</table>";
				?>
				<tr class="row<?=$item->active?>">
					<td class="text-center"><?=($i+1)?></td>
					<td class="text-center">
						<input type="checkbox" id="cb<?=$i?>" name="cid[]" value="<?=$item->id?>" onclick="isChecked(this.checked);">
					</td>
					<td>
						<a href="<?=site_url("syslog/content/{$category->id}/edit/{$item->id}")?>"><?=$item->title?></a>
						<ul class="action-icon-list">
							<li><?=number_format($item->view_num)?> Views</li>
							<li><a href="<?=site_url("syslog/content/{$category->id}/edit/{$item->id}")?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
							<li><a href="#" onclick="return confirmBox('Delete items', 'Are you sure you want to delete the selected items?', 'itemTask', ['cb<?=$i?>', 'delete']);"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
							<? if ($item->active) { ?>
							<li><a href="#" onclick="return itemTask('cb<?=$i?>','unpublish');"><i class="fa fa-eye-slash" aria-hidden="true"></i> Hide</a></li>
							<? } else { ?>
							<li><a href="#" onclick="return itemTask('cb<?=$i?>','publish');"><i class="fa fa-eye" aria-hidden="true"></i> Show</a></li>
							<? } ?>
							<li><a href="#" onclick="return itemTask('cb<?=$i?>','orderup');"><i class="fa fa-level-up" aria-hidden="true"></i> Up</a></li>
							<li><a href="#" onclick="return itemTask('cb<?=$i?>','orderdown');"><i class="fa fa-level-down" aria-hidden="true"></i> Down</a></li>
							<? if (!empty($histories) && $this->session->userdata("admin")->user_type == USR_SUPPER_ADMIN) { ?>
							<li><a href="#" data-container="body" data-toggle="tooltip" data-placement="right" data-html="true" title="<?=$history_detail?>"><i class="fa fa-edit" aria-hidden="true"></i> Log</a></li>
							<? } ?>
						</ul>
					</td>
					<td class="hidden">
						<?
						/*
							$updated_by = $this->m_user->load($item->updated_by);
							if (!empty($updated_by)) {
						?>
						<strong><?=$updated_by->fullname?></strong>
						<div class="action-icon-list"><span class="text-color-grey"><?=date($this->config->item("log_date_format"), strtotime($item->updated_date))?></span></div>
						<?
							}
						*/
						?>
					</td>
				</tr>
				<?
						$i++;
					}
				?>
			</table>
		</form>
		<? } ?>
	</div>
</div>

<script>
$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
	$(".btn-publish").click(function(e){
		e.preventDefault();
		if ($("#boxchecked").val() == 0) {
			messageBox("ERROR", "Error", "Please make a selection from the list to publish.");
		}
		else {
			submitButton("publish");
		}
	});
	$(".btn-unpublish").click(function(e){
		e.preventDefault();
		if ($("#boxchecked").val() == 0) {
			messageBox("ERROR", "Error", "Please make a selection from the list to unpublish.");
		}
		else {
			submitButton("unpublish");
		}
	});
	$(".btn-delete").click(function(e){
		e.preventDefault();
		if ($("#boxchecked").val() == 0) {
			messageBox("ERROR", "Error", "Please make a selection from the list to delete.");
		}
		else {
			confirmBox("Delete items", "Are you sure you want to delete the selected items?", "submitButton", "delete");
		}
	});
});
</script>