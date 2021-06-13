<style type="text/css">
  #dapur .modal-header{
    border-radius: 0;
    background: #C53E3E;
    color: #fff;
  }
</style>
<div class="modal fade" id="dapur">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Login Devisi Dapur</h4>
      </div>
      <div class="modal-body">
         <form method="post" action="<?php echo base_url()?>adminweb/masuk" >
            <div class="form-group">
            <label>Divisi Dapur</label>
              <select name="divisi" class="form-control">
                  <option>Makanan</option>
                  <option>Minuman</option>
              </select>
            </div>
            <div class="form-group">
                <label>Nama User</label>
                <input name="username" autofocus type="text" size="5" class="form-control" placeholder="Masukkan Nama User" required="" />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input name="pass" type="password" class="form-control" placeholder="Masukkan Kata Sandi" required="" />
            </div>
            <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="submit" style="background: #333333;color:#fff" class="btn">Masuk <i class="fa fa-share-square"></i></button>
      </div>
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
  $(function(){

  })
</script>
