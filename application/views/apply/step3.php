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
		<form id="frmApply" class="form-horizontal" role="form" action="<?=site_url('apply-company-services/completed')?>" method="POST">
			<div class="container">
				<?require_once(APPPATH."views/apply/nav.php");?>
				<div class="row">
					<div class="col-md-8">
						<h2 style="font-size: 28px;padding-bottom: 20px;">Payment</h2>
						<div class="row">
							<div class="col-xs-4 col-sm-4 text-center">
								<label for="payment3"><img class="img-responsive" src="<?=IMG_URL?>payment/paypal.png" alt="Paypal" /></label>
								<br />
								<div class="radio">
									<label><input id="payment3" type="radio" name="payment" value="Paypal" checked="checked" />Credit Card by Paypal</label>
								</div>
							</div>
							<? if ( OP == "ON") { ?>
							<div class="col-xs-4 col-sm-4 text-center">
								<label for="payment1"><img class="img-responsive" src="<?=IMG_URL?>payment/onepay.png" alt="OnePay" /></label>
								<br />
								<div class="radio">
									<label><input id="payment1" type="radio" name="payment" value="OnePay" />Credit Card by OnePay</label>
								</div>
							</div>
							<? } ?>
							<div class="col-xs-4 col-sm-4 text-center">
								<label for="payment4"><img class="img-responsive" src="<?=IMG_URL?>banktransfer.png" alt="Bank Transfer" /></label>
								<br />
								<div class="radio">
									<label><input id="payment4" type="radio" name="payment" value="Bank Transfer" />Bank Transfer</label>
								</div>
							</div>
						</div>
						<br>
						<strong class="text-color-red">(*)Please be noticed that: all fees are subjected to change without prior notice. Please contact us prior payment for confirmation.</strong>
					</div>
					<?
						$optional_fee = 0;
						foreach ($company_service->service_option as $value) {
							$optional_fee += $this->m_services_fee->load($value)->fee;
						}
					?>
					<div class="col-md-4">
						<div class="checkout-form-box">
							<h3>PACKAGE</h3>
							<div class="table-responsive">
								<div class="option-fee clearfix">
									<div class="float-left">The <?=$nation->name?> Corporation</div>
									<div class="float-right">$0.00</div>
								</div>
								<div class="option-fee clearfix">
									<div class="float-left">Non Package</div>
									<div class="float-right">$<?=number_format(round($company_service->total_fee - $optional_fee,2))?></div>
								</div>
								<div class="option-fee clearfix">
									<div class="float-left">Optional Services</div>
									<div class="float-right">$<?=number_format(round($optional_fee,2))?></div>
								</div>
								<div class="wrap-promotion clearfix">
									<div class="float-left">Coupon code:</div>
									<div class="float-right">
										<div class="input-group mb-3" style="margin:0 !important;">
											<input type="text" name="promotion_code" id="promotion_code" class="form-control">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary btn-red" style="border: 1px solid #B21F1F !important;" id="">Apply</button>
											</div>
										</div>
									</div>
								</div>
								<div class="total clearfix">
									<div class="float-left">Total: </div>
									<div class="float-right">
										$<span class="ctotal"><?=number_format(round($company_service->total_fee,2))?></span>
									</div>
								</div>
							</div>
						</div>
						<br>
					</div>
					<div class="col-md-8">
						<div class="text-center">
							<hr width="30%" color="#b21f1f" style="margin: 0px auto 15px auto;">
							<button href="#" class="btn-next btn-white btn-normal">PREVIOUS</button>
							<button type="submit" class="btn-next btn-red btn-normal">PLACE ORDER</button>
						</div>
						<br>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>