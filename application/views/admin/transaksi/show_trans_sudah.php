<div id="showtrans" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="tutup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 align="center" class="modal-title">Cari Meja Atau Nota </h4>
      </div>
      <div class="modal-body">
      <div class="row">
          <div class="table-responsive">
            <table class="table table-bordered " id="ttrans">
              <thead>
                <td>Nota</td>
                <td>Nama Meja</td>
                <td>Nama Pemesan</td>
                <td>Grand Total</td>
                <td>Pilih</td>
              </thead>
              <tbody>
                <?php foreach ($data->result() as $row) { ?>
                  <tr>
                    <td id="nota"><?php echo $row->nota ?></td>
                    <td><?php echo $row->nm_meja ?></td>
                    <td><?php echo $row->nama ?></td>
                    <td><?php echo $row->gtot ?></td>
                    <td class="last"><a url="<?php echo base_url() ?>adminweb/bacatrans" class="" id="nota<?php echo $row->nota ?>" nota="<?php echo $row->nota ?>">Pilih <i class='fa fa-check-circle'></i></a></td>
                  </tr>
      <script type="text/javascript">
        $('#nota<?php echo $row->nota ?>').click(function () {
            var nota= $(this).attr('nota');
            $('#notrans').text(nota);
            $('#nota').val(nota);
            $('#nama').val('<?php echo $row->nama ?>');
            $('#no_meja').val('<?php echo $row->nm_meja ?>');
            
            $('#tutup').trigger('click');
            var  url = $(this).attr('url');
            $.ajax({
              url : url,
              method:'post',
              data : 'nota='+nota,
              success:function(e){
                
                $('#tmp').html("");
                $('#tmp').html(e);
                var penampungnota = $('#penampung').val();
                $('#total').text(penampungnota);
                $('#bayar').focus();
              }
            })
            $('#pilih').trigger('click');
        })
       </script>
                <?php }?>
              </tbody>
            </table>
          </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->