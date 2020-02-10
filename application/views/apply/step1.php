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
		<form id="frm-step1" class="form-horizontal" role="form" action="<?=site_url('apply-company-services/step2')?>" method="POST">
			<div class="container">
				<?require_once(APPPATH."views/apply/nav.php");?>
				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<h6><span>Corporation Name:</span> (", Inc." will be added to your corporate name unless another corporate identifier ending is given.)</h6>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="preferred" class="form-input form-control " id="preferred" placeholder="Preferred*" value="<?=$company_service->preferred?>">
									<div class="wrap-error"></div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="alternate" class="form-input form-control " id="alternate" placeholder="Alternate*" value="<?=$company_service->alternate?>">
									<div class="wrap-error"></div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<h6><span>Authorized Stock & Par Value: </span> The corporation will be authorized to issue up to 1,500 shares of No Par Value common stock unless fewer shares qualify for minimum incorporating fees or minimum annual franchise taxes, or unless you instruct otherwise.</h6>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="shares" class="form-input form-control keyup-number" id="shares" placeholder="1500" value="<?=$company_service->shares?>">
									<div class="wrap-error"></div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="sharesval" class="form-input form-control keyup-number" id="sharesval" placeholder="Par Value" value="<?=$company_service->sharesval?>">
									<div class="wrap-error"></div>
								</div>
							</div>
						</div>
						<div class="form-group initial-director">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<h6><span>Initial Directors: </span></h6>
								</div>
							</div>
							<div class="after-add-more">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<input type="text" name="directorname[]" class="form-input form-control" id="directorname-0" placeholder="Director - Name of Person*" value="<?=!empty($company_service->address_detail[0]->directorname) ? $company_service->address_detail[0]->directorname : ''?>">
										<div class="wrap-error"></div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<input type="text" name="directoraddress1[]" class="form-input form-control" id="directoraddress1-0" placeholder="Address Line 1*" value="<?=!empty($company_service->address_detail[0]->directoraddress1) ? $company_service->address_detail[0]->directoraddress1 : ''?>">
										<div class="wrap-error"></div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<input type="text" name="directoraddress2[]" class="form-input form-control" id="directoraddress2-0" placeholder="Address Line 2*" value="<?=!empty($company_service->address_detail[0]->directoraddress2) ? $company_service->address_detail[0]->directoraddress2 : ''?>">
										<div class="wrap-error"></div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<input type="text" name="directorcity[]" class="form-input form-control" id="directorcity-0" placeholder="City*"" value="<?=!empty($company_service->address_detail[0]->directorcity) ? $company_service->address_detail[0]->directorcity : ''?>">
										<div class="wrap-error"></div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dir_last">
										<input type="text" name="directorstate[]" class="form-input form-control" id="directorstate-0" placeholder="State*" value="<?=!empty($company_service->address_detail[0]->directorstate) ? $company_service->address_detail[0]->directorstate : ''?>">
										<div class="wrap-error"></div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dir_last">
										<input type="text" name="directorcountry[]" class="form-input form-control" id="directorcountry-0" placeholder="Country*" value="<?=!empty($company_service->address_detail[0]->directorcountry) ? $company_service->address_detail[0]->directorcountry : ''?>">
										<div class="wrap-error"></div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dir_last">
										<input type="text" name="directorcode[]" class="form-input form-control" id="directorcode-0" placeholder="Postal Code*" value="<?=!empty($company_service->address_detail[0]->directorcode) ? $company_service->address_detail[0]->directorcode : ''?>">
										<div class="wrap-error"></div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dir_last">
										<div class="text-right">
											<a class="btn-plus btn-green btn-small"><i class="fas fa-plus"></i> Plus</a>
										</div>
									</div>
								</div>
							</div>
							<div class="add-dir-section" qty-plus="<?
								$str = '0';
								$c = count($company_service->address_detail);
								for ($i = 1; $i < $c; $i++) {
									$str .= '|'.$i;
								}
								echo $str;
							?>">
								<? for ($i = 1; $i < $c; $i++) { if (!empty($company_service->address_detail[$i])) { ?>
								<div class="after-add-more">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="directorname[]" class="form-input form-control" id="directorname-<?=$i?>" placeholder="Director - Name of Person*" value="<?=$company_service->address_detail[$i]->directorname?>">
											<div class="wrap-error"></div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="directoraddress1[]" class="form-input form-control" id="directoraddress1-<?=$i?>" placeholder="Address Line 1*" value="<?=$company_service->address_detail[$i]->directoraddress1?>">
											<div class="wrap-error"></div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="directoraddress2[]" class="form-input form-control" id="directoraddress2-<?=$i?>" placeholder="Address Line 2*" value="<?=$company_service->address_detail[$i]->directoraddress2?>">
											<div class="wrap-error"></div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="directorcity[]" class="form-input form-control" id="directorcity-<?=$i?>" placeholder="City*"" value="<?=$company_service->address_detail[$i]->directorcity?>">
											<div class="wrap-error"></div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dir_last">
											<input type="text" name="directorstate[]" class="form-input form-control" id="directorstate-<?=$i?>" placeholder="State*" value="<?=$company_service->address_detail[$i]->directorstate?>">
											<div class="wrap-error"></div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dir_last">
											<input type="text" name="directorcountry[]" class="form-input form-control" id="directorcountry-<?=$i?>" placeholder="Country*" value="<?=$company_service->address_detail[$i]->directorcountry?>">
											<div class="wrap-error"></div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dir_last">
											<input type="text" name="directorcode[]" class="form-input form-control" id="directorcode-<?=$i?>" placeholder="Postal Code*" value="<?=$company_service->address_detail[$i]->directorcode?>">
											<div class="wrap-error"></div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dir_last">
											<div class="text-right">
												<a class="btn-del btn-red btn-small" item="<?=$i?>"><i class="fas fa-minus"></i> Delete</a>
											</div>
										</div>
									</div>
								</div>
								<? } } ?>
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
									<div class="float-left">The <?=$this->m_nation->load($company_service->jurisdiction)->name?> Corporation</div>
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
							<a class="btn-next btn-red btn-normal">NEXT</a>
						</div>
						<br>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript" src="<?=JS_URL?>apply-company-services-step1.js"></script>