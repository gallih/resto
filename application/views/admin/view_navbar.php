<?php $this->load->view('admin/header_admin') ?>
<style type="text/css">
    #samping li a:hover {
        background: transparent;
    }
</style>
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="<?php echo base_url() ?>adashboard" class="site_title"><i class="fa fa-apple"></i> <span>Admin Web</span> </a>
                </div>
                <div class="clearfix"></div>
                <!-- menu prile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                     <?php 
                        $asal = FCPATH.'asset/images/user/'.$this->session->userdata('username').".jpg";
                        if(file_exists($asal)){
                            $alamat = base_url().'asset/images/user/'.$this->session->userdata('username').".jpg";
                        }else{
                            $alamat = base_url().'asset/images/item/no-image.jpg';
                        }
                    ?>
                        <img src="<?php echo $alamat ?>" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Selamat Datang,</span>
                        <h2><?php echo $this->session->userdata('username') ?></h2>
                    </div>
                </div>
                <br />
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3><?php echo $this->session->userdata('level') ?></h3>
                        <ul class="nav side-menu">
                        <!-- <li><a href="<?php echo base_url() ?>adashboard"><i class="fa fa-circle-o"></i>Dashboard</a></li> -->
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
                                    echo '<li><a href ='.$url.'><i class="fa fa-chevron-circle-right"></i> '.$menu->nama.'</a>';
                                    echo '<ul class="nav child_menu" >';
                                    foreach ($sub->result() as $submenu) {
                                        if($menu->id_menu == $submenu->id_menu)
                                        {
                                            echo '<li><a href="'.base_url().$submenu->link.'"><i class="fa fa-angle-right"></i> '.$submenu->menu_sub.'</a></li>';
                                        }
                                    }
                                    echo "</li></ul>";
                                }
                            ?>

                            </li>
                            
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" onclick="launchIntoFullscreen(document.documentElement);" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a href="<?php echo base_url() ?>adminweb/logout" data-toggle="tooltip" data-placement="top" title="Logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>
        <div class="top_nav" >
            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right" id="samping">
                        <li><a href="<?php echo base_url() ?>adminweb/logout"><i class="fa fa-sign-out"></i>Keluar</a></li>
                    </ul>
                </nav>
            </div>

        </div> <!-- tutup col md-left -->
        <div class="right_col" role="main">
      