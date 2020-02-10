<?

	if (!empty($file_name[1])) {
		$process_id = $file_name[1];
	} else {
		$process_id = $item->services_process_id;
	}
	$process_item = $this->m_services_process->load($process_id);
?>
<div class="" id="process">
	<div class="how-it-work-item">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="how-it-work-title">
						<sup><i class="fas fa-quote-left"></sup></i> How to set up
					</div>
				</div>
				<div class="col-md-9" style="background: #e1e1e1;padding: 20px 15px;">
					<div class="row">
						<? for ($i=1; $i <= 8 ; $i++) { $pro = "step{$i}";
							if (!empty($process_item->{$pro})) {
						?>
						<div class="col-md-6">
							<div class="wrap-step">
								<div class="step">Step <?=$i?></div>
								<div class="step-name"><?=$process_item->{$pro}?></div>
							</div>
						</div>
						<? } } ?>
					</div>
					<div class="text-center">
						<a class="get-started-now" href="">GET STARTED NOW</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>