<div class="cluster">
	<div class="container-fluid">
		<h1 class="page-title">
			<h1 class="page-title">Download Form</h1>
		</h1>
		<? if (empty($item) || !sizeof($item)) { ?>
		<p class="help-block">Item not found.</p>
		<? } else { ?>
		<form id="frm-admin" name="adminForm" action="" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="task" name="task" value="">
			<table class="table table-bordered">
				<tr>
					<td class="table-head text-right" width="10%">Title</td>
					<td>
						<input type="text" name="title" id="title" class="form-control" value="<?=!empty($item->title) ? $item->title : ''?>" required="required">
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">File</td>
					<td>
						<label class="custom-file-upload">
							<input type="file" name="file_upload" id="file-upload" value="">
							Chọn file upload
						</label>
						<div class="boder-file-upload">
							<p class="file-name"><?=!empty($item->file_path) ? str_replace('/files/upload/service/download/','', $item->file_path) : 'Chưa có file'?></p>
						</div>
						<i class="help-block">Upload file (.rar .zip .doc .docx .xls .xlsx .csv .pdf)</i>
					</td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Description</td>
					<td>
						<textarea name="description" id="description" class="form-control" rows="3" required="required"><?=!empty($item->description) ? $item->description : ''?></textarea>
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
	$('#file-upload').change(function(event) {
		var file_name = $(this).val().replace(/^.*\\/, "");
		var allow_type = file_name.split('.')[1].toLowerCase();
		if (allow_type == 'rar' || allow_type == 'zip' || allow_type == 'doc' ||
			allow_type == 'docx' || allow_type == 'xls' || allow_type == 'xlsx' ||
			allow_type == 'csv' || allow_type == 'pdf')
		{
			var file_name_current = $('.file-name').html();
			if (file_name_current != '' && file_name_current != 'Chưa có file'){
				var allow_type_current = file_name_current.split('.')[1].toLowerCase();
				$('.fa').removeClass(font_file(allow_type_current));
			}
			$('.file-name').html(file_name);
		} else {
			alert('Upload file (.rar .zip .doc .docx .xls .xlsx .csv .pdf)');
		}
	});
	$('.action-item').click(function(event) {
		var cf = confirm('Are you sure?');
		if (cf) {
			var id = $(this).attr('item-id');
			var task = $(this).attr('task');
			p = {};
			p['id'] = id;
			p['task'] = task;
			$.ajax({
				url: '<?=site_url("syslog/ajax-jurisdiction-details")?>',
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