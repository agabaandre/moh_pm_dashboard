<style>
 .carousel-control.left, .carousel-control.right{ 
    background: none !important;
    filter: none !important;

    
}

</style>

        <div class="row" id="fullscreendiv">
            <div class="col-sm-12 col-md-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h2>Performance</h2>
                        </div>
                    </div>
                    <div class="panel-body">
                          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >

                                 <div class="carousel-inner">
  


                                 <?php   
                                            
                                $subs=Modules::run('dashboard/slider/getsubjects');
                                //print_r($subs);
                                // die();
                                  $info_cat = $_SESSION['info_category'];
                                 $min_id = $this->db->query("SELECT min(id) as id from subject_areas where info_category= '$info_cat'")->row()->id;
                                 $i = 1;
                                 foreach($subs as $sub):
                                ?>
                                 
                                 <div class="item<?php if ($sub->id == $min_id) {
                                     echo " active";
                                 } else {
                                     echo "";
                                 }?>" style="min-height:700px;"> 
                                         <div class="col-md-12">
                                            <h2 class="text-muted green"> <?php echo $sub->name;?></h2>
                                              <hr>
                                              </div>
                                    <table id="subject" class="table table-responsive table-striped table-bordered" style="width:100%;">
                                    
                            

                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Indicator Statement</th>
                                                <th>Financial Year</th>
                                                <th>Period</th>
                                                <th style="width:13%;">Target</th>
                                                <th style="width:13%;">Current Performance</th>
                                                <th style="width:13%;">Previous Performance</th>
                    
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
                                                <td><a href="<?php echo base_url() . 'data/kpidata/' . $kpi->kpi_id . '/' . $sub->id; ?>" target="_blank"><?php echo $kpi->indicator_statement;?></a></td>
                                                <td><?php echo @$data->financial_year; ?></td>
                                                <td><?php echo @$data->cp; ?></td>
                                                <td ><?php echo @$data->current_target;  ?></td>
                                                <td  <?php

                                                        echo Modules::run("kpi/kpiTrendcolors", @$data->current_target, @$data->current_value, @$data->previous_value, @$data->cp, @$data->pp);
                                                        ?>><?php
                                                            if (@$data->current_value) {
                                                                echo @$data->current_value;
                                                            } 
                                                            else{
                                                            echo "No Data";
                                                            }
                                                            ?>
                                                </td>
                                                <td style="width:13%;">
                                                    <?php
                                                    if ($data->previous_value) {
                                                        echo @$data->previous_value;
                                                    } else {
                                                        echo "No Data";
                                                    }
                                                    ?>
                                            </td>
                    
                                            </tr>


                                            <?php endforeach;?>

                                                    
                                           </tbody>
                                           <tfoot>
                                        
                                            <tfoot>
                                    </table>
                                     </div>

            
                                  
                                      
                                    
                                    <?php endforeach;?>
                                      </div>
                                      </div>
                                    

                   

    
  


  </div>
  <a class="left carousel-control" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>





                
   

                    </div>
                    <div class="panel-footer">
                     
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /.content -->
