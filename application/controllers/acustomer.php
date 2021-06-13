<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acustomer extends CI_Controller {

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
	// 	$this->Model_security->hakakses($this->session->userdata('level'));
	// }

	public function index()
	{
		$data['datadb'] = $this->db->get('tb_customer');
		$data['error'] = '';
		$this->load->view('admin/user/view_user' ,$data);
	}

	public function cancelpesan(){
		$data = $this->db->get('tb_pesan');
		foreach ($data->result() as $row) {
			$meja = $row->id_meja;
		}
		$tbmeja = $this->db->get('tb_meja');
		foreach ($tbmeja->result() as $mj) {
			$m['sts'] = 'kosong';
			$this->db->where('id_meja',$meja);
			$this->db->update('tb_meja',$m);
		}

		$nota = $this->session->userdata('nota');
		$this->db->where('nota',$nota);
		$this->db->delete(array('tb_pemesanan' ,'tb_pesan'));



		$this->session->sess_destroy();
		redirect('user_home');

	}
	function bacameja(){
		$meja = $this->input->post('no_meja');
		//baca ke tabel meja
		$this->db->where('nm_meja',$meja);
		$q = $this->db->get('tb_meja');
		foreach ($q->result() as $mj) {
			$kode = $mj->id_meja;
		}
		//baca ke tabel pesan
		$this->db->where(array('id_meja' => $kode ,'trans'=>'T'));
		$p = $this->db->get('tb_pesan');
		$rc =$p->num_rows();
		if($rc == 1){
			//membaca ke tabel pesan mengambil nota 
			$brsnota = $p->row()->nota; //nota
			$brsid_cus = $p->row()->id_cus; //id cus
			
			//membaca ke tabel customer mengambil nama
			$this->db->where('Id_cus',$brsid_cus);
			$cus = $this->db->get('tb_customer');
			$nmcus = $cus->row()->nama;
			
			
			$sess_log = array('nama' => $nmcus,
						  'id_cus' =>$brsid_cus,
						'id_meja'=>$meja,
						'nota' =>$brsnota,
						'sts'=>'tambah');
			
			$this->session->set_userdata($sess_log);
			

			$link = base_url().'food';
			echo $link;
		}else{
			$sess_log = array('sts'=>'');
			$this->session->set_userdata($sess_log);
			echo "";
		}


	}
	
	public function pesan(){
		$subtot = $this->uri->segment(3);
		$nota = $this->session->userdata('nota');

		//menghapus ke tabel pemesanan
		// if(!empty($this->session->userdata('sts'))){
		 
		//  $this->db->where('nota',$nota);
		//  $this->db->delete('tb_det_pesan');
		 
		// }

		$query = $this->db->get_where('tb_pemesanan',array('nota' => $nota ));

		//mengurangi stok ditabel item
		if($query->num_rows() > 0){
			foreach ($query->result() as $baris){
				$kode = $baris->kd_item;
				$this->db->where('kd_item',$kode);
				$qitem = $this->db->get_where('tb_item');
				foreach ($qitem->result() as $brs) {
					if($baris->kd_item == $brs->kd_item){
						if($brs->item_jadi =='Ya'){
							if($brs->stok >0){
								//update isi stok
								$baru['stok'] = $brs->stok - $baris->jml;
								$baru['sts'] = ($stokbaru <= 0) ? 'Tidak' : $brs->sts ;
								$this->db->where('kd_item',$kode);
								$this->db->update('tb_item',$baru);
							}
						}
					}
				}
			}
		}
		//========================================================================

		//update ke tabel pesan===================================================
		if($query->num_rows()  > 0){
			foreach ($query->result() as $baris){
				$data['id_cus'] = $this->session->userdata('id_cus');
				$data['gtot'] = $subtot;
				$data['tutup'] = 'T';
				$this->db->where('nota',$nota);
				$this->db->update('tb_pesan',$data);
			}
		}
		//========================================================================

		//simpan ke tabel detail==================================================
		$query = $this->db->get_where('tb_pemesanan',array('nota' => $this->session->userdata('nota')));
		if($query->num_rows()  > 0){
			foreach ($query->result() as $baris){
				$det['nota'] = $nota;
				$det['kd_item'] = $baris->kd_item;
				$det['jml'] = $baris->jml;
				$det['ket'] = $baris->ket;
				$det['rasa'] = $baris->rasa;
				$this->db->insert('tb_det_pesan',$det);
			}
		}
		//========================================================================


		///menghapus ke table pemesanan
		$this->db->where('nota',$nota);
		$this->db->delete('tb_pemesanan');


		$this->session->sess_destroy();
		redirect('home/thanks');

	}

	public function simpan(){
		date_default_timezone_set('Asia/Bangkok');


		//membaca ke table meja
		$kdmeja =$this->input->post('id_meja');
		$nomeja = $this->db->get_where('tb_meja',array('nm_meja'=>$kdmeja));
		foreach ($nomeja->result() as $brs) {
			$isi['id_meja'] =$brs->id_meja;
		}
		
		$nota = 'N'.date('Ymdhms').$this->db->insert_id();

		//mengisi ke tabel customer
		$data['nama'] = $this->input->post('nama');
		$data['nohp'] = $this->input->post('nohp');
		$data['nota'] = $nota;

		$this->db->insert('tb_customer',$data);

		//------------------------

		//medapatkan id customer
		$datae = $this->db->get_where('tb_customer',array('nota' => $nota ));
		foreach ($datae->result() as $key) {
			$kode = $key->Id_cus;
		}
		//-------------


		//mengisi ke tabel pesan
		$isi['nota'] =$nota;
		$isi['tgl'] = date('Y-m-d');
		$isi['jam'] = date('h:i:s');
		$isi['id_cus'] = $kode;
		$this->db->insert('tb_pesan',$isi);

		//update ke tabel meja
		$kd =  $this->input->post('id_meja');
		$meja['sts'] = 'Ada';
		$this->db->where('nm_meja',$kd);
		$this->db->update('tb_meja',$meja);
		//----

		
		$nama = $this->input->post('nama');
		$id_meja = $this->input->post('id_meja');

		$sess_log = array('nama' => $nama,
						  'id_cus' =>$kode,
						'id_meja'=>$this->input->post('id_meja'),
						'nota' =>$nota);
		$this->session->set_userdata($sess_log);

		redirect('food');

		// redirect('auser');
	}
	public function pemesanan(){

		//menyimpan ke tabel pemesanan
		$nota =$this->session->userdata('nota');
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
			$data['nota'] = $this->session->userdata('nota');
			$data['kd_item'] = $this->input->post('kd_item');
			$data['jml'] = $this->input->post('jml');
			$data['ket'] = $this->input->post('ket');
			$data['rasa'] = $this->input->post('rasa');
			$this->db->insert('tb_pemesanan',$data);
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
		$nota =$this->session->userdata('nota');
		$query = $this->db->get_where('tb_pemesanan',array('nota' => $nota ));
		//mengurangi stok ditabel item
		if($query->num_rows() > 0){
			foreach ($query->result() as $baris){
				$kode = $baris->kd_item;
				$this->db->where('kd_item',$kode);
				$qitem = $this->db->get_where('tb_item');
				foreach ($qitem->result() as $brs) {
					if($baris->kd_item == $brs->kd_item){
						if($brs->item_jadi =='Ya'){
							if($brs->stok >0){
								//update isi stok
								$baru['stok'] = $brs->stok + $baris->jml;
								$baru['sts'] = ($stokbaru > 0) ? 'ada' : $brs->sts ;
								$this->db->where('kd_item',$kode);
								$this->db->update('tb_item',$baru);
							}
						}
					}
				}
			}
		}
		$id = $this->uri->segment(3);
		// $this->db->where('nota' ,$nota);
		// $pms = $this->db->get('tb_pemesanan');
		// $this->db->where($pms->row()->id_meja());
		// $mj['sts']= 'kosong';
		// $this->db->update('tb_meja',$mj);

		//mengahapus ke tabel pemesanan
		$kriteria = $this->db->where(array('nota' => $nota ,'kd_item'=>$id));
		$this->db->delete('tb_pemesanan');
		redirect('pesanan');

	}
}
