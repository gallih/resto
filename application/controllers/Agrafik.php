<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agrafik extends CI_Controller {

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

	public function __construct(){
		parent ::__construct();
		$this->load->model('Model_grafik');
		// $this->Model_security->getsecure();
		// $this->Model_security->hakakses($this->session->userdata('level'));
	
	}
	public function index()
	{
		$tahun = date('Y');
		error_reporting(0);
		foreach ($this->Model_grafik->laporan('tb_pesan',$tahun)->result_array() as $row) {
					$data['grafik'][]=(float)$row['Januari'];
					$data['grafik'][]=(float)$row['Februari'];
					$data['grafik'][]=(float)$row['Maret'];
					$data['grafik'][]=(float)$row['April'];
					$data['grafik'][]=(float)$row['Mei'];
					$data['grafik'][]=(float)$row['Juni'];
					$data['grafik'][]=(float)$row['Juli'];
					$data['grafik'][]=(float)$row['Agustus'];
					$data['grafik'][]=(float)$row['September'];
					$data['grafik'][]=(float)$row['Oktober'];
					$data['grafik'][]=(float)$row['November'];
					$data['grafik'][]=(float)$row['Desember'];
		}
		$this->load->view('admin/grafik/view_grafik',$data);
	}
	public function penjualantahun()
	{
		$tahun = $this->input->post('tahun');
		error_reporting(0);
		foreach ($this->Model_grafik->laporan('tb_pesan',$tahun)->result_array() as $row) {
					$data['grafik'][]=(float)$row['Januari'];
					$data['grafik'][]=(float)$row['Februari'];
					$data['grafik'][]=(float)$row['Maret'];
					$data['grafik'][]=(float)$row['April'];
					$data['grafik'][]=(float)$row['Mei'];
					$data['grafik'][]=(float)$row['Juni'];
					$data['grafik'][]=(float)$row['Juli'];
					$data['grafik'][]=(float)$row['Agustus'];
					$data['grafik'][]=(float)$row['September'];
					$data['grafik'][]=(float)$row['Oktober'];
					$data['grafik'][]=(float)$row['November'];
					$data['grafik'][]=(float)$row['Desember'];
		}
		$this->load->view('admin/grafik/view_grafik',$data);
	}
	public function penjualanbungkus()
	{
		$tahun = date('Y');
		error_reporting(0);
		foreach ($this->Model_grafik->laporan('tb_bungkus',$tahun)->result_array() as $row) {
					$data['grafik'][]=(float)$row['Januari'];
					$data['grafik'][]=(float)$row['Februari'];
					$data['grafik'][]=(float)$row['Maret'];
					$data['grafik'][]=(float)$row['April'];
					$data['grafik'][]=(float)$row['Mei'];
					$data['grafik'][]=(float)$row['Juni'];
					$data['grafik'][]=(float)$row['Juli'];
					$data['grafik'][]=(float)$row['Agustus'];
					$data['grafik'][]=(float)$row['September'];
					$data['grafik'][]=(float)$row['Oktober'];
					$data['grafik'][]=(float)$row['November'];
					$data['grafik'][]=(float)$row['Desember'];
		}
		$this->load->view('admin/grafik/view_grafik_bungkus',$data);
	}
}
