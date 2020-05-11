<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Syslog extends CI_Controller {

	var $_breadcrumb = array();
	
	public function __construct()
	{
		parent::__construct();
		
		$method = $this->util->slug($this->router->fetch_method());
		
		if (!in_array($method, array("login", "logout"))) {
			$this->util->requireAdminLogin();
			$user = $this->session->userdata("admin");
			if (!$user->active) {
				$this->session->set_flashdata("error", "Your account is under review.");
				redirect(ADMIN_URL);
			}
			
			if (in_array($method, array("users", "payment-report", "passport-types", "visa-types", "visit-purposes", "arrival-ports", "page-meta-tags", "page-redirects", "settings", "history", "debt", "scheduler", "holiday"))) {
				$this->util->requireSupperAdminLogin();
			}
			
			if (substr($method, 0, 4) === "adm-") {
				$this->util->requireSupperAdminLogin();
			}
			
			$this->m_user->last_activity($user->id);
		}
		
		$this->m_user_online->track_ip();
		
		if (!empty($user)) {
			if ($user->user_type == USR_ADMIN) {
				if (!$this->check_schedule($user->id)) {
					//$this->session->set_flashdata("error", "Sorry, access denied.");
					//redirect(ADMIN_URL);
				}
			}
		}
		
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Syslog" => site_url($this->util->slug($this->router->fetch_class()))));
	}
	
	public function index()
	{
		$view_data = array();
		$view_data["breadcrumb"] = $this->_breadcrumb;
		
		$tmpl_content = array();
		$tmpl_content["content"] = $this->load->view("admin/index", $view_data, true);
		$this->load->view("layout/admin/main", $tmpl_content);
	}
	
	//------------------------------------------------------------------------------
	// Login
	//------------------------------------------------------------------------------
	
	public function login()
	{
		if (!empty($_POST))
		{
			$agent_id = trim($this->util->value($this->input->post("agent_id"), ""));
			$email = trim($this->util->value($this->input->post("email"), ""));
			$password = trim($this->util->value($this->input->post("password"), ""));
			
			if (strtoupper($agent_id) == ADMIN_AGENT_ID) {
				if ($this->m_user->login($email, $password, "admin") == false) {
					$this->session->set_flashdata("error", "Invalid email or password.");
					redirect(site_url("syslog/login"), "back");
				} else {
					redirect(site_url("syslog"));
				}
			} else {
				$this->session->set_flashdata("error", "Invalid Agent ID.");
				redirect(site_url("syslog/login"), "back");
			}
		}
		
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Login" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$view_data = array();
		$view_data["breadcrumb"] = $this->_breadcrumb;
		
		$tmpl_content = array();
		$tmpl_content["content"] = $this->load->view("admin/login", $view_data, true);
		$this->load->view("layout/admin/login", $tmpl_content);
	}

	public function logout()
	{
		$this->m_user->logout();
		redirect(site_url("syslog"));
	}
	
	//------------------------------------------------------------------------------
	// Sitemap
	//------------------------------------------------------------------------------
	
	public function create_sitemap()
	{
		// $url80 = array();
		// $url64 = array();
		
		$xmlstr  = '<?xml version="1.0" encoding="UTF-8"?>';
		// $xmlstr .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">';
		
		// $url80[] = BASE_URL;
		// $url80[] = site_url("processing");
		// $url80[] = site_url("apply-visa");
		// $url80[] = site_url("visa-fee");
		// $url80[] = site_url("services");
		// $url80[] = site_url("faqs");
		// //$url80[] = site_url("answers");
		// $url80[] = site_url("vietnam-embassies");
		// $url80[] = site_url("news");
		// $url80[] = site_url("news/travel");
		// $url80[] = site_url("member");
		// $url80[] = site_url("check-visa-status");
		// $url80[] = site_url("download-visa-application-forms");
		// $url80[] = site_url("contact");
		// $url80[] = site_url("about-us");
		// $url80[] = site_url("why-us");
		// $url80[] = site_url("terms-and-conditions");
		// $url80[] = site_url("policy");
		// $url80[] = site_url("payment-instruction");
		// $url80[] = site_url("vietnam-visa-tips");
		// $url80[] = site_url("visa-requirements");
		// $url80[] = site_url("vietnam-e-visa");
		
		// $nations = $this->m_country->items();
		// $contents = $this->m_content->items();
		// $legal_category = $this->m_category->load("legal");
		// $news_category = $this->m_category->load("news");
		// $travel_category = $this->m_category->load("travel-news");
		// $service_category = $this->m_category->load("extra-service");
		
		// foreach ($nations as $nation) {
		// 	if ($nation->active) {
		// 		$url64[] = site_url("visa-requirements/{$nation->alias}");
		// 		$url64[] = site_url("vietnam-embassies/view/{$nation->alias}");
		// 		//$url64[] = site_url("vietnam-visa-tips/view/{$nation->alias}");
		// 		$url64[] = site_url("visa-fee/{$nation->alias}");
		// 	}
		// }
		
		// foreach ($contents as $content) {
		// 	if ($content->active) {
		// 		if ($content->catid == $legal_category->id) {
		// 			$url64[] = site_url("legal/{$content->alias}");
		// 		}
		// 		else if ($content->catid == $news_category->id) {
		// 			$url64[] = site_url("news/view/{$content->alias}");
		// 		}
		// 		else if ($content->catid == $travel_category->id) {
		// 			$url64[] = site_url("news/travel/view/{$content->alias}");
		// 		}
		// 		else if ($content->catid == $service_category->id) {
		// 			$url64[] = site_url("services/view/{$content->alias}");
		// 		}
		// 	}
		// }
		
		// $contents = $this->m_tips->items();
		// foreach ($contents as $content) {
		// 	$url64[] = site_url("vietnam-visa-tips/view/{$content->alias}");
		// }
		
		// $info = new stdClass();
		// $info->topLevel = 1;
		// $contents = $this->m_question->items($info, 1);
		// foreach ($contents as $content) {
		// 	//$url64[] = site_url("answers/view/{$content->alias}");
		// }
		
		// foreach ($url80 as $url) {
		// 	$xmlstr .= '<url>';
		// 	$xmlstr .= '<loc>'.$url.'</loc>';
		// 	$xmlstr .= '<changefreq>daily</changefreq>';
		// 	$xmlstr .= '<priority>0.80</priority>';
		// 	$xmlstr .= '</url>';
		// }
		
		// foreach ($url64 as $url) {
		// 	$xmlstr .= '<url>';
		// 	$xmlstr .= '<loc>'.$url.'</loc>';
		// 	$xmlstr .= '<changefreq>daily</changefreq>';
		// 	$xmlstr .= '<priority>0.64</priority>';
		// 	$xmlstr .= '</url>';
		// }
		
		// $xmlstr .= '</urlset>';
		
		// chmod('sitemap.xml', 0777);
		
		// $fp = fopen('sitemap.xml', 'w');
		// fwrite($fp, $xmlstr);
		// fclose($fp);
		
		// chmod('sitemap.xml', 0664);
	}
	
	//------------------------------------------------------------------------------
	// Settings
	//------------------------------------------------------------------------------
	
	public function settings($action=null)
	{
		$settings = $this->m_setting->items();
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$company_name				= $this->util->value($this->input->post("company_name"), "");
				$company_address			= $this->util->value($this->input->post("company_address"), "");
				$company_email				= $this->util->value($this->input->post("company_email"), "");

				$company_hotline_vn			= $this->util->value($this->input->post("company_hotline_vn"), "");
				$company_address_vn			= $this->util->value($this->input->post("company_address_vn"), "");
				$company_email_vn			= $this->util->value($this->input->post("company_email_vn"), "");
				$company_working_time_vn	= $this->util->value($this->input->post("company_working_time_vn"), "");

				$company_hotline_us			= $this->util->value($this->input->post("company_hotline_us"), "");
				$company_address_us			= $this->util->value($this->input->post("company_address_us"), "");
				$company_email_us			= $this->util->value($this->input->post("company_email_us"), "");
				$company_working_time_us	= $this->util->value($this->input->post("company_working_time_us"), "");

				$company_hotline_au			= $this->util->value($this->input->post("company_hotline_au"), "");
				$company_address_au			= $this->util->value($this->input->post("company_address_au"), "");
				$company_email_au			= $this->util->value($this->input->post("company_email_au"), "");
				$company_working_time_au	= $this->util->value($this->input->post("company_working_time_au"), "");

				$company_hotline_sin		= $this->util->value($this->input->post("company_hotline_sin"), "");
				$company_address_sin		= $this->util->value($this->input->post("company_address_sin"), "");
				$company_email_sin			= $this->util->value($this->input->post("company_email_sin"), "");
				$company_working_time_sin	= $this->util->value($this->input->post("company_working_time_sin"), "");

				$company_hotline_hk			= $this->util->value($this->input->post("company_hotline_hk"), "");
				$company_address_hk			= $this->util->value($this->input->post("company_address_hk"), "");
				$company_email_hk			= $this->util->value($this->input->post("company_email_hk"), "");
				$company_working_time_hk	= $this->util->value($this->input->post("company_working_time_hk"), "");

				$company_tollfree			= $this->util->value($this->input->post("company_tollfree"), "");
				$facebook_url				= $this->util->value($this->input->post("facebook_url"), "");
				$googleplus_url				= $this->util->value($this->input->post("googleplus_url"), "");
				$twitter_url				= $this->util->value($this->input->post("twitter_url"), "");
				$youtube_url				= $this->util->value($this->input->post("youtube_url"), "");
				$bang_ip					= $this->util->value($this->input->post("bang_ip"), "");
				$bang_name					= $this->util->value($this->input->post("bang_name"), "");
				$bang_email					= $this->util->value($this->input->post("bang_email"), "");
				$bang_passport				= $this->util->value($this->input->post("bang_passport"), "");
				
				$data = array (
					"company_name"				=> $company_name,
					"company_address"			=> $company_address,
					"company_email"				=> $company_email,

					"company_hotline_vn"		=> $company_hotline_vn,
					"company_address_vn"		=> $company_address_vn,
					"company_email_vn"			=> $company_email_vn,
					"company_working_time_vn"	=> $company_working_time_vn,

					"company_hotline_us"		=> $company_hotline_us,
					"company_address_us"		=> $company_address_us,
					"company_email_us"			=> $company_email_us,
					"company_working_time_us"	=> $company_working_time_us,

					"company_hotline_au"		=> $company_hotline_au,
					"company_address_au"		=> $company_address_au,
					"company_email_au"			=> $company_email_au,
					"company_working_time_au"	=> $company_working_time_au,

					"company_hotline_sin"		=> $company_hotline_sin,
					"company_address_sin"		=> $company_address_sin,
					"company_email_sin"			=> $company_email_sin,
					"company_working_time_sin"	=> $company_working_time_sin,

					"company_hotline_hk"		=> $company_hotline_hk,
					"company_address_hk"		=> $company_address_hk,
					"company_email_hk"			=> $company_email_hk,
					"company_working_time_hk"	=> $company_working_time_hk,

					"company_tollfree"			=> $company_tollfree,
					"facebook_url"				=> $facebook_url,
					"googleplus_url"			=> $googleplus_url,
					"twitter_url"				=> $twitter_url,
					"youtube_url"				=> $youtube_url,
					"bang_ip"					=> $bang_ip,
					"bang_name"					=> $bang_name,
					"bang_email"				=> $bang_email,
					"bang_passport"				=> $bang_passport,
				);
				
				if (!is_null($settings) && sizeof($settings)) {
					$setting = array_shift($settings);
					$where = array("id" => $setting->id);
					$this->m_setting->update($data, $where);
				} else {
					$this->m_setting->add($data);
				}
			}
			
			redirect(site_url("syslog/settings"));
		}
		
		$action = !is_null($action) ? $action : "index";
		
		if (!is_null($settings) && sizeof($settings)) {
			$setting = array_shift($settings);
		} else {
			$setting = $this->m_setting->instance();
		}
		
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Settings" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$view_data = array();
		$view_data["setting"] = $setting;
		$view_data["breadcrumb"] = $this->_breadcrumb;
		
		$tmpl_content = array();
		$tmpl_content["content"] = $this->load->view("admin/settings/{$action}", $view_data, true);
		$this->load->view("layout/admin/main", $tmpl_content);
	}
	
	//------------------------------------------------------------------------------
	// Users
	//------------------------------------------------------------------------------
	
	public function users($action=null, $id=null)
	{
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task) && $task != "search") {
			$ids = $this->util->value($this->input->post("cid"), array());
			foreach ($ids as $id) {
				$user = $this->m_user->load($id);
				if (($user->user_type == USR_SUPPER_ADMIN && $this->session->userdata("admin")->user_type != USR_SUPPER_ADMIN)
				|| ($user->user_type == USR_ADMIN && $this->session->userdata("admin")->user_type == USR_ADMIN && $this->session->userdata("admin")->id != $user->id)) {
					$this->session->set_flashdata("error", "Sorry, you don't have permission to edit the selected users.");
					redirect(site_url("syslog/users"));
				} else {
					if ($task == "publish") {
						$data = array("active" => 1);
						$where = array("id" => $id);
						$this->m_user->update($data, $where);
					}
					else if ($task == "unpublish") {
						$data = array("active" => 0);
						$where = array("id" => $id);
						$this->m_user->update($data, $where);
					}
					else if ($task == "delete") {
						$where = array("id" => $id);
						$this->m_user->delete($where);
					}
				}
			}
			redirect(site_url("syslog/users"));
		}
		
		if ($action == "signin") {
			$user = $this->m_user->load($id);
			if (($user->user_type == USR_SUPPER_ADMIN && $this->session->userdata("admin")->user_type != USR_SUPPER_ADMIN)
			|| ($user->user_type == USR_ADMIN && $this->session->userdata("admin")->user_type == USR_ADMIN && $this->session->userdata("admin")->id != $user->id)) {
				$this->session->set_flashdata("error", "Sorry, you don't have permission to edit the selected users.");
				redirect(site_url("syslog/users"));
			} else {
				$this->m_user->cp_login($id);
				redirect(site_url("member"));
			}
		}
		else {
			$search_text = $this->util->value($this->input->post("search_text"), "");
			$info = new stdClass();
			if (!empty($search_text)) {
				$info->search_text = $search_text;
			}
			$level = '';
			if (!empty($_GET['level'])) {
				if ($_GET['level'] == 'silver') {
					$info->level = array(99, 200);
					$level = '?level=silver&';
				} else if ($_GET['level'] == 'gold') {
					$info->level = array(199, 500);
					$level = '?level=gold&';
				} else if ($_GET['level'] == 'diamond') {
					$info->level = array(499, 2000);
					$level = '?level=diamond&';
				} else if ($_GET['level'] == 'vip') {
					$info->level = array(1999);
					$level = '?level=vip&';
				}
			}

			
			$page = (!empty($_GET["page"]) ? max($_GET["page"], 1) : 1);
			$pagination = $this->util->pagination(site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}"). "?$_SERVER[QUERY_STRING]", $this->m_user->count($info), ADMIN_ROW_PER_PAGE);
			
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Users" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
			
			$users	= $this->m_user->users($info, null, ADMIN_ROW_PER_PAGE, ($page - 1) * ADMIN_ROW_PER_PAGE);

			$view_data = array();
			$view_data["breadcrumb"] 	= $this->_breadcrumb;
			$view_data["users"]			= $users;
			$view_data["search_text"]	= $search_text;
			$view_data["page"]			= $page;
			$view_data["pagination"]	= $pagination;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/account/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	
	//------------------------------------------------------------------------------
	// Content
	//------------------------------------------------------------------------------
	
	public function content_categories($action=null, $id=null)
	{
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Content Categories" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$name			= $this->util->value($this->input->post("name"), "");
				$alias			= $this->util->value($this->input->post("alias"), "");
				$parent_id		= $this->util->value($this->input->post("parent_id"), 0);
				$active			= $this->util->value($this->input->post("active"), 1);
				
				if (empty($alias)) {
					$alias = $this->util->slug($name);
				}
				
				$data = array (
					"name"		=> $name,
					"alias"		=> $alias,
					"parent_id"	=> $parent_id,
					"active"	=> $active
				);
				
				if ($action == "add") {
					$this->m_category->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_category->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/content-categories"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/content-categories"));
			}
			else if ($task == "orderup") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_category->order_up($id);
				}
				redirect(site_url("syslog/content-categories"));
			}
			else if ($task == "orderdown") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_category->order_down($id);
				}
				redirect(site_url("syslog/content-categories"));
			}
			else if ($task == "saveorder") {
				$order = $this->util->value($this->input->post("order"), array());
				$cids  = $this->util->value($this->input->post("cids"), array());
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array("order_num" => $order[$i]);
					$where = array("id" => $cids[$i]);
					$this->m_category->update($data, $where);
				}
				redirect(site_url("syslog/content-categories"));
			}
			else if ($task == "publish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 1);
					$where = array("id" => $id);
					$this->m_category->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/content-categories"));
			}
			else if ($task == "unpublish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 0);
					$where = array("id" => $id);
					$this->m_category->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/content-categories"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_category->delete($where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/content-categories"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_category->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add Content Category" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/content/category/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_category->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->name}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}/{$id}")));
		
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/content/category/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$category_info = new stdClass();
			$category_info->parent_id = 0;
			$categories = $this->m_category->items($category_info);
			
			$view_data = array();
			$view_data["breadcrumb"] 	= $this->_breadcrumb;
			$view_data["items"]			= $categories;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/content/category/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	
	public function content($category_id, $action=null, $id=null)
	{
		$category = $this->m_category->load($category_id);
		
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Content Categories" => site_url("{$this->util->slug($this->router->fetch_class())}/content-categories")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$category->name}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$category_id}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$title			= $this->util->value($this->input->post("title"), "");
				$alias			= $this->util->value($this->input->post("alias"), "");
				$catid			= $this->util->value($this->input->post("catid"), 0);
				$thumbnail 		= !empty($_FILES['thumbnail']['name']) ? explode('.',$_FILES['thumbnail']['name']) : $this->m_content->load($id)->thumbnail;
				$meta_title		= $this->util->value($this->input->post("meta_title"), "");
				$meta_key		= $this->util->value($this->input->post("meta_key"), "");
				$meta_desc		= $this->util->value($this->input->post("meta_desc"), "");
				$summary		= $this->util->value($this->input->post("summary"), "");
				$content		= $this->util->value($this->input->post("content"), "");
				//$order_num		= $this->util->value($this->input->post("order_num"), 1);
				$active			= $this->util->value($this->input->post("active"), 1);
				
				if (empty($alias)) {
					$alias = $this->util->slug($title);
				}
				
				$data = array (
					"title"			=> $title,
					"alias"			=> $alias,
					"catid"			=> $catid,
					"thumbnail"		=> $thumbnail,
					"meta_title"	=> $meta_title,
					"meta_key"		=> $meta_key,
					"meta_desc"		=> $meta_desc,
					"summary"		=> $summary,
					"content"		=> $content,
					//"order_num"		=> $order_num,
					"active"		=> $active
				);
				if (!empty($_FILES['thumbnail']['name'])){
					$data['thumbnail'] = "/files/upload/content/{$id}/{$this->util->slug($thumbnail[0])}.{$thumbnail[1]}";
				}
				$file_deleted = '';
				
				if ($action == "add") {
					$file_deleted = "./files/upload/content/{$id}/{$this->m_content->load($id)->name}";
					$this->m_content->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_content->update($data, $where);
				}
				$path = "./files/upload/content/{$id}";
				if (!file_exists($path)) {
					mkdir($path, 0755, true);
				}
				$allow_type = 'JPG|PNG|jpg|jpeg|png';
				$this->util->upload_file($path,'thumbnail',$file_deleted,$allow_type,$this->util->slug($thumbnail[0]).'.'.$thumbnail[1]);
				$this->create_sitemap();
				redirect(site_url("syslog/content/{$category->alias}"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/content/{$category->alias}"));
			}
			else if ($task == "orderup") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_content->order_up($id);
				}
				redirect(site_url("syslog/content/{$category->alias}"));
			}
			else if ($task == "orderdown") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_content->order_down($id);
				}
				redirect(site_url("syslog/content/{$category->alias}"));
			}
			else if ($task == "saveorder") {
				$order = $this->util->value($this->input->post("order"), array());
				$cids  = $this->util->value($this->input->post("cids"), array());
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array("order_num" => $order[$i]);
					$where = array("id" => $cids[$i]);
					$this->m_content->update($data, $where);
				}
				redirect(site_url("syslog/content/{$category->alias}"));
			}
			else if ($task == "publish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 1);
					$where = array("id" => $id);
					$this->m_content->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/content/{$category->alias}"));
			}
			else if ($task == "unpublish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 0);
					$where = array("id" => $id);
					$this->m_content->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/content/{$category->alias}"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_content->delete($where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/content/{$category->alias}"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_content->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add Content" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$category_id}/{$action}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			$view_data["category"] = $category;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/content/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_content->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->title}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$category_id}/{$action}/{$id}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			$view_data["category"] = $category;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/content/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$info = new stdClass();
			$info->catid = $category->id;
			
			$view_data = array();
			$view_data["breadcrumb"]	= $this->_breadcrumb;
			$view_data["items"]			= $this->m_content->items($info, null, null, null);
			$view_data["category"]		= $category;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/content/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}

	public function faq_categories($action=null, $id=null)
	{
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("FAQs Categories" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$name			= $this->util->value($this->input->post("name"), "");
				$alias			= $this->util->value($this->input->post("alias"), "");
				$active			= $this->util->value($this->input->post("active"), 1);
				
				if (empty($alias)) {
					$alias = $this->util->slug($name);
				}
				
				$data = array (
					"name"		=> $name,
					"alias"		=> $alias,
					"active"	=> $active
				);
				
				if ($action == "add") {
					$this->m_faq_category->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_faq_category->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/faq-categories"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/faq-categories"));
			}
			else if ($task == "orderup") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_faq_category->order_up($id);
				}
				redirect(site_url("syslog/faq-categories"));
			}
			else if ($task == "orderdown") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_faq_category->order_down($id);
				}
				redirect(site_url("syslog/faq-categories"));
			}
			else if ($task == "saveorder") {
				$order = $this->util->value($this->input->post("order"), array());
				$cids  = $this->util->value($this->input->post("cids"), array());
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array("order_num" => $order[$i]);
					$where = array("id" => $cids[$i]);
					$this->m_faq_category->update($data, $where);
				}
				redirect(site_url("syslog/faq-categories"));
			}
			else if ($task == "publish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 1);
					$where = array("id" => $id);
					$this->m_faq_category->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/faq-categories"));
			}
			else if ($task == "unpublish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 0);
					$where = array("id" => $id);
					$this->m_faq_category->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/faq-categories"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_faq_category->delete($where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/faq-categories"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_faq_category->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add FAQs Category" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/faq/category/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_faq_category->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->name}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}/{$id}")));
		
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/faq/category/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			
			$view_data = array();
			$view_data["breadcrumb"] 	= $this->_breadcrumb;
			$view_data["items"]			= $this->m_faq_category->items();
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/faq/category/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}

	public function faq($category_id, $action=null, $id=null)
	{
		$category = $this->m_faq_category->load($category_id);
		
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("FAQ Categories" => site_url("{$this->util->slug($this->router->fetch_class())}/faq-categories")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$category->name}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$category_id}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$title			= $this->util->value($this->input->post("title"), "");
				$meta_title		= $this->util->value($this->input->post("meta_title"), "");
				$meta_key		= $this->util->value($this->input->post("meta_key"), "");
				$meta_desc		= $this->util->value($this->input->post("meta_desc"), "");
				$content		= $this->util->value($this->input->post("content"), "");
				$active			= $this->util->value($this->input->post("active"), 1);
				
				if (empty($alias)) {
					$alias = $this->util->slug($title);
				}
				
				$data = array (
					"title"			=> $title,
					"alias"			=> $alias,
					"category_id"	=> $category_id,
					"meta_title"	=> $meta_title,
					"meta_key"		=> $meta_key,
					"meta_desc"		=> $meta_desc,
					"content"		=> $content,
					"order_num"		=> count($this->m_faq->items()) + 1,
					"active"		=> $active
				);
				if ($action == "add") {
					$this->m_faq->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_faq->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/faq/{$category_id}"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/faq/{$category_id}"));
			}
			else if ($task == "orderup") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_faq->order_up($id);
				}
				redirect(site_url("syslog/faq/{$category_id}"));
			}
			else if ($task == "orderdown") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_faq->order_down($id);
				}
				redirect(site_url("syslog/faq/{$category_id}"));
			}
			else if ($task == "saveorder") {
				$order = $this->util->value($this->input->post("order"), array());
				$cids  = $this->util->value($this->input->post("cids"), array());
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array("order_num" => $order[$i]);
					$where = array("id" => $cids[$i]);
					$this->m_faq->update($data, $where);
				}
				redirect(site_url("syslog/faq/{$category_id}"));
			}
			else if ($task == "publish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 1);
					$where = array("id" => $id);
					$this->m_faq->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/faq/{$category_id}"));
			}
			else if ($task == "unpublish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 0);
					$where = array("id" => $id);
					$this->m_faq->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/faq/{$category_id}"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_faq->delete($where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/faq/{$category_id}"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_faq->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add FAQs" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$category_id}/{$action}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			$view_data["category"] = $category;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/faq/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_faq->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->title}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$category_id}/{$action}/{$id}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			$view_data["category"] = $category;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/faq/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$info = new stdClass();
			$info->category_id = $category->id;
			
			$view_data = array();
			$view_data["breadcrumb"]	= $this->_breadcrumb;
			$view_data["items"]			= $this->m_faq->items($info);
			$view_data["category"]		= $category;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/faq/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	//------------------------------------------------------------------------------
	// SERVICES
	//------------------------------------------------------------------------------
	public function services($action=null,$id=null) {

		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Services" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$name			= $this->util->value($this->input->post("name"), "");
				$alias			= $this->util->value($this->input->post("alias"), "");
				$description	= $this->util->value($this->input->post("description"), "");
				$meta_title		= $this->util->value($this->input->post("meta_title"), "");
				$meta_key		= $this->util->value($this->input->post("meta_key"), "");
				$meta_desc		= $this->util->value($this->input->post("meta_desc"), "");
				
				if (empty($alias)) {
					$alias = $this->util->slug($name);
				}
				
				$data = array (
					"name"			=> $name,
					"alias"			=> $alias,
					"description"	=> $description,
					"meta_title"	=> $meta_title,
					"meta_key"		=> $meta_key,
					"meta_desc"		=> $meta_desc,
				);
				
				if ($action == "add") {
					$this->m_services->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_services->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/services"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/services"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_services->delete($where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/services"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_services->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_services->load($id);
			$info = new stdClass();
			$info->service_id = $item->id;
			$tabs = $this->m_services_tabs->items($info);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->name}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}/{$id}")));
		
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			$view_data["tabs"] = $tabs;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$view_data = array();
			$view_data["breadcrumb"] 	= $this->_breadcrumb;
			$view_data["items"]			= $this->m_services->items();
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	public function services_tabs($service_id, $action=null,$id=null) {
		$service = $this->m_services->load($service_id);
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Services" => site_url("syslog/services")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$service->name}" => site_url("syslog/services/edit/{$service->id}")));

		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$name			= $this->util->value($this->input->post("name"), "");
				$icon_path 		= !empty($_FILES['icon_path']['name']) ? explode('.',$_FILES['icon_path']['name']) : $this->m_services_tabs->load($id)->icon_path;
				$active			= $this->util->value($this->input->post("active"), 1);
				
				$alias = $this->util->slug($name);
				$data = array (
					"name"			=> $name,
					"alias"			=> $alias,
					"icon_path"		=> $icon_path,
					"service_id"	=> $service_id,
					"active"		=> $active
				);
				if (!empty($_FILES['icon_path']['name'])){
					$data['icon_path'] = "/files/upload/icon/{$this->util->slug($icon_path[0])}.{$icon_path[1]}";
				}
				$file_deleted = '';

				if ($action == "add") {
					$file_deleted = "./files/upload/icon/{$this->m_services_tabs->load($id)->name}";
					$data['order_num'] = $this->m_services_tabs->get_next_value('order_num');
					$this->m_services_tabs->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_services_tabs->update($data, $where);
				}
				$path = "./files/upload/icon";

				$allow_type = 'JPG|PNG|jpg|jpeg|png';
				$this->util->upload_file($path,'icon_path',$file_deleted,$allow_type,$this->util->slug($icon_path[0]).'.'.$icon_path[1],0);
				
				$this->create_sitemap();
				redirect(site_url("syslog/services/edit/{$service->id}"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/services/edit/{$service->id}"));
			}
		}
		if ($action == "add") {
			$item = $this->m_services_tabs->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$service_id}/add")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			$view_data["service"] = $service;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/tabs/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$item = $this->m_services_tabs->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->name}" => ''));
			
			$info = new stdClass();
			$info->service_tab_id = $item->id;
			$details = $this->m_services_tabs_details->items($info);
			$downloads = $this->m_services_tab_downloads->items($info);
			$faqs = $this->m_services_tab_faqs->items($info);

			$info = new stdClass();
			$info->service_tab_id = $item->id;
			$services_nation = $this->m_services_tab_nation->items($info);
			
			$view_data = array();
			$view_data["breadcrumb"] 		= $this->_breadcrumb;
			$view_data["item"] 				= $item;
			$view_data["service"] 			= $service;
			$view_data["details"] 			= $details;
			$view_data["services_nation"] 	= $services_nation;
			$view_data["downloads"] 		= $downloads;
			$view_data["faqs"] 				= $faqs;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/tabs/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	public function services_tab_faqs($service_tab_id, $action=null, $id=null) {
		$services_tab = $this->m_services_tabs->load($service_tab_id);
		$services = $this->m_services->load($services_tab->service_id);
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Services" => site_url("syslog/services")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$services->name}" => site_url("syslog/services/edit/{$services->id}")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$services_tab->name}" => site_url("syslog/services-tabs/{$services_tab->id}/edit/{$services->id}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$question		= $this->util->value($this->input->post("question"), "");
				$alias			= $this->util->value($this->input->post("alias"), "");
				$desscription	= $this->util->value($this->input->post("desscription"), "");
				$answer			= $this->util->value($this->input->post("answer"), "");
				$meta_title		= $this->util->value($this->input->post("meta_title"), "");
				$meta_key		= $this->util->value($this->input->post("meta_key"), "");
				$meta_desc		= $this->util->value($this->input->post("meta_desc"), "");
				$active			= $this->util->value($this->input->post("active"),1);
				if (empty($alias)) {
					$alias = $this->util->slug($question);
				}
				$data = array (
					"question"			=> $question,
					"alias"				=> $alias,
					"desscription"		=> $desscription,
					"answer"			=> $answer,
					"service_tab_id"	=> $service_tab_id,
					"meta_title"		=> $meta_title,
					"meta_key"			=> $meta_key,
					"meta_desc"			=> $meta_desc,
					"active"			=> $active,
				);
				
				if ($action == "add") {
					$data['order_num'] = $this->m_services_tab_faqs->get_next_value('order_num');
					$this->m_services_tab_faqs->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_services_tab_faqs->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/services-tabs/{$services->id}/edit/{$service_tab_id}"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/services-tabs/{$services->id}/edit/{$service_tab_id}"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_services_tab_faqs->delete($where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/services-tabs/{$services->id}/edit/{$jurisdiction_id}"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_services_tab_faqs->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add" => ''));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/faq/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_services_tab_faqs->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->question}" => ''));

			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/faq/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	public function services_tab_downloads($service_tab_id, $action=null, $id=null) {
		$services_tab = $this->m_services_tabs->load($service_tab_id);
		$services = $this->m_services->load($services_tab->service_id);
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Services" => site_url("syslog/services")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$services->name}" => site_url("syslog/services/edit/{$services->id}")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$services_tab->name}" => site_url("syslog/services-tabs/{$services_tab->id}/edit/{$services->id}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$title		= $this->util->value($this->input->post("title"), "");
				$service_id		= $this->util->value($this->input->post("service_id"), "");
				$description		= $this->util->value($this->input->post("description"), "");
				$file_upload 		= !empty($_FILES['file_upload']['name']) ? explode('.',$_FILES['file_upload']['name']) : '';

				$data = array (
					"title"				=> $title,
					"service_tab_id"	=> $service_tab_id,
					"description"		=> $description
				);
				if (!empty($_FILES['file_upload']['name'])){
					$data['file_path'] = "/files/upload/service/download/{$this->util->slug($file_upload[0])}.{$file_upload[1]}";
				}
				if ($action == "add") {
					$data['order_num'] = $this->m_services_tab_downloads->get_next_value('order_num');
					$this->m_services_tab_downloads->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_services_tab_downloads->update($data, $where);
				}
				$path = "./files/upload/service/download";
				if (!file_exists($path)) {
					mkdir($path, 0755, true);
				}
				$allow_type = '*';
				$this->util->upload_file($path,'file_upload','',$allow_type,$this->util->slug($file_upload[0]).'.'.$file_upload[1]);
				$this->create_sitemap();
				redirect(site_url("syslog/services-tabs/{$services->id}/edit/{$service_tab_id}"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/services-tabs/{$services->id}/edit/{$service_tab_id}"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_services_tab_downloads->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add" => ''));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/download/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_services_tab_downloads->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->title}" => ''));

			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/download/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	function ajax_action_item(){
		$id = $this->util->value($this->input->post("id"), "");
		$task = $this->util->value($this->input->post("task"), "");
		$table = $this->util->value($this->input->post("table"), "");

		if ($task == 'del') {
			$this->{$table}->delete(array("id" => $id));
		} elseif ($task == 'hide') {
			$this->{$table}->update(array("active" => 0), array("id" => $id));
		} elseif ($task == 'show') {
			$this->{$table}->update(array("active" => 1), array("id" => $id));
		} elseif ($task == 'close') {
			$this->{$table}->update(array("open" => 0), array("id" => $id));
		} elseif ($task == 'open') {
			$this->{$table}->update(array("open" => 1), array("id" => $id));
		} elseif ($task == 'up') {
			$item = $this->{$table}->order_up($id);
		} elseif ($task == 'down') {
			$item = $this->{$table}->order_down($id);
		}
	}
	public function services_tabs_detail($service_tab_id, $action=null,$id=null) {
		$services_tab = $this->m_services_tabs->load($service_tab_id);
		$services = $this->m_services->load($services_tab->service_id);
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Services" => site_url("syslog/services")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$services->name}" => site_url("syslog/services/edit/{$services->id}")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$services_tab->name}" => site_url("syslog/services-tabs/{$services_tab->id}/edit/{$services->id}")));

		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$name		= $this->util->value($this->input->post("name"), "");
				$module		= $this->util->value($this->input->post("module"), "");
				$content	= $this->util->value($this->input->post("content"), "");
				$active		= $this->util->value($this->input->post("active"), 1);
				
				$alias = $this->util->slug($name);
				$data = array (
					"name"		=> $name,
					"service_tab_id"=> $service_tab_id,
					"alias"		=> $alias,
					"module"	=> $module,
					"content"	=> ($module == 'content') ? $content : null,
					"active"	=> $active
				);
				if ($action == "add") {
					$data['order_num'] = $this->m_services_tabs_details->get_next_value('order_num');
					$this->m_services_tabs_details->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_services_tabs_details->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/services-tabs/{$services_tab->service_id}/edit/{$services_tab->id}"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/services-tabs/{$services_tab->service_id}/edit/{$services_tab->id}"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_services_tabs_details->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			$view_data["services_tab"] = $services_tab;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/tabs/edit_details", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$item = $this->m_services_tabs_details->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->name}" => ''));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			$view_data["services_tab"] = $services_tab;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/tabs/edit_details", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	function services_tab_nation($service_tab_id, $action=null, $id=null) {
		$services_tab = $this->m_services_tabs->load($service_tab_id);
		$services = $this->m_services->load($services_tab->service_id);
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Services" => site_url("syslog/services")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$services->name}" => site_url("syslog/services/edit/{$services->id}")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$services_tab->name}" => site_url("syslog/services-tabs/{$services_tab->id}/edit/{$services->id}")));

		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$nation_id		= $this->util->value($this->input->post("nation_id"), "");
				$summary				= $this->util->value($this->input->post("summary"), "");
				$content				= $this->util->value($this->input->post("content"), "");
				// $services_process_id	= $this->util->value($this->input->post("services_process_id"), "");
				$meta_title				= $this->util->value($this->input->post("meta_title"), "");
				$meta_key				= $this->util->value($this->input->post("meta_key"), "");
				$meta_desc				= $this->util->value($this->input->post("meta_desc"), "");
				$active					= $this->util->value($this->input->post("active"), "");

				$data = array (
					"service_tab_id"		=> $service_tab_id,
					"nation_id"		=> $nation_id,
					"summary"				=> $summary,
					"content"				=> $content,
					// "services_process_id"	=> $services_process_id,
					"meta_title"			=> $meta_title,
					"meta_key"				=> $meta_key,
					"meta_desc"				=> $meta_desc,
					"active"				=> $active,
				);
				
				if ($action == "add") {
					$data['order_num'] = $this->m_services_tab_nation->get_next_value('order_num');
					$this->m_services_tab_nation->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_services_tab_nation->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/services-tabs/{$services->id}/edit/{$service_tab_id}"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/services-tabs/{$services->id}/edit/{$service_tab_id}"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_services_tab_nation->delete($where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/services-tabs/{$services->id}/edit/{$service_tab_id}"));
			}
		}

		if ($action == "add") {
			$item = $this->m_services_tab_nation->instance();
			$nation = null;
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add" => ''));
		}
		else if ($action == "edit") {
			$item = $this->m_services_tab_nation->load($id);

			$nation = $this->m_nation->load($item->nation_id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$nation->name}" => ''));
		}

		$view_data = array();
		$view_data["breadcrumb"] = $this->_breadcrumb;
		$view_data["item"] = $item;
		$view_data["nation"] = $nation;
		$view_data["nations"] = $this->m_nation->items();
		$view_data["process"] = $this->m_services_process->items();
		
		$tmpl_content = array();
		$tmpl_content["content"] = $this->load->view("admin/services/nation/edit", $view_data, true);
		$this->load->view("layout/admin/main", $tmpl_content);

	}
	public function services_process($action=null,$id=null) {

		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Service" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$name	= $this->util->value($this->input->post("name"), "");
				$step1	= $this->util->value($this->input->post("step1"), "");
				$step2	= $this->util->value($this->input->post("step2"), "");
				$step3	= $this->util->value($this->input->post("step3"), "");
				$step4	= $this->util->value($this->input->post("step4"), "");
				$step5	= $this->util->value($this->input->post("step5"), "");
				$step6	= $this->util->value($this->input->post("step6"), "");
				$step7	= $this->util->value($this->input->post("step7"), "");
				$step8	= $this->util->value($this->input->post("step8"), "");
				
				$data = array (
					"name"		=> $name,
					"step1"		=> $step1,
					"step2"		=> $step2,
					"step3"		=> $step3,
					"step4"		=> $step4,
					"step5"		=> $step5,
					"step6"		=> $step6,
					"step7"		=> $step7,
					"step8"		=> $step8,
				);
				
				if ($action == "add") {
					$this->m_services_process->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_services_process->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/services-process"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/services-process"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_services_process->delete($where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/services-process"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_services_process->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/process/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_services_process->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->name}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}/{$id}")));
		
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/process/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$view_data = array();
			$view_data["breadcrumb"] 	= $this->_breadcrumb;
			$view_data["items"]			= $this->m_services_process->items();
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/process/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	public function services_faqs($service_id, $action=null, $id=null) {
		$service = $this->m_services->load($service_id);

		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Service faqs" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$service_id}")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$service->name}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$service_id}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$question		= $this->util->value($this->input->post("question"), "");
				$alias			= $this->util->value($this->input->post("alias"), "");
				$desscription	= $this->util->value($this->input->post("desscription"), "");
				$jurisdiction_id= $this->util->value($this->input->post("jurisdiction_id"), "");
				$answer			= $this->util->value($this->input->post("answer"), "");
				$meta_title		= $this->util->value($this->input->post("meta_title"), "");
				$meta_key		= $this->util->value($this->input->post("meta_key"), "");
				$meta_desc		= $this->util->value($this->input->post("meta_desc"), "");
				$active			= $this->util->value($this->input->post("active"),1);
				if (empty($alias)) {
					$alias = $this->util->slug($question);
				}
				$data = array (
					"question"			=> $question,
					"alias"				=> $alias,
					"desscription"		=> $desscription,
					"jurisdiction_id"	=> $jurisdiction_id,
					"answer"			=> $answer,
					"service_id"		=> $service_id,
					"meta_title"		=> $meta_title,
					"meta_key"			=> $meta_key,
					"meta_desc"			=> $meta_desc,
					"active"			=> $active,
				);
				
				if ($action == "add") {
					$this->m_services_faqs->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_services_faqs->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/services-faqs/{$service_id}"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/services-faqs/{$service_id}"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_services_faqs->delete($where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/services-faqs/{$service_id}"));
			}
		}
		$info = new stdClass();
		$info->service_id = $service_id;
		$jurisdiction_services = $this->m_jurisdiction_services->items($info);
		
		if ($action == "add") {
			$item = $this->m_services_faqs->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$service_id}/{$action}")));
			
			$view_data = array();
			$view_data["breadcrumb"] 			= $this->_breadcrumb;
			$view_data["item"] 					= $item;
			$view_data["service"] 				= $service;
			$view_data["jurisdiction_services"] = $jurisdiction_services;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/faq/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_services_faqs->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->question}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$service_id}/{$action}/{$id}")));
		
			$view_data = array();
			$view_data["breadcrumb"] 			= $this->_breadcrumb;
			$view_data["item"] 					= $item;
			$view_data["service"] 				= $service;
			$view_data["jurisdiction_services"] = $jurisdiction_services;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/faq/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$info = new stdClass();
			$info->service_id = $service_id;
			$view_data = array();
			$view_data["breadcrumb"] 	= $this->_breadcrumb;
			$view_data["service"] 		= $service;
			$view_data["items"]			= $this->m_services_faqs->items($info);
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/services/faq/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}

	public function jurisdictions($action=null, $id=null) {

		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Jurisdictions " => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));

		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$nation_id		= $this->util->value($this->input->post("nation_id"), "");
				$thumbnail 		= !empty($_FILES['thumbnail']['name']) ? explode('.',$_FILES['thumbnail']['name']) : $this->m_content->load($id)->thumbnail;
				$description	= $this->util->value($this->input->post("description"), "");
				$meta_title		= $this->util->value($this->input->post("meta_title"), "");
				$meta_key		= $this->util->value($this->input->post("meta_key"), "");
				$meta_desc		= $this->util->value($this->input->post("meta_desc"), "");
				$services		= $this->util->value($this->input->post("services"), "");

				if (empty($id)) {
					$id = $this->m_jurisdictions->get_next_value();
				}

				$info = new stdClass();
				$info->jurisdiction_id = $id;
				$del_services = $this->m_jurisdiction_services->items($info);
				foreach ($del_services as $del_service) {
					$this->m_jurisdiction_services->delete(array("id" => $del_service->id));
				}
				
				foreach ($services as $service) {
					$data = array(
						"jurisdiction_id" 	=> $id,
						"service_id" 		=> $service,
					);
					$this->m_jurisdiction_services->add($data);
				}

				$data = array (
					"nation_id"		=> $nation_id,
					"description"	=> $description,
					"meta_title"	=> $meta_title,
					"meta_key"		=> $meta_key,
					"meta_desc"		=> $meta_desc,
				);
				if (!empty($_FILES['thumbnail']['name'])){
					$data['thumbnail'] = "/files/upload/jurisdiction/{$id}/{$this->util->slug($thumbnail[0])}.{$thumbnail[1]}";
				}
				$file_deleted = '';
				
				if ($action == "add") {
					$file_deleted = "./files/upload/jurisdiction/{$id}/{$this->m_content->load($id)->name}";
					$this->m_jurisdictions->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_jurisdictions->update($data, $where);
				}
				$path = "./files/upload/jurisdiction/{$id}";
				if (!file_exists($path)) {
					mkdir($path, 0755, true);
				}
				$allow_type = 'JPG|PNG|jpg|jpeg|png';
				$this->util->upload_file($path,'thumbnail',$file_deleted,$allow_type,$this->util->slug($thumbnail[0]).'.'.$thumbnail[1]);

				$this->create_sitemap();
				redirect(site_url("syslog/jurisdictions"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/jurisdictions"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_jurisdictions->delete($where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/jurisdictions"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_jurisdictions->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}")));

			$info = new stdClass();
			$nations = $this->m_nation->items();
			
			$view_data = array();
			$view_data["breadcrumb"] 	= $this->_breadcrumb;
			$view_data["item"] 			= $item;
			$view_data["nations"] 		= $nations;
			$view_data["id"] 			= $id;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/jurisdictions/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_jurisdictions->load($id);
			$nation = $this->m_nation->load($item->nation_id);

			$info = new stdClass();
			$info->jurisdiction_id = $id;
			$details = $this->m_jurisdiction_details->items($info);
			$downloads = $this->m_jurisdictions_download->items($info);
			$faqs = $this->m_jurisdictions_faqs->items($info);

			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$nation->name}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}/{$id}")));

			$nations = $this->m_nation->items();
		
			$view_data = array();
			$view_data["breadcrumb"] 	= $this->_breadcrumb;
			$view_data["item"] 			= $item;
			$view_data["nations"] 		= $nations;
			$view_data["details"] 		= $details;
			$view_data["downloads"] 	= $downloads;
			$view_data["faqs"] 			= $faqs;
			$view_data["id"] 			= $id;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/jurisdictions/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {

			$view_data = array();
			$view_data["breadcrumb"] 	= $this->_breadcrumb;
			$view_data["items"]			= $this->m_jurisdictions->items();
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/jurisdictions/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	public function jurisdiction_details($jurisdiction_id, $action=null,$id=null) {
		$jurisdiction_item = $this->m_jurisdictions->load($jurisdiction_id);
		$nation = $this->m_nation->load($jurisdiction_item->nation_id);
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Jurisdictions " => site_url("syslog/jurisdictions")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$nation->name}" => site_url("syslog/jurisdictions/edit/{$jurisdiction_id}")));

		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$name		= $this->util->value($this->input->post("name"), "");
				$module		= $this->util->value($this->input->post("module"), "");
				$content	= $this->util->value($this->input->post("content"), "");
				$active		= $this->util->value($this->input->post("active"), 1);
				
				$alias = $this->util->slug($name);
				$data = array (
					"name"				=> $name,
					"alias"				=> $alias,
					"jurisdiction_id"	=> $jurisdiction_id,
					"module"			=> $module,
					"content"			=> ($module == 'content') ? $content : null,
					"active"			=> $active
				);
				if ($action == "add") {
					$data['order_num'] = $this->m_jurisdiction_details->get_next_value('order_num');
					$this->m_jurisdiction_details->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_jurisdiction_details->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/jurisdictions/edit/{$jurisdiction_id}"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/jurisdictions/edit/{$jurisdiction_id}"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_jurisdiction_details->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add" => ''));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			$view_data["nation"] = $nation;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/jurisdictions/edit_details", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$item = $this->m_jurisdiction_details->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->name}" => ''));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			$view_data["nation"] = $nation;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/jurisdictions/edit_details", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	public function jurisdictions_faqs($jurisdiction_id, $action=null, $id=null) {
		$jurisdiction_item = $this->m_jurisdictions->load($jurisdiction_id);
		$nation = $this->m_nation->load($jurisdiction_item->nation_id);
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Jurisdictions " => site_url("syslog/jurisdictions")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$nation->name}" => site_url("syslog/jurisdictions/edit/{$jurisdiction_id}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$question		= $this->util->value($this->input->post("question"), "");
				$alias			= $this->util->value($this->input->post("alias"), "");
				$desscription	= $this->util->value($this->input->post("desscription"), "");
				$answer			= $this->util->value($this->input->post("answer"), "");
				$meta_title		= $this->util->value($this->input->post("meta_title"), "");
				$meta_key		= $this->util->value($this->input->post("meta_key"), "");
				$meta_desc		= $this->util->value($this->input->post("meta_desc"), "");
				$active			= $this->util->value($this->input->post("active"),1);
				if (empty($alias)) {
					$alias = $this->util->slug($question);
				}
				$data = array (
					"question"			=> $question,
					"alias"				=> $alias,
					"desscription"		=> $desscription,
					"answer"			=> $answer,
					"jurisdiction_id"	=> $jurisdiction_id,
					"meta_title"		=> $meta_title,
					"meta_key"			=> $meta_key,
					"meta_desc"			=> $meta_desc,
					"active"			=> $active,
				);
				
				if ($action == "add") {
					$data['order_num'] = $this->m_jurisdictions_faqs->get_next_value('order_num');
					$this->m_jurisdictions_faqs->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_jurisdictions_faqs->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/jurisdictions/edit/{$jurisdiction_id}"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/jurisdictions/edit/{$jurisdiction_id}"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_jurisdictions_faqs->delete($where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/jurisdictions/edit/{$jurisdiction_id}"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_jurisdictions_faqs->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add" => ''));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/jurisdictions/faq/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_jurisdictions_faqs->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->question}" => ''));

			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/jurisdictions/faq/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}

	public function jurisdictions_download($jurisdiction_id, $action=null,$id=null) {
		$jurisdiction_item = $this->m_jurisdictions->load($jurisdiction_id);
		$nation = $this->m_nation->load($jurisdiction_item->nation_id);
		$services = $this->m_services->items();
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Jurisdictions " => site_url("syslog/jurisdictions")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$nation->name}" => site_url("syslog/jurisdictions/edit/{$jurisdiction_id}")));
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("download" => ''));

		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$title		= $this->util->value($this->input->post("title"), "");
				$service_id		= $this->util->value($this->input->post("service_id"), "");
				$description		= $this->util->value($this->input->post("description"), "");
				$file_upload 		= !empty($_FILES['file_upload']['name']) ? explode('.',$_FILES['file_upload']['name']) : '';

				$data = array (
					"title"				=> $title,
					"jurisdiction_id"	=> $jurisdiction_id,
					"service_id"		=> $service_id,
					"description"		=> $description
				);
				if (!empty($_FILES['file_upload']['name'])){
					$data['file_path'] = "/files/upload/jurisdiction/download/{$this->util->slug($file_upload[0])}.{$file_upload[1]}";
				}
				if ($action == "add") {
					$data['order_num'] = $this->m_jurisdictions_download->get_next_value('order_num');
					$this->m_jurisdictions_download->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_jurisdictions_download->update($data, $where);
				}
				$path = "./files/upload/jurisdiction/download";
				if (!file_exists($path)) {
					mkdir($path, 0755, true);
				}
				$allow_type = '*';
				$this->util->upload_file($path,'file_upload','',$allow_type,$this->util->slug($file_upload[0]).'.'.$file_upload[1]);
				$this->create_sitemap();
				redirect(site_url("syslog/jurisdictions/edit/{$jurisdiction_id}"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/jurisdictions/edit/{$jurisdiction_id}"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_jurisdictions_download->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add" => ''));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			$view_data["nation"] = $nation;
			$view_data["services"] = $services;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/jurisdictions/download/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$item = $this->m_jurisdictions_download->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->title}" => ''));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			$view_data["nation"] = $nation;
			$view_data["services"] = $services;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/jurisdictions/download/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}

	public function pricing($service_id, $jurisdiction_id=null, $action=null, $services_tab_fee_id=null) {

		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Pricing" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$service_id}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$name			= $this->util->value($this->input->post("name"), "");
				$alias			= $this->util->value($this->input->post("alias"), "");
				$description	= $this->util->value($this->input->post("description"), "");
				
				if (empty($alias)) {
					$alias = $this->util->slug($name);
				}
				
				$data = array (
					"name"			=> $name,
					"alias"			=> $alias,
					"description"	=> $description,
				);
				
				if ($action == "add") {
					$this->m_services->add($data);
					redirect(site_url("syslog/services"));
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_services->update($data, $where);
					redirect(site_url("syslog/services"));
				} else {
					$name	= $this->util->value($this->input->post("name"), "");
					$data_tab = array(
						"name" => $name,
						"jurisdiction_id" => $jurisdiction_id,
						"service_id" => $service_id,
					);

					if ($action == "add_type") {
						$this->m_services_tab_fee->add($data_tab);
					} else if ($action == "edit_type") {
						$this->m_services_tab_fee->update($data_tab,array("id" => $services_tab_fee_id));
					}
					redirect(site_url("syslog/pricing/{$service_id}/{$jurisdiction_id}/edit"));
				}
				
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/services"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_services->delete($where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/services"));
			}
		}
		
		if ($action == "edit") {
			$info = new stdClass();
			$info->jurisdiction_id = $jurisdiction_id;
			$jurisdiction = $this->m_jurisdictions->jion_nation($info);

			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$jurisdiction->name}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$service_id}/{$jurisdiction_id}/{$action}")));

			$info->service_id = $service_id;
			$tab_fee_items = $this->m_services_tab_fee->items($info);
			if (empty($services_tab_fee_id)) {
				$services_tab_fee_id = !empty($tab_fee_items) ? $tab_fee_items[0]->id : null;
			}

			$info->services_tab_fee_id = $services_tab_fee_id;
			$items = $this->m_services_fee->items($info);

			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["jurisdiction"] = $jurisdiction;
			$view_data["service_id"] = $service_id;
			$view_data["jurisdiction_id"] = $jurisdiction_id;
			$view_data["services_tab_fee_id"] = $services_tab_fee_id;
			$view_data["tab_fee_items"] = $tab_fee_items;
			
			$view_data["items"] = $items;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/pricing/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "add_type") {
			$info = new stdClass();
			$info->jurisdiction_id = $jurisdiction_id;
			$jurisdiction = $this->m_jurisdictions->jion_nation($info);

			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$jurisdiction->name}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$service_id}/{$jurisdiction_id}/edit")));
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add type" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$service_id}/{$jurisdiction_id}/{$action}")));

			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["jurisdiction"] = $jurisdiction;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/pricing/edit_tab", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit_type") {
			$info = new stdClass();
			$info->jurisdiction_id = $jurisdiction_id;
			$jurisdiction = $this->m_jurisdictions->jion_nation($info);

			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$jurisdiction->name}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$service_id}/{$jurisdiction_id}/edit")));
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add type" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$service_id}/{$jurisdiction_id}/{$action}")));

			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["jurisdiction"] = $jurisdiction;
			
			$view_data["item"] = $this->m_services_tab_fee->load($services_tab_fee_id);
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/pricing/edit_tab", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$view_data = array();
			$view_data["breadcrumb"] 	= $this->_breadcrumb;
			$view_data["items"]			= $this->m_jurisdictions->items();
			$view_data["service_id"]	= $service_id;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/pricing/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	public function ajax_add_service_fee() {
		$jurisdiction_id= $this->util->value($this->input->post("jurisdiction_id"), "");
		$service_id		= $this->util->value($this->input->post("service_id"), "");
		$services_tab_fee_id= $this->util->value($this->input->post("services_tab_fee_id"), "");
		$name			= $this->util->value($this->input->post("name"), "");
		$content		= $this->util->value($this->input->post("description"), "");
		$fee			= $this->util->value($this->input->post("fee"), "");
		$capital		= $this->util->value($this->input->post("capital"), "");
		$recomen		= ($this->input->post("recomen") == 'true') ? 1 : 0;

		$data = array(
			"jurisdiction_id" 	=> $jurisdiction_id,
			"service_id" 		=> $service_id,
			"services_tab_fee_id" 	=> $services_tab_fee_id,
			"name" 				=> $name,
			"content" 			=> $content,
			"fee" 				=> $fee,
			"capital" 			=> $capital,
			"recomen" 			=> $recomen,
		);
		$result = $this->m_services_fee->add($data);

		echo json_encode($result);
	}
	public function ajax_change_service_fee() {
		$item_id		= $this->util->value($this->input->post("item_id"), "");
		$pro_type		= $this->util->value($this->input->post("pro_type"), "");
		$val			= $this->util->value($this->input->post("val"), "");

		if ($pro_type == 'recomen') {
			if ($val == 'true') {
				$data = array("{$pro_type}" 	=> 1);
			} else {
				$data = array("{$pro_type}" 	=> 0);
			}
		} else {
			$data = array("{$pro_type}" 	=> $val);
		}

		$this->m_services_fee->update($data, array("id" => $item_id));
	}
	public function ajax_delete_item() {
		$item_id	= $this->input->post("item_id");
		$tbl	= $this->input->post("tbl");
		$result = $this->{$tbl}->delete(array("id" => $item_id));
		echo json_encode($result);
	}
	public function slider($action=null, $id=null)
	{
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Sliders" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$name			= $this->util->value($this->input->post("name"), "");
				$link			= $this->util->value($this->input->post("link"), "");
				$content		= $this->util->value($this->input->post("content"), "");
				$url_img 		= !empty($_FILES['url_img']['name']) ? explode('.',$_FILES['url_img']['name']) : $this->m_slider->load($id)->url_img;
				$active			= $this->util->value($this->input->post("active"), 1);
				
				if (empty($id)) {
					$id = $this->m_slider->get_next_value();
				}

				$data = array (
					"name"		=> $name,
					"link"		=> $link,
					"content"	=> $content,
					"active"	=> $active
				);
				if (!empty($_FILES['url_img']['name'])){
					$data['url_img'] = "/files/upload/image/slider/{$id}/{$this->util->slug($url_img[0])}.{$url_img[1]}";
				}
				
				
				if ($action == "add") {
					$file_deleted = '';
					$this->m_slider->add($data);
				}
				else if ($action == "edit") {
					$file_deleted = ".{$this->m_slider->load($id)->url_img}";
					$where = array("id" => $id);
					$this->m_slider->update($data, $where);
				}
				$path = "./files/upload/image/slider/{$id}";
				if (!file_exists($path)) {
					mkdir($path, 0755, true);
				}
				$allow_type = 'JPG|PNG|jpg|jpeg|png';
				$this->util->upload_file($path,'url_img',$file_deleted,$allow_type,$this->util->slug($url_img[0]).'.'.$url_img[1]);

				$this->create_sitemap();
				redirect(site_url("syslog/slider"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/slider"));
			}
			else if ($task == "orderup") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_slider->order_up($id);
				}
				redirect(site_url("syslog/slider"));
			}
			else if ($task == "orderdown") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_slider->order_down($id);
				}
				redirect(site_url("syslog/slider"));
			}
			else if ($task == "saveorder") {
				$order = $this->util->value($this->input->post("order"), array());
				$cids  = $this->util->value($this->input->post("cids"), array());
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array("order_num" => $order[$i]);
					$where = array("id" => $cids[$i]);
					$this->m_slider->update($data, $where);
				}
				redirect(site_url("syslog/slider"));
			}
			else if ($task == "publish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 1);
					$where = array("id" => $id);
					$this->m_slider->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/slider"));
			}
			else if ($task == "unpublish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 0);
					$where = array("id" => $id);
					$this->m_slider->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/slider"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_slider->delete($where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/slider"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_slider->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/slider/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_slider->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->name}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}/{$id}")));
		
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/slider/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$items = $this->m_slider->items();
			
			$view_data = array();
			$view_data["breadcrumb"] 	= $this->_breadcrumb;
			$view_data["items"]			= $items;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/slider/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	//------------------------------------------------------------------------------
	// Q&A
	//------------------------------------------------------------------------------
	
	public function questions($action=null, $id=null)
	{
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Q&A" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$title		= $this->util->value($this->input->post("title"), "");
				$author		= $this->util->value($this->input->post("author"), "");
				$email		= $this->util->value($this->input->post("email"), "");
				$content	= $this->util->value($this->input->post("content"), "");
				$active		= $this->util->value($this->input->post("active"), 1);
				
				$id = (empty($id) ? $this->m_question->get_next_value() : $id);
				$alias = $this->util->slug($title)."-".$id;
				
				if ($action == "answer") {
					$data = array (
						"parent_id"	=> $id,
						"author"	=> "Vietnam Evisa Support",
						"email"		=> MAIL_INFO,
						"content"	=> $content
					);
					
					$this->m_question->add($data);
					
					$question = $this->m_question->load($id);
					
					$mail_data = array(
						"fullname"	=> $question->author,
						"question"	=> $question,
						"answer"	=> $content,
					);
					
					$mail_tpl = $this->mail_tpl->question_reply($mail_data);
					
					// Mail to author
					$mail = array(
	            		"subject"		=> $question->title,
						"from_sender"	=> MAIL_INFO,
	            		"name_sender"	=> SITE_NAME,
						"to_receiver"   => $question->email,
						"message"       => $mail_tpl
					);
					$this->mail->config($mail);
					$this->mail->sendmail();
				}
				else if ($action == "edit") {
					$data = array (
						"title"		=> $title,
						"alias"		=> $alias,
						"author"	=> $author,
						"email"		=> $email,
						"content"	=> $content,
						"active"	=> $active
					);
					
					$where = array("id" => $id);
					$this->m_question->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/questions"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/questions"));
			}
			else if ($task == "orderup") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_question->order_up($id);
				}
				redirect(site_url("syslog/questions"));
			}
			else if ($task == "orderdown") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_question->order_down($id);
				}
				redirect(site_url("syslog/questions"));
			}
			else if ($task == "saveorder") {
				$order = $this->util->value($this->input->post("order"), array());
				$cids  = $this->util->value($this->input->post("cids"), array());
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array("order_num" => $order[$i]);
					$where = array("id" => $cids[$i]);
					$this->m_question->update($data, $where);
				}
				redirect(site_url("syslog/questions"));
			}
			else if ($task == "publish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 1);
					$where = array("id" => $id);
					$this->m_question->update($data, $where);
				}
				redirect(site_url("syslog/questions"));
			}
			else if ($task == "unpublish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 0);
					$where = array("id" => $id);
					$this->m_question->update($data, $where);
				}
				redirect(site_url("syslog/questions"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_question->delete($where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/questions"));
			}
		}
		
		if ($action == "answer") {
			$item = $this->m_question->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add Answer" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}/{$id}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/question/answer", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_question->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->title}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}/{$id}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/question/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$info = new stdClass();
			$info->topLevel = TRUE;
			$info->orderby = "updated_date";
			$info->sortby = "DESC";
			
			$page = (!empty($_GET["page"]) ? max($_GET["page"], 1) : 1);
			$pagination = $this->util->pagination(site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}"), $this->m_question->count($info, null, $info->orderby, $info->sortby), ADMIN_ROW_PER_PAGE);
			
			$view_data = array();
			$view_data["breadcrumb"] 	= $this->_breadcrumb;
			$view_data["items"]			= $this->m_question->items($info, null, ADMIN_ROW_PER_PAGE, ($page - 1) * ADMIN_ROW_PER_PAGE, $info->orderby, $info->sortby);
			$view_data["page"]			= $page;
			$view_data["pagination"]	= $pagination;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/question/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	
	//------------------------------------------------------------------------------
	// Nations
	//------------------------------------------------------------------------------
	
	public function nations($action=null, $id=null)
	{
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Nations" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$name	= $this->util->value($this->input->post("name"), "");
				$code	= $this->util->value($this->input->post("code"), "");
				$alias	= $this->util->value($this->input->post("alias"), "");
				$file_path	= $this->util->value($this->input->post("file_path"), "");
				$region	= $this->util->value($this->input->post("region"), "");
				$active	= $this->util->value($this->input->post("active"), 1);
				
				if (empty($alias)) {
					$alias = $this->util->slug($name);
				}
				
				$data = array (
					"name"		=> $name,
					"code"		=> $code,
					"alias"		=> $alias,
					"file_path"	=> $file_path,
					"region"	=> $region,
					"active"	=> $active,
				);
				
				if ($action == "add") {
					$this->m_nation->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_nation->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/nations"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/nations"));
			}
			else if ($task == "orderup") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_nation->order_up($id);
				}
				redirect(site_url("syslog/nations"));
			}
			else if ($task == "orderdown") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_nation->order_down($id);
				}
				redirect(site_url("syslog/nations"));
			}
			else if ($task == "saveorder") {
				$order = $this->util->value($this->input->post("order"), array());
				$cids  = $this->util->value($this->input->post("cids"), array());
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array("order_num" => $order[$i]);
					$where = array("id" => $cids[$i]);
					$this->m_nation->update($data, $where);
				}
				redirect(site_url("syslog/nations"));
			}
			else if ($task == "publish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 1);
					$where = array("id" => $id);
					$this->m_nation->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/nations"));
			}
			else if ($task == "unpublish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 0);
					$where = array("id" => $id);
					$this->m_nation->update($data, $where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/nations"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_nation->delete($where);
				}
				$this->create_sitemap();
				redirect(site_url("syslog/nations"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_nation->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add Nation" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/nation/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_nation->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->name}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}/{$id}")));
		
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/nation/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {

			$view_data = array();
			$view_data["breadcrumb"] 	= $this->_breadcrumb;
			$view_data["items"]			= $this->m_nation->items(null, null, null, null);
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/nation/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	public function nation_type($action=null, $id=null)
	{
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Nation type" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$name	= $this->util->value($this->input->post("name"), "");
				
				$data = array (
					"name"		=> $name,
				);
				
				if ($action == "add") {
					$this->m_nation_type->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_nation_type->update($data, $where);
				}
				redirect(site_url("syslog/nation-type"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/nation-type"));
			}
			else if ($task == "orderup") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_nation_type->order_up($id);
				}
				redirect(site_url("syslog/nation-type"));
			}
			else if ($task == "orderdown") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$this->m_nation_type->order_down($id);
				}
				redirect(site_url("syslog/nation-type"));
			}
			else if ($task == "saveorder") {
				$order = $this->util->value($this->input->post("order"), array());
				$cids  = $this->util->value($this->input->post("cids"), array());
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array("order_num" => $order[$i]);
					$where = array("id" => $cids[$i]);
					$this->m_nation_type->update($data, $where);
				}
				redirect(site_url("syslog/nation-type"));
			}
			else if ($task == "publish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 1);
					$where = array("id" => $id);
					$this->m_nation_type->update($data, $where);
				}
				redirect(site_url("syslog/nation-type"));
			}
			else if ($task == "unpublish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 0);
					$where = array("id" => $id);
					$this->m_nation_type->update($data, $where);
				}
				redirect(site_url("syslog/nation-type"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_nation_type->delete($where);
				}
				redirect(site_url("syslog/nation-type"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_nation_type->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add Nation type" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/nation/type/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_nation_type->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->name}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}/{$id}")));
		
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/nation/type/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$view_data = array();
			$view_data["breadcrumb"] 	= $this->_breadcrumb;
			$view_data["items"]			= $this->m_nation_type->items();
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/nation/type/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	//------------------------------------------------------------------------------
	// Report
	//------------------------------------------------------------------------------
	function export_list()
	{
		$task		= $this->util->value($this->input->post("task"), "");
		$fromdate	= $this->util->value($this->input->post("fromdate"), date('Y-m-d H:i:s', mktime(0, 0, 0, date('m'), date('d'), date('Y'))));
		$todate		= $this->util->value($this->input->post("todate"), date('Y-m-d H:i:s', mktime(date('H'), date('i'), 59, date('m'), date('d'), date('Y'))));
		
		if (!empty($fromdate)) {
			$fromdate = date("Y-m-d H:i:s", strtotime($fromdate));
		}
		if (!empty($todate)) {
			$todate = date("Y-m-d H:i:s", strtotime($todate));
		}
		
		$info = new stdClass();
		$info->fromdate = $fromdate;
		$info->todate = $todate;
		
		$items = $this->m_visa_booking->all_booking_success($info);
		$booking_ids = array();
		for ($idx = 0; $idx < sizeof($items); $idx++) {
			$booking_ids[] = $items[$idx]->order_id;
		}
		if (sizeof($booking_ids)) {
			$paxs = $this->m_visa_booking->booking_travelers($booking_ids);
		} else {
			$paxs = array();
		}
		
		$view_data = array();
		$view_data['fromdate']	= $fromdate;
		$view_data['todate']	= $todate;
		$view_data['items']		= $items;
		$view_data['paxs']		= $paxs;
		
		$tmpl_content = array();
		$tmpl_content["content"]	= $this->load->view("admin/report/export_list", $view_data, TRUE);
		$this->load->view("layout/admin/main", $tmpl_content);

	}
	//------------------------------------------------------------------------------
	// History
	//------------------------------------------------------------------------------
	
	public function history($action=null, $id=null)
	{
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("History" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_history->delete($where);
				}
				redirect(site_url("syslog/history"));
			}
			else if ($task == "delete-all") {
				$this->m_history->delete_all();
				redirect(site_url("syslog/history"));
			}
		}
		
		$page = (!empty($_GET["page"]) ? max($_GET["page"], 1) : 1);
		$pagination = $this->util->pagination(site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}"), $this->m_history->count(), ADMIN_ROW_PER_PAGE);
		
		$view_data = array();
		$view_data["items"]			= $this->m_history->items(null, ADMIN_ROW_PER_PAGE, ($page - 1) * ADMIN_ROW_PER_PAGE);
		$view_data["breadcrumb"]	= $this->_breadcrumb;
		$view_data["page"]			= $page;
		$view_data["pagination"]	= $pagination;
		
		$tmpl_content = array();
		$tmpl_content["content"] = $this->load->view("admin/history/index", $view_data, true);
		$this->load->view("layout/admin/main", $tmpl_content);
	}
	
	public function ajax_history()
	{
		$id = $this->util->value($this->input->post("id"), 0);
		
		$view_data = array();
		$view_data["item"] = $this->m_history->load($id);
		echo $this->load->view("admin/history/ajax/detail", $view_data, true);
	}
	
	//------------------------------------------------------------------------------
	// Meta tags
	//------------------------------------------------------------------------------
	
	public function page_meta_tags($action=null, $id=null)
	{
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Page Meta Tags" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$url			= $this->util->value($this->input->post("url"), "");
				$title			= $this->util->value($this->input->post("title"), "");
				$keywords		= $this->util->value($this->input->post("keywords"), "");
				$description	= $this->util->value($this->input->post("description"), "");
				$active			= $this->util->value($this->input->post("active"), 1);
				
				$data = array (
					"url"			=> $url,
					"title"			=> $title,
					"keywords"		=> $keywords,
					"description"	=> $description,
					"active"		=> $active,
				);
	
				if ($action == "add") {
					$this->m_meta->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_meta->update($data, $where);
				}
				redirect(site_url("syslog/page-meta-tags"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/page-meta-tags"));
			}
			else if ($task == "publish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 1);
					$where = array("id" => $id);
					$this->m_meta->update($data, $where);
				}
				redirect(site_url("syslog/page-meta-tags"));
			}
			else if ($task == "unpublish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 0);
					$where = array("id" => $id);
					$this->m_meta->update($data, $where);
				}
				redirect(site_url("syslog/page-meta-tags"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_meta->delete($where);
				}
				redirect(site_url("syslog/page-meta-tags"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_meta->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add Meta Tags" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/meta/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_meta->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->title}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}/{$id}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/meta/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$page = (!empty($_GET["page"]) ? max($_GET["page"], 1) : 1);
			$pagination = $this->util->pagination(site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}"), $this->m_meta->count(), ADMIN_ROW_PER_PAGE);
			
			$view_data = array();
			$view_data["breadcrumb"]	= $this->_breadcrumb;
			$view_data["items"]			= $this->m_meta->items(null, null, ADMIN_ROW_PER_PAGE, ($page - 1) * ADMIN_ROW_PER_PAGE);
			$view_data["page"]			= $page;
			$view_data["pagination"]	= $pagination;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/meta/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	
	//------------------------------------------------------------------------------
	// Redirects
	//------------------------------------------------------------------------------
	
	public function page_redirects($action=null, $id=null)
	{
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Page Redirects" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$from_url	= $this->util->value($this->input->post("from_url"), "");
				$to_url		= $this->util->value($this->input->post("to_url"), "");
				$active		= $this->util->value($this->input->post("active"), 1);
				
				$data = array (
					"from_url"	=> $from_url,
					"to_url"	=> $to_url,
					"active"	=> $active,
				);
	
				if ($action == "add") {
					$this->m_redirect->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_redirect->update($data, $where);
				}
				redirect(site_url("syslog/page-redirects"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/page-redirects"));
			}
			else if ($task == "publish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 1);
					$where = array("id" => $id);
					$this->m_redirect->update($data, $where);
				}
				redirect(site_url("syslog/page-redirects"));
			}
			else if ($task == "unpublish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 0);
					$where = array("id" => $id);
					$this->m_redirect->update($data, $where);
				}
				redirect(site_url("syslog/page-redirects"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_redirect->delete($where);
				}
				redirect(site_url("syslog/page-redirects"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_redirect->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add Page Redirect" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/redirect/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_redirect->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->from_url}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}/{$id}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/redirect/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$page = (!empty($_GET["page"]) ? max($_GET["page"], 1) : 1);
			$pagination = $this->util->pagination(site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}"), $this->m_redirect->count(), ADMIN_ROW_PER_PAGE);
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["items"]			= $this->m_redirect->items(null, null, ADMIN_ROW_PER_PAGE, ($page - 1) * ADMIN_ROW_PER_PAGE);
			$view_data["page"]			= $page;
			$view_data["pagination"]	= $pagination;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/redirect/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	
	//------------------------------------------------------------------------------
	// Promotion
	//------------------------------------------------------------------------------
	
	public function promotion_codes($action=null, $id=null)
	{
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Promotion Codes" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$code			= $this->util->value(trim($this->input->post("code")), "");
				$start_date		= $this->util->value(date("Y-m-d", strtotime($this->input->post("start_date"))), date("Y-m-d"));
				$end_date		= $this->util->value(date("Y-m-d", strtotime($this->input->post("end_date"))), date("Y-m-d"));
				$discount		= $this->util->value($this->input->post("discount"), 0);
				$discount_unit	= $this->util->value($this->input->post("discount_unit"), "%");
				$active			= $this->util->value($this->input->post("active"), 1);
				
				$data = array (
					"code"			=> $code,
					"start_date"	=> $start_date,
					"end_date"		=> $end_date,
					"discount"		=> $discount,
					"discount_unit"	=> $discount_unit,
					"active"		=> $active,
				);
	
				if ($action == "add") {
					$this->m_promotion->add($data);
				}
				else if ($action == "edit") {
					$where = array("code" => $id);
					$this->m_promotion->update($data, $where);
				}
				redirect(site_url("syslog/promotion-codes"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/promotion-codes"));
			}
			else if ($task == "publish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 1);
					$where = array("code" => $id);
					$this->m_promotion->update($data, $where);
				}
				redirect(site_url("syslog/promotion-codes"));
			}
			else if ($task == "unpublish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 0);
					$where = array("code" => $id);
					$this->m_promotion->update($data, $where);
				}
				redirect(site_url("syslog/promotion-codes"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("code" => $id);
					$this->m_promotion->delete($where);
				}
				redirect(site_url("syslog/promotion-codes"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_promotion->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add Promotion Code" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/promotion/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_promotion->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->code}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}/{$id}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/promotion/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$search_status = $this->util->value($this->input->post("search_status"), "");
			$search_text = $this->util->value($this->input->post("search_text"), "");
			$search_text = strtoupper(trim($search_text));
			
			$info = new stdClass();
			if (!empty($search_text)) {
				$info->search_text = $search_text;
			}
			if (!empty($search_status)) {
				$info->search_status = $search_status;
			}
			
			$page = (!empty($_GET["page"]) ? max($_GET["page"], 1) : 1);
			$pagination = $this->util->pagination(site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}"), $this->m_promotion->count($info), ADMIN_ROW_PER_PAGE);
			
			$view_data = array();
			$view_data["task"]			= $task;
			$view_data["breadcrumb"]	= $this->_breadcrumb;
			$view_data["items"]			= $this->m_promotion->items($info, null, ADMIN_ROW_PER_PAGE, ($page - 1) * ADMIN_ROW_PER_PAGE);
			$view_data["search_text"]	= $search_text;
			$view_data["search_status"]	= $search_status;
			$view_data["page"]			= $page;
			$view_data["pagination"]	= $pagination;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/promotion/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	
	public function promotion_templates($action=null, $id=null)
	{
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Promotion Templates" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		if (!empty($task)) {
			if ($task == "save") {
				$sender			= $this->util->value($this->input->post("sender"), "");
				$sender_email	= $this->util->value($this->input->post("sender_email"), "");
				$emails			= $this->util->value($this->input->post("emails"), "");
				$subject		= $this->util->value($this->input->post("subject"), "");
				$content		= $this->util->value($this->input->post("content"), "");
				
				$data = array (
					"sender"		=> $sender,
					"sender_email"	=> $sender_email,
					"emails"		=> $emails,
					"subject"		=> $subject,
					"content"		=> $content
				);
	
				if ($action == "add") {
					$this->m_promotion_txt->add($data);
				}
				else if ($action == "edit") {
					$where = array("id" => $id);
					$this->m_promotion_txt->update($data, $where);
				}
				redirect(site_url("syslog/promotion-templates"));
			}
			else if ($task == "cancel") {
				redirect(site_url("syslog/promotion-templates"));
			}
			else if ($task == "publish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 1);
					$where = array("id" => $id);
					$this->m_promotion_txt->update($data, $where);
				}
				redirect(site_url("syslog/promotion-templates"));
			}
			else if ($task == "unpublish") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$data = array("active" => 0);
					$where = array("id" => $id);
					$this->m_promotion_txt->update($data, $where);
				}
				redirect(site_url("syslog/promotion-templates"));
			}
			else if ($task == "delete") {
				$ids = $this->util->value($this->input->post("cid"), array());
				foreach ($ids as $id) {
					$where = array("id" => $id);
					$this->m_promotion_txt->delete($where);
				}
				redirect(site_url("syslog/promotion-templates"));
			}
		}
		
		if ($action == "add") {
			$item = $this->m_promotion_txt->instance();
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("Add Promotion Template" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/promotion/template/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else if ($action == "edit") {
			$item = $this->m_promotion_txt->load($id);
			$this->_breadcrumb = array_merge($this->_breadcrumb, array("{$item->subject}" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}/{$action}/{$id}")));
			
			$view_data = array();
			$view_data["breadcrumb"] = $this->_breadcrumb;
			$view_data["item"] = $item;
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/promotion/template/edit", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
		else {
			$view_data = array();
			$view_data["breadcrumb"]	= $this->_breadcrumb;
			$view_data["items"]			= $this->m_promotion_txt->items(null, null, null, null);
			
			$tmpl_content = array();
			$tmpl_content["content"] = $this->load->view("admin/promotion/template/index", $view_data, true);
			$this->load->view("layout/admin/main", $tmpl_content);
		}
	}
	
	function promotion_booking()
	{
		require_once(APPPATH."libraries/ip2location/IP2Location.php");
		$loc = new IP2Location(FCPATH . '/application/libraries/ip2location/databases/IP-COUNTRY-SAMPLE.BIN', IP2Location::FILE_IO);
		
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Visa Bookings with Codes" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$task	= $this->util->value($this->input->post("task"), "cancel");
		$ids	= $this->util->value($this->input->post("cid"), array());
		
		foreach ($ids as $id) {
			if ($task == "remove") {
				$this->m_visa_booking->delete(array ("id" => $id));
				$this->m_visa_booking->delete_traveller(array ("book_id" => $id));
			} else if ($task == "paid") {
				$data = array ("status" => 1);
				$where = array ("id" => $id);
				$this->m_visa_booking->update($data, $where);
			} else if ($task == "unpaid") {
				$data = array ("status" => 0);
				$where = array ("id" => $id);
				$this->m_visa_booking->update($data, $where);
			}
		}
		
		$sortby 				= $this->util->value($this->input->post("sortby"), "booking_date");
		$orderby 				= $this->util->value($this->input->post("orderby"), "DESC");
		$original_search_text	= $this->util->value($this->input->post("search_text"), "");
		$search_visa_type		= $this->util->value($this->input->post("search_visa_type"), "");
		$search_visit_purpose	= $this->util->value($this->input->post("search_visit_purpose"), "");
		$search_country 		= $this->util->value($this->input->post("search_country"), "");
		$fromdate				= $this->util->value($this->input->post("fromdate"), date("Y-m-d"));
		$todate					= $this->util->value($this->input->post("todate"), date("Y-m-d"));
		
		$search_text = strtoupper(trim($original_search_text));
		$search_text = str_replace(array(BOOKING_PREFIX), "", $search_text);
		
		if (!empty($search_text)) {
			$fromdate = "";
			$todate = "";
		}
		
		if (!empty($fromdate)) {
			$fromdate = date("Y-m-d", strtotime($fromdate));
		}
		if (!empty($todate)) {
			$todate = date("Y-m-d", strtotime($todate));
		}
		
		$info = new stdClass();
		$info->search_text		= $search_text;
		if (!empty($search_visa_type)) {
			$info->visa_type	= $this->m_visa_type->load($search_visa_type)->name;
		}
		$info->visit_purpose	= $search_visit_purpose;
		$info->fromdate			= $fromdate;
		$info->todate			= $todate;
		$info->sortby			= $sortby;
		$info->orderby			= $orderby;
		$info->promotion_code	= "*";
		
		$pre_items = $this->m_visa_booking->bookings($info);
		
		$countries = array();
		foreach ($pre_items as $item) {
			if (!empty($item->client_ip)) {
				$country_code = $loc->lookup($item->client_ip, IP2Location::COUNTRY_CODE);
				$country_name = $loc->lookup($item->client_ip, IP2Location::COUNTRY_NAME);
				$country_flag = ADMIN_IMG_URL.'flags/'.strtolower($country_code).'.png';
				if ($country_code == '-') {
					$country_flag = ADMIN_IMG_URL.'flags/default.png';
				}
				$item->country_name = ucwords(strtolower($country_name));
				$item->country_flag = $country_flag;
				if ($item->status) {
					if (array_key_exists($item->country_name, $countries)) {
						$countries[$item->country_name] += 1;
					} else {
						$countries[$item->country_name] = 1;
					}
				}
			}
		}
		ksort($countries);
		
		$items = array();
		
		$sum_vs = 0;
		$sum_px = 0;
		$sum_op = 0;
		$sum_pp = 0;
		$sum_gs = 0;
		
		$sum_pr = 0;
		$sum_fp = 0;
		$sum_fc = 0;
		$sum_cr = 0;
		$sum_cp = 0;
		$sum_rf = 0;
		$sum_st = 0;
		
		foreach ($pre_items as $item) {
			if (!empty($search_country) && $search_country != $item->country_name) {
				continue;
			}
			$items[] = $item;
			if ($item->status == 1) {
				$sum_vs += 1;
				$sum_px += $item->group_size;
				
				if ($item->private_visa) {
					$sum_pr ++;
				}
				if ($item->full_package) {
					$sum_fp ++;
				}
				if ($item->fast_checkin) {
					$sum_fc ++;
				}
				if ($item->car_pickup) {
					$sum_cr ++;
				}
				if ($item->full_package || $item->rush_type == 2) {
					$sum_st += ($item->stamp_fee * $item->group_size);
				}
				if ($item->payment_method == "OnePay") {
					$sum_op += $item->total_fee;
				} else if ($item->payment_method == "Paypal") {
					$sum_pp += $item->total_fee;
				} else if ($item->payment_method == "Credit Card") {
					$sum_gs += $item->total_fee;
				}
				if ($item->refund != $item->total_fee) {
					$sum_cp += $item->capital;
				}
				$sum_rf += $item->refund;
			}
		}
		
		$page = (!empty($_GET["page"]) ? max($_GET["page"], 1) : 1);
		$pagination = $this->util->pagination(site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}"), sizeof($items), ADMIN_ROW_PER_PAGE);
		
		$view_data = array();
		$view_data["task"]					= $task;
		$view_data["sortby"]				= $sortby;
		$view_data["orderby"]				= $orderby;
		$view_data["search_text"]			= $original_search_text;
		$view_data["edited_search_text"]	= $search_text;
		$view_data["search_visa_type"]		= $search_visa_type;
		$view_data["search_visit_purpose"]	= $search_visit_purpose;
		$view_data["search_country"]		= $search_country;
		$view_data["fromdate"]				= $fromdate;
		$view_data["todate"]				= $todate;
		$view_data["items"]					= $items;
		$view_data["sum_vs"]				= $sum_vs;
		$view_data["sum_px"]				= $sum_px;
		$view_data["sum_op"]				= $sum_op;
		$view_data["sum_pp"]				= $sum_pp;
		$view_data["sum_gs"]				= $sum_gs;
		$view_data["sum_pr"]				= $sum_pr;
		$view_data["sum_fp"]				= $sum_fp;
		$view_data["sum_fc"]				= $sum_fc;
		$view_data["sum_cr"]				= $sum_cr;
		$view_data["sum_cp"]				= $sum_cp;
		$view_data["sum_rf"]				= $sum_rf;
		$view_data["sum_st"]				= $sum_st;
		$view_data["breadcrumb"]			= $this->_breadcrumb;
		$view_data["page"]					= $page;
		$view_data["pagination"]			= $pagination;
		$view_data["all_countries"]			= $countries;
		
		$booking_ids = array();
		for ($idx = (($page - 1) * ADMIN_ROW_PER_PAGE); $idx < sizeof($items) && $idx < ($page * ADMIN_ROW_PER_PAGE); $idx++) {
			$booking_ids[] = $items[$idx]->id;
		}
		if (sizeof($booking_ids)) {
			$view_data["paxs"] = $this->m_visa_booking->booking_travelers($booking_ids);
		} else {
			$view_data["paxs"] = array();
		}
		
		$tmpl_content = array();
		$tmpl_content["content"] = $this->load->view("admin/promotion/booking/visa_booking", $view_data, TRUE);
		$this->load->view("layout/admin/main", $tmpl_content);
	}
	//------------------------------------------------------------------------------
	// Scheduler
	//------------------------------------------------------------------------------
	
	public function scheduler()
	{
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Time Table" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$task = $this->util->value($this->input->post("task"), "");
		
		$search_text = $this->util->value($this->input->post("search_text"), "");
		$fromdate = $this->util->value($this->input->post("fromdate"), date("Y-m-d"));
		$todate = $this->util->value($this->input->post("todate"), date("Y-m-d"));
		
		$search_text = strtoupper(trim($search_text));
		
		if (!empty($search_text)) {
			$fromdate = "";
			$todate = "";
		}
		
		if (!empty($fromdate)) {
			$fromdate = date("Y-m-d", strtotime($fromdate));
		}
		if (!empty($todate)) {
			$todate = date("Y-m-d", strtotime($todate));
		}
		
		$info = new stdClass();
		$info->search_text = $search_text;
		$info->fromdate = $fromdate;
		$info->todate = $todate;
		$info->user_types = array(USR_ADMIN);
		$users = $this->m_user->users($info, 1);
		
		$view_data = array();
		$view_data["breadcrumb"] 	= $this->_breadcrumb;
		$view_data["users"]			= $users;
		$view_data["task"]			= $task;
		$view_data["search_text"]	= $search_text;
		$view_data["fromdate"]		= $fromdate;
		$view_data["todate"]		= $todate;
		
		$tmpl_content = array();
		$tmpl_content["content"] = $this->load->view("admin/scheduler/index", $view_data, true);
		$this->load->view("layout/admin/main", $tmpl_content);
	}
	
	public function ajax_scheduler($action)
	{
		if ($action == "add") {
			$start_date = date('m/d/Y H:i');
			$end_date = date('m/d/Y H:i');
			echo json_encode(array($start_date, $end_date));
		}
		else if ($action == "edit") {
			$id = $this->input->post("id");
			$schedule = $this->m_work_schedule->load($id);
			$start_date = date('m/d/Y H:i', strtotime($schedule->start_date));
			$end_date = date('m/d/Y H:i', strtotime($schedule->end_date));
			echo json_encode(array($start_date, $end_date));
		}
		else if ($action == "save") {
			$data = array(
				"user_id"		=> $this->input->post("user_id"),
				"start_date"	=> date("Y-m-d H:i:s", strtotime($this->input->post("start_date"))),
				"end_date"		=> date("Y-m-d H:i:s", strtotime($this->input->post("end_date")))
			);
			$this->m_work_schedule->add($data);
		}
		else if ($action == "update") {
			$data = array(
				"start_date"	=> date("Y-m-d H:i:s", strtotime($this->input->post("start_date"))),
				"end_date"		=> date("Y-m-d H:i:s", strtotime($this->input->post("end_date")))
			);
			$where = array("id" => $this->input->post("id"));
			$this->m_work_schedule->update($data, $where);
		}
		else if ($action == "delete") {
			$where = array("id" => $this->input->post("id"));
			$this->m_work_schedule->delete($where);
		}
	}
	
	public function check_schedule($user_id)
	{
		$now = date($this->config->item("log_date_format"));
		$info = new stdClass();
		$info->user_id = $user_id;
		$info->fromdate = date("Y-m-d");
		$info->todate = date("Y-m-d");
		$schedules = $this->m_work_schedule->items($info);
		foreach ($schedules as $schedule) {
			if (strtotime($now) >= strtotime($schedule->start_date) && strtotime($now) <= strtotime($schedule->end_date)) {
				return true;
			}
		}
		return false;
	}
	
	//------------------------------------------------------------------------------
	// Holiday
	//------------------------------------------------------------------------------
	
	public function holiday()
	{
		$this->_breadcrumb = array_merge($this->_breadcrumb, array("Holiday" => site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}")));
		
		$view_data = array();
		$view_data["breadcrumb"] = $this->_breadcrumb;
		
		$tmpl_content = array();
		$tmpl_content["content"] = $this->load->view("admin/holiday/index", $view_data, true);
		$this->load->view("layout/admin/main", $tmpl_content);
	}
	
	public function ajax_holiday($action)
	{
		if ($action == "add") {
			$name = "";
			$start_date = date('m/d/Y');
			$end_date = date('m/d/Y');
			echo json_encode(array($name, $start_date, $end_date));
		}
		else if ($action == "edit") {
			$id = $this->input->post("id");
			$holiday = $this->m_holiday->load($id);
			$name = $holiday->name;
			$start_date = date('m/d/Y', strtotime($holiday->start_date));
			$end_date = date('m/d/Y', strtotime($holiday->end_date));
			echo json_encode(array($name, $start_date, $end_date));
		}
		else if ($action == "save") {
			$name = $this->input->post("name");
			$start_date = date("Y-m-d", strtotime($this->input->post("start_date")));
			$end_date = date("Y-m-d", strtotime($this->input->post("end_date")));
			if ($start_date > $end_date) {
				$start_date = $end_date;
			}
			$data = array(
				"name"			=> $name,
				"start_date"	=> $start_date,
				"end_date"		=> $end_date
			);
			$this->m_holiday->add($data);
		}
		else if ($action == "update") {
			$id = $this->input->post("id");
			$name = $this->input->post("name");
			$start_date = date("Y-m-d", strtotime($this->input->post("start_date")));
			$end_date = date("Y-m-d", strtotime($this->input->post("end_date")));
			if ($start_date > $end_date) {
				$start_date = $end_date;
			}
			$data = array(
				"name"			=> $name,
				"start_date"	=> $start_date,
				"end_date"		=> $end_date
			);
			$where = array("id" => $id);
			$this->m_holiday->update($data, $where);
		}
		else if ($action == "delete") {
			$id = $this->input->post("id");
			$where = array("id" => $id);
			$this->m_holiday->delete($where);
		}
	}
	public function upload_file (){
		$config = array(
			"upload_path" 		=> './files/upload/image/img-content',
			"allowed_types" 	=> '*'
		);
		$this->load->library('upload',$config);
		if ($this->upload->do_upload('file')) {
			$data = $this->upload->data();
			@chmod($data['full_path'],0777);
			$temp = explode('.',$_FILES['file']['name']);
			rename($data['full_path'],$data['file_path'].$this->util->slug($temp[0]).'.'.$temp[1]);
			$filename = $this->util->slug($temp[0]).'.'.$temp[1];
		}
		echo $filename;
	}
	public function delete_file() {
		$link = $this->input->post('link');
		$filename = explode('img-content/', $link);
		$file_link = str_replace('*','',PATH_CKFINDER);
		unlink($file_link.$filename[1]);
	}
	function booking() {
		require_once(APPPATH."libraries/ip2location/IP2Location.php");
		$loc = new IP2Location(FCPATH . '/application/libraries/ip2location/databases/IP-COUNTRY-SAMPLE.BIN', IP2Location::FILE_IO);
		$page = (!empty($_GET["page"]) ? max($_GET["page"], 1) : 1);
		$offset = ($page - 1) * ADMIN_ROW_PER_PAGE;
		$fromdate 	= $this->input->post('fromdate');
		$todate 	= $this->input->post('todate');
		$info = new stdClass();
		$info->fromdate = !empty($fromdate) ? $fromdate : date('Y-m-d');
		$info->todate = !empty($todate) ? $todate : date('Y-m-d');
		$total_bookings = $this->m_services_booking->bookings($info);
		$bookings	= $this->m_services_booking->bookings($info, ADMIN_ROW_PER_PAGE, $offset);

		$countries = array();
		foreach ($bookings as $booking) {
			if (!empty($booking->client_ip)) {
				$country_code = $loc->lookup($booking->client_ip, IP2Location::COUNTRY_CODE);
				$country_name = $loc->lookup($booking->client_ip, IP2Location::COUNTRY_NAME);
				$country_flag = ADMIN_IMG_URL.'flags/'.strtolower($country_code).'.png';
				if ($country_code == '-') {
					$country_flag = ADMIN_IMG_URL.'flags/default.png';
				}
				$booking->country_name = ucwords(strtolower($country_name));
				$booking->country_flag = $country_flag;
				if ($booking->status) {
					if (array_key_exists($booking->country_name, $countries)) {
						$countries[$booking->country_name] += 1;
					} else {
						$countries[$booking->country_name] = 1;
					}
				}
			}
		}
		ksort($countries);

		$pagination = $this->util->pagination(site_url("{$this->util->slug($this->router->fetch_class())}/{$this->util->slug($this->router->fetch_method())}"), sizeof($total_bookings), ADMIN_ROW_PER_PAGE);

		$view_data = array();
		$view_data["breadcrumb"] 		= $this->_breadcrumb;
		$view_data["bookings"]			= $bookings;
		$view_data["all_countries"]		= $countries;
		$view_data["fromdate"]			= $fromdate;
		$view_data["todate"]			= $todate;
		$view_data["pagination"]		= $pagination;
		$view_data["offset"]			= $offset;
		
		$tmpl_content = array();
		$tmpl_content["content"] = $this->load->view("admin/report/booking", $view_data, true);
		$this->load->view("layout/admin/main", $tmpl_content);
	}
	public function get_jurisdictions_content() {
		$module = $this->input->post('module');
		$jur_id = $this->input->post('jur_id');

		$info = new stdClass();
		$info->module = $module;
		$info->jurisdiction_id = $jur_id;
		$jurisdictions_modules = $this->m_jurisdictions_resources->items($info);

		$arr_modules = array();
		foreach ($jurisdictions_modules as $jurisdictions_module) {
			array_push($arr_modules, $jurisdictions_module->content_id);
		}

		$info = new stdClass();
		if ($module == 'new') {
			$info->catid = 6;
		} else if ($module == 'blog') {
			$info->catid = 5;
		}
		$info->arr_modules = $arr_modules;
		$jurisdictions_modules = $this->m_content->jurisdiction_items($info);
		echo json_encode($jurisdictions_modules);
	}
	public function add_jurisdictions_content() {
		$module = $this->input->post('module');
		$jur_id = $this->input->post('jur_id');
		$list_content = array_filter($this->input->post('list_content'));

		foreach ($list_content as $value) {
			$data = array(
				"jurisdiction_id" => $jur_id,
				"module" => $module,
				"content_id" => $value,
			);
			$this->m_jurisdictions_resources->add($data);
		}

		echo json_encode(1);
	}
	public function get_services_content() {
		$module = $this->input->post('module');
		$service_tab_id = $this->input->post('service_tab_id');

		$info = new stdClass();
		$info->module = $module;
		$info->service_tab_id = $service_tab_id;
		$service_modules = $this->m_services_resources->items($info);

		$arr_modules = array();
		foreach ($service_modules as $service_module) {
			array_push($arr_modules, $service_module->content_id);
		}

		$info = new stdClass();
		if ($module == 'new') {
			$info->catid = 6;
		} else if ($module == 'blog') {
			$info->catid = 5;
		}
		$info->arr_modules = $arr_modules;
		$service_modules = $this->m_content->jurisdiction_items($info);
		echo json_encode($service_modules);
	}
	public function add_services_content() {
		$module = $this->input->post('module');
		$service_tab_id = $this->input->post('service_tab_id');
		$list_content = array_filter($this->input->post('list_content'));

		foreach ($list_content as $value) {
			$data = array(
				"service_tab_id" => $service_tab_id,
				"module" => $module,
				"content_id" => $value,
			);
			$this->m_services_resources->add($data);
		}

		echo json_encode(1);
	}
}

?>