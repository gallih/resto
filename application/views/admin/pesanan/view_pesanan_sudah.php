<?php $this->load->view('admin/header_admin') ?>
<body onload="javascript:setTimeout('location.reload(true);',20000);">
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
<style type="text/css">
	body{
		background: #fff;
	}

</style>
<script type="text/javascript">
	$(function(){
		$(document).ready(function(){
			var pos = $('#pos').attr('pos');
			if(pos == 1){
				$('#pos').css({'color':'#000'});
				$('#btnpos').removeClass();
				$('#btnpos').addClass('btn btn-block btn-danger');
			}
		})

	})
</script>
<div class="container">
<div class="row">
<div class="row">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" style="background:transparent">
      <a class="navbar-brand" id="brand" href="#">
      	<img class="img img-responsive"style="margin-top:-7%" src="<?php echo base_url() ?>asset/images/logo_dapur.png"  >
      </a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      	<li><a>Selamat Datang <b><?php echo $this->session->userdata('username') ?></b></a></li>
        <li><a href="<?php echo base_url() ?>adashboard"><i class="fa fa-home"></i> Dashboard Admin</a></li>
        <?php 
            $query = $this->db
                            ->like('level',$this->session->userdata('level'))
                            ->where('aktif','ya')
                            ->order_by('urutan','asc')
                            ->get('tb_menu');

            $sub = $this->db
                            ->like('level',$this->session->userdata('level'))
                            ->order_by('urutan','asc')
                            ->get('tb_submenu');
            foreach ($query->result() as $menu) {
                if($menu->link != '#'){ $url = base_url().$menu->link ;}else{ $url ='#';}
                echo '<li  class="dropdown" ><a href ='.$url.' class="dropdown-toggle" data-toggle="dropdown">'.$menu->nama.'</a>';
                echo '<ul class="dropdown-menu" role="menu">';
                foreach ($sub->result() as $submenu) {
                    if($menu->id_menu == $submenu->id_menu)
                    {
                        echo '<li><a href="'.base_url().$submenu->link.'"> '.$submenu->menu_sub.'</a></li>';
                    }
                }
                echo "</li></ul>";
            }
        ?>
        <li class=""><a href="<?php echo base_url() ?>apesanan/keluar">Logout <i class="fa fa-sign-out"></i></a></li>
      </ul>
      <ul class="nav navbar-nav pull-right">
      	<li><a href="">Tanggal <b><?php echo date('d-M-Y') ?></a></li>
      </ul>
      </div>
	</div>
</nav>

</div> <!-- menu atas -->
<?php if ($this->db->where(array('tgl' => date('Y-m-d')))->get('q_pesan')->num_rows() == 0) { ?>
<div class="row">
	<div class="jumbotron">
		<h1 align="center" style="color:#0ccf">Data Pesanan Hari ini masih belum ada</h1>
	</div>
</div>
<?php }else{?>
<div class="row">
<div class="col-md-9 col-sm-12 col-xs-12">
<div class="row">
	<?php $pos=1; foreach ($datadb as $brs) { ?>
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="x_panel" id="pos" pos="<?php echo $pos; ?>">
			<div class="x_title">
				<div class="col-md-12">
				<div>
	                <a href="<?php echo base_url() ?>apesanan/selesai/<?php echo $brs->nota ?>" id="btnpos" class="btn btn-block btn-success">Selesai</a>
	            </div>
	            </div>
	            <div class="clearfix"></div>
			</div>
			<div class="x_content">
			<p align="center"><font size="1pt">Pesanan Nota </font><b><?php echo $brs->nota ?></b></p>
			<p align="center"><font size="1pt">Meja </font><b><?php echo $brs->nm_meja ?></b></p>
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<td>Nama Item</td>
									<td>Jumlah</td>
									<td>keterangan</td>
								</tr>
							</thead>
							<tbody>
								<?php
									$jml = 0;
									$det =$this->db->group_by('item')->get_where('q_pesan',array('nota' => $brs->nota ,'sts_item'=>'belum' ));
									foreach ($det->result() as $row) { 
										
									?>
								<tr>
									<td><?php echo $row->item ?></td>
									<td align="center"><?php echo $row->jml ?></td>
									<td><?php echo $row->ket ?></td>
								</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
			</div>
			<div class="x_footer"></div>
		</div>
	</div>
	<?php $pos++; }?>
</div>
<div class="row">
	<?php echo $halaman ; }?>
</div>
</div> 