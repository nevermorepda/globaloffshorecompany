<div class="cluster">
	<div class="container-fluid">
		<h1 class="page-title"><?=!empty($item->name) ? $item->name : 'Add' ?></h1>
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
					<td class="table-head text-right" width="10%">Thumbnail</td>
					<td>
						<label class="wrap-upload-thumb" style="background: url('<?=BASE_URL?><?=!empty($item->url_img) ? $item->url_img : ''?>') no-repeat">
							<input type="file" name="url_img" id="file-upload" value="<?=!empty($item->url_img) ? $item->url_img : ''?>">
							<i class="fa fa-cloud-upload" aria-hidden="true"></i>
						</label>
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