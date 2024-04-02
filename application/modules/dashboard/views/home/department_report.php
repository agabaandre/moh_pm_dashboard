<style>
    .vertical {
        border-left: 6px solid blue;
        height: 200px;
        position: absolute;
    }

    .table {
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 0.3em;
        /* Adjust padding as needed */
        border: 1px solid #E1DDDC;
        /* Add borders */
        text-align: left;
        /* Center align text */
    }

    .table th {
        background-color: #f2f2f2;
        /* Background color for table headers */
    }

    .table th:first-child,
    .table td:first-child {
        text-align: left;
        /* Left align first column */
    }

    .table th[colspan],
    .table td[colspan] {
        background-color: #d9d9d9;
        /* Background color for colspan cells */
    }

    .table th[rowspan],
    .table td[rowspan] {
        vertical-align: middle;
        /* Vertically center rowspan cells */
    }

    /* Optional: Highlight even rows */
    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
        padding: 0.5rem !important;
    }
</style>
<div class=" mt-4">
    <h2>Performance Report</h2>

    <?php
    // dd($this->session->userdata());
    $this->load->view('dashboard/home/partials/filters') ?>

  
        <?php 
        //$departments = Modules::run('dashboard/home/get_departments');
        // print_r($departments);
  
        foreach ($subject_areas as $department):
            ?>
 
            <div class="row mt-4">
                <div class="col">
                    <h3>
                        <?php echo $department->name; ?> 
                    </h3>
                 
                    <table class="table table-bordered">

                        <tr>
                            <th colspan="2">
                                <?php if (!empty($this->input->get('kpi_id'))) {
                                    echo @getkpi_info($this->input->get('kpi_id'))->short_name;
                                }

                                ?>
                            </th>

                            <td colspan="3">Q1</td>


                            <td colspan="3">Q2</td>


                            <td colspan="3">Q3</td>


                            <td colspan="3">Q4</td>
                        </tr>
                        <tr>
                            <th>KPI </th>
                            <th>Numerator/Denominator</th>
                            <td>Data</td>
                            <td>Score</td>
                            <td>Target</td>

                            <td>Data</td>
                            <td>Score</td>
                            <td>Target</td>

                            <td>Data</td>
                            <td>Score</td>
                            <td>Target</td>

                            <td>Data</td>
                            <td>Score</td>
                            <td>Target</td>
                        </tr>
                        <?php
                          $i = 1;
                        $kpis = Modules::run('dashboard/home/kpis',$department->id);
                       // print_r($kpis);
                        foreach ($kpis as $kpi): ?>
                            <tr>

                                <th rowspan="2">

                                    <?php echo $i++ . '. ' . $kpi->short_name;
                                    if(!empty($this->input->get('kpi_id'))){
                                    $kpi_id = $this->input->get('kpi_id');
                                    }
                                    else{
                                     $kpi_id = $kpi->kpi_id;
                                    }
                                    if(!empty($this->input->get('financial_year'))){
                                        $financial_year = $this->input->get('financial_year');
                                    };
                                    
                            
                                    $subject_area_id = $department->id;
                                      @$q1_vals = Modules::run('dashboard/home/kpi_performance', $subject_area_id, 'Q1',  $kpi_id,$financial_year);
                                      @$q2_vals = Modules::run('dashboard/home/kpi_performance', $subject_area_id, 'Q2', $kpi_id, $financial_year);
                                      @$q3_vals = Modules::run('dashboard/home/kpi_performance', $subject_area_id, 'Q3', $kpi_id, $financial_year);
                                      @$q4_vals = Modules::run('dashboard/home/kpi_performance', $subject_area_id, 'Q4', $kpi_id, $financial_year);




                                    ?>

                                </th>
                                <td>
                                    <?php
                                        echo explode('/',getkpi_info($kpi_id)->computation)[0];
                                     ?>
                                </td>
                                <td><?= number_format($q1_vals->total_numerator) ?></td>
                                <td rowspan="2" <?php if (!empty($q1_vals->current_value)) {
                                    echo "style='font-weight:bold; color:#FFF; background:" . getColorBasedOnPerformance($q1_vals->current_value, $q1_vals->target_value) . "'";
                                } ?>>
                                    <?php if(!empty($q1_vals->total_numerator)){?>
                                    <?= round($q1_vals->current_value, 0);} ?>
                                </td>
                                 <td rowspan=2><?= $q1_vals->target_value ?></td>

                                 <!--end quater1-->
                                <td><?= number_format($q2_vals->total_numerator) ?></td>
                                <td rowspan="2" <?php if (!empty($q2_vals->current_value)) {
                                    echo "style='font-weight:bold; color:#FFF; background:" . getColorBasedOnPerformance($q2_vals->current_value, $q2_vals->target_value) . "'";
                                } ?>>
                                <?php if (!empty($q2_vals->total_numerator)){ ?>
                                    <?= round($q2_vals->current_value, 0); }?>
                                </td>
                                 <td rowspan=2><?= $q2_vals->target_value ?></td>

                                 <!---end q2-->
                             <td><?= number_format($q3_vals->total_numerator) ?></td>
                                <td rowspan="2" <?php if (!empty($q3_vals->current_value)) {
                                    echo "style='font-weight:bold; color:#FFF; background:" . getColorBasedOnPerformance($q3_vals->current_value, $q3_vals->target_value) . "'";
                                } ?>>
                                <?php if (!empty($q3_vals->total_numerator)){ ?>
                                    <?= round($q3_vals->current_value, 0);} ?>
                                </td>
                                 <td rowspan=2><?= $q3_vals->target_value ?></td>

                                 <!---end q3-->
                              <td><?= number_format($q4_vals->total_numerator) ?></td>
                                <td rowspan="2" <?php if (!empty($q4_vals->current_value)) {
                                    echo "style='font-weight:bold; color:#FFF; background:" . getColorBasedOnPerformance($q4_vals->current_value, $q4_vals->target_value) . "'";
                                } ?>>
                                <?php if (!empty($q4_vals->total_numerator)) {?>
                                    <?= round($q4_vals->current_value, 0); }?>
                                </td>
                                 <td rowspan=2><?= $q4_vals->target_value ?></td>

                                 <!---end q4-->

                            </tr>
                            <tr style="border-bottom:2px solid #FDE693; !important">

                                <td>
                                    <?php
                                    echo explode('/', getkpi_info($kpi_id)->computation)[1];
                                     ?>
                                </td>
                                <td>
                                    <?= number_format($q1_vals->total_denominator) ?>
                                </td>

                                <td>
                                    <?= number_format($q2_vals->total_denominator) ?>
                                </td>

                                <td>
                                    <?= number_format($q3_vals->total_denominator) ?>
                                </td>

                                <td>
                                    <?= number_format($q4_vals->total_denominator) ?>
                                </td>


                            </tr>

                        <?php endforeach; ?>

                    </table>


                </div>
            </div>
        <?php endforeach; ?>

    </div>
<script>

        function getkpis(val) {

        $.ajax({
            method: "GET",
            url: "<?php echo base_url(); ?>dashboard/home/getkpis",
            data: 'subject_area=' + val,
            success: function (data) {
                //console.log(data);
                $(".performance_kpis").html(data);
            }
            //  console.log('iwioowiiwoow');
        });
    }
</script>