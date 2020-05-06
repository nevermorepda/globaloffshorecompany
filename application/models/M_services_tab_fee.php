<?php
class M_services_tab_fee extends M_db
{
	public function __construct()
	{
		parent::__construct();
		
		$this->_table = "vs_services_tab_fee";
	}

	function items($info=NULL, $active=NULL, $limit=NULL, $offset=NULL)
	{
		$sql = "SELECT * FROM {$this->_table} WHERE 1=1";
		if (!is_null($info)) {
			if (!empty($info->jurisdiction_id)) {
				$sql .= " AND jurisdiction_id = '{$info->jurisdiction_id}'";
			}
			if (!empty($info->service_id)) {
				$sql .= " AND service_id = '{$info->service_id}'";
			}
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function item($jurisdiction_id, $service_id)
	{
		$sql  = "SELECT * FROM {$this->_table} WHERE 1 = 1";
		$sql .= " AND jurisdiction_id = '{$jurisdiction_id}'";
		$sql .= " AND service_id = '{$service_id}'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return NULL;
	}
}
?>