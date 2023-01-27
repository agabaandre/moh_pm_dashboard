
<div class="content">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h2>KPI Reporting Rates by Department</h2>
                        </div>
                    </div>
                    <div class="panel-body">
                    

                             <?php   
                                            
                                $subs=Modules::run('dashboard/slider/getsubjects');
                                 $i = 1;
                                 foreach($subs as $sub):
                                ?>
                              
                          
                                         
                                <table id="subject" class="table table-responsive table-striped table-bordered" style="width:100%;">
                                

                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Indicator Statement</th>
                                                <th>Quater 1</th>
                                                <th>Quater 2</th>
                                                <th>Quater 3</th>
                                                <th>Qauter 4</th>
                    
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $kpis=Modules::run('dashboard/slider/getkpi',$sub->id);
                                                        $i = 1;
                                              
                                                        foreach($kpis as $kpi):
                                                        $kpi_ids = $kpi->kpi_id;
                                                        $data = Modules::run('dashboard/slider/getsummaries', $kpi->kpi_id);

                                                  //  echo sizeof((array)$data);
                                                        ?>
                                            <tr>
                                                
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $kpi->indicator_statement;?></td>
                                                <td><?php echo @$data->financial_year; ?></td>
                                                <td><?php echo @$data->cp; ?></td>
                                                <td ><?php echo @$data->current_target;  ?></td>
                                                <td  <?php

                                                        echo Modules::run("kpi/kpiTrendcolors", @$data->current_target, @$data->current_value, @$data->previous_value, @$data->cp, @$data->pp);
                                                        ?>><?php echo @$data->current_value;
                                                if (@$data->current_value) {
                                                  } ?></td>
                                                <td style="width:13%;"><?php echo @$data->previous_value; ?></td>
                    
                                            </tr>


                                            <?php endforeach;?>

                                                    
                                           </tbody>
                                           <tfoot>
                                            <tfoot>
                                    </table>
                        </div>

            
                                  
                                      
                                    
                                    <?php endforeach;?>
                    </div>
                    <div class="panel-footer">
                     
                    </div>
                </div>
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->