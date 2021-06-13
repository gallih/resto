<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_drink extends CI_Model {

	
	public function lihat($sampai,$dari)
	{
		$where = "kd_jenis =2 and sts='ada'";
		return $query = $this->db
							 ->where($where)
							 ->limit($sampai,$dari)
							 ->get('tb_item')
							 ->result();
	}
	public function jumlah(){
		$this->db->where(array('kd_jenis' => 2, 'sts'=>'ada'));
		return $query = $this->db->get('tb_item')->num_rows();	
	}
}
