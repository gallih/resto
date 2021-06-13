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
        <p>Hai <b><?php echo $this->session->userdata('username') ?> ,</b>Selamat datang di halaman Administrator. Silahkan Klik Menu
        Pilihan di Menu bagian Samping untuk mengelola Website</p>
        
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
<?php 
    $mak=0;$mik=0;$makbks=0;$mikbks=0;
    $this->db->where(array('tutup'=>'T' ,'nm_jns'=>'Makanan'));
    foreach ($this->db->get('q_det_pesan')->result() as $row) {
        $mak = $mak + $row->jml;
    }
    $this->db->where(array('tutup'=>'T' ,'nm_jns'=>'Minuman'));
    foreach ($this->db->get('q_det_pesan')->result() as $row) {
        $mik = $mik + $row->jml;
    }
    $this->db->where(array('tutup'=>'T' ,'nm_jns'=>'Makanan'));
    foreach ($this->db->get('q_pesan_bungkus')->result() as $row) {
        $makbks = $makbks + $row->jml;
    }
    $this->db->where(array('tutup'=>'T' ,'nm_jns'=>'Minuman'));
    foreach ($this->db->get('q_pesan_bungkus')->result() as $row) {
        $mikbks = $mikbks + $row->jml;
    }
?>

<div class="row top_tiles">
    <h5><b>Update Transaksi Langsung Hari ini</b></h5>
    <div class="x_panel">
    <a href="<?php echo base_url() ?>adminweb/historypenjualan">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats" style="background:#019875;color:#F7CA18">
            <div class="icon">
            </div>
            <div class="count">Rp <?php echo number_format($gtot); ?></div>
            <h3>&nbsp;</h3>
            <p>Total Transaksi dari <?php echo $no ?> Nota</p>
        </div>
    </div>
    </a>
    <a href="<?php echo base_url() ?>adminweb/viewdetailitem">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats" style="background:#019875;color:#F7CA18">
            <div class="icon"><i  class="fa fa-exchange"></i>
            </div>
            <div class="count" >
                <h4>Item yang Laku : <?php echo $jml  ?></h4>
                <p>Makanan : <?php echo $mak  ?></p>
                <p>Minuman : <?php echo $mik ?></p>

            </div>
            <h3>&nbsp;</h3>
            <p>Lihat detail</p>
        </div>
    </div>
    </a>
    <a href="<?php echo base_url() ?>adminweb/tutupbuku">
    <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="tile-stats" style="background: #2C3E50;color:#fff">
            <div class="icon">
            <i class="fa fa-book"></i>
            </div>
            <div class="count" align="center"> Tutup Buku</div>
            <h3>&nbsp;</h3>
            <p align="center">Tutup Transaksi Hari ini</p>
        </div>
    </div>
    </a>
    </div>
</div>
<div class="row top_tiles">
    <h5><b>Update Transaksi Bawa Pulang (Bungkus) Hari ini</b></h5>
    <div class="x_panel">
    <a href="#">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats" style="background:#19B5FE;color:#F7CA18">
            <div class="icon">
            </div>
            <div class="count">Rp <?php echo number_format($gtotbungkus); ?></div>
            <h3>&nbsp;</h3>
            <p>Total Transaksi Bungkus dari <?php echo $nobungkus ?> Nota</p>
        </div>
    </div>
    </a>
    <a href="<?php echo base_url() ?>adminweb/detailitembungkus">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats"  style="background:#19B5FE;color:#F7CA18">
            <div class="icon"><i class="fa fa-exchange"></i>
            </div>
            <div class="count" >
                <h4>Item yang Laku : <?php echo $jmlbks  ?></h4>
                <p>Makanan : <?php echo $makbks  ?></p>
                <p>Minuman : <?php echo $mikbks ?></p>
            </div>
            <h3>&nbsp;</h3>
            <p>Lihat detail</p>
        </div>
    </div>
    </a>
    <a href="<?php echo base_url() ?>adminweb/eksport_harian">
    <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon">
            <i class="fa fa-download"></i>
            </div>
            <div class="count">Bekup</div>
            <h3>&nbsp;</h3>
            <p>Eksport to excel</p>
        </div>
    </div>
    </a>
    <a href="<?php echo base_url() ?>adminweb/cetakgrandtotal">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon">
            <i class="fa fa-upload"></i>
            </div>
            <div class="count">Info Penjualan</div>
            <h3>&nbsp;</h3>
            <p>Cetak Info penjualan</p>
        </div>
    </div>
    </a>
    </div>
</div>
<div class="row top_tiles">
<h5><b>Menu Utama</b></h5>
    <div class="x_panel">
    <a href="<?php echo base_url() ?>abahanbaku">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats" style="background:#36D7B7;color:#FFF">
            <div class="icon"><i class="fa fa-cubes"></i>
            </div>
            <div class="count">Bahan</div>
            <h3>Bahan Baku</h3>
            <p>Lihat semua Data</p>
        </div>
    </div>
    </a>
    <a href="<?php echo base_url() ?>aitem">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats" style="background:#D35400;color:#fff">
            <div class="icon"><i class="fa fa-comments-o"></i>
            </div>
            <div class="count">Item</div>

            <h3>Data Item</h3>
            <p>Lihat semua Data</p>
        </div>
    </div>
    </a>
    <a href="<?php echo base_url() ?>apesanan">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats" style="background:#4183D7;color:#fff">
            <div class="icon"><i class="fa fa-cutlery"></i>
            </div>
            <div class="count">Pesanan</div>

            <h3>Data Pesanan</h3>
            <p>Lihat semua Data</p>
        </div>
    </div>
    </a>
    <a href="<?php echo base_url() ?>akaryawan">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats" style="background:#EC644B;color:#fff">
            <div class="icon"><i class="fa fa-group"></i>
            </div>
            <div class="count">Karyawan</div>

            <h3>Data Karyawan</h3>
            <p>Lihat semua Data</p>
        </div>
    </div>
    </a>
    <a href="<?php echo base_url() ?>aperusahaan">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-building"></i>
            </div>
            <div class="count">Resto</div>

            <h3>Data Resto</h3>
            <p>Setting Data Resto</p>
        </div>
    </div>
    </a>
    <a href="<?php echo base_url() ?>adminweb/historytrans">
        
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats" style="background:#36D7B7;color:#fff">
            <div class="icon"><i class="fa fa-credit-card"></i>
            </div>
            <div class="count">History</div>

            <h3>&nbsp;</h3>
            <p>History Transaksi</p>
        </div>
    </div>
    </a>
     <a href="<?php echo base_url() ?>ameja/resetstatus">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats" id="red">
            <div class="icon"><i class="fa fa-close"></i>
            </div>
            <div class="count">Reset </div>

            <h3>Reset Status Meja</h3>
            <p>Setting Data Resto</p>
        </div>
    </div>
    </a>
</div>  
</div> 
<hr>
<div class="row top_tiles">
    
</div>