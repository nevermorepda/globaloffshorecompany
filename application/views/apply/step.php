<?
	require_once(APPPATH."libraries/ip2location/IP2Location.php");
	$loc = new IP2Location(FCPATH . '/application/libraries/ip2location/databases/IP-COUNTRY-SAMPLE.BIN', IP2Location::FILE_IO);
	$country_name = $loc->lookup($this->util->realIP(), IP2Location::COUNTRY_NAME);
?>
<div class="apply">
	<div class="container">
		<div class="tab-step clearfix">
			<h1 class="note">Apply Company Services</h1>
		</div>
	</div>
	<div class="applyform">
		<form id="frmApply" class="form-horizontal" role="form" action="<?=site_url('apply-company-services/step1')?>" method="POST">
			<div class="container">
				<div class="row">
					<div class="col-lg-7">
						<p><strong>Nominee Shareholders, Company Secretary and Directors Companies Incorporated is able to provide nominee shareholders, a company secretary and professional directors. Clients seeking Companies Incorporated to arrange for the provision of directors to their companies should note that any directors that Companies Incorporated may appoint will act responsibly and with due regard to their legal obligations.</strong></p>
						<div class="row">
							<div class="col-md-4">
								<strong class="select-title"> Select Jurisdiction:</strong>
								<select name="jurisdiction" id="jurisdictions" class="form-control" required="required">
									<option value="">Select Jurisdiction</option>
									<? foreach ($jurisdictions as $jurisdiction) { 
										$check_service = $this->m_jurisdiction_services->item($jurisdiction->jurisdiction_id, $service_id);
										if (!empty($check_service)) {
									?>
									<option value="<?=$jurisdiction->alias?>"><?=$jurisdiction->name?></option>
									<? } } ?>
								</select>
							</div>
						</div>
						<br>
						<p>Please select any additional supplies or services that you would like.</p>
						<p>You have chosen the <strong class="text-color-red set-nation">National</strong> Corporation, Which includes:</p>

					</div>
					<div class="col-lg-5 d-none d-xl-block d-lg-block">
						<div class="how-it-work-title">
							<sup><i class="fas fa-quote-left"></i></sup> How to set up
						</div>
						<div class="bg-apply">
							
						</div>
					</div>
				</div>
			</div>
			<br><br>
			<div class="container">
				<div class="wrap-loading" style="display: none;">
					<img src="<?=IMG_URL.'loading.gif'?>" alt="loading" class="loading">
				</div>
				<div class="form-box">
					<div class="wrap-apply"></div>
				</div>
			</div>
		</form>
	</div>
<script type="text/javascript" src="<?=JS_URL?>apply-company-services.js"></script>
</div>