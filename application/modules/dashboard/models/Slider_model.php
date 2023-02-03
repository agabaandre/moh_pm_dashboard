<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends CI_Model {

    public function __Construct(){

				parent::__Construct();
				$this->db->query('SET SESSION sql_mode = ""');
		        $this->financial_year = $this->session->userdata('financial_year');


		}
	public function financialYear($financial_year = FALSE)
	{
		$query = $this->db->get('setting');
		$result = $query->row();
		if (empty($financial_year)) {
			// unset($_SESSION['financial_year']);
			return $_SESSION['financial_year'] = str_replace(" ", "", $result->financial_year);
		} else {
			//  unset($_SESSION['financial_year']);
			return $_SESSION['financial_year'] = str_replace(" ", "", $this->input->post('financial_year'));
		}

	}
	public function slider_data($kpi)
	{

		$query = $this->db->query("SELECT  CONCAT(period,'/',period_year) as cp,kpi_id,period,financial_year,target_value as current_target,current_value from report_kpi_trend t WHERE trim(kpi_id)='$kpi' and period = (SELECT max(period) from  report_kpi_trend WHERE kpi_id='$kpi' and financial_year='$this->financial_year') and financial_year = (SELECT distinct financial_year from report_kpi_trend WHERE kpi_id='$kpi' and financial_year='$this->financial_year')");
		$period = $query->row()->period;
              $fy = $query->row()->financial_year;
    $previous_period = $this->db->query("SELECT MAX(period) as previous_period FROM `report_kpi_trend` WHERE period!='$period'  and financial_year='$fy' and kpi_id= '$kpi' ")->row()->previous_period;
    $query1 = $this->db->query("SELECT  CONCAT(period,'/',period_year) as pp, `period` as  pervious_period, `financial_year` as previous_financial_year, `period_year` as previousperiod_year, `current_value` as previous_value, `target_value` as previous_target FROM report_kpi_trend WHERE period='$previous_period' AND kpi_id='$kpi' AND financial_year ='$fy'");

    $res= array_merge((array) $query->row(), (array) $query1->row());

	return (object) $res;
}

public function get_subjects(){
		return $this->db->get('subject_areas')->result();
}
public function getkpis($subject_area){
	    $this->db->where("subject_area","$subject_area");
		$query = $this->db->get('kpi');
return $query->result();
}





}
 