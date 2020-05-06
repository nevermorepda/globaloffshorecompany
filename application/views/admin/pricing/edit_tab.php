<div class="cluster">
	<div class="container-fluid">
		<h1 class="page-title"><?=$jurisdiction->name?></h1>
		<form id="frm-admin" name="adminForm" action="" method="POST">
			<input type="hidden" id="task" name="task" value="">
			<table class="table table-bordered">
				<tr>
					<td class="table-head text-right" width="10%">Name</td>
					<td><input type="text" id="name" name="name" class="form-control" value="<?=!empty($item->name) ? $item->name : '' ?>"></td>
				</tr>
			</table>
			<div>
				<button class="btn btn-sm btn-primary btn-save">Save</button>
				<button class="btn btn-sm btn-default btn-cancel">Cancel</button>
			</div>
		</form>
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