 
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
                        <!-- Add Subject -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop" style="margin-bottom:3px;"><i class="fa fa-plus">
                            </i>Add Institution Category
                            </button>
                        
                            <div class="card-content">
                                <table id="category" class="table table-responsive table-striped table-bordered">
                    
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Institution</th>
                                        
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i=1;
                                        $elements=Modules::run('kpi/info_category_Data');
                                            foreach($elements as $element):?>

                                        <tr class="table-row tbrow content strow">
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $element->name; ?></td>
                                         
                                            
                                            
                                            
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
                                 </table>
                               </div>
                           </div> 
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

<?php $this->load->view('add_info_category');?>

    <script>
$(document).ready(function() {
    $('#category').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        responsive: true,
        displayLength: 25,
        lengthChange: true
    } );
} );
</script>                      