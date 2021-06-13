<?php $this->load->view('admin/view_navbar') ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Data User</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
    <form enctype="multipart/form-data" class="form-horizontal form-label-left" method="post" action="<?php echo base_url() ?>auser/simpanedit" novalidate>
    <?php foreach ($datadb->result() as $row) { ?>    
      <div class="row">
      <div class="col-md-7">
            <div class="item form-group">
                <input type="hidden" value="<?php echo $row->Id ?>" name="id">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Username</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input value="<?php echo $row->username ?>" id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="4" name="username"  required="required" type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama Lengkap</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input value="<?php echo $row->nama ?>" id="name" class="form-control col-md-7 col-xs-12" data-validate-words="1" name="nama"  required="required" type="text">
                </div>
            </div>                        
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Telepon<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input value="<?php echo $row->no_telp ?>" id="name" class="form-control col-md-7 col-xs-12" data-validate-words="1" name="no_telp"  required="required" type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Hak Akses</label>
                <div class="col-md-6 col-sm-9 col-xs-12">
                    <select name="level" class="form-control">
                        <option <?php if($row->level == 'Admin') echo 'selected="selected"' ?>>Admin</option>
                        <option <?php if($row->level == 'Kasir') echo 'selected="selected"' ?>>Kasir</option>
                        <option <?php if($row->level == 'Chef') echo 'selected="selected"' ?>>Chef</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2">
          <div class="item form-group">
                <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Foto</label>
                <br>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <?php 
                    $asal = FCPATH.'asset/images/user/'.$row->username.".jpg";
                    if(file_exists($asal)){
                        $alamat = base_url().'asset/images/user/'.$row->username.".jpg";
                    }else{
                        $alamat = base_url().'asset/images/user/no-image.jpg';
                    }

                ?>
                    <img id="imgnya" src="<?php echo $alamat ?>" width="250px" class="img-bordered">
                    <input id="imgdata" accept="image/*" type="file" name="userfile">
                </div>
            </div>
        </div>
        </div>
      </div>
      </div>
      <div class="x_footer pull-right">
        <a href="<?php echo base_url() ?>auser" class="btn btn-default" data-dismiss="modal">Batal</a>
        <button type="submit" class="btn btn-success">Update Data</button>
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