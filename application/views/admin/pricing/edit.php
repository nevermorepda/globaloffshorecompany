<div class="cluster">
	<div class="container-fluid">
		<div class="tool-bar clearfix">
			<h1 class="page-title">
				<?=$jurisdiction->name?>
				<div class="pull-right">
					<ul class="action-icon-list">
						<li><a data-toggle="modal" href="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></li>
					</ul>
				</div>
			</h1>
		</div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Services fee</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="jurisdiction_id" value="<?=$jurisdiction_id?>">
					<input type="hidden" name="service_id" value="<?=$service_id?>">
					<input type="text" name="name" id="name" class="form-control" value="" placeholder="Title">
					<br>
					<div class="row">
						<div class="col-md-4">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Fee</span>
								<input type="text" name="fee" id="fee" class="form-control" placeholder="$0.00" aria-describedby="basic-addon1">
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Capital</span>
								<input type="text" name="capital" id="capital" class="form-control" placeholder="$0.00" aria-describedby="basic-addon1">
							</div>
						</div>
						<div class="col-md-4">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="recomen" id="recomen" value="1">
									Recomendation
								</label>
							</div>
						</div>
					</div>
					<br>
					<textarea name="description" id="description" class="form-control" rows="3" required="required" placeholder="Description"></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary btn-add">Add</button>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$('.btn-add').click(function(event) {
				var err = 0;
				if ($("#name").val() == "") {
					$("#name").addClass("error");
					err++;
				} else {
					$("#name").removeClass("error");
				}

				if ($("#description").val() == "") {
					$("#description").addClass("error");
					err++;
				} else {
					$("#description").removeClass("error");
				}

				if ($("#fee").val() == "") {
					$("#fee").addClass("error");
					err++;
				} else {
					$("#fee").removeClass("error");
				}

				if ($("#capital").val() == "") {
					$("#capital").addClass("error");
					err++;
				} else {
					$("#capital").removeClass("error");
				}

				if (err == 0) {
					var p = {};
					p['jurisdiction_id'] = '<?=$jurisdiction_id?>';
					p['service_id'] = '<?=$service_id?>';
					p['name'] = $("#name").val();
					p['description'] = $("#description").val();
					p['fee'] = $("#fee").val();
					p['capital'] = $("#capital").val();
					p['recomen'] = $('#recomen').is(":checked");

					$.ajax({
						url: '<?=site_url("syslog/ajax-add-service-fee")?>',
						type: 'post',
						dataType: 'json',
						data: p,
						success: function (data) {
							if (data) {
								window.location.reload();
							}
						}
					});
				}
			});
		</script>
	</div>
		<? if (empty($items) || !sizeof($items)) { ?>
		<p class="help-block">No item found.</p>
		<? } else { ?>
		<form id="frm-admin" name="adminForm" action="" method="POST">
			<input type="hidden" id="task" name="task" value="">
			<input type="hidden" id="boxchecked" name="boxchecked" value="0" />
			<table class="table table-bordered">
				<tr>
					<th class="text-center" width="30px">#</th>
					<th width="300px">Title</th>
					<th class="text-center" width="60px">Fee</th>
					<th class="text-center" width="60px">Capital</th>
					<th class="text-center" width="60px">Recomen</th>
					<th>Description</th>
				</tr>
				<?
					$i = 0;
					foreach ($items as $item) {
				?>
				<tr class="row1">
					<td class="text-center"><?=($i+1)?></td>
					<td>
						<input type="text" class="change" item-id="<?=$item->id?>" pro-type="name" value="<?=$item->name?>" style="background-color: #f2f2f2; width: 100%; text-align: left; border: none;">
						<ul class="action-icon-list">
							<li><a href="#" class="btn-delete" item-id="<?=$item->id?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
						</ul>
					</td>
					<td>
						<input item-id="<?=$item->id?>" pro-type="fee" type="text" class="change" value="<?=$item->fee?>" style="background-color: #f2f2f2; width: 50px; text-align: right; border: none;">
					</td>
					<td>
						<input item-id="<?=$item->id?>" pro-type="capital" type="text" class="change" value="<?=$item->capital?>" style="background-color: #D9EDF7; width: 50px; text-align: right; border: none;">
					</td>
					<td class="text-center">
						<input item-id="<?=$item->id?>" class="change-check" pro-type="recomen" type="checkbox" <?=!empty($item->recomen) ? 'checked' : ''?>>
					</td>
					<td>
						<textarea item-id="<?=$item->id?>" pro-type="content" class="change" style="width: 100%;border: none;background: #f2f2f2;"><?=$item->content?></textarea>
					</td>
				</tr>
				<?
						$i++;
					}
				?>
			</table>
		</form>
		<? } ?>
	</div>
</div>

<script>
$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
	$(".btn-publish").click(function(e){
		e.preventDefault();
		if ($("#boxchecked").val() == 0) {
			messageBox("ERROR", "Error", "Please make a selection from the list to publish.");
		}
		else {
			submitButton("publish");
		}
	});
	$(".btn-unpublish").click(function(e){
		e.preventDefault();
		if ($("#boxchecked").val() == 0) {
			messageBox("ERROR", "Error", "Please make a selection from the list to unpublish.");
		}
		else {
			submitButton("unpublish");
		}
	});
	$(".btn-delete").click(function(e){
		e.preventDefault();
		if ($("#boxchecked").val() == 0) {
			messageBox("ERROR", "Error", "Please make a selection from the list to delete.");
		}
		else {
			confirmBox("Delete items", "Are you sure you want to delete the selected items?", "submitButton", "delete");
		}
	});
	$(".change").click(function() {
		$(this).select();
	});
	
	$(".change").blur(function() {
		var item_id = $(this).attr("item-id");
		var pro_type = $(this).attr("pro-type");
		var val = $(this).val();
		
		var p = {};
		p["item_id"] = item_id;
		p["pro_type"] = pro_type;
		p["val"] = val;
		
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-change-service-fee")?>",
			data: p
		});
	});

	$(".change-check").click(function() {
		var item_id = $(this).attr("item-id");
		var pro_type = $(this).attr("pro-type");
		var val = $(this).is(":checked");
		
		var p = {};
		p["item_id"] = item_id;
		p["pro_type"] = pro_type;
		p["val"] = val;
		
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-change-service-fee")?>",
			data: p
		});
	});
	$(".btn-delete").click(function() {
		var cf = confirm('Are you sure?');
		if (cf) {
			var item_id = $(this).attr("item-id");
			
			var p = {};
			p["item_id"] = item_id;

			$.ajax({
				type: "POST",
				url: "<?=site_url("syslog/ajax-delete-service-fee")?>",
				data: p,
				success: function (data) {
					if (data) {
						window.location.reload();
					}
				}
			});
		}
	});
});
</script>