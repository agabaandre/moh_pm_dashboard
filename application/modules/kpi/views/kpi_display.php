<style>
    input {
        clear:both;
        padding:4px;
        border:0px #FFF;

    }
</style>
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
                        <!-- Button trigger modal -->
                       
                            <div class="card-content">
                            <form class="form" action="<?php echo base_url(); ?>kpi/insertDisplayData" method="post">
                                                 
                           <button type="submit" class="btn btn-success" style="margin-bottom:3px;"><i class="fa fa-plus">
                            </i>Save KPI
                            </button>
                        

                                    <table id="kpi"  class="table table-responsive table-striped table-bordered">
                                    
                            
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>KPI ID</th>
                                                <th>Subject Area</th>
                                                <th>Indicator Statement</th>
                                                <th style="width:13%;">Subject Area Display Index</th>
                                                <th style="width:13%;">Dashboard Display Index</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                  <?php 

                                               
                                                    $i=1;
                                                $elements=Modules::run('Kpi/kpiDisplayData');
                                                    foreach($elements as $element):?>

                                                <tr class="table-row tbrow content strow">
                                                    <td><?php echo $i ?></td>
                                                    <td style="width:20%;"><input type="text" style="width:50%;" class="form-control" value="<?php echo $element->kpi_id; ?>" name="kpi_id[]"></td>
                                                    <td><?php echo  $element->name; ?></td>
                                                    <td><?php echo $element->indicator_statement; ?></td>
                                                     <td style="width:20%;"> <input type="tel" style="width:40%;"class="form-control" value="<?php echo $element->dashboard_index; ?> " name="dashboard_index[]"></td>
                                                     <td style="width:20%;"> <input type="tel" style="width:40%;"class="form-control" value="<?php echo $element->subject_index; ?> " name="subject_index[]"></td>
                                                   


                                                
    
                                                    
                                                </tr>
                                                    <?php 
                                                        $i++;
                                                    endforeach; 

                                                    if(count($elements)==0){

                                                        echo "<tr><td colspan='8'><center><h3 class='text-warning'>Please Add Indicators</h3></center></td></tr>";
                                                    }
                                                        ?>
                                            </tr>

                                            </form>
                                                                
                                        </tbody>
                                    </table>
                               </div>
                           </div> 
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>


