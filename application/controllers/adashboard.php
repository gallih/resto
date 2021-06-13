<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adashboard extends CI_Controller {

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
		
		$level = $this->session->userdata('level');		
		$this->Model_security->getsecure();
		$this->Model_security->hakakses($level);	
		
	}
}
