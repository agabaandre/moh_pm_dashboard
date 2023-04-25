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
    function andinfocategory(){
    $info_cat = $_SESSION['info_category'];
    if(isset($info_cat)){
        return "and subject_areas.info_category = $info_cat";
    }
    else{
        return "";
    }
    }
function whereinfocategory()
{
    $info_cat = $_SESSION['info_category'];
    if (isset($info_cat)) {
        return "where subject_areas.info_category = $info_cat";
    } else {
        return "";
    }
}
if (!function_exists('render_csv_data')) {
    function render_csv_data($datas, $filename, $use_columns = true)
    {
        //datas should be assoc array
       // ob_start();
        // write data to CSV file here
    
        $csv_file = $filename . ".csv";
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=\"$csv_file\"");
        $fh = fopen('php://output', 'w+b');

        $is_coloumn = $use_columns;
        if (!empty($datas)) {
             if ($is_coloumn) {
                    fputcsv($fh, array_keys(($datas[0])));
            foreach ($datas as $data) {

                   // $is_coloumn = false;
                    fputcsv($fh, array_values($data));
                }
               
                
            }
            else{
                    
                    fputcsv($fh, $datas);

            
            }
            fclose($fh);
        }
        exit;
    }
    
}


if (!function_exists('session_headings')) {
    function session_headings($data)
    {
        if($data==''){
            return 'Subject Areas';
        
        }
        else{
            return '';
        }
    
    }

}