<?php $this->load->view('front/view_navbar') ?>
<script>
    jQuery(document).ready(function ($) {

        $('#info').addClass('active');

        var _SlideshowTransitions = [
        //Fade in L
            {$Duration: 1200, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
        //Fade out R
            , { $Duration: 1200, $SlideOut: true, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
        //Fade in R
            , { $Duration: 1200, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
        //Fade out L
            , { $Duration: 1200, $SlideOut: true, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }

        //Fade in T
            , { $Duration: 1200, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
        //Fade out B
            , { $Duration: 1200, $SlideOut: true, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
        //Fade in B
            , { $Duration: 1200, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
        //Fade out T
            , { $Duration: 1200, $SlideOut: true, $FlyDirection: 4, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }

        //Fade in LR
            , { $Duration: 1200, $Cols: 2, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
        //Fade out LR
            , { $Duration: 1200, $Cols: 2, $SlideOut: true, $FlyDirection: 1, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
        //Fade in TB
            , { $Duration: 1200, $Rows: 2, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
        //Fade out TB
            , { $Duration: 1200, $Rows: 2, $SlideOut: true, $FlyDirection: 4, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }

        //Fade in LR Chess
            , { $Duration: 1200, $Cols: 2, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
        //Fade out LR Chess
            , { $Duration: 1200, $Cols: 2, $SlideOut: true, $FlyDirection: 8, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
        //Fade in TB Chess
            , { $Duration: 1200, $Rows: 2, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
        //Fade out TB Chess
            , { $Duration: 1200, $Rows: 2, $SlideOut: true, $FlyDirection: 2, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }

        //Fade in Corners
            , { $Duration: 1200, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $FlyDirection: 5, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2 }
        //Fade out Corners
            , { $Duration: 1200, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $FlyDirection: 5, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2 }

        //Fade Clip in H
            , { $Duration: 1200, $Delay: 20, $Clip: 3, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
        //Fade Clip out H
            , { $Duration: 1200, $Delay: 20, $Clip: 3, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
        //Fade Clip in V
            , { $Duration: 1200, $Delay: 20, $Clip: 12, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
        //Fade Clip out V
            , { $Duration: 1200, $Delay: 20, $Clip: 12, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            ];

        var options = {
            $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
            $AutoPlayInterval: 1500,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
            $PauseOnHover: 3,                                //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 3

            $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
            $ArrowKeyNavigation: true,                          //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
            $SlideDuration: 800,                                //Specifies default duration (swipe) for slide in milliseconds

            $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
            },

            $DirectionNavigatorOptions: {                       //[Optional] Options to specify and enable direction navigator or not
                $Class: $JssorDirectionNavigator$,              //[Requried] Class to create direction navigator instance
                $ChanceToShow: 1                               //[Required] 0 Never, 1 Mouse Over, 2 Always
            },

            $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
                $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                $SpacingX: 6,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                $DisplayPieces: 10,                             //[Optional] Number of pieces to display, default value is 1
                $ParkingPosition: 360                          //[Optional] The offset position to park thumbnail
            }
        };

        var jssor_slider1 = new $JssorSlider$("slider1_container", options);
        //responsive code begin
        //you can remove responsive code if you don't want the slider scales while window resizes
        function ScaleSlider() {
            var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
            if (parentWidth)
                jssor_slider1.$SetScaleWidth(Math.max(Math.min(parentWidth, 800), 300));
            else
                window.setTimeout(ScaleSlider, 30);
        }

        ScaleSlider();

        if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
            $(window).bind('resize', ScaleSlider);
        }
        //responsive code end
    });
</script>
<style type="text/css">
    body{
        /*background: #323223;*/
    }
</style>
    <div class="container">
        <h1 align="left">Sedang Populer</h1>
    </div>

    <div class="container">
    <div class="row">
    <div class="col-md-6">
        <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 800px;height: 456px; background: #191919; overflow: hidden;">
            <!-- Loading Screen -->
            <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                    background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                </div>
                <div style="position: absolute; display: block; background: url(../img/loading.gif) no-repeat center center;
                    top: 0px; left: 0px;width: 100%;height:100%;">
                </div>
            </div>
            <?php echo "123".$dbitem->num_rows(); ?>
            <!-- Slides Container -->
            <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 800px; height: 356px; overflow: hidden;">
            <?php 
                if($dbitem->num_rows() >0){
                foreach($dbitem->result() as $row){
                     $asal = FCPATH.'asset/images/item/'.$row->kd_item.".jpg";
                    if(file_exists($asal)){
                        $alamat = base_url().'asset/images/item/'.$row->kd_item.".jpg";
                    }else{
                        $alamat = base_url().'asset/images/item/no-image.jpg';
                    }
            ?>
                <div>
                    <img u="image" src="<?php echo $alamat ?>" />
                    <img u="thumb" src="<?php echo $alamat ?>" />
                    <div u=caption align="center" class="captionOrange" style="background:#fff;opacity:0.85;width:30%;height:100%" > 
                        <div style="background:#634500">
                            <font color="#fff" size="12"><?php echo $row->item ?></font>
                        </div>
                        <p style="font-size:12pt"><?php echo $row->ket ?></p>
                        <div style="background:#634500">
                            <font color="#fff" size="12"><h3>Harga<br><?php echo "Rp. ".$row->harga ?></h3></font>
                        </div>
                    </div>

                </div>
            <?php }}?>
            </div>
            
            <style>
                .jssord05l, .jssord05r, .jssord05ldn, .jssord05rdn
                {
                    position: absolute;
                    cursor: pointer;
                    display: block;
                    background: url(../img/d17.png) no-repeat;
                    overflow:hidden;
                }
                .jssord05l { background-position: -10px -40px; }
                .jssord05r { background-position: -70px -40px; }
                .jssord05l:hover { background-position: -130px -40px; }
                .jssord05r:hover { background-position: -190px -40px; }
                .jssord05ldn { background-position: -250px -40px; }
                .jssord05rdn { background-position: -310px -40px; }
            </style>
            <!-- Arrow Left -->
            <span u="arrowleft" class="jssord05l" style="width: 40px; height: 40px; top: 158px; left: 8px;"></span>
            <!-- Arrow Right -->
            <span u="arrowright" class="jssord05r" style="width: 40px; height: 40px; top: 158px; right: 8px"></span>
            <!-- Direction Navigator Skin End -->
            <!-- Thumbnail Navigator Skin Begin -->
            <div u="thumbnavigator" class="jssort01" style="background:#313122; position: absolute; width: 800px; height: 100px; left:0px; bottom: 0px;">
                <!-- Thumbnail Item Skin Begin -->
                <style>
                    .jssort01 .w
                    {
                        position: absolute;
                        top: 0px;
                        left: 0px;
                        width: 100%;
                        height: 100%;
                    }
                    .jssort01 .c
                    {
                        position: absolute;
                        top: 0px;
                        left: 0px;
                        width: 70px;
                        height: 70px;
                        border: #000 2px solid;
                    }
                    .jssort01 .p:hover .c, .jssort01 .pav:hover .c, .jssort01 .pav .c 
                    {
                        background: url(../img/t01.png) center center;
                        border-width: 0px;
                        top: 2px;
                        left: 2px;
                        width: 70px;
                        height: 70px;
                    }
                    .jssort01 .p:hover .c, .jssort01 .pav:hover .c
                    {
                        top: 0px;
                        left: 0px;
                        width: 72px;
                        height: 72px;
                        border: #fff 1px solid;
                    }
                </style>
                <div u="slides" style="cursor: move;">
                    <div u="prototype" class="p" style="position: absolute; width: 74px; height: 74px; top: 0; left: 0;">
                        <div class=w><thumbnailtemplate style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0;"></thumbnailtemplate></div>
                        <div class=c>
                        </div>
                    </div>
                </div>
                <!-- Thumbnail Item Skin End -->
            </div>
            <!-- Thumbnail Navigator Skin End -->
            <a style="display: none" href="http://www.jssor.com">Responsive Slider</a>
        </div>
    </div> <!--  tutup div col-md-6 -->
    <div class="col-md-1"></div>
    <div class="col-md-5 col-sm-12 col-xs-12">
    <h3>Informasi Resto</h3>
        <div class="col-sm-6">
         <?php 
            foreach ($datadb->result() as $row) {
                $asal = FCPATH.'asset/images/logo.jpg';
                if(file_exists($asal)){
                    $alamat = base_url().'asset/images/logo.jpg';
                }else{
                    $alamat = base_url().'asset/images/item/no-logo.jpg';
                }
        ?>
          <img src="<?php echo $alamat ?>" width="300">
        <?php }?>
        </div>
        <div class="col-sm-6">
            <?php foreach ($datadb->result() as $row) { ?>
                <p><?php echo $row->ket ?></p>
            <?php } ?>
        </div>
    </div>
    </div> <!-- tutup row -->
    <br>
</div>