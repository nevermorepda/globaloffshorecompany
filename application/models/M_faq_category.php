<?php
class M_faq_category extends M_db
{
	public function __construct()
	{
		parent::__construct();
		
		$this->_table = "vs_faq_category";
	}
	
	function items($info=NULL, $active=NULL, $limit=NULL, $offset=NULL)
	{
		$sql = "SELECT * FROM {$this->_table} AS CC WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->name)) {
				$sql .= " AND name = '{$info->name}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY order_num ASC";
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