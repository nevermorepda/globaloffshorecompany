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
				<? for ($i=1; $i <= 8 ; $i++) { $step = "step{$i}" ?>
				<tr>
					<td class="table-head text-right" width="10%">Step <?=$i?></td>
					<td><input type="text" id="step<?=$i?>" name="step<?=$i?>" class="form-control" value="<?=$item->{$step}?>"></td>
				</tr>
				<? } ?>
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
	$(".btn-save").click(function(){
		submitButton("save");
	});
	$(".btn-cancel").click(function(){
		submitButton("cancel");
	});
});
</script>