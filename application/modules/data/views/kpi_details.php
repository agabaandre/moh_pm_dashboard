
<style>
table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}
table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}
table tr {
  background: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}
table th,
table td {
  padding: .625em;
  text-align:left;
}
table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}
@media screen and (max-width: 600px) {
  table {
    border: 0;
  }
  table caption {
    font-size: 1.3em;
  }
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  table td:before {
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  table td:last-child {
    border-bottom: 0;
  }
}

</style>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div> 
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                      
                        
                            <div class="card-content">
                                    <!-- begin table -->
                                <table class="table table-striped table-responsive">

                                    <thead class="header-row tbrow">
                                    
                                        <th class="cell"><b id="kpiid"></b>KPI ID</th>
                                        <th class="cell">Indicator Statement</th>
                                        <th class="cell">Description</th>
                                        <th class="cell">Computation</th>
                                        <th class="cell">Data Sources</th>
                                        <th class="cell">Frequency</th>
                                        <th class="cell">Target</th>
                                      

                                    </thead>

                                    <?php 


                                    foreach($kpi_table as $element):?>

                                    <tr class="table-row tbrow content">
                                      
                                        <td class="cell tbprimary"  data-label="KPI ID"><?php echo $element->kpi_id; ?> </td>
                                        <td class="cell cname" data-label="Indicator Statement"><?php echo $element->indicator_statement; ?></td>
                                        <td class="cell" data-label="Description"><?php echo $element->description; ?></td>
                                        <td class="cell" data-label="Computation"><?php echo $element->computation;?></td>
                                        <td class="cell" data-label="Data Sources"><?php echo $element->data_sources; ?></td>
                                        <td class="cell" data-label="Frequency"><?php echo $element->frequency; ?></td>
                                        <td class="cell" data-label="Target"><?php echo $element->current_target; ?></td>
                                        
                                    </tr>

                                    <?php endforeach; ?>

                                </table>





                               </div>
                           </div> 
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

<script>
 $(document).ready(function() {
    $('#kpi').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
</script>