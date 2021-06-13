<?php $this->load->view('admin/view_navbar') ?>
<style type="text/css">
    #pass{
        /*box-shadow: 0px 6px 10px #667 ;*/
        margin-top: 150px;        
        padding: 10px;
    }
</style>
  
<div class="row"> 

<div id="wrapper">
<div class="x_panel">
<form class="form-horizontal form-label-left" novalidate action="<?php echo base_url()?>adminweb/ganti_pass" url="<?php echo base_url()?>adminweb/baca_pass">
<h3 align="center"><i class="fa fa-asterisk"></i> Ganti Password</h3>
    <div class="item form-group">
        <label for="password" class="control-label col-xs-12">Password Lama</label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="satu" type="password" name="passlama" autofocus class="form-control col-md-7 col-xs-12" >
            <p id="teks" style="text-align:left;color:red;font-size:10pt"></p>
        </div>
    </div>
    <div class="item form-group">
        <label for="password" class="control-label col-xs-12">Password Baru</label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="password" type="password" name="password" class="form-control col-md-7 col-xs-12" required="required">
        </div>
    </div>
    <div class="item form-group">
        <label for="password2" class="control-label col-xs-12">Ulangi Password </label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="password2" type="password" name="pass" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <button id="send" type="submit" class="btn btn-block btn-primary">Perbarui <i class="fa fa-check-square"></i></button>
        </div>
    </div>
</form>
</div>
</div>
</div>
    <?php $this->load->view('admin/user/user_tambah') ?>
    <script type="text/javascript">
    $(function(){
    //     $('#passlama').on('focus',function(){
    //         $('#teks').html('');
    //     })

        $('#password').on('focus',function(){
            var url = $('form').attr('url');
            var passlama = $('form').serialize();
            $.ajax({
                url :url,
                method :'post',
                data :passlama,
                success:function(e){
                    if(e != ""){
                        $('#teks').html(e);
                        $('#satu').focus();
                    }else{
                        $('#teks').html('');
                    }
                }
            })
        })
    //     $('form').on('submit',function(){
    //         alert('123');
        })
   
    </script>



