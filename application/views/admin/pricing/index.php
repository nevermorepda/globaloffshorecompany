<div class="cluster">
	<div class="container-fluid">
		<div class="tool-bar clearfix">
			<h1 class="page-title">
				Services fee
			</h1>
		</div>
		<? if (empty($items) || !sizeof($items)) { ?>
		<p class="help-block">No item found.</p>
		<? } else { ?>
		<?
			$regions = array();
			foreach ($items as $item) {
				if (!in_array($item->region, $regions)) {
					$regions[] = $item->region;
				}
			}
			sort($regions);
		?>
		<form id="frm-admin" name="adminForm" action="" method="POST">
			<input type="hidden" id="task" name="task" value="">
			<input type="hidden" id="boxchecked" name="boxchecked" value="0" />
			<ul class="nav nav-tabs" role="tablist">
				<? $i=0; foreach ($regions as $region) { ?>
				<li role="presentation" class="<?=($i==0) ? 'active' : ''?>"><a href="#<?=$region?>" aria-controls="<?=$region?>" role="tab" data-toggle="tab"><?=ucwords(str_replace('-',' ', $region))?></a></li>
				<? $i++; } ?>
			</ul>
			<div class="tab-content">
				<? for ($r=0; $r<sizeof($regions); $r++) { ?>
				<div role="tabpanel" class="tab-pane <?=(!$r?"active":"")?>" id="<?=$this->util->slug($regions[$r])?>">
					<table class="table table-bordered table-hover">
						<tr>
							<th class="text-center" width="30px">#</th>
							<th class="text-center" width="30px">
								<input type="checkbox" id="toggle" name="toggle" onclick="checkAll('<?=sizeof($items)?>');" />
							</th>
							<th>Name</th>
							<th class="" width="180px">Updated</th>
						</tr>
						<?
							$i = 0;
							foreach ($items as $item) {
								if ($item->region != $regions[$r]) {
									continue;
								}
								$check = $this->m_jurisdiction_services->item($item->jurisdiction_id, $service_id);
								if (!empty($check)) {
						?>
						<tr class="row<?=$item->active?>">
							<td class="text-center"><?=($i+1)?></td>
							<td class="text-center">
								<input type="checkbox" id="cb<?=$i?>" name="cid[]" value="<?=$item->jurisdiction_id?>" onclick="isChecked(this.checked);">
							</td>
							<td>
								<a href="<?=site_url("syslog/pricing/{$service_id}/{$item->jurisdiction_id}/edit")?>"><?=$item->name?></a>
							</td>
							<td class="">
								<?
								
									$updated_by = $this->m_user->load($item->updated_by);
									if (!empty($updated_by)) {
								?>
								<strong><?=$updated_by->user_fullname?></strong>
								<div class="action-icon-list"><span class="text-color-grey"><?=date($this->config->item("log_date_format"), strtotime($item->updated_date))?></span></div>
								<?
									}
								
								?>
							</td>
						</tr>
						<?
								$i++; }
							}
						?>
					</table>
				</div>
				<? } ?>
			</div>
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