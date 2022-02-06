<div class="row">
    <div class="col-sm-12 col-md-12">
                            <?php
                                //Load KPI'S with display Index Dashboard
                               // call their modules dynamically
                               // Bug fix load kpis which only have data(in Home mode DashData function)
                               foreach ($dashkpis as $dashkpi) {
                               echo Modules::run($dashkpi->module.'/kpi',$dashkpi->kpi_id,'on');
                               }

                              
                            ?>  
    </div>
</div>

 
