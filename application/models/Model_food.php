<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_food extends CI_Model {

	
	public function lihat($sampai,$dari)
	{
		$where = "kd_jenis =1 and sts ='ada'";
		return $query = $this->db
							 ->where($where)
							 ->limit($sampai,$dari)
							 ->get('tb_item')
							 ->result();
	}
	public function jumlah(){
		$this->db->where(array('kd_jenis' => 1, 'sts'=>'ada' ));
		return $query = $this->db->get('tb_item')->num_rows();	
	}

	
}
