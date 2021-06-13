<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_apesanan extends CI_Model {


	public function lihat($sampai,$dari,$tabel,$div)
	{
		return $query = $this->db
							   ->group_by('nota')
							   ->order_by('jam','asc')
							   ->where(array('sts_item'=>'belum','nm_jns'=>$div))
							   ->limit($sampai,$dari)
							   ->get($tabel)
							   ->result();
	}
	public function jumlah($tabel){
		$this->db
			 ->group_by('nota')
			 ->where('sts','belum');
		return $query = $this->db->get($tabel)->num_rows();
	}

}
