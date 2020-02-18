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

    <script src="<?= base_url("js/jquery.min.js") ?>"></script>
    <link href="<?= base_url() ?>main.css" rel="stylesheet">

</head>
<?php
$month = $rs->row();

?>
<body>
<input hidden type="text" name="checkMonth" id="checkMonth" value="<?=$month->otchart_month_nameTH?>">

    <div class="container-fulid bg-white p-3">
<button type="button" class="btn btn-secondary" onclick="javascript:history.back();">Back</button>
        <div class="row">
            <div class="col-md-12">
            <div id="mainchart"></div>
            </div>
        </div>




    </div>
</body>


<script>
    var monthName = $('#checkMonth').val();
    var chart = Highcharts.chart('mainchart', {

        title: {
            text: 'รายการ โอที ของเดือน'+monthName
        },

        subtitle: {
            text: 'Plain'
        },

        xAxis: {
            categories: [
                <?php
                foreach ($rs->result_array() as $rss) {
                    echo "['" . $rss['otdept_name'] . "'],";
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
                            location.href = '';
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
                    foreach ($rs->result_array() as $rss) {
                        echo $rss['count_by_dept'] . ",";
                    }
                    ?>
                    // 29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4

                ],

            showInLegend: false
        }]

    });
</script>

</html>