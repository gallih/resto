<?php $this->load->view('front/view_navbar') ?>
<?php 
    $status = $this->session->userdata('sts'); 
    $hide = ($status =='tambah') ? 'hide' : '' ;
?>
<script type="text/javascript">
    $('#pesanan').addClass('active');
</script>
<style type="text/css">
    .meja{
        padding: 9px;
        color: #fff;
    }
    .harga{
        padding: 15px;
        color: #fff;
        font-size: 20pt;
    }
    #panel{
        margin-top: 3%;
    }
    #pesan{
        background: #09f;
        padding: 7px;
        text-decoration: none;
        margin-top: 2.5%;
    }
    #pesan a{
        color: #fff;
        text-decoration: none;
    }
    .label-default{
        background: #41A793;
    }
    .label-default a{
        color: #fff;
        text-decoration: none;
    }
   
</style>
<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
      <div class="col-md-3">
        <h3 align="center">
            <b>Data Pesanan</b>
        </h3>
      </div>
      <div class="col-md-9 col-xs-12">
        <div class="col-md-6">
          <h3 align="center"><font size="3pt"><u>Atas Nama</u></font><br><?php echo $this->session->userdata('nama') ?></h3>
        </div>
        <div class="col-md-6">
          <h3 align="center"><font size="3pt">No.Meja</font><br><label class="label label-success"><?php echo $this->session->userdata('id_meja') ?></label></h3>
        </div>
      </div>
</div>
</div>
<div class="row">        
    <div class="table-responsive col-md-8 col-md-8 col-xs-12">
        <table class="table" id="mytable">
            <thead>
                <th>No</th>
                <th>Nama Item</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Rasa</th>
                <th>Keterangan</th>
                <th class="<?php echo $hide ?>">Edit Jumlah</th>
                <th class="<?php echo $hide ?>">Hapus</th>
            </thead>
            <tbody>
                <?php 
                $no=1; $subtot=0;$subtottb=0;
                if($datapesanan->num_rows() > 0){
                    foreach ($datapesanan->result() as $brs) { 
                $hrgdiskon=$brs->harga -($brs->harga*$brs->promo/100);
                $subtot = $subtot +($brs->jml * $hrgdiskon);
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $brs->item ?></td>
                    <td align="right"><?php echo "Rp ". $hrgdiskon; ?></td>
                    <td align="right"><?php echo $brs->jml?></td>
                    <td><?php echo $brs->rasa?></td>
                    <td><?php echo $brs->ket?></td>
                    <td><button type="button" idne="<?php echo $brs->kd_item ?>"  id="btn<?php echo $brs->kd_item ?>"  class="btn btn-success <?php echo $hide ?>">Edit</button></td>
                    <td><a href="<?php echo base_url() ?>acustomer/batalpesan/<?php echo $brs->kd_item  ?>" class="btn btn-danger <?php echo $hide ?>">Hapus</a></td>
                </tr>

                <!-- mengirim id meja -->
                <script type="text/javascript">
                   $('#btn<?php echo $brs->kd_item ?>').on('click',function(){
                    var idne = $(this).attr('idne');
                    $('input[name=id]').val(idne);
                    $('#editjml').modal('show');
                   })
                </script>

                <?php 
                $no++; 

                    }
                }else{
                    echo "<tr>
                        <td colspan='7' align='center'>Pesanan masih kosong</td>
                    </tr>";
                    
                }
                ?>
            </tbody>
            </thead>
        </table>
    </div>
</div>
<?php if ($status =='tambah') {
    echo  '
    <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="col-md-3">
        <h3 align="center">
            <b>Item Tambahan</b>
        </h3>
      </div>
    </div>
    <div class="table-responsive col-md-8 col-md-8 col-xs-12">
        <table class="table" id="mytable">
            <thead>
                <th>No</th>
                <th>Nama Item</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Rasa</th>
                <th>Keterangan</th>
                <th>Edit Jumlah</th>
                <th>Hapus</th>
            </thead>
            <tbody>';
                $no=1;
                if($pesanan->num_rows()>0){
                    foreach($pesanan->result() as $psn){
                    $hrgdiskon=$psn->harga-($psn->harga*$psn->promo/100);
                    $subtottb=$subtottb+($psn->jml*$hrgdiskon);
                        echo '
                            <tr>
                                <td>'.$no.'</td>
                                <td>'.$psn->item.'</td>
                                <td>'.$hrgdiskon.'</td>
                                <td>'.$psn->jml.'</td>
                                <td>'.$psn->rasa.'</td>
                                <td>'.$psn->ket.'</td>
                                <td><button type="button" idne="'.$psn->kd_item.'"  id="btntb'.$psn->kd_item.'"  class="btn btn-success">Edit</button></td>
                                <td><a href="'.base_url().'acustomer/batalpesan/'.$psn->kd_item.'" class="btn btn-danger">Hapus</a></td>
                            </tr>
                            <script type="text/javascript">
                               $("#btntb'.$psn->kd_item.'").on("click",function(){
                                var idne = $(this).attr("idne");
                                $("input[name=id]").val(idne);
                                $("#editjml").modal("show");
                               })
                            </script>
                        ';
                    }
                }
    echo'
            </tbody>
            </thead>
        </table>
    </div>
    </div>
    ';
}
?>
<?php
    $akhir = $subtot + $subtottb;
?>  

    <div class="col-md-12 col-sm-12 col-xs-12">
        <label id="hrg" class="harga label-success"><h3><?php echo "Rp. ". $akhir.",-" ?></h3></label>    
        <label id="psn" subtot="<?php echo $subtot; ?>" class="harga label-default"><h3><a id="btnpesan"><i class="fa fa-check-circle"></i> Pesan</a></h3></label>    
        <label id="psn" class="harga label-danger"><h3><a style="color:#fff" href="<?php echo base_url() ?>acustomer/cancelpesan"><i class="fa fa-trash"></i> Batal Pesan</a></h3></label>    
    </div>
</div>
</div> <!-- tututp e container -->


<div id="editjml" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Jumlah</h4>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-md-12">
          <form url="<?php echo base_url() ?>acustomer/jumlah">
              <input type="hidden" name="id">
              <div class="form-group col-md-12">
                  <input type="radio" checked name="sts" value="1">Kurangi&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio"  name="sts" value="2">Tambah
              </div>

              <div class="form-group">
                <input type="tel" name="jml" class="form-control" placeholder="Masukkan jumlah">
              </div>
              <div class="form-group">
                <input type="text" name="ket" class="form-control" placeholder="Keterangan">
              </div>
              
      <div class="modal-footer">
        <div class="form-group">
            <button id="tbh" type="button" class="btn btn-success">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss='modal'>Batal</button>
        </div>
      </div>
          </form>
      </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    $(function(){
        $('#btnpesan').on('click',function(){
            var subtot = $('#psn').attr('subtot');
            if (subtot == 0) {
              alert('Pesanan Belum diisi !');
            }else{
                $(this).attr('href','<?php echo base_url() ?>acustomer/pesan/<?php echo $subtot; ?>');
            }
        })
        $('#tbh').on('click',function(){
            var angka = $('input[name=sts]:checked').val();
            var almt = $('form').attr('url');
            var data = $('form').serialize();

            $.ajax({
                url:almt,
                method:'post',
                data :data,
                success:function(c){
                    if(c =='ok'){
                        window.location.reload(true);
                    }else{
                        alert('Jumlah Tidak boleh melebihi Jumlah awal !');
                        window.location.reload(true);
                    }
                }
            }) 
        })
    })
</script>