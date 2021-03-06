<?
	$method = $this->util->slug($this->router->fetch_class());
	$info = new stdClass();
	$info->module = 'new';
	if ($method != 'our-services') {
		$info->jurisdiction_id = $item->jurisdiction_id;
		$module_items = $this->m_jurisdictions_resources->join_content_items($info);
	} else {
		$info->service_tab_id = $tab->id;
		$module_items = $this->m_services_resources->join_content_items($info);
	}
	$c = count($module_items);
?>
<div class=" d-none d-lg-block" id="<?=!empty($tab_detail->module) ? $tab_detail->module : ''?>">
	<div class="resources wrap-owl">
		<div class="container">
			<div style="position: relative;">
				<h4 class="title text-center">NEWS</h4>
				<div class="title-line">
					<div class="line">
						<img src="<?=IMG_URL?>title-icon.png" alt="">
					</div>
				</div>
				<ul class="control-owl">
					<li><i class="transition fas fa-angle-left"></i></li>
					<li><i class="transition fas fa-angle-right"></i></li>
				</ul>
				<? if(!empty($module_items)) { ?>
				<div class="owl-carousel owl-theme carousel-resources">
					<div class="item" data-merge="2">
						<div class="mer-item">
							<div class="bg-item" style="background-image: url(<?=BASE_URL.$module_items[0]->thumbnail?>);">
								<div class="info">
									<a href="<?=site_url("news/{$module_items[0]->alias}")?>">
										<h5 class="title-item"><?=$module_items[0]->title?></h5>
										<p>
										<?=word_limiter(strip_tags($module_items[0]->summary), 35)?>
										</p>
									</a>
									<a href="<?=site_url("news/{$module_items[0]->alias}")?>" class="btn-viewmore">View more</a>
									<div class="date">
										<label><?=date('d',strtotime($module_items[0]->created_date))?></label><br>
										<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($module_items[0]->created_date))?></label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<? for ($i=1; $i < $c; $i++) { ?>
					<div class="item">
						<a href="<?=site_url("news/{$module_items[$i]->alias}")?>">
							<div class="re-item">
								<div class="bg-re-item" style="background-image: url(<?=BASE_URL.$module_items[$i]->thumbnail?>);">
									<div class="date">
										<label><?=date('d',strtotime($module_items[1]->created_date))?></label><br>
										<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($module_items[1]->created_date))?></label>
									</div>
								</div>
							</div>
							<h5 class="title-re-item"><?=$module_items[$i]->title?></h5>
						</a>
						<a href="<?=site_url("news/{$module_items[$i]->alias}")?>" class="btn btn-viewmore">view more</a>
					</div>
					<? } ?>
				</div>
				<script type="text/javascript">
					var owlc = $('.carousel-resources');
					owlc.owlCarousel({
						items:5,
						merge:true,
						dots:false,
						autoplay: true,
						responsive:{
							0:{
								items:1
							},
							678:{
								mergeFit:true,
							},
							1000:{
								mergeFit:false
							}
						}
					});
					$('.resources .fa-angle-left').click(function() {
						owlc.trigger('prev.owl.carousel');
					});
					$('.resources .fa-angle-right').click(function() {
						owlc.trigger('next.owl.carousel');
					});
				</script>
				<? } ?>
			</div>
		</div>
	</div>
</div>