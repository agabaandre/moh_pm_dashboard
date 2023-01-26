<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->db->query('SET SESSION sql_mode = ""');

        $this->load->model('slider_model');


    }

    function index()
    {
        $data['sliders'] = $this->slider_model->slider_data();
        $data['module'] = "dashboard";
        $data['page'] = "home/Slider";
        $data['uptitle'] = "Performance Over View";
        $data['title'] = "Perfomance";
        echo Modules::run('template/layout', $data);
    }



}