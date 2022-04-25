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
        url:'<?php echo  base_url()."data/dim1data/".$this->uri->segment(3);?>',
        success:function(response){
            //console.log(response);
            renderGraph(JSON.parse(response));
        }
     });

});
</script>

<script>
$("#trend1").submit(function(e) {

e.preventDefault(); // avoid to execute the actual submit of the form.

var form = $(this);
var actionUrl = form.attr('action');

$.ajax({
    type: "POST",
    url: '<?php echo  base_url()."data/dim1data/".$this->uri->segment(3);?>',
    data: form.serialize(), // serializes the form's elements.
    success: function(data)
    {
      renderGraph(JSON.parse(data));
      console.log(data); // show response from the php script.
    }
});

});

</script>