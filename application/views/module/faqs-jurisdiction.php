<?
	$info = new stdClass();
	$info->jurisdiction_id = $item->jurisdiction_id;
	$faqs_item = $this->m_jurisdictions_faqs->items($info,1);
	$c = count($faqs_item);
?>
<div class="">
	<div class="faqs">
		<div class="container">
			<div class="wrap-title select-tab title-status-<?=$i?>" stt="<?=$i?>" status="<?=!empty($tab_detail->open) ? '-' : '+'?>">
				<div class="hide-show hide-show-<?=$i?>">
					<?=!empty($tab_detail->open) ? '<i class="fas fa-minus"></i>' : '<i class="fas fa-plus"></i>'?>
				</div>
				<i class="fas fa-quote-left"></i>
				<h4 class="content-title" id="<?=$tab_detail->module?>">FAQs</h4>
			</div>
			<div class="tonggle-content tonggle-<?=$i?>" <?=!empty($tab_detail->open) ? 'style="display: block;"' : ''?>>
				<div class="row">
					<div class="col-md-6">
						<? for ($i=0; $i < $c; $i++) { 
							if ($i%2 == 0) {
						?>
						<div class="item">
							<div class="question" st="0">
								<i class="fas fa-angle-down"></i>
								<?=$i+1?>. <?=$faqs_item[$i]->question?>
							</div>
							<div class="answer">
								<?=$faqs_item[$i]->answer?>
							</div>
						</div>
						<? } } ?>
					</div>
					<div class="col-md-6">
						<? for ($i=0; $i < $c; $i++) { 
							if ($i%2 != 0) {
						?>
						<div class="item">
							<div class="question" st="0">
								<i class="fas fa-angle-down"></i>
								<?=$i+1?>. <?=$faqs_item[$i]->question?>
							</div>
							<div class="answer">
								<?=$faqs_item[$i]->answer?>
							</div>
						</div>
						<? } } ?>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$(document).ready(function(){
					$(".question").click(function(){
						var st = parseInt($(this).attr('st'));
						if (st == 0) {
							$(this).attr('st',1);
							$(this).addClass('active');
						} else {
							$(this).attr('st',0);
							$(this).removeClass('active');
						}
						$(this).parent().children(".answer").toggle('slow');
					});
				});
			</script>
		</div>
	</div>
</div>