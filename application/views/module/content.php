<div class="services-content" id="<?=$tab_detail->module.$i?>" <?=($count_content > 1) ? 'style="background: transparent;"' : '' ?>>
	<div class="container">
		<div class="wrap-title select-tab title-status-<?=$i?>" stt="<?=$i?>" status="<?=!empty($tab_detail->open) ? '-' : '+'?>">
			<div class="hide-show hide-show-<?=$i?>">
				<?=!empty($tab_detail->open) ? '<i class="fas fa-minus"></i>' : '<i class="fas fa-plus"></i>'?>
			</div>
			<i class="fas fa-quote-left"></i>
			<h4 class="content-title"><?=$tab_detail->name?></h4>
		</div>
		<div class="tonggle-content tonggle-<?=$i?>" <?=!empty($tab_detail->open) ? 'style="display: block;"' : ''?>>
			<?=$tab_detail->content?>
		</div>
	</div>
</div>