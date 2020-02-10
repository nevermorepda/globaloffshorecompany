<?php
class M_services_tab_faqs extends M_db
{
	public function __construct()
	{
		parent::__construct();
		
		$this->_table = "vs_services_tab_faqs";
	}
	
	function items($info=NULL, $active=NULL, $limit=NULL, $offset=NULL)
	{
		$sql = "SELECT * FROM {$this->_table} WHERE 1=1";
		if (!is_null($info)) {
			if (!empty($info->service_tab_id)) {
				$sql .= " AND service_tab_id = '{$info->service_tab_id}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY order_num ASC, created_date DESC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}
		if (!is_null($offset)) {
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
}
?>