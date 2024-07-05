<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();

   $this->db->query('SET SESSION sql_mode = ""');

 		$this->load->model(array(
 			'auth_model'
 		));

		//$this->load->helper('captcha');
 	}

	public function index()
	{  
		if ($this->session->userdata('isLogIn'))
		redirect('dashboard/home');
		$data['title']    = display('login'); 
		$this->form_validation->set_rules('email', display('email'), 'required|valid_email|max_length[100]|trim');
		$this->form_validation->set_rules('password', display('password'), 'required|max_length[100]|trim');

		$data['user'] = (object)$userData = array(
			'email' 	 => $this->input->post('email'),
			'password'   => $this->input->post('password'),
		);
		#-------------------------------------#
		if ( $this->form_validation->run())
		{

		$user = $this->auth_model->checkUser($userData);

		$user->row()->password;
		
	     $auth = ($this->argonhash->check($this->input->post('password'), $user->row()->password));

		// 	print_r($this->argonhash->make($this->input->post('password')));
		//  die();
		
		if($auth) {

             	$sData = array(
					'isLogIn' 	  => true,
					'isAdmin' 	  => (($user->row()->is_admin == 1)?true:false),
					'id' 		  => $user->row()->id,
					'fullname'	  => $user->row()->fullname,
					'user_level'  => $user->row()->user_level,
					'email' 	  => $user->row()->email,
					'image' 	  => $user->row()->image,
					'last_login'  => $user->row()->last_login,
					'last_logout' => $user->row()->last_logout,
					'ip_address'  => $user->row()->ip_address,
					'user_type'  => $user->row()->user_type,
					'subject_area'  => $user->row()->subject_area,
					'financial_year' => $this->current_financial_year(),
					'dimension_chart' => $this->dimension_chart(),
					'info_category' => $user->row()->info_category,
					'allow_upload' => $user->row()->allow_upload,
					'allow_form' => $user->row()->allow_form,
					'allow_all_categories'=> $user->row()->allow_all_categories
					);	

					//store date to session 
					$this->session->set_userdata($sData);
					//update database status
					$this->auth_model->last_login();
					
					$this->session->set_flashdata('message', display('welcome_back').' '.$user->row()->fullname);
					redirect('dashboard/home/department_reporting');

			   } else {
				$this->session->set_flashdata('exception', display('incorrect_email_or_password'));
				redirect('login');
			} 

		} else {

			echo Modules::run('template/login',$data);
		}
	}

	public function financialYear()
	{
	
	$_SESSION['financial_year'] = str_replace(" ", "", $this->input->post('financial_year'));

	redirect('dashboard/home');
	

	}

	public function dimension_chart(){
	return $this->db->get('setting')->row()->dimension_chart;
	}

	public function current_financial_year()
	{
		//returns current financial_year
		// $current_year = date("Y");
		// $current_month = date("m");
		// if ($current_month > 6) {
		// 	return ($current_year . "-" . ($current_year + 1));
		// } else {
		// 	return (($current_year - 1) . "-" . $current_year);
		// }

		return $this->db->query("SELECT MAX(financial_year) as financial_year from new_data")->row()->financial_year;
	}
  
	public function logout()
	{ 
		//update database status
		$this->auth_model->last_logout();
		//destroy session
		$this->session->sess_destroy();
		redirect('login');
	}
    /*
 |--------------------------------------------------------
 | Finger print Device information
 |--------------------------------------------------------
 */
 public function deviceData(){
    return $this->db->select('*')->from('deviceinfo')->get()->row();
 }
 function DataCategory(){
		$_SESSION['info_category'] = $_GET['info_category'];
		redirect();
 }
}


