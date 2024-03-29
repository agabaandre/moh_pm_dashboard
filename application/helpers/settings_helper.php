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
  $performance = (($value / $target) * 100);
  if (!empty($performance)) {
    if ($performance < 50) {
      return 'red';
    } elseif ($performance >= 50 && $performance < 75) {
      return 'orange';
    } elseif ($performance >= 75) {
      return 'green';
    } else {
      //if there is no target
      return '#088F8F';
    }
  } else {
    return "";
  }

}

