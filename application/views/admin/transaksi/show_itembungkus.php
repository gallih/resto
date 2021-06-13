<div class="table-responsive">
    <table class="table table-bordered " id="tshow">
      <thead>
        <td>Item</td>
        <td>Jenis</td>
        <td>Harga</td>
        <td></td>
      </thead>
      <tbody>
        <?php foreach ($data->result() as $row) { ?>
          <tr>
            <td><?php echo $row->item?></td>
            <td><?php echo $row->nm_jns ?></td>
            <td align="right"><?php echo "Rp ". $row->harga?></td>
            <td class="last"><a id="pilihe<?php echo $row->kd_item?>" href="#" style="text-decoration:none" class=""><i class='fa fa-check-circle'></i> Pilih</a></td>
          </tr>
          <!-- PEMANGGILAN MODAL -->
          <script type="text/javascript">
              $('#pilihe<?php echo $row->kd_item?>').click(function(){
                var kode = <?php echo $row->kd_item ?>;
                $('#kd_item').val(kode);
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
        <h4 class="modal-title" id="myModalLabel">Pemesanan</h4>
      </div>
      <div class="modal-body">
        <form id="forme<?php echo $row->kd_item ?>" >
        <input type="hidden" name="kd_item" id="kd_item" value="">
          <div class="form-group">
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
        <button url="<?php echo base_url() ?>/akasir/pesanbungkus" id="form<?php echo $row->kd_item ?>" type="button" class="btn btn-success">Pesan Sekarang</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- TUTUP MODAL PEMESANAN -->

<script type="text/javascript">
    $('#form<?php echo $row->kd_item ?>').on('click',function(){

        var url = $(this).attr('url');
        var isidata = 'nota='+$('#nota').text()+'&kd_item='+$('#kd_item').val()+'&jml='+$('#jml').val()+'&ket='+$('#ket').val();
        $.ajax({
          url: url,
          method:'post',
          data: isidata,
          success:function(e){
          $('#jml').val('');$('#ket').val('');
          window.location.reload(true);           
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