<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		// $this->Model_security->securecustomer();
		$data['dbitem'] = $this->db->get_where('tb_item',array('populer' => 'Y' ));
		$data['datadb'] = $this->db->get('tb_perusahaan');
		$this->load->view('front/view_home',$data);
	}
	public function thanks(){
		$data['datadb']= $this->db->get_where('tb_meja',array('sts' => 'kosong' ));
		$data['restodb']= $this->db->get('tb_perusahaan');
		$this->load->view('front/view_thanks',$data);
	}
}
