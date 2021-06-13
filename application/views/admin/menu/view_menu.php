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
<script type="text/javascript">
	$(function(){
		$('#menu').dataTable();
	})
</script>
<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
			<div class="x_title">
				<h3>Menu Utama</h3>
				<p> *) Data pada Menu Utama tidak bisa dihapus tapi bisa dinonaktifkan melalui pilihan menu aktif</p>
				<p> *) # adalah untuk menonaktifkan link</p>
			</div>
			<div class="x_content">
				<a data-toggle='modal' data-target='#addmenu' class="btn btn-default">Tambah Menu Utama</a>
				<div class="table-responsive">
					<table class="table table-bordered table-striped" id="menu">
						<thead>
							<td>No.</td>
							<td>Menu Utama</td>
							<td>Link</td>
							<td>Hak Akses</td>
							<td>Aktif</td>
							<td>Urutan</td>
							<td>Aksi</td>
						</thead>
						<tbody>
						<?php $no=1; foreach ($menu->result() as $row) { ?>
							<tr>
								<td><?php echo $no ?></td>							
								<td><?php echo $row->nama ?></td>
								<td><?php echo $row->link ?></td>
								<td><?php echo $row->level?></td>
								<td><?php echo $row->aktif?></td>
								<td align="center"><?php echo $row->urutan?></td>
								<td><a href="<?php echo base_url() ?>amenu/editutama/<?php echo $row->id_menu ?>">Edit</a></td>
							</tr>
						<?php $no++; }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php $this->load->view('admin/menu/menu_tambah') ?>
	

