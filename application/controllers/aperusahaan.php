<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aperusahaan extends CI_Controller {

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
		// $data['datadb'] = $this->db->get_where('tb_perusahaan',array('sts' => 'A' ));
		$this->Model_security->getsecure();
		$data['error'] = '';
		$data['datadb'] = $this->db->get('tb_perusahaan');
		$this->load->view('admin/perusahaan/view_perusahaan' ,$data);		
	}
	public function simpan(){
		$data['nama'] = $this->input->post('nama');
		$data['almt'] = $this->input->post('almt');
		$data['telp'] = $this->input->post('telp');
		$data['kota'] = $this->input->post('kota');
		$data['ket'] = $this->input->post('ket');
				
		$this->db->insert('tb_perusahaan',$data);
		$this->session->set_flashdata('info','Berhasil');
		$this->do_upload();
		
	}
	public function edit(){
		$id = $this->uri->segment(3);
		$data['datadb'] = $this->db->get_where('tb_perusahaan',array('id' => $id ));
		$this->load->view('admin/perusahaan/perusahaan_edit' ,$data);
	}

	public function simpanedit(){
		$id = $this->input->post('id');
		
		$data['nama'] = $this->input->post('nama');
		$data['almt'] = $this->input->post('almt');
		$data['telp'] = $this->input->post('telp');
		$data['kota'] = $this->input->post('kota');
		$data['ket'] = $this->input->post('ket');
		
		$this->db->where('id', $id );
		$this->db->update('tb_perusahaan',$data);
		$this->session->set_flashdata('info','Berhasil');
		if($_FILES['userfile']['size'] > 0){
		 	$this->do_upload();
		 }else{
			redirect('aperusahaan');
		 }
	}
	public function do_upload(){

		$config['upload_path'] = './asset/images';
		$config['allowed_types'] = 'gif|jpg|png|bmp';
		$config['max_size'] =1000;
		$config['max_width']=1024;
		$config['max_height'] =768;
		$config['overwrite'] = true;
		$config['file_name'] ="logo.jpg";
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if (! $this->upload->do_upload()) {
			$data['error'] =$this->upload->display_errors();
			$this->load->view('admin/perusahaan/view_perusahaan' ,$data);
		}
		else{
			$data['upload_data']= $this->upload->data();
			redirect('aperusahaan');
		}
	}

}
