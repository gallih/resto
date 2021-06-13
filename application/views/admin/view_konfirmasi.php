<div class="modal fade" id="<?php echo $id ?>">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><?php echo $title ?></h4>
      </div>
      <div class="modal-body">
        <p><?php echo $content?></p>
        <input type="hidden" id="kriteria">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <a href="<?php echo $link ?>" id="ya" class="btn btn-primary">Ya </a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->