<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auser extends CI_Controller {

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
	// }

	public function index()
	{
		$data['datadb'] = $this->db->get('tb_user');
		$data['error'] = '';
		$this->load->view('admin/user/view_user' ,$data);		
	}
	public function all()
	{
		$data['datadb'] = $this->db->get('tb_user');
		$data['error'] = '';
		$this->load->view('admin/user/view_user-all' ,$data);		
	}
	public function resetpwd(){
		$id = $this->uri->segment(3);
		$qr = $this->db->get_where('tb_user',array('Id' => $id ));
		foreach ($qr->result() as $brs) {
			$telp = $brs->no_telp;
		}
		$this->db->where('Id',$id);
		$dt['pass'] = md5($telp);
		$this->db->update('tb_user',$dt);
		$this->session->set_flashdata('info','Password berhasil direset');
		redirect('auser');
	}
	public function simpan(){				
		
		$data['username'] = $this->input->post('username');
		$data['pass'] = md5($this->input->post('pass'));
		$data['nama'] = $this->input->post('nama');
		$data['no_telp'] = $this->input->post('no_telp');
		$data['level'] = $this->input->post('level');		
		$data['blokir'] = 'N';
		
		$this->db->insert('tb_user',$data);
		$this->session->set_flashdata('info','User Baru berhasil disimpan');
		if($_FILES['userfile']['size'] > 0){
		 	$this->do_upload();
		 }else{
			redirect('auser');
		 }
			// redirect('auser');		
	}
	public function edit(){
		$id = $this->uri->segment(3);
		$data['datadb'] = $this->db->get_where('tb_user',array('Id' => $id ));
		$this->load->view('admin/user/user_edit' ,$data);
	}

	public function hapus(){
		$id = $this->uri->segment(3);
		$this->db->where('Id',$id);
		$this->db->delete('tb_user');
		$this->session->set_flashdata('info','User Berhasil dihapus');
		redirect('auser');
	}

	public function simpanedit(){
		$id = $this->input->post('id');
		
		$data['username'] = $this->input->post('username');		
		$data['nama'] = $this->input->post('nama');
		$data['no_telp'] = $this->input->post('no_telp');
		$data['level'] = $this->input->post('level');		

		$this->db->where('Id', $id );
		$this->db->update('tb_user',$data);
		$this->session->set_flashdata('info','Data Berhasil diupdate');

		if($_FILES['userfile']['size'] > 0){
		 	$this->do_upload();
		 }else{
			redirect('auser');
		 }
	}
	public function blokir(){

		$id = $this->uri->segment(3);		
		$this->db->where('Id',$id);
		$query = $this->db->get('tb_user');
		foreach ($query->result() as $brs) {
			if($brs->blokir =='Y'){
				$st = 'N';
			}else{
				$st = 'Y';
			}
		}
		$data['blokir'] = $st;
		$this->db->where('id', $id );
		$this->db->update('tb_user',$data);
		$this->session->set_flashdata('info','Status User Berhasil di Update');
		redirect('auser');

	}
	public function do_upload(){

		$config['upload_path'] = './asset/images/user';
		$config['allowed_types'] = 'gif|jpg|png|bmp';
		$config['max_size'] =1000;
		$config['max_width']=1024;
		$config['max_height'] =768;
		$config['overwrite'] = true;
		$config['file_name'] =$this->input->post('username') .".jpg";
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if (! $this->upload->do_upload()) {
			$data['error'] =$this->upload->display_errors();
			$data['datadb'] = $this->db->get('tb_user');
			$this->load->view('admin/user/view_user' ,$data);
		}
		else{
			$data['upload_data']= $this->upload->data();
			$data['error'] = '';
			$data['datadb'] = $this->db->get('tb_user');
			redirect('auser');
			// $this->load->view('admin/user/view_user' ,$data);
		}
	}


}
