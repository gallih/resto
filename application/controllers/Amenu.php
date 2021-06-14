<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amenu extends CI_Controller {

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
		// $this->Model_security->getsecure();
		// $this->Model_security->hakakses($this->session->userdata('level'));
	}


	public function index()
	{
		$data['menu'] = $this->db->order_by('urutan','asc')->get('tb_menu');
		$this->load->view('admin/menu/view_menu',$data);
		
	}
	function submenu(){
		$data['menu'] = $this->db->order_by('urutan','asc')->get('tb_menu');
		$data['submenu'] = $this->db->order_by('urutan','asc')->get('q_submenu');
		$this->load->view('admin/menu/view_submenu',$data);
	}
	function submenuedit(){
		$id = $this->uri->segment(3);
		$this->db->where('id_sub',$id);
		$data['submenu'] = $this->db->get('tb_submenu');
		$data['menu'] = $this->db->order_by('urutan','asc')->get('tb_menu');
		$this->load->view('admin/menu/submenu_edit',$data);
	}
	function simpanutama(){
		$level="";
		foreach ($this->input->post('level') as $key) {
			$level = $level . $key.",";
		}
			$data['nama'] = $this->input->post('nama');
			$data['urutan'] =$this->input->post('urutan');
			$data['link'] = $this->input->post('link');
			$data['level'] = $level;
			$data['aktif'] =$this->input->post('aktif');
			$this->db->insert('tb_menu',$data);
			$this->session->set_flashdata('info','Berhasil ditambahkan');
			redirect('amenu');
	}
	function editutama(){
		$id = $this->uri->segment(3);
		$this->db->where('id_menu',$id);
		$data['menu'] = $this->db->get('tb_menu');
		$this->load->view('admin/menu/menu_edit',$data);
	}
	function simpanutamaedit(){
		$level="";
		foreach ($this->input->post('level') as $key) {
			$level = $level . $key.",";
		}
		$id = $this->input->post('id');
		$data['nama'] = $this->input->post('nama');
		$data['urutan'] =$this->input->post('urutan');
		$data['link'] = $this->input->post('link');
		$data['level'] = $level;
		$data['aktif'] =$this->input->post('aktif');

		$this->db->where('id_menu',$id);
		$this->db->update('tb_menu',$data);

		$this->session->set_flashdata('info','Berhasil diedit');
		redirect('amenu');
	}
	function simpansubedit(){
		$level="";
		foreach ($this->input->post('level') as $key) {
			$level = $level . $key.",";
		}
		$id = $this->input->post('id');
		$data['id_menu'] = $this->input->post('id_menu');
		$data['menu_sub'] = $this->input->post('menu_sub');
		$data['urutan'] =$this->input->post('urutan');
		$data['link'] = $this->input->post('link');
		$data['level'] = $level;
		$data['aktif'] =$this->input->post('aktif');

		$this->db->where('id_sub',$id);
		$this->db->update('tb_submenu',$data);

		$this->session->set_flashdata('info','Berhasil diedit');
		redirect('amenu/submenu');
	}
	function simpansub(){
		$level="";
		foreach ($this->input->post('level') as $key) {
			$level = $level . $key.",";
		}
		$id = $this->input->post('id');
		$data['id_menu'] = $this->input->post('id_menu');
		$data['menu_sub'] =$this->input->post('menu_sub');
		$data['link'] = $this->input->post('link');
		$data['urutan'] =$this->input->post('urutan');
		$data['level'] = $level;
		$data['aktif'] =$this->input->post('aktif');

		$this->db->insert('tb_submenu',$data);
		$this->session->set_flashdata('info','Berhasil ditambahkan');

		redirect('amenu');
	}
}
