


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
   <div class="<?php echo $col ?>" style="text-align:center; background-color:#feffff; padding:20px; margin-bottom:40px;">
   
    <div id="gauge<?php echo $chartkpi; ?>"></div>

   <?php 

   echo $kstatus=Modules::run("data/kpiTrend",$gauge['data'][0]->current_target,$gauge['data'][0]->current_value,$gauge['data'][0]->previous_value,$gauge['data'][0]->cp,$gauge['data'][0]->pp);
   
   ?>
   <br>

  </div>
       
<?php require("includes/gaugejs.php"); ?>

  







