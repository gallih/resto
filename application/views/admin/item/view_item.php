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
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2 >Data Produk</small></h2>
            
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a href="" data-toggle='modal' data-target='#additem' class="btn btn-dark">Item baru</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="">
        <p>* <i class="fa fa-pencil"></i> Untuk Mengedit data&nbsp;&nbsp;&nbsp;<i class="fa fa-trash"></i> Untuk Untuk menghapus data Item</p>
            <table id="karyawan" class="table table-striped responsive-utilities jambo_table">
                <thead>
                    <tr class="headings">
                        <th>No.</th>
                        <th>Nama Item</th>
                        <th>Stok</th>
                        <th>Jenis Item</th>
                        <th>Item Sachet</th>
                        <th>Rasa</th>
                        <th>Harga</th>
                        <th>Diskon</th>
                        <th>Populer</th>
                        <th>Persediaan</th>
                        <th>Pilihan</th>
                        <th>Keterangan</th>
                        <th class=" no-link last"><span class="nobr">Aksi</span>
                        </th>
                    </tr>
                </thead>

                <tbody>
                <?php $no=1;foreach ($datadb->result() as $row) { ?>
                    <tr class="even pointer">
                        <td class=" "><?php echo $no?></td>
                        <td class=" "><?php echo $row->item?></td>
                        <td align="center"><?php echo $row->stok?></td>
                        <td class=" "><?php echo $row->item_jadi?></td>
                        <td class=" "><?php echo $row->rasa?></td>
                        <td align="right"><?php echo "Rp ".$row->harga?></td>
                        <td align="center"><?php echo $row->promo ."%" ?></td>
                        <td class=" "><?php if($row->populer=='Y') echo 'Ya';else echo "Tidak"; ?></td>
                        <td align="center"><?php  echo $row->sts?></td>
                        <td align="center"><?php  echo $row->pilihan?></td>
                        <td class=" "><?php  echo $row->ket?></td>
                        <td class=" last">
                            <a href="<?php echo base_url() ?>aitem/edit/<?php echo $row->kd_item ?>" class="fa fa-pencil"></a>&nbsp;&nbsp;&nbsp;
                            <a href="<?php echo base_url() ?>aitem/hapus/<?php echo $row->kd_item ?>" class="fa fa-trash"></a>
                        </td>
                    </tr>
                    <?php
                    $no++;
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php $this->load->view('admin/item/item_tambah'); 
$this->load->view('admin/jenis/jenis_tambah')?>

<script type="text/javascript">
    $(document).ready(function(){
        var oTable = $('#karyawan').dataTable({
                    "oLanguage": {
                        "sSearch": "Cari Item"
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

