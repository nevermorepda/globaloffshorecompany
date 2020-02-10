<?php
class M_services_faqs extends M_db
{
	public function __construct()
	{
		parent::__construct();
		
		$this->_table = "vs_services_faqs";
	}
	
	function items($info=NULL, $active=NULL, $limit=NULL, $offset=NULL)
	{
		$sql = "SELECT * FROM {$this->_table} WHERE 1=1";
		if (!is_null($info)) {
			if (!empty($info->service_id)) {
				$sql .= " AND service_id = '{$info->service_id}'";
			}
			if (!empty($info->jurisdiction_id)) {
				$sql .= " AND jurisdiction_id = '{$info->jurisdiction_id}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY created_date ASC";
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