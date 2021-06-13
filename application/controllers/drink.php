<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drink extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * atur/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('model_drink');
		$this->load->model('model_security');
		
	}


	public function index($kd=NULL)
	{
		// $this->load->view('welcome_message');
		
		$this->Model_security->securecustomer();
		$data['datadb']= $this->db->get('tb_perusahaan');
		
		//atur halaman pagination
		$atur['full_tag_open'] = '<div align="center"><nav><ul  class="pagination">';
		$atur['full_tag_close'] = '</ul></nav></div>';
		$atur['first_link'] = false;
		$atur['last_link'] = false;
		$atur['first_tag_open'] = '<li>';
		$atur['first_tag_close'] = '</li>';
		$atur['prev_link'] = 'Prev';
		$atur['prev_tag_open'] = '<li class="prev">';
		$atur['prev_tag_close'] = '</li>';
		$atur['next_link'] = 'Next';
		$atur['next_tag_open'] = '<li>';
		$atur['next_tag_close'] = '</li>';
		$atur['last_tag_open'] = '<li>';
		$atur['last_tag_close'] = '</li>';
		$atur['cur_tag_open'] =  '<li class="active"><a href="#">';
		$atur['cur_tag_close'] = '</a></li>';
		$atur['num_tag_open'] = '<li>';
		$atur['num_tag_close'] = '</li>';
		
		//mengambil data dari database dan model
		$jumlah = $this->model_drink->jumlah();
		$atur['base_url'] =base_url().'drink/index';
		$atur['total_rows'] = $jumlah;
		$atur['per_page']=8;
	
		$this->pagination->initialize($atur);
		$data['page_drink'] = $this->pagination->create_links();
		$data['datadrink']= $this->model_drink->lihat($atur['per_page'],$kd);
		
		$this->load->view('front/view_drink',$data);

	}
}
