<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	public function index($type=null, $alias=null)
	{
		$breadcrumb = array("News" => site_url("{$this->util->slug($this->router->fetch_class())}"));
		if (!empty($type)) {
			if (!in_array($type,array('company-services','bank-account','office-services','professional-service','visa-and-immigrant'))) {

				$nation = $this->m_nation->load($type);

				$info = new stdClass();
				$info->nation_id = $nation->id;
				$jurisdiction = $this->m_jurisdictions->items($info)[0];


				if (!empty($alias)) {
					// $this->output->cache(CACHE_TIME);
					$item = $this->m_content->load($alias);
					$info = new stdClass();
					$info->module = 'new';
					$info->jurisdiction_id = $jurisdiction->jurisdiction_id;
					$info->content_id = $item->id;
					$check_jurisdictions_resources = $this->m_jurisdictions_resources->items($info,1)[0];
					if (empty($check_jurisdictions_resources)) {
						redirect(site_url("error404"));
					}

					$relateditems = $this->m_jurisdictions_resources->related_items($check_jurisdictions_resources->id,$info,1,12);
					
					$view_data = array();
					$view_data['item'] = $item;
					$view_data['relateditems'] = $relateditems;
					$view_data['breadcrumb'] = $breadcrumb;
					$view_data['type'] = $type;
					$view_data['title'] = 'News';
					
					$tmpl_content = array();
					$tmpl_content['meta']['title'] = $this->util->getMetaTitle($item);
					$tmpl_content['meta']['keywords'] = $item->meta_key;
					$tmpl_content['meta']['description'] = $item->meta_desc;
					$tmpl_content['content'] = $this->load->view("news/detail", $view_data, TRUE);
					$this->load->view('layout/main', $tmpl_content);
				} else {
					$info = new stdClass();
					$info->module = 'new';
					$info->jurisdiction_id = $jurisdiction->jurisdiction_id;
					
					$search_text = '';
					if (!empty($_GET['search'])) {
						$info->search = $_GET['search'];
						$search_text = $_GET['search'];
					}

					$total_items = $this->m_jurisdictions_resources->join_content_items($info,1);
					$c_total_items = count($total_items);

					$page = (!empty($_GET["page"]) ? max($_GET["page"], 1) : 1);
					$pagination = $this->util->pagination(site_url("{$this->util->slug($this->router->fetch_class())}/{$type}"). "?$_SERVER[QUERY_STRING]", $c_total_items, 12);

					$items = $this->m_jurisdictions_resources->join_content_items($info,1, 12, ($page - 1) * 12);
					
					$view_data = array();
					$view_data['items'] = $items;
					$view_data['breadcrumb'] = $breadcrumb;
					$view_data['pagination'] = $pagination;
					$view_data['type'] = $type;
					$view_data['search_text'] = $search_text;
					$view_data['title'] = 'News';
					
					$tmpl_content = array();
					$tmpl_content['meta']['title'] = 'News';
					$tmpl_content['meta']['keywords'] = '';
					$tmpl_content['meta']['description'] = '';
					$tmpl_content['content'] = $this->load->view("news/index", $view_data, TRUE);
					$this->load->view('layout/main', $tmpl_content);
				}
			} else {

			}
		} else {
			$info = new stdClass();
			$info->module = 'new';
			$search_text = '';
			if (!empty($_GET['search'])) {
				$info->search = $_GET['search'];
				$search_text = $_GET['search'];
			}

			$total_items = $this->m_jurisdictions_resources->join_content_items($info,1);
			$c_total_items = count($total_items);

			$page = (!empty($_GET["page"]) ? max($_GET["page"], 1) : 1);
			$pagination = $this->util->pagination(site_url("{$this->util->slug($this->router->fetch_class())}/{$type}"). "?$_SERVER[QUERY_STRING]", $c_total_items, 12);

			$items = $this->m_jurisdictions_resources->join_content_items($info,1, 12, ($page - 1) * 12);
			
			$view_data = array();
			$view_data['items'] = $items;
			$view_data['breadcrumb'] = $breadcrumb;
			$view_data['pagination'] = $pagination;
			$view_data['type'] = $type;
			$view_data['search_text'] = $search_text;
			$view_data['title'] = 'News';
			
			$tmpl_content = array();
			$tmpl_content['meta']['title'] = 'News';
			$tmpl_content['meta']['keywords'] = '';
			$tmpl_content['meta']['description'] = '';
			$tmpl_content['content'] = $this->load->view("news/index", $view_data, TRUE);
			$this->load->view('layout/main', $tmpl_content);
		}
	}
}

?>