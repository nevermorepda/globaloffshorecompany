<?
	$category = $this->m_category->load(4);
	$info = new stdClass();
	$info->catid = $category->id;
	$lisences = $this->m_content->items($info,1);
	$c = count($lisences);
?>
<div class=" d-none d-lg-block" id="<?=!empty($tab_detail->module) ? $tab_detail->module : ''?>">
	<div class="wrap-owl wrap-owl-1">
		<div class="container">
			<div style="position: relative">
				<h4 class="title text-center">LISENCES</h4>
				<div class="title-line">
					<div class="line">
						<img src="<?=IMG_URL?>title-icon.png" alt="">
					</div>
				</div>
				<ul class="control-owl">
					<li><i class="transition fas fa-angle-left"></i></li>
					<li><i class="transition fas fa-angle-right"></i></li>
				</ul>
				<div class="owl-carousel owl-theme carousel-resources-1">
					<div class="item" data-merge="2">
						<div class="mer-item" style="border: 1px solid #b21f1f;">
							<a href="<?=site_url("content/{$category->alias}/{$lisences[0]->alias}")?>">
								<div class="bg-item" style="background-image: url(<?='.'.$lisences[0]->thumbnail?>);">
									<div class="info">
										<h5 class="title-item"><?=$lisences[0]->title?></h5>
										<p>
										<?=word_limiter(strip_tags($lisences[0]->summary), 35)?>
										</p>
										<a href="#" class="btn-viewmore">View more</a>
									</div>
								</div>
							</a>
						</div>
					</div>
					<? for ($i=1; $i < $c; $i++) { ?>
					<div class="item">
						<a href="<?=site_url("content/{$category->alias}/{$lisences[$i]->alias}")?>">
							<div class="re-item">
								<div class="bg-re-item" style="background-image: url(<?='.'.$lisences[$i]->thumbnail?>);">
								</div>
							</div>
							<h5 class="title-re-item"><?=$lisences[$i]->title?></h5>
							<a href="#" class="btn btn-viewmore">view more</a>
						</a>
					</div>
					<? } ?>
				</div>
				<script type="text/javascript">
					var owlc1 = $('.carousel-resources-1');
					owlc1.owlCarousel({
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
					$('.wrap-owl-1 .fa-angle-left').click(function() { console.log(1);
						owlc1.trigger('prev.owl.carousel');
					});
					$('.wrap-owl-1 .fa-angle-right').click(function() { console.log(2);
						owlc1.trigger('next.owl.carousel');
					});
				</script>
			</div>
		</div>
	</div>
</div>