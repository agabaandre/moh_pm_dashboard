<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*
  Retrieves and avails app settings
*
*/

if(!function_exists('app_settings')){

  function app_settings(){

    $ci =& get_instance();
    $table  = 'setting';
    return $ci->db->get($table)->row();
  }
}


if (!function_exists('settings')) {

    function settings($text = null)
    {
        $settings = app_settings();
        $menu     = $settings->use_category_two;
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

if(!function_exists('financial_years')){

    function financial_years(){

      $startdate="2020";
      $enddate=intval(date('Y')+1);
      $years = range($startdate, $enddate);
      
      $settings = app_settings();

      $yearsHtml ="";
      //print years
          //print years
        foreach ($years as $year) {
          if ((substr($year, 0) + 1) <= substr($enddate, 0)) {
          $fy = $year . ' - ' . (substr($year, 0) + 1);
          $yearsOptions .= '<option value="'.$fy.'"'.(($settings->financial_year==$fy)?"selected":"").'>'.$fy.'</option>';
      
        }
    }

    return $yearsOptions;

  }
}
