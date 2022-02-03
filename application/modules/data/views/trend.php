


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

// foreach($tests as $test){

//    foreach($test as $ftest){
//    }
// }
                            
?>
<div class="col-md-12">
    <div class="row">
        <?php //print_r($this->uri->segment(3)); ?>
        <ul class="nav nav-tabs">

                       <?php
                     $dimsub=Modules::run("data/getdimSubject",$this->uri->segment(3)); 
                        ?>
                         <li class="active"> <a href="<?php echo base_url().'data/kpidata/'.$this->uri->segment(3).'/'.$dimsub; ?>" class="dropdown-item">Trend</a> </li>
                     
                        <?php
                        

                     
                     


                        $dim1=Modules::run('data/dimalldisplay',$this->uri->segment(3));

                       // print_r($dim1);

                        foreach ($dim1 as $dim){ ?>
                         <li class="<?php if ($this->uri->segment(2)=='dimension1') { echo ''; } ?>"> <a href="<?php echo base_url().'data/dimension1/'.$dim->kpi_id.'/'.$dimsub; ?>" class="dropdown-item"><?php echo $dim->dimension1_key; ?></a> </li>
                         <li class="<?php if ($this->uri->segment(2)=='dimension2') { echo ''; } ?>"> <a href="<?php echo base_url().'data/dimension2/'.$dim->kpi_id.'/'.$dimsub; ?>" class="dropdown-item"><?php echo $dim->dimension2_key; ?></a> </li>
                        <li class="<?php if ($this->uri->segment(2)=='dimension3') { echo ''; } ?>"> <a href="<?php echo base_url().'data/dimension3/'.$dim->kpi_id.'/'.$dimsub;?>" class="dropdown-item"><?php echo $dim->dimension3_key; ?></a> </li>
                    
                       <?php   
          
                       ?>

                      

                    
                       <?php    }  
                       
                       
                       ?>
        </ul>
</div>

</div>
<!--Trends-->
  
   <div class="<?php echo $col ?>" style="text-align:center; background-color:#feffff;">
   
        <div id="line<?php echo @$chartkpi; ?>"> 
         </div>


</div>
       
    
   


<?php require("includes/trendjs.php") ?>




