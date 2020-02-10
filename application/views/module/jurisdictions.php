<?
	$info = new stdClass();
	$info->service_tab_id = $tab->id;
	$nation_items = $this->m_services_tab_nation->jion_nation($info);
	$regions = array();
	foreach ($nation_items as $nation_item) { 
		if (!in_array($nation_item->region, $regions)) {
			$regions[] = $nation_item->region;
		}
	}
	sort($regions);
?>
<div class="" id="jurisdictions">
	<div class="container">
		<div class="wrap-title select-tab title-status-<?=$i?>" stt="<?=$i?>" status="<?=!empty($tab_detail->open) ? '-' : '+'?>">
			<div class="hide-show hide-show-<?=$i?>">
				<?=!empty($tab_detail->open) ? '<i class="fas fa-minus"></i>' : '<i class="fas fa-plus"></i>'?>
			</div>
			<i class="fas fa-quote-left"></i>
			<h4 class="content-title">Jurisdictions</h4>
		</div>
		<div class="tonggle-content tonggle-<?=$i?>" <?=!empty($tab_detail->open) ? 'style="display: block;"' : ''?>>
			<ul class="nav nav-tabs list-tabs" id="myTab" role="tablist">
				<? for ($r=0; $r<sizeof($regions); $r++) { ?>
				<li class="nav-item">
					<a class="nav-link transition <?=(!$r?"active":"")?>" id="jurisdiction-<?=$this->util->slug($regions[$r])?>" data-toggle="tab" href="#<?=$this->util->slug($regions[$r])?>" role="tab" aria-controls="<?=$this->util->slug($regions[$r])?>" aria-selected="true">
						<? if ($regions[$r] == 'america-carribean') {
								echo 'America - Carribean';
							} else {
								echo ucwords(str_replace('-',' ', $regions[$r]));
							}
						?>
					</a>
				</li>
				<? } ?>
			</ul>
			<div class="tab-content" id="myTabContent">
				<? for ($r=0; $r<sizeof($regions); $r++) { ?>
				<div class="tab-pane fade <?=(!$r?"show active":"")?>" id="<?=$this->util->slug($regions[$r])?>" role="tabpanel" aria-labelledby="jurisdiction-<?=$this->util->slug($regions[$r])?>">
					<div class="row">
						<?
							$i = 0;
							foreach ($nation_items as $nation_item) {
								if ($nation_item->region != $regions[$r]) {
									continue;
								}
						?>
						<div class="col-md-2">
							<div class="item select-content" nation = "<?=$nation_item->alias?>">
								<a id="content-juricdictions" data-toggle="tab" href="#select-juricdictions" role="tab" aria-controls="select-juricdictions" aria-selected="true">
									<img src="<?=IMG_URL."flag/{$nation_item->alias}.svg"?>" class="img-responsive transition" alt="Image">
									<h6><?=$nation_item->name?></h6>
								</a>
							</div>
						</div>
						<?
								$i++;
							}
						?>
					</div>
				</div>
				<? } ?>
				<div class="tab-pane fade" id="select-juricdictions" role="tabpanel" aria-labelledby="content-juricdictions">
					<div class="load-juricdiction"></div>
				</div>
				<script type="text/javascript">
					$(document).on('click', '.select-content', function(event) {
						var p = {};
						p['nation'] = $(this).attr('nation');
						$('.tab-pane').removeClass('show');
						$('.tab-pane').removeClass('active');
						// $('.nav-link').removeClass('active');
						$('.load-juricdiction').html('<div class="wrap-loading"><img src="<?=IMG_URL.'loading.gif'?>" alt="loading" class="loading"></div>');
						$.ajax({
							url: '<?=site_url("libraries/get-jurisdiction")?>',
							type: 'POST',
							dataType: 'json',
							data: p,
							success: function (data){
								var c_region = data[2].length;
								var str = '';
								if (data) {
									$('#select-juricdictions').addClass('show');
									$('#select-juricdictions').addClass('active');
									str += '<ul class="list-region">';
									for (var i = 0; i < c_region; i++) {
										if (data[2][i].region == data[1].region) {
											if (data[1].name == data[2][i].name) {
												str += 	'<li class="select-content active" nation = "'+data[2][i].alias+'">'+data[2][i].name+'</li>';
											} else {
												str += 	'<li class="select-content" nation = "'+data[2][i].alias+'">'+data[2][i].name+'</li>';
											}
										}
									}
									str += 	'</ul>';
									str += '<h6 class="title">'+data[1].name+'</h6>';
									str += '<div class="content-juricdictions">'+data[0].content+'</div>';
									str += '<div class="text-center"><a target="_blank" href="'+BASE_URL+'/jurisdictions/'+data[1].region+'/'+data[1].alias+'.html" class="btn-small btn-red">View more</a></div>';
								}
								$('.load-juricdiction').html(str);
							}
						})
					});
				</script>
			</div>
		</div>
	</div>
</div>