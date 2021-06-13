<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

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
	public function index()
	{
		$sts = $this->session->userdata('sts');
		// $this->load->view('welcome_message');
		// $this->load->model('Model_security');
		// $this->Model_security->securecustomer();
		$data['datadb']= $this->db->get('tb_perusahaan');
		$nota = $this->session->userdata('nota');
		if($sts == ''){
			$data['datapesanan'] = $this->db->get_where('q_pemesanan' ,array('nota' => $nota  ));
		}else{
			$data['datapesanan'] = $this->db->get_where('q_pesan' ,array('nota' => $nota  ));
			$data['pesanan'] = $this->db->get_where('q_pemesanan' ,array('nota' => $nota  ));
		}
		$this->load->view('front/view_pesanan',$data);
	}
}
