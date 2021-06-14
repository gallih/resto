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
                text: 'Berhasil disimpan',
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
            <h2>Data Resto</h2>

            <?php if($datadb->num_rows() == 0){ ?>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a href="" data-toggle='modal' data-target='#addperusahaan' class="btn btn-success">Buat Baru</a>
                </li>
            </ul>
            <?php }?>
            <div class="clearfix"></div>
        </div>
        <div class="">
            <table id="karyawan" class="table table-striped responsive-utilities jambo_table">
                <thead>
                    <tr class="headings">
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Telepon / HP </th>
                        <th>Keterangan</th>
                        <th class=" no-link last"><span class="nobr">Aksi</span>
                        </th>
                    </tr>
                </thead>

                <tbody>

                <?php 
                if ($datadb->num_rows() == 0 ){
                    echo "<tr>
                        <td colspan='5' align='center'>Data Perusahaan Masih Belum ada</td>;
                    </tr>";
                }
                foreach ($datadb->result() as $row) { ?>
                    <tr class="even pointer">
                        <td class=" "><?php echo $row->nama?></td>
                        <td class=" "><?php echo $row->almt?></td>
                        <td class=" "><?php echo $row->kota ?></td>
                        <td class=" "><?php  echo $row->telp?></td>
                        <td class=" "><?php  echo $row->ket?></td>
                        <td class=" last">
                            <a href="<?php echo base_url() ?>aperusahaan/edit/<?php echo $row->id ?>" class="fa fa-pencil"></a>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php $this->load->view('admin/Perusahaan/perusahaan_tambah')  ?>