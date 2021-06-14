<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apesanan extends CI_Controller {

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
	
	public function index($id=NULL)
	{		
		$this->load->model('model_apesanan');
		
		$level = $this->session->userdata('level');
		// $this->Model_security->getsecure();
		// $this->model_security->hakakses($level);	
		$div = $this->session->flashdata('div');

		//config halaman pagination
		$config['full_tag_open'] = '<div align="center"><nav><ul  class="pagination">';
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
		$config['cur_tag_open'] =  '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$jumlah = $this->model_apesanan->jumlah('q_pesan');
		$config['base_url'] =base_url().'apesanan/index';
		$config['total_rows'] = $jumlah;
		$config['per_page']=3;

		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['datadb']= $this->model_apesanan->lihat($config['per_page'],$id,'q_pesan','Makanan');
		


		// $tgl = date('Y-m-d');
		$data['datajum'] = $this->db
								->order_by('sum_jml','desc')
								->get_where('q_jml_perhari',array('sts'=>'belum' ));
		$this->load->view('admin/pesanan/view_pesanan',$data);
	}
	public function bungkus(){
		$data['datadb'] = $this->db
						   ->group_by('nota')
						   ->order_by('jam','asc')
						   ->where(array('sts_item'=>'belum'))
						   ->get('q_pesan_bungkus')
						   ->result();
		$data['tol'] = 'kon';
		$this->load->view('admin/pesanan/view_pesanan_bungkus',$data);	
	}
	public function selesai(){
		$nota = $this->uri->segment(3);
		$data['sts'] = 'sudah';
		//update ke tabel pesan
		$this->db->where('nota',$nota);
		$this->db->update('tb_pesan',$data);

		//update ke tabel detail

		$this->db->where('nota',$nota);
		$this->db->update('tb_det_pesan',$data);		


		$this->session->set_flashdata('info','Pesanan sudah siap ');
		redirect('Apesanan');
	}
	public function selesaibarang(){
		$nota = $this->uri->segment(3);
		$brg = $this->uri->segment(4);
		
		//update ke tabel detail
		$this->db->where(array('nota' => $nota ,'kd_item'=>$brg));
		$data['sts'] = 'sudah';
		$this->db->update('tb_det_pesan',$data);

		//baca ke tabel detail
		$qr = $this->db->get_where('tb_det_pesan',array('nota' => $nota ,'sts'=>'belum' ));
		if($qr->num_rows() == 0){
			$psn['sts'] = 'sudah';
			$this->db->where('nota',$nota);
			$this->db->update('tb_pesan',$psn);
		}


		$this->session->set_flashdata('info','Pesanan sudah siap ');
		redirect('Apesanan');
	}
	public function selesaibungkus(){
		$nota = $this->uri->segment(3);
		$data['sts'] = 'sudah';
		//update ke tabel pesan
		$this->db->where('nota',$nota);
		$this->db->update('tb_bungkus',$data);

		//update ke tabel detail

		$this->db->where('nota',$nota);
		$this->db->update('tb_det_bungkus',$data);		


		$this->session->set_flashdata('info','Pesanan sudah siap ');
		redirect('Apesanan/bungkus');
	}
	public function selesaibksbarang(){
		$nota = $this->uri->segment(3);
		$brg = $this->uri->segment(4);

		//update ke tabel detail
		$this->db->where(array('nota' => $nota ,'kd_item'=>$brg));
		$data['sts'] = 'sudah';
		$this->db->update('tb_det_bungkus',$data);

		//baca ke tabel detail
		$qr = $this->db->get_where('tb_det_bungkus',array('nota' => $nota ,'sts'=>'belum' ));
		if($qr->num_rows() == 0){
			$psn['sts'] = 'sudah';
			$this->db->where('nota',$nota);
			$this->db->update('tb_bungkus',$psn);
		}

		$this->session->set_flashdata('info','Pesanan sudah siap ');
		redirect('Apesanan/bungkus');
	}
	public function keluar(){
		$this->session->sess_destroy();
		redirect('adminweb');
	}
	function cekjml(){
		$data = $this->db->get_where('q_jml_perhari',array('nm_jns' => 'makanan','tgl'=>date('Y-m-d'),'sts'=>'Belum' ));
        echo $data->num_rows();
        
	}
	function cetakmakan()
    {
        $data = $this->db->get_where('q_jml_perhari',array('nm_jns' => 'makanan','tgl'=>date('Y-m-d'),'sts'=>'Belum' ));
        if($data->num_rows() >0){
    	//custom ukuran kertas 
    	//(P = POTRAIT L=LANDSCAPE ,SATUAN UKURAN ,ARRAY(TINGGI ,LEBAR))
        $pdf = new FPDF('P','cm',array(20,5.8));
        $pdf->AddPage();
        $pdf->SetMargins(0.4,0,0);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(4,0.5,"Pesanan Makanan yang Belum",0,0,'C');
        $pdf->Ln(0.5);
        $pdf->Cell(5,0,"-----------------",0,0,'C');
        $pdf->Ln(0.5);
        	foreach ($data->result() as $mak ) { 
        		$pdf->Cell(4,0.5,$mak->item,0,0,'L');
        		$pdf->Cell(1,0.5,$mak->Sum_jml,0,0,'R');
        	}
        // $pdf->AutoPrint(true);
        $pdf->AddPage();
        $pdf->Output();
        
        }else{
        	echo 0;	
        }
    }

	
}
