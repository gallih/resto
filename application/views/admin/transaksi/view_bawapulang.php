<?php $this->load->view('admin/view_navbar') ?>
<style type="text/css">
	#bayar{
		font-size: 20pt;
		padding: 30px;
		text-align: right;
	}
	#nota{
		color: #fff;
		padding: 2px;
		letter-spacing: 3pt;
		background-color: #26B99A;
	}
</style>
<div class="row">
	<div class="col-md-8 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h3 align="center"><i class="fa fa-check-square"></i> TRANSAKSI BAWA PULANG</h3>
				
	            <div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label>Nota</label>
					<h1 id="nota" align="center"><?php echo $this->session->userdata('nota') ?></h1>
				</div>
				</div>
				<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<a url="<?php echo base_url() ?>akasir/bacapesananbungkus" href="#" id='pilih' class="btn btn-default hidden">Pilih</a>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12" id="pilihan">
					</div>
				</div>
				</div>
			</div>
			<div class="x_footer">
				
			</div>
		</div>
	</div>

	<div class="col-md-4 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="row" id="tmp">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<label>Data Pesanan</label>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<td>No</td>
						<td align="center">Nama Item</td>
						<td align="center">Harga</td>
						<td align="center">Jumlah</td>
						<td align="center">Keterangan</td>
						<td align="center">Edit</td>
						<td align="center">Hapus</td>
					</thead>
					<tbody>
					<?php $no=1;$subtot=0;if($dbpesanan->num_rows() > 0) { ?>
					<?php foreach ($dbpesanan->result() as $brs) { 
						$hrgdiskon=$brs->harga -($brs->harga*$brs->promo/100);
					      $subtot = $subtot +($brs->jml * $hrgdiskon);
					?>
						<tr>
							<td ><?php echo $no?></td>
							<td ><?php echo $brs->item ?></td>
							<td ><?php echo $hrgdiskon=$brs->harga -($brs->harga*$brs->promo/100); ?></td>
							<td ><?php echo $brs->jml ?></td>
							<td ><?php echo $brs->ket ?></td>
							<td><a href="#" idne="<?php echo $brs->kd_item ?>"  id="btn<?php echo $brs->kd_item ?>"  class="btn"><i class="fa fa-pencil"></i></a></td>
							<td><a href="<?php echo base_url() ?>akasir/batalpesan/<?php echo $brs->kd_item  ?>"  class="btn"><i class="fa fa-trash"></i></a></td>
						</tr>

					<!-- mengirim id meja -->
	                <script type="text/javascript">
	                   $('#btn<?php echo $brs->kd_item ?>').on('click',function(){
	                   		var idne = $(this).attr('idne');
		                    $('input[name=id]').val(idne);
		                    $('#editjml').modal('show');
	                   })
	                </script>
	                <!-- tutup -->
					<?php $no++; }}else{?>
						<tr>
							<td colspan="7" align="center">Pesanan Masih kosong</td>
						</tr>
					<?php }?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<label>Atas Nama</label>
			<input type="text" id="nama" name="nama" class="form-control">
		</div>
		</div><br>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				Grand Total Rp.<h1 id="total" align="right"><?php echo $subtot ?></h1>
			</div>
		</div>
		<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			Bayar
			<input type="tel" id="bayar" align="right" onchange="pengurangan()" size="14">
		</div>
		</div>
		<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			Kembalian Rp.
			<div align="right">
				<h1 id="hasil">0</h1>
			</div>
		</div>
		</div>
		<div class="row">
			<br><br><br>
			<div align="center">
				<a id="simpan" url="<?php echo base_url() ?>akasir" class="btn disabled btn-default"><i class="fa fa-floppy-o"></i> Simpan</a>
				<a id="cetak" url="<?php echo base_url() ?>adminweb" class="btn btn-info hide"><i class="fa fa-print"></i> Cetak</a>
			</div>
		</div>
	</div>
	</div>

</div>

<!-- CUSTOM JUMLAH -->
<div id="editjml" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Jumlah</h4>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-md-12">
          <form id ="formedit" url="<?php echo base_url() ?>akasir/jumlah">
              <input type="hidden" name="id">
              <div class="form-group col-md-12">
                  <input type="radio" checked name="sts" value="1">Kurangi&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio"  name="sts" value="2">Tambah
              </div>

              <div class="form-group">
                <input type="tel" name="jml" class="form-control" placeholder="Masukkan jumlah">
              </div>
              <div class="form-group">
                <input type="text" name="ket" class="form-control" placeholder="Keterangan">
              </div>
              
      <div class="modal-footer">
        <div class="form-group">
            <button id="tbh" type="button" class="btn btn-success">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss='modal'>Batal</button>
        </div>
      </div>
          </form>
      </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	function pengurangan(){
		var total = <?php echo $subtot ?>;
		var hasil = $('#hasil').text();
		var bayar = $('#bayar').val();
		hasil = bayar - total;
		$('#hasil').text("Rp "+hasil);
		$('#simpan').removeClass('disabled');
		
	}
	$(document).ready(function(){
		$('#pilih').trigger('click');
	})

	$('#cetak').on('click',function(){
		var url = $(this).attr('url') +'/cetakbungkus'+'/'+$('#notrans').text();
		window.location.href = url;

	})

	$('#simpan').on('click',function(){
		var url = $(this).attr('url') +'/'+'simpanbungkus';
		var gtot = 'gtot='+$('#total').text()+'&nama='+$('input[name=nama]').val()+'&bayar='+$('#bayar').val();
		$.ajax({
			url:url,
			method:'post',
			data : gtot,
			success :function(e){
				var ini = $('#simpan').attr('url');
				if(e == 'ok'){
					window.location.href = ini;
				}
			}
		})
	})

	$('#pilih').on('click',function(){
		var url = $(this).attr('url');
		$.ajax({
			url:url,
			success:function(xx){
				$('#pilihan').html(xx);
			}
		})
	})
	 $('#tbh').on('click',function(){
            var angka = $('input[name=sts]:checked').val();
            var almt = $('#formedit').attr('url');
            var data = $('form').serialize();

            $.ajax({
                url:almt,
                method:'post',
                data :data,
                success:function(c){
                	
                    if(c =='ok'){
                        window.location.reload(true);
                    }else{
                        alert('Jumlah Tidak boleh melebihi Jumlah awal !');
                        window.location.reload(true);
                    }
                }
            }) 
        })
</script>