<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apply_company_services extends CI_Controller {
	var $service_id = 1; // company-services

	public function __construct()
	{
		parent::__construct();
		
		$params = explode('/', current_url());
		
		$key = "";
		$paymentOk = false;
		
		// OnePay
		if (isset($_GET['vpc_TxnResponseCode']))
		{
			$vpc_Txn_Secure_Hash = $_GET["vpc_SecureHash"];
			$vpc_MerchTxnRef = $_GET["vpc_MerchTxnRef"];
			$vpc_AcqResponseCode = $_GET["vpc_AcqResponseCode"];
			unset($_GET["vpc_SecureHash"]);
			
			$key = $vpc_MerchTxnRef;
			
			// set a flag to indicate if hash has been validated
			$errorExists = false;
			
			if (strlen(OP_SECURE_SECRET) > 0 && $_GET["vpc_TxnResponseCode"] != "7" && $_GET["vpc_TxnResponseCode"] != "No Value Returned")
			{
			    ksort($_GET);
			    
			    $md5HashData = "";
			    
			    // sort all the incoming vpc response fields and leave out any with no value
			    foreach ($_GET as $k => $v) {
			        if ($k != "vpc_SecureHash" && (strlen($v) > 0) && ((substr($k, 0,4)=="vpc_") || (substr($k,0,5) =="user_"))) {
					    $md5HashData .= $k . "=" . $v . "&";
					}
			    }
			    
			    $md5HashData = rtrim($md5HashData, "&");
			
				if (strtoupper($vpc_Txn_Secure_Hash) == strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*',OP_SECURE_SECRET)))) {
			        // Secure Hash validation succeeded, add a data field to be displayed later.
			        $hashValidated = "CORRECT";
			    } else {
			        // Secure Hash validation failed, add a data field to be displayed later.
			        $hashValidated = "INVALID HASH";
			    }
			} else {
			    // Secure Hash was not validated, add a data field to be displayed later.
			    $hashValidated = "INVALID HASH";
			}
			
			if($hashValidated=="CORRECT" && $_GET["vpc_TxnResponseCode"]=="0") {
				// Transaction successful
				$paymentOk = true;
			} else if ($hashValidated=="INVALID HASH" && $_GET["vpc_TxnResponseCode"]=="0") {
				// Transaction is pendding
				$paymentOk = false;
			} else {
				// Transaction is failed
				$paymentOk = false;
			}
		}
		// G2S
		else if (isset($_GET['customField1']))
		{
			$key = $_GET['customField1'];
			
			//Status, could be APPROVED, PENDING, DECLINED or ERROR
			$checksum = md5(urldecode(G2S_SECRET_KEY.$_GET['totalAmount'].$_GET['currency'].$_GET['responseTimeStamp'].$_GET['PPP_TransactionID'].$_GET['Status'].$_GET['productId']));
			
			if ($_GET['Status'] && $checksum === $_GET['advanceResponseChecksum']) {
				if ($_GET['Status'] == 'APPROVED') {
					$paymentOk = true;
				}
				else {
					$paymentOk = false;
				}
			}
			else {
				$paymentOk = false;
			}
		}
		// Paypal
		else if (isset($_GET['token']))
		{
			$key = $_GET['key'];
			$token = $_GET['token'];
			
			$resArray = $this->paypal->GetShippingDetails($token);
			$ack = strtoupper($resArray["ACK"]);
			if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
				$resArray = $this->paypal->ConfirmPayment();
				$ack = strtoupper($resArray["ACK"]);
				if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
					$paymentOk = true;
				}
			}
		}
		
		if (!empty($key))
		{
			if ($paymentOk)
			{
				if (substr($key, 0 , 3) == "po_") {
					header('Location: '.BASE_URL."/payment-online/success.html?key=".$key);
					die();
				} else if (substr($key, 0 , 4) == "spo_") {
					header('Location: '.BASE_URL."/secured-payment-online/success.html?key=".$key);
					die();
				} else if (substr($key, 0 , 2) == "m_") {
					header('Location: '.BASE_URL."/member/payment-success.html?key=".$key);
					die();
				} else if (substr($key, 0 , 3) == "ex_") {
					header('Location: '.BASE_URL."/booking/payment-success.html?key=".$key);
					die();
				} else {
					header('Location: '.BASE_URL."/apply-company-services/success.html?key=".$key);
					die();
				}
			}
			else
			{
				if (substr($key, 0 , 3) == "po_") {
					header('Location: '.BASE_URL."/payment-online/failure.html?key=".$key);
					die();
				} else if (substr($key, 0 , 4) == "spo_") {
					header('Location: '.BASE_URL."/secured-payment-online/failure.html?key=".$key);
					die();
				} else if (substr($key, 0 , 2) == "m_") {
					header('Location: '.BASE_URL."/member/payment-failure.html?key=".$key);
					die();
				} else if (substr($key, 0 , 3) == "ex_") {
					header('Location: '.BASE_URL."/booking/payment-failure.html?key=".$key);
					die();
				} else {
					header('Location: '.BASE_URL."/apply-company-services/failure.html?key=".$key);
					die();
				}
			}
		}
	}

	public function prepare()
	{
		$this->session->unset_userdata("company_service");
		$company_service = new stdClass();

		$company_service->jurisdiction				= "";
		$company_service->service_option			= array();
		$company_service->services_id				= $this->service_id;
		$company_service->total_capital				= 0;
		$company_service->total_fee					= 0;
		$company_service->promotion_code			= 0;
		$company_service->discount					= 0;
		$company_service->address_detail 			= array();
		$company_service->preferred 				= "";
		$company_service->alternate 				= "";
		$company_service->shares 					= "";
		$company_service->sharesval 				= "";
		$company_service->req_ship_title 			= "";
		$company_service->req_ship_fullname 		= "";
		$company_service->req_ship_address 			= "";
		$company_service->req_ship_city 			= "";
		$company_service->req_ship_province 		= "";
		$company_service->req_ship_zipcode 			= "";
		$company_service->req_ship_country 			= "";
		$company_service->req_ship_day_phone 		= "";
		$company_service->req_ship_evening_phone 	= "";
		$company_service->req_ship_phone 			= "";
		$company_service->req_ship_fax 				= "";
		$company_service->req_ship_email 			= "";
		$company_service->req_corp_title 			= "";
		$company_service->req_corp_fullname 		= "";
		$company_service->req_corp_address 			= "";
		$company_service->req_corp_city 			= "";
		$company_service->req_corp_province 		= "";
		$company_service->req_corp_zipcode 			= "";
		$company_service->req_corp_country 			= "";
		$company_service->req_corp_day_phone 		= "";
		$company_service->req_corp_evening_phone 	= "";
		$company_service->req_corp_phone 			= "";
		$company_service->req_corp_fax 				= "";
		$company_service->req_corp_email 			= "";
		$company_service->req_person_title 			= "";
		$company_service->req_person_fullname 		= "";
		$company_service->req_person_address 		= "";
		$company_service->req_person_city 			= "";
		$company_service->req_person_province 		= "";
		$company_service->req_person_zipcode 		= "";
		$company_service->req_person_country 		= "";
		$company_service->req_person_day_phone 		= "";
		$company_service->req_person_evening_phone 	= "";
		$company_service->req_person_phone 			= "";
		$company_service->req_person_fax 			= "";
		$company_service->req_person_email 			= "";
		$company_service->req_agent_name 			= "";
		$company_service->req_agent_address 		= "";
		$company_service->req_agent_city 			= "";
		$company_service->req_agent_state 			= "";
		$company_service->req_agent_zipcode 		= "";

		$this->session->set_userdata("company_service", $company_service);
	}
	public function index()
	{
		$this->prepare();
		$jurisdictions = $this->m_jurisdictions->items();

		$view_data = array();
		$view_data['jurisdictions'] 	= $jurisdictions;
		$view_data['service_id'] 		= $this->service_id;
		
		$tmpl_content = array();
		// $tmpl_content['meta']['title'] = $this->util->getMetaTitle($service);
		// $tmpl_content['meta']['keywords'] = $service->meta_key;
		// $tmpl_content['meta']['description'] = $service->meta_desc;
		$tmpl_content['content'] = $this->load->view("apply/step", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
	public function get_list_service_type_fee() {
		$services_tab_fee_id = $this->input->post('services_tab_fee_id');

		$info = new stdClass();
		$info->services_tab_fee_id = $services_tab_fee_id;
		$items = $this->m_services_fee->items($info);
		$total = 0;
		foreach ($items as $item) {
			if (empty($item->recomen)) {
				$total += $item->fee;
			}
		}

		echo json_encode(array($items, $total));
	}
	public function get_list_service_fee() {
		$nation = $this->input->post('nation');

		$info = new stdClass();
		$info->nation_alias = $nation;
		$jurisdiction_id = $this->m_jurisdictions->jion_nation($info)->jurisdiction_id;

		$info = new stdClass();
		$info->jurisdiction_id = $jurisdiction_id;
		$info->service_id = $this->service_id;
		$type_items = $this->m_services_tab_fee->items($info);

		$info->services_tab_fee_id = $type_items[0]->id;
		$items = $this->m_services_fee->items($info);

		$total = 0;
		foreach ($items as $item) {
			if (empty($item->recomen)) {
				$total += $item->fee;
			}
		}
		echo json_encode(array($items, $total, $type_items));
	}
	public function get_service_fee() {
		$id = $this->input->post('id');
		echo json_encode($this->m_services_fee->load($id));
	}
	function login()
	{
		$company_service = $this->session->userdata("company_service");
		
		if ($company_service == null) {
			redirect(site_url("{$this->util->slug($this->router->fetch_class())}"));
		}
		
		$breadcrumb = array('Member Login' => '');
		
		$this->session->set_userdata("return_url", site_url("{$this->util->slug($this->router->fetch_class())}/step1"));
		
		$this->load->library('user_agent');
		$agent = 'Unidentified';
		if ($this->agent->is_browser()) {
			$agent = $this->agent->browser();
		}
		
		$view_data = array();
		$view_data["breadcrumb"] = $breadcrumb;
		$view_data["agent"] = $agent;
		
		$tmpl_content = array();
		$tmpl_content['meta']['title'] = "Apply Vietnam Visa At The Official Site ".SITE_NAME;
		$tmpl_content['meta']['description'] = "Apply Vietnam visa online using our secure online form at the official site of ".SITE_NAME.". Get visa approval letters in one working day only!";
		$tmpl_content['tabindex'] = "{$this->util->slug($this->router->fetch_class())}";
		$tmpl_content['content'] = $this->load->view("apply/login", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
	function dologin()
	{
		$company_service = $this->session->userdata("company_service");
		
		if ($company_service == null) {
			redirect(site_url("{$this->util->slug($this->router->fetch_class())}"));
		}
		
		$task = (!empty($_POST["task"]) ? $_POST["task"] : "login");
		
		if ($task == "login")
		{
			$email = (!empty($_POST["email"]) ? $_POST["email"] : "");
			$password = (!empty($_POST["password"]) ? $_POST["password"] : "");
			
			$data = new stdClass();
			$data->email = $email;
			$data->password = $password;
			$this->session->set_flashdata("login", $data);
			
			$info = new stdClass();
			$info->username = $email;
			$info->password = $password;
			
			$user = $this->m_user->user($info, 1);
			
			if ($user != null) {
				$this->m_user->login($email, $password);
			}
			else {
				$this->session->set_flashdata("status", "Invalid email or password.");
				redirect(site_url("{$this->util->slug($this->router->fetch_class())}/login"), "back");
			}
		}
		else if ($task == "register")
		{
			$new_title		= (!empty($_POST["new_title"]) ? $_POST["new_title"] : "");
			$new_fullname	= (!empty($_POST["new_fullname"]) ? $_POST["new_fullname"] : "");
			$new_email		= (!empty($_POST["new_email"]) ? $_POST["new_email"] : "");
			$new_password	= (!empty($_POST["new_password"]) ? $_POST["new_password"] : "");
			$new_phone		= (!empty($_POST["new_phone"]) ? $_POST["new_phone"] : "");
			
			$data->new_title = $new_title;
			$data->new_fullname = $new_fullname;
			$data->new_email = $new_email;
			$data->new_password = $new_password;
			$data->new_phone = $new_phone;
			$this->session->set_flashdata("login", $data);
			
			if (empty($new_fullname)) {
				$this->session->set_flashdata("status", "Full name is required.");
				redirect(BASE_URL_HTTPS."/{$this->util->slug($this->router->fetch_class())}/login.html", "back");
			}
			else if (empty($new_email)) {
				$this->session->set_flashdata("status", "Email is required.");
				redirect(BASE_URL_HTTPS."/{$this->util->slug($this->router->fetch_class())}/login.html", "back");
			}
			else if ($this->m_user->is_user_exist($new_email)) {
				$this->session->set_flashdata("status", "This email is already in used. Please input another email address.");
				redirect(BASE_URL_HTTPS."/{$this->util->slug($this->router->fetch_class())}/login.html", "back");
			}
			else if (strlen($new_password) < 6) {
				$this->session->set_flashdata("status", "Password must be at least 6 characters long.");
				redirect(BASE_URL_HTTPS."/{$this->util->slug($this->router->fetch_class())}/login.html", "back");
			}
			else {
				$data = array(
					"title"				=> $new_title,
					"user_fullname"		=> $new_fullname,
					"user_login"		=> $new_email,
					"user_pass"			=> md5($new_password),
					"password_text"		=> $new_password,
					"user_email"		=> $new_email,
					"active"			=> 1,
					"phone"				=> $new_phone,
					"user_registered"	=> date($this->config->item("log_date_format")),
					"client_ip"			=> $this->util->realIP()
				);
				$this->m_user->add($data);
				
				// Auto Login
				$info->username = $new_email;
				$info->password = $new_password;
				
				$user = $this->m_user->user($info);
				
				if ($user != null) {
					$this->m_user->login($new_email, $new_password);
					
					// SEND MAIL TO USER
					$tpl_data = array(
						"FULLNAME"	=> $user->user_fullname,
						"EMAIL"		=> $user->user_login,
						"PASSWORD"	=> $user->password_text,
					);
					
					$message = $this->mail_tpl->register_successful($tpl_data);
					
					// Send to SALE Department
					$mail = array(
						"subject"		=> "Registration Successful - ".SITE_NAME,
						"from_sender"	=> MAIL_INFO,
						"name_sender"	=> $user->user_fullname,
						"to_receiver"	=> $user->user_email,
						"message"		=> $message
					);
					$this->mail->config($mail);
					$this->mail->sendmail();
				} else {
					$this->session->set_flashdata("error", "Invalid email or password.");
					redirect(site_url("{$this->util->slug($this->router->fetch_class())}/login"), "back");
				}
			}
		}
		
		if ($user != null) {
			// if (empty($step1->contact_title)) {
			// 	$step1->contact_title = $user->title;
			// }
			// if (empty($step1->contact_fullname)) {
			// 	$step1->contact_fullname = $user->user_fullname;
			// }
			// if (empty($step1->contact_email)) {
			// 	$step1->contact_email = $user->user_email;
			// }
			// if (empty($step1->contact_phone)) {
			// 	$step1->contact_phone = $user->phone;
			// }
			
			// // Re-calculate the total fee
			// $step1->vip_discount = $this->vip()->discount;
			
			// if ($step1->discount > 0) {
			// 	$step1->vip_discount = 0;
			// }
			
			// if ($step1->visa_type == "6mm" || $step1->visa_type == "1ym") {
			// 	$step1->vip_discount = 0;
			// }
			
			// $step1->total_fee = $step1->total_service_fee + $step1->total_rush_fee + $step1->business_visa_fee + $step1->private_visa_fee + $step1->full_package_total_fee + $step1->fast_checkin_total_fee + $step1->car_total_fee;
			// if ($step1->discount_unit == "USD") {
			// 	$step1->total_fee = $step1->total_fee - $step1->discount;
			// } else {
			// 	//$step1->total_fee = $step1->total_fee - $step1->total_service_fee * $step1->discount/100;
			// 	$step1->total_fee = $step1->total_fee - round($step1->total_service_fee * $step1->discount/100);
			// }
			// //$step1->total_fee = $step1->total_fee - $step1->total_service_fee * $step1->vip_discount/100;
			// $step1->total_fee = $step1->total_fee - round($step1->total_service_fee * $step1->vip_discount/100);
			
			$this->session->set_userdata("company_service", $company_service);
			
			redirect(site_url("{$this->util->slug($this->router->fetch_class())}/step1"));
		}
	}
	public function step1() {
		$company_service = $this->session->userdata("company_service");
		if ($company_service == NULL) {
			redirect(site_url("{$this->util->slug($this->router->fetch_class())}"));
		}
		if (!empty($_POST)) {
			$jurisdiction = $this->input->post('jurisdiction');
			$service_option = $this->input->post('service_option');

			$info = new stdClass();
			$info->nation_alias = $jurisdiction;
			$jurisdiction_id = $this->m_jurisdictions->jion_nation($info)->jurisdiction_id;

			$info = new stdClass();
			$info->jurisdiction_id = $jurisdiction_id;
			$info->service_id = $this->service_id;
			$items = $this->m_services_fee->items($info);

			$total_fee = 0;
			$total_capital = 0;
			foreach ($items as $item) {
				if (empty($item->recomen)) {
					$total_fee += $item->fee;
					$total_capital += $item->capital;
				} else {
					if (in_array($item->id, $service_option)) {
						$total_fee += $item->fee;
						$total_capital += $item->capital;
					}
				}
			}
			$company_service->total_fee = $total_fee;
			$company_service->total_capital = $total_capital;
			$company_service->service_option = $service_option;
			$company_service->jurisdiction = $jurisdiction;
		}
		$this->session->set_userdata("company_service", $company_service);
		$this->util->requireUserLogin("{$this->util->slug($this->router->fetch_class())}/login");
		$view_data = array();
		$view_data['company_service'] 	= $company_service;
		
		$tmpl_content = array();
		// $tmpl_content['meta']['title'] = $this->util->getMetaTitle($service);
		// $tmpl_content['meta']['keywords'] = $service->meta_key;
		// $tmpl_content['meta']['description'] = $service->meta_desc;
		$tmpl_content['content'] = $this->load->view("apply/step1", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
	public function step2() {
		$company_service = $this->session->userdata("company_service");
		if ($company_service == NULL) {
			redirect(site_url("apply-company-services"));
		}
		if (!empty($_POST)) {
			$company_service->preferred = $this->input->post('preferred');
			$company_service->alternate = $this->input->post('alternate');
			$company_service->shares 	= $this->input->post('shares');
			$company_service->sharesval = $this->input->post('sharesval');
			$directorname 				= $this->input->post('directorname');
			$directoraddress1 			= $this->input->post('directoraddress1');
			$directoraddress2 			= $this->input->post('directoraddress2');
			$directorcity 				= $this->input->post('directorcity');
			$directorstate 				= $this->input->post('directorstate');
			$directorcountry 			= $this->input->post('directorcountry');
			$directorcode 				= $this->input->post('directorcode');

			$c_directorname = count($directorname);
			$address_detail = array();
			for ($i=0; $i < $c_directorname; $i++) { 
				$address = new stdClass();
				$address->directorname = $directorname[$i];
				$address->directoraddress1 = $directoraddress1[$i];
				$address->directoraddress2 = $directoraddress2[$i];
				$address->directorcity = $directorcity[$i];
				$address->directorstate = $directorstate[$i];
				$address->directorcountry = $directorcountry[$i];
				$address->directorcode = $directorcode[$i];
				array_push($address_detail, $address);
			}
			$company_service->address_detail = $address_detail;
		}
		if (!$this->util->checkUserLogin()) {
			redirect(site_url("{$this->util->slug($this->router->fetch_class())}/login"));
		}
		$this->session->set_userdata("company_service", $company_service);

		$view_data = array();
		$view_data['company_service'] 	= $company_service;
		$view_data['service_id'] 		= $this->service_id;
		
		$tmpl_content = array();
		// $tmpl_content['meta']['title'] = $this->util->getMetaTitle($service);
		// $tmpl_content['meta']['keywords'] = $service->meta_key;
		// $tmpl_content['meta']['description'] = $service->meta_desc;
		$tmpl_content['content'] = $this->load->view("apply/step2", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
	public function step3() {
		$company_service = $this->session->userdata("company_service");

		if ($company_service == NULL) {
			redirect(site_url("apply-company-services"));
		}
		if (!empty($_POST)) {
			$company_service->req_ship_title 				= $this->input->post('req_ship_title');
			$company_service->req_ship_fullname 			= $this->input->post('req_ship_fullname');
			$company_service->req_ship_address 				= $this->input->post('req_ship_address');
			$company_service->req_ship_city 				= $this->input->post('req_ship_city');
			$company_service->req_ship_province 			= $this->input->post('req_ship_province');
			$company_service->req_ship_zipcode 				= $this->input->post('req_ship_zipcode');
			$company_service->req_ship_country 				= $this->input->post('req_ship_country');
			$company_service->req_ship_day_phone 			= $this->input->post('req_ship_day_phone');
			$company_service->req_ship_evening_phone 		= $this->input->post('req_ship_evening_phone');
			$company_service->req_ship_phone 				= $this->input->post('req_ship_phone');
			$company_service->req_ship_fax 					= $this->input->post('req_ship_fax');
			$company_service->req_ship_email 				= $this->input->post('req_ship_email');

			$company_service->req_corp_title 				= $this->input->post('req_corp_title');
			$company_service->req_corp_fullname 			= $this->input->post('req_corp_fullname');
			$company_service->req_corp_address 				= $this->input->post('req_corp_address');
			$company_service->req_corp_city 				= $this->input->post('req_corp_city');
			$company_service->req_corp_province 			= $this->input->post('req_corp_province');
			$company_service->req_corp_zipcode 				= $this->input->post('req_corp_zipcode');
			$company_service->req_corp_country 				= $this->input->post('req_corp_country');
			$company_service->req_corp_day_phone 			= $this->input->post('req_corp_day_phone');
			$company_service->req_corp_evening_phone 		= $this->input->post('req_corp_evening_phone');
			$company_service->req_corp_phone 				= $this->input->post('req_corp_phone');
			$company_service->req_corp_fax 					= $this->input->post('req_corp_fax');
			$company_service->req_corp_email 				= $this->input->post('req_corp_email');

			$company_service->req_person_title 				= $this->input->post('req_person_title');
			$company_service->req_person_fullname 			= $this->input->post('req_person_fullname');
			$company_service->req_person_address 			= $this->input->post('req_person_address');
			$company_service->req_person_city 				= $this->input->post('req_person_city');
			$company_service->req_person_province 			= $this->input->post('req_person_province');
			$company_service->req_person_zipcode 			= $this->input->post('req_person_zipcode');
			$company_service->req_person_country 			= $this->input->post('req_person_country');
			$company_service->req_person_day_phone 			= $this->input->post('req_person_day_phone');
			$company_service->req_person_evening_phone 		= $this->input->post('req_person_evening_phone');
			$company_service->req_person_phone 				= $this->input->post('req_person_phone');
			$company_service->req_person_fax 				= $this->input->post('req_person_fax');
			$company_service->req_person_email 				= $this->input->post('req_person_email');

			$company_service->req_agent_name 				= $this->input->post('req_agent_name');
			$company_service->req_agent_address 			= $this->input->post('req_agent_address');
			$company_service->req_agent_city 				= $this->input->post('req_agent_city');
			$company_service->req_agent_state 				= $this->input->post('req_agent_state');
			$company_service->req_agent_zipcode 			= $this->input->post('req_agent_zipcode');
		}
		$this->session->set_userdata("company_service", $company_service);
		if (!$this->util->checkUserLogin()) {
			redirect(site_url("{$this->util->slug($this->router->fetch_class())}/login"));
		}
		$view_data = array();
		$view_data['company_service'] 	= $company_service;
		$view_data['service_id'] 		= $this->service_id;
		
		$tmpl_content = array();
		// $tmpl_content['meta']['title'] = $this->util->getMetaTitle($service);
		// $tmpl_content['meta']['keywords'] = $service->meta_key;
		// $tmpl_content['meta']['description'] = $service->meta_desc;
		$tmpl_content['content'] = $this->load->view("apply/step3", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
	public function completed() {
		$company_service = $this->session->userdata("company_service");
		if (!empty($_POST))
		{
			$company_service->payment_method = (!empty($_POST["payment"]) ? $_POST["payment"] : "");
			if (empty($company_service->payment_method)) {
				$this->session->set_flashdata("error", "Please select an method of Payment.");
				redirect(BASE_URL_HTTPS."/apply-company-services/step3.html", "back");
			}
			$this->session->set_userdata("company_service", $company_service);
		}

		$succed  = true;
		$booking_id = "";

		/////////////////////////
		if (empty($booking_id)) {
			// Get booking id
			$booking_id = $this->m_services_booking->get_next_value() + rand(2, 5);
			
			// Booking key
			$key = md5($booking_id.time());
			
			// Mobile detect
			$this->load->library('user_agent');
			
			$agent = 'Unidentified';
			$platform = $this->agent->platform();
			
			if ($this->agent->is_mobile()) {
				$agent = "Mobile - ". $this->agent->mobile();
			}
			else if ($this->agent->is_browser()) {
				$agent = $this->agent->browser().' '.$this->agent->version();
			}
			else if ($this->agent->is_robot()) {
				$agent = $this->agent->robot();
			}
			$arr_service_option = '';
			foreach ($company_service->service_option as $service_option) {
				$arr_service_option .= $service_option.'|';
			}
			// Add to booking list
			$data = array(
				'id'						=> $booking_id,
				"order_ref"					=> $this->util->order_ref($booking_id),
				'booking_key'				=> $key,
				'jurisdiction'				=> $company_service->jurisdiction,
				'service_option'			=> $arr_service_option,
				'service_id'				=> $this->service_id,
				'capital'					=> $company_service->total_capital,
				'total_fee'					=> $company_service->total_fee,
				'preferred'					=> $company_service->preferred,
				'alternate'					=> $company_service->alternate,
				'shares'					=> $company_service->shares,
				'sharesval'					=> $company_service->sharesval,
				'payment_method'			=> $company_service->payment_method,
				// 'promotion_code'			=> $company_service->promotion_code,
				// 'discount'					=> $company_service->discount,
				'req_ship_title'			=> $company_service->req_ship_title,
				'req_ship_fullname'			=> $company_service->req_ship_fullname,
				'req_ship_address'			=> $company_service->req_ship_address,
				'req_ship_city'				=> $company_service->req_ship_city,
				'req_ship_province'			=> $company_service->req_ship_province,
				'req_ship_zipcode'			=> $company_service->req_ship_zipcode,
				'req_ship_country'			=> $company_service->req_ship_country,
				'req_ship_day_phone'		=> $company_service->req_ship_day_phone,
				'req_ship_evening_phone'	=> $company_service->req_ship_evening_phone,
				'req_ship_phone'			=> $company_service->req_ship_phone,
				'req_ship_fax'				=> $company_service->req_ship_fax,
				'req_ship_email'			=> $company_service->req_ship_email,
				'req_corp_title'			=> $company_service->req_corp_title,
				'req_corp_fullname'			=> $company_service->req_corp_fullname,
				'req_corp_address'			=> $company_service->req_corp_address,
				'req_corp_city'				=> $company_service->req_corp_city,
				'req_corp_province'			=> $company_service->req_corp_province,
				'req_corp_zipcode'			=> $company_service->req_corp_zipcode,
				'req_corp_country'			=> $company_service->req_corp_country,
				'req_corp_day_phone'		=> $company_service->req_corp_day_phone,
				'req_corp_evening_phone'	=> $company_service->req_corp_evening_phone,
				'req_corp_phone'			=> $company_service->req_corp_phone,
				'req_corp_fax'				=> $company_service->req_corp_fax,
				'req_corp_email'			=> $company_service->req_corp_email,
				'req_person_title'			=> $company_service->req_person_title,
				'req_person_fullname'		=> $company_service->req_person_fullname,
				'req_person_address'		=> $company_service->req_person_address,
				'req_person_city'			=> $company_service->req_person_city,
				'req_person_province'		=> $company_service->req_person_province,
				'req_person_zipcode'		=> $company_service->req_person_zipcode,
				'req_person_country'		=> $company_service->req_person_country,
				'req_person_day_phone'		=> $company_service->req_person_day_phone,
				'req_person_evening_phone'	=> $company_service->req_person_evening_phone,
				'req_person_phone'			=> $company_service->req_person_phone,
				'req_person_fax'			=> $company_service->req_person_fax,
				'req_person_email'			=> $company_service->req_person_email,
				'req_agent_name'			=> $company_service->req_agent_name,
				'req_agent_address'			=> $company_service->req_agent_address,
				'req_agent_city'			=> $company_service->req_agent_city,
				'req_agent_state'			=> $company_service->req_agent_state,
				'req_agent_zipcode'			=> $company_service->req_agent_zipcode,
				'user_id' 					=> !empty($user->id) ? $user->id : 0,
				'status' 					=> 0,
				'client_ip' 				=> $this->util->realIP(),
				'user_agent'				=> $agent,
				'platform'					=> $platform,
			);
			if (!$this->m_services_booking->add($data)) {
				$succed = false;
			} else {
				foreach ($company_service->address_detail as $detail) {
					$data_detail = array();
					$data_detail["booking_id"]			= $booking_id;
					$data_detail["directorname"]		= $detail->directorname;
					$data_detail["directoraddress1"]	= $detail->directoraddress1;
					$data_detail["directoraddress2"]	= $detail->directoraddress2;
					$data_detail["directorcity"]		= $detail->directorcity;
					$data_detail["directorstate"]		= $detail->directorstate;
					$data_detail["directorcountry"]		= $detail->directorcountry;
					$data_detail["directorcode"]		= $detail->directorcode;

					if (!$this->m_services_booking_detail->add($data_detail)) {
						$succed = false;
					}
				}
			}
		}

		if ($succed)
		{
			// Get new added booking
			$booking = $this->m_services_booking->booking(NULL, '05bc25f57be9ff0006fc59987924dc33');
			
			// Send mail
			$tpl_data = $this->mail_tpl->service_data($booking);
			
			if ($booking->payment_method == "Western Union" || $booking->payment_method == "Bank Transfer") {
				$subject = "Application #".CODE_COMPANY_SERVICE.$booking->id.": Confirm company services (".$booking->payment_method.")";
			} else {
				$subject = "Application #".CODE_COMPANY_SERVICE.$booking->id.": Company services Remind (gate ".$booking->payment_method.")";
			}
			
			$message = $this->mail_tpl->company_service_payment_remind($tpl_data);
			
			// Send to SALE Department
			$mail = array(
				"subject"		=> $subject." - ".$booking->req_ship_fullname,
				"from_sender"	=> $booking->req_ship_email,
				"name_sender"	=> $booking->req_ship_fullname,
				"to_receiver"	=> MAIL_INFO,
				"message"		=> $message
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
			
			// Send confirmation to SENDER
			$mail = array(
				"subject"		=> $subject,
				"from_sender"	=> MAIL_INFO,
				"name_sender"	=> SITE_NAME,
				"to_receiver"	=> $booking->req_ship_email,
				"message"		=> $message
			);
			$this->mail->config($mail);
			$this->mail->sendmail();

			if ($booking->payment_method == 'OnePay')
			{
				$fields = array("agent" => "M_THEONE_VN");
				$fields["booking_id"] = $booking->id;
				$curl = curl_init("https://www.theonevietnam.com/cdn/cdn-evs/04.html");
				curl_setopt($curl, CURLOPT_TIMEOUT, 30);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
				curl_exec($curl);
				curl_close($curl);
				
				//Redirect to OnePay
				$vpcURL = OP_PAYMENT_URL;
				
				$vpcOpt['Title']				= "Settle payment for company services at ".SITE_NAME;
				$vpcOpt['AgainLink']			= urlencode($_SERVER['HTTP_REFERER']);
				$vpcOpt['vpc_Merchant']			= OP_MERCHANT;
				$vpcOpt['vpc_AccessCode']		= OP_ACCESSCODE;
				$vpcOpt['vpc_MerchTxnRef']		= $key;
				$vpcOpt['vpc_OrderInfo']		= $booking->order_ref;
				$vpcOpt['vpc_Amount']			= $booking->total_fee*100;
				$vpcOpt['vpc_ReturnURL']		= OP_RETURN_URL;
				$vpcOpt['vpc_Version']			= "2";
				$vpcOpt['vpc_Command']			= "pay";
				$vpcOpt['vpc_Locale']			= "en";
				$vpcOpt['vpc_TicketNo']			= $this->util->realIP();
				$vpcOpt['vpc_Customer_Email']	= $booking->req_ship_email;
				$vpcOpt['vpc_Customer_Id']		= !empty($user->id) ? $user->id : 0;
				
				$md5HashData = "";
				
				ksort($vpcOpt);
				
				$appendAmp = 0;
				
				foreach($vpcOpt as $k => $v) {
					// create the md5 input and URL leaving out any fields that have no value
					if (strlen($v) > 0) {
						// this ensures the first paramter of the URL is preceded by the '?' char
						if ($appendAmp == 0) {
							$vpcURL .= urlencode($k) . '=' . urlencode($v);
							$appendAmp = 1;
						} else {
							$vpcURL .= '&' . urlencode($k) . "=" . urlencode($v);
						}
						if ((strlen($v) > 0) && ((substr($k, 0,4)=="vpc_") || (substr($k,0,5) =="user_"))) {
							$md5HashData .= $k . "=" . $v . "&";
						}
					}
				}
				
				$md5HashData = rtrim($md5HashData, "&");
				$md5HashData = strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*',OP_SECURE_SECRET)));
				
				$vpcURL .= "&vpc_SecureHash=" . $md5HashData;
				
				header("Location: ".$vpcURL);
				die();
			}
			else if ($booking->payment_method == 'Credit Card')
			{
				//Redirect to gate2shop
				$numberofitems = 1;
				$totalAmount   = $booking->total_fee;
				$productName   = BOOKING_PREFIX.$booking->id.": Company services";
				$productPrice  = $totalAmount;
				$productNum    = 1;
				$datetime      = gmdate($this->config->item("log_date_format"));
				
				// Cal checksum
				$checksum = md5(G2S_SECRET_KEY.G2S_MERCHANT_ID.G2S_CURRENTCY.$totalAmount.$productName.$productPrice.$productNum.$datetime);
	
				$link  = 'https://secure.Gate2Shop.com/ppp/purchase.do?';
				$link .= 'version='.G2S_VERSION;
				$link .= '&merchant_id='.G2S_MERCHANT_ID;
				$link .= '&merchant_site_id='.G2S_MERCHANT_SITE_ID;
				$link .= '&total_amount='.$totalAmount;
				$link .= '&numberofitems='.$numberofitems;
				$link .= '&currency='.G2S_CURRENTCY;
				$link .= '&item_name_1='.$productName;
				$link .= '&item_amount_1='.$productPrice;
				$link .= '&item_quantity_1='.$productNum;
				$link .= '&time_stamp='.$datetime;
				$link .= '&checksum='.$checksum;
				$link .= '&customField1='.$key;
				$link .= '&customField2='.$booking->req_ship_email;
				
				header('Location: '.$link);
				die();
			}
			else if ($booking->payment_method == 'Paypal')
			{
				$paymentAmount = $booking->total_fee;
				$paymentType = "Sale";
				$itemName = BOOKING_PREFIX.$booking->id.": Company services";
				$itemQuantity = 1;
				$itemPrice = $booking->total_fee;
				$returnURL = PAYPAL_RETURN_URL."?key=".$key;
				$cancelURL = PAYPAL_CANCEL_URL."?key=".$key;
				
				$resArray = $this->paypal->CallShortcutExpressCheckout($paymentAmount, PAYPAL_CURRENCY, $paymentType, $itemName, $itemQuantity, $itemPrice, $returnURL, $cancelURL);
				$ack = strtoupper($resArray["ACK"]);
				$token = urldecode($resArray["TOKEN"]);
				if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
					$this->paypal->RedirectToPayPal($token);
				}
				else {
					header('Location: '.BASE_URL."/apply-company-services/failure.html?key=".$key);
					die();
				}
			}
			else if (in_array($booking->payment_method, array("Credit Card", "Western Union", "Bank Transfer")))
			{
				if ($this->session->userdata("user") && ($this->session->userdata("user")->id == 8086)) {
					header("Location: ".BASE_URL."/apply-company-services/success.html?key=".$key);
					die();
				}
			}
		}
		/////////////////////////

		$view_data = array();
		$view_data['company_service'] 	= $company_service;
		$view_data['service_id'] 		= $this->service_id;
		
		$tmpl_content = array();
		// $tmpl_content['meta']['title'] = $this->util->getMetaTitle($service);
		// $tmpl_content['meta']['keywords'] = $service->meta_key;
		// $tmpl_content['meta']['description'] = $service->meta_desc;
		$tmpl_content['content'] = $this->load->view("apply/completed", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
	public function failure($key="") {

		if (empty($key)) {
			$key = !empty($_GET["key"]) ? $_GET["key"] : "";
		}
		
		if (!empty($key)) {
			$key = str_ireplace(".html", "", $key);
		}
		
		if (!empty($key))
		{
			$key = str_ireplace(".html", "", $key);
			
			// Redirect if this booking is not found or succed
			$booking = $this->m_services_booking->booking(NULL, $key);
			if ($booking == null || $booking->status) {
				redirect(BASE_URL);
				die();
			}
			
			if ($booking != null)
			{
				$user = $this->m_user->load($booking->user_id);
				
				// Change key for duplicated email
				$newkey = $key."_f";
				$data = array( 'booking_key' => $newkey );
				$where = array( 'booking_key' => $key );
				$this->m_services_booking->update($data, $where);
				
				// $tpl_data = $this->mail_tpl->visa_data($booking);
				
				$subject = "Application #".BOOKING_PREFIX.$booking->id.": Confirm company services Failure (gate ".$booking->payment_method.")";
				$vendor_subject = $subject;
				// if ($tpl_data['PROCESSING_TIME'] != "Normal") {
				// 	$vendor_subject = "[".$tpl_data['PROCESSING_TIME']."] ".$subject;
				// }
				
				$message = $this->mail_tpl->text_mail();
				
				// Send to SALE Department
				$mail = array(
					"subject"		=> $vendor_subject." - ".$booking->req_ship_fullname,
					"from_sender"	=> $booking->req_ship_email,
					"name_sender"	=> $user->req_ship_fullname,
					"to_receiver"	=> MAIL_INFO,
					"message"		=> $message
				);
				$this->mail->config($mail);
				// $this->mail->sendmail();
				
				// Send confirmation to SENDER
				$mail = array(
					"subject"		=> $subject,
					"from_sender"	=> MAIL_INFO,
					"name_sender"	=> SITE_NAME,
					"to_receiver"	=> $booking->req_ship_email,
					"message"		=> $message
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
				
				if ($booking->payment_method == "OnePay") {
					$fields = array("agent" => "M_THEONE_VN");
					$fields["booking_id"] = $booking->id;
					$curl = curl_init("https://www.theonevietnam.com/cdn/cdn-evs/04.html");
					curl_setopt($curl, CURLOPT_TIMEOUT, 30);
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
					curl_exec($curl);
					curl_close($curl);
				}
			}
		}
		
		// $breadcrumb = array('Apply Visa' => site_url('apply-company-services'), '1. Visa Options' => site_url('apply-company-services/step1'), '2. Applicant Details' => site_url('apply-company-services/step2'), '3. Review & Payment' => site_url('apply-company-services/step3'), 'Apply Failure' => '');
		
		$view_data = array();
		$view_data["client_name"] 	= $booking->req_ship_fullname;
		$view_data["key"] 			= $newkey;
		$view_data["errMsg"] 		= $this->session->flashdata('payment_error');
		// $view_data["breadcrumb"] 	= $breadcrumb;
		
		$tmpl_content = array();
		$tmpl_content['tabindex'] = "apply-company-services";
		$tmpl_content['content'] = $this->load->view("apply/failure", $view_data, TRUE);
		$this->load->view('layout/view', $tmpl_content);
	}
	function success($key="")
	{
		if (empty($key)) {
			$key = !empty($_GET["key"]) ? $_GET["key"] : "";
		}
		
		if (!empty($key)) {
			$key = str_ireplace(".html", "", $key);
		}
		
		// Redirect if this booking is not found or succed
		$booking = $this->m_services_booking->booking(NULL, $key);
		if ($booking == null || $booking->status) {
			redirect(BASE_URL);
			die();
		}
		
		$data  = array(
			'status' => 1,
			'paid_date' => date($this->config->item("log_date_format"))
		);
		$where = array( 'booking_key' => $key );
		
		$this->m_services_booking->update($data, $where);
		
		$booking = $this->m_services_booking->booking(NULL, $key);
		if ($booking != null)
		{
			
			$user = $this->m_user->load($booking->user_id);
			// Send mail
			// $tpl_data = $this->mail_tpl->visa_data($booking);
			
			$subject = "Application #".BOOKING_PREFIX.$booking->id.": Confirm Visa for Vietnam Successful (gate ".$booking->payment_method.")";
			$vendor_subject = $subject;
			// if ($tpl_data['PROCESSING_TIME'] != "Normal") {
			// 	$vendor_subject = "[".$tpl_data['PROCESSING_TIME']."] ".$subject;
			// }
			
			$message  = $this->mail_tpl->text_mail();
			
			// Send to SALE Department
			$mail = array(
				"subject"		=> $vendor_subject." - ".$booking->req_ship_fullname,
				"from_sender"	=> $booking->req_ship_email,
				"name_sender"	=> $booking->req_ship_fullname,
				"to_receiver"	=> MAIL_INFO,
				"message"		=> $message
			);
			$this->mail->config($mail);
			// $this->mail->sendmail();
			
			// Send confirmation to SENDER
			$mail = array(
				"subject"		=> $subject,
				"from_sender"	=> MAIL_INFO,
				"name_sender"	=> SITE_NAME,
				"to_receiver"	=> $booking->req_ship_email,
				"message"		=> $message
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
			
			if ($booking->payment_method == "OnePay") {
				$fields = array("agent" => "M_THEONE_VN");
				$fields["booking_id"] = $booking->id;
				$curl = curl_init("https://www.theonevietnam.com/cdn/cdn-evs/04.html");
				curl_setopt($curl, CURLOPT_TIMEOUT, 30);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
				curl_exec($curl);
				curl_close($curl);
			}
			//
		}
		else {
			redirect(BASE_URL);
			die();
		}
		
		$breadcrumb = array('Apply Visa' => site_url('{$this->util->slug($this->router->fetch_class())}'), '1. Visa Options' => site_url('{$this->util->slug($this->router->fetch_class())}/step1'), '2. Applicant Details' => site_url('{$this->util->slug($this->router->fetch_class())}/step2'), '3. Review & Payment' => site_url('{$this->util->slug($this->router->fetch_class())}/step3'), 'Apply Successful' => '');
		
		$total_fee = $booking->total_fee - (($booking->full_package) ? ($booking->stamp_fee * $booking->group_size) : 0);
		
		$view_data = array();
		$view_data["client_name"]	= $user->req_ship_fullname;
		$view_data["total_fee"] 	= $total_fee;
		$view_data["key"]			= $key;
		$view_data["breadcrumb"]	= $breadcrumb;
		
		$tmpl_content = array();
		$tmpl_content["transaction_id"]			= BOOKING_PREFIX.$booking->id;
		$tmpl_content["transaction_fee"]		= $total_fee;
		$tmpl_content["transaction_sku"]		= $booking->id;
		$tmpl_content["transaction_name"]		= $booking->visa_type;
		$tmpl_content["transaction_category"]	= ($booking->rush_type == 1) ? "Urgent" : (($booking->rush_type == 2) ? "Emergency" : (($booking->rush_type == 3) ? "Holiday" : (($booking->rush_type == 4) ? "TET Holiday" : "Normal")));
		$tmpl_content["transaction_quantity"]	= $booking->group_size;
		$tmpl_content["tabindex"] = "{$this->util->slug($this->router->fetch_class())}";
		$tmpl_content["content"] = $this->load->view("apply/successful", $view_data, TRUE);
		$this->load->view('layout/view', $tmpl_content);
	}
}

?>