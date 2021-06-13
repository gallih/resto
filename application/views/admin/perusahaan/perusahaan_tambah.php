<div id="addperusahaan" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Identitas Baru Resto</h4>
        
      </div>
      <div class="modal-body">
      <form enctype="multipart/form-data" class="form-horizontal form-label-left" method="post" action="<?php echo base_url() ?>aperusahaan/simpan" novalidate>
      <div class="row">
      <div class="col-md-6">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-words="1" name="nama"  required="required" type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Alamat<span class="required">*</span>
                </label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <textarea name="almt" class="form-control col-md-7 col-xs-12"></textarea>
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kota<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12" data-validate-words="1" name="kota"  required="required" type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Telepon<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-words="1" name="telp"  required="required" type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Keterangan</span>
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <textarea rows="5" id="name" class="form-control col-md-7 col-xs-12" data-validate-words="1" name="ket"  required="required" type="text"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-4">
          <div class="item form-group">
                <label class="">Logo</label>
                <i class='fa fa-exclamation-circle'></i><small> Ukuran gambar 400px X 100px</small>
                <br>
                <div class="">
                    <img id="imgnya" src="<?php echo base_url() ?>asset/images/no-logo.jpg" width="400px" height="100px" class="img-bordered">
                    <input id="imgdata" accept="image/*" type="file" name="userfile">
                </div>
            </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
        </form> <!-- tutup form -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
<script>
        // initialize the validator function
        validator.message['date'] = 'not a real date';

        // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
        $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

        $('.multi.required')
            .on('keyup blur', 'input', function () {
                validator.checkField.apply($(this).siblings().last()[0]);
            });

        // bind the validation to the form submit event
        //$('#send').click('submit');//.prop('disabled', true);

        $('form').submit(function (e) {
            e.preventDefault();
            var submit = true;
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();
            return false;
        });

        /* FOR DEMO ONLY */
        $('#vfields').change(function () {
            $('form').toggleClass('mode2');
        }).prop('checked', false);

        $('#alerts').change(function () {
            validator.defaults.alerts = (this.checked) ? false : true;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
    </script>