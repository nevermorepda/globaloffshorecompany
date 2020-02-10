<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apply extends CI_Controller {

	public function index()
	{

		$view_data = array();
		// $view_data['service'] 			= $service;
		// $view_data['item_tabs'] 	= $item_tabs;
		// $view_data['tab'] 			= $tab;
		
		$tmpl_content = array();
		// $tmpl_content['meta']['title'] = $this->util->getMetaTitle($service);
		// $tmpl_content['meta']['keywords'] = $service->meta_key;
		// $tmpl_content['meta']['description'] = $service->meta_desc;
		$tmpl_content['content'] = $this->load->view("apply/step", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
}

?>