
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends MX_Controller
{


    public function __Construct()
    {

        parent::__Construct();
        $this->db->query('SET SESSION sql_mode = ""');

        $this->load->model('files_mdl');
        // $this->load->library('excel');  

    }
    public function file()
    {

        $data['title'] = 'Upload KPI Data';
        $data['page'] = 'files';
        $data['module'] = "files";
        echo Modules::run('template/layout', $data);

    }

    public function add_file()
    {

        $data['title'] = 'Add KPI Data';
        $data['page'] = 'add_files';
        $data['module'] = "files";
        echo Modules::run('template/layout', $data);

    }
    function importcsv()
    {
        if (isset($_FILES["upload_csv_file"]["name"])) {
            $path = $_FILES["upload_csv_file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $sale) {
                $highestRow = $sale->getHighestRow();
                $highestColumn = $sale->getHighestColumn();
                for ($row = 1; $row <= $highestRow; $row++) {

                    if (!empty($sale->getCellByColumnAndRow(1, $row)->getValue())) {
                        $dim1 = trim($sale->getCellByColumnAndRow(1, $row)->getValue());
                        $dim1k = trim($sale->getCellByColumnAndRow(2, $row)->getValue());
                    } else {
                        $dim1 = NULL;
                        $dim1k = NULL;

                    }


                    if (!empty($sale->getCellByColumnAndRow(3, $row)->getValue())) {
                        $dim2 = trim($sale->getCellByColumnAndRow(3, $row)->getValue());
                        $dim2k = trim($sale->getCellByColumnAndRow(4, $row)->getValue());
                    } else {
                        $dim2 = NULL;
                        $dim2k = NULL;

                    }
                    if (!empty(trim($sale->getCellByColumnAndRow(5, $row)->getValue()))) {
                        $dim3 = trim($sale->getCellByColumnAndRow(5, $row)->getValue());
                        $dim3k = trim($sale->getCellByColumnAndRow(6, $row)->getValue());
                    } else {
                        $dim3 = NULL;
                        $dim3k = NULL;

                    }

                    $data = array(
                        'kpi_id' => str_replace(" ", "", $sale->getCellByColumnAndRow(0, $row)->getValue()),
                        'dimension1' => $dim1,
                        'dimension1_key' => $dim1k,
                        'dimension2' => $dim2,
                        'dimension2_key' => $dim2k,
                        'dimension3' => $dim3,
                        'dimension3_key' => $dim3k,
                        'financial_year' => str_replace("/", "-", $sale->getCellByColumnAndRow(7, $row)->getValue()),
                        'period_year' => str_replace(" ", "", $sale->getCellByColumnAndRow(8, $row)->getValue()),
                        'period' => ucwords(str_replace(" ", "", $sale->getCellByColumnAndRow(9, $row)->getValue())),
                        'numerator' => str_replace("%", "", str_replace(",", "", $sale->getCellByColumnAndRow(10, $row)->getValue())),
                        'denominator' => str_replace("%", "", str_replace(",", "", $sale->getCellByColumnAndRow(11, $row)->getValue())),
                        'data_target' => str_replace("%", "", $sale->getCellByColumnAndRow(12, $row)->getValue()),
                        'comment' => $sale->getCellByColumnAndRow(13, $row)->getValue(),
                        'uploaded_by' => $_SESSION['id']
                    );

                    // print_r($data);

                    if (!empty($data)) {
                        $this->db->insert("new_data", $data);
                    }


                }
            }

            $this->session->set_flashdata('message', 'Upload Successful');
            redirect('files/file');
        }
    }


    public function do_upload()
    {
        // set validation rules for uploaded file
        $config['upload_path'] = './db_folder/'; // upload directory
        $config['allowed_types'] = 'csv'; // allowed file types
        $config['max_size'] = 1000; // maximum file size in KB

        $this->load->library('upload', $config);

        // check if file upload failed
        if (!$this->upload->do_upload('upload_csv_file')) {
            $error = array('error' => $this->upload->display_errors());
            foreach ($error as $index => $entry) {
                $resultString .= $index . ". " . $entry . ", ";
            }
           // $resultString = substr($resultString, 0, -);
            $this->session->set_flashdata('exception', $resultString);
            redirect('files/file');
        } else {
            // get uploaded file data
            $data = $this->upload->data();
            $file_path = './db_folder/' . $data['file_name'];

            // open file and read data into array
            $rows = array_map('str_getcsv', file($file_path));

            // validate column headers
            $headers = array_shift($rows);
            $valid_headers = array(
                'kpi_id',
                'dimension1',
                'dimension1_key',
                'dimension2',
                'dimension2_key',
                'dimension3',
                'dimension3_key',
                'financial_year',
                'period_year',
                'period',
                'numerator',
                'denominator',
                'data_target',
                'comment'
            );
            if ($headers !== $valid_headers) {

                $message = 'Invalid file format. Please upload a CSV file with the correct column headers' . '<br>
                Valid Column headers are:
                kpi_id,
                dimension1,
                dimension1_key,
                dimension2,
                dimension2_key,
                dimension3,
                dimension3_key,
                financial_year,
                period_year,
                period,
                numerator,
                denominator,
                data_target,
                comment
                ';
                $this->session->set_flashdata('exception', $message);
                redirect('files/file');

            }


            // loop through rows and insert data into database
            $validation_errors = array();

            for ($i = 0; $i < count($rows); $i++) {
                $row = $rows[$i];

                $data = array(
                    'kpi_id' => $row[0],
                    'dimension1' => trim($row[1]),
                    'dimension1_key' => trim($row[2]),
                    'dimension2' => trim($row[3]),
                    'dimension2_key' => trim($row[4]),
                    'dimension3' => trim($row[5]),
                    'dimension3_key' => trim($row[6]),
                    'financial_year' => trim(str_replace("/", "-", $row[7])),
                    'period_year' => trim(str_replace(" ", "", $row[8])),
                    'period' => trim(str_replace(" ", "", $row[9])),
                    'numerator' => trim(str_replace("%", "", str_replace(",", "", $row[10]))),
                    'denominator' => trim(str_replace("%", "", str_replace(",", "", $row[11]))),
                    'data_target' => trim(str_replace("%", "", $row[12])),
                    'comment' => $row[13],
                    'upload_date' =>date('Y-m-d'),
                    'uploaded_by' => $_SESSION['id']
                );
               $kpi_id=$row[0];
               $period = trim(str_replace(" ", "", $row[9]));
               $financial_year = trim(str_replace("/", "-", $row[7]));
           

                // valid data, insert into database
                //check if data exits then update
              if(($this->update_check($kpi_id,$period,$financial_year))==1){
                    $this->db->where('financial_year', "$financial_year");
                    $this->db->where('period', "$period");
                    $this->db->where('kpi_id', "$kpi_id");
                    $this->db->update('new_data', $data);
               } else {

                    $this->db->insert('new_data', $data);
                }
                // delete uploaded file from server



            }
            unlink($file_path);
            $this->session->set_flashdata('message', 'Data uploaded successfully.');
            redirect('files/file');


        }

    }

    public function update_check($kpi_id,$period,$financial_year){
    return $this->db->query("SELECT kpi_id from new_data where kpi_id='$kpi_id' and period='$period' and financial_year='$financial_year'")->num_rows();

    }
    function generate_csv_file()
    {
        // define header row
        $kpi_id = $this->input->get('kpi_id');
    

        // define example data row
        $data_rows = $this->db->query("SELECT kpi_id,
                dimension1,
                dimension1_key,
                dimension2,
                dimension2_key,
                dimension3,
                dimension3_key,
                financial_year,
                period_year,
                period,
                numerator,
                denominator,
                data_target,
                comment FROM new_data where kpi_id= '$kpi_id' LIMIT 10") ->result_array();
    
        $filename = 'sample_upload_'.$kpi_id;
        if (count($data_rows) > 0) {
            render_csv_data($data_rows, $filename, true);
        }
        else{
            $data_rows = array(
                'kpi_id',
                'dimension1',
                'dimension1_key',
                'dimension2',
                'dimension2_key',
                'dimension3',
                'dimension3_key',
                'financial_year',
                'period_year',
                'period',
                'numerator',
                'denominator',
                'data_target',
                'comment'
            );
            render_csv_data($data_rows, $filename, false);

        }
    }
    function fetch_dimensions(){
    if(isset($_POST['kpi_id'])) {
    $kpi_id = $_POST['kpi_id'];
    $sql = "SELECT DISTINCT dimension1_key, dimension2_key, dimension3_key FROM new_data WHERE kpi_id = '$kpi_id'";
    $result = $$this->db->query($sql);

    $dimensions = array();
    if ($result->num_rows() > 0) {
        foreach($result->result() as $row) {
            $dimensions[] = $row;
        }
    }
    echo json_encode($dimensions);
}}
}