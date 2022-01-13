<?php 

?>
<script>

    function renderGraph(data){

        Highcharts.chart('line<?php echo $chartkpi; ?>', {

        title: {
            text: '<?php echo $title ?>'
        },

        subtitle: {
            text: ''
        },

        yAxis: {
            title: {
                text: 'Score (%)'
            }
        },

        xAxis: {
            
            categories:data.quaters
            },
        

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                    enableMouseTracking: true

            }
        },
        credits: {
                enabled: false
        },

        series: data.data,
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
};

$(document).ready(function(){

    $.ajax({
        url:'<?php echo  base_url()."data/dim2data/".$this->uri->segment(3).'/'.urlencode(str_replace(" ","_",$this->input->post('dimension1'))); ?>',
        success:function(response){
            
            console.log(response);
            renderGraph(JSON.parse(response));
        }
     });

});
</script>