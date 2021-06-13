<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_security extends CI_Model {


	public function getsecure()
	{
		$username = $this->session->userdata('username');
		if(empty($username)){
			$this->session->sess_destroy();
			redirect('adminweb');
		}

	}
	public function securecustomer(){
		$nama = $this->session->userdata('nama');
		if(empty($nama)){
			$this->session->sess_destroy();
			redirect('user_home');
		}
	}

	public function hakakses($level){
		// if(empty($this->session->userdata('level'))){
		// 	$this->load->view('hakakses');
			if($level == 'Admin'){
				// $where = ""
				$this->db->where(array('trans'=>'Y','sts'=>'sudah','tutup'=>'T'));
				$data['datadb'] = $this->db->get('tb_pesan');
				$this->db->where(array('trans'=>'Y','sts'=>'sudah','tutup'=>'T'));
				$data['databungkus'] = $this->db->get('tb_bungkus');
				$data['datadetail'] = $this->db->get_where('q_det_pesan',array('tutup'=>'T'));
				$data['detailbungkus'] = $this->db->get_where('q_pesan_bungkus',array('tutup'=>'T'));
				$this->load->view('admin/view_dashboard',$data);
			}else if($level == 'Kasir' || $level == 'Admin'  ){
				redirect('akasir');
			}else if($level == 'Chef' || $level == 'Admin'  ){
				$div = $this->session->userdata('divisi');
				if($div == 'Makanan'){
					redirect('apesanan');	
				}elseif ($div == 'Minuman'){
					redirect('apesanan_min');
				}else{
					$this->session->set_flashdata('info','Untuk Divisi dapur Silahkan Login di Tombol Merah');
					redirect('adminweb');
				}
			}
		// }
	}

}
