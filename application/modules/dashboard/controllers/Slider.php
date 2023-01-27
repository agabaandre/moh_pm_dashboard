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

    public function reporting_rate($subject)
    {
        $query = $this->db->query("SELECT distinct new_data.kpi_id from new_data join kpi on kpi.kpi_id=new_data.kpi_id WHERE kpi.subject_area='$subject'")->num_rows();
        return $query;
    }

    function department_reporting()
    {
        $data['module'] = "dashboard";
        $data['page'] = "home/reporting_rates";
        $data['uptitle'] = "KPI Reporting Rates by Department";
        $data['title'] = "Reporting by Departement";
        echo Modules::run('template/layout', $data);
    }



    






}