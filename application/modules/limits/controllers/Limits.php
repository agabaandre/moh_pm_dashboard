<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjobs extends MX_Controller {

	
	public function __Construct(){
        $this->load->model("Limits_mdl","l_mdl");

       
	}
    public function setYear(){
        $_SESSION['fy']=$this->input->post('financial_year');
     redirect('dashboard/home');
    }
    public function limitdepartment(){
   }
    
	



}
