<?php
class M_faq extends M_db
{
	public function __construct()
	{
		parent::__construct();
		
		$this->_table = "vs_faq";
	}
	
	function items($info=NULL, $active=NULL, $limit=NULL, $offset=NULL)
	{
		$sql  = "SELECT * FROM {$this->_table} WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->search)) {
				$sql .= " AND title LIKE '%{$info->search}%'";
			}
			if (!empty($info->category_id)) {
				$sql .= " AND category_id = '{$info->category_id}'";
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

	function related_items($excluded_id=0,$info=NULL, $active=NULL, $limit=NULL, $offset=NULL)
	{
		$sql  = "SELECT * FROM {$this->_table} WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->search)) {
				$sql .= " AND title LIKE '%{$info->search}%'";
			}
		}
		$sql .= " AND id <> '{$excluded_id}'";
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