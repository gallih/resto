<div class="table-responsive">
    <table class="table table-bordered " id="tshow">
      <thead>
        <td>Item</td>
        <td>Jenis</td>
        <td>Harga</td>
        <td>Promo</td>
        <td align="center">Pilih</td>
      </thead>
      <tbody>
        <?php foreach ($data->result() as $row) {
          $hrgdiskon=$row->harga -($row->harga*$row->promo/100);
        ?>
          <tr>
            <td><?php echo $row->item?></td>
            <td><?php echo $row->nm_jns ?></td>
            <td align="center"><?php echo $row->promo ?>%</td>
            <td align="right"><?php echo "Rp ". $hrgdiskon ;?></td>
            <td align="center"><a url="<?php echo base_url() ?>" id="pilihe<?php echo $row->kd_item?>" href="#" style="text-decoration:none" class=""><i class='fa fa-check-circle'></i></a></td>
          </tr>
          <!-- PEMANGGILAN MODAL -->
          <script type="text/javascript">
              $('#pilihe<?php echo $row->kd_item?>').click(function(){
                var kode = <?php echo $row->kd_item ?>;
                var item = '<?php echo $row->item ?>';
                var isi;
                $('#kd_item').val(kode);
                var pilihan = '<?php echo $row->pilihan ?>';
                if(pilihan =='Y'){
                  $('#h').html('');
                  <?php 
                    $baca = $this->db->get_where('q_item',array('kd_item' => $row->kd_item ));
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
                  //isi ="<label>Rasa</label><select name='rasa' class='form-control'><option>Pedas</option><option>Manis</option><option>Asin</option></select>";
                }else{
                  $('#h').html('');
                }
                $('#h').append(isi);

                var sumber  = $(this).attr('url') + '/asset//images//item//'+kode+'.jpg';
                var tidak  = $(this).attr('url') + '//asset//images//item//no-image.jpg';
                
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

                $('label[name=item]').text(item);

                $('#myModal').modal('show');
              });
          </script>
          <!-- // AKHIR PEMANGGILAN -->

<!-- MODAL PEMESANAN -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Pemesanan</h4>
      </div>
      <div class="modal-body">
        <form id="forme<?php echo $row->kd_item ?>" >
        <input type="hidden" name="kd_item" id="kd_item" value="">
          <div class="form-group">
          <label>Item Yang dipesan</label>
          <label class="label" style="background:#ccc;color:#478D06;display:block;text-align:center;font-size:20pt" name='item'></label>
          <div id='h'>Halo</div>
          <img class="img-responsive" id="img" src="">
            <label>Jumlah Pesanan</label>
            <input autofocus type="tel" class="form-control" id="jml" name="jml" placeholder="Masukkan Jumlah porsi">
          </div>
          <div class="form-group">
            <label>Keterangan tambahan</label>
            <input type="text" class="form-control" id="ket" name="ket" placeholder="">
          </div>
      </div>
      <div class="modal-footer">
        <button id="hilang" type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
        <button url="<?php echo base_url() ?>/akasir/simpantambahitem" id="form<?php echo $row->kd_item ?>" type="button" class="btn btn-success">Pesan Sekarang</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- TUTUP MODAL PEMESANAN -->

<script type="text/javascript">
    $('#form<?php echo $row->kd_item ?>').on('click',function(){

        var url = $(this).attr('url');
        var isidata = 'nota='+$('#notrans').text()+'&kd_item='+$('#kd_item').val()+'&jml='+$('#jml').val()+'&ket='+$('#ket').val()+'&rasa='+$('select[name=rasa]').val();
        $.ajax({
          url: url,
          method:'post',
          data: isidata,
          success:function(e){
            if(e == 'ok'){
              $('#myModal').modal('hide');
               var  url = "<?php echo base_url() ?>"+"adminweb/bacatrans";
                $.ajax({
                    url : url,
                    method:'post',
                    data : 'nota='+$('#notrans').text(),
                    success:function(e){
                      $('#tmp').html(e);
                    }
                })
            }
          }
        })
      })
</script>
        <?php }?> <!-- TUTUP PEMBACAAN TABEL ITEM -->
      </tbody>
    </table>
  </div>
<script type="text/javascript">
  $(document).ready(function(){
        var ttrans = $('#tshow').dataTable({
                    "oLanguage": {
                        "sSearch": "Cari disini"
                    },
                   
        });
    })
</script>