<div class="banner" style="background-image: url('<?=IMG_URL?>banner_services_company.jpg')">
	<div class="container">
		<div style="display: table;"><i class="fas fa-angle-right"></i><h1>FAQs</h1></div>
	</div>
</div>
<div class="">
	<div class="faqs">
		<div class="container">
			<? foreach ($categories as $category) { 
				$info = new stdClass();
				$info->category_id = $category->id;
				$items = $this->m_faq->items($info,1);
				$c = count($items);
			?>
			<div class="wrap-title select-tab">
				<i class="fas fa-quote-left"></i>
				<h4 class="content-title"><?=$category->name?></h4>
			</div>
			<div class="row">
				<div class="col-md-6">
					<? for ($i=0; $i < $c; $i++) { 
						if ($i%2 == 0) {
					?>
					<div class="item">
						<div class="question" st="0">
							<i class="fas fa-angle-down"></i>
							<?=$i+1?>. <?=$items[$i]->title?>
						</div>
						<div class="answer">
							<?=$items[$i]->content?>
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
							<?=$i+1?>. <?=$items[$i]->title?>
						</div>
						<div class="answer">
							<?=$items[$i]->content?>
						</div>
					</div>
					<? } } ?>
				</div>
			</div>
			<br>
			<? } ?>
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
			$(this).parent().children(".answer").toggle('fast');
		});
	});
</script>