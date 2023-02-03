<style>
    input {
        clear:both;
        padding:4px;
        border:0px #FFF;

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
                        <!-- Button trigger modal -->
                       
                            <div class="card-content">
                       <?php //print_r($this->session->userdata());?>   
<table id="kpi_data"  class="table table-responsive table-striped table-bordered">
                             
    <thead>
        <tr>
            <th>KPI ID</th>
            <th>Dimension 1</th>
   
            <th>Dimension 2</th>
        
            <th>Dimension 3 </th>
            
            <th>Financial Year</th>
           
            <th>Period</th>
            <th>Denominator</th>
            <th>Numerator</th>
            <th>Data Target</th>
         
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row) { ?>
            <tr>
                <td>
                    <?php echo $row->kpi_id; ?>
                </td>
                <td>
                    <?php echo $row->dimension1; ?>
                </td>
             
                <td>
                    <?php echo $row->dimension2; ?>
                </td>
             
                <td>
                    <?php echo $row->dimension3; ?>
                </td>
               
                    <td>
                     <?php echo $row->financial_year; ?>
                </td>
             
                <td>
                    <?php echo $row->period; ?>
                </td>
                <td>
                    <?php echo $row->denominator; ?>
                </td>
                <td>
                    <?php echo $row->numerator; ?>
                </td>
                <td>
                    <?php echo $row->data_target; ?>
                </td>
               
            
            </tr>
        <?php } ?>
    </tbody>
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
    $('#kpi_data').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        responsive: true,
        displayLength: 25,
        lengthChange: true
    } );
} );
</script>
