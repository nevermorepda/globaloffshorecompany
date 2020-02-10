<?
	$info = new stdClass();
	$info->jurisdiction_id = $item->jurisdiction_id;
	$download_items = $this->m_jurisdictions_download->items($info);
?>
<div class="download-module">
	<div class="container">
		<div class="wrap-title select-tab title-status-<?=$i?>" stt="<?=$i?>" status="<?=!empty($tab_detail->open) ? '-' : '+'?>">
			<div class="hide-show hide-show-<?=$i?>">
				<?=!empty($tab_detail->open) ? '<i class="fas fa-minus"></i>' : '<i class="fas fa-plus"></i>'?>
			</div>
			<i class="fas fa-quote-left"></i>
			<h4 class="content-title" id="download">Form & Download</h4>
		</div>
		<div class="tonggle-content tonggle-<?=$i?>" <?=!empty($tab_detail->open) ? 'style="display: block;"' : ''?>>
			<table class="table table-bordered" style="font-size:15px;">
				<tbody>
					<tr style="font-weight: 600; background-color: #f0f0f0;">
						<td>Description</td>
						<td class="text-center"  width="100px">Download</td>
					</tr>
					<? foreach ($download_items as $download_item) { ?>
					<tr>
						<td>
							<div class="faqs-title"><strong><?=$download_item->title?></strong></div>
							<p style="margin:0" class="description-title"><?=$download_item->description?></p>
						</td>
						<td class="text-center"><a target="_blank" href="<?=BASE_URL.$download_item->file_path?>"><i style="color: #b21f1f;" class="fas fa-download"></i></a></td>
					</tr>
					<? } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>