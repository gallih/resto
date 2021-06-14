<?php $this->load->view('admin/view_navbar') ?>
<style type="text/css">
	#blue{
		background: #045ca2;
		border-color: #fff;
		color: #fff;
	}
	#green{
		background: #049a77;
		border-color: #fff;
		color: #fff;	
	}
</style>
<div class="row top_tiles">
<h3 align="center">Hallo <b><?php echo $this->session->userdata('username') ?></b></h3>
<p align="middle">Silahkan pilih Menu Utama Kasir di bawah</p><hr>
<div class="x_panel">
<a href="<?php echo base_url() ?>akasir/transaksi">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats" id="blue">
            <div class="icon"><i class="fa fa-cc-visa"></i>
            </div>
            <div class="count">Bayar</div>

            <h3>&nbsp;</h3>
            <p>Transaksi Langsung</p>
        </div>
    </div>
    </a>
    <a href="<?php echo base_url() ?>akasir/bawapulang">
        
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats" id="green">
            <div class="icon"><i class="fa fa-credit-card"></i>
            </div>
            <div class="count">Bayar</div>

            <h3>&nbsp;</h3>
            <p>Transaksi Bawa Pulang</p>
        </div>
    </div>
    </a>
    <a href="<?php echo base_url() ?>akasir/tambahitem">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats" style="background:#2C3E50;color:#fff">
            <div class="icon"><i class="fa fa-plus"></i>
            </div>
            <div class="count">Request Pesanan Baru</div>
            <h3>&nbsp;</h3>
            <p>Request Pesanan Baru</p>
        </div>
    </div>
    </a>
    <a href="<?php echo base_url() ?>akaryawan/prive">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats" style="background:#1E8BC3;color:#fff">
            <div class="icon"><i class="fa fa-child"></i>
            </div>
            <div class="count">Jatah Pegawai</div>
            <h3>&nbsp;</h3>
            <p>Jatah ini hanya sekali dalam sehari</p>
        </div>
    </div>
    </a>
    </div>
</div>