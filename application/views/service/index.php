<?
	$info = new stdClass();
	$info->service_tab_id = !empty($tab->id) ? $tab->id : 0;
	$tab_details = $this->m_services_tabs_details->items($info);
?>
<div class="banner" style="background-image: url('<?=IMG_URL?>banner_services_company.jpg')">
	<div class="container">
		<h2>OUR SERVICES</h2>
		<div style="display: table;"><i class="fas fa-angle-right"></i><h1><?=$service->name?></h1></div>
	</div>
</div>
<div class="tabs-bar">
	<div class="container">
		<ul class="nav nav-tabs">
			<? $i=0; foreach ($item_tabs as $item_tab) { ?>
			<li class="nav-item">
				<a class="nav-link <?=($tab->alias == $item_tab->alias) ? 'active' : ''?>" href="<?=site_url("our-services/{$service->alias}/{$item_tab->alias}")?>"><?=$item_tab->name?></a>
			</li>
			<? $i++; } ?>
		</ul>
	</div>
</div>
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
	$('.wrap-title').click(function(event) {
		var st = $(this).attr('status');
		if (st == '+') {
			$(this).find('.hide-show').html('<i class="fas fa-minus"></i>');
			$(this).attr('status', '-');
			$(this).parents('.container').find('.tonggle-content').show('speed');
		} else {
			$(this).find('.hide-show').html('<i class="fas fa-plus"></i>');
			$(this).attr('status', '+');
			$(this).parents('.container').find('.tonggle-content').hide('speed');
		}
	});
</script>