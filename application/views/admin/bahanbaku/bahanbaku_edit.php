<?php $this->load->view('admin/view_navbar') ?>
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-2">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit BahanBaku</h2>
                <div class="clearfix"></div>
            </div>
    <div class="x_content">
                <br />
        <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url() ?>abahanbaku/simpanedit" novalidate>
        <?php foreach ($datadb->result() as $row) { ?>    
            <div class="item form-group">
                <input type="hidden" value="<?php echo $row->kd_bahan ?>" name="kd_bahan">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bahan Baku<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input value="<?php echo $row->nm_bhn ?>" class="form-control col-md-7 col-xs-12" placeholder="Nama Bahan Baku" data-validate-length-range="4" name="nm_bhn"  required="required" type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-12 col-xs-12" for="name">Harga</span>
                </label>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <input value="<?php echo $row->harga_awal ?>" style="text-align:right" class="form-control col-md-7 col-xs-12" name="harga"  required="required" type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Satuan</span>
                </label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <input value="<?php echo $row->satuan ?>" class="form-control col-md-7 col-xs-12" data-validate-words="1" name="satuan"  required="required" type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Keterangan<span class="required">*</span>
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <textarea name="ket" class="form-control col-md-7 col-xs-12"><?php echo $row->ket ?></textarea>
                </div>
            </div>
      </div>

      <div class="x_footer pull-right">
        <a href="<?php echo base_url() ?>abahanbaku" class="btn btn-default" data-dismiss="modal">Batal</a>
        <button type="submit" class="btn btn-success">Update</button>
      </div>

      
        </div>
    <?php }?>
      </form> 
    </div>
</div>
<script type="text/javascript">
$(function(){
    $('input[type=file]').bootstrapFileInput();
    var myid, myfile;
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#imgnya').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }               
    $("#imgdata").change(function(e){
        var files = e.originalEvent.target.files;
        for (var i=0, len=files.length; i<len; i++){
            var n = files[i].name,
                    s = files[i].size,
                    t = files[i].type;
            readURL(this);
        }           
        $('#imgnya').attr('src',img);
    });
})
    
</script>