<?php $this->load->view('front/header_ui') ?>  
<script type="text/javascript">
  $(function(){
    // var url = "http//www.google.com";
    // window.setTimeout(function(){
    //   location.href = '<?php echo base_url() ?>';
    // },5000)
    // setTimeout('location.reload(true);',1000);
    // setTimeout('<?php redirect("user_home") ?>;',5000);
  })
</script>
<style>
  body{
    background-color: #2F6DAB;
    color: white;
  }
  #back{
    background-image: url('../asset/images/piring.png');
  }
</style>
  <div class="col-md-4 col-sm-12 col-xs-12 col-md-offset-4" align="center">
    <h2 align="center">Terima Kasih Atas Pemesanan Anda</h2>
    <h4 align="center">Silahkan Menunggu Pesanan Anda sedang diproses</h4>
    <p>Hubungi Kasir untuk Penambahan Jumlah Pemesanan</p>
    <img class="img-responsive" src="<?php echo base_url() ?>asset/images/smile.png"><br>
    <a class="btn btn-warning" href="<?php echo base_url() ?>">Pesan Kembali</a>
  </div>