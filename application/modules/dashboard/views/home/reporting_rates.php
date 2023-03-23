
<div class="content">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h2>KPI Reporting Rates</h2>
                        </div>
                    </div>
                    <div class="col-md-12 text-align-center"><h4>Financial Year: <?php echo $this->session->userdata('financial_year'); ?></h4>   </div>
                    <div class="panel-body">   
                               
                                <table id="subject" class="table table-responsive table-striped table-bordered" style="width:100%;">
                                
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Department</th>
                                                <th>Quater 1</th>
                                                <th>Quater 2</th>
                                                <th>Quater 3</th>
                                                <th>Qauter 4</th>
                    
                                            </tr>
                                            </thead>
                                            <tbody>
                                              <?php   
                                            
                                                $subs=Modules::run('dashboard/slider/getsubjects');
                                                $i = 1;
                                              foreach ($subs as $sub):
                                                  $fy = $this->session->userdata('financial_year');
                                                  $q1_val = Modules::run('dashboard/slider/get_reporting_rate',$sub->id,'Q1',$fy);
                                                  $q2_val = Modules::run('dashboard/slider/get_reporting_rate',$sub->id, 'Q2',$fy);
                                                  $q3_val = Modules::run('dashboard/slider/get_reporting_rate', $sub->id, 'Q3',$fy);
                                                  $q4_val = Modules::run('dashboard/slider/get_reporting_rate', $sub->id, 'Q4',$fy);
                                                  ?>
                                            
                                            <tr>
                                                
                                                <td><?php echo $i++;?></td>
                                                <td><a href="<?php echo base_url().'data/subject/'.$sub->id.'/'. $sub->name?>"><?php echo $sub->name;?></a></td>
                                                
                                                <td <?php echo $q1_val->color; ?>><?php echo $q1_val->report_status; ?></td>
                                                <td <?php echo $q2_val->color; ?>><?php echo $q2_val->report_status; ?></td>
                                                <td <?php echo $q3_val->color; ?>><?php echo $q3_val->report_status;  ?></td>
                                                <td <?php echo $q4_val->color; ?>><?php echo $q4_val->report_status; ?></td>


                                            <?php endforeach;?>

                                                    
                                           </tbody>
                                       
                                    </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                     
                    </div>
                </div>
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->