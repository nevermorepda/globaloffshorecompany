<?php
class M_embassy extends M_db
{
	public function __construct()
	{
		parent::__construct();
		
		$this->_table = "m_embassy";
	}
	
	function items($info=NULL, $active=NULL, $limit=NULL, $offset=NULL)
	{
		$sql  = "SELECT * FROM {$this->_table} WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->nation)) {
				$sql .= " AND (nation = '{$info->nation}' OR LCASE(nation) LIKE '%".str_ireplace("-"," ",$info->nation)."%')";
			}
			if (!empty($info->alias)) {
				$sql .= " AND alias = '{$info->alias}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		
		$sql .= " ORDER BY nation ASC";
		
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