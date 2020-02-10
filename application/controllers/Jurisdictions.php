<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jurisdictions extends CI_Controller {

	public function index($region, $nation_alias=null)
	{
		if (!empty($region)) {
			if (!empty($nation_alias)) {
				$info = new stdClass();
				$info->nation_alias = $nation_alias;
				$item = $this->m_jurisdictions->jion_nation($info);

				$info = new stdClass();
				$info->jurisdiction_id = $item->jurisdiction_id;
				$tab_details = $this->m_jurisdiction_details->items($info,1);

				
				$view_data = array();
				$view_data['item'] 		= $item;
				$view_data['tab_details'] 		= $tab_details;
				// $view_data['tab'] 			= $tab;
				// $view_data['breadcrumb'] = $breadcrumb;
				
				$tmpl_content = array();
				// $tmpl_content['meta']['title'] = $this->util->getMetaTitle($item);
				// $tmpl_content['meta']['keywords'] = $item->meta_key;
				// $tmpl_content['meta']['description'] = $item->meta_desc;
				$tmpl_content['content'] = $this->load->view("jurisdictions/detail", $view_data, TRUE);
				$this->load->view('layout/main', $tmpl_content);
			} else {
				// $breadcrumb = array("Why us" => site_url("{$this->util->slug($this->router->fetch_class())}"));
				$info = new stdClass();
				$info->region = $region;
				$items = $this->m_jurisdictions->items($info);
				
				$view_data = array();
				$view_data['items'] 		= $items;
				$view_data['region'] 		= $region;
				// $view_data['tab'] 			= $tab;
				// $view_data['breadcrumb'] = $breadcrumb;
				
				$tmpl_content = array();
				// $tmpl_content['meta']['title'] = $this->util->getMetaTitle($item);
				// $tmpl_content['meta']['keywords'] = $item->meta_key;
				// $tmpl_content['meta']['description'] = $item->meta_desc;
				$tmpl_content['content'] = $this->load->view("jurisdictions/index", $view_data, TRUE);
				$this->load->view('layout/main', $tmpl_content);
			}
		} else {
			redirect("error404");
		}
	}
}

?>