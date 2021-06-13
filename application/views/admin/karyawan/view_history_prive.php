<?php $this->load->view('admin/view_navbar') ?>
<div class="col-md-5 col-sm-12 col-xs-12 ">
	<div class="row">
		<div class="x_panel">
		<div class="x_title">
			<h5>History Penginputan Jatah Karyawan Hari ini</h5>
            
		</div>
		<div class="x_content">
			<div class="table-responsive">
				<table class="table" id="history">
					<thead>
					<!-- nota,nm_meja,gtot,sts,trans,nama -->
						<td>No.</td>
						<td>Nama Penginput</td>
						<td>Nama Karyawan</td>
						<td>Jam</td>
						<td>Item</td>
					</thead>
					<tbody>
						<?php 
							$no=1; 
							if($datadb->num_rows() > 0){
								foreach ($datadb->result() as $row) {
						?>
						<tr>
							<td><?php echo $no; ?></td>
							<td ><?php echo $row->userkasir ?></td>
							<td><?php echo $row->nama ?></td>
							<td><?php echo $row->jam ?></td>
							<td><?php echo $row->item ?></td>
							
						</tr>
						<?php $no++; }}else{ echo '<td colspan="4" align="center">Masih Belum ada yang mengambil Jatah </td>'; }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	</div>
</div>