<?
	$admin = $this->session->userdata("admin");

?>

<div class="cluster">
	<div class="container-fluid">
		<div class="tool-bar clearfix">
			<h1 class="page-title">
				Visa Bookings
				<div class="pull-right">
					<div class="clearfix">
						<div class="pull-left" style="margin-right: 5px;">
							<div class="input-group input-group-sm">
								<input type="text" id="report_text" name="report_text" class="form-control" value="" placeholder="Search for application ID">
							</div>
						</div>
						<div class="pull-left" style="margin-right: 5px;">
							<div class="input-group input-group-sm">
								<select id="report_visa_type" name="report_visa_type" class="form-control">
									<option value="">All type</option>
									<option value="1ms">1MS</option>
									<option value="1mm">1MM</option>
									<option value="3ms">3MS</option>
									<option value="3mm">3MM</option>
									<option value="6mm">6MM</option>
									<option value="1ym">1YM</option>
								</select>
								<script>$("#report_visa_type").val("");</script>
							</div>
						</div>
						<div class="pull-left" style="margin-right: 5px;">
							<div class="input-group input-group-sm">
								<select id="report_visit_purpose" name="report_visit_purpose" class="form-control">
									<option value="">All purpose</option>
									<option value="For tourist">Tourist</option>
									<option value="For business">Business</option>
									<option value="Family or Friend visit">Family</option>
								</select>
								<script>$("#report_visit_purpose").val("");</script>
							</div>
						</div>
						<div class="pull-left" style="margin-right: 5px;">
							<div class="input-group input-group-sm">
								<select id="report_country" name="report_country" class="form-control">
									<option value="">All country</option>
										<option value=""> (1)</option>
									</select>
								<script>$("#report_country").val("");</script>
							</div>
						</div>
						<div class="pull-left" style="max-width: 220px;">
							<div class="input-group input-group-sm">
								<input type="text" class="form-control daterange">
								<span class="input-group-btn">
									<button class="btn btn-default btn-report" type="button">Report</button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</h1>
		</div>
				<div class="statement-bar clearfix">
			<div class="payment-statement pull-left">
				<div class="title">Success</div>
				<div class="number">1</div>
			</div>
			<div class="payment-statement pull-left">
				<div class="title">Pax</div>
				<div class="number">1</div>
			</div>
			<div class="payment-statement pull-left">
				<div class="title">VOA</div>
				<div class="number">1</div>
			</div>
			<div class="payment-statement pull-left">
				<div class="title">VEV</div>
				<div class="number">0</div>
			</div>
			<div class="payment-statement pull-left">
				<div class="title">PR</div>
				<div class="number">0</div>
			</div>
			<div class="payment-statement pull-left">
				<div class="title">Full</div>
				<div class="number">0</div>
			</div>
			<div class="payment-statement pull-left">
				<div class="title">FC</div>
				<div class="number">0</div>
			</div>
			<div class="payment-statement pull-left">
				<div class="title">Car</div>
				<div class="number">0</div>
			</div>
			<div class="payment-statement pull-left hidden-xs hidden">
				<div class="title">OnePay</div>
				<div class="number">$0</div>
			</div>
			<div class="payment-statement pull-left hidden-xs hidden">
				<div class="title">Paypal</div>
				<div class="number">$10</div>
			</div>
			<div class="payment-statement pull-left hidden-xs hidden">
				<div class="title">G2S</div>
				<div class="number">$0</div>
			</div>
			<div class="payment-statement pull-left hidden-xs hidden">
				<div class="title">&nbsp;</div>
				<div class="number">=</div>
			</div>
			<div class="payment-statement pull-left hidden">
				<div class="title">Total</div>
				<div class="number">$10</div>
			</div>
			<div class="payment-statement pull-left hidden">
				<div class="title">Capital</div>
				<div class="number text-color-red">- $5</div>
			</div>
			<div class="payment-statement pull-left hidden">
				<div class="title">Refund</div>
				<div class="number text-color-red">- $4</div>
			</div>
			<div class="payment-statement pull-left hidden-xs hidden">
				<div class="title">Stamping</div>
				<div class="number text-color-red">- $0</div>
			</div>
			<div class="payment-statement pull-left hidden">
				<div class="title">Profit</div>
				<div class="number text-color-green"> $1</div>
			</div>
		</div>
			<form id="frm-admin" name="adminForm" action="http://localhost/vietnam-visa.org.vn/syslog/visa-booking.html" method="POST">
				<input type="hidden" id="task" name="task" value="cancel">
				<input type="hidden" id="boxchecked" name="boxchecked" value="0">
				<input type="hidden" id="search_text" name="search_text" value="">
				<input type="hidden" id="search_visa_type" name="search_visa_type" value="">
				<input type="hidden" id="search_visit_purpose" name="search_visit_purpose" value="">
				<input type="hidden" id="search_country" name="search_country" value="">
				<input type="hidden" id="fromdate" name="fromdate" value="2020-01-02">
				<input type="hidden" id="todate" name="todate" value="2020-01-02">
				<input type="hidden" id="sortby" name="sortby" value="booking_date">
				<input type="hidden" id="orderby" name="orderby" value="DESC">
				<p></p>
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover">
						<tbody><tr>
							<th class="text-center" width="5">
								#
							</th>
							<th class="text-center"></th>
							<th class="text-center">
								IP
							</th>
							<th class="text-center" width="20">
							</th>
							<th width="80" class="sortby selected DESC" sortby="booking_date">
								Date
							</th>
							<th class="text-center" width="5">
								<i class="fa fa-paperclip"></i>
							</th>
							<th class="sortby" sortby="id">
								ID
							</th>
							<th class="text-center sortby" sortby="payment_method">
								Payment
							</th>
							<th class="sortby" sortby="oreder_ref">
								Reference
							</th>
							<th class="sortby" sortby="primary_email">
								Email
							</th>
							<th class="text-center sortby" sortby="visa_type">
								Type
							</th>
							<th class="text-center sortby" sortby="arrival_date" width="80">
								Arrival
							</th>
							<th class="text-center sortby" sortby="arrival_port">
								Port
							</th>
							<th class="text-center sortby" sortby="group_size">
								Paxs
							</th>
							<th class="text-center sortby" sortby="visa_fee">
								Fee
							</th>
							<th class="text-center sortby" sortby="rush_fee">
								Rush
							</th>
							<th class="text-center sortby" sortby="private_visa">
								Private
							</th>
							<th class="text-center sortby" sortby="full_package">
								Full
							</th>
							<th class="text-center sortby" sortby="fast_checkin">
								FC
							</th>
							<th class="text-center sortby" sortby="car_pickup" nowrap="nowrap">
								Car
							</th>
							<th class="text-center sortby" sortby="discount">
								Discount
							</th>
							<th class="text-center sortby" sortby="promotion_code">
								Code
							</th>
							<th class="text-center sortby" sortby="capital">
								Capital
							</th>
							<th class="text-center sortby" sortby="refund">
								Refund
							</th>
							<th class="text-center sortby" sortby="total_fee">
								Total
							</th>
							<th class="text-center sortby" sortby="status">
								Payment
							</th>
							<th class="text-center sortby" sortby="other_payment" nowrap="">
								Other Payment
							</th>
							<th class="text-center sortby" sortby="booking_status">
								Status
							</th>
						</tr>
						<? foreach ($bookings as $booking) { ?>
						<tr class="prss0">
							<td width="2%" class="text-center">
								1
							</td>
							<td class="text-center">
								<i class="fa fa-desktop" aria-hidden="true"></i>
							</td>
							<td width="2%" class="text-center">
								<a target="_blank" href="http://whatismyipaddress.com/ip/::1">
									<img src="http://localhost/vietnam-visa.org.vn/template/admin/images/flags/.png" alt="" title="">
								</a>
							</td>
							<td>
							</td>
							<td class="text-right">
								2020-01-02<br>
								08:10:12
							</td>
							<td class="text-center">
								<div class="fa-attachment-5076 display-none">
									<i class="fa fa-paperclip"></i>
								</div>
							</td>
							<td width="80px">
								<a class="collapsed" data-toggle="collapse" href="#5076" aria-expanded="false" aria-controls="collapse5076">
									VISA5076
								</a>
							</td>
							<td width="4%" class="text-center">
								PP
							</td>
							<td width="80px">
								1911051572916212
							</td>
							<td>
								nevermorepda1@gmail.com
							</td>
							<td width="4%" class="text-center">
								1MS
							</td>
							<td width="6%" class="text-center">
								Dec/08/2019
							</td>
							<td class="text-center">
								Ho Chi Minh
							</td>
							<td width="3%" class="text-center">
								1
							</td>
							<td width="3%" align="right">
								$9.99
							</td>
							<td width="3%" align="right">
								$0
							</td>
							<td class="text-center" width="30px">
							</td>
							<td class="text-center" width="30px">
							</td>
							<td width="3%" align="right">
								$0
							</td>
							<td width="3%" align="right">
								$0
							</td>
							<td width="3%" align="right">
							</td>
							<td width="3%" class="text-center">
							</td>
							<td width="3%" class="text-center">
								<input type="text" class="capital" name="capital" value="5" booking-id="5076" style="background-color: #F0F0F0; width: 30px; text-align: right; border: none;">
							</td>
							<td width="3%" class="text-center">
								<input type="text" class="refund" name="refund" value="4" booking-id="5076" style="background-color: #F0F0F0; width: 30px; text-align: right; border: none;">
							</td>
							<td width="3%" align="right">
								$9.99
							</td>
							<td width="3%" align="right">
								<div class="btn-group btn-processing-status">
									<a class="btn btn-xs dropdown-toggle dropdown-toggle-payment-status-5076" data-toggle="dropdown">
										<span class="label label-success">Paid</span> <i class="fa fa-caret-down"></i>
									</a>
									<ul class="dropdown-menu">
										<li>
											<a title="" class="payment-status" booking-id="5076" status-id="1"><span class="label label-success">Paid</span></a>
											<a title="" class="payment-status" booking-id="5076" status-id="0"><span class="label label-danger">UnPaid</span></a>
										</li>
									</ul>
								</div>
							</td>
							<td width="3%" align="right">
								<div class="btn-group btn-processing-status">
									<a class="btn btn-xs dropdown-toggle dropdown-toggle-other-payment-5076" data-toggle="dropdown">
										<span class="label label-default">No</span> <i class="fa fa-caret-down"></i>
									</a>
									<ul class="dropdown-menu">
										<li>
											<a title="" class="other-payment" email="nevermorepda1@gmail.com" booking-id="5076" status-id="0"><span class="label label-default">No</span></a>
											<a title="" class="other-payment" email="nevermorepda1@gmail.com" booking-id="5076" status-id="1"><span class="label label-success">Payment Online</span></a>
										</li>
									</ul>
								</div>
							</td>
							<td width="3%" align="right">
								<div class="btn-group btn-processing-status">
									<a class="btn btn-xs dropdown-toggle dropdown-toggle-booking-status-5076" data-toggle="dropdown">
										<span class="label label-default">Submitted</span> <i class="fa fa-caret-down"></i>
									</a>
									<ul class="dropdown-menu">
										<li>
											<a title="" class="booking-status" booking-id="5076" status-id="1"><span class="label label-default">Submitted</span></a>
											<a title="" class="booking-status" booking-id="5076" status-id="2"><span class="label label-success">Approved</span></a>
											<a title="" class="booking-status" booking-id="5076" status-id="3"><span class="label label-danger">Denied</span></a>
											<a title="" class="booking-status" booking-id="5076" status-id="4"><span class="label label-warning">Refund</span></a>
										</li>
									</ul>
								</div>
							</td>
						</tr>
						<tr class="collapse" id="5076">
							<td colspan="30">
								<div class="row">
									<div class="col-sm-7">
										<div class="panel panel-default">
											<div class="panel-heading"><strong>Visa Information Details</strong></div>
											<div class="panel-body">
												<div>
													<div style="font-weight: bold; padding: 10px 0 10px 20px;">
														A. Visa Options
														<div class="pull-right"><a class="pointer btn-edit-option" item-id="5076"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></div>
													</div>
													<div style="padding: 0 0 10px 40px;">
														<table class="table table-bordered table-striped">
															<tbody><tr><td>Type of visa</td><td>1 month single</td></tr>
															<tr><td width="20%">Purpose of visit</td><td>For tourist</td></tr>
															<tr><td>Entry date</td><td>Dec/08/2019</td></tr>
															<tr class="hidden"><td>Exit date</td><td>Jan/01/1970</td></tr>
															<tr><td>Entry through checkpoint</td><td>Ho Chi Minh</td></tr>
															<tr><td>Number of applicants</td><td>1</td></tr>
															<tr><td>Visa service fee for American Samoa</td><td>9.99 USD/pax</td></tr>
															<tr><td><b>Total fee</b></td><td><b>9.99 USD</b></td></tr>
														</tbody></table>
													</div>
												</div>
												<div>
													<div style="font-weight: bold; padding: 10px 0 10px 20px;">
														B. Passport Detail
													</div>
													<div style="padding: 0 0 10px 40px;">
														<table class="table table-bordered">
															<tbody>
																<tr>
																	<th class="text-center" width="40">No.</th>
																	<th class="text-left">Full name</th>
																	<th class="text-center">Gender</th>
																	<th class="text-center">Date of birth</th>
																	<th class="text-center">Nationality</th>
																	<th class="text-center">Passport number</th><th class="text-center" width="60"></th>
																</tr>
																<tr>
																	<td class="text-center" style="border: 1px solid #DDD;">1</td><td style="border: 1px solid #DDD;">Duy Anh Phan</td>
																	<td class="text-center" style="border: 1px solid #DDD;">Male</td>
																	<td class="text-center" style="border: 1px solid #DDD;">Apr/04/1913</td>
																	<td class="text-center" style="border: 1px solid #DDD;">American Samoa</td>
																	<td class="text-center" style="border: 1px solid #DDD;">12321321</td><td class="text-center" style="border: 1px solid #DDD;"><a class="pointer btn-edit-passport" item-id="19"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div>
													<div style="font-weight: bold; padding: 10px 0 10px 20px;">
														C. Contact Information
														<div class="pull-right"><a class="pointer btn-edit-contact" item-id="5076"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></div>
													</div>
													<div style="padding: 0 0 10px 40px;">
														<table class="table table-bordered table-striped">
															<tbody><tr><td width="20%">Full Name</td><td>Mr. Duy Anh Phan</td></tr>
															<tr><td>Email</td><td><a href="mailto:nevermorepda1@gmail.com">nevermorepda1@gmail.com</a></td></tr>
															<tr><td>Alternate Email</td><td><a href="mailto:"></a></td></tr>
															<tr><td>Phone Number</td><td><a href="tel:0859322224">0859322224</a></td></tr>
															<tr><td>Special Request</td><td></td></tr>
														</tbody></table>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-5">
										<div class="panel panel-default">
											<div class="panel-heading">
												<strong>Upload</strong>
											</div>
											<div class="panel-body">
												<div class="file-path file-path-5076 clearfix">
													<p>No file exist.</p>
												</div>
												<div class="file-upload">
													<button type="button" class="btn btn-xs btn-default btn-browse" user-id="8060" item-id="5076">Browse...</button>
													<button type="button" class="btn btn-xs btn-primary btn-create-pdf" user-id="8060" item-id="5076">Make letter</button>
													<button type="button" class="btn btn-xs btn-primary btn-sendmail" user-id="8060" item-id="5076">Send letter</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
		</form>
	</div>
</div>
<? require_once(APPPATH."views/module/admin/upload_ckfinder.php"); ?>
<script src="//code.highcharts.com/highcharts.js"></script>
<script>
function openCdnKCFinderBrowse(field, url, user_id, id) {
	window.KCFinder = {
		callBack: function(url) {
			field.value = url;
			window.KCFinder = null;
		}
	};
	var popUp = window.open('<?=CDN_URL?>/files/browse.php?type=<?=BOOKING_PREFIX?>&dir=<?=BOOKING_PREFIX?>/user/' + url, 'kcfinder_browse',
		'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
		'resizable=1, scrollbars=0, width=800, height=600'
	);
	var pollTimer = window.setInterval(function() {
		if (popUp.closed !== false) {
			window.clearInterval(pollTimer);
			
			var p = {};
			p["user_id"] = user_id;
			p["id"] = id;
			p["field"] = field;
			
			$.ajax({
				type : 'POST',
				data : p,
				url : "<?=site_url('syslog/ajax-get-booking-download-files')?>",
				success : function(data){
					$(".file-path-"+id).html(data);
				},
				async:false
			});
		}
	}, 200);
}

$(document).ready(function() {
	var sortby  = "<?=(!empty($sortby)?$sortby:'booking_date')?>";
	var orderby = "<?=(!empty($orderby)?$orderby:'DESC')?>";

	$(".sortby").each(function() {
		if ($(this).attr("sortby") == sortby) {
			$(this).addClass("selected");
			$(this).addClass(orderby);
		}
	});
	
	$(".sortby").click(function() {
		if ($(this).attr("sortby") == sortby) {
			orderby = ((orderby == "DESC")?"ASC":"DESC");
		}
		else {
			orderby = "DESC";
		}
		$("#sortby").val($(this).attr("sortby"));
		$("#orderby").val(orderby);
		submitButton("search");
	});
	
	$(".btn-browse").click(function() {
		var user_id = $(this).attr("user-id");
		var item_id = $(this).attr("item-id");
		var user_path = user_id + "/approval/" + item_id + "/";

		var p = {};
		p["user_path"] = user_path;
		
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-mkdir")?>",
			data: p,
			success: function(result) {
				openCdnKCFinderBrowse('user', user_path, user_id, item_id);
			},
			async:false
		});
	});

	$(".capital").click(function() {
		$(this).select();
	});
	
	$(".capital").blur(function() {
		var booking_id = $(this).attr("booking-id");
		var capital = $(this).val();
		
		var p = {};
		p["booking_id"] = booking_id;
		p["capital"] = capital;
		
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-visa-booking-capital")?>",
			data: p
		});
	});

	$(".refund").click(function() {
		$(this).select();
	});
	
	$(".refund").blur(function() {
		var booking_id = $(this).attr("booking-id");
		var refund = $(this).val();
		
		var p = {};
		p["booking_id"] = booking_id;
		p["refund"] = refund;
		
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-visa-booking-refund")?>",
			data: p
		});
	});

	$(".payment-status").click(function() {
		var booking_id = $(this).attr("booking-id");
		var status_id = $(this).attr("status-id");
		var status_label = $(this).html();
		
		var p = {};
		p["booking_id"] = booking_id;
		p["status_id"] = parseInt(status_id);
		
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-visa-payment-status")?>",
			data: p,
			success: function(result) {
				$(".dropdown-toggle-payment-status-" + booking_id).html(status_label + " <i class=\"fa fa-caret-down\"></i>");
			}
		});
	});

	$(".other-payment").click(function() {
		var booking_id = $(this).attr("booking-id");
		var status_id = $(this).attr("status-id");
		var email = $(this).attr("email");
		var status_label = $(this).html();
		
		var p = {};
		p["booking_id"] = booking_id;
		p["status_id"] = status_id;
		p["email"] = email;
		
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-visa-other-payment")?>",
			data: p,
			success: function(result) {
				$(".dropdown-toggle-other-payment-" + booking_id).html(status_label + " <i class=\"fa fa-caret-down\"></i>");
			}
		});
	});
	
	$(".booking-status").click(function() {
		var booking_id = $(this).attr("booking-id");
		var status_id = $(this).attr("status-id");
		var status_label = $(this).html();
		
		var p = {};
		p["booking_id"] = booking_id;
		p["status_id"] = status_id;
		
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-visa-booking-status")?>",
			data: p,
			success: function(result) {
				$(".dropdown-toggle-booking-status-" + booking_id).html(status_label + " <i class=\"fa fa-caret-down\"></i>");
			}
		});
	});

	$(".datepicker").daterangepicker({
		singleDatePicker: true
	});
	
	$(".btn-edit-option").click(function(e) {
		e.preventDefault();
		var dialog = $("#dialog-edit-option");
		var item_id = $(this).attr("item-id");
		var p = {};
		p["id"] = item_id;
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-visa-options/edit")?>",
			data: p,
			dataType: "json",
			success: function(data) {
				dialog.find("#item_id").val(item_id);
				dialog.find("#visa_type").val(data[0]);
				dialog.find("#visit_purpose").val(data[1]);
				dialog.find("#arrival_date").val(data[2]);
				dialog.find("#exit_date").val(data[3]);
				dialog.find("#arrival_port").val(data[4]);
				dialog.find("#flight_number").val(data[5]);
				dialog.find("#arrival_time").val(data[6]);
				dialog.find("#rush_type").val(data[7]);
				dialog.find("#private_visa").val(data[8]);
				dialog.find("#full_package").val(data[9]);
				dialog.find("#fast_checkin").val(data[10]);
				dialog.find("#car_pickup").val(data[11]);
				$("#arrival_date").data("daterangepicker").setStartDate(data[2]);
				$("#arrival_date").data("daterangepicker").setEndDate(data[2]);
				$("#exit_date").data("daterangepicker").setStartDate(data[3]);
				$("#exit_date").data("daterangepicker").setEndDate(data[3]);
				dialog.modal();
			}
		});
	});

	$(".btn-update-option").click(function(e) {
		e.preventDefault();
		var dialog = $("#dialog-edit-option");
		var p = {};
		p["id"] = dialog.find("#item_id").val();
		p["visa_type"] = dialog.find("#visa_type").val();
		p["visit_purpose"] = dialog.find("#visit_purpose").val();
		p["arrival_date"] = dialog.find("#arrival_date").val();
		p["exit_date"] = dialog.find("#exit_date").val();
		p["arrival_port"] = dialog.find("#arrival_port").val();
		p["flight_number"] = dialog.find("#flight_number").val();
		p["arrival_time"] = dialog.find("#arrival_time").val();
		p["rush_type"] = dialog.find("#rush_type").val();
		p["private_visa"] = dialog.find("#private_visa").val();
		p["full_package"] = dialog.find("#full_package").val();
		p["fast_checkin"] = dialog.find("#fast_checkin").val();
		p["car_pickup"] = dialog.find("#car_pickup").val();
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-visa-options/update")?>",
			data: p,
			success: function(data) {
				dialog.modal("hide");
			}
		});
	});

	$(".btn-edit-passport").click(function(e) {
		e.preventDefault();
		var dialog = $("#dialog-edit-passport");
		var item_id = $(this).attr("item-id");
		var p = {};
		p["id"] = item_id;
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-visa-passport/edit")?>",
			data: p,
			dataType: "json",
			success: function(data) {
				dialog.find("#item_id").val(item_id);
				dialog.find("#fullname").val(data[0]);
				dialog.find("#gender").val(data[1]);
				dialog.find("#birthday").val(data[2]);
				dialog.find("#nationality").val(data[3]);
				dialog.find("#passport").val(data[4]);
				$("#birthday").data("daterangepicker").setStartDate(data[2]);
				$("#birthday").data("daterangepicker").setEndDate(data[2]);
				dialog.modal();
			}
		});
	});

	$(".btn-update-passport").click(function(e) {
		e.preventDefault();
		var dialog = $("#dialog-edit-passport");
		var p = {};
		p["id"] = dialog.find("#item_id").val();
		p["fullname"] = dialog.find("#fullname").val();
		p["gender"] = dialog.find("#gender").val();
		p["birthday"] = dialog.find("#birthday").val();
		p["nationality"] = dialog.find("#nationality").val();
		p["passport"] = dialog.find("#passport").val();
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-visa-passport/update")?>",
			data: p,
			success: function(data) {
				dialog.modal("hide");
			}
		});
	});

	$(".btn-edit-contact").click(function(e) {
		e.preventDefault();
		var dialog = $("#dialog-edit-contact");
		var item_id = $(this).attr("item-id");
		var p = {};
		p["id"] = item_id;
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-visa-contact/edit")?>",
			data: p,
			dataType: "json",
			success: function(data) {
				dialog.find("#item_id").val(item_id);
				dialog.find("#contact_title").val(data[0]);
				dialog.find("#contact_fullname").val(data[1]);
				dialog.find("#primary_email").val(data[2]);
				dialog.find("#secondary_email").val(data[3]);
				dialog.find("#contact_phone").val(data[4]);
				dialog.modal();
			}
		});
	});

	$(".btn-update-contact").click(function(e) {
		e.preventDefault();
		var dialog = $("#dialog-edit-contact");
		var p = {};
		p["id"] = dialog.find("#item_id").val();
		p["contact_title"] = dialog.find("#contact_title").val();
		p["contact_fullname"] = dialog.find("#contact_fullname").val();
		p["primary_email"] = dialog.find("#primary_email").val();
		p["secondary_email"] = dialog.find("#secondary_email").val();
		p["contact_phone"] = dialog.find("#contact_phone").val();
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-visa-contact/update")?>",
			data: p,
			success: function(data) {
				dialog.modal("hide");
			}
		});
	});

	$(".btn-create-pdf").click(function(e) {
		e.preventDefault();
		var item_id = $(this).attr("item-id");
		var user_id = $(this).attr("user-id");
		var p = {};
		p["id"] = item_id;
		
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-load-boarding-letter-pdf-content")?>",
			data: p,
			success: function(result) {
				$("#dialog-make-file").find("#item_id").val(item_id);
				$("#dialog-make-file").find("#user_id").val(user_id);
				tinymce.get('pdf-content').setContent(result);
				$("#dialog-make-file").modal();
			}
		});
	});
	
	$(".btn-create").click(function() {
		var id = $("#dialog-make-file").find("#item_id").val();
		var user_id = $("#dialog-make-file").find("#user_id").val();
		
		var p = {};
		p["id"] = id;
		p["content"] = tinymce.get('pdf-content').getContent();
		
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-create-boarding-letter")?>",
			data: p,
			success: function(data) {
				$("#dialog-make-file").modal("hide");
			},
			async:false
		});
		
		p["user_id"] = user_id;
		p["field"] = "user";
		
		$.ajax({
			type : 'POST',
			data : p,
			url : "<?=site_url('syslog/ajax-get-booking-download-files')?>",
			success : function(data){
				$(".file-path-"+id).html(data);
			},
			async:false
		});
	});

	$(".btn-sendmail").click(function(e) {
		e.preventDefault();
		var item_id = $(this).attr("item-id");
		var p = {};
		p["id"] = item_id;
		
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-boarding-letter/compose")?>",
			data: p,
			dataType: "json",
			success: function(result) {
				$("#dialog-send-mail").find("#item_id").val(item_id);
				$("#dialog-send-mail").find("#subject").val(result[0]);
				tinymce.get('message').setContent(result[1]);
				$("#dialog-send-mail").modal();
			}
		});
	});
	
	$(".btn-send").click(function() {
		var p = {};
		p["id"] = $("#dialog-send-mail").find("#item_id").val();
		p["subject"] = $("#dialog-send-mail").find("#subject").val();
		p["message"] = tinymce.get('message').getContent();
		
		$.ajax({
			type: "POST",
			url: "<?=site_url("syslog/ajax-boarding-letter/send")?>",
			data: p,
			success: function(result) {
				messageBox("INFO", "Compose Email", result);
				$("#dialog-send-mail").modal("hide");
			}
		});
	});
	
	if ($(".daterange").length) {
		$(".daterange").daterangepicker({
			startDate: "<?=date('m/d/Y', strtotime((!empty($fromdate)?$fromdate:"now")))?>",
			endDate: "<?=date('m/d/Y', strtotime((!empty($todate)?$todate:"now")))?>"
		});
	}
	
	$(".btn-report").click(function(){
		$("#search_text").val($("#report_text").val());
		$("#search_visa_type").val($("#report_visa_type :selected").val());
		$("#search_visit_purpose").val($("#report_visit_purpose :selected").val());
		$("#search_country").val($("#report_country :selected").val());
		if ($(".daterange").length) {
			$("#fromdate").val($(".daterange").data("daterangepicker").startDate.format('YYYY-MM-DD'));
			$("#todate").val($(".daterange").data("daterangepicker").endDate.format('YYYY-MM-DD'));
		}
		submitButton("search");
	});

	$("[data-ci-pagination-page]").click(function(event){
		event.preventDefault();
		$("#frm-admin").attr("action", $(this).attr("href")).submit();
	});
});
</script>