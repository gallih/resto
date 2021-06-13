<table class="table table-bordered">
	<thead>
		<td>Nota</td>
		<td>Nama Meja</td>
	</thead>
	<tbody>
	<?php foreach ($datadb->result() as $key) { ?>
		<tr>
			<td><?php echo $key->nota ?></td>
			<td><?php echo $key->nm_meja ?></td>
		</tr>
	<?php }?>
	</tbody>
</table>
<a href="<?php echo base_url() ?>adminweb/topdf">Cetak</a>