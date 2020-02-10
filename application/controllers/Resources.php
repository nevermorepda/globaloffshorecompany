<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resources extends CI_Controller {

	public function index($category, $alias=null)
	{
		if (empty($category)) {
			redirect(site_url("error404"));
		}
		$breadcrumb = array("Resources" => site_url("{$this->util->slug($this->router->fetch_class())}"));
		$category = $this->m_category->load($category);

		if (!empty($alias)) {

			// $this->output->cache(CACHE_TIME);
			$item = $this->m_content->load($alias);
			$relateditems = $this->m_content->getRelatedItems($item->id,12);
			
			$view_data = array();
			$view_data['item'] = $item;
			$view_data['relateditems'] = $relateditems;
			$view_data['breadcrumb'] = $breadcrumb;
			$view_data['category'] = $category;
			
			$tmpl_content = array();
			$tmpl_content['meta']['title'] = $this->util->getMetaTitle($item);
			$tmpl_content['meta']['keywords'] = $item->meta_key;
			$tmpl_content['meta']['description'] = $item->meta_desc;
			$tmpl_content['content'] = $this->load->view("resources/detail", $view_data, TRUE);
			$this->load->view('layout/main', $tmpl_content);
		} else {
			$info = new stdClass();
			$info->catid = $category->id;
			$search_text = '';
			if (!empty($_GET['search'])) {
				$info->search = $_GET['search'];
				$search_text = $_GET['search'];
			}

			$total_items = $this->m_content->items($info,1);
			$c_total_items = count($total_items);

			$page = (!empty($_GET["page"]) ? max($_GET["page"], 1) : 1);
			$pagination = $this->util->pagination(site_url("{$this->util->slug($this->router->fetch_class())}/{$category->alias}"). "?$_SERVER[QUERY_STRING]", $c_total_items, 12);

			$items = $this->m_content->items($info,1, 12, ($page - 1) * 12);
			
			$view_data = array();
			$view_data['items'] = $items;
			$view_data['breadcrumb'] = $breadcrumb;
			$view_data['pagination'] = $pagination;
			$view_data['category'] = $category;
			$view_data['search_text'] = $search_text;
			
			$tmpl_content = array();
			$tmpl_content['meta']['title'] = 'Resources';
			$tmpl_content['meta']['keywords'] = '';
			$tmpl_content['meta']['description'] = '';
			$tmpl_content['content'] = $this->load->view("resources/index", $view_data, TRUE);
			$this->load->view('layout/main', $tmpl_content);
		}
	}
}

?>