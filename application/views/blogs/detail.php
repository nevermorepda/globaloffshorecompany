<div class="banner" style="background-image: url('<?=IMG_URL?>banner_services_company.jpg')">
	<div class="container">
		<h2><?=$title?></h2>
		<div style="display: table;"><i class="fas fa-angle-right"></i><h1><?=$item->title?></h1></div>
	</div>
</div>
<div class="cluster">
	<div class="container">
		<div class="wrap-title">
			<i class="fas fa-quote-left"></i>
			<h4 class="content-title"><?=$item->title?></h4>
		</div>
		<div class="resources-detail">
			<?=$item->content?>
			<!-- <div class="row">
				<div class="col-md-6"><img src="<?=IMG_URL?>img-over-bank.png" class='full-width' alt=""></div>
				<div class="col-md-6">
					<p>Not only has the charming and majestic scenery of a pagoda located in the middle of the mountains in Ninh Binh, but Bai Dinh pagoda is also the most beautiful and has many records pagoda in Vietnam. This is the largest temple in Vietnam and to visit all, you can take from 3-4 hours. The pagoda has a large main hall, a high tower, and countless Arhat statues, the temple architecture is extremely delicate, leaving many impressions in the hearts of visitors</p>
					<p>Not only has the charming and majestic scenery of a pagoda located in the middle of the mountains in Ninh Binh, but Bai Dinh pagoda is also the most beautiful and has many records pagoda in Vietnam. This is the largest temple in Vietnam and to visit all, you can take from 3-4 hours. The pagoda has a large main hall, a high tower, and countless Arhat statues, the temple architecture is extremely delicate, leaving many impressions in the hearts of visitors.</p>
				</div>
			</div>
			<p>Not only has the charming and majestic scenery of a pagoda located in the middle of the mountains in Ninh Binh, but Bai Dinh pagoda is also the most beautiful and has many records pagoda in Vietnam. This is the largest temple in Vietnam and to visit all, you can take from 3-4 hours. The pagoda has a large main hall, a high tower, and countless Arhat statues, the temple architecture is extremely delicate, leaving many impressions in the hearts of visitors.</p>
			<p>Not only has the charming and majestic scenery of a pagoda located in the middle of the mountains in Ninh Binh, but Bai Dinh pagoda is also the most beautiful and has many records pagoda in Vietnam. This is the largest temple in Vietnam and to visit all, you can take from 3-4 hours. The pagoda has a large main hall, a high tower, and countless Arhat statues, the temple architecture is extremely delicate, leaving many impressions in the hearts of visitors.</p>
			<p>Not only has the charming and majestic scenery of a pagoda located in the middle of the mountains in Ninh Binh, but Bai Dinh pagoda is also the most beautiful and has many records pagoda in Vietnam. This is the largest temple in Vietnam and to visit all, you can take from 3-4 hours. The pagoda has a large main hall, a high tower, and countless Arhat statues, the temple architecture is extremely delicate, leaving many impressions in the hearts of visitors.</p>
			<p>Not only has the charming and majestic scenery of a pagoda located in the middle of the mountains in Ninh Binh, but Bai Dinh pagoda is also the most beautiful and has many records pagoda in Vietnam. This is the largest temple in Vietnam and to visit all, you can take from 3-4 hours. The pagoda has a large main hall, a high tower, and countless Arhat statues, the temple architecture is extremely delicate, leaving many impressions in the hearts of visitors.</p>
			<p>Not only has the charming and majestic scenery of a pagoda located in the middle of the mountains in Ninh Binh, but Bai Dinh pagoda is also the most beautiful and has many records pagoda in Vietnam. This is the largest temple in Vietnam and to visit all, you can take from 3-4 hours. The pagoda has a large main hall, a high tower, and countless Arhat statues, the temple architecture is extremely delicate, leaving many impressions in the hearts of visitors.</p>
			<div class="row">
				<div class="col-md-6">
					<p>Not only has the charming and majestic scenery of a pagoda located in the middle of the mountains in Ninh Binh, but Bai Dinh pagoda is also the most beautiful and has many records pagoda in Vietnam. This is the largest temple in Vietnam and to visit all, you can take from 3-4 hours. The pagoda has a large main hall, a high tower, and countless Arhat statues, the temple architecture is extremely delicate, leaving many impressions in the hearts of visitors</p>
					<p>Not only has the charming and majestic scenery of a pagoda located in the middle of the mountains in Ninh Binh, but Bai Dinh pagoda is also the most beautiful and has many records pagoda in Vietnam. This is the largest temple in Vietnam and to visit all, you can take from 3-4 hours. The pagoda has a large main hall, a high tower, and countless Arhat statues, the temple architecture is extremely delicate, leaving many impressions in the hearts of visitors.</p>
				</div>
				<div class="col-md-6"><img src="<?=IMG_URL?>img-over-bank.png" class='full-width' alt=""></div>
			</div> -->
		</div>
	</div>
</div>
<div class="cluster d-none d-lg-block">
	<div class="resources wrap-owl">
		<div class="container">
			<div style="position: relative">
				<h4 class="title text-center">OTHER RELATED RESOURCES</h4>
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
					<? $c_relateditems = count($relateditems); ?>
					<div class="item" data-merge="2">
						<div class="mer-item">
							<a href="<?=site_url("blogs/{$type}/{$relateditems[0]->alias}")?>">
								<div class="bg-item" style="background-image: url(<?=BASE_URL.$relateditems[0]->thumbnail?>);">
									<div class="info">
										<h5 class="title-item"><?=$relateditems[0]->title?></h5>
										<p>
											<?=word_limiter(strip_tags($relateditems[0]->summary),20)?>
										</p>
										<a href="<?=site_url("blogs/{$type}/{$relateditems[0]->alias}")?>" class="btn-viewmore">View more</a>
										<div class="date">
											<label><?=date('d',strtotime($relateditems[0]->created_date))?></label><br>
											<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($relateditems[0]->created_date))?></label>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<? for ($i=1; $i < $c_relateditems; $i++) { ?>
					<div class="item">
						<a href="<?=site_url("blogs/{$type}/{$relateditems[$i]->alias}")?>">
							<div class="re-item border-red">
								<div class="bg-re-item" style="background-image: url(<?=BASE_URL.$relateditems[$i]->thumbnail?>);">
									<div class="date">
										<label><?=date('d',strtotime($relateditems[$i]->created_date))?></label><br>
										<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($relateditems[$i]->created_date))?></label>
									</div>
								</div>
							</div>
							<h5 class="title-re-item"><?=$relateditems[$i]->title?></h5>
							<a href="<?=site_url("blogs/{$type}/{$relateditems[$i]->alias}")?>" class="btn btn-viewmore">view more</a>
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