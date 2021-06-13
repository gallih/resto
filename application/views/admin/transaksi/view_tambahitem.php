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
</style>

<div class="row">
	<div class="col-md-8 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h3 align="center"><i class="fa fa-plus-circle"></i> Penambahan Item</h3>
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
						<h1 align="center" id="notrans" style="color:red"><b></b></h1>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<button type="button" url="<?php echo base_url() ?>akasir/bacapesanan" id='pilih' class="btn btn-default hidden">Pilih</button>
					</div>
				</div>
				<div class="row">
					
					<div class="col-md-12 col-sm-12 col-xs-12" id="pilihan">

					</div>
				</div>
			</div>
			<div class="x_footer">
				
			</div>
		</div>
	</div>
	<div class="col-md-4 col-sm-12 col-xs-12">
	<div class="row" id="tmp">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<label>Data Pesanan</label>
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<td>No</td>
					<td align="center">Nama Item</td>
					<td align="center">Harga</td>
					<td align="center">Rasa</td>
					<td align="center">Jumlah</td>
					<td align="center">Keterangan</td>
				</thead>
				<tbody>
					<tr>
						<td colspan="6" align="center">Tidak ada pesanan</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	</div>
	</div>
	</div>
</div>
<?php $this->load->view('admin/transaksi/show_trans_sudah') ?>
<script type="text/javascript">

$(document).ready(function(){
		$('#pilih').on('click',function(){
			var url = $(this).attr('url');
			$.ajax({
				url:url,
				success:function(xx){
					$('#pilihan').html(xx);
				}
			})
		})
    	

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
</script>

