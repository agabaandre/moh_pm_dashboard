<div class="row">
    <div class="col-sm-12 col-md-12">
                            <?php
                                //Load KPI'S with display Index Dashboard
                               // call their modules dynamically
                               // Bug fix load kpis which only have data(in Home mode DashData function)
                               foreach ($dashkpis as $dashkpi) {

                              // print_r($dashkpi->kpi_id);
                                   

                               echo Modules::run($dashkpi->module.'/kpi',$dashkpi->kpi_id,'on');
                              
                               }

                              //print_r(json_decode($setting->font_awesome));

                              
                            ?>
                     
    </div>
</div>

 

        

<!--     
<script src="<?php echo base_url('assets/plugins/counterup/chart.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/dashboardchart.js') ?>" type="text/javascript"></script> -->
 


