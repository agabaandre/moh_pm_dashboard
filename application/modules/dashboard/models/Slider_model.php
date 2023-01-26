<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends CI_Model {

    public function __Construct(){

				parent::__Construct();
				$this->db->query('SET SESSION sql_mode = ""');


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
	public function slider_data()
	{
		
		
	}

	public function get_departments(){
		return $this->db->get('subject_areas')->result();
	}





}
 