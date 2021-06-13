<style type="text/css">
 
  #s_meja p{
    background: #333333; 
    padding: 10px;
    border-top: solid thick;
  }
  #s_meja p a{
    text-decoration: none;
    color: #fff;
  }
  #lantai{
    padding: 10px;
  }
</style>
<script type="text/javascript">
  
</script>
<div id="showmeja" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pilih Meja </h4>
      </div>
      <div class="modal-body">
      <div class="row">
          <?php foreach ($datadb->result() as $row) { ?>
           <div class="col-md-3 col-xs-4 " id="s_meja">
              <p style="<?php if($row->sts =='kosong'){ echo 'background:#c53e3e';}  ?>"><a id="idne<?php echo $row->id_meja ?>"  href="#" mejane="<?php echo $row->nm_meja ?>"><?php echo $row->nm_meja ?></a></p>
           </div>
           <script type="text/javascript">
              $(function(){
                $('#idne<?php echo $row->id_meja ?>').on('click',function(){
                  var mejane = $(this).attr('mejane');
                  $('#nomormeja').text(mejane);
                  $('#id_meja').val(mejane);
                  $('#showmeja').modal('hide');

                  //mengirim ke controller customer
                  $.ajax({
                    url : '<?php echo base_url() ?>acustomer/bacameja',
                    method :'post',
                    data : 'no_meja='+mejane,
                    success:function(e){
                      if(e != ""){
                        window.location.href = e;
                      }
                    }
                  })
                })
              })
          </script>
          <?php } ?>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->