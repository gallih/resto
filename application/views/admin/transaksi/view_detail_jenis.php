<?php $this->load->view('admin/view_navbar') ?>
<?php 
    $sts = $this->session->flashdata('info');
    if(!empty($sts)){
        echo "
        <script type='text/javascript'>
        $(function(){
            new PNotify({
                title: 'Konfirmasi',
                text: '".$sts."',
                type: 'danger'
                        });
        })
        </script>

        ";
    }
?>
<script type="text/javascript">
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            locale:{
                format:'dd-MMM-yyyy'
            }
        });
        
        $('#bahan').DataTable({
            dom: 'T<"clear">lfrtip',
            "sPaginationType": "full_numbers",
            "tableTools": {
                "aButtons":["print"],
                "sSwfPath": "/asset/admin/js/datatables/tools/swf/swf/copy_csv_xls_pdf.swf"
            }

        });
    });
</script>
<div class="row jumbotron">
<form method="post" action="<?php echo base_url() ?>adminweb/filterhis">
    <div class="row">
        <h3>Pencarian data</h3>
    </div>
    <div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label>Filter Tanggal</label>
            <input type="text" id="daterange" name="daterange" class="form-control" placeholder="Masukkan Range Tanggal" />
            <button type="submit" id="cari" class="btn btn-success pull-right">Cari</button>
        <a href="<?php echo base_url() ?>adminweb/viewdetailitem" class="btn btn-primary pull-right">Refersh</a>
    </div>  
    </div>

</form>
</div><br>
<div class="row">
    <div class="col-md-8 col-sm-12 col-xs-12 col-sm-offset-2">
        <div class="x_panel">
        <div class="x_title">
            <h3 align="center">Detail Pengeluaran Item</h3>
        </div>
        <div class="x_content">
            <div class="table-responsive">
                <table class="table table-striped" id="tdetail">
                <thead>
                    <td>No</td>
                    <td>Tanggal</td>
                    <td>Nama Item</td>
                    <td>Jenis Item</td>
                    <td>Jumlah</td>
                </thead>
                <tbody>
                <?php $no=1; foreach ($datadb->result() as $row) { ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo date('d-F-Y',strtotime($row->tgl)) ?></td>
                        <td><?php echo $row->item ?></td>
                        <td><?php echo $row->nm_jns ?></td>
                        <td><?php echo $row->Sum_jml ?></td>
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