
       
       <style>
           @import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);

body {
    background-color: #D32F2F;
    font-family: 'Calibri', sans-serif !important
}

.mt-100 {
    margin-top: 100px
}

.mb-100 {
    margin-bottom: 100px
}

.card {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0px solid transparent;
    border-radius: 0px
}

.card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem
}

.card .card-title {
    position: relative;
    font-weight: 600;
    margin-bottom: 10px
}

.comment-widgets {
    position: relative;
    margin-bottom: 10px
}

.comment-widgets .comment-row {
    border-bottom: 1px solid transparent;
    padding: 14px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin: 10px 0
}

.p-2 {
    padding: 0.5rem !important
}

.comment-text {
    padding-left: 15px
}

.w-100 {
    width: 100% !important
}

.m-b-15 {
    margin-bottom: 15px
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.76563rem;
    line-height: 1.5;
    border-radius: 1px
}

.btn-cyan {
    color: #fff;
    background-color: #27a9e3;
    border-color: #27a9e3
}

.btn-cyan:hover {
    color: #fff;
    background-color: #1a93ca;
    border-color: #198bbe
}

.comment-widgets .comment-row:hover {
    background: rgba(0, 0, 0, 0.05)
}
</style>
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
    <form method="post"  class="form-horizontal" action="" style="width:50%; margin:10px;">
        <label>Subject Areas </label>
                        <?php
                           //print_r($this->input->post());
                        @$id=implode(",",json_decode($_SESSION['subject_area'])); 
                        if(!empty($id)){
                        $years = $this->db->query("SELECT * FROM `subject_areas` where id in ($id)")->result(); 
                        }
                        else
                        {
                         $years = $this->db->query("SELECT * FROM `subject_areas`")->result(); 
                        }
                        ?>
                          <label for="cumulative" class="">Department</label>
                          <select class="js-example-basic-multiple" name="subject_area[]" class="form-control" multiple="multiple">
                            
                           
                           <?php
                          
                             $ids=json_decode($_SESSION['subject_area']);
                             foreach($years as $value): 
                                
                                ?>
                             <option value="<?php echo $value->id;?>" <?php if (in_array($value->id, $ids)) {echo "selected";} ?>>
                                <?php echo $value->name; ?>
                             </option>
                            <?php endforeach; ?>
                            </select> 
                        
                   
       <br>
       <br>
   
       <button type="submit" class="btn btn-success">Apply</button>


        </form>
                    <div class="card-content">
                      
                        <div class="col-md-6">    
                        <a href="<?php echo base_url()?>kpi/printsummary/print_summary/<?php echo urlencode(json_encode($this->input->post('subject_area'))); ?>" class="btn btn-success"><i class="fa fa-print"  ></i>Print</a>
                        </div>
                        <div class="col-md-6">
                        <button type="button" class="btn btn-success" style="float:right;" data-toggle="modal" data-target="#definition">
                        <?php echo display("definition"); ?>
                        </button>
                        
                        </div>

                        <div id="kpitable">

                                    <table id="kpi"  class="table table-responsive table-striped table-bordered print table">
                                    
                            
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Subject Area</th>
                                                <th>Indicator Statement</th>
                                                <th>Target</th>
                                                <th>Comments</th>
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
                                                    
                                                    <td><?php echo $gauge['gauge']['data'][0]->current_target; ?></td>
                                                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $element->kpi_id ?>"><i class="fa fa-info"></i>                                                      
                                                    </button></td>
                                                    <td><?php echo $gauge['gauge']['data'][0]->financial_year; ?></td>
                                                   
                                                    <td  <?php 
                                                    
                                                    echo Modules::run("kpi/kpiTrendcolors",$gauge['gauge']['data'][0]->current_target,$gauge['gauge']['data'][0]->current_value,$gauge['gauge']['data'][0]->previous_value,$gauge['gauge']['data'][0]->cp,$gauge['gauge']['data'][0]->pp);
                                                     ?>>
                                                     <?php echo  $gauge['gauge']['data'][0]->current_value.'%'; ?>
                                                     </td>
                                                  <!-- Modal -->
                                                <div class="modal fade" id="exampleModal<?php echo $element->kpi_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $gauge['gauge']['details'][0]->short_name; ?> Performance Comments</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        
                                                            <div class="card">
                                                                <div class="card-body text-center">
                                                                    <h4 class="card-title">Latest Performance Comment</h4>
                                                                </div>
                                                                <?php 
                                                                $this->db->query("SELECT comments from new_data where kpi_id='$id' LIMIT 10 order by ");
                                                                foreach ($comments as $comment): ?>
                                                                
                                                                    <!-- Comment Row -->
                                                                    <div class="d-flex flex-row comment-row m-t-0">
                                                                        <div class="p-2"><?php echo $element->kpi_id ?></div>
                                                                        <div class="comment-text w-100">
                                                                            <h6 class="font-medium"><?php ?></h6> <span class="m-b-15 d-block"><?php  ?></span>
                                                                        </div>
                                                                    </div> <!-- Comment Row -->
                                                              
                                                                    
                                                                    
                                                            </div> <!-- Card -->
                                                            <?php endforeach; ?>
                                                          
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                               <!--end-->     </div>
                                                </div>
                                                </div>
                                                    
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
	</script>


