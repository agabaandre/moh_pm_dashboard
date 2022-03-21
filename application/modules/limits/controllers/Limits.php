<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Limits extends MX_Controller {

	
	public function __Construct(){
        // $this->load->model("Limits_mdl","l_mdl");
        $this->db->query('SET SESSION sql_mode = ""');

       
	}
    public function setYear(){
        $_SESSION['fy']=$this->input->post('financial_year');
     redirect('dashboard/home');
    }
  
  
  
    
	



}
