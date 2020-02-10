<?php
class M_jurisdictions extends M_db
{
	public function __construct()
	{
		parent::__construct();
		
		$this->_table = "vs_jurisdictions";
	}
	
	function items($info=NULL, $limit=NULL, $offset=NULL)
	{
		$sql = "SELECT {$this->_table}.id as jurisdiction_id, {$this->_table}.*, vs_nation.* FROM {$this->_table} INNER JOIN vs_nation ON {$this->_table}.nation_id = vs_nation.id WHERE 1=1";
		if (!is_null($info)) {
			if (!empty($info->nation_id)) {
				$sql .= " AND {$this->_table}.nation_id = '{$info->nation_id}'";
			}
			if (!empty($info->region)) {
				$sql .= " AND vs_nation.region = '{$info->region}'";
			}
		}
		$sql .= " ORDER BY vs_nation.name ASC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}
		if (!is_null($offset)) {
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	function jion_nation($info=null)
	{
		$sql = "SELECT {$this->_table}.id as jurisdiction_id, {$this->_table}.* , vs_nation.* FROM {$this->_table} INNER JOIN vs_nation ON {$this->_table}.nation_id = vs_nation.id WHERE 1=1";
		if (!is_null($info)) {
			if (!empty($info->jurisdiction_id)) {
				$sql .= " AND {$this->_table}.id = {$info->jurisdiction_id}";
			}
			if (!empty($info->nation_id)) {
				$sql .= " AND vs_nation.id = '{$info->nation_id}'";
			}
			if (!empty($info->nation_alias)) {
				$sql .= " AND vs_nation.alias = '{$info->nation_alias}'";
			}
		}
		$sql .= " ORDER BY vs_nation.name ASC";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return null;
	}
	public function load_nation($id)
	{
		$sql = "SELECT * FROM {$this->_table} WHERE 1 = 1";
		$sql = "SELECT {$this->_table}.id as jurisdiction_id, {$this->_table}.* , vs_nation.* FROM {$this->_table} INNER JOIN vs_nation ON {$this->_table}.nation_id = vs_nation.id WHERE 1=1";
		if (is_numeric($id)) {
			$sql .= " AND {$this->_table}.id = '{$id}'";
		} else if ($this->db->field_exists("alias", $this->_table)) {
			$sql .= " AND {$this->_table}.alias = '{$id}'";
		}
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return null;
	}
}
?>