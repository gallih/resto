<?php $this->load->view('admin/view_navbar') ?>
<?php 

    $sts = $this->session->flashdata('info');
    $duplikat = $this->session->flashdata('duplikat');
    if(!empty($duplikat))
    {
        echo "
        <script type='text/javascript'>
        $(function(){
            new PNotify({
                title: 'Error Terjadi',
                text: 'Nip Karyawan Sudah dipakai !',
                type: 'error'
                        });
        })
        </script>
        ";
    }
    else if(!empty($sts)){
        echo "
        <script type='text/javascript'>
        $(function(){
            new PNotify({
                title: 'Konfirmasi',
                text: 'Data Berhasil di update',
                type: 'success'
                        });
        })
        </script>

        ";
    }
?>
<div class="row">
<div class="col-md-8 col-sm-12 col-xs-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Data Karyawan Perusahaan</h2>           
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a href="" data-toggle='modal' data-target='#addkaryawan' class="btn btn-dark">Tambah Karyawan</a>
                </li>
            </ul>
            <div class="clearfix"></div>
           <p>* Data Karyawan yang ditampilkan hanya Karyawan Aktif</p>
           <p>* <i class="fa fa-pencil"></i> Untuk Mengedit data&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i> Untuk Merubah status karyawan menjadi Pasif</p>
        </div>
        <div class="">
            <table id="karyawan" class="table table-striped responsive-utilities jambo_table">
                <thead>
                    <tr class="headings">
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Alamat </th>
                        <th>Telepon / HP </th>
                        <th class=" no-link last"><span class="nobr">Aksi</span>
                        </th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($datadb->result() as $row) { ?>
                    <tr class="even pointer">
                        <td class=" "><?php echo $row->nip ?></td>
                        <td class=" "><?php echo $row->nama?></td>
                        <td class=" "><?php echo $row->jabat?></td>
                        <td class=" "><?php echo $row->alamat ?></td>
                        <td class=" "><?php  echo $row->telp?></td>                        
                        <td class=" last">
                            <a href="<?php echo base_url() ?>akaryawan/edit/<?php echo $row->nip ?>" class="fa fa-pencil"></a>&nbsp;&nbsp;&nbsp;
                            <a href="<?php echo base_url() ?>akaryawan/rubahstatus/<?php echo $row->nip ?>/Pasif" class="fa fa-refresh"></a>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php $this->load->view('admin/karyawan/karyawan_tambah')  ?>

<script type="text/javascript">
    $(document).ready(function(){
        var oTable = $('#karyawan').dataTable({
                    "oLanguage": {
                        "sSearch": "Cari karyawan"
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

