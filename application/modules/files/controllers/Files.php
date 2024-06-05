
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

    public function add_data()
    {

        $data['title'] = 'Add KPI Data';
        $data['page'] = 'add_files';
        $data['module'] = "files";
        $kpi_id = $this->input->get('kpi_id');
        $period = $this->input->get('period');
        $financial_year = $this->input->get('financial_year');
        
        if(!empty($kpi_id)&& !empty($period) && !empty($financial_year)){
            $prev = getPeriodYear($financial_year, $period)-1;
        $rows = $this->db->query("SELECT * from new_data where kpi_id='$kpi_id' AND period='$period' AND period_year='$prev'")->num_rows();
        $data['rows'] = ($rows < 1) ? 1 : $rows;

        $data ['kpi_datas'] = $this->files_mdl->get_kpi_data($kpi_id, $period, $financial_year);
        }
     

        $data['last_query'] = $this->db->last_query();
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
    function fetch_dimension1($kpid){
    if($kpid){
 
    $sql = "SELECT DISTINCT dimension1 FROM new_data WHERE kpi_id = '$kpid'";
   return $result = $this->db->query($sql)->result();
     }
   else{
    return array();
   }

   }

    function fetch_dimension2($kpid)
    {
        if ($kpid) {

            $sql = "SELECT DISTINCT  dimension2 FROM new_data WHERE kpi_id = '$kpid'";
            return $result = $this->db->query($sql)->result();
        } else {
            return array();
        }

    }

    function fetch_dimension3($kpid)
    {
        if ($kpid) {

            $sql = "SELECT DISTINCT  dimension3 FROM new_data WHERE kpi_id = '$kpid'";
            return $result = $this->db->query($sql)->result();
        } else {
            return array();
        }

    }
    function fetch_dimensions1_keys($kpid)
    {
        if ($kpid) {
            $fy = $this->financial_year();
            if (!empty($fy)) {
                $fi = "and financial_year='$fy'";
            }
            $sql = "SELECT DISTINCT dimension1_key FROM new_data WHERE kpi_id = '$kpid' $fi";
            return $result = $this->db->query($sql)->row();
        } else {
            return array();
        }

    }
    function fetch_dimensions2_keys($kpid)
    {
        if ($kpid) {
            $fy = $this->financial_year();
            if (!empty($fy)) {
                $fi = "and financial_year='$fy'";
            }

            $sql = "SELECT DISTINCT dimension2_key FROM new_data WHERE kpi_id = '$kpid' $fi";
            return $result = $this->db->query($sql)->row();
        } else {
            return array();
        }

    }
    function fetch_dimensions3_keys($kpid)
    {
        if ($kpid) {
            $fy = $this->financial_year();
            if(!empty($fy)){
               $fi = "and financial_year='$fy'";
            }

            $sql = "SELECT DISTINCT dimension2_key FROM new_data WHERE kpi_id = '$kpid' $fi";
            return $result = $this->db->query($sql)->row();
        } else {
            return array();
        }
        

    }
 function financial_year(){
   $fy = $this->session->userdata('financial_year');
  $rows = $this->db->query("SELECT * from new_data WHERE financial_year='$fy'")->num_rows();
   if ($rows>0){
   return $fy;
   }
   else{
    return  NULL;
   }
 }
    public function save_data()
    {
        // Check if the request method is POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Retrieve the posted data
            $kpi_ids = $this->input->post('kpi_id');
            $numerators = $this->input->post('numerator');
            $denominators = $this->input->post('denominator');
            $sfys = $this->input->post('financial_year');
            $period_years = $this->input->post('period_year');
            $periods = $this->input->post('period');
            $dimension1_keys = $this->input->post('dimension1_key');
            $dimension1_values = $this->input->post('dimension1');
            $dimension2_keys = $this->input->post('dimension2_key');
            $dimension2_values = $this->input->post('dimension2');
            $dimension3_keys = $this->input->post('dimension3_key');
            $dimension3_values = $this->input->post('dimension3');
            $data_targets = $this->input->post('data_target');
            $comments = $this->input->post('comment');

            // Iterate through each row of data
            for ($i = 0; $i < count($kpi_ids); $i++) {
                // Check if both numerator and denominator are present
                if (!empty($numerators[$i]) && !empty($denominators[$i])) {
                    // Create an array with data for insertion
                    $insert_data = array(
                        'kpi_id' => $kpi_ids[$i],
                        'numerator' => $numerators[$i],
                        'denominator' => $denominators[$i],
                        'period' => $periods[$i],
                        'period_year' => $period_years[$i],
                        'financial_year' => $sfys[$i],
                        'comment'=> $comments[$i],
                        'data_target' => $data_targets[$i],
                        'dimension3' => $dimension3_values[$i],
                        'dimension3_key' => $dimension3_keys[$i],
                        'dimension2' => $dimension2_values[$i],
                        'dimension2_key' => $dimension2_keys[$i],
                        'dimension1' => $dimension1_values[$i],
                        'dimension1_key' => $dimension1_keys[$i],
                        'upload_date' => date('Y-m-d H:i:s'),
                        'uploaded_by' => $this->session->userdata('id')

                        // Add other fields here if needed
                    );
                                    if(!empty($dimension1_values[$i])){
                                    $this->db->where("dimension1", "$dimension1_values[$i]");
                                    }
                                    if(!empty($dimension2_values[$i])){
                                    $this->db->where("dimension2", "$dimension2_values[$i]");
                                    }
                                    if(!empty($dimension3_values[$i])){
                                    $this->db->where("dimension3", "$dimension3_values[$i]");
                                    }
                                    $this->db->where("financial_year", "$sfys[$i]");
                                    $this->db->where("period", "$periods[$i]");
                                    $this->db->where('kpi_id', $kpi_ids[$i]);
                                    $this->db->from('new_data');
                                    $exists = $this->db->count_all_results() > 0;
                                    
                                    // If the record exists, update it; otherwise, insert it
                                    if ($exists) {
                                        $this->db->where('kpi_id', $kpi_ids[$i]);
                                        $this->db->update('new_data', $insert_data);
                                    } else {
                    // Insert the data into the database
                  
                 
                    $this->db->insert('new_data', $insert_data);
                }
                }
            }

            // Return success response
            $msg = "Data saved successfully!";
            $this->session->set_flashdata('message', $msg);
            
        } else {
            // If the request method is not POST, return an error response
            $msg  ="Error";
            $this->session->set_flashdata('exception', $msg);

        }
        redirect("files/add_data?kpi_id=$kpi_ids[0]&financial_year=$sfys[0]&period=$periods[0]");
    }



}