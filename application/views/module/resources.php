<?
	$info = new stdClass();
	$info->catid = 2;
	$resources = $this->m_content->items($info,1,6);
	$c = count($resources);
?>
<div class=" d-none d-lg-block" id="<?=!empty($tab_detail->module) ? $tab_detail->module : ''?>">
	<div class="resources wrap-owl">
		<div class="container">
			<div style="position: relative;">
				<h4 class="title text-center">RESOURCES</h4>
				<div class="title-line">
					<div class="line">
						<img src="<?=IMG_URL?>title-icon.png" alt="">
					</div>
				</div>
				<ul class="control-owl">
					<li><i class="transition fas fa-angle-left"></i></li>
					<li><i class="transition fas fa-angle-right"></i></li>
				</ul>
				<div class="owl-carousel owl-theme carousel-resources">
					<div class="item" data-merge="2">
						<div class="mer-item">
							<div class="bg-item" style="background-image: url(<?=BASE_URL.$resources[0]->thumbnail?>);">
								<div class="info">
									<a href="">
										<h5 class="title-item"><?=$resources[0]->title?></h5>
										<p>
										<?=word_limiter(strip_tags($resources[0]->summary), 35)?>
										</p>
									</a>
									<a href="./resources-detail.html" class="btn-viewmore">View more</a>
									<div class="date">
										<label><?=date('d',strtotime($resources[0]->created_date))?></label><br>
										<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($resources[0]->created_date))?></label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<? for ($i=1; $i < $c; $i++) { ?>
					<div class="item">
						<a href="">
							<div class="re-item">
								<div class="bg-re-item" style="background-image: url(<?=BASE_URL.$resources[$i]->thumbnail?>);">
									<div class="date">
										<label><?=date('d',strtotime($resources[1]->created_date))?></label><br>
										<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($resources[1]->created_date))?></label>
									</div>
								</div>
							</div>
							<h5 class="title-re-item"><?=$resources[$i]->title?></h5>
						</a>
						<a href="./resources-detail.html" class="btn btn-viewmore">view more</a>
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
			</div>
		</div>
	</div>
</div>