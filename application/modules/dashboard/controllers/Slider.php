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
        $data['module'] = "dashboard";
        $data['page'] = "home/slider";
        $data['uptitle'] = "Performance Over View";
        $data['title'] = "Perfomance";
        echo Modules::run('template/layout', $data);
    }

    public function getsummaries($kpi){

        return $this->slider_model->slider_data($kpi);
    }
    public function getsubjects()
    {
        return $this->slider_model->get_subjects();
    }
    public function getkpi($subject)
    {
        return $this->slider_model->getkpis($subject);
    }



}