<?php
class M_services extends M_db
{
	public function __construct()
	{
		parent::__construct();
		
		$this->_table = "vs_services";
	}
	
	function items($info=NULL)
	{
		$sql = "SELECT * FROM {$this->_table} WHERE 1=1";
		if (!is_null($info)) {
			if (!empty($info->name)) {
				$sql .= " AND name = '{$info->name}'";
			}
		}
		$sql .= " ORDER BY created_date ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
}
?>