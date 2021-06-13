<?php $this->load->view('admin/view_navbar') ?>
<style type="text/css">
	.total{
		padding: 15px;
		color: #fff;
        font-size: 18pt;
	}
</style>
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
<form method="post" action="<?php echo base_url() ?>adminweb/filterhispenjualan">
    <div class="row">
        <h3>Pencarian data</h3>
    </div>
    <div class="row">
    <div class="col-md-4 col-sm-12 col-xs-12">
        <label>Filter Tanggal</label>
            <input type="text" id="daterange" name="daterange" class="form-control" placeholder="Masukkan Range Tanggal" />
            <button type="submit" id="cari" class="btn btn-success pull-right">Cari</button>
            <a href="<?php echo base_url() ?>adminweb/historypenjualan" class="btn btn-primary pull-right">Refersh</a>
    </div>  
    </div>

</form>
</div><br>
<div class="row">
<div class="col-md-8 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Rekap Penjualan </h2>
            <div class="clearfix"></div>
        </div>
        <div class="">
            <table link=<?php echo base_url() ?> id="bahan" class="table table-striped ">
                <thead>
                    <tr class="headings">
                    	<th>No</th>
                    	<th>Nota</th>
                        <th>Tgl Trans</th>
                        <th>Grand Total</th>
                    </tr>
                </thead>
                <tbody>
                	<?php $no=1; $gtot=0;
                	foreach ($datadb->result() as $row) { ?>
                    <tr class="even pointer">
                    	<td class=" "><?php echo $no?></td>
                        <td class=" "><?php echo $row->nota?></td>
                        <td class=" "><?php echo date('d-F-Y',strtotime($row->tgl))?></td>
                        <td align="center"><?php echo "Rp. ". $row->gtot ?></td>
                    </tr>
                 <?php $no++; $gtot = $gtot+ $row->gtot; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-12 col-xs-12">
	<h2>Total Penjualan</h2>
	<label class="label-primary total"><?php echo "Rp." . $gtot; ?></label>
</div>
</div>
