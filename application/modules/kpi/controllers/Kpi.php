<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi extends MX_Controller {

	
	public function __Construct(){

		parent::__Construct();

		$this->load->model('kpi_mdl');
		$this->load->model('graph_mdl');
		$this->module = "kpi";
		$this->load->library('form_validation');
		$this->load->library('M_pdf');
		$this->watermark=FCPATH."assets/images/moh.png";

	}

	public function Kpis(){

		$data['title']  = 'Key Performance Indicators';
		$data['page']   = 'kpi';
		$data['module'] = $this->module;
		$data['category_twos'] = $this->kpi_mdl->getCategoryTwo();

		echo Modules::run('template/layout', $data); 
	}

	public function kpiData(){

      return   $this->kpi_mdl->kpiDakpiDatata();
	}
    
	public function dashKpi($id = FALSE){
		
		$kpis = $this->kpi_mdl->navkpi($id);
        return $kpis;
	}
	public function nav_generalKpi($id){
		
		$kpis = $this->kpi_mdl->general_menukpi($id);
        return $kpis;
	}

	public function categoryKpi($id = FALSE,$kpiType){

		$kpis = $this->kpi_mdl->categoryKpi($id,$kpiType);
        return $kpis;
	}

	public function subject(){

		$data['title']  = 'Subject Areas';
		$data['page']   = 'subject';
		$data['module'] = $this->module;

		echo Modules::run('template/layout', $data); 
	}

	public function subjectData(){

      $menu = $this->kpi_mdl->subjectData();
      return $menu;
	}

	public function getCategoryTwos(){

		$rows = $this->kpi_mdl->getCategoryTwo();
		return $rows;
	}
	public function getCategoryMenu($subject){

		$rows = $this->kpi_mdl->catgoryTwoMenu($subject);
		return $rows;
	}

	//objectives for cphl
	public function categoryTwo(){

		if( $this->input->post() ):

			$insert_data = $this->input->post();
			if ($this->form_validation->run() == FALSE){

				$this->form_validation->set_rules('name', 'Objective', 'required');
                $this->form_validation->set_rules('subject_area', 'Subject area', 'required');

			    $data['message'] = $this->kpi_mdl->saveCategoryTwo($insert_data);
			    $this->session->set_flashdata('message',$data['message']);
		}

		endif;

		$data['title']    = 'Objectives';
		$data['page']     = 'category_two';
		$data['subjects'] = $this->kpi_mdl->subjectData();
		$data['module']   = $this->module;
		$data['data']     = $this->getCategoryTwos();

		echo Modules::run('template/layout', $data); 
	}

	public function addKpi(){

	  $insert = $this->input->post();
	  $data['message'] = $this->kpi_mdl->addKpi($insert);

	  $this->session->set_flashdata('message','Added');
	  $data['title']   = 'Key Performance Indicators';
	  $data['page']    = 'kpi';
	  $data['module']  = $this->module;

	  echo Modules::run('template/layout', $data); 
	}
	public function addKpiData(){

		$insert = $this->input->post();
		$data['message'] = $this->kpi_mdl->addKpi($insert);
  
		$this->session->set_flashdata('message','Saved');
		$data['title']   = 'Key Performance Indicator Data';
		$data['page']    = 'add_data';
		$data['module']  = $this->module;
  
		echo Modules::run('template/layout', $data); 
	  }

	public function updateKpi(){

	    $kpi  = $this->input->post('kpi_id');
		$is   = $this->input->post('indicator_statement');
		$sn   = $this->input->post('short_name');
		$des  = $this->input->post('description');
		$ds   = $this->input->post('data_sources');
		$freq = $this->input->post('frequency');
		$target = $this->input->post('current_target');
		$comp   = $this->input->post('computation');
		$sa     = $this->input->post('subject_area');
		$ic     = $this->input->post('is_cumulative');
		$kpiType = $this->input->post('kpi_type');

		$count = count($kpi);
		//print_r($count);

		for($i=0;$i<$count; $i++){
		//build and insert array
		$insert = array(
			'kpi_id'			  => $kpi[$i],
			'indicator_statement' => $is[$i],
			'description'		=> $des[$i],
		    'frequency'			=> $freq[$i],
		    'data_sources'		=> $ds[$i],
		    'current_target'	=> $target[$i],
		    'computation'		=> $comp[$i],
		    'subject_area'		=> $sa[$i],
		    'is_cumulative'		=> $ic[$i],
		    'indicator_type_id' => $kpiType[$i],
		    'short_name'        => $sn[$i]
		);
	
		 $data['message'] = $this->kpi_mdl->updatekpiData($insert);
		// print_r($insert);
		
		} 
	
		$this->session->set_flashdata('message','Saved');

		$data['title']  = 'Key Performance Indicators';
		$data['page']   = 'kpi';
		$data['module'] = $this->module;

		echo Modules::run('template/layout', $data); 
	  }

	public function addSubject(){

	  $insert=$this->input->post();
	  //print_r($insert);
      $data['message'] = $this->kpi_mdl->addsubject($insert);

	  $this->session->set_flashdata('message',$data['message']);

      $data['title']  = 'Subject Areas';
	  $data['page']   = 'subject';
	  $data['module'] = $this->module;
	 // echo Modules::run('template/layout', $data);

	}

	public function kpiDisplayData(){
       return   $this->kpi_mdl->kpiDisplayData();
	}

	public function insertDisplayData(){

		$kpi   = $this->input->post('kpi_id');
		$dash  = $this->input->post('dashboard_index');
		$sub   = $this->input->post('subject_index');
		$count = count($kpi);
		 
		for($i=0;$i<$count; $i++){
		//build and insert array
		 $insert = array('kpi_id' => $kpi[$i],'dashboard_index' => $dash[$i],'subject_index' =>$sub[$i]);
		 $data['message'] = $this->kpi_mdl->insertDisplayData($insert);

		} 
	
		$this->session->set_flashdata('message','Saved');
	
		$data['title']  = 'KPI Display ';
		$data['page']   = 'kpi_display';
		$data['module'] = $this->module;

		echo Modules::run('template/layout', $data); 
	}

	public function kpiDisplay(){
	 
      $data['title']  = 'KPI Display ';
	  $data['page']   = 'kpi_display';
	  $data['module'] = $this->module;

	  echo Modules::run('template/layout', $data); 
	}

	public function summary(){
	 
		$data['title']  = 'KPI Summary ';
		$data['page']   = 'kpi_summary';
		$data['module'] = $this->module;

		echo Modules::run('template/layout', $data); 
	}
	public function summaryData(){

		return   $this->kpi_mdl->kpiSummaryData();
	}

	public function kpiTrendcolors(
		 $current_target,$gauge_value
		,$previousgauge_value
		,$current_period  = FALSE
		,$previous_period = FALSE){
		
		if ($previous_period != 0){
			$previous_period = 'for '. $previous_period;
		}
		else{
		   $previous_period = '';
		}
   
		if(($current_target) > 40){
			if ($gauge_value >= $current_target){
			return 'style="background-color:green; color:white;"';
			} 
			elseif (($gauge_value < $current_target)&&($gauge_value >= 50)){
			return 'style="background-color:orange; color:white;"';
			} 
			
			else
			{
			return 'style="background-color:red; color:white;"';
			}
		}  

		//reducing
	   if(($current_target)<40){
	  
			if ($gauge_value <= $current_target){
				return 'style="background-color:green; color:white;"';
			} 
			elseif (($gauge_value < $current_target)&&($gauge_value >= 50)){
				return 'style="background-color:orange; color:white;"';
			} 
			
			else
			{
			return 'style="background-color:red; color:white;"';
			}
		}  
   
	}

	public function gaugeData($kpi){

		$data['chartkpi'] = $kpi;
		//gauge data
		$data['gauge'] = $this->graph_mdl->gaugeData(str_replace(" ",'',$kpi));
		$data['financial_year'] = $_SESSION['financial_year'];
		$data['module'] = "data";

	    return $data;
	}

	
	public function printsummary($view){
		  
		  $html=$this->load->view($view,$data='',true);   
		  $PDFContent = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
		  $this->m_pdf->pdf->SetWatermarkImage($this->watermark);
		  $this->m_pdf->pdf->showWatermarkImage = true;
		  date_default_timezone_set("Africa/Kampala"); 
		  $this->m_pdf->pdf->SetHTMLFooter("Printed/ Accessed on: <b>".date('d F,Y h:i A')."</b><br style='font-size: 9px !imporntant;'>"." Source: MoH PM Dashboard " .base_url());
		  $this->m_pdf->pdf->SetWatermarkImage($this->watermark);
		  $this->m_pdf->showWatermarkImage = true;
		  ini_set('max_execution_time',0);
		  $this->m_pdf->pdf->WriteHTML($PDFContent); //ml_pdf because we loaded the library ml_pdf for landscape format not m_pdf
		  //download it D save F.
		  $this->m_pdf->pdf->Output($filename,'I');
		  }

	

	



}
