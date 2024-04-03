<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*
  Retrieves and avails app settings
*
*/


if (!function_exists('settings')) {

    function settings($text = FALSE)
    {
        $ci =& get_instance();
        $ci->load->database();
        $table  = 'setting';
  
        $settings = $ci->db->get($table)->row();
        $menu = $settings->use_category_two;
        if($menu==0):
        return $menu='traditional_menu.php';
        endif;
        if($menu==1):
          return $menu='general_kpi_menu.php';
        endif;
        if($menu==2):
          return $menu='category_two_menu.php';
         endif;
      
    }
 
}
function getkpi_info($kpi_id)
{
  $ci =& get_instance();
  $ci->load->database();

  if (!empty($kpi_id)) {
    $query = $ci->db->query("SELECT * from kpi where kpi_id='$kpi_id'");
    return @$row = $query->row();
  } else
    return "";



}

function getColorBasedOnPerformance($value, $target)
{
  //ratios -
 // $performance = (($value / $target) * 100);
  if (!empty($value)) {
    if (($value-$target)>=0) {
      return '#008000';
    } elseif ($value-$target>=-10) {
      return '#FFA500';
    } else {
      return '#FF0000';
    }
 

}}
function generateQuartersOptions($startYear, $endYear, $selectedYear)
{
  $quarters = '';

  for ($year = $startYear; $year <= $endYear; $year++) {
    $quarters .= "<optgroup label=\"$year\">";
    $quarters .= "<option value=\"Q1 $year\"" . ($selectedYear == $year && date('n') >= 7 ? ' selected' : '') . ">Q1 $year</option>";
    $quarters .= "<option value=\"Q2 $year\"" . ($selectedYear == $year && date('n') >= 10 ? ' selected' : '') . ">Q2 $year</option>";
    $quarters .= "<option value=\"Q3 $year\"" . ($selectedYear == $year && date('n') >= 1 && date('n') <= 3 ? ' selected' : '') . ">Q3 $year</option>";
    $quarters .= "<option value=\"Q4 $year\"" . ($selectedYear == $year && date('n') >= 4 && date('n') <= 6 ? ' selected' : '') . ">Q4 $year</option>";
    $quarters .= "</optgroup>";
  }

  return $quarters;
}

