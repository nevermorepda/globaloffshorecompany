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
		<form id="frm-step2" class="form-horizontal" role="form" action="<?=site_url('apply-company-services/step3')?>" method="POST">
			<div class="container">
				<?require_once(APPPATH."views/apply/nav.php");?>
				<div class="row">
					<div class="col-md-8">
						<p>Please complete all address information. If you plan to use a Registered Agent other than Companies Incorporated, that agent must have a physical address in China and be available during normal business hours. There is a $5 processing fee for using an agent other than Companies Incorporated.</p>
						<div class="form-group">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<h6><span>Shipping Address:</span> (No P.O. Boxes, please. Street address only.)</h6>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="row">
										<div class="col-xs-4 col-sm-4 col-md-4">
											<select class="form-control form-input" id="title_ship" name="req_ship_title">
												<option value="Mr">Mr</option>
												<option value="Ms">Ms</option>
												<option value="Mrs">Mrs</option>
											</select>
											<script> $("#new_title").val('<?=!empty($company_service->req_ship_title) ? $company_service->req_ship_title : 'Mr'?>'); </script>
										</div>
										<div class="col-xs-8 col-sm-8 col-md-8 new-fullname">
											<input type="text" id="req_ship_fullname" name="req_ship_fullname" class="form-input form-control" placeholder="Full name*" value="<?=$company_service->req_ship_fullname?>">
											<div class="wrap-error"></div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="req_ship_address" name="req_ship_address" class="form-input form-control" placeholder="Address*" value="<?=$company_service->req_ship_address?>">
									<div class="wrap-error"></div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="req_ship_city" name="req_ship_city" class="form-input form-control" placeholder="City*" value="<?=$company_service->req_ship_city?>">
									<div class="wrap-error"></div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="req_ship_province" name="req_ship_province" class="form-input form-control" placeholder="Province*" value="<?=$company_service->req_ship_province?>">
									<div class="wrap-error"></div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="req_ship_zipcode" name="req_ship_zipcode" class="form-input form-control" placeholder="ZIP/Postal Code Required*" value="<?=$company_service->req_ship_zipcode?>">
									<div class="wrap-error"></div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="req_ship_country" name="req_ship_country" class="form-input form-control" placeholder="Country*" value="<?=$company_service->req_ship_country?>">
									<div class="wrap-error"></div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="req_ship_day_phone" name="req_ship_day_phone" class="form-input form-control keyup-number" placeholder="Day Telephone*" value="<?=$company_service->req_ship_day_phone?>">
									<div class="wrap-error"></div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="req_ship_evening_phone" name="req_ship_evening_phone" class="form-input form-control keyup-number" placeholder="Evening Telephone*" value="<?=$company_service->req_ship_evening_phone?>">
									<div class="wrap-error"></div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="req_ship_phone" name="req_ship_phone" class="form-input form-control keyup-number" placeholder="Cellular No*" value="<?=$company_service->req_ship_phone?>">
									<div class="wrap-error"></div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="req_ship_fax" name="req_ship_fax" class="form-input form-control keyup-number" placeholder="Fax*" value="<?=$company_service->req_ship_fax?>">
									<div class="wrap-error"></div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<input type="text" id="req_ship_email" name="req_ship_email" class="form-input form-control" placeholder="Email (Email will remain private)*" value="<?=$company_service->req_ship_email?>">
									<div class="wrap-error"></div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<h6><span>Corporate Legal Address:</span></h6>
									<label class="wrap-checkbox">
										<input type="checkbox" class="check-corp" name="check_corp" value="" <?=!empty($company_service->req_corp_fullname) ? 'checked' : '' ?>>
										<span class="checkmark" style="left:0;"></span>
										<div style="padding-left: 30px;">Please Check if Corporate Legal Address is Different.</div>
									</label>
								</div>
							</div>
							<script type="text/javascript">
								$('.check-corp').click(function(event) {
									$('.check-corp-form').toggle('speed');
								});
							</script>
							<div class="row check-corp-form" <?=empty($company_service->req_corp_fullname) ? 'style="display: none;"' : '' ?>>
								<br>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="row">
										<div class="col-xs-4 col-sm-4 col-md-4">
											<select class="form-control form-input" id="req_corp_title" name="req_corp_title">
												<option value="Mr">Mr</option>
												<option value="Ms">Ms</option>
												<option value="Mrs">Mrs</option>
											</select>
											<script> $("#req_corpTitle").val('<?=!empty($company_service->req_corp_title) ? $company_service->req_corp_title : 'Mr'?>'); </script>
										</div>
										<div class="col-xs-8 col-sm-8 col-md-8 new-fullname">
											<input type="text" name="req_corp_fullname" class="form-input form-control" placeholder="Full name" value="<?=$company_service->req_corp_fullname?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_corp_address" class="form-input form-control" placeholder="Address" value="<?=$company_service->req_corp_address?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_corp_city" class="form-input form-control" placeholder="City" value="<?=$company_service->req_corp_city?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_corp_province" class="form-input form-control" placeholder="Province" value="<?=$company_service->req_corp_province?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_corp_zipcode" class="form-input form-control" placeholder="ZIP/Postal Code Required" value="<?=$company_service->req_corp_zipcode?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_corp_country" class="form-input form-control" placeholder="Country" value="<?=$company_service->req_corp_country?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_corp_day_phone" class="form-input form-control keyup-number" placeholder="Day Telephone" value="<?=$company_service->req_corp_day_phone?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_corp_evening_phone" class="form-input form-control keyup-number" placeholder="Evening Telephone" value="<?=$company_service->req_corp_evening_phone?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_corp_phone" class="form-input form-control keyup-number" placeholder="Cellular No" value="<?=$company_service->req_corp_phone?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_corp_fax" class="form-input form-control keyup-number" placeholder="Fax" value="<?=$company_service->req_corp_fax?>">
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<input type="text" name="req_corp_email" class="form-input form-control" placeholder="Email (Email will remain private)" value="<?=$company_service->req_corp_email?>">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<h6><span>Address of Person Placing Order:</span></h6>
									<label class="wrap-checkbox">
										<input type="checkbox" class="check-person" name="check_person" value="" <?=!empty($company_service->req_person_fullname) ? 'checked' : '' ?>>
										<span class="checkmark" style="left:0;"></span>
										<div style="padding-left: 30px;">Please Check if Corporate Legal Address is Different.</div>
									</label>
								</div>
							</div>
							<script type="text/javascript">
								$('.check-person').click(function(event) {
									$('.check-person-form').toggle('speed');
									
								});
							</script>
							<div class="row check-person-form" <?=empty($company_service->req_person_fullname) ? 'style="display: none;"' : '' ?>>
								<br>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="row">
										<div class="col-xs-4 col-sm-4 col-md-4">
											<select class="form-control form-input" id="req_person_title" name="req_person_title">
												<option value="Mr">Mr</option>
												<option value="Ms">Ms</option>
												<option value="Mrs">Mrs</option>
											</select>
											<script> $("#req_person_title").val('<?=!empty($company_service->req_person_title) ? $company_service->req_person_title : 'Mr'?>'); </script>
										</div>
										<div class="col-xs-8 col-sm-8 col-md-8 new-fullname">
											<input type="text" name="req_person_fullname" class="form-input form-control" placeholder="Full name" value="<?=$company_service->req_person_fullname?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_person_address" class="form-input form-control" placeholder="Address" value="<?=$company_service->req_person_address?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_person_city" class="form-input form-control" placeholder="City" value="<?=$company_service->req_person_city?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_person_province" class="form-input form-control" placeholder="Province" value="<?=$company_service->req_person_province?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_person_zipcode" class="form-input form-control" placeholder="ZIP/Postal Code Required" value="<?=$company_service->req_person_zipcode?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_person_country" class="form-input form-control" placeholder="Country" value="<?=$company_service->req_person_country?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_person_day_phone" class="form-input form-control keyup-number" placeholder="Day Telephone" value="<?=$company_service->req_person_day_phone?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_person_evening_phone" class="form-input form-control keyup-number" placeholder="Evening Telephone" value="<?=$company_service->req_person_evening_phone?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_person_phone" class="form-input form-control keyup-number" placeholder="Cellular No" value="<?=$company_service->req_person_phone?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_person_fax" class="form-input form-control keyup-number" placeholder="Fax" value="<?=$company_service->req_person_fax?>">
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<input type="text" name="req_person_email" class="form-input form-control" placeholder="Email (Email will remain private)" value="<?=$company_service->req_person_email?>">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<h6><span>Registered Agent Address:</span> The Agent must have a physical location in <?=$nation->name?>. If Companies Incorporated is to be your Registered Agent, please skip this section.</h6>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_agent_name" class="form-input form-control" value="<?=!empty($company_service->req_agent_address) ? $company_service->req_agent_address : 'Companies Incorporated'?>">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="req_agent_address" class="form-input form-control" placeholder="Address" value="<?=$company_service->req_agent_address?>">
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<input type="text" name="req_agent_city" class="form-input form-control" placeholder="City" value="<?=$company_service->req_agent_city?>">
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<input type="text" name="req_agent_state" class="form-input form-control" placeholder="State" value="<?=$company_service->req_agent_state?>">
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<input type="text" name="req_agent_zipcode" class="form-input form-control" placeholder="ZIP/Postal Code" value="<?=$company_service->req_agent_zipcode?>">
								</div>
							</div>
						</div>
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
							<button type="submit" class="btn-white btn-normal">PREVIOUS</button>
							<button type="submit" class="btn-next btn-red btn-normal">NEXT</button>
						</div>
						<br>
					</div>
				</div>
			</div>
		</form>
	</div>
<script type="text/javascript" src="<?=JS_URL?>apply-company-services-step2.js"></script>
</div>