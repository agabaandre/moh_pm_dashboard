
                        


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
   
  
   echo $kstatus=Modules::run("data/kpiTrend",$gauge['data'][0]->current_target,$gauge['data'][0]->current_value,$gauge['data'][0]->previous_value,$gauge['data'][0]->cp,$gauge['data'][0]->pp);
   
   ?>
   <br>
  
  </div>
</div>
       
<?php require("includes/gaugejs.php"); ?>

  








      