<?php  $this->load->view('admin/view_navbar')?>
<body onload="javascript:setTimeout('location.reload(true);',10000);">
<div class="row">
<div class="col-md-6 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h3><i class="fa fa-calculator"></i> History Transaksi Langsung</h3>
            <div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="table-responsive">
				<table class="table" id="history">
					<thead>
					<!-- nota,nm_meja,gtot,sts,trans,nama -->
						<td>No</td>
						<td>Tanggal</td>
						<td>Jam</td>
						<td>Nama Pemesan</td>
						<td>No Meja</td>
						<td>Grand Total</td>
						<td>Cetak</td>
					</thead>
					<tbody>
						<?php $no=1; foreach ($datadb->result() as $row) {?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo date('d-F-Y',strtotime($row->tgl)) ?></td>
							<td><?php echo $row->jam ?></td>
							<td><?php echo $row->nama ?></td>
							<td><?php echo $row->nm_meja ?></td>
							<td align="right"><?php echo "Rp ".$row->gtot ?></td>
							<td align="center"><a href="<?php echo base_url() ?>adminweb/cetak/<?php echo $row->nota ?>"><i class="fa fa-print"></i></a></td>
						</tr>
						<?php $no++; }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h3><i class="fa fa-check-circle"></i> History Transaksi Bawa Pulang</h3>
            <div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="table-responsive">
				<table class="table" id="historybungkus">
					<thead>
					<!-- nota,nm_meja,gtot,sts,trans,nama -->
						<td>No</td>
						<td>Nota</td>
						<td>Tanggal</td>
						<td>Jam</td>
						<td>Nama Pemesan</td>
						<td>Grand Total</td>
						<td>Cetak</td>
					</thead>
					<tbody>
						<?php $no=1; foreach ($datadbbungkus->result() as $row) {?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $row->nota; ?></td>
							<td><?php echo date('d-F-Y',strtotime($row->tgl)) ?></td>
							<td><?php echo $row->jam ?></td>
							<td><?php echo $row->nama ?></td>
							<td align="right"><?php echo "Rp ".$row->gtot ?></td>
							<td><a href="<?php echo base_url() ?>adminweb/cetakbungkus/<?php echo $row->nota ?>"><i class="fa fa-print"></i></a></td>
						</tr>
						<?php $no++; }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var oTable = $('#history').dataTable({
                    "oLanguage": {
                        "sSearch": "Cari disini"
                    },
        });
        var oTablebungkus = $('#historybungkus').dataTable({
                    "oLanguage": {
                        "sSearch": "Cari disini"
                    },
        });
    })
</script>

