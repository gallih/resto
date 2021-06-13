<div id="addbahan" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambahkan BahanBaku Baru</h4>
      </div>
      <div class="modal-body">
      <form enctype="multipart/form-data" class="form-horizontal form-label-left" method="post" action="<?php echo base_url() ?>abahanbaku/simpan" novalidate>
      <div class="row">
      <div class="col-md-12">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bahan Baku<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12" placeholder="Nama Bahan Baku" data-validate-length-range="4" name="nm_bhn"  required="required" type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Stok Opname<span class="required">*</span>
                </label>
                 <div class="col-md-2 col-sm-6 col-xs-12">
                    <input style="text-align:right"  class="form-control col-md-2 col-xs-12" name="stok"  required="required" type="tel">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Satuan</span>
                </label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12" data-validate-words="1" name="satuan"  required="required" type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Harga/satuan<span class="required">*</span>
                </label>
                 <div class="col-md-5 col-sm-6 col-xs-12">
                    <input style="text-align:right" class="form-control col-md-2 col-xs-12" name="harga_awal"  required="required" type="tel">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Keterangan<span class="required">*</span>
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <textarea name="ket" class="form-control col-md-7 col-xs-12"></textarea>
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