<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akasir extends CI_Controller {

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
		$this->Model_security->getsecure();
		$sesi = array('nota' => 'BKS'.rand(1000,1));
		$this->session->set_userdata($sesi);
		$this->load->view('admin/transaksi/view_kasir');		
	}
	//HISTORY
	public function historypesanan(){
		$data['pesanbelum'] = $this->db->order_by('jam','asc')->get_where('q_his_trans',array('sts' => 'belum','tgl'=> date('Y-m-d')));
		$data['pesansudah'] = $this->db->order_by('jam','desc')->get_where('q_his_trans',array('sts' => 'sudah','tgl'=> date('Y-m-d')));
		$this->load->view('admin/transaksi/view_history_belum',$data);
	}
	public function historybungkus(){
		$data['pesanbelum'] = $this->db->order_by('jam','asc')->get_where('tb_bungkus',array('sts' => 'belum','tgl'=> date('Y-m-d')));
		$data['pesansudah'] = $this->db->order_by('jam','desc')->get_where('tb_bungkus',array('sts' => 'sudah','tgl'=> date('Y-m-d')));
		$this->load->view('admin/transaksi/view_history_bungkus',$data);	
	}

	public function transaksi(){
		$data['data'] = $this->db->get_where('q_trans_sudah',array('sts' => 'sudah','trans'=>'T'  ));
		$this->load->view('admin/view_dashboard_kasir',$data);		
	}
	public function bawapulang(){
		$data['data'] = $this->db->get('q_item');
		$data['dbpesanan'] = $this->db->get_where('q_pemesanan',array('nota' => $this->session->userdata('nota')));
		$this->load->view('admin/transaksi/view_bawapulang',$data);		
	}
	public function bacapesanan(){		
		$this->db->where('sts','ada');
		$data['data'] = $this->db->get('q_item');
		$this->load->view('admin/transaksi/show_itempesanan',$data);
	}
	public function bacapesananbungkus(){				
		$this->db->where('sts','ada');
		$data['data'] = $this->db->get('q_item');
		$this->load->view('admin/transaksi/show_itempesananbungkus',$data);
	}
	public function tambahitem(){
		// $data['data'] = $this->db->get_where('q_trans_sudah',array('trans' => 'Y' ));
		$data['data'] = $this->db->get_where('q_trans_sudah',array('trans'=>'T'  ));
		$data['dbpesanan'] = $this->db->get_where('q_pemesanan',array('nota' => $this->session->userdata('nota')));
		$this->load->view('admin/transaksi/view_tambahitem',$data);		
	}
	public function simpantambahitem(){
			
		$data['ket']= $this->input->post('ket');
		$data['jml'] = $this->input->post('jml');
		$data['sts'] = 'belum';
		$data['rasa'] = ($this->input->post('rasa') == 'undefined') ? '' : $this->input->post('rasa');  
		$data['nota'] =$this->input->post('nota');
		$data['kd_item'] = $this->input->post('kd_item');
		$this->db->insert('tb_det_pesan',$data);


		$query = $this->db->get_where('q_det_pesan',array('nota' => $this->input->post('nota')));
		//mengurangi stok ditabel item
		if($query->num_rows() > 0){
			foreach ($query->result() as $baris){
				$kode = $baris->kd_item;
				$this->db->where('kd_item',$this->input->post('kd_item'));
				$qitem = $this->db->get_where('tb_item');
				foreach ($qitem->result() as $brs) {
					$hrg = $brs->harga;
					$promo = $brs->promo;
					if($baris->kd_item == $brs->kd_item){
						if($brs->item_jadi =='Ya'){
							if($brs->stok >0){
								//update isi stok
								$stokbaru = $brs->stok - $baris->jml;
								$baru['stok'] = $stokbaru;
								$baru['sts'] = ($stokbaru <= 0) ? 'Tidak' : $brs->sts ;
								$this->db->where('kd_item',$kode);
								$this->db->update('tb_item',$baru);
							}
						}
					}
				}
			}
		}
		//mengupdate total di tabel pesan
		$nota = $this->input->post('nota');
		$this->db->where('nota',$nota);
		$pesan = $this->db->get('tb_pesan');
		foreach ($pesan->result() as $pesane) {
			//totawal = totawal + (harga*promo/100)*jml;
			$gtot = $pesane->gtot + ($hrg -($hrg *$promo/100))*$this->input->post('jml');
			$datapsn['gtot'] = $gtot;
			$this->db->where('nota',$nota);
			$this->db->update('tb_pesan',$datapsn);
		}
		// ========================================================================

		echo 'ok';
	}


	public function simpanbungkus(){
		date_default_timezone_set('Asia/Bangkok');

		// simpan ke tabel pesan bungkus
		$data['nota']= $this->session->userdata('nota');
		$data['tgl'] = date('Y-m-d');
		$data['jam'] = date('h:i:s');
		$data['nama'] = $this->input->post('nama');
		$data['nip'] = $this->session->userdata('username');
		$data['gtot'] = $this->input->post('gtot');
		$data['bayar'] = $this->input->post('bayar');
		$data['trans'] = 'Y';
		$data['tutup'] = 'T';
		$data['sts'] = 'belum';

		$this->db->insert('tb_bungkus',$data);

		// simpan ke tabel detail bungkus
		$query = $this->db->get_where('tb_pemesanan',array('nota' => $this->session->userdata('nota')));
		if($query->num_rows()  > 0){
			foreach ($query->result() as $baris){
				$det['nota'] = $this->session->userdata('nota');
				$det['kd_item'] = $baris->kd_item;
				$det['jml'] = $baris->jml;
				$det['ket'] = $baris->ket;
				$det['sts'] = 'belum';				
				$this->db->insert('tb_det_bungkus',$det);
			}
		}
		//----------------------------------------------------------



		//menghapus ke table pemesanan
		$this->db->where('nota',$this->session->userdata('nota'));
		$this->db->delete('tb_pemesanan');
		echo "ok";
	}
	public function pesanbungkus(){

		$nota =$this->input->post('nota');
		$kd_item = $this->input->post('kd_item');
		$baca = $this->db->get_where('tb_pemesanan',array('nota' => $nota ,
														'kd_item'=>$kd_item));


		if($baca->num_rows() ==1){
			foreach ($baca->result() as $brs) {
				$lama = $brs->jml + $this->input->post('jml');
				$ketlama = $brs->ket ." ". $this->input->post('ket');
				$baru['jml'] = $lama;
				$baru['ket'] = $ketlama;
				$this->db->where(array('nota' => $nota ,'kd_item'=>$kd_item ));
				$this->db->update('tb_pemesanan',$baru);
			}
		}else{
			$data['nota'] = $nota;
			$data['kd_item'] = $this->input->post('kd_item');
			$data['jml'] = $this->input->post('jml');
			$data['ket'] = $this->input->post('ket');
			$this->db->insert('tb_pemesanan',$data);
		}
		//mengurangi stok ditabel item
		$query = $this->db->get_where('tb_pemesanan',array('nota' => $this->input->post('nota')));
		if($query->num_rows() > 0){
			foreach ($query->result() as $baris){
				$kode = $baris->kd_item;
				$this->db->where('kd_item',$this->input->post('kd_item'));
				$qitem = $this->db->get_where('tb_item');
				foreach ($qitem->result() as $brs) {
					$hrg = $brs->harga;
					$promo = $brs->promo;
					if($baris->kd_item == $brs->kd_item){
						if($brs->item_jadi =='Ya'){
							if($brs->stok >0){
								//update isi stok
								$stokbaru = $brs->stok - $baris->jml;
								$baru['stok'] = $stokbaru;
								$baru['sts'] = ($stokbaru <= 0) ? 'Tidak' : $brs->sts ;
								$this->db->where('kd_item',$kode);
								$this->db->update('tb_item',$baru);
							}
						}
					}
				}
			}
		}
		echo "ok";
	}
	public function jumlah(){
		$sts = $this->input->post('sts');
		$jmlbaru = $this->input->post('jml');
		$ketbaru = $this->input->post('ket');
		
		$nota =$this->session->userdata('nota');
		$kd_item = $this->input->post('id');
		$baca = $this->db->get_where('tb_pemesanan',array('nota' => $nota ,
														'kd_item'=>$kd_item));
		if($baca->num_rows() ==1){
			foreach ($baca->result() as $brs) {
				if($sts == 1){   // kurangi
					if($jmlbaru >= $brs->jml){
						echo 'tidak';
					}else{
						$lama = $brs->jml - $jmlbaru;	
						$ketlama = $this->input->post('ket');
						$baru['jml'] = $lama;
						$baru['ket'] = $ketlama;
						$this->db->where(array('nota' => $nota ,'kd_item'=>$kd_item ));
						$this->db->update('tb_pemesanan',$baru);
						echo 'ok';
					}
					
				}else{  	     //tambah
					$lama = $brs->jml + $jmlbaru;
					$ketlama = $this->input->post('ket');
					$baru['jml'] = $lama;
					$baru['ket'] = $ketlama;
					$this->db->where(array('nota' => $nota ,'kd_item'=>$kd_item ));
					$this->db->update('tb_pemesanan',$baru);
					echo 'ok';
				}
				
			}
		}
		
	}
	public function batalpesan(){
		$id = $this->uri->segment(3);
		$nota =$this->session->userdata('nota');
		$kriteria = $this->db->where(array('nota' => $nota ,'kd_item'=>$id));
		$this->db->delete('tb_pemesanan');
		redirect('akasir/bawapulang');

	}
}
