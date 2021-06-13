<?php $this->load->view('admin/view_navbar') ?>
<?php 
    $sts = $this->session->flashdata('info');
    if(!empty($sts)){
        echo "
        <script type='text/javascript'>
        $(function(){
            new PNotify({
                title: 'Konfirmasi',
                text: '".$sts."',
                type: 'success'
                        });
        })
        </script>

        ";
    }
?>
<div class="row">
<div class="col-md-4">
    <div class="x_panel">
        <div class="x_title">
            <h2>Inputkan Data BahanBaku Masuk</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <form url="<?php echo base_url() ?>abahanbaku/updatestok" method="post">
            <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="name">Nama Bahan Baku
                </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <select name="kd_bhn" class="form-control" id="kd_bhn">
                    <?php foreach ($datadb->result() as $key ) { ?>
                        <option value="<?php echo $key->kd_bahan ?>"><?php echo $key->nm_bhn ?></option>
                     <?php } ?>
                    </select>                    
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="name">Stok Masuk<span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-3 col-xs-3">
                    <input style="text-align:right" class="form-control col-md-7 col-xs-12" name="stk_msk"  required="required" type="tel">
                </div>
            </div>
            <!-- <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="name">Harga</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input style="text-align:right" class="form-control col-md-7 col-xs-12" name="harga"  required="required" type="text">
                </div>
            </div> -->
        </div>
        <div class="x_footer">
        <div class="item form-group">
            <a onclick="validasi()" class="btn btn-success pull-right">Masuk</a>
            <a onclick="keluar()" class="btn btn-danger pull-right">Dipakai</a>
        </div>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">

function validasi(){
        var url = $('form').attr('url');
        var data = 'kd_bhn='+$('#kd_bhn').val() +'&stk_msk='+$('input[name=stk_msk]').val();
        
        $.ajax({
            url : url,
            data : data,
            method :'post',
            success :function(e){
                if(e == 'ok'){
                    window.location.reload();
                }
            }
        })
}
function keluar(){
        var url = '<?php echo base_url() ?>'+'abahanbaku/stokkeluar';
       
        $.ajax({
            url : url,
            data : $('form').serialize(),
            method :'post',
            success :function(e){
                if(e == 'ok'){
                    window.location.reload();
                }
            }
        })
}
</script>

<div class="col-md-8 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Daftar Harga Bahanbaku yang digunakan per satuan</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a href="" data-toggle='modal' data-target='#addbahan' class="btn btn-success">Bahan Baru</a>
                </li>
            </ul>
            <div class="clearfix"></div>
           <p>* <i class="fa fa-pencil"></i> Untuk Mengedit data&nbsp;&nbsp;&nbsp;<i class="fa fa-trash"></i> Untuk Menghapus data Bahan</p>
        </div>
        <div class="">
            <table link=<?php echo base_url() ?> id="bahan" class="table table-striped responsive-utilities jambo_table">
                <thead>
                    <tr class="headings">
                        <th>Nama Bahan</th>
                        <th>Opname</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Keterangan</th>
                        <th class=" no-link last"><span class="nobr">Aksi</span>
                        </th>
                    </tr>
                </thead>

                <tbody>
                <?php 
                foreach ($datadb->result() as $row) { ?>
                    <tr class="even pointer">
                        <td class=" "><?php echo $row->nm_bhn?></td>
                        <td class="a-right"><?php echo $row->opname?></td>
                        <td class="a-right"><?php echo $row->stok?></td>
                        <td class=" "><?php echo $row->satuan ?></td>
                        <td class=" "><?php echo $row->harga_awal ?></td>
                        <td class=" "><?php  echo $row->ket?></td>
                        <td class=" last">
                            <a href="<?php echo base_url() ?>abahanbaku/edit/<?php echo $row->kd_bahan ?>" class="fa fa-pencil"></a>&nbsp;&nbsp;&nbsp;
                            <a href="<?php echo base_url() ?>abahanbaku/hapus/<?php echo $row->kd_bahan ?>" data-toggle='modal' class="fa fa-trash"></a>&nbsp;&nbsp;&nbsp;
                        </td>
                    <!-- memanggil modal hapus -->
                        <?php
                            $data['id'] ='hpsbhn';
                            $data['title'] ='Hapus Bahan';
                            $data['kriteria'] = $row->kd_bahan;
                            $data['content'] ='Bahan ini akan dihapus ?';
                            $data['link'] ='abahanbaku/hapus'.'/'.$row->kd_bahan;
                            $this->load->view('admin/view_konfirmasi',$data);
                        ?>

                        <?php  }?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $(function(){
            // $('.mod<?php echo $row->kd_bahan ?>').on('click',function(){
            //     alert('123');
            //     var isne = $('#kriteria').val();
            //     var isi = 'kd_bahan='+<?php echo $row->kd_bahan ?>;
            //     alert(isne);
            // var dataurl = $('#bahan').attr('link') +'abahanbaku/hapus';
            
            // $.ajax({
            //     url : dataurl,
            //     data: isi,
            //     method :'post',
            //     success : function(e){
            //         if(e == 'ok')
            //         {
            //             window.location.reload();
            //         }
            //     }
            // })
            })
    
</script>
<?php $this->load->view('admin/bahanbaku/bahanbaku_tambah') ?>

<script type="text/javascript">
    $(document).ready(function(){
        var oTable = $('#bahan').dataTable({
                    "oLanguage": {
                        "sSearch": "Cari BahanBaku"
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        } //disables sorting for column one
            ],
                    'iDisplayLength': 12,
                    "sPaginationType": "full_numbers",
                    
        });
    })
</script>

