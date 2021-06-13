<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akaryawan extends CI_Controller {

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
	// 		parent::__construct();
	// 		$this->Model_security->getsecure();
	// 		// $this->Model_security->hakakses($this->session->userdata('level'));
	// }

	public function index()
	{
		// $this->model_security->hakakses($level);
		$data['datadb'] = $this->db->get_where('tb_karyawan',array('sts' => 'A' ));
		// $data['datadb'] = $this->db->get('tb_karyawan');
		$data['error'] = '';
		$this->load->view('admin/karyawan/view_karyawan' ,$data);		
	}
	public function prive(){
		$data['dbkary'] = $this->db->get('tb_karyawan');
		$data['dbitem'] = $this->db->get('tb_item');
		$data['datadb'] = $this->db->get_where('q_prive',array('tgl' => date('Y-m-d')));
		$this->load->view('admin/karyawan/view_karyawan_prive',$data);
	}

	function historyprive(){
		$data['datadb'] = $this->db->get_where('q_prive',array('tgl' => date('Y-m-d')));
		$this->load->view('admin/karyawan/view_history_prive',$data);	
	}

	public function simpanprive(){
		$nama = $this->input->post('nama');
		$query = $this->db->get_where('tb_prive', array('tgl' => date('Y-m-d') ,'nip'=>$nama ));
		if($query->num_rows() == 0){
			$db['userkasir'] = $this->session->userdata('username');
			$db['nip'] = $nama;
			$db['tgl'] = date('Y-m-d');
			$db['jam'] = date('h:i:s');
			$db['kd_item'] = $this->input->post('item');
			$this->session->set_flashdata('info','Berhasil disimpan');
			$this->db->insert('tb_prive',$db);
		}else{
			$this->session->set_flashdata('info','Karyawan ini sudah mengambil jatahnya hari ini');
		}
		redirect('akaryawan/prive');
	}
	public function all()
	{
		$data['datadb'] = $this->db->get('tb_karyawan');
		$data['error'] = '';
		$this->load->view('admin/karyawan/view_karyawan-all' ,$data);		
	}
	public function simpan(){
		// validasi primary key
		$nip = $this->input->post('nip');
		$query = $this->db->get_where('tb_karyawan',array('nip' => $nip ));
		if($query->num_rows()>0){
			$this->session->set_flashdata('duplikat','Berhasil');
			redirect('Akaryawan');	
		}else{
			$data['nip'] = $this->input->post('nip');
			$data['nama'] = $this->input->post('nama');
			$data['jabat'] = $this->input->post('jabat');
			$data['alamat'] = $this->input->post('alamat');
			$data['telp'] = $this->input->post('telp');
			$data['sts'] = 'A';
			
			$this->db->insert('tb_karyawan',$data);
			$this->session->set_flashdata('info','Berhasil');
			$this->do_upload();
			// redirect('Akaryawan');

		}
	}
	public function edit(){
		$id = $this->uri->segment(3);
		$data['datadb'] = $this->db->get_where('tb_karyawan',array('nip' => $id ));
		$this->load->view('admin/karyawan/karyawan_edit' ,$data);
	}

	public function simpanedit(){
		$nip = $this->input->post('nip');
		
		$data['nama'] = $this->input->post('nama');
		$data['jabat'] = $this->input->post('jabat');
		$data['alamat'] = $this->input->post('alamat');
		$data['telp'] = $this->input->post('telp');
		$data['sts'] = 'A';

		$this->db->where('nip', $nip );
		$this->db->update('tb_karyawan',$data);
		$this->session->set_flashdata('info','Berhasil');
		if($_FILES['userfile']['size'] > 0){
			unlink(base_url()."asset/images/item/".$_FILES['userfile']['file_name'].".jpg");
		 	$this->do_upload();
		 }else{
			redirect('Akaryawan');
		 }
	}


	public function rubahstatus(){

		$id = $this->uri->segment(3);
		$sts = $this->uri->segment(4);

		if($sts =='Pasif'){
			$data['sts'] = 'P';
		}else{
			$data['sts'] = 'A';
		}
		$this->db->where('nip', $id );
		$this->db->update('tb_karyawan',$data);
		$this->session->set_flashdata('info','Berhasil');
		$this->all();

	}
	public function do_upload(){


		$config['upload_path'] = './asset/images/karyawan';
		$config['allowed_types'] = 'gif|jpg|png|bmp';
		$config['max_size'] =1000;
		$config['max_width']=1024;
		$config['max_height'] =768;
		$config['overwrite'] = true;
		$config['file_name'] =$this->input->post('nip') .".jpg";
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if (! $this->upload->do_upload()) {
			$data['error'] =$this->upload->display_errors();
			$data['datadb'] = $this->db->get_where('tb_karyawan',array('sts' => 'A' ));
			$this->load->view('admin/karyawan/view_karyawan' ,$data);
		}
		else{
			$data['upload_data']= $this->upload->data();
			$data['error'] = '';
			$data['datadb'] = $this->db->get_where('tb_karyawan',array('sts' => 'A' ));
			redirect('Akaryawan');
			// $this->load->view('admin/karyawan/view_karyawan' ,$data);
		}
	}


}
