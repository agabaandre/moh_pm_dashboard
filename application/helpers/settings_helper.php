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
        $settings->menu = ($settings->use_category_two==0)?GENERAL_MENU:CATEGORY_MENU;

        return $settings;
      
    }
 
}

