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
        $('#sudah').DataTable({
            "sPaginationType": "full_numbers",
        });
        $('#belum').DataTable({
            "sPaginationType": "full_numbers",
        });
    });
</script>

<div class="row">
<h3 align="center"><i class="fa fa-caret-right"></i> History Pemesanan <b class="label-warning" style="color:#fff">Langsung</b> Hari ini</h3>
<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title" style="background:#a0364f;color:#fff">
            <h2 align="center">PESANAN TRANSAKSI <span style="color:#000"><b>PENDING</b></span></h2>
            <div class="clearfix"></div>
        </div>
        <div class="">
            <table link=<?php echo base_url() ?> id="belum" class="table table-striped ">
                <thead>
                    <tr class="headings">
                    	<th>No</th>
                    	<th>Nota</th>
                    	<th>Nama Pemesan</th>
                        <th>No Meja</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                    </tr>
                </thead>
                <tbody>
                	<?php $no=1; $gtot=0;
                	foreach ($pesanbelum->result() as $row) { ?>
                    <tr class="even pointer">
                    	<td class=" "><?php echo $no?></td>
                        <td class=" "><?php echo $row->nota?></td>
                        <td class=" "><?php echo $row->nama?></td>
                        <td class=" "><?php echo $row->nm_meja?></td>
                        <td class=" "><?php echo date('d-F-Y',strtotime($row->tgl))?></td>
                        <td class=" "><?php echo $row->jam?></td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title" style="background:#1d916c;color:#fff">
            <h2 align="center">PESANAN TRANSAKSI <span style="color:#a0364f"><b>SUDAH DIANTAR</b></span></h2>
            <div class="clearfix"></div>
        </div>
        <div class="">
            <table link=<?php echo base_url() ?> id="sudah" class="table table-striped ">
                <thead>
                    <tr class="headings">
                    	<th>No</th>
                    	<th>Nota</th>
                    	<th>Nama Pemesan</th>
                        <th>No Meja</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                    </tr>
                </thead>
                <tbody>
                	<?php $no=1; $gtot=0;
                	foreach ($pesansudah->result() as $row) { ?>
                    <tr class="even pointer">
                    	<td class=" "><?php echo $no?></td>
                        <td class=" "><?php echo $row->nota?></td>
                        <td class=" "><?php echo $row->nama?></td>
                        <td class=" "><?php echo $row->nm_meja?></td>
                        <td class=" "><?php echo date('d-F-Y',strtotime($row->tgl))?></td>
                        <td class=" "><?php echo $row->jam?></td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>