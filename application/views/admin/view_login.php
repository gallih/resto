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
        background: #FAFAFA;
    }
    .head{
        background: #FAFAFA;
    }
    #login{
        
        background: #fff;
        padding: 20px;
        border: 2px solid #ccc;
    }
</style>

<div class="">
        <div id="wrapper" style="margin-top:10%">
            <div id="login" class="animated fadeInDown">
                <div class="">
                        <div class="row">
                            <div class="col-md-12" class="head">
                                <h4 align="center" style="color:#000">LOGIN</h4>
                            </div>         
                        </div>               

                    <form method="post" action="<?php echo base_url()?>adminweb/masuk">
                        <div class="input-group">
                            <input name="username" autofocus type="text" size="5" class="form-control" placeholder="Username" required="" />
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                        <div class="input-group">
                            <input name="pass" type="password" class="form-control" placeholder="Password" required="" />
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