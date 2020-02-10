<?php
class M_services_booking_detail extends M_db
{
	public function __construct()
	{
		parent::__construct();
		
		$this->_table = "vs_services_booking_detail";
	}
	
	function items($info=NULL, $limit=NULL, $offset=NULL)
	{
		$sql  = "SELECT * FROM {$this->_table} WHERE 1=1";
		if (!is_null($info)) {
			if (!empty($info->booking_id)) {
				$sql .= " AND {$this->_table}.booking_id = '{$info->booking_id}'";
			}
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
