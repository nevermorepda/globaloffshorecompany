<div class="banner" style="background-image: url('<?=IMG_URL?>banner_services_company.jpg')">
	<div class="container">
		<div style="display: table;"><i class="fas fa-angle-right"></i><h1>JURISDICTIONS</h1></div>
	</div>
</div>
<?
	$nations = $this->m_nation->items();
	$nation_regions = array();
	foreach ($nations as $nation) {
		if (!in_array($nation->region, $nation_regions)) {
			$nation_regions[] = $nation->region;
		}
	}
	sort($nation_regions);
?>
<div class="tabs-bar">
	<div class="container">
		<ul class="nav nav-tabs">
			<? foreach ($nation_regions as $nation_region) {?>
			<li class="nav-item">
				<a class="nav-link <?=($region == $nation_region) ? 'active' : ''?>" href="<?=site_url("jurisdictions/{$nation_region}")?>">
					<? if ($nation_region == 'america-carribean') {
							echo 'America - Carribean';
						} else {
							echo ucwords(str_replace('-',' ', $nation_region));
						}
					?>
				</a>
			</li>
			<? } ?>
		</ul>
	</div>
</div>
<div class="services-content">
	<div class="container">
		<div class="row">
			<? foreach ($items as $item) { ?>
			<div class="col-md-4">
				<a href="<?=site_url("jurisdictions/{$region}/{$item->alias}")?>">
					<div class="mer-item" style="border: 1px solid #b21f1f;">
						<div class="bg-item" style="background-image: url(<?=BASE_URL.$item->thumbnail?>);">
							<div class="info">
								<h5 class="title-item"><?=$item->name?></h5>
								<p>
								<?=$item->description?>
								</p>
<!-- 								<a href="" class="btn-viewmore">View more</a> -->
							</div>
						</div>
					</div>
				</a>
			</div>
			<? } ?>
		</div>
	</div>
</div>
<? require_once(APPPATH."views/module/resources.php"); ?>