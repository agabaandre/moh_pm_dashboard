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

		$this->load->helper('captcha');
 	}

	public function index()
	{  
		if ($this->session->userdata('isLogIn'))
		redirect('dashboard/home');
		$data['title']    = display('login'); 

		#-------------------------------------#
		$this->form_validation->set_rules('email', display('email'), 'required|valid_email|max_length[100]|trim');
		$this->form_validation->set_rules('password', display('password'), 'required|max_length[32]|md5|trim');
		
		$this->form_validation->set_rules(
		    'captcha', display('captcha'),
		    array(
		        'matches[captcha]', 
		        function($captcha)
		        { 
		        	$oldCaptcha = $this->session->userdata('captcha');
		        	if ($captcha == $oldCaptcha) {
		        		return true;
		        	}
		        }
		    )
		);


		#-------------------------------------#
		$data['user'] = (object)$userData = array(
			'email' 	 => $this->input->post('email'),
			'password'   => $this->input->post('password'),
		);
		#-------------------------------------#
		if ( $this->form_validation->run())
		{
			
			$this->session->unset_userdata('captcha');

			$user = $this->auth_model->checkUser($userData);

		if($user->num_rows() > 0) {

			if($user->row()->is_admin == 2){
				$row = $this->db->select('client_id,client_email')->where('client_email',$user->row()->email)->get('setup_client_tbl')->row();
			}
             	$sData = array(
					'isLogIn' 	  => true,
					'isAdmin' 	  => (($user->row()->is_admin == 1)?true:false),
					'user_type'   => $user->row()->is_admin,
					'id' 		  => $user->row()->id,
					'client_id'   => @$row->client_id,
					'fullname'	  => $user->row()->fullname,
					'user_level'  => $user->row()->user_level,
					'email' 	  => $user->row()->email,
					'image' 	  => $user->row()->image,
					'last_login'  => $user->row()->last_login,
					'last_logout' => $user->row()->last_logout,
					'ip_address'  => $user->row()->ip_address,
					'user_type'  => $user->row()->user_type,
					'subject_area'  => $user->row()->subject_area,
					'permission'  => json_encode(@$permission), 
					'label_permission'  => json_encode(@$permission1) 
					);	

					//store date to session 
					$this->session->set_userdata($sData);
					//update database status
					$this->auth_model->last_login();
					
					$this->session->set_flashdata('message', display('welcome_back').' '.$user->row()->fullname);
					redirect('dashboard/home');

			} else {
				$this->session->set_flashdata('exception', display('incorrect_email_or_password'));
				redirect('login');
			} 

		} else {

			$captcha = create_captcha(array(
			    'img_path'      => './assets/img/captcha/',
			    'img_url'       => base_url('assets/img/captcha/'),
			    'font_path'     => './assets/fonts/captcha.ttf',
			    'img_width'     => '300',
			    'img_height'    => 64,
			    'expiration'    => 600, //5 min
			    'word_length'   => 4,
			    'font_size'     => 26,
			    'img_id'        => 'Imageid',
			    'pool'          => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',

			    // White background and border, black text and red grid
			    'colors'        => array(
			            'background' => array(255, 255, 255),
			            'border'     => array(228, 229, 231),
			            'text'       => array(13,94,132),
			            'grid'       => array(199, 222, 255)
			    )
			));
			$data['captcha_word'] = $captcha['word'];
			$data['captcha_image'] = $captcha['image'];
			$this->session->set_userdata('captcha', $captcha['word']);

			echo Modules::run('template/login', $data);
		}
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
}