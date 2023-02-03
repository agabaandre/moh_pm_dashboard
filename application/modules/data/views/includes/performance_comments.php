<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Performance Comments</h4>
    </div>
    <div class="panel-body">
        <table id="performance_comments" class="table table-responsive table-striped table-bordered">
            <thead>
             
                <tr>
                    <th width=10>#</th>
                    <th width=10>Period</th>
                    <th width=10>Numerator</th>
                    <th width=10>Denominator</th>
                    <th width=10>% Score</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
            


                <?php $kpi_id = trim($this->uri->segment(3));
                $periods = Modules::run('data/get_period', $kpi_id);
                $i = 1;

                foreach ($periods as $period):
                    ?>
                    <tr>
                        <td>
                            <?php echo $i++; ?>
                        </td>
                        <td>
                            <?php echo $pp = $period->period; ?>
                        </td>
                        <td><b>
                            <?php $cals = Modules::run('data/get_calculation', $kpi_id, $pp); 
                            foreach ($cals as $cal): ?>

                                <?php echo  number_format($cal->numerator)  ;

                                $num = $cal->numerator;
                                ?>


                            <?php endforeach;

                            ?>
                            </b>
                        </td>
                        <td>
                            <b>
                            <?php $cals = Modules::run('data/get_calculation', $kpi_id, $pp); 
                            foreach ($cals as $cal): ?>

                                <?php echo number_format($cal->denominator);

                                        $den = $cal->denominator; ?>


                            <?php endforeach;

                            ?>
                            </b>
                        </td>
                        <td>
                            <?php echo round(($num / $den)*100,2); ?>
                        </td>
                        <td>
                        
                            <?php $comments = Modules::run('data/get_comments', $kpi_id, $pp); foreach ($comments as $comment): ?>
                                <ul>
                                    <li>
                                        <?php echo $comment->comment; ?>
                                    </li>
                                </ul>

                            <?php endforeach;

                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                

            </tbody>
               <tr>
                    <th colspan="2">
                      Computation Method
                    </th>
                    <td colspan="3">
                    <?php echo Modules::run('data/get_computation', $kpi_id);?>
                    </td>
                       
                </tr>
            
                
            
        </table>

    </div>
</div>


<script>
    $(document).ready(function () {
        $('#performance_comments').DataTable({
       dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A4',
             
            }
        ],
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        responsive: true,
        displayLength: 25,
        lengthChange: true
    } );
} );
</script>