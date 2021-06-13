<?php $this->load->view('admin/view_navbar') ?>
<style type="text/css">
	#total ,#hasil,#totalku{
		font-size: 30pt;
	}
	#bayar{
		font-size: 20pt;
		padding: 30px;
		text-align: right;
	}
	#simpan{
		padding: 16px;
		background-color: #ccc;
		color: #000;

	}
	#notrans{
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
				<h3 align="center"><i class="fa fa-cc-visa"></i> PEMBAYARAN</h3>
				<div class="nav navbar-right panel_toolbox">
					<p>Hallo <b><?php echo $this->session->userdata('username') ?></b></p>
	            </div>
	            <div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<label>Atas nama</label>
						<input onkeyup="showtrans(event)" id="nama" type="text" class="form-control " disabled="" autofocus>
						<input id="nota" type="hidden" class="form-control">
						<a href="" data-toggle='modal' data-target='#showtrans' class="btn btn-default pull-right">Cari</a>
					</div>
					<div class="col-md-1 col-sm-2 ">
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12" >
						<label>Nomor Meja</label>
						<input type="text" id="no_meja" disabled="" class="form-control">
					</div>
				</div>
				<div class="row">					
					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>Nomor Transaksi</label>
						<h1 align="center" id="notrans" ><b></b></h1>
					</div>
				</div>
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
							</thead>
							<tbody>
								<tr>
									<td colspan="5" align="center">Tidak ada pesanan</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				</div>
			</div>
			<div class="x_footer">
				
			</div>
		</div>
	</div>
	<div class="col-md-4 col-sm-12 col-xs-12 ">
	<div class="x_panel">
	<div class="row">
		<h3><b>Total bayar</b></h3>
		<div align=	"right">
			<label class="label label-success" id="totalku">Rp.</label><label style="margin-left:-15px" class="label label-success" id="total"></label>
		</div>
	</div>
	<div class="row">
		<h3><b>Bayar</b></h3>
		<input type="tel" id="bayar" onchange="pengurangan()" size="14">
	</div>
	<div class="row">
		<h3><b>Kembalian</b></h3>
		<div align="right">
			<label class="label label-danger" id="hasil">Rp 0</label>
		</div>
	</div>

	<div class="row">
		<br><br><br>
		<div align="center">
			<a id="simpan" url="<?php echo base_url() ?>adminweb/updatetrans" class="btn disabled btn-default"><i class="fa fa-floppy-o"></i> Simpan</a>
			<a id="cetak" url="<?php echo base_url() ?>adminweb" class="btn btn-info hidden"><i class="fa fa-print"></i> Cetak</a>
		</div>
	</div>
	</div>
	</div>
	
</div>
<?php $this->load->view('admin/transaksi/show_trans_sudah') ?>
<script type="text/javascript">

	function pengurangan(){
		var total = $('#total').text();
		var hasil = $('#hasil').text();
		var bayar = $('#bayar').val();
		hasil = bayar - total;
		$('#hasil').text("Rp "+hasil);
		$('#simpan').removeClass('disabled');
		
	}
	$('#cetak').on('click',function(){
		var url = $(this).attr('url') +'/cetak'+'/'+$('#notrans').text();
		window.location.href = url;

	})

	$('#simpan').on('click',function(){
		var nota = $('#notrans').text();
		var url = $(this).attr('url');
		$.ajax({
			url:url,
			method:'post',
			data :'nota='+nota+'&bayar='+$('#bayar').val()+'&no_meja='+$('#no_meja').val()+'&gtot='+$('#total').text(),
			success:function(e){
				if(e =='ok'){
					// alert('Berhasil disimpan !')
					$('#cetak').trigger('click');
					// window.location.reload(true);
				}
			}
		})
	})

    $(document).ready(function(){
        var ttrans = $('#ttrans').dataTable({
                    "oLanguage": {
                        "sSearch": "Cari disini"
                    },
                    select:true,

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
    // KETEMU SAM---------------
	// onload = function() {
	//     if (!document.getElementsByTagName || !document.createTextNode) return;
	//     var rows = document.getElementById('ttrans').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
	//     for (i = 0; i < rows.length; i++) {
	//         rows[i].onclick = function() {
	//             // alert(this.rowIndex + 1);
	//             alert(document.getElementById('ttrans').rows[this.rowIndex].cells[1].innerHTML);
	//         }
	//     }
	//     // alert(document.getElementById('ttrans').rows[this.rowIndex].cells[1].innerHTML);
	//--------------------------------
	// }





    function showtrans(event){
    	if(event.keyCode ==113){
    		$('#showtrans').modal('show');
    	}
    }
</script>

