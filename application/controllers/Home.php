<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		// $this->util->block_ip();
		$this->output->cache(CACHE_TIME);
		$sliders = $this->m_slider->items(1);

		$services = $this->m_services->items(null,1,5);

		$view_data = array();
		$view_data['services'] 	= $services;
		$view_data['sliders'] 	= $sliders;

		$tmpl_content = array();
		$tmpl_content['tabindex']  = "home";
		$tmpl_content['content']   = $this->load->view("home", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
}

?>