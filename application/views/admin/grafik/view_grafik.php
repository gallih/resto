<?php $this->load->view('admin/view_navbar') ?>
<form method="post" action="<?php echo base_url() ?>agrafik/penjualantahun">
<label>Pilih Berdasarkan Tahun</label>
<div class="row">
    <div class="col-md-3 col-sm-8 col-xs-12">
        <select id="tahun" name="tahun" class="form-control">
            <?php for ($i=2016; $i<2026  ; $i++) { 
                echo "<option value='$i'>$i</option>";
            } ?>
        </select>
    </div>
    <div class="col-md-1">
        <button type="submit" class="btn btn-dark pull-right btn-block">Cari <i class="fa fa-search"></i></button>
    </div>
</div>
</form>

<div id="container">

</div>

<script type="text/javascript">

    $(function () {
        $('#tahun').on('change',function(){
            ('form').submit();
            alert('213')
        })
    // Create the chart
    $('#container').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Grafik Penjualan'
        },
        subtitle: {
            text: 'Total Transaksi Uang dalam sebulan di tahun '+ $('#tahun').val(),

        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                    'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des']
        },
        yAxis: {
            title: {
			    text: 'Pendapatan (Ribu)'
			   }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: 'Rp.{point.y:.1f}'
                }
            }
        },
        series:[{
        	name: 'Pendapatan (Ribu)',
        	data: <?php echo json_encode($grafik) ?>
        }]        
        
    });
});
</script>