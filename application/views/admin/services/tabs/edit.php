<div class="cluster">
	<div class="container-fluid">
		<h1 class="page-title"><?=$service->name?></h1>
		<? if (empty($item) || !sizeof($item)) { ?>
		<p class="help-block">Item not found.</p>
		<? } else { ?>
		<form id="frm-admin" name="adminForm" action="" method="POST">
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

<script>
$(document).ready(function() {
	$(".btn-save").click(function(){
		submitButton("save");
	});
	$(".btn-cancel").click(function(){
		submitButton("cancel");
	});
});
</script>