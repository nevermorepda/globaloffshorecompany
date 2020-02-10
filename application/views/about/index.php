<div class="banner" style="background-image: url('<?=!empty($item->thumbnail) ? '.'.$item->thumbnail : IMG_URL.'banner_services_company.jpg'?>')">
	<div class="container">
		<div style="display: table;"><i class="fas fa-angle-right"></i><h1>ABOUT US</h1></div>
	</div>
</div>
<div class="cluster">
	<div class="container">
		<h4 class="title text-center"><?=$item->title?></h4>
		<div class="title-line">
			<div class="line">
				<img src="<?=IMG_URL?>title-icon.png" alt="">
			</div>
		</div>
		<div class="about-content">
			<?=$item->content?>
			<!-- <p>
				For more straightforward sizing in CSS, we switch the global box-sizing value from content-box to border-box. This ensures padding does not affect the final computed width of an element, but it can cause problems with some third party software like Google Maps and Google Custom Search Engine.<br>For more straightforward sizing in CSS, we switch the global box-sizing value from content-box to border-box. This ensures padding does not affect the final computed width of an element, but it can cause problems with some third party software like Google Maps and Google Custom Search Engine.
			</p>
			<div class="row">
				<div class="col-md-4">
					<i class="fab fa-schlix"></i><h6>This ensures padding does not affect the final</h6>
				</div>
				<div class="col-md-4">
					<i class="fab fa-schlix"></i><h6>This ensures padding does not affect the final</h6>
				</div>
				<div class="col-md-4">
					<i class="fab fa-schlix"></i><h6>This ensures padding does not affect the final</h6>
				</div>
				<div class="col-md-4">
					<i class="fab fa-schlix"></i><h6>This ensures padding does not affect the final</h6>
				</div>
				<div class="col-md-4">
					<i class="fab fa-schlix"></i><h6>This ensures padding does not affect the final</h6>
				</div>
				<div class="col-md-4">
					<i class="fab fa-schlix"></i><h6>This ensures padding does not affect the final</h6>
				</div>
			</div>
			<br>
			<img src="<?=IMG_URL?>img-about.png" class="img-responsive full-width" alt="Image"> -->
		</div>
	</div>
</div>
<? require_once(APPPATH."views/module/awards.php"); ?>
<? require_once(APPPATH."views/module/lisences.php"); ?>
<? require_once(APPPATH."views/module/why-us.php"); ?>
<? require_once(APPPATH."views/module/team.php"); ?>
<? require_once(APPPATH."views/module/resources.php"); ?>