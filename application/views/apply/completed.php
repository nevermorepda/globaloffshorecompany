<?
	require_once(APPPATH."libraries/ip2location/IP2Location.php");
	$loc = new IP2Location(FCPATH . '/application/libraries/ip2location/databases/IP-COUNTRY-SAMPLE.BIN', IP2Location::FILE_IO);
	$country_name = $loc->lookup($this->util->realIP(), IP2Location::COUNTRY_NAME);
	$nation = $this->m_nation->load($company_service->jurisdiction);
?>
<div class="apply">
	<div class="container">
		<div class="tab-step clearfix">
			<h1 class="note">Apply Company Services</h1>
		</div>
	</div>
	<div class="applyform">
		<form id="frmApply" class="form-horizontal" role="form" action="<?=site_url('apply-company-services/')?>" method="POST">
			<div class="container">
				<?require_once(APPPATH."views/apply/nav.php");?>
				<?// var_dump($company_service); ?>
			</div>
		</form>
	</div>
<script type="text/javascript" src="<?=JS_URL?>apply-company-services-step2.js"></script>
</div>