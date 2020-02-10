<?php
class M_services_tab_nation extends M_db
{
	public function __construct()
	{
		parent::__construct();
		
		$this->_table = "vs_services_tab_nation";
	}
	
	function items($info=NULL, $active=NULL, $limit=NULL, $offset=NULL)
	{
		$sql = "SELECT * FROM {$this->_table} WHERE 1=1";
		if (!is_null($info)) {
			if (!empty($info->service_tab_id)) {
				$sql .= " AND service_tab_id = '{$info->service_tab_id}'";
			}
			if (!empty($info->nation_id)) {
				$sql .= " AND nation_id = '{$info->nation_id}'";
			}
			if (!empty($info->services_process_id)) {
				$sql .= " AND services_process_id = '{$info->services_process_id}'";
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
	public function load_item($nation_id, $active=null)
	{
		$sql = "SELECT * FROM {$this->_table} WHERE 1 = 1";
		if (is_numeric($nation_id)) {
			$sql .= " AND nation_id = '{$nation_id}'";
		}
		if (!is_null($active) && $this->db->field_exists("active", $this->_table)) {
			$sql .= " AND active = '{$active}'";
		}
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return null;
	}
	function jion_nation($info=null, $active=null)
	{
		$sql = "SELECT {$this->_table}.id as tab_id, {$this->_table}.* , vs_nation.* FROM {$this->_table} INNER JOIN vs_nation ON {$this->_table}.nation_id = vs_nation.id WHERE 1=1";
		if (!is_null($info)) {
			if (!empty($info->service_tab_id)) {
				$sql .= " AND {$this->_table}.service_tab_id = '{$info->service_tab_id}'";
			}
			if (!empty($info->nation_id)) {
				$sql .= " AND {$this->_table}.nation_id = '{$info->nation_id}'";
			}
			if (!empty($info->services_process_id)) {
				$sql .= " AND {$this->_table}.services_process_id = '{$info->services_process_id}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY vs_nation.name ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
}
?>