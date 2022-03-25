<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi_mdl extends CI_Model {

		
	public function __Construct(){
			parent::__Construct();
			$this->db->query('SET SESSION sql_mode = ""');
	}

	public function kpiData(){

		$query=$this->db->query("SELECT s.id as sid,k.*,s.* FROM kpi k left join subject_areas s on s.id=k.subject_area ORDER BY kpi_id ASC");
		return $query->result();
	}

	public function navkpi($id){

		$this->db->where('subject_area', $id);
		$this->db->join("subject_areas", "subject_areas.id=$id");
		$query = $this->db->get('kpi');
		return $query->result();
	}
	
	public function general_menukpi($id){

		$this->db->where('category_two_id', $id);
		$this->db->join("category_two", "category_two.id=$id");
		$query = $this->db->get('kpi');
		return $query->result();
	}

	public function categoryKpi($id,$kpiType){

		$this->db->where('subject_area', $id);
		$this->db->where('indicator_type_id', $kpiType);
		$this->db->join("subject_areas", "subject_areas.id=$id");

		$query = $this->db->get('kpi');
		return $query->result();
	}

	public function subjectData(){
		@$limit=dashlimits('wheresubject');

		$query = $this->db->query("SELECT * FROM subject_areas $limit");
		return $query->result();
	}

	public function addKpi($data){

		$query = $this->db->insert('kpi',$data);

		if ($query){
			$message ="Succesful";
		} else{
			$message ="Failed";

		return $data;
		}
	}


	public function addSubject($data){

		$query = $this->db->insert('subject_areas',$data);

		if ($query){
			$message ="Succesful";
		} else{
			$message = "Failed";

		return $data;
		}
	}


	public function kpiDisplayData(){

		$query = $this->db->query("SELECT kpi.kpi_id, subject_areas.name, kpi.indicator_statement,kpi_displays.dashboard_index,kpi_displays.subject_index FROM kpi left join subject_areas on subject_areas.id=kpi.subject_area left join kpi_displays on kpi.kpi_id=kpi_displays.kpi_id");
		return $query->result();
	}


	public function kpiSummaryData(){

		$query = $this->db->query("SELECT kpi.kpi_id, report_kpi_summary.kpi_id, short_name,frequency subject_areas.name FROM kpi,report_kpi_summary,subject_areas WHERE kpi.kpi_id=report_kpi_summary.kpi_id AND subject_areas.id=kpi.subject_area order by subject_areas.name ASC, short_name ASC ");
		return $query->result();
	}

	public function insertDisplayData($data){

		$query = $this->db->replace('kpi_displays',$data);
		
		if ($query){
			$message ="Succesful";
		}else{
			$message = "Failed";
			return $data;
		}

	}

	public function updatekpiData($data){
		
		$query = $this->db->replace('kpi', $data);

		if ($query){
			$message ="Succesful";
		} else{
			$message = "Failed";

		return $data;
		}
	}

	public function catgoryTwoMenu($subject)
	{
	 $this->db->where("subject_area_id","$subject");
	 return $this->db->get('category_two')->result();
	}


	public function getCategoryTwo($subject = false)
	{

		$this->db->select("category_two.*");
		
		if($subject){
			$this->db->join('subject_areas','category_two.subject_area_id=subject_areas.id');
		}
		return $this->db->get('category_two')->result();
	}


	public function saveCategoryTwo($data)
	{

		$insert_data   = array(
			"cat_name" => $data['name'],
			"cat_description"   => $data['description'],
			"subject_area_id"   => $data['subject_area'],
			"cat_display_index" => $data['display_index'],
			//"module" => $data['module'],
			"icon"   => ($data['icon'])?$data['icon']:null
		);
		
		$message = "Operation Failed";
		$query   = $this->db->insert('category_two',$insert_data);

		if ($query)
			$message ="Objective added successfully";
		
		return $message;
		
	}

	public function fetchKpi($id)
	{
		$this->db->where('kpi_id',$id);
		$query = $this->db->get('kpi');
		return $query->row();
	}

	public function kpiRecordsData($kpiId)
	{
		$this->db->where('kpi_id',$kpiId);
		$query = $this->db->get('new_data');
		return $query->row();
	}


}
