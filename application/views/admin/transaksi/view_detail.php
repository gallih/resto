<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<label>Data Pesanan</label>
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<td>No</td>
					<td align="center">Nama Item</td>
					<td align="center">Harga</td>
					<td align="center">Rasa</td>
					<td align="center">Jumlah</td>
					<td align="center">Keterangan</td>
				</thead>
				<tbody>
				<?php $no=1; $gtot=0; foreach ($datadb->result() as $row) {	?>

					<?php if ($datadb->num_rows() > 0) { ?>
					<tr>
						<td  align="center"><?php echo $no ?></td>
						<td  align="center"><?php echo $row->item ?></td>
						<td  align="center"><?php echo "Rp. ".$hrgdiskon=$row->harga -($row->harga*$row->promo/100);$gtot = $gtot+$hrgdiskon;?></td>
						<td  align="center"><?php echo $row->rasa ?></td>
						<td  align="center"><?php echo $row->jml;?></td>
						<td  align="center"><?php echo $row->ket?></td>
					</tr>
					<?php $no++; }?>
				<?php }?>

					<input id="penampung" type="hidden" value="<?php echo $gtot ?>">
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
