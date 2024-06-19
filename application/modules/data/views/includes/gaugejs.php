<script>
  Highcharts.chart('gauge<?php echo $chartkpi; ?>', {
    chart: {
      type: 'gauge',
      plotBackgroundColor: null,
      plotBackgroundImage: null,
      plotBorderWidth: 0,
      plotShadow: false,
      height: '80%'
    },
    subtitle: {
      text: ''
    },
    title: {
      text: '<a href="<?php echo base_url() . 'data/kpidata/' . $gauge['details'][0]->kpi_id . '/' . $gauge['details'][0]->subject_area; ?>"><button class="btn" style="word-wrap:normal; color:#3f424a; font-size:12.5px;"><?php echo trim(addslashes($gauge['details'][0]->short_name)); ?></button></a>'
    },
    pane: {
      startAngle: -90,
      endAngle: 89.9,
      background: {
        backgroundColor: '#e6e2e2',
        innerRadius: '93%',
        outerRadius: '100%',
        shape: 'arc'
      },
      center: ['50%', '75%'],
      size: '110%'
    },
    yAxis: {
      min: 0,
      max: <?php echo (($gauge['data']->current_value ?? 0) > 100) ? $gauge['data']->current_value : 100; ?>,
      tickPixelInterval: 72,
      tickPosition: 'inside',
      tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
      tickLength: 20,
      tickWidth: 2,
      minorTickInterval: null,
      labels: {
        distance: 20,
        style: {
          fontSize: '14px'
        }
      },
      lineWidth: 0,
      plotBands: [{
        from: 0,
        to: <?= $gauge['data']->current_value ?? 0 ?>,
        color: '<?= getColorBasedOnPerformance($gauge['data']->current_value ?? 0, $gauge['data']->current_target) ?>'
      }]
    },
    series: [{
      name: '<?php echo trim(addslashes($gauge['details'][0]->short_name)); ?>',
      data: [<?php echo trim($current_value = round($gauge['data']->current_value ?? 0)); ?>],
      tooltip: {
        valueSuffix: ' %'
      },
      dataLabels: {
        format: '{y} %',
        borderWidth: 0,
        color: (
          Highcharts.defaultOptions.title &&
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || '#333333',
        style: {
          fontSize: '16px'
        }
      },
      dial: {
        radius: '80%',
        backgroundColor: 'gray',
        baseWidth: 12,
        baseLength: '0%',
        rearLength: '0%'
      },
      pivot: {
        backgroundColor: 'gray',
        radius: 6
      }
    }],
    credits: {
      enabled: false
    }
  });
</script>