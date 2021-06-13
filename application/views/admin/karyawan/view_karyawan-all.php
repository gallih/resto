<?php $this->load->view('admin/view_navbar') ?>
<?php 
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
<div class="col-md-9 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Data Karyawan Perusahaan<small>Semua Karyawan akan ditampilkan disini</small></h2>           
            <div class="clearfix"></div>
        </div>
        <div class="">
        <p>* <i class="fa fa-unlock "></i> Untuk Mengaktifkan karyawan kembali</p>
            <table id="karyawan" class="table table-striped responsive-utilities jambo_table">
                <thead>
                    <tr class="headings">
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Alamat </th>
                        <th>Telepon / HP </th>
                        <th>Status</th>
                        <th class=" no-link last"><span class="nobr">Aktifkan</span>
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
                        <td class=" "><?php if($row->sts=='P'){echo 'Pasif';}else{echo "Aktif";} ?></td>
                        <td class="">
                            <?php if($row->sts=='P') { echo '<a href="" data-toggle="modal" data-target="#aktif" class="fa fa-unlock "></a>';}?>
                        </td>
                    </tr>
                    <!-- memanggil modal hapus -->
                    <?php
                        $data['id'] ='aktif';
                        $data['title'] ='Aktif Karyawan';
                        $data['content'] ='Karyawan ini kembali akan di aktifkan ?';
                        $data['link'] ='rubahstatus'.'/'.$row->nip.'/Aktif';
                        $this->load->view('admin/view_konfirmasi',$data);
                    ?>

                <?php }?>
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

