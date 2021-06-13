<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Adashboard extends CI_Controller {

	
	public function index()
	{		
		// $level = $this->session->userdata('level');		
		// $this->Model_security->getsecure();
		// $this->Model_security->hakakses($level);	

		$data['datadb'] = $this->db->get('tb_pesan');
		$this->db->where(array('trans'=>'Y','sts'=>'sudah','tutup'=>'T'));
		$data['databungkus'] = $this->db->get('tb_bungkus');
		$data['datadetail'] = $this->db->get_where('q_det_pesan',array('tutup'=>'T'));
		$data['detailbungkus'] = $this->db->get_where('q_pesan_bungkus',array('tutup'=>'T'));
		$this->load->view('admin/view_dashboard' ,$data);
		
	}
}
