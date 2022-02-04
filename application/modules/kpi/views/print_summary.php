
                        <div id="kpitable">

                                    <table id="kpi"  class="table table-responsive table-striped table-bordered print table">
                                    
                            
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
                                                $elements=Modules::run('Kpi/summaryData');
                                                    foreach($elements as $element):?>

                                                <tr class="table-row tbrow content strow">
                                                    <td><?php echo $i ?></td>
                                                    <td style="width:20%;"><?php echo $element->name; ?></td>
                                                    <td><?php 
                                                    $gauge=Modules::run('Kpi/gaugeData',$element->kpi_id); ?>
                                                    <a href="<?php echo base_url().'data/kpidata/'.$gauge['gauge']['details'][0]->kpi_id.'/'.$gauge['gauge']['details'][0]->subject_area; ?>" target="_self"><p class=""  style=" color:green; font-size:12px;" ><?php echo $gauge['gauge']['details'][0]->short_name; ?></p></a></td>
                                                    
                                                    <td><?php echo $gauge['gauge']['data'][0]->current_target; ?></td>
                                                    <td><?php echo $gauge['gauge']['data'][0]->financial_year; ?></td>
                                                    <td  <?php 
                                                    
                                                    echo Modules::run("kpi/kpiTrendcolors",$gauge['gauge']['data'][0]->current_target,$gauge['gauge']['data'][0]->current_value,$gauge['gauge']['data'][0]->previous_value,$gauge['gauge']['data'][0]->cp,$gauge['gauge']['data'][0]->pp);
                                                     ?>>
                                                     <?php echo  $gauge['gauge']['data'][0]->current_value.'%'; ?>
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
                             
