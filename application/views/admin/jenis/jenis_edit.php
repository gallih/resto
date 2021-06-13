<?php $this->load->view('admin/view_navbar') ?>
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Jenis Perusahaan</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <?php foreach ($jenis->result() as $jn) { ?>
                <form method="post" action="<?php echo base_url() ?>aitem/simpaneditjenis">
                    <div class="item form-group">
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <input value="<?php echo $jn->kd_jns ?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="4" name="kd_jns"  required="required" type="hidden">
                        </div>
                    </div>  
                    <div class="item form-group">
                        <label class="control-label col-md-6 col-sm-3 col-xs-12" for="name">Nama Jenis Baru</label>
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <input id="name" value="<?php echo $jn->nm_jns ?>" class="form-control col-md-7 col-xs-12" data-validate-words="1" name="nm_jns"  required="required" type="text">
                        </div>
                    </div>
                
            <?php }
            ?>
            </div>
            <div class="x_footer">
            <div class="col-md-12 col-sm-6 col-xs-12">
                <a href="<?php echo base_url() ?>aitem" class="btn btn-default" data-dismiss="modal">Batal</a>
                <button type="submit" type="submit" class="btn btn-success">Update Jenis</button>
            </div>
            </div>  
                </form>
    </div>
</div>
</div>