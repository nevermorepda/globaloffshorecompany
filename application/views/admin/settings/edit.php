<link rel="stylesheet" type="text/css" href="<?=ADMIN_CSS_URL?>bootstrap-tagsinput.css" />
<div class="cluster">
	<div class="container-fluid">
		<? if (empty($setting) || !sizeof($setting)) { ?>
		<h1 class="page-title">Settings</h1>
		<p class="help-block">Item not found.</p>
		<? } else { ?>
		<form id="frm-admin" name="adminForm" action="" method="POST">
			<input type="hidden" id="task" name="task" value="">
			<h1 class="page-title">Company Details</h1>
			<table class="table table-bordered">
				<tr>
					<td class="table-head text-right" width="10%">Name</td>
					<td><input type="text" id="company_name" name="company_name" class="form-control" value="<?=$setting->company_name?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Address</td>
					<td><input type="text" id="company_address" name="company_address" class="form-control" value="<?=$setting->company_address?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Email</td>
					<td><input type="text" id="company_email" name="company_email" class="form-control" value="<?=$setting->company_email?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Tollfree</td>
					<td><input type="text" id="company_tollfree" name="company_tollfree" class="form-control" value="<?=$setting->company_tollfree?>"></td>
				</tr>
			</table>
			<h1 class="page-title">VN</h1>
			<table class="table table-bordered">
				<tr>
					<td class="table-head text-right" width="10%">Hotline [VN]</td>
					<td><input type="text" id="company_hotline_vn" name="company_hotline_vn" class="form-control" value="<?=$setting->company_hotline_vn?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Address [VN]</td>
					<td><input type="text" id="company_address_vn" name="company_address_vn" class="form-control" value="<?=$setting->company_address_vn?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Email [VN]</td>
					<td><input type="text" id="company_email_vn" name="company_email_vn" class="form-control" value="<?=$setting->company_email_vn?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Working time [VN]</td>
					<td><input type="text" id="company_working_time_vn" name="company_working_time_vn" class="form-control" value="<?=$setting->company_working_time_vn?>"></td>
				</tr>
			</table>
			<h1 class="page-title">US</h1>
			<table class="table table-bordered">
				<tr>
					<td class="table-head text-right" width="10%">Hotline [US]</td>
					<td><input type="text" id="company_hotline_us" name="company_hotline_us" class="form-control" value="<?=$setting->company_hotline_us?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Address [US]</td>
					<td><input type="text" id="company_address_us" name="company_address_us" class="form-control" value="<?=$setting->company_address_us?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Email [US]</td>
					<td><input type="text" id="company_email_us" name="company_email_us" class="form-control" value="<?=$setting->company_email_us?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Working time [US]</td>
					<td><input type="text" id="company_working_time_us" name="company_working_time_us" class="form-control" value="<?=$setting->company_working_time_us?>"></td>
				</tr>
			</table>
			<h1 class="page-title">AU</h1>
			<table class="table table-bordered">
				<tr>
					<td class="table-head text-right" width="10%">Hotline [AU]</td>
					<td><input type="text" id="company_hotline_au" name="company_hotline_au" class="form-control" value="<?=$setting->company_hotline_au?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Address [AU]</td>
					<td><input type="text" id="company_address_au" name="company_address_au" class="form-control" value="<?=$setting->company_address_au?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Email [AU]</td>
					<td><input type="text" id="company_email_au" name="company_email_au" class="form-control" value="<?=$setting->company_email_au?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Working time [AU]</td>
					<td><input type="text" id="company_working_time_au" name="company_working_time_au" class="form-control" value="<?=$setting->company_working_time_au?>"></td>
				</tr>
			</table>
			<h1 class="page-title">SIN</h1>
			<table class="table table-bordered">
				<tr>
					<td class="table-head text-right" width="10%">Hotline [SIN]</td>
					<td><input type="text" id="company_hotline_sin" name="company_hotline_sin" class="form-control" value="<?=$setting->company_hotline_sin?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Address [SIN]</td>
					<td><input type="text" id="company_address_sin" name="company_address_sin" class="form-control" value="<?=$setting->company_address_sin?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Email [SIN]</td>
					<td><input type="text" id="company_email_sin" name="company_email_sin" class="form-control" value="<?=$setting->company_email_sin?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Working time [SIN]</td>
					<td><input type="text" id="company_working_time_sin" name="company_working_time_sin" class="form-control" value="<?=$setting->company_working_time_sin?>"></td>
				</tr>
			</table>
			<h1 class="page-title">HK</h1>
			<table class="table table-bordered">
				<tr>
					<td class="table-head text-right" width="10%">Hotline [HK]</td>
					<td><input type="text" id="company_hotline_hk" name="company_hotline_hk" class="form-control" value="<?=$setting->company_hotline_hk?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Address [HK]</td>
					<td><input type="text" id="company_address_hk" name="company_address_hk" class="form-control" value="<?=$setting->company_address_hk?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Email [HK]</td>
					<td><input type="text" id="company_email_hk" name="company_email_hk" class="form-control" value="<?=$setting->company_email_hk?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Working time [HK]</td>
					<td><input type="text" id="company_working_time_hk" name="company_working_time_hk" class="form-control" value="<?=$setting->company_working_time_hk?>"></td>
				</tr>
			</table>
			<h1 class="page-title">Social Links</h1>
			<table class="table table-bordered">
				<tr>
					<td class="table-head text-right" width="10%">Facebook</td>
					<td><input type="text" id="facebook_url" name="facebook_url" class="form-control" value="<?=$setting->facebook_url?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Google+</td>
					<td><input type="text" id="googleplus_url" name="googleplus_url" class="form-control" value="<?=$setting->googleplus_url?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Twitter</td>
					<td><input type="text" id="twitter_url" name="twitter_url" class="form-control" value="<?=$setting->twitter_url?>"></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Youtube</td>
					<td><input type="text" id="youtube_url" name="youtube_url" class="form-control" value="<?=$setting->youtube_url?>"></td>
				</tr>
			</table>
			<h1 class="page-title">Bang List</h1>
			<table class="table table-bordered bang-list">
				<tr>
					<td class="table-head text-right" width="10%">IP</td>
					<td><input type="text" class="form-control tag-input" name="bang_ip" rows="3" value='<?=$setting->bang_ip?>'/></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Name</td>
					<td><input type="text" class="form-control tag-input" name="bang_name" rows="3" value='<?=$setting->bang_name?>'/></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Email</td>
					<td><input type="text" class="form-control tag-input" name="bang_email" rows="3" value='<?=$setting->bang_email?>'/></td>
				</tr>
				<tr>
					<td class="table-head text-right" width="10%">Passport</td>
					<td><input type="text" class="form-control tag-input" name="bang_passport" rows="3" value='<?=$setting->bang_passport?>'/></td>
				</tr>
			</table>
			<div>
				<button class="btn btn-sm btn-primary btn-save">Save</button>
				<button class="btn btn-sm btn-default btn-cancel">Cancel</button>
			</div>
		</form>
		<? } ?>
	</div>
</div>
<script src="<?=ADMIN_JS_URL?>typeahead.bundle.min.js"></script>
<script src="<?=ADMIN_JS_URL?>bootstrap-tagsinput.min.js"></script>
<script>
$(document).ready(function() { 

	$('.tag-input').tagsinput({
		typeahead: {
			afterSelect: function() {
				this.$element[0].value = '';
			}
		}
	});
});
$(document).ready(function() {
	$(".btn-save").click(function(){
		submitButton("save");
	});
	$(".btn-cancel").click(function(){
		submitButton("cancel");
	});
});
</script>