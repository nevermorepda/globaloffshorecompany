<?
	$tabindex = !empty($tabindex) ? $tabindex : "home";
	if ($this->session->userdata("user")) {
		$user = $this->session->userdata("user");
	}
	$services = $this->m_services->items();
	$arr_icon = array('fa-building','fa-university','fa-chalkboard-teacher','fa-calculator','fa-atlas');
	$setting = $this->m_setting->load(1);
?>
<div class="header-top">
	<div class="bg-header-top">
		<div class="container">
			<div class="clearfix" style="position: relative">
				<ul class="float-left">
					<li>
						<a href="tel:<?=$setting->company_hotline_vn?>" class="d-none d-lg-block">
							<i class="fas fa-phone"></i> <?=$setting->company_hotline_vn?>
						</a>
					</li>
					<!-- <li>
						<a href="" class="d-none d-lg-block">
							<i class="fab fa-skype"></i> Global Offshore
						</a>
					</li> -->
				</ul>
				<ul class="float-right">
					<li>
						<a href="" class="d-none d-lg-block">
							<i class="fas fa-search"></i> Search
						</a>
					</li>
					<li>
						<a class="btn-get-started" href="<?=site_url('apply-company-services')?>">
							GET STARTED NOW
						</a>
					</li>
					<? if (!empty($user)) { ?>
					<li class="nav-myaccount">
						<a href="#">
							<i class="fas fa-user-tie"></i> <?=$user->user_fullname?>
						</a>
					</li>
					<? } else { ?>
					<li>
						<a href="<?=site_url("member")?>">
							<i class="fas fa-user-tie"></i> Sign in
						</a>
					</li>
					<? } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="wrap-sub-myaccount">
		<ul class="sub-myaccount">
			<li><a href="<?=site_url("member")?>"><i class="fas fa-user-tie"></i> My account</a></li>
			<li><a href="<?=site_url("member/logout")?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
		</ul>
	</div>
</div>
<script type="text/javascript">
	$(".nav-myaccount").mouseenter(function() {
		$('.wrap-sub-myaccount').css('display', 'block');
	}).mouseleave(function() {
		$('.wrap-sub-myaccount').css('display', 'none');
	});
	$(".wrap-sub-myaccount").mouseenter(function() {
		$(this).css('display', 'block');
	}).mouseleave(function() {
		$(this).css('display', 'none');
	});
</script>
<div class="menu" <?=(in_array($this->util->slug($this->router->fetch_class()),array('apply-company-services','member')) ? 'style="border-bottom: 3px solid #b21f1f;"' : '')?>>
	<div class="container">
		<div class="clearfix">
			<a href="<?=BASE_URL?>"><img src="<?=IMG_URL?>logo.png" class="float-left logo" alt=""></a>
			<div class="d-none d-lg-block">
				<ul class="nav justify-content-end float-right " style="display: inline-flex;">
					<li class="nav-item">
						<a class="nav-link transition active" href="<?=site_url("about-us")?>">ABOUT US</a>
					</li>
					<li class="nav-item wrap-menu">
						<a class="nav-link transition">OUR SERVICES <i class="fas fa-caret-down"></i></a>
						<div class="wrap-menu-sub">
							<ul class="menu-services sub-menu">
								<? $i=0; foreach ($services as $service) { ?>
								<li class="sub-item"><a href="<?=site_url("our-services/{$service->alias}")?>">
									<div class="sub-menu-icon"><i class="fas <?=$arr_icon[$i]?>"></i></div>
									<div class="sub-menu-title"><?=$service->name?></div>
								</a></li>
								<? $i++;} ?>
							</ul>
						</div>
					</li>
					<li class="nav-item wrap-menu">
						<a class="nav-link transition">JURISDICTIONS <i class="fas fa-caret-down"></i></a>
						<div class="wrap-menu-sub">
							<ul class="menu-jurisdictions sub-menu">
								<li class="sub-item"><a href="<?=site_url("jurisdictions/asia-pacific")?>">
									<div class="bg-menu-sub" style="background-image: url('<?=IMG_URL?>region/300xasia-pacific.jpg');">
										<div class="sub-menu-title"><h5>ASIA PACIFIC</h5></div>
									</div>
								</a></li>
								<li class="sub-item"><a href="<?=site_url("jurisdictions/europe")?>">
									<div class="bg-menu-sub" style="background-image: url('<?=IMG_URL?>region/300xeurope.jpg');">
										<div class="sub-menu-title"><h5>EUROPE</h5></div>
									</div>
								</a></li>
								<li class="sub-item"><a href="<?=site_url("jurisdictions/america-caribbean")?>">
									<div class="bg-menu-sub" style="background-image: url('<?=IMG_URL?>region/300xamerica-carribean.jpg');">
										<div class="sub-menu-title"><h5>AMERICA - CARIBBEAN</h5></div>
									</div>
								</a></li>
								<li class="sub-item"><a href="<?=site_url("jurisdictions/middle-east")?>">
									<div class="bg-menu-sub" style="background-image: url('<?=IMG_URL?>region/300xmiddle-east.jpg');">
										<div class="sub-menu-title"><h5>MIDDLE EAST</h5></div>
									</div>
								</a></li>
								<li class="sub-item"><a href="<?=site_url("jurisdictions/africa")?>">
									<div class="bg-menu-sub" style="background-image: url('<?=IMG_URL?>region/300xafrica.jpg');">
										<div class="sub-menu-title"><h5>AFRICA</h5></div>
									</div>
								</a></li>
							</ul>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link transition" href="<?=site_url("contact")?>">CONTACT US</a>
					</li>
					<li class="nav-item nav-resources">
						<a class="nav-link transition">RESOURCES</a>
						<ul class="sub-resources">
							<li >
								<a href="<?=site_url("news")?>" class="transition">
									NEWS
								</a>
							</li>
							<li>
								<a href="<?=site_url("faqs")?>" class="transition">
									FAQS
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="float-right control-menu d-block d-lg-none"><i stt="0" class="fas fa-bars"></i> <i class="fas fa-search"></i></div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(window).scroll(function() {
		$scroll = $(window).scrollTop();
		if ($scroll > 150){
			$('.menu').addClass('menu-croll');
		} else {
			$('.menu').removeClass('menu-croll');
		}
	});
</script>
<div id="target-menu" class="menu-mobile transition d-block d-lg-none menu-off">
	<div class="bg-menu-mobile">
		<ul class="menu-list">
			<li class="item"><a href="<?=site_url("about-us")?>">ABOUT US</a></li>
			<li class="menu-child item" st="0">
				<a>OUR SERVICES</a>
				<ul class="sub-menu">
					<? foreach ($services as $service) { ?>
					<li class="sub-item"><a href="<?=site_url("our-services/{$service->alias}")?>"><?=$service->name?></a></li>
					<? } ?>
				</ul>
				<i class="fas fa-angle-down"></i>
			</li>
			<li class="menu-child item " st="0">
				<a>JURISDICTIONS</a>
				<ul class="sub-menu">
					<li class="sub-item"><a href="<?=site_url("jurisdictions/asia-pacific")?>">ASIA PACIFIC</a></li>
					<li class="sub-item"><a href="<?=site_url("jurisdictions/europe")?>">EUROPE</a></li>
					<li class="sub-item "><a href="<?=site_url("jurisdictions/america-caribbean")?>">AMERICA - CARIBBEAN</a></li>
					<li class="sub-item "><a href="<?=site_url("jurisdictions/middle-east")?>">MIDDLE EAST</a></li>
					<li class="sub-item "><a href="<?=site_url("jurisdictions/africa")?>">AFRICA</a></li>
				</ul>
				<i class="fas fa-angle-down"></i>
			</li>
			<li class="item "><a class="nav-link transition" href="<?=site_url("contact")?>">CONTACT US</a></li>
			<li class="menu-child item " st="0">
				<a>RESOURCES</a>
				<ul class="sub-menu">
					<li class="sub-item"><a href="<?=site_url("news")?>">NEWS</a></li>
					<li class="sub-item"><a href="<?=site_url("faqs")?>">FAQS</a></li>
				</ul>
				<i class="fas fa-angle-down"></i>
			</li>
		</ul>
		<div class="line-menu-mobile"></div>
		<div class="mobile-contact">
			<a href="">
				<i class="fab fa-skype"></i> Global Offshore
			</a>
			<a href="">
				<i class="fas fa-phone"></i> +1234567890
			</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#target-menu .menu-child').click(function(event) {
		var st = parseInt($(this).attr('st'));
		$('#target-menu .menu-child').removeClass('active');
		$('#target-menu .menu-child').attr('st',0);
		if (st == 0) {
			$(this).attr('st',1);
			$(this).addClass('active');
		}
	});
	$('.control-menu > .fa-bars').click(function(event) {
		var st = parseInt($(this).attr('stt'));
		if (st == 0) {
			$('.menu-mobile').removeClass('menu-off');
			$('.menu-mobile').addClass('menu-on');
			$(this).attr('stt',1);
		} else {
			$('.menu-mobile').removeClass('menu-on');
			$('.menu-mobile').addClass('menu-off');
			$(this).attr('stt',0);
		}
	});
	document.onclick = function (e) {
		if ($(e.target).is('#target-menu')) {
			$('.menu-mobile').removeClass('menu-on');
			$('.menu-mobile').addClass('menu-off');
			$('.control-menu > a').attr('stt',0);
		}
	};
	var screen = $(document).width();
	if (screen < 992) {
		$('header').css('position', 'fixed');
	} else {
		$('header').css('position', 'relative');
	}
</script>
