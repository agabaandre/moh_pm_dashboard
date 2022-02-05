<style>
table.minimalistBlack {
  border: 3px solid #000000;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.minimalistBlack td, table.minimalistBlack th {
  border: 1px solid #000000;
  padding: 5px 4px;
}
table.minimalistBlack tbody td {
  font-size: 13px;
}
table.minimalistBlack thead {
  background: #CFCFCF;
  background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  border-bottom: 2px solid #000000;
}
table.minimalistBlack thead th {
  font-size: 12px;
  font-weight: bold;
  color: #000000;
  text-align: left;
}
table.minimalistBlack tfoot {
  font-size: 12px;
  font-weight: bold;
  color: #000000;
  border-top: 0px solid #000000;
}
table.minimalistBlack tfoot td {
  font-size: 12px;
}
</style>
                        <div id="kpitable">
                            <h4 style="text-align:center;">MOH PERFORMANCE MANAGEMENT DASHBOARD INDICATOR SUMMARY</h4>

                                    <table id="kpi"  class="table minimalistBlack table-responsive table-striped table-bordered print table">
                                    
                            
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
                             
