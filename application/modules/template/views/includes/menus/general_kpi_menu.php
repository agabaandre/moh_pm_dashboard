       <?php 
                        $subjects=Modules::run('kpi/subjectData');

                      //  print_r($subjects);
                        
                        
                        foreach ($subjects as $subject):
                          ?>
                        <li class="treeview <?php if ($subject->id == $this->uri->segment(3)||$subject->id == $this->uri->segment(4)){ echo "active"; } ?>" >
                         <?php 
                         $url =  base_url()."data/subject/".$subject->id."/".str_replace("+","_",urlencode($subject->name)); ?>

                            <a href="" title="<?php echo $subject->name; ?>"  target="_self"  onclick="openUrl('<?php echo $url; ?>');">
                            <i class="fa fa-<?php echo $subject->icon;?>"></i><span>
                                <?php echo ellipsize($subject->name,28,1); ?>
                                    
                                </span>
                                <span class="pull-right-container pull-right">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            
          <?php $subject2=Modules::run('kpi/getCategoryMenu',$subject->id);   
          foreach($subject2 as $sub2):
          ?>
           
        <ul class="treeview-menu">
        <li class="treeview <?php echo ($outComeActive)?'active':''; ?>">
             <a  href="#" 
                target="_self">
                <span><?php echo $sub2->cat_name; ?></span>
                <ul class="treeview-menu">
                            <?php $kpis= Modules::run('Kpi/nav_generalKpi',$sub2->id); 
                                    foreach ($kpis as $kpi): ?>
                                 <li data-toggle="tooltip" data-placement="right" title="<?php echo $kpi->short_name; ?>" style="z-index:1000;" ><a href="<?php echo base_url().'data/kpiData/'.$kpi->kpi_id.'/'.$subject->id; ?>" class="text-truncate"><?php echo $kpi->short_name; ?></a> </li>
                                 <?php endforeach; ?>
               </ul>
            </a>
        </li>
       
      </ul>
      <?php endforeach; ?>
                        </li>

      <?php  endforeach; 
        ?>
   
        <!-- *************************************
        **********ENDS OF CUSTOM MODULES*********
        ************************************* -->