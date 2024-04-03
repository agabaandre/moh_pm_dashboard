
<script>
Highcharts.setOptions({
    chart: {
        inverted: true,
        marginLeft: 0,
        type: 'bullet'
    },
  
    legend: {
        enabled: false
    },
    yAxis: {
        gridLineWidth: 0
    },
    plotOptions: {
        series: {
            pointPadding: 0.25,
            borderWidth: 0,
            color: '#000',
            targetOptions: {
                width: '200%'
            }
        }
    },
    credits: {
        enabled: false
    },
    exporting: {
        enabled: false
    }
});

Highcharts.chart('gauge<?php echo $chartkpi; ?>', {
    chart: {
        marginTop: 40
    },
     subtitle: {
      text: '<a href="<?php echo base_url() . 'data/kpidetails/' . $gauge['details'][0]->kpi_id . '/' . $gauge['details'][0]->subject_area; ?>"><button class="btn"  style="word-wrap:normal; color:#2286c3; font-size:11px;" ><?php echo "KPI Info"; ?> <button/> </a>'
    },
    
    title: {        
      text: '<a href="<?php echo base_url() . 'data/kpidata/' . $gauge['details'][0]->kpi_id . '/' . $gauge['details'][0]->subject_area; ?>"><button class="btn"  style="word-wrap:normal; color:#3f424a; font-size:12.5px; " ><?php echo trim($gauge['details'][0]->short_name); ?><button/> </a>'
    },
    xAxis: {
        categories: ['<span class="hc-cat-title">Indicator Performance</span><br/>U.S. $ (1,000s)']
    },
    yAxis: {
        plotBands: [{
            from: 0,
            to: 150,
            color: '#666'
        }, {
            from: 150,
            to: 225,
            color: '#999'
        }, {
            from: 225,
            to: 9e9,
            color: '#bbb'
        }],
        title: null
    },
    series: [{
        data: [{
            y: 275,
            target: <?php echo $current_target = $gauge['data']->current_target; ?> 
        }]
    }],
    tooltip: {
        pointFormat: '<b>{point.y}</b> (with target at {point.target})'
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