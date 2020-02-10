<?
	$category = $this->m_category->load(3);
	$info = new stdClass();
	$info->catid = $category->id;
	$awards = $this->m_content->items($info,1);
	$c = count($awards);
?>
<div class="d-none d-lg-block"  id="awards">
	<div class="resources wrap-owl">
		<div class="container">
			<div style="position: relative">
				<h4 class="title text-center">AWARDS</h4>
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
							<a href="<?=site_url("content/{$category->alias}/{$awards[0]->alias}")?>">
								<div class="bg-item" style="background-image: url(<?=BASE_URL.$awards[0]->thumbnail?>);">
									<div class="info">
											<h5 class="title-item"><?=$awards[0]->title?></h5>
											<p>
											<?=word_limiter(strip_tags($awards[0]->summary), 35)?>
											</p>
										<a href="#" class="btn-viewmore">View more</a>
									</div>
								</div>
							</a>
						</div>
					</div>
					<? for ($i=1; $i < $c; $i++) { ?>
					<div class="item">
						<a href="<?=site_url("content/{$category->alias}/{$awards[$i]->alias}")?>">
							<div class="re-item">
								<div class="bg-re-item" style="background-image: url(<?=BASE_URL.$awards[$i]->thumbnail?>);">
								</div>
							</div>
							<h5 class="title-re-item"><?=$awards[$i]->title?></h5>
							<a href="#" class="btn btn-viewmore">view more</a>
						</a>
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
					$('.carousel-resources .fa-angle-left').click(function() {
						owlc.trigger('prev.owl.carousel');
					});
					$('.carousel-resources .fa-angle-right').click(function() {
						owlc.trigger('next.owl.carousel');
					});
				</script>
			</div>
		</div>
	</div>
</div>