<?php $this->load->view('front/view_navbar') ?>
<style type="text/css">
  h3{
    margin-top: 0;
    margin-bottom: 0;
    padding: 5px;
  }
</style>
<div class="container">
<div class="row">
<?php foreach ($datafood as $baris) {?>
<div class="col-md-3 col-sm-4 col-xs-6">
	<div class="panel-heading">
		<h3 align="center" style="color:#C53E3E"><b><?= strtoupper($baris->item) ?></b></h3>
	</div>
	<div class="panel panel-default">
		<div class="panel-body" style="position:relative">
     <?php 
          $asal = FCPATH.'asset/images/item/'.$baris->kd_item.".jpg";
          if(file_exists($asal)){
              $alamat = base_url().'asset/images/item/'.$baris->kd_item.".jpg";
          }else{
              $alamat = base_url().'asset/images/item/no-image.jpg';
          }
      ?>
      <?php if($baris->promo >0) { ?>
      <div> 
      <img src="<?= base_url() ?>asset/images/diskon.png" style="position:absolute;top:-4%;left:-4%" width="22%">
      <h5 style="position:absolute;left:1%;top:-1%;color:yellow;font-size:14pt;"><b><?= ($baris->promo >0) ??  $baris->promo ?>%</b></h5>
      </div>
      <?php }?>
      <div class="promo" style="position:absolute;bottom:35%;left:0;display:<?= ($baris->promo ==0) ?? "none"; ?>"> 
        <div style="background:#373327;padding:1px;color:white;border-radius: 0px 7px 0px 0px;
">
          <h4><b style="text-decoration: line-through;"><?= "Rp ".number_format($baris->harga) ?></b></h4>
        </div>
      </div>
       <div class="harga" style="position:absolute;right:0;bottom:35%"> 
        <div style="width:auto;display:block;background:#C53E3E;color:white;border-radius: 7px 0px 0px 0px;">
        <h3><?= $hrgdiskon=$baris->harga -($baris->harga*$baris->promo/100);  "Rp ". number_format($hrgdiskon); ?></h3>
        </div>
      </div>

      <div>
			   <img src="<?= $alamat ?>" height="200px" width="100%">
      </div>

			<p>&nbsp;<?= $baris->ket ?></p>
		</div> <!-- tutup body -->
		<div class="panel-footer" style="background: #fff;">
			<button type="button" pil = <?= $baris->pilihan ?> url="<?= base_url() ?>" meja="<?= $baris->kd_item ?>" item = "<?= $baris->item ?>" id="pesan<?= $baris->kd_item ?>" style="background:#373327;color:#fff"  class="btn btn-block" >Pilih </button>
	  </div> <!-- tutup footer -->
</div> <!-- tutup panel -->
</div>
<script type="text/javascript">

$(function(){
  $('#pesan<?= $baris->kd_item ?>').on('click',function(){
    var kode = $(this).attr('meja');
    var item = $(this).attr('item');
    var pilihan = $(this).attr('pil');
    var sumber  = $(this).attr('url') + '/asset//images//item//'+kode+'.jpg';
    var tidak  = $(this).attr('url') + '//asset//images//item//no-image.jpg';
    var isi;

    // MENAMPILKAN GAMBAR DARI JAVASCRIPT
    $.ajax({
      url :sumber,
      type:'HEAD',
      error:function(){
        $('#img').attr('src',tidak); 
      },
      success :function(){
       $('#img').attr('src',sumber);
      }
    })
    // BATAS --------------------------

    $('#kd_item').val(kode);
    if(pilihan =='Y'){
      $('#h').html('');
      <?php 
        $baca = $this->db->get_where('q_item',array('kd_item' => $baris->kd_item ));
        foreach ($baca->result() as $brs) {
        $rasane = explode(',', $brs->rasa);
        $pjg = sizeof($rasane);
        $tes ='';$rs ='rasa';$kls='form-control';
        for ($i=0; $i < $pjg; $i++) { 
          $tes = $tes . "<option>$rasane[$i]</option>";
        }
        echo 'isi ="<label>Rasa</label><select name='.$rs.' class='.$kls.'>'.$tes.'</select>"';
        
        
      } 
      ?>
    }else{
      $('#h').html('');
    }
    $('#h').append(isi);
    $('label[name=item]').text(item);

    $('#myModal').modal('show');
  })
})
  $('#food').addClass('active');
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pemesanan Item</h4>
      </div>
      <div class="modal-body">
        <form id="forme<?= $baris->kd_item ?>" >
        <input type="hidden" name="kd_item" id="kd_item" value="<?= $baris->kd_item ?>">
         <label>Item yang dipesan :</label><br>
         <label class="label" style="background:#333333;color:#fff;display:block;text-align:center;font-size:20pt" name='item'></label>
         <div class="form-group">
          <div id='h'>Halo</div>
         </div>
         <div class="form-group">
          <img class="img" src="" id="img">
        </div>
          <div class="form-group">
            <label>Jumlah Pesanan</label>
            <input required="" autofocus type="tel" class="form-control" name="jml" placeholder="Masukkan Jumlah porsi">
          </div>
          <div class="form-group">
            <label>Keterangan tambahan</label>
            <input type="text" class="form-control" name="ket" placeholder="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
        <button url="<?= base_url() ?>/acustomer/pemesanan" id="form<?= $baris->kd_item ?>" type="submit" style="background:#C53E3E;color:#fff" class="btn">Pesan Sekarang</button>
      </div>
        </form>
    </div>
  </div>
</div>

<!-- menyimpan ke tabel pemesanan -->
<script type="text/javascript">
  $(function(){
    $('#form<?= $baris->kd_item ?>').on('click',function(e){
        var jml = $('input[name=jml]').val();
        var url = $(this).attr('url');
        var isidata = $('#forme<?= $baris->kd_item ?>').serialize();
        if(jml ==0 || jml < 0){
          alert('Masukkan Jumlah ');
        }else{
          $.ajax({
            url: url,
            method:'post',
            data: isidata,
            success:function(e){
              if(e =='ok'){
                $(this).modal('hide');
                document.location.reload(true);
              }
            },
            error:function(msg){
              document.location.reload(true);
              return false;
            }
          })
        }

        e.preventDefault();
    })
  })
</script>
<?php }?>
</div>
  <?= $halaman ?>
</div> <!-- tutup container -->