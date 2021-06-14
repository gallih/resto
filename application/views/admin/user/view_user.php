<?php $this->load->view('admin/view_navbar') ?>
<?php 
    echo $error;
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
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Data User</h2>
            
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a href="" data-toggle='modal' data-target='#adduser' class="btn btn-dark"><i class="fa fa-plus-circle"></i> User Baru</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="">
            <table id="karyawan" class="table table-striped responsive-utilities jambo_table">
                <thead>
                    <tr class="headings">
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Telepon / HP</th>                        
                        <th>Level</th>
                        <th>Blokir</th>
                        <th class=" no-link last"><span class="nobr">Aksi</span></th>
                        <th>Hapus</th>
                        <th>Reset</th>
                    </tr>
                </thead>

                <tbody>
                <?php $no=1;
                foreach ($datadb->result() as $row) { ?>
                    <tr class="even pointer">
                        <td class=" "><?php echo $no ?></td>
                        <td class=" "><?php echo $row->username?></td>
                        <td class=" "><?php echo $row->nama?></td>
                        <td class=" "><?php echo $row->no_telp ?></td>
                        <td class=" "><?php  echo $row->level ?></td>
                        <td class=" "><?php  echo $row->blokir ?></td>                                    
                        <td class=" last">
                            <a href="<?php echo base_url() ?>auser/edit/<?php echo $row->Id ?>" class="fa fa-pencil"></a>&nbsp;&nbsp;&nbsp;
                            <a href="<?php echo base_url() ?>auser/blokir/<?php echo $row->Id ?>" class="fa fa-ban" ></a>
                        </td>
                        <td align="center"><a href="<?php echo base_url() ?>auser/hapus/<?php echo $row->Id ?>" class="fa fa-trash" ></a></td>
                        <td><a href="<?php echo base_url() ?>auser/resetpwd/<?php echo $row->Id ?>">Reset</a></td>
                    </tr>
                    <!-- memanggil modal hapus -->

                <?php $no++;}?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

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

<?php $this->load->view('admin/user/user_tambah') ?>