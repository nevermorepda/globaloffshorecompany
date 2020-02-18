<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mail_tpl {

	function template($content)
	{
		return '<!DOCTYPE html>
				<html lang="en-US">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					</head>
					<body style="font-family: Arial,Tahoma,sans-serif; font-size: 13px;">
						<table style="background-color: #FFF3B0; border: 1px solid #BBCDD9; border-collapse: collapse;">
							<tr>
								<td style="padding: 15px;">
									'.$content.'
								</td>
							</tr>
							<tr>
								<td style="padding: 0px 15px 15px;">
									<table>
										<tr><td colspan="3"><b>VIETNAM VISA DEPT.</b></td></tr>
										<tr><td>Address</td><td>:</td><td>'.ADDRESS.'</td></tr>
										<tr><td>Hotline</td><td>:</td><td>'.HOTLINE.'</td></tr>
										<tr><td>Website</td><td>:</td><td><a href="'.BASE_URL.'" target="_blank">www.'.strtolower(SITE_NAME).'</a></td></tr>
										<tr><td>Email</td><td>:</td><td><a href="mailto:'.MAIL_INFO.'" target="_blank">'.MAIL_INFO.'</a></td></tr>
										<tr><td colspan="3" style="color: red"><b>WE ALWAYS SUPPORT YOU 24/7</b></td></tr>
									</table>
								</td>
							</tr>
						</table>
					</body>
				</html>';
	}
	
	function service_data($booking)
	{
		$this->ci =& get_instance();
		$this->ci->load->model('m_user');
		$this->ci->load->model('m_services_fee');
		$this->ci->load->model('m_services_booking_detail');
		
		$user = $this->ci->m_user->load($booking->user_id);
		$info = new stdClass();
		$info->booking_id = $booking->id;
		$booking_paxs = $this->ci->m_services_booking_detail->items($info);
		
		$paxs = array();
		for ($i=0; $i<sizeof($booking_paxs); $i++) {
			$pax = array();
			$pax["directorname"]		= $booking_paxs[$i]->directorname;
			$pax["directoraddress1"]	= $booking_paxs[$i]->directoraddress1;
			$pax["directoraddress2"]	= $booking_paxs[$i]->directoraddress2;
			$pax["directorcity"]		= $booking_paxs[$i]->directorcity;
			$pax["directorstate"]		= $booking_paxs[$i]->directorstate;
			$pax["directorcountry"]		= $booking_paxs[$i]->directorcountry;
			$pax["directorcode"]		= $booking_paxs[$i]->directorcode;
			$paxs[] 					= $pax;
		}

		$service_option = array();
		$options = explode('|',$booking->service_option);
		foreach ($options as $option) {
			if (!empty($option)) {
				array_push($service_option, $this->ci->m_services_fee->load($option));
			}
		}

		$tpl_data = array(
			"BOOKING_ID"				=> $booking->id,
			"ORDER_REF"					=> $booking->order_ref,
			"JURISDICTION"				=> $booking->jurisdiction,
			"SERVICE_ID"				=> $booking->service_id,
			"TOTAL_FEE"					=> $booking->total_fee,
			"PREFERRED"					=> $booking->preferred,
			"ALTERNATE"					=> $booking->alternate,
			"SHARES"					=> $booking->shares,
			"SHARESVAL"					=> $booking->sharesval,
			"PAYMENT_METHOD"			=> $booking->payment_method,

			"REQ_SHIP_TITLE"			=> $booking->req_ship_title,
			"REQ_SHIP_FULLNAME"			=> $booking->req_ship_fullname,
			"REQ_SHIP_ADDRESS"			=> $booking->req_ship_address,
			"REQ_SHIP_CITY"				=> $booking->req_ship_city,
			"REQ_SHIP_PROVINCE"			=> $booking->req_ship_province,
			"REQ_SHIP_ZIPCODE"			=> $booking->req_ship_zipcode,
			"REQ_SHIP_COUNTRY"			=> $booking->req_ship_country,
			"REQ_SHIP_DAY_PHONE"		=> $booking->req_ship_day_phone,
			"REQ_SHIP_EVENING_PHONE"	=> $booking->req_ship_evening_phone,
			"REQ_SHIP_PHONE"			=> $booking->req_ship_phone,
			"REQ_SHIP_FAX"				=> $booking->req_ship_fax,
			"REQ_SHIP_EMAIL"			=> $booking->req_ship_email,

			"REQ_CORP_TITLE"			=> $booking->req_corp_title,
			"REQ_CORP_FULLNAME"			=> $booking->req_corp_fullname,
			"REQ_CORP_ADDRESS"			=> $booking->req_corp_address,
			"REQ_CORP_CITY"				=> $booking->req_corp_city,
			"REQ_CORP_PROVINCE"			=> $booking->req_corp_province,
			"REQ_CORP_ZIPCODE"			=> $booking->req_corp_zipcode,
			"REQ_CORP_COUNTRY"			=> $booking->req_corp_country,
			"REQ_CORP_DAY_PHONE"		=> $booking->req_corp_day_phone,
			"REQ_CORP_EVENING_PHONE"	=> $booking->req_corp_evening_phone,
			"REQ_CORP_PHONE"			=> $booking->req_corp_phone,
			"REQ_CORP_FAX"				=> $booking->req_corp_fax,
			"REQ_CORP_EMAIL"			=> $booking->req_corp_email,

			"REQ_PERSON_TITLE"			=> $booking->req_person_title,
			"REQ_PERSON_FULLNAME"		=> $booking->req_person_fullname,
			"REQ_PERSON_ADDRESS"		=> $booking->req_person_address,
			"REQ_PERSON_CITY"			=> $booking->req_person_city,
			"REQ_PERSON_PROVINCE"		=> $booking->req_person_province,
			"REQ_PERSON_ZIPCODE"		=> $booking->req_person_zipcode,
			"REQ_PERSON_COUNTRY"		=> $booking->req_person_country,
			"REQ_PERSON_DAY_PHONE"		=> $booking->req_person_day_phone,
			"REQ_PERSON_EVENING_PHONE"	=> $booking->req_person_evening_phone,
			"REQ_PERSON_PHONE"			=> $booking->req_person_phone,
			"REQ_PERSON_FAX"			=> $booking->req_person_fax,
			"REQ_PERSON_EMAIL"			=> $booking->req_person_email,

			"REQ_AGENT_NAME"			=> $booking->req_agent_name,
			"REQ_AGENT_ADDRESS"			=> $booking->req_agent_address,
			"REQ_AGENT_CITY"			=> $booking->req_agent_city,
			"REQ_AGENT_STATE"			=> $booking->req_agent_state,
			"REQ_AGENT_ZIPCODE"			=> $booking->req_agent_zipcode,

			"SERVICE_OPTION"			=> $service_option,
			"PAXS"						=> $paxs,
		);
		return $tpl_data;
	}
	
	function data_info($tpl_data)
	{
		$paxs = $tpl_data["PAXS"];
		
		$trl_lines = "";
		$style = 'style="border: 1px solid #CCC;"';
		for ($i=0; $i<sizeof($paxs); $i++) {
			$trl_lines .= '<tr><td align="center" '.$style.'>'.($i+1).'</td>
								<td '.$style.'>'.$paxs[$i]["directorname"].'</td>
								<td align="center" '.$style.'>'.$paxs[$i]["directoraddress1"].'</td>
								<td align="center" '.$style.'>'.$paxs[$i]["directoraddress2"].'</td>
								<td align="center" '.$style.'>'.$paxs[$i]["directorcity"].'</td>
								<td align="center" '.$style.'>'.$paxs[$i]["directorstate"].'</td>
								<td align="center" '.$style.'>'.$paxs[$i]["directorcountry"].'</td>
								<td align="center" '.$style.'>'.$paxs[$i]["directorcode"].'</td>';
			$trl_lines .= '</tr>';
		}
		
		$result = '<fieldset style="border:1px solid #DADCE0; background-color: #FFFFFF;">
					<legend style="border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px"><strong>Your Apply Service Information Details</strong></legend>
					<div>
						<div style="color: #005286; font-weight: bold; padding: 10px 0 10px 20px;">
							A. Company details
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table>
								<tr><td>Jurisdiction</td><td> : </td><td>'.$tpl_data["JURISDICTION"].'</td></tr>
								<tr><td>Services</td><td> : </td><td>Company services</td></tr>
								<tr><td>Preferred</td><td> : </td><td>'.$tpl_data["PREFERRED"].'</td></tr>
								<tr><td>Alternate</td><td> : </td><td>'.$tpl_data["ALTERNATE"].'</td></tr>
								<tr><td>Shares</td><td> : </td><td>'.$tpl_data["SHARES"].'</td></tr>
								<tr><td>Sharesval</td><td> : </td><td>'.$tpl_data["SHARESVAL"].'</td></tr>
								<tr><td colspan="3" style="border-top: 1px dotted #CCCCCC; height: 1px;"></td></tr>
								<tr><td><b>Total services</b></td><td> : </td><td><b>'.$tpl_data["TOTAL_FEE"].' USD</b></td></tr>
							</table>
						</div>
					</div>
					<div>
						<div style="color: #005286; font-weight: bold; padding: 10px 0 10px 20px;">
							B. Initial Directors
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table cellpadding="4" cellspacing="0" border="0" style="border: 1px solid #DDDDDD; border-collapse: collapse; border-spacing: 0; margin: 0;">
								<tr>
									<th style="background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">No.</th>
									<th style="background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Name</th>
									<th style="background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Address1</th>
									<th style="background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Address2</th>
									<th style="background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">City</th>
									<th style="background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">State</th>
									<th style="background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Country</th>
									<th style="background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Code</th>';
									$result .= '</tr>
								'.$trl_lines.'
							</table>
						</div>
					</div>
					<div>
						<div style="color: #005286; font-weight: bold; padding: 10px 0 10px 20px;">
							C. Shipping Address
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table>
								<tr><td>Full name</td><td> : </td><td>'.$tpl_data["REQ_SHIP_TITLE"].'. '.$tpl_data["REQ_SHIP_FULLNAME"].'</td></tr>
								<tr><td>Address</td><td> : </td><td>'.$tpl_data["REQ_SHIP_ADDRESS"].'</td></tr>
								<tr><td>City</td><td> : </td><td>'.$tpl_data["REQ_SHIP_CITY"].'</td></tr>
								<tr><td>Province</td><td> : </td><td>'.$tpl_data["REQ_SHIP_PROVINCE"].'</td></tr>
								<tr><td>Zipcode</td><td> : </td><td>'.$tpl_data["REQ_SHIP_ZIPCODE"].'</td></tr>
								<tr><td>Country</td><td> : </td><td>'.$tpl_data["REQ_SHIP_COUNTRY"].'</td></tr>
								<tr><td>Day phone</td><td> : </td><td>'.$tpl_data["REQ_SHIP_DAY_PHONE"].'</td></tr>
								<tr><td>Evening phone</td><td> : </td><td>'.$tpl_data["REQ_SHIP_EVENING_PHONE"].'</td></tr>
								<tr><td>Fax</td><td> : </td><td>'.$tpl_data["REQ_SHIP_FAX"].'</td></tr>
								<tr><td>Email</td><td> : </td><td>'.$tpl_data["REQ_SHIP_EMAIL"].'</td></tr>
							</table>
						</div>
					</div>
					<div>
						<div style="color: #005286; font-weight: bold; padding: 10px 0 10px 20px;">
							D. Corporate Legal Address
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table>
								<tr><td>Full name</td><td> : </td><td>'.$tpl_data["REQ_CORP_TITLE"].'. '.$tpl_data["REQ_CORP_FULLNAME"].'</td></tr>
								<tr><td>Address</td><td> : </td><td>'.$tpl_data["REQ_CORP_ADDRESS"].'</td></tr>
								<tr><td>City</td><td> : </td><td>'.$tpl_data["REQ_CORP_CITY"].'</td></tr>
								<tr><td>Province</td><td> : </td><td>'.$tpl_data["REQ_CORP_PROVINCE"].'</td></tr>
								<tr><td>Zipcode</td><td> : </td><td>'.$tpl_data["REQ_CORP_ZIPCODE"].'</td></tr>
								<tr><td>Country</td><td> : </td><td>'.$tpl_data["REQ_CORP_COUNTRY"].'</td></tr>
								<tr><td>Day phone</td><td> : </td><td>'.$tpl_data["REQ_CORP_DAY_PHONE"].'</td></tr>
								<tr><td>Evening phone</td><td> : </td><td>'.$tpl_data["REQ_CORP_EVENING_PHONE"].'</td></tr>
								<tr><td>Fax</td><td> : </td><td>'.$tpl_data["REQ_CORP_FAX"].'</td></tr>
								<tr><td>Email</td><td> : </td><td>'.$tpl_data["REQ_CORP_EMAIL"].'</td></tr>
							</table>
						</div>
					</div>
					<div>
						<div style="color: #005286; font-weight: bold; padding: 10px 0 10px 20px;">
							E. Address of Person Placing Order
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table>
								<tr><td>Full name</td><td> : </td><td>'.$tpl_data["REQ_PERSON_TITLE"].'. '.$tpl_data["REQ_PERSON_FULLNAME"].'</td></tr>
								<tr><td>Address</td><td> : </td><td>'.$tpl_data["REQ_PERSON_ADDRESS"].'</td></tr>
								<tr><td>City</td><td> : </td><td>'.$tpl_data["REQ_PERSON_CITY"].'</td></tr>
								<tr><td>Province</td><td> : </td><td>'.$tpl_data["REQ_PERSON_PROVINCE"].'</td></tr>
								<tr><td>Zipcode</td><td> : </td><td>'.$tpl_data["REQ_PERSON_ZIPCODE"].'</td></tr>
								<tr><td>Country</td><td> : </td><td>'.$tpl_data["REQ_PERSON_COUNTRY"].'</td></tr>
								<tr><td>Day phone</td><td> : </td><td>'.$tpl_data["REQ_PERSON_DAY_PHONE"].'</td></tr>
								<tr><td>Evening phone</td><td> : </td><td>'.$tpl_data["REQ_PERSON_EVENING_PHONE"].'</td></tr>
								<tr><td>Fax</td><td> : </td><td>'.$tpl_data["REQ_PERSON_FAX"].'</td></tr>
								<tr><td>Email</td><td> : </td><td>'.$tpl_data["REQ_PERSON_EMAIL"].'</td></tr>
							</table>
						</div>
					</div>
					<div>
						<div style="color: #005286; font-weight: bold; padding: 10px 0 10px 20px;">
							F. Registered Agent Address
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table>
								<tr><td>Full name</td><td> : </td><td>'.$tpl_data["REQ_AGENT_NAME"].'</td></tr>
								<tr><td>Address</td><td> : </td><td>'.$tpl_data["REQ_AGENT_ADDRESS"].'</td></tr>
								<tr><td>City</td><td> : </td><td>'.$tpl_data["REQ_AGENT_CITY"].'</td></tr>
								<tr><td>STATE</td><td> : </td><td>'.$tpl_data["REQ_AGENT_STATE"].'</td></tr>
								<tr><td>Zipcode</td><td> : </td><td>'.$tpl_data["REQ_AGENT_ZIPCODE"].'</td></tr>
							</table>
						</div>
					</div>
				</fieldset>';
		return $result;
	}

	function visa_payment_successful($tpl_data)
	{
		$todo = "";
		if (!$tpl_data["FULL_PACKAGE"]) {
			$todo .= '<li>Prepare '.$tpl_data["STAMPING_FEE"].'USD/person in cash for <a style="color: red;" href="'.site_url("visa-fee").'">stamping fee</a> at the airport.</li>';
		}
		
		if ($tpl_data["PROCESSING_TIME"] == "Urgent") {
			$processing_time = '<p>
									<strong><u>This email to confirm that:</u></strong>
									<ul>
										<li>You are successful to apply visa online and paid for '.$tpl_data["PROCESSING_TIME"].' case.</li>
										<li>We will process and send you the visa approved letter in 4 to 8 working hours via email (except weekend and holiday). If you need visa right away, you can reply this email or call us at: <font color="red">'.HOTLINE.'</font></li>
										<li>Please send us the correct flight number and arrival time if you have fast track or car pick up service to avoid missing service.</li>
										<li>All information must be the same as state on your passport, if not extra charges will be caused.</li>
									</ul>
								</p>
								<p>';
			if ($tpl_data["BOOKING_TYPE_ID"] == 2) {
			$processing_time .= '<strong><u>Things to do:</u></strong>
									<ul style="list-style-type: decimal;">
										<li>Check the information carefully and print out the eVisa.</li>
										<li>Present your passport and eVisa at the indicated port of entry</li>
									</ul>';
			} else {
			$processing_time .= '<strong><u>Thing to do before arrival airport:</u></strong>
									<ul style="list-style-type: decimal;">
										<li>Print out the visa approved letter which will be sent to your email.</li>
										<li>Prepare 2 photos (size 4x6cm) or you can take photos at the airport with 5USD/person</li>
										'.$todo.'
										<li>Print and fill out Immigration form <a style="color: red;" href="https://www.vietnam-visa.org.vn/files/upload/file/Documents/Form-XNC.pdf">download here</a> (to avoid wasting your time at the arrival airport).</li>
									</ul>';
			}
			$processing_time .= '</p>';
		}
		else if ($tpl_data["PROCESSING_TIME"] == "Emergency") {
			$processing_time = '<p>
									<strong><u><font color="red">For emergency case, we require some necessary information:</font></u></strong>
									<ul style="list-style-type: decimal;">
										<li>Please confirm your current location.</li>
										<li>Please send us your passport scan (you can capture by phone).</li>
										<li>Please confirm your flight number and arrival time.</li>
										<li>1 to 4 hours processing, if you need visa letter right away you can call us at <font color="red">'.HOTLINE.'</font> or <font color="red">'.HOTLINE.'</font></li>
									</ul>
									<font color="red">And you must reply this email with all requires information above.</font>
								</p>
								<p>';
			if ($tpl_data["BOOKING_TYPE_ID"] == 2) {
			$processing_time .= '<strong><u>Things to do:</u></strong>
									<ul style="list-style-type: decimal;">
										<li>Check the information carefully and print out the eVisa.</li>
										<li>Present your passport and eVisa at the indicated port of entry</li>
									</ul>';
			} else {
			$processing_time .= '<strong><u>Thing to do before arrival airport:</u></strong>
									<ul style="list-style-type: decimal;">
										<li>Print out the visa approved letter which will be sent to your email.</li>
										<li>Prepare 2 photos (size 4x6cm) or you can take photos at the airport with 5USD/person</li>
										'.$todo.'
										<li>Print and fill out Immigration form <a style="color: red;" href="https://www.vietnam-visa.org.vn/files/upload/file/Documents/Form-XNC.pdf">download here</a> (to avoid wasting your time at the arrival airport).</li>
									</ul>';
			}
			$processing_time .= '</p>';
		}
		else if ($tpl_data["PROCESSING_TIME"] == "Holiday") {
			$processing_time = '<p>
									<strong><u><font color="red">For emergency case, we require some necessary information:</font></u></strong>
									<ul style="list-style-type: decimal;">
										<li>Please confirm your current location.</li>
										<li>Please send us your passport scan (you can capture by phone).</li>
										<li>Please confirm your flight number and arrival time.</li>
										<li>1 to 4 hours processing, if you need visa letter right away you can call us at <font color="red">'.HOTLINE.'</font> or <font color="red">'.HOTLINE.'</font></li>
									</ul>
									<font color="red">And you must reply this email with all requires information above.</font>
								</p>
								<p>';
			if ($tpl_data["BOOKING_TYPE_ID"] == 2) {
			$processing_time .= '<strong><u>Things to do:</u></strong>
									<ul style="list-style-type: decimal;">
										<li>Check the information carefully and print out the eVisa.</li>
										<li>Present your passport and eVisa at the indicated port of entry</li>
									</ul>';
			} else {
			$processing_time .= '<strong><u>Thing to do before arrival airport:</u></strong>
									<ul style="list-style-type: decimal;">
										<li>We will send you the visa letter for boarding the airplane only. <font color="red">Not for using at the arrival airport</font>.</li>
										<li>Prepare 2 photos (size 4x6cm) or you can take photos at the airport with price 5USD/person</li>
										<li>All the fee you are paid and our person at the arrival airport will take care visa for you.</li>
										<li>Print and fill out Immigration form <a style="color: red;" href="https://www.vietnam-visa.org.vn/files/upload/file/Documents/Form-XNC.pdf">download here</a> (to avoid wasting your time at the arrival airport).</li>
									</ul>';
			}
			$processing_time .= '</p>
								<p><font color="red">You must read and clear all instructions above. Reply and confirm you did read this email.</font></p>';
		}
		else {
			$processing_time = '<p>
									<strong><u>This email to confirm that:</u></strong>
									<ul>
										<li>You are successful to apply visa online and paid for '.$tpl_data["PROCESSING_TIME"].' case.</li>
										<li>We will process and send you the visa approved letter in 24 to 48 hours via email (except weekend and holiday). If you need visa right away, you can reply this email or call us at: <font color="red">'.HOTLINE.'</font></li>
										<li>Please send us the correct flight number and arrival time if you have fast track or car pick up service to avoid missing service.</li>
										<li>All information must be the same as state on your passport, if not extra charges will be caused.</li>
									</ul>
								</p>
								<p>';
			if ($tpl_data["BOOKING_TYPE_ID"] == 2) {
			$processing_time .= '<strong><u>Things to do:</u></strong>
									<ul style="list-style-type: decimal;">
										<li>Check the information carefully and print out the eVisa.</li>
										<li>Present your passport and eVisa at the indicated port of entry</li>
									</ul>';
			} else {
			$processing_time .= '<strong><u>Thing to do before arrival airport:</u></strong>
									<ul style="list-style-type: decimal;">
										<li>Print out the visa approved letter which will be sent to your email. Please check your email and make sure your email is correctly.</li>
										<li>Prepare 2 photos (size 4x6cm) or you can take photos at the airport with price 5USD/person</li>
										'.$todo.'
										<li>Print and fill out Immigration form <a style="color: red;" href="https://www.vietnam-visa.org.vn/files/upload/file/Documents/Form-XNC.pdf">download here</a> (to avoid wasting your time at the arrival airport).</li>
									</ul>';
			}
			$processing_time .= '</p>';
		}
		
		$order_ref = "";
		if ($tpl_data["PAYMENT_METHOD"] == "OnePay") {
			$order_ref .= '<p>Order Reference: <strong>'.$tpl_data["ORDER_REF"].'</strong></p>';
			$order_ref .= '<br>';
		}
		$code_booking = ($tpl_data["BOOKING_TYPE_ID"] == 2) ? BOOKING_E_PREFIX : BOOKING_PREFIX;
		$content = '<div>
						<p>Dear <b>'.$tpl_data["FULLNAME"].'</b>,</p>
						<p>Thanks for booking with us, your visa application is successful with ID: <strong>'.$code_booking.$tpl_data["BOOKING_ID"].'</strong></p>
						'.$processing_time.'
						<p><font style="color: red;">* Please be noted:</font> This confirmation email is not visa approval letter for you to get visa sticker at the airport, we will send it to you in next email. Please check your email and make sure your email is correctly.</p>
						<p>All information must be exacted as your passport. Any wrong information, you must contact us before you arrive in Vietnam. We will not respond with any troubles if you give us incorrect passport information.</p>
					</div>
					<br>
					'.$this->visa_info($tpl_data).'
					<br>
					<h3><strong>Cancellation and Refund Policy</strong></h3>
					<p><strong><u>Refundable:</u></strong></p>
					<ul>
						<li>Visa service fees: will be refunded full amount if: denied application(s) by Vietnam Immigration Department, website owner mistake, or you must contact us for cancel maximum 1 hour after applying visa form.</li>
						<li>Fast-track: website owner mistake or not coming to welcome you at the airport or you must contact us at least 24 hours before your departure.</li>
						<li>Stamping fee: FULL refund if you will not arrive Vietnam or cancel visa.</li>
					</ul>
					<p><strong><u>Non refundable:</u></strong></p>
					<ul>
						<li>Mistake(s) from applicant(s), so you must check to make sure all information are correct after applying visa.</li>
						<li>Your application is processing or service delivery (via email) or any changes after service is completed.</li>
						<li>All the payment over 6 months, will not refund.</li>
					</ul>
					'.$order_ref;
		return $this->template($content);
	}
	
	function visa_payment_failure($tpl_data)
	{
		$todo = "";
		// if (!$tpl_data["FULL_PACKAGE"]) {
		// 	$todo .= '<li><i>All the service fee is not including stamping fee for Government at the airport.</i></li>';
		// }
		
		if ($tpl_data["PROCESSING_TIME"] == "Urgent") {
			$processing_time = '<p>
									<strong><u>This email to confirm that:</u></strong>
									<ul>
										<li>You are applying '.$tpl_data["PROCESSING_TIME"].' visa to Vietnam and you have not paid yet. So your visa have not approved yet.</li>
										<li>You wish to have visa, you can pay us via this link: '.site_url("payment-online").'</li>
										<li>Or you can call us at: <font color="red">'.HOTLINE.'</font>, if you have trouble with your payment.</li>
										'.$todo.'
									</ul>
								</p>
								<p><font style="color: red;">* Please be noted:</font> This confirmation email is not visa approval letter for you to get visa sticker at the airport, we will send visa letter after you settle the payment.</p>';
		}
		else if ($tpl_data["PROCESSING_TIME"] == "Emergency") {
			$processing_time = '<p>
									<strong><u>This email to confirm that:</u></strong>
									<ul>
										<li>You are applying '.$tpl_data["PROCESSING_TIME"].' visa to Vietnam and you have not paid yet. So your visa have not approved yet.</li>
										<li>You wish to have visa, you can pay us via this link: '.site_url("payment-online").'</li>
										<li>Or you can call us at: <font color="red">'.HOTLINE.'</font>, if you have trouble with your payment.</li>
										'.$todo.'
									</ul>
								</p>
								<p><font style="color: red;">* Please be noted:</font> This confirmation email is not visa approval letter for you to get visa sticker at the airport, we will send visa letter after you settle the payment.</p>';
		}
		else if ($tpl_data["PROCESSING_TIME"] == "Holiday") {
			$processing_time = '<p>
									<strong><u>This email to confirm that:</u></strong>
									<ul>
										<li>You are applying '.$tpl_data["PROCESSING_TIME"].' visa to Vietnam and you have not paid yet. So your visa have not approved yet.</li>
										<li>You wish to have visa, you can pay us via this link: '.site_url("payment-online").'</li>
										<li>Or you can call us at: <font color="red">'.HOTLINE.'</font>, if you have trouble with your payment.</li>
										<li><i>All the service fee is including stamping fee for Government at the airport.</i></li>
									</ul>
								</p>
								<p>
									<font style="color: red;">* Please be noted:</font>
									<ul>
										<li>This confirmation email is not visa approval letter for you to get visa sticker at the airport, we will send visa letter after you settle the payment.</li>
										<li>You must have correct flight number and arrival time</li>
										<li>Holiday visa is valid for single entry 15 days in HCM airport, 30 days in Hanoi. If you need multiple, you have to delay to next Monday.</li>
										<li>This case is invalid for Da Nang airport.</li>
									</ul>
								</p>';
		}
		else {
			$processing_time = '<p>
									<strong><u>This email to confirm that:</u></strong>
									<ul>
										<li>You are applying visa to Vietnam and you have not paid yet. So your visa have not approved yet.</li>
										<li>You wish to have visa, you can pay us via this link: '.site_url("payment-online").'</li>
										<li>Or you can call us at: <font color="red">'.HOTLINE.'</font>, if you have trouble with your payment.</li>
										'.$todo.'
									</ul>
								</p>
								<p><font style="color: red;">* Please be noted:</font> This confirmation email is not visa approval letter for you to get visa sticker at the airport, we will send visa letter after you settle the payment.</p>';
		}
		$code_booking = ($tpl_data["BOOKING_TYPE_ID"] == 2) ? BOOKING_E_PREFIX : BOOKING_PREFIX;
		$content = '<div>
						<p>Dear <b>'.$tpl_data["FULLNAME"].'</b>,</p>
						<p>Thanks for booking with us, your visa application ID: <strong>'.$code_booking.$tpl_data["BOOKING_ID"].'</strong></p>
						'.$processing_time.'
						<p>Please double check to make sure all your information you give us correctly as in your passport. We will not response with any troubles if you give us incorrect passport information.</p>
					</div>
					<br>'.$this->visa_info($tpl_data);
		return $this->template($content);
	}
	
	function company_service_payment_remind($tpl_data)
	{
		$content = '<div>
						<p>Dear <b>'.$tpl_data["REQ_SHIP_TITLE"].'</b>,</p>
						<p>Thanks for booking with us, your visa application ID: <strong>'.CODE_COMPANY_SERVICE.$tpl_data["BOOKING_ID"].'</strong></p>
						<p>Please double check to make sure all your information you give us correctly as in your passport. We will not response with any troubles if you give us incorrect passport information.</p>
					</div>
					<br>'.$this->data_info($tpl_data).'
					<p>If you have any questions, please contact us immediately.</p>';
		return $this->template($content);
	}
	
	function payment_online_info($tpl_data)
	{
		return '<fieldset style="border:1px solid #DADCE0;">
					<legend style="border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px"><strong>Payment Details</strong></legend>
					<div>
						<div style="padding: 10 0 10px 20px;">
							<table>
								<tr><td>Full Name</td><td> : </td><td>'.$tpl_data["FULLNAME"].'</td></tr>
								<tr><td>Primary Email</td><td> : </td><td><a href="mailto:'.$tpl_data["PRIMARY_EMAIL"].'">'.$tpl_data["PRIMARY_EMAIL"].'</a></td></tr>
								<tr><td>Application ID</td><td> : </td><td>'.$tpl_data["APPLICATION_ID"].'</td></tr>
								<tr><td>Amount</td><td> : </td><td>'.$tpl_data["AMOUNT"].' USD</td></tr>
								<tr><td>Note for Payment</td><td> : </td><td>'.$tpl_data["NOT_4_PAYMENT"].'</td></tr>
							</table>
						</div>
					</div>
				</fieldset>';
	}

	function payment_online_successful($tpl_data)
	{
		$content = '<div>
						<p>Dear: <b>'.$tpl_data["FULLNAME"].'</b></p>
						<p>Thanks for booking with us!</p>
						<p>* This is confirmation from us to show that you are successful in payment online. We will have double check and send you a letter later.</p>
						<p>* Payment successful via <b>'.$tpl_data["PAYMENT_METHOD"].'</b> payment gate.</p>
						<p>* Total amount for service charge: <b>'.$tpl_data["AMOUNT"].'</b> USD.</p>
						<p><b>* Please double check for making sure your information is correctly as in your passport. Any change after visa approved will be charged!</b></p>
					</div>
					<br>'.$this->payment_online_info($tpl_data);
		return $this->template($content);
	}
	
	function payment_online_failure($tpl_data)
	{
		$content = '<div>
						<p>Dear: <b>'.$tpl_data["FULLNAME"].'</b></p>
						<p>Thanks for booking with us!</p>
						<p>* This is confirmation from us to show that you was not successful in payment online. Because you can not settle the payment with our system. May your credit card issue some where and you are way from there. Or some reasons for security.</p>
						<p>* Payment unsuccessful via <b>'.$tpl_data["PAYMENT_METHOD"].'</b> payment gate.</p>
						<p>* If you wish to pay via Paypal, You can pay us directly to account: '.PAYPAL_PAYMENT.'</p>
						<p>* Total amount for service charge: <b>'.$tpl_data["AMOUNT"].'</b> USD.</p>
						<p><b>* Please double check for making sure your information is correctly as in your passport. Any change after visa approved will be charged!</b></p>
					</div>
					<br>'.$this->payment_online_info($tpl_data);
		return $this->template($content);
	}
	
	function payment_online_remind($tpl_data)
	{
		$content = '<div>
						<p>Dear: <b>'.$tpl_data["FULLNAME"].'</b></p>
						<p>Thanks for booking with us!</p>
						<p>* This is confirmation from us to show that you are making new payment online with us.</p>
						<p>* Payment method: <b>'.$tpl_data["PAYMENT_METHOD"].'</b></p>
						<p>* Total amount for service charge: <b>'.$tpl_data["AMOUNT"].'</b> USD.</p>
						<p>* You can pay us via Paypal address: '.PAYPAL_PAYMENT.'</p>
						<p>* For secure reason, we accept payment from third party only as: www.paypal.com or Western Union or Bank transfer. (Please do not send us your credit cards detail)</p>
						<p><b>* Please double check for making sure your information is correctly as in your passport. Any change after visa approved will be charged!</b></p>
					</div>
					<br>'.$this->payment_online_info($tpl_data);
		return $this->template($content);
	}
	
	function need_support($tpl_data)
	{
		$content = '<fieldset style="border:1px solid #DADCE0;">
						<legend style="border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px"><strong>Request Support Details</strong></legend>
						<div>
							<div style="padding: 10 0 10px 20px;">
								<table>
									<tr><td>Primary Email</td><td> : </td><td><a href="mailto:'.$tpl_data["PRIMARY_EMAIL"].'">'.$tpl_data["PRIMARY_EMAIL"].'</a></td></tr>
									<tr><td>Secondary Email</td><td> : </td><td><a href="mailto:'.$tpl_data["SECONDARY_EMAIL"].'">'.$tpl_data["SECONDARY_EMAIL"].'</a></td></tr>
									<tr><td>Full Name</td><td> : </td><td>'.$tpl_data["FULLNAME"].'</td></tr>
									<tr><td>Airport Conceige</td><td> : </td><td>'.$tpl_data["AIRPORT_CONCEIGZE"].'</td></tr>
									<tr><td>Car Pickup</td><td> : </td><td>'.$tpl_data["CAR_PICKUP"].'</td></tr>
									<tr><td>Hotel Booking</td><td> : </td><td>'.$tpl_data["HOTEL_BOOKING"].'</td></tr>
									<tr><td>Optional Tours</td><td> : </td><td>'.$tpl_data["OPTIONAL_TOUR"].'</td></tr>
									<tr><td>Domestic Flights</td><td> : </td><td>'.$tpl_data["DOMESTIC_FLIGHT"].'</td></tr>
								</table>
							</div>
						</div>
					</fieldset>';
		return $this->template($content);
	}
	
	function check_status($tpl_data)
	{
		$content = '<fieldset style="border:1px solid #DADCE0;">
						<legend style="border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px"><strong>Request Support Details</strong></legend>
						<div>
							<div style="padding: 10 0 10px 20px;">
								<table>
									<tr><td>Primary Email</td><td> : </td><td><a href="mailto:'.$tpl_data["PRIMARY_EMAIL"].'">'.$tpl_data["PRIMARY_EMAIL"].'</a></td></tr>
									<tr><td>Secondary Email</td><td> : </td><td><a href="mailto:'.$tpl_data["SECONDARY_EMAIL"].'">'.$tpl_data["SECONDARY_EMAIL"].'</a></td></tr>
									<tr><td>Full Name</td><td> : </td><td>'.$tpl_data["FULLNAME"].'</td></tr>
									<tr><td>Passport</td><td> : </td><td>'.$tpl_data["PASSPORT"].'</td></tr>
									<tr><td>Message</td><td> : </td><td>'.$tpl_data["MESSAGE"].'</td></tr>
								</table>
							</div>
						</div>
					</fieldset>';
		return $this->template($content);
	}
	
	function forgot_password($tpl_data)
	{
		$content = '<div>
						<p>Dear <b>'.$tpl_data["FULLNAME"].'</b>,</p>
						<br>
						<p>We have received forgot password request for your account.</p>
						<p>Please return to the <a href="'.BASE_URL.'">'.SITE_NAME.'</a> website and log in using the following information:</p>
						<p>Email: '.$tpl_data["EMAIL"].'</p>
						<p>Password: '.$tpl_data["PASSWORD"].'</p>
						<br>
						<p>Please do not hesitate to contact us if you have any problem!</p>
						<br>
						<p>Best regards,</p>
						<p><b>VIETNAM VISA DEPT.</b></p>
					</div>';
		return $content;
	}
	
	function register_successful($tpl_data)
	{
		$content = '<div>
						<p>Dear <b>'.$tpl_data["FULLNAME"].'</b>,</p>
						<br>
						<p>Thank you for your registration to <a href="'.BASE_URL.'">'.SITE_NAME.'</a>!</p>
						<p>This email to confirm that you have registered account successful with us.</p>
						<p>Please return to the <a href="'.site_url("member").'">'.SITE_NAME.'</a> website and login with the email that you have registered.</p>
						<p>Please do not hesitate to contact us if you have any problem!</p>
						<br>
						<p>Best regards,</p>
						<p><b>VIETNAM VISA DEPT.</b></p>
					</div>';
		return $content;
	}
	
	function question_reply($tpl_data)
	{
		return '<html lang="en-US">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					</head>
					<body style="font-family: Arial,Tahoma,sans-serif; font-size: 12px;">
						<div style="padding-bottom: 10px; border-bottom: 2px solid #DF1F26">
							<div style="float:left">
								<img alt="Vietnam Immigration" src="'.IMG_URL.'vietnam-visa-logo.png">
							</div>
							<div style="float:right">
								<a href="'.BASE_URL.'">HOME</a> | 
								<a href="'.site_url("answers").'">QUESTION</a> |
								<a href="'.site_url("faqs").'">FAQ</a>
							</div>
							<div style="clear:both"></div>
						</div>
						<div style="margin: 20px 0px">
							<p>Hello '.$tpl_data['fullname'].':</p>				
							<p>Your question on <a href="'.SITE_NAME.'">'.SITE_NAME.'</a> has received a reply:</p>
							<br/>
							<div>
								<div style=""><strong>Question</strong></div>
								<p>'.$tpl_data['question']->title.'</p>
							</div>
							<br/>
							<div>
								<div><strong>Reply</strong></div>
								<p>'.$tpl_data['answer'].'</p>
							</div>
							<br/>
							<div>
								<div><strong>Your next steps*</strong></div>
								<p>
									Did this reply answer your question?
									<br/>
									[<a href="'.site_url("answers/view/".$tpl_data["question"]->alias).'">Mark a new reply on this answer</a>]
								</p>
								<p>
									Have a new question?
									<br/>
									[<a href="'.site_url("ask").'">Ask more question</a>]
								</p>
							</div>
						</div>
						<div style="padding: 10px 0px; border-top: 2px solid #DF1F26; font-size: 10px;">
							Please do not reply directly to this message. If you need our help, please <a href="'.site_url("ask").'">submit your question</a> or contact us by <a href="mailto:'.MAIL_INFO.'">email</a> or phone '.HOTLINE.'.
						</div>
					<body>
				</html>';
	}




	function template_remind_arrival_date($content)
	{
		return '<!DOCTYPE html>
				<html lang="en-US">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
						<style>
							*{
								margin:0;
								padding:0;
							}
						</style>
					</head>
					<body style="font-family: Arial,Tahoma,sans-serif; font-size: 13px; padding: 30px;">
						<table style="border: 1px solid #BBCDD9;">
							<tr>
								<td style="padding: 15px 30px;">
									<div style="width: 100%; display: table;">
										<div style="width: 50%; display: table-cell; vertical-align: middle;">
											<img width="220px" src="https://www.vietnam-visa.org.vn/template/images/logo-email-vietnam-visa.png"/>
										</div>
										<div style="width: 50%; display: table-cell; vertical-align: middle; text-align: right;padding: 15px 30px; color: #e42827; font-size: 18px;">
											<strong>Hotline: '.HOTLINE.'</strong>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td style="padding: 15px 30px;">
									'.$content.'
								</td>
							</tr>
							<tr>
								<td style="padding: 15px;background: #e7eef9;">
									<div style="display:table;width:100%;">
										<div style="display:table-cell;padding: 0 15px 15px 15px;vertical-align:middle;width: 80%">
											<table>
												<tr><td colspan="3"><b>VIETNAM VISA DEPT.</b></td></tr>
												<tr><td>Address</td><td>:</td><td>'.ADDRESS.'</td></tr>
												<tr><td>Website</td><td>:</td><td><a href="'.BASE_URL.'" target="_blank">www.'.strtolower(SITE_NAME).'</a></td></tr>
											</table>
										</div>
										<div style="display:table-cell;padding: 0 15px 15px 15px;text-align:right;vertical-align:middle;width: 20%">
											<a href="https://www.facebook.com/vietnamvisavs"><img style="width: 15px;" src="https://www.vietnam-visa.org.vn/template/images/template_mail/mail_remind/icon-facebook.png"></a>
										</div>
									</div>
								</td>
							</tr>
						</table>
					</body>
				</html>';
	}
	
	function visa_info_remind_arrival_date($tpl_data)
	{
		$paxs = $tpl_data["PAXS"];
		
		$processingTime = "";
		if ($tpl_data["PROCESSING_TIME"] != "Normal") {
			$processingTime .= '<tr><td>Processing ('.$tpl_data["PROCESSING_TIME"].')</td><td> : </td><td>'.$tpl_data["RUSH_FEE"].' USD/pax</td></tr>';
		}
		
		$privateVisa = "";
		if (!empty($tpl_data["PRIVATE_VISA"])) {
			$privateVisa = '<tr><td>Private letter</td><td> : </td><td>'.$tpl_data["PRIVATE_VISA_FEE"].' USD</td></tr>';
		}
		
		$fullPackage = "";
		if ($tpl_data["FULL_PACKAGE"]) {
			$fullPackage .= '<tr><td>Visa stamping fee</td><td> : </td><td>'.$tpl_data["STAMPING_FEE"].' USD/pax</td></tr>';
			$fullPackage .= '<tr><td>Airport fast check-in</td><td> : </td><td>'.$tpl_data["FULL_PACKAGE_FC_FEE"].' USD/pax</td></tr>';
		}
		
		$carPickup = "";
		if ($tpl_data["CAR_PICKUP"]) {
			$carPickup = '<tr><td>Car pick-up</td><td> : </td><td>'.$tpl_data["CAR_PICKUP_FEE"].' USD</td></tr>';
		}
		
		$airportFastCheckin = "";
		if ($tpl_data["AIRPORT_FAST_CHECKIN"] == 1) {
			$airportFastCheckin = '<tr><td>Airport fast check-in</td><td> : </td><td>'.$tpl_data["AIRPORT_FAST_CHECKIN_FEE"].' USD</td></tr>';
		}
		else if ($tpl_data["AIRPORT_FAST_CHECKIN"] == 2) {
			$airportFastCheckin = '<tr><td>VIP fast check-in</td><td> : </td><td>'.$tpl_data["AIRPORT_FAST_CHECKIN_FEE"].' USD</td></tr>';
		}
		
		$discount = "";
		if ($tpl_data["VIPDISCOUNT"]) {
			$discount .= '<tr><td>VIP discount</td><td> : </td><td>-'.$tpl_data["VIPDISCOUNT"].' USD</td></tr>';
		}
		// if ($tpl_data["SERVICE_FEE_DISCOUNT"]) {
		// 	$discount .= '<tr><td>Visa service fee discount</td><td> : </td><td>-'.$tpl_data["SERVICE_FEE_DISCOUNT"].' USD</td></tr>';
		// }
		if ($tpl_data["DISCOUNT"]) {
			$discount .= '<tr><td>Promotion discount</td><td> : </td><td>-'.$tpl_data["DISCOUNT"].' USD</td></tr>';
		}
		
		$flightNumber = "";
		if (!empty($tpl_data["FLIGHT_NUMBER"])) {
			$flightNumber = '<tr><td>Flight number</td><td> : </td><td>'.$tpl_data["FLIGHT_NUMBER"].'</td></tr>';
		}
		$arrivalTime  = "";
		if (!empty($tpl_data["ARRIVAL_TIME"])) {
			$arrivalTime  = '<tr><td>Arrival time</td><td> : </td><td>'.$tpl_data["ARRIVAL_TIME"].'</td></tr>';
		}
		
		$trl_lines = "";
		if (!empty($paxs)) {
			$style = 'padding: 5px; border: 1px solid #CCC;';
			for ($i=0; $i<sizeof($paxs); $i++) {
				$trl_lines .= '<tr><td style="'.$style.'" align="center">'.($i+1).'</td>
									<td style="'.$style.'">'.$paxs[$i]["fullname"].'</td>
									<td style="'.$style.'" align="center">'.$paxs[$i]["gender"].'</td>
									<td style="'.$style.'" align="center">'.date("M/d/Y", strtotime($paxs[$i]["birthday"])).'</td>
									<td style="'.$style.'" align="center">'.$paxs[$i]["nationality"].'</td>
									<td style="'.$style.'" align="center">'.$paxs[$i]["passport"].'</td>
									<td style="'.$style.'" align="center">'.date("M/d/Y",strtotime($tpl_data["ARRIVAL_DATE"])).'</td>
									<td style="'.$style.'" align="center">'.$tpl_data["ARRIVAL_PORT"].'</td>';
									if ($tpl_data["BOOKING_TYPE_ID"] == 2) {
										$trl_lines .= '<td style="'.$style.'" align="center">'.$paxs[$i]["passport_type"].'</td>
										<td style="'.$style.'" align="center">'.date("M/d/Y",strtotime($paxs[$i]["expiry_date"])).'</td>
										<td style="'.$style.'" align="center">'.$paxs[$i]["religion"].'</td>
										<td style="'.$style.'" align="center"><a href="'.BASE_URL.$paxs[$i]["passport_photo"].'">Download</a></td>
										<td style="'.$style.'" align="center"><a href="'.BASE_URL.$paxs[$i]["passport_data"].'">Download</a></td>
										';
									} else {
										$trl_lines .= '<td style="'.$style.'">'.$tpl_data["VISA_TYPE"].'</td>';
									}
				$trl_lines .= '</tr>';
			}
		}
		
		$result = '<fieldset style="border:1px solid #DADCE0; background-color: #e7eef9;padding:30px;">
					<strong>Your Apply Visa Information Details</strong>
					<div style="background-color:#fff;margin-top:20px;">
						<div>
							<div style="color: #005286; font-weight: bold; padding: 10px 0 10px 20px;">
								Visa Options
							</div>
							<div style="padding: 0 0 10px 40px;">
								<table>
									<tr><td>Type of visa</td><td> : </td><td>'.$tpl_data["VISA_TYPE"].'</td></tr>
									<tr><td>Purpose of visit</td><td> : </td><td>'.$tpl_data["VISIT_PURPOSE"].'</td></tr>
									<tr><td>Arrival airport</td><td> : </td><td>'.$tpl_data["ARRIVAL_PORT"].'</td></tr>
									<tr><td>Arrival date</td><td> : </td><td>'.date("M/d/Y",strtotime($tpl_data["ARRIVAL_DATE"])).'</td></tr>
									'.$flightNumber.$arrivalTime.'
									<tr><td>Number of applicants</td><td> : </td><td>'.$tpl_data["GROUP_SIZE"].'</td></tr>
									<tr><td>Visa service fee</td><td> : </td><td>'.$tpl_data["SERVICE_FEE"].' USD/pax</td></tr>
									'.$processingTime.'
									'.$privateVisa.$fullPackage.$airportFastCheckin.$carPickup.$discount.'
									<tr><td colspan="3" style="border-top: 1px dotted #CCCCCC; height: 1px;"></td></tr>
									<tr><td><b>Total services charge</b></td><td> : </td><td><b>'.$tpl_data["TOTAL_FEE"].' USD</b></td></tr>
								</table>
							</div>
						</div>';
			if (!empty($trl_lines)) {
			$result .=	'<div>
							<div style="color: #005286; font-weight: bold; padding: 10px 0 10px 20px;">
								Passport Detail of Applications
							</div>
							<div style="padding: 0 0 10px 40px;">
								<table cellpadding="4" cellspacing="0" border="0" style="border: 1px solid #DDDDDD; border-collapse: collapse; border-spacing: 0; margin: 0;">
									<tr>
										<th style="padding:5px;background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Applicant</th>
										<th style="padding:5px;background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Full name</th>
										<th style="padding:5px;background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Gender</th>
										<th style="padding:5px;background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Date of birth</th>
										<th style="padding:5px;background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Nationality</th>
										<th style="padding:5px;background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Passport number</th>
										<th style="padding:5px;background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Arrival date</th>
										<th style="padding:5px;background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Arrival airport</th>';
										if ($tpl_data["BOOKING_TYPE_ID"] == 2) {
											$result .= '
													<th style="padding:5px;background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Passport type</th>
													<th style="padding:5px;background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Expiry date</th>
													<th style="padding:5px;background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Religion</th>
													<th style="padding:5px;background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Photography</th>
													<th style="padding:5px;background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Passport data</th>';
										} else {
											$result .= '<th style="padding:5px;background-color: #F1F1F1;border: 1px solid #DDDDDD;font-weight: normal;text-align: center;vertical-align: middle;">Type of visa</th>';
										}
										$result .= '</tr>
									'.$trl_lines.'
								</table>
							</div>
						</div>';
			}
			$result	.=	'<div>
							<div style="color: #005286; font-weight: bold; padding: 10px 0 10px 20px;">
								Contact Information
							</div>
							<div style="padding: 0 0 10px 40px;">
								<table>
									<tr><td>Full name</td><td> : </td><td>'.$tpl_data["CONTACT_TITLE"].'. '.$tpl_data["CONTACT_FULLNAME"].'</td></tr>
									<tr><td>Email</td><td> : </td><td><a href="mailto:'.$tpl_data["PRIMARY_EMAIL"].'">'.$tpl_data["PRIMARY_EMAIL"].'</a></td></tr>
									<tr><td>Alternate email</td><td> : </td><td><a href="mailto:'.$tpl_data["SECONDARY_EMAIL"].'">'.$tpl_data["SECONDARY_EMAIL"].'</a></td></tr>
									<tr><td>Phone number</td><td> : </td><td><a href="tel:'.$tpl_data["CONTACT_PHONE"].'">'.$tpl_data["CONTACT_PHONE"].'</a></td></tr>
									<tr><td>Special request</td><td> : </td><td>'.$tpl_data["SPECIAL_REQUEST"].'</td></tr>
								</table>
							</div>
						</div>
					</div>
					<div style="padding: 10px 0">
						<a style="color:#2680eb;text-decoration: none;" href="https://www.beetrip.net">Some famous tourist destinations in Vietnam</a><br>
						<!--<p>Some things to keep in mind when coming to Vietnam: <a href="https://www.vietnam-visa.org.vn/news/view/some-things-to-keep-in-mind-when-coming-to-vietnam.html">Click here</a></p>-->
					</div>
				</fieldset>';
		return $result;
	}
	function visa_remind_arrival_date($tpl_data=null,$fullname = null)
	{
		$content = '<div>
						<p>Dear <b>'.(!empty($tpl_data["FULLNAME"]) ? $tpl_data["FULLNAME"] : $fullname).'</b>,</p>
						<p>It is Mia here from Vietnam-Visa.Org.Vn Business Site. I wanted to check in to see how things have been going since you booked a couple of days ago.</p>
						<p>If you have any questions, you can reach me anytime, just reply directly to this message. Feel free to send over any feedback or let me know if there is anything I can do to help.</p>
					</div>';
			if (!empty($tpl_data)) {
				$content .= '<br>'.$this->visa_info_remind_arrival_date($tpl_data).'<br>';
			}
		$content .= '<p>If you have any questions, please contact us immediately.</p>
					<br>
					<p style="color:#696969;">Best,<br>Mia<br>Business Support Manager</p>';
		return $this->template_remind_arrival_date($content);
	}
	function cron_sendmail_promotion() {
		$content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html>
			<head>
			<meta charset="utf-8">
			<meta http-equiv="content-type" content="text/html; charset=UTF-8">
			<title>Apply Vietnam Visa Online - Get visa to Vietnam in 30 minutes</title>
			<style type="text/css" media="screen">
			*{
				margin: 0;
				padding: 0;
			}
			</style>
			</head>
			<body style="font-family: Arial,Tahoma,sans-serif; font-size: 16px;line-height: 24px;color: #4d4d4d;background: #f1f1f1; margin:0; padding:0;">
			<div style="width:600px;margin:auto;background:#ed1b24;">
			<div style="padding:15px;">
				<div style="background:#fff;">
				<div style="width: 100%; display: table;">
					<div style="width: 30%; display: table-cell; vertical-align: middle; padding: 10px 30px;">
						<img width="150px" src="https://www.vietnam-visa.org.vn/template/images/logo-email-vietnam-visa.png"/>
					</div>
					<div style="width: 70%; display: table-cell; vertical-align: middle; text-align: right;padding: 15px 30px; color: #e42827; font-size: 18px;">
						<strong>'.HOTLINE.'</strong>
					</div>
				</div>
				<div style="padding: 10px 30px;">
				<img width="100%" src="https://www.vietnam-visa.org.vn/template/images/template_mail/mail_remind/vietnam-visa-on-arrival.jpg"/>
				</div>
				<div style="padding: 15px 30px;font-size: 14px;">
					<div style="padding: 10px 20px; text-align: center;">
						<div style="background: #f8d6d5;padding: 18px 0;">
							<strong style="font-size: 60px;color: red;margin: 25px 0;display: block;">25% OFF</strong>
						</div>
						<div style="line-height: 28px;padding: 15px 0;;background: #fbebeb;">
							<div style="margin-bottom: 10px;font-size: 18px;font-weight: bold;">APPLY WITH CODE</div>
							<a style="color: red;font-weight: bold;border: 2px red dashed;font-size: 30px;padding: 5px 10px;">VS2519</a>
							<p style="margin-top: 15px;">FROM JULY 1ST, 2019 TO DECEMBER 31ST, 2019</p>
						</div>
					</div>
					<div style="text-align: center;margin-top: 15px;">
						<a style="text-decoration: none;color: #fff;background: red;font-weight: bold;font-size: 25px;line-height: 65px;padding: 10px;" href="https://www.vietnam-visa.org.vn/apply-visa.html">APPLY NOW</a>
					</div>
				</div>
				</div>
			</div>
			<div style="display:table;width:100%; color: #fff;">
				<div style="display:table-cell;padding: 0 15px 15px 15px;vertical-align:middle;font-size:13px;width: 80%">
				©2019 by www.vietnam-visa.org.vn. All rights reserved.
				</div>
				<div style="display:table-cell;padding: 0 15px 15px 15px;text-align:right;vertical-align:middle;width: 20%">
				<a href="https://www.facebook.com/vietnamvisavs"><img style="width: 25px;" src="https://www.vietnam-visa.org.vn/template/images/template_mail/mail_remind/fb-fff.png"></a>
				</div>
			</div>
			</div>
			</body>
		</html>';
	return $content;
	}
	function send_approved_visa_list($tpl_data)
	{
		$ci =& get_instance();

		$ci->load->library('util');
		$template = '<!DOCTYPE html>
					<html lang="en-US">
						<head>
							<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
							<style>
								*{
									margin:0;
									padding:0;
								}
							</style>
						</head>
						<body style="font-family: Arial,Tahoma,sans-serif; font-size: 13px; padding: 30px;">
							<table style="border: thin solid #999;border-collapse: collapse;" id="export-list" class="table table-bordered table-hover">
								<tr>
									<th style="border: thin solid #999; padding:2px;background: #eee; text-align:center;" colspan="17">For tourist list</th>
								</tr>
								<tr>
									<th style="border: thin solid #999; padding:2px;" width="50px">
										No.
									</th>';
						if ($tpl_data['TYPE'] == 'admin') {
						$template.='<th style="border: thin solid #999; padding:2px;" width="100px">
										App No
									</th>';
						}
						$template.='<th style="border: thin solid #999; padding:2px;">
										Fullname
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Gender
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Birth Date
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Nationality
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Passport No
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Arrival Date
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Arrival Port
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Type
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Purpose
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="80px">
										Private
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										Process
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										FC
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										Flight
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										Note
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Attach file
									</th>
								</tr>';
				$i=0;
				$visa_type = $tpl_data['VISA_TYPE'];
				foreach ($tpl_data['ITEMS'] as $item) {
					if($item->visit_purpose == 'For tourist') {
						if ($item->{$visa_type} == 1) {
							$code = ($item->booking_type_id) ? BOOKING_PREFIX : BOOKING_E_PREFIX;
							//
							$arr_type = array(
								'1 month single' => '',
								'1 month multiple' => '1TNL',
								'3 months single' => '3T1L',
								'3 months multiple' => '3TNL',
								'6 months multiple' => '6TNL',
								'1 year multiple' => '1NNL',
							);
							//
							$private_visa = !empty($item->private_visa) ? 'CV Riêng' : '';
							//
							$note_process = '';
							if(empty($item->note_process)) {
								if ($item->visit_purpose == 'For tourist'){
									switch ($item->rush_type) {
										case 1:
											$note_process = 'URG4H';
											break;
										case 2:
											$note_process = 'URG1H';
											break;
										case 3:
											$note_process = 'DNG';
											break;
									}
								} else {
									switch ($item->rush_type) {
										case 1:
											$note_process = 'URG8H';
											break;
										case 2:
											$note_process = 'URG4H';
											break;
										case 3:
											$note_process = 'DNG';
											break;
									}
								}
							} else {
								$note_process = $item->note_process;
							}
							$note_fc = '';
							if ((date('Y-m-d',strtotime($item->arrival_date)) >= date('Y-m-d',strtotime($item->paid_date))) && (date('Y-m-d',strtotime($item->arrival_date)) <= date('Y-m-d',strtotime("{$item->paid_date} + 2days"))) && ($item->agents_id == $item->agents_fc_id))
							{
								$note_fc = $ci->util->fc($item->full_package,$item->fast_checkin,$item->car_pickup,$item->booking_type_id)[1];
							}
							//
							$files = glob("files/upload/image/{$tpl_data['ATTACH_FILE']}/{$item->pax_id}/*");
							$str_attach_file = '';
							foreach ($files as $file) {
								$file_name = explode($item->pax_id.'/', $file);
								$str_attach_file .= '<a style="display:block;" href="'.BASE_URL."/files/upload/image/{$tpl_data['ATTACH_FILE']}/{$item->pax_id}/$file_name[1]".'">Tải về</a>';
							}
							$flight_number = '';
							if(!empty($item->flight_number)) { 
								$flight_number = $item->flight_number;
							} else {
								if ((date('Y-m-d',strtotime($item->arrival_date)) >= date('Y-m-d',strtotime($item->paid_date))) && (date('Y-m-d',strtotime($item->arrival_date)) <= date('Y-m-d',strtotime("{$item->paid_date} + 2days"))) && ($item->agents_id == $item->agents_fc_id) && (!empty($item->fast_checkin) || !empty($item->car_pickup) || !empty($item->full_package))) {
									$flight_number = $item->vb_flight_number.' - '.$item->arrival_time;
								}
							}
							//
							$template.='<tr class="row1 prss0">';
							$template.='<td style="vertical-align: middle;border: thin solid #999; padding:2px;">'.($i+1).'</td>';
							if ($tpl_data['TYPE'] == 'admin') {
								$template.='<td style="vertical-align: middle;border: thin solid #999; padding:2px;">'.$code.$item->book_id.'</td>';
							}
								$template.='<td style="vertical-align: middle;border: thin solid #999; padding:2px;">'.$item->fullname.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->gender.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.date('M/d/Y',strtotime($item->birthday)).'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->nationality.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->passport.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.date('M/d/Y',strtotime($item->arrival_date)).'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->arrival_port.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$arr_type[$item->visa_type].'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->visit_purpose.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$private_visa.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$note_process.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$note_fc.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$flight_number.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->note.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$str_attach_file.'</td>
										</tr>';
						$i++;
						}
					}
					
				}
				$template.='</table>
							<br><br>
							<table style="border: thin solid #999;border-collapse: collapse;" id="export-list" class="table table-bordered table-hover">
								<tr>
									<th style="border: thin solid #999; padding:2px;background: #eee; text-align:center;" colspan="17">For business list</th>
								</tr>
								<tr>
									<th style="border: thin solid #999; padding:2px;" width="50px">
										No.
									</th>';
						if ($tpl_data['TYPE'] == 'admin') {
						$template.='<th style="border: thin solid #999; padding:2px;" width="100px">
										App No
									</th>';
						}
						$template.='<th style="border: thin solid #999; padding:2px;">
										Fullname
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Gender
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Birth Date
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Nationality
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Passport No
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Arrival Date
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Arrival Port
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Type
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Purpose
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="80px">
										Private
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										Process
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										FC
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										Flight
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										Note
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Attach file
									</th>
								</tr>';
				$i=0;
				foreach ($tpl_data['ITEMS'] as $item) {;
					if($item->visit_purpose == 'For business') {
						if ($item->{$visa_type} == 1) {
							$code = ($item->booking_type_id) ? BOOKING_PREFIX : BOOKING_E_PREFIX;
							//
							$arr_type = array(
								'1 month single' => '',
								'1 month multiple' => '1TNL',
								'3 months single' => '3T1L',
								'3 months multiple' => '3TNL',
								'6 months multiple' => '6TNL',
								'1 year multiple' => '1NNL',
							);
							//
							$private_visa = !empty($item->private_visa) ? 'CV Riêng' : '';
							//
							$note_process = '';
							if(empty($item->note_process)) {
								if ($item->visit_purpose == 'For tourist'){
									switch ($item->rush_type) {
										case 1:
											$note_process = 'URG4H';
											break;
										case 2:
											$note_process = 'URG1H';
											break;
										case 3:
											$note_process = 'DNG';
											break;
									}
								} else {
									switch ($item->rush_type) {
										case 1:
											$note_process = 'URG8H';
											break;
										case 2:
											$note_process = 'URG4H';
											break;
										case 3:
											$note_process = 'DNG';
											break;
									}
								}
							} else {
								$note_process = $item->note_process;
							}
							$note_fc = '';
							if ((date('Y-m-d',strtotime($item->arrival_date)) >= date('Y-m-d',strtotime($item->paid_date))) && (date('Y-m-d',strtotime($item->arrival_date)) <= date('Y-m-d',strtotime("{$item->paid_date} + 2days"))) && ($item->agents_id == $item->agents_fc_id))
							{
								$note_fc = $ci->util->fc($item->full_package,$item->fast_checkin,$item->car_pickup,$item->booking_type_id)[1];
							}
							//
							$files = glob("files/upload/image/{$tpl_data['ATTACH_FILE']}/{$item->pax_id}/*");
							$str_attach_file = '';
							foreach ($files as $file) {
								$file_name = explode($item->pax_id.'/', $file);
								$str_attach_file .= '<a style="display:block;" href="'.BASE_URL."/files/upload/image/{$tpl_data['ATTACH_FILE']}/{$item->pax_id}/$file_name[1]".'">Tải về</a>';
							}
							//
							$flight_number = '';
							if(!empty($item->flight_number)) { 
								$flight_number = $item->flight_number;
							} else {
								if ((date('Y-m-d',strtotime($item->arrival_date)) >= date('Y-m-d',strtotime($item->paid_date))) && (date('Y-m-d',strtotime($item->arrival_date)) <= date('Y-m-d',strtotime("{$item->paid_date} + 2days"))) && ($item->agents_id == $item->agents_fc_id) && (!empty($item->fast_checkin) || !empty($item->car_pickup) || !empty($item->full_package))) {
									$flight_number = $item->vb_flight_number.' - '.$item->arrival_time;
								}
							}
							$template.='<tr class="row1 prss0">';
								$template.='<td style="vertical-align: middle;border: thin solid #999; padding:2px;">'.($i+1).'</td>';
							if ($tpl_data['TYPE'] == 'admin') {
								$template.='<td style="vertical-align: middle;border: thin solid #999; padding:2px;">'.$code.$item->book_id.'</td>';
							}
								$template.='<td style="vertical-align: middle;border: thin solid #999; padding:2px;">'.$item->fullname.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->gender.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.date('M/d/Y',strtotime($item->birthday)).'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->nationality.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->passport.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.date('M/d/Y',strtotime($item->arrival_date)).'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->arrival_port.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$arr_type[$item->visa_type].'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->visit_purpose.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$private_visa.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$note_process.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$note_fc.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$flight_number.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->note.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$str_attach_file.'</td>
										</tr>';
						$i++;
						}
					}
					
				}
				$template.='</table>
						</body>
					</html>';
		return $template;
	}
	function send_fc_visa_list($tpl_data)
	{
		$ci =& get_instance();

		$ci->load->library('util');
		$template = '<!DOCTYPE html>
					<html lang="en-US">
						<head>
							<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
							<style>
								*{
									margin:0;
									padding:0;
								}
							</style>
						</head>
						<body style="font-family: Arial,Tahoma,sans-serif; font-size: 13px; padding: 30px;">
							<table style="border: thin solid #999;border-collapse: collapse;" id="export-list" class="table table-bordered table-hover">
								<tr>
									<th style="border: thin solid #999; padding:2px;background: #eee; text-align:center;" colspan="17">For tourist list</th>
								</tr>
								<tr>
									<th style="border: thin solid #999; padding:2px;" width="50px">
										No.
									</th>';
						if ($tpl_data['TYPE'] == 'admin') {
						$template.='<th style="border: thin solid #999; padding:2px;" width="100px">
										App No
									</th>';
						}
						$template.='<th style="border: thin solid #999; padding:2px;">
										Fullname
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Gender
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Birth Date
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Nationality
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Passport No
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Arrival Date
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Arrival Port
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Type
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Purpose
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="80px">
										Private
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										Process
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										FC
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										Flight
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										Note
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Attach file
									</th>
								</tr>';
				$i=0;
				$visa_type = $tpl_data['VISA_TYPE'];
				foreach ($tpl_data['ITEMS'] as $item) {
					if($item->visit_purpose == 'For tourist') {
						if ($item->{$visa_type} == 1) {
							$code = ($item->booking_type_id) ? BOOKING_PREFIX : BOOKING_E_PREFIX;
							//
							$arr_type = array(
								'1 month single' => '',
								'1 month multiple' => '1TNL',
								'3 months single' => '3T1L',
								'3 months multiple' => '3TNL',
								'6 months multiple' => '6TNL',
								'1 year multiple' => '1NNL',
							);
							//
							$private_visa = !empty($item->private_visa) ? 'CV Riêng' : '';
							//
							$note_process = '';
							if(empty($item->note_process)) {
								if ($item->visit_purpose == 'For tourist'){
									switch ($item->rush_type) {
										case 1:
											$note_process = 'URG4H';
											break;
										case 2:
											$note_process = 'URG1H';
											break;
										case 3:
											$note_process = 'DNG';
											break;
									}
								} else {
									switch ($item->rush_type) {
										case 1:
											$note_process = 'URG8H';
											break;
										case 2:
											$note_process = 'URG4H';
											break;
										case 3:
											$note_process = 'DNG';
											break;
									}
								}
							} else {
								$note_process = $item->note_process;
							}
							$note_fc = $ci->util->fc($item->full_package,$item->fast_checkin,$item->car_pickup,$item->booking_type_id)[1];
							//
							$files = glob("files/upload/image/{$tpl_data['ATTACH_FILE']}/{$item->pax_id}/*");
							$str_attach_file = '';
							foreach ($files as $file) {
								$file_name = explode($item->pax_id.'/', $file);
								$str_attach_file .= '<a style="display:block;" href="'.BASE_URL."/files/upload/image/{$tpl_data['ATTACH_FILE']}/{$item->pax_id}/$file_name[1]".'">Tải về</a>';
							}
							//
							$flight_number_fc = !empty($item->flight_number_fc) ? $item->flight_number_fc : $item->vb_flight_number.' - '.$item->arrival_time;

							$template.='<tr class="row1 prss0">';
							$template.='<td style="vertical-align: middle;border: thin solid #999; padding:2px;">'.($i+1).'</td>';
							if ($tpl_data['TYPE'] == 'admin') {
								$template.='<td style="vertical-align: middle;border: thin solid #999; padding:2px;">'.$code.$item->book_id.'</td>';
							}
								$template.='<td style="vertical-align: middle;border: thin solid #999; padding:2px;">'.$item->fullname.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->gender.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.date('M/d/Y',strtotime($item->birthday)).'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->nationality.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->passport.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.date('M/d/Y',strtotime($item->arrival_date)).'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->arrival_port.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$arr_type[$item->visa_type].'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->visit_purpose.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$private_visa.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$note_process.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$note_fc.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$flight_number_fc.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->note_list_fc.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$str_attach_file.'</td>
										</tr>';
						$i++;
						}
					}
					
				}
				foreach ($tpl_data['SERVICES_ITEMS'] as $item) {
					$note_fc = $ci->util->fc($item->full_package,$item->fast_checkin,$item->car_pickup)[1];

					$template.='<tr class="row1 prss0">';
					$template.='<td style="vertical-align: middle;border: thin solid #999; padding:2px;">'.($i+1).'</td>';
					if ($tpl_data['TYPE'] == 'admin') {
						$template.='<td style="vertical-align: middle;border: thin solid #999; padding:2px;">EX-'.$item->id.'</td>';
					}
						$template.='<td style="vertical-align: middle;border: thin solid #999; padding:2px;">'.$item->welcome_name.'</td>
									<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;"></td>
									<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;"></td>
									<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;"></td>
									<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;"></td>
									<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.date('M/d/Y',strtotime($item->arrival_date)).'</td>
									<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->arrival_port.'</td>
									<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;"></td>
									<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;"></td>
									<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;"></td>
									<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;"></td>
									<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$note_fc.'</td>
									<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->flight_number.'</td>
									<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->note.'</td>
									<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;"></td>
								</tr>';
					$i++;
					
				}
				$template.='</table>
							<br><br>
							<table style="border: thin solid #999;border-collapse: collapse;" id="export-list" class="table table-bordered table-hover">
								<tr>
									<th style="border: thin solid #999; padding:2px;background: #eee; text-align:center;" colspan="17">For business list</th>
								</tr>
								<tr>
									<th style="border: thin solid #999; padding:2px;" width="50px">
										No.
									</th>';
						if ($tpl_data['TYPE'] == 'admin') {
						$template.='<th style="border: thin solid #999; padding:2px;" width="100px">
										App No
									</th>';
						}
						$template.='<th style="border: thin solid #999; padding:2px;">
										Fullname
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Gender
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Birth Date
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Nationality
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Passport No
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Arrival Date
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Arrival Port
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Type
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Purpose
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="80px">
										Private
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										Process
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										FC
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										Flight
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center" width="100px">
										Note
									</th>
									<th style="border: thin solid #999; padding:2px; text-align: center">
										Attach file
									</th>
								</tr>';
				$i=0;
				foreach ($tpl_data['ITEMS'] as $item) {;
					if($item->visit_purpose == 'For business') {
						if ($item->{$visa_type} == 1) {
							$code = ($item->booking_type_id) ? BOOKING_PREFIX : BOOKING_E_PREFIX;
							//
							$arr_type = array(
								'1 month single' => '',
								'1 month multiple' => '1TNL',
								'3 months single' => '3T1L',
								'3 months multiple' => '3TNL',
								'6 months multiple' => '6TNL',
								'1 year multiple' => '1NNL',
							);
							//
							$private_visa = !empty($item->private_visa) ? 'CV Riêng' : '';
							//
							$note_process = '';
							if(empty($item->note_process)) {
								if ($item->visit_purpose == 'For tourist'){
									switch ($item->rush_type) {
										case 1:
											$note_process = 'URG4H';
											break;
										case 2:
											$note_process = 'URG1H';
											break;
										case 3:
											$note_process = 'DNG';
											break;
									}
								} else {
									switch ($item->rush_type) {
										case 1:
											$note_process = 'URG8H';
											break;
										case 2:
											$note_process = 'URG4H';
											break;
										case 3:
											$note_process = 'DNG';
											break;
									}
								}
							} else {
								$note_process = $item->note_process;
							}
							$note_fc = $ci->util->fc($item->full_package,$item->fast_checkin,$item->car_pickup,$item->booking_type_id)[1];
							//
							$files = glob("files/upload/image/{$tpl_data['ATTACH_FILE']}/{$item->pax_id}/*");
							$str_attach_file = '';
							foreach ($files as $file) {
								$file_name = explode($item->pax_id.'/', $file);
								$str_attach_file .= '<a style="display:block;" href="'.BASE_URL."/files/upload/image/{$tpl_data['ATTACH_FILE']}/{$item->pax_id}/$file_name[1]".'">Tải về</a>';
							}
							//
							$flight_number_fc = !empty($item->flight_number_fc) ? $item->flight_number_fc : $item->vb_flight_number.' - '.$item->arrival_time;
							$template.='<tr class="row1 prss0">';
								$template.='<td style="vertical-align: middle;border: thin solid #999; padding:2px;">'.($i+1).'</td>';
							if ($tpl_data['TYPE'] == 'admin') {
								$template.='<td style="vertical-align: middle;border: thin solid #999; padding:2px;">'.$code.$item->book_id.'</td>';
							}
								$template.='<td style="vertical-align: middle;border: thin solid #999; padding:2px;">'.$item->fullname.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->gender.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.date('M/d/Y',strtotime($item->birthday)).'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->nationality.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->passport.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.date('M/d/Y',strtotime($item->arrival_date)).'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->arrival_port.'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$arr_type[$item->visa_type].'</td>
											<td style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->visit_purpose.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$private_visa.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$note_process.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$note_fc.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$flight_number_fc.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$item->note_list_fc.'</td>
											<td rowspan="1" style="vertical-align: middle;border: thin solid #999; padding:2px;text-align: center;">'.$str_attach_file.'</td>
										</tr>';
						$i++;
						}
					}
					
				}
				$template.='</table>
						</body>
					</html>';
		return $template;
	}
	function feedback_fc_service($tpl_data)
	{
		$content = '<div>
						<p>Are you satisfied with our services?</p>
						<p>Dear: <b>'.$tpl_data["FULLNAME"].'</b></p>
						<p>Thanks for choosing our service.</p>
						<p>We would love to hear about your experience with us.</p>
						<p>One of our teams picked you up at the airport on '.date('M/d/Y',strtotime("-2 days")).' and we wanted to find out how they\'ve done.</p>
						<p>The short survey only takes a few seconds to complete, and your feedback will help us tremendously to improve our services in the future.</p>
						<p>Please answer some questions as below:</p>
						<ul>
							<li><strong>How quickly did the customer service representatives at our company help you?</strong></li>
							<li><strong>Did you have to queue to get visa sticker and visa stamp?</strong></li>
							<li><strong>If you have any queries or if you experience problems using our service, please let us know.</strong></li>
						</ul>
						<p>We greatly appreciate your participation and look forward to hearing from you.</p>
						<p>We wish you a pleasant stay in Vietnam.</p>
						<br>
						<p>Best Regards,</p>
						<p>(Ms.Mia)</p>
					</div>';
		return $this->template($content);
	}
	function feedback_car_service($tpl_data)
	{
		$content = '<div>
						<p>Are you satisfied with our services?</p>
						<p>Dear: <b>'.$tpl_data["FULLNAME"].'</b></p>
						<p>Thanks for choosing our service.</p>
						<p>We would love to hear about your experience with us.</p>
						<p>One of our teams picked you up at the airport on '.date('M/d/Y',strtotime("-2 days")).' and we wanted to find out how they\'ve done.</p>
						<p>The short survey only takes a few seconds to complete, and your feedback will help us tremendously to improve our services in the future.</p>
						<p>Please answer some questions as below:</p>
						<ul>
							<li><strong>How quickly did the customer service representatives at our company help you?</strong></li>
							<li><strong>If you have any queries or if you experience problems using our service, please let us know.</strong></li>
						</ul>
						<p>We greatly appreciate your participation and look forward to hearing from you.</p>
						<p>We wish you have a pleasant stay during in Vietnam!</p>
						<br>
						<p>Best Regards,</p>
						<p>(Ms.Mia)</p>
					</div>';
		return $this->template($content);
	}
	function text_mail(){
		return '<p>failure</p>';
	}
	function contac_apply($tpl_data)
	{
		$content = '<div>
						<p> Service: '.$tpl_data["TITLE"].'</p>
						<p> Email: '.$tpl_data["EMAIL"].'</p>
						<p> Phone: '.$tpl_data["PHONE"].'</p>
						<p> Message: '.$tpl_data["CONTENT"].'</p>
						<br>
						<p>Best Regards,</p>
						<p>('.$tpl_data["FULLNAME"].')</p>
					</div>';
		return $this->template($content);
	}
}