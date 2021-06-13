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
<div class="col-md-7 col-sm-12 col-xs-12 ">
	<div class="x_panel">
		<div class="x_title">
			<h3><i class="fa fa-child"></i> Input Jatah Karyawan</h3>
			<ul class="nav navbar-right panel_toolbox">
                <li>
                    
                </li>
            </ul>
            <div class="clearfix"></div>
		</div>
		<div class="x_content">
		<form method="post" action="<?php echo base_url()?>akaryawan/simpanprive">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label>Hallo <b><?php echo $this->session->userdata('username') ?> </b> Silahkan Menginputkan Jatah Karyawan</label>
						<p>Jatah mendapatkan Makanan / Minuman ini diberikan 1 x dalam sehari</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-sm-12 col-xs-12">
					<div class="form-group">
						<label>Nama karyawan</label>
	                    <select name="nama" class="form-control">
	                        <?php foreach ($dbkary->result() as $row) { ?>
	                        	<option value="<?php echo $row->nip ?>"><?php echo $row->nama ?></option>
	                        <?php }?>
	                    </select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-sm-12 col-xs-12">
					<div class="form-group">
						<label>Item</label>
	                    <select name="item" class="form-control">
							<?php foreach ($dbitem->result() as $brs) {?>
	                        	<option value="<?php echo $brs->kd_item ?>"><?php echo $brs->item ?></option>
	                    	<?php }?>
	                    </select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="form-group pull-right">
						<button type="submit" class="btn btn-success">Simpan</button>
					</div>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>
</div>