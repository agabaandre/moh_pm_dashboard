<style>
input {
    clear: both;
    padding: 4px;
    border: 0px #FFF;

}
</style>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                        <?php echo (!empty($title) ? $title : null) ?>
                    </h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <!-- Button trigger modal -->

                            <div class="card-content">
                                <form class="form" action="<?php echo base_url(); ?>kpi/insertDisplayData"
                                    method="post">

                                    <button type="submit" class="btn btn-success" style="margin-bottom:3px;"><i
                                            class="fa fa-plus">
                                        </i>Save KPI
                                    </button>


                                    <table id="kpi_display" class="table table-responsive table-striped table-bordered">


                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>KPI ID</th>
                                                <th>Subject Area</th>
                                                <th>Indicator Statement</th>
                                                <th style="width:13%;">Subject Area Display Index</th>
                                                <th style="width:13%;">Dashboard Display Index</th>
                                                <th>#</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php


                                            $i = 1;
                                            $elements = Modules::run('Kpi/kpiDisplayData');
                                            foreach ($elements as $element): ?>

                                            <tr class="table-row tbrow content strow">
                                                <td>
                                                    <?php echo $i ?>
                                                </td>
                                                <td style="width:20%;"><input type="text" style="width:50%;"
                                                        class="form-control" value="<?php echo $element->kpi_id; ?>"
                                                        name="kpi_id[]"></td>
                                                <td>
                                                    <?php echo $element->name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $element->indicator_statement; ?>
                                                </td>
                                                <td style="width:20%;"> <input type="tel" style="width:40%;"
                                                        class="form-control"
                                                        value="<?php echo $element->dashboard_index; ?> "
                                                        name="dashboard_index[]"></td>
                                                <td style="width:20%;"> <input type="tel" style="width:40%;"
                                                        class="form-control"
                                                        value="<?php echo $element->subject_index; ?> "
                                                        name="subject_index[]"></td>
                                                <td>
                                            
                                </form>
                                               
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete<?php echo $element->id; ?>" style="margin-bottom:3px; width:80px;"><i class="fa fa-minus" >
                                                    </i>DELETE
                                                    </button>

                                                        <!-- delete Modal -->
                                                        <div class="modal fade" id="delete<?php echo $element->id; ?>" data-backdrop="static" data-keyboard="false"
                                                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm modal-danger">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="staticBackdropLabel">DELETE KPI/ KPI DATA for
                                                                                <?php echo $element->kpi_id; ?>?
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                        
                                                                            <form action="<?php echo base_url(); ?>kpi/deletekpi" enctype="multipart/form-data" method="post"
                                                                                accept-charset="utf-8">
                                                        
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-9">
                                                                                        <input type="hidden" name="kpi_id" value="<?php echo $element->kpi_id; ?>">
                                                                                        <label class="radio-inline">
                                                                                            <?php echo form_radio('deletekpi', '1', false, 'id="allow_all_categories"'); ?>KPI report
                                                                                            Data and KPI Meta Data
                                                                                        </label>
                                                                                        <br>
                                                                                        <label class="radio-inline">
                                                                                            <?php echo form_radio('deletekpi', '2', false, 'id="allow_all_categories"'); ?>KPI
                                                                                            Report Data Only
                                                                                        </label>
                                                                                        <br>
                                                                                        <label class="radio-inline">
                                                                                            <?php echo form_radio('deletekpi', '0', false, 'id="allow_all_categories"'); ?>KPI Meta
                                                                                            Data Only
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                        
                                                        
                                                        
                                                                                <div class="form-group btn-inline">
                                                                                    <button type="reset" class="btn btn-sm btn-primary w-md m-b-5">Reset</button>
                                                                                    <button type="submit" class="btn btn-sm btn-danger w-md m-b-5">Delete</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                        
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- delete Modal -->
                                                
                                                </td>
                                        
                                                    </tr>
                                            <?php
                                                $i++;
                                            endforeach;

                                            if (count($elements) == 0) {

                                                echo "<tr><td colspan='8'><center><h3 class='text-warning'>Please Add Indicators</h3></center></td></tr>";
                                            }
                                            ?>
                                            </tr>


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
    $('#kpi_display').DataTable( {
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