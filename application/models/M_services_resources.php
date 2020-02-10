<?php
class M_services_resources extends M_db
{
	public function __construct()
	{
		parent::__construct();
		
		$this->_table = "vs_services_resources";
	}
	
	function items($info=NULL,$active=1, $limit=NULL, $offset=NULL)
	{
		$sql  = "SELECT * FROM {$this->_table} WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->service_tab_id)) {
				$sql .= " AND service_tab_id = '{$info->service_tab_id}'";
			}
			if (!empty($info->module)) {
				$sql .= " AND module = '{$info->module}'";
			}
			if (!empty($info->content_id)) {
				$sql .= " AND content_id = '{$info->content_id}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY created_date DESC";
		
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}
		if (!is_null($offset)) {
			$sql .= " OFFSET {$offset}";
		}

		$query = $this->db->query($sql);
		return $query->result();
	}
	function join_content_items($info=NULL,$active=1, $limit=NULL, $offset=NULL)
	{
		$sql = "SELECT {$this->_table}.*, vs_content.* FROM {$this->_table} INNER JOIN vs_content ON ({$this->_table}.content_id = vs_content.id) WHERE 1=1";
		if (!is_null($info)) {
			if (!empty($info->service_tab_id)) {
				$sql .= " AND {$this->_table}.service_tab_id = '{$info->service_tab_id}'";
			}
			if (!empty($info->module)) {
				$sql .= " AND {$this->_table}.module = '{$info->module}'";
			}
			if (!empty($info->search)) {
				$sql .= " AND vs_content.title LIKE '%{$info->search}%'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND {$this->_table}.active = '{$active}'";
		}
		$sql .= " ORDER BY {$this->_table}.created_date DESC";
		
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}
		if (!is_null($offset)) {
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	function related_items($excluded_id=0,$info=NULL,$active=1, $limit=NULL, $offset=NULL)
	{
		$sql = "SELECT {$this->_table}.*, vs_content.* FROM {$this->_table} INNER JOIN vs_content ON {$this->_table}.content_id = vs_content.id WHERE 1=1";
		$sql .= " AND {$this->_table}.id <> '{$excluded_id}'";
		if (!is_null($info)) {
			if (!empty($info->service_tab_id)) {
				$sql .= " AND {$this->_table}.service_tab_id = '{$info->service_tab_id}'";
			}
			if (!empty($info->module)) {
				$sql .= " AND {$this->_table}.module = '{$info->module}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND {$this->_table}.active = '{$active}'";
		}
		$sql .= " ORDER BY {$this->_table}.created_date DESC";
		
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