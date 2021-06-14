<?php $this->load->view('admin/view_navbar') ?>
<body onload="javascript:setTimeout('location.reload(true);',20000);">
<style type="text/css">
    #red{
        background: #2C3E50;
        color: #fff;
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
                type: 'success'
                        });
        })
        </script>

        ";
    }
?>
<div class="row">
    <div class="col-md-12">
        <h3><b>Dashboard</b></h3>        
        
    </div>
</div>
<!-- mentotal transaksi -->
<?php 
    $gtot=0;$no=0;$gtotbungkus=0;$nobungkus=0;
    foreach ($datadb->result() as $row) {
        $gtot = $gtot + $row->gtot;
        $no++;
    } 
    foreach ($databungkus->result() as $row) {
        $gtotbungkus = $gtotbungkus + $row->gtot;
        $nobungkus++;
    } 
?>
<!-- membaca jumlah makanan dan minuman yang keluar -->
<?php
    $jml=0; $jmlbks=0; 
    foreach ($datadetail->result() as $row) {
        $jml = $jml + $row->jml;
    } 
    foreach ($detailbungkus->result() as $row) {
        $jmlbks = $jmlbks + $row->jml;
    } 
?>
<div class="row">
    <a href="<?php echo base_url() ?>adminweb/historypenjualan">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats" style=" ">
            <div class="icon">
            </div>
            <div class="count">Rp <?php echo number_format($gtot); ?></div>
            <h3>&nbsp;</h3>
            <p>Total Transaksi dari <?php echo $no ?> Nota</p>
        </div>
    </div>
    </a>

</div>