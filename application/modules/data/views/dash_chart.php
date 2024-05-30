
                        


<style>
.highcharts-figure{
    background:#FEFFFF;
    height: 30px!important;
    
}
</style>

<?php 

if(($this->uri->segment(1)=="dashboard")||($this->uri->segment(1)=="")){
    
    $col="col-md-".$setting->dash_rows;
    }
    else{
        $col="col-md-".$setting->kpi_rows;
    }
                                
?>

<!--gauge-->
   <div class="<?php echo $col ?>" style="text-align:center;  margin-bottom:10px;">
         <button id="kpiInfoBtn<?php echo $chartkpi; ?>" class="btn kpi-info-btn"
            style="word-wrap:normal; color:#2286c3; font-size:12px;" data-toggle="modal"
            data-target="#kpiModal<?php echo $chartkpi; ?>" data-kpi-id="<?php echo $gauge['details'][0]->kpi_id; ?>">KPI
        Info</button>
    <div id="gauge<?php echo $chartkpi; ?>">
    
    </div>
    <div class="" style="background:#FEFFFF;font-size:12px;"> 
   <?php 
   
  
   echo @$kstatus=Modules::run("data/kpiTrend",$gauge['data']->current_target,$gauge['data']->current_value,$gauge['data']->previous_value,$gauge['data']->cp,$gauge['data']->pp);
   
   ?>
   <br>
  
  </div>
</div>
       
<?php require("includes/gaugejs.php"); ?>

  








      