<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ameja extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct();
		$this->Model_security->getsecure();
		// $this->Model_security->hakakses($this->session->userdata('level'));
	}
	
	public function index()
	{
		
		$data['datadb']= $this->db->get('tb_meja');
		$this->load->view('admin/meja/view_meja',$data);
	}

	public function resetstatus(){
		$data['sts'] = 'kosong';
		$this->db->update('tb_meja',$data);

		$data['sts'] = 'Ada';
		$this->db->where('nm_meja','BKS');
		$this->db->update('tb_meja',$data);
		
		$this->session->set_flashdata('info','Berhasil Mereset status Meja');
		redirect('adashboard');
	}

	public function simpan(){
		
		$data['nm_meja'] = $this->input->post('nm_meja');
		$data['lantai'] = $this->input->post('lantai');
		$data['sts'] = 'kosong';

		$this->db->insert('tb_meja',$data);
		$this->session->set_flashdata('info','Berhasil disimpan');
		redirect('ameja');

	}
	public function edit(){
		$kd = $this->uri->segment(3);
		$data['datadb'] = $this->db->get_where('tb_meja',array('id_meja' => $kd));
		$this->load->view('admin/meja/meja_edit' ,$data);
	}

	public function simpanedit(){
		$kd = $this->input->post('id_meja');
		$data[''] = $this->input->post('nm_bhn');
		$data['stok'] = $this->input->post('stok');
		

		$this->db->where('kd_bahan', $kd);
		$this->db->update('tb_bahanbaku',$data);
		$this->session->set_flashdata('info','Berhasil diupdate');	
		redirect('abahanbaku');
	}
	public function hapus(){
		$id = $this->uri->segment(3);

		$this->db->where('kd_bahan',$id);
		$this->db->delete('tb_bahanbaku');
		$this->session->set_flashdata('info','Data Berhasil dihapus');
		redirect('abahanbaku');
	}
	public function rubah(){
		$id = $this->uri->segment(3);
		$this->db->where('id_meja',$id);
		$query = $this->db->get('tb_meja');
		foreach ($query->result() as $row) {
			if($row->sts =='kosong'){
				$data['sts'] ='Ada';
			}else
			{
				$data['sts'] ='kosong';
			}
		}
		$this->db->where('id_meja', $id);
		$this->db->update('tb_meja',$data);

		$this->session->set_flashdata('info','Status Meja Berhasil diupdate');
		redirect('ameja');
	}
}
