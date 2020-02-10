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
		<form id="frmApply" class="form-horizontal" role="form" action="" method="POST">
			<div class="container">
				<div class="row">
					<div class="col-lg-7">
						<? require_once(APPPATH."views/apply/step-nav.php"); ?>
						<div class="form-box">
							<div class="box-title">
								Step 1: Set up Service
							</div>
							<div class="box-content">
								<div class="row">
									<div class="col-md-6">
										<label for="">Type of Service</label>
										<select name="type_service" id="type_service" class="form-control" required="">
											<option value="">Company service</option>
											<option value="">Company service</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="">Jurisdiction</label>
										<select name="type_service" id="type_service" class="form-control" required="">
											<option value="">Hong Kong</option>
											<option value="">Viet Nam</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="">Entity Type</label>
										<select name="type_service" id="type_service" class="form-control" required="">
											<option value="">Company litmit by share</option>
											<option value="">Company litmit by share</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="">No of Director</label>
										<select name="type_service" id="type_service" class="form-control" required="">
											<option value="">1</option>
											<option value="">2</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="">No of Shareholder</label>
										<select name="type_service" id="type_service" class="form-control" required="">
											<option value="">1</option>
											<option value="">2</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-5 d-none d-xl-block d-lg-block">
						<div class="how-it-work-title">
							<sup><i class="fas fa-quote-left"></i></sup> How to set up
						</div>
						<img src="<?=IMG_URL.'bg-apply-step.jpg'?>" alt="" style="max-height: 370px;width: 900px;">
					</div>
				</div>
			</div>
			<br><br>
			<div class="container">
				<div class="row">
					<div class="col-md-7">
						<div class="form-box">
							<div class="box-title">
								Recommended Services
							</div>
							<div class="box-content">
								<div class="row">
									<div class="col-md-6">
										<label for="">Type of Service</label>
										<select name="type_service" id="type_service" class="form-control" required="">
											<option value="">Company service</option>
											<option value="">Company service</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="">Jurisdiction</label>
										<select name="type_service" id="type_service" class="form-control" required="">
											<option value="">Hong Kong</option>
											<option value="">Viet Nam</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="">Entity Type</label>
										<select name="type_service" id="type_service" class="form-control" required="">
											<option value="">Company litmit by share</option>
											<option value="">Company litmit by share</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="">No of Director</label>
										<select name="type_service" id="type_service" class="form-control" required="">
											<option value="">1</option>
											<option value="">2</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="">No of Shareholder</label>
										<select name="type_service" id="type_service" class="form-control" required="">
											<option value="">1</option>
											<option value="">2</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-box">
							<div class="box-title">
								Summary of Your Order
							</div>
							<div class="box-content">
								<div class="review-box">
									<div class="clearfix">
										<div class="float-left">Type of Service <strong class="text-color-red">[?]</strong></div>
										<div class="float-right">Company Formation/Incorporation</div>
									</div>
								</div>
								<div class="review-box">
									<div class="clearfix">
										<div class="float-left">Jurisdiction of Incorporation <strong class="text-color-red">[?]</strong></div>
										<div class="float-right">Hong Kong</div>
									</div>
								</div>
								<div class="review-box">
									<div class="clearfix">
										<div class="float-left">Type of Incorporation <strong class="text-color-red">[?]</strong></div>
										<div class="float-right">US$ 399.00</div>
									</div>
									<p class="help-block">Company litmit by shares</p>
								</div>
								<div class="review-box">
									<div class="clearfix">
										<div class="float-left">Number of Director(s) <strong class="text-color-red">[?]</strong></div>
										<div class="float-right">1</div>
									</div>
								</div>
								<div class="review-box">
									<div class="clearfix">
										<div class="float-left">Number of Shareholder(s) <strong class="text-color-red">[?]</strong></div>
										<div class="float-right">1</div>
									</div>
								</div>
								<div class="review-box">
									<div class="clearfix">
										<div class="float-left">Open Bank Account Support</div>
										<div class="float-right">US$ 299.00</div>
									</div>
									<p class="help-block">Hong Kong - HSCB BANK</p>
								</div>
								<div class="review-box">
									<div class="clearfix">
										<div class="float-left">Processing Time <strong class="text-color-red">[?]</strong></div>
										<div class="float-right">US$ 0.00</div>
									</div>
									<p class="help-block">Normal (Guaranteed within 1 working days)</p>
								</div>
								<div class="review-total">
									<div class="clearfix">
										<div class="float-left">Total</div>
										<div class="float-right text-color-red">US$ 698.00</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>