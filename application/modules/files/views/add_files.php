<script>
    $(document).ready(function () {
        // Function to fetch dimensions based on selected KPI
        $('#kpi_id').change(function () {
            var kpi_id = $(this).val();
            $.ajax({
                url: '<?php echo base_url()?>/files/fetch_dimensions',
                type: 'post',
                data: { kpi_id: kpi_id },
                dataType: 'json',
                success: function (response) {
                    var options = '';
                    $.each(response, function (index, value) {
                        options += '<option value="' + value.dimension1_key + '">' + value.dimension1_key + '</option>';
                        options += '<option value="' + value.dimension2_key + '">' + value.dimension2_key + '</option>';
                        options += '<option value="' + value.dimension3_key + '">' + value.dimension3_key + '</option>';
                    });
                    $('#dimensions').html(options);

                    // Append additional form fields
                    var additionalFields = '<label for="financial_year">Financial Year:</label>';
                    additionalFields += '<input type="text" name="financial_year" class="form-control">';
                    additionalFields += '<label for="period_year">Period Year:</label>';
                    additionalFields += '<input type="text" name="period_year" class="form-control">';
                    additionalFields += '<label for="period">Period:</label>';
                    additionalFields += '<input type="text" name="period" class="form-control">';
                    additionalFields += '<label for="denominator">Denominator:</label>';
                    additionalFields += '<input type="text" name="denominator" class="form-control">';
                    additionalFields += '<label for="numerator">Numerator:</label>';
                    additionalFields += '<input type="text" name="numerator" class="form-control">';
                    additionalFields += '<label for="data_target">Data Target:</label>';
                    additionalFields += '<input type="text" name="data_target" class="form-control">';
                    additionalFields += '<label for="upload_date">Upload Date:</label>';
                    additionalFields += '<input type="text" name="upload_date" class="form-control">';
                    additionalFields += '<label for="comment">Comment:</label>';
                    additionalFields += '<textarea name="comment" class="form-control"></textarea>';
                    additionalFields += '<label for="uploaded_by">Uploaded By:</label>';
                    additionalFields += '<input type="text" name="uploaded_by" class="form-control">';

                    $('#additional_fields').html(additionalFields);
                }
            });
        });

        // Function to add more rows
        $('#add_row').click(function () {
            var row = '<tr><td><input type="text" name="dimension1[]" class="form-control"></td><td><input type="text" name="dimension2[]" class="form-control"></td><td><input type="text" name="dimension3[]" class="form-control"></td></tr>';
            $('#dimensions_table tbody').append(row);
        });
    });
</script>
</head>

<body>
    <form method="post" action="submit_form.php">
        <label for="kpi_id">Select KPI:</label>
        <select class="form-control" name="kpi_id">

                                            <?php
                                            $info_cat = $_SESSION['info_category'];
                                            if (!empty($_SESSION['subject_area'])) {
                                            @$id = implode(",", json_decode($_SESSION['subject_area']));
                                                
                                                $kpis = $this->db->query("SELECT * FROM `kpi` where subject_area in ($id)")->result();
                                            } else {
                                                $kpis = $this->db->query("SELECT * FROM `kpi` where subject_area in (select id from subject_areas where info_category=$info_cat)  ")->result();
                                            }
                                            foreach ($kpis as $row): ?>
                                                <option value="<?php echo $row->kpi_id; ?>"><?php echo $row->short_name .'('.$row->kpi_id.')'; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
               
        <label for="financial_year">Financial Year:(*)</label>

            <select class="form-control selectize" name="financial_year" required>
    <option value="">Select Financial Year</option>
    <?php

                        $current_date = date('Y-m-d');
                        $current_year = date('Y', strtotime($current_date));
                        $next_year = $current_year + 1;
                        if (date('m-d', strtotime($current_date)) < '06-30') {

                            $current_year -= 1;
                            $next_year -= 1;
                        }
                        $current_financial_year = $current_year . '-' . $next_year;
                        $startdate = "2022"; // Start of available financial years
                        $enddate = intval(date('Y') + 1); // End of available financial years
                        $years = range($startdate, $enddate);

                        foreach ($years as $year) {
                            $financial_year = $year . '-' . ($year + 1);
                            ?>
                            <option value="<?php echo $financial_year; ?>" <?php if (($current_financial_year === $financial_year) || ($financial_year === $this->input->get('financial_year)'))) {
                                   echo "selected";
                               } ?>>
                                <?php echo $financial_year; ?>
                            </option>
                        <?php }

                        ?>
                    </select>
            <?php
                    $startYear = date('Y') - 1; // Get the previous year
                    $endYear = date('Y'); // Get the current year
                    $selectedYear = date('Y'); // Get the current year

                    $quartersOptions = generateQuartersOptions($startYear, $endYear, $selectedYear);

            ?>

            <select name="financial_quarter">
                <?php echo $quartersOptions; ?>
            </select>

        <table id="dimensions_table">
            <thead>
                <tr>
                    <th>Dimension 1</th>
                    <th>Dimension 2</th>
                    <th>Dimension 3</th>
                </tr>
            </thead>
            <tbody id="dimensions">
                <!-- Dimension rows will be added here dynamically -->
            </tbody>
        </table>

        <div id="additional_fields">
            <!-- Additional form fields will be appended here -->
        </div>

        <button type="button" id="add_row">Add Row</button>
        <button type="submit">Submit</button>
    </form>