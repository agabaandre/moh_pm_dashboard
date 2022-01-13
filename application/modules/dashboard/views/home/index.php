<div class="row">




    <div class="col-sm-12 col-md-12">

    
 

        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div> 
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                        
                            <div class="card-content">
                             <?php

          
 ?>
          
                        <div class="col-lg-12">
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
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

 

        

    
        <script src="<?php echo base_url('assets/plugins/counterup/chart.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/dashboardchart.js') ?>" type="text/javascript"></script>
 


