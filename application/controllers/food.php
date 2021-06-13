<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Food extends CI_Controller {

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
			$this->load->model('model_food');
			$this->load->model('Model_security');
	}
	public function index($id =NULL)
	{
		$this->Model_security->securecustomer();
		$data['datadb']= $this->db->get('tb_perusahaan');

		//config halaman pagination
		$config['full_tag_open'] = '<div align="center"><nav style="background:#ccc"><ul class="pagination pagination-lg">';
		$config['full_tag_close'] = '</ul></nav></div>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] =  '<li class="active"><a style="background:#478D06;color:#fff;border:none" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		//mengambil data dari database dan model
		$jumlah = $this->model_food->jumlah();
		$config['base_url'] =base_url().'food/index';
		$config['total_rows'] = $jumlah;
		$config['per_page']=8;
	
		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['datafood']= $this->model_food->lihat($config['per_page'],$id);
		
		$this->load->view('front/view_food',$data);
	}
}
