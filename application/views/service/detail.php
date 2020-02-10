<div class="banner" style="background-image: url('<?=IMG_URL?>banner_services_company.jpg')">
	<div class="container">
		<h2>OUR SERVICES</h2>
		<div style="display: table;"><i class="fas fa-angle-right"></i><h1>COMPANY SERVICES</h1></div>
	</div>
</div>
<div class="services-content">
	<div class="container">
		<div class="wrap-title">
			<i class="fas fa-quote-left"></i>
			<h4 class="content-title">Overview</h4>
		</div>
		<div><?=$item->content?></div>
	</div>
</div>
<? require_once(APPPATH."views/module/process.php"); ?>
<div class="container">
	<div class="wrap-title">
		<i class="fas fa-quote-left"></i>
		<h4 class="content-title">Scope of Services</h4>
	</div>
	<div><?=$item->summary?></div>
</div>
<? require_once(APPPATH."views/module/service.php"); ?>
<?
	$info = new stdClass();
	$info->jurisdiction_id = $item->jurisdiction_id;
	$info->service_id = $service->id;
	$faqs = $this->m_services_faqs->items($info,1);
	$c = count($faqs);
?>
<div class="cluster">
	<div class="faqs">
		<div class="container">
			<div class="wrap-title">
				<i class="fas fa-quote-left"></i>
				<h4 class="content-title">FAQs</h4>
			</div>
			<div class="row">
				<div class="col-md-6">
					<? for ($i=0; $i < $c; $i++) { 
						if ($i%2 == 0) {
					?>
					<div class="item">
						<div class="question" st="0">
							<i class="fas fa-angle-down"></i>
							<?=$i+1?>. <?=$faqs[$i]->question?>
						</div>
						<div class="answer">
							<?=$faqs[$i]->answer?>
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
							<?=$i+1?>. <?=$faqs[$i]->question?>
						</div>
						<div class="answer">
							<?=$faqs[$i]->answer?>
						</div>
					</div>
					<? } } ?>
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
<? require_once(APPPATH."views/module/download.php"); ?>
<? require_once(APPPATH."views/module/resources.php"); ?>