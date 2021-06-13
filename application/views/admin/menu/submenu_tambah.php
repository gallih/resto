<div id="addsub" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Sub Menu Baru</h4>
      </div>
      <div class="modal-body">
      <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url() ?>amenu/simpansub" novalidate>
            <div class="item form-group">
                <label>Menu Utama</label>
                <select name="id_menu" class="form-control">
                  <?php foreach ($menu->result() as $row) { ?>
                    <option value="<?php echo $row->id_menu ?>"><?php echo $row->nama ?></option>
                  <?php }?>
                </select>
            </div>
            <div class="item form-group">
                <label>Nama Sub Menu</label>
                <input type="text" name="menu_sub" class="form-control">
            </div>
            <div class="item form-group">
                <label>Link</label>
                <input type="text" name="link" class="form-control">
            </div>
            <div class="item form-group">
                <label>Hak Akses</label><br>
                <input type="checkbox" name="level[]" value="admin"> Admin&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="level[]" value="kasir"> Kasir&nbsp;&nbsp;
                <input type="checkbox" name="level[]" value="Chef"> Koki
            </div>
            <div class="item form-group">
                <label>Urutan Menu</label>
                <input type="number" name="urutan" class="form-control">
            </div>
            <div class="item form-group">
                <label>Aktif</label>&nbsp;&nbsp;&nbsp;
                <input type="radio" name="aktif" value="ya" > Ya&nbsp;&nbsp;
                <input type="radio" name="aktif" value="tidak"> Tidak
            </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
        </form> <!-- tutup form -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>