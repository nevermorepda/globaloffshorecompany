<div class="banner" style="background-image: url('<?=$item->thumbnail?>')">
	<div class="container">
		<h2>JURISDICTIONS </h2>
		<div style="display: table;"><i class="fas fa-angle-right"></i><h1><?=$item->name?></h1></div>
	</div>
</div>
<div class="tabs-bar">
	<div class="container">
		<ul class="nav nav-tabs">
			<? $i=0; foreach ($tab_details as $tab_detail) { 
				$module = explode('-|-', $tab_detail->module);
			?>
			<li class="nav-item">
				<a stt="<?=$i?>" status="+" class="nav-link select-tab <?=($i == 0) ? 'active' : ''?>" href="#<?=$module[0]?><?=($module[0] == 'content') ? $i : ''?>"><?=$tab_detail->name?></a>
			</li>
			<? $i++; } ?>
		</ul>
	</div>
	<div class="d-none d-lg-block">
		<ul class="scroll-tabs">
			<? $i=0; foreach ($tab_details as $tab_detail) { 
				$module = explode('-|-', $tab_detail->module);
			?>
			<li class="tab-item">
				<a stt="<?=$i?>" status="+" class="select-tab" href="#<?=$module[0]?><?=($module[0] == 'content') ? $i : ''?>"><?=$tab_detail->name?></a>
			</li>
			<? $i++; } ?>
		</ul>
	</div>
</div>
<script type="text/javascript">
	$('.scroll-tabs .tab-item a').click(function(event) {
		$('.scroll-tabs .tab-item a').removeClass('active');
		$(this).addClass('active');
	});
	$('.tabs-bar .nav-item .nav-link').click(function(event) {
		$('.tabs-bar .nav-item .nav-link').removeClass('active');
		$(this).addClass('active');
	});
	$(window).scroll(function() {
		$scroll = $(window).scrollTop();
		if ($scroll > 350){
			$('.scroll-tabs').css('display', 'block');
		} else {
			$('.scroll-tabs').css('display', 'none');
		}
	});
</script>
<?
	$count_content = 0;
	$i=0;
	foreach ($tab_details as $tab_detail) {
		$file_name = explode('-|-', $tab_detail->module);
		if ($file_name[0] == 'content') {
			$count_content++;
		}
		require(APPPATH."views/module/{$file_name[0]}.php");
		$i++;
	}
?>
<script type="text/javascript">
	$('.select-tab').click(function(event) {
		var st = $(this).attr('status');
		var stt = $(this).attr('stt');
		if (st == '+') {
			$('.hide-show-'+stt).html('<i class="fas fa-minus"></i>');
			$('.title-status-'+stt).attr('status', '-');
			$('.tonggle-'+stt).show('speed');
		} else {
			$('.hide-show-'+stt).html('<i class="fas fa-plus"></i>');
			$('.title-status-'+stt).attr('status', '+');
			$('.tonggle-'+stt).hide('speed');
		}
	});
</script>