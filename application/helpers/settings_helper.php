<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*
  Retrieves and avails app settings
*
*/


if (!function_exists('settings')) {

    function settings($text = null)
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

