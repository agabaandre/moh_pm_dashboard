<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Template_model extends CI_Model {

	
	public function setting()
	{
		return $this->db->get('setting')->row();
	}
}
 