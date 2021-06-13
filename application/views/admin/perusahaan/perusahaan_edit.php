<?php $this->load->view('admin/view_navbar') ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Identitas Resto</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
    <form enctype="multipart/form-data" class="form-horizontal form-label-left" method="post" action="<?php echo base_url() ?>aperusahaan/simpanedit" novalidate>
    <?php foreach ($datadb->result() as $row) { ?>    
      <div class="row">
      <div class="col-md-5">
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" value="<?php echo $row->id ?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="4" name="id"  required="required" type="hidden">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" value="<?php echo $row->nama ?>" class="form-control col-md-7 col-xs-12" data-validate-words="1" name="nama"  required="required" type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Alamat<span class="required">*</span>
                </label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <textarea name="almt" class="form-control col-md-7 col-xs-12"><?php echo $row->almt ?></textarea>
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kota<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" value="<?php echo $row->kota ?>" class="form-control col-md-7 col-xs-12" data-validate-words="1" name="kota"  required="required" type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Telepon<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" value="<?php echo $row->telp ?>" class="form-control col-md-7 col-xs-12" data-validate-words="1" name="telp"  required="required" type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Keterangan</span>
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <textarea id="name" rows="5" class="form-control col-md-7 col-xs-12" data-validate-words="1" name="ket"  required="required" type="text"><?php echo $row->ket ?></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-4">
          <div class="item form-group">
                <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Logo</label>
                <br>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php 
                        $asal = FCPATH.'asset/images/logo.jpg';
                        if(file_exists($asal)){
                            $alamat = base_url().'asset/images/logo.jpg';
                        }else{
                            $alamat = base_url().'asset/images/item/no-logo.jpg';
                        }
                    ?>
                    <img id="imgnya" src="<?php echo $alamat ?>" width="200px" height="200px" class="img-bordered">
                    <input id="imgdata" accept="image/*" type="file" name="userfile">
                </div>
            </div>
        </div>
      </div>
      </div>
      <div class="x_footer pull-right">
        <a href="<?php echo base_url() ?>aperusahaan" class="btn btn-default" data-dismiss="modal">Close</a>
        <button type="submit" class="btn btn-success">Update Pengaturan</button>
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