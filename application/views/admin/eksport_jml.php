<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=backupjumlah".date('d-F-Y').".xls");


?>
<div class="row">
	<div class="col-md-6">
	<?php 
		$tgl = $lap_jml->row();
		$tgltutup = $tgl->tgl;
	?>
	<h4>Laporan Jumlah Item Keluar Per Tanggal <?php echo date('d-F-y',strtotime($tgltutup)) ?></h4>
		<table  class="table">
		<thead>
			<td>No.</td>
			<td>Item</td>
			<td>Tanggal</td>
			<td>Jumlah</td>
		</thead>
		<tbody>
		<?php $no=1; foreach ($lap_jml->result() as $lap) {?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $lap->item ?></td>
				<td><?php echo date('d-F-y',strtotime($lap->tgl)) ?></td>
				<td><?php echo $lap->Sum_jml ?></td>
			</tr>
		<?php  } ?>
		</tbody>
		</table>
	</div>
</div>