<?
	$admin = $this->session->userdata("admin");
	$method = $this->util->slug($this->router->fetch_method());
	
	$category_info = new stdClass();
	$category_info->parent_id = 0;
	$content_categories = $this->m_category->items($category_info);
	
	$info = new stdClass();
	$info->user_types = array(USR_SUPPER_ADMIN, USR_ADMIN);
	$user_onlines = $this->m_user->users($info);
	
	$admin_id = explode('|',SUPER_ADMIN_FULL_ROLE);

	$services = $this->m_services->items();
	$services_process = $this->m_services_process->items();
?>
<div class="header">
	<div class="header-top">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse" aria-expanded="false">
						<span class="sr-only"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<div class="clearfix">
							<div class="pull-left">
								<span class="header-sitename"><?=SITE_NAME?></span><br>
								<span class="header-title">Administration</span>
							</div>
							<div class="pull-left">
								<span class="caret"></span>
							</div>
						</div>
					</a>
<!-- 					<ul class="dropdown-menu">
						<li><a target="_blank" href="https://www.vietnam-evisa.org/syslog.html">Vietnam-Evisa.Org</a></li>
						<li><a target="_blank" href="https://www.visa-vietnam.org.vn/syslog.html">Visa-Vietnam.Org.Vn</a></li>
						<li><a target="_blank" href="http://www.vietnam-immigration.net/syslog.html">Vietnam-Immigration.Net</a></li>
						<li><a target="_blank" href="http://www.vietnam-immigration.org.vn/syslog.html">Vietnam-Immigration.Org.Vn</a></li>
						<li><a target="_blank" href="http://www.vietnamvisateam.com/syslog.html">VietnamVisaTeam.Com</a></li>
					</ul> -->
				</div>
				<div class="collapse navbar-collapse" id="bs-navbar-collapse">
					<ul class="nav navbar-nav">
						<? if ($admin->user_type == USR_SUPPER_ADMIN) { ?>
						<li class="<?=(($method=='users')?'active':'')?>"><a href="<?=site_url("syslog/users")?>">Users</a></li>
						<? } ?>
						<li class="dropdown <?=((in_array($method, array('content', 'content-categories')))?'active':'')?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Content <span class="caret"></span></a>
							<ul class="dropdown-menu multi-level">
								<li><a href="<?=site_url("syslog/content-categories")?>">Content Categories</a></li>
								<li role="separator" class="divider"></li>
								<? gen_category_menu($content_categories, $this); ?>
								<li role="separator" class="divider"></li>
								<li><a href="<?=site_url("syslog/nations")?>">Nations</a></li>
							</ul>
						</li>
						<li class="dropdown <?=((in_array($method, array('services', 'services-tabs')))?'active':'')?>">
							<a href="<?=site_url("syslog/services")?>" class="dropdown-toggle" >Services <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<? foreach ($services as $service) { ?>
								<li><a href="<?=site_url("syslog/services/edit/{$service->id}")?>"><?=$service->name?></a></li>
								<? } ?>
							</ul>
						</li>
						<li class="dropdown <?=((in_array($method, array('jurisdictions')))?'active':'')?>">
							<a href="<?=site_url("syslog/jurisdictions")?>" class="dropdown-toggle" >Jurisdictions</a>
							<ul class="dropdown-menu">
								<li class="dropdown-submenu">
									<a href="<?=site_url("syslog/services-process")?>">Service Process</a>
									<ul class="dropdown-menu">
										<? foreach ($services_process as $service_process) { ?>
										<li><a href="<?=site_url("syslog/services-process/edit/{$service_process->id}")?>"><?=$service_process->name?></a></li>
										<? } ?>
									</ul>
								</li>
							</ul>
						</li>
						<li class="dropdown <?=((in_array($method, array('pricing')))?'active':'')?>">
							<a href="#" class="dropdown-toggle" >Pricing</a>
							<ul class="dropdown-menu">
								<? foreach ($services as $service) { ?>
								<li><a href="<?=site_url("syslog/pricing/{$service->id}")?>"><?=$service->name?></a></li>
								<? } ?>
							</ul>
						</li>
						<li class="dropdown <?=((in_array($method, array('booking')))?'active':'')?>">
							<a href="#" class="dropdown-toggle" >Report</a>
							<ul class="dropdown-menu">
								<li><a href="<?=site_url("syslog/booking")?>">Booking</a></li>
							</ul>
						</li>
						<!-- <li class="dropdown <?=((in_array($method, array('promotion-codes', 'promotion-templates')))?'active':'')?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Promotion <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?=site_url("syslog/promotion-codes")?>">Promotion Codes</a></li>
								<li><a href="<?=site_url("syslog/promotion-booking")?>">Promotion Booking</a></li>
							</ul>
						</li> -->
						<li class="<?=(($method=='slider')?'active':'')?>"><a href="<?=site_url("syslog/slider")?>">Slider</a></li>
						<? if ($admin->user_type == USR_SUPPER_ADMIN) { ?>
						<li class="dropdown <?=((in_array($method, array('page-meta-tags', 'page-redirects')))?'active':'')?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SEO <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?=site_url("syslog/page-meta-tags")?>">Page Meta Tags</a></li>
								<li><a href="<?=site_url("syslog/page-redirects")?>">Page Redirects</a></li>
							</ul>
						</li>
						<? } ?>
						<li class="<?=(($method=='mail')?'active':'')?>"><a href="<?=site_url("syslog/mail")?>">Mail</a></li>
						<? if (in_array($this->session->userdata('admin')->id,$admin_id)) { ?>
						<li class="<?=(($method=='scheduler')?'active':'')?>"><a href="<?=site_url("syslog/scheduler")?>">Scheduler</a></li>
						<li class="<?=(($method=='holiday')?'active':'')?>"><a href="<?=site_url("syslog/holiday")?>">Holiday</a></li>
						<li class="<?=(($method=='history')?'active':'')?>"><a href="<?=site_url("syslog/history")?>">History</a></li>
						<li class="<?=(($method=='settings')?'active':'')?>"><a href="<?=site_url("syslog/settings")?>">Settings</a></li>
						<? } ?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#" class="navbar-link" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$this->session->admin->user_fullname?> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?=site_url("syslog/logout")?>"><i class="fa fa-sign-out"></i> Log Out</a></li>
							</ul>
						</li>
						<?
							foreach ($user_onlines as $user_online) {
								if (($user_online->id != $this->session->admin->id) && (date($this->config->item("log_date_format"), strtotime($user_online->last_activity)) >= date($this->config->item("log_date_format"), strtotime("-30 minutes")))) {
						?>
						<li>
							<a href="#" title="<?=$user_online->user_fullname?>">
								<? if (!empty($user_online->avatar)) { ?>
								<img class="img-circle" src="<?=$user_online->avatar?>" width="20px">
								<? } else { ?>
								<img class="img-circle" src="<?=IMG_URL?>no-avatar.gif" width="20px">
								<? } ?>
								<? if (date($this->config->item("log_date_format"), strtotime($user_online->last_activity)) >= date($this->config->item("log_date_format"), strtotime("-10 minutes"))) { ?>
								<sup style="margin-left: -6px;"><i class="fa fa-circle" style="color: #5cb85c;"></i></sup>
								<? } else if (date($this->config->item("log_date_format"), strtotime($user_online->last_activity)) >= date($this->config->item("log_date_format"), strtotime("-20 minutes"))) { ?>
								<sup style="margin-left: -6px;"><i class="fa fa-circle" style="color: orange;"></i></sup>
								<? } else { ?>
								<sup style="margin-left: -6px;"><i class="fa fa-circle" style="color: #afafaf;"></i></sup>
								<? } ?>
							</a>
						</li>
						<?
								}
							}
						?>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</div>
<?// if ($admin->user_type == USR_SUPPER_ADMIN) { ?>
<?
	// $info = new stdClass();
	// $info->sortby			= 'id';
	// $info->orderby			= 'DESC';
	// $notify_item = $this->m_visa_booking->bookings($info,1);
?>
<!-- <div id="get_notify_booking" val="<?//=$notify_item[0]->id?>" style="display: none"></div> -->
<script type="text/javascript">
	// setInterval(function(){
	// 	$.ajax({
	// 		url: '<?//=site_url('syslog/real-time-notify-booking')?>',
	// 		type: 'post',
	// 		dataType: 'json',
	// 		success:function(result){
	// 			var count = result.length;
	// 			for (var i = 0; i < count; i++) {
	// 				if (result[i].id > parseInt($('#get_notify_booking').attr('val'))) {
	// 					$('#get_notify_booking').attr('val',result[i].id);
	// 					notifyme('BookingID : VISA'+result[i].id);
	// 				}
	// 			}
	// 		}
	// 	});
	// },10000);
	// function notifyme(title,link=null){
	// 	if (Notification.permission !== "granted")
	// 		Notification.requestPermission();
	// 	else {
	// 		var notification = new Notification('You have new book', {
	// 			icon: '<?//=IMG_URL?>logo-120x120.jpg',
	// 			body: title,
	// 		});
	// 		if (link != null) {
	// 			notification.onclick = function () {
	// 				window.open(link);
	// 				notification.close();
	// 			};
	// 		}
	// 	}
	// }
</script>
<?// } ?>
<?
	function gen_category_menu($categories, $obj) {
		foreach ($categories as $category) {
			$child_category_info = new stdClass();
			$child_category_info->parent_id = $category->id;
			$child_categories = $obj->m_category->items($child_category_info);
			if (!empty($child_categories)) {
				echo '<li class="dropdown-submenu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$category->name.'</a>
						<ul class="dropdown-menu">';
						gen_category_menu($child_categories, $obj);
				echo '	</ul>
					</li>';
			} else {
				echo '<li><a href="'.site_url("syslog/content/{$category->alias}").'">'.$category->name.'</a></li>';
			}
		}
	}
?>
