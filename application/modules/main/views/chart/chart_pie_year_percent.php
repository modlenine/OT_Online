<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OT Online Program | Dashboard</title>


    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/variable-pie.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>

    <link href="<?= base_url() ?>main.css" rel="stylesheet">

</head>

<body>

    <div class="container-fulid bg-white p-3">

        <div class="row">
            <div class="col-md-12">
            <div id="pine_total_year"></div>
            </div>
        </div>




    </div>
</body>


<script>
Highcharts.chart('pine_total_year', {
  chart: {
    type: 'pie'
  },
  title: {
    text: 'ชม. สะสมในแต่ละเดือน'
  },
  plotOptions: {
        series: {
          cursor: 'pointer',
          point: {
            events: {
              click: function() {
                location.href = '';
              }
            }
          }
        }
      },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.percentage:,.1f}%</b> of total<br/>'
  },

  series: [
    {
      name: "OT",
      colorByPoint: true,
      data: [
        <?php
          
          foreach (chartCountPerMonth()->result_array() as $getgraph) {
            $result = "['" . $getgraph['otchart_month_name'] . "'," . $getgraph['total_time'] . "],";
            echo $result;
          }
          ?>
      ]
    }
  ]
});
</script>

</html>