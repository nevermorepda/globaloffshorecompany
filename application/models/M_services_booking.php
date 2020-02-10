<?php
class M_services_booking extends M_db
{
	public function __construct()
	{
		parent::__construct();
		
		$this->_table = "vs_services_booking";
	}
	
	function booking($id=NULL, $key=NULL)
	{
		$sql   = "SELECT * FROM {$this->_table} WHERE 1 = 1";
		if (!is_null($id)) {
			$sql .= " AND id='{$id}'";
		}
		if (!is_null($key)) {
			$sql .= " AND booking_key='{$key}'";
		}
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return null;
	}
	
	function bookings($info=NULL, $limit=NULL, $offset=NULL)
	{
		$sql  = "SELECT DISTINCT {$this->_table}.* FROM {$this->_table} WHERE 1=1";
		if (!is_null($info)) {
			if (!empty($info->search_text)) {
				$info->search_text = strtoupper(trim($info->search_text));
				$ID = preg_replace("/[^0-9]/", "", $info->search_text);
				if ($this->email->valid_email($info->search_text)) {
					$sql .= " AND (UPPER({$this->_table}.req_ship_fullname) LIKE '%{$info->search_text}%' OR {$this->_table}.id = '{$ID}' OR UPPER({$this->_table}.req_ship_email) LIKE '%{$info->search_text}%')";
				} else {
					$sql .= " AND (UPPER({$this->_table}.req_ship_fullname) LIKE '%{$info->search_text}%' OR {$this->_table}.id = '{$ID}')";
				}
			}
			if (!empty($info->payment_method)) {
				$sql .= " AND {$this->_table}.payment_method = '{$info->payment_method}'";
			}
			if (!empty($info->fromdate)) {
				$sql .= " AND DATE({$this->_table}.booking_date) >= '{$info->fromdate}'";
			}
			if (!empty($info->todate)) {
				$sql .= " AND DATE({$this->_table}.booking_date) <= '{$info->todate}'";
			}
		}
		$sql .= " ORDER BY {$this->_table}.booking_date DESC";
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
