<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Our_services extends CI_Controller {

	public function index($service, $tab=null, $nation=null)
	{

		$service = $this->m_services->load($service);

		$info = new stdClass();
		$info->service_id = $service->id;
		$item_tabs = $this->m_services_tabs->items($info);
		if (empty($tab)) {
			$tab = !empty($item_tabs[0]) ? $item_tabs[0] : null;
		} else {
			$tab = $this->m_services_tabs->load($tab);
		}

		$view_data = array();
		$view_data['service'] 		= $service;
		$view_data['item_tabs'] 	= $item_tabs;
		$view_data['tab'] 			= $tab;
		
		$tmpl_content = array();
		$tmpl_content['meta']['title'] = $service->meta_title;
		$tmpl_content['meta']['keywords'] = $service->meta_key;
		$tmpl_content['meta']['description'] = $service->meta_desc;
		$tmpl_content['content'] = $this->load->view("service/index", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
}

?>