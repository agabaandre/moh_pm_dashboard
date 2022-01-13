


<style>
.highcharts-figure{
    background:#FEFFFF;
    
}
</style>

<?php 

if($this->uri->segment(1)=="dashboard"){
    
    $col="col-md-12  offset-2";
}
else{
    $col="col-md-12 offset-2";
}

foreach($tests as $test){

   foreach($test as $ftest){
   }
}
                            
?>
<div class="col-md-12">
    <div class="row">
        <?php //print_r($this->uri->segment(3)); ?>
        <ul class="nav nav-tabs">
                <?php
                $dimsub=Modules::run("data/getdimSubject",$this->uri->segment(3)); 
                ?>
                <li class=""> <a href="<?php echo base_url().'data/kpidata/'.$this->uri->segment(3).'/'.$dimsub; ?>" class="dropdown-item">Trend</a> </li>

                <?php
                
                        $dim1=Modules::run('data/dimalldisplay',$this->uri->segment(3));

                                    foreach ($dim1 as $dim){ ?>
                                        <li class="<?php if ($this->uri->segment(2)=='dimension1') { echo ''; } ?>"> <a href="<?php echo base_url().'data/dimension1/'.$dim->kpi_id.'/'.$dimsub; ?>" class="dropdown-item"><?php echo $dim->dimension1_key; ?></a> </li>
                                        <li class="active <?php if ($this->uri->segment(2)=='dimension2') { echo ''; } ?>"> <a href="<?php echo base_url().'data/dimension2/'.$dim->kpi_id.'/'.$dimsub; ?>" class="dropdown-item"><?php echo $dim->dimension2_key; ?></a> </li>
                                        <li class="<?php if ($this->uri->segment(2)=='dimension3') { echo ''; } ?>"> <a href="<?php echo base_url().'data/dimension3/'.$dim->kpi_id.'/'.$dimsub;?>" class="dropdown-item"><?php echo $dim->dimension3_key; ?></a> </li> 
                                    <?php    }  
                        ?>
</ul>
</div>

<div class="row" >
        <form method="post" class="form-horizontal" action="<?php echo base_url('data/dimension2/').$this->uri->segment(3).'/'.$dimsub; ?>" style="width:50%; margin:10px;">
        <label>Select Limit </label>
        <select class="js-example-basic-single" name="dimension1">
        <?php 
         $dim1vals=Modules::run('data/dim1s',$this->uri->segment(3));
        foreach ($dim1vals as $dim1val): ?>

          <option value="<?php echo  $dim1val->dimension1;?>"><?php echo $dim1val->dimension1;?></option>

        <?php

         endforeach;
       ?>
       </select>

       <p>Showing Data: <?php echo $this->input->post('dimension1'); ?></p>

       <button type="submit" class="btn btn-success">Apply</button>
       <a href="<?php echo base_url('data/dimension2/').$this->uri->segment(3).'/'.$dimsub; ?>" class="btn btn-success">Reset</a>

    

        </form>
</div>
</div>
<!--Trends-->
  
   <div class="<?php echo $col ?>" style="text-align:center; background-color:#feffff;">
   
        <div id="line<?php echo $chartkpi; ?>"> 
         </div>


</div>
       
    
   


<?php require("includes/trend2js.php") ?>




