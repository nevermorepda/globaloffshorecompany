<div class="owl-slider">
	<div class="owl-carousel owl-theme banner-owl">
		<? $c_sliders = count($sliders); for ($i=0; $i < $c_sliders; $i++) { ?>
		<div class="item">
			<img src="<?=BASE_URL.$sliders[$i]->url_img?>" class="img-responsive" alt="<?=$sliders[$i]->name?>">
		</div>
		<? } ?>
	</div>
	<div class="d-none d-lg-block">
		<div class="bg-slider" style="left: -45px;">
			<div class="container">
				<div style="position: relative">
					<div class="row">
						<div class="col-md-7"></div>
						<div class="col-md-5">
							<div class="slider-text" style="width: 100%;padding: 250px 0;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-slider" style="left: -15px;">
			<div class="container">
				<div style="position: relative">
					<div class="row">
						<div class="col-md-7"></div>
						<div class="col-md-5">
							<div class="slider-text" style="width: 100%;padding: 250px 0;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-slider">
			<div class="container">
				<div style="position: relative">
					<div class="row">
						<div class="col-md-7"></div>
						<div class="col-md-5">
							<div class="slider-text">
								<h2 class="slide-title">The standard Lorem Ipsum <br> passage, used since the 1500s</h2>
								<p class="slide-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
								<a class="btn-getstarted">View more</a>
							</div>
						</div>
					</div>
					<ul class="control-owl-slider">
						<? for ($i=0; $i < $c_sliders; $i++) { ?>
						<li class="control-icon control-icon-<?=$i?> <?=($i==0) ? 'active' : ''?>" pos="<?=$i?>"></li>
						<? } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="d-block d-lg-none">
		<div class="bg-slider-mobile" style="">
			<div class="container">
				<div style="position: relative">
					<div class="row">
						<div class="col-md-6"></div>
						<div class="col-md-6">
							<div class="slider-text" style="width: 270px;padding: 250px 0;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-slider-mobile" style="">
			<div class="container">
				<div style="position: relative">
					<div class="row">
						<div class="col-md-6"></div>
						<div class="col-md-6">
							<div class="slider-text" style="width: 256px;padding: 250px 0;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-slider-mobile">
			<div class="container">
				<div style="position: relative">
					<div class="row">
						<div class="col-md-6"></div>
						<div class="col-md-6">
							<div class="slider-text">
								<h2 class="slide-title">The standard Lorem <br>Ipsum passage used <br>since the 1500s</h2>
							</div>
						</div>
					</div>
					<ul class="control-owl-slider">
						<? for ($i=0; $i < $c_sliders; $i++) { ?>
						<li class="control-icon control-icon-<?=$i?> <?=($i==0) ? 'active' : ''?>" pos="<?=$i?>"></li>
						<? } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var owl = $('.owl-slider .banner-owl');
		owl.owlCarousel({
			autoplay:true,
			dots:false,
			items:1
		});
		$('.control-owl-slider .control-icon').click(function() {
			var pos = parseInt($(this).attr('pos'));
			owl.trigger('to.owl.carousel',pos,1000);
		});
		owl.on('changed.owl.carousel', function(event) {
			var pos = event.item.index;
			$('.control-owl-slider > .control-icon').removeClass('active');
			$('.control-owl-slider > .control-icon-'+pos).addClass('active');
		});
	</script>
</div>
<div class="cluster">
	<div class="services">
		<div class="container">
			<h4 class="title text-center">OUR SERVICES</h4>
			<div class="title-line">
				<div class="line">
					<img src="<?=IMG_URL?>title-icon.png" alt="">
				</div>
			</div>
			<div class="d-none d-lg-block">
				<div class="row">
					<div class="col-md">
						<div class="wrap-item">
							<div class="item" st="0" item="0">
								<div class="warp-icon">
									<div class="icon"><i class="fas fa-building"></i></div>
									<div class="item-title">COMPANY<br>SERVICES</div>
								</div>
								<hr>
								<p><?=$services[0]->description?></p>
								<div class="view-more">
									<a class="btn btn-viewmore">view more</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md">
						<div class="wrap-item">
							<div class="item" st="0" item="1">
								<div class="warp-icon">
									<div class="icon"><i class="fas fa-university"></i></div>
									<div class="item-title">BANK<br>ACCOUNT</div>
								</div>
								<hr>
								<p><?=$services[1]->description?></p>
								<div class="view-more">
									<a class="btn btn-viewmore">view more</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md">
						<div class="wrap-item">
							<div class="item" st="0" item="2">
								<div class="warp-icon">
									<div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
									<div class="item-title">OFFICE<br>SERVICES</div>
								</div>
								<hr>
								<p><?=$services[2]->description?></p>
								<div class="view-more">
									<a class="btn btn-viewmore">view more</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md">
						<div class="wrap-item">
							<div class="item" st="0" item="3">
								<div class="warp-icon">
									<div class="icon"><i class="fas fa-calculator"></i></div>
									<div class="item-title">PROFESSIONAL<br>SERVICES</div>
								</div>
								<hr>
								<p><?=$services[3]->description?></p>
								<div class="view-more">
									<a class="btn btn-viewmore">view more</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md">
						<div class="wrap-item">
							<div class="item" st="0" item="4">
								<div class="warp-icon">
									<div class="icon"><i class="fas fa-atlas"></i></div>
									<div class="item-title">VISA AND<br>IMMIGRANT</div>
								</div>
								<hr>
								<p><?=$services[4]->description?></p>
								<div class="view-more">
									<a class="btn btn-viewmore">view more</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--------->
			<div class="info-service info-service-0"> 
				<div class="bg-info-service">
					<div class="info-service-title">
						<h5><?=$services[0]->name?></h5>
						<p>Global Offshore</p>
					</div>
					<p class="text">An offshore company is a company established in a country different than that of its beneficial owner’s residence. Having international leverage through diversification of companies in multiple jurisdictions will allow entrepreneurs to reap many of the offshore structures’ benefits. It can range from opportunities for global expansion to advantages inflexible tax planning, financial privacy, asset and wealth protection.</p>
					<?
						$info = new stdClass();
						$info->service_id = $services[0]->id;
						$service_one = $this->m_services_tabs->items($info);
						$c_service_one = count($service_one);
					?>
					<div class="row">
						<? for ($i=0; $i < $c_service_one; $i++) { ?>
						<div class="col-sm-4">
							<div class="info-item-child">
								<div style="display: table-cell;vertical-align: middle;width:43px">
									<img src="<?='.'.$service_one[$i]->icon_path?>" alt="<?=$service_one[$i]->name?>">
								</div>
								<div class="info-item">
									<a href="<?=site_url("our-services/{$services[0]->alias}/{$service_one[$i]->alias}")?>"><h6><?=$service_one[$i]->name?></h6></a>
								</div>
							</div>
						</div>
						<? } ?>
					</div>
				</div>
			</div>
			<div class="info-service info-service-1">
				<div class="bg-info-service">
					<div class="info-service-title">
						<h5><?=$services[1]->name?></h5>
						<p>Global Offshore</p>
					</div>
					<p class="text">Offshore banking is the establishment of bank accounts in a country different than that of your residence, preferably in any jurisdictions with banking laws favorable for foreigners, strict privacy laws and a strong, stable economy and government.</p>
					<?
						$info = new stdClass();
						$info->service_id = $services[1]->id;
						$service_two = $this->m_services_tabs->items($info);
						$c_service_two = count($service_two);
					?>
					<div class="bank-account">
						<div class="row">
							<? for ($i=0; $i < $c_service_two; $i++) { ?>
							<div class="col-sm-4">
								<img src="<?=IMG_URL?>list-icon.png" alt="">
								<a href="<?=site_url("our-services/{$services[1]->alias}/{$service_two[$i]->alias}")?>"><h6><?=$service_two[$i]->name?></h6></a>
							</div>
							<? } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="info-service info-service-2">
				<div class="bg-info-service">
					<div class="info-service-title">
						<h5><?=$services[2]->name?></h5>
						<p>Global Offshore</p>
					</div>
					<p class="text">Having a prestigious business address in a financial center area will greatly enhance your company's reputation, legitimacy, and an international platform to reach out to the global market.</p>
					<?
						$info = new stdClass();
						$info->service_id = $services[2]->id;
						$service_three = $this->m_services_tabs->items($info);
						$c_service_three = count($service_three);
					?>
					<div class="row">
						<? for ($i=0; $i < $c_service_three; $i++) { ?>
						<div class="col-sm-4">
							<div class="info-item-child">
								<div style="display: table-cell;vertical-align: middle;width:43px">
									<img src="<?='.'.$service_three[$i]->icon_path?>" alt="<?=$service_three[$i]->name?>">
								</div>
								<div class="info-item">
									<a href="<?=site_url("our-services/{$services[2]->alias}/{$service_three[$i]->alias}")?>"><h6><?=$service_three[$i]->name?></h6></a>
								</div>
							</div>
						</div>
						<? } ?>
					</div>
				</div>
			</div>
			<div class="info-service info-service-3">
				<div class="bg-info-service">
					<div class="info-service-title">
						<h5><?=$services[3]->name?></h5>
						<p>Global Offshore</p>
					</div>
					<p class="text">Having a prestigious business address in a financial center area will greatly enhance your company's reputation, legitimacy, and an international platform to reach out to the global market.</p>
					<?
						$info = new stdClass();
						$info->service_id = $services[3]->id;
						$service_four = $this->m_services_tabs->items($info);
						$c_service_four = count($service_four);
					?>
					<div class="row">
						<? for ($i=0; $i < $c_service_four; $i++) { ?>
						<div class="col-sm-4">
							<div class="info-item-child">
								<div style="display: table-cell;vertical-align: middle;width:43px">
									<img src="<?='.'.$service_four[$i]->icon_path?>" alt="<?=$service_four[$i]->name?>">
								</div>
								<div class="info-item">
									<a href="<?=site_url("our-services/{$services[3]->alias}/{$service_four[$i]->alias}")?>"><h6><?=$service_four[$i]->name?></h6></a>
								</div>
							</div>
						</div>
						<? } ?>
					</div>
				</div>
			</div>
			<div class="info-service info-service-4">
				<div class="bg-info-service">
					<div class="info-service-title">
						<h5><?=$services[4]->name?></h5>
						<p>Global Offshore</p>
					</div>
					<p class="text">In today's ever-changing and complex world, the demand for global mobility is greatly on the rise. Whether it is because of geopolitical stress, economic tensions, or quality of life, having multiple citizenships can dramatically increase your personal & economic freedom, expand your investment horizons, preserve your wealth and provide you access to endless new opportunities.</p>
					<?
						$info = new stdClass();
						$info->service_id = $services[4]->id;
						$service_five = $this->m_services_tabs->items($info);
						$c_service_five = count($service_five);
					?>
					<div class="row">
						<? for ($i=0; $i < $c_service_five; $i++) { ?>
						<div class="col-sm-4">
							<div class="info-item-child">
								<div style="display: table-cell;vertical-align: middle;width:43px">
									<img src="<?='.'.$service_five[$i]->icon_path?>" alt="<?=$service_five[$i]->name?>">
								</div>
								<div class="info-item">
									<a href="<?=site_url("our-services/{$services[4]->alias}/{$service_five[$i]->alias}")?>"><h6><?=$service_five[$i]->name?></h6></a>
								</div>
							</div>
						</div>
						<? } ?>
					</div>
				</div>
			</div>
			<!--------->
			<div class="d-block d-lg-none">
				<div class="wrap-item-mobile">
					<div class="item" st="0" item="0">
						<div class="bg-icon">
							<i class="fas fa-atlas"></i>
							<div class="item-title"><?=$services[0]->name?></div>
						</div>
						<i class="fas fa-angle-down"></i>
					</div>
					<div class="info-item info-item-0">
						<div class="info-item-bg">
							<div class="info-service-title">
								<h5><?=$services[0]->name?></h5>
								<p>Global Offshore</p>
							</div>
							<? for ($i=0; $i < $c_service_one; $i++) { ?>
							<div class="detail-item">
								<img src="<?=IMG_URL?>info-service-icon.png" alt="">
								<a href="<?=site_url("our-services/{$services[0]->alias}/{$service_one[$i]->alias}")?>"><h6><?=$service_one[$i]->name?></h6></a>
							</div>
							<? } ?>
						</div>
					</div>
				</div>
				<div class="wrap-item-mobile">
					<div class="item" st="0" item="1">
						<div class="bg-icon">
							<i class="fas fa-atlas"></i>
							<div class="item-title"><?=$services[1]->name?></div>
						</div>
						<i class="fas fa-angle-down"></i>
					</div>
					<div class="info-item info-item-1">
						<div class="info-item-bg">
							<div class="info-service-title">
								<h5><?=$services[1]->name?></h5>
								<p>Global Offshore</p>
							</div>
							<? for ($i=0; $i < $c_service_two; $i++) { ?>
							<div class="detail-item">
								<img src="<?=IMG_URL?>info-service-icon.png" alt="">
								<a href="<?=site_url("our-services/{$services[1]->alias}/{$service_two[$i]->alias}")?>"><h6><?=$service_two[$i]->name?></h6></a>
							</div>
							<? } ?>
						</div>
					</div>
				</div>
				<div class="wrap-item-mobile">
					<div class="item" st="0" item="2">
						<div class="bg-icon">
							<i class="fas fa-atlas"></i>
							<div class="item-title"><?=$services[2]->name?></div>
						</div>
						<i class="fas fa-angle-down"></i>
					</div>
					<div class="info-item info-item-2">
						<div class="info-item-bg">
							<div class="info-service-title">
								<h5><?=$services[2]->name?></h5>
								<p>Global Offshore</p>
							</div>
							<? for ($i=0; $i < $c_service_three; $i++) { ?>
							<div class="detail-item">
								<img src="<?=IMG_URL?>info-service-icon.png" alt="">
								<a href="<?=site_url("our-services/{$services[2]->alias}/{$service_three[$i]->alias}")?>"><h6><?=$service_three[$i]->name?></h6></a>
							</div>
							<? } ?>
						</div>
					</div>
				</div>
				<div class="wrap-item-mobile">
					<div class="item" st="0" item="3">
						<div class="bg-icon">
							<i class="fas fa-atlas"></i>
							<div class="item-title"><?=$services[3]->name?></div>
						</div>
						<i class="fas fa-angle-down"></i>
					</div>
					<div class="info-item info-item-3">
						<div class="info-item-bg">
							<div class="info-service-title">
								<h5><?=$services[3]->name?></h5>
								<p>Global Offshore</p>
							</div>
							<? for ($i=0; $i < $c_service_four; $i++) { ?>
							<div class="detail-item">
								<img src="<?=IMG_URL?>info-service-icon.png" alt="">
								<a href="<?=site_url("our-services/{$services[3]->alias}/{$service_four[$i]->alias}")?>"><h6><?=$service_four[$i]->name?></h6></a>
							</div>
							<? } ?>
						</div>
					</div>
				</div>
				<div class="wrap-item-mobile">
					<div class="item" st="0" item="4">
						<div class="bg-icon">
							<i class="fas fa-atlas"></i>
							<div class="item-title"><?=$services[4]->name?></div>
						</div>
						<i class="fas fa-angle-down"></i>
					</div>
					<div class="info-item info-item-4">
						<div class="info-item-bg">
							<div class="info-service-title">
								<h5><?=$services[4]->name?></h5>
								<p>Global Offshore</p>
							</div>
							<? for ($i=0; $i < $c_service_five; $i++) { ?>
							<div class="detail-item">
								<img src="<?=IMG_URL?>info-service-icon.png" alt="">
								<a href="<?=site_url("our-services/{$services[4]->alias}/{$service_five[$i]->alias}")?>"><h6><?=$service_five[$i]->name?></h6></a>
							</div>
							<? } ?>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$('.services .wrap-item .item').click(function(event) {
					var st = parseInt($(this).attr('st'));
					var item = $(this).attr('item');
					$('.services .wrap-item .item').removeClass('active');
					$('.services .wrap-item .item').attr('st',0);
					$('.info-service').css('display','none');
					if (st != 1) {
						$(this).addClass('active');
						$(this).attr('st',1);
						$('.info-service-'+item).css('display','block');
					}
				});
			</script>
			<script type="text/javascript">
				$('.services .wrap-item-mobile .item').click(function(event) {
					var st = parseInt($(this).attr('st'));
					var item = $(this).attr('item');
					$('.services .wrap-item-mobile .item').removeClass('active-mobile');
					$('.services .wrap-item-mobile .item').attr('st',0);
					$('.services .wrap-item-mobile .info-item').css('display','none');
					if (st != 1) {
						$(this).addClass('active-mobile');
						$(this).attr('st',1);
						$('.services .wrap-item-mobile .info-item-'+item).css('display','block');
					}
				});
			</script>
		</div>
	</div>
</div>
<? require_once(APPPATH."views/module/why-us.php"); ?>
<div class="cluster">
	<div class="jurisdictions">
		<div class="container">
			<h4 class="title text-center">JURISDICTIONS</h4>
			<div class="title-line">
				<div class="line">
					<img src="<?=IMG_URL?>title-icon.png" alt="">
				</div>
			</div>
			<div class="d-none d-lg-block wrap-pc">
				<div class="row">
					<div class="col-md">
						<div class="item" st="0" item="0" style="background-image: url(<?=IMG_URL?>region/300xasia-pacific.jpg);">
							<div class="item-title">ASIA PACIFIC <hr></div>
							<div class="view-more">
								<a class="btn btn-viewmore">view more</a>
							</div>
						</div>
					</div>
					<div class="col-md">
						<div class="item" st="0" item="1" style="background-image: url(<?=IMG_URL?>region/300xeurope.jpg);">
							<div class="item-title">EUROPE <hr></div>
							<div class="view-more">
								<a class="btn btn-viewmore">view more</a>
							</div>
						</div>
					</div>
					<div class="col-md">
						<div class="item" st="0" item="2" style="background-image: url(<?=IMG_URL?>region/300xamerica-carribean.jpg);">
							<div class="item-title">AMERICA - CARIBBEAN<hr></div>
							<div class="view-more">
								<a class="btn btn-viewmore">view more</a>
							</div>
						</div>
					</div>
					<div class="col-md">
						<div class="item" st="0" item="3" style="background-image: url(<?=IMG_URL?>region/300xmiddle-east.jpg);">
							<div class="item-title">MIDDLE EAST <hr></div>
							<div class="view-more">
								<a class="btn btn-viewmore">view more</a>
							</div>
						</div>
					</div>
					<div class="col-md">
						<div class="item" st="0" item="4" style="background-image: url(<?=IMG_URL?>region/300xafrica.jpg);">
							<div class="item-title">AFRICA <hr></div>
							<div class="view-more">
								<a class="btn btn-viewmore">view more</a>
							</div>
						</div>
					</div>
				</div>
				<!--------->
				<div class="info-jurisdictions info-jurisdictions-0" style="background-image: url(<?=IMG_URL?>region/asia-pacific.jpg);">
					<div class="bg-info-jurisdictions">
						<div class="info-jurisdictions-title">
							<h5>ASIA PACIFIC</h5>
							<p>Global Offshore</p>
						</div>
						<?
							$info = new stdClass();
							$info->region = 'asia-pacific';
							$items = $this->m_jurisdictions->items($info);
						?>
						<div class="row">
							<? foreach ($items as $item) { ?>
							<div class="col-md-6">
								<a href="<?=site_url("jurisdictions/{$item->region}/{$item->alias}")?>">
									<div class="child-item">
										<img src="<?=IMG_URL?>flag/<?=$item->alias?>.svg" alt="<?=$item->name?>">
										<div class="info">
											<h6><?=$item->name?></h6>
											<p><?=$item->description?></p>
										</div>
									</div>
								</a>
							</div>
							<? } ?>
						</div>
					</div>
				</div>
				<div class="info-jurisdictions info-jurisdictions-1" style="background-image: url(<?=IMG_URL?>region/europe.jpg);">
					<div class="bg-info-jurisdictions">
						<div class="info-jurisdictions-title">
							<h5>EUROPE</h5>
							<p>Global Offshore</p>
						</div>
						<?
							$info = new stdClass();
							$info->region = 'europe';
							$items = $this->m_jurisdictions->items($info);
						?>
						<div class="row">
							<? foreach ($items as $item) { ?>
							<div class="col-md-6">
								<a href="<?=site_url("jurisdictions/{$item->region}/{$item->alias}")?>">
									<div class="child-item">
										<img src="<?=IMG_URL?>flag/<?=$item->alias?>.svg" alt="<?=$item->name?>">
										<div class="info">
											<h6><?=$item->name?></h6>
											<p><?=$item->description?></p>
										</div>
									</div>
								</a>
							</div>
							<? } ?>
						</div>
					</div>
				</div>
				<div class="info-jurisdictions info-jurisdictions-2" style="background-image: url(<?=IMG_URL?>region/america-carribean.jpg);">
					<div class="bg-info-jurisdictions">
						<div class="info-jurisdictions-title">
							<h5>AMERICA - CARIBBEAN</h5>
							<p>Global Offshore</p>
						</div>
						<?
							$info = new stdClass();
							$info->region = 'america-carribean';
							$items = $this->m_jurisdictions->items($info);
						?>
						<div class="row">
							<? foreach ($items as $item) { ?>
							<div class="col-md-6">
								<a href="<?=site_url("jurisdictions/{$item->region}/{$item->alias}")?>">
									<div class="child-item">
										<img src="<?=IMG_URL?>flag/<?=$item->alias?>.svg" alt="<?=$item->name?>">
										<div class="info">
											<h6><?=$item->name?></h6>
											<p><?=$item->description?></p>
										</div>
									</div>
								</a>
							</div>
							<? } ?>
						</div>
					</div>
				</div>
				<div class="info-jurisdictions info-jurisdictions-3" style="background-image: url(<?=IMG_URL?>region/middle-east.jpg);">
					<div class="bg-info-jurisdictions">
						<div class="info-jurisdictions-title">
							<h5>MIDDLE EAST</h5>
							<p>Global Offshore</p>
						</div>
						<?
							$info = new stdClass();
							$info->region = 'middle-east';
							$items = $this->m_jurisdictions->items($info);
						?>
						<div class="row">
							<? foreach ($items as $item) { ?>
							<div class="col-md-6">
								<a href="<?=site_url("jurisdictions/{$item->region}/{$item->alias}")?>">
									<div class="child-item">
										<img src="<?=IMG_URL?>flag/<?=$item->alias?>.svg" alt="<?=$item->name?>">
										<div class="info">
											<h6><?=$item->name?></h6>
											<p><?=$item->description?></p>
										</div>
									</div>
								</a>
							</div>
							<? } ?>
						</div>
					</div>
				</div>
				<div class="info-jurisdictions info-jurisdictions-4" style="background-image: url(<?=IMG_URL?>region/africa.jpg);">
					<div class="bg-info-jurisdictions">
						<div class="info-jurisdictions-title">
							<h5>AFRICA</h5>
							<p>Global Offshore</p>
						</div>
						<?
							$info = new stdClass();
							$info->region = 'africa';
							$items = $this->m_jurisdictions->items($info);
						?>
						<div class="row">
							<? foreach ($items as $item) { ?>
							<div class="col-md-6">
								<a href="<?=site_url("jurisdictions/{$item->region}/{$item->alias}")?>">
									<div class="child-item">
										<img src="<?=IMG_URL?>flag/<?=$item->alias?>.svg" alt="<?=$item->name?>">
										<div class="info">
											<h6><?=$item->name?></h6>
											<p><?=$item->description?></p>
										</div>
									</div>
								</a>
							</div>
							<? } ?>
						</div>
					</div>
				</div>
			</div>
			<!--------->
			<script type="text/javascript">
				$('.jurisdictions .item').click(function(event) {
					var st = parseInt($(this).attr('st'));
					var item = $(this).attr('item');
					$('.jurisdictions .item').removeClass('active');
					$('.jurisdictions .item').attr('st',0);
					$('.info-jurisdictions').css('display','none');
					if (st != 1) {
						$(this).addClass('active');
						$(this).attr('st',1);
						$('.info-jurisdictions-'+item).css('display','block');
					}
				});
			</script>
			<div class="d-block d-lg-none">
				<div class="wrap-item-mobile">
					<div class="item" st="0" item="0">
						<div class="bg-icon">
							<div class="item-title">COMPANY SERVICES</div>
						</div>
						<i class="fas fa-angle-down"></i>
					</div>
					<div class="info-item info-item-0">
						<div class="info-item-bg">
							<div class="info-service-title">
								<h5>COMPANY SERVICES</h5>
								<p>Global Offshore</p>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Hong Kong</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Singapore</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Japan</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Thailand</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Korea</h6>
							</div>
						</div>
					</div>
				</div>
				<div class="wrap-item-mobile">
					<div class="item" st="0" item="1">
						<div class="bg-icon">
							<div class="item-title">COMPANY SERVICES</div>
						</div>
						<i class="fas fa-angle-down"></i>
					</div>
					<div class="info-item info-item-1">
						<div class="info-item-bg">
							<div class="info-service-title">
								<h5>COMPANY SERVICES</h5>
								<p>Global Offshore</p>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Hong Kong</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Singapore</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Japan</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Thailand</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Korea</h6>
							</div>
						</div>
					</div>
				</div>
				<div class="wrap-item-mobile">
					<div class="item" st="0" item="2">
						<div class="bg-icon">
							<div class="item-title">COMPANY SERVICES</div>
						</div>
						<i class="fas fa-angle-down"></i>
					</div>
					<div class="info-item info-item-2">
						<div class="info-item-bg">
							<div class="info-service-title">
								<h5>COMPANY SERVICES</h5>
								<p>Global Offshore</p>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Hong Kong</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Singapore</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Japan</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Thailand</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Korea</h6>
							</div>
						</div>
					</div>
				</div>
				<div class="wrap-item-mobile">
					<div class="item" st="0" item="3">
						<div class="bg-icon">
							<div class="item-title">COMPANY SERVICES</div>
						</div>
						<i class="fas fa-angle-down"></i>
					</div>
					<div class="info-item info-item-3">
						<div class="info-item-bg">
							<div class="info-service-title">
								<h5>COMPANY SERVICES</h5>
								<p>Global Offshore</p>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Hong Kong</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Singapore</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Japan</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Thailand</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Korea</h6>
							</div>
						</div>
					</div>
				</div>
				<div class="wrap-item-mobile">
					<div class="item" st="0" item="4">
						<div class="bg-icon">
							<div class="item-title">COMPANY SERVICES</div>
						</div>
						<i class="fas fa-angle-down"></i>
					</div>
					<div class="info-item info-item-4">
						<div class="info-item-bg">
							<div class="info-service-title">
								<h5>COMPANY SERVICES</h5>
								<p>Global Offshore</p>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Hong Kong</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Singapore</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Japan</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Thailand</h6>
							</div>
							<div class="detail-item">
								<img src="<?=IMG_URL?>glas.png" alt="">
								<h6>Korea</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$('.jurisdictions .wrap-item-mobile .item').click(function(event) {
					var st = parseInt($(this).attr('st'));
					var item = $(this).attr('item');
					$('.jurisdictions .wrap-item-mobile .item').removeClass('active-mobile');
					$('.jurisdictions .wrap-item-mobile .item').attr('st',0);
					$('.jurisdictions .wrap-item-mobile .info-item').css('display','none');
					if (st != 1) {
						$(this).addClass('active-mobile');
						$(this).attr('st',1);
						$('.jurisdictions .wrap-item-mobile .info-item-'+item).css('display','block');
					}
				});
			</script>
		</div>
	</div>
</div>
<? require_once(APPPATH."views/module/resources.php"); ?>