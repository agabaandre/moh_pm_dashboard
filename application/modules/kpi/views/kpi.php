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
                          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop" style="margin-bottom:3px; width:150px;"><i class="fa fa-plus" >
                            </i>Add KPI
                            </button>
                            <form action="<?php echo base_url()?>kpi/updateKpi" method="post">
                            <button type="submit" class="btn btn-success"  style="margin-bottom:3px; width:150px;" disabled><i class="fa fa-circle">
                            </i>Update KPI
                            </button>
                        
                            <div class="card-content">

                                    <table id="kpi"  class="table table-striped table-bordered table-responsive ">
                                 
                            
                                            <thead>
                                            <tr>
                                                <th  width="5%">#</th>
                                                <th  width="10%">KPI ID</th>
                                                <th  width="10%"><?php echo (uses_category())?'Objective':'Subject Area'; ?></th>
                                                <th  width="40%">Short Name</th>
                                                <th  width="10%">Indicator Statement</th>
                                                <th  width="5%">Description</th>
                                                <th  width="5%">Data Sources</th>
                                                <th  width="5%">Computation</th>
                                                <th  width="5%">Frequency</th>
                                                <th  width="5%">Target</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php 

                                                    $i=1;
                                                    $elements=Modules::run('Kpi/kpiData');

                                                    foreach($elements as $element):
                                                    ?>

                                                <tr class="table-row tbrow content strow">
                                                    <td><?php echo $i ?></td>
                                                    <td><input type="text" class="form-control" name="kpi_id[]" value="<?php echo $element->kpi_id; ?>" style="border:#000 none; width:70%;" readonly></td>
                                                    
                                                    <td>
                                                        <?php if(!uses_category()): ?>
                                                            <?php echo  $element->name; ?>
                                                            <input type="hidden" name="subject_area[]" value="<?php echo $element->sid; ?>">
                                                        <?php else: 
                                                             $obj = objective($element->category_two_id); 
                                                            echo  $obj->cat_name; 
                                                        ?>
                                                        <input type="hidden" name="category_two_id[]" value="<?php echo $obj->id; ?>">
                                                    <?php endif; ?>
                                                    </td>

                                                    <input type="hidden" name="is_cumulative[]" value="<?php echo $element->is_cumulative; ?>">
                                                    <td><textarea name="short_name[]" rows=4 class="form-control" style="border:#000  none; width:90%;"><?php echo $element->short_name; ?></textarea></td>
                                                    <td><textarea name="indicator_statement[]" rows=4 class="form-control" style="border:#000  none; width:90%;"><?php echo $element->indicator_statement; ?></textarea></td>
                                                    <td><textarea name="description[]" rows=4 class="form-control" style="border:#000  none; width:95%;"><?php echo $element->description; ?></textarea></td>
                                                    <td><textarea name="data_sources[]" rows=4 class="form-control" style="border:#000  none; width:80%;"><?php echo $element->data_sources; ?></textarea></td>
                                                    <td><textarea name="computation[]" rows=5 class="form-control" style="border:#000  none; width:82%;"><?php echo $element->computation; ?></textarea></td>
                            
                                                    <td>
                                                    <select name="frequency[]" class="form-control codeigniterselect">
                                                    <?php $periods=array("Quarterly","Monthly","Weekly","Annualy");
                                                    
                                                    
                                                    foreach ($periods as $period):
                                                    ?>
                                                    <option value="<?php echo $period; ?>" <?php if ($period==$element->frequency){ echo "selected"; } ?>><?php echo $period; ?></option>
                                                    <?php endforeach; ?>
                                                    </select>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="current_target[]" value="<?php echo $element->current_target; ?>" style="border:#000 none; width:70%;"></td>
                                                </tr>
                                                    <?php 
                                                        $i++;
                                                    endforeach; 

                                                    if(count($elements)==0){

                                                        echo "<tr><td colspan='8'><center><h3 class='text-warning'>Please Add Indicators</h3></center></td></tr>";
                                                    }
                                                        ?>
                                            </tr>
                                                                
                                        </tbody>
                                    </form>
                                    </table>
                               </div>
                           </div> 
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

<?php $this->load->view('add_kpi');?>

<script>
 $(document).ready(function() {
    $('#kpi').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
</script>