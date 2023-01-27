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
    public function get_reporting_rate($sub,$qtr,$fy){
        $kpis_with_data = $this->db->query("SELECT distinct new_data.kpi_id as kpis_with_data from new_data join kpi on kpi.kpi_id=new_data.kpi_id WHERE kpi.subject_area='$sub' and new_data.period='$qtr' and new_data.financial_year='$fy' and new_data.period in(SELECT distinct period from new_data)")->num_rows();
        $total_kpis = $this->db->query("SELECT kpi_id as total_kpis from kpi WHERE subject_area='$sub'")->num_rows();
        $qtrs = $this->db->query("SELECT distinct period from new_data where financial_year='$fy' and period='$qtr'")->num_rows();
        if(((0 > ($kpis_with_data / $total_kpis) * 50) < 90) && ($qtrs>0)) {
            $color = "style='background-color:red; color:#FFF;'";
        }
        else if (((50> ($kpis_with_data / $total_kpis) * 100)<90) && ($qtrs>0)){
            $color = "style='background-color:yellow; color:#FFF;'";

        }
       else if (((90 > ($kpis_with_data / $total_kpis)*100) <= 100) && ($qtrs>0)){
            $color = "style='background-color:green; color:#FFF;'";
            
        }
        else if ($qtrs<=0){
            $color = "style='background-color:grey; color:grey;'";
        }
        $status = $kpis_with_data .'/'.$total_kpis;
    return (object)['report_status' => "$status",'color'=>"$color"];
    }

    



    






}