<?php $this->load->view('front/header_ui') ?>
<style type="text/css">
	body{
		background: #F5F5F5;
	}
	#panel{
		margin-top: 10%;
		padding: 20px;
		position: relative;
	}
	#meja{
		position: absolute;
		right: 5%;top:2%;
	}
	#nomer{
		position: absolute;
		padding: 5px;
		background: #C53E3E;
		color: #fff;
		top: 2%;
    	left: 5%;
	}
</style>
<div class="container">
	<div class="row">
		<div class=" col-md-4 col-md-offset-4 col-xs-12 animated pulse " id="panel">
			<div class="panel panel-body" >
				<div id="nomer">
					<p align="center" style="display:block;background:#fff;color:#000"><b>Meja</b></p>
					<h3 id="nomormeja">0000</h3>
				</div>
				<div id="meja">
					<a href="" data-toggle='modal' data-target='#showmeja' id="btnmeja" class="btn" style="background:#2B2B2B;color:#fff">Pilih No. Meja <i class="fa fa-table"></i></a>
				</div>
				<div class="panel-body" style="margin-top:14%;padding:20px">
				<?php foreach ($restodb->result() as $key) { ?>
					<h3>
						Selamat Datang Pelanggan
					</h3>
					<form name='formlogin' action="<?php echo base_url() ?>acustomer/simpan" method="post" >
						<input type="hidden" name="id_meja" id="id_meja">
						<div class="form-group">
							<label>Nama Pemesan</label>
							<input required="required" name="nama" autofocus placeholder="Masukkan Nama Anda" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label>Nomor Handphone</label>
							<input required="required" name="nohp" placeholder="Masukkan Nomor HP Anda" type="tel" class="form-control">
						</div>
						<div class="form-group">
							<button type="button" onclick="valmeja()" class="btn" style="background:#2B2B2B;color:#fff">Lihat Menu <i class="fa fa-arrow-right"></i></button>
							<button type="button" onclick="javascript:location.reload(true)" class="btn btn-primary"><i class="fa fa-refresh"></i></button>
						</div>
					</form>
				</div>
				<div class="panel-footer" style="background:#fff">
					<p align="middle"><i class="fa fa-cutlery"></i> <?php echo $key->nama ?><br><?php echo $key->almt." ".$key->kota ." <br>".$key->telp ?></p>
				</div>
				<?php }?>
			</div>
		</div>
		<?php $this->load->view('front/show_meja') ?>

	</div>
</div>
<div id="konfir" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Konfirmasi</h4>
      </div>
      <div class="modal-body">
      	<p align="center"><b>Meja belum dipilih !</b></p>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	function valmeja(){
			if($('#nomormeja').text() == '0000'){
				$('#konfir').modal('show');
				return false;
			}else if($('input[name=nama]').val() == ""){
				alert('Nama Anda ?');
				return false;
			}else{
				document.forms['formlogin'].submit();
			}
	}

	

</script>
