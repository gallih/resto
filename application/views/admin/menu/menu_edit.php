<?php $this->load->view('admin/view_navbar') ?>
<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-1">
<h3>Edit Menu Utama</h3>
<form class="form-horizontal form-label-left" method="post" action="<?php echo base_url() ?>amenu/simpanutamaedit" novalidate>
<?php foreach ($menu->result() as $row) {?>
    <div class="item form-group">
        <label>Menu Utama</label>
        <input type="hidden" name="id" value="<?php echo $row->id_menu ?>" class="form-control">
        <input type="text" name="nama" value="<?php echo $row->nama ?>" class="form-control">
    </div>
    <div class="item form-group">
        <label>Link Menu</label>
        <input type="text" name="link" value="<?php echo $row->link ?>" class="form-control">
    </div>
    <div class="item form-group">
        <label>Hak Akses</label><br>
        <?php 
            $isi = $row->level;
            $data = explode(',',$isi);
            $panjang = sizeof($data);
         ?>
        <input type="checkbox" <?php if($panjang >=1) {if(trim($data[0]) =='admin') {echo 'checked="checked"' ;}else {echo " ";} }?> name="level[]" value="admin"> Admin&nbsp;&nbsp;&nbsp;
        <input type="checkbox" <?php if($panjang >=2) {if(trim($data[1]) =='kasir') {echo 'checked="checked"' ;}else {echo " ";} }?> name="level[]" value="kasir"> Kasir&nbsp;&nbsp;
        <input type="checkbox" <?php if($panjang >=3) {if(trim($data[2])  =='Chef') {echo 'checked="checked"' ;}else {echo " ";} }?> name="level[]" value="Chef"> Koki
    </div>
    <div class="item form-group">
        <label>Urutan Menu</label>
        <input type="number" value="<?php echo $row->urutan ?>" name="urutan" class="form-control">
    </div>
    <div class="item form-group">
        <label>Aktif</label>&nbsp;&nbsp;&nbsp;
        <input <?php if($row->aktif =='ya') echo 'checked ="checked"' ?> value='ya' type="radio" name="aktif" value="ya" > Ya&nbsp;&nbsp;
        <input <?php if($row->aktif =='tidak') echo 'checked ="checked"' ?> value='tidak' type="radio" name="aktif" value="tidak"> Tidak
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?php echo base_url() ?>amenu" class="btn btn-default">Batal</a>
<?php } ?>
</form> <!-- tutup form -->
</div>