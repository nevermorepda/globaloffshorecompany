<div class="cluster">
	<div class="container-fluid">
		<h1 class="page-title"><?=$services_tab->name?></h1>
		<? if (empty($item) || !sizeof($item)) { ?>
		<p class="help-block">Item not found.</p>
		<? } else { ?>
		<form id="frm-admin" name="adminForm" action="" method="POST">
			<input type="hidden" id="task" name="task" value="">
			<table class="table table-bordered">
				<tr>
					<td class="table-head text-right" width="10%">Title</td>
					<td><input type="text" id="name" name="name" class="form-control" value="<?=$item->name?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Module</td>
					<td>
						<? require_once(APPPATH."views/admin/services/selector-module.php"); ?>
						<script type="text/javascript">
							$('#module').val('<?=!empty($item->module) ? $item->module : 'content' ?>');
						</script>
						<br>
						<div id="content">
							<textarea name="content" class="tinymce form-control" rows="20"><?=$item->content?></textarea>
						</div>
						<script type="text/javascript">
							<?
								if (!empty($item->module)) {
									if ($item->module == 'content') {
										echo '$("#content").show();';
									} else {
										echo '$("#content").hide();';
									}
								} else {
									echo '$("#content").show();';
								}
							?>
							$('#module').change(function(event) {
								var v = $(this).val();
								if (v != 'content') {
									$('#content').hide();
								} else {
									$('#content').show();
								}
							});
						</script>
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