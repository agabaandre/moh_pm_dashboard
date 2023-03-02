
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
    <form method="post"  class="form-horizontal" action="" style="width:100%; margin:10px;">
        <label>Subject Areas </label>
                        <?php
                           //print_r($this->input->post());
                        $info_cat = $_SESSION['info_category'];
                        if (!empty($_SESSION['subject_area'])) {
                        @$id=implode(",",json_decode($_SESSION['subject_area'])); 
                       
                        $years = $this->db->query("SELECT * FROM `subject_areas` where id in ($id) and info_category=$info_cat")->result(); 
                        }
                        else
                        {
                         $years = $this->db->query("SELECT * FROM `subject_areas` WHERE info_category=$info_cat")->result(); 
                        }
                        ?>
                          <label for="cumulative" class="">Search Department</label>
                          <select class="js-example-basic-multiple" name="subject_area[]" class="form-control" multiple="multiple">
                            
                           
                           <?php
                          
                             @$ids=json_decode($_SESSION['subject_area']);
                             if(empty($ids)){
                               $ids = array();
                             }
                             foreach($years as $value): 
                                
                                ?>
                             <option value="<?php echo @$value->id;?>" <?php if (in_array(@$value->id, @$ids)) {echo "selected";} ?>>
                                <?php echo @$value->name; ?>
                             </option>
                            <?php endforeach; ?>
                            </select> 
                        
                   
       <br>
       <br>
   
       <button type="submit" class="btn btn-success">Apply</button>
         <button type="button" class="btn btn-success" style="float:right;" data-toggle="modal" data-target="#definition" style="margin-bottom:2px;">
                        <?php echo display("definition");


            ?>
        </button>

        </form>
                    <div class="card-content">
                    

                        <div id="kpitable">

                                    <table id="subject" class="table table-responsive table-striped table-bordered">
                                    
                            
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Subject Area</th>
                                                <th>Indicator Statement</th>
                                                <th>Target</th>
                                                <th>Financial Year</th>
                                                <th style="width:13%;">Current Performance</th>
                    
                                            </tr>
                                            </thead>
                                            <tbody>
                                                  <?php 
                                                    $i=1;
                                                
                                                //print_r($gauge['gauge']['data'][0]->current_target);
                                                $elements=Modules::run('Kpi/summaryData',json_encode($this->input->post('subject_area')));
                                                    foreach($elements as $element):?>

                                                <tr class="table-row tbrow content strow">
                                                    <td><?php echo $i ?></td>
                                                    <td style="width:20%;"><?php echo $element->name; ?></td>
                                                    <td><?php 
                                                    $gauge=Modules::run('Kpi/gaugeData',$id=$element->kpi_id); ?>
                                                    <a href="<?php echo base_url().'data/kpidata/'.$gauge['gauge']['details'][0]->kpi_id.'/'.$gauge['gauge']['details'][0]->subject_area; ?>" target="_self"><p class=""  style=" color:#072b41; font-size:12px;" ><?php echo $gauge['gauge']['details'][0]->short_name; ?></p></a></td>
                                                    
                                                    <td><?php echo $gauge['gauge']['data']->current_target; ?></td>
                        
                                                    <td><?php echo $gauge['gauge']['data']->financial_year; ?></td>
                                                   
                                                    <td  <?php 
                                                    
                                                    echo Modules::run("kpi/kpiTrendcolors",$gauge['gauge']['data']->current_target,$gauge['gauge']['data']->current_value,$gauge['gauge']['data']->previous_value,$gauge['gauge']['data']->cp,$gauge['gauge']['data']->pp);
                                                     ?>>
                                                     <?php echo  $gauge['gauge']['data']->current_value.'%'; ?>
                                                     </td>
                                        
                                                    
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
    



    <script>
		function printTable(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;

		}
 


    $(document).ready(function() {
    $('#subject').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            {
                extend: 'pdfHtml5',
                orientation: 'Potrait',
                pageSize: 'A4',
             
            }
        ],
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        responsive: true,
        displayLength: 25,
        lengthChange: true
    } );
} );

</script>


    


