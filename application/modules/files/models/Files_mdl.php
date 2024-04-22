<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files_mdl extends CI_Model {

	
public function __Construct(){

		parent::__Construct();


}
public function get_kpi_data($kpi_id,$period,$financial_year){

	$this->db->where('kpi_id',"$kpi_id");
	$this->db->where('period', "$period");
	$this->db->where('financial_year', "$financial_year");
	$res =$this->db->get('new_data');

	return $res->result();



}

}