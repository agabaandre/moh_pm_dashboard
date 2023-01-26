
                        


<style>
.highcharts-figure{
    background:#FEFFFF;
    
}
</style>

<?php 

if(($this->uri->segment(1)=="dashboard")||($this->uri->segment(1)=="")){
    
    $col="col-md-".$setting->dash_rows. " offset-2";
    }
    else{
        $col="col-md-".$setting->kpi_rows. " offset-2";
    }
                                
?>

<!--gauge-->
   <div class="<?php echo $col ?>" style="text-align:center;  padding:4px; margin-bottom:40px;">
   
    <div id="gauge<?php echo $chartkpi; ?>">
    </div>
    <div class="" style="background:#FEFFFF;font-size:12px;"> 
   <?php 
   
  
   echo $kstatus=Modules::run("data/kpiTrend",$gauge['data']->current_target,$gauge['data']->current_value,$gauge['data']->previous_value,$gauge['data']->cp,$gauge['data']->pp);
   
   ?>
   <br>
  
  </div>
</div>
       
<?php require("includes/gaugejs.php"); ?>

  








      