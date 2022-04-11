<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*Developer:Agaba Andrew 2022
* Helps to filter dashboard data by financial year or by the user department
*andyear,whereyear,andsubject,wheresubject
*/
if (!function_exists('dashlimits')) {
 function dashlimits($type){
     if($type=='andyear'):
        return andyearlimit();
     endif;
     if($type=='whereyear'):
        return whereyearlimit();
     endif;
     if($type=='andsubject'):
        return andsubjectlimit();
     endif;
     if($type=='wheresubject'):
        return wheresubjectlimit();
     endif;
     

 }
}
 function andyearlimit(){
        if($_SESSION['fy']!=""){
            $fy=$_SESSION['fy'];
    return "and financial_year='$fy'";   
        }
        else{
   return "";        
        }
    
    }
function whereyearlimit(){
        if($_SESSION['fy']!=""){
            $fy=$_SESSION['fy'];
     return   "where financial_year='$fy'";   
        }
        else{
    return   "";        
        }
    
    }
   //subject area and
  function andsubjectlimit(){
        if($_SESSION['subject_area']!=""){
            @$id=implode(",",json_decode($_SESSION['subject_area']));
  return "and subject_areas.id in ($id)";   
        }
        else{
    return   "";        
        }
    
    }
  function wheresubjectlimit(){
          
        if($_SESSION['subject_area']!=""){
           @$id=implode(",",json_decode($_SESSION['subject_area']));
     return   "where subject_areas.id in ($id)";   
        }
        else{
   return "";        
        }
    
    }
    