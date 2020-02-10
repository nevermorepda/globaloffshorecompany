<div class="cluster">
	<div class="container-fluid">
		<h1 class="page-title"><?=!empty($nation->name) ? $nation->name : 'Add'?></h1>
		<? if (empty($item) || !sizeof($item)) { ?>
		<p class="help-block">Item not found.</p>
		<? } else { ?>
		<form id="frm-admin" name="adminForm" action="" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="task" name="task" value="">
			<table class="table table-bordered">
				<tr>
					<td class="table-head text-right" width="10%">Nation</td>
					<td>
						<select name="nation_id" id="nation_id" class="form-control" required="required">
							<option value="">—Choose Nation—</option>
							<? foreach ($nations as $nation) { ?>
							<option value="<?=$nation->id?>"><?=$nation->name?></option>
							<? } ?>
						</select>
						<script type="text/javascript">
							$('#nation_id').val('<?=!empty($item->nation_id) ? $item->nation_id : '';?>')
						</script>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Summary</td>
					<td><textarea id="summary" name="summary" class="tinymce form-control" rows="5"><?=$item->summary?></textarea></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Overview</td>
					<td>
						<textarea id="content" name="content" class="tinymce form-control" rows="20"><?=$item->content?></textarea>
					</td>
				</tr>
				<!-- <tr>
					<td class="table-head text-right" width="10%">Process</td>
					<td>
						<select name="services_process_id" id="services_process_id" class="form-control" required="required">
							<option value="">—Choose Process</option>
							<? foreach ($process as $proces) { ?>
							<option value="<?=$proces->id?>"><?=$proces->name?></option>
							<? } ?>
						</select>
						<script type="text/javascript">
							$('#services_process_id').val('<?=!empty($item->services_process_id) ? $item->services_process_id : '';?>')
						</script>
					</td>
				</tr> -->
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

	$('.action-item').click(function(event) {
		var cf = confirm('Are you sure?');
		if (cf) {
			var id = $(this).attr('item-id');
			var task = $(this).attr('task');
			p = {};
			p['id'] = id;
			p['task'] = task;
			$.ajax({
				url: '<?=site_url("syslog/ajax-services-tabs")?>',
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