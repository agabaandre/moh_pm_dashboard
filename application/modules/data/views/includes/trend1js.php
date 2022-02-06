<?php 


?>
<script>

    function renderGraph(data){

        Highcharts.chart('line<?php echo $chartkpi; ?>', {

        title: {
            text: '<?php echo $title ?>'
        },
        chart: {
        height: 800,
        
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
        

        // legend: {
        //     marginBottom: 70 ,
        //     layout: 'horizontal',
        //     align: 'center',
        //     verticalAlign: 'middle'
        // },

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
        url:'<?php echo  base_url()."data/dim1data/".$this->uri->segment(3); ?>',
        success:function(response){
            console.log(response);
            renderGraph(JSON.parse(response));
        }
     });

});
</script>