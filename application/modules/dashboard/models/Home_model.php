<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

    public function __Construct(){

				parent::__Construct();

		//financial_year is from settings financial Year/ allows 1 2 for current and previous year respectively
		$this->financial_year=$this->financialYear();

		}
		public function financialYear($financial_year=FALSE){
			$query=$this->db->get('setting');
			$result=$query->row();
		if(empty($financial_year)){
			// unset($_SESSION['financial_year']);
		return $_SESSION['financial_year']=str_replace(" ","",$result->financial_year);
			}
		else{
			//  unset($_SESSION['financial_year']);
		return $_SESSION['financial_year']=str_replace(" ","",$this->input->post('financial_year'));
		}

	}

	public function checkUser($data = array())
	{
		return $this->db->select("
				user.id, 
				CONCAT_WS(' ', user.firstname, user.lastname) AS fullname,
				user.email, 
				user.image, 
				user.last_login,
				user.last_logout, 
				user.ip_address, 
				user.status, 
				user.is_admin, 
				IF (user.is_admin=1, 'Admin', 'User') as user_level
			")
			->from('user')
			->where('email', $data['email'])
			->where('password', md5($data['password']))
			->get();
	}

	

	public function last_login($id = null)
	{
		return $this->db->set('last_login', date('Y-m-d H:i:s'))
			->set('ip_address', $this->input->ip_address())
			->where('id',$this->session->userdata('id'))
			->update('user');
	}

	public function last_logout($id = null)
	{
		return $this->db->set('last_logout', date('Y-m-d H:i:s'))
			->where('id', $this->session->userdata('id'))
			->update('user');
	}

	public function profile($id = null)
	{
		return $this->db->select("
			*, 
				CONCAT_WS(' ', firstname, lastname) AS fullname,
				IF (user.is_admin=1, 'Admin', 'User') as user_level
			")
			->from("user")
			->where("id", $id)
			->get()
			->row();
	}

	public function setting($data = array())
	{
		return $this->db->where('id', $data['id'])
			->update('user', $data);
	}
    public function dashData(){
          //$query = $this->db->get("kpi_displays");
		  $query=$this->db->query("SELECT subject_areas.id,kpi.subject_area,kpi_displays.kpi_id,kpi.kpi_id,dashboard_index,subject_index,subject_areas.module FROM kpi right join subject_areas on subject_areas.id=kpi.subject_area right join kpi_displays on kpi_displays.kpi_id =kpi.kpi_id where kpi.kpi_id in (SELECT DISTINCT trim(kpi_id) from new_data) and dashboard_index!='0'  order by dashboard_index ");

		 // $query=$this->db->query("SELECT subject_areas.id,kpi.kpi_id FROM kpi right join subject_areas on subject_areas.id=kpi.subject_area ");

			return $query->result();
	}





}
 