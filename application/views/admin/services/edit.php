<div class="cluster">
	<div class="container-fluid">
		<h1 class="page-title"><?=!empty($item->name) ? $item->name : 'Add'?></h1>
		<? if (empty($item) || !sizeof($item)) { ?>
		<p class="help-block">Item not found.</p>
		<? } else { ?>
		<form id="frm-admin" name="adminForm" action="" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="task" name="task" value="">
			<table class="table table-bordered">
				<tr>
					<td class="table-head text-right" width="10%">Name</td>
					<td><input type="text" id="name" name="name" class="form-control" value="<?=$item->name?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">URL alias</td>
					<td><input type="text" id="alias" name="alias" class="form-control" value="<?=$item->alias?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Description</td>
					<td>
						<textarea name="description" id="description" class="form-control" rows="3"><?=$item->description?></textarea>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Tab</td>
					<td>
						<div class="tool-bar clearfix">
							<h1 class="page-title">
								<div class="pull-right">
									<ul class="action-icon-list">
										<li><a href="<?=site_url("syslog/services-tabs/{$item->id}/add")?>"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></li>
									</ul>
								</div>
							</h1>
						</div>
						<table class="table table-bordered table-hover">
							<tbody>
							<tr>
								<th class="text-center" width="30px">#</th>
								<th>Tab name</th>
								<th class="" width="180px">Updated</th>
							</tr>
							<? $i=0; foreach ($tabs as $tab) { ?>
							<tr class="row1">
								<td class="text-center"><?=$i+1?></td>
								<td>
									<a href="<?=site_url("syslog/services-tabs/{$item->id}/edit/{$tab->id}")?>"><?=$tab->name?></a>
									<ul class="action-icon-list">
										<li><a href="<?=site_url("syslog/services-tabs/{$item->id}/edit/{$tab->id}")?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tabs" item-id="<?=$tab->id?>" task="del"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tabs" item-id="<?=$tab->id?>" task="<?=!empty($tab->active) ? 'hide' : 'show'?>"><i class="fa fa-eye-slash" aria-hidden="true"></i> <?=!empty($tab->active) ? 'Hide' : 'Show'?></a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tabs" item-id="<?=$tab->id?>" task="up"><i class="fa fa-level-up" aria-hidden="true"></i> Up</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tabs" item-id="<?=$tab->id?>" task="down"><i class="fa fa-level-down" aria-hidden="true"></i> Down</a></li>
									</ul>
								</td>
								<td class="">
									<?
										$updated_by = $this->m_user->load($tab->updated_by);
										if (!empty($updated_by)) {
									?>
									<strong><?=$updated_by->user_fullname?></strong>
									<div class="action-icon-list"><span class="text-color-grey"><?=date($this->config->item("log_date_format"), strtotime($tab->updated_date))?></span></div>
									<?
										}
									?>
								</td>
							</tr>
							<? $i++; } ?>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">SEO</td>
					<td>
						<div class="seo-panel">
							<p class="title"><input type="text" id="meta_title" name="meta_title" class="form-control seo-control" maxlength="70" value="<?=$item->meta_title?>" placeholder="Title..."></p>
							<p class="url"><?=BASE_URL?>/.../<?=$item->alias?>.html</p>
							<p class="keywords"><input type="text" id="meta_key" name="meta_key" class="form-control seo-control" maxlength="255" value="<?=$item->meta_key?>" placeholder="Keywords..."></p>
							<p class="description"><input type="text" id="meta_desc" name="meta_desc" class="form-control seo-control" maxlength="160" value="<?=$item->meta_desc?>" placeholder="Description..."></p>
						</div>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right"></td>
					<td>
						<select id="active" name="active" class="form-control">
							<option value="1">Show</option>
							<option value="0">Hide</option>
						</select>
						<script type="text/javascript">
							$("#active").val("<?=$item->active?>");
						</script>
					</td>
				</tr>
			</table>
			<div>
				<a class="btn btn-sm btn-primary btn-save">Save</a>
				<a class="btn btn-sm btn-default btn-cancel">Cancel</a>
			</div>
		</form>
		<? } ?>
	</div>
</div>
<? require_once(APPPATH."views/module/admin/upload_ckfinder.php"); ?>
<script>
$(document).ready(function() {

	$("#file-upload").change(function() {
		readURL(this);
	});
	
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('.wrap-upload-thumb').css({
					"background-image": "url('"+e.target.result+"')"
				});
				$('.wrap-upload-thumb > i').css({
					"color": "rgba(52, 73, 94, 0.38)"
				});
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	$(".btn-save").click(function(){
		submitButton("save");
	});
	$(".btn-cancel").click(function(){
		submitButton("cancel");
	});
});
</script>