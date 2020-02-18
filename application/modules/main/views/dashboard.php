<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OT Online Program | Dashboard</title>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>



</head>

<body>
    <!-- Head Template for use all page ###############
##################################################
################################################## -->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Dashboard
                    <div class="page-title-subheading">หน้าแสดง กราฟ สรุปผลต่างๆ
                    </div>
                </div>
            </div>
            <div class="page-title-actions">


            </div>
        </div>
    </div>
    <!-- Head Template for use all page ###############
##################################################
################################################## -->
    <div class="container-fulid bg-white p-3">

        <div class="row">
            <div class="col-md-12">
            <iframe src="<?=base_url('main/loadchart') ?>" frameborder="0" width="100%" height="500"></iframe>
            <!-- <div id="mainchart"></div> -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
            <iframe src="<?=base_url('main/loadChartYearPercent') ?>" frameborder="0" width="100%" height="500"></iframe>
            </div>

            <div class="col-md-6">
            <iframe src="<?=base_url('main/loadChartPercent') ?>" frameborder="0" width="100%" height="500"></iframe>
            </div>
        </div>




    </div>
</body>


<!-- <script>
    var chart = Highcharts.chart('mainchart', {

        title: {
            text: 'Chart.update'
        },

        subtitle: {
            text: 'Plain'
        },

        xAxis: {
            categories: [
                <?php
                foreach (chartCountPerMonth()->result_array() as $rss) {
                    echo "['" . $rss['otchart_month_name_short'] . "'],";
                }
                ?>
                // 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'

            ]
        },
        plotOptions: {
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function() {
                            var linkchart = '<?php echo base_url(); ?>';
                            // location.href = popup(linkchart,'',1000,800);
                            window.open(popup(linkchart+this.category,'',1000,600));

                        }
                    }
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.category}</span>: <b>{point.y:,.0f}</b> รายการ<br/>'
        },

        series: [{
            name: 'OT',
            type: 'column',
            colorByPoint: true,
            data:

                [
                    <?php
                    foreach (chartCountPerMonth()->result_array() as $rss) {
                        echo $rss['count_per_month'] . ",";
                    }
                    ?>
                    // 29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4

                ],

            showInLegend: false
        }]

    });
</script> -->

</html>