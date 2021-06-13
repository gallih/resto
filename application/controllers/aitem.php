<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aitem extends CI_Controller {

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
		// $data['datadb'] = $this->db->get_where('tb_item',array('sts' => 'A' ));
		$data['jenis'] = $this->db->get('tb_jenis');
		$data['datadb'] = $this->db->get('q_item');

		$this->load->view('admin/item/view_item' ,$data);		
	}

	// JENIS BARANG
	public function simpanjenis(){
		$data['nm_jns'] = $this->input->post('nm_jns');
		
		
		$this->db->insert('tb_jenis',$data);
		$this->session->set_flashdata('info','Berhasil');
		redirect('aitem');
	}
	public function simpaneditjenis(){
		$id = $this->input->post('kd_jns');

		$data['nm_jns'] = $this->input->post('nm_jns');
		
		$this->db->where('kd_jns', $id);
		$this->db->update('tb_jenis',$data);
		$this->session->set_flashdata('info','Berhasil');
		redirect('aitem');
	}
	public function editjenis(){
		$kd = $this->uri->segment(3);
		$data['jenis'] = $this->db->get_where('tb_jenis',array('kd_jns' => $kd ));
		$this->load->view('admin/jenis/jenis_edit' ,$data);
	}
	public function hapusjenis(){
		$id = $this->uri->segment(3);
		$this->db->where('kd_jns',$id);
		$this->db->delete('tb_jenis');
		$this->session->set_flashdata('info','Berhasil');
		redirect('aitem');
	}


	// BATAS JENIS BARANG
	public function simpan(){
		
		$data['rasa'] = $this->input->post('rasa');
		if($this->input->post('populer') =='Ya')$pop = 'Y';else $pop = 'T';
		if($this->input->post('pilihan') =='Ya') $pil = 'Y';else $pil= 'T';
		$data['kd_item'] = $this->input->post('kd_item');
		$data['item'] = $this->input->post('item');
		$data['kd_jenis'] = $this->input->post('kd_jenis');
		$data['harga'] = $this->input->post('harga');
		$data['promo'] = $this->input->post('promo');
		$data['stok'] = $this->input->post('stok');
		$data['item_jadi'] = $this->input->post('item_jadi');
		$data['populer'] = $pop ;
		$data['sts'] = $this->input->post('sts');
		$data['pilihan'] = $pil;
		$data['ket'] = $this->input->post('ket');
		
		
		$this->db->insert('tb_item',$data);
		$this->session->set_flashdata('info','Berhasil ditambahkan');
		if($_FILES['userfile']['size'] > 0){
		 	$this->do_upload();
		 }else{
			redirect('aitem');
		 }

	}
	public function edit(){
		$kd = $this->uri->segment(3);
		$data['datadb'] = $this->db->get_where('q_item',array('kd_item' => $kd));
		$data['jenis'] = $this->db->get('tb_jenis');
		$this->load->view('admin/item/item_edit' ,$data);
	}

	public function simpanedit(){


		if($this->input->post('populer') =='Ya')
		$pop = 'Y';
		else $pop = 'T';
		$kd = $this->input->post('kd_item');
		
		$data['item'] = $this->input->post('item');
		$data['kd_jenis'] = $this->input->post('kd_jenis');

		$data['rasa'] = $this->input->post('rasa');

		$data['harga'] = $this->input->post('harga');
		$data['promo'] = $this->input->post('promo');
		$data['sts'] = $this->input->post('sts');
		$data['stok'] = is_null($this->input->post('stok')) ? 0 : $this->input->post('stok');
		$data['populer'] = $pop;
		$data['pilihan'] = $this->input->post('pilihan');
		$data['item_jadi'] = $this->input->post('item_jadi');
		$data['ket'] = $this->input->post('ket');
		

		$this->db->where('kd_item', $kd);
		$this->db->update('tb_item',$data);
		$this->session->set_flashdata('info','Berhasil');
		if($_FILES['userfile']['size'] > 0){

		 	$this->do_upload();
		 }else{
			redirect('aitem');
		 }

		
	}
	public function hapus(){
		$id = $this->uri->segment(3);
		
		$this->db->where('kd_item',$id);
		$this->db->delete('tb_item');
		$this->session->set_flashdata('info','Berhasil dihapus');
		redirect('aitem');
	}

	public function do_upload(){


		if($this->uri->segment(2) == 'simpanedit'){

			unlink(base_url()."asset/images/item/".$_FILES['userfile']['file_name'].".jpg");
			$config['file_name'] =$this->input->post('kd_item') .".jpg";
		}else{
			$config['file_name'] =$this->db->insert_id() .".jpg";
		}

		$config['upload_path'] = './asset/images/item';
		$config['allowed_types'] = 'gif|jpg|png|bmp';
		$config['max_size'] =1000;
		$config['max_width']=1024;
		$config['max_height'] =768;
		$config['overwrite'] = true;
		
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if (! $this->upload->do_upload()) {
			$data['error'] =$this->upload->display_errors();
			$data['datadb'] = $this->db->get_where('tb_karyawan',array('sts' => 'A' ));
			$this->load->view('admin/item/view_item' ,$data);
		}
		else{
			$data['upload_data']= $this->upload->data();
			redirect('aitem');
		}
	}
	
}
