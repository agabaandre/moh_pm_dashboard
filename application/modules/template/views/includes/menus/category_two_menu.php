<?php 
$subjects=Modules::run('kpi/subjectData');

foreach ($subjects as $subject):
  ?>
<li class="treeview <?php if ($subject->id == $this->uri->segment(3)||$subject->id == $this->uri->segment(4)){ echo "active"; } ?>" >
 <?php 

 $url =  base_url()."data/subject/".$subject->id."/".str_replace("+","_",urlencode($subject->name)); 
 ?>

    <a  href="" 
        title="<?php echo $subject->name; ?>"  
        target="_self"  
        onclick="openUrl('<?php echo $url; ?>');">

        <i class="fa fa-<?php echo $subject->icon;?>"></i>
        <span>
            <?php echo ellipsize($subject->name,28,1); ?>
        </span>
        <span class="pull-right-container pull-right">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <?php 

      $outComeKpis = Modules::run('Kpi/categoryKpi',$subject->id,1);
      $outPutKpis  = Modules::run('Kpi/categoryKpi',$subject->id,2);

      $outComeUrl =  base_url()."data/subject/".$subject->id."/".str_replace("+","_",urlencode($subject->name))."_Outcome_KPIs/1";  
      $outPutUrl =  base_url()."data/subject/".$subject->id."/".str_replace("+","_",urlencode($subject->name))."_Output_KPIs/2"; 

        $outComeActive = (($subject->id == $this->uri->segment(3)||$subject->id == $this->uri->segment(4)) && $this->uri->segment(5)==1)?true:false;

       $outPutActive = (($subject->id == $this->uri->segment(3)||$subject->id == $this->uri->segment(4)) && $this->uri->segment(5)==2)?true:false;
    ?>
    <ul class="treeview-menu">

        <?php if( count($outComeKpis)>0): ?>

        <li class="treeview <?php echo ($outComeActive)?'active':''; ?>">
             <a  href="#" 
                target="_self"  
                onclick="openUrl('<?php echo $outComeUrl; ?>');">
                <span>Outcome</span>
                <ul class="treeview-menu">
                  <?php foreach ($outComeKpis as $kpi): ?>
                     <li data-toggle="tooltip" data-placement="right" title="<?php echo $kpi->short_name; ?>" style="z-index:1000;" >
                        <a href="<?php echo base_url().'data/kpiData/'.$kpi->kpi_id.'/'.$subject->id; ?>" class="text-truncate"><?php echo $kpi->short_name; ?></a> </li>
                     <?php endforeach; ?>
                </ul>
            </a>
        </li>
       <?php 
        endif; 

        if( count($outPutKpis)>0): ?>

        <li class="treeview <?php echo ($outPutActive )?'active':''; ?>">
             <a  href="#" 
                title="Output KPIs"
                target="_self"  
                onclick="openUrl('<?php echo $outPutUrl; ?>');">
                <span>Output</span>
                <ul class="treeview-menu">
                  <?php foreach ($outPutKpis as $kpi): ?>
                     <li data-toggle="tooltip" data-placement="right" title="<?php echo $kpi->short_name; ?>" style="z-index:1000;" ><a href="<?php echo base_url().'data/kpiData/'.$kpi->kpi_id.'/'.$subject->id; ?>" class="text-truncate"><?php echo $kpi->short_name; ?></a> </li>
                     <?php endforeach; ?>
                </ul>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</li>

<?php  endforeach;  ?>
   