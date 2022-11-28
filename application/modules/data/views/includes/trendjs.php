<?php $graph = Modules::run("data/dimension0", $this->uri->segment(3));

?>
<script>
Highcharts.chart('line<?php echo $chartkpi; ?>', {
    chart: {
        type: 'line'
    },
    title: {
        text: '<?php echo $title; ?>'
    },
    chart: {
        height: 400,

    },

    legend: {
        align: 'center',
        verticalAlign: 'bottom',
        x: 0,
        y: 0
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: <?php echo json_encode($graph['quaters']); ?>
    },
    yAxis: {
        title: {
            text: 'Score  (°%)'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: true
        }
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Period',
        data: <?php echo json_encode($graph['data'],JSON_NUMERIC_CHECK); ?>
    }, {
        name: 'Target',
        data: <?php echo json_encode($graph[' target '],JSON_NUMERIC_CHECK); ?>
    }]
});
</script>