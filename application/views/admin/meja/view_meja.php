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
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="x_panel">
                <div class="x_title">
                    <h4 align="center">Tambahkan Data Meja</h4>
                </div>
                <form method="post" action="<?php echo base_url() ?>ameja/simpan">
                    <div class="form-group">
                        <label>Lantai </label>
                        <select class="form-control" name="lantai">
                            <option>Lantai 1</option>
                            <option>Lantai 2</option>
                            <option>Lantai 3</option>
                            <option>Lantai 4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Meja</label>
                        <input type="text" required="required" placeholder="Nama Meja" name="nm_meja" class="form-control">
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-success">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
        <a href="<?php echo base_url() ?>ameja/resetstatus" class="btn btn-danger"><i class="fa fa-exclamation"></i> Reset Status Meja</a><br>
        <p>* <i class="fa fa-pencil"> Untuk mengedit data Meja</i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash"> Untuk menghapus data Meja</i>&nbsp;&nbsp;<i class="fa fa-refresh"> Untuk mengganti Status meja</i></p>
            <table id="meja" class="table table-striped responsive-utilities jambo_table">
                <thead>
                    <tr class="headings">
                        <th>Nama Meja</th>
                        <th>Posisi Lantai</th>
                        <th>Status</th>
                        <th class=" no-link last"><span class="nobr">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($datadb->result() as $row) { ?>
                    <tr class="even pointer">
                        <td class=" "><?php echo $row->nm_meja?></td>
                        <td class=" "><?php echo $row->lantai?></td>
                        <td class=" "><?php echo $row->sts?></td>
                        <td class=" last">
                            <a href="<?php echo base_url() ?>aitem/edit/<?php echo $row->id_meja ?>" class="fa fa-pencil"></a>&nbsp;&nbsp;&nbsp;
                            <a href="<?php echo base_url() ?>aitem/hapus/<?php echo $row->id_meja ?>" data-toggle="modal" data-target="#hpsitem" class="fa fa-trash"></a>&nbsp;&nbsp;&nbsp
                            <a href="<?php echo base_url() ?>ameja/rubah/<?php echo $row->id_meja ?>" class="fa fa-refresh"></a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('#meja').DataTable({
            'iDisplayLenght':12,
            "sPaginationType":"full_numbers",
        });
    })
    function kirim(){
       var url = $('form').attr('url');
       var isi = $('form').serialize();
       $.ajax({
        url:url,
        method:'post',
        data : isi,
        sucess:function(){

        }
       })
    }
</script>

