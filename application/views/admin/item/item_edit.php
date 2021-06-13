<?php $this->load->view('admin/view_navbar') ?>
<script type="text/javascript">    
$(function(){
    fungsi();
})
    function fungsi(){
        var itemjadi = $('select[name=item_jadi]');
        
        if(itemjadi.val() == 'Ya'){
            document.getElementById('stok').disabled = false;
        }else{
            document.getElementById('stok').disabled = true;
            document.getElementById('stok').value = '0';
        }
    }
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Item</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <p>* Keterangan : Penginputan Rasa pisahkan dengan Koma</p>
                <br />
    <form enctype="multipart/form-data" class="form-horizontal form-label-left" method="post" action="<?php echo base_url() ?>aitem/simpanedit" novalidate>
    <?php foreach ($datadb->result() as $row) { ?>    
      <div class="row">
      <div class="col-md-7">
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" value="<?php echo $row->kd_item ?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="4" name="kd_item"  ="" type="hidden">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama Item<span class="">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" value="<?php echo $row->item ?>" class="form-control col-md-7 col-xs-12" data-validate-words="1" name="item"  ="" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Item</label>
                <div name="jabat" class="col-md-4 col-sm-9 col-xs-12">
                    <select name="kd_jenis" class="form-control">
                        <?php 
                            foreach ($jenis->result() as $key ) {
                                if($row->nm_jns == $key->nm_jns)
                                {
                                    echo "<option value='$key->kd_jns' selected='selected'>$row->nm_jns</option>";
                                }
                                else{
                                    echo "<option value='$key->kd_jns' >$key->nm_jns</option>";   
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Item Sachet
                </label>
               <div name="jabat" class="col-md-6 col-sm-9 col-xs-12">
               <select onchange="fungsi()" name="item_jadi" class="form-control">
                        <option <?php if($row->item_jadi =='Ya') echo "selected='selected'"; ?>>Ya</option>
                        <option <?php if($row->item_jadi =='Tidak') echo "selected='selected'"; ?>>Tidak</option>
                </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Rasa
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12" value="<?php echo $row->rasa?>" name="rasa"  type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Harga<span class="">*</span>
                </label>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <input style="text-align:right" value="<?php echo $row->harga ?>" class="form-control col-md-7 col-xs-12" data-validate-words="1" name="harga"  type="text">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Stok<span class="">*</span>
                </label>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12" align="right" id="stok" name="stok" value="<?php echo $row->stok ?>" type="tel">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Diskon<span class="">*</span>
                </label>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12" name="promo" value="<?php echo $row->promo ?>" type="tel">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Populer<span class="">*</span>
                </label>
                <div name="populer" class="col-md-2 col-sm-9 col-xs-12">
                    <select name="populer" class="form-control">
                        <option <?php if($row->populer =='Y') echo "selected='selected'"; ?>>Ya</option>
                        <option <?php if($row->populer =='T') echo "selected='selected'"; ?>>Tidak</option>
                    </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Persediaan<span class="">*</span>
                </label>
                <div name="sts" class="col-md-2 col-sm-9 col-xs-12">
                    <select name="sts" class="form-control">
                        <option <?php if($row->sts =='ada') echo "selected='selected'"; ?>>ada</option>
                        <option <?php if($row->sts =='Tidak') echo "selected='selected'"; ?>>Tidak</option>
                    </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Menu Pilihan<span class="">*</span>
                </label>
                <div name="sts" class="col-md-2 col-sm-9 col-xs-12">
                    <select name="pilihan" class="form-control">
                        <option <?php if($row->pilihan =='Y') echo "selected='selected'"; ?>>Ya</option>
                        <option <?php if($row->pilihan =='T') echo "selected='selected'"; ?>>Tidak</option>
                    </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Keterangan<span class="">*</span>
                </label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <textarea name="ket" class="form-control col-md-7 col-xs-12"><?php echo $row->ket ?></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-4">
          <div class="item form-group">
                <label>Gambar</label>
                <br>
                <div>
                 <?php 
                    $asal = FCPATH.'asset/images/item/'.$row->kd_item.".jpg";
                    if(file_exists($asal)){
                        $alamat = base_url().'asset/images/item/'.$row->kd_item.".jpg";
                    }else{
                        $alamat = base_url().'asset/images/item/no-image.jpg';
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
        <a href="<?php echo base_url() ?>aitem" class="btn btn-default" data-dismiss="modal">Batal</a>
        <button type="submit" class="btn btn-success">Simpan</button>

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