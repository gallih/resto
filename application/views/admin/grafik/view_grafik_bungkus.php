<?php $this->load->view('admin/view_navbar') ?>
<div id="container">

</div>

<script type="text/javascript">
    $(function () {
    // Create the chart
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Penjualan'
        },
        subtitle: {
            text: 'Total Transaksi Uang dalam sebulan di tahun <?php echo date("Y") ?>',

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