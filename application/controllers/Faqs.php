<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faqs extends CI_Controller {

	public function index()
	{
		$view_data = array();
		$view_data['categories'] = $this->m_faq_category->items(null,1);
		
		$tmpl_content = array();
		$tmpl_content['meta']['title'] = 'FAQs';
		$tmpl_content['meta']['keywords'] = '';
		$tmpl_content['meta']['description'] = '';
		$tmpl_content['content'] = $this->load->view("faq/index", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
}

?>