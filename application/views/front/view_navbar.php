<?php $this->load->view('front/header_ui') ?>

<div class="container">
    <div align="center">
    <?php 
        foreach ($datadb->result() as $row) {
            $asal = FCPATH.'asset/images/logo.jpg';
            if(file_exists($asal)){
                $alamat = base_url().'asset/images/logo.jpg';
            }else{
                $alamat = base_url().'asset/images/item/no-logo.jpg';
            }
        ?>
        <a href="<?php echo base_url() ?>home"><img src="<?php echo $alamat ?>" width="100px" height="100px"></a>
        <h4><b><?php echo $row->nama; ?></b></h4>
        <p><?php echo $row->almt ." ".$row->kota ." Telepon ".$row->telp; ?></p>
    <?php }
    ?>
    </div>
</div><br>
<div class="container">
        <div class="menu" style="display:block;margin:0 auto"><!-- start menu -->
            <ul class="mcd-menu">
               <!--  <li>
                        <a id="info" href="<?php echo base_url() ?>home"><img src="<?php echo base_url() ?>asset/images/icon-info.png" width="50">
                            <strong>INFO</strong>
                        </a>
                    
                </li> -->
                <li style="margin-left:20%">
                    <a id="food" href="<?php echo base_url() ?>food">
                        <img src="<?php echo base_url() ?>asset/images/icon-food.png" width="50">
                        <strong>MAKANAN</strong>
                    </a>
                </li>
                <li>
                    <a id="drink" href="<?php echo base_url() ?>drink" >
                        <img src="<?php echo base_url() ?>asset/images/icon-drink.png" width="50">
                        <strong>MINUMAN</strong>
                    </a>
                </li>
                
                 <li style="position:relative">
                    <div style="position:absolute;right:0;top:0">
                            <img style="img-responsive" src="<?php echo base_url() ?>asset/images/label.png">
                            <h1 style="position:absolute;top:0;left:30%"><?php echo $this->db->get_where('q_pemesanan',array('nota' => $this->session->userdata('nota')))->num_rows()  ?></h1>
                    </div>
                    <a id="pesanan" href="<?php echo base_url() ?>pesanan" >
                        <img src="<?php echo base_url() ?>asset/images/icon-pesan.png" width="50">
                        <strong>PESANAN</strong>
                    </a>
                </li>
            </ul>
        </div><BR>
</div>