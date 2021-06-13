<?php $this->load->view('admin/view_navbar') ?>
<div class="row jumbotron">
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
<form method="post" action="<?php echo base_url() ?>abahanbaku/filterhis">
    <div class="row">
        <h3>Pencarian data</h3>
    </div>
    <div class="row">
    <div class="col-md-2 col-sm-12 col-xs-12">
        <label>Nama Bahan</label>
        <select name="bahan" class="form-control">
        <?php 
            $query = $this->db->get('tb_bahanbaku');
            foreach ($query->result() as $brs){
                echo "<option value=$brs->kd_bahan>$brs->nm_bhn</option>";
            }
         ?>
            <option></option>
        </select>        
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
        <label>Filter Tanggal</label>
            <input type="text" id="daterange" name="daterange" class="form-control" placeholder="Masukkan Range Tanggal" />
            <button type="submit" id="cari" class="btn btn-success pull-right">Cari</button>
            <a href="<?php echo base_url() ?>abahanbaku/view_his" class="btn btn-primary pull-right">Refersh</a>
    </div>  
    </div>

</form>
</div><br>
<div class="row">
<div class="col-md-8 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>History Bahan </h2>
            <div class="clearfix"></div>
        </div>
        <div class="">
            <table link=<?php echo base_url() ?> id="bahan" class="table table-striped ">
                <thead>
                    <tr class="headings">
                    	<th>No.</th>
                        <th>Nama Bahan</th>
                        <th>Tanggal</th>
                        <th>Stok Masuk</th>
                        <th>Stok Keluar</th>
                    </tr>
                </thead>

                <tbody>
                <?php $no=1;$stkmsk=0;$stkklr=0;
                foreach ($datadb->result() as $row) { ?>
                    <tr class="even pointer">
                    	<td class=" "><?php echo $no?></td>
                        <td class=" "><?php echo $row->nm_bhn?></td>
                        <td class=" "><?php echo date('d-F-Y',strtotime($row->tgl))?></td>
                        <td align="center"><?php echo $row->stok_msk ?></td>
                        <td align="center"><?php echo $row->stok_klr ?></td>
                    </tr>
                 <?php 
                    $no++;
                    $stkmsk = $stkmsk +$row->stok_msk;
                    $stkklr = $stkklr +$row->stok_klr;
                }
                 ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-12 col-xs-12">
<div class="x_panel">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <h3 class="label-warning" style="color:#fff;" align="center">Stok Masuk</h3>
        <h1 align="center"><?php echo $stkmsk ?></h1>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <h3 class="label-primary" style="color:#fff;" align="center">Stok Keluar</h3>
        <h1 align="center"><?php echo $stkklr ?></h1>
    </div>
</div>
</div>
</div>
</div>