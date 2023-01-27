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
    public function get_reporting_rate($sub, $qtr, $fy)
    {
        // Get the number of distinct KPIs with data that match the subject area, quarter, and financial year
        $kpis_with_data = $this->db->query("SELECT COUNT(DISTINCT new_data.kpi_id) as kpis_with_data FROM new_data JOIN kpi ON kpi.kpi_id = new_data.kpi_id WHERE kpi.subject_area = '$sub' AND new_data.period = '$qtr' AND new_data.financial_year = '$fy'")->row()->kpis_with_data;

        // Get the total number of KPIs that match the subject area
        $total_kpis = $this->db->query("SELECT COUNT(kpi_id) as total_kpis FROM kpi WHERE subject_area = '$sub'")->row()->total_kpis;

        // Get the number of distinct quarters that match the financial year and quarter
        $qtrs = $this->db->query("SELECT COUNT(DISTINCT period) as total_qtrs FROM new_data WHERE financial_year = '$fy' AND period = '$qtr'")->row()->total_qtrs;

        // Initialize the color variable
        $color = "";

        // Calculate the reporting rate as a percentage
        if ($total_kpis > 0) {
            $reporting_rate = ($kpis_with_data / $total_kpis) * 100;
        } else {
            $reporting_rate = null;
        }

        // Set the color based on the reporting rate
        if ($qtrs > 0) {
            if ($reporting_rate === null) {
                $color = "style='background-color:red; color:#FFF;'";
            } elseif ($reporting_rate < 50) {
                $color = "style='background-color:red; color:#FFF;'";
            } elseif ($reporting_rate >= 50 && $reporting_rate < 90) {
                $color = "style='background-color:yellow; color:#FFF;'";
            } elseif ($reporting_rate >= 90) {
                $color = "style='background-color:green; color:#FFF;'";
            }
        } else {
            $color = "style='background-color:grey; color:grey;'";
        }
        $status = $kpis_with_data . '/' . $total_kpis;
        return (object) ['report_status' => "$status", 'color' => "$color"];
    }













}