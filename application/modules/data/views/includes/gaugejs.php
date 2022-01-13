
<script>
Highcharts.chart('gauge<?php echo $chartkpi; ?>', {

    chart: {
      type: 'gauge',

        events: {
            load: function () {
                var label = this.renderer.label('')
                .css({
                    width: '500px',
            
                    fontSize: '8px'
                  
                })
                .add();
                
                label.align(Highcharts.extend(label.getBBox(), {
                    align: 'center',
                    x: 0, // offset
                    verticalAlign: 'bottom',
                    y: 0 // offset
                }), null, 'spacingBox');
                
            }
        },
      plotBackgroundColor: null,
      plotBackgroundImage: null,
      plotBorderWidth: 0,
      plotShadow: false
      
    },
    

    subtitle: {
      text: '<a href="<?php echo base_url().'data/kpidetails/'.$gauge['details'][0]->kpi_id.'/'.$gauge['details'][0]->subject_area; ?>"><button class="btn"  style="word-wrap:normal; color:#2286c3; font-size:12px;" "><?php echo "KPI Info"; ?> <button/> </a>'
    },

    title: {
      text: '<a href="<?php echo base_url().'data/kpidata/'.$gauge['details'][0]->kpi_id.'/'.$gauge['details'][0]->subject_area; ?>"><button class="btn"  style="word-wrap:normal; color:green; font-size:14px;" "><?php echo $gauge['details'][0]->short_name; ?><button/> </a>'
    },

    pane: {
      startAngle: -150,
      endAngle: 150,
      background: [{
        backgroundColor: {
          linearGradient: {
            x1: 0,
            y1: 0,
            x2: 0,
            y2: 1
          },
          stops: [
            [0, '#FFF'],
            [1, '#333']
          ]
        },
        borderWidth: 0,
        outerRadius: '0%'
      }, {
        backgroundColor: {
          linearGradient: {
            x1: 0,
            y1: 0,
            x2: 0,
            y2: 1
          },
          stops: [
            [0, '#333'],
            [1, '#FFF']
          ]
        },
        borderWidth: 0,
        outerRadius: '0%'
      }, {
        // default background
      }, {
        backgroundColor: '#EFF',
        borderWidth: 0,
        outerRadius: '0%',
        innerRadius: '50%'
      }]
    },

    // the value axis
    yAxis: {
      min: 0,
      max: 100,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 12,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 13,
        tickColor: '#666',
        labels: {
            step: 2,
            rotation: 'auto'
        },
      title: {
        text: 'Target <?php echo $current_target=$gauge['data'][0]->current_target; ?> %'
      },
      plotBands: [<?php echo $gauge['config'][0]->config_json; ?> ]
    },

    series: [{
      name: '<?php echo $gauge['details'][0]->indicator_statement; ?> ',
      data: [<?php echo $current_value=round($gauge['data'][0]->current_value); ?>],
      tooltip: {
        valueSuffix: ' %'
      }
    }],
     credits: {
        enabled: false
     }

  },
  // Add some life
  function(chart) {
    if (!chart.renderer.forExport) {
      setInterval(function() {
        var point = chart.series[0].points[0],
          newVal,
          inc = Math.round((Math.random() - 0.5) * 1);

        newVal = point.y + inc;
        if (newVal < 0 || newVal > 100) {
          newVal = point.y - inc;
        }

        point.update(newVal);

      }, 3000);
    }
  });
 </script>
  



<!-- Modal -->
<div class="modal fade" id="modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="staticBackdropLabel">Add Subject</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
      <div class="modal-body">
        
               
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    
      </div>
    </div>
  </div>
</div>