<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


//objective

if (!function_exists('objective')) {

  function objective($id)
  {
    $ci =& get_instance();
    $ci->load->database();
    $table  = 'category_two';
    $ci->db->where('id',$id);
    return $ci->db->get($table)->row();
  }

}


if (!function_exists('generate_kpi_id')) {

  function generate_kpi_id(){
    $ci =& get_instance();
    $ci->load->database();
    $table  = 'kpi';

    $ci->db->select('max(kpi_id) as kip');
    $kpi =  $ci->db->get($table)->row()->kip;
    $kpi_parts = explode('-',$kpi);
    return $kpi_parts[0]."-" .($kpi_parts[1]+1);
 }
}

