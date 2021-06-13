<?php $this->load->view('admin/header_admin') ?>
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
        /*background: #1ABB9C;*/
        background: #333333;
    }
    .head{
        background: #09f;
    }
    #login{
        
        box-shadow: 6px 6px 5px #000;
        background: #fff;
        padding: 20px;
        border: 2px solid #ccc;
    }
</style>

<div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
        <div id="wrapper">
            <div id="login" class="animated flipInX">
                <div class="">
                        <div class="row">
                            <div class="col-md-12" class="head">
                                <h4 align="center" style="color:#000">ADMINISTRATOR PAGE <i class="fa fa-key"></i></h4>
                            </div>         
                        </div>               
                        <div class="row">
                            <div class="col-md-12">
                                <img src="<?php echo base_url('asset/images/admin.png')?>" class="img" width="300px" >
                        </div>
                        </div>
                    <form method="post" action="<?php echo base_url()?>adminweb/masuk">
                        <div class="input-group">
                            <input name="username" autofocus type="text" size="5" class="form-control" placeholder="Masukkan Nama User" required="" />
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                        <div class="input-group">
                            <input name="pass" type="password" class="form-control" placeholder="Masukkan Kata Sandi" required="" />
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        </div>
                        <div>
                            <a style="background: #C53E3E;color:#fff" class="btn pull-right" data-toggle="modal" data-target="#dapur">Devisi Dapur <i class="fa fa-cutlery"></i></a>
                            <button class="btn btn-dark pull-right  submit" type="submit">Masuk <i class="fa fa-share-square"></i></button>
                            <!-- <button class="btn btn-danger" type="button" onclick="modal()"><i class="fa fa-plus-circle"></i> Pengguna Baru</button> -->
                        </div>
                        <div class="clearfix"></div>
                        
                    </form>
                    <!-- form -->
                </div>
                <!-- content -->
            </div>            
        </div>
    </div>
    <?php $this->load->view('admin/logindapur') ?>
    <?php $this->load->view('admin/user/user_tambah') ?>
    <script type="text/javascript">
    function modal(){
        $('#adduser').modal('show');
    }
    </script>