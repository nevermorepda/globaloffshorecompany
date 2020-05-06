<div class="cluster">
	<div class="container-fluid">
		<h1 class="page-title">Company Details</h1>
		<table class="table table-bordered">
			<tr>
				<td class="table-head text-right" width="10%">Name</td>
				<td><?=$setting->company_name?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Address</td>
				<td><?=$setting->company_address?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Email</td>
				<td><?=$setting->company_email?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Tollfree</td>
				<td><?=$setting->company_tollfree?></td>
			</tr>
		</table>
		<h1 class="page-title">VN</h1>
		<table class="table table-bordered">
			<tr>
				<td class="table-head text-right" width="10%">Hotline [VN]</td>
				<td><?=$setting->company_hotline_vn?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Address [VN]</td>
				<td><?=$setting->company_address_vn?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Email [VN]</td>
				<td><?=$setting->company_email_vn?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Working time [VN]</td>
				<td><?=$setting->company_working_time_vn?></td>
			</tr>
		</table>
		<h1 class="page-title">US</h1>
		<table class="table table-bordered">
			<tr>
				<td class="table-head text-right" width="10%">Hotline [US]</td>
				<td><?=$setting->company_hotline_us?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Address [US]</td>
				<td><?=$setting->company_address_us?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Email [US]</td>
				<td><?=$setting->company_email_us?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Working time [US]</td>
				<td><?=$setting->company_working_time_us?></td>
			</tr>
		</table>
		<h1 class="page-title">AU</h1>
		<table class="table table-bordered">
			<tr>
				<td class="table-head text-right" width="10%">Hotline [AU]</td>
				<td><?=$setting->company_hotline_au?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Address [AU]</td>
				<td><?=$setting->company_address_au?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Email [AU]</td>
				<td><?=$setting->company_email_au?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Working time [AU]</td>
				<td><?=$setting->company_working_time_au?></td>
			</tr>
		</table>
		<h1 class="page-title">SIN</h1>
		<table class="table table-bordered">
			<tr>
				<td class="table-head text-right" width="10%">Hotline [SIN]</td>
				<td><?=$setting->company_hotline_sin?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Address [SIN]</td>
				<td><?=$setting->company_address_sin?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Email [SIN]</td>
				<td><?=$setting->company_email_sin?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Working time [SIN]</td>
				<td><?=$setting->company_working_time_sin?></td>
			</tr>
		</table>
		<h1 class="page-title">HK</h1>
		<table class="table table-bordered">
			<tr>
				<td class="table-head text-right" width="10%">Hotline [HK]</td>
				<td><?=$setting->company_hotline_hk?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Address [HK]</td>
				<td><?=$setting->company_address_hk?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Email [HK]</td>
				<td><?=$setting->company_email_hk?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Working time [HK]</td>
				<td><?=$setting->company_working_time_hk?></td>
			</tr>
		</table>

		<h1 class="page-title">Social Links</h1>
		<table class="table table-bordered">
			<tr>
				<td class="table-head text-right" width="10%">Facebook</td>
				<td><?=$setting->facebook_url?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Google+</td>
				<td><?=$setting->googleplus_url?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Twitter</td>
				<td><?=$setting->twitter_url?></td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Youtube</td>
				<td><?=$setting->youtube_url?></td>
			</tr>
		</table>
		<h1 class="page-title">Bang List</h1>
		<table class="table table-bordered bang-list">
			<tr>
				<td class="table-head text-right" width="10%">IP</td>
				<td>
					<?
						$ip_list = explode(',',$setting->bang_ip);
						foreach ($ip_list as $value) {
							echo '<span class="item">'.$value.'</span>';
						}
					?>
				</td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Name</td>
				<td>
					<?
						$name_list = explode(',',$setting->bang_name);
						foreach ($name_list as $value) {
							echo '<span class="item">'.$value.'</span>';
						}
					?>
				</td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Email</td>
				<td>
					<?
						$email_list = explode(',',$setting->bang_email);
						foreach ($email_list as $value) {
							echo '<span class="item">'.$value.'</span>';
						}
					?>
				</td>
			</tr>
			<tr>
				<td class="table-head text-right" width="10%">Passport</td>
				<td>
					<?
						$passport_list = explode(',',$setting->bang_passport);
						foreach ($passport_list as $value) {
							echo '<span class="item">'.$value.'</span>';
						}
					?>
				</td>
			</tr>
		</table>
		<div>
			<a class="btn btn-sm btn-primary btn-edit" href="<?=site_url("syslog/settings/edit")?>">Edit</a>
		</div>
	</div>
</div>
