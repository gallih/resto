<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminweb extends CI_Controller {

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
	// 	$this->load->model('Model_Security');
	// 	$this->Model_security->getsecure();
	// }

	function __construct(){
		parent::__construct();
		
	}
	public function index()
	{
		
		$this->load->view('admin/view_login');
		
	}


	function tutupbuku(){
		// update ke tabel pesan
		$this->cetakgrandtotal();
		
		$this->db->where('tutup','T');
		$query = $this->db->get('tb_pesan');
		$brs = $query->row();
		$tgltutup = $brs->tgl;
		$data['tgl_tutup'] = $tgltutup;
		$data['tutup'] = 'Y';
		$this->db->update('tb_pesan',$data);

		//update ke tabel bungkus
		$this->db->where('tutup','T');
		$query = $this->db->get('tb_bungkus');
		$brs = $query->row();
		$bks['tgl_tutup'] = $tgltutup;
		$bks['tutup'] = 'Y';

		$this->db->where('tutup','T');
		$this->db->update('tb_bungkus',$bks);
		//eksport data excel penjualan
		
		$this->eksport_xls('penjual');
		$this->eksport_xls('jml');
		// redirect('adashboard');
		

	}
	public function eksport_harian()
	{
			$this->db->where(array('tgl'=>date('Y-m-d'),'trans'=>'Y'));
			$data['lap_hari'] = $this->db->get('q_laporan_hari');
			$this->load->view('admin/eksport',$data);
	}
	public function eksport_xls($value=null)
	{
		if($value =='penjual'){
			$this->db->where('tutup','Y');
			$data['lap_hari'] = $this->db->get('q_laporan_hari');
			$this->load->view('admin/eksport',$data);
		}elseif ($value =='jml'){
			$data['lap_jml'] = $this->db->get_where('q_jml_perhari',array('tutup'=>'Y'));
			$this->load->view('admin/eksport_jml',$data);
		}
	}
	public function bekupdatabase(){
		$tanggal = date('Ymdhis');
		$namafil = $tanggal.'log.sql.zip';
		$this->load->dbutil();
		$bekup =& $this->dbutil()->backup();
		force_download($namafil,$bekup);
	}
	public function resetstatus(){
		$data['sts'] = 'kosong';
		$this->db->update('tb_meja',$data);

		$data['sts'] = 'Ada';
		$this->db->where('nm_meja','BKS');
		$this->db->update('tb_meja',$data);
		
		$this->session->set_flashdata('info','Berhasil Mereset status Meja');
		redirect('adashboard');
	}

	public function historypenjualan(){
		$data['datadb'] = $this->db->get_where('tb_pesan',array('trans' => 'Y','tgl'=>date('Y-m-d')));
		$this->load->view('admin/transaksi/view_his_penjualan',$data);
	}
	public function filterhispenjualan(){
		$tgl = $this->input->post('daterange');
		if ($tgl == is_null($tgl)){
			$this->session->set_flashdata('info','Pilih Range Tanggal');
			redirect('adminweb/historypenjualan');
		}
		$pisah = explode('-',$tgl);

		$tgl1 = date('Y-m-d',strtotime($pisah[0]));
		$tgl2 = date('Y-m-d',strtotime($pisah[1]));
				
		$this->db->where("tgl_tutup >=",$tgl1);
		$this->db->where("tgl_tutup <=",$tgl2);
				
		$data['datadb'] = $this->db->get('tb_pesan');
		
		$this->load->view('admin/transaksi/view_his_penjualan',$data);
	}
	public function masuk(){
		$uname = $this->input->post('username');
		$pass = md5($this->input->post('pass'));
		$div = ($this->input->post('divisi')=='') ? '' : $this->input->post('divisi') ;
		//echo $uname . $pass;
		$query = $this->db->get_where('tb_user',array('username' => $uname,
											'pass' =>$pass ));
		if($query->num_rows() > 0){
			foreach ($query->result() as $row ) {
				if($row->blokir =='Y'){
					$this->session->set_flashdata('info','Maaf username '.$uname.' di Blokir oleh Administrator Web ini');
					redirect('Adminweb');
				}else{
					foreach ($query->result() as $row) {
					$sess = array('username' => $row->username ,
								  'level' =>$row->level,
								  'id' =>$row->Id,
								  'divisi'=> $div);
					$this->session->set_userdata($sess);
					redirect('adashboard');
					}
				}
			}			
		}else{
			$this->session->set_flashdata('info','Username atau Password salah');
			redirect('Adminweb');
		}
	}
	function dapurlogin(){
		$uname = $this->input->post('username');
		$pass = md5($this->input->post('pass'));
		$div= $this->input->post('divisi');
		echo $uname.$pass.$div;
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('adminweb');
	}

	public function password(){
		$this->load->view('admin/view_password');
	}
	
	public function baca_pass(){
		$passlama = md5($this->input->post('passlama'));

		$id = $this->session->userdata('id');
		$this->db->where('Id',$id);
		$query = $this->db->get('tb_user');
		foreach ($query->result() as $row) {

			if($passlama != $row->pass){
				echo "Password salah";
			}
		}
	}
	public function ganti_pass(){
		$id = $this->session->userdata('id');
		$pass['pass'] = md5($_REQUEST['pass']);
		
		$this->db->where('Id',$id);
		$this->db->update('tb_user',$pass);
		$this->session->set_flashdata('info','Password Baru Berhasil diupdate ');
		redirect('adashboard');
	}
	public function historytrans(){
		$data['datadb'] = $this->db->order_by('tgl','desc')->get_where('q_trans_sudah',array('sts' => 'sudah' ,'trans'=>'Y','tgl'=>date('Y-m-d')));
		$data['datadbbungkus'] = $this->db->order_by('tgl','desc')->get_where('tb_bungkus',array('sts' => 'sudah' ,'trans'=>'Y','tgl'=>date('Y-m-d') ));
		$this->load->view('admin/transaksi/history_trans',$data);

	}
	public function viewdetailitem(){
		$data['datadb'] = $this->db->get_where('q_jml_perhari',array('tutup'=>'T'));
		$this->load->view('admin/transaksi/view_detail_jenis',$data);
	}
	public function detailitembungkus(){
		$data['datadb'] = $this->db->get_where('q_jml_perhari_bungkus',array('tutup'=>'T'));
		$this->load->view('admin/transaksi/view_detail_bungkus',$data);
	}
	public function filterhis(){
		$tgl = $this->input->post('daterange');
		if ($tgl == is_null($tgl)){
			$this->session->set_flashdata('info','Pilih Range Tanggal');
			redirect('adminweb/viewdetailitem');
		}
		$pisah = explode('-',$tgl);

		$tgl1 = date('Y-m-d',strtotime($pisah[0]));
		$tgl2 = date('Y-m-d',strtotime($pisah[1]));
				
		$this->db->where("tgl >=",$tgl1);
		$this->db->where("tgl <=",$tgl2);
				
		$data['datadb'] = $this->db->get('q_jml_perhari');

		$this->load->view('admin/transaksi/view_detail_jenis',$data);		

	}


//UNTUK KASIR
	public function bacatrans(){
		$nota = $this->input->post('nota');
		$this->db->where('nota',$nota);
		$data['datadb'] = $this->db->get('q_det_pesan');
		$this->load->view('admin/transaksi/view_detail',$data);
	}

	public function updatetrans(){
		$nota = $this->input->post('nota');
		$data['trans']='Y';
		$data['gtot']=$this->input->post('gtot');
		$data['bayar'] = $this->input->post('bayar');
		$this->db->where('nota',$nota);
		$this->db->update('tb_pesan',$data);

		//mengupdate meja menjadi kosong
		$meja = $this->input->post('no_meja');
		$mejane['sts'] = 'kosong';
		$this->db->where('nm_meja',$meja);
		$this->db->update('tb_meja',$mejane);
		// echo $nota . "ikimejo".$meja;
		echo 'ok';
		
	}
	function cetaknota(){
		$data['resto'] = $this->db->get('tb_perusahaan');
		$this->load->view('admin/transaksi/cetak',$data);
	}
	// function cetakbungkus(){
	// 	$data['resto'] = $this->db->get('tb_perusahaan');
	// 	$this->load->view('admin/transaksi/cetak_bungkus',$data);
	// }
	function cetak()
    {
    	$kasir =  $this->session->userdata('username');
    	//custom ukuran kertas 
    	//(P = POTRAIT L=LANDSCAPE ,SATUAN UKURAN ,ARRAY(TINGGI ,LEBAR))
        $pdf = new FPDF('P','cm',array(20,5.8));
        $pdf->AddPage();
        $pdf->SetMargins(0.4,0,1);
        $pdf->SetFont('Arial','',9);

        //membaca tabel perusahaan
        $usaha = $this->db->get('tb_perusahaan');
        foreach ($usaha->result() as $row) {
        	$pdf->Ln(0.4);
        	$pdf->Cell(4.5, 1, $row->nama, 0, 0, 'C'); 	
        	$pdf->Ln(0.4);
        	$pdf->Cell(4.5, 1, $row->almt, 0, 0, 'C'); 	
        	$pdf->Ln(0.4);
        	$pdf->Cell(4.5, 1, $row->kota." ".$row->telp, 0, 0, 'C'); 	
        	$pdf->Ln(0.7);

        }
        // membaca table pesan
        $nota = $this->uri->segment(3);
        $this->db->where('nota',$nota);
        $query = $this->db->get('q_trans_sudah');
        foreach ($query->result() as $key) {
        	$pdf->Cell(3.7, 1,"Nota ". $key->nota, 0, 0, 'L'); 
        	//$pdf->Ln(0.4);
        	$pdf->Cell(1.4, 1, " ".$key->nm_meja, 0, 0, 'L'); 
        	$pdf->Ln(0.4);
        	$pdf->Cell(3.3, 1, $key->nama, 0, 0, 'L'); 
        	$pdf->Cell(1, 1, "Kasir :".$kasir, 0, 0, 'C'); 
        	$pdf->Ln(0.4);
        }
        $pdf->Cell(3, 1, "Data pesanan ", 0, 0, 'L'); 
        $pdf->Ln(0.3);
        //grup berdasarkan makanan
        $pdf->Cell(1, 1, "Makanan ", 0, 0, 'L'); 
        $pdf->Ln(0.7);
        $pdf->Cell(4.6, 0, " ", 1, 0, 'L'); 
        $pdf->Ln(0.1);
        // membaca tabel detail
        $nota = $this->uri->segment(3);
        $this->db->where(array('nota' =>$nota,'nm_jns'=>'Makanan' ));
        $detail = $this->db->get('q_det_pesan');
        $gtotmak=0;$item=0;$totale=0;$subtotmak=0;$tot=0;
        foreach ($detail->result() as $brs) {
        	$hrgdiskon=$brs->harga -($brs->harga*$brs->promo/100);
            $subtotmak = $subtotmak +($brs->jml * $hrgdiskon);
            $tot = $tot + $hrgdiskon;

        	$pdf->Cell(1.8, 0.5, $brs->item, 0, 0, 'L'); 
			$pdf->Cell(2.5, 0.5, "Rp.".$hrgdiskon, 0, 0, 'R'); 
			$pdf->Cell(0.1, 0.5, $brs->jml, 0, 0, 'C'); 
			$pdf->Cell(2, 0.5, $brs->ket, 0, 0, 'L'); 
			
			$item = $item +$brs->jml;
			$gtotmak=$gtotmak +($subtotmak * $brs->jml);
			$pdf->Ln(0.4);
        }
        $pdf->Cell(4.5, 0.5,"Jumlah Item " .$item, 0, 0, 'R'); 
        $pdf->Ln(0.3);
        $pdf->Cell(4.5, 0.5,"Total Makanan Rp " .$subtotmak, 0, 0, 'R'); 
        $pdf->Ln(0.1);
        //grup berdasarkan minuman
        $pdf->Cell(1, 1, "Minuman", 0, 0, 'L'); 
        $pdf->Ln(0.7);
        $pdf->Cell(4.6, 0, " ", 1, 0, 'L'); 
        $pdf->Ln(0.1);

        // membaca tabel detail
        $nota = $this->uri->segment(3);
        $this->db->where(array('nota' =>$nota,'nm_jns'=>'Minuman' ));
        $detail = $this->db->get('q_det_pesan');
        $gtotmik=0;$item=0;$totale=0;$subtotmik=0;$totmin=0;
        foreach ($detail->result() as $brs) {
        	$hrgdiskon=$brs->harga -($brs->harga*$brs->promo/100);
            $subtotmik = $subtotmik +($brs->jml * $hrgdiskon);
        	$totmin = $totmin + $hrgdiskon;

        	$pdf->Cell(1.8, 0.5, $brs->item, 0, 0, 'L'); 
			$pdf->Cell(2.5, 0.5, "Rp.".$hrgdiskon, 0, 0, 'R'); 
			$pdf->Cell(0.1, 0.5, $brs->jml, 0, 0, 'C'); 
			$pdf->Cell(2, 0.5, $brs->ket, 0, 0, 'L'); 
			
			$totale = $brs->gtot;
			$item = $item +$brs->jml;
			$gtotmik=$gtotmik +($subtotmik *$brs->jml);
			$pdf->Ln(0.3);
        }
        $akhir = $subtotmak+$subtotmik;
        $pdf->Cell(4.5, 0.5,"Jumlah Item " .$item, 0, 0, 'R'); 
        $pdf->Ln(0.4);
        $pdf->Cell(4.5, 0.5,"Total Minuman Rp " .$subtotmik, 0, 0, 'R'); 
        $pdf->Ln(1);
        $pdf->Cell(4.6, 0.5,"GrandTotal Rp " .$akhir, 0, 0, 'R'); 
        $pdf->Ln(0.3);
        $pdf->Cell(4.6, 0.5,"Bayar Rp " .$brs->bayar, 0, 0, 'R'); 
        $pdf->Ln(0.3);
        $pdf->Cell(4.6, 0.5,"Kembalian Rp " .($brs->bayar -$akhir), 0, 0, 'R'); 

        $pdf->Output();
    }
    function cetakbungkus()
    {
    	$kasir =  $this->session->userdata('username');
    	//custom ukuran kertas 
    	//(P = POTRAIT L=LANDSCAPE ,SATUAN UKURAN ,ARRAY(TINGGI ,LEBAR))
        $pdf = new FPDF('P','cm',array(20,5.8));
        $pdf->AddPage();
        $pdf->SetMargins(0.4,0,1);
        $pdf->SetFont('Arial','',9);

        //membaca tabel perusahaan
        $usaha = $this->db->get('tb_perusahaan');
        foreach ($usaha->result() as $row) {
        	$pdf->Ln(0.4);
        	$pdf->Cell(4.5, 1, $row->nama, 0, 0, 'C'); 	
        	$pdf->Ln(0.4);
        	$pdf->Cell(4.5, 1, $row->almt, 0, 0, 'C'); 	
        	$pdf->Ln(0.4);
        	$pdf->Cell(4.5, 1, $row->kota." ".$row->telp, 0, 0, 'C'); 	
        	$pdf->Ln(0.7);

        }
        // membaca table pesan
        $nota = $this->uri->segment(3);
        $this->db->where('nota',$nota);
        $query = $this->db->get('q_pesan_bungkus');
    	$pdf->Cell(3.7, 1,"Nota ". $nota, 0, 0, 'L'); 
    	$pdf->Ln(0.4);
    	$pdf->Cell(3.2, 1, "Kasir :".$kasir, 0, 0, 'L'); 
    	$pdf->Cell(2.8, 1, $query->row()->nama, 0, 0, 'L'); 
    	$pdf->Ln(0.5);

        $pdf->Cell(3, 1, "Data pesanan ", 0, 0, 'L'); 
        $pdf->Ln(0.3);
        //grup berdasarkan makanan
        $pdf->Cell(1, 1, "Makanan ", 0, 0, 'L'); 
        $pdf->Ln(0.7);
        $pdf->Cell(4.6, 0, " ", 1, 0, 'L'); 
        $pdf->Ln(0.1);
        // membaca tabel detail
        $nota = $this->uri->segment(3);
        $this->db->where(array('nota' =>$nota,'nm_jns'=>'Makanan' ));
        $detail = $this->db->get('q_pesan_bungkus');
        $gtotmak=0;$item=0;$totale=0;$subtotmak=0;$tot=0;
        foreach ($detail->result() as $brs) {
        	$hrgdiskon=$brs->harga -($brs->harga*$brs->promo/100);
            $subtotmak = $subtotmak +($brs->jml * $hrgdiskon);
            $tot = $tot + $hrgdiskon;


        	$pdf->Cell(1.8, 0.5, $brs->item, 0, 0, 'L'); 
			$pdf->Cell(2.5, 0.5, "Rp.".$hrgdiskon, 0, 0, 'R'); 
			$pdf->Cell(0.1, 0.5, $brs->jml, 0, 0, 'C'); 
			$pdf->Cell(2, 0.5, $brs->ket, 0, 0, 'L'); 
			
			$item = $item +$brs->jml;
			$gtotmak=$gtotmak +($subtotmak * $brs->jml);
			$pdf->Ln(0.4);
        }
        $pdf->Cell(4.5, 0.5,"Jumlah Item " .$item, 0, 0, 'R'); 
        $pdf->Ln(0.3);
        $pdf->Cell(4.5, 0.5,"Total Makanan Rp " .$subtotmak, 0, 0, 'R'); 
        $pdf->Ln(0.1);
        //grup berdasarkan minuman
        $pdf->Cell(1, 1, "Minuman", 0, 0, 'L'); 
        $pdf->Ln(0.7);
        $pdf->Cell(4.6, 0, " ", 1, 0, 'L'); 
        $pdf->Ln(0.1);

        // membaca tabel detail
        $nota = $this->uri->segment(3);
        $this->db->where(array('nota' =>$nota,'nm_jns'=>'Minuman' ));
        $detail = $this->db->get('q_pesan_bungkus');
        $gtotmik=0;$item=0;$totale=0;$subtotmik=0;$totmik=0;
        foreach ($detail->result() as $brs) {
        	$hrgdiskon=$brs->harga -($brs->harga*$brs->promo/100);
            $subtotmik = $subtotmik +($brs->jml * $hrgdiskon);
        	$totmik = $totmik + $hrgdiskon;


        	$pdf->Cell(1.8, 0.5, $brs->item, 0, 0, 'L'); 
			$pdf->Cell(2.5, 0.5, "Rp.".$hrgdiskon, 0, 0, 'R'); 
			$pdf->Cell(0.1, 0.5, $brs->jml, 0, 0, 'C'); 
			$pdf->Cell(2, 0.5, $brs->ket, 0, 0, 'L'); 
			
			$totale = $brs->gtot;
			$item = $item +$brs->jml;
			$gtotmik=$gtotmik +($subtotmik *$brs->jml);
			$pdf->Ln(0.3);
        }
        $akhir = $subtotmak+$subtotmik;
        $pdf->Cell(4.5, 0.5,"Jumlah Item " .$item, 0, 0, 'R'); 
        $pdf->Ln(0.4);
        $pdf->Cell(4.5, 0.5,"Total Minuman Rp " .$subtotmik, 0, 0, 'R'); 
        $pdf->Ln(1);
        $pdf->Cell(4.6, 0.5,"GrandTotal Rp " .$akhir, 0, 0, 'R'); 
        $pdf->Ln(0.3);
        $pdf->Cell(4.6, 0.5,"Bayar Rp " .$brs->bayar, 0, 0, 'R'); 
        $pdf->Ln(0.3);
        $pdf->Cell(4.6, 0.5,"Kembalian Rp " .($brs->bayar -$akhir), 0, 0, 'R'); 

        $pdf->Output();
    }
    function cetakgrandtotal()
    {
    	date_default_timezone_set("Asia/Bangkok");
    	$pdf = new FPDF('P','cm',array(20,5.8));
        $pdf->AddPage();
        $pdf->SetMargins(0.4,0,1);
        $pdf->SetFont('Arial','',9);
    	
    	// TRANSAKSI LANGSIUNG
    	$this->db->where(array('trans'=>'Y','sts'=>'sudah','tutup'=>'T'));
		$datadb= $this->db->get('tb_pesan');
    	$gtot=0;$no=0;$gtotbungkus=0;$nobungkus=0;
	    foreach ($datadb->result() as $row) {
	        $gtot = $gtot + $row->gtot;
	        $no++;
	    } 
	    $mak=0;$mik=0;$makbks=0;$mikbks=0;
	    $this->db->where(array('tutup'=>'T' ,'nm_jns'=>'Makanan'));
	    foreach ($this->db->get('q_det_pesan')->result() as $row) {
	        $mak = $mak + $row->jml;
	    }
	    $this->db->where(array('tutup'=>'T' ,'nm_jns'=>'Minuman'));
	    foreach ($this->db->get('q_det_pesan')->result() as $row) {
	        $mik = $mik + $row->jml;
	    }
	    // BATASNYA

	    //TRANSAKSI BUNGKUS
	    $this->db->where(array('trans'=>'Y','sts'=>'sudah','tutup'=>'T'));
		$databungkus = $this->db->get('tb_bungkus');
	    foreach ($databungkus->result() as $row) {
	        $gtotbungkus = $gtotbungkus + $row->gtot;
	        $nobungkus++;
    	} 	       
    	$this->db->where(array('tutup'=>'T' ,'nm_jns'=>'Makanan'));
	    foreach ($this->db->get('q_pesan_bungkus')->result() as $row) {
	        $makbks = $makbks + $row->jml;
	    }
	    $this->db->where(array('tutup'=>'T' ,'nm_jns'=>'Minuman'));
	    foreach ($this->db->get('q_pesan_bungkus')->result() as $row) {
	        $mikbks = $mikbks + $row->jml;
	    }

	    //BATASNYA
	    $pdf->Cell(1,0.5,"Info Penjualan",0,0,'C');
	    $pdf->Ln(0.5);
	    $pdf->Cell(2,0.5,date('d-F-y'),0,0,'L');
	    $pdf->Cell(2,0.5,date('h:i A'),0,0,'R');
	    $pdf->Ln(1);
    	$pdf->Cell(5,0.5,"Transaksi Langsung",0,0,'C');
    	$pdf->Ln(0.5);
	    $pdf->Cell(4.6, 0, " ", 1, 0, 'L'); 
        $pdf->Ln(0.1);
	    $pdf->Cell(3.3,0.5,"Grand Total Rp".number_format($gtot),0,0,'L');
	    $pdf->Ln(0.3);
	    // $pdf->Cell(3.3,0.5,"Jumlah Transaksi ".$no,0,0,'L');
	    // $pdf->Ln(0.3);
	    $pdf->Cell(2.5,0.5,"Makanan ".$mak,0,0,'L');
	    $pdf->Cell(3.3,0.5,"Minuman ".$mik,0,0,'L');
	    $pdf->Ln(1);
	    $pdf->Cell(5,0.5,"Transaksi Bungkus",0,0,'C');
	    $pdf->Ln(0.5);
	    $pdf->Cell(4.6, 0, " ", 1, 0, 'L'); 
        $pdf->Ln(0.1);
        $pdf->Cell(3.3,0.5,"Grand Total Rp".number_format($gtotbungkus),0,0,'L');
	    $pdf->Ln(0.3);
	    // $pdf->Cell(3.3,0.5,"Jumlah Transaksi ".$nobungkus,0,0,'L');
	    // $pdf->Ln(0.3);
	    $pdf->Cell(2.5,0.5,"Makanan ".$makbks,0,0,'L');
	    $pdf->Cell(3.3,0.5,"Minuman ".$mikbks,0,0,'L');
	    $pdf->Ln(1);
        $pdf->Output();
    }
}

