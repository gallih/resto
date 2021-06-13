<?php $this->load->view('admin/header_admin') ?>
<style type="text/css">
	body{
		background: #fff;
		color: #000;
	}
	#utama{
		width: 220px;
		font-family: 'Sans';
		font-size: 8pt;
		/*border: 2px solid;*/
	}
</style>
<script type="text/javascript">
	$(function(){
		window.print();
		window.location.href = "<?php echo base_url() ?>adminweb/historytrans";
	})
</script>

<div id="utama">
<!-- <div class="container-fluid"> -->
<!-- cetak resto -->
<?php foreach ($resto->result() as $resto) { ?>
<div align="center">
	<label><?php echo $resto->nama ?></label><br>
	<label><?php echo $resto->almt ?></label><br>
	<label><?php echo $resto->telp ?></label><hr>
</div>
<?php }?>
<!-- cetak nomer nota -->
<?php 
	$nota = $this->uri->segment(3);
    $this->db->where('nota',$nota);
    $this->db->group_by('nota');
    $query = $this->db->get('q_pesan_bungkus');
	foreach ($query->result() as $trans) { 
?>
	<label><b>Nota :</b> <?php echo $nota ?></label><br>
	<label><b>Tanggal:</b> <?php echo date('d-m-y',strtotime($trans->tgl)) ?></label>&nbsp;&nbsp;&nbsp;
	<label><b>Jam:</b> <?php echo date('h:i',strtotime($trans->jam)) ?></label>&nbsp;&nbsp;&nbsp;
	<label><b><?php echo $this->session->userdata('username');?></b></label><br><br>
<?php 
	}
?>
<!-- cetak detail makanan -->
	<label style="text-align:center">Data Pesanan</label><br>
	
<!-- cetak makanan -->
	<label>Makanan</label><br>
	<table class="table">
		<?php
			$item=0;$gtot=0;
			$this->db->where(array('nm_jns' => 'Makanan' ,'nota'=>$nota));
			$detail = $this->db->get('q_pesan_bungkus');
			foreach ($detail->result() as $det) 
		      { ?>
		  <tr>
		  <td><?php echo $det->item ?></td>
		  <td><?php echo $det->promo."%" ?></td>
		  <td align="right"><?php echo number_format($hrgdiskon=$det->harga -($det->harga*$det->promo/100)) ?></td>
		  <td><?php echo $det->jml ?></td>
		  <td><?php echo $det->ket ;$item = $item +$det->jml; $gtot=$gtot +($hrgdiskon * $det->jml); ?></td>
		  </tr>
		<?php }?>
	</table>
	<div align="right">
		<label>Jumlah Item <?php echo $item ?></label><br>
		<label>Total Rp. <?php echo number_format($gtot) ?></label><br>
	</div>
<!-- cetak minuman -->
	<label>Minuman</label><br>
	<table class="table">
		<?php
			$item=0;$gtot=0;
			$this->db->where(array('nm_jns' => 'Minuman' ,'nota'=>$nota));
			$detail = $this->db->get('q_pesan_bungkus');
			foreach ($detail->result() as $det) 
		      { ?>
		  <td><?php echo $det->item ?></td>
		  <td><?php echo $det->promo."%" ?></td>
		  <td align="right"><?php echo number_format($hrgdiskon=$det->harga -($det->harga*$det->promo/100)) ?></td>
		  <td><?php echo $det->jml ?></td>
		  <td><?php echo $det->ket ;$item = $item +$det->jml; $gtot=$gtot +($hrgdiskon * $det->jml); ?></td>
		<?php }?>
	</table>
	<div align="right">
		<label>Jumlah Item <?php echo $item ?></label><br>
		<label>Total Rp. <?php echo number_format($gtot) ?></label><br>
	</div><br><br>

	<div align="right">
		<label>Grandtotal Rp. <?php echo number_format($det->gtot) ?></label><br>
		<label>Bayar Rp. <?php echo number_format($det->bayar) ?></label><br>
		<label>Kembalian Rp. <?php echo number_format($det->bayar -$det->gtot) ?></label>
	</div>

<!-- </div> -->
</div>