
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends MX_Controller {

	
	public function __Construct(){

		parent::__Construct();

		$this->load->model('files_mdl');
        $this->load->library('excel');  

	}
    public function file(){

		$data['title']='Upload KPI Data';
		$data['page'] ='files';
		$data['module']="files";
		echo Modules::run('template/layout', $data); 

	}
    function importcsv() {
            if(isset($_FILES["upload_csv_file"]["name"]))
            {
                $path = $_FILES["upload_csv_file"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach($object->getWorksheetIterator() as $sale)
                {
                    $highestRow = $sale->getHighestRow();
                    $highestColumn = $sale->getHighestColumn();
                    for($row=2; $row<=$highestRow; $row++)
                    {

                    if(!empty($sale->getCellByColumnAndRow(1, $row)->getValue())){
                        $dim1=trim($sale->getCellByColumnAndRow(1, $row)->getValue());
                        $dim1k=trim($sale->getCellByColumnAndRow(2, $row)->getValue());
                    }
                    else{
                        $dim1 = NULL;
                        $dim1k= NULL;

                    }

                
                    if(!empty($sale->getCellByColumnAndRow(3, $row)->getValue())){
                        $dim2=trim($sale->getCellByColumnAndRow(3, $row)->getValue());
                        $dim2k=trim($sale->getCellByColumnAndRow(4, $row)->getValue());
                    }
                    else{
                        $dim2 = NULL;
                        $dim2k= NULL;

                    }
                       if(!empty(trim($sale->getCellByColumnAndRow(5, $row)->getValue()))){
                        $dim3=trim($sale->getCellByColumnAndRow(5, $row)->getValue());
                        $dim3k=trim($sale->getCellByColumnAndRow(6, $row)->getValue());
                    }
                    else{
                        $dim3 = NULL;
                        $dim3k= NULL;

                    }

                   $data = array('kpi_id'  =>  str_replace(" ", "",$sale->getCellByColumnAndRow(0, $row)->getValue()), 
                        'dimension1' => $dim1, 
                        'dimension1_key'    =>  $dim1k, 	
                        'dimension2'  =>  $dim2, 	
                        'dimension2_key'  =>  $dim2k, 	
                        'dimension3'  =>  $dim3, 	
                        'dimension3_key'  =>  $dim3k, 
                        'financial_year'  =>  str_replace(" ", "",$sale->getCellByColumnAndRow(7, $row)->getValue()),
                        'period_year'  =>  str_replace(" ", "",$sale->getCellByColumnAndRow(8, $row)->getValue()),  
                        'period'  =>  str_replace(" ", "",$sale->getCellByColumnAndRow(9, $row)->getValue()), 
                        'denominator'  =>  str_replace(" ", "",$sale->getCellByColumnAndRow(10, $row)->getValue()), 
                        'numerator'  =>  str_replace(" ", "",$sale->getCellByColumnAndRow(11, $row)->getValue()), 	
                        'data_target'  =>  str_replace(" ", "",$sale->getCellByColumnAndRow(12, $row)->getValue())
                        );

                 // print_r($data);
            
                 if(!empty($data)){
                   $this->db->insert("new_data",$data);
                }
            
    
            }
            }
            
        $this->session->set_flashdata('message', 'Upload Successful');
        redirect('files/file');
    }
    } 

}