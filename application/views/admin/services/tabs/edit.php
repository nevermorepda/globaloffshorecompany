<div class="cluster">
	<div class="container-fluid">
		<h1 class="page-title"><?=$service->name?></h1>
		<? if (empty($item) || !sizeof($item)) { ?>
		<p class="help-block">Item not found.</p>
		<? } else { ?>
		<form id="frm-admin" name="adminForm" action="" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="task" name="task" value="">
			<table class="table table-bordered">
				<tr>
					<td class="table-head text-right" width="10%">Tab Name</td>
					<td><input type="text" id="name" name="name" class="form-control" value="<?=$item->name?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">URL alias</td>
					<td><input type="text" id="alias" name="alias" class="form-control" value="<?=$item->alias?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Icon</td>
					<td>
						<label class="wrap-upload-icon" style="background: url('<?=BASE_URL?><?=!empty($item->icon_path) ? $item->icon_path : ''?>') no-repeat">
							<input type="file" name="icon_path" id="file-upload" value="<?=!empty($item->name) ? $item->name : ''?>">
							<i class="fa fa-cloud-upload" aria-hidden="true"></i>
						</label>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Content</td>
					<td>
						<div class="tool-bar clearfix">
							<? if (!empty($item->id)) { ?>
							<div class="pull-right">
								<ul class="action-icon-list">
									<li><a href="<?=site_url("syslog/services-tabs-detail/{$item->id}/add")?>"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></li>
								</ul>
							</div>
							<? } ?>
						</div>
						<table class="table table-bordered table-hover">
							<tbody>
							<tr>
								<th class="text-center" width="30px">#</th>
								<th>Content</th>
								<th class="" width="180px">Updated</th>
							</tr>
							<?
							if (!empty($details)) {
							$i=0; foreach ($details as $detail) { ?>
							<tr class="row1">
								<td class="text-center"><?=$i+1?></td>
								<td>
									<a href="<?=site_url("syslog/services-tabs-detail/{$item->id}/edit/{$detail->id}")?>"><?=$detail->name?></a>
									<ul class="action-icon-list">
										<li><a href="<?=site_url("syslog/services-tabs-detail/{$item->id}/edit/{$detail->id}")?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tabs_details" item-id="<?=$detail->id?>" task="del"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tabs_details" item-id="<?=$detail->id?>" task="<?=!empty($detail->active) ? 'hide' : 'show'?>"><i class="fa fa-eye-slash" aria-hidden="true"></i> <?=!empty($detail->active) ? 'Hide' : 'Show'?></a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tabs_details" item-id="<?=$detail->id?>" task="<?=!empty($detail->open) ? 'close' : 'open'?>"><i class="fa fa-eye-slash" aria-hidden="true"></i> <?=!empty($detail->open) ? 'Close' : 'Open'?></a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tabs_details" item-id="<?=$detail->id?>" task="up"><i class="fa fa-level-up" aria-hidden="true"></i> Up</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tabs_details" item-id="<?=$detail->id?>" task="down"><i class="fa fa-level-down" aria-hidden="true"></i> Down</a></li>
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
							<? $i++; } } ?>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Jurisdictions</td>
					<td>
						<? $regions = array(
							"asia-pacific" => 'Asia Pacific',
							"europe" => 'Europe',
							"america-carribean" => ' America - Carribean',
							"middle-east" => 'Middle East',
							"africa" => 'Africa',
						) ?>
						<ul class="nav nav-tabs" role="tablist">
							<? $i=0; foreach ($regions as $key => $value) { ?>
							<li role="presentation" class="<?=($i==0) ? 'active' : ''?>"><a href="#<?=$key?>" aria-controls="asia-pacific" role="tab" data-toggle="tab"><?=$value?></a></li>
							<? $i++; } ?>
						</ul>
						<div class="tab-content">
							<? $i=0; foreach ($regions as $key => $value) { ?>
							<div role="tabpanel" class="tab-pane <?=($i==0) ? 'active' : ''?>" id="<?=$key?>">
								<div class="tool-bar clearfix">
									<? if (!empty($item->id)) { ?>
									<div class="pull-right">
										<ul class="action-icon-list">
											<li><a href="<?=site_url("syslog/services-tab-nation/{$item->id}/add")?>"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></li>
										</ul>
									</div>
									<? } ?>
								</div>
								<table class="table table-bordered table-hover">
									<tbody>
									<tr>
										<th class="text-center" width="30px">#</th>
										<th>Content</th>
										<th class="" width="180px">Updated</th>
									</tr>
									<?
									if (!empty($services_nation)) {
									$i=0; foreach ($services_nation as $service_nation) {
										$nation = $this->m_nation->load($service_nation->nation_id);
										if (!empty($nation) && ($nation->region == $key)) {
									?>
									<tr class="row1">
										<td class="text-center"><?=$i+1?></td>
										<td>
											<a href="<?=site_url("syslog/services-tab-nation/{$item->id}/edit/{$service_nation->id}")?>"><?=$nation->name?></a>
											<ul class="action-icon-list">
												<li><a href="<?=site_url("syslog/services-tab-nation/{$item->id}/edit/{$service_nation->id}")?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
												<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tab_nation" item-id="<?=$service_nation->id?>" task="del"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
												<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tab_nation" item-id="<?=$service_nation->id?>" task="<?=!empty($service_nation->active) ? 'hide' : 'show'?>"><i class="fa fa-eye-slash" aria-hidden="true"></i> <?=!empty($service_nation->active) ? 'Hide' : 'Show'?></a></li>
												<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tab_nation" item-id="<?=$service_nation->id?>" task="up"><i class="fa fa-level-up" aria-hidden="true"></i> Up</a></li>
												<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tab_nation" item-id="<?=$service_nation->id?>" task="down"><i class="fa fa-level-down" aria-hidden="true"></i> Down</a></li>
											</ul>
										</td>
										<td class="">
											<?
												$updated_by = $this->m_user->load($service_nation->updated_by);
												if (!empty($updated_by)) {
											?>
											<strong><?=$updated_by->user_fullname?></strong>
											<div class="action-icon-list"><span class="text-color-grey"><?=date($this->config->item("log_date_format"), strtotime($service_nation->updated_date))?></span></div>
											<?
												}
											
											?>
										</td>
									</tr>
									<? $i++; } } } ?>
									</tbody>
								</table>
							</div>
							<? $i++; } ?>
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
									<li><a href="<?=site_url("syslog/services-tab-faqs/{$item->id}/add")?>"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></li>
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
									<a href="<?=site_url("syslog/services-tab-faqs/{$item->id}/edit/{$faq->id}")?>"><?=$faq->question?></a>
									<ul class="action-icon-list faq">
										<li><a href="<?=site_url("syslog/services-tab-faqs/{$item->id}/edit/{$faq->id}")?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tab_faqs" item-id="<?=$faq->id?>" task="del"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tab_faqs" item-id="<?=$faq->id?>" task="<?=!empty($faq->active) ? 'hide' : 'show'?>"><i class="fa fa-eye-slash" aria-hidden="true"></i> <?=!empty($faq->active) ? 'Hide' : 'Show'?></a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tab_faqs" item-id="<?=$faq->id?>" task="up"><i class="fa fa-level-up" aria-hidden="true"></i> Up</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tab_faqs" item-id="<?=$faq->id?>" task="down"><i class="fa fa-level-down" aria-hidden="true"></i> Down</a></li>
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
					<td class="table-head text-right" width="10%">Form & Download</td>
					<td>
						<div class="tool-bar clearfix">
							<? if (!empty($item->id)) { ?>
							<div class="pull-right">
								<ul class="action-icon-list">
									<li><a href="<?=site_url("syslog/services-tab-downloads/{$item->id}/add")?>"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></li>
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
									<a href="<?=site_url("syslog/services-tab-downloads/{$item->id}/edit/{$download->id}")?>"><?=$download->title?></a>
									<ul class="action-icon-list download">
										<li><a href="<?=site_url("syslog/services-tab-downloads/{$item->id}/edit/{$download->id}")?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tab_downloads" item-id="<?=$download->id?>" task="del"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
										<li style="color: green;">Path: <?=$download->file_path?></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tab_downloads" item-id="<?=$download->id?>" task="<?=!empty($download->active) ? 'hide' : 'show'?>"><i class="fa fa-eye-slash" aria-hidden="true"></i> <?=!empty($download->active) ? 'Hide' : 'Show'?></a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tab_downloads" item-id="<?=$download->id?>" task="up"><i class="fa fa-level-up" aria-hidden="true"></i> Up</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_tab_downloads" item-id="<?=$download->id?>" task="down"><i class="fa fa-level-down" aria-hidden="true"></i> Down</a></li>
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
							$info->service_tab_id = !empty($item->id) ? $item->id : 0;
							$services_modules = $this->m_services_resources->items($info);
							if (!empty($services_modules)) {
							$i=0; foreach ($services_modules as $services_module) { $content_item = $this->m_content->load($services_module->content_id)?>
							<tr class="row1">
								<td class="text-center"><?=$i+1?></td>
								<td>
									<a><?=$content_item->title?></a>
									<ul class="action-icon-list faq">
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_resources" item-id="<?=$services_module->id?>" task="del"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_resources" item-id="<?=$services_module->id?>" task="<?=!empty($services_module->active) ? 'hide' : 'show'?>"><i class="fa fa-eye-slash" aria-hidden="true"></i> <?=!empty($services_module->active) ? 'Hide' : 'Show'?></a></li>
									</ul>
								</td>
								<td class="">
									<?
										$updated_by = $this->m_user->load($services_module->updated_by);
										if (!empty($updated_by)) {
									?>
									<strong><?=$updated_by->user_fullname?></strong>
									<div class="action-icon-list"><span class="text-color-grey"><?=date($this->config->item("log_date_format"), strtotime($services_module->updated_date))?></span></div>
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
							$info->service_tab_id = !empty($item->id) ? $item->id : 0;
							$services_modules = $this->m_services_resources->items($info);
							if (!empty($services_modules)) {
							$i=0; foreach ($services_modules as $services_module) { $content_item = $this->m_content->load($services_module->content_id)?>
							<tr class="row1">
								<td class="text-center"><?=$i+1?></td>
								<td>
									<a><?=$content_item->title?></a>
									<ul class="action-icon-list faq">
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_resources" item-id="<?=$services_module->id?>" task="del"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
										<li><a style="cursor: pointer;" onclick="return actionItem(this)" tbl="m_services_resources" item-id="<?=$services_module->id?>" task="<?=!empty($services_module->active) ? 'hide' : 'show'?>"><i class="fa fa-eye-slash" aria-hidden="true"></i> <?=!empty($services_module->active) ? 'Hide' : 'Show'?></a></li>
									</ul>
								</td>
								<td class="">
									<?
										$updated_by = $this->m_user->load($services_module->updated_by);
										if (!empty($updated_by)) {
									?>
									<strong><?=$updated_by->user_fullname?></strong>
									<div class="action-icon-list"><span class="text-color-grey"><?=date($this->config->item("log_date_format"), strtotime($services_module->updated_date))?></span></div>
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
<script type="text/javascript">
	$('.get-resources').click(function(event) {
		var m = $(this).attr('module');
		var service_tab_id = <?=!empty($item->id) ? $item->id : 0?>;
		var p = {};
		p['module'] = m;
		p['service_tab_id'] = service_tab_id;
		$('.module-title').html(m);
		$.ajax({
			url: '<?=site_url("syslog/get-services-content")?>',
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
		var service_tab_id = <?=!empty($item->id) ? $item->id : 0?>;
		var p = {};
		p['module'] = m;
		p['service_tab_id'] = service_tab_id;
		p['list_content'] = $('#list_content').val().split(",");
		if (p['list_content'] != '') {
			$.ajax({
				url: '<?=site_url("syslog/add-services-content")?>',
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
	$("#file-upload").change(function() {
		readURL(this);
	});
	
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('.wrap-upload-icon').css({
					"background-image": "url('"+e.target.result+"')"
				});
				$('.wrap-upload-icon > i').css({
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