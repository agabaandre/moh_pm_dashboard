<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends MX_Controller {

	
	public function __Construct(){

	
		$this->db->query('SET SESSION sql_mode = ""');
	

	}


//GAUGE
	public function index(){

		
	
		$data['Error']    = "Error Please Contact the Administrator";
		$data['page']     = 'error';
		$data['module']   = "error";

	
		echo Modules::run('template/layout', $data); 
		
	
	}
	

	
}