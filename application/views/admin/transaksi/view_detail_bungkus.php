<?php $this->load->view('admin/view_navbar') ?>
<div class="row">
    <div class="col-md-6">
        <div class="x_panel">
        <div class="x_title">
            <h3 align="center">Detail Pengeluaran Item</h3>
            <p>Pengeluaran yang dibawa pulang atau dibungkus</p>
        </div>
        <div class="x_content">
            <div class="table-responsive">
                <table class="table table-striped" id="tdetail">
                <thead>
                    <td>No</td>
                    <td>Tanggal</td>
                    <td>Nama Item</td>
                    
                    <td>Jumlah</td>
                </thead>
                <tbody>
                <?php $no=1; foreach ($datadb->result() as $row) { ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo date('d-F-Y',strtotime($row->tgl)) ?></td>
                        <td><?php echo $row->item ?></td>
                    
                        <td><?php echo $row->jml ?></td>
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
		$('#tdetail').dataTable({
			"tableTools": {
                        "sSwfPath": "<?php echo base_url('assets/admin/js/datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                    }
		});
	})
</script>