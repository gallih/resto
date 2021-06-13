<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=backupjual".date('d-F-Y').".xls");


?>
<style type="text/css">
	body{
		background: transparent;
		color: #000;
	}
</style>
<div class="row">
	<div class="col-md-6">
	<?php 
		$tgl = $lap_hari->row();
		$tgltutup = $tgl->tgl_tutup;
	?>
	<h4>Laporan Penjualan Harian Tutup Buku Per Tanggal <?php echo date('d-F-y',strtotime($tgltutup)) ?></h4>
		<table  class="table">
		<thead>
			<td>No.</td>
			<td>Nota</td>
			<td>Tanggal</td>
			<td>Jam</td>
			<td>Nama Item</td>
			<td>Pengeluaran</td>
			<td>Grand Total</td>
			<td>Bayar</td>
		</thead>
		<tbody>
		<?php $no=1; foreach ($lap_hari->result() as $lap) {?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $lap->nota ?></td>
				<td><?php echo date('d-F-y',strtotime($lap->tgl)) ?></td>
				<td><?php echo $lap->jam ?></td>
				<td><?php echo $lap->item ?></td>
				<td><?php echo $lap->jml ?></td>
				<td><?php echo $lap->gtot ?></td>
				<td><?php echo $lap->bayar ?></td>
			</tr>
		<?php  } ?>
		</tbody>
		</table>
	</div>
</div>
