<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Home extends 	MX_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		
 		$this->load->model('home_model'); 

	
 	}
 
	function index(){
	    $data['dashkpis']=$this->home_model->dashData();
		$data['module']      = "dashboard";
		$data['page']        = "home/index";
		$data['uptitle']        = "Main Dashboard";
		$data['title']        = "Dashboard";
		echo Modules::run('template/layout', $data); 
	}

	function department_reporting()
	{
		$data['module'] = "dashboard";
		$data['page'] = "home/department_report";
		$data['uptitle'] = "Department Reports";
		$data['title'] = "Reporting by Job";
		if(!empty(json_decode($this->session->userdata('subject_area'),true))||(!empty($this->input->get('subject_area')))){

			@$si= json_decode($this->session->userdata('subject_area'),true);
			if(!empty($si)){
				$subject_area =$si;
			}
			else{
				$subject_area = $this->input->get('subject_area');
			}
			$this->db->where_in('subject_areas.id',$subject_area);
			$query = $this->db->get('subject_areas');
			$data['subject_areas']  = $query->result();
			// print_r($subject_area);
			// exit;
		}
		
		else{
			$data['subject_areas'] = $this->db->get('subject_areas')->result();

		}

		// print_r($data);
		// exit;


		echo Modules::run('template/layout', $data);
	}
	public function getkpis()
	{
		$subject = urldecode($this->input->get('subject_area'));
		$kpis = $this->db->query("SELECT * FROM kpi WHERE kpi.subject_area='$subject'")->result();
		$opt = ""; // Initialize $opt before the loop
		if (!empty($kpis)) {
			foreach ($kpis as $row) {

				$opt .= "<option value='" . $row->kpi_id . "'>" . ucwords($row->short_name) . "</option>";
			}
		}

		echo $opt;

	}

	//get department report_rate

	public function get_departments()


	{

	   if(!empty(json_decode($this->session->userdata('subject_area')))){

			$subject_area = json_decode($this->session->userdata('subject_area'))[0];
			$this->db->where('subject_areas.id',$subject_area);
			// $this->db->limit();
			$query = $this->db->get('subject_areas');
			return $data['departments']  = $query->result();
		
		}
		elseif(!empty($this->input->get('kpi_group'))){
			$subject_area = $this->input->get('kpi_group');
			$this->db->where('subject_areas.id', $subject_area);
			// $this->db->limit();
			$query = $this->db->get('subject_areas');


		}
		else{
			//$this->db->limit();
			return $data['departments'] = $this->db->get('subject_areas')->result();

		}
	
	}
	public function kpis($subject_area)
	{
		if(!empty($this->input->get('kpi_id'))){
		$kpid_id = $this->input->get('kpi_id');
		$this->db->where('kpi_id', $kpid_id);
		}
		$this->db->where('subject_area',$subject_area);
		return $this->db->get('kpi')->result();
	
	}

	public function kpi_performance($subject_area, $period, $kpi_id = FALSE, $financial_year = FALSE)
{
    $current_date = date('Y-m-d');
    $current_year = date('Y', strtotime($current_date));
    $next_year = $current_year + 1;
    if (date('m-d', strtotime($current_date)) < '06-30') {
        $current_year -= 1;
        $next_year -= 1;
    }
    $current_financial_year = $current_year . '-' . $next_year;

    if (empty($financial_year)) {
        $financial_year = $current_financial_year;
    }

  

    return $this->db->query("
        SELECT 
            r.*,
            k.computation,
            k.short_name,
            k.subject_area 
        FROM 
            kpi k 
        LEFT JOIN 
            report_kpi_trend r 
        ON 
            r.kpi_id = '$kpi_id'
            AND r.financial_year = '$financial_year' 
            AND r.period = '$period' 
           
        WHERE 
            k.subject_area = $subject_area
    ")->row();
}

	
	




	public function profile()
	{
		$data['title']  = "Profile";
		$data['module'] = "dashboard";  
		$data['page']   = "home/profile";  
		$id = $this->session->userdata('id');//
		$data['user']   = $this->home_model->profile($id);
		echo Modules::run('template/layout', $data);  
	}

	public function setting()
	{ 
		$data['title']    = "Profile Setting";
		$id = $this->session->userdata('id');
		/*-----------------------------------*/
		$this->form_validation->set_rules('firstname', 'First Name','required|max_length[50]');
		$this->form_validation->set_rules('lastname', 'Last Name','required|max_length[50]');
		#------------------------#
       	$this->form_validation->set_rules('email', 'Email Address', "required|valid_email|max_length[100]");
       	/*---#callback fn not supported#---*/ 
		#------------------------#
		$this->form_validation->set_rules('password', 'Password','max_length[200]');
		$this->form_validation->set_rules('about', 'About','max_length[1000]');
		/*-----------------------------------*/
        $config['upload_path']          = './assets/img/user/';
        $config['allowed_types']        = 'gif|jpg|png'; 

        $this->load->library('upload', $config);
 
        if ($this->upload->do_upload('image')) {  
            $data = $this->upload->data();  
            $image = $config['upload_path'].$data['file_name']; 

			$config['image_library']  = 'gd2';
			$config['source_image']   = $image;
			$config['create_thumb']   = false;
			$config['maintain_ratio'] = TRUE;
			$config['width']          = 115;
			$config['height']         = 90;
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->session->set_flashdata('message', "Image Upload Successfully!");
        }
		/*-----------------------------------*/
		$data['user'] = (object)$userData = array(
			'id' 		  => $this->input->post('id'),
			'firstname'   => $this->input->post('firstname'),
			'lastname' 	  => $this->input->post('lastname'),
			'email' 	  => $this->input->post('email'),
			'password' 	  => (!empty($this->input->post('password')) ? $this->argonhash->make($this->input->post('password')) : $this->input->post('oldpassword')),
			'about' 	  => $this->input->post('about',true),
			'image'   	  => (!empty($image)?$image:$this->input->post('old_image')) 
		);

		/*-----------------------------------*/
		if ($this->form_validation->run()) {

	        if (empty($userData['image'])) {
				$this->session->set_flashdata('exception', $this->upload->display_errors()); 
	        }

			if ($this->home_model->setting($userData)) {

				$this->session->set_userdata(array(
					'fullname'   => $this->input->post('firstname'). ' ' .$this->input->post('lastname'),
					'email' 	  => $this->input->post('email'),
					'image'   	  => (!empty($image)?$image:$this->input->post('old_image'))
				));


				$this->session->set_flashdata('message', display('update_successfully'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("dashboard/home/setting");

		} else {
			$data['module'] = "dashboard";  
			$data['page']   = "home/profile_setting"; 
			if(!empty($id))
			$data['user']   = $this->home_model->profile($id);
			echo Modules::run('template/layout', $data);
		}
	}
	///// Notice 
	 public function view_details(){
        $id = $this->uri->segment(4);
		$data['module'] = "dashboard";  
		$data['page']   = "home/notice_details";  
		$data['detls']   = $this->evencal->details($id);
       echo Modules::run('template/layout', $data); 

    }

}
