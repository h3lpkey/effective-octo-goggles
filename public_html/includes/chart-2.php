<div id="pie-chart-2" class="pie-chart"></div>
<?php
$false =0;
$half = 0;
$right = 0;

$list = $collectionArchive->find();
$list -> limit(300);
$list -> sort(array('$natural' => - 1, 'bkRobotResult' => 1));
while($document = $list->getNext()) {
    if($document['bkRobotResult'] == 1) $false++;
    if($document['bkRobotResult'] == 2) $half++;
    if($document['bkRobotResult'] == 3) $right++;
}
?>
<script defer type="text/javascript">
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Stakes', 'Percentage'],
            ['<?php echo $right; ?>  Ставок зашло полностью', <?php echo $right; ?>],
            ['<?php echo $half; ?>  Ставок зашло не полностью', <?php echo $half; ?>],
            ['<?php echo $false; ?>  Ставок не зашли вообще',  <?php echo $false; ?>]
        ]);

        var options = {
            forceIFrame: true,
            enableInteractivity: false,
            chartArea: {
                top: 0,
                left: 0,
                width: '100%',
                height: '100%'
            },
            fontSize: 20,
            fontName: '"Proxima Nova", sans-serif',
            colors: [
                '#ffa80e',
                '#ffc01a',
                '#f26c4f'
            ],
            legend: {
                position: 'none',
                textStyle: { color: '#5b7e76',
                    fontName: '"Proxima Nova", sans-serif',
                    fontSize: 12
                }
            },
            tooltip: {
                textStyle: { color: '#5b7e76',
                    fontName: 'Proxima Nova',
                    fontSize: 14
                }
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('pie-chart-2'));

        chart.draw(data, options);
    }
</script>