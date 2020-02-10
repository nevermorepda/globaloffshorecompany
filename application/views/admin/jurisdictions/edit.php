<div class="cluster">
	<div class="container-fluid">
		<h1 class="page-title">
			<?=!empty($item->id) ? 'Edit' : 'Add'; ?>
		</h1>
		<? if (empty($item)) { ?>
		<p class="help-block">Item not found.</p>
		<? } else { ?>
		<form id="frm-admin" name="adminForm" action="" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="task" name="task" value="">
			<table class="table table-bordered">
				<tr>
					<td class="table-head text-right" width="10%">Nation</td>
					<td>
						<select name="nation_id" id="nation_id" class="form-control">
							<? foreach ($nations as $nation) { ?>
							<option value="<?=$nation->id?>"><?=$nation->name?></option>
							<? } ?>
						</select>
						<script type="text/javascript">
							$('#nation_id').val('<?=$item->nation_id?>');
						</script>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Thumbnail</td>
					<td>
						<label class="wrap-upload-thumb" style="background: url('<?=BASE_URL?><?=!empty($item->thumbnail) ? $item->thumbnail : ''?>') no-repeat">
							<input type="file" name="thumbnail" id="file-upload" value="<?=!empty($item->name) ? $item->name : ''?>">
							<i class="fa fa-cloud-upload" aria-hidden="true"></i>
						</label>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Description</td>
					<td>
						<textarea name="description" id="description" class="form-control" rows="3" required="required"><?=!empty($item->description) ? $item->description : ''?></textarea>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Tab</td>
					<td>
						<div class="tool-bar clearfix">
							<? if (!empty($item->id)) { ?>
							<div class="pull-right">
								<ul class="action-icon-list">
									<li><a href="<?=site_url("syslog/jurisdiction-details/{$item->id}/add")?>"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></li>
								</ul>
							</div>
							<? } ?>
						</div>
						<table class="table table-bordered table-hover">
							<tbody>
							<tr>
								<th class="text-center" width="30px">#</th>
								<th>Tab name</th>
								<th class="" width="180px">Updated</th>
							</tr>
							<?
							if (!empty($details)) {
							$i=0; foreach ($details as $detail) { ?>
							<tr class="row1">
								<td class="text-center"><?=$i+1?></td>
								<td>
									<a href="<?=site_url("syslog/jurisdiction-details/{$item->id}/edit/{$detail->id}")?>"><?=$detail->name?></a>
									<ul class="action-icon-list detail">
										<li><a href="<?=site_url("syslog/jurisdiction-details/{$item->id}/edit/{$detail->id}")?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdiction_details" item-id="<?=$detail->id?>" task="del"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdiction_details" item-id="<?=$detail->id?>" task="<?=!empty($detail->active) ? 'hide' : 'show'?>"><i class="fa fa-eye-slash" aria-hidden="true"></i> <?=!empty($detail->active) ? 'Hide' : 'Show'?></a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdiction_details" item-id="<?=$detail->id?>" task="<?=!empty($detail->open) ? 'close' : 'open'?>"><i class="fa fa-eye-slash" aria-hidden="true"></i> <?=!empty($detail->open) ? 'Close' : 'Open'?></a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdiction_details" item-id="<?=$detail->id?>" task="up"><i class="fa fa-level-up" aria-hidden="true"></i> Up</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdiction_details" item-id="<?=$detail->id?>" task="down"><i class="fa fa-level-down" aria-hidden="true"></i> Down</a></li>
									</ul>
								</td>
								<td class="">
									<?
										$updated_by = $this->m_user->load($detail->updated_by);
										if (!empty($updated_by)) {
									?>
									<strong><?=$updated_by->user_fullname?></strong>
									<div class="action-icon-list"><span class="text-color-grey"><?=date($this->config->item("log_date_format"), strtotime($detail->updated_date))?></span></div>
									<?
										}
									
									?>
								</td>
							</tr>
							<? $i++; } }?>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Services</td>
					<td>
						<div class="row">
							<?
							$services = $this->m_services->items(null,1);
							foreach ($services as $service) {
								$checked = $this->m_jurisdiction_services->item($id, $service->id);
							?>
							<div class="col-sm-3">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="services[]" value="<?=$service->id?>" <?=!empty($checked) ? 'checked' : '' ?>>
										<?=$service->name?>
									</label>
								</div>
							</div>
							<? } ?>
						</div>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Faqs</td>
					<td>
						<div class="tool-bar clearfix">
							<? if (!empty($item->id)) { ?>
							<div class="pull-right">
								<ul class="action-icon-list">
									<li><a href="<?=site_url("syslog/jurisdictions-faqs/{$item->id}/add")?>"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></li>
								</ul>
							</div>
							<? } ?>
						</div>
						<table class="table table-bordered table-hover">
							<tbody>
							<tr>
								<th class="text-center" width="30px">#</th>
								<th>File</th>
								<th class="" width="180px">Updated</th>
							</tr>
							<?
							if (!empty($faqs)) {
							$i=0; foreach ($faqs as $faq) { ?>
							<tr class="row1">
								<td class="text-center"><?=$i+1?></td>
								<td>
									<a href="<?=site_url("syslog/jurisdictions-faqs/{$item->id}/edit/{$faq->id}")?>"><?=$faq->question?></a>
									<ul class="action-icon-list faq">
										<li><a href="<?=site_url("syslog/jurisdictions-faqs/{$item->id}/edit/{$faq->id}")?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdictions_faqs" item-id="<?=$faq->id?>" task="del"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdictions_faqs" item-id="<?=$faq->id?>" task="<?=!empty($faq->active) ? 'hide' : 'show'?>"><i class="fa fa-eye-slash" aria-hidden="true"></i> <?=!empty($faq->active) ? 'Hide' : 'Show'?></a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdictions_faqs" item-id="<?=$faq->id?>" task="up"><i class="fa fa-level-up" aria-hidden="true"></i> Up</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdictions_faqs" item-id="<?=$faq->id?>" task="down"><i class="fa fa-level-down" aria-hidden="true"></i> Down</a></li>
									</ul>
								</td>
								<td class="">
									<?
										$updated_by = $this->m_user->load($faq->updated_by);
										if (!empty($updated_by)) {
									?>
									<strong><?=$updated_by->user_fullname?></strong>
									<div class="action-icon-list"><span class="text-color-grey"><?=date($this->config->item("log_date_format"), strtotime($faq->updated_date))?></span></div>
									<?
										}
									
									?>
								</td>
							</tr>
							<? $i++; } }?>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">News</td>
					<td>
						<div class="tool-bar clearfix">
							<? if (!empty($item->id)) { ?>
							<div class="pull-right">
								<ul class="action-icon-list">
									<li><a class="get-resources" module="new" style="cursor: pointer;" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></li>
								</ul>
							</div>
							<? } ?>
						</div>
						<table class="table table-bordered table-hover">
							<tbody>
							<tr>
								<th class="text-center" width="30px">#</th>
								<th>File</th>
								<th class="" width="180px">Updated</th>
							</tr>
							<?
							$info = new stdClass();
							$info->module = 'new';
							$info->jurisdiction_id = !empty($item->id) ? $item->id : 0;
							$jurisdictions_modules = $this->m_jurisdictions_resources->items($info);
							if (!empty($jurisdictions_modules)) {
							$i=0; foreach ($jurisdictions_modules as $jurisdictions_module) { $content_item = $this->m_content->load($jurisdictions_module->content_id)?>
							<tr class="row1">
								<td class="text-center"><?=$i+1?></td>
								<td>
									<a><?=$content_item->title?></a>
									<ul class="action-icon-list faq">
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdictions_resources" item-id="<?=$jurisdictions_module->id?>" task="del"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdictions_resources" item-id="<?=$jurisdictions_module->id?>" task="<?=!empty($jurisdictions_module->active) ? 'hide' : 'show'?>"><i class="fa fa-eye-slash" aria-hidden="true"></i> <?=!empty($jurisdictions_module->active) ? 'Hide' : 'Show'?></a></li>
									</ul>
								</td>
								<td class="">
									<?
										$updated_by = $this->m_user->load($jurisdictions_module->updated_by);
										if (!empty($updated_by)) {
									?>
									<strong><?=$updated_by->user_fullname?></strong>
									<div class="action-icon-list"><span class="text-color-grey"><?=date($this->config->item("log_date_format"), strtotime($jurisdictions_module->updated_date))?></span></div>
									<?
										}
									
									?>
								</td>
							</tr>
							<? $i++; } }?>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Blogs</td>
					<td>
						<div class="tool-bar clearfix">
							<? if (!empty($item->id)) { ?>
							<div class="pull-right">
								<ul class="action-icon-list">
									<li><a class="get-resources" module="blog" style="cursor: pointer;" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></li>
								</ul>
							</div>
							<? } ?>
						</div>
						<table class="table table-bordered table-hover">
							<tbody>
							<tr>
								<th class="text-center" width="30px">#</th>
								<th>File</th>
								<th class="" width="180px">Updated</th>
							</tr>
							<?
							$info = new stdClass();
							$info->module = 'blog';
							$info->jurisdiction_id = !empty($item->id) ? $item->id : 0;
							$jurisdictions_modules = $this->m_jurisdictions_resources->items($info);
							if (!empty($jurisdictions_modules)) {
							$i=0; foreach ($jurisdictions_modules as $jurisdictions_module) { $content_item = $this->m_content->load($jurisdictions_module->content_id)?>
							<tr class="row1">
								<td class="text-center"><?=$i+1?></td>
								<td>
									<a><?=$content_item->title?></a>
									<ul class="action-icon-list faq">
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdictions_resources" item-id="<?=$jurisdictions_module->id?>" task="del"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdictions_resources" item-id="<?=$jurisdictions_module->id?>" task="<?=!empty($jurisdictions_module->active) ? 'hide' : 'show'?>"><i class="fa fa-eye-slash" aria-hidden="true"></i> <?=!empty($jurisdictions_module->active) ? 'Hide' : 'Show'?></a></li>
									</ul>
								</td>
								<td class="">
									<?
										$updated_by = $this->m_user->load($jurisdictions_module->updated_by);
										if (!empty($updated_by)) {
									?>
									<strong><?=$updated_by->user_fullname?></strong>
									<div class="action-icon-list"><span class="text-color-grey"><?=date($this->config->item("log_date_format"), strtotime($jurisdictions_module->updated_date))?></span></div>
									<?
										}
									
									?>
								</td>
							</tr>
							<? $i++; } }?>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Form & Download</td>
					<td>
						<div class="tool-bar clearfix">
							<? if (!empty($item->id)) { ?>
							<div class="pull-right">
								<ul class="action-icon-list">
									<li><a href="<?=site_url("syslog/jurisdictions-download/{$item->id}/add")?>"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></li>
								</ul>
							</div>
							<? } ?>
						</div>
						<table class="table table-bordered table-hover">
							<tbody>
							<tr>
								<th class="text-center" width="30px">#</th>
								<th>File</th>
								<th class="" width="180px">Updated</th>
							</tr>
							<?
							if (!empty($downloads)) {
							$i=0; foreach ($downloads as $download) { ?>
							<tr class="row1">
								<td class="text-center"><?=$i+1?></td>
								<td>
									<a href="<?=site_url("syslog/jurisdictions-download/{$item->id}/edit/{$download->id}")?>"><?=$download->title?></a>
									<ul class="action-icon-list download">
										<li><a href="<?=site_url("syslog/jurisdictions-download/{$item->id}/edit/{$download->id}")?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdictions_download" item-id="<?=$download->id?>" task="del"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
										<li style="color: green;">Path: <?=$download->file_path?></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdictions_download" item-id="<?=$download->id?>" task="<?=!empty($download->active) ? 'hide' : 'show'?>"><i class="fa fa-eye-slash" aria-hidden="true"></i> <?=!empty($download->active) ? 'Hide' : 'Show'?></a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdictions_download" item-id="<?=$download->id?>" task="up"><i class="fa fa-level-up" aria-hidden="true"></i> Up</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_jurisdictions_download" item-id="<?=$download->id?>" task="down"><i class="fa fa-level-down" aria-hidden="true"></i> Down</a></li>
									</ul>
								</td>
								<td class="">
									<?
										$updated_by = $this->m_user->load($download->updated_by);
										if (!empty($updated_by)) {
									?>
									<strong><?=$updated_by->user_fullname?></strong>
									<div class="action-icon-list"><span class="text-color-grey"><?=date($this->config->item("log_date_format"), strtotime($download->updated_date))?></span></div>
									<?
										}
									
									?>
								</td>
							</tr>
							<? $i++; } }?>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">SEO</td>
					<td>
						<div class="seo-panel">
							<p class="title"><input type="text" id="meta_title" name="meta_title" class="form-control seo-control" maxlength="70" value="<?=$item->meta_title?>" placeholder="Title..."></p>
							<p class="keywords"><input type="text" id="meta_key" name="meta_key" class="form-control seo-control" maxlength="255" value="<?=$item->meta_key?>" placeholder="Keywords..."></p>
							<p class="description"><input type="text" id="meta_desc" name="meta_desc" class="form-control seo-control" maxlength="160" value="<?=$item->meta_desc?>" placeholder="Description..."></p>
						</div>
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
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<input type="hidden" name="list_content" id="list_content" value="">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title module-title">Modal Header</h4>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a class="btn btn-success add-item">Add</a>
			</div>
		</div>
	</div>
</div>
<? require_once(APPPATH."views/module/admin/upload_ckfinder.php"); ?>
<script type="text/javascript">
	$('.get-resources').click(function(event) {
		var m = $(this).attr('module');
		var jur_id = <?=!empty($item->id) ? $item->id : 0?>;
		var p = {};
		p['module'] = m;
		p['jur_id'] = jur_id;
		$('.module-title').html(m);
		$.ajax({
			url: '<?=site_url("syslog/get-jurisdictions-content")?>',
			type: 'post',
			dataType: 'json',
			data: p,
			success: function(data) {
				var c = data.length
				var str = '<ul class="list-group">';
				for (var i = 0; i < c; i++) {
					str += '<li class="list-group-item" stt="0" id_item = "'+data[i].id+'">'+(i+1)+'. '+data[i].title+'</li>';
				}
					str += '</ul>';
				$('.modal-body').html(str);
			}
		})
	});
	$(document).on('click', '.list-group-item', function(event) {
		event.preventDefault();
		var stt = parseInt($(this).attr('stt'));
		var id_item = $(this).attr('id_item');
		var str = $('#list_content').val();
		if (stt == 1) {
			$(this).children('.fa-check').remove();
			$(this).attr('stt',0);
			var temp = str.split(',');
			str = '';
			for (var i = 0; i < temp.length; i++) {
				if (id_item != temp[i] && temp[i] != ""){
					str += temp[i]+',';
				}
			}
		} else {
			$(this).append('<i class="fa fa-check"></i>');
			$(this).attr('stt',1);
			str += id_item+',';
		}
		$('#list_content').val(str);
	});
	$('.add-item').click(function(event) {
		var m = $('.module-title').html();
		var jur_id = <?=!empty($item->id) ? $item->id : 0?>;
		var p = {};
		p['module'] = m;
		p['jur_id'] = jur_id;
		p['list_content'] = $('#list_content').val().split(",");
		if (p['list_content'] != '') {
			$.ajax({
				url: '<?=site_url("syslog/add-jurisdictions-content")?>',
				type: 'post',
				dataType: 'json',
				data: p,
				success: function(data) {
					if(data) {
						location.reload();
					}
				}
			})
		} else {
			alert('Please select items!');
		}
		
	});
</script>
<script>
$(document).ready(function() {
	$('.action-item').click(function(event) {
		var cf = confirm('Are you sure?');
		if (cf) {
			var id = $(this).attr('item-id');
			var task = $(this).attr('task');
			var table = $(this).attr('tbl');

			p = {};
			p['id'] = id;
			p['task'] = task;
			p['table'] = table;
			$.ajax({
				url: '<?=site_url("syslog/ajax-action-item")?>',
				type: 'POST',
				dataType: 'html',
				data: p,
				success: function (data) {
					window.location.reload();
				}
			})
		}
	});

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