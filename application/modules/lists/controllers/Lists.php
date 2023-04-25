
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends MX_Controller
{


    public function __Construct()
    {

        parent::__Construct();
        $this->db->query('SET SESSION sql_mode = ""');

        $this->load->model('files_mdl');
        // $this->load->library('excel');  

    }
    public function index()
    {

        $data['title'] = 'Administrative Lists';
        $data['page'] = 'lists';
        $data['module'] = "lists";
        echo Modules::run('template/layout', $data);

    }
       
}