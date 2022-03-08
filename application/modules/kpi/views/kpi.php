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
                            <button type="submit" class="btn btn-success"  style="margin-bottom:3px; width:150px;"><i class="fa fa-circle">
                            </i>Update KPI
                            </button>
                        
                            <div class="card-content">

                                    <table id="kpi"  class="table table-responsive table-striped table-bordered">
                                 
                            
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>KPI ID</th>
                                                <th>Subject Area</th>
                                                <th>Short Name</th>
                                                <th>Indicator Statement</th>
                                                <th>Description</th>
                                                <th>Data Sources</th>
                                                <th>Computation</th>
                                                <th>Frequency</th>
                                                <th>Target</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $i=1;
                                                $elements=Modules::run('Kpi/kpiData');
                                                    foreach($elements as $element):?>

                                                <tr class="table-row tbrow content strow">
                                                    <td><?php echo $i ?></td>
                                                    <td style="width:10%;"><input type="text" class="form-control" name="kpi_id[]" value="<?php echo $element->kpi_id; ?>" style="border:#000 none; width:70%;" readonly></td>
                                                    <td><?php echo  $element->name; ?></td>
                                                    <input type="hidden" name="subject_area[]" value="<?php echo $element->sid; ?>">
                                                    <input type="hidden" name="is_cumulative[]" value="<?php echo $element->is_cumulative; ?>">
                                                    <td style="width:20%;"><textarea name="short_name[]" rows=4 class="form-control" style="border:#000  none; width:90%;"><?php echo $element->short_name; ?></textarea></td>
                                                    <td style="width:20%;"><textarea name="indicator_statement[]" rows=4 class="form-control" style="border:#000  none; width:90%;"><?php echo $element->indicator_statement; ?></textarea></td>
                                                    <td style="width:40%;"><textarea name="description[]" rows=4 class="form-control" style="border:#000  none; width:95%;"><?php echo $element->description; ?></textarea></td>
                                                    <td style="width:15%;"><textarea name="data_sources[]" rows=4 class="form-control" style="border:#000  none; width:80%;"><?php echo $element->data_sources; ?></textarea></td>
                                                    <td style="width:25%;"><textarea name="computation[]" rows=5 class="form-control" style="border:#000  none; width:82%;"><?php echo $element->computation; ?></textarea></td>
                            
                                                    <td>
                                                    <select name="frequency[]" class="form-control codeigniterselect">
                                                    <?php $periods=array("Quarterly","Monthly","Weekly","Annualy");
                                                    
                                                    
                                                    foreach ($periods as $period):
                                                    ?>
                                                    <option value="<?php echo $period; ?>" <?php if ($period==$element->frequency){ echo "selected"; } ?>><?php echo $period; ?></option>
                                                    <?php endforeach; ?>
                                                    </select>
                                                    </td>
                                                    <td style="width:10%;"><input type="text" class="form-control" name="current_target[]" value="<?php echo $element->current_target; ?>" style="border:#000 none; width:70%;"></td>
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
            {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            pageSize: 'LEGAL' }
        ]
    } );
} );
</script>