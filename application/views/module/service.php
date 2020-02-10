<?
	$service_items = $this->m_services->items();
?>
<div class="service-jurisdiction" id="<?=!empty($tab_detail->module) ? $tab_detail->module : ''?>">
	<div class="container">
		<div class="wrap-title select-tab title-status-<?=$i?>" stt="<?=$i?>" status="<?=!empty($tab_detail->open) ? '-' : '+'?>">
			<div class="hide-show hide-show-<?=$i?>">
				<?=!empty($tab_detail->open) ? '<i class="fas fa-minus"></i>' : '<i class="fas fa-plus"></i>'?>
			</div>
			<i class="fas fa-quote-left"></i>
			<h4 class="content-title">Services</h4>
		</div>
		<div class="tonggle-content tonggle-<?=$i?>" <?=!empty($tab_detail->open) ? 'style="display: block;"' : ''?>>
			<p>For faster mobile-friendly development, use responsive display classes for showing and hiding elements by device. Avoid creating entirely different versions of the same site, instead hide element responsively for each screen size. instead hide element responsively for each screen size. instead hide element responsively for each screen size. instead hide element responsively for each screen size.</p>
			<div class="row">
				<? foreach ($service_items as $service_item) {
					$jurisdiction_id = !empty($tab_detail->jurisdiction_id) ? $tab_detail->jurisdiction_id : $item->jurisdiction_id;
					$check_service = $this->m_jurisdiction_services->item($jurisdiction_id,$service_item->id);
					if (!empty($check_service)) {
					$nation_alias = !empty($item->alias) ? $item->alias : $nation->alias;
				?>
				<div class="col-md-4">
					<a href="<?=site_url("our-services/{$service_item->alias}/jurisdictions/{$nation_alias}")?>">
						<div class="item">
							<img src="<?=IMG_URL.'service-item.PNG'?>" alt="">
							<div class="service-name"><?=$service_item->name?></div>
						</div>
					</a>
				</div>
				<? } } ?>
			</div>
		</div>
	</div>
</div>