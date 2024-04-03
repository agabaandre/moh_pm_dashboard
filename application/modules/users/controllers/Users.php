<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(
			array(
				'user_mdl'
			)
		);

		if (!$this->session->userdata('isAdmin'))
			redirect('login');
	}

	public function index()
	{
		$data['title'] = display('user_list');
		$data['module'] = "users";
		$data['page'] = "list";
		$data['user'] = $this->user_mdl->read();
		echo Modules::run('template/layout', $data);
	}
	


	public function email_check($email, $id)
	{
		$emailExists = $this->db->select('email')
			->where('email', $email)
			->where_not_in('id', $id)
			->get('user')
			->num_rows();

		if ($emailExists > 0) {
			$this->form_validation->set_message('email_check', 'The {field} is already registered.');
			return false;
		} else {
			return true;
		}
	}


	public function form()
	{
		@$id = $this->uri->segment(3);
		$data['title'] = display('add_user');
		/*-----------------------------------*/
		$this->form_validation->set_rules('firstname', display('firstname'), 'required|max_length[50]');
		$this->form_validation->set_rules('lastname', display('lastname'), 'required|max_length[50]');
		#------------------------#
		$this->form_validation->set_rules('email', display('email'), 'required|valid_email|max_length[100]');
	
		$this->form_validation->set_rules('status', display('status'), 'required|max_length[1]');
		/*-----------------------------------*/
		$config['upload_path'] = './assets/img/user/';
		$config['allowed_types'] = 'gif|jpg|png';
		$image = $this->input->post('image');
		/*-----------------------------------*/
		if (!empty(($this->input->post('subject_area')) && ($this->input->post('user_type') != 'admin'))) {
			@$subjectarea = json_encode($this->input->post('subject_area'));
		} else {
			@$subjectarea = '';
		}

		$data['user'] = (object) $userLevelData = array(
			'id' => $this->input->post('id'),
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'email' => $this->input->post('email'),
			'password' => (!empty($this->input->post('password')) ? $this->argonhash->make($this->input->post('password')) : $this->argonhash->make($this->input->post('oldpassword'))),
			'about' => $this->input->post('about', true),
			'image' => (!empty($image) ? $image : $this->input->post('old_image')),
			'last_login' => null,
			'last_logout' => null,
			'ip_address' => null,
			'status' => $this->input->post('status'),
			'subject_area' => $subjectarea,
			'info_category' => $this->input->post('info_category'),
			'allow_form' => $this->input->post('allow_form'),
			'allow_upload' => $this->input->post('allow_upload'),
			'allow_all_categories' => $this->input->post('allow_all_categories'),
			'user_type' => $this->input->post('user_type'),
			'is_admin' => 0
		);

		/*-----------------------------------*/
		if ($this->form_validation->run()) {


			if (empty($userLevelData['id'])) {
				if ($this->user_mdl->create($userLevelData)) {
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect("users/form");

			} else {
				if ($this->user_mdl->update($userLevelData)) {
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				$post_id = $this->input->post('id');
				redirect("users/form/$post_id ");
			}
		}


		 else {
			$data['module'] = "users";
			$data['page'] = "form";
			if (!empty($id)) {
				$data['user'] = $this->user_mdl->single($id);
			}
			echo Modules::run('template/layout', $data);
		}
	}

	public function delete($id = null)
	{
		if ($this->user_mdl->delete($id)) {
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));
		}

		redirect("index");
	}


}