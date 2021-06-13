<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Abahanbaku extends CI_Controller {

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
	// function __construct(){
	// 	parent::__construct();
	// 	$this->Model_security->getsecure();
	// 	// $this->Model_security->hakakses($this->session->userdata('level'));
	// }

	public function index()
	{
	
		$data['datadb'] = $this->db->get('tb_bahanbaku');
		$this->load->view('admin/bahanbaku/view_bahanbaku' ,$data);		
	}
	public function simpan(){
		
		$data['nm_bhn'] = $this->input->post('nm_bhn');
		$data['opname'] = $this->input->post('stok');
		$data['satuan'] = $this->input->post('satuan');
		$data['harga_awal'] = $this->input->post('harga_awal');
		$data['tgl'] = date('Y-m-d');
		$data['ket'] = $this->input->post('ket');		
		
		$this->db->insert('tb_bahanbaku',$data);
		$this->session->set_flashdata('info','Berhasil disimpan');
		redirect('abahanbaku');

	}
	public function filterhis(){
		$tgl = $this->input->post('daterange');
		if ($tgl == is_null($tgl)){
			$this->session->set_flashdata('info','Pilih Range Tanggal');
			redirect('abahanbaku/view_his');
		}
		$kd_bhn = $this->input->post('bahan');
		$pisah = explode('-',$tgl);

		$tgl1 = date('Y-m-d',strtotime($pisah[0]));
		$tgl2 = date('Y-m-d',strtotime($pisah[1]));
				
		$this->db->where("tgl >=",$tgl1);
		$this->db->where("tgl <=",$tgl2);
		$this->db->where('kd_bhn',$kd_bhn);
		
		$data['datadb'] = $this->db->get('q_his_bahan');
		$this->load->view('admin/bahanbaku/view_his_bahan' ,$data);

		

	}
	public function edit(){
		$kd = $this->uri->segment(3);
		$data['datadb'] = $this->db->get_where('tb_bahanbaku',array('kd_bahan' => $kd));
		$this->load->view('admin/bahanbaku/bahanbaku_edit' ,$data);
	}
	public function view_his(){
		$data['datadb'] = $this->db->get_where('q_his_bahan');
		$this->load->view('admin/bahanbaku/view_his_bahan' ,$data);	
	}
	public function simpanedit(){
		$kd = $this->input->post('kd_bahan');
		$data['nm_bhn'] = $this->input->post('nm_bhn');
		$data['harga_awal'] = $this->input->post('harga');
		$data['satuan'] = $this->input->post('satuan');
		$data['ket'] = $this->input->post('ket');		
		

		$this->db->where('kd_bahan', $kd);
		$this->db->update('tb_bahanbaku',$data);
		$this->session->set_flashdata('info','Berhasil diupdate');	
		redirect('abahanbaku');
	}
	public function hapus(){
		$id = $this->uri->segment(3);

		$this->db->where('kd_bahan',$id);
		$this->db->delete('tb_bahanbaku');

		$this->db->where('kd_bhn',$id);
		$this->db->delete('tb_det_bahanbaku');

		$this->session->set_flashdata('info','Data Berhasil dihapus');
		redirect('abahanbaku');
	}
	public function updatestok(){
		
		$kd_bhn = $this->input->post('kd_bhn');
		$stkbru = $this->input->post('stk_msk');
		
		
		// UPDATE STOK DAN HARGA DI TABEL BAHANBAKU
		$this->db->where('kd_bahan',$kd_bhn);
		$query = $this->db->get('tb_bahanbaku');
		foreach ($query->result() as $key) {
			if($key->stok == 0){
				$stoke= $key->opname + $stkbru;	
			}else{
				$stoke = $key->stok + $stkbru;
			}
		}

		$data['stok'] = $stoke;
		$this->db->where('kd_bahan',$kd_bhn);
		$this->db->update('tb_bahanbaku',$data);
		// BATAS

		//MENGISI KE TABEL DETAIL BAHANBAKU
		$isi['kd_bhn'] = $kd_bhn;
		$isi['tgl'] = date('Y-m-d');
		$isi['stok_msk'] = $stkbru;

		$this->db->insert('tb_det_bahanbaku',$isi);
		$this->session->set_flashdata('info','Berhasil diupdate ke Bahan Baku');
		echo "ok";
	}
	public function stokkeluar(){
		
		$kd_bhn = $this->input->post('kd_bhn');
		$stkbru = $this->input->post('stk_msk');
		$hargabru = $this->input->post('harga');

		// UPDATE STOK DAN HARGA DI TABEL BAHANBAKU
		
		$this->db->where('kd_bahan',$kd_bhn);
		$query = $this->db->get('tb_bahanbaku');
		foreach ($query->result() as $key) {
			if($key->stok == 0){
				$stoke= $key->opname - $stkbru;	
			}else{
				$stoke = $key->stok - $stkbru;
			}
		}
		$data['stok'] = $stoke;
		$this->db->where('kd_bahan',$kd_bhn);
		$this->db->update('tb_bahanbaku',$data);
		// BATAS

		//MENGISI KE TABEL DETAIL BAHANBAKU
		$isi['kd_bhn'] = $kd_bhn;
		$isi['tgl'] = date('Y-m-d');
		$isi['stok_klr'] = $stkbru;

		$this->db->insert('tb_det_bahanbaku',$isi);
		$this->session->set_flashdata('info','Berhasil diupdate ke Bahan Baku');
		echo "ok";
	}
}
