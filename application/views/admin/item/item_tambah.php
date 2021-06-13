<script type="text/javascript">    
    function fungsi(){
        var itemjadi = $('select[name=item_jadi]');
        if(itemjadi.val() == 'Ya'){
            document.getElementById('stok').disabled = false;
        }else{
            document.getElementById('stok').disabled = true;
        }
    }
</script>
<div id="additem" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambahkan Item Baru</h4>
      </div>
      <div class="modal-body">
      <form enctype="multipart/form-data" class="form-horizontal form-label-left" method="post" action="<?php echo base_url() ?>aitem/simpan" novalidate>
      <div class="row">
      <p>* Keterangan : Penginputan Rasa pisahkan dengan Koma</p>
      <div class="col-md-6">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama Item
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12" name="item"  type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Jenis Item
                </label>
               <div name="jabat" class="col-md-6 col-sm-9 col-xs-12">
               <select name="kd_jenis" class="form-control">
               <?php 
                    $jenis = $this->db->get('tb_jenis');
                    foreach ($jenis->result() as $row) {
               ?>
                    <option value="<?php echo $row->kd_jns ?>"><?php echo $row->nm_jns ?></option>
                <?php }?>
                </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Item Sachet
                </label>
               <div name="jabat" class="col-md-6 col-sm-9 col-xs-12">
               <select onchange="fungsi()" name="item_jadi" class="form-control">
                    <option>Ya</option>
                    <option>Tidak</option>
                </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Rasa
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12" name="rasa"  type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Harga
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input style="text-align:right" class="form-control col-md-7 col-xs-12" data-validate-words="1" name="harga"  ="" type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Stok
                </label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12 " id="stok" name="stok" type="tel">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Diskon
                </label>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12" name="promo" type="tel">
                </div>
                
            </div>
             <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Populer
                </label>
                <div name="populer" class="col-md-6 col-sm-9 col-xs-12">
                    <select name="populer" class="form-control">
                        <option>Ya</option>
                        <option>Tidak</option>
                    </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Persediaan
                </label>
                <div name="populer" class="col-md-6 col-sm-9 col-xs-12">
                    <select name="sts" class="form-control">
                        <option>ada</option>
                        <option>Tidak</option>
                    </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mn Pilihan
                </label>
                <div name="sts" class="col-md-6 col-sm-9 col-xs-12">
                    <select name="pilihan" class="form-control">
                        <option>Ya</option>
                        <option>Tidak</option>
                    </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Keterangan
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <textarea name="ket" class="form-control col-md-7 col-xs-12"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-4">
          <div class="item form-group">
                <label>Gambar</label>
                <br>
                <div>
                    <img id="imgnya"  src="<?php echo base_url() ?>asset/images/item/no-image.jpg" width="250px" class="img-bordered">
                    <input id="imgdata" accept="image/*" type="file" name="userfile">
                </div>
            </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Tambahkan Baru </button>
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
            .on('blur', 'input[], input.optional, select.', validator.checkField)
            .on('change', 'select.', validator.checkField)
            .on('keypress', 'input[][pattern]', validator.keypress);

        $('.multi.')
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